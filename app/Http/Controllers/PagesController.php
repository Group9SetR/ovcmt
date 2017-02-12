<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('pages.about');
    }


    public function adminauth() {
        return view('pages.adminauth');
    }
    public function staffauth() {
        return view('pages.staffauth');
    }
    public function studauth() {
        return view('pages.studauth');
    }
    public function tolschedualview(){
        return view('pages.tolschedualview');
    }

    public function addschedual(){
        return view('pages.addschedual');
    }

    public function schedulestudent(){
        return view('pages.schedulestudent');
    }

    public function schedulestaff(){
        return view('pages.schedulestaff.');
    }

    public function editSchedule() {
        return view('pages.editSchedule');
    }

    public function register() {
        return view('auth.register');
    }

}
