<?php

namespace App\Http\Controllers;

use DOMXPath;
use DOMDocument;
use App\Models\Book;
use GuzzleHttp\Client;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Notifications\BookPublished;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::filter(request(["search", "category", "search", "tag", "published"]))->paginate(22);
        $shareComponent = \Share::currentPage()
            ->facebook()
            ->pinterest()
            ->twitter()
            ->whatsapp()
            ->linkedin()
            ->reddit()
            ->telegram();

        $currentCategory = str_replace("-", " ", request("category"));
        $tags = Book::groupBy("tag")->get('tag');
        if ($currentCategory == "")
            $currentCategory = null;
        return view("index", [
            "books" => $books,
            "categories" => Category::all(),
            "currentCategory" => $currentCategory,
            "shareComponent" => $shareComponent,
            "tags" => $tags
        ]);
    }

    public function draft($id)
    {
        if (request()->has("draftForm")) {
            $book = Book::find($id);
            $book->update(["draft" => 1]);
            return back();
        }
    }
    public function publish($id)
    {
        if (request()->has("publishForm")) {
            $book = Book::find($id);
            $book->update(["draft" => 0]);
            return back();
        }
    }

    public function getTheLink($slug)
    {
        $book = Book::get()->where("slug", $slug)->first();
        $relatedBooks = Book::get()->where("tag", $book->tag)->where('title', '!=', $book->title);
        if (count($relatedBooks) == 0)
            $relatedBooks = Book::get()->where("category", $book->category);
        $url = $book->download_link;
        $d_link2 = "";
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
            $d_link = $book->download_link2;
            $d_link2 = $book->download_link3;
        }
        return view("get-the-link", [
            "d_link" => $d_link,
            "d_link2" => $d_link2,
            "slug" => $slug,
            "book_size" => $book->PDF_size,
            "book" => $book,
            "relatedBooks" => $relatedBooks
        ]);
    }

    public function sendTelegramNotif(Request $request)
    {
        $book = Book::findOrFail($request->id);
        $book->notify(new BookPublished());
        return response()->json(['success' => 'Telegram notification has been sent']);
    }
    public function howToDowload()
    {
        return view("how-to-download");
    }

    public function ebooksFormats()
    {
        return view("ebooks-formats");
    }
    public function about()
    {
        return view("about");
    }
    public function privayPolicy()
    {
        return view("privacy-policy");
    }
}
