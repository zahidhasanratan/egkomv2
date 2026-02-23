<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorPayout;
use App\Models\Booking;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VendorPaymentProfileController extends Controller
{
    /**
     * List all vendors with payment summary (income, payouts, pending). Super Admin landing for Payment & Income.
     */
    public function index()
    {
        $vendors = Vendor::with(['hotels', 'payouts'])
            ->where('status', Vendor::STATUS_APPROVED)
            ->orderBy('hotel_name')
            ->get()
            ->map(function ($vendor) {
                $vendor->total_income = $vendor->getTotalIncomeAttribute();
                $vendor->total_commission = $vendor->getTotalCommissionAttribute();
                $vendor->net_earnings = round($vendor->total_income - $vendor->total_commission, 2);
                $vendor->total_paid_out = $vendor->payouts()->where('status', VendorPayout::STATUS_COMPLETED)->sum('amount');
                $vendor->pending_payouts = $vendor->payouts()->whereIn('status', [
                    VendorPayout::STATUS_PENDING,
                    VendorPayout::STATUS_IN_PROCESS,
                    VendorPayout::STATUS_ON_HOLD,
                ])->sum('amount');
                return $vendor;
            });

        // All open withdrawal requests (pending, in_process, on_hold) for easy management
        $pendingPayouts = VendorPayout::with('vendor')
            ->whereIn('status', [
                VendorPayout::STATUS_PENDING,
                VendorPayout::STATUS_IN_PROCESS,
                VendorPayout::STATUS_ON_HOLD,
            ])
            ->orderByDesc('requested_at')
            ->orderByDesc('id')
            ->get();

        return view('auth.super_admin.vendor_payment_profile.index', compact('vendors', 'pendingPayouts'));
    }

    /**
     * Single vendor payment & income profile (income, payments sent, withdrawal requests).
     */
    public function show(int $id)
    {
        $vendor = Vendor::with(['owner', 'banking', 'hotels', 'payouts'])->findOrFail($id);
        $hotelIds = $vendor->hotels->pluck('id')->toArray();

        $totalIncome = $vendor->getTotalIncomeAttribute();
        $totalCommission = $vendor->getTotalCommissionAttribute();
        $netEarnings = round($totalIncome - $totalCommission, 2);

        $weeklyIncome = $vendor->weekly_income;
        $weeklyCommission = $vendor->weekly_commission;
        $weeklyNet = round($weeklyIncome - $weeklyCommission, 2);
        $monthlyIncome = $vendor->monthly_income;
        $monthlyCommission = $vendor->monthly_commission;
        $monthlyNet = round($monthlyIncome - $monthlyCommission, 2);

        $customDateFrom = null;
        $customDateTo = null;
        $customIncome = null;
        $customCommission = null;
        $customNet = null;
        $from = request('date_from');
        $to = request('date_to');
        if ($from && $to) {
            try {
                $start = Carbon::parse($from)->startOfDay();
                $end = Carbon::parse($to)->endOfDay();
                if ($start->lte($end)) {
                    $customDateFrom = $start;
                    $customDateTo = $end;
                    $result = $vendor->getIncomeAndCommissionForDateRange($start, $end);
                    $customIncome = $result['income'];
                    $customCommission = $result['commission'];
                    $customNet = round($customIncome - $customCommission, 2);
                }
            } catch (\Exception $e) {
                //
            }
        }

        $payouts = $vendor->payouts()->orderByDesc('created_at')->paginate(10);
        $totalPaidOut = $vendor->payouts()->where('status', VendorPayout::STATUS_COMPLETED)->sum('amount');
        $pendingPayouts = $vendor->payouts()->whereIn('status', [
            VendorPayout::STATUS_PENDING,
            VendorPayout::STATUS_IN_PROCESS,
            VendorPayout::STATUS_ON_HOLD,
        ])->sum('amount');

        return view('auth.super_admin.vendor_payment_profile.show', compact(
            'vendor',
            'totalIncome',
            'totalCommission',
            'netEarnings',
            'weeklyIncome',
            'weeklyCommission',
            'weeklyNet',
            'monthlyIncome',
            'monthlyCommission',
            'monthlyNet',
            'customDateFrom',
            'customDateTo',
            'customIncome',
            'customCommission',
            'customNet',
            'payouts',
            'totalPaidOut',
            'pendingPayouts'
        ));
    }

    /**
     * Update payout status (Completed, Pending, On Hold, In Process, Rejected).
     */
    public function updatePayoutStatus(Request $request, int $payoutId)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(VendorPayout::statusOptions())),
            'admin_note' => 'nullable|string|max:1000',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        $payout = VendorPayout::findOrFail($payoutId);
        $payout->status = $validated['status'];
        $payout->admin_note = $validated['admin_note'] ?? $payout->admin_note;
        $payout->payment_reference = $validated['payment_reference'] ?? $payout->payment_reference;
        if ($validated['status'] === VendorPayout::STATUS_COMPLETED || $validated['status'] === VendorPayout::STATUS_REJECTED) {
            $payout->processed_at = now();
        }
        $payout->save();

        return redirect()->route('super-admin.vendor.payment-profile', $payout->vendor_id)
            ->with('success', 'Payout status updated.');
    }
}
