<?php

namespace App\Http\Controllers;

use App\CourseInstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Instructor;

class AssignController extends Controller
{
    public function getInstructors() {
        $instructors = Instructor::all();
        return $instructors;
    }

    public function store(Request $req) {
        DB::table('course_instructors')
            ->insert(['course_id' => $req->course_id, 'instructor_id' => $req->instructor_id]);

        return redirect()->action('AssignController@index');
    }

    public function index() {
        return view('pages.assign');
    }
}
