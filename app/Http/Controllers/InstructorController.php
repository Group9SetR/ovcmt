<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\InstructAvail;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

class InstructorController extends Controller
{
    public function store(Request $req)
    {
        $instructor = new Instructor;

        $instructor->first_name = $req->first_name;
        $instructor->email = $req->email;
        $instructor->save();

        $latestInstructorId = $this->getLastInsertedInstructorId()->instructor_id;
        $instructAvail = new InstructAvail;
        $instructAvail->instruct_id = $latestInstructorId;
        $instructAvail->date_start = '2017/03/27';

        $checkboxes = $req->instructAvail;
        $availability = array_fill(0,10,0);
        foreach($checkboxes as $avail) {
            $availability[$avail] = 1;
        }

        $instructAvail->mon_am = $availability[0];
        $instructAvail->tues_am = $availability[1];
        $instructAvail->wed_am = $availability[2];
        $instructAvail->thurs_am = $availability[3];
        $instructAvail->fri_am = $availability[4];
        $instructAvail->mon_pm = $availability[5];
        $instructAvail->tues_pm = $availability[6];
        $instructAvail->wed_pm = $availability[7];
        $instructAvail->thurs_pm = $availability[8];
        $instructAvail->fri_pm = $availability[9];
        $instructAvail->save();
        return redirect()->action('InstructorController@manageInstructor');
    }

    public function getLastInsertedInstructorId() {
        return DB::table('instructors')->select('instructor_id')->orderBy('instructor_id', 'DESC')->first();
    }

    public function listInstructors() {
        return DB::table('instructors')
            ->select('instructor_id', 'first_name')
            ->get();
    }

    public function index() {
        $instructors = $this->listInstructors();
        return view('pages.manageInstructor', compact('instructors'));
    }
}
