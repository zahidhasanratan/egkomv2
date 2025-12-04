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
        Log::info('Received store request', [
            'raw_input' => $request->all(),
            'cancellation_policy' => $request->input('cancellation_policy', []),
        ]);

        // Merge standard and custom arrays, ensuring uniqueness and filtering out null/empty values
        $appliances = array_unique(array_filter(array_merge($request->appliances ?? [], $request->custom_appliances ?? [])));
        $furniture = array_unique(array_filter(array_merge($request->furniture ?? [], $request->custom_furniture ?? [])));
        $amenities = array_unique(array_filter(array_merge($request->amenities ?? [], $request->custom_amenities ?? [])));
        $cancellation_policy = array_unique(array_filter((array)$request->input('cancellation_policy', [])));

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
                            $destinationPath = public_path('room_photos');

                            // Ensure the directory exists
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0775, true);
                            }

                            $photo->move($destinationPath, $filename);

                            RoomPhoto::create([
                                'room_id' => $room->id,
                                'photo_path' => 'room_photos/' . $filename,
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
        Log::info('Received store request from super admin', [
            'raw_input' => $request->all(),
            'cancellation_policy' => $request->input('cancellation_policy', []),
        ]);

        // Merge standard and custom arrays, ensuring uniqueness and filtering out null/empty values
        $appliances = array_unique(array_filter(array_merge($request->appliances ?? [], $request->custom_appliances ?? [])));
        $furniture = array_unique(array_filter(array_merge($request->furniture ?? [], $request->custom_furniture ?? [])));
        $amenities = array_unique(array_filter(array_merge($request->amenities ?? [], $request->custom_amenities ?? [])));
        $cancellation_policy = array_unique(array_filter((array)$request->input('cancellation_policy', [])));

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
                            $destinationPath = public_path('room_photos');

                            // Ensure the directory exists
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0775, true);
                            }

                            $photo->move($destinationPath, $filename);

                            RoomPhoto::create([
                                'room_id' => $room->id,
                                'photo_path' => 'room_photos/' . $filename,
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
            $room = Room::findOrFail($roomId);
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
            $room = Room::findOrFail($roomId);
            $hotelId = $room->hotel_id;
            return view('auth.super_admin.room.edit', ['room' => $room, 'hotel' => $hotelId]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            \Log::error("Decryption failed for ID: $id", ['error' => $e->getMessage()]);
            abort(404, 'Invalid or tampered room ID');
        }
    }



    public function update(Request $request, $id)
    {
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

            foreach ($photoCategories as $inputName => $category) {
                if ($request->hasFile($inputName)) {
                    foreach ($request->file($inputName) as $index => $photo) {
                        try {
                            if ($photo->isValid()) {
                                $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                                $destinationPath = public_path('room_photos');

                                // Ensure the directory exists
                                if (!file_exists($destinationPath)) {
                                    mkdir($destinationPath, 0775, true);
                                }

                                $photo->move($destinationPath, $filename);

                                RoomPhoto::create([
                                    'room_id' => $room->id,
                                    'photo_path' => 'room_photos/' . $filename,
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

            return redirect()->route('vendor-admin.room.index', ['id' => Crypt::encrypt($room->hotel_id)])
                ->with('success', 'Room updated successfully!');

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

            foreach ($photoCategories as $inputName => $category) {
                if ($request->hasFile($inputName)) {
                    foreach ($request->file($inputName) as $index => $photo) {
                        try {
                            if ($photo->isValid()) {
                                $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                                $destinationPath = public_path('room_photos');

                                // Ensure the directory exists
                                if (!file_exists($destinationPath)) {
                                    mkdir($destinationPath, 0775, true);
                                }

                                $photo->move($destinationPath, $filename);

                                RoomPhoto::create([
                                    'room_id' => $room->id,
                                    'photo_path' => 'room_photos/' . $filename, // relative to public folder
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


            return redirect()->route('super-admin.room.index', ['id' => Crypt::encrypt($room->hotel_id)])
                ->with('success', 'Room updated successfully!');

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

            // Delete the file from storage
            if (Storage::disk('public')->exists($photo->photo_path)) {
                Storage::disk('public')->delete($photo->photo_path);
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

            // Delete the file from storage
            if (Storage::disk('public')->exists($photo->photo_path)) {
                Storage::disk('public')->delete($photo->photo_path);
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
