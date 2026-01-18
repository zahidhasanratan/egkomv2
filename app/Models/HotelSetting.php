<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelSetting extends Model
{
    use HasFactory;

    // Define the table name (if it's different from the default)
    protected $table = 'hotel_settings';

    // Define the fillable attributes
    protected $fillable = [
        'hotel_name',
        'hotel_logo',
        'hotel_address',
        'email',
        'phone',
        'copyright',
        // Hotel-specific cancellation policies
        'cancellation_policy_texts',
        'custom_cancellation_policies',
        'enabled_cancellation_policies',
        // Room-specific cancellation policies
        'room_cancellation_policy_texts',
        'room_custom_cancellation_policies',
        'room_enabled_cancellation_policies',
    ];

    protected $casts = [
        // Hotel-specific
        'cancellation_policy_texts' => 'array',
        'custom_cancellation_policies' => 'array',
        'enabled_cancellation_policies' => 'array',
        // Room-specific
        'room_cancellation_policy_texts' => 'array',
        'room_custom_cancellation_policies' => 'array',
        'room_enabled_cancellation_policies' => 'array',
    ];
}
