<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Hotel;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('valid_to', 'desc')->orderBy('id', 'desc')->paginate(15);
        return view('auth.super_admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $hotels = Hotel::where('approve', 1)->where('is_suspended', 0)->where('status', 'submitted')
            ->orderBy('description')->get(['id', 'description']);
        return view('auth.super_admin.coupons.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:64|unique:coupons,code',
            'description' => 'nullable|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer|min:1',
            'apply_to_all_hotels' => 'nullable|boolean',
            'hotel_ids' => 'nullable|array',
            'hotel_ids.*' => 'integer|exists:hotels,id',
            'min_booking_amount' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));
        // When checkbox is unchecked it is not sent; default false so "selected hotels" is preserved
        $validated['apply_to_all_hotels'] = $request->boolean('apply_to_all_hotels', false);
        $validated['is_active'] = $request->boolean('is_active', true);
        if ($validated['apply_to_all_hotels']) {
            $validated['hotel_ids'] = null;
        } else {
            $validated['hotel_ids'] = $validated['hotel_ids'] ?? [];
        }

        Coupon::create($validated);
        return redirect()->route('super-admin.coupons.index')
            ->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        $hotels = Hotel::where('approve', 1)->where('is_suspended', 0)->where('status', 'submitted')
            ->orderBy('description')->get(['id', 'description']);
        return view('auth.super_admin.coupons.edit', compact('coupon', 'hotels'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:64|unique:coupons,code,' . $coupon->id,
            'description' => 'nullable|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer|min:0',
            'apply_to_all_hotels' => 'nullable|boolean',
            'hotel_ids' => 'nullable|array',
            'hotel_ids.*' => 'integer|exists:hotels,id',
            'min_booking_amount' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));
        // When checkbox is unchecked it is not sent; default false so "selected hotels" is preserved on update
        $validated['apply_to_all_hotels'] = $request->boolean('apply_to_all_hotels', false);
        $validated['is_active'] = $request->boolean('is_active', true);
        if ($validated['apply_to_all_hotels']) {
            $validated['hotel_ids'] = null;
        } else {
            $validated['hotel_ids'] = $validated['hotel_ids'] ?? [];
        }

        $coupon->update($validated);
        return redirect()->route('super-admin.coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('super-admin.coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }
}
