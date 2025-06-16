<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'mission_title',
        'mission',
        'vision_title',
        'vision',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
