<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function store(Request $req) {
        $course = new Course;
        $course->course_id = $req->course_id2;
        $course->sessions_days = $req->sessions_days2;
        $course->course_type = $req->course_type2;
        $course->term_no = $req->term_no2;
        $course->color = $req->color2;
        $course->save();
        return redirect()->action('CourseController@manageCourse');
    }

    public function listCourses() {
        $courseList = Course::all();
        return $courseList;
    }

    public function updateCourse(Request $req) {
        if (Course::find($req->course_id)) {
            $course = Course::find($req->course_id);
            $course->sessions_days = $req->sessions_days;
            $course->course_type = $req->course_type;
            $course->term_no = $req->term_no;
            $course->color = $req->color;
            $course->save();
        }
        return redirect()->action('CourseController@index');
    }

    public function deleteCourse(Request $req) {
        if (Course::find($req->modal_courseid_delete)) {
            $course = Course::find($req->modal_courseid_delete);
            $course->delete();
        }
        return redirect()->action('CourseController@index');
    }

    public function index() {
        $courses = $this->listCourses();
        return view('pages.manageCourse', compact('courses'));
    }
}
