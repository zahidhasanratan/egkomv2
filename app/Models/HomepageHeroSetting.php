<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageHeroSetting extends Model
{
    protected $table = 'homepage_hero_settings';

    protected $fillable = [
        'video_path',
        'title',
        'subtitle',
    ];

    protected $attributes = [
        'title' => 'Welcome to Eg Kom!',
        'subtitle' => 'Find Hotels, Visa & Holidays',
    ];

    /**
     * Get the single homepage hero settings row (id = 1).
     */
    public static function get(): self
    {
        $row = static::first();
        if (!$row) {
            $row = static::create([
                'video_path' => 'frontend/images/slider/hero-bg-cover.mp4',
                'title' => 'Welcome to Eg Kom!',
                'subtitle' => 'Find Hotels, Visa & Holidays',
            ]);
        }
        return $row;
    }
}
