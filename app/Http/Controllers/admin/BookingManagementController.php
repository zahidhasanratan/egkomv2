<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

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
        ]);
        
        $booking->booking_status = $request->booking_status;
        $booking->save();
        
        return redirect()->back()->with('success', 'Booking status updated successfully');
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
}
