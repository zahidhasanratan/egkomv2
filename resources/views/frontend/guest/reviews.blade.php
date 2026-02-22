@extends('frontend.app')
@section('title','My Reviews - EZBOOKING')
@section('main')

@include('frontend.guest.dashboard-styles')
@include('frontend.guest.dashboard-header')

<style>
    .reviews-grid {
        display: grid;
        gap: 20px;
        margin-bottom: 30px;
    }
    .review-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: all 0.3s;
    }
    .review-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }
    .review-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid #91278f;
    }
    .review-rating {
        font-size: 28px;
        font-weight: 700;
        color: #91278f;
    }
    .review-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-approved { background: #d1fae5; color: #065f46; }
    .status-pending { background: #fef3c7; color: #92400e; }
    .review-card-body { padding: 20px; }
    .review-hotel { font-size: 18px; font-weight: 600; color: #1a1a1a; margin-bottom: 8px; }
    .review-title { font-weight: 600; color: #333; margin-bottom: 8px; }
    .review-comment { color: #666; font-size: 14px; margin-bottom: 12px; line-height: 1.5; }
    .review-stay-details {
        font-size: 13px;
        color: #666;
        padding: 10px 12px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .review-date { color: #999; font-size: 13px; }
    .pagination-wrapper { margin-top: 30px; display: flex; justify-content: center; }
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
        color: white;
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        @include('frontend.guest.dashboard-sidebar')
        
        <div class="dashboard-content">
            <div class="dashboard-header">
                <h1 class="dashboard-title">My Reviews</h1>
                <p class="dashboard-subtitle">Reviews you've written for hotels</p>
            </div>
            
            @if($reviews->count() > 0)
                <div class="reviews-grid">
                    @foreach($reviews as $review)
                    <div class="review-card">
                        <div class="review-card-header">
                            <div>
                                <span class="review-rating">{{ number_format($review->overall_rating, 1) }}/10</span>
                                <span class="review-date d-block mt-1">{{ $review->created_at->format('d M Y') }}</span>
                            </div>
                            <span class="review-status status-{{ $review->is_approved ? 'approved' : 'pending' }}">
                                {{ $review->is_approved ? 'Published' : 'Pending' }}
                            </span>
                        </div>
                        <div class="review-card-body">
                            <div class="review-hotel">{{ $review->hotel->description ?? $review->hotel->property_category ?? 'Hotel #'.$review->hotel_id }}</div>
                            @if($review->title)
                                <div class="review-title">{{ $review->title }}</div>
                            @endif
                            @if($review->comment)
                                <div class="review-comment">{{ Str::limit($review->comment, 200) }}</div>
                            @endif
                            @if($review->booking)
                                @php
                                    $booking = $review->booking;
                                    $hotelRooms = collect($booking->rooms_data ?? [])->filter(fn($r) => isset($r['hotelId']) && (int)($r['hotelId'] ?? 0) === (int)$review->hotel_id);
                                    $roomNames = $hotelRooms->map(fn($r) => ($r['quantity'] ?? 1) . 'x ' . ($r['roomName'] ?? 'Room'))->unique()->implode(', ');
                                @endphp
                                <div class="review-stay-details">
                                    <i class="fa fa-bed"></i> {{ $roomNames ?: 'Room' }} — 
                                    {{ $booking->checkin_date->format('M d, Y') }} to {{ $booking->checkout_date->format('M d, Y') }} 
                                    ({{ $booking->total_nights }} {{ $booking->total_nights == 1 ? 'night' : 'nights' }})
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="pagination-wrapper">
                    {{ $reviews->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fa fa-star"></i>
                    </div>
                    <h4 class="empty-state-title">No reviews yet</h4>
                    <p class="empty-state-text">Share your experience by writing reviews for hotels you've stayed at</p>
                    <a href="{{ route('welcome') }}" class="btn-browse-hotels">Browse Hotels</a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
