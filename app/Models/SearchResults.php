<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchResults extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "query", "result", "num_of_searches"
    ];
}
