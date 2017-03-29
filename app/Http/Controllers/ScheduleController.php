<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Carbon;
use App\Term;
use App\RoomsByDay;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function store(Request $req)
    {
        $saveDate = $req->schedule_date;
        $rooms = DB::table('rooms')
            ->select('room_id')
            ->get();
        $inputs = $req->all();
        $roomSlots = $this->getRoomsAndTimeslots();
        foreach($rooms as $room) {
            $roomId = $room->room_id;
            $roomUpdatesAm = $inputs[$roomSlots[$roomId]["am"]];
            $roomUpdatesPm = $inputs[$roomSlots[$roomId]["pm"]];
            $this->updateRoomByWeek($roomId, $saveDate, $roomUpdatesAm, $roomUpdatesPm);
        }
        //Send back to where schedule was saved
        $cdate = DateTime::createFromFormat('Y-m-d', $req->schedule_date);
        $year =$cdate->format('Y');
        $week = $cdate->format('W');
        $calendarDetails = $this->getCalendarDetails($cdate, $year, $week);
        $courseOfferings = $this->generateCourses($req->selected_term_id);
        $roomsByWeek = $this->getScheduleByWeek($year, $week);
        $courseOfferingsSessions = $this->calculateDiff($courseOfferings);
        $term = DB::table('terms')
            ->where('term_id', $req->selected_term_id)
            ->first();
        return view('pages.dragDrop', compact('calendarDetails','courseOfferings', 'term', 'courseOfferingsSessions', 'roomsByWeek'));
    }

    public function getRoomsAndTimeslots()
    {
        return array('M1'=>array('am'=>'M1-am', 'pm'=>'M1-pm'),
                     'A1'=>array('am'=>'A1-am', 'pm'=>'A1-pm'),
                     'P1'=>array('am'=>'P1-am', 'pm'=>'P1-pm'),
                     'P2'=>array('am'=>'P2-am', 'pm'=>'P2-pm'));
    }

    /**
     * Given a week's schedule for a particular room, update schedule.
     * @param $roomId
     * @param $date
     * @param $amUpdates
     * @param $pmUpdates
     */
    public function updateRoomByWeek($roomId, $date, $amUpdates, $pmUpdates)
    {
        for($i = 0; $i<5; $i++) {
            $weekDay = date("Y-m-d", strtotime($date."+ $i days"));
            $am_crn = $amUpdates[$i] === "empty" ? null:$amUpdates[$i];
            $pm_crn = $pmUpdates[$i] === "empty" ? null:$pmUpdates[$i];
            $updated = RoomsByDay::where('room_id', $roomId)
                ->where('cdate', $weekDay)
                ->update(['am_crn'=>$am_crn,'pm_crn'=>$pm_crn]);
        }
    }

    public function generateCourses($term_id)
    {
        $courseofferings = DB::table('courses AS c')
            ->join('course_offerings AS co', 'c.course_id', '=', 'co.course_id')
            //->join('terms AS t', 'co.term_id', '=', 't.term_id')
            ->select('co.crn AS crn','c.course_id AS course_id', 'c.sessions_days AS sessions_days', 'c.course_type AS course_type',
                        'c.term_no AS term_no', 'co.instructor_id AS instructor_id', 'co.ta_id AS ta_id')
            ->where('co.term_id', $term_id)
            ->get();
        return $courseofferings;
    }

    public function calculateDiff($courseofferings) {
        $courseOfferingsDiff = array();
        foreach ($courseofferings as $offering) {
            $count = RoomsByDay::where('am_crn', $offering->crn)->count() +
                RoomsByDay::where('pm_crn', $offering->crn)->count();
            $courseOfferingsDiff[$offering->crn] = $offering->sessions_days - $count;
        }
        return $courseOfferingsDiff;
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
            'firstOfWeek'=>$dto->format('d/m/Y'),
            'goToDate'=>$dto->format('Y-m-d'), //MUST TAKE THIS FORMAT
            'mon'=>$dto->format('M d'));
        $dto->modify('+1 days');
        $calendar['tues']=$dto->format('M d');
        $dto->modify('+1 days');
        $calendar['wed']=$dto->format('M d');
        $dto->modify('+1 days');
        $calendar['thurs']=$dto->format('M d');
        $dto->modify('+1 days');
        $calendar['fri']=$dto->format('M d');
        return $calendar;
    }

    /**
     * Display schedule using the date selection tool.
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayRoomsByWeek(Request $req) {
        $cdate = $this->extractStartDate($req->selected_term_id);
        $year =$cdate->format('Y');
        $week = $cdate->format('W');
        $calendarDetails = $this->getCalendarDetails($cdate, $year, $week);
        $courseOfferings = $this->generateCourses($req->selected_term_id);
        $roomsByWeek = $this->getScheduleByWeek($year, $week);
        $courseOfferingsSessions = $this->calculateDiff($courseOfferings);
        $term = DB::table('terms')
            ->where('term_id', $req->selected_term_id)
            ->first();
        return view('pages.dragDrop', compact('calendarDetails','courseOfferings', 'courseOfferingsSessions', 'term', 'roomsByWeek'));
    }

    /**
     * Cannot see schedule without first selecting a term.
     * @return redirect to term select.
     */
    public function index() {
        return redirect()->action('ScheduleController@selectTerm');
    }

    public function selectTerm()
    {
        $terms = Term::all();
        return view('pages.selecttermschedule', compact('terms'));
    }

    public function extractStartDate($term_id)
    {
        $term = DB::table('terms')
            ->select('*')
            ->where('term_id', $term_id)
            ->get();
        $cdate = DateTime::createFromFormat('Y-m-d', $term[0]->term_start_date);
        return $cdate;
    }

    public function propagate() {
        return view('pages.propagateschedule');
    }
}
