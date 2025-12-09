<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Banking;
use App\Models\Owner;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OwnerController extends Controller
{

    public function create()
    {
        $vendorId = Auth::id();
        $property = Owner::where('vendor_id', $vendorId)->first();
        return view('auth.owner.ownerInfo', compact('property'));
    }

    public function createSuper($id)
    {
        $vendorId = $id;
        $property = Owner::where('vendor_id', $vendorId)->first();
        return view('auth.super_admin.owner.ownerInfo', compact('property'));
    }

    public function store(Request $request)
    {
        $vendorId = Auth::id();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'ownership_type' => 'nullable|in:Commercial,Private,Others',
            'trade_license' => 'nullable|string|max:255',
            'bin' => 'nullable|string|max:255',
            'tin' => 'nullable|string|max:255',
            'nid_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'passport_number' => 'nullable|string|max:255',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'property_ownership' => 'nullable|in:Proprietorship,Partnership,Ltd,NGO,Leased',
            'partner_name' => 'nullable|string|max:255',
            'partner_contact' => 'nullable|string|max:20',
            'partner_details' => 'nullable|string',
            'lease_start_date' => 'nullable|date',
            'lease_end_date' => 'nullable|date',
            'facebook_link' => 'nullable|url',
            'website_link' => 'nullable|url',
            'nid_front_image' => 'nullable|image|max:2048',
            'nid_back_image' => 'nullable|image|max:2048',
        ]);

        $owner = Owner::where('vendor_id', $vendorId)->first();

        // Handle NID front image
        if ($request->hasFile('nid_front_image')) {
            $validated['nid_front_image'] = $request->file('nid_front_image')->store('nid_images', 'public');
        } elseif ($owner && $owner->nid_front_image) {
            $validated['nid_front_image'] = $owner->nid_front_image;
        }

        // Handle NID back image
        if ($request->hasFile('nid_back_image')) {
            $validated['nid_back_image'] = $request->file('nid_back_image')->store('nid_images', 'public');
        } elseif ($owner && $owner->nid_back_image) {
            $validated['nid_back_image'] = $owner->nid_back_image;
        }

        $validated['vendor_id'] = $vendorId;
        // Use 'action' from the form and map it to 'status'
        $validated['status'] = $request->input('action', 'draft'); // 'submitted' or 'draft' based on button clicked

        if ($owner) {
            $owner->update($validated);
            $message = 'Owner details updated successfully!';
        } else {
            Owner::create($validated);
            $message = 'Owner details saved successfully!';
        }

        if ($validated['status'] === 'submitted') {
            return redirect()->route('owners.bankInfo')->with('success', $message);
        }

        return redirect()->back()->with('success', $message);
    }

    public function storeSuper(Request $request)
    {
        $vendorId = $request->vendor_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'ownership_type' => 'nullable|in:Commercial,Private,Others',
            'trade_license' => 'nullable|string|max:255',
            'bin' => 'nullable|string|max:255',
            'tin' => 'nullable|string|max:255',
            'nid_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'passport_number' => 'nullable|string|max:255',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'property_ownership' => 'nullable|in:Proprietorship,Partnership,Ltd,NGO,Leased',
            'partner_name' => 'nullable|string|max:255',
            'partner_contact' => 'nullable|string|max:20',
            'partner_details' => 'nullable|string',
            'lease_start_date' => 'nullable|date',
            'lease_end_date' => 'nullable|date',
            'facebook_link' => 'nullable|url',
            'website_link' => 'nullable|url',
            'nid_front_image' => 'nullable|image|max:2048',
            'nid_back_image' => 'nullable|image|max:2048',
        ]);

        $owner = Owner::where('vendor_id', $vendorId)->first();

        // Handle NID front image
        if ($request->hasFile('nid_front_image')) {
            $validated['nid_front_image'] = $request->file('nid_front_image')->store('nid_images', 'public');
        } elseif ($owner && $owner->nid_front_image) {
            $validated['nid_front_image'] = $owner->nid_front_image;
        }

        // Handle NID back image
        if ($request->hasFile('nid_back_image')) {
            $validated['nid_back_image'] = $request->file('nid_back_image')->store('nid_images', 'public');
        } elseif ($owner && $owner->nid_back_image) {
            $validated['nid_back_image'] = $owner->nid_back_image;
        }

        $validated['vendor_id'] = $vendorId;
        // Use 'action' from the form and map it to 'status'
        $validated['status'] = $request->input('action', 'draft'); // 'submitted' or 'draft' based on button clicked

        if ($owner) {
            $owner->update($validated);
            $message = 'Owner details updated successfully!';
        } else {
            Owner::create($validated);
            $message = 'Owner details saved successfully!';
        }

        if ($validated['status'] === 'submitted') {
            return redirect()->route('super.owners.bankInfo',$vendorId)->with('success', $message);
        }

        return redirect()->back()->with('success', $message);
    }


    public function bankInfo()
    {
        $vendorId = Auth::id();
        if (!$vendorId) {
            return redirect()->route('login'); // Or handle unauthorized access
        }
        $banking = Banking::where('vendor_id', $vendorId)->first();
        return view('auth.owner.bankInfo', compact('banking'));
    }


    public function bankInfoSuper($id)
    {
        $vendorId = $id;
        if (!$vendorId) {
            return redirect()->route('login'); // Or handle unauthorized access
        }
        $banking = Banking::where('vendor_id', $vendorId)->first();
        return view('auth.super_admin.owner.bankInfo', compact('banking'));
    }

    public function ownerInfoShow($id)
    {
        $vendorId = $id;
        $property = Owner::where('vendor_id', $vendorId)->first();
        return view('auth.super_admin.owner.ownerInfo_show', compact('property'));
    }

    public function bankInfoShow($id)
    {
        $vendorId = $id;
        if (!$vendorId) {
            return redirect()->route('login');
        }
        $banking = Banking::where('vendor_id', $vendorId)->first();
        return view('auth.super_admin.owner.bankInfo_show', compact('banking'));
    }

}
