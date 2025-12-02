<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Toggle wishlist (add or remove)
     */
    public function toggle(Request $request)
    {
        if (!Auth::guard('guest')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to wishlist',
                'action' => 'login_required'
            ], 401);
        }

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
        ]);

        $guestId = Auth::guard('guest')->id();
        $roomId = $request->room_id;

        $wishlist = Wishlist::where('guest_id', $guestId)
            ->where('room_id', $roomId)
            ->first();

        if ($wishlist) {
            // Remove from wishlist
            $wishlist->delete();
            return response()->json([
                'success' => true,
                'message' => 'Removed from wishlist',
                'is_wishlisted' => false
            ]);
        } else {
            // Add to wishlist
            Wishlist::create([
                'guest_id' => $guestId,
                'room_id' => $roomId,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Added to wishlist',
                'is_wishlisted' => true
            ]);
        }
    }

    /**
     * Check if room is in wishlist
     */
    public function check(Request $request)
    {
        if (!Auth::guard('guest')->check()) {
            return response()->json([
                'is_wishlisted' => false
            ]);
        }

        $guestId = Auth::guard('guest')->id();
        $roomId = $request->room_id;

        $isWishlisted = Wishlist::where('guest_id', $guestId)
            ->where('room_id', $roomId)
            ->exists();

        return response()->json([
            'is_wishlisted' => $isWishlisted
        ]);
    }

    /**
     * Get all wishlist items for authenticated guest
     */
    public function index()
    {
        if (!Auth::guard('guest')->check()) {
            return redirect()->route('guest.login');
        }

        $guestId = Auth::guard('guest')->id();
        $wishlists = Wishlist::where('guest_id', $guestId)
            ->with(['room.hotel'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.guest.wishlist', compact('wishlists'));
    }
}
