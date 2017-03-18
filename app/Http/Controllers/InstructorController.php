<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests;
use App\InstructAvail;
use App\Instructor;
use DB;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function store(Request $req)
    {
        //Save Instructor
        $instructor = new Instructor;
        $instructor->first_name = $req->first_name;
        $instructor->email = $req->email;
        $instructor->save();

        //Save InstructAvail
        $latestInstructorId = $this->getLastInsertedInstructorId()->instructor_id;
        $instructAvail = new InstructAvail;
        $instructAvail->instructor_id = $latestInstructorId;
        $instructAvail->date_start = $req->date_start;
        $availability = $this->getAvailabilityFromCheckboxes($req);
        $this->setInstructorAvailability($instructAvail, $availability);
        $instructAvail->save();

        return redirect()->action('InstructorController@index');
    }

    public function getLastInsertedInstructorId() {
        return DB::table('instructors')->select('instructor_id')->orderBy('instructor_id', 'DESC')->first();
    }

    public function getAvailabilityFromCheckboxes($req) {
        $checkboxes = $req->instructAvail;
        $availability = array_fill(0,10,0);
        foreach($checkboxes as $avail) {
            $availability[$avail] = 1;
        }
        return $availability;
    }

    public function setInstructorAvailability($instructAvail, $availability) {
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
    }

    public function listInstructors() {
        return DB::table('instructors as i')
            ->join('instruct_avails as ia', 'i.instructor_id', '=', 'ia.instructor_id')
            ->select('i.instructor_id', 'i.first_name', 'ia.*')
            ->get();
    }

    public function index() {
        $instructors = $this->listInstructors();
        $courses = Course::all();
        return view('pages.manageInstructor', compact('instructors', 'courses'));
    }
}
