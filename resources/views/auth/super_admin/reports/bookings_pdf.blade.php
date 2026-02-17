<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookings Report</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; font-weight: bold; }
        .header { text-align: center; margin-bottom: 15px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bookings Report</h1>
        <p>Generated on {{ date('F j, Y \a\t H:i') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Guest</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Hotel</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Nights</th>
                <th>Status</th>
                <th>Total</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $b)
            <tr>
                <td>{{ $b->invoice_number }}</td>
                <td>{{ $b->guest_name }}</td>
                <td>{{ $b->guest_email }}</td>
                <td>{{ $b->guest_phone ?? '-' }}</td>
                <td>{{ $b->getHotelName() }}</td>
                <td>{{ $b->checkin_date ? $b->checkin_date->format('Y-m-d') : '-' }}</td>
                <td>{{ $b->checkout_date ? $b->checkout_date->format('Y-m-d') : '-' }}</td>
                <td>{{ $b->total_nights ?? '-' }}</td>
                <td>{{ ucfirst($b->booking_status ?? '-') }}</td>
                <td>{{ number_format($b->grand_total ?? 0, 2) }}</td>
                <td>{{ ucfirst($b->payment_status ?? '-') }}</td>
            </tr>
            @empty
            <tr><td colspan="11">No bookings found.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
