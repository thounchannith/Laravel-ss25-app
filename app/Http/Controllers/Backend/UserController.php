<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login()
    {
        return view('backend.user.login');
    }

    public function dologin(Request $req)
    {
        $username = $req->user_name;
        $pwd = md5($req->password);

        $users = DB::table('users')
            ->where('user_name', $username)
            ->where('password', $pwd)
            ->first();

        if ($users != null) {
            session(['user' => $users]);
            return redirect('/');
        }else{
            session()->flash('error', 'Login Failed !!! Invalid Username or Password ');
            return redirect('/login');
        }

    }

    public function logout(Request $req){

        $req->session()->forget('user');
        $req->session()->flush();
        return redirect('/login');

    }

}

