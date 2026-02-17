<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;

class TourPackageController extends Controller
{
    public function show(string $slug)
    {
        $tourPackage = TourPackage::where('slug', $slug)->where('is_active', 1)->firstOrFail();
        return view('frontend.tour_package.show', compact('tourPackage'));
    }
}
