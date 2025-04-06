<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Validation rules
        $validated = $request->validate([
            'status' => 'required|in:draft,submitted',
        ]);


        // Handle file uploads
        $photoFields = [
            'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
            'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos',
            'gym_photos', 'security_photos', 'amenities_photos',
        ];

        $data = $validated;
        foreach ($photoFields as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $path = $file->store('hotel_photos', 'public');
                    $paths[] = $path;
                }
                $data[$field] = $paths;
            } else {
                $data[$field] = null;
            }
        }

        // Add vendor_id
        $data['vendor_id'] = auth()->user()->id; // Adjust if using a custom guard

        // Create or update the hotel
        $hotel = Hotel::updateOrCreate(
            ['vendor_id' => $data['vendor_id']], // Unique by vendor_id only
            $data
        );

        // Redirect based on status
        if ($request->status === 'submitted') {
            return redirect()->route('vendor-admin.hotel.index')->with('success', 'Hotel submitted successfully!');
        } else {
            return redirect()->back()->with('success', 'Hotel saved as draft!');
        }
    }
    public function edit(Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }
        return view('vendor_admin.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        if ($hotel->vendor_id !== auth()->user()->id) {
            return redirect()->route('vendor-admin.hotel.index')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'status' => 'required|in:draft,submitted',
            'kitchen_photos.*' => 'nullable|image|max:2048',
            'washroom_photos.*' => 'nullable|image|max:2048',
            'parking_lot_photos.*' => 'nullable|image|max:2048',
            'entrance_gate_photos.*' => 'nullable|image|max:2048',
            'lift_stairs_photos.*' => 'nullable|image|max:2048',
            'spa_photos.*' => 'nullable|image|max:2048',
            'bar_photos.*' => 'nullable|image|max:2048',
            'transport_photos.*' => 'nullable|image|max:2048',
            'rooftop_photos.*' => 'nullable|image|max:2048',
            'gym_photos.*' => 'nullable|image|max:2048',
            'security_photos.*' => 'nullable|image|max:2048',
            'amenities_photos.*' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['status'] = $request->input('status');

        $photoFields = [
            'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
            'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos',
            'gym_photos', 'security_photos', 'amenities_photos',
        ];

        foreach ($photoFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old photos if they exist
                if ($hotel->$field) {
                    foreach ($hotel->$field as $oldPath) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $path = $file->store('hotel_photos', 'public');
                    $paths[] = $path;
                }
                $data[$field] = $paths;
            }
        }

        try {
            $hotel->update($data);
        } catch (\Exception $e) {
            Log::error('Hotel update failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while updating the hotel.');
        }

        if ($request->status === 'submitted') {
            return redirect()->route('vendor-admin.hotel.index')->with('success', 'Hotel updated successfully!');
        } else {
            return redirect()->back()->with('success', 'Hotel draft updated!');
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
