@extends('frontend.app')
@section('title','My Wishlist - EZBOOKING')
@section('main')

@include('frontend.guest.dashboard-styles')
@include('frontend.guest.dashboard-header')

<style>
    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .wishlist-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: all 0.3s;
        position: relative;
    }
    
    .wishlist-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        transform: translateY(-4px);
    }
    
    .wishlist-card-image {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: #f0f0f0;
    }
    
    .wishlist-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    
    .wishlist-card:hover .wishlist-card-image img {
        transform: scale(1.05);
    }
    
    .wishlist-heart-icon-card {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }
    
    .wishlist-heart-icon-card:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    }
    
    .wishlist-heart-icon-card i {
        font-size: 20px;
        color: #e91e63;
    }
    
    .wishlist-heart-icon-card i:before {
        content: "\f004"; /* Font Awesome filled heart */
    }
    
    .wishlist-card-body {
        padding: 20px;
    }
    
    .wishlist-hotel-name {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .wishlist-room-name {
        font-size: 18px;
        font-weight: 700;
        color: #91278f;
        margin-bottom: 10px;
    }
    
    .wishlist-room-details {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 15px;
        color: #666;
        font-size: 14px;
    }
    
    .wishlist-room-detail-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .wishlist-room-detail-item i {
        color: #91278f;
        font-size: 16px;
    }
    
    .wishlist-price {
        display: flex;
        align-items: baseline;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .wishlist-price-current {
        font-size: 24px;
        font-weight: 700;
        color: #91278f;
    }
    
    .wishlist-price-label {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
    }
    
    .wishlist-price-original {
        font-size: 16px;
        color: #999;
        text-decoration: line-through;
    }
    
    .wishlist-card-actions {
        display: flex;
        gap: 10px;
        padding-top: 15px;
        border-top: 1px solid #e0e0e0;
    }
    
    .btn-view-details {
        flex: 1;
        padding: 10px 20px;
        background: #91278f;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s;
    }
    
    .btn-view-details:hover {
        background: #6b1f6e;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(145, 39, 143, 0.3);
        color: white;
    }
    
    .btn-remove-wishlist {
        padding: 10px 15px;
        background: #fee2e2;
        color: #991b1b;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-remove-wishlist:hover {
        background: #fecaca;
        transform: translateY(-2px);
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .empty-state-icon {
        font-size: 80px;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .empty-state-title {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    
    .empty-state-text {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
    }
    
    .btn-browse-hotels {
        display: inline-block;
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
    
    .pagination-wrapper {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }
    
    @media (max-width: 768px) {
        .wishlist-grid {
            grid-template-columns: 1fr;
        }
        
        .wishlist-card-actions {
            flex-direction: column;
        }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        @include('frontend.guest.dashboard-sidebar')
        
        <div class="dashboard-content">
            <div class="dashboard-header">
                <h1 class="dashboard-title">My Wishlist</h1>
                <p class="dashboard-subtitle">Your favorite rooms saved for later</p>
            </div>
            
            @if($wishlists->count() > 0)
                <div class="wishlist-grid">
                    @foreach($wishlists as $wishlist)
                    @php
                        $room = $wishlist->room;
                        $hotel = $room->hotel ?? null;
                        $featurePhoto = $room->photos->where('category', 'feature')->first();
                        
                        $originalPrice = $room->price_per_night;
                        $discountedPrice = $originalPrice;
                        $discountPercentage = 0;
                        
                        if ($room->discount_type == 'percentage' && $room->discount_percentage) {
                            $discountPercentage = $room->discount_percentage;
                            $discountedPrice = $originalPrice - ($originalPrice * $discountPercentage / 100);
                        } elseif ($room->discount_type == 'amount' && $room->discount_amount) {
                            $discountedPrice = $originalPrice - $room->discount_amount;
                            $discountPercentage = (($originalPrice - $discountedPrice) / $originalPrice) * 100;
                        }
                    @endphp
                    <div class="wishlist-card">
                        <div class="wishlist-card-image">
                            @if($featurePhoto)
                                <img src="{{ asset($featurePhoto->photo_path) }}" alt="{{ $room->name }}">
                            @else
                                <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #999;">
                                    <i class="fa fa-image" style="font-size: 48px;"></i>
                                </div>
                            @endif
                            <div class="wishlist-heart-icon-card" 
                                 data-room-id="{{ $room->id }}"
                                 onclick="toggleWishlist({{ $room->id }})">
                                <i class="fa fa-heart"></i>
                            </div>
                        </div>
                        
                        <div class="wishlist-card-body">
                            @if($hotel)
                            <div class="wishlist-hotel-name">{{ $hotel->description ?? $hotel->property_category ?? 'Hotel' }}</div>
                            @endif
                            
                            <div class="wishlist-room-name">{{ $room->name }}</div>
                            
                            <div class="wishlist-room-details">
                                @if($room->total_persons)
                                <div class="wishlist-room-detail-item">
                                    <i class="fa fa-users"></i>
                                    <span>{{ $room->total_persons }} Guest{{ $room->total_persons > 1 ? 's' : '' }}</span>
                                </div>
                                @endif
                                
                                @if($room->total_beds)
                                <div class="wishlist-room-detail-item">
                                    <i class="fa fa-bed"></i>
                                    <span>{{ $room->total_beds }} Bed{{ $room->total_beds > 1 ? 's' : '' }}</span>
                                </div>
                                @endif
                                
                                @if($room->size)
                                <div class="wishlist-room-detail-item">
                                    <i class="fa fa-arrows-alt"></i>
                                    <span>{{ $room->size }} sq ft</span>
                                </div>
                                @endif
                            </div>
                            
                            <div class="wishlist-price">
                                <span class="wishlist-price-current">BDT {{ number_format($discountedPrice, 2) }}</span>
                                <span class="wishlist-price-label">per night</span>
                                @if($discountPercentage > 0)
                                <span class="wishlist-price-original">BDT {{ number_format($originalPrice, 2) }}</span>
                                @endif
                            </div>
                            
                            <div class="wishlist-card-actions">
                                <a href="{{ route('hotel.details', encrypt($hotel->id ?? 0)) }}" class="btn-view-details">
                                    View Details
                                </a>
                                <button type="button" 
                                        class="btn-remove-wishlist" 
                                        onclick="toggleWishlist({{ $room->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="pagination-wrapper">
                    {{ $wishlists->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fa fa-heart-o"></i>
                    </div>
                    <h4 class="empty-state-title">Your wishlist is empty</h4>
                    <p class="empty-state-text">Start exploring and save your favorite rooms!</p>
                    <a href="{{ route('welcome') }}" class="btn-browse-hotels">Browse Hotels</a>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleWishlist(roomId) {
        fetch('{{ route("wishlist.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ room_id: roomId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.action === 'login_required') {
                Swal.fire({
                    icon: 'info',
                    title: 'Login Required',
                    text: 'Please login to manage your wishlist',
                    confirmButtonColor: '#91278f',
                    showCancelButton: true,
                    confirmButtonText: 'Login',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("guest.login") }}';
                    }
                });
                return;
            }
            
            if (data.is_wishlisted) {
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Wishlist!',
                    text: data.message,
                    confirmButtonColor: '#91278f',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Removed from Wishlist',
                    text: data.message,
                    confirmButtonColor: '#91278f',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    // Reload page to remove the card
                    location.reload();
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong. Please try again.',
                confirmButtonColor: '#91278f'
            });
        });
    }
</script>

@endsection
