<?php

namespace App\Models;

use Illuminate\Support\Str;
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
        $subsctract = "";
        if (isset($filters["search"])) {
            if (str_contains($filters["search"], "-")) {
                $subsctract = substr($filters["search"], strpos($filters["search"], "-") + 2);
                if ($subsctract != "")
                    $query->where("title", "NOT LIKE", "%" . $subsctract . "%");
            }
            $search = substr($filters["search"], strpos($filters["search"], "-"));
            if (request("exact_search") == "on") {
                $query->search($search, null, true, true);
            } else
                $query->search($search, null, true);
        } else {
            $query->where("draft", 0);
        }

        if (isset($filters["search1"])) {
            if (str_contains($filters["search1"], "-")) {
                $subsctract = substr($filters["search1"], strpos($filters["search1"], "-") + 2);
                if ($subsctract != "")
                    $query->where("title", "NOT LIKE", "%" . $subsctract . "%");
            }
            $search = substr($filters["search1"], 0, strpos($filters["search1"], "-") - 1);
            if (request("exact_search") == "on")
                $query->search($search, null, true, true);
            else
                $query->search($search, null, true);
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

    public function setTitleAttribute($value)
    {
        $this->attributes["title"] = $value;
        $this->attributes["slug"] = Str::slug($value);
    }

    public function setcategoryAttribute($value)
    {
        $this->attributes["category"] = $value;
        $this->attributes["category_slug"] = Str::slug($value);
    }
}
