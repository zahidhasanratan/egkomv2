<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CoHost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CoHostAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.co-host.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('cohost')->attempt($credentials, $request->has('remember'))) {
            $coHost = Auth::guard('cohost')->user();
            
            if (!$coHost->is_active) {
                Auth::guard('cohost')->logout();
                return back()->withErrors(['email' => 'Your account is inactive. Please contact the vendor.'])->withInput();
            }

            return redirect()->intended(route('co-host.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function logout()
    {
        Auth::guard('cohost')->logout();
        return redirect()->route('co-host.login');
    }

    public function dashboard()
    {
        $coHost = Auth::guard('cohost')->user();
        $hotel = $coHost->hotel;
        
        return view('frontend.co-host.dashboard', compact('coHost', 'hotel'));
    }

    public function bookings(Request $request)
    {
        $coHost = Auth::guard('cohost')->user();
        $hotel = $coHost->hotel;
        
        // Get all bookings for this hotel
        $query = \App\Models\Booking::whereRaw("JSON_SEARCH(rooms_data, 'one', ?) IS NOT NULL", [$hotel->id])
            ->orderBy('created_at', 'desc');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('guest_name', 'like', "%{$search}%")
                  ->orWhere('guest_email', 'like', "%{$search}%")
                  ->orWhere('guest_phone', 'like', "%{$search}%");
            });
        }
        
        $bookings = $query->paginate(15);
        
        return view('frontend.co-host.bookings', compact('coHost', 'hotel', 'bookings'));
    }

    public function bookingShow($id)
    {
        $coHost = Auth::guard('cohost')->user();
        $hotel = $coHost->hotel;
        
        $booking = \App\Models\Booking::where('id', $id)->firstOrFail();
        
        // Verify this booking belongs to co-host's hotel
        $bookingHotelIds = $booking->getHotelIds();
        if (!in_array($hotel->id, $bookingHotelIds)) {
            abort(403, 'You do not have permission to view this booking.');
        }
        
        return view('frontend.co-host.booking-details', compact('coHost', 'hotel', 'booking'));
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $coHost = Auth::guard('cohost')->user();
        $hotel = $coHost->hotel;
        
        $booking = \App\Models\Booking::where('id', $id)->firstOrFail();
        
        // Verify this booking belongs to co-host's hotel
        $bookingHotelIds = $booking->getHotelIds();
        if (!in_array($hotel->id, $bookingHotelIds)) {
            abort(403, 'You do not have permission to update this booking.');
        }
        
        $request->validate([
            'booking_status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);
        
        $booking->booking_status = $request->booking_status;
        $booking->save();
        
        return back()->with('success', 'Booking status updated successfully!');
    }
}
