<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;


class InstructorController extends Controller
{

    public function insert(Request $reg)
    {
    /*
        $user = new Instructor;

        $user ->first_name =Input('first_name');
        $user ->last_name =Input::post("last_name");
        $user ->email =Input::post("email");
        $user ->save();

        return Redirect::back();
*/
        $id = null;
        $first_name = $reg -> input('first_name');
        $last_name = $reg -> input('last_name');
        $email = $reg -> input('email');

        $data = array("instructor_id"=>$id,"first_name"=>$first_name, "last_name" =>$last_name, "email" => $email);

        DB::table('instructor')-> insert($data);





    }

    public function index()
    {
        return view('pages.manageInstructor');

    }

    public function manageInstructor() {
        return view('pages.manageInstructor');
    }







}
