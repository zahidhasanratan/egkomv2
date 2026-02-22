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
                    ->where('is_suspended', 0)
                    ->where('status', 'submitted')
                    ->count();
                return $destination;
            });

        return view('frontend.destinations.index', compact('destinations'));
    }

    public function show($slug)
    {
        // First, try to find as PopularDestination
        $destination = PopularDestination::where('slug', $slug)
            ->where('is_active', 1)
            ->first();

        $type = 'destination';
        $name = null;
        $query = null;

        if ($destination) {
            // It's a popular destination
            $query = Hotel::where('popular_destination_id', $destination->id)
                ->where('approve', 1)
                ->where('is_suspended', 0);
            $name = $destination->name;
        } else {
            // Check if it's a district
            $districts = ['Bagerhat', 'Bandarban', 'Barguna', 'Barisal', 'Bhola', 'Bogra', 'Brahmanbaria', 'Chandpur', 'Chittagong', 'Chuadanga', 'Comilla', "Cox'sBazar", 'Dhaka', 'Dinajpur', 'Faridpur', 'Feni', 'Gaibandha', 'Gazipur', 'Gopalganj', 'Habiganj', 'Jaipurhat', 'Jamalpur', 'Jessore', 'Jhalokati', 'Jhenaidah', 'Khagrachari', 'Khulna', 'Kishoreganj', 'Kurigram', 'Kushtia', 'Lakshmipur', 'Lalmonirhat', 'Madaripur', 'Magura', 'Manikganj', 'Maulvibazar', 'Meherpur', 'Munshiganj', 'Mymensingh', 'Naogaon', 'Narail', 'Narayanganj', 'Narsingdi', 'Natore', 'Nawabganj', 'Netrokona', 'Nilphamari', 'Noakhali', 'Pabna', 'Panchagarh', 'Patuakhali', 'Pirojpur', 'Rajbari', 'Rajshahi', 'Rangamati', 'Rangpur', 'Satkhira', 'Shariatpur', 'Sherpur', 'Sirajganj', 'Sunamganj', 'Sylhet', 'Tangail', 'Thakurgaon'];
            
            foreach ($districts as $district) {
                if (Str::slug($district) === $slug) {
                    $query = Hotel::where('district', $district)
                        ->where('approve', 1)
                        ->where('is_suspended', 0);
                    $name = $district;
                    $type = 'district';
                    break;
                }
            }

            // If not a district, check if it's a city
            if (!$query) {
                $cities = Hotel::where('approve', 1)
                    ->where('is_suspended', 0)
                    ->where('status', 'submitted')
                    ->whereNotNull('city')
                    ->where('city', '!=', '')
                    ->select('city')
                    ->distinct()
                    ->pluck('city')
                    ->toArray();

                foreach ($cities as $city) {
                    if (Str::slug($city) === $slug) {
                        $query = Hotel::where('city', $city)
                            ->where('approve', 1)
                            ->where('is_suspended', 0);
                        $name = $city;
                        $type = 'city';
                        break;
                    }
                }
            }
        }

        // If still not found, return 404
        if (!$query) {
            abort(404);
        }

        // Get hotels for this destination/district/city
        $hotels = $query
            ->where('approve', 1)
            ->where('is_suspended', 0)
            ->where('status', 'submitted')
            ->with(['rooms' => function($roomQuery) {
                $roomQuery->where('is_active', true);
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

        // Create a destination object for the view
        if (!$destination) {
            $destination = (object)[
                'id' => null,
                'name' => $name,
                'slug' => $slug
            ];
        }

        return view('frontend.destinations.show', compact('destination', 'hotels', 'type'));
    }

}

