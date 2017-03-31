<?php

namespace App\Http\Controllers;
use DB;
use App\RoomsByDay;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class ScheduleViewController extends Controller
{
    public function getCalendar($days)
    {
        $weeks = array();
        $tmpWeek = array();
        foreach ($days as $day) {
            $date = DateTime::createFromFormat('Y-m-d', $day->cdate);
            array_push($tmpWeek, $date->format('j'));
            if ($day->cdayOfWeek == 6) { //if it's sunday, push
                array_push($weeks, $tmpWeek);
                $tmpWeek = array(); //clear tmp
            }
        }
        if (!empty($tmpWeek)) {
            array_push($weeks, $tmpWeek);
        }
        return $weeks;
    }

    public function getScheduleByMonth($date)
    {
        $amCourses = DB::table('rooms_by_days AS r')
            ->leftjoin('course_offerings AS co', 'r.am_crn', '=', 'co.crn')
            ->join('courses AS c', 'co.course_id', '=', 'c.course_id')
            ->select('r.room_id', 'c.course_id', 'r.cdate', 'c.color')
            ->whereMonth('r.cdate', $date->format('n'))
            ->whereYear('r.cdate', $date->format('Y'))
            ->get();
        $pmCourses = DB::table('rooms_by_days AS r')
            ->leftjoin('course_offerings AS co', 'r.pm_crn', '=', 'co.crn')
            ->join('courses AS c', 'co.course_id', '=', 'c.course_id')
            ->select('r.room_id', 'c.course_id', 'r.cdate','c.color')
            ->whereMonth('r.cdate', $date->format('n'))
            ->whereYear('r.cdate', $date->format('Y'))
            ->get();
        return array('am_courses'=>$amCourses, 'pm_courses'=>$pmCourses);

    }

    //
    public function index()
    {
        //get this month
        $now = new DateTime(null, new DateTimeZone('America/Vancouver'));
        $calendar = DB::table('calendar_dates')
            ->where('cmonth', $now->format('n'))
            ->where('cyear', $now->format('Y'))
            ->where('isWeekday', 1)
            ->get();
        $weeks = $this->getCalendar($calendar);
        $courses = $this->getScheduleByMonth($now);
        return view('pages.schedulestudent', compact('weeks', 'courses'));
    }

}
