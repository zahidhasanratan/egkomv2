<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin;
use App\Mail\SuperAdminPasswordResetMail;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
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

    /**
     * Show the forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.super_admin.forgot-password');
    }

    /**
     * Send password reset email
     */
    public function sendPasswordResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = SuperAdmin::where('email', $request->email)->first();

        if ($user) {
            // Generate reset token
            $token = Str::random(64);
            $user->password_reset_token = $token;
            $user->password_reset_expires_at = Carbon::now()->addHours(1);
            $user->save();

            // Send email
            try {
                Mail::to($user->email)->send(new SuperAdminPasswordResetMail($token, $user->name));
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
        $user = SuperAdmin::where('password_reset_token', $token)
            ->where('password_reset_expires_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return redirect()->route('super-admin.password.request')
                ->withErrors(['token' => 'This password reset token is invalid or has expired.']);
        }

        return view('auth.super_admin.reset-password', [
            'token' => $token,
            'email' => $user->email,
        ]);
    }

    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = SuperAdmin::where('email', $request->email)
            ->where('password_reset_token', $request->token)
            ->where('password_reset_expires_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return back()->withErrors(['token' => 'This password reset token is invalid or has expired.'])->withInput();
        }

        // Update password and clear reset token
        $user->password = Hash::make($request->password);
        $user->password_reset_token = null;
        $user->password_reset_expires_at = null;
        $user->save();

        return redirect()->route('super-admin.login')
            ->with('success', 'Your password has been reset successfully. You can now log in with your new password.');
    }
}
