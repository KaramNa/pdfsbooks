<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;


class CheatSheet extends Model
{
    use HasFactory, SearchableTrait;

    protected $searchable = [

        'columns' => [
            'cheat_sheets.title' => 10,
        ],
        'groupBy' => [
            "id",
            "title",
            "slug",
            "subtitle",
            "subject",
            "subject_slug",
            "tag",
            "tag_slug",
            "language",
            "pages",
            "downloads",
            "download_link",
            "created_at",
            "updated_at"
        ]
    ];

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters["cheatsheets_search"])) {
            if (request("cheatsheets_exact_search") == "on") {
                $query->where("title", "LIKE", "%" . $filters["cheatsheets_search"] . "%");
            } else
                $query->search($filters["cheatsheets_search"], null, true);
        }
        $query->when(
            $filters["subject"] ?? false,
            fn ($query, $subject) =>
            $query->where("subject_slug", "like", "%" . $subject . "%")
        );
        $query->when(
            $filters["tag"] ?? false,
            fn ($query, $tag) =>
            $query->where("tag", "like", "%" . $tag . "%")
        );
        $query->when(
            $filters["language"] ?? false,
            fn ($query, $language) =>
            $query->where("language", "like", "%" . $language . "%")
        );
        if (!isset($filters["search"]))
            $query->latest();
    }
}
