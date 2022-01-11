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
        $avatars = ["avatar1.jpg", "avatar2.jpg", "avatar3.jpg", "avatar4.jpg", "avatar5.jpg", "avatar6.jpg", "avatar7.jpg", "avatar8.jpg", "avatar9.jpg", "avatar10.jpg", "avatar11.jpg", "avatar12.jpg", "avatar13.jpg", "avatar14.jpg", "avatar15.jpg", "avatar16.jpg", "avatar17.jpg", "avatar18.png", "avatar19.jpg", "avatar20.jpg", "avatar21.jpg", "avatar22.jpg", "avatar23.jpg"];

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
