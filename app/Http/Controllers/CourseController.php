<?php

namespace App\Http\Controllers;

use DB;
use App\Course;
use App\Http\Requests;
use Illuminate\Http\Request;


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

    public function listCourse() {
        return DB::table('courses')
            ->select('course_id', 'sessions_days', 'course_type', 'term_no')
            ->get();
    }
    public function index()
    {

        return view('pages.manageCourse');

    }

    public function manageCourse() {
        $courses = $this->listCourse();
        return view('pages.manageCourse', compact('courses'));
    }
}
