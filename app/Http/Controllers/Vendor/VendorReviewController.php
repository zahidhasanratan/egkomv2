<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorReviewController extends Controller
{
    /**
     * Display reviews for vendor's hotels only
     */
    public function index(Request $request)
    {
        $vendorId = Auth::guard('vendor')->id();
        
        // Get vendor's hotel IDs
        $vendorHotelIds = Hotel::where('vendor_id', $vendorId)
            ->where('approve', 1)
            ->pluck('id')
            ->toArray();
        
        if (empty($vendorHotelIds)) {
            $reviews = collect([])->paginate(20);
            $hotels = collect([]);
            return view('auth.vendor.reviews.index', compact('reviews', 'hotels'));
        }
        
        $query = Review::with(['hotel', 'guest', 'booking'])
            ->whereIn('hotel_id', $vendorHotelIds);
        
        // Filter by approval status
        if ($request->has('status')) {
            if ($request->status === 'pending') {
                $query->where('is_approved', false);
            } elseif ($request->status === 'approved') {
                $query->where('is_approved', true);
            }
        }
        
        // Filter by hotel (only vendor's hotels)
        if ($request->has('hotel_id') && $request->hotel_id) {
            if (in_array($request->hotel_id, $vendorHotelIds)) {
                $query->where('hotel_id', $request->hotel_id);
            }
        }
        
        // Search by guest name or review title
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%")
                  ->orWhereHas('guest', function($guestQuery) use ($search) {
                      $guestQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $reviews = $query->orderBy('created_at', 'desc')->paginate(20);
        $hotels = Hotel::where('vendor_id', $vendorId)
            ->where('approve', 1)
            ->orderBy('description', 'asc')
            ->get();
        
        return view('auth.vendor.reviews.index', compact('reviews', 'hotels'));
    }

    /**
     * Show review details
     */
    public function show($id)
    {
        $vendorId = Auth::guard('vendor')->id();
        $vendorHotelIds = Hotel::where('vendor_id', $vendorId)
            ->where('approve', 1)
            ->pluck('id')
            ->toArray();
        
        $review = Review::with(['hotel', 'guest', 'booking'])->findOrFail($id);
        
        // Ensure review belongs to vendor's hotel
        if (!in_array($review->hotel_id, $vendorHotelIds)) {
            abort(403, 'Unauthorized access to this review');
        }
        
        return view('auth.vendor.reviews.show', compact('review'));
    }

    /**
     * Approve a review (vendor can only approve reviews for their hotels)
     */
    public function approve($id)
    {
        $vendorId = Auth::guard('vendor')->id();
        $vendorHotelIds = Hotel::where('vendor_id', $vendorId)
            ->where('approve', 1)
            ->pluck('id')
            ->toArray();
        
        $review = Review::findOrFail($id);
        
        // Ensure review belongs to vendor's hotel
        if (!in_array($review->hotel_id, $vendorHotelIds)) {
            abort(403, 'Unauthorized access to this review');
        }
        
        $review->is_approved = true;
        $review->save();
        
        return redirect()->back()->with('success', 'Review approved successfully');
    }

    /**
     * Bulk approve reviews
     */
    public function bulkApprove(Request $request)
    {
        $request->validate([
            'review_ids' => 'required|array',
            'review_ids.*' => 'exists:reviews,id'
        ]);
        
        $vendorId = Auth::guard('vendor')->id();
        $vendorHotelIds = Hotel::where('vendor_id', $vendorId)
            ->where('approve', 1)
            ->pluck('id')
            ->toArray();
        
        // Only approve reviews that belong to vendor's hotels
        $reviews = Review::whereIn('id', $request->review_ids)
            ->whereIn('hotel_id', $vendorHotelIds)
            ->update(['is_approved' => true]);
        
        return redirect()->back()->with('success', count($request->review_ids) . ' reviews approved successfully');
    }

    /**
     * Add hotel response to a review
     */
    public function addResponse(Request $request, $id)
    {
        $request->validate([
            'hotel_response' => 'required|string|max:1000'
        ]);
        
        $vendorId = Auth::guard('vendor')->id();
        $vendorHotelIds = Hotel::where('vendor_id', $vendorId)
            ->where('approve', 1)
            ->pluck('id')
            ->toArray();
        
        $review = Review::findOrFail($id);
        
        // Ensure review belongs to vendor's hotel
        if (!in_array($review->hotel_id, $vendorHotelIds)) {
            abort(403, 'Unauthorized access to this review');
        }
        
        $review->hotel_response = $request->hotel_response;
        $review->hotel_response_date = now();
        $review->save();
        
        return redirect()->back()->with('success', 'Hotel response added successfully');
    }
}
