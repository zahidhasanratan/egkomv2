<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'booking_status',
        'guest_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'rooms_data',
        'checkin_date',
        'checkout_date',
        'total_nights',
        'total_male',
        'total_female',
        'total_kids',
        'total_persons',
        'other_guests',
        'home_address',
        'organization',
        'organization_address',
        'relationship',
        'additional_requests',
        'bed_type',
        'room_preference',
        'room_type',
        'room_number',
        'arrival_time',
        'property_note',
        'citizenship',
        'nid_front',
        'nid_back',
        'passport',
        'visa',
        'subtotal',
        'discount',
        'tax',
        'grand_total',
        'coupon_code',
        'payment_status',
        'paid_amount',
    ];

    protected $casts = [
        'rooms_data' => 'array',
        'other_guests' => 'array',
        'additional_requests' => 'array',
        'checkin_date' => 'date',
        'checkout_date' => 'date',
    ];

    // Relationships
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    // Helper method to generate invoice number
    public static function generateInvoiceNumber()
    {
        $year = date('Y');
        $lastBooking = self::whereYear('created_at', $year)->latest()->first();
        $number = $lastBooking ? intval(substr($lastBooking->invoice_number, -6)) + 1 : 1;
        return 'INV-' . $year . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }

    // Get hotel IDs from rooms data
    public function getHotelIds()
    {
        $hotelIds = [];
        foreach ($this->rooms_data as $room) {
            if (isset($room['hotelId']) && !in_array($room['hotelId'], $hotelIds)) {
                $hotelIds[] = $room['hotelId'];
            }
        }
        return $hotelIds;
    }
}
