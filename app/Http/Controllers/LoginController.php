<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view("login");
    }

    public function login()
    {
        $user = request()->validate([
            "name" => "required",
            "password" => "required"
        ]);

        if (auth()->attempt($user)) {
            return redirect(route("home"));
        } else {
            return back()->with("failed", "Username or Password is incorrect");
        }
    }
}
