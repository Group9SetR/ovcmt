<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;


class AddUserController extends Controller
{


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'usertype' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    }


    public function store(Request $req) {
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->usertype = $req->usertype;
        $user->save();
        return redirect()->action('AddUserController@index');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'usertype' => $data['usertype'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function index(){
        $admins = DB::table('users')
            ->where('usertype', 'admin')
            ->get();
        return view('pages.addUser',compact('admins'));
    }

}
