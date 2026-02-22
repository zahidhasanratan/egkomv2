<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::orderBy('sort_order')->orderBy('id')->paginate(10);
        return view('auth.super_admin.tour_packages.index', compact('packages'));
    }

    public function create()
    {
        return view('auth.super_admin.tour_packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $validated;
        $data['is_active'] = $request->boolean('is_active', true);
        $data['rating'] = $data['rating'] ?? 5;
        $data['review_count'] = $data['review_count'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $dir = public_path('uploads/tour_packages');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $file = $request->file('image');
            $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $name);
            $data['image'] = 'uploads/tour_packages/' . $name;
        }

        TourPackage::create($data);
        return redirect()->route('super-admin.tour-packages.index')
            ->with('success', 'Tour package created successfully.');
    }

    public function show(TourPackage $tour_package)
    {
        return view('auth.super_admin.tour_packages.show', compact('tour_package'));
    }

    public function edit(TourPackage $tour_package)
    {
        return view('auth.super_admin.tour_packages.edit', compact('tour_package'));
    }

    public function update(Request $request, TourPackage $tour_package)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $validated;
        $data['is_active'] = $request->boolean('is_active', true);

        // Handle image removal
        if ($request->input('remove_current_image') == '1') {
            if ($tour_package->image && file_exists(public_path($tour_package->image))) {
                unlink(public_path($tour_package->image));
            }
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($tour_package->image && file_exists(public_path($tour_package->image))) {
                unlink(public_path($tour_package->image));
            }
            $dir = public_path('uploads/tour_packages');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $file = $request->file('image');
            $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $name);
            $data['image'] = 'uploads/tour_packages/' . $name;
        }

        $tour_package->update($data);
        return redirect()->route('super-admin.tour-packages.index')
            ->with('success', 'Tour package updated successfully.');
    }

    public function destroy(TourPackage $tour_package)
    {
        if ($tour_package->image && file_exists(public_path($tour_package->image))) {
            unlink(public_path($tour_package->image));
        }
        $tour_package->delete();
        return redirect()->route('super-admin.tour-packages.index')
            ->with('success', 'Tour package deleted successfully.');
    }
}
