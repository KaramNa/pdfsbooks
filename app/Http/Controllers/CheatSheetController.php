<?php

namespace App\Http\Controllers;

use App\Models\CheatSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheatSheetController extends Controller
{
    public function index()
    {
        $subjects = CheatSheet::groupBy(['subject', 'subject_slug'])->get(['subject', 'subject_slug']);
        $tags = CheatSheet::groupBy(["tag", "tag_slug"])->get(['tag', "tag_slug"]);
        $currentSubject = request("subject");
        $cheatsheets = CheatSheet::filter(request(["subject", "cheatsheets_search", "tag", "language"]))->paginate(11);
        // $cheatsheets = CheatSheet::where('subject_slug', request('subject'))->paginate(6);
        return view("cheatsheets.index", [
            'subjects' => $subjects,
            'tags' => $tags,
            'currentSubject' => $currentSubject,
            'cheatsheets' => $cheatsheets,
        ]);
    }

    public function show(Request $request)
    {
        $cheatsheet = cheatsheet::where("slug", $request->cheatsheet_slug)->firstOrFail();
        return view("cheatsheets.show", [
            'cheatsheet' => $cheatsheet
        ]);
    }

}
