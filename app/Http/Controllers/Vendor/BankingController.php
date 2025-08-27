<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Banking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankingController extends Controller
{


    public function store(Request $request)
    {
        $vendorId = Auth::id();

        $validated = $request->validate([
            'payment_method' => 'required|in:Bank,Mobile Banking',
            'account_number' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'routing_number' => 'nullable|string|max:255',
            'account_type' => 'nullable|in:Current,Savings,etc',
            'bank_cheque_image' => 'nullable|image|max:2048',
            'bakshe_number' => 'nullable|string|max:255',
            'nagad_number' => 'nullable|string|max:255',
            'dutch_bangla_number' => 'nullable|string|max:255',
        ]);

        $banking = Banking::where('vendor_id', $vendorId)->first();

        // Handle file upload for bank cheque
        if ($request->hasFile('bank_cheque_image')) {
            $validated['bank_cheque_image'] = $request->file('bank_cheque_image')->store('bank_cheques', 'public');
        } elseif ($banking && $banking->bank_cheque_image) {
            $validated['bank_cheque_image'] = $banking->bank_cheque_image; // Preserve existing image
        }

        $validated['vendor_id'] = $vendorId;
        $validated['status'] = $request->input('action') === 'submit' ? 'submitted' : 'draft';

        if ($banking) {
            $banking->update($validated);
            $message = 'Banking details updated successfully!';
        } else {
            Banking::create($validated);
            $message = 'Banking details saved successfully!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function storeSuper(Request $request)
    {
        $vendorId = $request->vendor_id;

        $validated = $request->validate([
            'payment_method' => 'required|in:Bank,Mobile Banking',
            'account_number' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'routing_number' => 'nullable|string|max:255',
            'account_type' => 'nullable|in:Current,Savings,etc',
            'bank_cheque_image' => 'nullable|image|max:2048',
            'bakshe_number' => 'nullable|string|max:255',
            'nagad_number' => 'nullable|string|max:255',
            'dutch_bangla_number' => 'nullable|string|max:255',
        ]);

        $banking = Banking::where('vendor_id', $vendorId)->first();

        // Handle file upload for bank cheque
        if ($request->hasFile('bank_cheque_image')) {
            $validated['bank_cheque_image'] = $request->file('bank_cheque_image')->store('bank_cheques', 'public');
        } elseif ($banking && $banking->bank_cheque_image) {
            $validated['bank_cheque_image'] = $banking->bank_cheque_image; // Preserve existing image
        }

        $validated['vendor_id'] = $vendorId;
        $validated['status'] = $request->input('action') === 'submit' ? 'submitted' : 'draft';

        if ($banking) {
            $banking->update($validated);
            $message = 'Banking details updated successfully!';
        } else {
            Banking::create($validated);
            $message = 'Banking details saved successfully!';
        }

        return redirect()->back()->with('success', $message);
    }
}
