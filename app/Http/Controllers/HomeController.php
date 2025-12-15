<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function hotelDetails($id, Request $request)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
        $show = Hotel::where('id', $decryptedId)->firstOrFail();
        
        // Get search parameters from URL query string
        $searchParams = [
            'checkin' => $request->input('checkin', ''),
            'checkout' => $request->input('checkout', ''),
            'adults' => (int) $request->input('adults', 0),
            'children' => (int) $request->input('children', 0),
            'infants' => (int) $request->input('infants', 0),
            'pets' => (int) $request->input('pets', 0),
        ];
        
        return view('frontend.Hotel.hotelDetails', compact('show', 'searchParams'));
    }
}
