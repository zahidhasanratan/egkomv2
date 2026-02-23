<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\HotelSetting;
use App\Models\Hotel;
use Illuminate\Http\Request;

class CommissionFeesController extends Controller
{
    public function index()
    {
        $settings = HotelSetting::getPlatformSettings();
        $hotels = Hotel::where('approve', 1)->where('is_suspended', 0)->where('status', 'submitted')
            ->orderBy('description')
            ->get(['id', 'description']);
        return view('auth.super_admin.commission_fees.index', compact('settings', 'hotels'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'commission_percentage' => 'nullable|numeric|min:0|max:100',
            'platform_fee_enabled' => 'nullable|boolean',
            'platform_fee_amount' => 'nullable|numeric|min:0',
            'tax_enabled' => 'nullable|boolean',
            'tax_percentage' => 'nullable|numeric|min:0|max:100',
            'platform_discount_enabled' => 'nullable|boolean',
            'platform_discount_percentage' => 'nullable|numeric|min:0|max:100',
            'platform_discount_apply_to_all_hotels' => 'nullable|boolean',
            'hotel_ids' => 'nullable|array',
            'hotel_ids.*' => 'integer|exists:hotels,id',
        ]);

        $settings = HotelSetting::first();
        if (!$settings) {
            $settings = new HotelSetting();
            $settings->hotel_name = config('app.name', 'Platform');
            $settings->hotel_address = '';
            $settings->email = '';
            $settings->phone = '';
            $settings->copyright = '';
        }

        $settings->commission_percentage = $validated['commission_percentage'] ?? 0;
        $settings->platform_fee_enabled = $request->boolean('platform_fee_enabled');
        $settings->platform_fee_amount = $validated['platform_fee_amount'] ?? 0;
        $settings->tax_enabled = $request->boolean('tax_enabled');
        $settings->tax_percentage = $validated['tax_percentage'] ?? 0;
        $settings->platform_discount_enabled = $request->boolean('platform_discount_enabled');
        $settings->platform_discount_percentage = $validated['platform_discount_percentage'] ?? 0;
        $settings->platform_discount_apply_to_all_hotels = $request->boolean('platform_discount_apply_to_all_hotels');
        $settings->platform_discount_hotel_ids = $settings->platform_discount_apply_to_all_hotels
            ? null
            : ($validated['hotel_ids'] ?? []);

        $settings->save();

        return redirect()->route('super-admin.commission-fees.index')
            ->with('success', 'Commission & platform fee settings updated successfully.');
    }
}
