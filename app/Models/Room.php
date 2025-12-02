<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'hotel_id','feature_photos', 'name', 'number', 'floor_number', 'price_per_night', 'weekend_price',
        'holiday_price', 'discount_type', 'discount_value', 'discount_amount', 'discount_percentage',
        'total_persons', 'total_rooms', 'total_washrooms', 'total_beds', 'size', 'wifi_details', 
        'description', 'appliances', 'furniture', 'amenities', 'cancellation_policy', 'is_active', 'status',
    ];

    protected $casts = [
        'appliances' => 'array',
        'furniture' => 'array',
        'amenities' => 'array',
        'is_active' => 'boolean',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function photos()
    {
        return $this->hasMany(RoomPhoto::class);
    }
}
