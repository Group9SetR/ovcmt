<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function store(Request $req)
    {

        $course = new Course;

        $course->course_id = $req->course_id;
        $course->session_days = $req->session_days;
        $course->course_type = $req->course_type;
        $course->term_no = $req->term_no;

        $course->save();


        return redirect()->action('CourseController@manageCourse');

    }
    public function index()
    {
        return view('pages.manageCourse');

    }

    public function manageCourse() {
        return view('pages.manageCourse');
    }
}
