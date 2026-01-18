<?php


namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\HotelSetting;
use App\Models\Property;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
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

    public function cancellationPolicySettings()
    {
        $hotelSetting = HotelSetting::first();
        
        if (!$hotelSetting) {
            $hotelSetting = new HotelSetting();
            $hotelSetting->hotel_name = 'Default';
            $hotelSetting->hotel_address = '';
            $hotelSetting->email = '';
            $hotelSetting->phone = '';
            $hotelSetting->copyright = '';
            $hotelSetting->save();
        }
        
        return view('auth.super_admin.cancellationPolicySettings', compact('hotelSetting'));
    }

    public function updateCancellationPolicySettings(Request $request)
    {
        $request->validate([
            // Hotel policies
            'cancellation_policy_texts' => 'nullable|array',
            'cancellation_policy_texts.*' => 'nullable|string',
            'custom_cancellation_policies' => 'nullable|array',
            'enabled_cancellation_policies' => 'nullable|array',
            // Room policies
            'room_cancellation_policy_texts' => 'nullable|array',
            'room_cancellation_policy_texts.*' => 'nullable|string',
            'room_custom_cancellation_policies' => 'nullable|array',
            'room_enabled_cancellation_policies' => 'nullable|array',
        ]);

        $hotelSetting = HotelSetting::first();
        
        if (!$hotelSetting) {
            $hotelSetting = new HotelSetting();
            $hotelSetting->hotel_name = 'Default';
            $hotelSetting->hotel_address = '';
            $hotelSetting->email = '';
            $hotelSetting->phone = '';
            $hotelSetting->copyright = '';
        }

        // ========== HOTEL POLICIES ==========
        // Handle hotel policy texts
        if ($request->has('cancellation_policy_texts')) {
            $policyTexts = array_filter(
                (array)$request->input('cancellation_policy_texts', []),
                fn($v) => $v !== null && trim($v) !== ''
            );
            $hotelSetting->cancellation_policy_texts = !empty($policyTexts) ? $policyTexts : null;
        }

        // Handle hotel custom policies
        if ($request->has('custom_cancellation_policies')) {
            $customPolicies = [];
            foreach ($request->input('custom_cancellation_policies', []) as $index => $policy) {
                if (!empty($policy['text']) && trim($policy['text']) !== '') {
                    $customPolicies[] = [
                        'key' => $policy['key'] ?? 'custom_' . ($index + 1),
                        'text' => $policy['text']
                    ];
                }
            }
            $hotelSetting->custom_cancellation_policies = !empty($customPolicies) ? $customPolicies : null;
        }

        // Handle hotel enabled policies
        if ($request->has('enabled_cancellation_policies_force') || $request->has('enabled_cancellation_policies')) {
            $enabledPolicies = array_filter(
                (array)$request->input('enabled_cancellation_policies', []),
                fn($v) => $v !== null && $v !== ''
            );
            
            if ($request->has('enabled_cancellation_policies_force') && empty($enabledPolicies)) {
                $hotelSetting->enabled_cancellation_policies = [];
            } else {
                $hotelSetting->enabled_cancellation_policies = $enabledPolicies;
            }
        }

        // ========== ROOM POLICIES ==========
        // Handle room policy texts
        if ($request->has('room_cancellation_policy_texts')) {
            $roomPolicyTexts = array_filter(
                (array)$request->input('room_cancellation_policy_texts', []),
                fn($v) => $v !== null && trim($v) !== ''
            );
            $hotelSetting->room_cancellation_policy_texts = !empty($roomPolicyTexts) ? $roomPolicyTexts : null;
        }

        // Handle room custom policies
        if ($request->has('room_custom_cancellation_policies')) {
            $roomCustomPolicies = [];
            foreach ($request->input('room_custom_cancellation_policies', []) as $index => $policy) {
                if (!empty($policy['text']) && trim($policy['text']) !== '') {
                    $roomCustomPolicies[] = [
                        'key' => $policy['key'] ?? 'custom_' . ($index + 1),
                        'text' => $policy['text']
                    ];
                }
            }
            $hotelSetting->room_custom_cancellation_policies = !empty($roomCustomPolicies) ? $roomCustomPolicies : null;
        }

        // Handle room enabled policies
        if ($request->has('room_enabled_cancellation_policies_force') || $request->has('room_enabled_cancellation_policies')) {
            $roomEnabledPolicies = array_filter(
                (array)$request->input('room_enabled_cancellation_policies', []),
                fn($v) => $v !== null && $v !== ''
            );
            
            if ($request->has('room_enabled_cancellation_policies_force') && empty($roomEnabledPolicies)) {
                $hotelSetting->room_enabled_cancellation_policies = [];
            } else {
                $hotelSetting->room_enabled_cancellation_policies = $roomEnabledPolicies;
            }
        }

        $hotelSetting->save();

        return back()->with('success', 'Cancellation policy settings updated successfully!');
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

    public function vendorInfoShow($id)
    {
        $property = Property::where('vendor_id', $id)->first();
        return view('auth.super_admin.vendorInfo_show', compact('property'));
    }

    public function vendor_store(Request $request)
    {
        Log::info('vendor_store() hit', ['url' => $request->fullUrl()]);

        // 1) Validate what the form actually sends
        $request->validate([
            // Vendor
            'property_name' => 'required|string|max:255',       // used as Vendor.hotel_name and Property.property_name
            'email'         => 'required|email|max:255|unique:vendors,email',
            'password'      => 'required|string|min:8',

            // Property basics
            'country_name'      => 'nullable|string|max:100',
            'district_name'     => 'nullable|string|max:100',
            'city_town_village' => 'nullable|string|max:255',
            'postcode'          => 'nullable|string|max:50',
            'house_number'      => 'nullable|string|max:100',
            'road_number_name'  => 'nullable|string|max:255',

            'company_logo'      => 'nullable|image|max:5120',

            'total_capacity'     => 'nullable|integer|min:0',
            'total_car_parking'  => 'nullable|integer|min:0',
            'reception'          => 'nullable|in:yes,no',
            'total_lifts'        => 'nullable|integer|min:0',
            'total_generators'   => 'nullable|integer|min:0',
            'total_fire_exits'   => 'nullable|integer|min:0',
            'wheelchair_access'  => 'nullable|in:yes,no',

            'male_housekeeping'   => 'nullable|integer|min:0',
            'female_housekeeping' => 'nullable|integer|min:0',

            'kids_zone'        => 'nullable|in:yes,no',
            'kids_zone_count'  => 'nullable|integer|min:0',

            'view_from_hotel'  => 'nullable|string|max:255',
            'security_guards'  => 'nullable|integer|min:0',

            'cafe_restaurants'        => 'nullable|in:yes,no',
            'cafe_restaurants_count'  => 'nullable|integer|min:0',
            'cafe_restaurant_names'   => 'nullable|array',
            'cafe_restaurant_names.*' => 'nullable|string|max:255',
            'cafe_names'              => 'nullable|array',
            'cafe_names.*'            => 'nullable|string|max:255',

            'pool'       => 'nullable|in:yes,no',
            'pool_count' => 'nullable|integer|min:0',

            'bar'        => 'nullable|in:yes,no',
            'bar_count'  => 'nullable|integer|min:0',

            'gym'        => 'nullable|in:yes,no',
            'gym_count'  => 'nullable|integer|min:0',

            'party_center'         => 'nullable|in:yes,no',
            'party_center_details' => 'nullable|string|max:2000',

            'conference_hall'         => 'nullable|in:yes,no',
            'conference_hall_details' => 'nullable|string|max:2000',
        ]);

        // helpers
        $toInt  = fn($v, $def = 0) => (is_numeric($v) && (int)$v >= 0) ? (int)$v : $def;
        $asBool = fn($yesNo) => $yesNo === 'yes';
        $str    = fn($v, $fallback = '') => ($v !== null ? (string)$v : $fallback);

        // Accept either cafe_restaurant_names[] or cafe_names[]
        $cafeNames = $request->has('cafe_restaurant_names')
            ? (array)$request->input('cafe_restaurant_names', [])
            : (array)$request->input('cafe_names', []);
        $cafeNames = array_values(array_filter(array_map('trim', $cafeNames)));

        // Optional logo upload
        $logoPath = null;
        if ($request->hasFile('company_logo') && $request->file('company_logo')->isValid()) {
            $file     = $request->file('company_logo');
            $fileName = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $dest     = public_path('storage/logos');
            if (!is_dir($dest)) { @mkdir($dest, 0777, true); }
            $file->move($dest, $fileName);
            $logoPath = 'storage/logos/'.$fileName;
        }

        DB::beginTransaction();
        try {
            // 2) Create Vendor
            $vendor = new Vendor();
            $vendor->hotel_name = $request->input('property_name');
            $vendor->email      = $request->input('email');
            $vendor->password   = bcrypt($request->input('password'));

            // If your vendors table has other NOT NULL columns, set safe defaults
            $maybeCols = [
                'phone','contact_person_name','contact_person_designation',
                'address_house','address_city','address_district','address_landmark',
                'nid','profile_picture','logo','bank_check_picture'
            ];
            foreach ($maybeCols as $col) {
                if (Schema::hasColumn('vendors', $col) && $vendor->{$col} === null) {
                    $vendor->{$col} = ''; // empty string to satisfy NOT NULL
                }
            }

            $vendor->save();
            Log::info('Vendor inserted', ['vendor_id' => $vendor->id]);

            // Optional readable code
            if (Schema::hasColumn('vendors', 'vendorId')) {
                $vendor->vendorId = 'Ven-'.$vendor->id;
                $vendor->save();
            }

            // 3) Create Property tied to Vendor
            $property = new Property();
            $property->vendor_id             = $vendor->id;
            $property->property_name         = $str($request->input('property_name'));
            $property->property_category     = $str($request->input('property_category'), 'Hotels'); // safe default
            $property->property_type         = $str($request->input('property_type'), '');

            // arrays (your casts will JSON them)
            $property->room_types            = [];
            $property->apartments            = [];
            $property->cafe_restaurant_names = $cafeNames;

            $property->country_name          = $str($request->input('country_name'), '');
            $property->district_name         = $str($request->input('district_name'), '');
            $property->city_town_village     = $str($request->input('city_town_village'), '');
            $property->postcode              = $str($request->input('postcode'), '');
            $property->house_number          = $str($request->input('house_number'), '');
            $property->road_number_name      = $str($request->input('road_number_name'), '');

            $property->building_age          = $toInt($request->input('building_age'), 0);
            $property->building_size         = $toInt($request->input('building_size'), 0);
            $property->building_stories      = $toInt($request->input('building_stories'), 0);
            $property->landmark_details      = $str($request->input('landmark_details'), '');
            $property->google_map_link       = $str($request->input('google_map_link'), '');

            $property->company_logo          = $logoPath ?: '';

            $property->apartment_count       = $toInt($request->input('apartment_count'), 0);

            $property->total_capacity        = $toInt($request->input('total_capacity'), 0);
            $property->car_parking           = $toInt($request->input('total_car_parking'), 0);
            $property->has_reception         = $asBool($request->input('reception', 'no'));
            $property->elevators             = $toInt($request->input('total_lifts'), 0);
            $property->generators            = $toInt($request->input('total_generators'), 0);
            $property->fire_exits            = $toInt($request->input('total_fire_exits'), 0);
            $property->wheelchair_access     = $asBool($request->input('wheelchair_access', 'no'));

            $property->male_housekeeping     = $toInt($request->input('male_housekeeping'), 0);
            $property->female_housekeeping   = $toInt($request->input('female_housekeeping'), 0);

            $property->has_kids_zone         = $asBool($request->input('kids_zone', 'no'));
            $property->kids_zone_count       = $toInt($request->input('kids_zone_count'), 0);

            $property->view_type             = $str($request->input('view_from_hotel'), '');
            $property->security_guards       = $toInt($request->input('security_guards'), 0);

            $property->has_cafe_restaurant   = $asBool($request->input('cafe_restaurants', 'no'));
            $property->cafe_restaurant_count = $toInt($request->input('cafe_restaurants_count'), 0);

            $property->has_pool              = $asBool($request->input('pool', 'no'));
            $property->pool_count            = $toInt($request->input('pool_count'), 0);

            $property->has_bar               = $asBool($request->input('bar', 'no'));
            $property->bar_count             = $toInt($request->input('bar_count'), 0);

            $property->has_gym               = $asBool($request->input('gym', 'no'));
            $property->gym_count             = $toInt($request->input('gym_count'), 0);

            $property->has_party_center      = $asBool($request->input('party_center', 'no'));
            $property->party_center_details  = $str($request->input('party_center_details'), '');

            $property->has_conference_hall     = $asBool($request->input('conference_hall', 'no'));
            $property->conference_hall_details = $str($request->input('conference_hall_details'), '');

            $property->status                = 'submitted';

            $property->save();
            Log::info('Property inserted', ['property_id' => $property->id, 'vendor_id' => $vendor->id]);

            DB::commit();
            return back()->with('success', 'Vendor and property created successfully!');
        } catch (QueryException $qe) {
            DB::rollBack();
            $dbMsg = $qe->errorInfo[2] ?? $qe->getMessage();
            Log::error('DB error vendor_store', [
                'driver_message' => $dbMsg,
                'sql_state'      => $qe->errorInfo[0] ?? null,
                'code'           => $qe->errorInfo[1] ?? null,
            ]);
            return back()
                ->withErrors([
                    'error'      => 'Failed to create vendor/property.',
                    'db_message' => $dbMsg,
                ])
                ->withInput();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('PHP error vendor_store', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);
            return back()
                ->withErrors(['error' => 'Failed to create vendor/property.'])
                ->withInput();
        }
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




    public function vendor_show($id)
    {
        $vendor = Property::where('vendor_id', $id)->firstOrFail();
        return view('auth.super_admin.vendor_show', compact('vendor'));
    }

    public function vendor_edit($id)
    {
        $vendor = Property::where('vendor_id', $id)->firstOrFail();
        return view('auth.super_admin.vendor_edit', compact('vendor'));
    }


    public function vendor_update(Request $request, $id)
    {
        Log::info('vendor_update() hit', ['url' => $request->fullUrl()]);

        // 1) Retrieve the Vendor record
        try {
            $vendor = Vendor::findOrFail($id);  // Ensure vendor exists
        } catch (\Exception $e) {
            Log::error("Vendor with id $id not found: " . $e->getMessage());
            return back()->withErrors(['error' => 'Vendor not found']);
        }

        // 2) Email validation rule
        $emailRule = 'required|email|max:255';
        if ($request->input('email') !== $vendor->email) {
            $emailRule .= '|unique:vendors,email,' . $id;
        }

        // 3) Validate the input
        $request->validate([
            'email' => $emailRule,  // Email validation
            'property_name' => 'required|string|max:255',
            'country_name' => 'nullable|string|max:100',
            'district_name' => 'nullable|string|max:100',
            'city_town_village' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:50',
            'house_number' => 'nullable|string|max:100',
            'road_number_name' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|max:5120',
            'total_capacity' => 'nullable|integer|min:0',
            'total_car_parking' => 'nullable|integer|min:0',
            'reception' => 'nullable|in:yes,no',
            'total_lifts' => 'nullable|integer|min:0',
            'total_generators' => 'nullable|integer|min:0',
            'total_fire_exits' => 'nullable|integer|min:0',
            'wheelchair_access' => 'nullable|in:yes,no',
            'male_housekeeping' => 'nullable|integer|min:0',
            'female_housekeeping' => 'nullable|integer|min:0',
            'kids_zone' => 'nullable|in:yes,no',
            'kids_zone_count' => 'nullable|integer|min:0',
            'view_from_hotel' => 'nullable|string|max:255',
            'security_guards' => 'nullable|integer|min:0',
            'cafe_restaurants' => 'nullable|in:yes,no',
            'cafe_restaurants_count' => 'nullable|integer|min:0',
            'cafe_restaurant_names' => 'nullable|array',
            'cafe_restaurant_names.*' => 'nullable|string|max:255',
            'pool' => 'nullable|in:yes,no',
            'pool_count' => 'nullable|integer|min:0',
            'bar' => 'nullable|in:yes,no',
            'bar_count' => 'nullable|integer|min:0',
            'gym' => 'nullable|in:yes,no',
            'gym_count' => 'nullable|integer|min:0',
            'party_center' => 'nullable|in:yes,no',
            'party_center_details' => 'nullable|string|max:2000',
            'conference_hall' => 'nullable|in:yes,no',
            'conference_hall_details' => 'nullable|string|max:2000',
        ]);

        // helpers
        $toInt  = fn($v, $def = 0) => (is_numeric($v) && (int)$v >= 0) ? (int)$v : $def;
        $asBool = fn($yesNo) => $yesNo === 'yes';
        $str    = fn($v, $fallback = '') => ($v !== null ? (string)$v : $fallback);

        // Accept either cafe_restaurant_names[] or cafe_names[]
        $cafeNames = $request->has('cafe_restaurant_names')
            ? (array)$request->input('cafe_restaurant_names', [])
            : (array)$request->input('cafe_names', []);
        $cafeNames = array_values(array_filter(array_map('trim', $cafeNames)));

        // Optional logo upload
        $logoPath = null;
        if ($request->hasFile('company_logo') && $request->file('company_logo')->isValid()) {
            $file     = $request->file('company_logo');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $dest     = public_path('storage/logos');
            if (!is_dir($dest)) {
                @mkdir($dest, 0777, true);
            }
            $file->move($dest, $fileName);
            $logoPath = 'storage/logos/' . $fileName;
        }

        DB::beginTransaction();
        try {
            // 4) Update Vendor
            $vendor->email = $request->input('email');

            // Update the password only if a new one is provided
            if ($request->has('password') && !empty($request->input('password'))) {
                $vendor->password = bcrypt($request->input('password'));
            }
            $vendor->save();
            Log::info('Vendor updated', ['vendor_id' => $vendor->id]);

            // 5) Update Property directly by vendor_id
            $property = Property::where('vendor_id', $vendor->id)->first();  // Fetch the associated property

            if ($property) {
                // Update property fields directly
                $property->property_name = $str($request->input('property_name'));
                $property->country_name = $str($request->input('country_name'), '');
                $property->district_name = $str($request->input('district_name'), '');
                $property->city_town_village = $str($request->input('city_town_village'), '');
                $property->postcode = $str($request->input('postcode'), '');
                $property->house_number = $str($request->input('house_number'), '');
                $property->road_number_name = $str($request->input('road_number_name'), '');

                // Optional fields for property
                $property->company_logo = $logoPath ?: $property->company_logo;
                $property->total_capacity = $toInt($request->input('total_capacity'), 0);
                $property->total_car_parking = $toInt($request->input('total_car_parking'), 0);
                $property->has_reception = $asBool($request->input('reception', 'no'));
                $property->elevators = $toInt($request->input('total_lifts'), 0);
                $property->generators = $toInt($request->input('total_generators'), 0);
                $property->fire_exits = $toInt($request->input('total_fire_exits'), 0);
                $property->wheelchair_access = $asBool($request->input('wheelchair_access', 'no'));
                $property->male_housekeeping = $toInt($request->input('male_housekeeping'), 0);
                $property->female_housekeeping = $toInt($request->input('female_housekeeping'), 0);
                $property->has_kids_zone = $asBool($request->input('kids_zone', 'no'));
                $property->kids_zone_count = $toInt($request->input('kids_zone_count'), 0);
                $property->view_type = $str($request->input('view_from_hotel'), '');
                $property->security_guards = $toInt($request->input('security_guards'), 0);

                // Cafe & Restaurants
                $property->has_cafe_restaurant = $asBool($request->input('cafe_restaurants', 'no'));
                $property->cafe_restaurant_count = $toInt($request->input('cafe_restaurants_count'), 0);
                $property->cafe_restaurant_names = $cafeNames;

                // Pool, Bar, Gym
                $property->has_pool = $asBool($request->input('pool', 'no'));
                $property->pool_count = $toInt($request->input('pool_count'), 0);
                $property->has_bar = $asBool($request->input('bar', 'no'));
                $property->bar_count = $toInt($request->input('bar_count'), 0);
                $property->has_gym = $asBool($request->input('gym', 'no'));
                $property->gym_count = $toInt($request->input('gym_count'), 0);

                // Party Center and Conference Hall
                $property->has_party_center = $asBool($request->input('party_center', 'no'));
                $property->party_center_details = $str($request->input('party_center_details'), '');
                $property->has_conference_hall = $asBool($request->input('conference_hall', 'no'));
                $property->conference_hall_details = $str($request->input('conference_hall_details'), '');

                $property->status = 'submitted';
                $property->save();
                Log::info('Property updated', ['property_id' => $property->id, 'vendor_id' => $vendor->id]);
            }

            DB::commit();

            // Redirect back to the vendor's edit page
            return redirect()->route('super-admin.vendor.edit', $vendor->id)->with('success', 'Vendor and property updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating vendor and property', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['error' => 'Failed to update vendor/property.']);
        }
    }


}
