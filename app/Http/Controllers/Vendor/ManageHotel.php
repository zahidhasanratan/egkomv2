<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelSetting;
use App\Models\Owner;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ManageHotel extends Controller
{

    public function index(Request $request)
    {
        $query = Hotel::where('vendor_id', auth()->user()->id)
            ->where('approve', 1);
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }
        
        $hotels = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('auth.vendor.hotel.index', compact('hotels'));
    }

    public function indexSuper(Request $request)
    {
        $query = Hotel::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%")
                  ->orWhereHas('vendor', function($vendorQuery) use ($search) {
                      $vendorQuery->where('contact_person_name', 'like', "%{$search}%")
                                   ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        $hotels = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('auth.super_admin.hotel.index', compact('hotels'));
    }

    public function create()
    {
        // Get vendor's most recent hotel to inherit enabled policies (if any)
        $latestHotel = Hotel::where('vendor_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->first();
        
        $popularDestinations = \App\Models\PopularDestination::where('is_active', 1)->orderBy('name')->get();
        
        return view('auth.vendor.hotel.create', compact('latestHotel', 'popularDestinations'));
    }

    public function store(Request $request)
    {
        // (Optional) light validation. Tweak as needed.
        $request->validate([
            'popular_destination_id' => 'required|exists:popular_destinations,id',
            'property_category' => 'required|string|in:Hotels,Transit,Resorts,Lodges,Apartments,Guesthouses,Crisis',
            'property_type'     => 'nullable|string|max:255',
            'address'           => 'nullable|string|max:500',
            'district'          => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',

            'room_types'   => 'nullable|array',
            'room_types.*' => 'nullable|string|max:255',

            'nearby_areas'                 => 'nullable|array',
            'nearby_areas.*.name'          => 'nullable|array',
            'nearby_areas.*.name.*'        => 'nullable|string|max:255',
            'nearby_areas.*.distance'      => 'nullable|array',
            'nearby_areas.*.distance.*'    => 'nullable|string|max:255',

            'hotel_facilities'   => 'nullable|array',
            'hotel_facilities.*' => 'nullable|array',

            'custom_nearby_areas'   => 'nullable|array',
            'custom_nearby_areas.*' => 'nullable|string|max:255',

            'check_in_rules'          => 'nullable|array',
            'check_in_rules.*'        => 'nullable|string|max:255',
            'custom_check_in_rules'   => 'nullable|array',
            'custom_check_in_rules.*' => 'nullable|string|max:255',

            // Photos (5MB each, adjust as needed)
            'featured_photo'            => 'nullable|image|max:5120', // Single file
            'entrance_gate_photos.*'   => 'nullable|image|max:5120',
            'lift_stairs_photos.*'     => 'nullable|image|max:5120',
            'rooftop_photos.*'         => 'nullable|image|max:5120',
            'spa_photos.*'             => 'nullable|image|max:5120',
            'gym_photos.*'             => 'nullable|image|max:5120',
            'amenities_photos.*'       => 'nullable|image|max:5120',
            'additional_photos.*'      => 'nullable|image|max:5120',
            'custom_facilities_icon.*' => 'nullable|image|max:5120',

            // 👇 add validation for apartments block
            'apartment_count'         => 'nullable|integer|min:0',
            'apartments'              => 'nullable|array',
            'apartments.*.name'       => 'nullable|string|max:255',
            'apartments.*.number'     => 'nullable|string|max:255',
            'apartments.*.floor'      => 'nullable|string|max:255',
            
            // Total Number of Room
            'total_rooms'             => 'nullable|integer|min:0|max:1000',
        ]);

        // Start with safe copy (exclude token/method/status)
        $data = $request->except(['_token', '_method', 'status']);

        Log::debug('Request data:', $request->all());

        // ✅ Normalize property category/type
        $data['property_category'] = $request->input('property_category');
        $data['property_type']     = $request->input('property_type');

        // ✅ room_types[] → JSON
        $roomTypes = $request->input('room_types', []);
        if (is_array($roomTypes)) {
            $roomTypes = array_values(array_unique(array_filter(array_map('trim', $roomTypes), fn ($v) => $v !== '')));
            $data['room_types'] = !empty($roomTypes) ? json_encode($roomTypes) : null;
        } else {
            $data['room_types'] = null;
        }

        // ✅ nearby_areas → flat JSON
        if ($request->has('nearby_areas') && is_array($request->nearby_areas)) {
            $flatNearbyAreas = [];
            foreach ($request->nearby_areas as $category => $categoryData) {
                $names     = $categoryData['name'] ?? [];
                $distances = $categoryData['distance'] ?? [];
                foreach ($names as $idx => $name) {
                    $name = trim((string)$name);
                    if ($name === '') continue;
                    $flatNearbyAreas[] = [
                        'category' => $category,
                        'name'     => $name,
                        'distance' => isset($distances[$idx]) ? trim((string)$distances[$idx]) : null,
                    ];
                }
            }
            $data['nearby_areas'] = !empty($flatNearbyAreas) ? json_encode($flatNearbyAreas) : null;
        }

        // ✅ hotel_facilities → flat JSON
        if ($request->has('hotel_facilities') && is_array($request->hotel_facilities)) {
            $flatHotelFacilities = [];
            foreach ($request->hotel_facilities as $category => $facilityNames) {
                if (!is_array($facilityNames)) continue;
                foreach ($facilityNames as $facility) {
                    $facility = trim((string)$facility);
                    if ($facility !== '') {
                        $flatHotelFacilities[] = ['category' => $category, 'name' => $facility];
                    }
                }
            }
            $data['hotel_facilities'] = !empty($flatHotelFacilities) ? json_encode($flatHotelFacilities) : null;
        }

        // (Optional) popular facilities[]
        if ($request->has('facilities') && is_array($request->facilities)) {
            $fac = array_values(array_unique(array_filter(array_map('trim', $request->facilities), fn ($v) => $v !== '')));
            $data['facilities'] = !empty($fac) ? json_encode($fac) : null;
        }

        // (Optional) custom_facilities[] text
        if ($request->has('custom_facilities') && is_array($request->custom_facilities)) {
            $cf = array_values(array_filter(array_map('trim', $request->custom_facilities), fn ($v) => $v !== ''));
            $data['custom_facilities'] = !empty($cf) ? json_encode($cf) : null;
        }

        // ✅ custom_nearby_areas[] (max 3)
        if ($request->has('custom_nearby_areas') && is_array($request->custom_nearby_areas)) {
            $customAreas = array_values(array_filter(array_map('trim', $request->custom_nearby_areas), fn ($v) => $v !== ''));
            $customAreas = array_slice($customAreas, 0, 3);
            $data['custom_nearby_areas'] = !empty($customAreas) ? json_encode($customAreas) : null;
        }

        // ✅ Merge check_in_rules[] + custom_check_in_rules[]
        $checkInRules = is_array($request->check_in_rules) ? $request->check_in_rules : [];
        $customRules  = is_array($request->custom_check_in_rules) ? $request->custom_check_in_rules : [];
        $customRules  = array_values(array_filter(array_map('trim', $customRules), fn ($v) => $v !== ''));
        $mergedCheckinRules = array_values(array_filter(array_map('trim', array_merge($checkInRules, $customRules)), fn ($v) => $v !== ''));
        $data['check_in_rules'] = !empty($mergedCheckinRules) ? json_encode($mergedCheckinRules) : null;

        // ✅ File uploads → /public/hotel_photos
        // Updated hotel photo categories (plus custom facility icons)
        $singlePhotoFields = ['featured_photo']; // Single file inputs
        $multiplePhotoFields = [
            'entrance_gate_photos',  // Hotel Exterior
            'lift_stairs_photos',    // Common Areas
            'rooftop_photos',        // Facilities
            'spa_photos',            // Leisure & Wellness
            'gym_photos',            // Guest Rooms
            'amenities_photos',      // Amenities & Services
            'additional_photos',     // Additional Photos
            'custom_facilities_icon',
        ];
        $uploadDir = public_path('hotel_photos');
        if (!is_dir($uploadDir)) { @mkdir($uploadDir, 0755, true); }
        
        // Handle single file inputs
        foreach ($singlePhotoFields as $field) {
            $data[$field] = null;
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                if ($file && $file->isValid()) {
                    $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $file->move($uploadDir, $filename);
                    $data[$field] = json_encode(['hotel_photos/' . $filename]);
                }
            }
        }
        
        // Handle multiple file inputs (arrays)
        foreach ($multiplePhotoFields as $field) {
            $data[$field] = null;
            if ($request->hasFile($field)) {
                $paths = [];
                $files = $request->file($field);
                // Ensure it's an array
                if (!is_array($files)) {
                    $files = [$files];
                }
                foreach ($files as $file) {
                    if ($file && $file->isValid()) {
                        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                        $file->move($uploadDir, $filename);
                        $paths[] = 'hotel_photos/' . $filename;
                    }
                }
                $data[$field] = !empty($paths) ? json_encode($paths) : null;
            }
        }

        // ✅ Vendor
        $data['vendor_id'] = auth()->id();

        // 🔑 Save apartment_count - rooms will be created as blank entries on the room list page
        $data['apartment_count'] = (int) $request->input('apartment_count', 0);
        
        // Total Number of Room
        $totalRooms = (int) $request->input('total_rooms', 0);

        Log::debug('Final data (before transaction):', $data);

        try {
            DB::transaction(function () use ($data, $request, $totalRooms) {
                // 1) Create the Hotel
                /** @var \App\Models\Hotel $hotel */
                $hotel = Hotel::create($data);

                // 2) Create blank rooms if total_rooms is specified
                if ($totalRooms > 0) {
                    $blankRooms = [];
                    for ($i = 1; $i <= $totalRooms; $i++) {
                        $blankRooms[] = [
                            'hotel_id' => $hotel->id,
                            'name' => '',
                            'number' => '',
                            'floor_number' => '',
                            'price_per_night' => 0,
                            'weekend_price' => 0,
                            'holiday_price' => 0,
                            'total_persons' => 0,
                            'size' => 0,
                            'total_rooms' => 0,
                            'total_washrooms' => 0,
                            'total_beds' => 0,
                            'is_active' => 0,
                            'status' => 'draft',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    
                    if (!empty($blankRooms)) {
                        Room::insert($blankRooms);
                        Log::info('Created blank rooms for hotel', [
                            'hotel_id' => $hotel->id,
                            'rooms_created' => count($blankRooms)
                        ]);
                    }
                }

                Log::info('Hotel created', ['hotel_id' => $hotel->id, 'apartment_count' => $hotel->apartment_count, 'total_rooms' => $totalRooms]);
            });
        } catch (\Throwable $e) {
            Log::error('Error creating hotel/rooms: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            throw $e;
        }

        // Redirect
        return redirect()
            ->route('vendor-admin.hotel.index')
            ->with('success', $request->status === 'submitted'
                ? 'Hotel submitted successfully!'
                : 'Hotel Info Saved as Draft!');
    }


    public function edit(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }

        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        $popularDestinations = \App\Models\PopularDestination::where('is_active', 1)->orderBy('name')->get();
        return view('auth.vendor.hotel.edit', compact('hotel','hotelFacilities', 'popularDestinations'));
    }


    public function partOne1(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        $popularDestinations = \App\Models\PopularDestination::where('is_active', 1)->orderBy('name')->get();
        return view('auth.vendor.hotel.part.partOne1', compact('hotel','hotelFacilities', 'popularDestinations'));
    }

    public function partOne2(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.part.partOne2', compact('hotel','hotelFacilities'));
    }

    public function partOne3(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.part.partOne3', compact('hotel','hotelFacilities'));
    }
    public function partOne4(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.part.partOne4', compact('hotel','hotelFacilities'));
    }

    public function partOne5(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.part.partOne5', compact('hotel','hotelFacilities'));
    }

    public function partOne6(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.part.partOne6', compact('hotel','hotelFacilities'));
    }

    public function partOneOne(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.partOneOne', compact('hotel','hotelFacilities'));
    }

    public function partTwo(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.partTwo', compact('hotel','hotelFacilities'));
    }

    public function partTwo1(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.part.partTwo1', compact('hotel','hotelFacilities'));
    }

    public function partTwo2(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.part.partTwo2', compact('hotel','hotelFacilities'));
    }

    public function partThree(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.partThree', compact('hotel','hotelFacilities'));
    }

    public function partFour(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.partFour', compact('hotel','hotelFacilities'));
    }

    public function partFour2(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.partFour2', compact('hotel','hotelFacilities'));
    }

    public function show(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        // Ensure it's always an array
        if (!is_array($hotelFacilities)) {
            $hotelFacilities = [];
        }
        return view('auth.vendor.hotel.show', compact('hotel','hotelFacilities'));
    }

    public function editSuper(Hotel $hotel)
    {
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        $popularDestinations = \App\Models\PopularDestination::where('is_active', 1)->orderBy('name')->get();
        return view('auth.super_admin.hotel.edit', compact('hotel','hotelFacilities', 'popularDestinations'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        // 1) Validate input
        $validated = $request->validate([
            'popular_destination_id' => 'required|exists:popular_destinations,id',
            'property_type'               => 'nullable|string',

            // 👇 room_types support
            'room_types'                  => 'nullable|array',
            'room_types.*'                => 'nullable|string',

            'description'                 => 'nullable|string',
            'property_category'           => 'nullable|string',
            'details'                     => 'nullable|string',
            'lati'                        => 'nullable|string',
            'longi'                       => 'nullable|string',
            'address'                     => 'nullable|string',
            'district'                    => 'nullable|string',
            'city'                        => 'nullable|string',
            'pets_allowed'                => 'nullable|in:yes,no',
            'pets_details'                => 'nullable|string',
            'events_allowed'              => 'nullable|in:yes,no',
            'events_details'              => 'nullable|string',
            'smoking_allowed'             => 'nullable|in:yes,no',
            'smoking_details'             => 'nullable|string',
            'quiet_hours'                 => 'nullable|string',
            'photography_allowed'         => 'nullable|in:yes,no',
            'photography_details'         => 'nullable|string',
            'check_in_window'             => 'nullable|string',
            'check_out_time'              => 'nullable|string',
            'food_laundry'                => 'nullable|in:yes,no',

            'check_in_rules'              => 'nullable|array',
            'custom_check_in_rules'       => 'nullable|array',

            'property_info'               => 'nullable|array',
            'custom_property_info'        => 'nullable|array',

            'age_restriction'             => 'nullable|in:yes,no',
            'age_restriction_details'     => 'nullable|string',
            'vlogging_allowed'            => 'nullable|in:yes,no',
            'vlogging_details'            => 'nullable|string',
            'child_policy'                => 'nullable|string',
            'extra_bed_policy'            => 'nullable|string',
            'cooking_policy'              => 'nullable|string',
            'directions'                  => 'nullable|string',
            'additional_policy'           => 'nullable|string',

            'check_in_methods'            => 'nullable|array',
            'custom_check_in_methods'     => 'nullable|array',

            'cancellation_policies'       => 'nullable|array',

            'facilities'                  => 'nullable|array',
            'custom_facilities'           => 'nullable|array',
            'custom_facilities_icon.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'nearby_areas'                => 'nullable|array',
            'custom_nearby_areas'         => 'nullable|array',

            'status'                      => 'required|in:draft,submitted',
            
            'total_rooms'                 => 'nullable|integer|min:0|max:1000',

            'kitchen_photos.*'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'washroom_photos.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parking_lot_photos.*'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'entrance_gate_photos.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lift_stairs_photos.*'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'spa_photos.*'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bar_photos.*'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'transport_photos.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rooftop_photos.*'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gym_photos.*'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'security_photos.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities_photos.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_photos.*'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2) Filter out null/empty values, but preserve property_category and description
        $data = collect($validated)
            ->filter(function($v, $k) {
                // Always include property_category and description
                if (in_array($k, ['property_category', 'description'])) {
                    return true;
                }
                // For other fields, filter out null/empty values
                return !is_null($v) && $v !== '' && $v !== [];
            })
            ->toArray();
        
        // Explicitly include property_category and description even if empty (to ensure they're always saved)
        if ($request->has('property_category')) {
            $data['property_category'] = $request->input('property_category', '');
        }
        if ($request->has('description')) {
            $data['description'] = $request->input('description', '');
        }

        // ✅ Encode generic array fields so they persist as JSON (if your columns are TEXT/JSON)
        $arrayFieldsToEncode = [
            'room_types',
            'check_in_methods',
            'custom_check_in_methods',
            'property_info',
            'custom_property_info',
            'cancellation_policies',
            'facilities',
            'custom_facilities',
            'nearby_areas',
        ];
        foreach ($arrayFieldsToEncode as $field) {
            if ($request->has($field)) {
                $val = $request->input($field, []);
                // Keep only non-empty strings for safety
                if (is_array($val)) {
                    $val = array_values(array_filter($val, fn($x) => is_array($x) || (is_string($x) && trim($x) !== '')));
                }
                $data[$field] = json_encode($val);
            }
        }

        // 3) Merge check-in rules (built from defaults + custom), overrides any previous
        $mergedCheck = array_filter(array_merge(
            $request->input('check_in_rules', []),
            array_filter($request->input('custom_check_in_rules', []), fn($v) => is_string($v) && trim($v) !== '')
        ));
        if (!empty($mergedCheck)) {
            $data['check_in_rules'] = json_encode(array_values($mergedCheck));
        }

        // 4) Flatten hotel facilities (category+name pairs) -> JSON
        if ($request->filled('hotel_facilities')) {
            $flatFacilities = [];
            foreach ($request->hotel_facilities as $category => $names) {
                foreach ($names as $name) {
                    if (is_string($name) && trim($name) !== '') {
                        $flatFacilities[] = ['category' => $category, 'name' => $name];
                    }
                }
            }
            if (!empty($flatFacilities)) {
                $data['hotel_facilities'] = json_encode(array_values($flatFacilities));
            }
        }

        // 5) Handle custom nearby areas (simple list) -> JSON (max 3)
        $customNearby = array_filter(
            $request->input('custom_nearby_areas', []),
            fn($v) => is_string($v) && trim($v) !== ''
        );
        if (!empty($customNearby)) {
            $data['custom_nearby_areas'] = json_encode(array_values(array_slice($customNearby, 0, 3)));
        }

        // 6) Handle custom facilities icons (remove + upload to storage/app/public)
        $existingIcons = json_decode($hotel->custom_facilities_icon ?? '[]', true);
        $existingIcons = is_array($existingIcons) ? $existingIcons : [];

        foreach (explode(',', $request->input('removed_custom_facilities_icon', '')) as $idx) {
            $idx = trim($idx);
            if ($idx !== '' && isset($existingIcons[$idx])) {
                \Storage::disk('public')->delete($existingIcons[$idx]);
                unset($existingIcons[$idx]);
            }
        }

        if ($request->hasFile('custom_facilities_icon')) {
            foreach ($request->file('custom_facilities_icon') as $file) {
                if ($file && $file->isValid()) {
                    $existingIcons[] = $file->store('hotel_photos', 'public');
                }
            }
        }

        if (!empty($existingIcons)) {
            $data['custom_facilities_icon'] = json_encode(array_values($existingIcons));
        } else {
            // If nothing remains, ensure we don't leave stale JSON
            $data['custom_facilities_icon'] = json_encode([]);
        }

        // 7) Handle multiple photo fields (remove + upload) using public_path (as in your current approach)
        // Updated hotel photo categories (plus custom facility icons)
        $photoFields = [
            'featured_photo', // single, stored as JSON array for consistency
            'entrance_gate_photos',  // Hotel Exterior
            'lift_stairs_photos',    // Common Areas
            'rooftop_photos',        // Facilities
            'spa_photos',            // Leisure & Wellness
            'gym_photos',            // Guest Rooms
            'amenities_photos',      // Amenities & Services
            'additional_photos',     // Additional Photos
            'custom_facilities_icon',
        ];

        foreach ($photoFields as $field) {
            $existingPhotos = json_decode($hotel->$field ?? '[]', true);
            $existingPhotos = is_array($existingPhotos) ? $existingPhotos : [];

            // Remove selected photos (expects comma-separated indexes in removed_{field})
            $toRemove = array_filter(explode(',', $request->input('removed_' . $field, '')), fn($x) => $x !== '');
            foreach ($toRemove as $index) {
                if (isset($existingPhotos[$index])) {
                    $filePath = public_path($existingPhotos[$index]);
                    if (is_string($filePath) && file_exists($filePath)) {
                        @unlink($filePath);
                    }
                    unset($existingPhotos[$index]);
                }
            }

            // Add new uploads
            if ($request->hasFile($field)) {
                // Handle featured_photo as single file, others as array
                if ($field === 'featured_photo') {
                    $file = $request->file($field);
                    if ($file && $file->isValid()) {
                        $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                        $file->move(public_path('hotel_photos'), $filename);
                        // Replace existing featured photo (only one allowed)
                        $existingPhotos = ['hotel_photos/' . $filename];
                    }
                } else {
                    foreach ($request->file($field) as $file) {
                        if ($file && $file->isValid()) {
                            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                            $file->move(public_path('hotel_photos'), $filename);
                            $existingPhotos[] = 'hotel_photos/' . $filename; // relative path
                        }
                    }
                }
            }

            $data[$field] = json_encode(array_values($existingPhotos));
        }

        // 8) Always keep vendor_id unchanged
        $data['vendor_id'] = $hotel->vendor_id;

        // 9) Handle total_rooms - create additional blank rooms if count increased
        $totalRooms = (int) $request->input('total_rooms', 0);
        if ($totalRooms > 0) {
            $existingRoomsCount = Room::where('hotel_id', $hotel->id)->count();
            if ($totalRooms > $existingRoomsCount) {
                $roomsToAdd = $totalRooms - $existingRoomsCount;
                $blankRooms = [];
                for ($i = 1; $i <= $roomsToAdd; $i++) {
                    $blankRooms[] = [
                        'hotel_id' => $hotel->id,
                        'name' => '',
                        'number' => '',
                        'floor_number' => '',
                        'price_per_night' => 0,
                        'weekend_price' => 0,
                        'holiday_price' => 0,
                        'total_persons' => 0,
                        'size' => 0,
                        'total_rooms' => 0,
                        'total_washrooms' => 0,
                        'total_beds' => 0,
                        'is_active' => 0,
                        'status' => 'draft',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
                if (!empty($blankRooms)) {
                    Room::insert($blankRooms);
                    Log::info('Added blank rooms for hotel', [
                        'hotel_id' => $hotel->id,
                        'rooms_added' => count($blankRooms)
                    ]);
                }
            }
        }

        // 10) Update and redirect
        $hotel->update($data);

        return redirect()->back()
            ->with('success', $request->status === 'draft'
                ? 'Info saved as draft successfully.'
                : 'Info Updated successfully.'
            );
    }


    public function updateSuper(Request $request, Hotel $hotel)
    {

        // 1) Validate input
        $validated = $request->validate([
            'popular_destination_id' => 'required|exists:popular_destinations,id',
            'property_type'               => 'nullable|string',
            'property_category'           => 'nullable|string',

            'address'               => 'nullable|string',
            'district'               => 'nullable|string',
            'city'               => 'nullable|string',
            'details'               => 'nullable|string',
            'lati'               => 'nullable|string',
            'longi'               => 'nullable|string',
            'description'               => 'nullable|string',
            'pets_allowed'              => 'nullable|in:yes,no',
            'pets_details'              => 'nullable|string',
            'events_allowed'            => 'nullable|in:yes,no',
            'events_details'            => 'nullable|string',
            'smoking_allowed'           => 'nullable|in:yes,no',
            'smoking_details'           => 'nullable|string',
            'quiet_hours'               => 'nullable|string',
            'photography_allowed'       => 'nullable|in:yes,no',
            'photography_details'       => 'nullable|string',
            'check_in_window'           => 'nullable|string',
            'check_out_time'            => 'nullable|string',
            'food_laundry'              => 'nullable|in:yes,no',
            'check_in_rules'            => 'nullable|array',
            'custom_check_in_rules'     => 'nullable|array',
            'property_info'             => 'nullable|array',
            'custom_property_info'      => 'nullable|array',
            'age_restriction'           => 'nullable|in:yes,no',
            'age_restriction_details'   => 'nullable|string',
            'vlogging_allowed'          => 'nullable|in:yes,no',
            'vlogging_details'          => 'nullable|string',
            'child_policy'              => 'nullable|string',
            'extra_bed_policy'          => 'nullable|string',
            'cooking_policy'            => 'nullable|string',
            'directions'                => 'nullable|string',
            'additional_policy'         => 'nullable|string',
            'check_in_methods'          => 'nullable|array',
            'custom_check_in_methods'   => 'nullable|array',
            'cancellation_policies'     => 'nullable|array',
            'cancellation_policy_texts' => 'nullable|array',
            'cancellation_policy_texts.*' => 'nullable|string',
            'custom_cancellation_policies' => 'nullable|array',
            'enabled_cancellation_policies' => 'nullable|array',
            'facilities'                => 'nullable|array',
            'custom_facilities'         => 'nullable|array',
            'custom_facilities_icon.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nearby_areas'              => 'nullable|array',
            'custom_nearby_areas'       => 'nullable|array',
            'status'                    => 'required|in:draft,submitted',
            'featured_photo.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kitchen_photos.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'washroom_photos.*'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parking_lot_photos.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'entrance_gate_photos.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lift_stairs_photos.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'spa_photos.*'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bar_photos.*'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'transport_photos.*'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rooftop_photos.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gym_photos.*'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'security_photos.*'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities_photos.*'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_photos.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2) Filter out null/empty values, but preserve property_category and description
        $data = collect($validated)
            ->filter(function($v, $k) {
                // Always include property_category and description
                if (in_array($k, ['property_category', 'description'])) {
                    return true;
                }
                // For other fields, filter out null/empty values
                return !is_null($v) && $v !== '' && $v !== [];
            })
            ->toArray();
        
        // Explicitly include property_category and description even if empty (to ensure they're always saved)
        if ($request->has('property_category')) {
            $data['property_category'] = $request->input('property_category', '');
        }
        if ($request->has('description')) {
            $data['description'] = $request->input('description', '');
        }

        // Handle cancellation policies - SAVE GLOBALLY (not per-hotel)
        // Get or create global hotel settings
        $hotelSetting = HotelSetting::first();
        if (!$hotelSetting) {
            $hotelSetting = new \App\Models\HotelSetting();
            $hotelSetting->hotel_name = 'Default';
            $hotelSetting->hotel_address = '';
            $hotelSetting->email = '';
            $hotelSetting->phone = '';
            $hotelSetting->copyright = '';
            $hotelSetting->save();
        }

        // Keep policy texts even if some values are empty (we want partial edits)
        if ($request->has('cancellation_policy_texts')) {
            $policyTexts = array_filter(
                (array)$request->input('cancellation_policy_texts', []),
                fn($v) => $v !== null
            );
            $hotelSetting->cancellation_policy_texts = $policyTexts;
        }

        // Handle custom cancellation policies - SAVE GLOBALLY
        if ($request->has('custom_cancellation_policies')) {
            $customPolicies = [];
            foreach ($request->input('custom_cancellation_policies', []) as $index => $policy) {
                if (!empty($policy['text'])) {
                    $customPolicies[] = [
                        'key' => $policy['key'] ?? 'custom_' . $index,
                        'text' => $policy['text']
                    ];
                }
            }
            $hotelSetting->custom_cancellation_policies = !empty($customPolicies) ? $customPolicies : null;
        }

        // Handle enabled cancellation policies - SAVE GLOBALLY
        // Process if cancellation policies section was edited (check for the hidden field or any policy-related field)
        if ($request->has('enabled_cancellation_policies_sent') || $request->has('enabled_cancellation_policies_force') || $request->has('cancellation_policy_texts') || $request->has('cancellation_policies') || $request->has('enabled_cancellation_policies')) {
            $enabledPolicies = array_filter(
                (array)$request->input('enabled_cancellation_policies', []),
                fn($v) => $v !== null && $v !== ''
            );
            // If force field is present and no policies checked, explicitly set to empty array
            if ($request->has('enabled_cancellation_policies_force') && empty($enabledPolicies)) {
                $hotelSetting->enabled_cancellation_policies = [];
            } else {
                $hotelSetting->enabled_cancellation_policies = $enabledPolicies; // Can be empty array if none checked
            }
        }

        // Save global cancellation policies
        if ($request->has('cancellation_policy_texts') || $request->has('custom_cancellation_policies') || $request->has('enabled_cancellation_policies_sent') || $request->has('enabled_cancellation_policies_force') || $request->has('enabled_cancellation_policies')) {
            $hotelSetting->save();
        }

        // 3) Merge check-in rules
        $mergedCheck = array_filter(array_merge(
            $request->input('check_in_rules', []),
            array_filter($request->input('custom_check_in_rules', []), fn($v) => trim($v) !== '')
        ));
        if (!empty($mergedCheck)) {
            $data['check_in_rules'] = json_encode(array_values($mergedCheck));
        }

        // 4) Flatten hotel facilities
        if ($request->filled('hotel_facilities')) {
            $flatFacilities = [];
            foreach ($request->hotel_facilities as $category => $names) {
                foreach ($names as $name) {
                    if (trim($name) !== '') {
                        $flatFacilities[] = ['category' => $category, 'name' => $name];
                    }
                }
            }
            if (!empty($flatFacilities)) {
                $data['hotel_facilities'] = json_encode($flatFacilities);
            }
        }

        // 5) Handle custom nearby areas (max 3)
        $customNearby = array_filter($request->input('custom_nearby_areas', []), fn($v) => trim($v) !== '');
        if (!empty($customNearby)) {
            $data['custom_nearby_areas'] = json_encode(array_values(array_slice($customNearby, 0, 3)));
        }

        // 6) Handle custom facilities icons (remove + upload)
        $existingIcons = json_decode($hotel->custom_facilities_icon ?? '[]', true);
        $existingIcons = is_array($existingIcons) ? $existingIcons : [];

        foreach (explode(',', $request->input('removed_custom_facilities_icon', '')) as $idx) {
            if (isset($existingIcons[$idx])) {
                \Storage::disk('public')->delete($existingIcons[$idx]);
                unset($existingIcons[$idx]);
            }
        }

        if ($request->hasFile('custom_facilities_icon')) {
            foreach ($request->file('custom_facilities_icon') as $file) {
                if ($file->isValid()) {
                    $existingIcons[] = $file->store('hotel_photos', 'public');
                }
            }
        }

        if (!empty($existingIcons)) {
            $data['custom_facilities_icon'] = json_encode(array_values($existingIcons));
        }

        // 7) Handle multiple photo fields (remove + upload)
        $photoFields = [
            'featured_photo','kitchen_photos', 'washroom_photos', 'parking_lot_photos',
            'entrance_gate_photos', 'lift_stairs_photos', 'spa_photos',
            'bar_photos', 'transport_photos', 'rooftop_photos',
            'gym_photos', 'security_photos', 'amenities_photos', 'additional_photos'
        ];

        foreach ($photoFields as $field) {
            $existingPhotos = json_decode($hotel->$field ?? '[]', true) ?: [];

            // Handle removal
            $removedIndexes = explode(',', $request->input('removed_' . $field, ''));
            $remainingPhotos = [];
            foreach ($existingPhotos as $index => $photo) {
                if (!in_array((string)$index, $removedIndexes, true)) {
                    $remainingPhotos[] = $photo;
                }
            }

            // Handle new uploads

            if ($request->hasFile($field)) {
                $files = is_array($request->file($field)) ? $request->file($field) : [$request->file($field)];

                foreach ($files as $file) {
                    if ($file && $file->isValid()) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/hotel_photos');

                        // Make sure the directory exists
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0755, true);
                        }

                        $file->move($destinationPath, $filename);
                        $remainingPhotos[] = 'uploads/hotel_photos/' . $filename;
                    }
                }
            }


            $data[$field] = json_encode($remainingPhotos);
        }

        $data['vendor_id'] = $hotel->vendor_id;

        // 9) Update and redirect
        $hotel->update($data);

        // If status is draft, redirect to hotel list, otherwise stay on edit page
        if ($request->status === 'draft') {
            return redirect()
                ->route('super-admin.hotel.index')
                ->with('success', 'Hotel saved as draft successfully.');
        }

        // For submitted status, stay on the same edit page
        return redirect()
            ->route('super-admin.hotel.edit', $hotel->id)
            ->with('success', 'Hotel updated successfully.');


    }


    public function toggleApprove(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->approve = $request->approve == 1 ? 1 : 0;
        // Clear suspend status when unapproving
        if ($request->approve != 1) {
            $hotel->is_suspended = 0;
        }
        $hotel->save();

        return response()->json(['success' => true]);
    }
    
    public function toggleSuspend(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        
        // Only allow suspending approved hotels
        if ($hotel->approve != 1) {
            return response()->json(['success' => false, 'message' => 'Only approved hotels can be suspended.'], 400);
        }
        
        $hotel->is_suspended = $request->is_suspended == 1 ? 1 : 0;
        $hotel->save();

        return response()->json(['success' => true]);
    }


    public function destroy(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }

        try {
            // Delete associated photos from public folder
            $photoFields = [
                'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
                'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos',
                'gym_photos', 'security_photos', 'amenities_photos', 'additional_photos',
            ];

            foreach ($photoFields as $field) {
                if ($hotel->$field) {
                    $photos = json_decode($hotel->$field, true);
                    if (is_array($photos)) {
                        foreach ($photos as $path) {
                            $filePath = public_path($path);
                            if (file_exists($filePath)) {
                                unlink($filePath);  // Delete the file
                            }
                        }
                    }
                }
            }

            $hotel->delete();
        } catch (\Exception $e) {
            Log::error('Hotel deletion failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while deleting the hotel.');
        }

        return redirect()->route('vendor-admin.hotel.index')->with('success', 'Hotel deleted successfully!');
    }

}
