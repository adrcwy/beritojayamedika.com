<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_company',
        'client_photo',
        'feedback',
        'rating',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
}
