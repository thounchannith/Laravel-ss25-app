<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    }

}
