<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'guest_id',
        'booking_id',
        'overall_rating',
        'title',
        'comment',
        'staff_rating',
        'facilities_rating',
        'cleanliness_rating',
        'location_rating',
        'comfort_rating',
        'value_for_money_rating',
        'free_wifi_rating',
        'pros',
        'cons',
        'images',
        'is_approved',
        'is_featured',
        'hotel_response',
        'hotel_response_date',
    ];

    protected $casts = [
        'overall_rating' => 'decimal:1',
        'staff_rating' => 'decimal:1',
        'facilities_rating' => 'decimal:1',
        'cleanliness_rating' => 'decimal:1',
        'location_rating' => 'decimal:1',
        'comfort_rating' => 'decimal:1',
        'value_for_money_rating' => 'decimal:1',
        'free_wifi_rating' => 'decimal:1',
        'images' => 'array',
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'hotel_response_date' => 'datetime',
    ];

    // Relationships
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Helper method to get rating sentiment
    public function getRatingSentiment()
    {
        $rating = $this->overall_rating;
        if ($rating >= 9.0) {
            return 'Exceptional';
        } elseif ($rating >= 8.0) {
            return 'Excellent';
        } elseif ($rating >= 7.0) {
            return 'Very Good';
        } elseif ($rating >= 6.0) {
            return 'Good';
        } elseif ($rating >= 5.0) {
            return 'Average';
        } else {
            return 'Poor';
        }
    }
}
