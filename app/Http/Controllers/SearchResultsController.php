<?php

namespace App\Http\Controllers;

use App\Models\SearchResults;

class SearchResultsController extends Controller
{
    public function index()
    {
        $queries = SearchResults::orderBy("num_of_searches", "desc")->get();        
        return view("admin.search-queries", [
            "queries" => $queries
        ]);
    }

    public function delete($id){
        SearchResults::find($id)->delete();
        return back()->with("success", "The query has been deleted");

    }
}
