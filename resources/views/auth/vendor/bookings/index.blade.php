@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .nk-content-body {
        padding: 20px;
    }
    .container-fluid {
        padding: 0 15px;
    }
    .action-buttons {
        display: flex !important;
        gap: 5px;
        justify-content: flex-start;
        align-items: center;
    }
    .action-btn {
        width: 35px;
        height: 35px;
        border-radius: 6px;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        color: white !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    .action-btn i {
        font-size: 14px;
        color: white;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        color: white !important;
    }
    .action-btn-info {
        background: #3b82f6 !important;
    }
    .action-btn-info:hover {
        background: #2563eb !important;
    }
    .action-btn-primary {
        background: #8b5cf6 !important;
    }
    .action-btn-primary:hover {
        background: #7c3aed !important;
    }
    .action-btn-warning {
        background: #f59e0b !important;
    }
    .action-btn-warning:hover {
        background: #d97706 !important;
    }
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        background: white;
        overflow: visible;
    }
    .card-body {
        background: white;
        padding: 20px;
    }
    .card-footer {
        background: white;
        padding: 15px 20px;
        border-top: 1px solid #e0e0e0;
    }
    .card-header {
        background: linear-gradient(135deg, #90278e 0%, #6d1c6a 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 8px 8px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-title {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    .table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #90278e;
        color: #1a1a1a;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 8px;
    }
    .table td {
        vertical-align: middle;
        padding: 12px 8px;
        font-size: 13px;
    }
    .table tbody tr:hover {
        background: rgba(144, 39, 142, 0.05);
    }
</style>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Hotel Bookings</h3>
                    <div class="card-tools" style="display: flex; gap: 10px; align-items: center;">
                        <a href="{{ route('vendor.bookings.manual.create') }}" class="btn btn-primary btn-sm" style="background: white; color: #90278e; border: 1px solid white;">
                            <em class="icon ni ni-plus"></em> Create Manual Booking
                        </a>
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" id="searchInput" class="form-control float-right" placeholder="Search bookings...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap" id="bookingsTable">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Type</th>
                                <th>Guest Name</th>
                                <th>Phone</th>
                                <th>Rooms</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Nights</th>
                                <th>Guests</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr>
                                <td><strong style="color: #90278e;">{{ $booking->invoice_number }}</strong></td>
                                <td>
                                    @if($booking->is_manual)
                                        <span class="badge badge-warning" style="background: #f59e0b; color: white;">
                                            <i class="fas fa-user-edit"></i> Manual
                                        </span>
                                    @else
                                        <span class="badge badge-info" style="background: #3b82f6; color: white;">
                                            <i class="fas fa-globe"></i> Website
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $booking->guest_name }}</td>
                                <td>{{ $booking->guest_phone }}</td>
                                <td>
                                    <small>{{ count($booking->rooms_data) }} Room{{ count($booking->rooms_data) > 1 ? 's' : '' }}</small>
                                </td>
                                <td>{{ $booking->checkin_date->format('d M Y') }}</td>
                                <td>{{ $booking->checkout_date->format('d M Y') }}</td>
                                <td><span class="badge badge-info">{{ $booking->total_nights }}</span></td>
                                <td>{{ $booking->total_persons }}</td>
                                <td><strong>BDT {{ number_format($booking->grand_total, 2) }}</strong></td>
                                <td>
                                    <span class="badge badge-{{ 
                                        $booking->booking_status == 'confirmed' ? 'success' : 
                                        ($booking->booking_status == 'pending' ? 'warning' : 
                                        ($booking->booking_status == 'cancelled' ? 'danger' : 
                                        ($booking->booking_status == 'staying' ? 'primary' : 'info'))) 
                                    }}">
                                        {{ ucfirst($booking->booking_status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('booking.invoice', $booking->id) }}" class="action-btn action-btn-info" target="_blank" title="View Invoice">
                                            <i class="fas fa-file-invoice"></i>
                                        </a>
                                        <a href="{{ route('vendor.bookings.show', $booking->id) }}" class="action-btn action-btn-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('vendor.bookings.edit', $booking->id) }}" class="action-btn action-btn-warning" title="Edit Booking">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="text-center py-5">
                                    <div style="color: #999;">
                                        <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px; opacity: 0.3;"></i>
                                        <p>No bookings found for your hotels</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#bookingsTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
            </div>
        </div>
    </div>
</div>
@endsection

