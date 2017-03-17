<?php

namespace App\Http\Controllers;

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
        $courseinstructor = DB::table('courses AS c')
            ->join('course_instructors AS ci', 'c.course_id', '=', 'ci.course_id')
            ->join('instructors AS i', 'ci.instructor_id', '=', 'i.instructor_id')
            ->select('')
            ->get();
//        TODO: add select fields
        return $courseinstructor;
    }

    public function store(Request $req) {
        DB::table('course_instructors')
            ->insert(['course_id' => $req->course_id, 'instructor_id' => $req->instructor_id]);

        return redirect()->action('AssignController@index');
    }

    public function index() {
        $courses = $this->getCourses();
        $instructors = $this->getInstructors();
        return view('pages.assign', compact('courses','instructors', 'courseinstructor'));
    }
}
