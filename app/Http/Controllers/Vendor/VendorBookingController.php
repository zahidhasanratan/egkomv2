<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorBookingController extends Controller
{
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
            ->where(function($query) use ($hotelIds) {
                foreach ($hotelIds as $hotelId) {
                    $query->orWhereJsonContains('rooms_data', ['hotelId' => $hotelId]);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('auth.vendor.bookings.index', compact('bookings'));
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
}
