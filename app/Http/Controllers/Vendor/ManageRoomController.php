<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelSetting;
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
        $hotel = Hotel::findOrFail($hotelId);
        return view('auth.vendor.room.create', ['hotel' => $hotelId, 'hotelObj' => $hotel]);
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
            'room_number' => 'nullable|string|max:255',
            'floor_number' => 'nullable|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'holiday_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'total_persons' => 'required|integer|min:1',
            'size' => 'nullable|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'total_washrooms' => 'required|integer|min:0',
            'total_beds' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'wifi_details' => 'nullable|string|max:255',
            'room_details' => 'nullable|array',
            'room_details.*.name' => 'nullable|string|max:255',
            'room_details.*.note' => 'nullable|string',
            'appliances' => 'nullable|array',
            'appliances.*' => 'nullable|string|max:255',
            'furniture' => 'nullable|array',
            'furniture.*' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'cancellation_policy' => 'nullable|array',
            'cancellation_policy.*' => 'nullable|string',
            'cancellation_policy_texts' => 'nullable|array',
            'cancellation_policy_texts.*' => 'nullable|string',
            'custom_cancellation_policies' => 'nullable|array',
            'enabled_cancellation_policies' => 'nullable|array',
            'is_active' => 'nullable|in:0,1,true,false,on,off',
            'couple_friendly' => 'nullable|boolean',
            'availability_dates' => 'nullable|string',
        ], [
            'hotel_id.required' => 'Hotel ID is required.',
            'hotel_id.exists' => 'Selected hotel does not exist.',
            'name.required' => 'Room name is required.',
            'name.max' => 'Room name must not exceed 255 characters.',
            'room_number.max' => 'Room number must not exceed 255 characters.',
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
            'room_details.*.name.max' => 'Room name must not exceed 255 characters.',
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
            'total_beds' => $request->input('total_beds'),
            'total_beds_raw' => $request->get('total_beds'),
            'total_beds_processed' => (int)($request->input('total_beds', 0) ?? 0),
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
            
            // Handle beds - new format is array of bed objects, old format is single bed
            $bedsData = $roomInfoData['beds'] ?? null;
            if ($bedsData && is_array($bedsData)) {
                // Process each bed: if custom_bed_type is set, use it as bed_type
                $bedsData = array_map(function($bed) {
                    if (isset($bed['custom_bed_type']) && !empty($bed['custom_bed_type'])) {
                        $bed['bed_type'] = $bed['custom_bed_type'];
                    }
                    unset($bed['custom_bed_type']); // Remove custom_bed_type as it's now in bed_type
                    return array_filter($bed, function($value) {
                        return $value !== '' && $value !== null;
                    });
                }, $bedsData);
                // Filter out empty beds
                $bedsData = array_filter($bedsData, function($bed) {
                    return !empty($bed['bed_type']);
                });
                $bedsData = array_values($bedsData);
            }
            
            // Store all room info fields
            $roomInfo = [
                'bedrooms' => $roomInfoData['bedrooms'] ?? null,
                'living' => $roomInfoData['living'] ?? null,
                'dining' => $roomInfoData['dining'] ?? null,
                'kitchen' => $roomInfoData['kitchen'] ?? null,
                'bathrooms' => $this->processBathroomsData($roomInfoData['bathrooms'] ?? null),
                'beds' => !empty($bedsData) ? $bedsData : null,
                'bed_type' => $roomInfoData['bed_type'] ?? null, // Keep for backward compatibility
                'number_of_beds' => $roomInfoData['number_of_beds'] ?? null, // Keep for backward compatibility
                'custom_bed_types' => array_filter($roomInfoData['custom_bed_types'] ?? []), // Keep for backward compatibility
                'max_occupancy' => $roomInfoData['max_occupancy'] ?? null,
                'min_occupancy' => $roomInfoData['min_occupancy'] ?? null,
                'layout' => array_filter($roomInfoData['layout'] ?? []),
                'view' => array_filter($roomInfoData['view'] ?? []),
                'bathroom' => array_filter($roomInfoData['bathroom'] ?? []), // Keep for backward compatibility
                'kitchen_facilities' => array_filter($roomInfoData['kitchen_facilities'] ?? []),
                'balcony' => $roomInfoData['balcony'] ?? null,
                'accessibility' => array_filter($roomInfoData['accessibility'] ?? []),
                'smoking_policy' => $roomInfoData['smoking_policy'] ?? null,
            ];
        }

        // Process additional room information - Dynamic approach
        $additionalInfo = [];
        if ($request->has('additional_info')) {
            $additionalInfoData = $request->input('additional_info', []);
            $additionalInfo = $this->processAdditionalInfo($additionalInfoData);
        }

        // Process room details - new format is array of room objects
        $roomDetailsData = $request->input('room_details', []);
        if ($roomDetailsData && is_array($roomDetailsData)) {
            // Filter out empty room details (name is not in room_details, it's a single field)
            $roomDetailsData = array_filter($roomDetailsData, function($room) {
                return !empty($room['number']);
            });
            $roomDetailsData = array_values($roomDetailsData);
        }
        
        // For backward compatibility, use first room's data for main fields if only one room
        $mainRoomName = $request->name ?? '';
        $mainRoomNumber = $request->room_number ?? $request->number ?? '';
        $mainFloorNumber = $request->floor_number ?? '';
        $mainSize = $request->size ?? 0;
        $mainWifiDetails = $request->wifi_details ?? '';
        
        if (!empty($roomDetailsData) && count($roomDetailsData) > 0) {
            $firstRoom = $roomDetailsData[0];
            // Room name is not in room_details, it comes from the main 'name' field
            $mainRoomNumber = $firstRoom['number'] ?? $mainRoomNumber;
            $mainFloorNumber = $firstRoom['floor_number'] ?? $mainFloorNumber;
            $mainSize = $firstRoom['size'] ?? $mainSize;
            $mainWifiDetails = $firstRoom['wifi_details'] ?? $mainWifiDetails;
        }
        
        // Add room_details to roomInfo
        if (!isset($roomInfo['room_details'])) {
            $roomInfo['room_details'] = !empty($roomDetailsData) ? $roomDetailsData : null;
        }

        // Merge room info and additional info into display_options
        $displayOptions = array_merge($roomInfo, ['additional_info' => $additionalInfo]);

        // Determine status based on save_draft
        $status = $request->has('save_draft') && $request->save_draft == '1' ? 'draft' : 'published';

        // Extract additional_info fields for direct database columns
        $additionalInfoColumns = $this->extractAdditionalInfoColumns($additionalInfo);
        
        // Create the room
        $room = Room::create(array_merge([
            'hotel_id' => $request->hotel_id,
            'name' => $mainRoomName,
            'number' => $mainRoomNumber,
            'floor_number' => $mainFloorNumber,
            'price_per_night' => $request->price_per_night,
            'weekend_price' => $request->weekend_price,
            'holiday_price' => $request->holiday_price,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_type == 'amount' ? $request->discount_value : null,
            'discount_percentage' => $request->discount_type == 'percentage' ? $request->discount_value : null,
            'total_persons' => $request->total_persons,
            'description' => $request->description,
            'size' => $mainSize,
            'total_rooms' => (int)($request->input('total_rooms', 1) ?? 1),
            'total_washrooms' => $request->total_washrooms,
            'total_beds' => (int)($request->input('total_beds', 0) ?? 0),
            'wifi_details' => $mainWifiDetails,
            'couple_friendly' => $request->has('couple_friendly') ? (bool)$request->couple_friendly : false,
            'appliances' => $appliances,
            'furniture' => $furniture,
            'amenities' => $amenities,
            'cancellation_policy' => $cancellation_policy,
            'display_options' => $displayOptions, // Store room information and additional info in display_options
            'is_active' => $request->boolean('is_active', false),
            'status' => $status,
            'availability_dates' => $this->processAvailabilityDates($request->availability_dates),
        ], $additionalInfoColumns));

        Log::info('Room created', [
                'room_id' => $room->id,
                'total_beds' => $room->total_beds,
                'cancellation_policy' => $room->cancellation_policy,
                'discount_type' => $room->discount_type,
                'discount_amount' => $room->discount_amount,
                'discount_percentage' => $room->discount_percentage,
            ]);

        // Handle photo uploads
        $photoCategories = [
            'feature_main_photos' => 'feature_main',
            'bedroom_photos' => 'bedroom',
            'washroom_photos' => 'washroom',
            'balcony_photos' => 'balcony',
            'living_dining_photos' => 'living_dining',
            'furniture_photos' => 'furniture',
            'appliances_photos' => 'appliances',
            'kitchen_photos' => 'kitchen',
            'amenity_photos' => 'amenity',
            'bedroom2_photos' => 'bedroom2',
            'bedroom3_photos' => 'bedroom3',
            'washroom2_photos' => 'washroom2',
            'washroom3_photos' => 'washroom3',
            'additional_photos' => 'additional',
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
            'room_number' => 'nullable|string|max:255',
            'floor_number' => 'nullable|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'holiday_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'total_persons' => 'required|integer|min:1',
            'size' => 'nullable|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'total_washrooms' => 'required|integer|min:0',
            'total_beds' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'wifi_details' => 'nullable|string|max:255',
            'room_details' => 'nullable|array',
            'room_details.*.name' => 'nullable|string|max:255',
            'room_details.*.note' => 'nullable|string',
            'appliances' => 'nullable|array',
            'appliances.*' => 'nullable|string|max:255',
            'furniture' => 'nullable|array',
            'furniture.*' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'cancellation_policy' => 'nullable|array',
            'cancellation_policy.*' => 'nullable|string',
            'cancellation_policy_texts' => 'nullable|array',
            'cancellation_policy_texts.*' => 'nullable|string',
            'custom_cancellation_policies' => 'nullable|array',
            'enabled_cancellation_policies' => 'nullable|array',
            'is_active' => 'nullable|in:0,1,true,false,on,off',
            'availability_dates' => 'nullable|string',
        ], [
            'hotel_id.required' => 'Hotel ID is required.',
            'hotel_id.exists' => 'Selected hotel does not exist.',
            'name.required' => 'Room name is required.',
            'name.max' => 'Room name must not exceed 255 characters.',
            'room_number.max' => 'Room number must not exceed 255 characters.',
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
            'room_details.*.name.max' => 'Room name must not exceed 255 characters.',
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
            'total_beds' => $request->input('total_beds'),
            'total_beds_raw' => $request->get('total_beds'),
            'total_beds_processed' => (int)($request->input('total_beds', 0) ?? 0),
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
            
            // Handle beds - new format is array of bed objects, old format is single bed
            $bedsData = $roomInfoData['beds'] ?? null;
            if ($bedsData && is_array($bedsData)) {
                // Process each bed: if custom_bed_type is set, use it as bed_type
                $bedsData = array_map(function($bed) {
                    if (isset($bed['custom_bed_type']) && !empty($bed['custom_bed_type'])) {
                        $bed['bed_type'] = $bed['custom_bed_type'];
                    }
                    unset($bed['custom_bed_type']); // Remove custom_bed_type as it's now in bed_type
                    return array_filter($bed, function($value) {
                        return $value !== '' && $value !== null;
                    });
                }, $bedsData);
                // Filter out empty beds
                $bedsData = array_filter($bedsData, function($bed) {
                    return !empty($bed['bed_type']);
                });
                $bedsData = array_values($bedsData);
            }
            
            // Store all room info fields
            $roomInfo = [
                'bedrooms' => $roomInfoData['bedrooms'] ?? null,
                'living' => $roomInfoData['living'] ?? null,
                'dining' => $roomInfoData['dining'] ?? null,
                'kitchen' => $roomInfoData['kitchen'] ?? null,
                'bathrooms' => $this->processBathroomsData($roomInfoData['bathrooms'] ?? null),
                'beds' => !empty($bedsData) ? $bedsData : null,
                'bed_type' => $roomInfoData['bed_type'] ?? null, // Keep for backward compatibility
                'number_of_beds' => $roomInfoData['number_of_beds'] ?? null, // Keep for backward compatibility
                'custom_bed_types' => array_filter($roomInfoData['custom_bed_types'] ?? []), // Keep for backward compatibility
                'max_occupancy' => $roomInfoData['max_occupancy'] ?? null,
                'min_occupancy' => $roomInfoData['min_occupancy'] ?? null,
                'layout' => array_filter($roomInfoData['layout'] ?? []),
                'view' => array_filter($roomInfoData['view'] ?? []),
                'bathroom' => array_filter($roomInfoData['bathroom'] ?? []), // Keep for backward compatibility
                'kitchen_facilities' => array_filter($roomInfoData['kitchen_facilities'] ?? []),
                'balcony' => $roomInfoData['balcony'] ?? null,
                'accessibility' => array_filter($roomInfoData['accessibility'] ?? []),
                'smoking_policy' => $roomInfoData['smoking_policy'] ?? null,
            ];
        }

        // Process additional room information - Dynamic approach
        $additionalInfo = [];
        if ($request->has('additional_info')) {
            $additionalInfoData = $request->input('additional_info', []);
            $additionalInfo = $this->processAdditionalInfo($additionalInfoData);
        }

        // Process room details - new format is array of room objects
        $roomDetailsData = $request->input('room_details', []);
        if ($roomDetailsData && is_array($roomDetailsData)) {
            // Filter out empty room details (name is not in room_details, it's a single field)
            $roomDetailsData = array_filter($roomDetailsData, function($room) {
                return !empty($room['number']);
            });
            $roomDetailsData = array_values($roomDetailsData);
        }
        
        // For backward compatibility, use first room's data for main fields if only one room
        $mainRoomName = $request->name ?? '';
        $mainRoomNumber = $request->room_number ?? $request->number ?? '';
        $mainFloorNumber = $request->floor_number ?? '';
        $mainSize = $request->size ?? 0;
        $mainWifiDetails = $request->wifi_details ?? '';
        
        if (!empty($roomDetailsData) && count($roomDetailsData) > 0) {
            $firstRoom = $roomDetailsData[0];
            // Room name is not in room_details, it comes from the main 'name' field
            $mainRoomNumber = $firstRoom['number'] ?? $mainRoomNumber;
            $mainFloorNumber = $firstRoom['floor_number'] ?? $mainFloorNumber;
            $mainSize = $firstRoom['size'] ?? $mainSize;
            $mainWifiDetails = $firstRoom['wifi_details'] ?? $mainWifiDetails;
        }
        
        // Add room_details to roomInfo
        if (!isset($roomInfo['room_details'])) {
            $roomInfo['room_details'] = !empty($roomDetailsData) ? $roomDetailsData : null;
        }

        // Merge room info and additional info into display_options
        $displayOptions = array_merge($roomInfo, ['additional_info' => $additionalInfo]);

        // Determine status based on save_draft
        $status = $request->has('save_draft') && $request->save_draft == '1' ? 'draft' : 'published';

        // Extract additional_info fields for direct database columns
        $additionalInfoColumns = $this->extractAdditionalInfoColumns($additionalInfo);
        
        // Create the room
        $room = Room::create(array_merge([
            'hotel_id' => $request->hotel_id,
            'name' => $mainRoomName,
            'number' => $mainRoomNumber,
            'floor_number' => $mainFloorNumber,
            'price_per_night' => $request->price_per_night,
            'weekend_price' => $request->weekend_price,
            'holiday_price' => $request->holiday_price,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_type == 'amount' ? $request->discount_value : null,
            'discount_percentage' => $request->discount_type == 'percentage' ? $request->discount_value : null,
            'total_persons' => $request->total_persons,
            'description' => $request->description,
            'size' => $mainSize,
            'total_rooms' => (int)($request->input('total_rooms', 1) ?? 1),
            'total_washrooms' => $request->total_washrooms,
            'total_beds' => (int)($request->input('total_beds', 0) ?? 0),
            'wifi_details' => $mainWifiDetails,
            'couple_friendly' => $request->has('couple_friendly') ? (bool)$request->couple_friendly : false,
            'appliances' => $appliances,
            'furniture' => $furniture,
            'amenities' => $amenities,
            'cancellation_policy' => $cancellation_policy,
            'display_options' => $displayOptions, // Store room information and additional info in display_options
            'is_active' => $request->boolean('is_active', false),
            'status' => $status,
            'availability_dates' => $this->processAvailabilityDates($request->availability_dates),
        ], $additionalInfoColumns));

        Log::info('Room created by super admin', [
            'room_id' => $room->id,
            'total_beds' => $room->total_beds,
            'cancellation_policy' => $room->cancellation_policy,
            'discount_type' => $room->discount_type,
            'discount_amount' => $room->discount_amount,
            'discount_percentage' => $room->discount_percentage,
        ]);

        // Handle photo uploads
        $photoCategories = [
            'feature_main_photos' => 'feature_main',
            'bedroom_photos' => 'bedroom',
            'washroom_photos' => 'washroom',
            'balcony_photos' => 'balcony',
            'living_dining_photos' => 'living_dining',
            'furniture_photos' => 'furniture',
            'appliances_photos' => 'appliances',
            'kitchen_photos' => 'kitchen',
            'amenity_photos' => 'amenity',
            'bedroom2_photos' => 'bedroom2',
            'bedroom3_photos' => 'bedroom3',
            'washroom2_photos' => 'washroom2',
            'washroom3_photos' => 'washroom3',
            'additional_photos' => 'additional',
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
            'room_number' => 'nullable|string|max:255',
            'floor_number' => 'nullable|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'holiday_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'total_persons' => 'required|integer|min:1',
            'size' => 'nullable|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'total_washrooms' => 'required|integer|min:0',
            'total_beds' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'wifi_details' => 'nullable|string|max:255',
            'room_details' => 'nullable|array',
            'room_details.*.name' => 'nullable|string|max:255',
            'room_details.*.note' => 'nullable|string',
            'appliances' => 'nullable|array',
            'appliances.*' => 'nullable|string|max:255',
            'furniture' => 'nullable|array',
            'furniture.*' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'cancellation_policy' => 'nullable|array',
            'cancellation_policy.*' => 'nullable|string',
            'cancellation_policy_texts' => 'nullable|array',
            'cancellation_policy_texts.*' => 'nullable|string',
            'custom_cancellation_policies' => 'nullable|array',
            'enabled_cancellation_policies' => 'nullable|array',
            'is_active' => 'nullable|in:0,1,true,false,on,off',
            'availability_dates' => 'nullable|string',
        ], [
            'hotel_id.required' => 'Hotel ID is required.',
            'hotel_id.exists' => 'Selected hotel does not exist.',
            'name.required' => 'Room name is required.',
            'name.max' => 'Room name must not exceed 255 characters.',
            'room_number.max' => 'Room number must not exceed 255 characters.',
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
            'room_details.*.name.max' => 'Room name must not exceed 255 characters.',
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
            'total_beds' => $request->input('total_beds'),
            'total_beds_raw' => $request->get('total_beds'),
            'total_beds_processed' => (int)($request->input('total_beds', 0) ?? 0),
        ]);

        try {
            // Find the room
            $room = Room::findOrFail($id);

            // Merge standard and custom arrays, ensuring uniqueness and filtering out null/empty values
            $appliances = array_unique(array_filter(array_merge($request->appliances ?? [], $request->custom_appliances ?? [])));
            $furniture = array_unique(array_filter(array_merge($request->furniture ?? [], $request->custom_furniture ?? [])));
            $amenities = array_unique(array_filter(array_merge($request->amenities ?? [], $request->custom_amenities ?? [])));
            $cancellation_policy = array_unique(array_filter((array)$request->input('cancellation_policy', [])));

            // Process room details - new format is array of room objects with name and note
            $roomDetailsData = $request->input('room_details', []);
            if ($roomDetailsData && is_array($roomDetailsData)) {
                // Filter out empty room details
                $roomDetailsData = array_filter($roomDetailsData, function($room) {
                    return !empty($room['name']) || !empty($room['note']);
                });
                $roomDetailsData = array_values($roomDetailsData);
            }
            
            // For backward compatibility, use first room's data for main fields if only one room
            // Room name comes from the main 'name' field, not from room_details
            $mainRoomName = $request->name ?? $room->name ?? '';
            $mainRoomNumber = $request->room_number ?? $request->number ?? $room->number ?? '';
            $mainFloorNumber = $request->floor_number ?? $room->floor_number ?? '';
            $mainSize = $request->size ?? $room->size ?? 0;
            $mainWifiDetails = $request->wifi_details ?? $room->wifi_details ?? '';
            
            if (!empty($roomDetailsData) && count($roomDetailsData) > 0) {
                $firstRoom = $roomDetailsData[0];
                // Room name is not in room_details, it comes from the main 'name' field
                $mainRoomNumber = $firstRoom['number'] ?? $mainRoomNumber;
                $mainFloorNumber = $firstRoom['floor_number'] ?? $mainFloorNumber;
                $mainSize = $firstRoom['size'] ?? $mainSize;
                $mainWifiDetails = $firstRoom['wifi_details'] ?? $mainWifiDetails;
            }

            // Process room information
            $roomInfo = [];
            if ($request->has('room_info')) {
                $roomInfoData = $request->input('room_info', []);
                
                // Handle beds - new format is array of bed objects, old format is single bed
                $bedsData = $roomInfoData['beds'] ?? null;
                if ($bedsData && is_array($bedsData)) {
                    // Process each bed: if custom_bed_type is set, use it as bed_type
                    $bedsData = array_map(function($bed) {
                        if (isset($bed['custom_bed_type']) && !empty($bed['custom_bed_type'])) {
                            $bed['bed_type'] = $bed['custom_bed_type'];
                        }
                        unset($bed['custom_bed_type']); // Remove custom_bed_type as it's now in bed_type
                        return array_filter($bed, function($value) {
                            return $value !== '' && $value !== null;
                        });
                    }, $bedsData);
                    // Filter out empty beds
                    $bedsData = array_filter($bedsData, function($bed) {
                        return !empty($bed['bed_type']);
                    });
                    $bedsData = array_values($bedsData);
                }
                
                // Store all room info fields
                $roomInfo = [
                    'bedrooms' => $roomInfoData['bedrooms'] ?? null,
                    'living' => $roomInfoData['living'] ?? null,
                    'dining' => $roomInfoData['dining'] ?? null,
                    'kitchen' => $roomInfoData['kitchen'] ?? null,
                    'bathrooms' => $this->processBathroomsData($roomInfoData['bathrooms'] ?? null),
                    'beds' => !empty($bedsData) ? $bedsData : null,
                    'bed_type' => $roomInfoData['bed_type'] ?? null, // Keep for backward compatibility
                    'number_of_beds' => $roomInfoData['number_of_beds'] ?? null, // Keep for backward compatibility
                    'custom_bed_types' => array_filter($roomInfoData['custom_bed_types'] ?? []), // Keep for backward compatibility
                    'max_occupancy' => $roomInfoData['max_occupancy'] ?? null,
                    'min_occupancy' => $roomInfoData['min_occupancy'] ?? null,
                    'layout' => array_filter($roomInfoData['layout'] ?? []),
                    'view' => array_filter($roomInfoData['view'] ?? []),
                    'bathroom' => array_filter($roomInfoData['bathroom'] ?? []), // Keep for backward compatibility
                    'kitchen_facilities' => array_filter($roomInfoData['kitchen_facilities'] ?? []),
                    'balcony' => $roomInfoData['balcony'] ?? null,
                    'accessibility' => array_filter($roomInfoData['accessibility'] ?? []),
                    'smoking_policy' => $roomInfoData['smoking_policy'] ?? null,
                    'room_details' => !empty($roomDetailsData) ? $roomDetailsData : null, // Store room details array
                ];
            } else {
                // If no room_info, still store room_details
                $roomInfo['room_details'] = !empty($roomDetailsData) ? $roomDetailsData : null;
            }

            // Process additional room information - Dynamic approach
            $additionalInfo = [];
            if ($request->has('additional_info')) {
                $additionalInfoData = $request->input('additional_info', []);
                // Get existing additional_info from room
                $existingAdditionalInfo = [];
                if ($room->display_options && isset($room->display_options['additional_info'])) {
                    $existingAdditionalInfo = $room->display_options['additional_info'];
                }
                $additionalInfo = $this->processAdditionalInfo($additionalInfoData, $existingAdditionalInfo);
            } else {
                // Preserve existing additional_info if not provided
                if ($room->display_options && isset($room->display_options['additional_info'])) {
                    $additionalInfo = $room->display_options['additional_info'];
                }
            }

            // Merge room info and additional info into display_options
            $displayOptions = array_merge($roomInfo, ['additional_info' => $additionalInfo]);

            // Determine status based on save_draft
            $status = $request->has('save_draft') && $request->save_draft == '1' ? 'draft' : 'published';

            // Prepare update data
            $updateData = [
                'hotel_id' => $request->hotel_id ?? $room->hotel_id,
                'name' => $mainRoomName,
                'number' => $mainRoomNumber,
                'floor_number' => $mainFloorNumber,
                'price_per_night' => $request->price_per_night ?? 0,
                'weekend_price' => $request->weekend_price ?? 0,
                'holiday_price' => $request->holiday_price ?? 0,
                'discount_type' => $request->discount_type,
                'discount_amount' => $request->discount_type == 'amount' ? ($request->discount_value ?? 0) : null,
                'discount_percentage' => $request->discount_type == 'percentage' ? ($request->discount_value ?? 0) : null,
                'total_persons' => $request->total_persons ?? 0,
                'description' => $request->description,
                'size' => $mainSize,
                'total_rooms' => (int)($request->input('total_rooms', 1) ?? 1),
                'total_washrooms' => $request->total_washrooms ?? 0,
                'total_beds' => (int)($request->input('total_beds', 0) ?? 0),
                'wifi_details' => $mainWifiDetails,
                'couple_friendly' => $request->has('couple_friendly') ? (bool)$request->couple_friendly : false,
                'appliances' => $appliances,
                'furniture' => $furniture,
                'amenities' => $amenities,
                'cancellation_policy' => $cancellation_policy,
                'display_options' => $displayOptions, // Store room information and additional info in display_options
                'is_active' => $request->boolean('is_active', false),
                'status' => $status,
                'availability_dates' => $this->processAvailabilityDates($request->availability_dates),
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
                'feature_main_photos' => 'feature_main',
                'bedroom_photos' => 'bedroom',
                'washroom_photos' => 'washroom',
                'balcony_photos' => 'balcony',
                'living_dining_photos' => 'living_dining',
                'furniture_photos' => 'furniture',
                'appliances_photos' => 'appliances',
                'kitchen_photos' => 'kitchen',
                'amenity_photos' => 'amenity',
                'bedroom2_photos' => 'bedroom2',
                'bedroom3_photos' => 'bedroom3',
                'washroom2_photos' => 'washroom2',
                'washroom3_photos' => 'washroom3',
                'additional_photos' => 'additional',
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
            'room_number' => 'nullable|string|max:255',
            'floor_number' => 'nullable|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'holiday_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'total_persons' => 'required|integer|min:1',
            'size' => 'nullable|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'total_washrooms' => 'required|integer|min:0',
            'total_beds' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'wifi_details' => 'nullable|string|max:255',
            'room_details' => 'nullable|array',
            'room_details.*.name' => 'nullable|string|max:255',
            'room_details.*.note' => 'nullable|string',
            'appliances' => 'nullable|array',
            'appliances.*' => 'nullable|string|max:255',
            'furniture' => 'nullable|array',
            'furniture.*' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'cancellation_policy' => 'nullable|array',
            'cancellation_policy.*' => 'nullable|string',
            'cancellation_policy_texts' => 'nullable|array',
            'cancellation_policy_texts.*' => 'nullable|string',
            'custom_cancellation_policies' => 'nullable|array',
            'enabled_cancellation_policies' => 'nullable|array',
            'is_active' => 'nullable|in:0,1,true,false,on,off',
            'availability_dates' => 'nullable|string',
        ], [
            'hotel_id.required' => 'Hotel ID is required.',
            'hotel_id.exists' => 'Selected hotel does not exist.',
            'name.required' => 'Room name is required.',
            'name.max' => 'Room name must not exceed 255 characters.',
            'room_number.max' => 'Room number must not exceed 255 characters.',
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
            'room_details.*.name.max' => 'Room name must not exceed 255 characters.',
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
            'total_beds' => $request->input('total_beds'),
            'total_beds_raw' => $request->get('total_beds'),
            'total_beds_processed' => (int)($request->input('total_beds', 0) ?? 0),
        ]);

        try {
            // Find the room
            $room = Room::findOrFail($id);

            // Merge standard and custom arrays, ensuring uniqueness and filtering out null/empty values
            $appliances = array_unique(array_filter(array_merge($request->appliances ?? [], $request->custom_appliances ?? [])));
            $furniture = array_unique(array_filter(array_merge($request->furniture ?? [], $request->custom_furniture ?? [])));
            $amenities = array_unique(array_filter(array_merge($request->amenities ?? [], $request->custom_amenities ?? [])));
            $cancellation_policy = array_unique(array_filter((array)$request->input('cancellation_policy', [])));

            // Process room details - new format is array of room objects with name and note
            $roomDetailsData = $request->input('room_details', []);
            if ($roomDetailsData && is_array($roomDetailsData)) {
                // Filter out empty room details
                $roomDetailsData = array_filter($roomDetailsData, function($room) {
                    return !empty($room['name']) || !empty($room['note']);
                });
                $roomDetailsData = array_values($roomDetailsData);
            }
            
            // Common room fields
            $mainRoomName = $request->name ?? $room->name ?? '';
            $mainRoomNumber = $request->room_number ?? $room->number ?? '';
            $mainFloorNumber = $request->floor_number ?? $room->floor_number ?? '';
            $mainSize = $request->size ?? $room->size ?? 0;
            $mainWifiDetails = $request->wifi_details ?? $room->wifi_details ?? '';

            // Process room information
            $roomInfo = [];
            if ($request->has('room_info')) {
                $roomInfoData = $request->input('room_info', []);
                
                // Handle beds - new format is array of bed objects, old format is single bed
                $bedsData = $roomInfoData['beds'] ?? null;
                if ($bedsData && is_array($bedsData)) {
                    // Process each bed: if custom_bed_type is set, use it as bed_type
                    $bedsData = array_map(function($bed) {
                        if (isset($bed['custom_bed_type']) && !empty($bed['custom_bed_type'])) {
                            $bed['bed_type'] = $bed['custom_bed_type'];
                        }
                        unset($bed['custom_bed_type']); // Remove custom_bed_type as it's now in bed_type
                        return array_filter($bed, function($value) {
                            return $value !== '' && $value !== null;
                        });
                    }, $bedsData);
                    // Filter out empty beds
                    $bedsData = array_filter($bedsData, function($bed) {
                        return !empty($bed['bed_type']);
                    });
                    $bedsData = array_values($bedsData);
                }
                
                // Store all room info fields
                $roomInfo = [
                    'bedrooms' => $roomInfoData['bedrooms'] ?? null,
                    'living' => $roomInfoData['living'] ?? null,
                    'dining' => $roomInfoData['dining'] ?? null,
                    'kitchen' => $roomInfoData['kitchen'] ?? null,
                    'bathrooms' => $this->processBathroomsData($roomInfoData['bathrooms'] ?? null),
                    'beds' => !empty($bedsData) ? $bedsData : null,
                    'bed_type' => $roomInfoData['bed_type'] ?? null, // Keep for backward compatibility
                    'number_of_beds' => $roomInfoData['number_of_beds'] ?? null, // Keep for backward compatibility
                    'custom_bed_types' => array_filter($roomInfoData['custom_bed_types'] ?? []), // Keep for backward compatibility
                    'max_occupancy' => $roomInfoData['max_occupancy'] ?? null,
                    'min_occupancy' => $roomInfoData['min_occupancy'] ?? null,
                    'layout' => array_filter($roomInfoData['layout'] ?? []),
                    'view' => array_filter($roomInfoData['view'] ?? []),
                    'bathroom' => array_filter($roomInfoData['bathroom'] ?? []), // Keep for backward compatibility
                    'kitchen_facilities' => array_filter($roomInfoData['kitchen_facilities'] ?? []),
                    'balcony' => $roomInfoData['balcony'] ?? null,
                    'accessibility' => array_filter($roomInfoData['accessibility'] ?? []),
                    'smoking_policy' => $roomInfoData['smoking_policy'] ?? null,
                    'room_details' => !empty($roomDetailsData) ? $roomDetailsData : null, // Store room details array
                ];
            } else {
                // If no room_info, still store room_details
                $roomInfo['room_details'] = !empty($roomDetailsData) ? $roomDetailsData : null;
            }

            // Process additional room information - Dynamic approach
            $additionalInfo = [];
            if ($request->has('additional_info')) {
                $additionalInfoData = $request->input('additional_info', []);
                // Get existing additional_info from room
                $existingAdditionalInfo = [];
                if ($room->display_options && isset($room->display_options['additional_info'])) {
                    $existingAdditionalInfo = $room->display_options['additional_info'];
                }
                $additionalInfo = $this->processAdditionalInfo($additionalInfoData, $existingAdditionalInfo);
            } else {
                // Preserve existing additional_info if not provided
                if ($room->display_options && isset($room->display_options['additional_info'])) {
                    $additionalInfo = $room->display_options['additional_info'];
                }
            }

            // Merge room info and additional info into display_options
            $displayOptions = array_merge($roomInfo, ['additional_info' => $additionalInfo]);

            // Determine status based on save_draft
            $status = $request->has('save_draft') && $request->save_draft == '1' ? 'draft' : 'published';

            // Extract additional_info fields for direct database columns
            $additionalInfoColumns = $this->extractAdditionalInfoColumns($additionalInfo);

            // Prepare update data
            $updateData = array_merge([
                'hotel_id' => $request->hotel_id ?? $room->hotel_id,
                'name' => $mainRoomName,
                'number' => $mainRoomNumber,
                'floor_number' => $mainFloorNumber,
                'price_per_night' => $request->price_per_night ?? 0,
                'weekend_price' => $request->weekend_price ?? 0,
                'holiday_price' => $request->holiday_price ?? 0,
                'discount_type' => $request->discount_type,
                'discount_amount' => $request->discount_type == 'amount' ? ($request->discount_value ?? 0) : null,
                'discount_percentage' => $request->discount_type == 'percentage' ? ($request->discount_value ?? 0) : null,
                'total_persons' => $request->total_persons ?? 0,
                'description' => $request->description,
                'size' => $mainSize,
                'total_rooms' => (int)($request->input('total_rooms', 1) ?? 1),
                'total_washrooms' => $request->total_washrooms ?? 0,
                'total_beds' => (int)($request->input('total_beds', 0) ?? 0),
                'wifi_details' => $mainWifiDetails,
                'appliances' => $appliances,
                'furniture' => $furniture,
                'amenities' => $amenities,
                'cancellation_policy' => $cancellation_policy,
                'cancellation_policy_texts' => (array)$request->input('cancellation_policy_texts', $room->cancellation_policy_texts ?? []),
                'display_options' => $displayOptions, // Store room information and additional info in display_options
                'is_active' => $request->boolean('is_active', false),
                'status' => $status,
                'availability_dates' => $this->processAvailabilityDates($request->availability_dates),
            ], $additionalInfoColumns);

            // Handle cancellation policies - SAVE GLOBALLY (not per-room)
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
            if ($request->has('enabled_cancellation_policies_sent') || $request->has('enabled_cancellation_policies_force') || $request->has('cancellation_policy_texts') || $request->has('cancellation_policy') || $request->has('enabled_cancellation_policies')) {
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
            if ($request->has('custom_cancellation_policies') || $request->has('enabled_cancellation_policies_sent') || $request->has('enabled_cancellation_policies_force') || $request->has('enabled_cancellation_policies')) {
                $hotelSetting->save();
            }

            // Update the room
            $room->update($updateData);

            Log::info('Room updated', [
                'room_id' => $room->id,
                'total_beds' => $room->total_beds,
                'cancellation_policy' => $room->cancellation_policy,
                'discount_type' => $room->discount_type,
                'discount_amount' => $room->discount_amount,
                'discount_percentage' => $room->discount_percentage,
            ]);

            // Handle photo uploads
            $photoCategories = [
                'feature_main_photos' => 'feature_main',
                'bedroom_photos' => 'bedroom',
                'washroom_photos' => 'washroom',
                'balcony_photos' => 'balcony',
                'living_dining_photos' => 'living_dining',
                'furniture_photos' => 'furniture',
                'appliances_photos' => 'appliances',
                'kitchen_photos' => 'kitchen',
                'amenity_photos' => 'amenity',
                'bedroom2_photos' => 'bedroom2',
                'bedroom3_photos' => 'bedroom3',
                'washroom2_photos' => 'washroom2',
                'washroom3_photos' => 'washroom3',
                'additional_photos' => 'additional',
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

    /**
     * Process availability dates from request
     */
    /**
     * Process additional_info dynamically - handles all fields automatically
     * 
     * @param array $additionalInfoData Input data from request
     * @param array|null $existingAdditionalInfo Existing data from room (for updates)
     * @return array Processed additional_info array
     */
    private function processAdditionalInfo($additionalInfoData, $existingAdditionalInfo = null)
    {
        // Start with existing data if updating, otherwise empty array
        $additionalInfo = $existingAdditionalInfo ?? [];
        
        // Merge new data with existing data (new data takes precedence)
        // This ensures all submitted fields are included
        $additionalInfo = array_merge($additionalInfo, $additionalInfoData);
        
        // Don't filter out empty strings - we want to preserve all fields
        // Empty strings will be stored as empty strings, which is fine for notes
        
        // Ensure all expected fields exist (for backward compatibility and consistency)
        $expectedFields = [
            // Additional Bed Policy
            'additional_bed_available', 'bed_fee_type', 'bed_fee_amount', 'bed_fee_currency', 'bed_fee_unit', 'bed_note',
            // Children & Extra Guest Policy
            'children_guest_policy_available', 'children_guest_policy_type', 'children_guest_fee_amount', 
            'children_guest_fee_currency', 'children_guest_fee_unit', 'children_guest_note',
            // Laundry Service
            'laundry_service', 'laundry_service_type', 'laundry_fee_amount', 'laundry_fee_currency', 
            'laundry_fee_unit', 'laundry_note',
            // Housekeeping Service
            'housekeeping_service', 'housekeeping_service_type', 'housekeeping_fee_amount', 
            'housekeeping_fee_currency', 'housekeeping_fee_unit', 'housekeeping_note',
            // Check-in & Check-out Policy
            'checkin_time', 'checkout_time', 'late_checkout_fee', 'early_checkin_fee',
            // Security Deposit
            'security_deposit_required', 'security_deposit_amount', 'security_deposit_refundable',
            // Parking
            'parking_type', 'parking_fee_amount', 'parking_fee_currency', 'parking_note',
            // Pet Policy
            'pet_type', 'pet_fee', 'pet_paid_note', 'pet_complementary_note',
            // Meal Options
            'meal_type', 'meal_options', 'meal_fee', 'meal_complementary_note', 'meal_paid_note',
            // Smoking Policy
            'smoking_policy', 'smoking_policy_note',
            // Transportation Services
            'airport_pickup_type', 'airport_pickup_fee', 'airport_pickup_note',
            'shuttle_service_type', 'shuttle_service_fee', 'shuttle_service_note',
            'car_rental_type', 'car_rental_fee', 'car_rental_note',
            // Legacy fields (for backward compatibility)
            'airport_pickup', 'shuttle_service', 'car_rental', 'other_charges',
            // Legacy fields (for backward compatibility)
            'bed_policy', 'children_free_age', 'extra_adult_charge', 'parking_availability', 
            'parking_complementary_note', 'pet_policy', 'housekeeping_type', 'housekeeping_details',
            'checkin_checkout_charges', 'parking_charges', 'pet_policy_details', 'meal_details',
            'transportation_services', 'children_guest_policy'
        ];
        
        // Ensure all expected fields exist in the array
        // If a field was submitted, use it; otherwise use existing value or null
        foreach ($expectedFields as $field) {
            if (!array_key_exists($field, $additionalInfo)) {
                $additionalInfo[$field] = $additionalInfoData[$field] ?? ($existingAdditionalInfo[$field] ?? null);
            }
        }
        
        return $additionalInfo;
    }

    /**
     * Process bathrooms data - handle both old format (single array) and new format (array of arrays)
     */
    private function processBathroomsData($bathroomsData)
    {
        if (!$bathroomsData || !is_array($bathroomsData)) {
            return null;
        }
        
        // Filter out empty arrays and ensure each bathroom is an array
        $processed = array_filter(array_map(function($bathroom) {
            return is_array($bathroom) ? array_filter($bathroom) : [];
        }, $bathroomsData), function($bathroom) {
            return !empty($bathroom);
        });
        
        // Re-index array
        return !empty($processed) ? array_values($processed) : null;
    }

    /**
     * Extract additional_info fields and map them to database columns
     * 
     * @param array $additionalInfo The processed additional_info array
     * @return array Array of column => value pairs for direct database storage
     */
    private function extractAdditionalInfoColumns($additionalInfo)
    {
        $columns = [];
        
        if (empty($additionalInfo)) {
            return $columns;
        }
        
        // Additional Bed Policy
        $columns['additional_bed_available'] = $additionalInfo['additional_bed_available'] ?? null;
        $columns['bed_fee_type'] = $additionalInfo['bed_fee_type'] ?? null;
        $columns['bed_fee_amount'] = $additionalInfo['bed_fee_amount'] ?? null;
        $columns['bed_fee_currency'] = $additionalInfo['bed_fee_currency'] ?? null;
        $columns['bed_fee_unit'] = $additionalInfo['bed_fee_unit'] ?? null;
        $columns['bed_note'] = $additionalInfo['bed_note'] ?? null;
        
        // Children & Extra Guest Policy
        $columns['children_guest_policy_available'] = $additionalInfo['children_guest_policy_available'] ?? null;
        $columns['children_guest_policy_type'] = $additionalInfo['children_guest_policy_type'] ?? null;
        $columns['children_guest_fee_amount'] = $additionalInfo['children_guest_fee_amount'] ?? null;
        $columns['children_guest_fee_currency'] = $additionalInfo['children_guest_fee_currency'] ?? null;
        $columns['children_guest_fee_unit'] = $additionalInfo['children_guest_fee_unit'] ?? null;
        $columns['children_guest_note'] = $additionalInfo['children_guest_note'] ?? null;
        
        // Laundry Service
        $columns['laundry_service'] = $additionalInfo['laundry_service'] ?? null;
        $columns['laundry_service_type'] = $additionalInfo['laundry_service_type'] ?? null;
        $columns['laundry_fee_amount'] = $additionalInfo['laundry_fee_amount'] ?? null;
        $columns['laundry_fee_currency'] = $additionalInfo['laundry_fee_currency'] ?? null;
        $columns['laundry_fee_unit'] = $additionalInfo['laundry_fee_unit'] ?? null;
        $columns['laundry_note'] = $additionalInfo['laundry_note'] ?? null;
        
        // Housekeeping Service
        $columns['housekeeping_service'] = $additionalInfo['housekeeping_service'] ?? null;
        $columns['housekeeping_service_type'] = $additionalInfo['housekeeping_service_type'] ?? null;
        $columns['housekeeping_fee_amount'] = $additionalInfo['housekeeping_fee_amount'] ?? null;
        $columns['housekeeping_fee_currency'] = $additionalInfo['housekeeping_fee_currency'] ?? null;
        $columns['housekeeping_fee_unit'] = $additionalInfo['housekeeping_fee_unit'] ?? null;
        $columns['housekeeping_note'] = $additionalInfo['housekeeping_note'] ?? null;
        
        // Parking
        $columns['parking_type'] = $additionalInfo['parking_type'] ?? null;
        $columns['parking_fee_amount'] = $additionalInfo['parking_fee_amount'] ?? null;
        $columns['parking_fee_currency'] = $additionalInfo['parking_fee_currency'] ?? null;
        $columns['parking_note'] = $additionalInfo['parking_note'] ?? null;
        
        // Pet Policy
        $columns['pet_type'] = $additionalInfo['pet_type'] ?? null;
        $columns['pet_fee'] = $additionalInfo['pet_fee'] ?? null;
        $columns['pet_complementary_note'] = $additionalInfo['pet_complementary_note'] ?? null;
        $columns['pet_paid_note'] = $additionalInfo['pet_paid_note'] ?? null;
        
        // Meal Options
        $columns['meal_complementary_note'] = $additionalInfo['meal_complementary_note'] ?? null;
        $columns['meal_paid_note'] = $additionalInfo['meal_paid_note'] ?? null;
        
        return $columns;
    }

    private function processAvailabilityDates($datesInput)
    {
        if (empty($datesInput)) {
            return null;
        }
        
        try {
            // If it's a JSON string, decode it
            $dates = json_decode($datesInput, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($dates)) {
                return $dates;
            }
            
            // If it's a comma-separated string, convert to array
            if (is_string($datesInput)) {
                $dates = array_filter(array_map('trim', explode(',', $datesInput)));
                return !empty($dates) ? array_values($dates) : null;
            }
            
            // If it's already an array, return as is
            if (is_array($datesInput)) {
                return array_values(array_filter($datesInput));
            }
        } catch (\Exception $e) {
            Log::error('Error processing availability dates', ['error' => $e->getMessage()]);
        }
        
        return null;
    }

}
