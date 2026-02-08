<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Hotel;
use Illuminate\Http\Request;

class ReviewManagementController extends Controller
{
    /**
     * Display all reviews for super admin
     */
    public function index(Request $request)
    {
        $query = Review::with(['hotel', 'guest', 'booking']);
        
        // Filter by approval status
        if ($request->has('status')) {
            if ($request->status === 'pending') {
                $query->where('is_approved', false);
            } elseif ($request->status === 'approved') {
                $query->where('is_approved', true);
            }
        }
        
        // Filter by hotel
        if ($request->has('hotel_id') && $request->hotel_id) {
            $query->where('hotel_id', $request->hotel_id);
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
        $hotels = Hotel::where('approve', 1)->orderBy('description', 'asc')->get();
        
        return view('auth.super_admin.reviews.index', compact('reviews', 'hotels'));
    }

    /**
     * Show review details
     */
    public function show($id)
    {
        $review = Review::with(['hotel', 'guest', 'booking'])->findOrFail($id);
        return view('auth.super_admin.reviews.show', compact('review'));
    }

    /**
     * Approve a review
     */
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->is_approved = true;
        $review->save();
        
        return redirect()->back()->with('success', 'Review approved successfully');
    }

    /**
     * Reject/Delete a review
     */
    public function reject($id)
    {
        $review = Review::findOrFail($id);
        
        // Delete images if any
        if ($review->images && is_array($review->images)) {
            foreach ($review->images as $image) {
                // Handle both storage and public paths
                $imagePath = null;
                if (strpos($image, 'uploads/') === 0) {
                    $imagePath = public_path($image);
                } elseif (strpos($image, 'storage/') === 0) {
                    $imagePath = public_path($image);
                } else {
                    $imagePath = public_path('uploads/reviews/' . basename($image));
                }
                
                if ($imagePath && file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        
        $review->delete();
        
        return redirect()->back()->with('success', 'Review rejected and deleted successfully');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured($id)
    {
        $review = Review::findOrFail($id);
        $review->is_featured = !$review->is_featured;
        $review->save();
        
        $status = $review->is_featured ? 'featured' : 'unfeatured';
        return redirect()->back()->with('success', "Review {$status} successfully");
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
        
        Review::whereIn('id', $request->review_ids)->update(['is_approved' => true]);
        
        return redirect()->back()->with('success', count($request->review_ids) . ' reviews approved successfully');
    }

    /**
     * Bulk reject reviews
     */
    public function bulkReject(Request $request)
    {
        $request->validate([
            'review_ids' => 'required|array',
            'review_ids.*' => 'exists:reviews,id'
        ]);
        
        $reviews = Review::whereIn('id', $request->review_ids)->get();
        
        foreach ($reviews as $review) {
            // Delete images if any
            if ($review->images && is_array($review->images)) {
                foreach ($review->images as $image) {
                    // Handle both storage and public paths
                    $imagePath = null;
                    if (strpos($image, 'uploads/') === 0) {
                        $imagePath = public_path($image);
                    } elseif (strpos($image, 'storage/') === 0) {
                        $imagePath = public_path($image);
                    } else {
                        $imagePath = public_path('uploads/reviews/' . basename($image));
                    }
                    
                    if ($imagePath && file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
        }
        
        Review::whereIn('id', $request->review_ids)->delete();
        
        return redirect()->back()->with('success', count($request->review_ids) . ' reviews rejected and deleted successfully');
    }

    /**
     * Edit review form (Super Admin only)
     */
    public function edit($id)
    {
        $review = Review::with(['hotel', 'guest', 'booking'])->findOrFail($id);
        return view('auth.super_admin.reviews.edit', compact('review'));
    }

    /**
     * Update review (Super Admin only)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'overall_rating' => 'required|numeric|min:0|max:10',
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string',
            'staff_rating' => 'nullable|numeric|min:0|max:10',
            'facilities_rating' => 'nullable|numeric|min:0|max:10',
            'cleanliness_rating' => 'nullable|numeric|min:0|max:10',
            'location_rating' => 'nullable|numeric|min:0|max:10',
            'comfort_rating' => 'nullable|numeric|min:0|max:10',
            'value_for_money_rating' => 'nullable|numeric|min:0|max:10',
            'free_wifi_rating' => 'nullable|numeric|min:0|max:10',
            'pros' => 'nullable|string',
            'cons' => 'nullable|string',
        ]);

        $review = Review::findOrFail($id);
        $review->fill($request->only([
            'overall_rating', 'title', 'comment', 'staff_rating', 'facilities_rating',
            'cleanliness_rating', 'location_rating', 'comfort_rating',
            'value_for_money_rating', 'free_wifi_rating', 'pros', 'cons'
        ]));
        $review->save();

        return redirect()->route('super-admin.reviews.show', $review->id)->with('success', 'Review updated successfully');
    }

    /**
     * Add or update hotel response (Super Admin can edit reply)
     */
    public function addResponse(Request $request, $id)
    {
        $request->validate([
            'hotel_response' => 'required|string|max:1000'
        ]);
        
        $review = Review::findOrFail($id);
        $review->hotel_response = $request->hotel_response;
        $review->hotel_response_date = now();
        $review->save();
        
        return redirect()->back()->with('success', 'Hotel response saved successfully');
    }

    /**
     * Delete hotel response (Super Admin only)
     */
    public function deleteResponse($id)
    {
        $review = Review::findOrFail($id);
        $review->hotel_response = null;
        $review->hotel_response_date = null;
        $review->save();

        return redirect()->back()->with('success', 'Hotel response deleted successfully');
    }
}
