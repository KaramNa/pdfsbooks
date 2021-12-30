<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;


class CommentController extends Controller
{
    public function comment(){
        $details = request()->validate([
            "name" => "required",
            "email" => "required|email",
            "comment" => "required"
        ]);
        $details["book_id"] = request("dd");
        $details["avatar"] = request("avatar");
        Comment::create($details);
        Notification::create([
            "username" => request("name"),
            "link" => request("link"),
            "notif_type" => "comment"
        ]);
        
        return back();
    }

    public function delete($id){
        $comment = Comment::find($id);
        $comment->delete();

        return back();
    }
}
