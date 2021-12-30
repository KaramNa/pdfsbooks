<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(){
        return view("contact-us");
    }

    public function sendEmail(Request $request){
        $details = $request->validate([
            "name" => "required",
            "email" => "required|email",
            "message" => "required",
        ]);

        Mail::to("info@pdfsbooks.com")->send(new ContactMail($details));
        return back()->with("success", "Your message has been sent successfully, Thank You for contacting us");
    }
}
