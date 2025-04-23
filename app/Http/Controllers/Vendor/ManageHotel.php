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
            Log::debug('Processing hotel_facilities:', $request->hotel_facilities);  // Log for debugging

            foreach ($request->hotel_facilities as $category => $facilityNames) {
                // Check if the category's facilities are an array (to handle the structure)
                if (is_array($facilityNames)) {
                    foreach ($facilityNames as $facility) {
                        if (!empty($facility)) {
                            $flatHotelFacilities[] = [
                                'category' => $category,  // Using the category as the field
                                'name' => $facility,      // Facility name in each category
                            ];
                        }
                    }
                }
            }

            // Log the processed facilities
            Log::debug('Processed hotel_facilities:', $flatHotelFacilities);

            // Only encode if we have any valid facilities
            if (!empty($flatHotelFacilities)) {
                $data['hotel_facilities'] = json_encode($flatHotelFacilities);
            } else {
                $data['hotel_facilities'] = null;  // If no valid facilities, set it to null
            }
        }

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
        return view('auth.vendor.hotel.edit', compact('hotel'));
    }

    public function editSuper(Hotel $hotel)
    {
        return view('auth.super_admin.hotel.edit', compact('hotel'));
    }


    public function update(Request $request, Hotel $hotel)
    {
        // Validate the request
        $validated = $request->validate([
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
            'check_in_rules.*' => 'string',
            'custom_check_in_rules' => 'nullable|array',
            'custom_check_in_rules.*' => 'nullable|string',
            'property_info' => 'nullable|array',
            'property_info.*' => 'string',
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
            'check_in_methods.*' => 'string',
            'custom_check_in_methods' => 'nullable|array',
            'custom_check_in_methods.*' => 'nullable|string',
            'cancellation_policies' => 'nullable|array',
            'cancellation_policies.*' => 'string',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string',
            'custom_facilities' => 'nullable|array',
            'custom_facilities.*' => 'nullable|string',
            'custom_facilities_icon.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facility_category' => 'nullable|string',
            'nearby_areas' => 'nullable|array',
            'nearby_areas.*' => 'string',
            'custom_nearby_areas' => 'nullable|array',
            'custom_nearby_areas.*' => 'nullable|string',
            'nearby_area_category' => 'nullable|string',
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
            'status' => 'required|in:submitted,draft',
        ]);

        // Initialize data array
        $data = $validated;

        // Handle custom facilities icons
        $existingIcons = $hotel->custom_facilities_icon ?? [];
        $newIcons = [];
        $removedIcons = $request->filled('removed_custom_facilities_icon')
            ? array_filter(explode(',', $request->input('removed_custom_facilities_icon')), 'is_numeric')
            : [];

        // Delete removed icons
        foreach ($removedIcons as $index) {
            if (isset($existingIcons[$index])) {
                Storage::disk('public')->delete($existingIcons[$index]);
                unset($existingIcons[$index]);
            }
        }

        // Handle new custom facility icons
        if ($request->hasFile('custom_facilities_icon')) {
            foreach ($request->file('custom_facilities_icon') as $index => $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('hotel_facilities', 'public');
                    $newIcons[$index] = $path;
                } else {
                    $newIcons[$index] = $existingIcons[$index] ?? null;
                }
            }
        }

        // Merge existing and new icons
        $data['custom_facilities_icon'] = array_values(array_filter(array_replace($existingIcons, $newIcons)));

        // Handle photo fields
        $photoFields = [
            'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
            'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos',
            'rooftop_photos', 'gym_photos', 'security_photos', 'amenities_photos'
        ];

        foreach ($photoFields as $field) {
            $existingPhotos = $hotel->$field ?? [];
            if (!is_array($existingPhotos)) {
                $existingPhotos = is_string($existingPhotos) && !empty($existingPhotos)
                    ? json_decode($existingPhotos, true) ?? [$existingPhotos]
                    : [];
            }
            $newPhotos = [];
            $removedPhotos = $request->filled("removed_{$field}")
                ? array_filter(explode(',', $request->input("removed_{$field}")), 'is_numeric')
                : [];

            // Delete removed photos
            foreach ($removedPhotos as $index) {
                if (isset($existingPhotos[$index])) {
                    Storage::disk('public')->delete($existingPhotos[$index]);
                    unset($existingPhotos[$index]);
                }
            }
            $existingPhotos = array_values($existingPhotos);

            // Handle new uploads
            if ($request->hasFile($field)) {
                foreach ($request->file($field) as $file) {
                    if ($file && $file->isValid()) {
                        $path = $file->store('hotel_photos', 'public');
                        $newPhotos[] = $path;
                    }
                }
            }

            // Merge existing and new photos
            $data[$field] = array_merge($existingPhotos, $newPhotos);
        }

        // Handle facilities with categories
        if ($request->has('facilities') && is_array($request->input('facilities'))) {
            $facilities = [];
            if (isset($request->input('facilities')[$request->input('facility_category')])) {
                $category = $request->input('facility_category');
                $facilities[$category] = array_filter($request->input('facilities')[$category], fn($item) => !empty($item));
            }
            // Include checkbox facilities
            if (isset($request->input('facilities')['most_popular'])) {
                $facilities['most_popular'] = array_filter($request->input('facilities')['most_popular'], fn($item) => !empty($item));
            }
            $data['facilities'] = !empty($facilities) ? $facilities : $hotel->facilities ?? [];
        }

        // Handle nearby areas with categories
        if ($request->has('nearby_areas') && is_array($request->input('nearby_areas'))) {
            $nearbyAreas = [];
            $category = $request->input('nearby_area_category');
            if (isset($request->input('nearby_areas')[$category]) && is_array($request->input('nearby_areas')[$category])) {
                $categoryData = $request->input('nearby_areas')[$category];
                if (isset($categoryData['name']) && isset($categoryData['distance'])) {
                    foreach ($categoryData['name'] as $index => $name) {
                        if (!empty($name) && isset($categoryData['distance'][$index]) && !empty($categoryData['distance'][$index])) {
                            $nearbyAreas[$category]['name'][] = $name;
                            $nearbyAreas[$category]['distance'][] = $categoryData['distance'][$index];
                        }
                    }
                }
            }
            // Include checkbox nearby areas
            if (isset($request->input('nearby_areas')['most_popular'])) {
                $nearbyAreas['most_popular'] = array_filter($request->input('nearby_areas')['most_popular'], fn($item) => !empty($item));
            }
            $data['nearby_areas'] = !empty($nearbyAreas) ? $nearbyAreas : $hotel->nearby_areas ?? [];
        }

        // Filter out empty custom fields
        $arrayFields = [
            'custom_check_in_rules', 'custom_property_info', 'custom_check_in_methods',
            'custom_facilities', 'custom_nearby_areas'
        ];

        foreach ($arrayFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                $data[$field] = array_filter($data[$field], fn($item) => !empty($item));
                $data[$field] = !empty($data[$field]) ? array_values($data[$field]) : [];
            }
        }

        // Update the hotel
        $hotel->update($data);

        // Redirect based on status
        $message = $request->status === 'draft' ? 'Hotel saved as draft successfully.' : 'Hotel updated successfully.';
        return redirect()->route('vendor-admin.hotel.index')->with('success', $message);
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
