<?php


namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\HotelSetting;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // Show the Super Admin Dashboard
    public function index()
    {

        return view('auth.vendor.dashboard');
    }

    public function vendorInfo()
    {

        $data = [
            'Hotels' => [
                'districts' => [
                    'hotel' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Luxury Hotels' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Resort Hotels' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Budget Hotels' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Hotels 3 Star' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Hotels 4 Star' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Hotels 5 Star' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                ]
            ],
            'Transit' => [
                'districts' => [
                    'Airport Hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                    'Station Hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                    'Bus Stop Hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                    'Jetty Hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                    'Hospital & Visa Center Area hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                ]
            ],
            'Resorts' => [
                'districts' => [
                    'Resorts' => [
                        'Luxury Resort Suites', 'Oceanfront Villas', 'Private Pool Villas', 'Garden View Rooms',
                        'Eco Resorts & Hotels', 'Bamboo Cottages', 'Solar-Powered Cabins', 'Off-Grid Stays',
                        'Farm Stays', 'Rustic Farmhouses', 'Luxury Farm Villas', 'Campsites', 'Standard Camping Tent',
                        'Luxury Tent (Glamping)', 'RV/Caravan Parking', 'Glamping', 'Safari-Style Tents', 'Dome Pods',
                        'Airstream Trailers', 'Treehouses', 'Basic Tree Cabins', 'Luxury Tree Villas', 'Adventure Resorts',
                        'Zipline Resorts', 'Rock Climbing Camps', 'Water Sports Resorts', 'Wellness Retreats',
                        'Ayurveda Resorts', 'Yoga Retreats', 'Meditation Centers', 'Beach Resorts', 'Overwater Bungalows',
                        'Beach Huts', 'Mountain Resorts', 'Safari Lodges', 'Wildlife Observation Rooms', 'Riverside Safari Cottages'
                    ],
                    // Add other resort sub-types if needed
                ]
            ],
            'Lodges' => [
                'districts' => [
                    'Hostels' => [
                        'Single Bed in Dormitory/Room/Apartment', 'Oceanfront Villas', 'Private Room/Apartment',
                        'Female-Only Dormitory/Apartment/Room', 'Male-Only Dormitory/Apartment/Room',
                        'Mixed Dormitory: Shared Room (All Genders)', 'Studio Apartment-Style Hostel'
                    ],
                    'Motels' => [
                        'Single Bed in Dormitory/Room/Apartment', 'Oceanfront Villas', 'Private Room/Apartment',
                        'Female-Only Dormitory/Apartment/Room', 'Male-Only Dormitory/Apartment/Room',
                        'Mixed Dormitory: Shared Room (All Genders)', 'Studio Apartment-Style Hostel'
                    ],
                    // Add other lodge sub-types
                ]
            ],
            'Apartments' => [
                'districts' => [
                    'Apartments' => [
                        'Luxury Serviced Apartments', 'Budget Serviced Apartments', 'Furnished Apartments',
                        'Unfurnished Apartments', 'Studio Apartments', 'One-Bedroom Apartments', 'Two-Bedroom Apartments',
                        'Three-Bedroom Apartments', 'Penthouse Apartments', 'Shared Apartments'
                    ],
                    'Homestays' => [
                        'Luxury Serviced Apartments', 'Budget Serviced Apartments', 'Furnished Apartments',
                        'Unfurnished Apartments', 'Studio Apartments', 'One-Bedroom Apartments', 'Two-Bedroom Apartments',
                        'Three-Bedroom Apartments', 'Penthouse Apartments', 'Shared Apartments'
                    ],
                ]
            ],
            'Guesthouses' => [
                'districts' => [
                    'Vacation Rentals' => [
                        'Bed Only', 'Room with Shared Bathroom', 'Entire Place', 'Private Room', 'Entire House',
                        'Farmhouse Room', 'Tent/Glamping Tent', 'RV/Caravan: Mobile Accommodations'
                    ],
                    'Guesthouses' => [
                        'Bed Only', 'Room with Shared Bathroom', 'Entire Place', 'Private Room', 'Entire House',
                        'Farmhouse Room', 'Tent/Glamping Tent', 'RV/Caravan: Mobile Accommodations'
                    ],
                ]
            ],
            'Crisis' => [
                'districts' => [
                    'Old Age Homes' => ['Old Age Homes', 'Orphanages', 'Rehabilitation Centers', 'Asylums'],
                    'Orphanages' => ['Old Age Homes', 'Orphanages', 'Rehabilitation Centers', 'Asylums'],
                    'Rehabilitation Centers' => ['Old Age Homes', 'Orphanages', 'Rehabilitation Centers', 'Asylums'],
                    'Asylums' => ['Old Age Homes', 'Orphanages', 'Rehabilitation Centers', 'Asylums'],
                ]
            ],
        ];

        // Pass the data to the view
        return view('auth.vendor.info', compact('data'));
    }



    public function activityLog()
    {
        // Fetch the last 20 activity logs, ordered by latest first
        $activityLogs = ActivityLog::latest()->take(20)->get();

        // Return the view and pass the data to it
        return view('auth.vendor.activityLog', compact('activityLogs'));
    }
    public function accountSettings()
    {
        $auth_id = Auth::id();
        $vendorSetting = Vendor::find($auth_id);

        // If no settings are found, you can either return a default empty object or create a new one
        if (!$vendorSetting) {
            $hotelSetting = new HotelSetting();
        }
        return view('auth.vendor.accountSettings', compact('vendorSetting'));
    }
    public function updateSettings(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'hotel_name' => 'required|string|max:255',
            'hotel_address' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        // Retrieve the first hotel setting record or create a new one if it doesn't exist
        $hotelSetting = Vendor::first();

        if (!$hotelSetting) {
            // If no record exists, create a new one
            $hotelSetting = new Vendor();
        }


        // Update the hotel settings with the new values
        $hotelSetting->hotel_name = $request->hotel_name;
        $hotelSetting->contact_person_name = $request->hotel_address;
        $hotelSetting->email = $request->email;
        $hotelSetting->phone = $request->phone;

        // Save the updated record to the database
        $hotelSetting->save();

        // Redirect back with a success message
        return back()->with('success', 'Vendor settings updated successfully!');
    }


    public function accountEmail()
    {
        $activityLogs = ActivityLog::latest()->take(20)->get();
        return view('auth.vendor.accountEmail', compact('activityLogs'));
    }

    public function accountSecurity()
    {
        $activityLogs = ActivityLog::latest()->take(20)->get();
        return view('auth.vendor.accountSecurity', compact('activityLogs'));
    }




}
