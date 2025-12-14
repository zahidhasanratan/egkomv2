@extends('frontend.app')
@section('title','Search Results - EGKom')
@section('main')

    <!--===== Start: Search Results ====-->
    <section class="innerpage-wrapper">
        <div id="hotel-grid" class="innerpage-section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12 content-side">
                        
                        <!-- Search Results Summary -->
                        <div class="search-results-summary mb-4">
                            <h3 class="mb-3">
                                @if($totalHotelsCount > 0)
                                    {{ $totalHotelsCount }} {{ $totalHotelsCount == 1 ? 'hotel' : 'hotels' }} 
                                    and {{ $totalRoomsCount }} {{ $totalRoomsCount == 1 ? 'room' : 'rooms' }} found
                                @else
                                    No hotels found matching your search criteria
                                @endif
                            </h3>
                            
                            @if($destination || $checkin || $checkout)
                                <div class="search-criteria">
                                    @if($destination)
                                        <span class="badge bg-secondary me-2">Destination: {{ $destination }}</span>
                                    @endif
                                    @if($checkin)
                                        <span class="badge bg-secondary me-2">Check-in: {{ $checkin }}</span>
                                    @endif
                                    @if($checkout)
                                        <span class="badge bg-secondary me-2">Check-out: {{ $checkout }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- All Hotels Grid -->
                        <div class="row">
                            @forelse($filteredHotels as $hotel)
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <div class="grid-block main-block h-grid-block">
                                        <div class="main-img h-grid-img">
                                            <a href="{{ route('hotel.details',encrypt($hotel->id)) }}">
                                                @php
                                                    $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                @endphp

                                                @if (!empty($featuredPhotos[0]))
                                                <img style="height: 270px;width: 100%;" src="{{ asset($featuredPhotos[0]) }}" class="img-fluid" alt="{{ $hotel->description }}" />
                                                @endif
                                            </a>
                                            <div class="guest-favourite">
                                                <h3>Guest favourite</h3>
                                            </div>
                                            {{-- Hotel Wishlist Heart Icon --}}
                                            <div class="wishlist-heart-icon hotel-wishlist-icon" 
                                                 data-hotel-id="{{ $hotel->id }}"
                                                 onclick="toggleHotelWishlist({{ $hotel->id }})">
                                                <i class="fa fa-heart-o"></i>
                                            </div>
                                        </div>
                                        <!-- end h-grid-img -->
                                        <div class="block-info h-grid-info">
                                            <h3 class="block-title">
                                                <a href="{{ route('hotel.details',encrypt($hotel->id)) }}">{{ $hotel->description }}</a>
                                            </h3>
                                            <p class="block-minor">
                                                @php
                                                    $nearbyAreas = is_string($hotel->custom_nearby_areas)
                                                        ? json_decode($hotel->custom_nearby_areas, true)
                                                        : $hotel->custom_nearby_areas;
                                                @endphp

                                                @if (!empty($nearbyAreas[0]))
                                                    {{ $nearbyAreas[0] }}
                                                @endif
                                            </p>
                                            <div class="review-main">
                                                <div class="review-cat-home">8.9</div>
                                                <div class="review-cat">Fabulous</div>
                                                <div class="review-cat spna">3,022 reviews</div>
                                            </div>
                                            <div class="main-mask">
                                                <ul class="list-unstyled list-inline offer-price-1">
                                                    <li class="list-inline-item price">5000 Tk. <span class="pkg">Night</span>
                                                    </li>
                                                    <li class="list-inline-item price">
                                                      <span class="pkg">
                                                        <del>2000 Tk.</del>
                                                      </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- end h-grid-info -->
                                    </div>
                                    <!-- end h-grid-block -->
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <h4>No hotels found</h4>
                                        <p class="text-muted">Please try adjusting your search criteria.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <!-- end row -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end Search Results -->

@endsection
