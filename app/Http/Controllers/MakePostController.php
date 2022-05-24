<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Tzsk\Collage\Facade\Collage;
use App\Models\TelegramNotification;
use App\Notifications\CollectionPublished;

class MakePostController extends Controller
{
    public function index()
    {
        $tags = Book::groupBy("tag")->get('tag');
        return view("admin.make-a-post", [
            "tags" => $tags
        ]);
    }

    public function getCovers(Request $request)
    {
        $covers = Book::where("tag", $request->tag)->get('poster');
        return response()->json($covers);
    }

    public function makeCollage(Request $request)
    {

        $covers = json_decode($request->covers);
        $images = [];
        for ($i = 0; $i < count($covers); $i++) {
            $url = substr($covers[$i], 22, strlen($covers[$i]));

            $images[$i] = file_get_contents('https://pdfsbooks.com/public/' . $url);
        }

        if (count($images) == 1)
            $image = Collage::make(280, 420)->padding(10)->from($images);
        else if (count($images) == 2)
            $image = Collage::make(560, 420)->padding(10)->from($images, function ($alignment) {
                $alignment->vertical();
            });
        else if (count($images) == 3)
            $image = Collage::make(840, 420)->padding(10)->from($images, function ($alignment) {
                $alignment->vertical();
            });
        else if (count($images) == 4)
            $image = Collage::make(560, 840)->padding(10)->from($images);
        else if (count($images) == 6)
            $image = Collage::make(840, 840)->padding(10)->from($images);
        else if (count($images) == 8)
            $image = Collage::make(1120, 840)->padding(10)->from($images);
        else if (count($images) == 9)
            $image = Collage::make(840, 1260)->padding(10)->from($images);
        else if (count($images) == 12)
            $image = Collage::make(840, 1680)->padding(10)->from($images);
        $image_name = time() . '.jpg';
        $image->save(public_path('/storage/collage/') . $image_name);

        return response()->json($image_name);
    }

    public function makeTelegramPost(Request $request)
    {
        $book = Book::firstOrFail();

        $book->notify(new CollectionPublished($request));

        return response()->json(['success' => 'The book has been posted to Telegram']);
    }
}
