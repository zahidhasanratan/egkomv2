<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking Invoice - {{ $booking->invoice_number }}</title>
    <style>
        :root {
            --brand: #90278e;
            --brand-light: #b84ab5;
            --brand-dark: #6d1c6a;
            --text-primary: #1a1a1a;
            --text-secondary: #666;
            --text-muted: #999;
            --border-color: #e0e0e0;
            --bg-light: #f8f8f8;
            --bg-white: #ffffff;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: var(--text-primary);
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            padding: 20px;
        }

        .invoice-container {
            max-width: 1100px;
            margin: 0 auto;
            background: var(--bg-white);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            padding: 30px;
        }

        .invoice-header {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--brand);
            width: 100%;
        }

        .vendor-logo {
            width: 150px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            justify-self: start;
        }

        .vendor-logo img {
            max-width: 100%;
            height: auto;
            display: block;
            object-fit: contain;
        }

        .vendor-info {
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 0 15px;
            justify-self: start;
        }

        .vendor-info h1 {
            font-size: 27px;
            font-weight: 600;
            color: var(--brand);
            margin-bottom: 6px;
            margin-top: 0;
        }

        .vendor-info p {
            font-size: 11px;
            color: var(--text-secondary);
            margin: 3px 0;
            line-height: 1.4;
        }

        .ez-logo {
            width: 150px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            justify-self: end;
        }

        .ez-logo img {
            max-width: 100%;
            height: auto;
            display: block;
            object-fit: contain;
        }

        .invoice-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px 20px;
            background: linear-gradient(135deg, rgba(144, 39, 142, 0.1) 0%, rgba(144, 39, 142, 0.05) 100%);
            border-radius: 6px;
            border-left: 4px solid var(--brand);
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .meta-label {
            font-size: 10px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .meta-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--brand);
            letter-spacing: 0.5px;
        }

        .invoice-section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--brand);
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 2px solid var(--brand);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 20px;
            background: var(--brand);
            border-radius: 2px;
        }

        .section-content {
            background: var(--bg-light);
            padding: 12px;
            border-radius: 6px;
            border: 1px solid rgba(144, 39, 142, 0.1);
        }

        .sections-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .sections-row .invoice-section {
            margin-bottom: 0;
        }

        .guest-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
        }

        .detail-item {
            margin-bottom: 8px;
        }

        .detail-label {
            font-size: 10px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .detail-value {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
        }

        address {
            font-style: normal;
        }

        .table-wrapper {
            overflow-x: auto;
            margin: -12px;
            padding: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        thead {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
            color: white;
        }

        thead th {
            padding: 8px 6px;
            text-align: left;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        thead th.text-right {
            text-align: right;
        }

        tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: rgba(144, 39, 142, 0.05);
        }

        tbody tr:nth-child(even) {
            background: rgba(144, 39, 142, 0.02);
        }

        tbody td {
            padding: 8px 6px;
            color: var(--text-primary);
        }

        tbody td.text-right {
            text-align: right;
            font-variant-numeric: tabular-nums;
        }

        tfoot {
            background: var(--bg-light);
            font-weight: 600;
        }

        tfoot tr {
            border-top: 2px solid var(--brand);
        }

        tfoot td {
            padding: 10px 6px;
            font-size: 12px;
        }

        tfoot td.text-right {
            text-align: right;
        }

        .tfoot-subtotal {
            color: #2563eb;
        }

        .tfoot-discount {
            color: #dc2626;
        }

        .tfoot-tax {
            color: #059669;
        }

        .grand-total {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
            color: white;
            font-size: 15px;
        }

        .grand-total td {
            padding: 12px 6px;
        }

        .requests-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .request-pill {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: var(--brand);
            color: white;
            box-shadow: 0 2px 4px rgba(144, 39, 142, 0.2);
        }

        .note-content {
            background: white;
            padding: 12px;
            border-left: 4px solid var(--brand);
            border-radius: 4px;
            font-size: 12px;
            line-height: 1.6;
            color: var(--text-primary);
            white-space: pre-wrap;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .relationship-info {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .relationship-value {
            font-weight: 700;
            color: var(--brand);
            font-size: 13px;
            padding: 6px 12px;
            background: rgba(144, 39, 142, 0.1);
            border-radius: 4px;
        }

        .other-guests {
            color: var(--text-secondary);
            font-size: 12px;
        }

        .contact-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
        }

        .arrival-time {
            font-size: 15px;
            font-weight: 700;
            color: var(--brand);
            padding: 12px;
            background: white;
            border-left: 4px solid var(--brand);
            border-radius: 4px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .document-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .document-preview {
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            width: 100%;
            max-height: 300px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .document-preview img {
            max-width: 100%;
            max-height: 250px;
            object-fit: contain;
            border-radius: 4px;
        }

        .document-preview .doc-icon {
            font-size: 50px;
            margin-bottom: 12px;
            margin-top: 30px;
            opacity: 0.6;
        }

        .document-preview .doc-text {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 4px;
        }

        .print-actions {
            text-align: center;
            margin: 20px 0;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: var(--brand);
            color: white;
        }

        .btn-primary:hover {
            background: var(--brand-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(144, 39, 142, 0.3);
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 1.2cm;
            }

            body {
                background: white;
                padding: 0;
                font-size: 9px;
            }

            .invoice-container {
                max-width: 100%;
                box-shadow: none;
                padding: 0;
            }

            .print-actions {
                display: none;
            }

            .invoice-header {
                grid-template-columns: auto 1fr auto !important;
                page-break-inside: avoid;
                page-break-after: avoid;
            }

            .vendor-logo {
                width: 80px !important;
            }

            .vendor-info h1 {
                font-size: 16px !important;
            }

            .vendor-info p {
                font-size: 8px !important;
            }

            .ez-logo {
                width: 110px !important;
            }

            table {
                font-size: 8px;
            }

            thead th {
                padding: 5px 3px;
                font-size: 8px;
            }

            tbody td,
            tfoot td {
                padding: 4px 3px;
                font-size: 8px;
            }
        }

        @media (max-width: 1024px) {
            .invoice-header {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .vendor-logo,
            .vendor-info,
            .ez-logo {
                width: 100%;
                justify-self: center;
            }

            .sections-row {
                grid-template-columns: 1fr;
            }

            .document-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Print Actions -->
        <div class="print-actions">
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fa fa-print"></i> Print Invoice
            </button>
            <a href="{{ route('guest.bookings') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Bookings
            </a>
        </div>

        <!-- Header -->
        <header class="invoice-header">
            @php
                $firstRoom = $booking->rooms_data[0] ?? null;
                $hotel = $booking->getPrimaryHotel();
            @endphp
            
            <div class="vendor-logo">
                @php
                    $hotelPhoto = null;
                    if ($hotel) {
                        // Check if hotel has a direct photo field
                        if (isset($hotel->photo) && $hotel->photo) {
                            $hotelPhoto = $hotel->photo;
                        }
                        // If not, try to get from featured_photo (which is JSON array)
                        elseif (isset($hotel->featured_photo) && $hotel->featured_photo) {
                            $featuredPhotos = is_string($hotel->featured_photo) 
                                ? json_decode($hotel->featured_photo, true) 
                                : $hotel->featured_photo;
                            if (!empty($featuredPhotos) && is_array($featuredPhotos) && isset($featuredPhotos[0])) {
                                $hotelPhoto = $featuredPhotos[0];
                            }
                        }
                    } 
                    // Fallback to room's hotel photo if available
                    elseif ($firstRoom && isset($firstRoom['hotelPhoto'])) {
                        $hotelPhoto = $firstRoom['hotelPhoto'];
                    }
                @endphp
                
                @if($hotelPhoto)
                    <img src="{{ asset($hotelPhoto) }}" alt="Hotel" style="max-height: 80px; width: auto; object-fit: contain;">
                @else
                    <div style="width: 150px; height: 60px; background: linear-gradient(135deg, #90278e 0%, #b84ab5 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 18px;">
                        HOTEL
                    </div>
                @endif
            </div>
            
            <div class="vendor-info">
                <h1>{{ $booking->getHotelName() }}</h1>
                <p>{{ $hotel->address ?? ($firstRoom['hotelAddress'] ?? 'Address not available') }}</p>
                @if($hotel)
                    @if(isset($hotel->email))
                    <p>Email: {{ $hotel->email }}</p>
                    @endif
                    @if(isset($hotel->phone))
                    <p>Phone: {{ $hotel->phone }}</p>
                    @endif
                @elseif($firstRoom)
                    @if(isset($firstRoom['hotelEmail']))
                    <p>Email: {{ $firstRoom['hotelEmail'] }}</p>
                    @endif
                    @if(isset($firstRoom['hotelPhone']))
                    <p>Phone: {{ $firstRoom['hotelPhone'] }}</p>
                    @endif
                @endif
            </div>
            
            <div class="ez-logo">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="EZ Booking">
            </div>
        </header>

        <!-- Invoice Metadata -->
        <div class="invoice-meta">
            <div class="meta-item left">
                <div class="meta-label">Invoice Number</div>
                <div class="meta-value">{{ $booking->invoice_number }}</div>
            </div>
            <div class="meta-item right">
                <div class="meta-label">Booking Date</div>
                <div class="meta-value">{{ $booking->created_at->format('d F Y') }}</div>
            </div>
        </div>

        <!-- Bill To Section -->
        <section class="invoice-section">
            <h2 class="section-title">Bill To</h2>
            <div class="section-content">
                <div class="guest-details">
                    <div class="detail-item">
                        <div class="detail-label">Guest Name</div>
                        <div class="detail-value">{{ $booking->guest_name }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Phone</div>
                        <div class="detail-value">{{ $booking->guest_phone }}</div>
                    </div>
                    @if($booking->guest_email)
                    <div class="detail-item">
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $booking->guest_email }}</div>
                    </div>
                    @endif
                    <div class="detail-item">
                        <div class="detail-label">Address</div>
                        <address class="detail-value">{{ $booking->home_address }}</address>
                    </div>
                </div>
            </div>
        </section>

        <!-- Booking Details Section -->
        <section class="invoice-section booking-details-section">
            <h2 class="section-title">Booking Details</h2>
            <div class="section-content">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th class="text-right">Nights</th>
                                <th class="text-right">Night</th>
                                <th class="text-right">Adults</th>
                                <th class="text-right">Kids</th>
                                <th class="text-right">Price/Night</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking->rooms_data as $room)
                            <tr>
                                <td>
                                    {{ $room['roomName'] }}
                                    @if(isset($room['roomNumber']) && $room['roomNumber'])
                                        (Room #{{ $room['roomNumber'] }})
                                    @endif
                                    @if(isset($room['floorNumber']) && $room['floorNumber'])
                                        - {{ $room['floorNumber'] }}{{ $room['floorNumber'] == 1 ? 'st' : ($room['floorNumber'] == 2 ? 'nd' : ($room['floorNumber'] == 3 ? 'rd' : 'th')) }} Floor
                                    @endif
                                </td>
                                <td>{{ $booking->checkin_date->format('d M Y') }}</td>
                                <td>{{ $booking->checkout_date->format('d M Y') }}</td>
                                <td class="text-right">{{ $booking->total_nights }}</td>
                                <td class="text-right">{{ $room['quantity'] }}</td>
                                <td class="text-right">{{ $booking->total_male + $booking->total_female }}</td>
                                <td class="text-right">{{ $booking->total_kids }}</td>
                                <td class="text-right">BDT {{ number_format($room['price'], 2) }}</td>
                                <td class="text-right">BDT {{ number_format($room['price'] * $room['quantity'] * $booking->total_nights, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8" class="text-right tfoot-subtotal"><strong>Subtotal:</strong></td>
                                <td class="text-right tfoot-subtotal"><strong>BDT {{ number_format($booking->subtotal, 2) }}</strong></td>
                            </tr>
                            @if($booking->discount > 0)
                            <tr>
                                <td colspan="8" class="text-right tfoot-discount"><strong>Discount:</strong></td>
                                <td class="text-right tfoot-discount"><strong>-BDT {{ number_format($booking->discount, 2) }}</strong></td>
                            </tr>
                            @endif
                            <tr class="grand-total">
                                <td colspan="8" class="text-right"><strong>Grand Total:</strong></td>
                                <td class="text-right"><strong>BDT {{ number_format($booking->grand_total, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>

        <!-- Additional Requests Section -->
        @php
            $additionalRequests = is_array($booking->additional_requests) ? $booking->additional_requests : [];
            $hasAdditionalRequests = !empty($additionalRequests) && count(array_filter($additionalRequests)) > 0;
        @endphp
        @if($hasAdditionalRequests)
        <section class="invoice-section">
            <h2 class="section-title">Additional Requests</h2>
            <div class="section-content">
                <div class="requests-list">
                    @foreach($additionalRequests as $request)
                        @if(!empty($request))
                            <span class="request-pill">{{ $request }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- Leave a Note Section -->
        @if($booking->property_note)
        <section class="invoice-section">
            <h2 class="section-title">Note For The Property</h2>
            <div class="section-content">
                <div class="note-content">{{ $booking->property_note }}</div>
            </div>
        </section>
        @endif

        <!-- Relationship With Guest -->
        <section class="invoice-section">
            <h2 class="section-title">Relationship With Guest</h2>
            <div class="section-content">
                <div class="relationship-info">
                    <span class="relationship-value">{{ ucfirst($booking->relationship) }}</span>
                    @if(!empty($booking->other_guests))
                        <span class="other-guests">({{ implode(', ', $booking->other_guests) }})</span>
                    @endif
                </div>
            </div>
        </section>

        <!-- Booking Information & Arrival Time - Side by Side -->
        <div class="sections-row">
            <section class="invoice-section">
                <h2 class="section-title">Booking Information</h2>
                <div class="section-content">
                    <div class="detail-item">
                        <div class="detail-label">Home Address</div>
                        <address class="detail-value">{{ $booking->home_address }}</address>
                    </div>
                    @if($booking->organization)
                    <div class="detail-item">
                        <div class="detail-label">Organization</div>
                        <div class="detail-value">{{ $booking->organization }}</div>
                    </div>
                    @endif
                    @if($booking->organization_address)
                    <div class="detail-item">
                        <div class="detail-label">Organization Address</div>
                        <div class="detail-value">{{ $booking->organization_address }}</div>
                    </div>
                    @endif
                </div>
            </section>

            <section class="invoice-section">
                <h2 class="section-title">Arrival Time</h2>
                <div class="section-content">
                    <div class="arrival-time">
                        @php
                            $arrivalHour = intval($booking->arrival_time);
                            if ($arrivalHour == -1) {
                                echo "I don't know";
                            } elseif ($arrivalHour >= 0 && $arrivalHour < 24) {
                                echo sprintf("%02d:00 - %02d:00", $arrivalHour, $arrivalHour + 1);
                            } else {
                                echo sprintf("%02d:00 - %02d:00 (next day)", $arrivalHour - 24, $arrivalHour - 23);
                            }
                        @endphp
                    </div>
                </div>
            </section>
        </div>

        <!-- NID/Passport Images -->
        @if($booking->nid_front || $booking->nid_back || $booking->passport || $booking->visa)
        <section class="invoice-section">
            <h2 class="section-title">{{ $booking->citizenship == 'bangladesh' ? 'NID' : 'Passport/Visa' }} Documents</h2>
            <div class="section-content">
                <div class="document-section">
                    @if($booking->nid_front)
                        <div class="document-preview">
                            @php
                                // Support both old storage path and new public folder path
                                $nidFrontPath = strpos($booking->nid_front, 'storage/') === 0 
                                    ? asset('storage/' . str_replace('storage/', '', $booking->nid_front)) 
                                    : asset($booking->nid_front);
                            @endphp
                            <img src="{{ $nidFrontPath }}" alt="NID Front" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="doc-icon" style="display: none; flex-direction: column; align-items: center; justify-content: center;"><i class="fa fa-file-image"></i></div>
                            <div class="doc-text">NID Front</div>
                        </div>
                    @endif
                    @if($booking->nid_back)
                        <div class="document-preview">
                            @php
                                // Support both old storage path and new public folder path
                                $nidBackPath = strpos($booking->nid_back, 'storage/') === 0 
                                    ? asset('storage/' . str_replace('storage/', '', $booking->nid_back)) 
                                    : asset($booking->nid_back);
                            @endphp
                            <img src="{{ $nidBackPath }}" alt="NID Back" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="doc-icon" style="display: none; flex-direction: column; align-items: center; justify-content: center;"><i class="fa fa-file-image"></i></div>
                            <div class="doc-text">NID Back</div>
                        </div>
                    @endif
                    @if($booking->passport)
                        <div class="document-preview">
                            @php
                                // Support both old storage path and new public folder path
                                $passportPath = strpos($booking->passport, 'storage/') === 0 
                                    ? asset('storage/' . str_replace('storage/', '', $booking->passport)) 
                                    : asset($booking->passport);
                            @endphp
                            <img src="{{ $passportPath }}" alt="Passport" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="doc-icon" style="display: none; flex-direction: column; align-items: center; justify-content: center;"><i class="fa fa-file-image"></i></div>
                            <div class="doc-text">Passport</div>
                        </div>
                    @endif
                    @if($booking->visa)
                        <div class="document-preview">
                            @php
                                // Support both old storage path and new public folder path
                                $visaPath = strpos($booking->visa, 'storage/') === 0 
                                    ? asset('storage/' . str_replace('storage/', '', $booking->visa)) 
                                    : asset($booking->visa);
                            @endphp
                            <img src="{{ $visaPath }}" alt="Visa" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="doc-icon" style="display: none; flex-direction: column; align-items: center; justify-content: center;"><i class="fa fa-file-image"></i></div>
                            <div class="doc-text">Visa</div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        @endif

        <!-- Footer -->
        <footer style="margin-top: 25px; padding-top: 15px; border-top: 2px solid var(--border-color); text-align: center; color: var(--text-muted); font-size: 11px;">
            <p>This is an electronically generated invoice. No signature required.</p>
            <p style="margin-top: 3px;">Thank you for booking with EGKom!</p>
            <p style="margin-top: 10px; font-weight: 600;">Status: <span style="color: var(--brand);">{{ strtoupper($booking->booking_status) }}</span></p>
        </footer>
    </div>
</body>
</html>

