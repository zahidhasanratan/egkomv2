<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ManageHotel extends Controller
{
//    public function index(){
//        $hotels = Hotel::where('vendor_id', auth()->user()->id)->get();
//        return view('auth.vendor.hotel.index', compact('hotels'));
//    }
    public function index()
    {
        $hotels = Hotel::where('vendor_id', auth()->user()->id)->paginate(10); // Paginate 10 per page
        return view('auth.vendor.hotel.index', compact('hotels'));
    }
    public function indexSuper()
    {
        $hotels = Hotel::paginate(10); // Paginate 10 per page
        return view('auth.super_admin.hotel.index', compact('hotels'));
    }

    public function create()
    {
        return view('auth.vendor.hotel.create');
    }


    public function store(Request $request)
    {
        // Prepare data array directly from the request inputs
        $data = $request->all();

        // Log the raw request data for debugging
        Log::debug('Request data:', $request->all());

        // Handle nearby_areas data
        if ($request->has('nearby_areas') && is_array($request->nearby_areas)) {
            $flatNearbyAreas = [];

            foreach ($request->nearby_areas as $category => $categoryData) {
                $names = $categoryData['name'] ?? [];
                $distances = $categoryData['distance'] ?? [];

                foreach ($names as $index => $name) {
                    $flatNearbyAreas[] = [
                        'category' => $category,
                        'name' => $name,
                        'distance' => $distances[$index] ?? null,
                    ];
                }
            }

            $data['nearby_areas'] = json_encode($flatNearbyAreas);
        }

        // Handle hotel_facilities data
        if ($request->has('hotel_facilities') && is_array($request->hotel_facilities)) {
            $flatHotelFacilities = [];
            Log::debug('Processing hotel_facilities:', $request->hotel_facilities);

            foreach ($request->hotel_facilities as $category => $facilityNames) {
                if (is_array($facilityNames)) {
                    foreach ($facilityNames as $facility) {
                        if (!empty($facility)) {
                            $flatHotelFacilities[] = [
                                'category' => $category,
                                'name' => $facility,
                            ];
                        }
                    }
                }
            }

            Log::debug('Processed hotel_facilities:', $flatHotelFacilities);

            $data['hotel_facilities'] = !empty($flatHotelFacilities)
                ? json_encode($flatHotelFacilities)
                : null;
        }

        // ✅ Handle custom_nearby_areas
        if ($request->has('custom_nearby_areas') && is_array($request->custom_nearby_areas)) {
            $customAreas = array_filter($request->custom_nearby_areas, function ($area) {
                return !empty($area);
            });

            $data['custom_nearby_areas'] = !empty($customAreas)
                ? json_encode(array_values($customAreas))
                : null;
        }

        // ✅ Merge check_in_rules[] and custom_check_in_rules[]
        $checkInRules = $request->check_in_rules ?? [];
        $customRules = $request->custom_check_in_rules ?? [];

        $customRules = array_filter($customRules, function ($val) {
            return !empty(trim($val));
        });

        $mergedCheckinRules = array_merge($checkInRules, $customRules);

        $data['check_in_rules'] = !empty($mergedCheckinRules)
            ? json_encode(array_values($mergedCheckinRules))
            : null;

        // Handle file uploads
        $photoFields = [
            'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
            'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos',
            'gym_photos', 'security_photos', 'amenities_photos', 'custom_facilities_icon',
        ];

        foreach ($photoFields as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('hotel_photos', 'public');
                        $paths[] = $path;
                    }
                }
                $data[$field] = !empty($paths) ? json_encode($paths) : null;
            } else {
                $data[$field] = null;
            }
        }

        // Add vendor_id
        $data['vendor_id'] = auth()->user()->id;

        // Log data for debugging before insertion
        Log::debug('Final data to be saved:', $data);

        try {
            // Create hotel record in the database
            Hotel::create($data);
        } catch (\Exception $e) {
            // Log the error if hotel record creation fails
            Log::error('Error creating hotel record: ' . $e->getMessage(), ['data' => $data]);
            throw $e;
        }

        // Redirect based on the status
        if ($request->status === 'submitted') {
            return redirect()->route('vendor-admin.hotel.index')->with('success', 'Hotel submitted successfully!');
        } else {
            return redirect()->route('vendor-admin.hotel.index')->with('success', 'Hotel Info Saved as Draft!');
        }
    }


    public function edit(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.edit', compact('hotel','hotelFacilities'));
    }


    public function partOne1(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        $hotelFacilities = json_decode($hotel->hotel_facilities, true);
        return view('auth.vendor.hotel.part.partOne1', compact('hotel','hotelFacilities'));
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
        return view('auth.vendor.hotel.show', compact('hotel','hotelFacilities'));
    }

    public function editSuper(Hotel $hotel)
    {
        return view('auth.super_admin.hotel.edit', compact('hotel'));
    }



    public function update(Request $request, Hotel $hotel)
    {
        // 1) Validate
        $validated = $request->validate([
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
            'facilities'                => 'nullable|array',
            'custom_facilities'         => 'nullable|array',
            'custom_facilities_icon.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nearby_areas'              => 'nullable|array',
            'custom_nearby_areas'       => 'nullable|array',
            'status'                    => 'required|in:draft,submitted',
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
        ]);

        $data = collect($validated)->filter(function ($value) {
            return !is_null($value) && $value !== [] && $value !== '';
        })->toArray();

        // Merge and clean check_in_rules
        $check = $request->input('check_in_rules', []);
        $custom = array_filter($request->input('custom_check_in_rules', []), fn($v) => trim($v) !== '');
        $mergedCheck = array_values(array_merge($check, $custom));
        if (!empty($mergedCheck)) {
            $data['check_in_rules'] = json_encode($mergedCheck);
        }

        // Flatten hotel_facilities
        if ($request->filled('hotel_facilities')) {
            $flatHF = [];
            foreach ($request->hotel_facilities as $cat => $names) {
                foreach ($names as $n) {
                    if (trim($n) !== '') {
                        $flatHF[] = ['category' => $cat, 'name' => $n];
                    }
                }
            }
            if (!empty($flatHF)) {
                $data['hotel_facilities'] = json_encode($flatHF);
            }
        }

        // custom_nearby_areas
        $ca = array_filter($request->input('custom_nearby_areas', []), fn($v) => trim($v) !== '');
        if (!empty($ca)) {
            $data['custom_nearby_areas'] = json_encode(array_values($ca));
        }

        // Handle custom_facilities_icon (remove + upload)
        $existingIcons = is_string($hotel->custom_facilities_icon)
            ? json_decode($hotel->custom_facilities_icon, true) ?? []
            : ($hotel->custom_facilities_icon ?? []);
        $existingIcons = is_array($existingIcons) ? $existingIcons : [];

        foreach (explode(',', $request->input('removed_custom_facilities_icon', '')) as $idx) {
            if (isset($existingIcons[$idx])) {
                \Storage::disk('public')->delete($existingIcons[$idx]);
                unset($existingIcons[$idx]);
            }
        }

        $keep = array_values($existingIcons);
        if ($request->hasFile('custom_facilities_icon')) {
            foreach ($request->file('custom_facilities_icon') as $file) {
                if ($file->isValid()) {
                    $keep[] = $file->store('hotel_photos', 'public');
                }
            }
        }

        if (!empty($keep)) {
            $data['custom_facilities_icon'] = json_encode($keep);
        }

        // Handle photo fields (remove + upload)
        $photoFields = [
            'kitchen_photos', 'washroom_photos', 'parking_lot_photos',
            'entrance_gate_photos', 'lift_stairs_photos', 'spa_photos',
            'bar_photos', 'transport_photos', 'rooftop_photos',
            'gym_photos', 'security_photos', 'amenities_photos'
        ];

        foreach ($photoFields as $f) {
            $existing = is_string($hotel->$f) ? json_decode($hotel->$f, true) ?? [] : $hotel->$f;
            $existing = is_array($existing) ? $existing : [];

            // Remove selected images
            $removedIndexes = array_filter(explode(',', $request->input('removed_' . $f, '')));
            foreach ($removedIndexes as $index) {
                if (isset($existing[$index])) {
                    \Storage::disk('public')->delete($existing[$index]);
                    unset($existing[$index]);
                }
            }

            $existing = array_values($existing); // Reindex
            $new = [];

            // Handle uploads
            if ($request->hasFile($f)) {
                foreach ($request->file($f) as $file) {
                    if ($file->isValid()) {
                        $new[] = $file->store('hotel_photos', 'public');
                    }
                }
            }

            $all = array_merge($existing, $new);
            $data[$f] = !empty($all) ? json_encode($all) : json_encode([]);
        }

        // Always keep vendor_id
        $data['vendor_id'] = $hotel->vendor_id;

        // Update and redirect
        $hotel->update($data);

        return redirect()
            ->route('vendor-admin.hotel.index')
            ->with('success', $request->status === 'draft'
                ? 'Hotel saved as draft successfully.'
                : 'Hotel updated successfully.'
            );
    }


    public function updateSuper(Request $request, Hotel $hotel)
    {




        // Validation rules
        $validated = $request->validate([
            'status' => 'required|in:draft,submitted',
            'description' => 'nullable|string',
            'pets_allowed' => 'nullable|in:yes,no',
            'pets_details' => 'nullable|string',
            'events_allowed' => 'nullable|in:yes,no',
            'events_details' => 'nullable|string',
            'smoking_allowed' => 'nullable|in:yes,no',
            'smoking_details' => 'nullable|string',
            'quiet_hours' => 'nullable|string',
            'photography_allowed' => 'nullable|in:yes,no',
            'photography_details' => 'nullable|string',
            'check_in_window' => 'nullable|string',
            'check_out_time' => 'nullable|string',
            'food_laundry' => 'nullable|in:yes,no',
            'check_in_rules' => 'nullable|array',
            'check_in_rules.*' => 'nullable|string',
            'custom_check_in_rules' => 'nullable|array',
            'custom_check_in_rules.*' => 'nullable|string',
            'property_info' => 'nullable|array',
            'property_info.*' => 'nullable|string',
            'custom_property_info' => 'nullable|array',
            'custom_property_info.*' => 'nullable|string',
            'age_restriction' => 'nullable|in:yes,no',
            'age_restriction_details' => 'nullable|string',
            'vlogging_allowed' => 'nullable|in:yes,no',
            'vlogging_details' => 'nullable|string',
            'child_policy' => 'nullable|string',
            'extra_bed_policy' => 'nullable|string',
            'cooking_policy' => 'nullable|string',
            'directions' => 'nullable|string',
            'additional_policy' => 'nullable|string',
            'check_in_methods' => 'nullable|array',
            'check_in_methods.*' => 'nullable|string',
            'custom_check_in_methods' => 'nullable|array',
            'custom_check_in_methods.*' => 'nullable|string',
            'cancellation_policies' => 'nullable|array',
            'cancellation_policies.*' => 'nullable|string',
            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string',
            'facility_category' => 'nullable|string',
            'custom_facilities' => 'nullable|array',
            'custom_facilities.*' => 'nullable|string',
            'nearby_areas' => 'nullable|array',
            'nearby_areas.*' => 'nullable|string',
            'custom_nearby_areas' => 'nullable|array',
            'custom_nearby_areas.*' => 'nullable|string',
            'nearby_area_category' => 'nullable|string',
            'custom_nearby_area_details' => 'nullable|array',
            'custom_nearby_area_details.*' => 'nullable|string',
            'kitchen_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'washroom_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parking_lot_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'entrance_gate_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lift_stairs_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'spa_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bar_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'transport_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rooftop_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gym_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'security_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'removed_kitchen_photos' => 'nullable|string',
            'removed_washroom_photos' => 'nullable|string',
            'removed_parking_lot_photos' => 'nullable|string',
            'removed_entrance_gate_photos' => 'nullable|string',
            'removed_lift_stairs_photos' => 'nullable|string',
            'removed_spa_photos' => 'nullable|string',
            'removed_bar_photos' => 'nullable|string',
            'removed_transport_photos' => 'nullable|string',
            'removed_rooftop_photos' => 'nullable|string',
            'removed_gym_photos' => 'nullable|string',
            'removed_security_photos' => 'nullable|string',
            'removed_amenities_photos' => 'nullable|string',
        ]);

        // Prepare data array with validated inputs
        $data = $validated;

        // Filter out empty values from array fields
        $arrayFields = [
            'check_in_rules', 'custom_check_in_rules', 'property_info', 'custom_property_info',
            'check_in_methods', 'custom_check_in_methods', 'cancellation_policies', 'facilities',
            'custom_facilities', 'nearby_areas', 'custom_nearby_areas', 'custom_nearby_area_details',
        ];
        foreach ($arrayFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                $data[$field] = array_filter($data[$field], function ($value) {
                    return !empty(trim($value));
                });
                $data[$field] = array_values($data[$field]); // Reindex array
            }
        }

        // Define photo fields
        $photoFields = [
            'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
            'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos',
            'gym_photos', 'security_photos', 'amenities_photos',
        ];

        // Handle photo updates
        foreach ($photoFields as $field) {
            // Ensure $existingPhotos is an array, decoding JSON if necessary
            $existingPhotos = $hotel->$field;
            if (is_string($existingPhotos)) {
                $existingPhotos = json_decode($existingPhotos, true) ?? [];
            } elseif (!is_array($existingPhotos)) {
                $existingPhotos = [];
            }

            $removedKey = "removed_{$field}";
            $removedIndices = $request->input($removedKey) ? explode(',', $request->input($removedKey)) : [];

            // Filter out removed photos from existing ones
            $updatedPhotos = array_filter($existingPhotos, function ($photo, $index) use ($removedIndices) {
                return !in_array((string)$index, $removedIndices);
            }, ARRAY_FILTER_USE_BOTH);

            // Reindex the array after filtering
            $updatedPhotos = array_values($updatedPhotos);

            // Handle new uploads
            if ($request->hasFile($field)) {
                $newPaths = [];
                foreach ($request->file($field) as $file) {
                    $path = $file->store('hotel_photos', 'public');
                    $newPaths[] = $path;
                }
                // Append new photos to existing ones instead of replacing
                $data[$field] = array_merge($updatedPhotos, $newPaths);
            } else {
                // Keep the filtered existing photos if no new uploads
                $data[$field] = $updatedPhotos;
            }
        }

        try {

            $data['approve'] = $request->has('approve') && $request->input('approve') == 1 ? 1 : 0;

            // Update the hotel record
            $hotel->update($data);

            // Redirect based on status
            if ($request->status === 'submitted') {
                return redirect()->route('super-admin.hotel.index')->with('success', 'Hotel updated successfully!');
            } else {
                return redirect()->route('super-admin.hotel.index')->with('success', 'Hotel draft updated!');
            }
        } catch (\Exception $e) {
            Log::error('Hotel update failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while updating the hotel.')->withInput();
        }
    }


    public function toggleApprove(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->approve = $request->approve == 1 ? 1 : 0;
        $hotel->save();

        return response()->json(['success' => true]);
    }


    public function destroy(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }

        try {
            // Delete associated photos
            $photoFields = [
                'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
                'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos',
                'gym_photos', 'security_photos', 'amenities_photos',
            ];
            foreach ($photoFields as $field) {
                if ($hotel->$field) {
                    foreach ($hotel->$field as $path) {
                        Storage::disk('public')->delete($path);
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
