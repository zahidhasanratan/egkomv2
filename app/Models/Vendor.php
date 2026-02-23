<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Authenticatable // Extend Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'hotel_name',
        'contact_person_name',
        'contact_person_dob',
        'contact_person_designation',
        'phone',
        'email',
        'address_house',
        'address_city',
        'address_district',
        'address_area',
        'address_landmark',
        'profile_picture',
        'logo',
        'hotel_pictures',
        'bank_check_picture',
        'nid',
        'trade_license_bin_tin',
        'bank_details',
        'password',
        'status',
        'vendorId',
        'password_reset_token',
        'password_reset_expires_at',
        'rejection_message',
    ];

    protected $hidden = ['password', 'remember_token'];

    /** Vendor approval: pending | approved | rejected */
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public function isApproved(): bool
    {
        return ($this->status ?? '') === self::STATUS_APPROVED;
    }
    
    public function isRejected(): bool
    {
        return ($this->status ?? '') === self::STATUS_REJECTED;
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function payouts()
    {
        return $this->hasMany(VendorPayout::class);
    }

    public function owner()
    {
        return $this->hasOne(Owner::class);
    }

    public function banking()
    {
        return $this->hasOne(Banking::class);
    }

    /**
     * Get vendor's total income from paid bookings (vendor's room share only).
     */
    public function getTotalIncomeAttribute(): float
    {
        $hotelIds = $this->hotels()->pluck('id')->toArray();
        if (empty($hotelIds)) {
            return 0;
        }

        $bookings = Booking::where('payment_status', 'paid')
            ->where(function ($q) use ($hotelIds) {
                foreach ($hotelIds as $hid) {
                    $q->orWhereJsonContains('rooms_data', ['hotelId' => $hid]);
                }
            })
            ->get();

        $total = 0;
        foreach ($bookings as $booking) {
            $total += self::vendorEarningFromBooking($booking->rooms_data, $booking->total_nights ?? 1, $hotelIds);
        }
        return round($total, 2);
    }

    /**
     * Vendor's earning from one booking (sum of price*qty*nights for their hotels only).
     */
    public static function vendorEarningFromBooking(array $roomsData, int $totalNights, array $vendorHotelIds): float
    {
        $sum = 0;
        foreach ($roomsData as $room) {
            $hotelId = $room['hotelId'] ?? null;
            if ($hotelId === null || !in_array((int) $hotelId, array_map('intval', $vendorHotelIds), true)) {
                continue;
            }
            $price = (float) ($room['price'] ?? 0);
            $qty = (int) ($room['quantity'] ?? 1);
            $sum += $price * $qty * $totalNights;
        }
        return round($sum, 2);
    }

    /**
     * Total commission deducted from this vendor's bookings (platform share).
     */
    public function getTotalCommissionAttribute(): float
    {
        $hotelIds = $this->hotels()->pluck('id')->toArray();
        if (empty($hotelIds)) {
            return 0;
        }

        $bookings = Booking::where('payment_status', 'paid')
            ->where(function ($q) use ($hotelIds) {
                foreach ($hotelIds as $hid) {
                    $q->orWhereJsonContains('rooms_data', ['hotelId' => $hid]);
                }
            })
            ->get();

        $total = 0;
        foreach ($bookings as $booking) {
            $vendorEarning = self::vendorEarningFromBooking(
                $booking->rooms_data ?? [],
                $booking->total_nights ?? 1,
                $hotelIds
            );
            $bookingBase = 0;
            foreach ($booking->rooms_data ?? [] as $room) {
                $bookingBase += ((float) ($room['price'] ?? 0)) * ((int) ($room['quantity'] ?? 1)) * ($booking->total_nights ?? 1);
            }
            if ($bookingBase > 0 && $booking->commission_amount) {
                $ratio = $vendorEarning / $bookingBase;
                $total += (float) $booking->commission_amount * $ratio;
            }
        }
        return round($total, 2);
    }

    /**
     * Get income and commission for a date range (from paid bookings by created_at).
     * Returns ['income' => float, 'commission' => float].
     */
    public function getIncomeAndCommissionForDateRange(?Carbon $from, ?Carbon $to): array
    {
        $hotelIds = $this->hotels()->pluck('id')->toArray();
        if (empty($hotelIds)) {
            return ['income' => 0, 'commission' => 0];
        }

        $query = Booking::where('payment_status', 'paid')
            ->where(function ($q) use ($hotelIds) {
                foreach ($hotelIds as $hid) {
                    $q->orWhereJsonContains('rooms_data', ['hotelId' => $hid]);
                }
            });
        if ($from) {
            $query->where('created_at', '>=', $from);
        }
        if ($to) {
            $query->where('created_at', '<=', $to);
        }
        $bookings = $query->get();

        $income = 0;
        $commission = 0;
        foreach ($bookings as $booking) {
            $income += self::vendorEarningFromBooking($booking->rooms_data ?? [], $booking->total_nights ?? 1, $hotelIds);
            $vendorEarning = self::vendorEarningFromBooking($booking->rooms_data ?? [], $booking->total_nights ?? 1, $hotelIds);
            $bookingBase = 0;
            foreach ($booking->rooms_data ?? [] as $room) {
                $bookingBase += ((float) ($room['price'] ?? 0)) * ((int) ($room['quantity'] ?? 1)) * ($booking->total_nights ?? 1);
            }
            if ($bookingBase > 0 && $booking->commission_amount) {
                $ratio = $vendorEarning / $bookingBase;
                $commission += (float) $booking->commission_amount * $ratio;
            }
        }
        return ['income' => round($income, 2), 'commission' => round($commission, 2)];
    }

    /** Weekly income (last 7 days from today). */
    public function getWeeklyIncomeAttribute(): float
    {
        $result = $this->getIncomeAndCommissionForDateRange(now()->subDays(7), now());
        return $result['income'];
    }

    /** Weekly commission (last 7 days). */
    public function getWeeklyCommissionAttribute(): float
    {
        $result = $this->getIncomeAndCommissionForDateRange(now()->subDays(7), now());
        return $result['commission'];
    }

    /** Monthly income (current calendar month). */
    public function getMonthlyIncomeAttribute(): float
    {
        $result = $this->getIncomeAndCommissionForDateRange(now()->startOfMonth(), now());
        return $result['income'];
    }

    /** Monthly commission (current calendar month). */
    public function getMonthlyCommissionAttribute(): float
    {
        $result = $this->getIncomeAndCommissionForDateRange(now()->startOfMonth(), now());
        return $result['commission'];
    }
}
