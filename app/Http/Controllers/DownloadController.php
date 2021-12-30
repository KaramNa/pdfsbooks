<?php

namespace App\Http\Controllers;

use DOMXPath;

use DOMDocument;
use App\Models\Book;
use GuzzleHttp\Client;

class DownloadController extends Controller
{
    public function index($id)
    {
        $url = Book::find($id)->download_link;
        $httpClient = new Client();
        $response = $httpClient->get($url);
        $htmlString = (string) $response->getBody();
        //add this line to suppress any warnings
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($htmlString);
        $xpath = new DOMXPath($doc);
        $download_link = $xpath->evaluate('//a[@class="btn-down"]');
        foreach ($download_link as $link) {
            $d_link = 'https://www.dbooks.org' . $link->attributes['href']->value;
        }
        return redirect($d_link);
    }
}
