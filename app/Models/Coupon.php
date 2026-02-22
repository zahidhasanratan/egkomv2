<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'valid_from',
        'valid_to',
        'usage_limit',
        'usage_count',
        'apply_to_all_hotels',
        'hotel_ids',
        'min_booking_amount',
        'is_active',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_to' => 'date',
        'discount_value' => 'decimal:2',
        'min_booking_amount' => 'decimal:2',
        'apply_to_all_hotels' => 'boolean',
        'hotel_ids' => 'array',
        'is_active' => 'boolean',
        'usage_limit' => 'integer',
        'usage_count' => 'integer',
    ];

    /**
     * Check if coupon is valid for given subtotal, hotel ID and dates.
     */
    public function isValidFor(float $subtotal, ?int $hotelId, \DateTimeInterface $checkin, \DateTimeInterface $checkout): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $today = now()->startOfDay();
        if ($this->valid_from->gt($today) || $this->valid_to->lt($today)) {
            return false;
        }

        if ($this->usage_limit !== null && $this->usage_count >= $this->usage_limit) {
            return false;
        }

        if ($this->min_booking_amount !== null && $subtotal < (float) $this->min_booking_amount) {
            return false;
        }

        if (!$this->apply_to_all_hotels && $hotelId !== null) {
            $ids = $this->hotel_ids ?? [];
            if (!in_array((int) $hotelId, array_map('intval', $ids), true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Calculate discount amount for a given subtotal.
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($this->discount_type === 'percentage') {
            return round($subtotal * ((float) $this->discount_value / 100), 2);
        }
        return min((float) $this->discount_value, $subtotal);
    }

    public function hotels()
    {
        if ($this->apply_to_all_hotels || empty($this->hotel_ids)) {
            return null;
        }
        return Hotel::whereIn('id', $this->hotel_ids)->get();
    }
}
