<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularDestination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'feature_photo',
        'feature_video',
        'media_type',
        'hotels_count',
        'search_url',
        'order',
        'is_active',
    ];
}
