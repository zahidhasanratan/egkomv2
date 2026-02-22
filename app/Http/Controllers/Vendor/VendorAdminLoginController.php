<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Property;
use App\Mail\VendorPasswordResetMail;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class VendorAdminLoginController extends Controller
{
    private function getBrowser()
    {
        $agent = new Agent();
        return $agent->browser() . ' on ' . $agent->platform();
    }

    private function getOperatingSystem()
    {
        $agent = new Agent();
        return $agent->platform();
    }

    public function showLoginForm()
    {
        // Redirect to dashboard if the vendor is already logged in
        if (Auth::guard('vendor')->check()) {
            return redirect()->route('vendor.dashboard');
        }

        return view('frontend.vendor.login-signup'); // dedicated vendor login/signup page
    }

    /**
     * Handle vendor signup with all fields
     */
    public function signup(Request $request)
    {
        // Validate all fields (same as superadmin vendor creation)
        $request->validate([
            'property_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:vendors,email',
            'password' => 'required|string|min:8|confirmed',
            
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
            'cafe_names' => 'nullable|array',
            'cafe_names.*' => 'nullable|string|max:255',
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
        ], [
            'email.unique' => 'This email is already registered. Please login instead.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        try {
            DB::beginTransaction();

            // Helper functions
            $toInt = fn($v, $def = 0) => (is_numeric($v) && (int)$v >= 0) ? (int)$v : $def;
            $asBool = fn($yesNo) => $yesNo === 'yes';
            $str = fn($v, $fallback = '') => ($v !== null ? (string)$v : $fallback);

            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('company_logo') && $request->file('company_logo')->isValid()) {
                $file = $request->file('company_logo');
                $fileName = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $dest = public_path('storage/logos');
                if (!is_dir($dest)) { @mkdir($dest, 0777, true); }
                $file->move($dest, $fileName);
                $logoPath = 'storage/logos/'.$fileName;
            }

            // Create Vendor
            $vendor = new Vendor();
            $vendor->hotel_name = $request->input('property_name');
            $vendor->email = $request->input('email');
            $vendor->password = Hash::make($request->input('password'));
            $vendor->status = \App\Models\Vendor::STATUS_PENDING;

            // Set default empty values for required fields
            $maybeCols = [
                'phone', 'contact_person_name', 'contact_person_designation',
                'address_house', 'address_city', 'address_district', 'address_landmark',
                'nid', 'profile_picture', 'logo', 'bank_check_picture'
            ];
            foreach ($maybeCols as $col) {
                if (Schema::hasColumn('vendors', $col) && $vendor->{$col} === null) {
                    $vendor->{$col} = '';
                }
            }
            if ($logoPath && Schema::hasColumn('vendors', 'logo')) {
                $vendor->logo = $logoPath;
            }

            $vendor->save();

            // Generate vendor ID
            if (Schema::hasColumn('vendors', 'vendorId')) {
                $vendor->vendorId = 'Ven-'.$vendor->id;
                $vendor->save();
            }

            // Create Property (same logic as superadmin)
            $cafeNames = array_values(array_filter(array_map('trim', (array)$request->input('cafe_names', []))));
            
            $property = new Property();
            $property->vendor_id = $vendor->id;
            $property->property_name = $str($request->input('property_name'));
            $property->property_category = 'Hotels'; // default
            $property->property_type = '';
            $property->room_types = [];
            $property->apartments = [];
            $property->cafe_restaurant_names = $cafeNames;
            $property->country_name = $str($request->input('country_name'), '');
            $property->district_name = $str($request->input('district_name'), '');
            $property->city_town_village = $str($request->input('city_town_village'), '');
            $property->postcode = $str($request->input('postcode'), '');
            $property->house_number = $str($request->input('house_number'), '');
            $property->road_number_name = $str($request->input('road_number_name'), '');
            $property->company_logo = $logoPath ?: '';
            $property->total_capacity = $toInt($request->input('total_capacity'), 0);
            $property->car_parking = $toInt($request->input('total_car_parking'), 0);
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
            $property->has_cafe_restaurant = $asBool($request->input('cafe_restaurants', 'no'));
            $property->cafe_restaurant_count = $toInt($request->input('cafe_restaurants_count'), 0);
            $property->has_pool = $asBool($request->input('pool', 'no'));
            $property->pool_count = $toInt($request->input('pool_count'), 0);
            $property->has_bar = $asBool($request->input('bar', 'no'));
            $property->bar_count = $toInt($request->input('bar_count'), 0);
            $property->has_gym = $asBool($request->input('gym', 'no'));
            $property->gym_count = $toInt($request->input('gym_count'), 0);
            $property->has_party_center = $asBool($request->input('party_center', 'no'));
            $property->party_center_details = $str($request->input('party_center_details'), '');
            $property->has_conference_hall = $asBool($request->input('conference_hall', 'no'));
            $property->conference_hall_details = $str($request->input('conference_hall_details'), '');
            $property->status = 'submitted';
            $property->save();

            DB::commit();

            // Log the signup activity
            DB::table('activity_logs')->insert([
                'browser' => $this->getBrowser(),
                'os' => $this->getOperatingSystem(),
                'ip_address' => $request->ip(),
                'activity_time' => now(),
                'activity' => 'Vendor Signup - Pending Approval',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('vendor-admin.login')
                ->with('success', 'Your vendor account has been created successfully! Please wait for admin approval before you can login.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Vendor signup error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Something went wrong. Please try again.'])->withInput();
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            // Validate the input fields
            $request->validate([
                'password' => 'required|min:8|confirmed', // The 'confirmed' rule ensures 'password_confirmation' matches
            ], [
                'password.confirmed' => 'The new password and confirm password do not match.',
            ]);

            // Get the authenticated super admin user
            $superAdmin = Auth::guard('vendor')->user();

            // Update the password
            $superAdmin->password = Hash::make($request->password);
            $superAdmin->save();

            // Return success message
            return back()->with('success', 'Password updated successfully.');

        } catch (\Exception $e) {
            // If any exception occurs, return with danger message
            return back()->with('danger', 'Failed to update password. Please try again.');
        }
    }




    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log in the user as SuperAdmin
        if (Auth::guard('vendor')->attempt($credentials)) {
            // Log the login activity
            DB::table('activity_logs')->insert([
                'browser' => $this->getBrowser(),
                'os' => $this->getOperatingSystem(),
                'ip_address' => $request->ip(),
                'activity_time' => now(),
                'activity' => 'Logged In',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Redirect to dashboard if successful
            return redirect()->route('vendor.dashboard');
        }

        // Redirect back with an error if login fails
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        // Log the logout activity
        if (Auth::guard('vendor')->check()) {
            DB::table('activity_logs')->insert([
                'browser' => $this->getBrowser(),
                'os' => $this->getOperatingSystem(),
                'ip_address' => $request->ip(),
                'activity_time' => now(),
                'activity' => 'Logged Out',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Log the user out of the super-admin guard
            Auth::guard('vendor')->logout();
        }

        // Invalidate and regenerate session
        session()->invalidate();
        session()->regenerateToken();

        // Redirect the user to the login page
//        return redirect()->url('vendor.login');
        return redirect(url('/login'));

    }

    /**
     * Show the forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.vendor.forgot-password');
    }

    /**
     * Send password reset email
     */
    public function sendPasswordResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:vendors,email',
        ], [
            'email.exists' => 'We could not find a vendor with that email address.',
        ]);

        $vendor = Vendor::where('email', $request->email)->first();

        if ($vendor) {
            // Generate reset token
            $token = Str::random(64);
            $vendor->password_reset_token = $token;
            $vendor->password_reset_expires_at = Carbon::now()->addHours(1);
            $vendor->save();

            // Send email
            try {
                Mail::to($vendor->email)->send(new VendorPasswordResetMail($token, $vendor->contact_person_name ?? $vendor->hotel_name));
            } catch (\Exception $e) {
                return back()->withErrors(['email' => 'Failed to send email. Please try again later.'])->withInput();
            }
        }

        return back()->with('success', 'If that email address exists in our system, we have sent a password reset link to it.');
    }

    /**
     * Show the reset password form
     */
    public function showResetPasswordForm($token)
    {
        $vendor = Vendor::where('password_reset_token', $token)
            ->where('password_reset_expires_at', '>', Carbon::now())
            ->first();

        if (!$vendor) {
            return redirect()->route('vendor-admin.password.request')
                ->withErrors(['token' => 'This password reset token is invalid or has expired.']);
        }

        return view('auth.vendor.reset-password', [
            'token' => $token,
            'email' => $vendor->email,
        ]);
    }

    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:vendors,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $vendor = Vendor::where('email', $request->email)
            ->where('password_reset_token', $request->token)
            ->where('password_reset_expires_at', '>', Carbon::now())
            ->first();

        if (!$vendor) {
            return back()->withErrors(['token' => 'This password reset token is invalid or has expired.'])->withInput();
        }

        // Update password and clear reset token
        $vendor->password = Hash::make($request->password);
        $vendor->password_reset_token = null;
        $vendor->password_reset_expires_at = null;
        $vendor->save();

        return redirect()->route('vendor-admin.login')
            ->with('success', 'Your password has been reset successfully. You can now log in with your new password.');
    }
}
