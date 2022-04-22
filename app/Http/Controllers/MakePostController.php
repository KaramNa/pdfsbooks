<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Tzsk\Collage\Facade\Collage;
use App\Models\TelegramNotification;
use App\Notifications\CollectionPublished;
use NotificationChannels\Telegram\TelegramFile;

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
            $url = substr($covers[$i], 22, strlen("https://pdfsbooks.com/public" . $covers[$i]));

            $images[$i] = file_get_contents($url);
        }

        if (count($images) == 1)
            $image = Collage::make(270, 420)->padding(10)->from($images);
        else if (count($images) == 2)
            $image = Collage::make(540, 420)->padding(10)->from($images, function ($alignment) {
                $alignment->vertical();
            });
        else if (count($images) == 3)
            $image = Collage::make(810, 420)->padding(10)->from($images, function ($alignment) {
                $alignment->vertical();
            });
        else if (count($images) == 4)
            $image = Collage::make(540, 840)->padding(10)->from($images);
        else if (count($images) == 6)
            $image = Collage::make(810, 840)->padding(10)->from($images);
        else if (count($images) == 8)
            $image = Collage::make(1080, 706)->padding(10)->from($images);
        else if (count($images) == 9)
            $image = Collage::make(810, 1260)->padding(10)->from($images);
            $image_name = time() . '.jpg';
        $image->save('storage/collage/' . $image_name);

        return response()->json($image_name);
    }

    public function makeTelegramPost(Request $request)
    {
        $book = TelegramNotification::firstOrFail();

        $book->notify(new CollectionPublished($request));


        return response()->json(['success' => 'The book has been posted to Telegram']);

    }
}
