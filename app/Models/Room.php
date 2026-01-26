<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'hotel_id','feature_photos', 'name', 'number', 'floor_number', 'price_per_night', 'weekend_price',
        'holiday_price', 'discount_type', 'discount_value', 'discount_amount', 'discount_percentage',
        'total_persons', 'total_rooms', 'total_washrooms', 'total_beds', 'size', 'wifi_details', 
        'description', 'appliances', 'furniture', 'amenities', 'cancellation_policy', 'cancellation_policy_texts', 'custom_cancellation_policies', 'enabled_cancellation_policies', 'display_options', 'is_active', 'status',
        'availability_dates',
        // Additional Bed Policy fields
        'additional_bed_available', 'bed_fee_type', 'bed_fee_amount', 'bed_fee_currency', 'bed_fee_unit', 'bed_note',
        // Children & Extra Guest Policy fields
        'children_guest_policy_available', 'children_guest_policy_type', 'children_guest_fee_amount',
        'children_guest_fee_currency', 'children_guest_fee_unit', 'children_guest_note',
        // Laundry Service fields
        'laundry_service', 'laundry_service_type', 'laundry_fee_amount', 'laundry_fee_currency',
        'laundry_fee_unit', 'laundry_note',
        // Housekeeping Service fields
        'housekeeping_service', 'housekeeping_service_type', 'housekeeping_fee_amount',
        'housekeeping_fee_currency', 'housekeeping_fee_unit', 'housekeeping_note',
        // Parking fields
        'parking_type', 'parking_fee_amount', 'parking_fee_currency', 'parking_note',
        // Pet Policy fields
        'pet_type', 'pet_fee', 'pet_complementary_note', 'pet_paid_note',
        // Meal Options fields
        'meal_complementary_note', 'meal_paid_note',
        // Couple Friendly field
        'couple_friendly',
    ];

    protected $casts = [
        'appliances' => 'array',
        'furniture' => 'array',
        'amenities' => 'array',
        'cancellation_policy' => 'array',
        'cancellation_policy_texts' => 'array',
        'custom_cancellation_policies' => 'array',
        'enabled_cancellation_policies' => 'array',
        'display_options' => 'array',
        'is_active' => 'boolean',
        'availability_dates' => 'array',
        'couple_friendly' => 'boolean',
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
     * Note: Checkout date is excluded as guests check out on that day
     * Example: checkin=2024-12-01, checkout=2024-12-03 means room needed for Dec 1 and Dec 2 only
     */
    public function isAvailableForDateRange($checkinDate, $checkoutDate)
    {
        // Ensure availability_dates is properly cast as array
        $availabilityDates = $this->availability_dates;
        
        // Handle different possible formats: null, empty string, JSON string, or array
        if (is_null($availabilityDates) || $availabilityDates === '' || $availabilityDates === '[]') {
            $availabilityDates = [];
        } elseif (is_string($availabilityDates)) {
            // Try to decode if it's a JSON string
            $decoded = json_decode($availabilityDates, true);
            $availabilityDates = is_array($decoded) ? $decoded : [];
        } elseif (!is_array($availabilityDates)) {
            $availabilityDates = [];
        }

        // If no availability dates set, room is always available (backward compatibility)
        if (empty($availabilityDates)) {
            return true;
        }

        $checkin = is_string($checkinDate) ? $checkinDate : $checkinDate->format('Y-m-d');
        $checkout = is_string($checkoutDate) ? $checkoutDate : $checkoutDate->format('Y-m-d');

        // Generate all dates in the range (excluding checkout date as it's the departure date)
        $start = new \DateTime($checkin);
        $end = new \DateTime($checkout);
        $end->modify('-1 day'); // Exclude checkout date - guests don't need room on checkout day

        // Check if checkout is after checkin (valid date range)
        if ($end < $start) {
            return false;
        }

        // Ensure all dates in availability_dates are strings (Y-m-d format)
        $availabilityDates = array_map(function($date) {
            if ($date instanceof \DateTime) {
                return $date->format('Y-m-d');
            }
            return (string) $date;
        }, $availabilityDates);

        $currentDate = clone $start;
        while ($currentDate <= $end) {
            $dateString = $currentDate->format('Y-m-d');
            if (!in_array($dateString, $availabilityDates, true)) {
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
