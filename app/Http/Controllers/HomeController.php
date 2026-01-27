<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function hotelDetails($id, Request $request)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
        $show = Hotel::where('id', $decryptedId)->firstOrFail();
        
        // Get search parameters from URL query string
        $searchParams = [
            'checkin' => $request->input('checkin', ''),
            'checkout' => $request->input('checkout', ''),
            'adults' => (int) $request->input('adults', 0),
            'children' => (int) $request->input('children', 0),
            'infants' => (int) $request->input('infants', 0),
            'pets' => (int) $request->input('pets', 0),
        ];
        
        // Get review statistics
        $reviews = Review::where('hotel_id', $decryptedId)->where('is_approved', true)->get();
        $reviewStats = [
            'total' => $reviews->count(),
            'overall_avg' => round($reviews->avg('overall_rating') ?? 0, 1),
            'staff_avg' => round($reviews->avg('staff_rating') ?? 0, 1),
            'facilities_avg' => round($reviews->avg('facilities_rating') ?? 0, 1),
            'cleanliness_avg' => round($reviews->avg('cleanliness_rating') ?? 0, 1),
            'location_avg' => round($reviews->avg('location_rating') ?? 0, 1),
            'comfort_avg' => round($reviews->avg('comfort_rating') ?? 0, 1),
            'value_avg' => round($reviews->avg('value_for_money_rating') ?? 0, 1),
            'wifi_avg' => round($reviews->avg('free_wifi_rating') ?? 0, 1),
        ];
        
        // Get rating sentiment
        $ratingSentiment = 'No Rating';
        if ($reviewStats['overall_avg'] >= 9.0) {
            $ratingSentiment = 'Exceptional';
        } elseif ($reviewStats['overall_avg'] >= 8.0) {
            $ratingSentiment = 'Excellent';
        } elseif ($reviewStats['overall_avg'] >= 7.0) {
            $ratingSentiment = 'Very Good';
        } elseif ($reviewStats['overall_avg'] >= 6.0) {
            $ratingSentiment = 'Good';
        } elseif ($reviewStats['overall_avg'] >= 5.0) {
            $ratingSentiment = 'Average';
        } elseif ($reviewStats['overall_avg'] > 0) {
            $ratingSentiment = 'Poor';
        }
        
        return view('frontend.Hotel.hotelDetails', compact('show', 'searchParams', 'reviewStats', 'ratingSentiment'));
    }
}
