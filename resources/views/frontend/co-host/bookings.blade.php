<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Co-Host Dashboard</title>
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

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
        }

        .btn-back {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: #5568d3;
            color: white;
        }

        .search-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .bookings-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: #f8f9fa;
        }

        .table th {
            border: none;
            padding: 15px;
            font-weight: 600;
            color: #333;
        }

        .table td {
            padding: 15px;
            vertical-align: middle;
            color: #212529 !important;
        }
        .table tbody td,
        .table tbody td strong,
        .table tbody td small {
            color: #212529 !important;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-confirmed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-completed {
            background: #dbeafe;
            color: #1e40af;
        }

        .action-btn {
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
            margin: 2px;
        }

        .action-btn-info {
            background: #6576ff;
            color: white;
        }

        .action-btn-info:hover {
            background: #5160d8;
            color: white;
        }

        .action-btn-primary {
            background: #667eea;
            color: white;
        }

        .action-btn-primary:hover {
            background: #5568d3;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('co-host.dashboard') }}">
                <i class="fas fa-hotel me-2"></i> EZBOOKING Co-Host
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
                <h1 class="page-title">Bookings Management</h1>
                <p style="color: #666; margin: 0;">Manage all bookings for {{ $hotel->description }}</p>
            </div>
            <a href="{{ route('co-host.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
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

        <!-- Search Bar -->
        <div class="search-card">
            <form method="GET" action="{{ route('co-host.bookings') }}">
                <div class="row g-3">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search by invoice number, guest name, email, or phone..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Bookings Table -->
        @if($bookings->count() > 0)
        <div class="bookings-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Guest</th>
                        <th>Check-in / Check-out</th>
                        <th>Nights</th>
                        <th>Guests</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>
                            <strong style="color: #667eea;">{{ $booking->invoice_number }}</strong><br>
                            <small class="text-muted">{{ $booking->created_at->format('d M Y') }}</small>
                        </td>
                        <td>
                            <strong>{{ $booking->guest_name }}</strong><br>
                            <small class="text-muted">{{ $booking->guest_email }}</small>
                        </td>
                        <td>
                            <div style="font-size: 13px;">
                                <strong>{{ $booking->checkin_date->format('d M Y') }}</strong><br>
                                <small class="text-muted">to</small><br>
                                <strong>{{ $booking->checkout_date->format('d M Y') }}</strong>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $booking->total_nights }}</strong> night{{ $booking->total_nights > 1 ? 's' : '' }}
                        </td>
                        <td>
                            {{ $booking->total_persons }} guest{{ $booking->total_persons > 1 ? 's' : '' }}
                        </td>
                        <td>
                            <strong style="color: #667eea; font-size: 16px;">BDT {{ number_format($booking->grand_total, 2) }}</strong>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $booking->booking_status }}">
                                {{ ucfirst($booking->booking_status) }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('booking.invoice', $booking->id) }}" 
                               class="action-btn action-btn-info" 
                               target="_blank" 
                               title="View Invoice">
                                <i class="fas fa-file-invoice"></i> Invoice
                            </a>
                            <a href="{{ route('co-host.bookings.show', $booking->id) }}" 
                               class="action-btn action-btn-primary" 
                               title="View Details">
                                <i class="fas fa-eye"></i> Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $bookings->links() }}
        </div>
        @else
        <div class="bookings-table">
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h4 style="color: #666; margin-bottom: 10px;">No bookings found</h4>
                <p style="color: #999;">Bookings for this hotel will appear here</p>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>






