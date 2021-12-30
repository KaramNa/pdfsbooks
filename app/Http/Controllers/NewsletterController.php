<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Validation\ValidationException;


class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        $email = request()->validate(["email_address" => "required|email"])["email_address"];

        try {
            $newsletter->subscribe($email);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                "bad_email" => "This email could not be added to our newsletter list, Please try another one."
            ]);
        }
        return back()->with("subscribed_success", "YaY, You are now signed up for our newsletter");
    }
}
