@extends('auth.layout.super_admin_layout')

@section('mainbody')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .nk-content-body {
        padding: 20px;
    }
    .review-detail-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .rating-display {
        font-size: 48px;
        font-weight: bold;
        color: #91278f;
    }
    .category-rating {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .category-rating:last-child {
        border-bottom: none;
    }
    .progress-custom {
        height: 8px;
        background: #f0f0f0;
        border-radius: 4px;
        overflow: hidden;
    }
    .review-images-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 10px;
        margin-top: 15px;
    }
    .review-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.3s;
    }
    .review-image:hover {
        transform: scale(1.05);
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

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('super-admin.reviews.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Reviews
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="review-detail-card">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h3>{{ $review->title ?? 'No Title' }}</h3>
                        <p class="text-muted mb-0">
                            By <strong>{{ $review->guest->name ?? 'Guest' }}</strong> 
                            on {{ $review->created_at->format('F d, Y') }}
                        </p>
                        @if($review->booking)
                        @php
                            $booking = $review->booking;
                            $hotelRooms = collect($booking->rooms_data ?? [])->filter(fn($r) => isset($r['hotelId']) && (int)($r['hotelId'] ?? 0) === (int)$review->hotel_id);
                            $roomNames = $hotelRooms->map(fn($r) => ($r['quantity'] ?? 1) . 'x ' . ($r['roomName'] ?? 'Room'))->unique()->implode(', ');
                        @endphp
                        <p class="text-muted mb-0 mt-2">
                            <i class="fas fa-bed"></i> Did you stay: <strong>{{ $roomNames ?: 'Room' }}</strong> 
                            from {{ $booking->checkin_date->format('M d, Y') }} to {{ $booking->checkout_date->format('M d, Y') }} 
                            ({{ $booking->total_nights }} {{ $booking->total_nights == 1 ? 'night' : 'nights' }})
                        </p>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="rating-display">{{ number_format($review->overall_rating, 1) }}</div>
                        <small class="text-muted">/ 10</small>
                        @if($review->is_featured)
                            <span class="badge badge-warning" style="background: #f59e0b; color: white;">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <h5>Review Comment</h5>
                    <p>{{ $review->comment ?? 'No comment provided' }}</p>
                </div>

                @if($review->pros || $review->cons)
                <div class="row mb-4">
                    @if($review->pros)
                    <div class="col-md-6">
                        <h5><i class="fas fa-smile text-success"></i> Pros</h5>
                        <p>{{ $review->pros }}</p>
                    </div>
                    @endif
                    @if($review->cons)
                    <div class="col-md-6">
                        <h5><i class="fas fa-frown text-danger"></i> Cons</h5>
                        <p>{{ $review->cons }}</p>
                    </div>
                    @endif
                </div>
                @endif

                @if($review->images && count($review->images) > 0)
                <div class="mb-4">
                    <h5>Review Images ({{ count($review->images) }})</h5>
                    <div class="review-images-gallery">
                        @foreach($review->images as $image)
                            @php
                                // Handle different path formats - prioritize public/uploads
                                if (strpos($image, 'http') === 0) {
                                    $imageUrl = $image;
                                } elseif (strpos($image, 'uploads/') === 0) {
                                    $imageUrl = asset($image);
                                } elseif (strpos($image, 'storage/') === 0) {
                                    $imageUrl = asset($image);
                                } elseif (strpos($image, '/') === 0) {
                                    $imageUrl = asset($image);
                                } else {
                                    // Default to uploads/reviews for new uploads
                                    $imageUrl = asset('uploads/reviews/' . $image);
                                }
                            @endphp
                            <img src="{{ $imageUrl }}" alt="Review Image" class="review-image" onclick="window.open('{{ $imageUrl }}', '_blank')" onerror="this.style.display='none';">
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mb-4">
                    <h5>Category Ratings</h5>
                    @php
                        $categories = [
                            'Staff' => $review->staff_rating,
                            'Facilities' => $review->facilities_rating,
                            'Cleanliness' => $review->cleanliness_rating,
                            'Location' => $review->location_rating,
                            'Comfort' => $review->comfort_rating,
                            'Value for Money' => $review->value_for_money_rating,
                            'Free WiFi' => $review->free_wifi_rating,
                        ];
                    @endphp
                    @foreach($categories as $name => $rating)
                        @if($rating)
                        <div class="category-rating">
                            <span><strong>{{ $name }}</strong></span>
                            <div class="d-flex align-items-center gap-3" style="width: 60%;">
                                <div class="progress-custom" style="flex: 1;">
                                    <div class="progress-bar" style="width: {{ ($rating / 10) * 100 }}%; background-color: #91278f; height: 100%;"></div>
                                </div>
                                <span style="min-width: 40px; text-align: right;"><strong>{{ number_format($rating, 1) }}</strong></span>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

            @if($review->hotel_response)
            <div class="review-detail-card" style="background: #f8f9fa;">
                <h5>Hotel Response</h5>
                <p>{{ $review->hotel_response }}</p>
                <small class="text-muted">
                    Responded on {{ $review->hotel_response_date ? $review->hotel_response_date->format('F d, Y') : 'N/A' }}
                </small>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="review-detail-card">
                <h5>Review Information</h5>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($review->is_approved)
                                <span class="badge badge-success" style="background: #10b981; color: white;">
                                    <i class="fas fa-check"></i> Approved
                                </span>
                            @else
                                <span class="badge badge-warning" style="background: #f59e0b; color: white;">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Hotel:</strong></td>
                        <td>{{ $review->hotel->description ?? $review->hotel->property_category ?? 'Hotel #' . $review->hotel_id }}</td>
                    </tr>
                    @if($review->booking)
                    @php
                        $booking = $review->booking;
                        $hotelRooms = collect($booking->rooms_data ?? [])->filter(fn($r) => isset($r['hotelId']) && (int)($r['hotelId'] ?? 0) === (int)$review->hotel_id);
                        $roomNames = $hotelRooms->map(fn($r) => ($r['quantity'] ?? 1) . 'x ' . ($r['roomName'] ?? 'Room'))->unique()->implode(', ');
                    @endphp
                    <tr>
                        <td><strong>Room(s):</strong></td>
                        <td>{{ $roomNames ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Stay Period:</strong></td>
                        <td>{{ $booking->checkin_date->format('M d, Y') }} to {{ $booking->checkout_date->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nights:</strong></td>
                        <td>{{ $booking->total_nights }} {{ $booking->total_nights == 1 ? 'night' : 'nights' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Booking:</strong></td>
                        <td>
                            <a href="{{ route('super-admin.bookings.show', $booking->id) }}">
                                {{ $booking->invoice_number }}
                            </a>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td><strong>Booking:</strong></td>
                        <td>N/A</td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Guest:</strong></td>
                        <td>{{ $review->guest->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $review->guest->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Submitted:</strong></td>
                        <td>{{ $review->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                </table>

                <hr>

                <h5>Actions (Super Admin)</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('super-admin.reviews.edit', $review->id) }}" class="btn btn-info btn-block">
                        <i class="fas fa-edit"></i> Edit Review
                    </a>
                    @if(!$review->is_approved)
                        <form method="POST" action="{{ route('super-admin.reviews.approve', $review->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> Approve Review
                            </button>
                        </form>
                    @endif
                    
                    <form method="POST" action="{{ route('super-admin.reviews.toggle-featured', $review->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-star"></i> {{ $review->is_featured ? 'Unfeature' : 'Feature' }} Review
                        </button>
                    </form>

                    <form method="POST" action="{{ route('super-admin.reviews.reject', $review->id) }}" onsubmit="return confirm('Are you sure you want to reject and delete this review? This action cannot be undone.');">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Reject & Delete Review
                        </button>
                    </form>
                </div>

                <hr>

                <h5>Edit Hotel Response (Super Admin Only)</h5>
                <form method="POST" action="{{ route('super-admin.reviews.add-response', $review->id) }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="hotel_response" class="form-control" rows="4" placeholder="Enter hotel response...">{{ $review->hotel_response }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="fas fa-reply"></i> {{ $review->hotel_response ? 'Update' : 'Add' }} Response
                        </button>
                        @if($review->hotel_response)
                        <form method="POST" action="{{ route('super-admin.reviews.delete-response', $review->id) }}" class="d-inline" onsubmit="return confirm('Delete this hotel response?');">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection

