<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id','popular_destination_id','property_category','property_type','room_types','details','address', 'district', 'city', 'status','lati','longi', 'approve', 'is_suspended', 'description', 'pets_allowed', 'pets_details',
        'events_allowed', 'events_details', 'smoking_allowed', 'smoking_details',
        'quiet_hours', 'photography_allowed', 'photography_details', 'check_in_window',
        'check_out_time', 'food_laundry', 'check_in_rules', 'custom_check_in_rules',
        'property_info', 'custom_property_info', 'age_restriction', 'age_restriction_details',
        'vlogging_allowed', 'vlogging_details', 'child_policy', 'extra_bed_policy',
        'cooking_policy', 'directions', 'additional_policy', 'check_in_methods',
        'custom_check_in_methods', 'cancellation_policies', 'facilities', 'facility_category',
        'cancellation_policy_texts', 'custom_cancellation_policies', 'enabled_cancellation_policies',
        'custom_facilities', 'custom_facilities_icon', 'nearby_areas', 'hotel_facilities',
        'custom_nearby_areas', 'nearby_area_category', 'custom_nearby_area_details','featured_photo',
        'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
        'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos',
        'gym_photos', 'security_photos', 'amenities_photos', 'additional_photos', 'property_types', 'apartments', 'apartment_count',
    ];

    protected $casts = [
        'check_in_rules' => 'array',
        'custom_check_in_rules' => 'array',
        'property_info' => 'array',
        'custom_property_info' => 'array',
        'check_in_methods' => 'array',
        'custom_check_in_methods' => 'array',
        'cancellation_policies' => 'array',
        'cancellation_policy_texts' => 'array',
        'custom_cancellation_policies' => 'array',
        'enabled_cancellation_policies' => 'array',
        'facilities' => 'array',
        'custom_facilities' => 'array',
        'custom_facilities_icon' => 'array',
        'nearby_areas' => 'array',
        'hotel_facilities' => 'array',
        'custom_nearby_areas' => 'array',
        'custom_nearby_area_details' => 'array',
        'property_types' => 'array',
        'apartments' => 'array',

        // ✅ Photo fields casted as arrays
        'kitchen_photos' => 'array',
        'washroom_photos' => 'array',
        'parking_lot_photos' => 'array',
        'entrance_gate_photos' => 'array',
        'lift_stairs_photos' => 'array',
        'spa_photos' => 'array',
        'bar_photos' => 'array',
        'transport_photos' => 'array',
        'rooftop_photos' => 'array',
        'gym_photos' => 'array',
        'security_photos' => 'array',
        'amenities_photos' => 'array',
        'additional_photos' => 'array',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function wishlists()
    {
        return $this->hasMany(HotelWishlist::class);
    }

    public function coHosts()
    {
        return $this->hasMany(CoHost::class)->where('is_active', true);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function popularDestination()
    {
        return $this->belongsTo(PopularDestination::class, 'popular_destination_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true)->orderBy('created_at', 'desc');
    }

    public function allReviews()
    {
        return $this->hasMany(Review::class)->orderBy('created_at', 'desc');
    }
    
    /**
     * Check if hotel is suspended/disabled
     */
    public function isSuspended(): bool
    {
        return (bool) ($this->is_suspended ?? false);
    }
    
    /**
     * Check if hotel is active (approved and not suspended)
     */
    public function isActive(): bool
    {
        return $this->approve == 1 && !$this->isSuspended();
    }

    /**
     * Default cancellation policy labels/descriptions (hotel-level keys).
     */
    private static function defaultCancellationPolicyTexts(): array
    {
        return [
            'Flexible' => 'Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)',
            'Non-refundable' => 'Non-refundable (Regardless of the cancellation window, customers will not get any refund under this.)',
            'Partially refundable' => 'Partially refundable (Cancellations less than 24 hours… after deducting a 30% cancellation fee.)',
            'Long-term/Monthly staying policy' => 'Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed.)',
        ];
    }

    /**
     * Get formatted cancellation policy text for display (e.g. in guest booking modal).
     * Uses hotel's enabled_cancellation_policies, cancellation_policy_texts, and custom_cancellation_policies.
     */
    public function getFormattedCancellationPolicy(): string
    {
        $defaults = self::defaultCancellationPolicyTexts();
        $texts = is_array($this->cancellation_policy_texts ?? null)
            ? array_merge($defaults, $this->cancellation_policy_texts)
            : $defaults;
        $enabled = $this->enabled_cancellation_policies ?? [];
        if (!is_array($enabled)) {
            $enabled = [];
        }
        $custom = $this->custom_cancellation_policies ?? [];
        if (!is_array($custom)) {
            $custom = [];
        }

        $lines = [];
        foreach ($enabled as $key) {
            if (isset($texts[$key]) && trim((string) $texts[$key]) !== '') {
                $lines[] = trim($texts[$key]);
            }
        }
        foreach ($custom as $item) {
            $t = is_string($item) ? $item : ($item['text'] ?? $item['description'] ?? '');
            if (trim($t) !== '') {
                $lines[] = trim($t);
            }
        }
        if (empty($lines)) {
            return 'No specific cancellation policy has been set for this property. Please contact the property for details.';
        }
        return implode("\n\n", $lines);
    }
}
