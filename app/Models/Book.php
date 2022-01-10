<?php

namespace App\Models;

use App\Models\SearchResults;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SearchableTrait;

    protected $searchable = [

        'columns' => [

            'books.title' => 10,
            'books.author' => 5,
        ],
        'groupBy' => [
            "id",
            "title",
            "slug",
            "qoute",
            "author",
            "poster",
            "description",
            "category",
            "category_slug",
            "publisher",
            "published",
            "pages",
            "PDF_size",
            "language",
            "download_link2",
            "download_link3",
            "draft",
            "edition",
            "isbn13",
            "isbn10",
            "isbn13_digital",
            "isbn10_digital",
            "license",
            "download_link",
            "created_at",
            "updated_at"
        ]

    ];

    protected $fillable = [
        "title",
        "slug",
        "qoute",
        "author",
        "poster",
        "description",
        "category",
        "category_slug",
        "publisher",
        "published",
        "pages",
        "PDF_size",
        "language",
        "download_link2",
        "download_link3",
        "draft"
    ];

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters["search"])) {
            if (request("exact_search") == "on")
                $query->search($filters['search'], null, true, true);
            else
                $query->search($filters['search'], null, true);
        } else {
            $query->where("draft", 0);
        }

        if (isset($filters["search1"])) {
            if (request("exact_search") == "on")
                $query->search($filters['search1'], null, true, true);
            else
                $query->search($filters['search1'], null, true);
            $this->SearchResults($query, $filters["search1"]);
        }

        $query->when(
            $filters["category"] ?? false,
            fn ($query, $category) =>
            $query->where("category_slug", "like", "%" . $category . "%")
        );

        if (!isset($filters["search"]) && !isset($filters["category"]))
            $query->latest();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function SearchResults($query, $searchWord)
    {
        $search = SearchResults::where("query", $searchWord)->first();
        if ($search) {
            $num = $search->num_of_searches + 1;
            $search->update([
                "num_of_searches" => $num,
                "result" => count($query->get()) > 0,
            ]);
        } else {
            SearchResults::create([
                "query" => $searchWord,
                "result" => count($query->get()) > 0,
                "num_of_searches" => 1
            ]);
        }
    }
}
