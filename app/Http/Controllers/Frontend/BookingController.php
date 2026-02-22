<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ShurjopayPlugin\PaymentRequest;
use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\ShurjopayConfig;

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
        
        $rooms = Room::whereIn('id', $roomIds)
            ->fromActiveHotels()
            ->with('hotel')
            ->get()
            ->map(function($room) {
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
            
            // Get hotel photo (featured_photo first element or photo field)
            $hotelPhoto = null;
            $hotelName = null;
            if ($room->hotel) {
                // Get hotel name
                $hotelName = $room->hotel->description ?? $room->hotel->property_category ?? 'Hotel';
                
                // Get hotel photo
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
            }
            
            return [
                'id' => $room->id,
                'name' => $room->name,
                'number' => $room->number ?? null,
                'floor_number' => $room->floor_number ?? null,
                'couple_friendly' => (bool)($room->couple_friendly ?? false),
                'hotel_id' => $room->hotel_id,
                'encrypted_hotel_id' => \Illuminate\Support\Facades\Crypt::encrypt($room->hotel_id),
                'hotel_photo' => $hotelPhoto,
                'hotel_name' => $hotelName,
                'total_persons' => $room->total_persons,
                'total_beds' => $room->total_beds,
                'available_requests' => $availableRequests,
                'available_bed_types' => $availableBedTypes,
                'available_room_preferences' => $availableRoomPreferences,
                'display_options' => $displayOptions,
                'cancellation_policy' => $room->cancellation_policy ?? []
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

    /**
     * Validate coupon and return discount amount for checkout.
     */
    public function validateCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:64',
            'subtotal' => 'required|numeric|min:0',
            'hotel_id' => 'nullable|integer|exists:hotels,id',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        $code = strtoupper(trim($request->code));
        $subtotal = (float) $request->subtotal;
        $hotelId = $request->hotel_id ? (int) $request->hotel_id : null;
        $checkin = new \DateTime($request->checkin_date);
        $checkout = new \DateTime($request->checkout_date);

        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid coupon code.',
            ]);
        }

        if (!$coupon->isValidFor($subtotal, $hotelId, $checkin, $checkout)) {
            if (!$coupon->is_active) {
                return response()->json(['valid' => false, 'message' => 'This coupon is no longer active.']);
            }
            if ($coupon->usage_limit !== null && $coupon->usage_count >= $coupon->usage_limit) {
                return response()->json(['valid' => false, 'message' => 'This coupon has reached its usage limit.']);
            }
            if ($coupon->min_booking_amount !== null && $subtotal < (float) $coupon->min_booking_amount) {
                return response()->json(['valid' => false, 'message' => 'Minimum booking amount for this coupon is BDT ' . number_format($coupon->min_booking_amount, 0) . '.']);
            }
            if (!$coupon->apply_to_all_hotels && $hotelId !== null) {
                $ids = $coupon->hotel_ids ?? [];
                if (!in_array($hotelId, array_map('intval', $ids), true)) {
                    return response()->json(['valid' => false, 'message' => 'This coupon is not valid for the selected hotel.']);
                }
            }
            $today = now()->startOfDay();
            if ($coupon->valid_from->gt($today) || $coupon->valid_to->lt($today)) {
                return response()->json(['valid' => false, 'message' => 'This coupon is not valid for the selected dates.']);
            }
            return response()->json(['valid' => false, 'message' => 'Coupon cannot be applied.']);
        }

        $discountAmount = $coupon->calculateDiscount($subtotal);
        return response()->json([
            'valid' => true,
            'message' => 'Coupon applied successfully.',
            'discount' => round($discountAmount, 2),
            'grand_total' => round($subtotal - $discountAmount, 2),
            'coupon_code' => $coupon->code,
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
                        'roomNumber' => $cartItem['roomNumber'] ?? $room->number ?? null,
                        'floorNumber' => $cartItem['floorNumber'] ?? $room->floor_number ?? null,
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

            $discount = 0;
            $couponCode = $request->coupon_code ? strtoupper(trim($request->coupon_code)) : null;
            $hotelIdFromCart = isset($roomsData[0]['hotelId']) ? (int) $roomsData[0]['hotelId'] : null;

            if ($couponCode) {
                $coupon = Coupon::where('code', $couponCode)->first();
                if ($coupon && $coupon->isValidFor($subtotal, $hotelIdFromCart, $checkinDate, $checkoutDate)) {
                    $discount = $coupon->calculateDiscount($subtotal);
                }
            }

            $tax = 0;
            $grandTotal = $subtotal - $discount;

            // Handle file uploads - save directly to public folder
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
                'coupon_code' => $couponCode,
                'payment_status' => 'unpaid',
            ]);

            if ($couponCode && $discount > 0) {
                Coupon::where('code', $couponCode)->increment('usage_count');
            }

            DB::commit();

            // Use current request base URL so redirect works from any domain/path (not just APP_URL)
            $redirectUrl = $request->getSchemeAndHttpHost() . $request->getBasePath() . '/booking/pay/' . $booking->id;

            return response()->json([
                'success' => true,
                'message' => 'Redirecting to payment gateway...',
                'booking_id' => $booking->id,
                'invoice_number' => $booking->invoice_number,
                'redirect_url' => $redirectUrl,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create booking: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Redirect to ShurjoPay gateway. User hits this after checkout; we send them to payment page.
     */
    public function pay(Booking $booking)
    {
        if ($booking->payment_status === 'paid') {
            return redirect()->route('booking.invoice', $booking->id);
        }
        // Allow unpaid/partial to proceed to gateway (enum has unpaid, partial, paid only)
        if (!in_array($booking->payment_status, ['unpaid', 'partial'], true)) {
            return redirect()->route('booking.checkout')->with('error', 'Invalid booking state.');
        }

        try {
            // Build callback URL from current request so cancel/return works (same host:port as user)
            $callbackUrl = request()->getSchemeAndHttpHost() . request()->getBasePath() . '/booking/payment/return';
            
            // Get ShurjoPay credentials with fallbacks - try multiple sources
            $username = config('services.shurjopay.username');
            if (empty($username)) {
                $username = env('SP_USERNAME');
            }
            if (empty($username)) {
                $username = env('MERCHANT_USERNAME');
            }
            
            $password = config('services.shurjopay.password');
            if (empty($password)) {
                $password = env('SP_PASSWORD');
            }
            if (empty($password)) {
                $password = env('MERCHANT_PASSWORD');
            }
            
            $apiEndpoint = config('services.shurjopay.api');
            if (empty($apiEndpoint)) {
                $apiEndpoint = env('SHURJOPAY_API', 'https://engine.shurjopayment.com');
            }
            
            // Validate credentials are not empty
            if (empty($username) || empty($password)) {
                Log::error('ShurjoPay credentials missing', [
                    'username_set' => !empty($username),
                    'password_set' => !empty($password),
                    'config_username' => config('services.shurjopay.username'),
                    'config_password' => config('services.shurjopay.password'),
                    'env_sp_username' => env('SP_USERNAME'),
                    'env_sp_password' => env('SP_PASSWORD'),
                    'env_merchant_username' => env('MERCHANT_USERNAME'),
                    'env_merchant_password' => env('MERCHANT_PASSWORD'),
                    'booking_id' => $booking->id,
                ]);
                return redirect()->route('booking.payment.failed')->with('message', 'Payment gateway configuration error. Please contact support with Booking ID: ' . $booking->invoice_number);
            }
            
            // Trim whitespace from credentials
            $username = trim($username);
            $password = trim($password);
            
            $config = new ShurjopayConfig();
            $config->username = $username;
            $config->password = $password;
            $config->api_endpoint = $apiEndpoint;
            $config->callback_url = $callbackUrl;
            $config->log_path = config('services.shurjopay.log_path', env('SP_LOG_LOCATION', storage_path('logs')));
            $config->order_prefix = config('services.shurjopay.prefix', env('SP_PREFIX', env('MERCHANT_PREFIX', 'SIC')));
            $config->ssl_verifypeer = (bool) (env('CURLOPT_SSL_VERIFYPEER', 1));
            $sp = new Shurjopay($config);

            $paymentRequest = new PaymentRequest();
            $paymentRequest->currency = 'BDT';
            // $paymentRequest->amount = (float) $booking->grand_total;
            $paymentRequest->amount = 11;

            $paymentRequest->discountAmount = (float) ($booking->discount ?? 0);
            $paymentRequest->discPercent = 0;
            $paymentRequest->customerName = $booking->guest_name;
            $paymentRequest->customerPhone = $booking->guest_phone ?? '0000000000';
            $paymentRequest->customerEmail = $booking->guest_email ?? 'guest@example.com';
            $paymentRequest->customerAddress = $booking->home_address ?? 'N/A';
            $paymentRequest->customerCity = 'N/A';
            $paymentRequest->customerState = 'N/A';
            $paymentRequest->customerPostcode = 'N/A';
            $paymentRequest->customerCountry = 'Bangladesh';
            $paymentRequest->shippingAddress = $booking->home_address ?? 'N/A';
            $paymentRequest->shippingCity = 'N/A';
            $paymentRequest->shippingCountry = 'Bangladesh';
            $paymentRequest->receivedPersonName = $booking->guest_name;
            $paymentRequest->shippingPhoneNumber = $booking->guest_phone ?? '0000000000';
            $paymentRequest->value1 = (string) $booking->id;
            $paymentRequest->value2 = $booking->invoice_number ?? '';
            $paymentRequest->value3 = '';
            $paymentRequest->value4 = '';

            $sp->makePayment($paymentRequest);
        } catch (\Throwable $e) {
            Log::error('ShurjoPay makePayment error: ' . $e->getMessage(), ['booking_id' => $booking->id]);
            return redirect()->route('booking.payment.failed')->with('message', 'Could not connect to payment gateway. Please try again or contact support.');
        }

        return null;
    }

    /**
     * ShurjoPay redirects here after payment (success or cancel). Verify and redirect to invoice or failed page.
     */
    public function paymentReturn(Request $request)
    {
        $orderId = $request->get('order_id') ?? $request->get('sp_order_id');
        if (!$orderId) {
            Log::warning('ShurjoPay return: missing order_id');
            return redirect()->route('booking.payment.failed')->with('message', 'Invalid return from payment gateway.');
        }

        try {
            $sp = app(Shurjopay::class);
            $response = $sp->verifyPayment($orderId);
        } catch (\Throwable $e) {
            Log::error('ShurjoPay verify error: ' . $e->getMessage());
            return redirect()->route('booking.payment.failed')->with('message', 'Payment verification failed.');
        }

        $raw = is_object($response) ? (array) $response : $response;
        Log::info('ShurjoPay verify response', ['order_id' => $orderId, 'response' => $raw]);

        // API returns { "response": [ { transaction object } ] } - use first element of list
        $payload = $raw['response'] ?? $raw['data'] ?? $raw;
        if (is_array($payload) && isset($payload[0])) {
            $payload = $payload[0];
        }
        if (is_object($payload)) {
            $payload = (array) $payload;
        }
        if (!is_array($payload)) {
            $payload = $raw;
        }

        // Booking ID was sent as value1
        $value1 = $payload['value1'] ?? $payload['value_1'] ?? null;
        $bookingId = is_array($value1) ? ($value1[0] ?? null) : $value1;
        if ($bookingId !== null) {
            $bookingId = (string) $bookingId;
        }

        $amount = $payload['amount'] ?? $payload['recived_amount'] ?? $payload['payable_amount'] ?? $payload['total_amount'] ?? null;

        if (!$bookingId) {
            return redirect()->route('booking.payment.failed')->with('message', 'Payment was cancelled or could not be completed. You can try again from checkout.');
        }

        $booking = Booking::find($bookingId);
        if (!$booking) {
            return redirect()->route('booking.payment.failed')->with('message', 'Booking not found.');
        }

        // Success: sp_code 1000 or sp_message/sp_massage contains Success (API typo: sp_massage)
        $spCode = $payload['sp_code'] ?? $payload['spCode'] ?? null;
        $message = $payload['sp_message'] ?? $payload['sp_massage'] ?? $payload['message'] ?? '';
        $bankStatus = $payload['bank_status'] ?? '';

        $success = ((int) $spCode === 1000)
            || (isset($payload['success']) && $payload['success'])
            || (stripos((string) $message, 'success') !== false)
            || (strtolower((string) $bankStatus) === 'completed');

        if ($success) {
            $booking->update([
                'payment_status' => 'paid',
                'paid_amount' => $amount ?? $booking->grand_total,
            ]);
            return redirect()->route('booking.invoice', $booking->id);
        }

        return redirect()->route('booking.payment.failed')->with('message', $message ?: 'Payment was not successful.');
    }

    /**
     * Show payment failed / cancelled page.
     */
    public function paymentFailed(Request $request)
    {
        $message = $request->session()->get('message', 'Payment was cancelled or failed. You can try again from your bookings.');
        return view('frontend.booking.payment-failed', compact('message'));
    }

    public function invoice($id)
    {
        $booking = Booking::findOrFail($id);
        return view('frontend.booking.invoice', compact('booking'));
    }
}


