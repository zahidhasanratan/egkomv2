<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\HotelSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    public function updateSmtpSettings(Request $request)
    {

        // Validate the form inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'smtp_host' => 'required|string',
            'smtp_port' => 'required|numeric',
            'smtp_encryption' => 'required|string',
        ]);

        // Get the data from the form
        $email = $request->input('email');
        $password = $request->input('password');
        $smtpHost = $request->input('smtp_host');
        $smtpPort = $request->input('smtp_port');
        $smtpEncryption = $request->input('smtp_encryption');

        // Read the .env file
        $envPath = base_path('.env');
        $envContents = File::get($envPath);

        // Update the .env file with the new settings
        $envContents = str_replace(
            'MAIL_USERNAME=' . env('MAIL_USERNAME'),
            'MAIL_USERNAME=' . $email,
            $envContents
        );

        $envContents = str_replace(
            'MAIL_PASSWORD=' . env('MAIL_PASSWORD'),
            'MAIL_PASSWORD=' . $password,
            $envContents
        );

        $envContents = str_replace(
            'MAIL_HOST=' . env('MAIL_HOST'),
            'MAIL_HOST=' . $smtpHost,
            $envContents
        );

        $envContents = str_replace(
            'MAIL_PORT=' . env('MAIL_PORT'),
            'MAIL_PORT=' . $smtpPort,
            $envContents
        );

        $envContents = str_replace(
            'MAIL_ENCRYPTION=' . env('MAIL_ENCRYPTION'),
            'MAIL_ENCRYPTION=' . $smtpEncryption,
            $envContents
        );

        // Write the updated contents back to the .env file
        File::put($envPath, $envContents);

        // Clear the cache to apply the changes immediately
        Artisan::call('config:clear');

        return back()->with('success', 'SMTP settings updated successfully.');
    }

    /**
     * Update logo
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
        ]);

        try {
            // Get or create hotel setting
            $hotelSetting = HotelSetting::first();
            if (!$hotelSetting) {
                $hotelSetting = new HotelSetting();
                $hotelSetting->hotel_name = 'EZBOOKING';
                $hotelSetting->hotel_address = '';
                $hotelSetting->email = '';
                $hotelSetting->phone = '';
                $hotelSetting->copyright = 'Copyright © 2024 EZBOOKING. All Rights Reserved.';
            }

            // Handle file upload
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $destinationPath = public_path('uploads/logos');
                
                // Create directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                // Delete old logo if exists
                if ($hotelSetting->hotel_logo && File::exists(public_path($hotelSetting->hotel_logo))) {
                    File::delete(public_path($hotelSetting->hotel_logo));
                }

                // Move uploaded file
                $file->move($destinationPath, $fileName);
                $logoPath = 'uploads/logos/' . $fileName;

                // Update hotel setting
                $hotelSetting->hotel_logo = $logoPath;
                $hotelSetting->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Logo updated successfully!',
                    'logo_path' => asset($logoPath)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No logo file uploaded.'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating logo: ' . $e->getMessage()
            ], 500);
        }
    }
}
