<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\CoHost;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CoHostController extends Controller
{
    public function index($hotelId)
    {
        try {
            $vendor = Auth::guard('vendor')->user();
            
            if (!$vendor) {
                return redirect()->route('vendor-admin.login')->with('error', 'Please login first');
            }
            
            $hotel = Hotel::where('id', $hotelId)->where('vendor_id', $vendor->id)->first();
            
            if (!$hotel) {
                return redirect()->route('vendor-admin.hotel.index')
                    ->with('error', 'Hotel not found or you do not have permission to access it');
            }
            
            $coHosts = CoHost::where('hotel_id', $hotelId)->orderBy('created_at', 'desc')->get();
            
            return view('auth.vendor.co-hosts.index', compact('hotel', 'coHosts'));
            
        } catch (\Exception $e) {
            return redirect()->route('vendor-admin.hotel.index')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function create($hotelId)
    {
        $vendor = Auth::guard('vendor')->user();
        $hotel = Hotel::where('id', $hotelId)->where('vendor_id', $vendor->id)->firstOrFail();
        
        return view('auth.vendor.co-hosts.create', compact('hotel'));
    }

    public function store(Request $request, $hotelId)
    {
        $vendor = Auth::guard('vendor')->user();
        $hotel = Hotel::where('id', $hotelId)->where('vendor_id', $vendor->id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:co_hosts,email',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:6',
            'bio' => 'nullable|string',
            'language' => 'nullable|string|max:50',
            'response_rate' => 'nullable|integer|min:0|max:100',
            'response_time' => 'nullable|string|max:100',
        ]);

        $data = $request->all();
        $data['hotel_id'] = $hotelId;
        $data['vendor_id'] = $vendor->id;
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/co-hosts'), $photoName);
            $data['photo'] = 'uploads/co-hosts/' . $photoName;
        }

        CoHost::create($data);

        return redirect()->route('vendor.co-hosts.index', $hotelId)
            ->with('success', 'Co-host created successfully!');
    }

    public function edit($hotelId, $id)
    {
        $vendor = Auth::guard('vendor')->user();
        $hotel = Hotel::where('id', $hotelId)->where('vendor_id', $vendor->id)->firstOrFail();
        $coHost = CoHost::where('id', $id)->where('hotel_id', $hotelId)->firstOrFail();

        return view('auth.vendor.co-hosts.edit', compact('hotel', 'coHost'));
    }

    public function update(Request $request, $hotelId, $id)
    {
        $vendor = Auth::guard('vendor')->user();
        $hotel = Hotel::where('id', $hotelId)->where('vendor_id', $vendor->id)->firstOrFail();
        $coHost = CoHost::where('id', $id)->where('hotel_id', $hotelId)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:co_hosts,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:6',
            'bio' => 'nullable|string',
            'language' => 'nullable|string|max:50',
            'response_rate' => 'nullable|integer|min:0|max:100',
            'response_time' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except(['password', 'photo']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($coHost->photo && file_exists(public_path($coHost->photo))) {
                unlink(public_path($coHost->photo));
            }
            
            // Upload new photo
            $photo = $request->file('photo');
            $photoName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/co-hosts'), $photoName);
            $data['photo'] = 'uploads/co-hosts/' . $photoName;
        }

        $coHost->update($data);

        return redirect()->route('vendor.co-hosts.index', $hotelId)
            ->with('success', 'Co-host updated successfully!');
    }

    public function destroy($hotelId, $id)
    {
        $vendor = Auth::guard('vendor')->user();
        $hotel = Hotel::where('id', $hotelId)->where('vendor_id', $vendor->id)->firstOrFail();
        $coHost = CoHost::where('id', $id)->where('hotel_id', $hotelId)->firstOrFail();

        // Delete photo if exists
        if ($coHost->photo && file_exists(public_path($coHost->photo))) {
            unlink(public_path($coHost->photo));
        }

        $coHost->delete();

        return redirect()->route('vendor.co-hosts.index', $hotelId)
            ->with('success', 'Co-host deleted successfully!');
    }

    public function allCoHosts()
    {
        try {
            $vendor = Auth::guard('vendor')->user();
            
            if (!$vendor) {
                return redirect()->route('vendor-admin.login')->with('error', 'Please login first');
            }
            
            // Get all co-hosts for this vendor with hotel relationship loaded
            $coHosts = CoHost::where('vendor_id', $vendor->id)
                ->with('hotel')
                ->orderBy('created_at', 'desc')
                ->get();
            
            return view('auth.vendor.co-hosts.all', compact('coHosts'));
            
        } catch (\Exception $e) {
            return redirect()->route('vendor-admin.dashboard')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
