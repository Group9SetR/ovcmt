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
        //TODO: add intake_no?? but how?

        return redirect()->action('AssignController@index');
    }

    //TODO assign course to instructor or ta - already linked up front end in assign blade
    public function assignCourse(Request $req) {
        $intake_no = Term::where('term_id', $req->term_id)
        ->pluck('intake_no');
        if(isset($req->ta_id)) {
            $courseoffering = CourseOffering::firstOrNew(['term_id' => $req->term_id, 'course_id' => $req->course_id, 'intake_no' => $intake_no]);
            $courseoffering->ta_id = $req->ta_id;
            $courseoffering->save();
        } else if (isset($req->instructor_id)) {
            $courseoffering = CourseOffering::firstOrNew(['term_id' => $req->term_id, 'course_id' => $req->course_id, 'intake_no' => $intake_no]);
            $courseoffering->instructor_id = $req->instructor_id;
            $courseoffering->save();
        }
        return redirect()->action('AssignController@index');
    }

    //TODO unassign instructor or ta from course - already linked up front end in assign blade
    public function unassignCourse(Request $req) {
        $courseoffering = CourseOffering::where('course_id', $req->course_id)
            ->where('instructor_id', $req->instructor_id)
            ->where('term_id', $req->term_id)
            ->where('intake_no', $req->intake_no);
        $courseoffering->delete();
        return redirect()->action('AssignController@index');
    }

    public function getTerms() {
        return Term::all();
    }

    public function listInstructors() {
        return DB::table('instructors as i')
            ->join('instruct_avails as ia', 'i.instructor_id', '=', 'ia.instructor_id')
            ->select('i.instructor_id', 'i.first_name', 'ia.*')
            ->get();
    }

    public function index() {
        $instructors = $this->listInstructors();
        $terms = $this->getTerms();
        return view('pages.assign', compact('terms', 'instructors'));
    }
}
