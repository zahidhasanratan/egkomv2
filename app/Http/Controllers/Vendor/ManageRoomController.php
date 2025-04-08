<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ManageRoomController extends Controller
{
    public function index($id)
    {
        try {
            $hotelId = Crypt::decrypt($id);
            $hotel = Hotel::where('id', $hotelId)->firstOrFail(); // Throws 404 if not found
        } catch (DecryptException $e) {
            abort(404, 'Invalid hotel ID');
        }

        return view('auth.vendor.room.index', ['hotel' => $hotel]);
    }
    public function create($id){
        $hotelId = Crypt::decrypt($id);
        return view('auth.vendor.room.create',['hotel'=>$hotelId]);
    }
    public function store(Request $request)
    {

        // Validation rules based on the form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer',
            'floor_number' => 'required|integer',
            'price_per_night' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'holiday_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'discount_amount' => 'nullable|numeric|min:0|required_if:discount_type,amount',
            'discount_percentage' => 'nullable|numeric|min:0|max:100|required_if:discount_type,percentage',
            'total_persons' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'size' => 'required|numeric|min:0',
            'total_rooms' => 'required|integer|min:0',
            'total_washrooms' => 'required|integer|min:0',
            'total_beds' => 'required|integer|min:0',
            'wifi_details' => 'nullable|string|max:255',
            'appliances' => 'nullable|array',
            'furniture' => 'nullable|array',
            'amenities' => 'nullable|array',
            'custom_appliances' => 'nullable|array', // Assuming "Add More" for appliances
            'custom_furniture' => 'nullable|array',  // Assuming "Add More" for furniture
            'custom_amenities' => 'nullable|array',  // Assuming "Add More" for amenities
            'cancellation_policies' => 'nullable|array',
            'cancellation_policies.*' => 'in:flexible,non_refundable,partially_refundable,long_term',
            'is_active' => 'boolean',
            'save_draft' => 'nullable|in:1', // To detect draft button
            'kitchen_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'washroom_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parking_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'entrance_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'accessibility_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'spa_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bar_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'transport_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rooftop_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'recreation_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'safety_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenity_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Merge custom fields with predefined ones
        $appliances = array_merge($request->appliances ?? [], $request->custom_appliances ?? []);
        $furniture = array_merge($request->furniture ?? [], $request->custom_furniture ?? []);
        $amenities = array_merge($request->amenities ?? [], $request->custom_amenities ?? []);

        // Determine status based on save_draft
        $status = $request->has('save_draft') && $request->save_draft == '1' ? 'draft' : 'published';

        // Create the room
        $room = Room::create([
            'hotel_id' => $request->hotel_id, // Must be provided elsewhere (e.g., session)
            'name' => $request->name,
            'number' => $request->number,
            'floor_number' => $request->floor_number,
            'price_per_night' => $request->price_per_night,
            'weekend_price' => $request->weekend_price,
            'holiday_price' => $request->holiday_price,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount, // Store as-is
            'discount_percentage' => $request->discount_percentage, // Store as-is
            'total_persons' => $request->total_persons,
            'description' => $request->description,
            'size' => $request->size,
            'total_rooms' => $request->total_rooms,
            'total_washrooms' => $request->total_washrooms,
            'total_beds' => $request->total_beds,
            'wifi_details' => $request->wifi_details,
            'appliances' => json_encode($appliances),
            'furniture' => json_encode($furniture),
            'amenities' => json_encode($amenities),
            'cancellation_policies' => json_encode($request->cancellation_policies ?? []), // Changed to match form
            'is_active' => $request->boolean('is_active', false),
            'status' => $status,
        ]);

        // Handle photo uploads
        $photoCategories = [
            'kitchen_photos' => 'kitchen',
            'washroom_photos' => 'washroom',
            'parking_photos' => 'parking',
            'entrance_photos' => 'entrance',
            'accessibility_photos' => 'accessibility',
            'spa_photos' => 'spa',
            'bar_photos' => 'bar',
            'transport_photos' => 'transport',
            'rooftop_photos' => 'rooftop',
            'recreation_photos' => 'recreation',
            'safety_photos' => 'safety',
            'amenity_photos' => 'amenity',
        ];

        foreach ($photoCategories as $inputName => $category) {
            if ($request->hasFile($inputName)) {
                foreach ($request->file($inputName) as $photo) {
                    $path = $photo->store('room_photos', 'public');
                    RoomPhoto::create([
                        'room_id' => $room->id,
                        'photo_path' => $path,
                        'category' => $category,
                    ]);
                }
            }
        }

//        return redirect()->back()->with('success', 'Room saved successfully!');
        return redirect()->route('vendor-admin.room.index', ['id' => Crypt::encrypt($request->hotel_id)])->with('success', 'Room saved successfully!');
    }
}
