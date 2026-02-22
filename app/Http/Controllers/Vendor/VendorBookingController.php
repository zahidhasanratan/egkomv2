<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VendorBookingController extends Controller
{
    /** Allowed booking statuses for filtering */
    private const BOOKING_STATUSES = ['pending', 'confirmed', 'staying', 'completed', 'cancelled'];

    /**
     * Display bookings for vendor's hotels
     */
    public function index()
    {
        $vendorId = Auth::user()->id;

        // Get all hotel IDs for this vendor
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();

        // Get bookings that include any of vendor's hotels
        $bookings = Booking::with('guest')
            ->where(function ($query) use ($hotelIds) {
                foreach ($hotelIds as $hotelId) {
                    $query->orWhereJsonContains('rooms_data', ['hotelId' => $hotelId]);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        return view('auth.vendor.bookings.index', compact('bookings'));
    }

    /**
     * Display vendor bookings filtered by status.
     */
    public function indexByStatus(string $status)
    {
        $status = strtolower($status);
        if (!in_array($status, self::BOOKING_STATUSES, true)) {
            return redirect()->route('vendor.bookings.index')->with('error', 'Invalid status.');
        }

        $vendorId = Auth::user()->id;
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();

        $bookings = Booking::with('guest')
            ->where('booking_status', $status)
            ->where(function ($query) use ($hotelIds) {
                foreach ($hotelIds as $hotelId) {
                    $query->orWhereJsonContains('rooms_data', ['hotelId' => $hotelId]);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        $currentStatus = $status;

        return view('auth.vendor.bookings.index', compact('bookings', 'currentStatus'));
    }

    /**
     * Export vendor's bookings as Excel (CSV)
     */
    public function exportExcel()
    {
        $vendorId = Auth::user()->id;
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();

        $bookings = Booking::with('guest')
            ->where(function ($query) use ($hotelIds) {
                if (empty($hotelIds)) {
                    $query->whereRaw('1 = 0');
                    return;
                }
                foreach ($hotelIds as $hotelId) {
                    $query->orWhereJsonContains('rooms_data', ['hotelId' => $hotelId]);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'vendor-bookings-report-' . date('Y-m-d-His') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($bookings) {
            $stream = fopen('php://output', 'w');
            fprintf($stream, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($stream, [
                'Invoice #', 'Guest Name', 'Email', 'Phone', 'Hotel', 'Check-in', 'Check-out', 'Nights', 'Status', 'Grand Total', 'Payment Status', 'Created',
            ]);
            foreach ($bookings as $b) {
                fputcsv($stream, [
                    $b->invoice_number,
                    $b->guest_name,
                    $b->guest_email,
                    $b->guest_phone ?? '',
                    $b->getHotelName(),
                    $b->checkin_date ? $b->checkin_date->format('Y-m-d') : '',
                    $b->checkout_date ? $b->checkout_date->format('Y-m-d') : '',
                    $b->total_nights ?? '',
                    $b->booking_status ?? '',
                    $b->grand_total ?? '',
                    $b->payment_status ?? '',
                    $b->created_at ? $b->created_at->format('Y-m-d H:i') : '',
                ]);
            }
            fclose($stream);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    /**
     * Export vendor's bookings as PDF
     */
    public function exportPdf()
    {
        $vendorId = Auth::user()->id;
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();

        $bookings = Booking::with('guest')
            ->where(function ($query) use ($hotelIds) {
                if (empty($hotelIds)) {
                    $query->whereRaw('1 = 0');
                    return;
                }
                foreach ($hotelIds as $hotelId) {
                    $query->orWhereJsonContains('rooms_data', ['hotelId' => $hotelId]);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('auth.vendor.reports.bookings_pdf', compact('bookings'))
            ->setPaper('a4', 'landscape')
            ->setOption('defaultFont', 'sans-serif');

        return $pdf->download('vendor-bookings-report-' . date('Y-m-d-His') . '.pdf');
    }

    /**
     * Show booking details
     */
    public function show($id)
    {
        $booking = Booking::with('guest')->findOrFail($id);
        
        // Verify vendor owns at least one hotel in this booking
        $vendorId = Auth::user()->id;
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();
        
        $hasAccess = false;
        foreach ($booking->rooms_data as $room) {
            if (in_array($room['hotelId'] ?? null, $hotelIds)) {
                $hasAccess = true;
                break;
            }
        }
        
        if (!$hasAccess) {
            abort(403, 'Unauthorized access to this booking');
        }
        
        return view('auth.vendor.bookings.show', compact('booking'));
    }

    /**
     * Update booking status
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Verify vendor owns at least one hotel in this booking
        $vendorId = Auth::user()->id;
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();
        
        $hasAccess = false;
        foreach ($booking->rooms_data as $room) {
            if (in_array($room['hotelId'] ?? null, $hotelIds)) {
                $hasAccess = true;
                break;
            }
        }
        
        if (!$hasAccess) {
            abort(403, 'Unauthorized access to this booking');
        }
        
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
        
        // Verify vendor owns at least one hotel in this booking
        $vendorId = Auth::user()->id;
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();
        
        $hasAccess = false;
        foreach ($booking->rooms_data as $room) {
            if (in_array($room['hotelId'] ?? null, $hotelIds)) {
                $hasAccess = true;
                break;
            }
        }
        
        if (!$hasAccess) {
            abort(403, 'Unauthorized access to this booking');
        }
        
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
        
        // Verify vendor owns at least one hotel in this booking
        $vendorId = Auth::user()->id;
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();
        
        $hasAccess = false;
        foreach ($booking->rooms_data as $room) {
            if (in_array($room['hotelId'] ?? null, $hotelIds)) {
                $hasAccess = true;
                break;
            }
        }
        
        if (!$hasAccess) {
            abort(403, 'Unauthorized access to this booking');
        }
        
        // Get vendor's hotels
        $hotels = Hotel::where('vendor_id', $vendorId)->get();
        
        // Get rooms for the first hotel in booking
        $firstRoom = $booking->rooms_data[0] ?? null;
        $rooms = [];
        if ($firstRoom && isset($firstRoom['hotelId'])) {
            // Verify vendor owns this hotel
            if (in_array($firstRoom['hotelId'], $hotelIds)) {
                $rooms = Room::where('hotel_id', $firstRoom['hotelId'])
                    ->where('is_active', true)
                    ->get();
            }
        }
        
        return view('auth.vendor.bookings.edit', compact('booking', 'hotels', 'rooms'));
    }

    /**
     * Update booking
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Verify vendor owns at least one hotel in this booking
        $vendorId = Auth::user()->id;
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();
        
        $hasAccess = false;
        foreach ($booking->rooms_data as $room) {
            if (in_array($room['hotelId'] ?? null, $hotelIds)) {
                $hasAccess = true;
                break;
            }
        }
        
        if (!$hasAccess) {
            abort(403, 'Unauthorized access to this booking');
        }
        
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'admin_note' => 'nullable|string|max:1000',
            'room_id' => 'required|exists:rooms,id',
            'quantity' => 'nullable|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'booking_status' => 'nullable|in:pending,confirmed,staying,completed,cancelled',
            'payment_status' => 'nullable|in:unpaid,partial,paid',
            'paid_amount' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax_percentage' => 'nullable|numeric|min:0|max:100',
            'platform_fee' => 'nullable|numeric|min:0',
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'nullable|string|max:20',
            'guest_email' => 'nullable|email|max:255',
            'home_address' => 'nullable|string',
        ]);
        
        DB::beginTransaction();
        try {
            // Always calculate new total nights from provided dates
            $checkinDate = new \DateTime($validated['checkin_date']);
            $checkoutDate = new \DateTime($validated['checkout_date']);
            $newTotalNights = $checkinDate->diff($checkoutDate)->days;
            
            // Check if dates or room changed
            $checkinChanged = $booking->checkin_date->format('Y-m-d') != $validated['checkin_date'];
            $checkoutChanged = $booking->checkout_date->format('Y-m-d') != $validated['checkout_date'];
            $datesChanged = $checkinChanged || $checkoutChanged;
            
            // If nights changed, we definitely need to recalculate
            if ($booking->total_nights != $newTotalNights) {
                $datesChanged = true;
            }
            
            $roomChanged = false;
            if ($request->has('room_id') && $request->room_id) {
                $firstRoom = $booking->rooms_data[0] ?? null;
                $roomChanged = !$firstRoom || ($firstRoom['roomId'] ?? null) != $request->room_id;
                
                // Verify vendor owns the room's hotel
                if ($roomChanged) {
                    $newRoom = Room::findOrFail($request->room_id);
                    if (!in_array($newRoom->hotel_id, $hotelIds)) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'You can only select rooms from your own hotels.');
                    }
                }
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
                    
                    // Verify vendor owns this room's hotel
                    if (!in_array($room->hotel_id, $hotelIds)) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'You can only edit bookings for your own hotels.');
                    }
                    
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
            
            $room = Room::findOrFail($validated['room_id']);
            if (!in_array($room->hotel_id, $hotelIds)) {
                DB::rollBack();
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'You can only select rooms from your own hotels.');
            }
            $hotel = $room->hotel;
            $hotelPhoto = null;
            if ($hotel->featured_photo) {
                $featuredPhotos = is_string($hotel->featured_photo)
                    ? json_decode($hotel->featured_photo, true)
                    : $hotel->featured_photo;
                if (!empty($featuredPhotos) && is_array($featuredPhotos) && isset($featuredPhotos[0])) {
                    $hotelPhoto = $featuredPhotos[0];
                }
            }
            $pricePerNight = floatval($validated['price_per_night']);
            $roomsData = [[
                'roomId' => $room->id,
                'roomName' => $room->name ?? 'Room',
                'quantity' => intval($validated['quantity'] ?? 1),
                'price' => $pricePerNight,
                'hotelId' => $hotel->id,
                'hotelName' => $hotel->description ?? $hotel->property_category ?? 'Hotel',
                'hotelAddress' => $hotel->address ?? 'Address not available',
                'hotelEmail' => null,
                'hotelPhone' => null,
                'hotelPhoto' => $hotelPhoto,
            ]];
            $booking->rooms_data = $roomsData;

            $firstRoom = $booking->rooms_data[0] ?? null;
            if ($firstRoom) {
                $pricePerNight = floatval($firstRoom['price'] ?? 0);
                $quantity = intval($firstRoom['quantity'] ?? 1);
                $totalNights = intval($newTotalNights);
                $subtotal = $pricePerNight * $quantity * $totalNights;
                $discount = floatval($validated['discount'] ?? $booking->discount ?? 0);
                $taxPct = floatval($validated['tax_percentage'] ?? $booking->tax_percentage ?? 0);
                $platformFee = floatval($validated['platform_fee'] ?? $booking->platform_fee ?? 0);
                $afterDiscount = $subtotal - $discount;
                $tax = $afterDiscount * ($taxPct / 100);
                $grandTotal = $afterDiscount + $tax + $platformFee;

                $booking->subtotal = round($subtotal, 2);
                $booking->discount = $discount;
                $booking->tax_percentage = $taxPct;
                $booking->tax = round($tax, 2);
                $booking->platform_fee = $platformFee;
                $booking->grand_total = round($grandTotal, 2);
            }

            $booking->admin_note = $validated['admin_note'] ?? $booking->admin_note;
            $booking->booking_status = $validated['booking_status'] ?? $booking->booking_status;
            $booking->payment_status = $validated['payment_status'] ?? $booking->payment_status;
            $booking->paid_amount = $validated['paid_amount'] ?? $booking->paid_amount ?? 0;
            $booking->guest_name = $validated['guest_name'];
            $booking->guest_phone = $validated['guest_phone'] ?? null;
            $booking->guest_email = $validated['guest_email'] ?? null;
            $booking->home_address = $validated['home_address'] ?? null;
            
            $booking->save();
            
            DB::commit();
            
            return redirect()->route('vendor.bookings.index')
                ->with('success', 'Booking updated successfully');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update booking: ' . $e->getMessage());
        }
    }

    /**
     * Show manual order creation form
     */
    public function createManualOrder()
    {
        $vendorId = Auth::user()->id;
        $hotels = Hotel::where('vendor_id', $vendorId)->get();
        
        return view('auth.vendor.bookings.create_manual', compact('hotels'));
    }

    /**
     * Get rooms for a specific hotel (AJAX)
     */
    public function getRooms($hotelId)
    {
        $vendorId = Auth::user()->id;
        
        // Verify vendor owns this hotel
        $hotel = Hotel::where('id', $hotelId)
            ->where('vendor_id', $vendorId)
            ->firstOrFail();
        
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
        $vendorId = Auth::user()->id;
        $room = Room::findOrFail($roomId);
        
        // Verify vendor owns this room's hotel
        $hotel = $room->hotel;
        if ($hotel->vendor_id != $vendorId) {
            abort(403, 'Unauthorized access to this room');
        }
        
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
        $vendorId = Auth::user()->id;
        
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
            'platform_fee' => 'nullable|numeric|min:0',
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

        // Verify vendor owns the hotel
        $hotel = Hotel::where('id', $validated['hotel_id'])
            ->where('vendor_id', $vendorId)
            ->firstOrFail();

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

            // Calculate pricing with tax
            $subtotal = $validated['price_per_night'] * $validated['quantity'] * $totalNights;
            $discount = $validated['discount'] ?? 0;
            $taxPercentage = $validated['tax_percentage'] ?? 0;
            $platformFee = $validated['platform_fee'] ?? 0;
            $afterDiscount = $subtotal - $discount;
            $tax = $afterDiscount * ($taxPercentage / 100);
            $grandTotal = $afterDiscount + $tax + $platformFee;

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
                'tax_percentage' => $taxPercentage,
                'platform_fee' => $platformFee,
                'grand_total' => $grandTotal,
                'payment_status' => $request->payment_status ?? 'unpaid',
                'paid_amount' => $request->paid_amount ?? 0,
            ]);

            DB::commit();

            return redirect()->route('vendor.bookings.show', $booking->id)
                ->with('success', 'Manual order created successfully! Invoice: ' . $booking->invoice_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create manual order: ' . $e->getMessage());
        }
    }
}
