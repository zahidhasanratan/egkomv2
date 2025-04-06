<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent; // Import the Agent package
use Illuminate\Support\Facades\DB; // For database operations

class SuperAdminLoginController extends Controller
{
    // Method to get browser and OS
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
        // Redirect to dashboard if the super admin is already logged in
        if (Auth::guard('super-admin')->check()) {
            return redirect()->route('super-admin.dashboard');
        }

        return view('auth.super_admin.super-admin-login'); // your login view
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
            $superAdmin = Auth::guard('super-admin')->user();

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
        if (Auth::guard('super-admin')->attempt($credentials)) {
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
            return redirect()->route('super-admin.dashboard');
        }

        // Redirect back with an error if login fails
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        // Log the logout activity
        if (Auth::guard('super-admin')->check()) {
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
            Auth::guard('super-admin')->logout();
        }

        // Invalidate and regenerate session
        session()->invalidate();
        session()->regenerateToken();

        // Redirect the user to the login page
        return redirect()->route('super-admin.login');
    }
}
