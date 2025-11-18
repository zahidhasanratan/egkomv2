<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Mail\GuestPasswordResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GuestAuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('frontend.guest.login');
    }

    /**
     * Show the signup form
     */
    public function showSignupForm()
    {
        return view('frontend.guest.signup');
    }

    /**
     * Handle guest login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::guard('guest')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            // Ensure the session is saved and committed
            $request->session()->save();
            session()->save();
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Handle guest signup
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'country_code' => 'required|string|max:10',
            'address' => 'nullable|string|max:500',
            'email' => 'required|string|email|max:255|unique:guests',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $guest = Guest::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'country_code' => $request->country_code,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('guest')->login($guest);
        
        // Ensure the session is saved and committed
        $request->session()->save();
        session()->save();

        return redirect('/')->with('success', 'Account created successfully! Welcome to Egkom!');
    }

    /**
     * Handle guest logout
     */
    public function logout(Request $request)
    {
        Auth::guard('guest')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show the guest profile page
     */
    public function showProfile()
    {
        $guest = Auth::guard('guest')->user();
        return view('frontend.guest.profile', compact('guest'));
    }

    /**
     * Update guest profile
     */
    public function updateProfile(Request $request)
    {
        $guest = Auth::guard('guest')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'country_code' => 'required|string|max:10',
            'address' => 'nullable|string|max:500',
            'email' => 'required|string|email|max:255|unique:guests,email,' . $guest->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'country_code' => $request->country_code,
            'address' => $request->address,
            'email' => $request->email,
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($guest->photo && file_exists(public_path($guest->photo))) {
                unlink(public_path($guest->photo));
            }

            // Upload new photo
            $photo = $request->file('photo');
            $photoName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = 'uploads/guests/photos/';
            
            // Create directory if it doesn't exist
            if (!file_exists(public_path($photoPath))) {
                mkdir(public_path($photoPath), 0755, true);
            }
            
            $photo->move(public_path($photoPath), $photoName);
            $data['photo'] = $photoPath . $photoName;
        }

        $guest->update($data);

        return redirect()->route('guest.profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Show the settings page
     */
    public function showSettings()
    {
        return view('frontend.guest.settings');
    }

    /**
     * Update guest password
     */
    public function updatePassword(Request $request)
    {
        $guest = Auth::guard('guest')->user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Verify current password
        if (!Hash::check($request->current_password, $guest->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ])->withInput();
        }

        // Update password
        $guest->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('guest.settings')->with('success', 'Password updated successfully!');
    }

    /**
     * Show the forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('frontend.guest.forgot-password');
    }

    /**
     * Send password reset email
     */
    public function sendPasswordResetEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:guests,email',
        ], [
            'email.exists' => 'We could not find a user with that email address.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $guest = Guest::where('email', $request->email)->first();

        if ($guest) {
            // Generate reset token
            $token = Str::random(64);
            $guest->password_reset_token = $token;
            $guest->password_reset_expires_at = Carbon::now()->addHours(1); // Token expires in 1 hour
            $guest->save();

            // Send email
            try {
                Mail::to($guest->email)->send(new GuestPasswordResetMail($token, $guest->name));
            } catch (\Exception $e) {
                return back()->withErrors(['email' => 'Failed to send email. Please try again later.'])->withInput();
            }
        }

        // Always return success message for security (don't reveal if email exists)
        return back()->with('success', 'If that email address exists in our system, we have sent a password reset link to it.');
    }

    /**
     * Show the reset password form
     */
    public function showResetPasswordForm($token)
    {
        $guest = Guest::where('password_reset_token', $token)
            ->where('password_reset_expires_at', '>', Carbon::now())
            ->first();

        if (!$guest) {
            return redirect()->route('guest.password.request')
                ->withErrors(['token' => 'This password reset token is invalid or has expired.']);
        }

        return view('frontend.guest.reset-password', [
            'token' => $token,
            'email' => $guest->email,
        ]);
    }

    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email|exists:guests,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $guest = Guest::where('email', $request->email)
            ->where('password_reset_token', $request->token)
            ->where('password_reset_expires_at', '>', Carbon::now())
            ->first();

        if (!$guest) {
            return back()->withErrors(['token' => 'This password reset token is invalid or has expired.'])->withInput();
        }

        // Update password and clear reset token
        $guest->password = Hash::make($request->password);
        $guest->password_reset_token = null;
        $guest->password_reset_expires_at = null;
        $guest->save();

        return redirect()->route('guest.login')
            ->with('success', 'Your password has been reset successfully. You can now log in with your new password.');
    }
}
