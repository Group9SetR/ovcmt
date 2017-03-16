<?php

namespace App\Http\Controllers;


use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;


class CourseController extends Controller
{
    public function store(Request $req)
    {
        $course = new Course;
        $course->course_id = $req->course_id;
        $course->sessions_days = $req->sessions_days;
        $course->course_type = $req->course_type;
        $course->term_no = $req->term_no;
        $course->save();
        return redirect()->action('CourseController@manageCourse');
    }

    public function index()
    {
        return view('pages.manageCourse');
    }

    public function manageCourse()
    {
        $courses = Course::all();
        return view('pages.manageCourse', compact('courses'));
    }



}
