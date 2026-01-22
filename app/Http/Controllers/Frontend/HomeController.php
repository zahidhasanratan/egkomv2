<?php

namespace App\Http\Controllers\frontend;

use App\Activity;
use App\Category;
use App\CompanyManagement;
use App\ContactUs;
use App\Dmcday;
use App\LifeMember;
use App\Item;
use App\Mail\ContactFormMail;
use App\Mail\DmcMail;
use App\MecroFinance;
use App\MedicalFeature;
use App\MedicalSlider;
use App\MicroSLider;
use App\Mission;
use App\NeedHelp;
use App\photo_gallery_table;
use App\Industry;
use App\Link;
use App\Menu;
use App\News;
use App\Objects;
use App\Others;
use App\Outlook;
use App\PreviousProgram;
use App\Publication;
use App\Rating;
use App\Ratinglist;
use App\Ratingtype;
use App\Sector;
use App\Service;
use App\Slider;
use App\Team;
use App\video;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $main   =   Menu::orderBy('sequence','ASC')
            ->where('display',1)
            ->get();

        $footer   =   Menu::orderBy('sequence','ASC')
            ->where('footer1',1)
            ->get();

        // Fetch popular destinations with hotel counts
        $popularDestinations = \App\Models\PopularDestination::where('is_active', 1)
            ->orderBy('order', 'ASC')
            ->orderBy('name', 'ASC')
            ->get()
            ->map(function ($destination) {
                $destination->hotels_count = \App\Models\Hotel::where('popular_destination_id', $destination->id)
                    ->where('approve', 1)
                    ->where('status', 'submitted')
                    ->count();
                return $destination;
            });

        // Fetch districts dynamically from hotels
        $districts = \App\Models\Hotel::where('approve', 1)
            ->where('status', 'submitted')
            ->whereNotNull('district')
            ->where('district', '!=', '')
            ->select('district')
            ->distinct()
            ->orderBy('district', 'ASC')
            ->get()
            ->map(function ($hotel) {
                $hotel->properties_count = \App\Models\Hotel::where('district', $hotel->district)
                    ->where('approve', 1)
                    ->where('status', 'submitted')
                    ->count();
                return $hotel;
            });

        // Fetch cities dynamically from hotels
        $cities = \App\Models\Hotel::where('approve', 1)
            ->where('status', 'submitted')
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->select('city')
            ->distinct()
            ->orderBy('city', 'ASC')
            ->get()
            ->map(function ($hotel) {
                $hotel->properties_count = \App\Models\Hotel::where('city', $hotel->city)
                    ->where('approve', 1)
                    ->where('status', 'submitted')
                    ->count();
                return $hotel;
            });

        return view('frontend/home.index',compact('main','footer', 'popularDestinations', 'districts', 'cities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
