<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id','property_type','details','address', 'status','lati','longi', 'approve', 'description', 'pets_allowed', 'pets_details',
        'events_allowed', 'events_details', 'smoking_allowed', 'smoking_details',
        'quiet_hours', 'photography_allowed', 'photography_details', 'check_in_window',
        'check_out_time', 'food_laundry', 'check_in_rules', 'custom_check_in_rules',
        'property_info', 'custom_property_info', 'age_restriction', 'age_restriction_details',
        'vlogging_allowed', 'vlogging_details', 'child_policy', 'extra_bed_policy',
        'cooking_policy', 'directions', 'additional_policy', 'check_in_methods',
        'custom_check_in_methods', 'cancellation_policies', 'facilities', 'facility_category',
        'custom_facilities', 'custom_facilities_icon', 'nearby_areas', 'hotel_facilities',
        'custom_nearby_areas', 'nearby_area_category', 'custom_nearby_area_details','featured_photo',
        'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
        'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos',
        'gym_photos', 'security_photos', 'amenities_photos', 'property_types', 'apartments',
    ];

    protected $casts = [
        'check_in_rules' => 'array',
        'custom_check_in_rules' => 'array',
        'property_info' => 'array',
        'custom_property_info' => 'array',
        'check_in_methods' => 'array',
        'custom_check_in_methods' => 'array',
        'cancellation_policies' => 'array',
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
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
