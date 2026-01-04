<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class FixBookingPrices extends Command
{
    protected $signature = 'booking:fix-prices {booking_id?}';
    protected $description = 'Fix booking prices based on current dates and room prices';

    public function handle()
    {
        $bookingId = $this->argument('booking_id');
        
        if ($bookingId) {
            $bookings = [Booking::find($bookingId)];
        } else {
            $bookings = Booking::all();
        }
        
        foreach ($bookings as $booking) {
            if (!$booking) {
                $this->error("Booking not found");
                continue;
            }
            
            $firstRoom = $booking->rooms_data[0] ?? null;
            if (!$firstRoom) {
                $this->warn("Booking {$booking->id} has no room data");
                continue;
            }
            
            $pricePerNight = floatval($firstRoom['price'] ?? 0);
            $quantity = intval($firstRoom['quantity'] ?? 1);
            $totalNights = intval($booking->total_nights);
            
            // Calculate correct subtotal (no tax)
            $subtotal = $pricePerNight * $quantity * $totalNights;
            $discount = floatval($booking->discount ?? 0);
            
            // No tax calculation - grand total = subtotal - discount
            $tax = 0;
            $grandTotal = $subtotal - $discount;
            
            // Update booking
            $booking->subtotal = round($subtotal, 2);
            $booking->tax = 0;
            $booking->grand_total = round($grandTotal, 2);
            $booking->save();
            
            $this->info("Fixed booking {$booking->id}: Subtotal={$booking->subtotal}, Tax={$booking->tax}, Grand Total={$booking->grand_total}");
        }
        
        return 0;
    }
}

