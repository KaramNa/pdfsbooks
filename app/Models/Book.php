<?php

namespace App\Models;

use App\Models\SearchResults;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;


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
        "draft"
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters["search"] ?? false, fn ($query, $search) =>
        [
        $query->where(
            fn ($query) =>
            $query->where("title", "like", "%" . $search . "%")
                ->orWhere("description", "like", "%" . $search . "%")
        ),
            $this->SearchResults($query, $search)
    ]);

        $query->when(
            $filters["category"] ?? false,
            fn ($query, $category) =>
            $query->where("category_slug", "like", "%" . $category . "%")
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function SearchResults($query, $searchWord){
        $search = SearchResults::where("query", $searchWord)->first();
        if($search){
            $num = $search->num_of_searches + 1;
            $search->update([
                "num_of_searches" => $num,
            ]);
        }else{
            SearchResults::create([
                "query" => $searchWord,
                "result" => count($query->get()) > 0,
                "num_of_searches" => 1
            ]);
        }
    }
}
