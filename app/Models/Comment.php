<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "email", "comment", "book_id", "avatar"
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
