<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('backend.auth.login');
    }

    public function postLogin(Request $req)
    {
        $req->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);

        $user = $req-> only('user_name', 'password');
        if (Auth::attempt($user)) {
            return redirect()->intended()->with('success', 'Login Successfully');
        }
        return redirect()->back()->with('error', 'Login Failed !!! Invalid Username or Password ');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}
