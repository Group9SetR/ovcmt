<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignController extends Controller
{
    public function getCourses() {
        $courses = DB::table('courses')
            ->whereNotIn('crs_id', function($query)
            {
                $query->select(DB::raw(1))
                    ->from('course_instructor')
                    ->whereRaw('course_instructor.crs_id = course.crs_id');
            })
            ->get();
        return $courses;
    }

    public function getInstructors() {
        $instructors = Instructor::all();
        return $instructors;
    }

    public function getCourseInstructors() {
        $courseinstructor = DB::table('courses AS c')
            ->join('course_instructor AS ci', 'c.crs_id', '=', 'ci.crs_id')
            ->join('instructor AS i', 'ci.instruct_id', '=', 'i.instruct_id')
            ->select('')
            ->get();
        return $courseinstructor;
    }

    public function index() {
        $courses = $this->getCourses();
        $instructors = $this->getInstructors();
        return view('pages.addschedule', compact('courses','instructors', 'courseinstructor'));
    }
}
