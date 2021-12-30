<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "book_name",
        "book_url",
        "orderer_name",
        "orderer_email",
        "notes",
        "status"
    ];
}
