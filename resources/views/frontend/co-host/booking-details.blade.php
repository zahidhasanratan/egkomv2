<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Co-Host Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f7fa;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 24px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            color: #667eea;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }

        .logout-btn {
            background: #e85347;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .page-header {
            background: white;
            padding: 25px 30px;
            margin-bottom: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-label {
            font-size: 12px;
            color: #999;
            font-weight: 600;
            text-transform: uppercase;
        }

        .info-value {
            font-size: 15px;
            color: #333;
            font-weight: 600;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-block;
        }

        .btn-back {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('co-host.dashboard') }}">
                <i class="fas fa-hotel me-2"></i> EGKom Co-Host
            </a>
            <div class="ms-auto">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr($coHost->name, 0, 2)) }}
                    </div>
                    <span>{{ $coHost->name }}</span>
                    <form method="POST" action="{{ route('co-host.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Booking Details</h1>
                <p style="color: #666; margin: 0;">{{ $booking->invoice_number }}</p>
            </div>
            <a href="{{ route('co-host.bookings') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i> Back to Bookings
            </a>
        </div>

        @if(session('success'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#667eea'
                });
            </script>
        @endif

        <div class="row">
            <div class="col-md-8">
                <!-- Booking Information -->
                <div class="section-card">
                    <h5 class="section-title">
                        <i class="fas fa-info-circle"></i> Booking Information
                    </h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Invoice Number</span>
                            <span class="info-value">{{ $booking->invoice_number }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Booking Status</span>
                            <span class="status-badge status-{{ $booking->booking_status }}">
                                {{ ucfirst($booking->booking_status) }}
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Booking Date</span>
                            <span class="info-value">{{ $booking->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Guest Information -->
                <div class="section-card">
                    <h5 class="section-title">
                        <i class="fas fa-user"></i> Guest Information
                    </h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Guest Name</span>
                            <span class="info-value">{{ $booking->guest_name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $booking->guest_email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone</span>
                            <span class="info-value">{{ $booking->guest_phone }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Address</span>
                            <span class="info-value">{{ $booking->home_address ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Stay Details -->
                <div class="section-card">
                    <h5 class="section-title">
                        <i class="fas fa-calendar"></i> Stay Details
                    </h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Check-in Date</span>
                            <span class="info-value">{{ $booking->checkin_date->format('d M Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Check-out Date</span>
                            <span class="info-value">{{ $booking->checkout_date->format('d M Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Total Nights</span>
                            <span class="info-value">{{ $booking->total_nights }} night{{ $booking->total_nights > 1 ? 's' : '' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Total Guests</span>
                            <span class="info-value">{{ $booking->total_persons }} ({{ $booking->total_male }}M, {{ $booking->total_female }}F, {{ $booking->total_kids }}K)</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Arrival Time</span>
                            <span class="info-value">{{ $booking->arrival_time ?? 'Not specified' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Rooms Booked -->
                <div class="section-card">
                    <h5 class="section-title">
                        <i class="fas fa-bed"></i> Rooms Booked
                    </h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Room Name</th>
                                <th>Quantity</th>
                                <th>Price/Night</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking->rooms_data as $room)
                            <tr>
                                <td>{{ $room['roomName'] }}</td>
                                <td>{{ $room['quantity'] }}</td>
                                <td>BDT {{ number_format($room['price'], 2) }}</td>
                                <td>BDT {{ number_format($room['price'] * $room['quantity'] * $booking->total_nights, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Update Status -->
                <div class="section-card">
                    <h5 class="section-title">
                        <i class="fas fa-tasks"></i> Update Status
                    </h5>
                    <form action="{{ route('co-host.bookings.updateStatus', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Booking Status</label>
                            <select name="booking_status" class="form-control" required>
                                <option value="pending" {{ $booking->booking_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->booking_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->booking_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->booking_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-check"></i> Update Status
                        </button>
                    </form>
                </div>

                <!-- Payment Summary -->
                <div class="section-card">
                    <h5 class="section-title">
                        <i class="fas fa-money-bill-wave"></i> Payment Summary
                    </h5>
                    <table class="table table-borderless" style="margin-bottom: 0;">
                        <tr>
                            <td>Subtotal:</td>
                            <td class="text-end"><strong>BDT {{ number_format($booking->subtotal, 2) }}</strong></td>
                        </tr>
                        @if($booking->discount > 0)
                        <tr>
                            <td>Discount:</td>
                            <td class="text-end" style="color: #1ee0ac;"><strong>- BDT {{ number_format($booking->discount, 2) }}</strong></td>
                        </tr>
                        @endif
                        <tr>
                            <td>Tax:</td>
                            <td class="text-end"><strong>BDT {{ number_format($booking->tax, 2) }}</strong></td>
                        </tr>
                        <tr style="border-top: 2px solid #e0e0e0;">
                            <td><strong>Grand Total:</strong></td>
                            <td class="text-end"><strong style="color: #667eea; font-size: 18px;">BDT {{ number_format($booking->grand_total, 2) }}</strong></td>
                        </tr>
                    </table>
                </div>

                <!-- Quick Actions -->
                <div class="section-card">
                    <a href="{{ route('booking.invoice', $booking->id) }}" target="_blank" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-file-invoice me-2"></i> View Invoice
                    </a>
                    <a href="{{ route('co-host.bookings') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-list me-2"></i> All Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>






