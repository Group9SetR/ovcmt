<?php

namespace App\Http\Controllers;

use App\CourseInstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Instructor;

class AssignController extends Controller
{
    public function getCourses() {
        $courses = DB::table('courses')
            ->whereNotIn('course_id', function($query)
            {
                $query->select(DB::raw(1))
                    ->from('course_instructors')
                    ->whereRaw('course_instructors.course_id = courses.course_id');
            })
            ->get();
        return $courses;
    }

    public function getInstructors() {
        $instructors = Instructor::all();
        return $instructors;
    }

    public function getCourseInstructors() {
        // this adds courses offerings that are already assigned.
        $courseofferings = DB::table('courses AS c')
            ->join('course_offerings AS co', 'c.course_id', '=', 'co.course_id')
            ->join('instructors AS i', 'co.instructor_id', '=', 'i.instructor_id')
            ->select('c.course_id AS course_id', 'co.instructor_id as instructor_id', 'i.first_name as first_name',
                'i.email as email')
            ->get();
//        TODO: add select fields
        return $courseofferings;
    }

    public function store(Request $req) {
        DB::table('course_instructors')
            ->insert(['course_id' => $req->course_id, 'instructor_id' => $req->instructor_id]);

        return redirect()->action('AssignController@index');
    }

    public function index() {
        $courses = $this->getCourses();
        $instructors = $this->getInstructors();
        $courseofferings = $this->getCourseInstructors();
        return view('pages.assign', compact('courses','instructors', 'courseofferings'));
    }
}
