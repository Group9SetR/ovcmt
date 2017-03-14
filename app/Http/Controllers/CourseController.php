<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function store(Request $req)
    {

        $course = new Course;

        $course->course_id = $req->course_id;
        $course->course_name = $req->course_name;
        $course->course_amen_req = $req->course_amen_req;
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
