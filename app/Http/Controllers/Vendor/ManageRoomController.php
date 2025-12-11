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
use Illuminate\Support\Facades\Storage;

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

        // Check if rooms exist, if not and apartment_count is set, create blank rooms
        $existingRoomsCount = Room::where('hotel_id', $hotel->id)->count();
        
        if ($existingRoomsCount == 0 && $hotel->apartment_count > 0) {
            // Create blank room entries based on apartment_count
            $blankRooms = [];
            for ($i = 1; $i <= $hotel->apartment_count; $i++) {
                $blankRooms[] = [
                    'hotel_id' => $hotel->id,
                    'name' => '', // Blank - user will fill this when editing
                    'number' => '', // Blank - user will fill this when editing
                    'floor_number' => '', // Blank - user will fill this when editing
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

        // Fetch rooms with pagination (e.g., 10 rooms per page)
        $roomList = Room::where('hotel_id', $hotel->id)->paginate(10);

        return view('auth.vendor.room.index', [
            'hotel' => $hotel,
            'roomList' => $roomList
        ]);
    }

    public function indexSuper($id)
    {
        try {
            $hotelId = Crypt::decrypt($id);
            $hotel = Hotel::where('id', $hotelId)->firstOrFail(); // Throws 404 if not found
        } catch (DecryptException $e) {
            abort(404, 'Invalid hotel ID');
        }

        // Check if rooms exist, if not and apartment_count is set, create blank rooms
        $existingRoomsCount = Room::where('hotel_id', $hotel->id)->count();
        
        if ($existingRoomsCount == 0 && $hotel->apartment_count > 0) {
            // Create blank room entries based on apartment_count
            $blankRooms = [];
            for ($i = 1; $i <= $hotel->apartment_count; $i++) {
                $blankRooms[] = [
                    'hotel_id' => $hotel->id,
                    'name' => '', // Blank - user will fill this when editing
                    'number' => '', // Blank - user will fill this when editing
                    'floor_number' => '', // Blank - user will fill this when editing
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
                Log::info('Created blank rooms for hotel (Super Admin)', [
                    'hotel_id' => $hotel->id,
                    'rooms_created' => count($blankRooms)
                ]);
            }
        }

        // Fetch rooms with pagination (e.g., 10 rooms per page)
        $roomList = Room::where('hotel_id', $hotel->id)->paginate(10);

        return view('auth.super_admin.room.index', [
            'hotel' => $hotel,
            'roomList' => $roomList
        ]);
    }

    public function create($id)
    {
        $hotelId = Crypt::decrypt($id);
        return view('auth.vendor.room.create', ['hotel' => $hotelId]);
    }

    public function createSuper($id)
    {
        $hotelId = Crypt::decrypt($id);
        return view('auth.super_admin.room.create', ['hotel' => $hotelId]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'floor_number' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'holiday_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'total_persons' => 'required|integer|min:1',
            'size' => 'required|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'total_washrooms' => 'required|integer|min:0',
            'total_beds' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'wifi_details' => 'nullable|string|max:255',
            'appliances' => 'nullable|array',
            'appliances.*' => 'nullable|string|max:255',
            'furniture' => 'nullable|array',
            'furniture.*' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'cancellation_policy' => 'nullable|array',
            'cancellation_policy.*' => 'nullable|string',
            'is_active' => 'nullable|in:0,1,true,false,on,off',
        ], [
            'hotel_id.required' => 'Hotel ID is required.',
            'hotel_id.exists' => 'Selected hotel does not exist.',
            'name.required' => 'Room name is required.',
            'name.max' => 'Room name must not exceed 255 characters.',
            'number.required' => 'Room number is required.',
            'number.max' => 'Room number must not exceed 255 characters.',
            'floor_number.required' => 'Floor number is required.',
            'floor_number.max' => 'Floor number must not exceed 255 characters.',
            'price_per_night.required' => 'Price per night is required.',
            'price_per_night.numeric' => 'Price per night must be a number.',
            'price_per_night.min' => 'Price per night must be at least 0.',
            'weekend_price.numeric' => 'Weekend price must be a number.',
            'weekend_price.min' => 'Weekend price must be at least 0.',
            'holiday_price.numeric' => 'Holiday price must be a number.',
            'holiday_price.min' => 'Holiday price must be at least 0.',
            'discount_type.in' => 'Discount type must be either amount or percentage.',
            'discount_value.numeric' => 'Discount value must be a number.',
            'discount_value.min' => 'Discount value must be at least 0.',
            'total_persons.required' => 'Total persons is required.',
            'total_persons.integer' => 'Total persons must be a whole number.',
            'total_persons.min' => 'Total persons must be at least 1.',
            'size.required' => 'Room size is required.',
            'size.numeric' => 'Room size must be a number.',
            'size.min' => 'Room size must be at least 0.',
            'total_rooms.required' => 'Total rooms is required.',
            'total_rooms.integer' => 'Total rooms must be a whole number.',
            'total_rooms.min' => 'Total rooms must be at least 1.',
            'total_washrooms.required' => 'Total washrooms is required.',
            'total_washrooms.integer' => 'Total washrooms must be a whole number.',
            'total_washrooms.min' => 'Total washrooms must be at least 0.',
            'total_beds.required' => 'Total beds is required.',
            'total_beds.integer' => 'Total beds must be a whole number.',
            'total_beds.min' => 'Total beds must be at least 0.',
        ]);

        Log::info('Received store request', [
            'raw_input' => $request->all(),
            'cancellation_policy' => $request->input('cancellation_policy', []),
        ]);

        // Merge standard and custom arrays, ensuring uniqueness and filtering out null/empty values
        $appliances = array_unique(array_filter(array_merge($request->appliances ?? [], $request->custom_appliances ?? [])));
        $furniture = array_unique(array_filter(array_merge($request->furniture ?? [], $request->custom_furniture ?? [])));
        $amenities = array_unique(array_filter(array_merge($request->amenities ?? [], $request->custom_amenities ?? [])));
        $cancellation_policy = array_unique(array_filter((array)$request->input('cancellation_policy', [])));

        // Process room information
        $roomInfo = [];
        if ($request->has('room_info')) {
            $roomInfoData = $request->input('room_info', []);
            
            // Store all room info fields
            $roomInfo = [
                'bedrooms' => $roomInfoData['bedrooms'] ?? null,
                'living' => $roomInfoData['living'] ?? null,
                'dining' => $roomInfoData['dining'] ?? null,
                'kitchen' => $roomInfoData['kitchen'] ?? null,
                'bathrooms' => $roomInfoData['bathrooms'] ?? null,
                'bed_type' => $roomInfoData['bed_type'] ?? null,
                'number_of_beds' => $roomInfoData['number_of_beds'] ?? null,
                'custom_bed_types' => array_filter($roomInfoData['custom_bed_types'] ?? []),
                'max_adults' => $roomInfoData['max_adults'] ?? null,
                'max_children' => $roomInfoData['max_children'] ?? null,
                'layout' => array_filter($roomInfoData['layout'] ?? []),
                'view' => array_filter($roomInfoData['view'] ?? []),
                'bathroom' => array_filter($roomInfoData['bathroom'] ?? []),
                'kitchen_facilities' => array_filter($roomInfoData['kitchen_facilities'] ?? []),
                'balcony' => $roomInfoData['balcony'] ?? null,
                'accessibility' => array_filter($roomInfoData['accessibility'] ?? []),
                'smoking_policy' => $roomInfoData['smoking_policy'] ?? null,
            ];
        }

        // Process additional room information
        $additionalInfo = [];
        if ($request->has('additional_info')) {
            $additionalInfoData = $request->input('additional_info', []);
            $additionalInfo = [
                'bed_fee_amount' => $additionalInfoData['bed_fee_amount'] ?? null,
                'bed_fee_currency' => $additionalInfoData['bed_fee_currency'] ?? null,
                'bed_fee_unit' => $additionalInfoData['bed_fee_unit'] ?? null,
                'children_free_age' => $additionalInfoData['children_free_age'] ?? null,
                'extra_adult_charge' => $additionalInfoData['extra_adult_charge'] ?? null,
                'laundry_fee_amount' => $additionalInfoData['laundry_fee_amount'] ?? null,
                'laundry_fee_currency' => $additionalInfoData['laundry_fee_currency'] ?? null,
                'laundry_fee_unit' => $additionalInfoData['laundry_fee_unit'] ?? null,
                'housekeeping_type' => $additionalInfoData['housekeeping_type'] ?? null,
                'checkin_time' => $additionalInfoData['checkin_time'] ?? null,
                'checkout_time' => $additionalInfoData['checkout_time'] ?? null,
                'late_checkout_fee' => $additionalInfoData['late_checkout_fee'] ?? null,
                'early_checkin_fee' => $additionalInfoData['early_checkin_fee'] ?? null,
                'security_deposit_amount' => $additionalInfoData['security_deposit_amount'] ?? null,
                'security_deposit_refundable' => $additionalInfoData['security_deposit_refundable'] ?? null,
                'parking_availability' => $additionalInfoData['parking_availability'] ?? null,
                'parking_fee_amount' => $additionalInfoData['parking_fee_amount'] ?? null,
                'parking_fee_unit' => $additionalInfoData['parking_fee_unit'] ?? null,
                'pet_policy' => $additionalInfoData['pet_policy'] ?? null,
                'pet_fee' => $additionalInfoData['pet_fee'] ?? null,
                'meal_options' => $additionalInfoData['meal_options'] ?? null,
                'meal_fee' => $additionalInfoData['meal_fee'] ?? null,
                'airport_pickup' => $additionalInfoData['airport_pickup'] ?? null,
                'airport_pickup_fee' => $additionalInfoData['airport_pickup_fee'] ?? null,
                'shuttle_service' => $additionalInfoData['shuttle_service'] ?? null,
                'shuttle_service_fee' => $additionalInfoData['shuttle_service_fee'] ?? null,
                'car_rental' => $additionalInfoData['car_rental'] ?? null,
                'car_rental_fee' => $additionalInfoData['car_rental_fee'] ?? null,
                'other_charges' => $additionalInfoData['other_charges'] ?? null,
            ];
        }

        // Merge room info and additional info into display_options
        $displayOptions = array_merge($roomInfo, ['additional_info' => $additionalInfo]);

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
            'discount_amount' => $request->discount_type == 'amount' ? $request->discount_value : null,
            'discount_percentage' => $request->discount_type == 'percentage' ? $request->discount_value : null,
            'total_persons' => $request->total_persons,
            'description' => $request->description,
            'size' => $request->size,
            'total_rooms' => $request->total_rooms,
            'total_washrooms' => $request->total_washrooms,
            'total_beds' => $request->total_beds,
            'wifi_details' => $request->wifi_details,
            'appliances' => $appliances,
            'furniture' => $furniture,
            'amenities' => $amenities,
            'cancellation_policy' => $cancellation_policy,
            'display_options' => $displayOptions, // Store room information and additional info in display_options
            'is_active' => $request->boolean('is_active', false),
            'status' => $status,
        ]);

        Log::info('Room created', [
            'room_id' => $room->id,
            'cancellation_policy' => $room->cancellation_policy,
            'discount_type' => $room->discount_type,
            'discount_amount' => $room->discount_amount,
            'discount_percentage' => $room->discount_percentage,
        ]);

        // Handle photo uploads
        $photoCategories = [
            'feature_photos' => 'feature',
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
                foreach ($request->file($inputName) as $index => $photo) {
                    try {
                        if ($photo->isValid()) {
                            $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                            $destinationPath = public_path('assets/room_photos');

                            // Ensure the directory exists
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0775, true);
                            }

                            $photo->move($destinationPath, $filename);

                            RoomPhoto::create([
                                'room_id' => $room->id,
                                'photo_path' => 'assets/room_photos/' . $filename,
                                'category' => $category,
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error("Error processing file for $inputName", [
                            'index' => $index,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('vendor-admin.room.index', ['id' => Crypt::encrypt($request->hotel_id)])
            ->with('success', 'Room created successfully!');
    }

    public function storeSuper(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'floor_number' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'holiday_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'total_persons' => 'required|integer|min:1',
            'size' => 'required|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'total_washrooms' => 'required|integer|min:0',
            'total_beds' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'wifi_details' => 'nullable|string|max:255',
            'appliances' => 'nullable|array',
            'appliances.*' => 'nullable|string|max:255',
            'furniture' => 'nullable|array',
            'furniture.*' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'cancellation_policy' => 'nullable|array',
            'cancellation_policy.*' => 'nullable|string',
            'is_active' => 'nullable|in:0,1,true,false,on,off',
        ], [
            'hotel_id.required' => 'Hotel ID is required.',
            'hotel_id.exists' => 'Selected hotel does not exist.',
            'name.required' => 'Room name is required.',
            'name.max' => 'Room name must not exceed 255 characters.',
            'number.required' => 'Room number is required.',
            'number.max' => 'Room number must not exceed 255 characters.',
            'floor_number.required' => 'Floor number is required.',
            'floor_number.max' => 'Floor number must not exceed 255 characters.',
            'price_per_night.required' => 'Price per night is required.',
            'price_per_night.numeric' => 'Price per night must be a number.',
            'price_per_night.min' => 'Price per night must be at least 0.',
            'weekend_price.numeric' => 'Weekend price must be a number.',
            'weekend_price.min' => 'Weekend price must be at least 0.',
            'holiday_price.numeric' => 'Holiday price must be a number.',
            'holiday_price.min' => 'Holiday price must be at least 0.',
            'discount_type.in' => 'Discount type must be either amount or percentage.',
            'discount_value.numeric' => 'Discount value must be a number.',
            'discount_value.min' => 'Discount value must be at least 0.',
            'total_persons.required' => 'Total persons is required.',
            'total_persons.integer' => 'Total persons must be a whole number.',
            'total_persons.min' => 'Total persons must be at least 1.',
            'size.required' => 'Room size is required.',
            'size.numeric' => 'Room size must be a number.',
            'size.min' => 'Room size must be at least 0.',
            'total_rooms.required' => 'Total rooms is required.',
            'total_rooms.integer' => 'Total rooms must be a whole number.',
            'total_rooms.min' => 'Total rooms must be at least 1.',
            'total_washrooms.required' => 'Total washrooms is required.',
            'total_washrooms.integer' => 'Total washrooms must be a whole number.',
            'total_washrooms.min' => 'Total washrooms must be at least 0.',
            'total_beds.required' => 'Total beds is required.',
            'total_beds.integer' => 'Total beds must be a whole number.',
            'total_beds.min' => 'Total beds must be at least 0.',
        ]);

        Log::info('Received store request from super admin', [
            'raw_input' => $request->all(),
            'cancellation_policy' => $request->input('cancellation_policy', []),
        ]);

        // Merge standard and custom arrays, ensuring uniqueness and filtering out null/empty values
        $appliances = array_unique(array_filter(array_merge($request->appliances ?? [], $request->custom_appliances ?? [])));
        $furniture = array_unique(array_filter(array_merge($request->furniture ?? [], $request->custom_furniture ?? [])));
        $amenities = array_unique(array_filter(array_merge($request->amenities ?? [], $request->custom_amenities ?? [])));
        $cancellation_policy = array_unique(array_filter((array)$request->input('cancellation_policy', [])));

        // Process room information
        $roomInfo = [];
        if ($request->has('room_info')) {
            $roomInfoData = $request->input('room_info', []);
            
            // Store all room info fields
            $roomInfo = [
                'bedrooms' => $roomInfoData['bedrooms'] ?? null,
                'living' => $roomInfoData['living'] ?? null,
                'dining' => $roomInfoData['dining'] ?? null,
                'kitchen' => $roomInfoData['kitchen'] ?? null,
                'bathrooms' => $roomInfoData['bathrooms'] ?? null,
                'bed_type' => $roomInfoData['bed_type'] ?? null,
                'number_of_beds' => $roomInfoData['number_of_beds'] ?? null,
                'custom_bed_types' => array_filter($roomInfoData['custom_bed_types'] ?? []),
                'max_adults' => $roomInfoData['max_adults'] ?? null,
                'max_children' => $roomInfoData['max_children'] ?? null,
                'layout' => array_filter($roomInfoData['layout'] ?? []),
                'view' => array_filter($roomInfoData['view'] ?? []),
                'bathroom' => array_filter($roomInfoData['bathroom'] ?? []),
                'kitchen_facilities' => array_filter($roomInfoData['kitchen_facilities'] ?? []),
                'balcony' => $roomInfoData['balcony'] ?? null,
                'accessibility' => array_filter($roomInfoData['accessibility'] ?? []),
                'smoking_policy' => $roomInfoData['smoking_policy'] ?? null,
            ];
        }

        // Process additional room information
        $additionalInfo = [];
        if ($request->has('additional_info')) {
            $additionalInfoData = $request->input('additional_info', []);
            $additionalInfo = [
                'bed_fee_amount' => $additionalInfoData['bed_fee_amount'] ?? null,
                'bed_fee_currency' => $additionalInfoData['bed_fee_currency'] ?? null,
                'bed_fee_unit' => $additionalInfoData['bed_fee_unit'] ?? null,
                'children_free_age' => $additionalInfoData['children_free_age'] ?? null,
                'extra_adult_charge' => $additionalInfoData['extra_adult_charge'] ?? null,
                'laundry_fee_amount' => $additionalInfoData['laundry_fee_amount'] ?? null,
                'laundry_fee_currency' => $additionalInfoData['laundry_fee_currency'] ?? null,
                'laundry_fee_unit' => $additionalInfoData['laundry_fee_unit'] ?? null,
                'housekeeping_type' => $additionalInfoData['housekeeping_type'] ?? null,
                'checkin_time' => $additionalInfoData['checkin_time'] ?? null,
                'checkout_time' => $additionalInfoData['checkout_time'] ?? null,
                'late_checkout_fee' => $additionalInfoData['late_checkout_fee'] ?? null,
                'early_checkin_fee' => $additionalInfoData['early_checkin_fee'] ?? null,
                'security_deposit_amount' => $additionalInfoData['security_deposit_amount'] ?? null,
                'security_deposit_refundable' => $additionalInfoData['security_deposit_refundable'] ?? null,
                'parking_availability' => $additionalInfoData['parking_availability'] ?? null,
                'parking_fee_amount' => $additionalInfoData['parking_fee_amount'] ?? null,
                'parking_fee_unit' => $additionalInfoData['parking_fee_unit'] ?? null,
                'pet_policy' => $additionalInfoData['pet_policy'] ?? null,
                'pet_fee' => $additionalInfoData['pet_fee'] ?? null,
                'meal_options' => $additionalInfoData['meal_options'] ?? null,
                'meal_fee' => $additionalInfoData['meal_fee'] ?? null,
                'airport_pickup' => $additionalInfoData['airport_pickup'] ?? null,
                'airport_pickup_fee' => $additionalInfoData['airport_pickup_fee'] ?? null,
                'shuttle_service' => $additionalInfoData['shuttle_service'] ?? null,
                'shuttle_service_fee' => $additionalInfoData['shuttle_service_fee'] ?? null,
                'car_rental' => $additionalInfoData['car_rental'] ?? null,
                'car_rental_fee' => $additionalInfoData['car_rental_fee'] ?? null,
                'other_charges' => $additionalInfoData['other_charges'] ?? null,
            ];
        }

        // Merge room info and additional info into display_options
        $displayOptions = array_merge($roomInfo, ['additional_info' => $additionalInfo]);

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
            'discount_amount' => $request->discount_type == 'amount' ? $request->discount_value : null,
            'discount_percentage' => $request->discount_type == 'percentage' ? $request->discount_value : null,
            'total_persons' => $request->total_persons,
            'description' => $request->description,
            'size' => $request->size,
            'total_rooms' => $request->total_rooms,
            'total_washrooms' => $request->total_washrooms,
            'total_beds' => $request->total_beds,
            'wifi_details' => $request->wifi_details,
            'appliances' => $appliances,
            'furniture' => $furniture,
            'amenities' => $amenities,
            'cancellation_policy' => $cancellation_policy,
            'display_options' => $displayOptions, // Store room information and additional info in display_options
            'is_active' => $request->boolean('is_active', false),
            'status' => $status,
        ]);

        Log::info('Room created by super admin', [
            'room_id' => $room->id,
            'cancellation_policy' => $room->cancellation_policy,
            'discount_type' => $room->discount_type,
            'discount_amount' => $room->discount_amount,
            'discount_percentage' => $room->discount_percentage,
        ]);

        // Handle photo uploads
        $photoCategories = [
            'feature_photos' => 'feature',
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
                foreach ($request->file($inputName) as $index => $photo) {
                    try {
                        if ($photo->isValid()) {
                            $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                            $destinationPath = public_path('assets/room_photos');

                            // Ensure the directory exists
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0775, true);
                            }

                            $photo->move($destinationPath, $filename);

                            RoomPhoto::create([
                                'room_id' => $room->id,
                                'photo_path' => 'assets/room_photos/' . $filename,
                                'category' => $category,
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error("Error processing file for $inputName", [
                            'index' => $index,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('super-admin.room.index', ['id' => Crypt::encrypt($request->hotel_id)])
            ->with('success', 'Room created successfully!');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        // Delete associated photos from storage and database
        foreach ($room->photos as $photo) {
            Storage::delete('public/photos/' . $photo->filename);
            $photo->delete();
        }

        // Delete the room
        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully.');
    }

    public function destroySuper($id)
    {
        $room = Room::findOrFail($id);

        // Delete associated photos from storage and database
        foreach ($room->photos as $photo) {
            if (file_exists(public_path($photo->photo_path))) {
                unlink(public_path($photo->photo_path));
            }
            $photo->delete();
        }

        // Delete the room
        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully.');
    }

    public function edit($id)
    {
        try {
            $roomId = $id;
            // Eager load photos so the edit view always sees the latest uploads
            $room = Room::with(['photos' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }])->findOrFail($roomId);
            $hotelId = $room->hotel_id;
            return view('auth.vendor.room.edit', ['room' => $room, 'hotel' => $hotelId]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            \Log::error("Decryption failed for ID: $id", ['error' => $e->getMessage()]);
            abort(404, 'Invalid or tampered room ID');
        }
    }


    public function editSuper($id)
    {
        try {
            $roomId = $id;
            // Eager load photos so the edit view always sees the latest uploads
            $room = Room::with(['photos' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }])->findOrFail($roomId);
            $hotelId = $room->hotel_id;
            return view('auth.super_admin.room.edit', ['room' => $room, 'hotel' => $hotelId]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            \Log::error("Decryption failed for ID: $id", ['error' => $e->getMessage()]);
            abort(404, 'Invalid or tampered room ID');
        }
    }



    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'floor_number' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'holiday_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'total_persons' => 'required|integer|min:1',
            'size' => 'required|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'total_washrooms' => 'required|integer|min:0',
            'total_beds' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'wifi_details' => 'nullable|string|max:255',
            'appliances' => 'nullable|array',
            'appliances.*' => 'nullable|string|max:255',
            'furniture' => 'nullable|array',
            'furniture.*' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'cancellation_policy' => 'nullable|array',
            'cancellation_policy.*' => 'nullable|string',
            'is_active' => 'nullable|in:0,1,true,false,on,off',
        ], [
            'hotel_id.required' => 'Hotel ID is required.',
            'hotel_id.exists' => 'Selected hotel does not exist.',
            'name.required' => 'Room name is required.',
            'name.max' => 'Room name must not exceed 255 characters.',
            'number.required' => 'Room number is required.',
            'number.max' => 'Room number must not exceed 255 characters.',
            'floor_number.required' => 'Floor number is required.',
            'floor_number.max' => 'Floor number must not exceed 255 characters.',
            'price_per_night.required' => 'Price per night is required.',
            'price_per_night.numeric' => 'Price per night must be a number.',
            'price_per_night.min' => 'Price per night must be at least 0.',
            'weekend_price.numeric' => 'Weekend price must be a number.',
            'weekend_price.min' => 'Weekend price must be at least 0.',
            'holiday_price.numeric' => 'Holiday price must be a number.',
            'holiday_price.min' => 'Holiday price must be at least 0.',
            'discount_type.in' => 'Discount type must be either amount or percentage.',
            'discount_value.numeric' => 'Discount value must be a number.',
            'discount_value.min' => 'Discount value must be at least 0.',
            'total_persons.required' => 'Total persons is required.',
            'total_persons.integer' => 'Total persons must be a whole number.',
            'total_persons.min' => 'Total persons must be at least 1.',
            'size.required' => 'Room size is required.',
            'size.numeric' => 'Room size must be a number.',
            'size.min' => 'Room size must be at least 0.',
            'total_rooms.required' => 'Total rooms is required.',
            'total_rooms.integer' => 'Total rooms must be a whole number.',
            'total_rooms.min' => 'Total rooms must be at least 1.',
            'total_washrooms.required' => 'Total washrooms is required.',
            'total_washrooms.integer' => 'Total washrooms must be a whole number.',
            'total_washrooms.min' => 'Total washrooms must be at least 0.',
            'total_beds.required' => 'Total beds is required.',
            'total_beds.integer' => 'Total beds must be a whole number.',
            'total_beds.min' => 'Total beds must be at least 0.',
        ]);

        Log::info('Received update request', [
            'room_id' => $id,
            'request_data' => $request->except(['_token', '_method']),
        ]);

        try {
            // Find the room
            $room = Room::findOrFail($id);

            // Merge standard and custom arrays, ensuring uniqueness and filtering out null/empty values
            $appliances = array_unique(array_filter(array_merge($request->appliances ?? [], $request->custom_appliances ?? [])));
            $furniture = array_unique(array_filter(array_merge($request->furniture ?? [], $request->custom_furniture ?? [])));
            $amenities = array_unique(array_filter(array_merge($request->amenities ?? [], $request->custom_amenities ?? [])));
            $cancellation_policy = array_unique(array_filter((array)$request->input('cancellation_policy', [])));

            // Process room information
            $roomInfo = [];
            if ($request->has('room_info')) {
                $roomInfoData = $request->input('room_info', []);
                
                // Store all room info fields
                $roomInfo = [
                    'bedrooms' => $roomInfoData['bedrooms'] ?? null,
                    'living' => $roomInfoData['living'] ?? null,
                    'dining' => $roomInfoData['dining'] ?? null,
                    'kitchen' => $roomInfoData['kitchen'] ?? null,
                    'bathrooms' => $roomInfoData['bathrooms'] ?? null,
                    'bed_type' => $roomInfoData['bed_type'] ?? null,
                    'number_of_beds' => $roomInfoData['number_of_beds'] ?? null,
                    'custom_bed_types' => array_filter($roomInfoData['custom_bed_types'] ?? []),
                    'max_adults' => $roomInfoData['max_adults'] ?? null,
                    'max_children' => $roomInfoData['max_children'] ?? null,
                    'layout' => array_filter($roomInfoData['layout'] ?? []),
                    'view' => array_filter($roomInfoData['view'] ?? []),
                    'bathroom' => array_filter($roomInfoData['bathroom'] ?? []),
                    'kitchen_facilities' => array_filter($roomInfoData['kitchen_facilities'] ?? []),
                    'balcony' => $roomInfoData['balcony'] ?? null,
                    'accessibility' => array_filter($roomInfoData['accessibility'] ?? []),
                    'smoking_policy' => $roomInfoData['smoking_policy'] ?? null,
                ];
            }

            // Process additional room information
            $additionalInfo = [];
            if ($request->has('additional_info')) {
                $additionalInfoData = $request->input('additional_info', []);
                $additionalInfo = [
                    'bed_policy' => $additionalInfoData['bed_policy'] ?? null,
                    'children_guest_policy' => $additionalInfoData['children_guest_policy'] ?? null,
                    'laundry_service' => $additionalInfoData['laundry_service'] ?? null,
                    'housekeeping_type' => $additionalInfoData['housekeeping_type'] ?? null,
                    'housekeeping_details' => $additionalInfoData['housekeeping_details'] ?? null,
                    'checkin_time' => $additionalInfoData['checkin_time'] ?? null,
                    'checkout_time' => $additionalInfoData['checkout_time'] ?? null,
                    'checkin_checkout_charges' => $additionalInfoData['checkin_checkout_charges'] ?? null,
                    'security_deposit_amount' => $additionalInfoData['security_deposit_amount'] ?? null,
                    'security_deposit_refundable' => $additionalInfoData['security_deposit_refundable'] ?? null,
                    'parking_charges' => $additionalInfoData['parking_charges'] ?? null,
                    'pet_policy' => $additionalInfoData['pet_policy'] ?? null,
                    'pet_policy_details' => $additionalInfoData['pet_policy_details'] ?? null,
                    'meal_options' => $additionalInfoData['meal_options'] ?? null,
                    'meal_details' => $additionalInfoData['meal_details'] ?? null,
                    'transportation_services' => $additionalInfoData['transportation_services'] ?? null,
                    'other_charges' => $additionalInfoData['other_charges'] ?? null,
                ];
            }

            // Merge room info and additional info into display_options
            $displayOptions = array_merge($roomInfo, ['additional_info' => $additionalInfo]);

            // Determine status based on save_draft
            $status = $request->has('save_draft') && $request->save_draft == '1' ? 'draft' : 'published';

            // Prepare update data
            $updateData = [
                'hotel_id' => $request->hotel_id ?? $room->hotel_id,
                'name' => $request->name,
                'number' => $request->number,
                'floor_number' => $request->floor_number,
                'price_per_night' => $request->price_per_night ?? 0,
                'weekend_price' => $request->weekend_price ?? 0,
                'holiday_price' => $request->holiday_price ?? 0,
                'discount_type' => $request->discount_type,
                'discount_amount' => $request->discount_type == 'amount' ? ($request->discount_value ?? 0) : null,
                'discount_percentage' => $request->discount_type == 'percentage' ? ($request->discount_value ?? 0) : null,
                'total_persons' => $request->total_persons ?? 0,
                'description' => $request->description,
                'size' => $request->size ?? 0,
                'total_rooms' => $request->total_rooms ?? 0,
                'total_washrooms' => $request->total_washrooms ?? 0,
                'total_beds' => $request->total_beds ?? 0,
                'wifi_details' => $request->wifi_details,
                'appliances' => $appliances,
                'furniture' => $furniture,
                'amenities' => $amenities,
                'cancellation_policy' => $cancellation_policy,
                'display_options' => $displayOptions, // Store room information and additional info in display_options
                'is_active' => $request->boolean('is_active', false),
                'status' => $status,
            ];

            // Update the room
            $room->update($updateData);

            Log::info('Room updated', [
                'room_id' => $room->id,
                'cancellation_policy' => $room->cancellation_policy,
                'discount_type' => $room->discount_type,
                'discount_amount' => $room->discount_amount,
                'discount_percentage' => $room->discount_percentage,
            ]);

            // Handle photo uploads
            $photoCategories = [
                'feature_photos' => 'feature',
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

            $photosUploaded = false;
            foreach ($photoCategories as $inputName => $category) {
                if ($request->hasFile($inputName)) {
                    foreach ($request->file($inputName) as $index => $photo) {
                        try {
                            if ($photo->isValid()) {
                                $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                                $destinationPath = public_path('assets/room_photos');

                                // Ensure the directory exists
                                if (!file_exists($destinationPath)) {
                                    mkdir($destinationPath, 0775, true);
                                }

                                $photo->move($destinationPath, $filename);

                                $roomPhoto = RoomPhoto::create([
                                    'room_id' => $room->id,
                                    'photo_path' => 'assets/room_photos/' . $filename,
                                    'category' => $category,
                                ]);
                                $photosUploaded = true;
                                Log::info("Photo uploaded successfully in update", [
                                    'room_id' => $room->id,
                                    'photo_id' => $roomPhoto->id,
                                    'category' => $category,
                                    'filename' => $filename,
                                    'path' => $roomPhoto->photo_path
                                ]);
                            }
                        } catch (\Exception $e) {
                            Log::error("Error processing file for $inputName", [
                                'index' => $index,
                                'error' => $e->getMessage(),
                            ]);
                        }
                    }
                }
            }

            // If save_draft is set, redirect to room list, otherwise stay on edit page
            if ($request->has('save_draft') && $request->save_draft == '1') {
                return redirect()->route('vendor-admin.room.index', ['id' => Crypt::encrypt($room->hotel_id)])
                    ->with('success', 'Room saved as draft successfully!');
            }

            // If photos were uploaded, ensure Photos tab is active
            $activeTab = $request->input('active_tab', 'tabItem3');
            $successMessage = 'Room updated successfully!';
            if ($photosUploaded) {
                $activeTab = 'Photos';
                $successMessage = 'Room updated successfully! Photos have been uploaded.';
            }

            // Preserve the active tab when redirecting back
            return redirect()->route('vendor-admin.room.edit', $room->id)
                ->with('success', $successMessage)
                ->withInput(['active_tab' => $activeTab]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Room not found for ID: $id", ['error' => $e->getMessage()]);
            return back()->with('error', 'Room not found.');
        } catch (\Exception $e) {
            Log::error("Error updating room ID: $id", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return back()->withInput()->with('error', 'An error occurred while updating the room: ' . $e->getMessage());
        }
    }

    public function updateSuper(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'floor_number' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'holiday_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'total_persons' => 'required|integer|min:1',
            'size' => 'required|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'total_washrooms' => 'required|integer|min:0',
            'total_beds' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'wifi_details' => 'nullable|string|max:255',
            'appliances' => 'nullable|array',
            'appliances.*' => 'nullable|string|max:255',
            'furniture' => 'nullable|array',
            'furniture.*' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'cancellation_policy' => 'nullable|array',
            'cancellation_policy.*' => 'nullable|string',
            'is_active' => 'nullable|in:0,1,true,false,on,off',
        ], [
            'hotel_id.required' => 'Hotel ID is required.',
            'hotel_id.exists' => 'Selected hotel does not exist.',
            'name.required' => 'Room name is required.',
            'name.max' => 'Room name must not exceed 255 characters.',
            'number.required' => 'Room number is required.',
            'number.max' => 'Room number must not exceed 255 characters.',
            'floor_number.required' => 'Floor number is required.',
            'floor_number.max' => 'Floor number must not exceed 255 characters.',
            'price_per_night.required' => 'Price per night is required.',
            'price_per_night.numeric' => 'Price per night must be a number.',
            'price_per_night.min' => 'Price per night must be at least 0.',
            'weekend_price.numeric' => 'Weekend price must be a number.',
            'weekend_price.min' => 'Weekend price must be at least 0.',
            'holiday_price.numeric' => 'Holiday price must be a number.',
            'holiday_price.min' => 'Holiday price must be at least 0.',
            'discount_type.in' => 'Discount type must be either amount or percentage.',
            'discount_value.numeric' => 'Discount value must be a number.',
            'discount_value.min' => 'Discount value must be at least 0.',
            'total_persons.required' => 'Total persons is required.',
            'total_persons.integer' => 'Total persons must be a whole number.',
            'total_persons.min' => 'Total persons must be at least 1.',
            'size.required' => 'Room size is required.',
            'size.numeric' => 'Room size must be a number.',
            'size.min' => 'Room size must be at least 0.',
            'total_rooms.required' => 'Total rooms is required.',
            'total_rooms.integer' => 'Total rooms must be a whole number.',
            'total_rooms.min' => 'Total rooms must be at least 1.',
            'total_washrooms.required' => 'Total washrooms is required.',
            'total_washrooms.integer' => 'Total washrooms must be a whole number.',
            'total_washrooms.min' => 'Total washrooms must be at least 0.',
            'total_beds.required' => 'Total beds is required.',
            'total_beds.integer' => 'Total beds must be a whole number.',
            'total_beds.min' => 'Total beds must be at least 0.',
        ]);

        Log::info('Received update request from super admin', [
            'room_id' => $id,
            'request_data' => $request->except(['_token', '_method']),
        ]);

        try {
            // Find the room
            $room = Room::findOrFail($id);

            // Merge standard and custom arrays, ensuring uniqueness and filtering out null/empty values
            $appliances = array_unique(array_filter(array_merge($request->appliances ?? [], $request->custom_appliances ?? [])));
            $furniture = array_unique(array_filter(array_merge($request->furniture ?? [], $request->custom_furniture ?? [])));
            $amenities = array_unique(array_filter(array_merge($request->amenities ?? [], $request->custom_amenities ?? [])));
            $cancellation_policy = array_unique(array_filter((array)$request->input('cancellation_policy', [])));

            // Process room information
            $roomInfo = [];
            if ($request->has('room_info')) {
                $roomInfoData = $request->input('room_info', []);
                
                // Store all room info fields
                $roomInfo = [
                    'bedrooms' => $roomInfoData['bedrooms'] ?? null,
                    'living' => $roomInfoData['living'] ?? null,
                    'dining' => $roomInfoData['dining'] ?? null,
                    'kitchen' => $roomInfoData['kitchen'] ?? null,
                    'bathrooms' => $roomInfoData['bathrooms'] ?? null,
                    'bed_type' => $roomInfoData['bed_type'] ?? null,
                    'number_of_beds' => $roomInfoData['number_of_beds'] ?? null,
                    'custom_bed_types' => array_filter($roomInfoData['custom_bed_types'] ?? []),
                    'max_adults' => $roomInfoData['max_adults'] ?? null,
                    'max_children' => $roomInfoData['max_children'] ?? null,
                    'layout' => array_filter($roomInfoData['layout'] ?? []),
                    'view' => array_filter($roomInfoData['view'] ?? []),
                    'bathroom' => array_filter($roomInfoData['bathroom'] ?? []),
                    'kitchen_facilities' => array_filter($roomInfoData['kitchen_facilities'] ?? []),
                    'balcony' => $roomInfoData['balcony'] ?? null,
                    'accessibility' => array_filter($roomInfoData['accessibility'] ?? []),
                    'smoking_policy' => $roomInfoData['smoking_policy'] ?? null,
                ];
            }

            // Process additional room information
            $additionalInfo = [];
            if ($request->has('additional_info')) {
                $additionalInfoData = $request->input('additional_info', []);
                $additionalInfo = [
                    'bed_policy' => $additionalInfoData['bed_policy'] ?? null,
                    'children_guest_policy' => $additionalInfoData['children_guest_policy'] ?? null,
                    'laundry_service' => $additionalInfoData['laundry_service'] ?? null,
                    'housekeeping_type' => $additionalInfoData['housekeeping_type'] ?? null,
                    'housekeeping_details' => $additionalInfoData['housekeeping_details'] ?? null,
                    'checkin_time' => $additionalInfoData['checkin_time'] ?? null,
                    'checkout_time' => $additionalInfoData['checkout_time'] ?? null,
                    'checkin_checkout_charges' => $additionalInfoData['checkin_checkout_charges'] ?? null,
                    'security_deposit_amount' => $additionalInfoData['security_deposit_amount'] ?? null,
                    'security_deposit_refundable' => $additionalInfoData['security_deposit_refundable'] ?? null,
                    'parking_charges' => $additionalInfoData['parking_charges'] ?? null,
                    'pet_policy' => $additionalInfoData['pet_policy'] ?? null,
                    'pet_policy_details' => $additionalInfoData['pet_policy_details'] ?? null,
                    'meal_options' => $additionalInfoData['meal_options'] ?? null,
                    'meal_details' => $additionalInfoData['meal_details'] ?? null,
                    'transportation_services' => $additionalInfoData['transportation_services'] ?? null,
                    'other_charges' => $additionalInfoData['other_charges'] ?? null,
                ];
            }

            // Merge room info and additional info into display_options
            $displayOptions = array_merge($roomInfo, ['additional_info' => $additionalInfo]);

            // Determine status based on save_draft
            $status = $request->has('save_draft') && $request->save_draft == '1' ? 'draft' : 'published';

            // Prepare update data
            $updateData = [
                'hotel_id' => $request->hotel_id ?? $room->hotel_id,
                'name' => $request->name,
                'number' => $request->number,
                'floor_number' => $request->floor_number,
                'price_per_night' => $request->price_per_night ?? 0,
                'weekend_price' => $request->weekend_price ?? 0,
                'holiday_price' => $request->holiday_price ?? 0,
                'discount_type' => $request->discount_type,
                'discount_amount' => $request->discount_type == 'amount' ? ($request->discount_value ?? 0) : null,
                'discount_percentage' => $request->discount_type == 'percentage' ? ($request->discount_value ?? 0) : null,
                'total_persons' => $request->total_persons ?? 0,
                'description' => $request->description,
                'size' => $request->size ?? 0,
                'total_rooms' => $request->total_rooms ?? 0,
                'total_washrooms' => $request->total_washrooms ?? 0,
                'total_beds' => $request->total_beds ?? 0,
                'wifi_details' => $request->wifi_details,
                'appliances' => $appliances,
                'furniture' => $furniture,
                'amenities' => $amenities,
                'cancellation_policy' => $cancellation_policy,
                'display_options' => $displayOptions, // Store room information and additional info in display_options
                'is_active' => $request->boolean('is_active', false),
                'status' => $status,
            ];

            // Update the room
            $room->update($updateData);

            Log::info('Room updated', [
                'room_id' => $room->id,
                'cancellation_policy' => $room->cancellation_policy,
                'discount_type' => $room->discount_type,
                'discount_amount' => $room->discount_amount,
                'discount_percentage' => $room->discount_percentage,
            ]);

            // Handle photo uploads
            $photoCategories = [
                'feature_photos' => 'feature',
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

            $photosUploaded = false;
            foreach ($photoCategories as $inputName => $category) {
                if ($request->hasFile($inputName)) {
                    foreach ($request->file($inputName) as $index => $photo) {
                        try {
                            if ($photo->isValid()) {
                                $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                                $destinationPath = public_path('assets/room_photos');

                                // Ensure the directory exists
                                if (!file_exists($destinationPath)) {
                                    mkdir($destinationPath, 0775, true);
                                }

                                $photo->move($destinationPath, $filename);

                                RoomPhoto::create([
                                    'room_id' => $room->id,
                                    'photo_path' => 'assets/room_photos/' . $filename, // relative to public folder
                                    'category' => $category,
                                ]);
                                $photosUploaded = true;
                                Log::info("Photo uploaded successfully", [
                                    'room_id' => $room->id,
                                    'category' => $category,
                                    'filename' => $filename
                                ]);
                            }
                        } catch (\Exception $e) {
                            Log::error("Error processing file for $inputName", [
                                'index' => $index,
                                'error' => $e->getMessage(),
                            ]);
                        }
                    }
                }
            }

            // If save_draft is set, redirect to room list, otherwise stay on edit page
            if ($request->has('save_draft') && $request->save_draft == '1') {
                return redirect()->route('super-admin.room.index', ['id' => Crypt::encrypt($room->hotel_id)])
                    ->with('success', 'Room saved as draft successfully!');
            }

            // If photos were uploaded, ensure Photos tab is active
            $activeTab = $request->input('active_tab', 'tabItem3');
            $successMessage = 'Room updated successfully!';
            if ($photosUploaded) {
                $activeTab = 'Photos';
                $successMessage = 'Room updated successfully! Photos have been uploaded.';
            }

            // Preserve the active tab when redirecting back
            return redirect()->route('super-admin.room.edit', $room->id)
                ->with('success', $successMessage)
                ->withInput(['active_tab' => $activeTab]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Room not found for ID: $id", ['error' => $e->getMessage()]);
            return back()->with('error', 'Room not found.');
        } catch (\Exception $e) {
            Log::error("Error updating room ID: $id (Super Admin)", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return back()->withInput()->with('error', 'An error occurred while updating the room: ' . $e->getMessage());
        }
    }



    public function deletePhoto(Request $request)
    {
        try {
            $request->validate([
                'photo_id' => 'required|integer|exists:room_photos,id',
            ]);

            $photo = RoomPhoto::findOrFail($request->photo_id);

            // Delete the file from public folder
            $filePath = public_path($photo->photo_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the database record
            $photo->delete();

            return response()->json(['success' => true, 'message' => 'Photo deleted successfully']);
        } catch (\Exception $e) {
            Log::error("Error deleting photo ID: {$request->photo_id}", ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Failed to delete photo'], 500);
        }
    }

    public function deletePhotoSuper(Request $request)
    {
        try {
            $request->validate([
                'photo_id' => 'required|integer|exists:room_photos,id',
            ]);

            $photo = RoomPhoto::findOrFail($request->photo_id);

            // Delete the file from public folder
            $filePath = public_path($photo->photo_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the database record
            $photo->delete();

            return response()->json(['success' => true, 'message' => 'Photo deleted successfully']);
        } catch (\Exception $e) {
            Log::error("Error deleting photo ID: {$request->photo_id}", ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Failed to delete photo'], 500);
        }
    }



}
