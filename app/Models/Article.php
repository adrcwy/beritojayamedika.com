<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'published_at',
        'content_images',
    ];

    protected $casts = [
        'published_at' => 'date',
        'content_images' => 'array',
    ];
}
