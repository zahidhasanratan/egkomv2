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
    
    public function getRoomsData(Request $request)
    {
        $roomIds = $request->input('room_ids', []);
        
        if (empty($roomIds)) {
            return response()->json(['rooms' => []]);
        }
        
        $rooms = Room::whereIn('id', $roomIds)->get()->map(function($room) {
            // Parse display_options to get available additional requests
            $displayOptions = is_string($room->display_options) 
                ? json_decode($room->display_options, true) 
                : ($room->display_options ?? []);
            
            // Parse additional_info (stored in display_options)
            $additionalInfo = $displayOptions['additional_info'] ?? [];
            if (is_string($additionalInfo)) {
                $additionalInfo = json_decode($additionalInfo, true) ?? [];
            }
            
            // Parse room_info (stored in display_options)
            $roomInfo = [];
            foreach (['bedrooms', 'living', 'dining', 'kitchen', 'bathrooms', 'bed_type', 'number_of_beds', 'max_adults', 'max_children', 'layout', 'view', 'bathroom', 'kitchen_facilities', 'balcony', 'accessibility', 'smoking_policy'] as $key) {
                if (isset($displayOptions[$key])) {
                    $roomInfo[$key] = $displayOptions[$key];
                }
            }
            
            // Determine available additional requests based on room configuration
            $availableRequests = [];
            
            // Airport Transfer - available if airport_pickup is set and not "Not Available"
            if (isset($additionalInfo['airport_pickup']) && 
                $additionalInfo['airport_pickup'] !== '' && 
                $additionalInfo['airport_pickup'] !== null &&
                $additionalInfo['airport_pickup'] !== 'Not Available') {
                $availableRequests[] = 'airportTransfer';
            }
            
            // Extra Bed - available if bed_fee_amount is set
            if (isset($additionalInfo['bed_fee_amount']) && 
                !empty($additionalInfo['bed_fee_amount']) && 
                $additionalInfo['bed_fee_amount'] > 0) {
                $availableRequests[] = 'extraBed';
            }
            
            // Kitchen Facility - available if kitchen facilities are configured
            if (isset($roomInfo['kitchen_facilities']) && 
                is_array($roomInfo['kitchen_facilities']) && 
                !empty($roomInfo['kitchen_facilities']) &&
                !in_array('None', $roomInfo['kitchen_facilities'])) {
                $availableRequests[] = 'kitchenFacility';
            }
            
            // Room On a Higher Floor - always available (no specific config needed)
            $availableRequests[] = 'higherFloor';
            
            // Decorations in Room - always available (no specific config needed)
            $availableRequests[] = 'roomDecorations';
            
            // Get available bed types from display_options or default to both
            $availableBedTypes = [];
            if (isset($displayOptions['bed_types']) && is_array($displayOptions['bed_types'])) {
                $availableBedTypes = $displayOptions['bed_types'];
            } else {
                // Default: show both if not configured
                $availableBedTypes = ['large_bed', 'twin_beds'];
            }
            
            // Get available room preferences from display_options or default to both
            $availableRoomPreferences = [];
            if (isset($displayOptions['room_preferences']) && is_array($displayOptions['room_preferences'])) {
                $availableRoomPreferences = $displayOptions['room_preferences'];
            } else {
                // Default: show both if not configured
                $availableRoomPreferences = ['non_smoking', 'smoking'];
            }
            
            return [
                'id' => $room->id,
                'name' => $room->name,
                'hotel_id' => $room->hotel_id,
                'encrypted_hotel_id' => \Illuminate\Support\Facades\Crypt::encrypt($room->hotel_id),
                'total_persons' => $room->total_persons,
                'total_beds' => $room->total_beds,
                'available_requests' => $availableRequests,
                'available_bed_types' => $availableBedTypes,
                'available_room_preferences' => $availableRoomPreferences,
                'display_options' => $displayOptions
            ];
        });
        
        return response()->json(['rooms' => $rooms]);
    }
    
    public function validateRoomAvailability(Request $request)
    {
        $roomIds = $request->input('room_ids', []);
        $checkinDate = $request->input('checkin_date');
        $checkoutDate = $request->input('checkout_date');
        $adults = (int) $request->input('adults', 0);
        $children = (int) $request->input('children', 0);
        $totalGuests = $adults + $children;
        
        if (empty($roomIds) || !$checkinDate || !$checkoutDate) {
            return response()->json([
                'available' => false,
                'message' => 'Missing required parameters'
            ], 400);
        }
        
        $checkin = new \DateTime($checkinDate);
        $checkout = new \DateTime($checkoutDate);
        
        if ($checkout <= $checkin) {
            return response()->json([
                'available' => false,
                'message' => 'Check-out date must be after check-in date'
            ], 400);
        }
        
        // Get all rooms from cart
        $rooms = Room::whereIn('id', $roomIds)->get();
        
        if ($rooms->isEmpty()) {
            return response()->json([
                'available' => false,
                'message' => 'No rooms found in your cart'
            ], 404);
        }
        
        $errors = [];
        $totalCapacity = 0;
        
        // Check each room's availability and capacity
        foreach ($rooms as $room) {
            // Check availability dates
            $availabilityDates = is_string($room->availability_dates) 
                ? json_decode($room->availability_dates, true) 
                : ($room->availability_dates ?? []);
            
            if (!empty($availabilityDates)) {
                // Generate all dates in the range
                $datesInRange = [];
                $currentDate = clone $checkin;
                while ($currentDate < $checkout) {
                    $datesInRange[] = $currentDate->format('Y-m-d');
                    $currentDate->modify('+1 day');
                }
                
                // Check if all dates are available
                $allDatesAvailable = true;
                foreach ($datesInRange as $date) {
                    if (!in_array($date, $availabilityDates)) {
                        $allDatesAvailable = false;
                        break;
                    }
                }
                
                if (!$allDatesAvailable) {
                    $errors[] = "Room '{$room->name}' is not available for the selected dates.";
                }
            }
            
            // Check for existing bookings that conflict with selected dates
            // Get all bookings that overlap with the selected date range
            $conflictingBookings = Booking::where('booking_status', '!=', 'cancelled')
                ->where(function($query) use ($checkin, $checkout) {
                    $query->where(function($q) use ($checkin, $checkout) {
                        // Check-in date falls within existing booking
                        $q->where('checkin_date', '<=', $checkin)
                          ->where('checkout_date', '>', $checkin);
                    })->orWhere(function($q) use ($checkin, $checkout) {
                        // Check-out date falls within existing booking
                        $q->where('checkin_date', '<', $checkout)
                          ->where('checkout_date', '>=', $checkout);
                    })->orWhere(function($q) use ($checkin, $checkout) {
                        // Selected dates completely encompass existing booking
                        $q->where('checkin_date', '>=', $checkin)
                          ->where('checkout_date', '<=', $checkout);
                    });
                })
                ->get()
                ->filter(function($booking) use ($room) {
                    // Check if this booking includes the room
                    $roomsData = is_string($booking->rooms_data) 
                        ? json_decode($booking->rooms_data, true) 
                        : ($booking->rooms_data ?? []);
                    
                    if (!is_array($roomsData)) {
                        return false;
                    }
                    
                    foreach ($roomsData as $roomData) {
                        if (isset($roomData['roomId']) && $roomData['roomId'] == $room->id) {
                            return true;
                        }
                    }
                    return false;
                });
            
            if ($conflictingBookings->count() > 0) {
                $errors[] = "Room '{$room->name}' is already booked for some of the selected dates.";
            }
            
            // Check if room is active
            if (!$room->is_active) {
                $errors[] = "Room '{$room->name}' is currently not available.";
            }
            
            // Calculate total capacity
            $totalCapacity += $room->total_persons;
        }
        
        // Check if total guests exceed capacity
        if ($totalGuests > $totalCapacity) {
            $errors[] = "Total guests ({$totalGuests}) exceed the maximum capacity ({$totalCapacity}) for your selected rooms.";
        }
        
        if (!empty($errors)) {
            return response()->json([
                'available' => false,
                'message' => implode(' ', $errors),
                'errors' => $errors
            ], 200);
        }
        
        return response()->json([
            'available' => true,
            'message' => 'Rooms are available for the selected dates and guest count'
        ]);
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
                if ($room && $room->hotel) {
                    // Get hotel photo - extract first image from featured_photo JSON array
                    $hotelPhoto = null;
                    if (isset($room->hotel->photo) && $room->hotel->photo) {
                        $hotelPhoto = $room->hotel->photo;
                    } elseif (isset($room->hotel->featured_photo) && $room->hotel->featured_photo) {
                        $featuredPhotos = is_string($room->hotel->featured_photo) 
                            ? json_decode($room->hotel->featured_photo, true) 
                            : $room->hotel->featured_photo;
                        if (!empty($featuredPhotos) && is_array($featuredPhotos) && isset($featuredPhotos[0])) {
                            $hotelPhoto = $featuredPhotos[0];
                        }
                    }
                    
                    $enrichedRoomsData[] = [
                        'roomId' => $room->id,
                        'roomName' => $room->name ?? 'Room',
                        'quantity' => $cartItem['quantity'],
                        'price' => $cartItem['price'],
                        'hotelId' => $room->hotel_id,
                        'hotelName' => $room->hotel->description ?? $room->hotel->property_category ?? 'Hotel',
                        'hotelAddress' => $room->hotel->address ?? 'Address not available',
                        'hotelEmail' => $room->hotel->email ?? null,
                        'hotelPhone' => $room->hotel->phone ?? null,
                        'hotelPhoto' => $hotelPhoto,
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
            $tax = 0; // Tax not applicable
            $grandTotal = $subtotal - $discount; // Grand total without tax

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


