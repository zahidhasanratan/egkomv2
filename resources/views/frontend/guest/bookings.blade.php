@extends('frontend.app')
@section('title','My Bookings - EGKom')
@section('main')

@include('frontend.guest.dashboard-styles')

<style>
    .bookings-grid {
        display: grid;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .booking-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: all 0.3s;
    }
    
    .booking-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }
    
    .booking-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid #91278f;
    }
    
    .booking-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .booking-invoice {
        font-size: 18px;
        font-weight: 700;
        color: #91278f;
        margin: 0;
    }
    
    .booking-status {
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
    
    .booking-date {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        font-size: 14px;
    }
    
    .booking-card-body {
        padding: 20px;
    }
    
    .hotel-info h4 {
        font-size: 20px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
    }
    
    .room-info {
        color: #666;
        font-size: 14px;
        margin-bottom: 15px;
    }
    
    .booking-dates {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    
    .date-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .date-label {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .date-value {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
    }
    
    .date-separator {
        color: #91278f;
        font-size: 20px;
        font-weight: bold;
    }
    
    .date-nights {
        margin-left: auto;
    }
    
    .nights-badge {
        background: #91278f;
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .booking-guests {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        font-size: 14px;
        margin-bottom: 15px;
    }
    
    .booking-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background: #f8f9fa;
        border-top: 1px solid #e0e0e0;
    }
    
    .booking-total {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .total-label {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
    }
    
    .total-amount {
        font-size: 24px;
        font-weight: 700;
        color: #91278f;
    }
    
    .booking-actions {
        display: flex;
        gap: 10px;
    }
    
    .btn-view-invoice {
        padding: 10px 20px;
        background: #91278f;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-view-invoice:hover {
        background: #6b1f6e;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(145, 39, 143, 0.3);
    }
    
    .btn-browse-hotels {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 24px;
        background: linear-gradient(90deg, #9333EA 0%, #6B46C1 100%);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-browse-hotels:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(147, 51, 234, 0.3);
    }
    
    .pagination-wrapper {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }
    
    @media (max-width: 768px) {
        .booking-card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .booking-dates {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .date-separator {
            transform: rotate(90deg);
        }
        
        .date-nights {
            margin-left: 0;
        }
        
        .booking-card-footer {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        @include('frontend.guest.dashboard-sidebar')
        
        <div class="dashboard-content">
            <div class="dashboard-header">
                <h1 class="dashboard-title">My Bookings</h1>
                <p class="dashboard-subtitle">View and manage all your hotel bookings</p>
            </div>
            
            @if($bookings->count() > 0)
                <div class="bookings-grid">
                    @foreach($bookings as $booking)
                    <div class="booking-card">
                        <div class="booking-card-header">
                            <div class="booking-info">
                                <h3 class="booking-invoice">{{ $booking->invoice_number }}</h3>
                                <span class="booking-status status-{{ $booking->booking_status }}">
                                    {{ ucfirst($booking->booking_status) }}
                                </span>
                            </div>
                            <div class="booking-date">
                                <i class="fa fa-calendar"></i>
                                {{ $booking->created_at->format('d M Y') }}
                            </div>
                        </div>
                        
                        <div class="booking-card-body">
                            @php
                                $firstRoom = $booking->rooms_data[0] ?? null;
                            @endphp
                            <div class="hotel-info">
                                <h4>{{ $firstRoom['hotelName'] ?? 'Hotel Booking' }}</h4>
                                <p class="room-info">
                                    @foreach($booking->rooms_data as $room)
                                        {{ $room['quantity'] }}x {{ $room['roomName'] }}@if(isset($room['roomNumber']) && $room['roomNumber']) (Room #{{ $room['roomNumber'] }})@endif@if(isset($room['floorNumber']) && $room['floorNumber']) - {{ $room['floorNumber'] }}{{ $room['floorNumber'] == 1 ? 'st' : ($room['floorNumber'] == 2 ? 'nd' : ($room['floorNumber'] == 3 ? 'rd' : 'th')) }} Floor@endif@if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            </div>
                            
                            <div class="booking-dates">
                                <div class="date-item">
                                    <span class="date-label">Check-in</span>
                                    <span class="date-value">{{ $booking->checkin_date->format('d M Y') }}</span>
                                </div>
                                <div class="date-separator">→</div>
                                <div class="date-item">
                                    <span class="date-label">Check-out</span>
                                    <span class="date-value">{{ $booking->checkout_date->format('d M Y') }}</span>
                                </div>
                                <div class="date-nights">
                                    <span class="nights-badge">{{ $booking->total_nights }} Night{{ $booking->total_nights > 1 ? 's' : '' }}</span>
                                </div>
                            </div>
                            
                            <div class="booking-guests">
                                <i class="fa fa-users"></i>
                                {{ $booking->total_persons }} Guest{{ $booking->total_persons > 1 ? 's' : '' }}
                                ({{ $booking->total_male }} Male, {{ $booking->total_female }} Female, {{ $booking->total_kids }} Kids)
                            </div>
                        </div>
                        
                        <div class="booking-card-footer">
                            <div class="booking-total">
                                <span class="total-label">Total Amount</span>
                                <span class="total-amount">BDT {{ number_format($booking->grand_total, 2) }}</span>
                            </div>
                            <div class="booking-actions">
                                <a href="{{ route('booking.invoice', $booking->id) }}" class="btn btn-view-invoice" target="_blank">
                                    <i class="fa fa-file-text-o"></i> View Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="pagination-wrapper">
                    {{ $bookings->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fa fa-calendar-check-o"></i>
                    </div>
                    <h4 class="empty-state-title">No bookings yet</h4>
                    <p class="empty-state-text">When you make a booking, it will appear here</p>
                    <a href="{{ route('welcome') }}" class="btn-browse-hotels">Browse Hotels</a>
                </div>
            @endif
        </div>
</div>

@endsection

