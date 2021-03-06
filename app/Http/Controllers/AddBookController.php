<?php

namespace App\Http\Controllers;

use Image;
use Goutte\Client;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\TelegramNotification;
use App\Notifications\BookPublished;
use PhpParser\Node\Expr\Throw_;

class AddBookController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $tags = Book::groupBy("tag")->get('tag');
        return view("admin.add-book", [
            "categories" => $categories,
            "tags" => $tags,
        ]);
    }

    public function store()
    {
        if (request()->has("publish") || request()->has("draft")) {
            $rules = [
                "title" => "required|unique:books,title",
                "qoute" => "",
                "author" => "required",
                "description" => "required",
                "category" => "required",
                "publisher" => "required",
                "published" => "required",
                "pages" => "required",
                "PDF_size" => "",
                "tag" => "required",
                "language" => "required",
                "download_link2" => "required",
            ];
            if (request()->image_url == '') {
                $rules["poster"] = "required|image";
            }
            $attributes =  request()->validate($rules);
            if (request()->has("draft"))
                $attributes["draft"] = 1;
            $attributes["tag"] = Str::upper($attributes["tag"]);
            $slug = Str::slug($attributes["title"]);
            $attributes["author"] = $attributes["author"];
            $attributes["paid_download_link"] = request("paid_download_link");
            $attributes["download_link3"] = request("download_link3");
            if (request()->file("poster"))
                $attributes["poster"] = $this->uploadImage(request()->file("poster"));
            else
                $attributes["poster"] = request("image_url");
            $attributes["PDF_size"] .= " MB";
            if ($book = Book::create($attributes)) {
                if (request("telegram_notif")) {
                    TelegramNotification::create([
                        "poster" => $book->poster,
                        "title" => $book->title,
                        "slug" => $book->slug,
                    ]);
                }
                // $book->notify(new BookPublished());
                return back()->with("success", "Book has been added. <a href='https://pdfsbooks.com/book/"
                    . $slug . "' target='_blank'>Book link</a>");
            }
        }
        if (request()->has("fill")) {
            $url = request()->validate([
                "url" => "required",
            ]);
            $categories = Category::all();
            $tags = Book::groupBy("tag")->get('tag');
            $httpClient = new Client();
            $response = $httpClient->request(
                'GET',
                $url["url"]
            );
            if (str_contains($url["url"], "itbook.store")) {
                $title = addslashes($response->evaluate('//h1')->text());
                $description = addslashes($response->evaluate('//div[@id="desc"]')->html());
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
                $poster = "https://itbook.store" . $response->evaluate('//img[@class="imgborder"]')->extract(["src"])[0];
                $image = $this->uploadImage($poster);
                $details["title"] = $title;
                $details["description"] = $description;
                $details["publisher"] = $publisher;
                $details["pages"] = $pages;
                $details["language"] = $language;
                $details["published"] = $published;
                $details["qoute"] = $qoute;
                $details["author"] = $author;
                $details["image_url"] = $image;
                $details["size"] = "";
            } else if (str_contains($url["url"], "link.springer.com")) {
                $title = addslashes($response->evaluate('//span[@id="title"]')->text());
                try {
                    $qoute = addslashes($response->evaluate('//span[@id="sub-title"]')->text());
                } catch (\Throwable $e) {
                    $qoute = '';
                }
                try {
                    $author = addslashes($response->evaluate('//span[@id="editors"]')->html());
                } catch (\Throwable $e) {
                    $author = addslashes($response->evaluate('//span[@id="authors"]')->html());
                }
                $authors = substr(str_replace('<br>', ', ', $author), 0, strlen(str_replace('<br>', ',', $author)) - 1);
                $poster = $response->evaluate('//img[@class="test-cover-image"]')->extract(["src"])[0];
                $image = $this->uploadImage(file_get_contents($poster));
                $description = addslashes($response->evaluate('//div[@itemprop="description"]')->html());
                $publisher = addslashes($response->evaluate('//span[@itemprop="publisher"]')->text());
                $published = addslashes($response->evaluate('//span[@itemprop="copyrightYear"]')->text());
                $pages = addslashes($response->evaluate('//span[@id="number-of-pages"]')->text());
                $pages = explode(', ', $pages)[1];
                try {
                    $link1 = 'https://link.springer.com' . $response->evaluate('//a[@data-track-action="Book download - pdf"]')->extract(["href"])[0];
                    $link2 = 'https://link.springer.com' . $response->evaluate('//a[@data-track-action="Book download - ePub"]')->extract(["href"])[0];
                } catch (\Throwable $e) {
                    $link1 = '';
                    $link2 = '';
                }

                $details["title"] = $title;
                $details["description"] = $description;
                $details["publisher"] = $publisher;
                $details["pages"] = $pages;
                $details["language"] = 'English';
                $details["published"] = $published;
                $details["qoute"] = $qoute;
                $details["author"] = $authors;
                $details["image_url"] = $image;
                $details["size"] = '';
                $details["link1"] = $link1;
                $details["link2"] = $link2;
            } else if (str_contains($url["url"], "libgen")) {
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
                        $pages = explode("\\", $pages)[1];
                        $pages = preg_replace('/[^0-9]/', '', $pages);
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
                $description = addslashes($response->evaluate('//td[@colspan="4"]')->html());
                try {
                    $image_src = $response->evaluate('//img')->extract(["src"])[0];
                    if (str_contains($image_src, "https"))
                        $poster = $image_src;
                    else
                        $poster = "https://www.libgen.is" .  $image_src;
                    $image = $this->uploadImage($poster);
                } catch (\Throwable $e) {
                    $image = '';
                }
                try {
                    $free1 = "";
                    $free2 = "";
                    $nextPageLink = $response->selectLink('this mirror')->link();
                    $nextPage = $httpClient->click($nextPageLink);
                    $donwload_links = $nextPage->evaluate('//div[@id="download"]//ul//li//a');
                    $tempCount = 0;
                    foreach ($donwload_links as $d) {
                        if ($tempCount == 0)
                            $free1 = $d->attributes[0]->value;
                        else if ($tempCount == 1)
                            $free2 = $d->attributes[0]->value;
                        else
                            break;
                        $tempCount++;
                    }
                } catch (\Throwable $e) {
                    $free1 = "";
                    $free2 = "";
                }
                $details["link1"] = $free1;
                $details["link2"] = $free2;
                $details["title"] = $title;
                $details["description"] = $description;
                $details["publisher"] = $publisher;
                $details["pages"] = $pages;
                $details["language"] = $language;
                $details["published"] = $published;
                $details["qoute"] = "";
                $details["author"] = $authors;
                $details["image_url"] = $image;
                $details["size"] = $size;
            } else {
                return back()->with("error", "Please enter a valid url");
            }
            return view("admin.add-book", [
                "categories" => $categories,
                "details" => $details,
                "tags" => $tags
            ]);
        }
    }


    public function edit($id)
    {
        $categories = Category::all();
        $book = Book::find($id);
        $tags = Book::groupBy("tag")->get('tag');
        return view("admin.edit-book", [
            "categories" => $categories,
            "book" => $book,
            "tags" => $tags,
        ]);
    }

    public function update($id)
    {
        if (request()->has("updateForm")) {
            $book = Book::find($id);

            $attributes =  request()->validate([
                "title" => "required",
                "qoute" => "",
                "author" => "required",
                "poster" => "image",
                "description" => "required",
                "category" => "required",
                "tag" => "",
                "publisher" => "required",
                "published" => "required",
                "pages" => "required",
                "PDF_size" => "",
                "language" => "required",
                "post_link" => "",
                "post_text" => "max:255"
            ]);

            if (isset($attributes["poster"]))
                $attributes["poster"] = $this->uploadImage(request()->file("poster"));
            $attributes["paid_download_link"] = request("paid_download_link");
            $attributes["download_link2"] = request("download_link2");
            $attributes["download_link3"] = request("download_link3");
            $attributes["tag"] = Str::upper($attributes["tag"]);
            $book->update($attributes);

            return back()->with("success", "Book has been updated");
        }
    }

    public function delete($id)
    {
        if (request()->has('deleteForm')) {
            $book = Book::find($id);
            $book->delete();
            return back();
        }
        if (request()->has('delete_book')) {
            $book = Book::find($id);
            $book->delete();
            return redirect('/');
        }
    }

    public function uploadImage($image)
    {
        $image_name = time() . '.' . 'webp';
        $imageResize = Image::make($image)->encode('webp', 90);
        $imageResize->resize(280, 420);
        $destinationPath = public_path('/storage/posters/');
        $imageResize->save($destinationPath . $image_name);
        return '/storage/posters/' . $image_name;
    }
}
