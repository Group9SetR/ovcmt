<?php

namespace App\Http\Controllers;
use DB;
use App\RoomsByDay;
use App\Term;
use App\Intake;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class ScheduleViewController extends Controller
{
    /**
     * Get all dates in a calendar month.
     * @param $days
     * @return array of weeks
     */
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

    /**
     * Generate the entire schedule by month given an intake and a date.
     * @param $date
     * @return array
     */
    public function getScheduleByMonth($date, $intake)
    {
        $terms = Term::where('intake_id', $intake)
            ->select('term_id')
            ->get();
        $amCourses = DB::table('rooms_by_days AS r')
            ->leftjoin('course_offerings AS co', 'r.am_crn', '=', 'co.crn')
            ->join('course_instructors AS ci', function($join) {
                $join->on('co.course_id', '=',  'ci.course_id');
                $join->on('co.instructor_id','=', 'ci.instructor_id');
                $join->on('co.intake_no','=', 'ci.intake_no');
            })
            ->join('courses AS c', 'ci.course_id', '=', 'c.course_id')
            ->select('r.room_id', 'c.course_id', 'r.cdate', 'c.color')
            ->whereMonth('r.cdate', $date->format('n'))
            ->whereYear('r.cdate', $date->format('Y'))
            ->whereIn('co.term_id', $terms)
            ->get();
        $pmCourses = DB::table('rooms_by_days AS r')
            ->leftjoin('course_offerings AS co', 'r.pm_crn', '=', 'co.crn')
            ->join('course_instructors AS ci', function($join) {
                $join->on('co.course_id', '=',  'ci.course_id');
                $join->on('co.instructor_id','=', 'ci.instructor_id');
                $join->on('co.intake_no','=', 'ci.intake_no');
            })
            ->join('courses AS c', 'ci.course_id', '=', 'c.course_id')
            ->select('r.room_id', 'c.course_id', 'r.cdate', 'c.color')
            ->whereMonth('r.cdate', $date->format('n'))
            ->whereYear('r.cdate', $date->format('Y'))
            ->whereIn('co.term_id', $terms)
            ->get();
        return array('am_courses'=>$amCourses, 'pm_courses'=>$pmCourses);
    }

    /**
     * Provide all intakes for schedule view selection.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function select()
    {
        $intakes = DB::table('intakes as i')
            ->select('i.*', DB::raw('YEAR(i.start_date) AS start_year'))
            ->get();
        return view('pages.selectstudentschedule', compact('intakes'));
    }

    //
    public function index(Request $req)
    {
        if(isset($req->schedule_starting_date)) {
            //if it's set then we should go to this date
            $schedDate = DateTime::createFromFormat('Y-m-d', $req->schedule_starting_date);
        } else {
            //Default to current week otherwise
            $schedDate = new DateTime(null, new DateTimeZone('America/Vancouver'));
        }
        $calendar = DB::table('calendar_dates')
            ->where('cmonth', $schedDate->format('n'))
            ->where('cyear', $schedDate->format('Y'))
            ->where('isWeekday', 1)
            ->get();
        $weeks = $this->getCalendar($calendar);
        $courses = $this->getScheduleByMonth($schedDate, $req->schedule_intake);
        $intake_info = Intake::where('intake_id', $req->schedule_intake)
            ->select('intake_no', 'start_date')
            ->first();
        $intake_info->start_date = DateTime::createFromFormat('Y-m-d', $intake_info->start_date);
        $details = array('intake_id'=>$req->schedule_intake, 'schedule_date'=>$schedDate, 'intake_info'=>$intake_info);
        return view('pages.schedulestudent', compact('weeks', 'courses','details'));
    }

}
