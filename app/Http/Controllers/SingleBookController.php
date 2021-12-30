<?php

namespace App\Http\Controllers;

use DOMXPath;
use DOMDocument;
use App\Models\Book;
use GuzzleHttp\Client;

class SingleBookController extends Controller
{
    public function index($slug)
    {

        $book = Book::get()->where("slug", $slug)->first();

        $url = $book->download_link;

        if ($url) {
            $httpClient = new Client();
            $response = $httpClient->get($url);
            $htmlString = (string) $response->getBody();
            libxml_use_internal_errors(true);
            $doc = new DOMDocument();
            $doc->loadHTML($htmlString);
            $xpath = new DOMXPath($doc);
            $download_link = $xpath->evaluate('//a[@class="btn-down"]');
            foreach ($download_link as $link) {
                $d_link = 'https://www.dbooks.org' . $link->attributes['href']->value;
            }
        } else {
            $d_link = Book::find($book->id)->download_link2;
        }

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
            $relatedBooks = Book::get()->where("category_slug", $book->category_slug)->random(6);
        else
            $relatedBooks = Book::get()->where("category_slug", $book->category_slug)->random(count($relatedBooks));

        return view("single-book", [
            "book" => $book,
            "relatedBooks" => $relatedBooks,
            "shareComponent" => $shareComponent,
            "d_link" => $d_link,
            "avatars" => $avatars

        ]);
    }
}
