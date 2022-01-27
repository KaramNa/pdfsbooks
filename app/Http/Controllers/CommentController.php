<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;


class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::get();
        return view('admin.comments',[
            "comments" => $comments
        ]);
    }
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
            "link" => "/admin/comments",
            "notif_type" => "comment"
        ]);
        
        return back();
    }

    public function delete($id){
        $comment = Comment::find($id);
        $comment->delete();

        return back()->with("success", "The comment has been deleted");

    }
}
