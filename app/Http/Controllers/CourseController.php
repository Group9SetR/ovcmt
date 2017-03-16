<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

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

    public function listCourses() {
        return DB::table('courses')
            ->select('course_id', 'sessions_days', 'course_type', 'term_no')
            ->get();
    }

    public function index() {
        $courses = $this->listCourses();
        return view('pages.manageCourse', compact('courses'));

    }

    public function manageCourse() {
        $courses = $this->listCourses();
        return view('pages.manageCourse', compact('courses'));
    }
}
