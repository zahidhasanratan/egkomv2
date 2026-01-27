<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Store a new review
     */
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if user is authenticated
        if (!Auth::guard('guest')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to submit a review'
            ], 401);
        }

        $guest = Auth::guard('guest')->user();
        $hotelId = $request->hotel_id;

        // Verify that the guest has a booking for this hotel
        $bookings = Booking::where('guest_id', $guest->id)
            ->where('booking_status', '!=', 'cancelled')
            ->get();
        
        $hasBooking = false;
        $booking = null;
        
        foreach ($bookings as $b) {
            foreach ($b->rooms_data as $room) {
                if (isset($room['hotelId']) && $room['hotelId'] == $hotelId) {
                    $hasBooking = true;
                    $booking = $b;
                    break 2;
                }
            }
        }

        if (!$hasBooking) {
            return response()->json([
                'success' => false,
                'message' => 'You can only review hotels you have booked'
            ], 403);
        }

        // Check if user already reviewed this hotel
        $existingReview = Review::where('hotel_id', $hotelId)
            ->where('guest_id', $guest->id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this hotel'
            ], 400);
        }

        // Booking is already found above

        // Handle image uploads - Save to public/uploads/reviews folder
        $images = [];
        if ($request->hasFile('images')) {
            $uploadPath = public_path('uploads/reviews');
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            foreach ($request->file('images') as $image) {
                $currentDate = now()->toDateString();
                $imageName = 'review-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($uploadPath, $imageName);
                $images[] = 'uploads/reviews/' . $imageName;
            }
        }

        // Create review
        $review = Review::create([
            'hotel_id' => $hotelId,
            'guest_id' => $guest->id,
            'booking_id' => $booking ? $booking->id : null,
            'overall_rating' => $request->overall_rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'staff_rating' => $request->staff_rating,
            'facilities_rating' => $request->facilities_rating,
            'cleanliness_rating' => $request->cleanliness_rating,
            'location_rating' => $request->location_rating,
            'comfort_rating' => $request->comfort_rating,
            'value_for_money_rating' => $request->value_for_money_rating,
            'free_wifi_rating' => $request->free_wifi_rating,
            'pros' => $request->pros,
            'cons' => $request->cons,
            'images' => !empty($images) ? $images : null,
            'is_approved' => false, // Admin needs to approve
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully. It will be published after approval.',
            'review' => $review->load('guest')
        ]);
    }

    /**
     * Get reviews for a hotel
     */
    public function getHotelReviews(Request $request, $hotelId)
    {
        try {
            $decryptedId = Crypt::decrypt($hotelId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid hotel ID'
            ], 404);
        }

        $sortBy = $request->input('sort', 'most_relevant'); // most_relevant, newest, oldest, highest_rating, lowest_rating
        
        $query = Review::where('hotel_id', $decryptedId)
            ->where('is_approved', true)
            ->with('guest');

        switch ($sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'highest_rating':
                $query->orderBy('overall_rating', 'desc');
                break;
            case 'lowest_rating':
                $query->orderBy('overall_rating', 'asc');
                break;
            default: // most_relevant
                $query->orderBy('is_featured', 'desc')
                      ->orderBy('overall_rating', 'desc')
                      ->orderBy('created_at', 'desc');
        }

        $reviews = $query->get();

        // Calculate average ratings
        $avgRatings = [
            'overall' => $reviews->avg('overall_rating') ?? 0,
            'staff' => $reviews->avg('staff_rating') ?? 0,
            'facilities' => $reviews->avg('facilities_rating') ?? 0,
            'cleanliness' => $reviews->avg('cleanliness_rating') ?? 0,
            'location' => $reviews->avg('location_rating') ?? 0,
            'comfort' => $reviews->avg('comfort_rating') ?? 0,
            'value_for_money' => $reviews->avg('value_for_money_rating') ?? 0,
            'free_wifi' => $reviews->avg('free_wifi_rating') ?? 0,
        ];

        return response()->json([
            'success' => true,
            'reviews' => $reviews,
            'average_ratings' => $avgRatings,
            'total_reviews' => $reviews->count()
        ]);
    }

    /**
     * Check if user can review this hotel
     */
    public function canReview(Request $request, $hotelId)
    {
        if (!Auth::guard('guest')->check()) {
            return response()->json([
                'can_review' => false,
                'message' => 'Please login to submit a review'
            ]);
        }

        try {
            $decryptedId = Crypt::decrypt($hotelId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'can_review' => false,
                'message' => 'Invalid hotel ID'
            ]);
        }

        $guest = Auth::guard('guest')->user();

        // Check if user has a booking
        $bookings = Booking::where('guest_id', $guest->id)
            ->where('booking_status', '!=', 'cancelled')
            ->get();

        $hasBooking = false;
        foreach ($bookings as $booking) {
            foreach ($booking->rooms_data as $room) {
                if (isset($room['hotelId']) && $room['hotelId'] == $decryptedId) {
                    $hasBooking = true;
                    break 2;
                }
            }
        }

        if (!$hasBooking) {
            return response()->json([
                'can_review' => false,
                'message' => 'You can only review hotels you have booked'
            ]);
        }

        // Check if already reviewed
        $existingReview = Review::where('hotel_id', $decryptedId)
            ->where('guest_id', $guest->id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'can_review' => false,
                'message' => 'You have already reviewed this hotel',
                'has_reviewed' => true
            ]);
        }

        return response()->json([
            'can_review' => true,
            'message' => 'You can submit a review'
        ]);
    }
}
