<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view("admin.category", [
            "categories" => $categories
        ]);
    }

    public function store(Request $request)
    {
        if (request()->has("addForm")) {

            $category = $request->validate([
                "category" => "required|unique:categories,name"
            ]);
            $slug = str_replace(" ", "-", strtolower($category["category"]));
            Category::create([
                "name" => $request->category,
                "slug" => $slug
            ]);

            return back()->with("success", "New Category has been added");
        }
    }

    public function update($id)
    {
        if (request()->has("editForm")) {
            $newCategory = request()->validate([
                "category_name" => "required|unique:categories,name"
            ]);
            $category = Category::find($id);
            $category->update(["name" => $newCategory['category_name']]);
            return back()->with("success", "The Category has been Updated");
        }
    }
    public function destroy($id)
    {
        if (request()->has("deleteForm")) {
            $category = Category::find($id);
            $category->delete();
            return back()->with("success", "The Category has been deleted");
        }
    }
}
