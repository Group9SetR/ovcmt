<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;





class InstructorController extends Controller
{
    /*
    public function addInstructor() {
        $instructor = Instructor::create(['first_name' => 'hansol', 'last_name' => 'lee', 'email' => 'afhd@fakjds.com']);
    }
    */
    public function store(Request $request)
    {

        $input = $request->all();

        return $input;
    }

    public function index()
    {
        $instructor = Instructor::findOrFail();

    }


    public function manageInstructor() {
        return view('pages.manageInstructor');
    }



}
