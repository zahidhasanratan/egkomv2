<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularDestination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'feature_photo',
        'feature_video',
        'media_type',
        'hotels_count',
        'search_url',
        'order',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($destination) {
            if (empty($destination->slug)) {
                $baseSlug = \Illuminate\Support\Str::slug($destination->name);
                $slug = $baseSlug;
                $counter = 1;
                
                // Ensure slug is unique
                while (self::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                
                $destination->slug = $slug;
            }
        });

        static::updating(function ($destination) {
            if ($destination->isDirty('name')) {
                $baseSlug = \Illuminate\Support\Str::slug($destination->name);
                $slug = $baseSlug;
                $counter = 1;
                
                // Ensure slug is unique (excluding current record)
                while (self::where('slug', $slug)->where('id', '!=', $destination->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                
                $destination->slug = $slug;
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
