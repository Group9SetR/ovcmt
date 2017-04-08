<?php

namespace App\Http\Controllers;

use App\CourseInstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Instructor;
use App\CourseOffering;
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
        $intake_no = DB::table('terms AS t')
            ->join('intakes AS i', 't.intake_id', '=', 'i.intake_id')
            ->where('t.term_id', $req->term_id)
            ->pluck('intake_no')
            ->first();
        if($req->ta_id != "none" || $req->instructor_id != "none") {
            $courseoffering = CourseOffering::firstOrNew(['term_id' => $req->term_id, 'course_id' => $req->course_id, 'intake_no' => $intake_no]);
        } else {
            return redirect()->back()->with('error', $req->course_id);

        }

        if($req->ta_id != "none") {
            $courseoffering->ta_id = $req->ta_id;
        }
        if ($req->instructor_id != "none") {
            $courseoffering->instructor_id = $req->instructor_id;
        }
        $courseoffering->save();
        return redirect()->action('AssignController@index');
    }

    //TODO unassign instructor or ta from course - already linked up front end in assign blade
    public function unassignCourse(Request $req) {
        $courseoffering = CourseOffering::where('course_id', $req->course_id)
            ->where('term_id', $req->term_id)
            ->where('intake_no', $req->intake_no);
        if (isset($req->instructor_id)) {
            $courseoffering->where('instructor_id', $req->instructor_id);
        }
        if (isset($req->ta_id)) {
            $courseoffering->where('instructor_id', $req->instructor_id);
        }
        $courseoffering->delete();
        return redirect()->action('AssignController@index');
    }

    public function getTerms() {
        $terms = DB::table('terms AS t')
            ->join('intakes AS i', 't.intake_id', '=', 'i.intake_id')
            ->select('t.term_id AS term_id',
                't.term_start_date AS term_start_date',
                't.intake_id AS intake_id',
                't.term_no AS term_no',
                'i.intake_no AS intake_no',
                'i.start_date AS program_start_date')
            ->orderBy('t.term_start_date', 'asc')
            ->orderBy('t.term_no', 'asc', 'i.intake_no')
            ->get();
        return $terms;
    }
    public function index() {
        $terms = $this->getTerms();
        return view('pages.assign', compact('terms'));
    }
}
