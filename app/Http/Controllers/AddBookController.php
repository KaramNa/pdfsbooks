<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Goutte\Client;

class AddBookController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("add-book", [
            "categories" => $categories,
        ]);
    }

    public function store()
    {
        if (request()->has("publish") || request()->has("draft")) {
            $attributes =  request()->validate([
                "title" => "required|unique:books,title",
                "qoute" => "",
                "author" => "required",
                "poster" => "image",
                "description" => "required",
                "category" => "required",
                "publisher" => "required",
                "published" => "required",
                "pages" => "required",
                "PDF_size" => "required",
                "language" => "required",
                "download_link2" => "required",
            ]);
            if (request()->has("draft"))
                $attributes["draft"] = 1;
            $slug = str_replace(["?", ",", "/", "|", "&", "$"], "", $attributes["title"]);
            $slug = str_replace(":", " ", $slug);
            $slug = str_replace("#", "sharp", $slug);
            $attributes["slug"] = strtolower(str_replace(" ", "-", $slug));
            $attributes["category_slug"] = strtolower(str_replace(" ", "-", $attributes["category"]));
            $attributes["author"] = "by " . $attributes["author"];
            $attributes["download_link3"] = request("download_link3");
            if (request()->file("poster"))
                $attributes["poster"] = "/storage/" . request()->file("poster")->store("posters", "public");
            else
                $attributes["poster"] = "/storage/" . request("image_url");
            $attributes["PDF_size"] .= " MB";
            if (Book::create($attributes))
                return back()->with("success", "Book has been added. Link: https://pdfsbooks.com/book/"
                    . $attributes["slug"]);
        }
        if (request()->has("fill")) {
            $url = request()->validate([
                "url" => "required",
            ]);
            $categories = Category::all();
            $httpClient = new Client();
            $response = $httpClient->request(
                'GET',
                $url["url"]
            );
            if (str_contains($url["url"], "itbook.store")) {
                $title = addslashes($response->evaluate('//h1')->text());
                $description = addslashes($response->evaluate('//div[@id="desc"]')->text());
                $publisher = $response->evaluate('//table[@class="table table-striped"]//td[@itemprop="publisher"]//b')->text();
                $pages = $response->evaluate('//table[@class="table table-striped"]//b[@itemprop="numberOfPages"]')->text();
                $language = $response->evaluate('//table[@class="table table-striped"]//b[@itemprop="inLanguage"]')->text();
                $published = $response->evaluate('//table[@class="table table-striped"]//td//a')->text();
                $qouteNum = $response->filter("h2")->count();
                if ($qouteNum > 0) {
                    $qoute = addslashes($response->filter('h2')->text());
                } else {
                    $qoute = "";
                }
                $author = $response->filter('td.t50')->siblings()->text();
                $image_name = "posters/" .  basename($response->evaluate('//img[@class="imgborder"]')->extract(["src"])[0]);
                $poster = "https://itbook.store" . $response->evaluate('//img[@class="imgborder"]')->extract(["src"])[0];
                Storage::disk('local')->put("public/" . $image_name, file_get_contents($poster));

                $details["title"] = $title;
                $details["description"] = $description;
                $details["publisher"] = $publisher;
                $details["pages"] = $pages;
                $details["language"] = $language;
                $details["published"] = $published;
                $details["qoute"] = $qoute;
                $details["author"] = $author;
                $details["image_url"] = $image_name;
                $details["size"] = "";
            } else {
                $attr = $response->filter('tr td');
                foreach ($attr as $value) {
                    if ($value->textContent == "Title: ")
                        $title = $value->nextSibling->textContent;
                    elseif ($value->textContent == "Author(s):")
                        $authors = $value->nextSibling->textContent;
                    elseif ($value->textContent == "Publisher:") {
                        $publisher = $value->nextSibling->textContent;
                    } elseif ($value->textContent == "Year:") {
                        $published = $value->nextSibling->textContent;
                    } elseif (str_contains($value->textContent, "Pages (biblio\\tech):")) {
                        $pages = $value->nextSibling->textContent;
                        $pages = explode("\\", $pages)[0];
                    } elseif ($value->textContent == "Language:") {
                        $language = $value->nextSibling->textContent;
                    } elseif ($value->textContent == "Size:") {
                        $size_temp = $value->nextSibling->textContent;
                        $size = explode("(", $size_temp)[0];
                        $size = preg_replace('/[^0-9.]/', '', $size);
                        if (str_contains($size_temp, "kB"))
                            $size = number_format($size / 1024, 1);
                    }
                }
                $description = addslashes($response->evaluate('//td[@colspan="4"]')->text());
                $image_name = "posters/" .  basename($response->evaluate('//img')->extract(["src"])[0]);
                $image_src = $response->evaluate('//img')->extract(["src"])[0];
                if (str_contains($image_src, "https"))
                    $poster = $image_src;
                else
                    $poster = "https://www.libgen.is" .  $image_src;
                Storage::disk('local')->put("public/" . $image_name, file_get_contents($poster));

                $categories = Category::all();
                $details["title"] = $title;
                $details["description"] = $description;
                $details["publisher"] = $publisher;
                $details["pages"] = $pages;
                $details["language"] = $language;
                $details["published"] = $published;
                $details["qoute"] = "";
                $details["author"] = $authors;
                $details["image_url"] = $image_name;
                $details["size"] = $size;
            }
            return view("add-book", [
                "categories" => $categories,
                "details" => $details
            ]);
        }
    }


    public function edit($id)
    {
        $categories = Category::all();
        $book = Book::find($id);
        return view("edit-book", [
            "categories" => $categories,
            "book" => $book
        ]);
    }

    public function update($id)
    {
        $book = Book::find($id);
        $attributes =  request()->validate([
            "title" => "required",
            "qoute" => "",
            "author" => "required",
            "poster" => "image",
            "description" => "required",
            "category" => "required",
            "publisher" => "required",
            "published" => "required",
            "pages" => "required",
            "PDF_size" => "required",
            "language" => "required",
        ]);

        $attributes["title_slug"] = strtolower(str_replace(" ", "-", $attributes["title"]));
        $attributes["category_slug"] = strtolower(str_replace(" ", "-", $attributes["category"]));
        if (isset($attributes["poster"]))
            $attributes["poster"] = "/storage/" . request()->file("poster")->store("posters", "public");
        $attributes["download_link2"] = request("download_link2");
        $attributes["download_link3"] = request("download_link3");
        $book->update($attributes);

        return back()->with("success", "Book has been updated");
    }

    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect(route("home"));
    }
}
