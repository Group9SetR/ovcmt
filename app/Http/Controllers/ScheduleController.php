<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Carbon;
use App\Course;
use App\RoomsByDays;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function store(Request $req)
    {
        $roomsByDays = new RoomsByDays();
        $input = $req->all();
        dd($input);
        $roomsByDays->room_id = $req->room_id;
        $roomsByDays->cdate = $req->cdate;
        $roomsByDays->am_crn = $req->am_crn;
        $roomsByDays->pm_crn = $req->pm_crn;
        $roomsByDays->save();
        return redirect()->action('ScheduleController@dragDrop');
    }

    public function generateCourses()
    {
        $courseofferings = DB::table('courses AS c')
            ->join('course_offerings AS co', 'c.course_id', '=', 'co.course_id')
            ->select('co.crn AS crn','c.course_id AS course_id', 'c.sessions_days AS sessions_days', 'c.course_type AS course_type',
                        'c.term_no AS term_no', 'co.instructor_id AS instructor_id', 'co.ta_id AS ta_id')
            ->get();
        return $courseofferings;
    }

    public function calculateDiff($courseofferings) {
        $courseOfferingsDiff = array();
        foreach ($courseofferings as $offering) {
            $count = DB::table('rooms_by_days')
                ->where('am_crn', $offering->crn)
                ->orwhere('pm_crn', $offering->crn)
                ->count();
            $courseOfferingsDiff[$offering->crn] = $offering->sessions_days - $count;
        }
        return $courseOfferingsDiff;
    }

    public function listCourses() {
        $courseList = Course::all();
        return $courseList;
    }

    public function displayRoomsByWeek(Request $req) {
        $cdate = DateTime::createFromFormat('Y-m-d', $req->schedule_starting_date);
        $year =$cdate->format('Y');
        $week = $cdate->format('W');
        $calendarDetails = $this->getCalendarDetails($cdate, $year, $week);
        $courseOfferings = $this->generateCourses();
        $roomsByWeek = $this->getScheduleByWeek($year, $week);
        $courseOfferingsSessions = $this->calculateDiff($courseOfferings);
        return view('pages.dragDrop', compact('calendarDetails','courseOfferings', 'courseOfferingsSessions', 'roomsByWeek'));
    }

    public function getScheduleByWeek($year, $week) {
        $amRoomsByWeek = DB::table('course_offerings AS co')
            ->join('rooms_by_days AS r', 'co.crn', '=', 'r.am_crn')
            ->join('calendar_dates AS c', 'r.cdate','=','c.cdate')
            ->select('r.room_id AS room_id', 'r.cdate AS date', 'r.am_crn AS crn','co.course_id AS course_id',
                'c.cdayOfWeek AS cdayOfWeek', DB::raw("'am' AS time"))
            ->where([
                ["c.cyear", $year],
                ["c.cweek",$week]
            ])
            ->whereNotNull('r.am_crn')
            ->whereIn('c.cdayOfWeek',[2,3,4,5,6]);
        $pmRoomsByWeek = DB::table('course_offerings AS co')
            ->join('rooms_by_days AS r', 'co.crn', '=', 'r.pm_crn')
            ->join('calendar_dates AS c', 'r.cdate','=','c.cdate')
            ->select('r.room_id AS room_id', 'r.cdate AS date', 'r.pm_crn AS crn','co.course_id AS course_id',
                'c.cdayOfWeek AS cdayOfWeek', DB::raw("'pm' AS time"))
            ->where([
                ["c.cyear", $year],
                ["c.cweek",$week]
            ])
            ->whereNotNull('r.pm_crn')
            ->whereIn('c.cdayOfWeek',[2,3,4,5,6]);
        $allRoomsByWeek = $pmRoomsByWeek->union($amRoomsByWeek)->get();
        return $allRoomsByWeek;
    }

    public function getCalendarDetails($date, $year, $week)
    {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $calendar = array('month'=>$date->format('m'),
            'year'=>$date->format('Y'),
            'date'=>$date,
            'mon'=>$dto->format('d'));
        $dto->modify('+1 days');
        $calendar['tues']=$dto->format('d');
        $dto->modify('+1 days');
        $calendar['wed']=$dto->format('d');
        $dto->modify('+1 days');
        $calendar['thurs']=$dto->format('d');
        $dto->modify('+1 days');
        $calendar['fri']=$dto->format('d');
        return $calendar;
    }

    public function index() {
        //TODO pass a date via term selection on /addschedule instead of using hardcoded date on line 89
        $courseOfferings = $this->generateCourses();
        $cdate = Carbon\Carbon::today(new DateTimeZone('America/Vancouver'));
        $year = $cdate->format('Y');
        $week = $cdate->format('W');
        $calendarDetails = $this->getCalendarDetails($cdate, $year ,$week);
        $roomsByWeek = $this->getScheduleByWeek($year, $week);
        $courseOfferingsSessions = $this->calculateDiff($courseOfferings);
        return view('pages.dragDrop', compact('calendarDetails','courseOfferings', 'courseOfferingsSessions', 'roomsByWeek'));
    }
}
