<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Co-Host Dashboard - EZBOOKING</title>
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

        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            margin: 0 10px;
            font-weight: 500;
        }

        .navbar .nav-link:hover {
            color: white !important;
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

        .dashboard-header {
            background: white;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .dashboard-subtitle {
            color: #666;
            font-size: 16px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 24px;
        }

        .stat-icon.purple {
            background: #f0edff;
            color: #667eea;
        }

        .stat-icon.green {
            background: #e6fff9;
            color: #1ee0ac;
        }

        .stat-icon.orange {
            background: #fff5e6;
            color: #f4bd0e;
        }

        .stat-icon.red {
            background: #ffe6e6;
            color: #e85347;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }

        .hotel-info-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .hotel-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
        }

        .hotel-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .hotel-logo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: bold;
        }

        .hotel-details h3 {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .hotel-details p {
            color: #666;
            margin: 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-size: 18px;
        }

        .info-content h5 {
            font-size: 12px;
            color: #999;
            margin-bottom: 3px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-content p {
            font-size: 15px;
            color: #333;
            font-weight: 600;
            margin: 0;
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

        .logout-btn:hover {
            background: #d63c30;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
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
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Welcome, {{ $coHost->name }}!</h1>
            <p class="dashboard-subtitle">Co-Host Dashboard for {{ $hotel->description ?? 'Hotel' }}</p>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-bed"></i>
                </div>
                <div class="stat-value">{{ $hotel->rooms->count() }}</div>
                <div class="stat-label">Total Rooms</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-value">
                    @php
                        $activeBookings = \App\Models\Booking::where('booking_status', 'confirmed')
                            ->whereJsonContains('rooms_data', [['hotelId' => $hotel->id]])
                            ->orWhere(function($query) use ($hotel) {
                                $query->where('booking_status', 'confirmed')
                                      ->whereRaw("JSON_SEARCH(rooms_data, 'one', ?) IS NOT NULL", [$hotel->id]);
                            })
                            ->count();
                    @endphp
                    {{ $activeBookings }}
                </div>
                <div class="stat-label">Active Bookings</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-value">{{ $coHost->response_rate }}%</div>
                <div class="stat-label">Response Rate</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon red">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value">{{ ucfirst($coHost->response_time) }}</div>
                <div class="stat-label">Response Time</div>
            </div>
        </div>

        <!-- Hotel Information -->
        <div class="hotel-info-card">
            <div class="hotel-header">
                @php
                    $vendor = $hotel->vendor;
                    $vendorLogo = $vendor ? ($vendor->logo ?? $vendor->profile_picture ?? null) : null;
                    $featuredPhotos = is_string($hotel->featured_photo) ? json_decode($hotel->featured_photo, true) : [];
                @endphp
                
                @if($vendorLogo)
                    <img src="{{ asset($vendorLogo) }}" alt="Hotel" class="hotel-logo">
                @elseif(!empty($featuredPhotos[0]))
                    <img src="{{ asset($featuredPhotos[0]) }}" alt="Hotel" class="hotel-logo">
                @else
                    <div class="hotel-logo-placeholder">
                        {{ strtoupper(substr($hotel->description ?? 'H', 0, 1)) }}
                    </div>
                @endif

                <div class="hotel-details">
                    <h3>{{ $hotel->description ?? 'Hotel' }}</h3>
                    <p><i class="fas fa-map-marker-alt me-2"></i>{{ $hotel->address ?? 'Address not available' }}</p>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="info-content">
                        <h5>Total Rooms</h5>
                        <p>{{ $hotel->rooms->count() }} Rooms</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <div class="info-content">
                        <h5>Property Type</h5>
                        <p>{{ $hotel->property_type ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="info-content">
                        <h5>Status</h5>
                        <p>{{ ucfirst($hotel->status ?? 'Active') }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="info-content">
                        <h5>Approval</h5>
                        <p>{{ $hotel->approve ? 'Approved' : 'Pending' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Role Section -->
        <div class="hotel-info-card">
            <h4 style="margin-bottom: 20px; color: #1a1a1a; font-weight: 700;">Your Role</h4>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h5>Email</h5>
                        <p>{{ $coHost->email }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info-content">
                        <h5>Phone</h5>
                        <p>{{ $coHost->phone ?? 'Not set' }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <div class="info-content">
                        <h5>Language</h5>
                        <p>{{ $coHost->language ?? 'English' }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="info-content">
                        <h5>Response Rate</h5>
                        <p>{{ $coHost->response_rate }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="hotel-info-card">
            <h4 style="margin-bottom: 20px; color: #1a1a1a; font-weight: 700;">Quick Actions</h4>
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('hotel.details', encrypt($hotel->id)) }}" target="_blank" class="btn btn-outline-primary w-100" style="padding: 15px;">
                        <i class="fas fa-eye me-2"></i> View Property Page
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('co-host.bookings') }}" class="btn btn-outline-success w-100" style="padding: 15px;">
                        <i class="fas fa-calendar-check me-2"></i> View Bookings
                    </a>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-outline-info w-100" style="padding: 15px;" disabled>
                        <i class="fas fa-comments me-2"></i> Messages (Coming Soon)
                    </button>
                </div>
            </div>
        </div>

        <!-- Bio Section -->
        @if($coHost->bio)
        <div class="hotel-info-card">
            <h4 style="margin-bottom: 15px; color: #1a1a1a; font-weight: 700;">About You</h4>
            <p style="color: #666; line-height: 1.8;">{{ $coHost->bio }}</p>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

