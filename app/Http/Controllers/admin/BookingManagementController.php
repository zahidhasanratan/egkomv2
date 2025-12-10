<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookingManagementController extends Controller
{
    /**
     * Display all bookings for super admin
     */
    public function index()
    {
        $bookings = Booking::with('guest')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('auth.super_admin.bookings.index', compact('bookings'));
    }

    /**
     * Show booking details
     */
    public function show($id)
    {
        $booking = Booking::with('guest')->findOrFail($id);
        return view('auth.super_admin.bookings.show', compact('booking'));
    }

    /**
     * Update booking status
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'booking_status' => 'required|in:pending,confirmed,cancelled,completed',
            'cancellation_comment' => 'nullable|string|max:1000',
        ]);
        
        $booking->booking_status = $request->booking_status;
        
        // Only save cancellation comment if status is cancelled
        if ($request->booking_status === 'cancelled') {
            $booking->cancellation_comment = $request->cancellation_comment;
        } else {
            $booking->cancellation_comment = null;
        }
        
        $booking->save();
        
        return redirect()->back()->with('success', 'Booking status updated successfully');
    }

    /**
     * Update currently staying status
     */
    public function updateCurrentlyStaying(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'currently_staying' => 'required|in:yes,no',
        ]);
        
        $booking->currently_staying = $request->currently_staying;
        $booking->save();
        
        return redirect()->back()->with('success', 'Currently staying status updated successfully');
    }

    /**
     * Delete booking
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        
        return redirect()->route('super-admin.bookings.index')->with('success', 'Booking deleted successfully');
    }

    /**
     * Show manual order creation form
     */
    public function createManualOrder()
    {
        // Super admin can see all hotels
        $hotels = Hotel::all();
        
        return view('auth.super_admin.bookings.create_manual', compact('hotels'));
    }

    /**
     * Get rooms for a specific hotel (AJAX)
     */
    public function getRooms($hotelId)
    {
        // Super admin can access any hotel
        $hotel = Hotel::findOrFail($hotelId);
        
        $rooms = Room::where('hotel_id', $hotelId)
            ->where('is_active', true)
            ->get();
        
        return response()->json($rooms);
    }

    /**
     * Store manual order
     */
    public function storeManualOrder(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_id' => 'required|exists:rooms,id',
            'quantity' => 'required|integer|min:1',
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'required|string|max:20',
            'guest_email' => 'nullable|email|max:255',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'home_address' => 'required|string',
            'total_male' => 'nullable|integer|min:0',
            'total_female' => 'nullable|integer|min:0',
            'total_kids' => 'nullable|integer|min:0',
            'total_persons' => 'nullable|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax_percentage' => 'nullable|numeric|min:0|max:100',
            'arrival_time' => 'nullable|string',
            'property_note' => 'nullable|string',
            'organization' => 'nullable|string',
            'organization_address' => 'nullable|string',
            'relationship' => 'nullable|in:family,husband,friends,colleagues,onlyMe',
            'bed_type' => 'nullable|in:large_bed,twin_beds',
            'room_preference' => 'nullable|in:non_smoking,smoking',
            'room_type' => 'nullable|string',
            'room_number' => 'nullable|string',
            'citizenship' => 'nullable|in:bangladesh,international',
        ]);

        // Super admin can access any hotel
        $hotel = Hotel::findOrFail($validated['hotel_id']);

        // Verify room belongs to hotel
        $room = Room::where('id', $validated['room_id'])
            ->where('hotel_id', $validated['hotel_id'])
            ->firstOrFail();

        DB::beginTransaction();
        try {
            // Calculate dates
            $checkinDate = new \DateTime($validated['checkin_date']);
            $checkoutDate = new \DateTime($validated['checkout_date']);
            $totalNights = $checkinDate->diff($checkoutDate)->days;

            // Get hotel photo
            $hotelPhoto = null;
            if ($hotel->featured_photo) {
                $featuredPhotos = is_string($hotel->featured_photo) 
                    ? json_decode($hotel->featured_photo, true) 
                    : $hotel->featured_photo;
                if (!empty($featuredPhotos) && is_array($featuredPhotos) && isset($featuredPhotos[0])) {
                    $hotelPhoto = $featuredPhotos[0];
                }
            }

            // Prepare rooms data
            $roomsData = [[
                'roomId' => $room->id,
                'roomName' => $room->name ?? 'Room',
                'quantity' => $validated['quantity'],
                'price' => $validated['price_per_night'],
                'hotelId' => $hotel->id,
                'hotelName' => $hotel->description ?? $hotel->property_category ?? 'Hotel',
                'hotelAddress' => $hotel->address ?? 'Address not available',
                'hotelEmail' => null,
                'hotelPhone' => null,
                'hotelPhoto' => $hotelPhoto,
            ]];

            // Calculate pricing
            $subtotal = $validated['price_per_night'] * $validated['quantity'] * $totalNights;
            $discount = $validated['discount'] ?? 0;
            $taxPercentage = $validated['tax_percentage'] ?? 15; // Default 15% VAT
            $tax = ($subtotal - $discount) * ($taxPercentage / 100);
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

            // Create booking
            $booking = Booking::create([
                'invoice_number' => Booking::generateInvoiceNumber(),
                'booking_status' => $request->booking_status ?? 'confirmed',
                'is_manual' => true,
                'guest_name' => $validated['guest_name'],
                'guest_email' => $validated['guest_email'] ?? null,
                'guest_phone' => $validated['guest_phone'],
                'rooms_data' => $roomsData,
                'checkin_date' => $validated['checkin_date'],
                'checkout_date' => $validated['checkout_date'],
                'total_nights' => $totalNights,
                'total_male' => $validated['total_male'] ?? 0,
                'total_female' => $validated['total_female'] ?? 0,
                'total_kids' => $validated['total_kids'] ?? 0,
                'total_persons' => $validated['total_persons'] ?? 1,
                'other_guests' => $otherGuests,
                'home_address' => $validated['home_address'],
                'organization' => $validated['organization'] ?? null,
                'organization_address' => $validated['organization_address'] ?? null,
                'relationship' => $validated['relationship'] ?? 'onlyMe',
                'additional_requests' => $additionalRequests,
                'bed_type' => $validated['bed_type'] ?? null,
                'room_preference' => $validated['room_preference'] ?? 'non_smoking',
                'room_type' => $validated['room_type'] ?? null,
                'room_number' => $validated['room_number'] ?? null,
                'arrival_time' => $validated['arrival_time'] ?? null,
                'property_note' => $validated['property_note'] ?? null,
                'citizenship' => $validated['citizenship'] ?? null,
                'nid_front' => $nidFront,
                'nid_back' => $nidBack,
                'passport' => $passport,
                'visa' => $visa,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'grand_total' => $grandTotal,
                'payment_status' => $request->payment_status ?? 'unpaid',
                'paid_amount' => $request->paid_amount ?? 0,
            ]);

            DB::commit();

            return redirect()->route('super-admin.bookings.show', $booking->id)
                ->with('success', 'Manual order created successfully! Invoice: ' . $booking->invoice_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create manual order: ' . $e->getMessage());
        }
    }
}
