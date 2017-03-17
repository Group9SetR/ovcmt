<?php

namespace App\Http\Controllers;

use App\Course;
use App\RoomsByDays;
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
            ->join('course_offerings AS co', 'c.course_id', '=', 'co.crs_id')
            ->select('c.course_id AS course_id', 'c.sessions_days AS sessions_days', 'c.course_type AS course_type', 'c.term_no AS term_no', 'co.instructor_id AS instructor_id', 'co.ta_id AS ta_id')
            ->get();
        return $courseofferings;
    }

    public function calculateDiff($courseofferings) {
        foreach ($courseofferings as $offering) {
            $count = DB::table('rooms_by_days')
                ->count()
                ->where('am_crn', $offering->course_id)
                ->orwhere('pm_crn', $offering->course_id);

            $offering->sessions_days = $offering->sessions_days - $count;
        }
        return $courseofferings;
    }

    public function listCourses() {
        $courseList = Course::all();
        return $courseList;
    }

    public function index()
    {
        return view('pages.addschedule');
    }

    public function dragDrop() {
        $courseList = $this->listCourses();
        $courseofferings = $this->generateCourses();
        $offeringswithsessions = $this->calculateDiff($courseofferings);
        return view('pages.dragDrop', compact('courseofferings','offeringswithsessions', 'courseList'));
    }
}
