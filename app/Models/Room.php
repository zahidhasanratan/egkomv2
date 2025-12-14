<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'hotel_id','feature_photos', 'name', 'number', 'floor_number', 'price_per_night', 'weekend_price',
        'holiday_price', 'discount_type', 'discount_value', 'discount_amount', 'discount_percentage',
        'total_persons', 'total_rooms', 'total_washrooms', 'total_beds', 'size', 'wifi_details', 
        'description', 'appliances', 'furniture', 'amenities', 'cancellation_policy', 'display_options', 'is_active', 'status',
        'availability_dates',
    ];

    protected $casts = [
        'appliances' => 'array',
        'furniture' => 'array',
        'amenities' => 'array',
        'cancellation_policy' => 'array',
        'display_options' => 'array',
        'is_active' => 'boolean',
        'availability_dates' => 'array',
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

    /**
     * Check if room is available on a specific date
     */
    public function isAvailableOnDate($date)
    {
        // If no availability dates set, room is always available (backward compatibility)
        if (empty($this->availability_dates)) {
            return true;
        }

        $dateString = is_string($date) ? $date : $date->format('Y-m-d');
        return in_array($dateString, $this->availability_dates);
    }

    /**
     * Check if room is available for a date range (all dates in range must be available)
     */
    public function isAvailableForDateRange($checkinDate, $checkoutDate)
    {
        // If no availability dates set, room is always available (backward compatibility)
        if (empty($this->availability_dates)) {
            return true;
        }

        $checkin = is_string($checkinDate) ? $checkinDate : $checkinDate->format('Y-m-d');
        $checkout = is_string($checkoutDate) ? $checkoutDate : $checkoutDate->format('Y-m-d');

        // Generate all dates in the range (excluding checkout date as it's the departure date)
        $start = new \DateTime($checkin);
        $end = new \DateTime($checkout);
        $end->modify('-1 day'); // Exclude checkout date

        $currentDate = clone $start;
        while ($currentDate <= $end) {
            if (!in_array($currentDate->format('Y-m-d'), $this->availability_dates)) {
                return false;
            }
            $currentDate->modify('+1 day');
        }

        return true;
    }

    /**
     * Scope to filter rooms available on a specific date
     */
    public function scopeAvailableOnDate($query, $date)
    {
        return $query->where(function($q) use ($date) {
            $dateString = is_string($date) ? $date : $date->format('Y-m-d');
            $q->whereNull('availability_dates')
              ->orWhereJsonContains('availability_dates', $dateString);
        });
    }

    /**
     * Scope to filter rooms available for a date range
     * Note: This checks if room has availability_dates set. For exact matching of all dates,
     * use the isAvailableForDateRange method after fetching rooms.
     */
    public function scopeAvailableForDateRange($query, $checkinDate, $checkoutDate)
    {
        $checkin = is_string($checkinDate) ? $checkinDate : $checkinDate->format('Y-m-d');
        $checkout = is_string($checkoutDate) ? $checkoutDate : $checkoutDate->format('Y-m-d');

        return $query->where(function($q) use ($checkin, $checkout) {
            // Rooms with no availability_dates are always available (backward compatibility)
            $q->whereNull('availability_dates')
              ->orWhere('availability_dates', '!=', '[]')
              ->orWhere(function($subQ) use ($checkin, $checkout) {
                  // Check if checkin date is in availability_dates
                  $subQ->whereJsonContains('availability_dates', $checkin)
                       ->whereJsonContains('availability_dates', $checkout);
              });
        });
    }
}
