<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'vendor_id',
        'property_name',
        'property_category',
        'property_type',
        'room_types',
        'country_name',
        'district_name',
        'city_town_village',
        'postcode',
        'house_number',
        'road_number_name',
        'building_age',
        'building_size',
        'building_stories',
        'landmark_details',
        'google_map_link',
        'company_logo',
        'apartment_count',
        'apartments',
        'total_capacity',
        'car_parking',
        'has_reception',
        'elevators',
        'generators',
        'fire_exits',
        'wheelchair_access',
        'male_housekeeping',
        'female_housekeeping',
        'has_kids_zone',
        'kids_zone_count',
        'view_type',
        'security_guards',
        'has_cafe_restaurant',
        'cafe_restaurant_count',
        'cafe_restaurant_names',
        'has_pool',
        'pool_count',
        'has_bar',
        'bar_count',
        'has_gym',
        'gym_count',
        'has_party_center',
        'party_center_details',
        'has_conference_hall',
        'conference_hall_details',
        'status',
    ];

    protected $casts = [
        'room_types' => 'array',
        'apartments' => 'array',
        'cafe_restaurant_names' => 'array',
        'has_reception' => 'boolean',
        'wheelchair_access' => 'boolean',
        'has_kids_zone' => 'boolean',
        'has_cafe_restaurant' => 'boolean',
        'has_pool' => 'boolean',
        'has_bar' => 'boolean',
        'has_gym' => 'boolean',
        'has_party_center' => 'boolean',
        'has_conference_hall' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
