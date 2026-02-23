<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CustomerController extends Controller
{
    /**
     * Base query for unique customers (from bookings, grouped by guest_email).
     */
    private function customersQuery()
    {
        return Booking::query()
            ->whereNotNull('guest_email')
            ->where('guest_email', '!=', '')
            ->selectRaw('guest_email, MAX(guest_name) as guest_name, MAX(guest_phone) as guest_phone, MAX(created_at) as last_booking_at, COUNT(*) as total_bookings')
            ->groupBy('guest_email')
            ->orderByDesc('last_booking_at');
    }

    /**
     * Display all customers (unique guests) for super admin.
     */
    public function index()
    {
        $customers = $this->customersQuery()->paginate(20)->withQueryString();
        return view('auth.super_admin.customers.index', compact('customers'));
    }

    /**
     * Export customers as Excel (CSV with BOM for Excel).
     */
    public function exportExcel()
    {
        $customers = $this->customersQuery()->get();
        $filename = 'customers-' . date('Y-m-d-His') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $callback = function () use ($customers) {
            $stream = fopen('php://output', 'w');
            fprintf($stream, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($stream, ['Name', 'Email', 'Phone', 'Total Bookings', 'Last Booking Date']);
            foreach ($customers as $c) {
                fputcsv($stream, [
                    $c->guest_name ?? '',
                    $c->guest_email ?? '',
                    $c->guest_phone ?? '',
                    $c->total_bookings ?? 0,
                    $c->last_booking_at ? \Carbon\Carbon::parse($c->last_booking_at)->format('Y-m-d H:i') : '',
                ]);
            }
            fclose($stream);
        };
        return new StreamedResponse($callback, 200, $headers);
    }

    /**
     * Export customers as CSV.
     */
    public function exportCsv()
    {
        $customers = $this->customersQuery()->get();
        $filename = 'customers-' . date('Y-m-d-His') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $callback = function () use ($customers) {
            $stream = fopen('php://output', 'w');
            fprintf($stream, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($stream, ['Name', 'Email', 'Phone', 'Total Bookings', 'Last Booking Date']);
            foreach ($customers as $c) {
                fputcsv($stream, [
                    $c->guest_name ?? '',
                    $c->guest_email ?? '',
                    $c->guest_phone ?? '',
                    $c->total_bookings ?? 0,
                    $c->last_booking_at ? \Carbon\Carbon::parse($c->last_booking_at)->format('Y-m-d H:i') : '',
                ]);
            }
            fclose($stream);
        };
        return new StreamedResponse($callback, 200, $headers);
    }
}
