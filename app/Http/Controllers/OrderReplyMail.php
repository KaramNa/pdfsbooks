<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Support\Facades\Mail;

class OrderReplyMail extends Controller
{
    public function sendMail($id)
    {
        $suggestion = Suggestion::findorFail($id);
        $data = [
            "name" => ucwords($suggestion->orderer_name),
            "subject" => $suggestion->book_name . " free download",
            "email" => $suggestion->orderer_email,
            "book_url" => request("book_url")
        ];
        Mail::send('emails.order-reply-mail', $data, function ($message) use ($data) {
            $message->from('info@pdfsbooks.com', 'PdfsBooks.com');
            $message->to($data["email"], $data["name"]);
            $message->subject($data["subject"]);
        });
        return back()->with("success", "Email has been sent successfully");
    }
}
