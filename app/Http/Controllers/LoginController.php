<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    public function index()
    {
        Session::put('prev.url', URL::previous());
        return view("login");
    }

    public function login()
    {
        $user = request()->validate([
            "name" => "required",
            "password" => "required"
        ]);

        if (auth()->attempt($user)) {
            return redirect(session("prev.url"));
        } else {
            return back()->with("failed", "Username or Password is incorrect");
        }
    }
}
