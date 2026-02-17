<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'rating',
        'review_count',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = self::uniqueSlug(\Illuminate\Support\Str::slug($model->title));
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = self::uniqueSlug(\Illuminate\Support\Str::slug($model->title), $model->id);
            }
        });
    }

    protected static function uniqueSlug(string $base, $excludeId = null): string
    {
        $slug = $base;
        $counter = 1;
        $query = self::where('slug', $slug);
        if ($excludeId !== null) {
            $query->where('id', '!=', $excludeId);
        }
        while ($query->exists()) {
            $slug = $base . '-' . $counter;
            $counter++;
            $query = self::where('slug', $slug);
            if ($excludeId !== null) {
                $query->where('id', '!=', $excludeId);
            }
        }
        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
