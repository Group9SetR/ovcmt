<?php

namespace App\Http\Controllers;

use DateTime;
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
        foreach ($courseofferings as $offering) {
            $count = DB::table('rooms_by_days')
                ->select(DB::raw('COUNT(*) AS crn_count, start_date'))
                ->where('am_crn', $offering->crn)
                ->orwhere('pm_crn', $offering->crn)
                ->groupBy();
            $offering->sessions_days = $offering->sessions_days - $count;
        }
        return $courseofferings;
    }

    public function listCourses() {
        $courseList = Course::all();
        return $courseList;
    }

    public function getAMScheduleByWeek($year, $week) {
        $amRoomsByWeek = DB::table('rooms_by_days AS r')
            ->join('calendar_dates AS c', 'r.cdate','=','c.cdate')
            ->select('r.room_id AS room_id', 'r.am_crn AS am_crn','c.cdayOfWeek AS cdayOfWeek')
            ->where([
                ["c.cyear", $year],
                ["c.cweek",$week]
            ])
            ->wherein('c.cdayOfWeek',[1,2,3,4,5])
            ->get();
        return $amRoomsByWeek;
    }
    public function getPMScheduleByWeek($year, $week) {
        $pmRoomsByWeek = DB::table('rooms_by_days AS r')
            ->join('calendar_dates AS c', 'r.cdate','=','c.cdate')
            ->select('r.room_id AS room_id', 'r.pm_crn AS pm_crn', 'c.cdayOfWeek AS cdayOfWeek')
            ->where([
                ['c.cyear', $year],
                ['c.cweek',$week]
            ])
            ->wherein('c.cdayOfWeek',[1,2,3,4,5])
            ->get();
        return $pmRoomsByWeek;
    }

    public function displayRoomsByWeek(Request $req) {
        $cdate = DateTime::createFromFormat('Y-m-d', $req->schedule_starting_date);
        $year = $cdate->format('Y');
        $week = $cdate->format('W');
        $amRoomsByWeek = $this->getAMScheduleByWeek($year, $week);
        $pmRoomsByWeek = $this->getPMScheduleByWeek($year, $week);
        $courseofferings = $this->generateCourses();
        return view('pages.dragDrop', compact('courseofferings','amRoomsByWeek', 'pmRoomsByWeek'));
    }

    public function index() {
        //TODO pass a date via term selection on /addschedule instead of using hardcoded date on line 89
        $courseList = $this->listCourses();
        $courseofferings = $this->generateCourses();
        $cdate = DateTime::createFromFormat('Y-m-d', '2017-03-17');
        $year = $cdate->format('Y');
        $week = $cdate->format('W');
        $amRoomsByWeek = $this->getAMScheduleByWeek($year, $week);
        $pmRoomsByWeek = $this->getPMScheduleByWeek($year, $week);
        //$offeringswithsessions = $this->calculateDiff($courseofferings);
        return view('pages.dragDrop', compact('courseofferings', 'courseList', 'amRoomsByWeek', 'pmRoomsByWeek'));
    }
}
