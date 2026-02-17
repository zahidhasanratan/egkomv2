<?php


namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\HotelSetting;
use App\Models\Room;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Build base query for bookings that include any of the vendor's hotels.
     */
    private function vendorBookingsQuery(array $hotelIds)
    {
        $query = Booking::with('guest');
        if (empty($hotelIds)) {
            $query->whereRaw('1 = 0');
            return $query;
        }
        $query->where(function ($q) use ($hotelIds) {
            foreach ($hotelIds as $hotelId) {
                $q->orWhereJsonContains('rooms_data', ['hotelId' => $hotelId]);
            }
        });
        return $query;
    }

    /**
     * Show the Vendor Dashboard with real data for this vendor's hotels.
     */
    public function index(Request $request)
    {
        $vendorId = Auth::guard('vendor')->id();
        $hotelIds = Hotel::where('vendor_id', $vendorId)->pluck('id')->toArray();

        $today = Carbon::today();
        $range = $request->get('range', '30d');
        $rangeStart = $range === '6m' ? Carbon::now()->subMonths(6) : ($range === '1y' ? Carbon::now()->subYear() : Carbon::now()->subDays(30));
        $dateRangeLabel = $range === '6m' ? 'Last 6 Months' : ($range === '1y' ? 'Last 1 Year' : 'Last 30 Days');

        $baseBookings = $this->vendorBookingsQuery($hotelIds);

        // Top stat cards (vendor's data only)
        $totalBookings = (clone $baseBookings)->count();
        $checkInToday = (clone $baseBookings)->whereDate('checkin_date', $today)->whereIn('booking_status', ['confirmed', 'pending', 'staying'])->count();
        $checkOutToday = (clone $baseBookings)->whereDate('checkout_date', $today)->whereIn('booking_status', ['confirmed', 'staying'])->count();
        $totalRooms = empty($hotelIds) ? 0 : Room::whereIn('hotel_id', $hotelIds)->count();
        $totalHotels = count($hotelIds);

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $bookingsThisMonth = (clone $baseBookings)->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $bookingsThisWeek = (clone $baseBookings)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $bookingsInRange = (clone $baseBookings)->where('created_at', '>=', $rangeStart)->count();

        $revenueQuery = (clone $baseBookings)->where('payment_status', 'paid');
        $totalRevenue = (float) (clone $revenueQuery)->sum(DB::raw('COALESCE(paid_amount, grand_total, 0)'));
        $revenueThisMonth = (float) (clone $revenueQuery)->whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum(DB::raw('COALESCE(paid_amount, grand_total, 0)'));
        $revenueThisWeek = (float) (clone $revenueQuery)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum(DB::raw('COALESCE(paid_amount, grand_total, 0)'));
        $revenueInRange = (float) (clone $baseBookings)->where('payment_status', 'paid')->where('created_at', '>=', $rangeStart)->sum(DB::raw('COALESCE(paid_amount, grand_total, 0)'));

        $recentBookings = (clone $baseBookings)->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $roomsByType = empty($hotelIds) ? collect() : Room::whereIn('hotel_id', $hotelIds)
            ->select('name')
            ->whereNotNull('name')
            ->where('name', '!=', '')
            ->get()
            ->groupBy('name')
            ->map->count()
            ->sortDesc()
            ->take(5);

        $newCustomers = (clone $baseBookings)->orderBy('created_at', 'desc')
            ->get()
            ->unique(fn ($b) => $b->guest_email ?: 'id-' . $b->id)
            ->take(5)
            ->values();

        $activityLogs = ActivityLog::latest()->take(5)->get();
        $recentActivities = $activityLogs->isNotEmpty()
            ? $activityLogs->map(fn ($log) => (object)[
                'name'     => class_basename($log->activity ?? 'Activity'),
                'initials' => strtoupper(mb_substr($log->activity ?? 'Ac', 0, 2)),
                'label'    => $log->activity ?? 'Activity',
                'time'     => $log->created_at ? $log->created_at->diffForHumans() : 'Recently',
            ])
            : (clone $baseBookings)->orderBy('created_at', 'desc')->take(5)->get()->map(fn ($b) => (object)[
                'name'     => $b->guest_name ?? 'Guest',
                'initials' => strtoupper(mb_substr($b->guest_name ?? 'G', 0, 2)),
                'label'    => ($b->guest_name ?? 'Guest') . ' – ' . ($b->booking_status === 'cancelled' ? 'cancelled' : 'booking ' . $b->invoice_number),
                'time'     => $b->created_at ? $b->created_at->diffForHumans() : 'Recently',
            ]);

        return view('auth.vendor.dashboard', compact(
            'totalBookings', 'checkInToday', 'checkOutToday', 'totalRooms', 'totalHotels',
            'bookingsThisMonth', 'bookingsThisWeek', 'bookingsInRange', 'dateRangeLabel', 'range',
            'totalRevenue', 'revenueThisMonth', 'revenueThisWeek', 'revenueInRange',
            'recentBookings', 'roomsByType', 'newCustomers', 'recentActivities'
        ));
    }

    public function vendorInfo()
    {

        $data = [
            'Hotels' => [
                'districts' => [
                    'hotel' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Luxury Hotels' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Resort Hotels' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Budget Hotels' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Hotels 3 Star' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Hotels 4 Star' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                    'Hotels 5 Star' => ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Penthouse Suite', 'Accessible Room'],
                ]
            ],
            'Transit' => [
                'districts' => [
                    'Airport Hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                    'Station Hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                    'Bus Stop Hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                    'Jetty Hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                    'Hospital & Visa Center Area hotels' => ['Single Room', 'Double Room', 'Family Unit', 'Parking-Accessible Room'],
                ]
            ],
            'Resorts' => [
                'districts' => [
                    'Resorts' => [
                        'Luxury Resort Suites', 'Oceanfront Villas', 'Private Pool Villas', 'Garden View Rooms',
                        'Eco Resorts & Hotels', 'Bamboo Cottages', 'Solar-Powered Cabins', 'Off-Grid Stays',
                        'Farm Stays', 'Rustic Farmhouses', 'Luxury Farm Villas', 'Campsites', 'Standard Camping Tent',
                        'Luxury Tent (Glamping)', 'RV/Caravan Parking', 'Glamping', 'Safari-Style Tents', 'Dome Pods',
                        'Airstream Trailers', 'Treehouses', 'Basic Tree Cabins', 'Luxury Tree Villas', 'Adventure Resorts',
                        'Zipline Resorts', 'Rock Climbing Camps', 'Water Sports Resorts', 'Wellness Retreats',
                        'Ayurveda Resorts', 'Yoga Retreats', 'Meditation Centers', 'Beach Resorts', 'Overwater Bungalows',
                        'Beach Huts', 'Mountain Resorts', 'Safari Lodges', 'Wildlife Observation Rooms', 'Riverside Safari Cottages'
                    ],
                    // Add other resort sub-types if needed
                ]
            ],
            'Lodges' => [
                'districts' => [
                    'Hostels' => [
                        'Single Bed in Dormitory/Room/Apartment', 'Oceanfront Villas', 'Private Room/Apartment',
                        'Female-Only Dormitory/Apartment/Room', 'Male-Only Dormitory/Apartment/Room',
                        'Mixed Dormitory: Shared Room (All Genders)', 'Studio Apartment-Style Hostel'
                    ],
                    'Motels' => [
                        'Single Bed in Dormitory/Room/Apartment', 'Oceanfront Villas', 'Private Room/Apartment',
                        'Female-Only Dormitory/Apartment/Room', 'Male-Only Dormitory/Apartment/Room',
                        'Mixed Dormitory: Shared Room (All Genders)', 'Studio Apartment-Style Hostel'
                    ],
                    // Add other lodge sub-types
                ]
            ],
            'Apartments' => [
                'districts' => [
                    'Apartments' => [
                        'Luxury Serviced Apartments', 'Budget Serviced Apartments', 'Furnished Apartments',
                        'Unfurnished Apartments', 'Studio Apartments', 'One-Bedroom Apartments', 'Two-Bedroom Apartments',
                        'Three-Bedroom Apartments', 'Penthouse Apartments', 'Shared Apartments'
                    ],
                    'Homestays' => [
                        'Luxury Serviced Apartments', 'Budget Serviced Apartments', 'Furnished Apartments',
                        'Unfurnished Apartments', 'Studio Apartments', 'One-Bedroom Apartments', 'Two-Bedroom Apartments',
                        'Three-Bedroom Apartments', 'Penthouse Apartments', 'Shared Apartments'
                    ],
                ]
            ],
            'Guesthouses' => [
                'districts' => [
                    'Vacation Rentals' => [
                        'Bed Only', 'Room with Shared Bathroom', 'Entire Place', 'Private Room', 'Entire House',
                        'Farmhouse Room', 'Tent/Glamping Tent', 'RV/Caravan: Mobile Accommodations'
                    ],
                    'Guesthouses' => [
                        'Bed Only', 'Room with Shared Bathroom', 'Entire Place', 'Private Room', 'Entire House',
                        'Farmhouse Room', 'Tent/Glamping Tent', 'RV/Caravan: Mobile Accommodations'
                    ],
                ]
            ],
            'Crisis' => [
                'districts' => [
                    'Old Age Homes' => ['Old Age Homes', 'Orphanages', 'Rehabilitation Centers', 'Asylums'],
                    'Orphanages' => ['Old Age Homes', 'Orphanages', 'Rehabilitation Centers', 'Asylums'],
                    'Rehabilitation Centers' => ['Old Age Homes', 'Orphanages', 'Rehabilitation Centers', 'Asylums'],
                    'Asylums' => ['Old Age Homes', 'Orphanages', 'Rehabilitation Centers', 'Asylums'],
                ]
            ],
        ];

        // Pass the data to the view
        return view('auth.vendor.info', compact('data'));
    }



    public function activityLog()
    {
        // Fetch the last 20 activity logs, ordered by latest first
        $activityLogs = ActivityLog::latest()->take(20)->get();

        // Return the view and pass the data to it
        return view('auth.vendor.activityLog', compact('activityLogs'));
    }
    public function accountSettings()
    {
        $auth_id = Auth::id();
        $vendorSetting = Vendor::find($auth_id);

        // If no settings are found, you can either return a default empty object or create a new one
        if (!$vendorSetting) {
            $hotelSetting = new HotelSetting();
        }
        return view('auth.vendor.accountSettings', compact('vendorSetting'));
    }
    public function updateSettings(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'hotel_name' => 'required|string|max:255',
            'hotel_address' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        // Retrieve the first hotel setting record or create a new one if it doesn't exist
        $hotelSetting = Vendor::first();

        if (!$hotelSetting) {
            // If no record exists, create a new one
            $hotelSetting = new Vendor();
        }


        // Update the hotel settings with the new values
        $hotelSetting->hotel_name = $request->hotel_name;
        $hotelSetting->contact_person_name = $request->hotel_address;
        $hotelSetting->email = $request->email;
        $hotelSetting->phone = $request->phone;

        // Save the updated record to the database
        $hotelSetting->save();

        // Redirect back with a success message
        return back()->with('success', 'Vendor settings updated successfully!');
    }


    public function accountEmail()
    {
        $activityLogs = ActivityLog::latest()->take(20)->get();
        return view('auth.vendor.accountEmail', compact('activityLogs'));
    }

    public function accountSecurity()
    {
        $activityLogs = ActivityLog::latest()->take(20)->get();
        return view('auth.vendor.accountSecurity', compact('activityLogs'));
    }




}
