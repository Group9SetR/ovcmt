<?php

namespace App\Http\Controllers;

use App\Term;
use App\Intake;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function store(Request $req) {
        // TODO: add logic for determining other columns
        $terms = Term::where('term_id', $req->modal_term_id)
            ->update(['term_start_date'=>$req->modal_term_start_date,
                      'course_weeks'=>$req->modal_course_weeks,
                      'break_weeks'=>$req->modal_break_weeks,
                      'exam_weeks'=>$req->modal_exam_weeks,
                      'duration_weeks'=>$req->modal_exam_weeks+$req->modal_break_weeks+$req->modal_course_weeks])
            ->get();
        dd($terms);
        return redirect()->action('TermController@index');
    }

    public function createTerm(Request $req)
    {
        $term_start = $this->makeTermStarts(Intake::find($req->intake_id)->start_date, $req->term_no);
        $term = new Term;
        $term->term_no = $req->term_no2;
        $term->term_start_date = $term_start;
        $term->course_weeks = $req->course_weeks;
        $term->break_weeks = $req->break_weeks;
        $term->exam_weeks = $req->exam_weeks;
        $term->duration_weeks = $req->course_weeks + $req->break_weeks + $req->exam_weeks;
        $term->save();
    }

    public function makeTermStarts($program_start, $term_no)
    {
        $startdate = DateTime::createFromFormat('Y-m-d', $program_start);
        $start_year = idate('Y', $startdate->getTimestamp());
        //INTAKE A
        if($startdate->format('m') === 9) {
            switch($term_no) {
                case 1:
                    return $program_start;
                    break;
                case 2:
                    return $this->makeTermStartDate($start_year++, "1");
                    break;
                case 3:
                    return $this->makeTermStartDate($start_year, "9");
                    break;
                case 4:
                    return $this->makeTermStartDate($start_year++, "1");
                    break;
            }
        } else {
            switch($term_no) {
                case 1:
                    return $program_start;
                    break;
                case 2:
                    return $this->makeTermStartDate($start_year, "9");
                    break;
                case 3:
                    $this->makeTermStartDate($start_year++, "1");
                    break;
                case 4:
                    $this->makeTermStartDate($start_year, "9");
                    break;
            }
        }
        return $program_start;
    }

    public function makeTermStartDate($year, $month)
    {
        return DateTime::createFromFormat('Y-m-d', "$year-$month-01");
    }

    public function index() {
        $terms = Term::all();
        $intakes = Intake::all();
        return view('pages.manageTerm', compact('intakes', 'terms'));
    }
}
