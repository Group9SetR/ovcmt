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
        $instructor->last_name = $req->last_name;
        $instructor->email = $req->email;
        $instructor->save();

        return Redirect::back();
    }

    public function index()
    {
        return view('pages.manageInstructor');

    }

    public function manageInstructor() {
        return view('pages.manageInstructor');
    }







}
