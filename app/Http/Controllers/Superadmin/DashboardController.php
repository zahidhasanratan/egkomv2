<?php


namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\HotelSetting;
use App\Models\Property;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // Show the Super Admin Dashboard
    public function index()
    {

        return view('auth.super_admin.dashboard');
    }



    public function vendor_index($id)
    {
        $property = Property::where('vendor_id', $id)->first();
        return view('auth.super_admin.vendor.info', compact('property'));
    }

    public function vendor_details($id){
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

    public function vendor_store(Request $request)
    {
        $validated = $request->validate([
            'hotel_name' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_dob' => 'nullable|date',
            'contact_person_designation' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:vendors',
            'address_house' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_district' => 'nullable|string|max:255',
            'address_area' => 'nullable|string|max:255',
            'address_landmark' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'hotel_pictures' => 'nullable|array',
            'hotel_pictures.*' => 'image|mimes:jpeg,png,jpg,gif',
            'bank_check_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'nid' => 'nullable|string|max:255',
            'trade_license_bin_tin' => 'nullable|string|max:255',
            'bank_details' => 'nullable|string|max:255',
            'password' => 'required|string|min:8', // Validate password
        ]);

        // Handle file uploads
        $profilePicture = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $logo = null;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('hotel_logos', 'public');
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
            'contact_person_dob' => $validated['contact_person_dob'],
            'contact_person_designation' => $validated['contact_person_designation'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address_house' => $validated['address_house'],
            'address_city' => $validated['address_city'],
            'address_district' => $validated['address_district'],
            'address_area' => $validated['address_area'],
            'address_landmark' => $validated['address_landmark'],
            'profile_picture' => $profilePicture,
            'logo' => $logo,
            'hotel_pictures' => json_encode($hotelPictures), // Save hotel pictures as JSON
            'bank_check_picture' => $bankCheckPicture,
            'nid' => $validated['nid'],
            'trade_license_bin_tin' => $validated['trade_license_bin_tin'],
            'bank_details' => $validated['bank_details'],
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
            'contact_person_dob' => 'nullable|date',
            'contact_person_designation' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:vendors,email,' . $vendor->id,
            'address_house' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_district' => 'nullable|string|max:255',
            'address_area' => 'nullable|string|max:255',
            'address_landmark' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'hotel_pictures' => 'nullable|array',
            'hotel_pictures.*' => 'image|mimes:jpeg,png,jpg,gif',
            'bank_check_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'nid' => 'nullable|string|max:255',
            'trade_license_bin_tin' => 'nullable|string|max:255',
            'bank_details' => 'nullable|string|max:255',
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
            if ($vendor->logo) {
                Storage::disk('public')->delete($vendor->logo);
            }
            $validated['logo'] = $request->file('logo')->store('hotel_logos', 'public');
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
