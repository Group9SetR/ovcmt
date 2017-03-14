<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Tester extends Controller
{

    public function generateCourses()
    {
        $courseofferings = DB::table('course AS c')
            ->join('course_offering AS co', 'c.crs_id', '=', 'co.crs_id')
            ->select('c.crs_id AS crs_id', 'c.sessions_days AS sessions_days', 'c.crs_type AS crs_type', 'c.term AS term', 'co.instruct_id AS instruct_id', 'co.ta_id AS ta_id')
            ->get();

        return $courseofferings;
    }

    public function index()
    {
        $var = $this->generateCourses();
        return $var;
    }
}

