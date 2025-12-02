<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HotelWishlist;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelWishlistController extends Controller
{
    /**
     * Toggle hotel wishlist (add or remove)
     */
    public function toggle(Request $request)
    {
        if (!Auth::guard('guest')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add hotels to wishlist',
                'action' => 'login_required'
            ], 401);
        }

        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $guestId = Auth::guard('guest')->id();
        $hotelId = $request->hotel_id;

        $wishlist = HotelWishlist::where('guest_id', $guestId)
            ->where('hotel_id', $hotelId)
            ->first();

        if ($wishlist) {
            // Remove from wishlist
            $wishlist->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hotel removed from wishlist',
                'is_wishlisted' => false
            ]);
        } else {
            // Add to wishlist
            HotelWishlist::create([
                'guest_id' => $guestId,
                'hotel_id' => $hotelId,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Hotel added to wishlist',
                'is_wishlisted' => true
            ]);
        }
    }

    /**
     * Check if hotel is in wishlist
     */
    public function check(Request $request)
    {
        if (!Auth::guard('guest')->check()) {
            return response()->json([
                'is_wishlisted' => false
            ]);
        }

        $guestId = Auth::guard('guest')->id();
        $hotelId = $request->hotel_id;

        $isWishlisted = HotelWishlist::where('guest_id', $guestId)
            ->where('hotel_id', $hotelId)
            ->exists();

        return response()->json([
            'is_wishlisted' => $isWishlisted
        ]);
    }

    /**
     * Get all hotel wishlist items for authenticated guest
     */
    public function index()
    {
        if (!Auth::guard('guest')->check()) {
            return redirect()->route('guest.login');
        }

        $guestId = Auth::guard('guest')->id();
        $wishlists = HotelWishlist::where('guest_id', $guestId)
            ->with('hotel')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.guest.hotel-wishlist', compact('wishlists'));
    }
}
