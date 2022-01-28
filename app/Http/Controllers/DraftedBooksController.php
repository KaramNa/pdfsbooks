<?php

namespace App\Http\Controllers;

use App\Models\Book;

class DraftedBooksController extends Controller
{
    public function index()
    {
        $drafted_books = Book::where("draft", 1)->paginate(10);
        return view("drafted-books", [
            "drafted_books" => $drafted_books
        ]);
    }

    public function publish()
    {
        if (request()->has('publishForm')) {
            $data = request("drafted");
            if ($data) {
                foreach ($data as $id) {
                    Book::find($id)->update(["draft" => 0]);
                }
                return back();
            } else {
                return back()->with("status", "You must select one book at least");
            }
        }
    }
    public function draft()
    {
        if (request()->has('draftForm')) {
            $data = request("published");
            if ($data) {
                foreach ($data as $id) {
                    Book::find($id)->update(["draft" => 1]);
                }
                return back();
            } else {
                return back()->with("status", "You must select one book at least");
            }
        }
    }
}
