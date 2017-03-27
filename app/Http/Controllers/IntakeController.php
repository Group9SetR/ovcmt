<?php

namespace App\Http\Controllers;
use App\Intake;
use Illuminate\Http\Request;

class IntakeController extends Controller
{
    //
    public function store(Request $req) {
        // TODO: add logic for determining other columns
        $intake = new Intake();
        $intake->intake_id = $req->intake_id;
        $intake->start_date = $req->start_date;
        $intake->intake_no = $req->intake_no;
        $intake->save();
        return redirect()->action('IntakeController@index');
    }
    public function index() {
        $intakes = Intake::all();
        return view('pages.manageIntake', compact('intakes'));
    }
}
