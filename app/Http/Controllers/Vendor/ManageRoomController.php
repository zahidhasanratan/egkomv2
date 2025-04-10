<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomPhoto;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

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

        // Fetch rooms with pagination (e.g., 10 rooms per page)
        $roomList = Room::where('hotel_id', $hotel->id)->paginate(10);

        return view('auth.vendor.room.index', [
            'hotel' => $hotel,
            'roomList' => $roomList
        ]);
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
            'appliances.*' => 'in:AC,TV,Fridge,Microwave,Fan,Lamp,Light,Water heater/Geyser,WiFi Router,Crockeries,Gas Stove,Electric Kettle,Room Heater,Hair Dryer',
            'furniture' => 'nullable|array',
            'amenities' => 'nullable|array',
            'custom_appliances' => 'nullable|array',
            'custom_appliances.*' => 'nullable|string|max:255',
            'custom_furniture' => 'nullable|array', // Added validation
            'custom_furniture.*' => 'nullable|string|max:255', // Added validation
            'custom_amenities' => 'nullable|array', // Added validation
            'custom_amenities.*' => 'nullable|string|max:255', // Added validation
            'cancellation_policies' => 'nullable|array',
            'cancellation_policies.*' => 'in:flexible,non_refundable,partially_refundable,long_term',
            'is_active' => 'boolean',
            'save_draft' => 'nullable|in:1',
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
        $appliances = array_unique(array_filter(array_merge($request->appliances ?? [], $request->custom_appliances ?? [])));
        $furniture = array_unique(array_filter(array_merge($request->furniture ?? [], $request->custom_furniture ?? []))); // Added array_unique and array_filter for consistency
        $amenities = array_unique(array_filter(array_merge($request->amenities ?? [], $request->custom_amenities ?? []))); // Added array_unique and array_filter for consistency

        // Determine status based on save_draft
        $status = $request->has('save_draft') && $request->save_draft == '1' ? 'draft' : 'published';

        // Create the room
        $room = Room::create([
            'hotel_id' => $request->hotel_id,
            'name' => $request->name,
            'number' => $request->number,
            'floor_number' => $request->floor_number,
            'price_per_night' => $request->price_per_night,
            'weekend_price' => $request->weekend_price,
            'holiday_price' => $request->holiday_price,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'discount_percentage' => $request->discount_percentage,
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
            'cancellation_policies' => json_encode($request->cancellation_policies ?? []),
            'is_active' => $request->boolean('is_active', false),
            'status' => $status,
        ]);

        // Handle photo uploads with debugging
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

        \Log::info('Starting photo upload process', ['request_files' => $request->allFiles()]);

        foreach ($photoCategories as $inputName => $category) {
            if ($request->hasFile($inputName)) {
                \Log::info("Processing files for: $inputName", ['files' => $request->file($inputName)]);
                foreach ($request->file($inputName) as $index => $photo) {
                    try {
                        if ($photo->isValid()) {
                            $path = $photo->store('room_photos', 'public');
                            \Log::info("File stored successfully", ['input' => $inputName, 'index' => $index, 'path' => $path]);
                            RoomPhoto::create([
                                'room_id' => $room->id,
                                'photo_path' => $path,
                                'category' => $category,
                            ]);
                        } else {
                            \Log::warning("Invalid file detected", ['input' => $inputName, 'index' => $index]);
                        }
                    } catch (\Exception $e) {
                        \Log::error("Error processing file for $inputName", ['index' => $index, 'error' => $e->getMessage()]);
                    }
                }
            } else {
                \Log::info("No files uploaded for: $inputName");
            }
        }

        return redirect()->route('vendor-admin.room.index', ['id' => Crypt::encrypt($request->hotel_id)])->with('success', 'Room saved successfully!');
    }
}
