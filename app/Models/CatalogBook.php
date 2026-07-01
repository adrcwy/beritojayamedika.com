<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'pdf_path',
        'cover_image',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'date',
    ];
}
