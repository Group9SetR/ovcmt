<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function store(Request $req) {
        // TODO: add logic for determining other columns
        $term = new Term();
        $term->term_start_date = $req->term_start_date;
        return redirect()->action('TermController@index');
    }
    public function index() {
        $terms = Term::all();
        return view('pages.addterm', compact('terms'));
    }
}
