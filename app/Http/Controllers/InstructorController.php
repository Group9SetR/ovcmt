<?php

namespace App\Http\Controllers;

use App\Instructor;
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


        return redirect()->action('InstructorController@manageInstructor');

    }

    public function listInstructors() {
        return DB::table('instructors')
            ->select('instructor_id', 'first_name')
            ->get();
    }

    public function index()
    {
        $instructors = $this->listInstructors();
        return view('pages.manageInstructor', compact('instructors'));
    }

    public function manageInstructor() {
        $instructors = $this->listInstructors();
        return view('pages.manageInstructor', compact('instructors'));
    }



}
