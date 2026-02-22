@extends('frontend.app')
@section('title','EZBOOKING')
@section('main')


    <!--========================= FLEX SLIDER =====================-->
    <section class="video-slider-home">
        <div class="video-slider">
            <div class="slider-wrapper">
                <div class="video-slide">
                    <video autoplay muted loop>
                        <source src="{{ asset($homepageHero->video_path ?? 'frontend/images/slider/hero-bg-cover.mp4') }}">
                    </video>
                </div>
            </div>
            <div class="slider-content">
                <h1>{!! $homepageHero->title ?? 'Welcome to <strong>Eg Kom!</strong>' !!}</h1>
                <p>{{ $homepageHero->subtitle ?? 'Find Hotels, Visa & Holidays' }}</p>
            </div>
        </div>
    </section>
    <!-- end flexslider-container -->



    <!--===== Start: Hotel All ====-->
    <div class="search-tabs-3" id="bottomStickyBar">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11 col-11">
                    <div class="row">
                        <ul class="nav nav-tabs owl-carousel owl-theme owl-custom-tabbing" id="owl-company-logo">

                            <li class="nav-item">
                                <a class="nav-link nav-custom active" href="#Hotel" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-building"></i>
                        </span>
                                    <span class=" d-md-inline-flex st-text">Hotel</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Transit" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Transit</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Resorts" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Resorts</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Lodges" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Lodges</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Guesthouses" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Guesthouses</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Crisis" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Crisis</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom" href="#Hotel" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-building"></i>
                        </span>
                                    <span class=" d-md-inline-flex st-text">Hotel</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Transit" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Transit</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Resorts" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Resorts</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Lodges" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Lodges</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Guesthouses" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Guesthouses</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Crisis" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Crisis</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-custom" href="#Hotel" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-building"></i>
                        </span>
                                    <span class=" d-md-inline-flex st-text">Hotel</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Transit" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Transit</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Resorts" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Resorts</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Lodges" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Lodges</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Guesthouses" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Guesthouses</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-custom " href="#Crisis" data-bs-toggle="tab">
                        <span>
                          <i class="fa fa-bed fa-bed-custom"></i>
                        </span>
                                    <span class="d-md-inline-flex st-text">Crisis</span>
                                </a>
                            </li>

                        </ul>

                    </div>

                    <!-- end tab-content -->
                </div>
                <!-- end columns -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end search-tabs -->

    <!-- tabing -->
    <section class="innerpage-wrapper">
        <div id="hotel-grid" class="innerpage-section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12 content-side">
                        <div class="tab-content">

                            <!-- Start:  Hotel -->
                            <div id="Hotel" class="tab-pane in active" data-category="Hotels">
                                <div class="row">
                                @php
                                    $hotelsData = isset($allCategoriesData['Hotels']) ? $allCategoriesData['Hotels'] : (isset($hotelsPaginated) && $category === 'Hotels' ? $hotelsPaginated : collect());
                                @endphp
                                @foreach($hotelsData as $hotel)
                                    <div class="col-md-6 col-lg-6 col-xl-3">
                                        <div class="grid-block main-block h-grid-block">
                                            <div class="main-img h-grid-img">
                                                <a href="{{ route('hotel.details',encrypt($hotel->id)) }}">
                                                    @php
                                                        $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                    @endphp

                                                        @if (!empty($featuredPhotos[0]))
                                                        <img style="height: 270px;width: 100%;" src="{{ asset($featuredPhotos[0]) }}" class="img-fluid" alt="{{ $hotel->description }}" onerror="this.src='https://via.placeholder.com/400x270?text=Hotel'" />
                                                    @else
                                                        <img style="height: 270px;width: 100%;" src="https://via.placeholder.com/400x270?text=Hotel" class="img-fluid" alt="{{ $hotel->description }}" />
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
                                                @php
                                                    $avgRating = $hotel->reviews_avg_overall_rating !== null ? round((float) $hotel->reviews_avg_overall_rating, 1) : null;
                                                    $reviewCount = (int) ($hotel->reviews_count ?? 0);
                                                    $sentiment = $avgRating >= 9 ? 'Exceptional' : ($avgRating >= 8 ? 'Fabulous' : ($avgRating >= 7 ? 'Very Good' : ($avgRating >= 6 ? 'Good' : ($avgRating >= 5 ? 'Average' : 'Rating'))));
                                                    $minPrice = $hotel->rooms_min_price_per_night ?? null;
                                                @endphp
                                                <div class="review-main">
                                                    <div class="review-cat-home">{{ $avgRating ?? '—' }}</div>
                                                    <div class="review-cat">{{ $avgRating !== null ? $sentiment : '—' }}</div>
                                                    <div class="review-cat spna">{{ $reviewCount > 0 ? number_format($reviewCount) . ' reviews' : 'No reviews' }}</div>
                                                </div>
                                                <div class="main-mask">
                                                    <ul class="list-unstyled list-inline offer-price-1">
                                                        <li class="list-inline-item price">@if($minPrice !== null){{ number_format((float) $minPrice) }} Tk.@else—@endif <span class="pkg">Night</span></li>
                                                        <li class="list-inline-item price"><span class="pkg"></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- end h-grid-info -->
                                        </div>
                                        <!-- end h-grid-block -->
                                    </div>
                                @endforeach
                                </div>
                                @if(isset($allCategoriesData['Hotels']) && $allCategoriesData['Hotels']->total() > 16)
                                <div class="pages">
                                    <ol class="pagination justify-content-center">
                                        <li>
                                            <a href="{{ $allCategoriesData['Hotels']->previousPageUrl() ? $allCategoriesData['Hotels']->previousPageUrl() . '&category=Hotels' : '#' }}" aria-label="Previous" class="{{ !$allCategoriesData['Hotels']->previousPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-left"></i>
                                                </span>
                                            </a>
                                        </li>
                                        @for($i = 1; $i <= $allCategoriesData['Hotels']->lastPage(); $i++)
                                        <li class="{{ $allCategoriesData['Hotels']->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $allCategoriesData['Hotels']->url($i) }}&category=Hotels">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        <li>
                                            <a href="{{ $allCategoriesData['Hotels']->nextPageUrl() ? $allCategoriesData['Hotels']->nextPageUrl() . '&category=Hotels' : '#' }}" aria-label="Next" class="{{ !$allCategoriesData['Hotels']->nextPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-right"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ol>
                                </div>
                                @endif
                            </div>
                            <!-- End:  Hotel -->

                            <div id="Transit" class="tab-pane">
                                <div class="row">

                                    @foreach($allCategoriesData['Transit'] as $hotel)
                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="grid-block main-block h-grid-block">
                                                <div class="main-img h-grid-img">
                                                    <a href="{{ route('hotel.details',encrypt($hotel->id)) }}">
                                                        @php
                                                            $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                        @endphp

                                                        @if (!empty($featuredPhotos[0]))
                                                            <img style="height: 270px;width: 100%;" src="{{ asset($featuredPhotos[0]) }}" class="img-fluid" alt="{{ $hotel->description }}" onerror="this.src='https://via.placeholder.com/400x270?text=Hotel'" />
                                                        @else
                                                            <img style="height: 270px;width: 100%;" src="https://via.placeholder.com/400x270?text=Hotel" class="img-fluid" alt="{{ $hotel->description }}" />
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
                                                    <!-- <p class="block-minor"> May 1 – 6</p> -->
                                                    @php
                                                        $avgRating = $hotel->reviews_avg_overall_rating !== null ? round((float) $hotel->reviews_avg_overall_rating, 1) : null;
                                                        $reviewCount = (int) ($hotel->reviews_count ?? 0);
                                                        $sentiment = $avgRating >= 9 ? 'Exceptional' : ($avgRating >= 8 ? 'Fabulous' : ($avgRating >= 7 ? 'Very Good' : ($avgRating >= 6 ? 'Good' : ($avgRating >= 5 ? 'Average' : 'Rating'))));
                                                        $minPrice = $hotel->rooms_min_price_per_night ?? null;
                                                    @endphp
                                                    <div class="review-main">
                                                        <div class="review-cat-home">{{ $avgRating ?? '—' }}</div>
                                                        <div class="review-cat">{{ $avgRating !== null ? $sentiment : '—' }}</div>
                                                        <div class="review-cat spna">{{ $reviewCount > 0 ? number_format($reviewCount) . ' reviews' : 'No reviews' }}</div>
                                                    </div>
                                                    <div class="main-mask">
                                                        <ul class="list-unstyled list-inline offer-price-1">
                                                            <li class="list-inline-item price">@if($minPrice !== null){{ number_format((float) $minPrice) }} Tk.@else—@endif <span class="pkg">Night</span></li>
                                                            <li class="list-inline-item price"><span class="pkg"></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- end h-grid-info -->
                                            </div>
                                            <!-- end h-grid-block -->
                                        </div>
                                    @endforeach

                                </div>
                                @if(isset($allCategoriesData['Transit']) && $allCategoriesData['Transit']->total() > 16)
                                <div class="pages">
                                    <ol class="pagination justify-content-center">
                                        <li>
                                            <a href="{{ $allCategoriesData['Transit']->previousPageUrl() ? $allCategoriesData['Transit']->previousPageUrl() . '&category=Transit' : '#' }}" aria-label="Previous" class="{{ !$allCategoriesData['Transit']->previousPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-left"></i>
                                                </span>
                                            </a>
                                        </li>
                                        @for($i = 1; $i <= $allCategoriesData['Transit']->lastPage(); $i++)
                                        <li class="{{ $allCategoriesData['Transit']->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $allCategoriesData['Transit']->url($i) }}&category=Transit">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        <li>
                                            <a href="{{ $allCategoriesData['Transit']->nextPageUrl() ? $allCategoriesData['Transit']->nextPageUrl() . '&category=Transit' : '#' }}" aria-label="Next" class="{{ !$allCategoriesData['Transit']->nextPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-right"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ol>
                                </div>
                                @endif
                            </div>
                            <div id="Resorts" class="tab-pane">
                                <div class="row">

                                    @foreach($allCategoriesData['Resorts'] as $hotel)
                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="grid-block main-block h-grid-block">
                                                <div class="main-img h-grid-img">
                                                    <a href="{{ route('hotel.details',encrypt($hotel->id)) }}">
                                                        @php
                                                            $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                        @endphp

                                                        @if (!empty($featuredPhotos[0]))
                                                            <img style="height: 270px;width: 100%;" src="{{ asset($featuredPhotos[0]) }}" class="img-fluid" alt="{{ $hotel->description }}" onerror="this.src='https://via.placeholder.com/400x270?text=Hotel'" />
                                                        @else
                                                            <img style="height: 270px;width: 100%;" src="https://via.placeholder.com/400x270?text=Hotel" class="img-fluid" alt="{{ $hotel->description }}" />
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
                                                    @php
                                                        $avgRating = $hotel->reviews_avg_overall_rating !== null ? round((float) $hotel->reviews_avg_overall_rating, 1) : null;
                                                        $reviewCount = (int) ($hotel->reviews_count ?? 0);
                                                        $sentiment = $avgRating >= 9 ? 'Exceptional' : ($avgRating >= 8 ? 'Fabulous' : ($avgRating >= 7 ? 'Very Good' : ($avgRating >= 6 ? 'Good' : ($avgRating >= 5 ? 'Average' : 'Rating'))));
                                                        $minPrice = $hotel->rooms_min_price_per_night ?? null;
                                                    @endphp
                                                    <div class="review-main">
                                                        <div class="review-cat-home">{{ $avgRating ?? '—' }}</div>
                                                        <div class="review-cat">{{ $avgRating !== null ? $sentiment : '—' }}</div>
                                                        <div class="review-cat spna">{{ $reviewCount > 0 ? number_format($reviewCount) . ' reviews' : 'No reviews' }}</div>
                                                    </div>
                                                    <div class="main-mask">
                                                        <ul class="list-unstyled list-inline offer-price-1">
                                                            <li class="list-inline-item price">@if($minPrice !== null){{ number_format((float) $minPrice) }} Tk.@else—@endif <span class="pkg">Night</span></li>
                                                            <li class="list-inline-item price"><span class="pkg"></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- end h-grid-info -->
                                            </div>
                                            <!-- end h-grid-block -->
                                        </div>
                                    @endforeach

                                </div>
                                @if(isset($allCategoriesData['Resorts']) && $allCategoriesData['Resorts']->total() > 16)
                                <div class="pages">
                                    <ol class="pagination justify-content-center">
                                        <li>
                                            <a href="{{ $allCategoriesData['Resorts']->previousPageUrl() ? $allCategoriesData['Resorts']->previousPageUrl() . '&category=Resorts' : '#' }}" aria-label="Previous" class="{{ !$allCategoriesData['Resorts']->previousPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-left"></i>
                                                </span>
                                            </a>
                                        </li>
                                        @for($i = 1; $i <= $allCategoriesData['Resorts']->lastPage(); $i++)
                                        <li class="{{ $allCategoriesData['Resorts']->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $allCategoriesData['Resorts']->url($i) }}&category=Resorts">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        <li>
                                            <a href="{{ $allCategoriesData['Resorts']->nextPageUrl() ? $allCategoriesData['Resorts']->nextPageUrl() . '&category=Resorts' : '#' }}" aria-label="Next" class="{{ !$allCategoriesData['Resorts']->nextPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-right"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ol>
                                </div>
                                @endif
                            </div>

                            <div id="Lodges" class="tab-pane">
                                <div class="row">

                                    @foreach($allCategoriesData['Lodges'] as $hotel)
                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="grid-block main-block h-grid-block">
                                                <div class="main-img h-grid-img">
                                                    <a href="{{ route('hotel.details',encrypt($hotel->id)) }}">
                                                        @php
                                                            $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                        @endphp

                                                        @if (!empty($featuredPhotos[0]))
                                                            <img style="height: 270px;width: 100%;" src="{{ asset($featuredPhotos[0]) }}" class="img-fluid" alt="{{ $hotel->description }}" onerror="this.src='https://via.placeholder.com/400x270?text=Hotel'" />
                                                        @else
                                                            <img style="height: 270px;width: 100%;" src="https://via.placeholder.com/400x270?text=Hotel" class="img-fluid" alt="{{ $hotel->description }}" />
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
                                                    <!-- <p class="block-minor"> May 1 – 6</p> -->
                                                    @php
                                                        $avgRating = $hotel->reviews_avg_overall_rating !== null ? round((float) $hotel->reviews_avg_overall_rating, 1) : null;
                                                        $reviewCount = (int) ($hotel->reviews_count ?? 0);
                                                        $sentiment = $avgRating >= 9 ? 'Exceptional' : ($avgRating >= 8 ? 'Fabulous' : ($avgRating >= 7 ? 'Very Good' : ($avgRating >= 6 ? 'Good' : ($avgRating >= 5 ? 'Average' : 'Rating'))));
                                                        $minPrice = $hotel->rooms_min_price_per_night ?? null;
                                                    @endphp
                                                    <div class="review-main">
                                                        <div class="review-cat-home">{{ $avgRating ?? '—' }}</div>
                                                        <div class="review-cat">{{ $avgRating !== null ? $sentiment : '—' }}</div>
                                                        <div class="review-cat spna">{{ $reviewCount > 0 ? number_format($reviewCount) . ' reviews' : 'No reviews' }}</div>
                                                    </div>
                                                    <div class="main-mask">
                                                        <ul class="list-unstyled list-inline offer-price-1">
                                                            <li class="list-inline-item price">@if($minPrice !== null){{ number_format((float) $minPrice) }} Tk.@else—@endif <span class="pkg">Night</span></li>
                                                            <li class="list-inline-item price"><span class="pkg"></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- end h-grid-info -->
                                            </div>
                                            <!-- end h-grid-block -->
                                        </div>
                                    @endforeach

                                </div>
                                @if(isset($allCategoriesData['Lodges']) && $allCategoriesData['Lodges']->total() > 16)
                                <div class="pages">
                                    <ol class="pagination justify-content-center">
                                        <li>
                                            <a href="{{ $allCategoriesData['Lodges']->previousPageUrl() ? $allCategoriesData['Lodges']->previousPageUrl() . '&category=Lodges' : '#' }}" aria-label="Previous" class="{{ !$allCategoriesData['Lodges']->previousPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-left"></i>
                                                </span>
                                            </a>
                                        </li>
                                        @for($i = 1; $i <= $allCategoriesData['Lodges']->lastPage(); $i++)
                                        <li class="{{ $allCategoriesData['Lodges']->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $allCategoriesData['Lodges']->url($i) }}&category=Lodges">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        <li>
                                            <a href="{{ $allCategoriesData['Lodges']->nextPageUrl() ? $allCategoriesData['Lodges']->nextPageUrl() . '&category=Lodges' : '#' }}" aria-label="Next" class="{{ !$allCategoriesData['Lodges']->nextPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-right"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ol>
                                </div>
                                @endif
                            </div>

                            <div id="Guesthouses" class="tab-pane">
                                <div class="row">

                                    @foreach($allCategoriesData['Guesthouses'] as $hotel)
                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="grid-block main-block h-grid-block">
                                                <div class="main-img h-grid-img">
                                                    <a href="{{ route('hotel.details',encrypt($hotel->id)) }}">
                                                        @php
                                                            $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                        @endphp

                                                        @if (!empty($featuredPhotos[0]))
                                                            <img style="height: 270px;width: 100%;" src="{{ asset($featuredPhotos[0]) }}" class="img-fluid" alt="{{ $hotel->description }}" onerror="this.src='https://via.placeholder.com/400x270?text=Hotel'" />
                                                        @else
                                                            <img style="height: 270px;width: 100%;" src="https://via.placeholder.com/400x270?text=Hotel" class="img-fluid" alt="{{ $hotel->description }}" />
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
                                                    <!-- <p class="block-minor"> May 1 – 6</p> -->
                                                    @php
                                                        $avgRating = $hotel->reviews_avg_overall_rating !== null ? round((float) $hotel->reviews_avg_overall_rating, 1) : null;
                                                        $reviewCount = (int) ($hotel->reviews_count ?? 0);
                                                        $sentiment = $avgRating >= 9 ? 'Exceptional' : ($avgRating >= 8 ? 'Fabulous' : ($avgRating >= 7 ? 'Very Good' : ($avgRating >= 6 ? 'Good' : ($avgRating >= 5 ? 'Average' : 'Rating'))));
                                                        $minPrice = $hotel->rooms_min_price_per_night ?? null;
                                                    @endphp
                                                    <div class="review-main">
                                                        <div class="review-cat-home">{{ $avgRating ?? '—' }}</div>
                                                        <div class="review-cat">{{ $avgRating !== null ? $sentiment : '—' }}</div>
                                                        <div class="review-cat spna">{{ $reviewCount > 0 ? number_format($reviewCount) . ' reviews' : 'No reviews' }}</div>
                                                    </div>
                                                    <div class="main-mask">
                                                        <ul class="list-unstyled list-inline offer-price-1">
                                                            <li class="list-inline-item price">@if($minPrice !== null){{ number_format((float) $minPrice) }} Tk.@else—@endif <span class="pkg">Night</span></li>
                                                            <li class="list-inline-item price"><span class="pkg"></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- end h-grid-info -->
                                            </div>
                                            <!-- end h-grid-block -->
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                            <div id="Crisis" class="tab-pane">
                                <div class="row">
                                    @foreach($allCategoriesData['Crisis'] as $hotel)
                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="grid-block main-block h-grid-block">
                                                <div class="main-img h-grid-img">
                                                    <a href="{{ route('hotel.details',encrypt($hotel->id)) }}">
                                                        @php
                                                            $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                        @endphp

                                                        @if (!empty($featuredPhotos[0]))
                                                            <img style="height: 270px;width: 100%;" src="{{ asset($featuredPhotos[0]) }}" class="img-fluid" alt="{{ $hotel->description }}" onerror="this.src='https://via.placeholder.com/400x270?text=Hotel'" />
                                                        @else
                                                            <img style="height: 270px;width: 100%;" src="https://via.placeholder.com/400x270?text=Hotel" class="img-fluid" alt="{{ $hotel->description }}" />
                                                        @endif
                                                    </a>
                                                    <div class="guest-favourite">
                                                        <h3>Guest favourite</h3>
                                                    </div>
                                                    <div class="wishlist-heart-icon hotel-wishlist-icon" 
                                                         data-hotel-id="{{ $hotel->id }}"
                                                         onclick="toggleHotelWishlist({{ $hotel->id }})">
                                                        <i class="fa fa-heart-o"></i>
                                                    </div>
                                                </div>
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
                                                    @php
                                                        $avgRating = $hotel->reviews_avg_overall_rating !== null ? round((float) $hotel->reviews_avg_overall_rating, 1) : null;
                                                        $reviewCount = (int) ($hotel->reviews_count ?? 0);
                                                        $sentiment = $avgRating >= 9 ? 'Exceptional' : ($avgRating >= 8 ? 'Fabulous' : ($avgRating >= 7 ? 'Very Good' : ($avgRating >= 6 ? 'Good' : ($avgRating >= 5 ? 'Average' : 'Rating'))));
                                                        $minPrice = $hotel->rooms_min_price_per_night ?? null;
                                                    @endphp
                                                    <div class="review-main">
                                                        <div class="review-cat-home">{{ $avgRating ?? '—' }}</div>
                                                        <div class="review-cat">{{ $avgRating !== null ? $sentiment : '—' }}</div>
                                                        <div class="review-cat spna">{{ $reviewCount > 0 ? number_format($reviewCount) . ' reviews' : 'No reviews' }}</div>
                                                    </div>
                                                    <div class="main-mask">
                                                        <ul class="list-unstyled list-inline offer-price-1">
                                                            <li class="list-inline-item price">@if($minPrice !== null){{ number_format((float) $minPrice) }} Tk.@else—@endif <span class="pkg">Night</span></li>
                                                            <li class="list-inline-item price"><span class="pkg"></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if(isset($allCategoriesData['Crisis']) && $allCategoriesData['Crisis']->total() > 16)
                                <div class="pages">
                                    <ol class="pagination justify-content-center">
                                        <li>
                                            <a href="{{ $allCategoriesData['Crisis']->previousPageUrl() ? $allCategoriesData['Crisis']->previousPageUrl() . '&category=Crisis' : '#' }}" aria-label="Previous" class="{{ !$allCategoriesData['Crisis']->previousPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-left"></i>
                                                </span>
                                            </a>
                                        </li>
                                        @for($i = 1; $i <= $allCategoriesData['Crisis']->lastPage(); $i++)
                                        <li class="{{ $allCategoriesData['Crisis']->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $allCategoriesData['Crisis']->url($i) }}&category=Crisis">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        <li>
                                            <a href="{{ $allCategoriesData['Crisis']->nextPageUrl() ? $allCategoriesData['Crisis']->nextPageUrl() . '&category=Crisis' : '#' }}" aria-label="Next" class="{{ !$allCategoriesData['Crisis']->nextPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-right"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ol>
                                </div>
                                @endif
                            </div>
                            
                            <div id="Crisis" class="tab-pane">
                                <div class="row">
                                    @foreach($allCategoriesData['Crisis'] as $hotel)
                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="grid-block main-block h-grid-block">
                                                <div class="main-img h-grid-img">
                                                    <a href="{{ route('hotel.details',encrypt($hotel->id)) }}">
                                                        @php
                                                            $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                        @endphp

                                                        @if (!empty($featuredPhotos[0]))
                                                            <img style="height: 270px;width: 100%;" src="{{ asset($featuredPhotos[0]) }}" class="img-fluid" alt="{{ $hotel->description }}" onerror="this.src='https://via.placeholder.com/400x270?text=Hotel'" />
                                                        @else
                                                            <img style="height: 270px;width: 100%;" src="https://via.placeholder.com/400x270?text=Hotel" class="img-fluid" alt="{{ $hotel->description }}" />
                                                        @endif
                                                    </a>
                                                    <div class="guest-favourite">
                                                        <h3>Guest favourite</h3>
                                                    </div>
                                                    <div class="wishlist-heart-icon hotel-wishlist-icon" 
                                                         data-hotel-id="{{ $hotel->id }}"
                                                         onclick="toggleHotelWishlist({{ $hotel->id }})">
                                                        <i class="fa fa-heart-o"></i>
                                                    </div>
                                                </div>
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
                                                    @php
                                                        $avgRating = $hotel->reviews_avg_overall_rating !== null ? round((float) $hotel->reviews_avg_overall_rating, 1) : null;
                                                        $reviewCount = (int) ($hotel->reviews_count ?? 0);
                                                        $sentiment = $avgRating >= 9 ? 'Exceptional' : ($avgRating >= 8 ? 'Fabulous' : ($avgRating >= 7 ? 'Very Good' : ($avgRating >= 6 ? 'Good' : ($avgRating >= 5 ? 'Average' : 'Rating'))));
                                                        $minPrice = $hotel->rooms_min_price_per_night ?? null;
                                                    @endphp
                                                    <div class="review-main">
                                                        <div class="review-cat-home">{{ $avgRating ?? '—' }}</div>
                                                        <div class="review-cat">{{ $avgRating !== null ? $sentiment : '—' }}</div>
                                                        <div class="review-cat spna">{{ $reviewCount > 0 ? number_format($reviewCount) . ' reviews' : 'No reviews' }}</div>
                                                    </div>
                                                    <div class="main-mask">
                                                        <ul class="list-unstyled list-inline offer-price-1">
                                                            <li class="list-inline-item price">@if($minPrice !== null){{ number_format((float) $minPrice) }} Tk.@else—@endif <span class="pkg">Night</span></li>
                                                            <li class="list-inline-item price"><span class="pkg"></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if(isset($allCategoriesData['Crisis']) && $allCategoriesData['Crisis']->total() > 16)
                                <div class="pages">
                                    <ol class="pagination justify-content-center">
                                        <li>
                                            <a href="{{ $allCategoriesData['Crisis']->previousPageUrl() ? $allCategoriesData['Crisis']->previousPageUrl() . '&category=Crisis' : '#' }}" aria-label="Previous" class="{{ !$allCategoriesData['Crisis']->previousPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-left"></i>
                                                </span>
                                            </a>
                                        </li>
                                        @for($i = 1; $i <= $allCategoriesData['Crisis']->lastPage(); $i++)
                                        <li class="{{ $allCategoriesData['Crisis']->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $allCategoriesData['Crisis']->url($i) }}&category=Crisis">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        <li>
                                            <a href="{{ $allCategoriesData['Crisis']->nextPageUrl() ? $allCategoriesData['Crisis']->nextPageUrl() . '&category=Crisis' : '#' }}" aria-label="Next" class="{{ !$allCategoriesData['Crisis']->nextPageUrl() ? 'disabled' : '' }}">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-angle-right"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ol>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- end Hotel All -->



    <!--=============== Most Popular Destinations===============-->
    <section id="hotel-offers" class="section-padding" style="background-color: #F5F7FA;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-heading-2" style=" margin-bottom: 40px; text-align: center;">
                        <h2>Most Popular Destinations</h2>
                        <p>Explore our handpicked collection of the most popular destinations with amazing hotels and accommodations waiting for you.</p>
                    </div>
                    <!-- end page-heading -->
                    @if($popularDestinations->count() > 0)
                    <article>
                        <section class="sectionWrapper">
                            <section class="swiper">
                                <div class="parallax-bg" data-swiper-parallax="600" data-swiper-parallax-scale="0.85"></div>
                                <div class="swiper-wrapper">
                                    @foreach($popularDestinations as $destination)
                                    <figure class="swiper-slide">
                                        <div class="explore-card-main">
                                            <a href="{{ route('destination.show', $destination->slug) }}">
                                                <div class="explore-card mui-style-lxguk4">
                                                    @if($destination->media_type == 'video' && $destination->feature_video)
                                                        @php
                                                            // Extract YouTube video ID from URL
                                                            $videoUrl = $destination->feature_video;
                                                            $videoId = '';
                                                            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/', $videoUrl, $matches)) {
                                                                $videoId = $matches[1];
                                                            }
                                                        @endphp
                                                        @if($videoId)
                                                            <div class="st-image-card__img" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&mute=1&loop=1&playlist={{ $videoId }}" 
                                                                        frameborder="0" 
                                                                        allow="autoplay; encrypted-media" 
                                                                        allowfullscreen
                                                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                                            </div>
                                                        @else
                                                            <video class="st-image-card__img" autoplay muted loop>
                                                                <source src="{{ $destination->feature_video }}" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    @elseif($destination->feature_photo)
                                                        <img class="st-image-card__img" src="{{ asset($destination->feature_photo) }}" alt="{{ $destination->name }}">
                                                    @else
                                                        <img class="st-image-card__img" src="{{ asset('frontend')}}/images/destination-1.jpg" alt="{{ $destination->name }}">
                                                    @endif
                                                    <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                                    <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">{{ $destination->name }}</p>
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-1mmzlec">{{ $destination->hotels_count }} {{ $destination->hotels_count == 1 ? 'Hotel' : 'Hotels' }} Available</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </figure>
                                    @endforeach
                                </div>
                            </section>
                        </section>
                    </article>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('destinations.index') }}" class="btn btn-primary" style="padding: 12px 30px; font-size: 16px; border-radius: 5px;">
                            View All Destinations
                        </a>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <p>No popular destinations available at the moment.</p>
                    </div>
                    @endif
                </div>
                <!-- end columns -->
            </div>
            <!-- end row -->
        </div>
    </section>
    <!--===============End: Most Popular Destinations===============-->

    <!-- Addvertise -->
    <section class="advertisement">
        <div class="container">
            <div class="row">
               @foreach(\App\Models\BigAdvertise::all() as $big)
                <div class="col-xl-12 col-12">
                    <div class="card-add-home" style="background: url({{ asset('uploads')}}/bigadvertise/{{ $big->image }}) no-repeat center;">
                        <h2 class="project-title">{{ $big->title }}</h2>

                    </div>
                </div>
                @endforeach
                   @foreach(\App\Models\SmallAdvertise::all() as $small)
                <div class="col-xl-4 col-12">
                    <div class="card-add-home" style="background: url({{ asset('uploads')}}/smalladvertise/{{ $small->image }}) no-repeat center;">
                        <h2 class="project-title">{{ $small->title }}</h2>
                        <!-- <h3 class="project-subtitle"><a href="https://booking.ezbooking.com/hotel-room-details.html#review"> View More</a></h3> -->
                    </div>
                </div>
                   @endforeach

            </div>
        </div>
    </section>
    <!-- Addvertise -->
    <!--=============== Best Hotels for Your Next Trip===============-->
    <section id="tourOffers">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="destiation-info-home">
                        <h2>Best Tour Packages</h2>
                        <div class="explore-title-pera">
                            <p class="short-pera">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim .</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-tour-offers">
                        @forelse($tourPackages as $pkg)
                        <div class="item">
                            <div class="explore-card-main mb-20">
                                <a href="{{ route('tour-package.show', $pkg->slug) }}">
                                    <div class="explore-card mui-style-lxguk4">
                                        <img class="st-image-card__img" src="{{ $pkg->image ? asset($pkg->image) : 'https://via.placeholder.com/384x256?text=Tour+Package' }}" alt="{{ $pkg->title }}">
                                        <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                        <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                            <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">{{ $pkg->title }}</p>
                                            <div class="stpromo-card__rating_container MuiBox-root mui-style-dun6p3">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.562 21.5606C17.3999 21.5602 17.2403 21.5204 17.097 21.4446L12 18.7646L6.90301 21.4446C6.73797 21.5311 6.55206 21.5697 6.36624 21.5562C6.18042 21.5426 6.00208 21.4775 5.85132 21.368C5.70057 21.2585 5.5834 21.1091 5.51302 20.9366C5.44264 20.7641 5.42186 20.5753 5.45301 20.3916L6.42601 14.7156L2.30201 10.6956C2.1686 10.5654 2.07426 10.4004 2.02965 10.2194C1.98504 10.0383 1.99194 9.84842 2.04956 9.67109C2.10717 9.49377 2.21322 9.33608 2.35573 9.21584C2.49823 9.0956 2.67151 9.01759 2.85601 8.99063L8.55501 8.16263L11.104 2.99863C11.1958 2.84247 11.3269 2.713 11.4841 2.62305C11.6413 2.5331 11.8194 2.48578 12.0005 2.48578C12.1817 2.48578 12.3597 2.5331 12.5169 2.62305C12.6742 2.713 12.8052 2.84247 12.897 2.99863L15.445 8.16263L21.144 8.99063C21.3285 9.01759 21.5018 9.0956 21.6443 9.21584C21.7868 9.33608 21.8928 9.49377 21.9505 9.67109C22.0081 9.84842 22.015 10.0383 21.9704 10.2194C21.9258 10.4004 21.8314 10.5654 21.698 10.6956L17.574 14.7156L18.548 20.3916C18.5726 20.5351 18.5656 20.6822 18.5274 20.8227C18.4893 20.9632 18.4209 21.0937 18.3271 21.205C18.2333 21.3163 18.1163 21.4058 17.9844 21.4672C17.8524 21.5287 17.7086 21.5605 17.563 21.5606H17.562Z" fill="#F27D00"></path>
                                                </svg>
                                                <p class="ratinmg-number" fw="bold">{{ number_format($pkg->rating, 1) }}</p>
                                                <p class="MuiTypography-root MuiTypography-body1 mui-style-1h22dky">({{ $pkg->review_count }} reviews)</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="item">
                            <div class="explore-card-main mb-20">
                                <p class="text-muted text-center py-4">No tour packages added yet.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <!-- end owl-hotel-offers -->
                </div>
                <!-- end columns -->
            </div>
            <!-- end row -->
        </div>
    </section>
    <!--===============End: Best Hotels for Your Next Trip===============-->
    <!-- Destination -->
    <section class="destination" style="background-color: #F5F7FA;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="destiation-info-home ">
                        <h2 class="text-center destination-title">Destinations we love</h2>
                        <div class="detail-tabs detail-tabs-home  ">
                            <ul class="nav nav-tabs nav-destination" style="border:none">
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom active" href="#hotel-overview" data-bs-toggle="tab">District</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom" href="#restaurant" data-bs-toggle="tab">Cities</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="hotel-overview" class="tab-pane tab-pane-custom in active">
                                    <div class="destination-list">
                                        <ul>
                                            @forelse($districts as $district)
                                                <li class="des-list">
                                                    <a href="{{ route('destination.show', \Illuminate\Support\Str::slug($district->district)) }}">{{ $district->district }}</a>
                                                    <span class="count-pro">{{ number_format($district->properties_count) }} {{ $district->properties_count == 1 ? 'property' : 'properties' }}</span>
                                                </li>
                                            @empty
                                                <li class="des-list">
                                                    <span>No districts available</span>
                                                </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                                <!-- end hotel-overview -->
                                <div id="restaurant" class="tab-pane tab-pane-custom">
                                    <div class="destination-list">
                                        <ul>
                                            @forelse($cities as $city)
                                                <li class="des-list">
                                                    <a href="{{ route('destination.show', \Illuminate\Support\Str::slug($city->city)) }}">{{ $city->city }}</a>
                                                    <span class="count-pro">{{ number_format($city->properties_count) }} {{ $city->properties_count == 1 ? 'property' : 'properties' }}</span>
                                                </li>
                                            @empty
                                                <li class="des-list">
                                                    <span>No cities available</span>
                                                </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                                <!-- end restaurant -->
                            </div>
                            <!-- end tab-content -->
                        </div>
                        <!-- end detail-tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Destination -->




<style>
    /* Hotel Wishlist Heart Icon Styles */
    .wishlist-heart-icon {
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
    
    .wishlist-heart-icon:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    }
    
    .wishlist-heart-icon i {
        font-size: 20px;
        color: #90278e;
        transition: all 0.3s ease;
    }
    
    .wishlist-heart-icon.active i,
    .wishlist-heart-icon.wishlisted i {
        color: #e91e63;
    }
    
    .wishlist-heart-icon.active i:before,
    .wishlist-heart-icon.wishlisted i:before {
        content: "\f004"; /* Font Awesome filled heart */
    }
    
    .h-grid-img {
        position: relative;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Hotel Wishlist Functions
    function toggleHotelWishlist(hotelId) {
        fetch('{{ route("hotel.wishlist.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ hotel_id: hotelId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.action === 'login_required') {
                Swal.fire({
                    icon: 'info',
                    title: 'Login Required',
                    text: 'Please login to add hotels to your wishlist',
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
            
            const heartIcon = document.querySelector(`.hotel-wishlist-icon[data-hotel-id="${hotelId}"]`);
            if (heartIcon) {
                if (data.is_wishlisted) {
                    heartIcon.classList.add('active', 'wishlisted');
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Wishlist!',
                        text: data.message,
                        confirmButtonColor: '#91278f',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    heartIcon.classList.remove('active', 'wishlisted');
                    Swal.fire({
                        icon: 'info',
                        title: 'Removed from Wishlist',
                        text: data.message,
                        confirmButtonColor: '#91278f',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
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
    
    // Check hotel wishlist status on page load
    function checkHotelWishlistStatus() {
        const heartIcons = document.querySelectorAll('.hotel-wishlist-icon');
        heartIcons.forEach(icon => {
            const hotelId = icon.getAttribute('data-hotel-id');
            fetch(`{{ route("hotel.wishlist.check") }}?hotel_id=${hotelId}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.is_wishlisted) {
                    icon.classList.add('active', 'wishlisted');
                }
            })
            .catch(error => {
                console.error('Error checking hotel wishlist:', error);
            });
        });
    }
    
    // Check wishlist status when page loads
    document.addEventListener('DOMContentLoaded', function() {
        checkHotelWishlistStatus();
    });
</script>

@endsection
