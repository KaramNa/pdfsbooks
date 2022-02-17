<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DCMA extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'infringing_url',
        'description',
        'message',
        'status'
    ];
}
