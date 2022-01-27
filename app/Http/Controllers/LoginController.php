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
        return view("admin.login");
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            "name" => "required",
            "password" => "required"
        ]);
        if (auth()->attempt($credential, $request->has('remember'))) {
            return redirect(route('admin.panel'));
        } else {
            return back()->with("failed", "Username or Password is incorrect");
        }
    }
}
