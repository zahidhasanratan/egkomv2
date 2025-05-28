<?php


namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\HotelSetting;
use App\Models\Property;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function App\Http\Controllers\Vendor;

class DashboardController extends Controller
{

    public function index()
    {

        return view('auth.super_admin.dashboard');
    }


    public function vendor_index($id)
    {
        $property = Property::where('vendor_id', $id)->first();
        return view('auth.super_admin.vendor.info', compact('property'));
    }

    public function vendor_details($id)
    {
        return $id;
    }


    public function activityLog()
    {
        // Fetch the last 20 activity logs, ordered by latest first
        $activityLogs = ActivityLog::latest()->take(20)->get();

        // Return the view and pass the data to it
        return view('auth.super_admin.activityLog', compact('activityLogs'));
    }

    public function accountSettings()
    {
        $hotelSetting = HotelSetting::first(); // Get the first hotel setting record

        // If no settings are found, you can either return a default empty object or create a new one
        if (!$hotelSetting) {
            $hotelSetting = new HotelSetting();
        }
        return view('auth.super_admin.accountSettings', compact('hotelSetting'));
    }

    public function updateSettings(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'hotel_name' => 'required|string|max:255',
            'hotel_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Limit the file size
            'hotel_address' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'copyright' => 'required|string|max:255',
        ]);

        // Retrieve the first hotel setting record or create a new one if it doesn't exist
        $hotelSetting = HotelSetting::first();

        if (!$hotelSetting) {
            // If no record exists, create a new one
            $hotelSetting = new HotelSetting();
        }

        // Handle logo upload if a new logo file is provided
        if ($request->hasFile('hotel_logo')) {
            // Define the destination path
            $destinationPath = public_path('hotel_logos');

            // Create the directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate a unique file name
            $fileName = time() . '_' . $request->file('hotel_logo')->getClientOriginalName();

            // Move the file to the public/hotel_logos directory
            $request->file('hotel_logo')->move($destinationPath, $fileName);

            // Save the relative file path to the database
            $hotelSetting->hotel_logo = 'hotel_logos/' . $fileName;
        }

        // Update the hotel settings with the new values
        $hotelSetting->hotel_name = $request->hotel_name;
        $hotelSetting->hotel_address = $request->hotel_address;
        $hotelSetting->email = $request->email;
        $hotelSetting->phone = $request->phone;
        $hotelSetting->copyright = $request->copyright;

        // Save the updated record to the database
        $hotelSetting->save();

        // Redirect back with a success message
        return back()->with('success', 'Hotel settings updated successfully!');
    }


    public function accountEmail()
    {
        $activityLogs = ActivityLog::latest()->take(20)->get();
        return view('auth.super_admin.accountEmail', compact('activityLogs'));
    }

    public function accountSecurity()
    {
        $activityLogs = ActivityLog::latest()->take(20)->get();
        return view('auth.super_admin.accountSecurity', compact('activityLogs'));
    }

    public function vendor_create()
    {
        return view('auth.super_admin.vendor_create');
    }

    public function allVendorList()
    {
        $vendorList = Vendor::all();
        return view('auth.super_admin.allVendorList', compact('vendorList'));
    }

    public function vendorInfoCreate($id)
    {
        $property = Property::where('vendor_id', $id)->first();
        return view('auth.super_admin.vendorInfo', compact('property'));
    }

    public function vendorInfoStore(Request $request)
    {
        $vendorId = $request->vendor_id;
        $property = Property::where('vendor_id', $vendorId)->first();

        $logoPath = $property->company_logo ?? null; // Retain old logo if not uploaded
        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('storage/logos');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $file->move($destinationPath, $fileName);
                $logoPath = 'storage/logos/' . $fileName;
            }
        }

        $sanitizeInteger = function ($value) {
            return is_numeric($value) && $value >= 0 ? (int)$value : null;
        };

        // Prepare only non-null data
        $newData = [
            'property_name' => $request->input('property_name'),
            'property_category' => $request->input('property_category'),
            'property_type' => $request->input('property_type'),
            'room_types' => $request->has('room_types') ? $request->input('room_types') : ($property->room_types ?? []),
            'country_name' => $request->input('country_name'),
            'district_name' => $request->input('district_name'),
            'city_town_village' => $request->input('city_town_village'),
            'postcode' => $request->input('postcode'),
            'house_number' => $request->input('house_number'),
            'road_number_name' => $request->input('road_number_name'),
            'building_age' => $sanitizeInteger($request->input('building_age')),
            'building_size' => $sanitizeInteger($request->input('building_size')),
            'building_stories' => $sanitizeInteger($request->input('building_stories')),
            'landmark_details' => $request->input('landmark_details'),
            'google_map_link' => $request->input('google_map_link'),
            'company_logo' => $logoPath,
            'apartment_count' => $sanitizeInteger($request->input('apartment_count')),
            'apartments' => $request->input('apartments', []),
            'total_capacity' => $sanitizeInteger($request->input('total_capacity')),
            'car_parking' => $sanitizeInteger($request->input('total_car_parking')),
            'has_reception' => $request->input('reception') === 'yes',
            'elevators' => $sanitizeInteger($request->input('total_lifts')),
            'generators' => $sanitizeInteger($request->input('total_generators')),
            'fire_exits' => $sanitizeInteger($request->input('total_fire_exits')),
            'wheelchair_access' => $request->input('wheelchair_access') === 'yes',
            'male_housekeeping' => $sanitizeInteger($request->input('male_housekeeping')),
            'female_housekeeping' => $sanitizeInteger($request->input('female_housekeeping')),
            'has_kids_zone' => $request->input('kids_zone') === 'yes',
            'kids_zone_count' => $sanitizeInteger($request->input('kids_zone_count')),
            'view_type' => $request->input('view_from_hotel'),
            'security_guards' => $sanitizeInteger($request->input('security_guards')),
            'has_cafe_restaurant' => $request->input('cafe_restaurants') === 'yes',
            'cafe_restaurant_count' => $sanitizeInteger($request->input('cafe_restaurants_count')),
            'cafe_restaurant_names' => $request->input('cafe_restaurants_names', []),
            'has_pool' => $request->input('pool') === 'yes',
            'pool_count' => $sanitizeInteger($request->input('pool_count')),
            'has_bar' => $request->input('bar') === 'yes',
            'bar_count' => $sanitizeInteger($request->input('bar_count')),
            'has_gym' => $request->input('gym') === 'yes',
            'gym_count' => $sanitizeInteger($request->input('gym_count')),
            'has_party_center' => $request->input('party_center') === 'yes',
            'party_center_details' => $request->input('party_center_details'),
            'has_conference_hall' => $request->input('conference_hall') === 'yes',
            'conference_hall_details' => $request->input('conference_hall_details'),
            'status' => $request->input('action') === 'submit' ? 'submitted' : 'draft',
        ];

        // Retain old values where new ones are not provided
        $data = array_merge($property ? $property->toArray() : [], array_filter($newData, fn($value) => !is_null($value)));

        // Update or create the property record
        Property::updateOrCreate(
            ['vendor_id' => $vendorId], // Condition
            $data // Updated data
        );

        $message = $data['status'] === 'submitted' ? 'submitted' : 'saved as draft';
//        return redirect()->route('vendor-admin.vendor.create')->with('success', "Property information $message successfully!");

// Conditional redirect based on the status
        if ($data['status'] === 'submitted') {
            return redirect()->route('super.vendor.infoCreate',$vendorId)->with('success', "Property information $message successfully!");
        } else {
            return redirect()->route('super.vendor.infoCreate',$vendorId)->with('success', "Property information $message successfully!");
        }

    }



    public function vendor_store(Request $request)
    {
        $validated = $request->validate([
            'hotel_name' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
//            'contact_person_dob' => 'nullable|date',
            'contact_person_designation' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:vendors',
            'address_house' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_district' => 'nullable|string|max:255',
//            'address_area' => 'nullable|string|max:255',
            'address_landmark' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'hotel_pictures' => 'nullable|array',
            'hotel_pictures.*' => 'image|mimes:jpeg,png,jpg,gif',
            'bank_check_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'nid' => 'nullable|string|max:255',
//            'trade_license_bin_tin' => 'nullable|string|max:255',
//            'bank_details' => 'nullable|string|max:255',
            'password' => 'required|string|min:8', // Validate password
        ]);

        // Handle file uploads
        $profilePicture = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $logo = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('hotel_logos'), $filename);
            $logo = 'hotel_logos/' . $filename;
        }


        $hotelPictures = [];
        if ($request->hasFile('hotel_pictures')) {
            foreach ($request->file('hotel_pictures') as $file) {
                $hotelPictures[] = $file->store('hotel_pictures', 'public');
            }
        }

        $bankCheckPicture = null;
        if ($request->hasFile('bank_check_picture')) {
            $bankCheckPicture = $request->file('bank_check_picture')->store('bank_check_pictures', 'public');
        }

        // Create the vendor
        $vendor = Vendor::create([
            'hotel_name' => $validated['hotel_name'],
            'contact_person_name' => $validated['contact_person_name'],
//            'contact_person_dob' => $validated['contact_person_dob'],
            'contact_person_designation' => $validated['contact_person_designation'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address_house' => $validated['address_house'],
            'address_city' => $validated['address_city'],
            'address_district' => $validated['address_district'],
//            'address_area' => $validated['address_area'],
            'address_landmark' => $validated['address_landmark'],
            'profile_picture' => $profilePicture,
            'logo' => $logo,
            'hotel_pictures' => json_encode($hotelPictures), // Save hotel pictures as JSON
            'bank_check_picture' => $bankCheckPicture,
            'nid' => $validated['nid'],
//            'trade_license_bin_tin' => $validated['trade_license_bin_tin'],
//            'bank_details' => $validated['bank_details'],
            'password' => bcrypt($validated['password']), // Hash the password
        ]);
        $vendor->vendorId = 'Ven-' . $vendor->id; // Create the vendorId
        $vendor->save();
        // Redirect to the vendor list page with a success message
        return redirect()->route('super-admin.vendor.index')->with('success', 'Vendor created successfully!');
    }

    public function vendor_edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('auth.super_admin.vendor_edit', compact('vendor'));
    }

    public function vendor_update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $validated = $request->validate([
            'hotel_name' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
//            'contact_person_dob' => 'nullable|date',
            'contact_person_designation' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:vendors,email,' . $vendor->id,
            'address_house' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_district' => 'nullable|string|max:255',
//            'address_area' => 'nullable|string|max:255',
            'address_landmark' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'hotel_pictures' => 'nullable|array',
            'hotel_pictures.*' => 'image|mimes:jpeg,png,jpg,gif',
            'bank_check_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'nid' => 'nullable|string|max:255',
//            'trade_license_bin_tin' => 'nullable|string|max:255',
//            'bank_details' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        // Handle file uploads
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($vendor->profile_picture) {
                Storage::disk('public')->delete($vendor->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($vendor->logo && File::exists(public_path($vendor->logo))) {
                File::delete(public_path($vendor->logo));
            }

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('hotel_logos'), $filename);
            $validated['logo'] = 'hotel_logos/' . $filename;
        }

        if ($request->hasFile('hotel_pictures')) {
            // Delete old pictures
            $oldPictures = json_decode($vendor->hotel_pictures, true) ?? [];
            foreach ($oldPictures as $picture) {
                Storage::disk('public')->delete($picture);
            }
            $hotelPictures = [];
            foreach ($request->file('hotel_pictures') as $file) {
                $hotelPictures[] = $file->store('hotel_pictures', 'public');
            }
            $validated['hotel_pictures'] = json_encode($hotelPictures);
        }

        if ($request->hasFile('bank_check_picture')) {
            if ($vendor->bank_check_picture) {
                Storage::disk('public')->delete($vendor->bank_check_picture);
            }
            $validated['bank_check_picture'] = $request->file('bank_check_picture')->store('bank_check_pictures', 'public');
        }

        // Update password if provided
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Update vendor
        $vendor->update($validated);

        return redirect()->route('super-admin.vendor.index')->with('success', 'Vendor updated successfully!');
    }

}
