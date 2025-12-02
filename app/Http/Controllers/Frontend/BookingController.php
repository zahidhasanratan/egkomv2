<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function checkout(Request $request)
    {
        return view('frontend.booking.checkout');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'guest_name' => 'required|string|max:255',
                'guest_phone' => 'required|string|max:20',
                'checkin_date' => 'required|date',
                'checkout_date' => 'required|date|after:checkin_date',
                'home_address' => 'required|string',
                'rooms_data' => 'required|string',
                'arrival_time' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->validator->errors()->all()),
                'errors' => $e->validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Parse rooms data
            $roomsData = json_decode($request->rooms_data, true);
            
            // Get room details from database for each room in cart
            $enrichedRoomsData = [];
            foreach ($roomsData as $cartItem) {
                $room = Room::with('hotel')->find($cartItem['roomId']);
                if ($room) {
                    $enrichedRoomsData[] = [
                        'roomId' => $room->id,
                        'roomName' => $room->name,
                        'quantity' => $cartItem['quantity'],
                        'price' => $cartItem['price'],
                        'hotelId' => $room->hotel_id,
                        'hotelName' => $room->hotel->name ?? 'N/A',
                        'hotelAddress' => $room->hotel->address ?? 'N/A',
                    ];
                }
            }

            // Calculate dates
            $checkinDate = new \DateTime($request->checkin_date);
            $checkoutDate = new \DateTime($request->checkout_date);
            $totalNights = $checkinDate->diff($checkoutDate)->days;

            // Calculate pricing
            $subtotal = 0;
            foreach ($roomsData as $item) {
                $subtotal += ($item['price'] * $item['quantity']);
            }
            $subtotal = $subtotal * $totalNights;
            
            $discount = 0; // Can be calculated based on coupon
            $tax = $subtotal * 0.15; // 15% VAT
            $grandTotal = $subtotal - $discount + $tax;

            // Handle file uploads
            $nidFront = null;
            $nidBack = null;
            $passport = null;
            $visa = null;

            if ($request->hasFile('nid_front')) {
                $nidFront = $request->file('nid_front')->store('documents/nid', 'public');
            }
            if ($request->hasFile('nid_back')) {
                $nidBack = $request->file('nid_back')->store('documents/nid', 'public');
            }
            if ($request->hasFile('passport')) {
                $passport = $request->file('passport')->store('documents/passport', 'public');
            }
            if ($request->hasFile('visa')) {
                $visa = $request->file('visa')->store('documents/visa', 'public');
            }

            // Parse other guests
            $otherGuests = [];
            if ($request->has('other_guests') && $request->other_guests) {
                $otherGuestsData = is_string($request->other_guests) ? json_decode($request->other_guests, true) : $request->other_guests;
                $otherGuests = is_array($otherGuestsData) ? array_filter($otherGuestsData) : [];
            }
            
            // Parse additional requests
            $additionalRequests = [];
            if ($request->has('additional_requests') && $request->additional_requests) {
                $additionalRequestsData = is_string($request->additional_requests) ? json_decode($request->additional_requests, true) : $request->additional_requests;
                $additionalRequests = is_array($additionalRequestsData) ? $additionalRequestsData : [];
            }

            // Normalize bed_type (convert "Twin Beds" to "twin_beds", "Large Bed" to "large_bed")
            $bedType = $request->bed_type;
            if ($bedType) {
                $bedType = strtolower(str_replace(' ', '_', $bedType));
            }
            
            // Normalize room_preference
            $roomPreference = $request->room_preference ?? 'non_smoking';
            if ($roomPreference) {
                $roomPreference = strtolower(str_replace('-', '_', $roomPreference));
            }
            
            // Create booking
            $booking = Booking::create([
                'invoice_number' => Booking::generateInvoiceNumber(),
                'booking_status' => 'confirmed',
                'guest_id' => auth('guest')->id() ?? null,
                'guest_name' => $request->guest_name,
                'guest_email' => auth('guest')->check() ? auth('guest')->user()->email : $request->guest_email,
                'guest_phone' => $request->guest_phone,
                'rooms_data' => $enrichedRoomsData,
                'checkin_date' => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'total_nights' => $totalNights,
                'total_male' => $request->total_male ?? 0,
                'total_female' => $request->total_female ?? 0,
                'total_kids' => $request->total_kids ?? 0,
                'total_persons' => $request->total_persons ?? 1,
                'other_guests' => $otherGuests,
                'home_address' => $request->home_address,
                'organization' => $request->organization,
                'organization_address' => $request->organization_address,
                'relationship' => $request->relationship ?? 'onlyMe',
                'additional_requests' => $additionalRequests,
                'bed_type' => $bedType,
                'room_preference' => $roomPreference,
                'room_type' => $request->room_type,
                'room_number' => $request->room_number,
                'arrival_time' => $request->arrival_time,
                'property_note' => $request->property_note,
                'citizenship' => $request->citizenship,
                'nid_front' => $nidFront,
                'nid_back' => $nidBack,
                'passport' => $passport,
                'visa' => $visa,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'grand_total' => $grandTotal,
                'coupon_code' => $request->coupon_code,
                'payment_status' => 'unpaid',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Booking confirmed successfully!',
                'booking_id' => $booking->id,
                'invoice_number' => $booking->invoice_number,
                'redirect_url' => route('booking.invoice', $booking->id),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create booking: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function invoice($id)
    {
        $booking = Booking::findOrFail($id);
        return view('frontend.booking.invoice', compact('booking'));
    }
}


