<?php

namespace App\Http\Controllers;

use App\CourseInstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Instructor;
use App\Term;

class AssignController extends Controller
{
    public function store(Request $req) {
        DB::table('course_instructors')
            ->insert(['course_id' => $req->course_id, 'instructor_id' => $req->instructor_id]);

        return redirect()->action('AssignController@index');
    }

    public function getTerms() {
        return Term::all();
    }

    public function index() {
        $terms = $this->getTerms();
        return view('pages.assign', compact('terms'));
    }
}
