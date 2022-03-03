<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Report;
use App\Models\Comment;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.showPanel");
    }

    public function dashboard()
    {
        $books = Book::get();
        $reports = Report::get();
        $orders = Suggestion::get();
        $comments = Comment::get();
        return view("admin.dashboard", [
            "books" => $books,
            "reports" => $reports,
            "orders" => $orders,
            "comments" => $comments,
        ]);
    }

    public function allBooks()
    {
        $books = Book::get();
        return view("admin.showallbooks", [
            "books" => $books
        ]);
    }
    
    public function publishedBooks()
    {
        $books = Book::where("draft", 0)->get();
        return view("admin.published", [
            "books" => $books
        ]);
    }
    public function draftedBooks()
    {
        $books = Book::where("draft", 1)->get();
        return view("admin.drafted", [
            "books" => $books
        ]);
    }
    public function EditPassword()
    {
        return view("admin.edit-password");
    }

    public function updatePassword(Request $request, User $user)
    {
        $credentials = $request->validate([
            "password" => "required|confirmed"
        ]);
        $user->update(["password" => bcrypt($credentials['password'])]);
        return back()->with("success", "Your password has been change successfully");
    }

    public function adminsDetails()
    {
        return view('admin.admins-details');
    }
}
