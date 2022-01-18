<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class RssFeedController extends Controller
{
    public function feed()
    {
        $books = Book::orderBy("id", "desc")->get();
        return response()->view("rss.feed", [
            "books" => $books
        ])->header("Content-Type", "application/xml");
    }

    public function categoryFeed($category)
    {
        $books = Book::where("category_slug", $category)->orderBy("id", "desc")->get();
        if (count($books) == 0)
            abort(404);
        return response()->view("rss.feed", [
            "books" => $books
        ])->header("Content-Type", "application/xml");
    }
}
