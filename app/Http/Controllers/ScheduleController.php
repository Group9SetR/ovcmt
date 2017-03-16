<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function generateCourses()
    {
        $courseofferings = DB::table('courses AS c')
            ->join('course_offerings AS co', 'c.crs_id', '=', 'co.crs_id')
            ->select('c.crs_id AS crs_id', 'c.sessions_days AS sessions_days', 'c.crs_type AS crs_type', 'c.term AS term', 'co.instruct_id AS instruct_id', 'co.ta_id AS ta_id')
            ->get();
        return $courseofferings;
    }

    public function calculateDiff($courseofferings) {
        foreach ($courseofferings as $offering) {
            $count = DB::table('rooms_by_day')
                ->count()
                ->where('am_crn', $offering->crs_id)
                ->orwhere('pm_crn', $offering->crs_id);

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
        $courseofferings = $this->generateCourses();
        $offeringswithsessions = $this->calculateDiff($courseofferings);
        return view('pages.addschedule', compact('courseofferings','offeringswithsessions'));
    }
}
