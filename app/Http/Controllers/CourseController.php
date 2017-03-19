<?php

namespace App\Http\Controllers;

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

    public function listCourses() {
        $courseList = Course::all();
        return $courseList;
    }

    public function updateCourse(Request $req)
    {
        if (Course::find($req->course_id)) {
            $course = Course::find($req->course_id);
            // $course->course_id = $req->course_id;
            $course->sessions_days = $req->sessions_days;
            $course->course_type = $req->course_type;
            $course->term_no = $req->term_no;
            $course->save();
        }

        return redirect()->action('CourseController@index');
    }

    public function index()
    {
        $courses = $this->listCourses();
        return view('pages.manageCourse', compact('courses'));
    }
}
