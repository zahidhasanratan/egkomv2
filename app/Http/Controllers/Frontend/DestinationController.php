<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PopularDestination;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = PopularDestination::where('is_active', 1)
            ->orderBy('order', 'ASC')
            ->orderBy('name', 'ASC')
            ->get()
            ->map(function ($destination) {
                $destination->hotels_count = Hotel::where('popular_destination_id', $destination->id)
                    ->where('approve', 1)
                    ->where('status', 'submitted')
                    ->count();
                return $destination;
            });

        return view('frontend.destinations.index', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = PopularDestination::where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        // Get hotels for this destination
        $hotels = Hotel::where('popular_destination_id', $destination->id)
            ->where('approve', 1)
            ->where('status', 'submitted')
            ->with(['rooms' => function($query) {
                $query->where('is_active', 1);
            }])
            ->get()
            ->map(function ($hotel) {
                // Get minimum room price from rooms
                $minPrice = $hotel->rooms->min('price_per_night') ?? 0;
                $hotel->min_price = $minPrice;
                
                // Get featured images
                $images = [];
                if ($hotel->featured_photo) {
                    $featuredPhotos = is_string($hotel->featured_photo) ? json_decode($hotel->featured_photo, true) : $hotel->featured_photo;
                    if (is_array($featuredPhotos) && !empty($featuredPhotos[0])) {
                        $images[] = $featuredPhotos[0];
                    } elseif (is_string($hotel->featured_photo)) {
                        $images[] = $hotel->featured_photo;
                    }
                }
                
                // Add other photos
                $photoFields = ['kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos'];
                foreach ($photoFields as $field) {
                    if ($hotel->$field) {
                        $photos = is_string($hotel->$field) ? json_decode($hotel->$field, true) : $hotel->$field;
                        if (is_array($photos)) {
                            $images = array_merge($images, array_slice($photos, 0, 1));
                        }
                    }
                }
                
                $hotel->display_images = array_slice($images, 0, 4);
                
                return $hotel;
            });

        return view('frontend.destinations.show', compact('destination', 'hotels'));
    }
}

