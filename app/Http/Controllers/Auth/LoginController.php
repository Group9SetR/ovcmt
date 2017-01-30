<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login
     */
    protected function redirectTo() {
        if (Auth::user()->usertype == 'student') {
            return view('pages.studauth');
        } elseif (Auth::user()->usertype == 'admin') {
            return view('pages.adminauth');
        } elseif (Auth::user()->usertype == 'staff') {
            return view('pages.staffauth');
        } else {
            return view('home');
        }
    }

    /**
     * Create a new controller instance.
     *
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
