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
        // Commission & platform fees
        'commission_percentage',
        'platform_fee_enabled',
        'platform_fee_amount',
        'tax_enabled',
        'tax_percentage',
        'platform_discount_enabled',
        'platform_discount_percentage',
        'platform_discount_apply_to_all_hotels',
        'platform_discount_hotel_ids',
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
        // Commission & fees
        'commission_percentage' => 'decimal:2',
        'platform_fee_enabled' => 'boolean',
        'platform_fee_amount' => 'decimal:2',
        'tax_enabled' => 'boolean',
        'tax_percentage' => 'decimal:2',
        'platform_discount_enabled' => 'boolean',
        'platform_discount_percentage' => 'decimal:2',
        'platform_discount_apply_to_all_hotels' => 'boolean',
        'platform_discount_hotel_ids' => 'array',
        // Hotel-specific
        'cancellation_policy_texts' => 'array',
        'custom_cancellation_policies' => 'array',
        'enabled_cancellation_policies' => 'array',
        // Room-specific
        'room_cancellation_policy_texts' => 'array',
        'room_custom_cancellation_policies' => 'array',
        'room_enabled_cancellation_policies' => 'array',
    ];

    /**
     * Get platform settings for pricing (commission, fee, tax, platform discount).
     */
    public static function getPlatformSettings(): self
    {
        $s = self::first();
        if (!$s) {
            $s = new self();
        }
        return $s;
    }

    /**
     * Check if platform discount applies to the given hotel ID.
     */
    public function platformDiscountAppliesToHotel(?int $hotelId): bool
    {
        if (!$this->platform_discount_enabled || (float) $this->platform_discount_percentage <= 0) {
            return false;
        }
        if ($this->platform_discount_apply_to_all_hotels) {
            return true;
        }
        if ($hotelId === null) {
            return false;
        }
        $ids = $this->platform_discount_hotel_ids ?? [];
        return in_array((int) $hotelId, array_map('intval', $ids), true);
    }
}
