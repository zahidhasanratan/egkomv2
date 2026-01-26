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
            'booking_status' => 'required|in:pending,confirmed,staying,cancelled,completed',
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
     * Show edit form for booking
     */
    public function edit($id)
    {
        $booking = Booking::with('guest')->findOrFail($id);
        
        // Get all hotels for super admin
        $hotels = Hotel::all();
        
        // Get rooms for the first hotel in booking
        $firstRoom = $booking->rooms_data[0] ?? null;
        $rooms = [];
        if ($firstRoom && isset($firstRoom['hotelId'])) {
            $rooms = Room::where('hotel_id', $firstRoom['hotelId'])
                ->where('is_active', true)
                ->get();
        }
        
        return view('auth.super_admin.bookings.edit', compact('booking', 'hotels', 'rooms'));
    }

    /**
     * Update booking
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $validated = $request->validate([
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'admin_note' => 'nullable|string|max:1000',
            'room_id' => 'nullable|exists:rooms,id',
            'quantity' => 'nullable|integer|min:1',
        ]);
        
        DB::beginTransaction();
        try {
            // Check if dates or room changed
            $datesChanged = $booking->checkin_date->format('Y-m-d') != $validated['checkin_date'] 
                || $booking->checkout_date->format('Y-m-d') != $validated['checkout_date'];
            
            $roomChanged = false;
            if ($request->has('room_id') && $request->room_id) {
                $firstRoom = $booking->rooms_data[0] ?? null;
                $roomChanged = !$firstRoom || ($firstRoom['roomId'] ?? null) != $request->room_id;
            }
            
            // If dates or room changed, check availability
            if ($datesChanged || $roomChanged) {
                $checkinDate = new \DateTime($validated['checkin_date']);
                $checkoutDate = new \DateTime($validated['checkout_date']);
                
                // Determine which room to check
                $roomIdToCheck = $request->room_id ?? ($booking->rooms_data[0]['roomId'] ?? null);
                $quantityToCheck = $request->quantity ?? ($booking->rooms_data[0]['quantity'] ?? 1);
                
                if ($roomIdToCheck) {
                    $room = Room::findOrFail($roomIdToCheck);
                    
                    // Check room availability dates
                    if (!$room->isAvailableForDateRange($checkinDate, $checkoutDate)) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'Room is not available for the selected dates.');
                    }
                    
                    // Check for conflicting bookings (excluding current booking)
                    $conflictingBookings = Booking::where('id', '!=', $booking->id)
                        ->where('booking_status', '!=', 'cancelled')
                        ->where(function($query) use ($checkinDate, $checkoutDate) {
                            $query->where(function($q) use ($checkinDate, $checkoutDate) {
                                $q->where('checkin_date', '<=', $checkinDate->format('Y-m-d'))
                                  ->where('checkout_date', '>', $checkinDate->format('Y-m-d'));
                            })->orWhere(function($q) use ($checkinDate, $checkoutDate) {
                                $q->where('checkin_date', '<', $checkoutDate->format('Y-m-d'))
                                  ->where('checkout_date', '>=', $checkoutDate->format('Y-m-d'));
                            })->orWhere(function($q) use ($checkinDate, $checkoutDate) {
                                $q->where('checkin_date', '>=', $checkinDate->format('Y-m-d'))
                                  ->where('checkout_date', '<=', $checkoutDate->format('Y-m-d'));
                            });
                        })
                        ->get()
                        ->filter(function($otherBooking) use ($roomIdToCheck) {
                            $roomsData = is_array($otherBooking->rooms_data) 
                                ? $otherBooking->rooms_data 
                                : json_decode($otherBooking->rooms_data, true);
                            
                            if (!is_array($roomsData)) {
                                return false;
                            }
                            
                            foreach ($roomsData as $roomData) {
                                if (isset($roomData['roomId']) && $roomData['roomId'] == $roomIdToCheck) {
                                    return true;
                                }
                            }
                            return false;
                        });
                    
                    if ($conflictingBookings->count() > 0) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'Room is already booked for some of the selected dates.');
                    }
                }
            }
            
            // Check if quantity changed
            $quantityChanged = false;
            if ($request->has('quantity')) {
                $firstRoom = $booking->rooms_data[0] ?? null;
                $currentQuantity = $firstRoom['quantity'] ?? 1;
                $quantityChanged = $currentQuantity != $validated['quantity'];
            }
            
            // Always calculate new total nights from provided dates (needed for recalculation)
            $checkinDate = new \DateTime($validated['checkin_date']);
            $checkoutDate = new \DateTime($validated['checkout_date']);
            $newTotalNights = $checkinDate->diff($checkoutDate)->days;
            
            // Update dates if changed
            if ($datesChanged) {
                $booking->checkin_date = $validated['checkin_date'];
                $booking->checkout_date = $validated['checkout_date'];
                $booking->total_nights = $newTotalNights;
            }
            
            // Update room if changed
            if ($roomChanged && $request->has('room_id') && $request->room_id) {
                $room = Room::findOrFail($request->room_id);
                $hotel = $room->hotel;
                
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
                
                // Update rooms_data
                $roomsData = [[
                    'roomId' => $room->id,
                    'roomName' => $room->name ?? 'Room',
                    'quantity' => $validated['quantity'] ?? ($booking->rooms_data[0]['quantity'] ?? 1),
                    'price' => $room->price_per_night,
                    'hotelId' => $hotel->id,
                    'hotelName' => $hotel->description ?? $hotel->property_category ?? 'Hotel',
                    'hotelAddress' => $hotel->address ?? 'Address not available',
                    'hotelEmail' => null,
                    'hotelPhone' => null,
                    'hotelPhoto' => $hotelPhoto,
                ]];
                
                $booking->rooms_data = $roomsData;
            }
            
            // Update quantity in rooms_data if changed
            if ($quantityChanged && !$roomChanged) {
                $roomsData = $booking->rooms_data;
                if (!empty($roomsData) && isset($roomsData[0])) {
                    $roomsData[0]['quantity'] = $validated['quantity'] ?? $roomsData[0]['quantity'];
                    $booking->rooms_data = $roomsData;
                }
            }
            
            // ALWAYS recalculate pricing when dates, room, or quantity are provided
            // This ensures the price is always correct based on current values
            // Force recalculation if dates are provided (even if they appear unchanged)
            $shouldRecalculate = $datesChanged || $roomChanged || $quantityChanged || 
                                 ($request->has('checkin_date') && $request->has('checkout_date')) ||
                                 ($booking->total_nights != $newTotalNights);
            
            // Always recalculate to ensure prices are correct
            if ($shouldRecalculate || true) { // Force recalculation every time
                $firstRoom = $booking->rooms_data[0] ?? null;
                if ($firstRoom) {
                    $pricePerNight = floatval($firstRoom['price'] ?? 0);
                    $quantity = intval($firstRoom['quantity'] ?? 1);
                    // Use newTotalNights which was calculated above
                    $totalNights = intval($newTotalNights);
                    
                    // Calculate subtotal: price per night × quantity × total nights
                    $subtotal = $pricePerNight * $quantity * $totalNights;
                    $discount = floatval($booking->discount ?? 0);
                    
                    // No tax calculation - grand total = subtotal - discount
                    $tax = 0;
                    $grandTotal = $subtotal - $discount;
                    
                    // Update booking with new calculated values
                    $booking->subtotal = round($subtotal, 2);
                    $booking->tax = 0;
                    $booking->grand_total = round($grandTotal, 2);
                }
            }
            
            // Update admin note
            if ($request->has('admin_note')) {
                $booking->admin_note = $validated['admin_note'];
            }
            
            $booking->save();
            
            DB::commit();
            
            return redirect()->route('super-admin.bookings.index')
                ->with('success', 'Booking updated successfully');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update booking: ' . $e->getMessage());
        }
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
     * Get room availability dates (AJAX)
     */
    public function getRoomAvailability($roomId, $bookingId = null)
    {
        $room = Room::findOrFail($roomId);
        
        // Get room availability dates
        $availabilityDates = [];
        if (!empty($room->availability_dates)) {
            $availabilityDates = is_array($room->availability_dates) 
                ? $room->availability_dates 
                : json_decode($room->availability_dates, true);
        }
        
        // Get booked dates (excluding current booking if editing)
        $bookedDates = [];
        $bookings = Booking::where('booking_status', '!=', 'cancelled')
            ->where('id', '!=', $bookingId)
            ->get();
        
        foreach ($bookings as $booking) {
            $roomsData = is_array($booking->rooms_data) 
                ? $booking->rooms_data 
                : json_decode($booking->rooms_data, true);
            
            if (!is_array($roomsData)) {
                continue;
            }
            
            foreach ($roomsData as $roomData) {
                if (isset($roomData['roomId']) && $roomData['roomId'] == $roomId) {
                    // Generate all dates in the booking range
                    $checkin = new \DateTime($booking->checkin_date->format('Y-m-d'));
                    $checkout = new \DateTime($booking->checkout_date->format('Y-m-d'));
                    
                    $currentDate = clone $checkin;
                    while ($currentDate < $checkout) {
                        $dateString = $currentDate->format('Y-m-d');
                        if (!in_array($dateString, $bookedDates)) {
                            $bookedDates[] = $dateString;
                        }
                        $currentDate->modify('+1 day');
                    }
                    break;
                }
            }
        }
        
        return response()->json([
            'availability_dates' => $availabilityDates,
            'booked_dates' => $bookedDates,
            'has_availability_dates' => !empty($availabilityDates),
        ]);
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

            // Calculate pricing (no tax)
            $subtotal = $validated['price_per_night'] * $validated['quantity'] * $totalNights;
            $discount = $validated['discount'] ?? 0;
            $tax = 0; // No tax calculation
            $grandTotal = $subtotal - $discount;

            // Handle file uploads
            $nidFront = null;
            $nidBack = null;
            $passport = null;
            $visa = null;

            // Ensure directories exist
            if (!file_exists(public_path('documents/nid'))) {
                mkdir(public_path('documents/nid'), 0755, true);
            }
            if (!file_exists(public_path('documents/passport'))) {
                mkdir(public_path('documents/passport'), 0755, true);
            }
            if (!file_exists(public_path('documents/visa'))) {
                mkdir(public_path('documents/visa'), 0755, true);
            }

            if ($request->hasFile('nid_front')) {
                $file = $request->file('nid_front');
                $filename = 'nid_front_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('documents/nid'), $filename);
                $nidFront = 'documents/nid/' . $filename;
            }
            if ($request->hasFile('nid_back')) {
                $file = $request->file('nid_back');
                $filename = 'nid_back_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('documents/nid'), $filename);
                $nidBack = 'documents/nid/' . $filename;
            }
            if ($request->hasFile('passport')) {
                $file = $request->file('passport');
                $filename = 'passport_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('documents/passport'), $filename);
                $passport = 'documents/passport/' . $filename;
            }
            if ($request->hasFile('visa')) {
                $file = $request->file('visa');
                $filename = 'visa_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('documents/visa'), $filename);
                $visa = 'documents/visa/' . $filename;
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
