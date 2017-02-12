<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Foundation\Auth\Access\AuthorizeResources;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return '/studauth';
        } elseif (Auth::user()->usertype == 'admin') {
            return '/adminauth';
        } elseif (Auth::user()->usertype == 'staff') {
            return '/staffauth';
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

    public function login(Request $req)
    {
        $email = $req->input('email');
        $password = $req->input('password');

        echo "email: $email <br>";
        echo "password: $password <br>";

        // $checkLogin = DB::table('users')->where(['email'=>$email,'password'=>$password])->get();

        $checkEmail = DB::table('users')->where(['email' => $email])->get();

        /*
         * if email within database
         *      if password is correct and matches email
         *          if stud
         *              redirect to stud page
         *          if staff
         *              redirect to staff page
         *          if admin
         *              redirect to admin page
         *      else
         *          display 'incorrect password' message
         *          and redirect back to empty login form
         * else
         *      display 'email is not registered'
         *      and redirect back to empty login form
         */
        if (count($checkEmail) > 0) {
            $correctPassword = DB::table('users')->where('email', $email)->value('password');
            $userType = DB::table('users')->where('email', $email)->value('usertype');
            if ($password == $correctPassword) {
                // check userType
                if ($userType == 'student') {
                    return redirect()->action('PagesController@studauth');
                } else if ($userType == 'staff') {
                    return redirect()->action('PagesController@staffauth');
                } else if ($userType == 'admin') {
                    return redirect()->action('PagesController@adminauth');
                }
            } else {
                // incorrect password
                echo "<h1 style='color: red;'>incorrect password</h1> <br>";
                // return redirect()->action('LoginController@login');
            }
        } else {
            // email is not registered
            echo "<h1 style='color: red;'>email is not registered</h1> <br>";
            // return redirect()->action('LoginController@login');
        }
    }
}
