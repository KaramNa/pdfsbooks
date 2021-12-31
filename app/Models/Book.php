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
            SearchResults::create([
                "query" => $search,
                "result" => count($query->get()) > 0
            ])
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
}
