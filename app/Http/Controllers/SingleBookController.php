<?php

namespace App\Http\Controllers;

use App\Models\Book;

class SingleBookController extends Controller
{
    public function index($slug)
    {

        $book = Book::where("slug", $slug)->firstorFail();

        $shareComponent = \Share::currentPage()
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();
        $relatedBooks = Book::get()->where("category_slug", $book->category_slug)->where("draft", 0);
        $avatars = ["avatar1.svg", "avatar2.svg", "avatar3.svg", "avatar4.svg", "avatar5.svg", "avatar6.svg", "avatar7.svg", "avatar8.svg", "avatar9.svg", "avatar10.svg", "avatar11.svg", "avatar12.svg", "avatar13.svg", "avatar14.svg", "avatar15.svg"];

        if (count($relatedBooks) > 6)
            $relatedBooks = $relatedBooks->random(6);
        else
            $relatedBooks = $relatedBooks->random(count($relatedBooks));

        return view("single-book", [
            "book" => $book,
            "relatedBooks" => $relatedBooks,
            "shareComponent" => $shareComponent,
            "avatars" => $avatars
        ]);
    }
}
