<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view("category");
    }

    public function store(Request $request){
        $category = $request->validate([
            "category" => "required|unique:categories,name"
        ]);
        $slug = str_replace(" ", "-",strtolower($category["category"]));
        Category::create([
            "name" => $request->category,
            "slug" => $slug
        ]);

        return back()->with("success", "New Category has been added");
    }
}
