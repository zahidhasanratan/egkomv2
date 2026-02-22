<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Get search parameters
        $destination = $request->input('destination', '');
        $searchType = $request->input('search_type', '');
        
        // Auto-detect search type if not provided
        if (empty($searchType) && !empty($destination)) {
            $searchType = $this->detectSearchType($destination);
        }
        
        $checkin = $request->input('checkin', '');
        $checkout = $request->input('checkout', '');
        $adults = (int) $request->input('adults', 0);
        $children = (int) $request->input('children', 0);
        $infants = (int) $request->input('infants', 0);
        $pets = (int) $request->input('pets', 0);
        
        // Convert dates from dd/mm/yyyy to YYYY-MM-DD if needed
        if ($checkin && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $checkin)) {
            $parts = explode('/', $checkin);
            if (count($parts) === 3) {
                $checkin = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
            }
        }
        
        if ($checkout && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $checkout)) {
            $parts = explode('/', $checkout);
            if (count($parts) === 3) {
                $checkout = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
            }
        }
        
        // Validate dates
        $hasValidDates = false;
        $checkinDate = null;
        $checkoutDate = null;
        
        if (!empty($checkin) && !empty($checkout)) {
            try {
                $checkinDate = Carbon::parse($checkin);
                $checkoutDate = Carbon::parse($checkout);
                
                // Validate that checkout is after checkin
                if ($checkoutDate->gt($checkinDate)) {
                    // Check if dates are not in the past
                    $today = Carbon::today();
                    if ($checkinDate->gte($today)) {
                        $hasValidDates = true;
                    }
                }
            } catch (\Exception $e) {
                // Invalid date format, skip date filtering
                $hasValidDates = false;
            }
        }
        
        // Total guests (adults + children) - infants and pets don't count towards room capacity
        // But we still need minimum 1 guest if specified
        $totalGuests = $adults + $children;
        $hasGuestRequirement = $totalGuests > 0;
        
        // Start with approved and non-suspended hotels only
        $query = Hotel::where('approve', 1)
            ->where('is_suspended', 0);
        
        // Filter by search type (location, apartment, room)
        if ($searchType === 'apartment') {
            // Filter for apartments only
            $query->where(function($q) {
                $q->where('property_category', 'Apartment')
                  ->orWhere('property_type', 'like', '%Apartment%')
                  ->orWhere('property_type', 'Only Apartment');
            });
        } elseif ($searchType === 'room') {
            // For room search, we need to check if hotels have rooms matching the search term
            // First, get hotel IDs that have matching rooms (excluding suspended hotels)
            $matchingRoomHotelIds = Room::where('is_active', true)
                ->whereHas('hotel', function($q) {
                    $q->where('approve', 1)
                      ->where('is_suspended', 0);
                })
                ->where(function($q) use ($destination) {
                    $q->where('name', 'like', '%' . $destination . '%')
                      ->orWhere('description', 'like', '%' . $destination . '%');
                })
                ->pluck('hotel_id')
                ->unique()
                ->toArray();
            
            // Filter hotels that either:
            // 1. Have rooms matching the search term, OR
            // 2. Match the property category/type for rooms
            $query->where(function($q) use ($matchingRoomHotelIds) {
                if (!empty($matchingRoomHotelIds)) {
                    $q->whereIn('id', $matchingRoomHotelIds);
                }
                $q->orWhere(function($subQ) {
                    $subQ->whereIn('property_category', ['Hotel', 'Resort'])
                         ->orWhere('property_type', 'like', '%room%')
                         ->orWhere('property_type', 'like', '%Room%')
                         ->orWhere('property_type', 'like', '%Bed%')
                         ->orWhere('property_type', 'like', '%bed%')
                         ->orWhere('property_type', 'Only room')
                         ->orWhere('property_type', 'Only Bed');
                });
            });
        }
        // For 'location' type, no additional filtering needed - show all approved properties
        
        // Filter by destination (search in description, address, nearby areas)
        if (!empty($destination)) {
            $query->where(function($q) use ($destination, $searchType) {
                $q->where('description', 'like', '%' . $destination . '%')
                  ->orWhere('address', 'like', '%' . $destination . '%')
                  ->orWhereJsonContains('custom_nearby_areas', $destination);
                
                // For room search, also check if hotel description matches (in case room name is in hotel description)
                if ($searchType === 'room') {
                    // Already handled above with room matching
                }
            });
        }
        
        // Get all hotels matching destination
        $hotels = $query->get();
        
        // Filter hotels that have available rooms for the selected criteria
        $filteredHotels = collect();
        
        // If no search criteria provided (no dates, no guests, no destination), show all approved hotels
        if (!$hasValidDates && !$hasGuestRequirement && empty($destination)) {
            $filteredHotels = $hotels;
        } else {
            foreach ($hotels as $hotel) {
                // Get active rooms for this hotel (hotel is already filtered to be non-suspended)
                $rooms = Room::where('hotel_id', $hotel->id)
                    ->where('is_active', true)
                    ->get();
                
                // If hotel has no active rooms, skip it
                if ($rooms->isEmpty()) {
                    continue;
                }
                
                // If no search criteria, include hotel if it has any active rooms
                if (!$hasValidDates && !$hasGuestRequirement) {
                    $filteredHotels->push($hotel);
                    continue;
                }
                
                $availableRooms = collect();
                
                foreach ($rooms as $room) {
                    $isRoomAvailable = true;
                    
                    // Check 1: Date Availability (STRICT CHECK)
                    if ($hasValidDates) {
                        // Get the availability dates from the room (Laravel should auto-cast JSON to array)
                        $roomAvailabilityDates = $room->availability_dates;
                        
                        // Normalize availability dates - handle various formats
                        $normalizedRoomDates = [];
                        
                        // Handle null, empty string, or empty array
                        if (empty($roomAvailabilityDates)) {
                            // Room has NO availability dates set - treat as NOT available when dates are searched
                            // This ensures only rooms with explicit availability show up
                            $isRoomAvailable = false;
                            continue; // Skip this room - it has no availability dates configured
                        }
                        
                        // Ensure it's an array
                        if (!is_array($roomAvailabilityDates)) {
                            // Try to decode if it's a JSON string
                            if (is_string($roomAvailabilityDates)) {
                                $decoded = json_decode($roomAvailabilityDates, true);
                                if (is_array($decoded)) {
                                    $roomAvailabilityDates = $decoded;
                                } else {
                                    $isRoomAvailable = false;
                                    continue;
                                }
                            } else {
                                $isRoomAvailable = false;
                                continue;
                            }
                        }
                        
                        // Normalize all dates to YYYY-MM-DD format
                        foreach ($roomAvailabilityDates as $date) {
                            try {
                                if ($date instanceof \DateTime || $date instanceof Carbon) {
                                    $normalizedRoomDates[] = $date->format('Y-m-d');
                                } elseif (is_string($date)) {
                                    // Parse the date string to ensure correct format
                                    $parsedDate = Carbon::parse($date);
                                    $normalizedRoomDates[] = $parsedDate->format('Y-m-d');
                                } else {
                                    // Try to convert to string
                                    $normalizedRoomDates[] = (string) $date;
                                }
                            } catch (\Exception $e) {
                                // Skip invalid dates
                                continue;
                            }
                        }
                        
                        // If after normalization we have no valid dates, skip this room
                        if (empty($normalizedRoomDates)) {
                            $isRoomAvailable = false;
                            continue;
                        }
                        
                        // Room has specific availability dates - must check ALL dates in search range
                        $allDatesAvailable = true;
                        
                        // Generate all dates in the search range (excluding checkout date)
                        $start = clone $checkinDate;
                        $end = clone $checkoutDate;
                        $end->subDay(); // Exclude checkout date - guest checks out on this day
                        
                        $currentDate = clone $start;
                        while ($currentDate <= $end) {
                            $searchDateString = $currentDate->format('Y-m-d');
                            
                            // STRICT CHECK: This date MUST be in the room's availability dates
                            if (!in_array($searchDateString, $normalizedRoomDates, true)) {
                                $allDatesAvailable = false;
                                break; // Even one missing date means room is not available
                            }
                            $currentDate->addDay();
                        }
                        
                        if (!$allDatesAvailable) {
                            $isRoomAvailable = false;
                            continue; // Skip to next room - this one is not available for the search dates
                        }
                    }
                    
                    // Check 2: Guest Capacity
                    if ($isRoomAvailable && $hasGuestRequirement) {
                        // Room must be able to accommodate the total number of guests
                        // total_persons should be >= totalGuests (adults + children)
                        if (empty($room->total_persons) || $room->total_persons < $totalGuests) {
                            $isRoomAvailable = false;
                        }
                    }
                    
                    // If room passes all checks, add it to available rooms
                    if ($isRoomAvailable) {
                        $availableRooms->push($room);
                    }
                }
                
                // Only include hotel if it has at least one available room that meets the criteria
                if ($availableRooms->count() > 0) {
                    $filteredHotels->push($hotel);
                }
            }
        }
        
        // Count total available rooms across all hotels
        $totalRoomsCount = 0;
        foreach ($filteredHotels as $hotel) {
            $rooms = Room::where('hotel_id', $hotel->id)
                ->where('is_active', true)
                ->get();
            
            // If dates are provided, count only available rooms
            if ($hasValidDates) {
                foreach ($rooms as $room) {
                    $roomAvailabilityDates = $room->availability_dates;
                    
                    if (empty($roomAvailabilityDates)) {
                        continue; // Skip rooms with no availability dates
                    }
                    
                    if (!is_array($roomAvailabilityDates)) {
                        if (is_string($roomAvailabilityDates)) {
                            $decoded = json_decode($roomAvailabilityDates, true);
                            $roomAvailabilityDates = is_array($decoded) ? $decoded : [];
                        } else {
                            continue;
                        }
                    }
                    
                    // Normalize dates
                    $normalizedRoomDates = [];
                    foreach ($roomAvailabilityDates as $date) {
                        try {
                            if ($date instanceof \DateTime || $date instanceof Carbon) {
                                $normalizedRoomDates[] = $date->format('Y-m-d');
                            } elseif (is_string($date)) {
                                $normalizedRoomDates[] = Carbon::parse($date)->format('Y-m-d');
                            }
                        } catch (\Exception $e) {
                            continue;
                        }
                    }
                    
                    if (empty($normalizedRoomDates)) {
                        continue;
                    }
                    
                    // Check if all search dates are in room's availability
                    $allDatesAvailable = true;
                    $start = clone $checkinDate;
                    $end = clone $checkoutDate;
                    $end->subDay();
                    
                    $currentDate = clone $start;
                    while ($currentDate <= $end) {
                        $searchDateString = $currentDate->format('Y-m-d');
                        if (!in_array($searchDateString, $normalizedRoomDates, true)) {
                            $allDatesAvailable = false;
                            break;
                        }
                        $currentDate->addDay();
                    }
                    
                    if ($allDatesAvailable) {
                        // Check guest capacity if required
                        if ($hasGuestRequirement) {
                            if (!empty($room->total_persons) && $room->total_persons >= $totalGuests) {
                                $totalRoomsCount++;
                            }
                        } else {
                            $totalRoomsCount++;
                        }
                    }
                }
            } else {
                // No dates, count all active rooms (optionally filter by guest capacity)
                if ($hasGuestRequirement) {
                    $totalRoomsCount += $rooms->where('total_persons', '>=', $totalGuests)->count();
                } else {
                    $totalRoomsCount += $rooms->count();
                }
            }
        }
        
        $totalHotelsCount = $filteredHotels->count();

        // Eager load rooms (filteredHotels is a Support\Collection, so load via a fresh query and set relation)
        if ($filteredHotels->isNotEmpty()) {
            $hotelIds = $filteredHotels->pluck('id')->toArray();
            $hotelsWithRooms = Hotel::whereIn('id', $hotelIds)
                ->with(['rooms' => function ($q) {
                    $q->where('is_active', true);
                }])
                ->get()
                ->keyBy('id');
            foreach ($filteredHotels as $hotel) {
                $withRooms = $hotelsWithRooms->get($hotel->id);
                if ($withRooms) {
                    $hotel->setRelation('rooms', $withRooms->rooms);
                }
            }
        }

        // Enrich hotels with min_price and display_images (same structure as destinations/show)
        $filteredHotels = $filteredHotels->map(function ($hotel) {
            $minPrice = $hotel->rooms->min('price_per_night') ?? 0;
            $hotel->min_price = $minPrice;

            $images = [];
            if ($hotel->featured_photo) {
                $featuredPhotos = is_string($hotel->featured_photo) ? json_decode($hotel->featured_photo, true) : $hotel->featured_photo;
                if (is_array($featuredPhotos) && !empty($featuredPhotos[0])) {
                    $images[] = $featuredPhotos[0];
                } elseif (is_string($hotel->featured_photo)) {
                    $images[] = $hotel->featured_photo;
                }
            }
            $photoFields = ['kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos'];
            foreach ($photoFields as $field) {
                if (!empty($hotel->$field)) {
                    $photos = is_string($hotel->$field) ? json_decode($hotel->$field, true) : $hotel->$field;
                    if (is_array($photos)) {
                        $images = array_merge($images, array_slice($photos, 0, 1));
                    }
                }
            }
            $hotel->display_images = array_slice($images, 0, 4);

            return $hotel;
        });

        // Property types for filter sidebar (from filtered hotels)
        $propertyTypes = $filteredHotels
            ->groupBy(function ($h) {
                return $h->property_category ?? 'Hotel';
            })
            ->map(function ($group) {
                return (object)['property_category' => $group->keys()->first(), 'count' => $group->count()];
            })
            ->values();

        // Pass search parameters to view for display
        return view('frontend.search.results', compact(
            'filteredHotels',
            'totalHotelsCount',
            'totalRoomsCount',
            'destination',
            'searchType',
            'checkin',
            'checkout',
            'adults',
            'children',
            'infants',
            'pets',
            'totalGuests',
            'propertyTypes'
        ));
    }

    /**
     * Auto-detect search type based on search term
     */
    private function detectSearchType($searchTerm)
    {
        if (empty($searchTerm)) {
            return 'location';
        }
        
        $term = strtolower($searchTerm);
        
        // Check for apartment keywords
        $apartmentKeywords = ['apartment', 'apt', 'flat', 'unit'];
        foreach ($apartmentKeywords as $keyword) {
            if (strpos($term, $keyword) !== false) {
                return 'apartment';
            }
        }
        
        // Check for room keywords
        $roomKeywords = ['room', 'bedroom', 'bed', 'suite', 'chamber'];
        foreach ($roomKeywords as $keyword) {
            if (strpos($term, $keyword) !== false) {
                return 'room';
            }
        }
        
        // Default to location
        return 'location';
    }
}
