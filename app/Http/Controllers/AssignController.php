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
            ->join('instructor AS i', 'ci.instructor_id', '=', 'i.instructor_id')
            ->select('')
            ->get();
//        TODO: add select fields
        return $courseinstructor;
    }

    public function store(Request $req) {
        DB::table('course_instructor')
            ->insert(['crs_id' => $req->crs_id, 'instructor_id' => $req->instructor_id]);

        return redirect()->action('AssignController@index');
    }

    public function index() {
        $courses = $this->getCourses();
        $instructors = $this->getInstructors();
        return view('pages.addschedule', compact('courses','instructors', 'courseinstructor'));
    }
}
