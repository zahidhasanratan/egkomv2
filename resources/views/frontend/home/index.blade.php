@extends('frontend.app')
@section('title','EGKom')
@section('main')


    <!--========================= FLEX SLIDER =====================-->
    <section class="video-slider-home">
        <div class="video-slider">
            <div class="slider-wrapper">
                <div class="video-slide">
                    <video autoplay muted loop>
                        <source src="{{ asset('frontend')}}/images/slider/hero-bg-cover.mp4">
                    </video>
                </div>
            </div>
            <div class="slider-content">
                <h1>Welcome to <strong>Eg Kom!</strong>
                </h1>
                <p>Find Hotels, Visa & Holidays </p>
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
                            <div id="Hotel" class="tab-pane in active">
                                <div class="row">
                                @foreach(\App\Models\Hotel:: where('property_type','Hotels')->get() as $hotel)
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
                                @endforeach
                                </div>
                            </div>
                            <!-- End:  Hotel -->

                            <div id="Transit" class="tab-pane">
                                <div class="row">

                                    @foreach(\App\Models\Hotel:: where('property_type','Transit')->get() as $hotel)
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
                                    @endforeach

                                </div>
                            </div>
                            <div id="Resorts" class="tab-pane">
                                <div class="row">

                                    @foreach(\App\Models\Hotel:: where('property_type','Resorts')->get() as $hotel)
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
                                    @endforeach

                                </div>
                            </div>

                            <div id="Lodges" class="tab-pane">
                                <div class="row">

                                    @foreach(\App\Models\Hotel:: where('property_type','Lodges')->get() as $hotel)
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
                                    @endforeach

                                </div>
                            </div>

                            <div id="Guesthouses" class="tab-pane">
                                <div class="row">

                                    @foreach(\App\Models\Hotel:: where('property_type','Guesthouses')->get() as $hotel)
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
                                    @endforeach


                                </div>
                            </div>
                            <div id="Crisis" class="tab-pane">
                                <div class="row">

                                    @foreach(\App\Models\Hotel:: where('property_type','Crisis')->get() as $hotel)
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
                                    @endforeach


                                </div>
                            </div>
                            <!-- end row -->
                            <div class="pages">
                                <ol class="pagination justify-content-center">
                                    <li>
                                        <a href="#" aria-label="Previous">
                        <span aria-hidden="true">
                          <i class="fa fa-angle-left"></i>
                        </span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="#">1</a>
                                    </li>
                                    <li>
                                        <a href="#">2</a>
                                    </li>
                                    <li>
                                        <a href="#">3</a>
                                    </li>
                                    <li>
                                        <a href="#">4</a>
                                    </li>
                                    <li>
                                        <a href="#" aria-label="Next">
                        <span aria-hidden="true">
                          <i class="fa fa-angle-right"></i>
                        </span>
                                        </a>
                                    </li>
                                </ol>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                    <!-- end page-heading -->
                    <article>
                        <section class="sectionWrapper">
                            <section class="swiper">
                                <div class="parallax-bg" data-swiper-parallax="600" data-swiper-parallax-scale="0.85"></div>
                                <div class="swiper-wrapper">
                                    <figure class="swiper-slide">
                                        <div class="explore-card-main">
                                            <a href="hotel-category-search.html">
                                                <div class="explore-card mui-style-lxguk4">
                                                    <img class="st-image-card__img" src="{{ asset('frontend')}}/images/destination-1.jpg">
                                                    <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                                    <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Dubai</p>
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-1mmzlec">97 Hotels Available</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </figure>
                                    <!-- Video Card -->
                                    <figure class="swiper-slide">
                                        <div class="explore-card-main">
                                            <a href="hotel-category-search.html">
                                                <div class="explore-card mui-style-lxguk4">
                                                    <!-- Embed video here, with the video taking the same space as the image -->
                                                    <video class="st-image-card__img" autoplay muted loop>
                                                        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4"> Your browser does not support the video tag.
                                                    </video>
                                                    <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                                    <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Australia</p>
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-1mmzlec">97 Hotels Available</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </figure>
                                    <figure class="swiper-slide">
                                        <div class="explore-card-main">
                                            <a href="hotel-category-search.html">
                                                <div class="explore-card mui-style-lxguk4">
                                                    <img class="st-image-card__img" src="{{ asset('frontend')}}/images/destination-3.jpg">
                                                    <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                                    <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Nepal</p>
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-1mmzlec">97 Hotels Available</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </figure>
                                    <figure class="swiper-slide">
                                        <div class="explore-card-main">
                                            <a href="hotel-category-search.html">
                                                <div class="explore-card mui-style-lxguk4">
                                                    <img class="st-image-card__img" src="{{ asset('frontend')}}/images/destination-4.jpg">
                                                    <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                                    <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">India</p>
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-1mmzlec">97 Hotels Available</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </figure>
                                    <figure class="swiper-slide">
                                        <div class="explore-card-main">
                                            <a href="hotel-category-search.html">
                                                <div class="explore-card mui-style-lxguk4">
                                                    <img class="st-image-card__img" src="{{ asset('frontend')}}/images/destination-3.jpg">
                                                    <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                                    <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Canada</p>
                                                        <p class="MuiTypography-root MuiTypography-body1 mui-style-1mmzlec">97 Hotels Available</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </figure>
                                </div>
                            </section>
                        </section>
                    </article>
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
                        <!-- <h3 class="project-subtitle"><a href="https://booking.egkom.com/hotel-room-details.html#review"> View More</a></h3> -->
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
                        <div class="item">
                            <div class="explore-card-main mb-20">
                                <a href="tour-package-details.html">
                                    <div class="explore-card mui-style-lxguk4">
                                        <img class="st-image-card__img" src="https://sharetrip.net/_next/image?url=https%3A%2F%2Ftbbd-flight.s3.ap-southeast-1.amazonaws.com%2Fpromotion%2Fsayeman_-1.PNG&w=384&q=75">
                                        <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                        <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                            <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Sayeman Beach Resort</p>
                                            <div class="stpromo-card__rating_container MuiBox-root mui-style-dun6p3">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.562 21.5606C17.3999 21.5602 17.2403 21.5204 17.097 21.4446L12 18.7646L6.90301 21.4446C6.73797 21.5311 6.55206 21.5697 6.36624 21.5562C6.18042 21.5426 6.00208 21.4775 5.85132 21.368C5.70057 21.2585 5.5834 21.1091 5.51302 20.9366C5.44264 20.7641 5.42186 20.5753 5.45301 20.3916L6.42601 14.7156L2.30201 10.6956C2.1686 10.5654 2.07426 10.4004 2.02965 10.2194C1.98504 10.0383 1.99194 9.84842 2.04956 9.67109C2.10717 9.49377 2.21322 9.33608 2.35573 9.21584C2.49823 9.0956 2.67151 9.01759 2.85601 8.99063L8.55501 8.16263L11.104 2.99863C11.1958 2.84247 11.3269 2.713 11.4841 2.62305C11.6413 2.5331 11.8194 2.48578 12.0005 2.48578C12.1817 2.48578 12.3597 2.5331 12.5169 2.62305C12.6742 2.713 12.8052 2.84247 12.897 2.99863L15.445 8.16263L21.144 8.99063C21.3285 9.01759 21.5018 9.0956 21.6443 9.21584C21.7868 9.33608 21.8928 9.49377 21.9505 9.67109C22.0081 9.84842 22.015 10.0383 21.9704 10.2194C21.9258 10.4004 21.8314 10.5654 21.698 10.6956L17.574 14.7156L18.548 20.3916C18.5726 20.5351 18.5656 20.6822 18.5274 20.8227C18.4893 20.9632 18.4209 21.0937 18.3271 21.205C18.2333 21.3163 18.1163 21.4058 17.9844 21.4672C17.8524 21.5287 17.7086 21.5605 17.563 21.5606H17.562Z" fill="#F27D00"></path>
                                                </svg>
                                                <p class="ratinmg-number" fw="bold">5</p>
                                                <p class="MuiTypography-root MuiTypography-body1 mui-style-1h22dky">(288 reviews)</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="explore-card-main mb-20">
                                <a href="tour-package-details.html">
                                    <div class="explore-card mui-style-lxguk4">
                                        <img class="st-image-card__img" src="https://sharetrip.net/_next/image?url=https%3A%2F%2Ftbbd-flight.s3.ap-southeast-1.amazonaws.com%2Fpromotion%2Fbest-western-plus-heritage.jpg&w=384&q=75">
                                        <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                        <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                            <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Best Western Heritage</p>
                                            <div class="stpromo-card__rating_container MuiBox-root mui-style-dun6p3">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.562 21.5606C17.3999 21.5602 17.2403 21.5204 17.097 21.4446L12 18.7646L6.90301 21.4446C6.73797 21.5311 6.55206 21.5697 6.36624 21.5562C6.18042 21.5426 6.00208 21.4775 5.85132 21.368C5.70057 21.2585 5.5834 21.1091 5.51302 20.9366C5.44264 20.7641 5.42186 20.5753 5.45301 20.3916L6.42601 14.7156L2.30201 10.6956C2.1686 10.5654 2.07426 10.4004 2.02965 10.2194C1.98504 10.0383 1.99194 9.84842 2.04956 9.67109C2.10717 9.49377 2.21322 9.33608 2.35573 9.21584C2.49823 9.0956 2.67151 9.01759 2.85601 8.99063L8.55501 8.16263L11.104 2.99863C11.1958 2.84247 11.3269 2.713 11.4841 2.62305C11.6413 2.5331 11.8194 2.48578 12.0005 2.48578C12.1817 2.48578 12.3597 2.5331 12.5169 2.62305C12.6742 2.713 12.8052 2.84247 12.897 2.99863L15.445 8.16263L21.144 8.99063C21.3285 9.01759 21.5018 9.0956 21.6443 9.21584C21.7868 9.33608 21.8928 9.49377 21.9505 9.67109C22.0081 9.84842 22.015 10.0383 21.9704 10.2194C21.9258 10.4004 21.8314 10.5654 21.698 10.6956L17.574 14.7156L18.548 20.3916C18.5726 20.5351 18.5656 20.6822 18.5274 20.8227C18.4893 20.9632 18.4209 21.0937 18.3271 21.205C18.2333 21.3163 18.1163 21.4058 17.9844 21.4672C17.8524 21.5287 17.7086 21.5605 17.563 21.5606H17.562Z" fill="#F27D00"></path>
                                                </svg>
                                                <p class="ratinmg-number" fw="bold">5</p>
                                                <p class="MuiTypography-root MuiTypography-body1 mui-style-1h22dky">(288 reviews)</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="explore-card-main mb-20">
                                <a href="#">
                                    <div class="explore-card mui-style-lxguk4">
                                        <img class="st-image-card__img" src="https://sharetrip.net/_next/image?url=https%3A%2F%2Ftbbd-flight.s3.ap-southeast-1.amazonaws.com%2Fpromotion%2Fagoda-2564409-60592569-839740.jpg&w=384&q=75">
                                        <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                        <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                            <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Sea Pearl Beach Resort..</p>
                                            <div class="stpromo-card__rating_container MuiBox-root mui-style-dun6p3">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.562 21.5606C17.3999 21.5602 17.2403 21.5204 17.097 21.4446L12 18.7646L6.90301 21.4446C6.73797 21.5311 6.55206 21.5697 6.36624 21.5562C6.18042 21.5426 6.00208 21.4775 5.85132 21.368C5.70057 21.2585 5.5834 21.1091 5.51302 20.9366C5.44264 20.7641 5.42186 20.5753 5.45301 20.3916L6.42601 14.7156L2.30201 10.6956C2.1686 10.5654 2.07426 10.4004 2.02965 10.2194C1.98504 10.0383 1.99194 9.84842 2.04956 9.67109C2.10717 9.49377 2.21322 9.33608 2.35573 9.21584C2.49823 9.0956 2.67151 9.01759 2.85601 8.99063L8.55501 8.16263L11.104 2.99863C11.1958 2.84247 11.3269 2.713 11.4841 2.62305C11.6413 2.5331 11.8194 2.48578 12.0005 2.48578C12.1817 2.48578 12.3597 2.5331 12.5169 2.62305C12.6742 2.713 12.8052 2.84247 12.897 2.99863L15.445 8.16263L21.144 8.99063C21.3285 9.01759 21.5018 9.0956 21.6443 9.21584C21.7868 9.33608 21.8928 9.49377 21.9505 9.67109C22.0081 9.84842 22.015 10.0383 21.9704 10.2194C21.9258 10.4004 21.8314 10.5654 21.698 10.6956L17.574 14.7156L18.548 20.3916C18.5726 20.5351 18.5656 20.6822 18.5274 20.8227C18.4893 20.9632 18.4209 21.0937 18.3271 21.205C18.2333 21.3163 18.1163 21.4058 17.9844 21.4672C17.8524 21.5287 17.7086 21.5605 17.563 21.5606H17.562Z" fill="#F27D00"></path>
                                                </svg>
                                                <p class="ratinmg-number" fw="bold">5</p>
                                                <p class="MuiTypography-root MuiTypography-body1 mui-style-1h22dky">(288 reviews)</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="explore-card-main mb-20">
                                <a href="#">
                                    <div class="explore-card mui-style-lxguk4">
                                        <img class="st-image-card__img" src="https://sharetrip.net/_next/image?url=https%3A%2F%2Ftbbd-flight.s3.ap-southeast-1.amazonaws.com%2Fpromotion%2Fsayeman_-1.PNG&w=384&q=75">
                                        <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                        <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                            <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Sayeman Beach Resort</p>
                                            <div class="stpromo-card__rating_container MuiBox-root mui-style-dun6p3">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.562 21.5606C17.3999 21.5602 17.2403 21.5204 17.097 21.4446L12 18.7646L6.90301 21.4446C6.73797 21.5311 6.55206 21.5697 6.36624 21.5562C6.18042 21.5426 6.00208 21.4775 5.85132 21.368C5.70057 21.2585 5.5834 21.1091 5.51302 20.9366C5.44264 20.7641 5.42186 20.5753 5.45301 20.3916L6.42601 14.7156L2.30201 10.6956C2.1686 10.5654 2.07426 10.4004 2.02965 10.2194C1.98504 10.0383 1.99194 9.84842 2.04956 9.67109C2.10717 9.49377 2.21322 9.33608 2.35573 9.21584C2.49823 9.0956 2.67151 9.01759 2.85601 8.99063L8.55501 8.16263L11.104 2.99863C11.1958 2.84247 11.3269 2.713 11.4841 2.62305C11.6413 2.5331 11.8194 2.48578 12.0005 2.48578C12.1817 2.48578 12.3597 2.5331 12.5169 2.62305C12.6742 2.713 12.8052 2.84247 12.897 2.99863L15.445 8.16263L21.144 8.99063C21.3285 9.01759 21.5018 9.0956 21.6443 9.21584C21.7868 9.33608 21.8928 9.49377 21.9505 9.67109C22.0081 9.84842 22.015 10.0383 21.9704 10.2194C21.9258 10.4004 21.8314 10.5654 21.698 10.6956L17.574 14.7156L18.548 20.3916C18.5726 20.5351 18.5656 20.6822 18.5274 20.8227C18.4893 20.9632 18.4209 21.0937 18.3271 21.205C18.2333 21.3163 18.1163 21.4058 17.9844 21.4672C17.8524 21.5287 17.7086 21.5605 17.563 21.5606H17.562Z" fill="#F27D00"></path>
                                                </svg>
                                                <p class="ratinmg-number" fw="bold">5</p>
                                                <p class="MuiTypography-root MuiTypography-body1 mui-style-1h22dky">(288 reviews)</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="explore-card-main mb-20">
                                <a href="#">
                                    <div class="explore-card mui-style-lxguk4">
                                        <img class="st-image-card__img" src="https://sharetrip.net/_next/image?url=https%3A%2F%2Ftbbd-flight.s3.ap-southeast-1.amazonaws.com%2Fpromotion%2Fbest-western-plus-heritage.jpg&w=384&q=75">
                                        <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                        <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                            <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Best Western Heritage</p>
                                            <div class="stpromo-card__rating_container MuiBox-root mui-style-dun6p3">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.562 21.5606C17.3999 21.5602 17.2403 21.5204 17.097 21.4446L12 18.7646L6.90301 21.4446C6.73797 21.5311 6.55206 21.5697 6.36624 21.5562C6.18042 21.5426 6.00208 21.4775 5.85132 21.368C5.70057 21.2585 5.5834 21.1091 5.51302 20.9366C5.44264 20.7641 5.42186 20.5753 5.45301 20.3916L6.42601 14.7156L2.30201 10.6956C2.1686 10.5654 2.07426 10.4004 2.02965 10.2194C1.98504 10.0383 1.99194 9.84842 2.04956 9.67109C2.10717 9.49377 2.21322 9.33608 2.35573 9.21584C2.49823 9.0956 2.67151 9.01759 2.85601 8.99063L8.55501 8.16263L11.104 2.99863C11.1958 2.84247 11.3269 2.713 11.4841 2.62305C11.6413 2.5331 11.8194 2.48578 12.0005 2.48578C12.1817 2.48578 12.3597 2.5331 12.5169 2.62305C12.6742 2.713 12.8052 2.84247 12.897 2.99863L15.445 8.16263L21.144 8.99063C21.3285 9.01759 21.5018 9.0956 21.6443 9.21584C21.7868 9.33608 21.8928 9.49377 21.9505 9.67109C22.0081 9.84842 22.015 10.0383 21.9704 10.2194C21.9258 10.4004 21.8314 10.5654 21.698 10.6956L17.574 14.7156L18.548 20.3916C18.5726 20.5351 18.5656 20.6822 18.5274 20.8227C18.4893 20.9632 18.4209 21.0937 18.3271 21.205C18.2333 21.3163 18.1163 21.4058 17.9844 21.4672C17.8524 21.5287 17.7086 21.5605 17.563 21.5606H17.562Z" fill="#F27D00"></path>
                                                </svg>
                                                <p class="ratinmg-number" fw="bold">5</p>
                                                <p class="MuiTypography-root MuiTypography-body1 mui-style-1h22dky">(288 reviews)</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="explore-card-main mb-20">
                                <a href="#">
                                    <div class="explore-card mui-style-lxguk4">
                                        <img class="st-image-card__img" src="https://sharetrip.net/_next/image?url=https%3A%2F%2Ftbbd-flight.s3.ap-southeast-1.amazonaws.com%2Fpromotion%2Fagoda-2564409-60592569-839740.jpg&w=384&q=75">
                                        <div class="MuiBox-root mui-style-1tyhrx3"></div>
                                        <div class="st-image-card__card_details MuiBox-root mui-style-a34mib">
                                            <p class="MuiTypography-root MuiTypography-body1 mui-style-sq479" fw="semiBold">Sea Pearl Beach Resort..</p>
                                            <div class="stpromo-card__rating_container MuiBox-root mui-style-dun6p3">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.562 21.5606C17.3999 21.5602 17.2403 21.5204 17.097 21.4446L12 18.7646L6.90301 21.4446C6.73797 21.5311 6.55206 21.5697 6.36624 21.5562C6.18042 21.5426 6.00208 21.4775 5.85132 21.368C5.70057 21.2585 5.5834 21.1091 5.51302 20.9366C5.44264 20.7641 5.42186 20.5753 5.45301 20.3916L6.42601 14.7156L2.30201 10.6956C2.1686 10.5654 2.07426 10.4004 2.02965 10.2194C1.98504 10.0383 1.99194 9.84842 2.04956 9.67109C2.10717 9.49377 2.21322 9.33608 2.35573 9.21584C2.49823 9.0956 2.67151 9.01759 2.85601 8.99063L8.55501 8.16263L11.104 2.99863C11.1958 2.84247 11.3269 2.713 11.4841 2.62305C11.6413 2.5331 11.8194 2.48578 12.0005 2.48578C12.1817 2.48578 12.3597 2.5331 12.5169 2.62305C12.6742 2.713 12.8052 2.84247 12.897 2.99863L15.445 8.16263L21.144 8.99063C21.3285 9.01759 21.5018 9.0956 21.6443 9.21584C21.7868 9.33608 21.8928 9.49377 21.9505 9.67109C22.0081 9.84842 22.015 10.0383 21.9704 10.2194C21.9258 10.4004 21.8314 10.5654 21.698 10.6956L17.574 14.7156L18.548 20.3916C18.5726 20.5351 18.5656 20.6822 18.5274 20.8227C18.4893 20.9632 18.4209 21.0937 18.3271 21.205C18.2333 21.3163 18.1163 21.4058 17.9844 21.4672C17.8524 21.5287 17.7086 21.5605 17.563 21.5606H17.562Z" fill="#F27D00"></path>
                                                </svg>
                                                <p class="ratinmg-number" fw="bold">5</p>
                                                <p class="MuiTypography-root MuiTypography-body1 mui-style-1h22dky">(288 reviews)</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
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
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom" href="#pick-up" data-bs-toggle="tab">Pick Up Places of interest</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="hotel-overview" class="tab-pane tab-pane-custom in active">
                                    <div class="destination-list">
                                        <ul>
                                            <li class="des-list">
                                                <a href="#">Bangladesh</a>
                                                <span class="count-pro">80,929 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Bangladesh</a>
                                                <span class="count-pro">80,929 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Bangladesh</a>
                                                <span class="count-pro">80,929 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Bangladesh</a>
                                                <span class="count-pro">80,929 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Bangladesh</a>
                                                <span class="count-pro">80,929 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Bangladesh</a>
                                                <span class="count-pro">80,929 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Bangladesh</a>
                                                <span class="count-pro">80,929 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Bangladesh</a>
                                                <span class="count-pro">80,929 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Bangladesh</a>
                                                <span class="count-pro">80,929 properties</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end hotel-overview -->
                                <div id="restaurant" class="tab-pane tab-pane-custom">
                                    <div class="destination-list">
                                        <ul>
                                            <li class="des-list">
                                                <a href="#">Dhaka</a>
                                                <span class="count-pro">46, Kazi Nazrul Islam Avenue</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Dhaka</a>
                                                <span class="count-pro">46, Kazi Nazrul Islam Avenue</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Dhaka</a>
                                                <span class="count-pro">46, Kazi Nazrul Islam Avenue</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Dhaka</a>
                                                <span class="count-pro">46, Kazi Nazrul Islam Avenue</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Dhaka</a>
                                                <span class="count-pro">46, Kazi Nazrul Islam Avenue</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Dhaka</a>
                                                <span class="count-pro">46, Kazi Nazrul Islam Avenue</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Dhaka</a>
                                                <span class="count-pro">46, Kazi Nazrul Islam Avenue</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Dhaka</a>
                                                <span class="count-pro">46, Kazi Nazrul Islam Avenue</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end restaurant -->
                                <div id="pick-up" class="tab-pane tab-pane-custom">
                                    <div class="destination-list">
                                        <ul>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                            <li class="des-list">
                                                <a href="#">Kawran Bazar</a>
                                                <span class="count-pro">100 properties</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end pick-up -->
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



@endsection
