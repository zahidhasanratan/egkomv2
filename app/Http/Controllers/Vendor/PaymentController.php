<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorPayout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * My Payment dashboard: income, charges, withdrawal requests, owner & banking access.
     */
    public function index()
    {
        $vendor = Auth::user();
        $vendor->load(['hotels', 'payouts', 'owner', 'banking']);

        $totalIncome = $vendor->getTotalIncomeAttribute();
        $totalCommission = $vendor->getTotalCommissionAttribute();
        $netEarnings = round($totalIncome - $totalCommission, 2);

        $weeklyIncome = $vendor->weekly_income;
        $weeklyCommission = $vendor->weekly_commission;
        $weeklyNet = round($weeklyIncome - $weeklyCommission, 2);
        $monthlyIncome = $vendor->monthly_income;
        $monthlyCommission = $vendor->monthly_commission;
        $monthlyNet = round($monthlyIncome - $monthlyCommission, 2);

        $payouts = $vendor->payouts()->orderByDesc('created_at')->paginate(10);
        $totalPaidOut = $vendor->payouts()->where('status', VendorPayout::STATUS_COMPLETED)->sum('amount');
        $pendingAmount = $vendor->payouts()->whereIn('status', [
            VendorPayout::STATUS_PENDING,
            VendorPayout::STATUS_IN_PROCESS,
            VendorPayout::STATUS_ON_HOLD,
        ])->sum('amount');
        $availableBalance = $netEarnings - $totalPaidOut - $pendingAmount;

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
                // invalid dates – leave custom* null
            }
        }

        return view('auth.vendor.payment.index', compact(
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
            'pendingAmount',
            'availableBalance'
        ));
    }

    /**
     * Request a payout (withdrawal).
     */
    public function requestPayout(Request $request)
    {
        $vendor = Auth::user();
        $vendor->load('banking');

        if (!$vendor->banking || ($vendor->banking->status ?? '') !== 'submitted') {
            return redirect()->route('vendor-admin.payment.index')
                ->with('error', 'Please complete and submit your Banking Info before requesting a payout.');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'vendor_note' => 'nullable|string|max:500',
        ]);

        $totalIncome = $vendor->getTotalIncomeAttribute();
        $totalCommission = $vendor->getTotalCommissionAttribute();
        $netEarnings = round($totalIncome - $totalCommission, 2);
        $totalPaidOut = $vendor->payouts()->where('status', VendorPayout::STATUS_COMPLETED)->sum('amount');
        $pendingAmount = $vendor->payouts()->whereIn('status', [
            VendorPayout::STATUS_PENDING,
            VendorPayout::STATUS_IN_PROCESS,
            VendorPayout::STATUS_ON_HOLD,
        ])->sum('amount');
        $availableBalance = $netEarnings - $totalPaidOut - $pendingAmount;

        if ($validated['amount'] > $availableBalance) {
            return redirect()->route('vendor-admin.payment.index')
                ->with('error', 'Requested amount exceeds available balance (BDT ' . number_format($availableBalance, 2) . ').');
        }

        VendorPayout::create([
            'vendor_id' => $vendor->id,
            'amount' => $validated['amount'],
            'status' => VendorPayout::STATUS_PENDING,
            'requested_at' => now(),
            'vendor_note' => $validated['vendor_note'] ?? null,
        ]);

        return redirect()->route('vendor-admin.payment.index')
            ->with('success', 'Payout request submitted. We will process it shortly.');
    }
}
