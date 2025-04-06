<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function create()
    {
        return view('auth.vendor.hotel.create');
    }

    public function store(Request $request)
    {
        // Validation rules for all fields
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

            // New fields from updated JavaScript
            'property_types' => 'nullable|array',
            'property_types.*' => 'nullable|string',
            'apartments' => 'nullable|array',
            'apartments.*.name' => 'nullable|string',
            'apartments.*.number' => 'nullable|string',
            'apartments.*.floor' => 'nullable|string',

            // File uploads
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
        ]);

        // Prepare data array with validated inputs
        $data = $validated;

        // Handle file uploads
        $photoFields = [
            'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
            'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos',
            'gym_photos', 'security_photos', 'amenities_photos',
        ];

        foreach ($photoFields as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $path = $file->store('hotel_photos', 'public');
                    $paths[] = $path;
                }
                $data[$field] = json_encode($paths); // Store as JSON
            }
            // No need to explicitly set to null; database will handle it if column is nullable
        }

        // Add vendor_id
        $data['vendor_id'] = auth()->user()->id;

        // Debugging (optional, remove in production)
        // dd($data);

        // Insert new hotel record
        Hotel::create($data);

        // Redirect based on status
        if ($request->status === 'submitted') {
            return redirect()->route('vendor-admin.hotel.index')->with('success', 'Hotel submitted successfully!');
        } else {
//            return redirect()->back()->with('success', 'Hotel saved as draft!');
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


    public function update(Request $request, Hotel $hotel)
    {
        // Ensure the authenticated vendor owns the hotel
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }

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
                // Delete old photos that are still in storage but not removed explicitly
                foreach ($updatedPhotos as $oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }
                $newPaths = [];
                foreach ($request->file($field) as $file) {
                    $path = $file->store('hotel_photos', 'public');
                    $newPaths[] = $path;
                }
                $data[$field] = $newPaths; // Replace with new photos
            } else {
                // Keep the filtered existing photos if no new uploads
                $data[$field] = $updatedPhotos;
            }
        }

        try {
            // Update the hotel record
            $hotel->update($data);

            // Redirect based on status
            if ($request->status === 'submitted') {
                return redirect()->route('vendor-admin.hotel.index')->with('success', 'Hotel updated successfully!');
            } else {
                return redirect()->route('vendor-admin.hotel.index')->with('success', 'Hotel draft updated!');
            }
        } catch (\Exception $e) {
            Log::error('Hotel update failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while updating the hotel.')->withInput();
        }
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
