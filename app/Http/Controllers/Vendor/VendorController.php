<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{


    public function store(Request $request)
    {
        $vendorId = Auth::id();
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
            return is_numeric($value) && $value >= 0 ? (int) $value : null;
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
            return redirect()->route('vendor-admin.owner.create')->with('success', "Property information $message successfully!");
        } else {
            return redirect()->route('vendor-admin.vendor.create')->with('success', "Property information $message successfully!");
        }

    }

    public function storeSuper(Request $request)
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
            return is_numeric($value) && $value >= 0 ? (int) $value : null;
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
            return redirect()->route('super-admin.vendor.details',$vendorId)->with('success', "Property information $message successfully!");
        } else {
            return redirect()->route('super-admin.vendor.details',$vendorId)->with('success', "Property information $message successfully!");
        }

    }



//    public function store(Request $request)
//    {
//        $logoPath = null;
//        if ($request->hasFile('company_logo')) {
//            $file = $request->file('company_logo');
//            if ($file->isValid()) {
//                $fileName = time() . '_' . $file->getClientOriginalName();
//                $destinationPath = public_path('storage/logos');
//
//                if (!file_exists($destinationPath)) {
//                    mkdir($destinationPath, 0777, true);
//                }
//
//                $file->move($destinationPath, $fileName);
//                $logoPath = 'storage/logos/' . $fileName;
//            }
//        }
//
//        $sanitizeInteger = function ($value) {
//            return is_numeric($value) && $value >= 0 ? (int) $value : null;
//        };
//
//        $vendorId = Auth::id();
//        $property = Property::where('vendor_id', $vendorId)->first();
//
//        $data = [
//            'vendor_id' => $vendorId,
//            'property_name' => $request->input('property_name', $property->property_name ?? null),
//            'property_category' => $request->input('property_category', $property->property_category ?? null),
//            'property_type' => $request->input('property_type', $property->property_type ?? null),
//            'room_types' => $request->input('room_types', $property->room_types ?? []),
//            'country_name' => $request->input('country_name', $property->country_name ?? null),
//            'district_name' => $request->input('district_name', $property->district_name ?? null),
//            'city_town_village' => $request->input('city_town_village', $property->city_town_village ?? null),
//            'postcode' => $request->input('postcode', $property->postcode ?? null),
//            'house_number' => $request->input('house_number', $property->house_number ?? null),
//            'road_number_name' => $request->input('road_number_name', $property->road_number_name ?? null),
//            'building_age' => $sanitizeInteger($request->input('building_age')) ?? $property->building_age,
//            'building_size' => $sanitizeInteger($request->input('building_size')) ?? $property->building_size,
//            'building_stories' => $sanitizeInteger($request->input('building_stories')) ?? $property->building_stories,
//            'landmark_details' => $request->input('landmark_details', $property->landmark_details ?? null),
//            'google_map_link' => $request->input('google_map_link', $property->google_map_link ?? null),
//            'company_logo' => $logoPath ?? $property->company_logo,
//            'apartment_count' => $sanitizeInteger($request->input('apartment_count')) ?? $property->apartment_count,
//            'status' => $request->input('action') === 'submit' ? 'submitted' : 'draft',
//        ];
//
//        // Filter out null values so existing values are not overwritten
//        $filteredData = array_filter($data, fn($value) => !is_null($value));
//
//        Property::updateOrCreate(['vendor_id' => $vendorId], $filteredData);
//
//        $message = $data['status'] === 'submitted' ? 'submitted' : 'saved as draft';
//        return redirect()->route('vendor-admin.vendor.create')->with('success', "Property information $message successfully!");
//    }


    public function create()
    {
        $property = Property::where('vendor_id', Auth::id())->first();
        return view('auth.vendor.info', compact('property'));
    }






}
