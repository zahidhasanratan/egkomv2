@extends('frontend.hotelMaster')
@section('title','EGKom')
@section('main')
    <!--===== INNERPAGE-WRAPPER (per hotel-room-details.html) =====-->
    <section class="innerpage-wrapper">
        <div id="hotel-details" class="innerpage-section-padding">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">

                        <div class="hotel-full-mame">

                            <div class="hotel-preview">
                                <div class="info-preview-container">
                                    <div data-v-58caae98="" class="type-and-rating">
                                        <div class="hotel-title-sec">
                                            <h2 data-v-58caae98="" class="hotel-title">{{ $show->description }}  </h2>
                                            <img class="title-logo"
                                                 src="{{ asset('/')}}{{ optional(\App\Models\Vendor::find($show->vendor_id))->logo }}"
                                                 alt="">
                                        </div>
                                        <div data-v-58caae98="" class="d-flex align-items-start">
                                            <span data-v-002f304c="" data-v-58caae98="" class="rating-wrapper">
                                               <svg data-v-002f304c="" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                  <path data-v-002f304c="" d="M11.3642 4.06484L8.09329 3.58798L6.63135 0.623797C6.36941 0.0954392 5.61046 0.0887228 5.34628 0.623797L3.88434 3.58798L0.613443 4.06484C0.0268763 4.14992 -0.208198 4.87305 0.217175 5.28723L2.58359 7.5932L2.02389 10.8507C1.92314 11.4395 2.54329 11.8805 3.0627 11.6051L5.98882 10.0671L8.91494 11.6051C9.43434 11.8783 10.0545 11.4395 9.95374 10.8507L9.39404 7.5932L11.7605 5.28723C12.1858 4.87305 11.9508 4.14992 11.3642 4.06484V4.06484Z" fill="white" fill-opacity="0.01"></path>
                                                  <mask data-v-002f304c="" id="mask0_1025_22137" maskUnits="userSpaceOnUse" x="0" y="0" width="12" height="12" style="mask-type: alpha;">
                                                     <path data-v-002f304c="" d="M11.3642 4.06484L8.09329 3.58798L6.63135 0.623797C6.36941 0.0954392 5.61046 0.0887228 5.34628 0.623797L3.88434 3.58798L0.613443 4.06484C0.0268763 4.14992 -0.208198 4.87305 0.217175 5.28723L2.58359 7.5932L2.02389 10.8507C1.92314 11.4395 2.54329 11.8805 3.0627 11.6051L5.98882 10.0671L8.91494 11.6051C9.43434 11.8783 10.0545 11.4395 9.95374 10.8507L9.39404 7.5932L11.7605 5.28723C12.1858 4.87305 11.9508 4.14992 11.3642 4.06484V4.06484Z" fill="white"></path>
                                                  </mask>
                                                  <g data-v-002f304c="" mask="url(#mask0_1025_22137)">
                                                     <rect data-v-002f304c="" width="12" height="12" fill="#FCCD03"></rect>
                                                  </g>
                                               </svg>
                                               <span data-v-002f304c="" class="rating-number">5 Star</span>
                                            </span>
                                            <div data-v-58caae98="" class="location">
                                                <a data-v-58caae98="" target="_blank" href="https://www.google.com/maps?q=21.2156613574987200000000000,92.0488919829189300000000000" class="location-link">
                                                    <svg data-v-58caae98="" width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path data-v-58caae98="" fill-rule="evenodd" clip-rule="evenodd" d="M5.99984 7.66667C4.71317 7.66667 3.6665 6.62 3.6665 5.33333C3.6665 4.04667 4.71317 3 5.99984 3C7.2865 3 8.33317 4.04667 8.33317 5.33333C8.33317 6.62 7.2865 7.66667 5.99984 7.66667ZM5.99984 0.333332C3.05917 0.333332 0.666504 2.70267 0.666504 5.61533C0.666504 9.26467 5.36584 13.3347 5.56584 13.506C5.69117 13.6133 5.84517 13.6667 5.99984 13.6667C6.1545 13.6667 6.3085 13.6133 6.43384 13.506C6.63384 13.3347 11.3332 9.26467 11.3332 5.61533C11.3332 2.70267 8.9405 0.333332 5.99984 0.333332Z" fill="#546378"></path>
                                                    </svg>
                                                    <span data-v-58caae98=""> {{ $show->address }} </span>
                                                </a>
                                            </div>
                                        </div>
                                        {{-- Couple Friendly Badge (per hotel-room-details.html) --}}
                                        <svg style="display: none;">
                                            <symbol id="couple-tag">
                                                <g clip-path="url(#clip0_3759_25068)">
                                                    <path d="M3.55554 1.50366H2.39844V3.23931H3.55554V1.50366Z" fill="#F44586"></path>
                                                    <path d="M6.15893 1.50366H5.00183V3.23931H6.15893V1.50366Z" fill="#F44586"></path>
                                                    <path d="M7.7836 12.4957C8.02825 12.2816 8.18382 11.968 8.18382 11.6182V6.42125C8.18382 6.2865 8.09072 6.16977 7.95965 6.13932L7.89455 6.12427V0.346648C7.89455 0.187048 7.76505 0.057373 7.60527 0.057373H0.952298C0.792698 0.057373 0.663023 0.187048 0.663023 0.346648V4.45547L0.438848 4.40367C0.352923 4.38407 0.262798 4.40437 0.193848 4.45915C0.124898 4.51392 0.0846477 4.59722 0.0846477 4.68542V11.6181C0.0846477 11.9679 0.240223 12.2815 0.485048 12.4955C0.240048 12.7099 0.0844727 13.0235 0.0844727 13.3733V13.6528C0.0844727 13.8124 0.214148 13.942 0.373748 13.942H7.89455C8.05415 13.942 8.18382 13.8125 8.184 13.6528V13.3733C8.184 13.0235 8.02842 12.7097 7.7836 12.4957ZM1.2414 0.635923H7.316V5.99092L6.1589 5.72387V4.39632H5.0018V5.45682L3.55542 5.1231V4.3965H2.39832V4.85622L1.24122 4.58917V0.635923H1.2414ZM6.98682 9.88152C6.74707 10.2462 5.71475 11.1133 5.49092 11.1133C5.27182 11.1133 4.23022 10.2431 3.99205 9.88152C3.87287 9.70057 3.78817 9.50072 3.80217 9.23822C3.82702 8.7736 4.20695 8.38982 4.67227 8.38982C5.15072 8.38982 5.42932 8.9003 5.48935 8.9003C5.55812 8.9003 5.84862 8.38982 6.30642 8.38982C6.77175 8.38982 7.15167 8.7736 7.17652 9.23822C7.1907 9.5009 7.10635 9.69987 6.98682 9.88152ZM1.0923 8.1016C1.12467 7.49627 1.61957 6.99647 2.2256 6.99647C2.84877 6.99647 3.21155 7.6613 3.28977 7.6613C3.3792 7.6613 3.75772 6.99647 4.35395 6.99647C4.95997 6.99647 5.45487 7.49627 5.48725 8.1016C5.4918 8.18822 5.49232 8.26697 5.47972 8.34012C5.47115 8.38982 5.42442 8.42045 5.3847 8.37967C5.21127 8.2122 5.02577 8.09495 4.6721 8.09495C4.37057 8.09495 4.08392 8.21395 3.86482 8.42972C3.65045 8.64112 3.52357 8.92252 3.50747 9.22248C3.48717 9.6038 3.63365 9.87382 3.74547 10.0437C3.78012 10.0962 3.79395 10.1171 3.84767 10.1787C3.87375 10.2126 3.85327 10.2357 3.84015 10.2452C3.59357 10.4233 3.38655 10.5435 3.2917 10.5435C3.00645 10.5435 1.64967 9.41007 1.3394 8.93915C1.18417 8.70377 1.0741 8.44355 1.0923 8.1016ZM0.663023 13.3637C0.668273 13.044 0.930073 12.7851 1.2512 12.7851H7.0171H7.01727C7.33822 12.7851 7.6002 13.0438 7.60527 13.3637H0.663023Z" fill="#F44586"></path>
                                                </g>
                                                <defs><clipPath id="clip0_3759_25068"><rect width="8.26822" height="14" transform="translate(0.0844727 0.057373)" fill="white"></rect></clipPath></defs>
                                            </symbol>
                                        </svg>
                                    </div>
                                </div>

                                <div class="hotel-preview hotel-nearby-lg">
                                    <div class="info-preview-container">
                                        <div class="hotel-heading-name">
                                            <div data-v-58caae98="" class="nearby">
                                                <div data-v-58caae98="" class="label"> What's Nearby</div>
                                                @php
                                                    $nearbyAreas = $show->custom_nearby_areas ?? null;
                                                    if (is_string($nearbyAreas)) {
                                                        $nearbyAreas = json_decode($nearbyAreas, true) ?? [];
                                                    } elseif (!is_array($nearbyAreas)) {
                                                        $nearbyAreas = [];
                                                    }
                                                @endphp
                                                @foreach(array_slice((array) $nearbyAreas, 0, 3) as $area)
                                                    <div class="landmark">
                                                        <span>
                                                            <i class="icon icon-map-marker-grey location-pin"></i> {{ $area }}
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hotel-at-a-galance">
                            <div class="all-gallery-button">
                                <button type="button" class="btn btn-primary btn-custim-gallery" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <span style="padding-right: 7px;"><i class="fa fa-solid fa-image"></i></span>
                                    View all photos
                                </button>
                            </div>
                            <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-car-offers">
                                @php
                                    $photoFields = ['entrance_gate_photos','lift_stairs_photos','rooftop_photos','spa_photos','gym_photos','amenities_photos','additional_photos'];
                                @endphp
                                @foreach($photoFields as $field)
                                    @php
                                        $raw = $show->$field ?? null;
                                        if (is_string($raw)) {
                                            $decoded = json_decode($raw, true);
                                            $photos = is_array($decoded) ? $decoded : (trim($raw) ? [$raw] : []);
                                        } else {
                                            $photos = is_array($raw) ? $raw : [];
                                        }
                                    @endphp
                                    @if(!empty($photos))
                                        @foreach($photos as $bannerPhoto)
                                            <div class="item">
                                                <div class="main-block car-offer-block">
                                                    <div class="main-img room-main-image car-offer-img">
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            <img src="{{ asset('/') . $bannerPhoto }}" class="img-fluid" alt="hotel"/>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabing Menu (per hotel-room-details.html) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabing-section headerss">
                            <div id="nav" class="pull-left">
                                <ul class="nav nav-pills nav-tabing-custom">
                                    <li role="presentation"><a href="#Overview">Hotel Overview</a></li>
                                    <li role="presentation"><a href="#Room_Details">Room Details</a></li>
                                    <li role="presentation"><a href="#Nearby">Nearby</a></li>
                                    <li role="presentation"><a href="#facilities">Facilities</a></li>
                                    <li role="presentation"><a href="#review">Review</a></li>
                                    <li role="presentation"><a href="#rules">Policy</a></li>
                                    <li role="presentation"><a href="#host_Profile">Host Profile</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabing Menu -->
                <!--Hotel Overview -->
                <div id="Overview" class="row ">
                    <div class="col-12 col-md-12 col-md-12 col-lg-12 side-bar right-side-bar">

                        <!--Start: Mobile view-hotel Near by -->
                        <div class="hotel-preview hotel-nearby-mb">
                            <div class="info-preview-container">
                                <div class="hotel-heading-name">
                                    <div data-v-58caae98="" class="nearby">
                                        <div data-v-58caae98="" class="label"> What's Nearby</div>
                                        @php
                                            $nearbyAreasMobile = $show->custom_nearby_areas ?? null;
                                            if (is_string($nearbyAreasMobile)) {
                                                $nearbyAreasMobile = json_decode($nearbyAreasMobile, true) ?? [];
                                            } elseif (!is_array($nearbyAreasMobile)) {
                                                $nearbyAreasMobile = [];
                                            }
                                        @endphp
                                        @foreach(array_slice((array) $nearbyAreasMobile, 0, 3) as $area)
                                        <div data-v-58caae98="" class="landmark">
                                          <span data-v-58caae98="">
                                          <i data-v-58caae98="" class="icon icon-map-marker-grey location-pin"></i> {{ $area }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End: Mobile view-hotel Near by -->


                        <div class="hotel-preview">
                            <div data-v-58caae98="" class="info-preview-container">

                                <div data-v-58caae98="" class="amenities">
                                    <h3 data-v-58caae98="" class="mst-pop-title"> Most Popular Facilities </h3>
                                    <div class="fea-list">

                                        @foreach(($show->facilities ?? []) as $facility)
                                            <div class="_19xnuo97">
                                                <div class="fea-list-all">
                                                    <div
                                                        class="i1fpqhzs atm_jb_1tcgj5g ihkmq0n atm_h0_exct8b atm_gz_idpfg4 dir dir-ltr">
                                                    @if($facility == 'Free Wi-Fi')
                                                        <!-- Free Wi-Fi Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                                                 aria-hidden="true" role="presentation"
                                                                 focusable="false"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path
                                                                    d="M16 20.33a3.67 3.67 0 1 1 0 7.34 3.67 3.67 0 0 1 0-7.34zm0 2a1.67 1.67 0 1 0 0 3.34 1.67 1.67 0 0 0 0-3.34zM16 15a9 9 0 0 1 8.04 4.96l-1.51 1.51a7 7 0 0 0-13.06 0l-1.51-1.51A9 9 0 0 1 16 15zm0-5.33c4.98 0 9.37 2.54 11.94 6.4l-1.45 1.44a12.33 12.33 0 0 0-20.98 0l-1.45-1.45A14.32 14.32 0 0 1 16 9.66zm0-5.34c6.45 0 12.18 3.1 15.76 7.9l-1.43 1.44a17.64 17.64 0 0 0-28.66 0L.24 12.24c3.58-4.8 9.3-7.9 15.76-7.9z"></path>
                                                            </svg>
                                                    @elseif($facility == 'On-site restaurant')
                                                        <!-- Restaurant Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path
                                                                    d="M11 9h2V2h-2v7zm7-7v9a3 3 0 0 1-3 3v9h2v-6h2v6h2v-9a3 3 0 0 1-3-3V2h-2zm-9 0v9a3 3 0 0 0 3 3v9h2v-9a3 3 0 0 0 3-3V2h-2v7h-2V2h-2v7H9V2H7z"/>
                                                            </svg>

                                                    @elseif($facility == 'Buffet Breakfast')
                                                        <!-- Restaurant Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path
                                                                    d="M21 10a9 9 0 1 0-9 9h2v-2h-2a7 7 0 1 1 7-7h2zm-9 2a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                            </svg>
                                                    @elseif($facility == 'Hill View Or Sea View')
                                                        <!-- Restaurant Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path d="M3 19h18l-6-8-4 5-2-3-6 6z"/>
                                                                <circle cx="17" cy="6" r="2"/>
                                                            </svg>
                                                    @elseif($facility == 'Bar/lounge')
                                                        <!-- Restaurant Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path
                                                                    d="M7 2v2h10V2h2v2a6 6 0 0 1-5 5.91V14h3v2h-3v6h-2v-6H9v-2h3V9.91A6 6 0 0 1 7 4V2h2z"/>
                                                            </svg>
                                                    @elseif($facility == 'Private Pool')
                                                        <!-- Restaurant Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                                                 aria-hidden="true" role="presentation"
                                                                 focusable="false"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path
                                                                    d="M24 26c.99 0 1.95.35 2.67 1 .3.29.71.45 1.14.5H28v2h-.23a3.96 3.96 0 0 1-2.44-1A1.98 1.98 0 0 0 24 28c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 16 28c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 8 28c-.5 0-.98.17-1.33.5a3.96 3.96 0 0 1-2.44 1H4v-2h.19a1.95 1.95 0 0 0 1.14-.5A3.98 3.98 0 0 1 8 26c.99 0 1.95.35 2.67 1 .35.33.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.97 3.97 0 0 1 16 26c.99 0 1.95.35 2.67 1 .35.33.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.98 3.98 0 0 1 24 26zm0-5c.99 0 1.95.35 2.67 1 .3.29.71.45 1.14.5H28v2h-.23a3.96 3.96 0 0 1-2.44-1A1.98 1.98 0 0 0 24 23c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 16 23c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 8 23c-.5 0-.98.17-1.33.5a3.96 3.96 0 0 1-2.44 1H4v-2h.19a1.95 1.95 0 0 0 1.14-.5A3.98 3.98 0 0 1 8 21c.99 0 1.95.35 2.67 1 .35.33.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.97 3.97 0 0 1 16 21c.99 0 1.95.35 2.67 1 .35.33.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.98 3.98 0 0 1 24 21zM20 3a4 4 0 0 1 4 3.8V9h4v2h-4v5a4 4 0 0 1 2.5.86l.17.15c.3.27.71.44 1.14.48l.19.01v2h-.23a3.96 3.96 0 0 1-2.44-1A1.98 1.98 0 0 0 24 18c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 16 18c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 8 18c-.5 0-.98.17-1.33.5a3.96 3.96 0 0 1-2.44 1H4v-2h.19a1.95 1.95 0 0 0 1.14-.5A3.98 3.98 0 0 1 8 16c.99 0 1.95.35 2.67 1 .35.33.83.5 1.33.5.5 0 .98-.17 1.33-.5a3.96 3.96 0 0 1 2.44-1H16v-5H4V9h12V7a2 2 0 0 0-4-.15V7h-2a4 4 0 0 1 7-2.65A3.98 3.98 0 0 1 20 3zm-2 13.52.46.31.21.18c.35.31.83.49 1.33.49a2 2 0 0 0 1.2-.38l.13-.11c.2-.19.43-.35.67-.49V11h-4zM20 5a2 2 0 0 0-2 1.85V9h4V7a2 2 0 0 0-2-2z"></path>
                                                            </svg>
                                                    @elseif($facility == 'Fitness center & Spa services')
                                                        <!-- Restaurant Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path
                                                                    d="M21 5V3h-2V2h-2v1h-2v2h-2v2H9V5H7V3H5v2H3v2h2v2H3v2h2v2H3v2h2v2H3v2h2v2h2v-2h2v-2h2v-2h2v-2h2v-2h2V9h2V7h-2V5h2z"/>
                                                            </svg>
                                                    @elseif($facility == '24-hour reception')
                                                        <!-- Restaurant Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path
                                                                    d="M12 2a10 10 0 1 0 10 10h-2a8 8 0 1 1-8-8V2zm1 5h-2v6l5 3 .9-1.45-3.9-2.25V7z"/>
                                                            </svg>
                                                    @elseif($facility == 'Parking facilities')
                                                        <!-- Restaurant Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                                                 aria-hidden="true" role="presentation"
                                                                 focusable="false"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path
                                                                    d="M26 19a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 18a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm20.7-5 .41 1.12A4.97 4.97 0 0 1 30 18v9a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-2H8v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-9c0-1.57.75-2.96 1.89-3.88L4.3 13H2v-2h3v.15L6.82 6.3A2 2 0 0 1 8.69 5h14.62c.83 0 1.58.52 1.87 1.3L27 11.15V11h3v2h-2.3zM6 25H4v2h2v-2zm22 0h-2v2h2v-2zm0-2v-5a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v5h24zm-3-10h.56L23.3 7H8.69l-2.25 6H25zm-15 7h12v-2H10v2z"></path>
                                                            </svg>
                                                    @elseif($facility == 'Airport shuttle service')
                                                        <!-- Restaurant Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <path
                                                                    d="M21 16V8a2 2 0 0 0-2-2h-3V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v2H3a2 2 0 0 0-2 2v8h2a3 3 0 1 0 6 0h6a3 3 0 1 0 6 0h2zm-8-2H5V6h8v8zm-6 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm10 1a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                            </svg>
                                                    @else
                                                        <!-- Default Icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                                                <circle cx="12" cy="12" r="10"/>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <div class="dir dir-ltr">{{ $facility }}</div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end columns -->
                </div>
                <!-- end row -->


                <div class="row">
                    <div data-v-58caae98="" class="col-md-12">
                        <div data-v-58caae98="" class="hotel-description-wrapper">
                            <h3 data-v-58caae98="" class="description-title"> Hotel Description </h3>
                            {{--                            <div data-v-58caae98="" class="hotel-meta">--}}
                            {{--                                <span data-v-58caae98="" class="meta-info"> Number of Rooms: 493 </span>--}}
                            {{--                                <span data-v-58caae98="" class="meta-info"> Number of Floors: 9 </span>--}}
                            {{--                                <span data-v-58caae98="" class="meta-info"> Year of construction: 2015 </span>--}}
                            {{--                            </div>--}}
                            <div data-v-58caae98="" class="description-texts">
                                {!! $show->details  !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room Deatails -->

                <div class="product-details-searchbar">
                    <div class="search-tabs search-custom-details" style="position: relative;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <div id="hotels" class="tab-pane active">

                                        <h2 class="meta-info-hotel">{{ $show->description }}</h2>

                                        <form id="searchForm">
                                            <div class="row">


                                                <div class="col-12 col-md-3">
                                                    <div class="form-group left-icon">
                                                        <input type="date" class="form-control hotel-details-date" id="checkInDate" name="checkin"
                                                               placeholder="Check In" required onchange="updateDatesAndFilter()">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div><!-- end columns -->

                                                <div class="col-12 col-md-3">
                                                    <div class="form-group left-icon">
                                                        <input type="date" class="form-control hotel-details-date" id="checkoutDate" name="checkout"
                                                               placeholder="Check Out" required onchange="updateDatesAndFilter()">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div><!-- end columns -->

                                                <div class="col-6 col-md-6 col-lg-2">
                                                    <div class="form-group right-icon">
                                                        <select class="form-control" id="guestsSelect" name="guests" onchange="updateGuestsAndFilter()">
                                                            <option value="0" selected>Add Guests</option>
                                                            <option value="1">1 Guest</option>
                                                            <option value="2">2 Guests</option>
                                                            <option value="3">3 Guests</option>
                                                            <option value="4">4 Guests</option>
                                                            <option value="5">5 Guests</option>
                                                            <option value="6">6+ Guests</option>
                                                        </select>
                                                        <i class="fa fa-angle-down"></i>
                                                    </div>
                                                </div><!-- end columns -->


                                                <div class="col-6 col-md-6 col-lg-2">
                                                    <div class="form-group right-icon">
                                                        <select class="form-control" id="childrenSelect" name="children" onchange="updateGuestsAndFilter()">
                                                            <option value="0" selected>Add Children</option>
                                                            <option value="1">1 Child</option>
                                                            <option value="2">2 Children</option>
                                                            <option value="3">3 Children</option>
                                                            <option value="4">4+ Children</option>
                                                        </select>
                                                        <i class="fa fa-angle-down"></i>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-12 col-xl-2">
                                                    <button type="button" onclick="modifySearch()" class="btn btn-orange" style="background: #91278f; border: none; width: 100%; padding: 12px; font-weight: 600; text-transform: uppercase; color: white;">
                                                        Modify Search
                                                    </button>
                                                </div>


                                            </div><!-- end row -->
                                        </form>
                                    </div><!-- end hotels -->

                                </div><!-- end tab-content -->

                            </div><!-- end columns -->
                        </div><!-- end row -->

                    </div>
                </div>


                <script>
                    // Auto-fill form from URL parameters
                    window.onload = function () {
                        // Get search parameters from URL
                        const urlParams = new URLSearchParams(window.location.search);
                        const checkin = urlParams.get('checkin');
                        const checkout = urlParams.get('checkout');
                        const adults = urlParams.get('adults') || '0';
                        const children = urlParams.get('children') || '0';
                        
                        // Set check-in date
                        if (checkin) {
                            document.getElementById("checkInDate").value = checkin;
                        } else {
                            // Default to today if no checkin in URL
                            const today = new Date();
                            const formattedDate = today.toISOString().substr(0, 10);
                            document.getElementById("checkInDate").value = formattedDate;
                        }
                        
                        // Set check-out date
                        if (checkout) {
                            document.getElementById("checkoutDate").value = checkout;
                        }
                        
                        // Set guests
                        if (adults && parseInt(adults) > 0) {
                            document.getElementById("guestsSelect").value = adults;
                        }
                        
                        // Set children
                        if (children && parseInt(children) > 0) {
                            document.getElementById("childrenSelect").value = children;
                        }
                        
                        // Check if dates are selected and update visibility
                        setTimeout(() => {
                            if (typeof updateDatesAndFilter === 'function') {
                                updateDatesAndFilter();
                            }
                        }, 100);
                    };

                </script>

                <style>
                    /* Wishlist Heart Icon - top-right of room card (like attachment 2) */
                    .hotel-all-card {
                        position: relative;
                    }
                    .wishlist-heart-icon {
                        position: absolute;
                        top: 15px;
                        right: 15px;
                        width: 40px;
                        height: 40px;
                        background: white;
                        border: 2px solid #90278e;
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
                    
                    /* Nights locked when set by search dates */
                    .quantity-btn.nights-locked .qty-room input {
                        cursor: default;
                        background-color: #f5f5f5;
                    }

                    /* Pill-style nights selector */
                    .quantity-btn .qty-room {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 4px;
                    }

                    .quantity-btn .qty-room input[type="number"] {
                        width: 56px;
                        height: 32px;
                        border-radius: 999px;
                        border: 2px solid #91278f;
                        text-align: center;
                        font-weight: 600;
                        color: #1c3c6b;
                        outline: none;
                        -moz-appearance: textfield;
                    }

                    .quantity-btn .qty-room input[type="number"]::-webkit-outer-spin-button,
                    .quantity-btn .qty-room input[type="number"]::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                        margin: 0;
                    }

                    .quantity-btn .qty-room .night-label {
                        font-size: 13px;
                        color: #444;
                        margin: 0;
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
                    
                    .image-gallery {
                        position: relative;
                    }

                    /* Ensure the featured image acts as the positioning context for the main heart icon */
                    .image-gallery .featured {
                        position: relative;
                    }

                    /* Position of the heart icon over the main image (as requested) */
                    .wishlist-heart-icon-main {
                        top: 48px;
                        right: -6px;
                    }
                    
                    /* Gap between Couple Friendly tag and image gallery */
                    #hotel-details .hotel-room .room-info .room-feature-head + .image-gallery.multiple-row {
                        margin-top: 14px;
                    }
                    #hotel-details .hotel-room .room-info .couple-friendly-card {
                        margin-bottom: 4px;
                    }
                    
                    /* Room image gallery: row 1 = feature image (top, full width), row 2 = thumbnails */
                    #hotel-details .hotel-room .room-info .image-gallery.multiple-row {
                        grid-template-rows: auto auto;
                        grid-template-columns: repeat(3, minmax(70px, 1fr));
                    }
                    #hotel-details .hotel-room .room-info .image-gallery.multiple-row div.featured {
                        grid-column: 1 / -1;
                        grid-row: 1;
                        width: 100%;
                        min-height: 200px;
                    }
                    #hotel-details .hotel-room .room-info .image-gallery.multiple-row div.featured .image-box {
                        width: 100%;
                        min-height: 200px;
                        height: 100%;
                        object-fit: cover;
                    }
                    #hotel-details .hotel-room .room-info .image-gallery.multiple-row div.thumb-image:nth-of-type(3) {
                        grid-column: 1;
                        grid-row: 2;
                    }
                    #hotel-details .hotel-room .room-info .image-gallery.multiple-row div.thumb-image:nth-of-type(4) {
                        grid-column: 2;
                        grid-row: 2;
                    }
                    #hotel-details .hotel-room .room-info .image-gallery.multiple-row div.thumb-image:nth-of-type(5) {
                        grid-column: 3;
                        grid-row: 2;
                    }
                    #hotel-details .hotel-room .room-info .image-gallery.multiple-row div.thumb-image .image-box {
                        width: 100%;
                        min-height: 80px;
                        height: 100%;
                        object-fit: cover;
                    }
                    
                    /* Room features list: consistent alignment (icon + text) */
                    #hotel-details .hotel-room .room-info .features.fea-grid {
                        display: flex;
                        flex-direction: column;
                        gap: 6px;
                    }
                    #hotel-details .hotel-room .room-info .features.fea-grid small.d-block {
                        display: flex !important;
                        align-items: center;
                        gap: 8px;
                        margin: 0;
                        padding: 0;
                        line-height: 1.4;
                    }
                    #hotel-details .hotel-room .room-info .features.fea-grid small.d-block i {
                        flex-shrink: 0;
                        width: 20px;
                        text-align: center;
                    }
                    
                    /* Pricing section: alignment and spacing */
                    #hotel-details .hotel-room .room-options .pricing-info .price-amount {
                        display: flex;
                        flex-direction: column;
                        gap: 4px;
                    }
                    #hotel-details .hotel-room .room-options .pricing-info .price-amount .tax-tag {
                        margin: 4px 0 0 0;
                        padding: 0;
                        font-size: 11px;
                        line-height: 1.3;
                        white-space: normal;
                        max-width: 100%;
                    }
                    #hotel-details .hotel-room .room-options .pricing-info .price-per {
                        margin: 6px 0 0 0;
                        padding: 0;
                    }
                    #hotel-details .hotel-room .room-options .pricing-info .option-meta-nr {
                        margin-top: 6px !important;
                        margin-bottom: 4px !important;
                    }
                    
                    .uitk-pill-container {
                        display: flex;
                        flex-wrap: nowrap;
                        margin-block: -.75rem 0;
                        margin-inline: -.25rem;
                        overflow: auto;
                        position: relative;
                    }

                    .uitk-pill-container .uitk-pill {
                        flex-shrink: 0;
                        margin-block: .75rem 0;
                        margin-inline: .25rem;
                    }

                    .uitk-pill {
                        align-items: stretch;
                        block-size: 2rem;
                        display: inline-flex;
                        min-inline-size: 2.75rem;
                    }

                    .is-visually-hidden {
                        block-size: 1px;
                        border: 0;
                        clip: rect(0 0 0 0);
                        inline-size: 1px;
                        margin: -1px;
                        overflow: hidden;
                        padding: 0;
                        position: absolute;
                    }

                    .uitk-pill-removable.uitk-pill-content, .uitk-pill-selected, .uitk-pill-standard:checked ~ .uitk-pill-content {
                        --egds-legacy-background-color: #ecf4fd;
                        --egds-legacy-border-color: #191e3b;
                        --egds-legacy-color: #191e3b;
                        --egds-legacy-fill: #191e3b;
                        background-color: var(--egds-secondary-container-variant, var(--egds-legacy-background-color));
                        box-shadow: inset 0 0 0 2px var(--egds-on-surface, var(--egds-legacy-border-color));
                        color: var(--egds-on-surface, var(--egds-legacy-color));
                    }

                    .uitk-pill-text {
                        max-inline-size: 12rem;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        white-space: nowrap;
                    }

                    .uitk-pill-content {
                        --egds-legacy-background-color: #fff;
                        --egds-legacy-color: #191e3b;
                        --egds-legacy-border-color: #818494;
                        align-items: center;
                        background-color: var(--egds-surface-low-elevation, var(--egds-legacy-background-color));
                        border-radius: 2500rem;
                        box-shadow: inset 0 0 0 1px var(--egds-outline, var(--egds-legacy-border-color));
                        color: var(--egds-on-surface, var(--egds-legacy-color));
                        display: inline-flex;
                        font-size: .75rem;
                        font-weight: 400;
                        justify-content: center;
                        line-height: 1rem;
                        padding-block: 0;
                        padding-inline: .75rem;
                    }
                </style>

                <div class="uitk-pill-container" id="bedFilterContainer" style="display: none;">
                    <div class="uitk-pill">
                        <input id="ALLROOMS" aria-checked="true" type="radio" name="bedFilter"
                               class="uitk-pill-standard is-visually-hidden" value="all" checked="" onchange="filterRoomsByBeds()"/>
                        <label class="uitk-pill-content" for="ALLROOMS" aria-label="All rooms"><span
                                class="uitk-pill-text">All rooms</span></label>
                    </div>
                    <div class="uitk-pill">
                        <input id="1BED" aria-checked="false" type="radio" name="bedFilter"
                               class="uitk-pill-standard is-visually-hidden" value="1" onchange="filterRoomsByBeds()"/><label
                            class="uitk-pill-content" for="1BED" aria-label="1 bed"><span
                                class="uitk-pill-text">1 bed</span></label>
                    </div>
                    <div class="uitk-pill">
                        <input id="2BEDS" aria-checked="false" type="radio" name="bedFilter"
                               class="uitk-pill-standard is-visually-hidden" value="2" onchange="filterRoomsByBeds()"/><label
                            class="uitk-pill-content" for="2BEDS" aria-label="2 beds"><span class="uitk-pill-text">2 beds</span></label>
                    </div>
                    <div class="uitk-pill">
                        <input id="3PLUSBEDS" aria-checked="false" type="radio" name="bedFilter"
                               class="uitk-pill-standard is-visually-hidden" value="3" onchange="filterRoomsByBeds()"/>
                        <label class="uitk-pill-content" for="3PLUSBEDS" aria-label="3 or more beds"><span
                                class="uitk-pill-text">3+ beds</span></label>
                    </div>
                    <div class="uitk-pill">
                        <a class="reset-btn" href="javascript:void(0)" onclick="clearAllFilters()">Clear Filter</a>
                    </div>

                </div>
                
                <!-- Search Summary Bar -->
                <div class="search-summary-bar" style="display: flex; justify-content: space-between; align-items: center; background: #f8f9fa; padding: 15px 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #91278f;">
                    <div style="flex: 1;">
                        <strong style="color: #333;">Room Details</strong>
                    </div>
                    <div id="searchSummary" style="flex: 1; text-align: center; color: #666; font-size: 14px;">
                        Select dates and guests to see pricing
                    </div>
                    <div style="flex: 1; text-align: right;">
                        <strong style="color: #91278f;">Pricing Summary</strong>
                    </div>
                </div>

                <style type="text/css">
                    .room-card {
                        background-color: #FAFAFA;
                        height: 400px;
                        border-radius: 5px;
                    }
                </style>

                <style>
                    /* Review Images Styles */
                    .review-hotel-rrom-gallery {
                        margin-top: 20px;
                        margin-bottom: 15px;
                    }
                    
                    .review-image-wrapper {
                        position: relative;
                        overflow: hidden;
                        border-radius: 8px;
                        cursor: pointer;
                        aspect-ratio: 1;
                        background: #f0f0f0;
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                    }
                    
                    .review-image-wrapper:hover {
                        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                        transform: translateY(-2px);
                    }
                    
                    .review-thumbnail {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        transition: transform 0.3s ease;
                    }
                    
                    .review-thumbnail:hover {
                        transform: scale(1.05);
                    }
                    
                    /* Review Image Modal Styles */
                    #reviewImageModal .modal-content {
                        background: transparent;
                        border: none;
                    }
                    
                    #reviewImageModal .modal-body {
                        padding: 0;
                        text-align: center;
                    }
                    
                    #reviewImageModal .modal-header {
                        border: none;
                        padding: 0;
                    }
                    
                    #reviewImageModal .btn-close {
                        background: white;
                        opacity: 1;
                        border-radius: 50%;
                        padding: 10px;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
                    }
                    
                    #reviewImageModal .image-navigation button {
                        transition: all 0.3s ease;
                    }
                    
                    #reviewImageModal .image-navigation button:hover:not(:disabled) {
                        transform: scale(1.1);
                        background: white !important;
                    }
                    
                    #reviewImageModal .image-navigation button:disabled {
                        opacity: 0.5;
                        cursor: not-allowed;
                    }
                </style>

                <div id="Room_Details" class="row">
                    <div class="col-md-12">
                        <!-- Message when dates not selected -->
                        <div id="noDatesMessage" style="display: none; text-align: center; padding: 60px 30px; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border-radius: 12px; margin: 30px 0; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 2px dashed #e0e0e0;">
                            <div style="margin-bottom: 25px;">
                                <i class="fa fa-calendar" style="font-size: 64px; color: #91278f; opacity: 0.3; margin-bottom: 20px;"></i>
                            </div>
                            <h3 style="color: #333; margin-bottom: 15px; font-size: 24px; font-weight: 600;">Select Dates to View Rooms</h3>
                            <p style="color: #666; margin-bottom: 25px; font-size: 16px; line-height: 1.6; max-width: 500px; margin-left: auto; margin-right: auto;">
                                Please select your check-in and check-out dates above to view available rooms and pricing.
                            </p>
                        </div>
                        
                        <div data-v-58caae98="" id="rooms" style="display: none;">
                            <div data-v-58caae98="" class="row">
                                <div data-v-58caae98="" class="col-lg-9 col-md-12">
                                    <div data-v-58caae98="" class="room-section hotel-summary">
                                        <div data-v-58caae98="" class="room-details-header">
                                            <h2 data-v-58caae98="">Room Details</h2>
                                            <h2 data-v-58caae98="" id="roomDetailsHeader">
                                                @if(isset($searchParams) && $searchParams['checkin'] && $searchParams['checkout'])
                                                    @php
                                                        $checkinDate = \Carbon\Carbon::parse($searchParams['checkin']);
                                                        $checkoutDate = \Carbon\Carbon::parse($searchParams['checkout']);
                                                        $nights = $checkinDate->diffInDays($checkoutDate);
                                                        $totalGuests = $searchParams['adults'] + $searchParams['children'];
                                                    @endphp
                                                    @if($searchParams['adults'] > 0 && $searchParams['children'] > 0)
                                                        For {{ $searchParams['adults'] }} {{ $searchParams['adults'] > 1 ? 'Adults' : 'Adult' }}, {{ $searchParams['children'] }} {{ $searchParams['children'] > 1 ? 'Children' : 'Child' }}, for {{ $nights }} {{ $nights > 1 ? 'Nights' : 'Night' }}
                                                    @elseif($searchParams['adults'] > 0)
                                                        For {{ $searchParams['adults'] }} {{ $searchParams['adults'] > 1 ? 'Adults' : 'Adult' }}, for {{ $nights }} {{ $nights > 1 ? 'Nights' : 'Night' }}
                                                    @elseif($searchParams['children'] > 0)
                                                        For {{ $searchParams['children'] }} {{ $searchParams['children'] > 1 ? 'Children' : 'Child' }}, for {{ $nights }} {{ $nights > 1 ? 'Nights' : 'Night' }}
                                                    @else
                                                        For {{ $totalGuests }} {{ $totalGuests > 1 ? 'Persons' : 'Person' }}, for {{ $nights }} {{ $nights > 1 ? 'Nights' : 'Night' }}
                                                    @endif
                                                @else
                                                    Select dates and guests to see pricing
                                                @endif
                                            </h2>
                                        </div>


                                        <div class="hotel-room">
                                            @php
                                                $activeRooms = \App\Models\Room::where('hotel_id', $show->id)->where('is_active', true)->get();
                                            @endphp
                                            
                                            @if($activeRooms->isEmpty())
                                                <div id="noRoomsAtAll" style="text-align: center; padding: 60px 30px; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border-radius: 12px; margin: 30px 0; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 2px dashed #e0e0e0;">
                                                    <div style="margin-bottom: 25px;">
                                                        <i class="fa fa-bed" style="font-size: 64px; color: #91278f; opacity: 0.3; margin-bottom: 20px;"></i>
                                                    </div>
                                                    <h3 style="color: #333; margin-bottom: 15px; font-size: 24px; font-weight: 600;">No Rooms Available</h3>
                                                    <p style="color: #666; margin-bottom: 25px; font-size: 16px; line-height: 1.6; max-width: 500px; margin-left: auto; margin-right: auto;">
                                                        This hotel currently doesn't have any active rooms available for booking. Please check back later or contact the hotel for more information.
                                                    </p>
                                                    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                                                        <a href="{{ route('search') }}" style="background: #91278f; color: white; border: none; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.3s; box-shadow: 0 2px 8px rgba(145, 39, 143, 0.3); text-decoration: none; display: inline-block;">
                                                            <i class="fa fa-search" style="margin-right: 8px;"></i>Search Other Hotels
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                            @php
                                                $searchNights = 1;
                                                $nightsFromSearch = false;
                                                if (isset($searchParams) && !empty($searchParams['checkin']) && !empty($searchParams['checkout'])) {
                                                    $ci = \Carbon\Carbon::parse($searchParams['checkin']);
                                                    $co = \Carbon\Carbon::parse($searchParams['checkout']);
                                                    $searchNights = max(1, $ci->diffInDays($co));
                                                    $nightsFromSearch = true;
                                                }
                                            @endphp
                                            @foreach($activeRooms as $roomList)

                                                <div class="hotel-all-card" 
                                                     data-room-id="{{ $roomList->id }}"
                                                     data-beds="{{ $roomList->total_beds ?? 1 }}" 
                                                     data-capacity="{{ $roomList->total_persons ?? 2 }}">
                                                    <div class="room-info">
                                                        <div class="room-feature-head">
                                                            <h3 class="room-title">{{ $roomList->name }}</h3>
                                                            @if($roomList->description)
                                                                <p class="room-description" style="color: #666; font-size: 14px; line-height: 1.6; margin-top: 8px; margin-bottom: 12px;">{{ $roomList->description }}</p>
                                                            @endif
                                                            <p class="room-numbers">Room # {{ $roomList->number ?: 'N/A' }} <span
                                                                    class="floor-numbers">{{ $roomList->floor_number ? $roomList->floor_number . ' Floor' : '' }}</span>
                                                            </p>
                                                            @if($roomList->couple_friendly)
                                                                <div data-v-58caae98="" class="couple-friendly-card" style="margin-top: 10px;">
                                                                    <span data-v-4323310d="" data-v-58caae98="" class="guest-tags-container">
                                                                        <span data-v-01d7cf4a="" data-v-4323310d="" class="hotel-guest-tag">
                                                                            <span data-v-01d7cf4a="" class="guest-type-tag for-couples">
                                                                                <svg data-v-01d7cf4a="" width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <use data-v-01d7cf4a="" xlink:href="#couple-tag"></use>
                                                                                </svg>
                                                                                Couple Friendly
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="image-gallery multiple-row" data-room-id="{{ $roomList->id }}"
                                                             onclick="loadRoomDetails({{ $roomList->id }})"
                                                             style="cursor: pointer;">
                                                            @php
                                                                // Prioritize main feature photo, then other categories in order
                                                                $photoOrder = [
                                                                    'feature_main',
                                                                    'bedroom',
                                                                    'bedroom2',
                                                                    'bedroom3',
                                                                    'living_dining',
                                                                    'washroom',
                                                                    'washroom2',
                                                                    'washroom3',
                                                                    'balcony',
                                                                    'furniture',
                                                                    'appliances',
                                                                    'kitchen',
                                                                    'amenity',
                                                                ];
                                                                $photosGrouped = $roomList->photos()->whereIn('category', $photoOrder)->get()->groupBy('category');
                                                                $orderedPhotos = collect($photoOrder)->flatMap(function($cat) use ($photosGrouped) {
                                                                    return $photosGrouped->get($cat, collect());
                                                                })->values();
                                                            @endphp

                                                            @foreach($orderedPhotos as $key => $feature)
                                                                @if($key == 0)
                                                                    {{-- Featured image (Main Feature Photo if available, otherwise next in order) --}}
                                                                    <div class="featured">
                                                                        {{-- Wishlist Heart Icon - top-right over featured image (stopPropagation prevents room-details drawer from opening) --}}
                                                                        <div class="wishlist-heart-icon wishlist-heart-icon-main" 
                                                                             data-room-id="{{ $roomList->id }}"
                                                                             onclick="event.stopPropagation(); event.preventDefault(); toggleWishlist({{ $roomList->id }}); return false;">
                                                                            <i class="fa fa-heart-o"></i>
                                                                        </div>
                                                                        <picture>
                                                                            <img src="{{ asset($feature->photo_path) }}" alt="Room" class="image-box">
                                                                        </picture>
                                                                    </div>
                                                                @elseif($key == 1 || $key == 2)
                                                                    {{-- Thumbnail images --}}
                                                                    <div class="thumb-image">
                                                                        <picture>
                                                                            <img src="{{ asset($feature->photo_path) }}" alt="Room" class="image-box">
                                                                        </picture>
                                                                    </div>
                                                                @elseif($key == 3)
                                                                    {{-- Overlay with remaining count --}}
                                                                    <div class="thumb-image">
                                                                        <div class="overlay">
                                                                            <span> +{{ $orderedPhotos->count() - 3 }} <i class="fas fa-images"></i></span>
                                                                        </div>
                                                                        <picture>
                                                                            <img src="{{ asset($feature->photo_path) }}" alt="Room" class="image-box">
                                                                        </picture>
                                                                    </div>
                                                                    @break
                                                                @endif
                                                            @endforeach

                                                        </div>

                                                        <div class="features fea-grid">
                                                            <small class="d-block">
                                                                <i style="color: #91278f; font-size: 18px;"
                                                                   class="fa fa-home"></i>Room Capacity: <b> {{ $roomList->total_persons ?? 'N/A' }} {{ $roomList->total_persons > 1 ? 'Adults' : 'Adult' }}
                                                                    Maximum </b> </small>


                                                            <small class="d-block">
                                                                <i style="color: #91278f; font-size: 18px;"
                                                                   class="fa fa-bed"></i>Bed: <b> {{ $roomList->total_beds ?? 'N/A' }} {{ $roomList->total_beds > 1 ? 'Beds' : 'Bed' }} </b> </small>
                                                            <!---->
                                                            @php
                                                                $displayOptions = $roomList->display_options ?? [];
                                                                $additionalInfo = $displayOptions['additional_info'] ?? [];
                                                                $laundryService = $additionalInfo['laundry_service'] ?? null;
                                                                $laundryServiceType = $additionalInfo['laundry_service_type'] ?? null;
                                                                $laundryFeeAmount = $additionalInfo['laundry_fee_amount'] ?? null;
                                                                $laundryFeeCurrency = $additionalInfo['laundry_fee_currency'] ?? 'BDT';
                                                                $laundryFeeUnit = $additionalInfo['laundry_fee_unit'] ?? 'Per Person';
                                                            @endphp
                                                            @if($laundryService === 'yes')
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-tint"></i>Laundry: <b>
                                                                        @if($laundryServiceType === 'complementary')
                                                                            Complementary (Free)
                                                                        @elseif($laundryServiceType === 'paid' && $laundryFeeAmount)
                                                                            {{ $laundryFeeAmount }} {{ $laundryFeeCurrency }} {{ $laundryFeeUnit }}
                                                                        @elseif($laundryServiceType === 'not_available')
                                                                            Not Available
                                                                        @else
                                                                            Available
                                                                        @endif
                                                                    </b>
                                                                </small>
                                                            @elseif($laundryFeeAmount)
                                                                {{-- Fallback for old data format --}}
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-tint"></i>Laundry: <b>{{ $laundryFeeAmount }} {{ $laundryFeeCurrency }} {{ $laundryFeeUnit }}</b></small>
                                                            @endif
                                                            @php
                                                                $housekeepingService = $additionalInfo['housekeeping_service'] ?? null;
                                                                $housekeepingServiceType = $additionalInfo['housekeeping_service_type'] ?? null;
                                                                $housekeepingFeeAmount = $additionalInfo['housekeeping_fee_amount'] ?? null;
                                                                $housekeepingFeeCurrency = $additionalInfo['housekeeping_fee_currency'] ?? 'BDT';
                                                                $housekeepingFeeUnit = $additionalInfo['housekeeping_fee_unit'] ?? 'Per Service';
                                                                $housekeepingType = $additionalInfo['housekeeping_type'] ?? null;
                                                            @endphp
                                                            @if($housekeepingService === 'yes')
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-broom"></i>Housekeeping: <b>
                                                                        @if($housekeepingServiceType === 'complementary')
                                                                            Complementary (Free)
                                                                        @elseif($housekeepingServiceType === 'paid' && $housekeepingFeeAmount)
                                                                            {{ $housekeepingFeeAmount }} {{ $housekeepingFeeCurrency }} {{ $housekeepingFeeUnit }}
                                                                        @elseif($housekeepingServiceType === 'not_available')
                                                                            Not Available
                                                                        @else
                                                                            Available
                                                                        @endif
                                                                    </b>
                                                                </small>
                                                            @elseif($housekeepingType)
                                                                {{-- Fallback for old data format --}}
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-broom"></i>Housekeeping: <b>{{ $housekeepingType }}</b></small>
                                                            @else
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-broom"></i>Housekeeping: <b>—</b></small>
                                                            @endif
                                                            @php
                                                                $parkingAvailability = $additionalInfo['parking_availability'] ?? null;
                                                                $parkingComplementaryNote = $additionalInfo['parking_complementary_note'] ?? null;
                                                                $parkingType = $additionalInfo['parking_type'] ?? null; // For backward compatibility
                                                                $parkingFeeAmount = $additionalInfo['parking_fee_amount'] ?? null;
                                                                $parkingFeeCurrency = $additionalInfo['parking_fee_currency'] ?? 'BDT';
                                                                $parkingFeeUnit = $additionalInfo['parking_fee_unit'] ?? 'Per Day';
                                                            @endphp
                                                            @if($parkingAvailability)
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-car"></i>Parking: <b>
                                                                        @if($parkingAvailability === 'available')
                                                                            Available - Complementary{{ !empty($parkingComplementaryNote) ? ' (' . $parkingComplementaryNote . ')' : '' }}
                                                                        @elseif($parkingAvailability === 'not_available')
                                                                            Not Available
                                                                        @endif
                                                                    </b>
                                                                </small>
                                                            @elseif($parkingType)
                                                                {{-- Fallback for old data format --}}
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-car"></i>Parking: <b>
                                                                        @if($parkingType === 'complementary')
                                                                            Available - Complementary (Free)
                                                                        @elseif($parkingType === 'paid' && $parkingFeeAmount)
                                                                            {{ $parkingFeeAmount }} {{ $parkingFeeCurrency }} {{ $parkingFeeUnit }}
                                                                        @elseif($parkingType === 'paid')
                                                                            Paid
                                                                        @elseif($parkingType === 'not_available')
                                                                            Not Available
                                                                        @endif
                                                                    </b>
                                                                </small>
                                                            @elseif(isset($additionalInfo['parking_availability']) && is_string($additionalInfo['parking_availability']) && $additionalInfo['parking_availability'] !== 'available' && $additionalInfo['parking_availability'] !== 'not_available')
                                                                {{-- Fallback for old string values --}}
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-car"></i>Parking: <b>{{ $additionalInfo['parking_availability'] }}@if($parkingFeeAmount) ({{ $parkingFeeAmount }} {{ $parkingFeeCurrency }} {{ $parkingFeeUnit }})@endif</b></small>
                                                            @else
                                                                {{-- Always show Parking row with icon for alignment; use — when no data --}}
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-car"></i>Parking: <b>—</b></small>
                                                            @endif
                                                            @php
                                                                $petType = $additionalInfo['pet_type'] ?? null;
                                                                $petFee = $additionalInfo['pet_fee'] ?? null;
                                                                $petPaidNote = $additionalInfo['pet_paid_note'] ?? null;
                                                                $petPolicy = $additionalInfo['pet_policy'] ?? null;
                                                            @endphp
                                                            @if($petType)
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-paw"></i>Pet Policy: <b>
                                                                        @if($petType === 'complementary')
                                                                            Complementary (Free)
                                                                        @elseif($petType === 'paid')
                                                                            Paid{{ !empty($petFee) ? ' (' . $petFee . ')' : '' }}{{ !empty($petPaidNote) ? ' - ' . $petPaidNote : '' }}
                                                                        @elseif($petType === 'not_available')
                                                                            Not Available
                                                                        @endif
                                                                    </b>
                                                                </small>
                                                            @elseif($petPolicy)
                                                                {{-- Fallback for old data format --}}
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-paw"></i>Pet Policy: <b>{{ $petPolicy }}@if($petFee) ({{ $petFee }})@endif</b></small>
                                                            @else
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-paw"></i>Pet Policy: <b>—</b></small>
                                                            @endif
                                                            @php
                                                                $mealType = $additionalInfo['meal_type'] ?? null;
                                                                $mealFee = $additionalInfo['meal_fee'] ?? null;
                                                                $mealOptions = $additionalInfo['meal_options'] ?? null;
                                                            @endphp
                                                            @if($mealType)
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-utensils"></i>Meal: <b>
                                                                        @if($mealType === 'complementary')
                                                                            Complementary (Free)
                                                                        @elseif($mealType === 'paid' && $mealFee)
                                                                            Paid ({{ $mealFee }})
                                                                        @elseif($mealType === 'paid')
                                                                            Paid
                                                                        @elseif($mealType === 'not_available')
                                                                            Not Available
                                                                        @endif
                                                                    </b>
                                                                </small>
                                                            @elseif($mealOptions)
                                                                {{-- Fallback for old data format --}}
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-utensils"></i>Meal: <b>{{ $mealOptions }}@if($mealFee) ({{ $mealFee }})@endif</b></small>
                                                            @else
                                                                <small class="d-block">
                                                                    <i style="color: #91278f; font-size: 18px;" class="fa fa-utensils"></i>Meal: <b>—</b></small>
                                                            @endif

                                                        </div>
                                                        <div class="show-amenities-modal mt-1 mb-2">
                                                            <span role="button" tabindex="0"><a href="javascript:void(0)"
                                                                                                onclick="loadRoomDetails({{ $roomList->id }})">  View Room Details</a> </span>
                                                        </div>

                                                    </div>



                                                    <!-- Room  Price Deatils -->
                                                    <div class="room-options">
                                                        <div data-v-798d4468="" class="option-card">

                                                            <div data-v-b6728cd0="" data-v-798d4468=""
                                                                 class="pricing-info">
                                                                <div class="review-main review-main-mb"
                                                                     style="margin-top: 10%;">
                                                                    @php
                                                                        $avgRating = isset($reviewStats['overall_avg']) && $reviewStats['overall_avg'] > 0 ? round((float) $reviewStats['overall_avg'], 1) : null;
                                                                        $roomSentiment = $avgRating >= 9 ? 'Exceptional' : ($avgRating >= 8 ? 'Fabulous' : ($avgRating >= 7 ? 'Very Good' : ($avgRating >= 6 ? 'Good' : ($avgRating >= 5 ? 'Average' : 'Rating'))));
                                                                    @endphp
                                                                    <div class="review-cat">{{ $avgRating !== null ? $roomSentiment : 'Rating' }}</div>
                                                                    <div class="review-cat-home">{{ $avgRating ?? '—' }}</div>
                                                                </div>
                                                                @php
                                                                    $originalPrice = (float) ($roomList->price_per_night ?? 0);
                                                                    $discountedPrice = $originalPrice;
                                                                    $discountPercentage = 0;
                                                                    
                                                                    if ($originalPrice > 0 && $roomList->discount_type == 'percentage' && $roomList->discount_percentage) {
                                                                        $discountPercentage = (float) $roomList->discount_percentage;
                                                                        $discountedPrice = $originalPrice - ($originalPrice * $discountPercentage / 100);
                                                                    } elseif ($originalPrice > 0 && $roomList->discount_type == 'amount' && $roomList->discount_amount) {
                                                                        $discountedPrice = max(0, $originalPrice - (float) $roomList->discount_amount);
                                                                        $discountPercentage = (($originalPrice - $discountedPrice) / $originalPrice) * 100;
                                                                    }
                                                                @endphp

                                                                @if($discountPercentage > 0)
                                                                <div data-v-b6728cd0=""
                                                                     class="discount-percentage mt-per-50">
                                                                    <span data-v-b6728cd0="" class="discount-tag"> {{ number_format($discountPercentage, 0) }}% off </span>
                                                                </div>
                                                                @endif
                                                                <!---->
                                                                <div data-v-b6728cd0="" class="price-amount" data-price-per-night="{{ $discountedPrice }}" data-room-id="{{ $roomList->id }}">
                                                                    @if($discountPercentage > 0)
                                                                    <span data-v-b6728cd0=""
                                                                          class="price-before-discount"> <del>BDT {{ number_format($originalPrice, 2) }}</del> </span>
                                                                    @endif
                                                                    @php
                                                                        $roomTotal = $discountedPrice * $searchNights;
                                                                    @endphp
                                                                    <span class="amount room-total-display">
                                                                        Total = BDT {{ number_format($roomTotal, 2) }}
                                                                        @if($searchNights > 0)
                                                                            for {{ $searchNights }} {{ $searchNights == 1 ? 'Night' : 'Nights' }}
                                                                        @endif
                                                                    </span>
                                                                    <p class="tax-tag">Fee or Tax will show at checkout (if any)</p>
                                                                </div>

                                                                <div data-v-b6728cd0="" class="price-per">BDT {{ number_format($discountedPrice, 2) }} per night</div>

                                                                @php
                                                                    // Check if Non-refundable is selected in room's cancellation_policy field
                                                                    $roomCancellationPolicyPricing = $roomList->cancellation_policy ?? [];
                                                                    if (is_string($roomCancellationPolicyPricing)) {
                                                                        $roomCancellationPolicyPricing = json_decode($roomCancellationPolicyPricing, true) ?: [];
                                                                    }
                                                                    if (!is_array($roomCancellationPolicyPricing)) {
                                                                        $roomCancellationPolicyPricing = [];
                                                                    }
                                                                    
                                                                    // Check if 'non_refundable' is in the cancellation_policy array
                                                                    $isNonRefundablePricing = in_array('non_refundable', $roomCancellationPolicyPricing);
                                                                @endphp
                                                                @if($isNonRefundablePricing)
                                                                <div class="option-meta option-meta-nr" style="margin-top: 8px; margin-bottom: 6px;">
                                                                    <span data-toggle="tooltip" class="non-refundable non-refundable-inline" data-bs-original-title="Regardless of the cancellation window, customers will not get any refund under this." style="white-space: nowrap; display: inline-flex; align-items: center; gap: 4px; font-size: 13px;">
                                                                        <i class="fa fa-info-circle" style="font-size: 12px;"></i> Non-Refundable
                                                                    </span>
                                                                </div>
                                                                @endif

                                                                <div class="quantity-btn {{ $nightsFromSearch ? 'nights-locked' : '' }}">
                                                                    <form action="">
                                                                        <p class="qty qty-room">
                                                                            @if($nightsFromSearch)
                                                                            <input type="number" name="qty" id="qty-{{ $roomList->id }}" readonly
                                                                                   min="1" max="{{ $roomList->total_rooms ?? 10 }}" step="1" value="{{ $searchNights }}"
                                                                                   data-room-id="{{ $roomList->id }}" data-price-per-night="{{ $discountedPrice }}" data-nights-locked="1">
                                                                            @else
                                                                            <input type="number" name="qty" id="qty-{{ $roomList->id }}"
                                                                                   min="1" max="{{ $roomList->total_rooms ?? 10 }}" step="1" value="{{ $searchNights }}"
                                                                                   data-room-id="{{ $roomList->id }}" data-price-per-night="{{ $discountedPrice }}">
                                                                            @endif
                                                                            <label style="padding-left: 15px;" for="qty-{{ $roomList->id }}" class="night-label">{{ $searchNights }} {{ $searchNights == 1 ? 'Night' : 'Nights' }}</label>
                                                                        </p>
                                                                    </form>
                                                                </div>

                                                                <div class="book_btn_2">
                                                                    <a href="javascript:void(0)" class="add-to-book-btn" role="button"
                                                                       data-room-id="{{ $roomList->id }}"
                                                                       data-room-name="{{ e($roomList->name) }}"
                                                                       data-price="{{ $discountedPrice ?? 0 }}"
                                                                       data-max-qty="{{ $roomList->total_rooms ?? 1 }}"
                                                                       data-capacity="{{ $roomList->total_persons ?? 2 }}"
                                                                       data-hotel-id="{{ $show->id ?? 0 }}">
                                                                        Add to<span> Book</span>
                                                                    </a>
                                                                </div>

                                                                <!---->
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                            @endif

                                        </div>


                                        <!--  -->
                                    </div>
                                </div>

                                <!-- Pricing Summary Sidebar -->
                                <div data-v-58caae98="" class="col-lg-3 pl-lg-0 mb-hide-cart">
                                    <div data-v-58caae98="" id="cart-bar" class="cart-visible" style="z-index: 1;">
                                        <div class="backdrop"></div>
                                        <div class="cart-wrapper">
                                            <div class="cart-header">
                                                <h2>Pricing Summary</h2>
                                            </div>
                                            <div class="rooms-selection-container">
                                                <div class="rooms">
                                                    <p class="text-center text-primary">Added Rooms</p>
                                                    <div id="cartItemsList">
                                                        <!-- Cart items will be added here dynamically -->
                                                    </div>
                                                </div>
                                                <div class="action">
                                                    <div class="total-amount">
                                                        <span class="amount" id="cartTotal">Total = BDT 0.00</span>
                                                        <p class="tax-tag">Fee or Tax Will show at the check out page (if any)</p>
                                                    </div>
                                                    <a href="javascript:void(0)" onclick="proceedToCheckout()">
                                                        <button type="button" class="btn btn-secondary total-con btn-block">CONTINUE</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room Deatails -->

                <!-- Room Data for Modal -->
                <script>
                    // Use global cart functions (from layout)
                    function addToCart(roomId, roomName, price, maxQuantity, capacity, hotelId) {
                        try {
                            roomId = Number(roomId);
                            const qtyInput = document.getElementById('qty-' + roomId);
                            let quantity = 1;
                            if (qtyInput && qtyInput.value !== '' && !isNaN(parseInt(qtyInput.value, 10))) {
                                quantity = Math.max(1, parseInt(qtyInput.value, 10));
                            }
                            maxQuantity = Math.max(1, parseInt(maxQuantity, 10) || 1);
                            capacity = Math.max(1, parseInt(capacity, 10) || 2);
                            hotelId = hotelId ? Number(hotelId) : null;
                            const priceNum = Number(price) || 0;

                            if (typeof addToGlobalCart !== 'function') {
                                console.error('addToGlobalCart is not defined. Layout cart script may not have loaded.');
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({ icon: 'error', title: 'Error', text: 'Booking cart is not ready. Please refresh the page.' });
                                } else {
                                    alert('Booking cart is not ready. Please refresh the page.');
                                }
                                return;
                            }

                            let roomNumber = null;
                            let floorNumber = null;
                            if (typeof roomsData !== 'undefined' && Array.isArray(roomsData)) {
                                const room = roomsData.find(r => Number(r.id) === roomId);
                                if (room) {
                                    roomNumber = room.number || null;
                                    floorNumber = room.floor_number || null;
                                }
                            }

                            const added = addToGlobalCart(roomId, String(roomName || 'Room'), priceNum, maxQuantity, quantity, capacity, hotelId, roomNumber, floorNumber);
                            if (!added) return;

                            // Store booking parameters from search form
                            const checkinEl = document.getElementById('checkInDate');
                            const checkoutEl = document.getElementById('checkoutDate');
                            const guestsEl = document.getElementById('guestsSelect');
                            const childrenEl = document.getElementById('childrenSelect');
                            const bookingParams = {
                                checkin: checkinEl ? checkinEl.value : '',
                                checkout: checkoutEl ? checkoutEl.value : '',
                                adults: guestsEl ? (parseInt(guestsEl.value, 10) || 0) : 0,
                                children: childrenEl ? (parseInt(childrenEl.value, 10) || 0) : 0,
                                infants: 0,
                                pets: 0
                            };
                            try {
                                localStorage.setItem('bookingParams', JSON.stringify(bookingParams));
                            } catch (e) {}

                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Added to Cart!',
                                    text: roomName + ' (' + quantity + ' Night' + (quantity > 1 ? 's' : '') + ') has been added to your booking cart.',
                                    confirmButtonColor: '#91278f',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        } catch (err) {
                            console.error('addToCart error:', err);
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({ icon: 'error', title: 'Could not add to cart', text: err.message || 'Please try again.' });
                            } else {
                                alert('Could not add to cart: ' + (err.message || 'Please try again.'));
                            }
                        }
                    }

                    function removeFromCart(roomId) {
                        removeFromGlobalCart(roomId);
                    }

                    // Delegate click for Add to Book buttons (uses data attributes - avoids JSON escaping issues)
                    document.addEventListener('DOMContentLoaded', function() {
                        document.body.addEventListener('click', function(e) {
                            const btn = e.target.closest('.add-to-book-btn');
                            if (!btn) return;
                            e.preventDefault();
                            e.stopPropagation();
                            const roomId = parseInt(btn.getAttribute('data-room-id'), 10);
                            const roomName = btn.getAttribute('data-room-name') || 'Room';
                            const price = parseFloat(btn.getAttribute('data-price')) || 0;
                            const maxQty = parseInt(btn.getAttribute('data-max-qty'), 10) || 1;
                            const capacity = parseInt(btn.getAttribute('data-capacity'), 10) || 2;
                            const hotelId = parseInt(btn.getAttribute('data-hotel-id'), 10) || 0;
                            addToCart(roomId, roomName, price, maxQty, capacity, hotelId);
                        });
                    });

                    @php
                        $roomsDataForJs = \App\Models\Room::where('hotel_id', $show->id)->where('is_active', true)->with('photos')->get()->map(function($room) {
                            return [
                                'id' => $room->id,
                                'name' => $room->name,
                                'number' => $room->number,
                                'floor_number' => $room->floor_number,
                                'couple_friendly' => (bool)($room->couple_friendly ?? false),
                                'price_per_night' => $room->price_per_night,
                                'weekend_price' => $room->weekend_price,
                                'holiday_price' => $room->holiday_price,
                                'discount_type' => $room->discount_type,
                                'discount_amount' => $room->discount_amount,
                                'discount_percentage' => $room->discount_percentage,
                                'total_persons' => $room->total_persons,
                                'total_rooms' => $room->total_rooms,
                                'total_washrooms' => $room->total_washrooms,
                                'total_beds' => $room->total_beds,
                                'size' => $room->size,
                                'description' => $room->description,
                                'wifi_details' => $room->wifi_details,
                                'appliances' => $room->appliances ?? [],
                                'furniture' => $room->furniture ?? [],
                                'amenities' => $room->amenities ?? [],
                                'cancellation_policy' => $room->cancellation_policy ?? [],
                                'display_options' => $room->display_options ?? [],
                                'availability_dates' => $room->availability_dates ?? [],
                                'photos' => $room->photos->groupBy('category')->map(function($photos) {
                                    return $photos->map(function($photo) {
                                        return $photo->photo_path;
                                    });
                                })
                            ];
                        })->values()->toArray();
                        $roomsDataJson = json_encode($roomsDataForJs, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                        if ($roomsDataJson === false) {
                            $roomsDataJson = '[]';
                        }
                        $roomsDataB64 = base64_encode($roomsDataJson);
                    @endphp
                    </script>
                    <script id="rooms-data-script" type="text/plain" data-b64="1">{!! $roomsDataB64 !!}</script>
                    <script>
                    var roomsData = (function() {
                        var el = document.getElementById('rooms-data-script');
                        if (!el || !el.getAttribute('data-b64')) return [];
                        try {
                            var jsonStr = atob(el.textContent.replace(/\s/g, ''));
                            return JSON.parse(jsonStr);
                        } catch(e) {
                            console.error('roomsData parse error', e);
                            return [];
                        }
                    })();

                    // Store current room for modal "Add to Book" button
                    let currentModalRoom = null;

                    function loadRoomDetails(roomId) {
                        roomId = Number(roomId);
                        const room = roomsData.find(r => Number(r.id) === roomId);
                        if (!room) return;

                        // Store for modal add to book button
                        currentModalRoom = room;

                        // Calculate discount
                        const originalPrice = parseFloat(room.price_per_night);
                        let discountedPrice = originalPrice;
                        let discountPercentage = 0;

                        if (room.discount_type === 'percentage' && room.discount_percentage) {
                            discountPercentage = parseFloat(room.discount_percentage);
                            discountedPrice = originalPrice - (originalPrice * discountPercentage / 100);
                        } else if (room.discount_type === 'amount' && room.discount_amount) {
                            discountedPrice = originalPrice - parseFloat(room.discount_amount);
                            discountPercentage = ((originalPrice - discountedPrice) / originalPrice) * 100;
                        }

                        // Store calculated price for modal button
                        room.calculatedPrice = discountedPrice;

                        // Update modal header - target modal specifically to avoid updating room cards
                        const modalTitle = document.querySelector('#rightSidebarModalDetails .room-title-modal');
                        if (modalTitle) {
                            modalTitle.textContent = room.name;
                        }
                        
                        const roomDescriptionEl = document.querySelector('#rightSidebarModalDetails .room-description-modal');
                        if (roomDescriptionEl) {
                            const desc = (room.description || '').toString().trim();
                            roomDescriptionEl.textContent = desc;
                            roomDescriptionEl.style.display = desc ? 'block' : 'none';
                        }
                        
                        // Update room numbers in modal (target modal specifically to avoid updating room cards)
                        const modalRoomNumbers = document.querySelector('#rightSidebarModalDetails .room-numbers');
                        if (modalRoomNumbers) {
                            // Format floor number with ordinal suffix
                            let floorText = '';
                            if (room.floor_number) {
                                const floorNum = parseInt(room.floor_number);
                                let suffix = 'th';
                                if (floorNum == 1) suffix = 'st';
                                else if (floorNum == 2) suffix = 'nd';
                                else if (floorNum == 3) suffix = 'rd';
                                floorText = `${floorNum}${suffix} Floor`;
                            }
                            modalRoomNumbers.innerHTML = `Room # ${room.number || 'N/A'}<br> <span style="padding-left:0px" class="floor-numbers">${floorText}</span>`;
                        }

                        // Update Non-Refundable badge in modal
                        const optionMeta = document.querySelector('#rightSidebarModalDetails .option-meta');
                        const nonRefundableBadge = document.querySelector('#rightSidebarModalDetails .option-meta .non-refundable');
                        
                        // Check if Non-refundable is selected in room's cancellation_policy field
                        // The form uses cancellation_policy[] with value 'non_refundable'
                        const roomCancellationPolicy = room.cancellation_policy || [];
                        const isNonRefundable = Array.isArray(roomCancellationPolicy) && roomCancellationPolicy.includes('non_refundable');
                        
                        if (optionMeta) {
                            if (isNonRefundable) {
                                // Show the option-meta container and badge
                                optionMeta.style.display = '';
                                if (nonRefundableBadge) {
                                    nonRefundableBadge.style.display = '';
                                } else {
                                    // Create badge if it doesn't exist (inline, no line break)
                                    optionMeta.innerHTML = `<span data-toggle="tooltip" class="non-refundable non-refundable-inline" data-bs-original-title="Regardless of the cancellation window, customers will not get any refund under this." style="white-space: nowrap; display: inline-flex; align-items: center; gap: 4px; font-size: 13px;"><i class="fa fa-info-circle" style="font-size: 12px;"></i> Non-Refundable</span>`;
                                }
                            } else {
                                // Hide badge if Non-refundable is not enabled
                                optionMeta.style.display = 'none';
                                if (nonRefundableBadge) {
                                    nonRefundableBadge.style.display = 'none';
                                }
                            }
                        }

                        // Update pricing - target modal specifically
                        const discountTagModal = document.querySelector('#rightSidebarModalDetails .discount-tag-modal');
                        const priceBeforeDiscountModal = document.querySelector('#rightSidebarModalDetails .price-before-discount-modal');
                        const discountPriceModal = document.querySelector('#rightSidebarModalDetails .discount-price-modal');
                        const modalTotalNightsText = document.querySelector('#rightSidebarModalDetails .modal-total-nights-text');
                        
                        if (discountPercentage > 0) {
                            if (discountTagModal) discountTagModal.style.display = 'block';
                            const discountTag = document.querySelector('#rightSidebarModalDetails .discount-tag-modal .discount-tag');
                            if (discountTag) discountTag.textContent = Math.round(discountPercentage) + '% off';
                            if (priceBeforeDiscountModal) priceBeforeDiscountModal.innerHTML = `<del>BDT ${originalPrice.toFixed(2)}</del>`;
                            if (discountPriceModal) discountPriceModal.textContent = `BDT ${discountedPrice.toFixed(2)}`;
                        } else {
                            if (discountTagModal) discountTagModal.style.display = 'none';
                            if (priceBeforeDiscountModal) priceBeforeDiscountModal.textContent = '';
                            if (discountPriceModal) discountPriceModal.textContent = `BDT ${originalPrice.toFixed(2)}`;
                        }

                        // Update modal total text using current nights (default 1; will sync from search state if present)
                        let modalNights = 1;
                        if (typeof searchState !== 'undefined' && searchState.nights && searchState.nights > 0) {
                            modalNights = searchState.nights;
                        }
                        const modalTotal = discountedPrice * modalNights;
                        if (modalTotalNightsText) {
                            modalTotalNightsText.textContent = `Total = BDT ${modalTotal.toFixed(2)} for ${modalNights} Night${modalNights > 1 ? 's' : ''}`;
                        }

                        // Update quantity max value
                        document.querySelector('#rightSidebarModalDetails #qty').setAttribute('max', room.total_rooms || 10);

                        // Update modal "Add to Book" button
                        const modalAddBtn = document.getElementById('modalAddToBookBtn');
                        if (modalAddBtn) {
                            modalAddBtn.onclick = function(e) {
                                e.preventDefault();
                                if (typeof addToGlobalCart !== 'function') {
                                    if (typeof Swal !== 'undefined') Swal.fire({ icon: 'error', title: 'Error', text: 'Booking cart is not ready. Please refresh the page.' });
                                    else alert('Booking cart is not ready. Please refresh the page.');
                                    return;
                                }
                                const modalQty = document.querySelector('#rightSidebarModalDetails #qty');
                                const quantity = modalQty ? parseInt(modalQty.value) : 1;
                                
                                if (addToGlobalCart(Number(room.id), room.name, Number(discountedPrice) || 0, room.total_rooms || 1, quantity, room.total_persons || 2, {{ $show->id ?? 0 }}, room.number || null, room.floor_number || null)) {
                                    // Close modal first
                                    const modalElement = document.getElementById('rightSidebarModalDetails');
                                    if (modalElement) {
                                        const modal = bootstrap.Modal.getInstance(modalElement);
                                        if (modal) modal.hide();
                                    }
                                    
                                    // Then show success message
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Added to Cart!',
                                        text: `${room.name} (${quantity} Night${quantity > 1 ? 's' : ''}) has been added to your booking cart.`,
                                        confirmButtonColor: '#91278f',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                }
                            };
                        }

                        // Update Room Photos
                        updateRoomPhotos(room.photos);

                        // Update Facilities
                        updateRoomFacilities(room);

                        // Update Room Details
                        updateRoomDetailsTab(room);

                        // Open the room-details modal here so that clicking the wishlist heart (which stops propagation) does not open it
                        const modalEl = document.getElementById('rightSidebarModalDetails');
                        if (modalEl && typeof bootstrap !== 'undefined') {
                            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                            modal.show();
                        }
                    }

                    function updateRoomPhotos(photos) {
                        const photoContainer = document.querySelector('#hotel-room .all-rooms-details .row');
                        photoContainer.innerHTML = '';

                        // New photo categories including the Main Feature Photo
                        const categories = [
                            'feature_main',
                            'bedroom',
                            'washroom',
                            'balcony',
                            'living_dining',
                            'furniture',
                            'appliances',
                            'kitchen',
                            'amenity',
                            'bedroom2',
                            'bedroom3',
                            'washroom2',
                            'washroom3',
                        ];

                        let hasPhotos = false;

                        // Show main feature photo first (if any)
                        if (photos['feature_main'] && photos['feature_main'].length > 0) {
                            photos['feature_main'].forEach(photoPath => {
                                const div = document.createElement('div');
                                div.className = 'col-12 luxury-room-block';
                                div.style.cssText = 'margin-bottom: 15px;';
                                div.innerHTML = `<img class="img-fluid" src="/${photoPath}" alt="main-feature-photo" style="width: 100%; height: 300px; object-fit: cover; border-radius: 8px;">`;
                                photoContainer.appendChild(div);
                                hasPhotos = true;
                            });
                        }

                        // Show remaining categories
                        categories.filter(cat => cat !== 'feature_main').forEach(category => {
                            if (photos[category]) {
                                photos[category].forEach(photoPath => {
                                    const div = document.createElement('div');
                                    div.className = 'col-6 col-md-6 luxury-room-block';
                                    div.style.cssText = 'margin-bottom: 15px;';
                                    div.innerHTML = `<img class="img-fluid" src="/${photoPath}" alt="${category}-photo" style="width: 100%; height: 300px; object-fit: cover; border-radius: 8px;">`;
                                    photoContainer.appendChild(div);
                                    hasPhotos = true;
                                });
                            }
                        });

                        if (!hasPhotos) {
                            photoContainer.innerHTML = '<div class="col-12"><p class="text-center">No photos available</p></div>';
                        }
                    }

                    function updateRoomFacilities(room) {
                        const facilitiesContainer = document.querySelector('#facility .facilities-flex');
                        facilitiesContainer.innerHTML = '';

                        // Appliances
                        if (room.appliances && room.appliances.length > 0) {
                            facilitiesContainer.innerHTML += generateFacilityColumn('Appliances Information', room.appliances, 'fa-bed fa-bed-custom');
                        }

                        // Furniture
                        if (room.furniture && room.furniture.length > 0) {
                            facilitiesContainer.innerHTML += generateFacilityColumn('Furniture Information', room.furniture, 'fa-bed fa-bed-custom');
                        }

                        // Amenities
                        if (room.amenities && room.amenities.length > 0) {
                            facilitiesContainer.innerHTML += generateFacilityColumn('Room Amenities', room.amenities, 'fa-bed fa-bed-custom');
                        }
                    }

                    function generateFacilityColumn(title, items, icon) {
                        let html = `<div data-v-58caae98="" class="facilities-column">
                            <h3 data-v-58caae98="" class="general-title">
                                <span class="faci-icon-awe"><i class="fa ${icon}"></i></span> ${title}
                            </h3>
                            <ul data-v-58caae98="" class="general-facilities-list">`;
                        
                        items.forEach(item => {
                            html += `<li data-v-58caae98="">
                                <span>
                                    <svg style="color: #91278f; margin-top: -3px; margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                    </svg>
                                </span>
                                ${item}
                            </li>`;
                        });
                        
                        html += `</ul></div>`;
                        return html;
                    }

                    function updateRoomDetailsTab(room) {
                        const detailsModal = document.querySelector('#others .room-details-modal');
                        
                        // Description section
                        const description = room.description || 'This room offers a comfortable and relaxing stay with modern amenities and excellent service.';
                        
                        // Get display_options data
                        const displayOptions = room.display_options || {};
                        const roomInfo = displayOptions.room_info || {};
                        const additionalInfo = displayOptions.additional_info || {};
                        
                        // Room Information (Left column)
                        const roomInfoList = [];
                        
                        // Basic room specifications
                        if (room.size) roomInfoList.push(`Room Size: ${room.size} sq ft`);
                        if (room.wifi_details) roomInfoList.push(`WiFi: ${room.wifi_details}`);
                        
                        // Room Facilities & Amenities (stored in appliances field)
                        if (room.appliances && Array.isArray(room.appliances) && room.appliances.length > 0) {
                            roomInfoList.push(...room.appliances);
                        }
                        
                        // Bed Details
                        if (roomInfo.bed_type) {
                            let bedInfo = `Bed Type: ${roomInfo.bed_type}`;
                            if (roomInfo.number_of_beds) {
                                bedInfo += ` (${roomInfo.number_of_beds} bed${roomInfo.number_of_beds > 1 ? 's' : ''})`;
                            }
                            roomInfoList.push(bedInfo);
                        }
                        if (roomInfo.custom_bed_types && Array.isArray(roomInfo.custom_bed_types) && roomInfo.custom_bed_types.length > 0) {
                            roomInfo.custom_bed_types.forEach(bedType => {
                                if (bedType) roomInfoList.push(bedType);
                            });
                        }
                        
                        // Maximum Occupancy
                        if (roomInfo.max_adults || roomInfo.max_children) {
                            let occupancy = 'Maximum Occupancy: ';
                            if (roomInfo.max_adults) occupancy += `${roomInfo.max_adults} Adult${roomInfo.max_adults > 1 ? 's' : ''}`;
                            if (roomInfo.max_adults && roomInfo.max_children) occupancy += ', ';
                            if (roomInfo.max_children) occupancy += `${roomInfo.max_children} Child${roomInfo.max_children > 1 ? 'ren' : ''}`;
                            roomInfoList.push(occupancy);
                        }
                        
                        // Layout Details
                        if (roomInfo.layout && Array.isArray(roomInfo.layout) && roomInfo.layout.length > 0) {
                            roomInfoList.push(...roomInfo.layout);
                        }
                        
                        // View from the Room
                        if (roomInfo.view && Array.isArray(roomInfo.view) && roomInfo.view.length > 0) {
                            roomInfoList.push(...roomInfo.view);
                        }
                        
                        // Bathroom Details
                        if (roomInfo.bathroom && Array.isArray(roomInfo.bathroom) && roomInfo.bathroom.length > 0) {
                            roomInfoList.push(...roomInfo.bathroom);
                        }
                        
                        // Kitchen Facilities
                        if (roomInfo.kitchen_facilities && Array.isArray(roomInfo.kitchen_facilities) && roomInfo.kitchen_facilities.length > 0) {
                            roomInfoList.push(...roomInfo.kitchen_facilities);
                        }
                        
                        // Balcony / Terrace
                        if (roomInfo.balcony) {
                            roomInfoList.push(`Balcony / Terrace: ${roomInfo.balcony}`);
                        }
                        
                        // Accessibility Features
                        if (roomInfo.accessibility && Array.isArray(roomInfo.accessibility) && roomInfo.accessibility.length > 0) {
                            roomInfoList.push(...roomInfo.accessibility);
                        }
                        
                        // Smoking Policy
                        if (roomInfo.smoking_policy) {
                            roomInfoList.push(`Smoking Policy: ${roomInfo.smoking_policy}`);
                        }
                        
                        // Fallback to old structure if display_options is not available
                        if (roomInfoList.length === 0) {
                            if (room.size) roomInfoList.push(`Room Size: ${room.size} sq ft`);
                            if (room.wifi_details) roomInfoList.push(`WiFi: ${room.wifi_details}`);
                        if (room.appliances && room.appliances.length > 0) {
                                roomInfoList.push(...room.appliances);
                            }
                        }
                        
                        // Additional Room Information (Right column)
                        const additionalInfoList = [];
                        
                        // Additional Bed Policy & Fee
                        if (additionalInfo.bed_fee_amount || additionalInfo.bed_policy_amount) {
                            const amount = additionalInfo.bed_fee_amount || additionalInfo.bed_policy_amount;
                            const currency = additionalInfo.bed_fee_currency || additionalInfo.bed_policy_currency || 'BDT';
                            const unit = additionalInfo.bed_fee_unit || additionalInfo.bed_policy_unit || 'Per Bed';
                            additionalInfoList.push(`Additional Bed: ${amount} ${currency} ${unit}`);
                        }
                        
                        // Children & Extra Guest Policy
                        if (additionalInfo.children_free_age) {
                            additionalInfoList.push(`Children under ${additionalInfo.children_free_age} stay free`);
                        }
                        if (additionalInfo.extra_adult_charge) {
                            additionalInfoList.push(`Extra Adult Charge: ${additionalInfo.extra_adult_charge}`);
                        }
                        
                        // Laundry Service
                        if (additionalInfo.laundry_service === 'yes') {
                            if (additionalInfo.laundry_service_type === 'complementary') {
                                additionalInfoList.push('Laundry Service: Complementary (Free)');
                            } else if (additionalInfo.laundry_service_type === 'paid') {
                                if (additionalInfo.laundry_fee_amount) {
                                    const currency = additionalInfo.laundry_fee_currency || 'BDT';
                                    const unit = additionalInfo.laundry_fee_unit || 'Per Person';
                                    additionalInfoList.push(`Laundry Service: ${additionalInfo.laundry_fee_amount} ${currency} ${unit}`);
                                } else {
                                    additionalInfoList.push('Laundry Service: Paid (Fee amount not specified)');
                                }
                            } else if (additionalInfo.laundry_service_type === 'not_available') {
                                additionalInfoList.push('Laundry Service: Not Available');
                            } else {
                                // Type not selected yet, show as available
                                additionalInfoList.push('Laundry Service: Available');
                            }
                        } else if (additionalInfo.laundry_service === 'no') {
                            // Don't show anything if laundry service is explicitly set to 'no'
                        } else if (additionalInfo.laundry_fee_amount) {
                            // Fallback for old data format (backward compatibility)
                            const currency = additionalInfo.laundry_fee_currency || 'BDT';
                            const unit = additionalInfo.laundry_fee_unit || 'Per Person';
                            additionalInfoList.push(`Laundry Service: ${additionalInfo.laundry_fee_amount} ${currency} ${unit}`);
                        }
                        
                        // Housekeeping & Cleaning Policy
                        if (additionalInfo.housekeeping_service === 'yes') {
                            if (additionalInfo.housekeeping_service_type === 'complementary') {
                                additionalInfoList.push('Housekeeping: Complementary (Free)');
                            } else if (additionalInfo.housekeeping_service_type === 'paid') {
                                if (additionalInfo.housekeeping_fee_amount) {
                                    const currency = additionalInfo.housekeeping_fee_currency || 'BDT';
                                    const unit = additionalInfo.housekeeping_fee_unit || 'Per Service';
                                    additionalInfoList.push(`Housekeeping: ${additionalInfo.housekeeping_fee_amount} ${currency} ${unit}`);
                                } else {
                                    additionalInfoList.push('Housekeeping: Paid (Fee amount not specified)');
                                }
                            } else if (additionalInfo.housekeeping_service_type === 'not_available') {
                                additionalInfoList.push('Housekeeping: Not Available');
                            } else {
                                // Type not selected yet, show as available
                                additionalInfoList.push('Housekeeping: Available');
                            }
                        } else if (additionalInfo.housekeeping_service === 'no') {
                            // Don't show anything if housekeeping service is explicitly set to 'no'
                        } else if (additionalInfo.housekeeping_type) {
                            // Fallback for old data format (backward compatibility)
                            additionalInfoList.push(`Housekeeping: ${additionalInfo.housekeeping_type}`);
                        }
                        
                        // Check-in & Check-out Policy
                        if (additionalInfo.checkin_time || additionalInfo.checkout_time) {
                            let checkinout = 'Check-in/out: ';
                            if (additionalInfo.checkin_time) checkinout += `Check-in ${additionalInfo.checkin_time}`;
                            if (additionalInfo.checkin_time && additionalInfo.checkout_time) checkinout += ', ';
                            if (additionalInfo.checkout_time) checkinout += `Check-out ${additionalInfo.checkout_time}`;
                            additionalInfoList.push(checkinout);
                        }
                        if (additionalInfo.late_checkout_fee) {
                            additionalInfoList.push(`Late Check-out Fee: ${additionalInfo.late_checkout_fee}`);
                        }
                        if (additionalInfo.early_checkin_fee) {
                            additionalInfoList.push(`Early Check-in Fee: ${additionalInfo.early_checkin_fee}`);
                        }
                        
                        // Security Deposit Requirement
                        if (additionalInfo.security_deposit_required === 'yes' || additionalInfo.security_deposit_amount) {
                            if (additionalInfo.security_deposit_amount) {
                                let deposit = `Security Deposit: ${additionalInfo.security_deposit_amount}`;
                                if (additionalInfo.security_deposit_refundable) {
                                    deposit += ` - ${additionalInfo.security_deposit_refundable}`;
                                }
                                additionalInfoList.push(deposit);
                            } else if (additionalInfo.security_deposit_required === 'yes') {
                                additionalInfoList.push('Security Deposit: Required (Amount not specified)');
                            }
                        }
                        
                        // Parking Availability
                        if (additionalInfo.parking_availability) {
                            let parking = '';
                            if (additionalInfo.parking_availability === 'available') {
                                if (additionalInfo.parking_complementary_note) {
                                    parking = `Parking: Available - Complementary (${additionalInfo.parking_complementary_note})`;
                                } else {
                                    parking = 'Parking: Available - Complementary';
                                }
                            } else if (additionalInfo.parking_availability === 'not_available') {
                                parking = 'Parking: Not Available';
                            }
                            if (parking) additionalInfoList.push(parking);
                        } else if (additionalInfo.parking_type) {
                            // Backward compatibility for old format
                            let parking = '';
                            if (additionalInfo.parking_type === 'complementary') {
                                parking = 'Parking: Available - Complementary (Free)';
                            } else if (additionalInfo.parking_type === 'paid') {
                                if (additionalInfo.parking_fee_amount) {
                                    const currency = additionalInfo.parking_fee_currency || 'BDT';
                                    const unit = additionalInfo.parking_fee_unit || 'Per Day';
                                    parking = `Parking: ${additionalInfo.parking_fee_amount} ${currency} ${unit}`;
                                } else {
                                    parking = 'Parking: Paid';
                                }
                            } else if (additionalInfo.parking_type === 'not_available') {
                                parking = 'Parking: Not Available';
                            }
                            if (parking) additionalInfoList.push(parking);
                        } else if (additionalInfo.parking_availability && typeof additionalInfo.parking_availability === 'string' && additionalInfo.parking_availability !== 'available' && additionalInfo.parking_availability !== 'not_available') {
                            // Backward compatibility for old string values
                            let parking = `Parking: ${additionalInfo.parking_availability}`;
                            if (additionalInfo.parking_fee_amount || additionalInfo.parking_charge_amount) {
                                const amount = additionalInfo.parking_fee_amount || additionalInfo.parking_charge_amount;
                                parking += ` (${amount} ${additionalInfo.parking_fee_unit || additionalInfo.parking_charge_unit || 'Per Day'})`;
                            }
                            additionalInfoList.push(parking);
                        }
                        
                        // Pet Policy
                        if (additionalInfo.pet_type) {
                            let pet = '';
                            if (additionalInfo.pet_type === 'complementary') {
                                pet = 'Pet Policy: Complementary (Free)';
                            } else if (additionalInfo.pet_type === 'paid') {
                                pet = 'Pet Policy: Paid';
                                if (additionalInfo.pet_fee) {
                                    pet += ` (${additionalInfo.pet_fee})`;
                                }
                                if (additionalInfo.pet_paid_note) {
                                    pet += ` - ${additionalInfo.pet_paid_note}`;
                                }
                            } else if (additionalInfo.pet_type === 'not_available') {
                                pet = 'Pet Policy: Not Available';
                            }
                            if (pet) additionalInfoList.push(pet);
                        } else if (additionalInfo.pet_policy) {
                            // Backward compatibility
                            let pet = `Pet Policy: ${additionalInfo.pet_policy}`;
                            if (additionalInfo.pet_fee) {
                                pet += ` (Fee: ${additionalInfo.pet_fee})`;
                            }
                            additionalInfoList.push(pet);
                        }
                        
                        // Meal Options
                        if (additionalInfo.meal_type) {
                            let meal = '';
                            if (additionalInfo.meal_type === 'complementary') {
                                meal = 'Meal: Complementary (Free)';
                            } else if (additionalInfo.meal_type === 'paid') {
                                if (additionalInfo.meal_fee) {
                                    meal = `Meal: Paid (${additionalInfo.meal_fee})`;
                                } else {
                                    meal = 'Meal: Paid';
                                }
                            } else if (additionalInfo.meal_type === 'not_available') {
                                meal = 'Meal: Not Available';
                            }
                            if (meal) additionalInfoList.push(meal);
                        } else if (additionalInfo.meal_options) {
                            // Backward compatibility
                            let meal = `Meal: ${additionalInfo.meal_options}`;
                            if (additionalInfo.meal_fee) {
                                meal += ` (Fee: ${additionalInfo.meal_fee})`;
                            }
                            additionalInfoList.push(meal);
                        }
                        
                        // Transportation Services
                        if (additionalInfo.airport_pickup || additionalInfo.airport_pickup_status) {
                            const status = additionalInfo.airport_pickup || additionalInfo.airport_pickup_status;
                            let transport = `Airport Pickup: ${status}`;
                            if (additionalInfo.airport_pickup_fee) {
                                transport += ` (${additionalInfo.airport_pickup_fee})`;
                            }
                            additionalInfoList.push(transport);
                        }
                        if (additionalInfo.shuttle_service || additionalInfo.shuttle_service_status) {
                            const status = additionalInfo.shuttle_service || additionalInfo.shuttle_service_status;
                            let transport = `Shuttle Service: ${status}`;
                            if (additionalInfo.shuttle_service_fee) {
                                transport += ` (${additionalInfo.shuttle_service_fee})`;
                            }
                            additionalInfoList.push(transport);
                        }
                        if (additionalInfo.car_rental || additionalInfo.car_rental_status) {
                            const status = additionalInfo.car_rental || additionalInfo.car_rental_status;
                            let transport = `Car Rental: ${status}`;
                            if (additionalInfo.car_rental_fee) {
                                transport += ` (${additionalInfo.car_rental_fee})`;
                            }
                            additionalInfoList.push(transport);
                        }
                        
                        // Extract other_charges separately for "Others Information" section
                        const otherCharges = additionalInfo.other_charges || '';
                        
                        // Fallback to old structure if display_options is not available
                        if (additionalInfoList.length === 0) {
                            if (room.furniture && room.furniture.length > 0) {
                                additionalInfoList.push(...room.furniture);
                            }
                            if (room.amenities && room.amenities.length > 0) {
                                additionalInfoList.push(...room.amenities);
                            }
                        if (room.cancellation_policy && room.cancellation_policy.length > 0) {
                                additionalInfoList.push(...room.cancellation_policy.map(policy => `Policy: ${policy}`));
                            }
                        }
                        
                        // Generate Others Information section if other_charges exists
                        const othersInformationSection = otherCharges ? `
                            <div class="row mt-4" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                <div class="col-md-12">
                                    <div data-v-58caae98="" class="facilities-column">
                                        <h3 data-v-58caae98="" class="general-title">
                                            <span class="faci-icon-awe"><i class="fa fa-bed fa-bed-custom"></i></span> Other Information
                                        </h3>
                                        <div style="color: #495057; line-height: 1.6; margin-top: 10px; white-space: pre-wrap;">${otherCharges}</div>
                                    </div>
                                </div>
                            </div>
                        ` : '';
                        
                        detailsModal.innerHTML = `
                            <div data-v-58caae98="" class="facilities-flex">
                                ${generateDetailsColumn('Room Information', roomInfoList, 'fa-bed fa-bed-custom')}
                                ${generateDetailsColumn('Additional Room Information', additionalInfoList, 'fa-bed fa-bed-custom')}
                            </div>
                            ${othersInformationSection}
                        `;
                    }
                    
                    function generateDetailsColumn(title, items, icon) {
                        if (!items || items.length === 0) return '';
                        
                        return `
                            <div data-v-58caae98="" class="facilities-column">
                                <h3 data-v-58caae98="" class="general-title">
                                    <span class="faci-icon-awe"><i class="fa ${icon}"></i></span> ${title}
                                </h3>
                                <ul data-v-58caae98="" class="general-facilities-list">
                                    ${items.map(item => `
                                        <li data-v-58caae98="">
                                            <span>
                                                <svg style="color: #91278f; margin-top: -3px; margin-right: 10px;" 
                                                     xmlns="http://www.w3.org/2000/svg" width="14" height="14" 
                                                     fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                                </svg>
                                            </span>
                                            ${item}
                                        </li>
                                    `).join('')}
                                </ul>
                            </div>
                        `;
                    }

                    // Wishlist Functions
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
                                    text: 'Please login to add items to your wishlist',
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
                            
                            const heartIcon = document.querySelector(`.wishlist-heart-icon[data-room-id="${roomId}"]`);
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
                    
                    // Check wishlist status on page load
                    function checkWishlistStatus() {
                        const heartIcons = document.querySelectorAll('.wishlist-heart-icon');
                        heartIcons.forEach(icon => {
                            const roomId = icon.getAttribute('data-room-id');
                            fetch(`{{ route("wishlist.check") }}?room_id=${roomId}`, {
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
                                console.error('Error checking wishlist:', error);
                            });
                        });
                    }
                    
                    document.addEventListener('DOMContentLoaded', function () {
                        // Check wishlist status for all rooms
                        checkWishlistStatus();
                        
                        // Handle quantity input for all rooms (no +/- buttons)
                        function updateRoomTotalAndLabel(roomId) {
                            const qtyInput = document.getElementById('qty-' + roomId);
                            if (!qtyInput) return;
                            const qty = Math.max(1, parseInt(qtyInput.value, 10) || 1);
                            const pricePerNight = parseFloat(qtyInput.getAttribute('data-price-per-night')) || 0;
                            const total = (pricePerNight * qty).toFixed(2);
                            const card = qtyInput.closest('.hotel-all-card');
                            if (card) {
                                const totalDisplay = card.querySelector('.room-total-display');
                                if (totalDisplay) totalDisplay.textContent = 'Total = BDT ' + Number(total).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                                const nightLabel = card.querySelector('.night-label');
                                if (nightLabel) nightLabel.textContent = qty + ' ' + (qty === 1 ? 'Night' : 'Nights');
                            }
                        }

                        document.querySelectorAll('input[id^="qty-"]').forEach(function (input) {
                            input.addEventListener('input', function () {
                                const roomId = input.getAttribute('data-room-id') || input.id.replace('qty-', '');
                                updateRoomTotalAndLabel(roomId);
                            });
                            input.addEventListener('change', function () {
                                const roomId = input.getAttribute('data-room-id') || input.id.replace('qty-', '');
                                let val = parseInt(input.value, 10);
                                if (isNaN(val) || val < 1) { input.value = 1; val = 1; }
                                const max = parseInt(input.getAttribute('max'), 10);
                                if (max && val > max) { input.value = max; val = max; }
                                updateRoomTotalAndLabel(roomId);
                            });
                        });
                    });

                </script>


                <!-- Nearby Location -->
                <div id="Nearby" class="row">
                    <div class="col-md-12">
                        <div data-v-58caae98="" id="description" class="hotel-description room-section">
                            <h3 data-v-58caae98="" class="nearby-title"> What's Nearby </h3>
                            <div data-v-58caae98="" class="hotel-location-details">
                                <div data-v-58caae98="" class="map-container">
                                    <div class="location-map">


                                        <iframe id="dynamicMap" width="100%" height="250" style="border:0;" allowfullscreen loading="lazy"></iframe>

                                        <script>
                                            const lat = {!! json_encode($show->lati ?? 0) !!};
                                            const lng = {!! json_encode($show->longi ?? 0) !!};
                                            const mapUrl = `https://www.google.com/maps?q=${lat},${lng}&z=15&output=embed`;

                                            document.getElementById('dynamicMap').src = mapUrl;
                                        </script>



                                    </div>
                                </div>
                                <div data-v-58caae98="" class="nearby-places">
                                    <div data-v-58caae98="" class="nearby-flex">


                                        @foreach(($show->nearby_areas ?? []) as $category => $data)
                                            @php
                                                // Format the category title nicely
                                                $title = ucwords(str_replace('___', ' & ', str_replace('_', ' ', $category)));
                                            @endphp

                                            <div class="facilities-column">
                                                <h3 class="place-title">
                                                    {{ $title }}
                                                </h3>
                                                <ul class="place-facilities-list">
                                                    @foreach(($data['name'] ?? []) as $index => $name)
                                                        <li>
                    <span>
                        <svg style="margin-top: -3px; margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14"
                             height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </span>
                                                            {{ $name }} - {{ $data['distance'][$index] ?? '' }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach


                                    </div>


                                    <!-- <div data-v-58caae98="" class="interest-points-wrapper">
                                       <h6 data-v-58caae98="" class="title"> Interest Points </h6>
                                       <div data-v-58caae98="" class="places">
                                          <span data-v-58caae98="">
                                          <i data-v-58caae98="" class="icon icon-map-marker-grey location-pin"></i> 16.5 km from Himchori Waterfall </span>
                                       </div>
                                    </div>
                                    <div data-v-58caae98="" class="nearby-terminals-wrapper">
                                       <h6 data-v-58caae98="" class="title"> Nearby Terminals </h6>
                                       <div data-v-58caae98="" class="places">
                                          <span data-v-58caae98="">
                                          <i data-v-58caae98="" class="icon icon-map-marker-grey location-pin"></i> 0.25 km from Navy Jetty, from where Saint Martin bound ship sails </span>
                                       </div>
                                       <div data-v-58caae98="" class="places">
                                          <span data-v-58caae98="">
                                          <i data-v-58caae98="" class="icon icon-map-marker-grey location-pin"></i> 3.2 km from Cox's Bazar Airport </span>
                                       </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Location -->
                <!-- Most Popular Facilities -->
                <!-- <section class="most-popular-wrapper">
                   <div class="container">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="most-popular">
                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                   tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                   consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                   cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                   proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                               </div>
                           </div>
                       </div>
                   </div>
                   </section>  -->
                <!-- Most Popular Facilities -->
                <!-- Facilities -->
                <div data-v-58caae98="" id="facilities" class="hotel-facilities room-section">
                    <h3 data-v-58caae98="" class="facility-title">
                        Facilities of Hotel Sea Palace
                    </h3>


                    <div data-v-58caae98="" class="facility-wrapper">
                        <div data-v-58caae98="" class="facility-container">

                            <div data-v-58caae98="" class="facilities-flex">

                                @php
                                    $facilitiesRaw = $show->hotel_facilities ?? null;
                                    if (is_string($facilitiesRaw)) {
                                        $facilities = json_decode($facilitiesRaw, true) ?? [];
                                    } elseif (is_array($facilitiesRaw)) {
                                        $facilities = $facilitiesRaw;
                                    } else {
                                        $facilities = [];
                                    }

                                    // Group facilities by category
                                    $groupedFacilities = collect($facilities)->groupBy('category');
                                @endphp

                                @foreach($groupedFacilities as $category => $items)
                                    <div data-v-58caae98="" class="facilities-column">
                                        <h3 data-v-58caae98="" class="general-title">
                                            {{ ucwords(str_replace(['___', '_'], [' & ', ' '], $category)) }}
                                        </h3>
                                        <ul data-v-58caae98="" class="general-facilities-list">
                                            @foreach(($items ?? []) as $facility)
                                                <li data-v-58caae98="">
                    <span>
                        <svg style="color: #91278f; margin-top: -3px; margin-right: 10px;"
                             xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                             class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                    </span>
                                                    {{ $facility['name'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach


                            </div>
                        </div>


                    </div>
                </div>
                <!-- Facilities -->


                <!-- Right Sidebar Modal  review-->
                <div class="modal fade right" id="rightSidebarModal" tabindex="-1"
                     aria-labelledby="rightSidebarModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-custom">
                        <div class="modal-content">
                            <div class="modal-header modal-header-review">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body modal-body-review">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Review Header -->
                                        <div class="row mb-20">
                                            <div class="col-lg-7">
                                                <div class="review-name-left">
                                                    <h2>Guest reviews</h2>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="group-select-label">
                                                    <h3 class="sort-review-title">Sort reviews by:</h3>
                                                    <select id="reviewSortSelect" class="form-select max-w-180" aria-label="Default select example">
                                                        <option value="most_relevant" selected>Most Relevant</option>
                                                        <option value="newest">Newest</option>
                                                        <option value="oldest">Oldest</option>
                                                        <option value="highest_rating">High Rate</option>
                                                        <option value="lowest_rating">Low Rate</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr class="b9bfeba2b4 b288f61df6" aria-hidden="true">
                                        </div>

                                        <!-- Dynamic Reviews Container -->
                                        <div id="reviewsContainer">
                                            <div class="text-center py-5">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <p class="mt-2">Loading reviews...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Review Image Popup Modal -->
                <div class="modal fade" id="reviewImageModal" tabindex="-1" aria-labelledby="reviewImageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="background: transparent; border: none;">
                            <div class="modal-header" style="border: none; padding: 0; position: absolute; top: -40px; right: 0; z-index: 1051;">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="background: white; opacity: 1; border-radius: 50%; padding: 10px;"></button>
                            </div>
                            <div class="modal-body" style="padding: 0; text-align: center;">
                                <img id="reviewModalImage" src="" alt="Review Image" style="max-width: 100%; max-height: 80vh; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                                <div class="image-navigation mt-3" style="display: flex; justify-content: center; align-items: center; gap: 15px;">
                                    <button id="prevImageBtn" class="btn btn-light" style="border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border: 2px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                        </svg>
                                    </button>
                                    <span id="imageCounter" style="color: white; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.5); background: rgba(0,0,0,0.5); padding: 5px 15px; border-radius: 20px;"></span>
                                    <button id="nextImageBtn" class="btn btn-light" style="border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border: 2px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review -->
                <div id="review" class="row">
                    <div class="col-md-12">
                        <div data-v-58caae98="" id="description" class="hotel-description room-section">
                            <h3 data-v-58caae98="" class="nearby-title">Review</h3>
                            <div data-v-58caae98="" class="hotel-review-details">
                                <div data-v-58caae98="" class="review-container">
                                    <div class="review-card">
                                        <div class="review-point">
                                            <h3>{{ $reviewStats['overall_avg'] > 0 ? number_format($reviewStats['overall_avg'], 1) : '0.0' }}</h3>
                                        </div>
                                        <div class="review-comments">
                                            <h2>{{ $ratingSentiment }}</h2>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#rightSidebarModal">
                                                {{ $reviewStats['total'] }} {{ $reviewStats['total'] == 1 ? 'Review' : 'Reviews' }} & Comments
                                                <span>
                                             <svg style="color: #91278f; margin-left: 10px; margin-top: -3px;"
                                                  xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                  fill="currentColor" class="bi bi-check-circle-fill"
                                                  viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                             </svg>
                                          </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div data-v-58caae98="" class="row">
                                        <div data-v-58caae98="" class="col-12 col-sm-6 col-lg-4 mb-20">
                                            <div class="review-list">
                                                <div class="review-header">
                                                    <div class="review-name">
                                                        <h2>
                                                            Staff
                                                            <span>
                                                      <svg style="color: #91278f; margin-top: -3px;"
                                                           xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                           fill="currentColor" class="bi bi-check-circle-fill"
                                                           viewBox="0 0 16 16">
                                                         <path
                                                             d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                      </svg>
                                                   </span>
                                                        </h2>
                                                    </div>
                                                    <div class="review-name">
                                                        <h2>{{ $reviewStats['staff_avg'] > 0 ? number_format($reviewStats['staff_avg'], 1) : '0.0' }}</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress_custom progress-bar-success"
                                                         role="progressbar" aria-valuenow="{{ $reviewStats['staff_avg'] }}" aria-valuemin="0"
                                                         aria-valuemax="10"
                                                         style="width: {{ ($reviewStats['staff_avg'] / 10) * 100 }}%; background-color: #91278f;">
                                                        <span class="sr-only">{{ $reviewStats['staff_avg'] }}% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-v-58caae98="" class="col-12 col-sm-6 col-lg-4 mb-20">
                                            <div class="review-list">
                                                <div class="review-header">
                                                    <div class="review-name">
                                                        <h2>
                                                            Facilities
                                                            <span>
                                                      <svg style="color: #91278f; margin-top: -3px;"
                                                           xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                           fill="currentColor" class="bi bi-check-circle-fill"
                                                           viewBox="0 0 16 16">
                                                         <path
                                                             d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                      </svg>
                                                   </span>
                                                        </h2>
                                                    </div>
                                                    <div class="review-name">
                                                        <h2>{{ $reviewStats['facilities_avg'] > 0 ? number_format($reviewStats['facilities_avg'], 1) : '0.0' }}</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                                         aria-valuenow="{{ $reviewStats['facilities_avg'] }}" aria-valuemin="0" aria-valuemax="10"
                                                         style="width: {{ ($reviewStats['facilities_avg'] / 10) * 100 }}%; background-color: #489b48;">
                                                        <span class="sr-only">{{ $reviewStats['facilities_avg'] }}% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-v-58caae98="" class="col-12 col-sm-6 col-lg-4 mb-20">
                                            <div class="review-list">
                                                <div class="review-header">
                                                    <div class="review-name">
                                                        <h2>
                                                            Cleanliness
                                                            <span>
                                                      <svg style="color: #91278f; margin-top: -3px;"
                                                           xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                           fill="currentColor" class="bi bi-check-circle-fill"
                                                           viewBox="0 0 16 16">
                                                         <path
                                                             d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                      </svg>
                                                   </span>
                                                        </h2>
                                                    </div>
                                                    <div class="review-name">
                                                        <h2>{{ $reviewStats['cleanliness_avg'] > 0 ? number_format($reviewStats['cleanliness_avg'], 1) : '0.0' }}</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                                         aria-valuenow="{{ $reviewStats['cleanliness_avg'] }}" aria-valuemin="0" aria-valuemax="10"
                                                         style="width: {{ ($reviewStats['cleanliness_avg'] / 10) * 100 }}%; background-color: #489b48;">
                                                        <span class="sr-only">{{ $reviewStats['cleanliness_avg'] }}% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-v-58caae98="" class="col-12 col-sm-6 col-lg-4 mb-20">
                                            <div class="review-list">
                                                <div class="review-header">
                                                    <div class="review-name">
                                                        <h2>
                                                            Location
                                                            <span>
                                                      <svg style="color: #91278f; margin-top: -3px;"
                                                           xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                           fill="currentColor" class="bi bi-check-circle-fill"
                                                           viewBox="0 0 16 16">
                                                         <path
                                                             d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                      </svg>
                                                   </span>
                                                        </h2>
                                                    </div>
                                                    <div class="review-name">
                                                        <h2>{{ $reviewStats['location_avg'] > 0 ? number_format($reviewStats['location_avg'], 1) : '0.0' }}</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress_custom" role="progressbar"
                                                         aria-valuenow="{{ $reviewStats['location_avg'] }}" aria-valuemin="0" aria-valuemax="10"
                                                         style="width: {{ ($reviewStats['location_avg'] / 10) * 100 }}%; background-color: #489b48;">
                                                        <span class="sr-only">{{ $reviewStats['location_avg'] }}% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-v-58caae98="" class="col-12 col-sm-6 col-lg-4 mb-20">
                                            <div class="review-list">
                                                <div class="review-header">
                                                    <div class="review-name">
                                                        <h2>
                                                            Comfort
                                                            <span>
                                                      <svg style="color: #91278f; margin-top: -3px;"
                                                           xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                           fill="currentColor" class="bi bi-check-circle-fill"
                                                           viewBox="0 0 16 16">
                                                         <path
                                                             d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                      </svg>
                                                   </span>
                                                        </h2>
                                                    </div>
                                                    <div class="review-name">
                                                        <h2>{{ $reviewStats['comfort_avg'] > 0 ? number_format($reviewStats['comfort_avg'], 1) : '0.0' }}</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress_custom progress-bar-success"
                                                         role="progressbar" aria-valuenow="{{ $reviewStats['comfort_avg'] }}" aria-valuemin="0"
                                                         aria-valuemax="10"
                                                         style="width: {{ ($reviewStats['comfort_avg'] / 10) * 100 }}%; background-color: #91278f;">
                                                        <span class="sr-only">{{ $reviewStats['comfort_avg'] }}% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-v-58caae98="" class="col-12 col-sm-6 col-lg-4 mb-20">
                                            <div class="review-list">
                                                <div class="review-header">
                                                    <div class="review-name">
                                                        <h2>
                                                            Value for Money
                                                            <span>
                                                      <svg style="color: #91278f; margin-top: -3px;"
                                                           xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                           fill="currentColor" class="bi bi-check-circle-fill"
                                                           viewBox="0 0 16 16">
                                                         <path
                                                             d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                      </svg>
                                                   </span>
                                                        </h2>
                                                    </div>
                                                    <div class="review-name">
                                                        <h2>{{ $reviewStats['value_avg'] > 0 ? number_format($reviewStats['value_avg'], 1) : '0.0' }}</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                                         aria-valuenow="{{ $reviewStats['value_avg'] }}" aria-valuemin="0" aria-valuemax="10"
                                                         style="width: {{ ($reviewStats['value_avg'] / 10) * 100 }}%; background-color: #489b48;">
                                                        <span class="sr-only">{{ $reviewStats['value_avg'] }}% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-v-58caae98="" class="col-12 col-sm-6 col-lg-4 mb-20">
                                            <div class="review-list">
                                                <div class="review-header">
                                                    <div class="review-name">
                                                        <h2>
                                                            Free WiFi
                                                            <span>
                                                      <svg style="color: #91278f; margin-top: -3px;"
                                                           xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                           fill="currentColor" class="bi bi-check-circle-fill"
                                                           viewBox="0 0 16 16">
                                                         <path
                                                             d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                      </svg>
                                                   </span>
                                                        </h2>
                                                    </div>
                                                    <div class="review-name">
                                                        <h2>{{ $reviewStats['wifi_avg'] > 0 ? number_format($reviewStats['wifi_avg'], 1) : '0.0' }}</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress_custom" role="progressbar"
                                                         aria-valuenow="{{ $reviewStats['wifi_avg'] }}" aria-valuemin="0" aria-valuemax="10"
                                                         style="width: {{ ($reviewStats['wifi_avg'] / 10) * 100 }}%; background-color: #91278f;">
                                                        <span class="sr-only">{{ $reviewStats['wifi_avg'] }}% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <!-- Add Review Form -->
                            <div id="review-form-section" class="mt-4" style="display: none;">
                                <style>
                                    #review-form-section .review-rating-slider {
                                        accent-color: #2563eb;
                                    }
                                    #review-form-section .review-rating-slider::-webkit-slider-runnable-track {
                                        width: 100%;
                                        height: 8px;
                                        background: linear-gradient(to right, #2563eb 0%, #2563eb var(--slider-fill, 0%), #e9ecef var(--slider-fill, 0%)) !important;
                                        border-radius: 4px;
                                    }
                                    #review-form-section .review-rating-slider::-webkit-slider-thumb {
                                        background: #2563eb;
                                        -webkit-appearance: none;
                                        appearance: none;
                                        width: 18px;
                                        height: 18px;
                                        border-radius: 50%;
                                        cursor: pointer;
                                        margin-top: -5px;
                                    }
                                    #review-form-section .review-rating-slider::-moz-range-track {
                                        height: 8px;
                                        background: #e9ecef;
                                        border-radius: 4px;
                                    }
                                    #review-form-section .review-rating-slider::-moz-range-progress {
                                        height: 8px;
                                        background: #2563eb;
                                        border-radius: 4px;
                                    }
                                    #review-form-section .review-rating-slider::-moz-range-thumb {
                                        background: #2563eb;
                                        border: none;
                                        width: 18px;
                                        height: 18px;
                                        border-radius: 50%;
                                        cursor: pointer;
                                    }
                                </style>
                                <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 25px;">
                                    <h4 class="mb-4" style="color: #91278f;">Write a Review</h4>
                                    <form id="reviewForm" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="hotel_id" value="{{ $show->id }}">
                                        <input type="hidden" name="booking_id" id="review_booking_id" value="">
                                        <input type="hidden" name="overall_rating" id="overall_rating" value="0">
                                        
                                        <!-- Which stay did you book? -->
                                        <div class="mb-4" id="review-booking-section">
                                            <label class="form-label fw-bold">Which stay would you like to review? <span class="text-danger">*</span></label>
                                            <select class="form-control" id="review_booking_select" required>
                                                <option value="">-- Select your stay --</option>
                                            </select>
                                            <div id="review-stay-details" class="mt-3 p-3 rounded" style="background: #f0f7ff; border: 1px solid #b8daff; display: none;">
                                                <p class="mb-1 fw-bold text-dark">Did you stay:</p>
                                                <p class="mb-0" id="stay-details-text"><span id="stay-room-names"></span> from <span id="stay-checkin"></span> to <span id="stay-checkout"></span> (<span id="stay-nights"></span>)</p>
                                            </div>
                                            <div id="review-booking-loading" class="mt-2 text-muted" style="display: none;">
                                                <small><i class="fa fa-spinner fa-spin"></i> Loading your bookings...</small>
                                            </div>
                                            <div id="review-booking-error" class="mt-2 text-danger" style="display: none;">
                                                <small>Could not load your bookings. Please refresh the page.</small>
                                            </div>
                                        </div>
                                        
                                        <!-- Review Title -->
                                        <div class="mb-3">
                                            <label for="review_title" class="form-label fw-bold">Review Title</label>
                                            <input type="text" class="form-control" id="review_title" name="title" placeholder="Give your review a title">
                                        </div>
                                        
                                        <!-- Review Comment -->
                                        <div class="mb-3">
                                            <label for="review_comment" class="form-label fw-bold">Your Review</label>
                                            <textarea class="form-control" id="review_comment" name="comment" rows="4" placeholder="Share your experience..."></textarea>
                                        </div>
                                        
                                        <!-- Category Ratings -->
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Staff</label>
                                                <input type="range" class="form-range review-rating-slider" min="0" max="10" step="0.1" name="staff_rating" id="staff_rating" value="0">
                                                <small class="text-muted"><span id="staff_rating_display">0.0</span>/10</small>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Facilities</label>
                                                <input type="range" class="form-range review-rating-slider" min="0" max="10" step="0.1" name="facilities_rating" id="facilities_rating" value="0">
                                                <small class="text-muted"><span id="facilities_rating_display">0.0</span>/10</small>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Cleanliness</label>
                                                <input type="range" class="form-range review-rating-slider" min="0" max="10" step="0.1" name="cleanliness_rating" id="cleanliness_rating" value="0">
                                                <small class="text-muted"><span id="cleanliness_rating_display">0.0</span>/10</small>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Location</label>
                                                <input type="range" class="form-range review-rating-slider" min="0" max="10" step="0.1" name="location_rating" id="location_rating" value="0">
                                                <small class="text-muted"><span id="location_rating_display">0.0</span>/10</small>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Comfort</label>
                                                <input type="range" class="form-range review-rating-slider" min="0" max="10" step="0.1" name="comfort_rating" id="comfort_rating" value="0">
                                                <small class="text-muted"><span id="comfort_rating_display">0.0</span>/10</small>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Value for Money</label>
                                                <input type="range" class="form-range review-rating-slider" min="0" max="10" step="0.1" name="value_for_money_rating" id="value_for_money_rating" value="0">
                                                <small class="text-muted"><span id="value_for_money_rating_display">0.0</span>/10</small>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Free WiFi</label>
                                                <input type="range" class="form-range review-rating-slider" min="0" max="10" step="0.1" name="free_wifi_rating" id="free_wifi_rating" value="0">
                                                <small class="text-muted"><span id="free_wifi_rating_display">0.0</span>/10</small>
                                            </div>
                                        </div>
                                        
                                        <!-- Overall Rating (auto-calculated, read-only) -->
                                        <div class="mb-4 p-3 rounded" style="background: #f8f9fa; border: 1px solid #e9ecef;">
                                            <label class="form-label fw-bold mb-0">Overall Rating <span class="text-danger">*</span></label>
                                            <p class="mb-0 mt-1 text-muted" style="font-size: 13px;">Calculated from your category ratings above</p>
                                            <div class="d-flex align-items-center gap-2 mt-2">
                                                <span id="overall_rating_display" class="fw-bold" style="font-size: 24px; color: #91278f;">0.0</span>
                                                <span class="text-muted">/ 10</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Pros and Cons -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="review_pros" class="form-label fw-bold">Pros</label>
                                                <textarea class="form-control" id="review_pros" name="pros" rows="2" placeholder="What did you like?"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="review_cons" class="form-label fw-bold">Cons</label>
                                                <textarea class="form-control" id="review_cons" name="cons" rows="2" placeholder="What could be improved?"></textarea>
                                            </div>
                                        </div>
                                        
                                        <!-- Images -->
                                        <div class="mb-3">
                                            <label for="review_images" class="form-label fw-bold">Upload Photos (Optional)</label>
                                            <input type="file" class="form-control" id="review_images" name="images[]" multiple accept="image/*">
                                            <small class="text-muted">You can upload up to 5 images</small>
                                        </div>
                                        
                                        <!-- Submit Button -->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary me-2" onclick="closeReviewForm()">Cancel</button>
                                            <button type="submit" class="btn text-white" style="background-color: #91278f;">Submit Review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Add Review Button -->
                            <div class="mt-4 text-center" id="add-review-button-section">
                                <button type="button" class="btn text-white" style="background-color: #91278f;" onclick="showReviewForm()" id="add-review-btn">
                                    <i class="fa fa-plus"></i> Write a Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Location -->


                <!-- Policy -->
                <div data-v-58caae98="" id="rules" class="hotel-rules room-section">
                    <h3 data-v-58caae98="" class="rules-title">
                        Policy
                    </h3>
                    <div data-v-58caae98="" class="rules-container">
                        <div data-v-58caae98="" class="rule centered d-flex">
                            <div data-v-58caae98="" class="key-point mb-0"><i data-v-58caae98=""
                                                                              class="icon icon-check-calendar"></i>
                                Check In
                            </div>
                            <div data-v-58caae98="" class="rule-detail">
                                <div data-v-58caae98="" class="check-time">
                                    {{ $show->check_in_window }}
                                </div>
                            </div>
                        </div>
                        <div data-v-58caae98="" class="rule centered d-flex">
                            <div data-v-58caae98="" class="key-point mb-0"><i data-v-58caae98=""
                                                                              class="icon icon-check-calendar"></i>
                                Check Out
                            </div>
                            <div data-v-58caae98="" class="rule-detail">
                                <div data-v-58caae98="" class="check-time">
                                    {{ $show->check_out_time }}
                                </div>
                            </div>
                        </div>
                        <div data-v-58caae98="" class="rule">
                            <div data-v-58caae98="" class="key-point">
                              <span data-v-58caae98="">
                                 <svg data-v-58caae98="" fill="none" viewBox="0 0 14 17" width="14" height="16">
                                    <path data-v-58caae98="" fill="#5d6a74" d="m7 16.3333-3.6027-1.9209A6.4066 6.4066 0 0 1 0
                                       8.75V1.1667A1.1678 1.1678 0 0 1 1.1667 0h11.6666A1.1676 1.1676 0
                                       0 1 14 1.1667V8.75a6.406 6.406 0 0 1-3.3973 5.6624L7 16.3333Z"></path>
                                    <path data-v-58caae98="" fill="#fff"
                                          d="M3.5 8.1665h7v1.1667h-7V8.1665Zm0-3.5h7v1.1667h-7V4.6665Z"></path>
                                 </svg>
                                 Location Direction
                              </span>
                            </div>
                            <div data-v-58caae98="" class="rule-detail">
                                {!!  $show->directions  !!}
                            </div>
                        </div>
                        <div data-v-58caae98="" class="rule">
                            <div data-v-58caae98="" class="key-point"><span data-v-58caae98=""><i data-v-58caae98=""
                                                                                                  class="fa fa-file-alt"></i>
                              Special Instructions
                              </span>
                            </div>
                            <div data-v-58caae98="" class="rule-detail">
                                {!!  $show->extra_bed_policy  !!}
                            </div>
                        </div>
                        <!----> <!---->
                        <div data-v-58caae98="" class="rule">
                            <div data-v-58caae98="" class="key-point"><i data-v-58caae98=""
                                                                         class="facility-icon icon-10"></i>
                                Child Policy
                            </div>
                            <div data-v-58caae98="" class="rule-detail">
                                {!!  $show->child_policy  !!}
                            </div>
                        </div>
                        <div data-v-58caae98="" class="rule">
                            <div data-v-58caae98="" class="key-point"><i data-v-58caae98="" class="icon icon-paw"></i>
                                Pet Policy
                            </div>
                            <div data-v-58caae98="" class="rule-detail">
                                <p data-v-58caae98="">@if($show->pets_allowed =='yes') Allowed @else Not Allowd @endif</p>
                                @if($show->pets_allowed =='yes')
                                <p data-v-58caae98="">{!!  $show->pets_details  !!}</p>
                                @endif
                            </div>
                        </div>
                        <div data-v-58caae98="" class="rule">
                            <div data-v-58caae98="" class="key-point"><i data-v-58caae98=""
                                                                         class="icon icon-info-dark"></i> Additional Policy
                            </div>
                            <div data-v-58caae98="" class="rule-detail">
                                {!! $show->additional_policy !!}
                            </div>
                        </div>
                        <div data-v-58caae98="" class="rule centered">
                            <div data-v-58caae98="" class="key-point"><i data-v-58caae98=""
                                                                         class="icon icon-payment-card"></i> Property
                                accepts
                            </div>
                            <div data-v-58caae98="" class="rule-detail">
                                <img data-v-6e29e399="" data-v-58caae98=""
                                     src="{{ asset('frontend')}}/images/surjoy.png" alt="payment icon"
                                     class="image-kit payment-card image-placeholder fade-in-out" style="height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Rules -->

                <!-- Host Profile -->
                <div data-v-58caae98="" id="host_Profile" class="hotel-rules room-section">
                    <h3 data-v-58caae98="" class="rules-title">
                        Host Profile
                    </h3>
                    <div data-v-58caae98="" class="rules-container">
                        <div data-v-58caae98="" class="rule centered d-flex">

                            <section class="vendor-wrapper" style="padding: 10px 0px;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8 order-2 order-lg-1">
                                            <div class="vendor-right-section">

                                                <div class="vendor-top-information">
                                                    <h5 class="Superhost-subtitle" style="color: #91278f;">What EZBooking Says about the Host?</h5>

                                                    <div class="vendor-personal-info">

                                                        <h3 class="info-subtitle" style="font-size: 16px;">Superhosts
                                                            are experienced, highly rated hosts who are committed to
                                                            providing great stays for guests.</h3>


                                                    </div>

                                                    @php
                                                        $coHosts = \App\Models\CoHost::where('hotel_id', $show->id)->where('is_active', true)->get();
                                                    @endphp
                                                    
                                                    @if($coHosts->count() > 0)
                                                    <div class="co-host-card">
                                                        <h5 class="Superhost-subtitle"> Co-hosts</h5>

                                                        <div class="co-host-list">
                                                            @foreach($coHosts as $coHost)
                                                            <div class="co-host-profile">
                                                                <div class="co-host-pic">
                                                                    <a href="#">
                                                                        @if($coHost->photo)
                                                                            <img src="{{ asset($coHost->photo) }}" alt="{{ $coHost->name }}">
                                                                        @else
                                                                            <img src="{{ asset('frontend/images/reviewer-1.jpg') }}" alt="{{ $coHost->name }}">
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="co-host-name">
                                                                    <h4>{{ $coHost->name }}</h4>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif


                                                    @php
                                                        $vendor = \App\Models\Vendor::find($show->vendor_id);
                                                        $avgResponseRate = $coHosts->count() > 0 ? $coHosts->avg('response_rate') : ($vendor ? 100 : 100);
                                                        $avgResponseTime = $coHosts->count() > 0 ? $coHosts->first()->response_time ?? 'within an hour' : 'within an hour';
                                                    @endphp
                                                    
                                                    <div class="co-host-card">
                                                        <h5 class="Superhost-subtitle">Host details</h5>
                                                        <div class="co-host-profile">
                                                            <div class="co-host-name">
                                                                <h4>Response rate: {{ number_format($avgResponseRate) }}%</h4>
                                                                <h4>Responds {{ $avgResponseTime }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3">
                                                        <button type="button" class="btn btn-primary" id="openMessageBtn" style="background: #91278f; border-color: #91278f; padding: 12px 28px; font-size: 16px; min-width: 160px;">Message</button>
                                                    </div>

                                                    <!-- Message compose panel (shown when Message clicked) -->
                                                    <div id="messageComposePanel" class="message-compose-panel" style="display: none;">
                                                        <div class="message-compose-header">
                                                            <h6 class="mb-0">Send a message</h6>
                                                            <button type="button" class="btn-close-message" id="closeMessageCompose" aria-label="Close">&times;</button>
                                                        </div>
                                                        <div class="message-compose-body">
                                                            <textarea id="messageTextInput" class="form-control" rows="4" placeholder="Type your message here..."></textarea>
                                                            <button type="button" class="btn btn-primary btn-send-message" id="sendMessageBtn" style="background: #91278f; border-color: #91278f; margin-top: 10px;">Send</button>
                                                        </div>
                                                    </div>

                                                    <!-- Message sent bubble + floating inbox (bottom-left) -->
                                                    <div id="messageSentBubble" class="message-sent-bubble" style="display: none;">
                                                        <div class="message-bubble-content">
                                                            <div class="message-bubble-icon">✓</div>
                                                            <p class="message-bubble-text">Message sent!</p>
                                                            <button type="button" class="btn btn-sm btn-primary btn-continue" id="messageBubbleContinue" style="background: #91278f; border-color: #91278f;">Continue</button>
                                                        </div>
                                                        <div class="message-bubble-tail"></div>
                                                    </div>

                                                    <!-- Floating Inbox button (always visible at same position) -->
                                                    <button id="floatingInboxButton" class="floating-inbox-btn" type="button">
                                                        <span class="inbox-icon">
                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                            <span class="inbox-badge" id="inboxUnreadBadge" style="display:none;">1</span>
                                                        </span>
                                                        <span class="inbox-label">Inbox</span>
                                                        <span class="inbox-avatar"></span>
                                                    </button>

                                                    <!-- <div class="border-bottom-line"></div> -->
                                                </div>

                                            </div>
                                        </div>

                                        <style>
                                        .message-compose-panel {
                                            margin-top: 15px;
                                            border: 1px solid #e0e0e0;
                                            border-radius: 12px;
                                            overflow: hidden;
                                            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
                                        }
                                        .message-compose-header {
                                            display: flex;
                                            justify-content: space-between;
                                            align-items: center;
                                            padding: 12px 16px;
                                            background: #f8f9fa;
                                            border-bottom: 1px solid #e0e0e0;
                                        }
                                        .message-compose-header h6 { color: #333; font-weight: 600; }
                                        .btn-close-message {
                                            background: none;
                                            border: none;
                                            font-size: 24px;
                                            line-height: 1;
                                            cursor: pointer;
                                            color: #666;
                                            padding: 0;
                                            width: 28px;
                                            height: 28px;
                                        }
                                        .btn-close-message:hover { color: #333; }
                                        .message-compose-body {
                                            padding: 16px;
                                        }
                                        .message-compose-body textarea {
                                            border-radius: 8px;
                                            resize: vertical;
                                            min-height: 100px;
                                        }
                                        .message-sent-bubble {
                                            position: fixed;
                                            left: 24px;
                                            bottom: 24px;
                                            z-index: 9999;
                                            animation: messageBubbleIn 0.3s ease;
                                        }
                                        @keyframes messageBubbleIn {
                                            from { opacity: 0; transform: translateY(10px); }
                                            to { opacity: 1; transform: translateY(0); }
                                        }
                                        .message-bubble-content {
                                            background: #fff;
                                            border-radius: 12px;
                                            padding: 16px 20px;
                                            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                                            border: 1px solid #e8e8e8;
                                            min-width: 200px;
                                            position: relative;
                                        }
                                        .message-bubble-icon {
                                            width: 36px;
                                            height: 36px;
                                            border-radius: 50%;
                                            background: #91278f;
                                            color: #fff;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            font-weight: bold;
                                            font-size: 18px;
                                            margin-bottom: 10px;
                                        }
                                        .message-bubble-text {
                                            margin: 0 0 12px 0;
                                            font-weight: 500;
                                            color: #333;
                                        }
                                        .message-bubble-tail {
                                            position: absolute;
                                            left: 20px;
                                            bottom: -8px;
                                            width: 0;
                                            height: 0;
                                            border-left: 10px solid transparent;
                                            border-right: 10px solid transparent;
                                            border-top: 10px solid #e8e8e8;
                                        }

                                        /* Floating Inbox pill button (bottom-left, same area as message bubble) */
                                        .floating-inbox-btn {
                                            position: fixed;
                                            left: 24px;
                                            bottom: 24px;
                                            z-index: 9998;
                                            display: inline-flex;
                                            align-items: center;
                                            justify-content: space-between;
                                            gap: 10px;
                                            padding: 8px 14px 8px 12px;
                                            background: #ffffff;
                                            border-radius: 999px;
                                            border: 1px solid #e0e0e0;
                                            box-shadow: 0 4px 14px rgba(0,0,0,0.12);
                                            cursor: pointer;
                                            min-width: 160px;
                                            transition: box-shadow 0.2s ease, transform 0.2s ease;
                                        }
                                        .floating-inbox-btn:hover {
                                            box-shadow: 0 6px 18px rgba(0,0,0,0.16);
                                            transform: translateY(-1px);
                                        }
                                        .floating-inbox-btn .inbox-icon {
                                            position: relative;
                                            display: inline-flex;
                                            align-items: center;
                                            justify-content: center;
                                            width: 26px;
                                            height: 26px;
                                            border-radius: 50%;
                                            border: 1px solid #91278f;
                                            color: #91278f;
                                            font-size: 14px;
                                        }
                                        .floating-inbox-btn .inbox-badge {
                                            position: absolute;
                                            top: -5px;
                                            right: -5px;
                                            min-width: 16px;
                                            height: 16px;
                                            border-radius: 50%;
                                            background: #e53e3e;
                                            color: #fff;
                                            font-size: 10px;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            padding: 0 3px;
                                        }
                                        .floating-inbox-btn .inbox-label {
                                            font-size: 14px;
                                            font-weight: 600;
                                            color: #333;
                                        }
                                        .floating-inbox-btn .inbox-avatar {
                                            width: 26px;
                                            height: 26px;
                                            border-radius: 50%;
                                            background: url('{{ asset('frontend/images/reviewer-1.jpg') }}') center/cover no-repeat;
                                        }
                                        </style>

                                        <div class="col-lg-3 order-1 order-lg-2">
                                            <div class="vendor-left-section">
                                                @php
                                                    $vendor = \App\Models\Vendor::find($show->vendor_id);
                                                    $vendorLogo = $vendor ? ($vendor->logo ?? $vendor->profile_picture ?? null) : null;
                                                    $yearsHosting = $vendor && $vendor->created_at ? \Carbon\Carbon::now()->diffInYears($vendor->created_at) : 0;
                                                @endphp
                                                
                                                <div class="vendor-profile">
                                                    <div class="vendor-profile-left">
                                                        <div class="vendor-pic">
                                                            @if($vendorLogo)
                                                                <img src="{{ asset($vendorLogo) }}" class="img-fluid" alt="{{ $show->description }}">
                                                            @else
                                                                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #90278e 0%, #b84ab5 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 24px;">
                                                                    {{ strtoupper(substr($show->description ?? 'H', 0, 1)) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="vendor-title">
                                                            <h3>{{ $show->description }}</h3>
                                                            <p>{{ ($reviewStats['total'] >= 5 && $reviewStats['overall_avg'] >= 8) ? 'Super Host' : 'Host' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="vendor-profile-right">
                                                        <div class="vendor-all-info">
                                                            <h3>{{ $reviewStats['total'] }}</h3>
                                                            <p>Reviews</p>
                                                        </div>

                                                        <div class="vendor-all-info">
                                                            <h3>{{ number_format($reviewStats['overall_avg'], 1) }} <sup><i class="fa fa-star Block"></i></sup></h3>
                                                            <p>Rating</p>
                                                        </div>

                                                        <div class="vendor-all-info">
                                                            <h3>{{ $yearsHosting }}</h3>
                                                            <p>Years hosting</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="vendor-profile-footer">


                                                    @php
                                                        $vendor = \App\Models\Vendor::find($show->vendor_id);
                                                    @endphp
                                                    
                                                    @if($vendor)
                                                    <div class="vendor-info-list">
                                                        <span><svg xmlns="http://www.w3.org/2000/svg"
                                                                   viewBox="0 0 32 32" aria-hidden="true"
                                                                   role="presentation" focusable="false"
                                                                   style="display: block; height: 24px; width: 24px; fill: var(--linaria-theme_palette-hof);"><path
                                                                    d="M26 2a5 5 0 0 1 5 4.78V21a5 5 0 0 1-4.78 5h-6.06L16 31.08 11.84 26H6a5 5 0 0 1-4.98-4.56L1 21.22 1 21V7a5 5 0 0 1 4.78-5H26zm0 2H6a3 3 0 0 0-3 2.82V21a3 3 0 0 0 2.82 3H12.8l3.2 3.92L19.2 24H26a3 3 0 0 0 3-2.82V7a3 3 0 0 0-2.82-3H26zM16 6a8.02 8.02 0 0 1 8 8.03A8 8 0 0 1 16.23 22h-.25A8 8 0 0 1 8 14.24v-.25A8 8 0 0 1 16 6zm1.68 9h-3.37c.11 1.45.43 2.76.79 3.68l.09.22.13.3c.23.45.45.74.62.8H16c.33 0 .85-.94 1.23-2.34l.11-.44c.16-.67.29-1.42.34-2.22zm4.24 0h-2.23c-.1 1.6-.42 3.12-.92 4.32a6 6 0 0 0 3.1-4.07l.05-.25zm-9.61 0h-2.23a6 6 0 0 0 3.14 4.32c-.5-1.2-.82-2.71-.91-4.32zm.92-6.32-.13.07A6 6 0 0 0 10.08 13h2.23c.1-1.61.42-3.12.91-4.32zM16 8h-.05c-.27.08-.64.7-.97 1.65l-.13.4a13.99 13.99 0 0 0-.54 2.95h3.37c-.19-2.66-1.1-4.85-1.63-5H16zm2.78.69.02.05c.48 1.19.8 2.68.9 4.26h2.21A6.02 6.02 0 0 0 19 8.8l-.22-.12z"></path></svg></span>Speaks
                                                        {{ $vendor->language ?? 'English' }}
                                                    </div>

                                                    <div class="vendor-info-list" style="padding-top: 15px;">
                                                        <span><svg xmlns="http://www.w3.org/2000/svg"
                                                                   viewBox="0 0 32 32" aria-hidden="true"
                                                                   role="presentation" focusable="false"
                                                                   style="display: block; height: 24px; width: 24px; fill: var(--linaria-theme_palette-hof);"><path
                                                                    d="m5.7 1.3 3 3-.66.72a12 12 0 0 0 16.95 16.94l.72-.67 3 3-1.42 1.42-1.67-1.68A13.94 13.94 0 0 1 18 26.96V29h3v2h-8v-2h3v-2.04a13.95 13.95 0 0 1-8.92-4.08 14 14 0 0 1-1.11-18.5L4.29 2.71zm18.18 4.44.21.21.21.22a10 10 0 1 1-.64-.63zm-9.34 11.13-2.45 2.45a8 8 0 0 0 8.04 1.05 16.7 16.7 0 0 1-5.59-3.5zm4.91-4.91-3.5 3.5c2.85 2.54 6.08 3.82 6.7 3.2.63-.61-.66-3.85-3.2-6.7zm-9.81-2.1-.08.19a8 8 0 0 0 1.12 7.86l2.45-2.45a16.68 16.68 0 0 1-3.5-5.6zM23.32 8.1l-2.45 2.44a16.73 16.73 0 0 1 3.5 5.6 8 8 0 0 0-1.05-8.05zm-11.98-.76c-.62.62.66 3.86 3.2 6.7l3.5-3.5c-2.85-2.54-6.07-3.82-6.7-3.2zm2.54-1.7c1.75.59 3.75 1.83 5.58 3.49l2.44-2.45a8.03 8.03 0 0 0-8.02-1.04z"></path></svg></span>Lives
                                                        in {{ $vendor->address_city ?? 'N/A' }}, {{ $vendor->address_district ?? 'N/A' }}
                                                    </div>

                                                    @if(isset($vendor->bio) && $vendor->bio)
                                                    <h4 class="vendor-names">{{ $vendor->bio }}</h4>
                                                    @else
                                                    <h4 class="vendor-names">Hi, I am {{ $vendor->contact_person_name ?? 'the host' }}. I am glad to help every guest to stay and have fun. Welcome!</h4>
                                                    @endif
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <!-- Host Profile -->
            </div>
            <!-- end container -->
        </div>
        <!-- end hotel-details -->
    </section>
    <!-- end innerpage-wrapper -->

    <!-- Modal hotel rooms -->
    <div class="modal fade modal-al-rooms" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $show->description }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-all-rooms">
                    <div class="hotel-pop-up-image">
                        <div class="bd-example bd-example-tabs">
                            <nav class="col-md-12">
                                <div class="nav nav-tabs nav-tabbing-padding" id="nav-tab" role="tablist">

                                    @foreach($photoFields as $key => $field)
                                        @php
                                            $photos = is_string($show->$field) ? json_decode($show->$field, true) : [];
                                        @endphp

                                        @if(!empty($photos))
                                            <a class="nav-item nav-item-rooms nav-link text-black @if($key == 0) active @endif"
                                               id="nav-{{ $field }}-tab"
                                               data-bs-toggle="tab"
                                               href="#{{ $field }}"
                                               role="tab"
                                               aria-controls="nav-{{ $field }}"
                                               aria-selected="{{ $key == 0 ? 'true' : 'false' }}">
                                                {{ ucwords(str_replace('_', ' ', $field)) }}
                                            </a>
                                        @endif
                                    @endforeach

                                </div>

                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                @foreach($photoFields as $key => $field)
                                    @php
                                        $photos = is_string($show->$field) ? json_decode($show->$field, true) : [];
                                    @endphp

                                    @if(!empty($photos))
                                        <div class="tab-pane fade show @if($key == 0) active @endif" id="{{ $field }}"
                                             role="tabpanel" aria-labelledby="nav-{{ $field }}-tab">
                                            <div class="slider">
                                                @foreach($photos as $photo)
                                                    <div>
                                                        <img src="{{ asset($photo) }}" class="img-fluid hotel-rom-gal"
                                                             alt="{{ $field }}"/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
    // Search and Filter State - Initialize from URL parameters if available
    const urlParams = new URLSearchParams(window.location.search);
    const urlCheckin = urlParams.get('checkin');
    const urlCheckout = urlParams.get('checkout');
    const urlAdults = parseInt(urlParams.get('adults')) || 0;
    const urlChildren = parseInt(urlParams.get('children')) || 0;
    
    let nights = 0;
    if (urlCheckin && urlCheckout) {
        const checkinDate = new Date(urlCheckin);
        const checkoutDate = new Date(urlCheckout);
        nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
    }
    
    let searchState = {
        checkin: urlCheckin || null,
        checkout: urlCheckout || null,
        guests: urlAdults,
        children: urlChildren,
        nights: nights,
        bedFilter: 'all'
    };

    // Filter rooms based on availability dates
    function filterRoomsByAvailability() {
        const checkin = document.getElementById('checkInDate')?.value;
        const checkout = document.getElementById('checkoutDate')?.value;
        
        // Filter rooms
        const rooms = document.querySelectorAll('.hotel-all-card');
        let visibleCount = 0;
        
        rooms.forEach(roomElement => {
            const roomId = Number(roomElement.getAttribute('data-room-id'));
            const room = roomsData.find(r => Number(r.id) === roomId);
            
            if (!room) {
                roomElement.style.display = 'none';
                return;
            }
            
            // If room has no availability_dates set, it's always available
            if (!room.availability_dates || room.availability_dates.length === 0) {
                roomElement.style.display = '';
                visibleCount++;
                return;
            }
            
            // If room has availability_dates set, it should only show when dates are selected AND match
            if (!checkin || !checkout) {
                // No dates selected - hide rooms that have availability_dates set
                roomElement.style.display = 'none';
                return;
            }
            
            const checkinDate = new Date(checkin);
            const checkoutDate = new Date(checkout);
            
            // Generate all dates in the range (excluding checkout date)
            const datesInRange = [];
            const currentDate = new Date(checkinDate);
            while (currentDate < checkoutDate) {
                datesInRange.push(currentDate.toISOString().split('T')[0]);
                currentDate.setDate(currentDate.getDate() + 1);
            }
            
            // Check if ALL dates in range are in availability_dates
            const allDatesAvailable = datesInRange.every(date => {
                return room.availability_dates.includes(date);
            });
            
            if (allDatesAvailable) {
                roomElement.style.display = '';
                visibleCount++;
            } else {
                roomElement.style.display = 'none';
            }
        });
        
        // Show/hide no rooms message
        if (visibleCount === 0 && (checkin && checkout)) {
            showNoRoomsMessage();
        } else {
            hideNoRoomsMessage();
        }
    }

    // Update Guests/Children and Filter Instantly
    function updateGuestsAndFilter() {
        const guests = parseInt(document.getElementById('guestsSelect').value) || 0;
        const children = parseInt(document.getElementById('childrenSelect').value) || 0;
        
        // Update search state with new guest values
        searchState.guests = guests;
        searchState.children = children;
        
        // Update summary text
        updateSearchSummary();
        
        // Filter rooms immediately
        filterRooms();
    }

    /**
     * Sync all room cards (nights input, night label, and total price)
     * with the current searchState.nights value. This is used when the
     * user changes dates on the page without reloading (instant update),
     * so the UI matches what a full "Modify Search" reload would show.
     */
    function updateRoomNightsAndTotalsFromState() {
        const nights = Math.max(1, parseInt(searchState.nights || 1, 10));
        const hasLockedDates = !!(searchState.checkin && searchState.checkout);

        document.querySelectorAll('.hotel-all-card').forEach(card => {
            const roomId = card.getAttribute('data-room-id');
            if (!roomId) {
                return;
            }

            const qtyInput = card.querySelector('#qty-' + roomId);
            if (!qtyInput) {
                return;
            }

            // Update quantity input to reflect nights
            qtyInput.value = nights;
            qtyInput.setAttribute('data-nights-locked', hasLockedDates ? '1' : '0');
            qtyInput.readOnly = hasLockedDates;

            // Recalculate total using price-per-night stored on the input
            const pricePerNight = parseFloat(qtyInput.getAttribute('data-price-per-night')) || 0;
            const total = (pricePerNight * nights).toFixed(2);

            const totalDisplay = card.querySelector('.room-total-display');
            if (totalDisplay) {
                totalDisplay.textContent = 'Total = BDT ' + Number(total).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            // Update "X Night(s)" label beside the qty input
            const nightLabel = card.querySelector('.night-label');
            if (nightLabel) {
                nightLabel.textContent = nights + ' ' + (nights === 1 ? 'Night' : 'Nights');
            }

            // Update the small "Total for X nights" text in the per-night line
            const pricePerLine = card.querySelector('.price-per .nights-label');
            if (pricePerLine) {
                if (nights > 1) {
                    pricePerLine.textContent = ' · Total for ' + nights + ' nights';
                    pricePerLine.style.display = 'inline';
                } else {
                    // For 1 night we hide the extra label to avoid confusion
                    pricePerLine.style.display = 'none';
                }
            }

            // Lock/unlock the +/- buttons visually and functionally when dates are set
            const qtyMinus = card.querySelector('.qtyminus');
            const qtyPlus = card.querySelector('.qtyplus');
            const quantityBtn = card.querySelector('.quantity-btn');

            if (hasLockedDates) {
                if (quantityBtn) {
                    quantityBtn.classList.add('nights-locked');
                }
                if (qtyMinus) qtyMinus.disabled = true;
                if (qtyPlus) qtyPlus.disabled = true;
            } else {
                if (quantityBtn) {
                    quantityBtn.classList.remove('nights-locked');
                }
                if (qtyMinus) qtyMinus.disabled = false;
                if (qtyPlus) qtyPlus.disabled = false;
            }
        });
    }

    // Update Dates and Filter Instantly
    function updateDatesAndFilter() {
        const checkin = document.getElementById('checkInDate').value;
        const checkout = document.getElementById('checkoutDate').value;
        const guests = parseInt(document.getElementById('guestsSelect').value) || 0;
        const children = parseInt(document.getElementById('childrenSelect').value) || 0;
        
        // Check if both dates are selected
        const datesSelected = checkin && checkout;
        
        // Show/hide filter pills based on date selection
        const filterContainer = document.getElementById('bedFilterContainer');
        const roomsContainer = document.getElementById('rooms');
        const noDatesMessage = document.getElementById('noDatesMessage');
        
        if (datesSelected) {
            const checkinDate = new Date(checkin);
            const checkoutDate = new Date(checkout);
            
            // Validate dates
            if (checkoutDate <= checkinDate) {
                // Invalid date range - hide everything
                if (filterContainer) filterContainer.style.display = 'none';
                if (roomsContainer) roomsContainer.style.display = 'none';
                if (noDatesMessage) noDatesMessage.style.display = 'block';
                return;
            }
            
            // Valid dates - show filters and rooms
            if (filterContainer) filterContainer.style.display = 'flex';
            if (roomsContainer) roomsContainer.style.display = 'block';
            if (noDatesMessage) noDatesMessage.style.display = 'none';
            
            // Calculate nights
            const nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
            
            // Update search state
            searchState.checkin = checkin;
            searchState.checkout = checkout;
            searchState.guests = guests;
            searchState.children = children;
            searchState.nights = nights;
            
            // Update summary text
            updateSearchSummary();

            // Ensure all room cards reflect the new number of nights and totals instantly
            updateRoomNightsAndTotalsFromState();
            
            // Filter rooms by availability and capacity
            filterRoomsByAvailability();
            filterRooms();
        } else {
            // Dates not selected - hide filters and rooms, show message
            if (filterContainer) filterContainer.style.display = 'none';
            if (roomsContainer) roomsContainer.style.display = 'none';
            if (noDatesMessage) noDatesMessage.style.display = 'block';
        }
    }

    // Modify Search Function
    function modifySearch() {
        const checkin = document.getElementById('checkInDate').value;
        const checkout = document.getElementById('checkoutDate').value;
        const guests = parseInt(document.getElementById('guestsSelect').value) || 0;
        const children = parseInt(document.getElementById('childrenSelect').value) || 0;

        if (!checkin || !checkout) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Dates',
                text: 'Please select both check-in and check-out dates',
                confirmButtonColor: '#91278f'
            });
            // Hide filters and rooms if dates not selected
            const filterContainer = document.getElementById('bedFilterContainer');
            const roomsContainer = document.getElementById('rooms');
            const noDatesMessage = document.getElementById('noDatesMessage');
            if (filterContainer) filterContainer.style.display = 'none';
            if (roomsContainer) roomsContainer.style.display = 'none';
            if (noDatesMessage) noDatesMessage.style.display = 'block';
            return;
        }

        const checkinDate = new Date(checkin);
        const checkoutDate = new Date(checkout);
        
        if (checkoutDate <= checkinDate) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Dates',
                text: 'Check-out date must be after check-in date',
                confirmButtonColor: '#91278f'
            });
            // Hide filters and rooms if invalid dates
            const filterContainer = document.getElementById('bedFilterContainer');
            const roomsContainer = document.getElementById('rooms');
            const noDatesMessage = document.getElementById('noDatesMessage');
            if (filterContainer) filterContainer.style.display = 'none';
            if (roomsContainer) roomsContainer.style.display = 'none';
            if (noDatesMessage) noDatesMessage.style.display = 'block';
            return;
        }

        // Redirect to same page with search params so room details (nights, price) reflect selection
        const params = new URLSearchParams();
        params.set('checkin', checkin);
        params.set('checkout', checkout);
        params.set('adults', String(guests));
        params.set('children', String(children));
        window.location = window.location.pathname + '?' + params.toString();
    }

    // Update Search Summary
    function updateSearchSummary() {
        const summaryDiv = document.getElementById('searchSummary');
        const roomDetailsHeader = document.getElementById('roomDetailsHeader');
        
        if (!searchState.checkin || !searchState.checkout) {
            const defaultText = 'Select dates and guests to see pricing';
            if (summaryDiv) summaryDiv.textContent = defaultText;
            if (roomDetailsHeader) roomDetailsHeader.textContent = defaultText;
            return;
        }

        const totalPersons = searchState.guests + searchState.children;
        let text = `For ${totalPersons} ${totalPersons === 1 ? 'Person' : 'Persons'}`;
        
        if (searchState.guests > 0 && searchState.children > 0) {
            text = `For ${searchState.guests} Adult${searchState.guests > 1 ? 's' : ''}, ${searchState.children} ${searchState.children > 1 ? 'Children' : 'Child'}`;
        } else if (searchState.guests > 0) {
            text = `For ${searchState.guests} Adult${searchState.guests > 1 ? 's' : ''}`;
        } else if (searchState.children > 0) {
            text = `For ${searchState.children} ${searchState.children > 1 ? 'Children' : 'Child'}`;
        }
        
        text += `, for ${searchState.nights} Night${searchState.nights > 1 ? 's' : ''}`;
        
        if (summaryDiv) summaryDiv.textContent = text;
        if (roomDetailsHeader) roomDetailsHeader.textContent = text;
    }

    // Filter Rooms by Beds
    function filterRoomsByBeds() {
        const selectedBed = document.querySelector('input[name="bedFilter"]:checked')?.value || 'all';
        searchState.bedFilter = selectedBed;
        
        // Always re-apply all filters when bed filter changes
        // This ensures availability filter is respected
        if (searchState.checkin && searchState.checkout) {
            filterRoomsByAvailability();
        }
        filterRooms();
    }

    // Main Filter Function
    function filterRooms() {
        const rooms = document.querySelectorAll('.hotel-all-card');
        let visibleCount = 0;

        rooms.forEach(room => {
            let show = true;

            // Get room data
            const totalBeds = parseInt(room.getAttribute('data-beds')) || 0;
            const capacity = parseInt(room.getAttribute('data-capacity')) || 0;

            // Filter by beds - if 'all' is selected, don't filter by beds (show all)
            if (searchState.bedFilter !== 'all') {
                const bedFilterNum = parseInt(searchState.bedFilter);
                if (bedFilterNum === 3) {
                    show = totalBeds >= 3;
                } else {
                    show = totalBeds === bedFilterNum;
                }
            }
            // If bedFilter is 'all', show remains true (show all rooms)

            // Filter by capacity (guests + children)
            if (show && (searchState.guests > 0 || searchState.children > 0)) {
                const totalPersons = searchState.guests + searchState.children;
                show = capacity >= totalPersons;
            }

            // Respect availability filter - if room is hidden by availability, keep it hidden
            // Check if room was hidden by availability filter
            const checkin = document.getElementById('checkInDate')?.value;
            const checkout = document.getElementById('checkoutDate')?.value;
            
            if (show && checkin && checkout) {
                // If dates are selected, check availability
                const roomId = Number(room.getAttribute('data-room-id'));
                const roomData = roomsData.find(r => Number(r.id) === roomId);
                
                if (roomData) {
                    // If room has availability_dates set, check if dates match
                    if (roomData.availability_dates && roomData.availability_dates.length > 0) {
                        const checkinDate = new Date(checkin);
                        const checkoutDate = new Date(checkout);
                        const datesInRange = [];
                        const currentDate = new Date(checkinDate);
                        while (currentDate < checkoutDate) {
                            datesInRange.push(currentDate.toISOString().split('T')[0]);
                            currentDate.setDate(currentDate.getDate() + 1);
                        }
                        
                        const allDatesAvailable = datesInRange.every(date => {
                            return roomData.availability_dates.includes(date);
                        });
                        
                        if (!allDatesAvailable) {
                            show = false;
                        }
                    }
                }
            }

            // Show/hide room
            if (show) {
                room.style.display = '';
                visibleCount++;
            } else {
                room.style.display = 'none';
            }
        });

        // Show message if no rooms found
        if (visibleCount === 0) {
            showNoRoomsMessage();
        } else {
            hideNoRoomsMessage();
        }
    }

    // Clear All Filters
    function clearAllFilters() {
        // Reset form
        document.getElementById('searchForm').reset();
        document.getElementById('ALLROOMS').checked = true;
        
        // Reset state
        searchState = {
            checkin: null,
            checkout: null,
            guests: 0,
            children: 0,
            nights: 0,
            bedFilter: 'all'
        };

        // Set check-in to today
        const today = new Date();
        document.getElementById('checkInDate').value = today.toISOString().substr(0, 10);
        
        // Reset summary
        document.getElementById('searchSummary').textContent = 'Select dates and guests to see pricing';
        
        // Show all rooms
        const rooms = document.querySelectorAll('.hotel-all-card');
        rooms.forEach(room => {
            room.style.display = '';
        });
        
        // Filter rooms by availability (will show all if no dates)
        filterRoomsByAvailability();
        
        hideNoRoomsMessage();
    }

    // Show No Rooms Message
    function showNoRoomsMessage() {
        let noRoomsDiv = document.getElementById('noRoomsMessage');
        if (!noRoomsDiv) {
            noRoomsDiv = document.createElement('div');
            noRoomsDiv.id = 'noRoomsMessage';
            noRoomsDiv.style.cssText = 'text-align: center; padding: 60px 30px; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border-radius: 12px; margin: 30px 0; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 2px dashed #e0e0e0;';
            noRoomsDiv.innerHTML = `
                <div style="margin-bottom: 25px;">
                    <i class="fa fa-search" style="font-size: 64px; color: #91278f; opacity: 0.3; margin-bottom: 20px;"></i>
                </div>
                <h3 style="color: #333; margin-bottom: 15px; font-size: 24px; font-weight: 600;">No Rooms Available</h3>
                <p style="color: #666; margin-bottom: 25px; font-size: 16px; line-height: 1.6; max-width: 500px; margin-left: auto; margin-right: auto;">
                    We couldn't find any rooms matching your search criteria. Please try adjusting your dates, guest count, or room filters.
                </p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <button onclick="clearAllFilters()" style="background: #91278f; color: white; border: none; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.3s; box-shadow: 0 2px 8px rgba(145, 39, 143, 0.3);">
                        <i class="fa fa-refresh" style="margin-right: 8px;"></i>Clear All Filters
                    </button>
                    <button onclick="document.getElementById('searchForm').scrollIntoView({behavior: 'smooth', block: 'center'})" style="background: white; color: #91278f; border: 2px solid #91278f; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.3s;">
                        <i class="fa fa-calendar" style="margin-right: 8px;"></i>Modify Search
                    </button>
                </div>
            `;
            
            const hotelRoom = document.querySelector('.hotel-room');
            if (hotelRoom) {
                hotelRoom.appendChild(noRoomsDiv);
            }
        }
        noRoomsDiv.style.display = 'block';
        
        // Also update the room details header
        const roomDetailsHeader = document.getElementById('roomDetailsHeader');
        if (roomDetailsHeader) {
            roomDetailsHeader.textContent = 'No rooms available for selected criteria';
            roomDetailsHeader.style.color = '#e74c3c';
        }
    }

    // Hide No Rooms Message
    function hideNoRoomsMessage() {
        const noRoomsDiv = document.getElementById('noRoomsMessage');
        if (noRoomsDiv) {
            noRoomsDiv.style.display = 'none';
        }
        
        // Reset room details header color
        const roomDetailsHeader = document.getElementById('roomDetailsHeader');
        if (roomDetailsHeader) {
            roomDetailsHeader.style.color = '';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Set min date for check-in (today)
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('checkInDate').setAttribute('min', today);
        document.getElementById('checkoutDate').setAttribute('min', today);
        
        // Check initial state - if dates are in URL, show filters and rooms
        const checkin = document.getElementById('checkInDate')?.value;
        const checkout = document.getElementById('checkoutDate')?.value;
        const filterContainer = document.getElementById('bedFilterContainer');
        const roomsContainer = document.getElementById('rooms');
        const noDatesMessage = document.getElementById('noDatesMessage');
        
        if (checkin && checkout) {
            // Dates are selected - show filters and rooms
            if (filterContainer) filterContainer.style.display = 'flex';
            if (roomsContainer) roomsContainer.style.display = 'block';
            if (noDatesMessage) noDatesMessage.style.display = 'none';
        } else {
            // No dates selected - hide filters and rooms, show message
            if (filterContainer) filterContainer.style.display = 'none';
            if (roomsContainer) roomsContainer.style.display = 'none';
            if (noDatesMessage) noDatesMessage.style.display = 'block';
        }
        
        // Open date picker when clicking anywhere inside the date input (not just the icon)
        ['checkInDate', 'checkoutDate'].forEach(function(id) {
            const el = document.getElementById(id);
            if (el && typeof el.showPicker === 'function') {
                el.addEventListener('click', function() { this.showPicker(); });
            }
        });

        // Update checkout min date when checkin changes
        document.getElementById('checkInDate').addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            checkinDate.setDate(checkinDate.getDate() + 1);
            document.getElementById('checkoutDate').setAttribute('min', checkinDate.toISOString().split('T')[0]);
            // Filter rooms when check-in date changes
            filterRoomsByAvailability();
        });
        
        // Filter rooms when check-out date changes
        document.getElementById('checkoutDate').addEventListener('change', function() {
            filterRoomsByAvailability();
        });
        
        // Filter rooms on initial page load if dates are already set
        filterRoomsByAvailability();
    });
    
    // Review System JavaScript
    const hotelId = {!! json_encode(\Illuminate\Support\Facades\Crypt::encrypt($show->id)) !!};
    const categoryRatingIds = ['staff_rating', 'facilities_rating', 'cleanliness_rating', 
                              'location_rating', 'comfort_rating', 'value_for_money_rating', 'free_wifi_rating'];
    
    function updateSliderFill(slider) {
        if (!slider) return;
        const val = parseFloat(slider.value) || 0;
        const min = parseFloat(slider.min) || 0;
        const max = parseFloat(slider.max) || 10;
        const percent = ((val - min) / (max - min)) * 100;
        slider.style.setProperty('--slider-fill', percent + '%');
    }
    
    function updateOverallRating() {
        let sum = 0;
        let count = 0;
        categoryRatingIds.forEach(inputId => {
            const input = document.getElementById(inputId);
            if (input && input.value) {
                sum += parseFloat(input.value) || 0;
                count++;
            }
        });
        const avg = count > 0 ? (sum / count) : 0;
        const rounded = Math.round(avg * 10) / 10;
        const display = document.getElementById('overall_rating_display');
        const hidden = document.getElementById('overall_rating');
        if (display) display.textContent = rounded.toFixed(1);
        if (hidden) hidden.value = rounded;
    }
    
    // Check if user can review on page load
    document.addEventListener('DOMContentLoaded', function() {
        checkCanReview();
        loadReviews();
        
        // Category rating display updates and overall rating auto-calculation
        categoryRatingIds.forEach(inputId => {
            const input = document.getElementById(inputId);
            if (input) {
                updateSliderFill(input);
                input.addEventListener('input', function() {
                    const displayId = inputId + '_display';
                    const display = document.getElementById(displayId);
                    if (display) {
                        display.textContent = parseFloat(this.value).toFixed(1);
                    }
                    updateSliderFill(this);
                    updateOverallRating();
                });
            }
        });
        updateOverallRating();
        const reviewBookingSelect = document.getElementById('review_booking_select');
        if (reviewBookingSelect) reviewBookingSelect.addEventListener('change', onReviewBookingSelect);
    });
    
    // Check if user can review
    function checkCanReview() {
        fetch(`/reviews/can-review/${hotelId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.can_review) {
                    const addReviewBtn = document.getElementById('add-review-btn');
                    if (addReviewBtn) {
                        addReviewBtn.style.display = 'none';
                    }
                }
            })
            .catch(error => {
                console.error('Error checking review eligibility:', error);
            });
    }
    
    let reviewBookingsData = [];
    
    function loadReviewBookings() {
        const select = document.getElementById('review_booking_select');
        const details = document.getElementById('review-stay-details');
        const loading = document.getElementById('review-booking-loading');
        const error = document.getElementById('review-booking-error');
        const hidden = document.getElementById('review_booking_id');
        if (!select) return;
        select.innerHTML = '<option value="">-- Select your stay --</option>';
        if (details) details.style.display = 'none';
        if (hidden) hidden.value = '';
        if (error) error.style.display = 'none';
        if (loading) loading.style.display = 'block';
        reviewBookingsData = [];
        fetch(`/reviews/bookings/${hotelId}`)
            .then(r => r.json())
            .then(data => {
                if (loading) loading.style.display = 'none';
                if (data.success && data.bookings && data.bookings.length > 0) {
                    reviewBookingsData = data.bookings;
                    data.bookings.forEach(function(b) {
                        const opt = document.createElement('option');
                        opt.value = b.id;
                        opt.textContent = b.room_names + ' - ' + b.checkin_date + ' to ' + b.checkout_date + ' (' + b.nights_label + ') - ' + b.invoice_number;
                        select.appendChild(opt);
                    });
                } else {
                    if (error) {
                        error.textContent = data.message || 'No bookings found for this hotel.';
                        error.style.display = 'block';
                    }
                }
            })
            .catch(function(err) {
                if (loading) loading.style.display = 'none';
                if (error) {
                    error.textContent = 'Could not load your bookings. Please refresh the page.';
                    error.style.display = 'block';
                }
            });
    }
    
    function onReviewBookingSelect() {
        const select = document.getElementById('review_booking_select');
        const details = document.getElementById('review-stay-details');
        const hidden = document.getElementById('review_booking_id');
        const bid = select && select.value ? parseInt(select.value) : 0;
        if (hidden) hidden.value = bid;
        if (!bid || !details) {
            if (details) details.style.display = 'none';
            return;
        }
        const b = reviewBookingsData.find(function(x) { return x.id == bid; });
        if (b) {
            document.getElementById('stay-room-names').textContent = b.room_names;
            document.getElementById('stay-checkin').textContent = b.checkin_date;
            document.getElementById('stay-checkout').textContent = b.checkout_date;
            document.getElementById('stay-nights').textContent = b.nights_label;
            details.style.display = 'block';
        }
    }
    
    // Show review form
    function showReviewForm() {
        const formSection = document.getElementById('review-form-section');
        const buttonSection = document.getElementById('add-review-button-section');
        
        if (formSection && buttonSection) {
            formSection.style.display = 'block';
            buttonSection.style.display = 'none';
            formSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            loadReviewBookings();
            categoryRatingIds.forEach(function(id) {
                updateSliderFill(document.getElementById(id));
            });
        }
    }
    
    // Close review form
    function closeReviewForm() {
        const formSection = document.getElementById('review-form-section');
        const buttonSection = document.getElementById('add-review-button-section');
        
        if (formSection && buttonSection) {
            formSection.style.display = 'none';
            buttonSection.style.display = 'block';
            document.getElementById('reviewForm').reset();
            const details = document.getElementById('review-stay-details');
            if (details) details.style.display = 'none';
            setTimeout(function() {
                categoryRatingIds.forEach(function(id) {
                    updateSliderFill(document.getElementById(id));
                });
                updateOverallRating();
            }, 0);
        }
    }
    
    // Handle review form submission
    document.getElementById('reviewForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const bidInput = document.getElementById('review_booking_id');
        if (!bidInput || !bidInput.value) {
            Swal.fire({
                icon: 'warning',
                title: 'Select Your Stay',
                text: 'Please select which stay you would like to review.',
                confirmButtonColor: '#91278f'
            });
            return;
        }
        updateOverallRating();
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
        
        fetch('/reviews/store', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                               document.querySelector('input[name="_token"]')?.value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Review Submitted!',
                    text: data.message,
                    confirmButtonColor: '#91278f'
                }).then(() => {
                    closeReviewForm();
                    location.reload(); // Reload to show updated reviews
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to submit review',
                    confirmButtonColor: '#91278f'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while submitting your review',
                confirmButtonColor: '#91278f'
            });
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    });
    
    // Load reviews for modal
    function loadReviews(sortBy = 'most_relevant') {
        const container = document.getElementById('reviewsContainer');
        if (!container) return;
        
        container.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Loading reviews...</p></div>';
        
        fetch(`/reviews/hotel/${hotelId}?sort=${sortBy}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderReviews(data.reviews);
                } else {
                    container.innerHTML = '<div class="text-center py-5"><p class="text-muted">No reviews found</p></div>';
                }
            })
            .catch(error => {
                console.error('Error loading reviews:', error);
                container.innerHTML = '<div class="text-center py-5"><p class="text-danger">Error loading reviews</p></div>';
            });
    }
    
    // Render reviews in modal
    function renderReviews(reviews) {
        const container = document.getElementById('reviewsContainer');
        if (!container) return;
        
        if (!reviews || reviews.length === 0) {
            container.innerHTML = '<div class="text-center py-5"><p class="text-muted">No reviews yet. Be the first to review!</p></div>';
            return;
        }
        
        let html = '';
        reviews.forEach((review, index) => {
            const guest = review.guest || {};
            const guestName = guest.name || 'Guest';
            const guestCountry = guest.address ? guest.address.split(',').pop().trim() : 'Unknown';
            const guestInitial = guestName.charAt(0).toUpperCase();
            
            // Get booking info if available - filter rooms by this hotel
            const booking = review.booking || {};
            const roomsData = booking.rooms_data || [];
            const hotelId = parseInt(review.hotel_id) || 0;
            const hotelRooms = roomsData.filter(r => (parseInt(r.hotelId) || 0) === hotelId);
            const roomNames = hotelRooms.length > 0 
                ? hotelRooms.map(r => (r.quantity || 1) + 'x ' + (r.roomName || 'Room')).join(', ')
                : (roomsData[0] ? (roomsData[0].quantity || 1) + 'x ' + (roomsData[0].roomName || 'Room') : 'Room');
            const checkinDate = booking.checkin_date ? new Date(booking.checkin_date) : null;
            const checkoutDate = booking.checkout_date ? new Date(booking.checkout_date) : null;
            const nights = booking.total_nights || (checkinDate && checkoutDate ? Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24)) : null);
            const checkinStr = checkinDate ? checkinDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '';
            const checkoutStr = checkoutDate ? checkoutDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '';
            const monthYear = checkinDate ? checkinDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' }) : '';
            
            // Get rating sentiment
            const rating = parseFloat(review.overall_rating) || 0;
            let sentiment = 'No Rating';
            if (rating >= 9.0) sentiment = 'Exceptional';
            else if (rating >= 8.0) sentiment = 'Excellent';
            else if (rating >= 7.0) sentiment = 'Very Good';
            else if (rating >= 6.0) sentiment = 'Good';
            else if (rating >= 5.0) sentiment = 'Average';
            else if (rating > 0) sentiment = 'Poor';
            
            // Format review date
            const reviewDate = new Date(review.created_at);
            const formattedDate = reviewDate.toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' });
            
            // Handle images
            let imagesHtml = '';
            if (review.images && Array.isArray(review.images) && review.images.length > 0) {
                imagesHtml = '<div class="review-hotel-rrom-gallery mt-3"><div class="row g-2">';
                review.images.forEach((image, imgIndex) => {
                    let imageUrl = '';
                    if (image.indexOf('http') === 0) {
                        imageUrl = image;
                    } else if (image.indexOf('uploads/') === 0) {
                        imageUrl = `{{ asset('') }}${image}`;
                    } else if (image.indexOf('storage/') === 0) {
                        imageUrl = `{{ asset('') }}${image}`;
                    } else {
                        imageUrl = `{{ asset('uploads/reviews/') }}${image}`;
                    }
                    imagesHtml += `<div class="col-6 col-md-4 col-lg-3">
                        <div class="review-image-wrapper" style="position: relative; overflow: hidden; border-radius: 8px; cursor: pointer; aspect-ratio: 1; background: #f0f0f0;">
                            <img class="img-fluid review-thumbnail" src="${imageUrl}" alt="Review Image" 
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                 onclick="openReviewImageModal('${imageUrl}', ${review.images.length}, ${imgIndex}, [${review.images.map(img => {
                                     if (img.indexOf('http') === 0) return `'${img}'`;
                                     else if (img.indexOf('uploads/') === 0) return `'{{ asset('') }}${img}'`;
                                     else if (img.indexOf('storage/') === 0) return `'{{ asset('') }}${img}'`;
                                     else return `'{{ asset('uploads/reviews/') }}${img}'`;
                                 }).join(',')}])"
                                 onmouseover="this.style.transform='scale(1.05)'"
                                 onmouseout="this.style.transform='scale(1)'">
                        </div>
                    </div>`;
                });
                imagesHtml += '</div></div>';
            }
            
            html += `
                <div class="row mb-20">
                    <div class="col-lg-4">
                        <div class="review-profile-left">
                            <div class="review-header-modal">
                                <div class="reviewer-info" style="display: flex; align-items: center; margin-bottom: 20px;">
                                    <div class="reviewer-avatar" style="width: 60px; height: 60px; border-radius: 50%; background: #6576ff; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; margin-right: 15px; flex-shrink: 0;">
                                        ${guestInitial}
                                    </div>
                                    <div class="reviewer-details">
                                        <h3 class="reviewer-name" style="margin: 0; font-size: 17px; font-weight: 600; color: #1a1a1a;">${guestName}</h3>
                                        <p class="reviewer-country" style="margin: 4px 0 0 0; font-size: 14px; color: #6c757d;">${guestCountry}</p>
                                    </div>
                                </div>
                                <div class="review-meta" style="font-size: 14px; color: #495057; line-height: 2;">
                                    ${roomNames ? `<p style="margin: 0 0 4px 0; display: flex; align-items: center; gap: 10px;"><span style="color: #6c757d;"><i class="fa fa-bed" style="width: 16px;"></i></span><span>${roomNames}</span></p>` : ''}
                                    ${nights && monthYear ? `<p style="margin: 0 0 4px 0; display: flex; align-items: center; gap: 10px;"><span style="color: #6c757d;"><i class="fa fa-calendar" style="width: 16px;"></i></span><span>${nights} night${nights > 1 ? 's' : ''} · ${monthYear}</span></p>` : ''}
                                    ${booking.relationship ? `<p style="margin: 0; display: flex; align-items: center; gap: 10px;"><span style="color: #6c757d;"><i class="fa fa-users" style="width: 16px;"></i></span><span>${booking.relationship === 'family' ? 'Family' : booking.relationship === 'friends' ? 'Friends' : booking.relationship === 'colleagues' ? 'Colleagues' : booking.relationship === 'husband' ? 'Couple' : 'Solo'}</span></p>` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="review-profile-details">
                            <div class="review-inner-1">
                                <div class="review-details">
                                    ${review.is_featured ? `<span class="reviewer-choice"><span><span class="fcd9eec8fb fb4ef8dd02 fc17714355" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20px"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12C23.993 5.376 18.624.007 12 0m6.216 10.376-2.788 2.485a.5.5 0 0 0-.126.572l1.629 3.749a.5.5 0 0 1-.7.634l-3.982-2.242a.5.5 0 0 0-.491 0l-3.985 2.242a.5.5 0 0 1-.7-.634L8.7 13.433a.5.5 0 0 0-.126-.572l-2.79-2.485a.5.5 0 0 1 .332-.876h3.31a.5.5 0 0 0 .46-.3l1.655-3.84a.5.5 0 0 1 .918 0l1.655 3.84a.5.5 0 0 0 .46.3h3.31a.5.5 0 0 1 .332.873z"></path></svg></span></span> Reviewers' choice</span>` : ''}
                                    <span class="review-date">Reviewed: ${formattedDate}</span>
                                    <div class="review-header">
                                        <h4 class="review-title">${sentiment}</h4>
                                        <div class="rating">
                                            <h2 class="rating-score">${Math.round(rating)}</h2>
                                        </div>
                                    </div>
                                    ${review.comment ? `<P>${review.comment}</P>` : ''}
                                    ${review.pros ? `<p class="review-text positive">😊 ${review.pros}</p>` : ''}
                                    ${review.cons ? `<p class="review-text negative">☹️ ${review.cons}</p>` : ''}
                                </div>
                            </div>
                            ${imagesHtml}
                            ${review.hotel_response ? `<div class="hotel-response"><h5 class="response-title">Hotel response:</h5><p>${review.hotel_response}</p></div>` : ''}
                        </div>
                    </div>
                    ${index < reviews.length - 1 ? '<hr class="b9bfeba2b4 b288f61df6" aria-hidden="true">' : ''}
                </div>
            `;
        });
        
        container.innerHTML = html;
    }
    
    // Load reviews when modal opens
    const reviewModal = document.getElementById('rightSidebarModal');
    if (reviewModal) {
        reviewModal.addEventListener('show.bs.modal', function() {
            loadReviews('most_relevant');
        });
    }
    
    // Handle sort change in modal
    document.getElementById('reviewSortSelect')?.addEventListener('change', function() {
        const sortValue = this.value;
        loadReviews(sortValue);
    });

    // Review Image Modal Functions
    let currentImageIndex = 0;
    let currentImageArray = [];

    function openReviewImageModal(imageUrl, totalImages, currentIndex, imageArray) {
        currentImageArray = imageArray;
        currentImageIndex = currentIndex;
        
        const modal = new bootstrap.Modal(document.getElementById('reviewImageModal'));
        document.getElementById('reviewModalImage').src = imageUrl;
        updateImageCounter();
        updateNavigationButtons();
        modal.show();
    }

    function updateImageCounter() {
        const counter = document.getElementById('imageCounter');
        counter.textContent = `${currentImageIndex + 1} / ${currentImageArray.length}`;
    }

    function updateNavigationButtons() {
        const prevBtn = document.getElementById('prevImageBtn');
        const nextBtn = document.getElementById('nextImageBtn');
        
        prevBtn.style.display = currentImageArray.length > 1 ? 'flex' : 'none';
        nextBtn.style.display = currentImageArray.length > 1 ? 'flex' : 'none';
        
        prevBtn.disabled = currentImageIndex === 0;
        nextBtn.disabled = currentImageIndex === currentImageArray.length - 1;
    }

    document.getElementById('prevImageBtn')?.addEventListener('click', function() {
        if (currentImageIndex > 0) {
            currentImageIndex--;
            document.getElementById('reviewModalImage').src = currentImageArray[currentImageIndex];
            updateImageCounter();
            updateNavigationButtons();
        }
    });

    document.getElementById('nextImageBtn')?.addEventListener('click', function() {
        if (currentImageIndex < currentImageArray.length - 1) {
            currentImageIndex++;
            document.getElementById('reviewModalImage').src = currentImageArray[currentImageIndex];
            updateImageCounter();
            updateNavigationButtons();
        }
    });

    // Keyboard navigation for image modal
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('reviewImageModal');
        if (modal && modal.classList.contains('show')) {
            if (e.key === 'ArrowLeft' && currentImageIndex > 0) {
                document.getElementById('prevImageBtn').click();
            } else if (e.key === 'ArrowRight' && currentImageIndex < currentImageArray.length - 1) {
                document.getElementById('nextImageBtn').click();
            } else if (e.key === 'Escape') {
                bootstrap.Modal.getInstance(modal).hide();
            }
        }
    });

    // Message button UI (Host Profile tab)
    document.addEventListener('DOMContentLoaded', function() {
        const openBtn = document.getElementById('openMessageBtn');
        const composePanel = document.getElementById('messageComposePanel');
        const closeBtn = document.getElementById('closeMessageCompose');
        const sendBtn = document.getElementById('sendMessageBtn');
        const messageInput = document.getElementById('messageTextInput');
        const sentBubble = document.getElementById('messageSentBubble');
        const continueBtn = document.getElementById('messageBubbleContinue');
        const inboxBtn = document.getElementById('floatingInboxButton');
        const inboxBadge = document.getElementById('inboxUnreadBadge');

        if (!openBtn || !composePanel) return;

        openBtn.addEventListener('click', function() {
            composePanel.style.display = 'block';
            sentBubble.style.display = 'none';
            messageInput.value = '';
        });

        if (closeBtn) closeBtn.addEventListener('click', function() {
            composePanel.style.display = 'none';
        });

        if (sendBtn) sendBtn.addEventListener('click', function() {
            composePanel.style.display = 'none';
            sentBubble.style.display = 'block';
            // Simulate 1 unread in inbox when a message is sent
            if (inboxBadge) {
                inboxBadge.style.display = 'flex';
                inboxBadge.textContent = '1';
            }
        });

        if (continueBtn) continueBtn.addEventListener('click', function() {
            sentBubble.style.display = 'none';
        });

        // Floating inbox button opens the compose panel (or could link to a real inbox page)
        if (inboxBtn) {
            inboxBtn.addEventListener('click', function () {
                sentBubble.style.display = 'none';
                composePanel.style.display = 'block';
                if (inboxBadge) {
                    inboxBadge.style.display = 'none';
                }
            });
        }
    });
</script>

@endsection

