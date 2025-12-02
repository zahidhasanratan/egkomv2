@extends('frontend.hotelMaster')
@section('title','EGKom')
@section('main')
    <!--===== INNERPAGE-WRAPPER ====-->
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
                                                 src="{{ asset('/')}}{{ optional(\App\Models\Vendor::find($show->vendor_id))->logo }}
                                                     ">
                                        </div>

                                        <div data-v-58caae98="" class="d-flex align-items-start">
                                        <span data-v-002f304c="" data-v-58caae98="" class="rating-wrapper">
                                           <svg data-v-002f304c="" width="12" height="12" viewBox="0 0 12 12"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <path data-v-002f304c="" d="M11.3642 4.06484L8.09329 3.58798L6.63135 0.623797C6.36941 0.0954392 5.61046 0.0887228
                                                 5.34628 0.623797L3.88434 3.58798L0.613443 4.06484C0.0268763 4.14992 -0.208198 4.87305 0.217175
                                                 5.28723L2.58359 7.5932L2.02389 10.8507C1.92314 11.4395 2.54329 11.8805 3.0627 11.6051L5.98882
                                                 10.0671L8.91494 11.6051C9.43434 11.8783 10.0545 11.4395 9.95374 10.8507L9.39404 7.5932L11.7605
                                                 5.28723C12.1858 4.87305 11.9508 4.14992 11.3642 4.06484V4.06484Z"
                                                    fill="white" fill-opacity="0.01"></path>
                                              <mask data-v-002f304c="" id="mask0_1025_22137" maskUnits="userSpaceOnUse"
                                                    x="0" y="0" width="12" height="12" style="mask-type: alpha;">
                                                 <path data-v-002f304c="" d="M11.3642 4.06484L8.09329 3.58798L6.63135 0.623797C6.36941 0.0954392 5.61046
                                                    0.0887228 5.34628 0.623797L3.88434 3.58798L0.613443 4.06484C0.0268763 4.14992 -0.208198
                                                    4.87305 0.217175 5.28723L2.58359 7.5932L2.02389 10.8507C1.92314 11.4395 2.54329 11.8805
                                                    3.0627 11.6051L5.98882 10.0671L8.91494 11.6051C9.43434 11.8783 10.0545 11.4395 9.95374
                                                    10.8507L9.39404 7.5932L11.7605 5.28723C12.1858 4.87305 11.9508 4.14992 11.3642
                                                    4.06484V4.06484Z" fill="white"></path>
                                              </mask>
                                              <g data-v-002f304c="" mask="url(#mask0_1025_22137)">
                                                 <rect data-v-002f304c="" width="12" height="12" fill="#FCCD03"></rect>
                                              </g>
                                           </svg>
                                           <span data-v-002f304c="" class="rating-number">5 Star</span>
                                        </span>
                                            <div data-v-58caae98="" class="location">
                                                <a data-v-58caae98="" target="_blank"
                                                   href="https://www.google.com/maps?q=21.2156613574987200000000000,92.0488919829189300000000000"
                                                   class="location-link">
                                                    <svg data-v-58caae98="" width="12" height="14" viewBox="0 0 12 14"
                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path data-v-58caae98="" fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M5.99984 7.66667C4.71317 7.66667 3.6665 6.62 3.6665 5.33333C3.6665 4.04667 4.71317 3 5.99984 3C7.2865 3 8.33317 4.04667 8.33317 5.33333C8.33317 6.62 7.2865 7.66667 5.99984 7.66667ZM5.99984 0.333332C3.05917 0.333332 0.666504 2.70267 0.666504 5.61533C0.666504 9.26467 5.36584 13.3347 5.56584 13.506C5.69117 13.6133 5.84517 13.6667 5.99984 13.6667C6.1545 13.6667 6.3085 13.6133 6.43384 13.506C6.63384 13.3347 11.3332 9.26467 11.3332 5.61533C11.3332 2.70267 8.9405 0.333332 5.99984 0.333332Z"
                                                              fill="#546378"></path>
                                                    </svg>
                                                    <span data-v-58caae98=""> {{ $show->address }} </span>
                                                </a>
                                            </div>
                                        </div>

                                        <div data-v-58caae98="" class="couple-friendly-card">
                                         <span data-v-4323310d="" data-v-58caae98="" class="guest-tags-container">
                                            <!---->
                                            <span data-v-01d7cf4a="" data-v-4323310d="" class="hotel-guest-tag">
                                               <span data-v-01d7cf4a="" id="tag-for-couples"
                                                     class="guest-type-tag for-couples">
                                                  <svg data-v-01d7cf4a="" width="9" height="14" viewBox="0 0 9 14"
                                                       fill="none" xmlns="http://www.w3.org/2000/svg">
                                                     <use data-v-01d7cf4a="" xlink:href="#couple-tag"></use>
                                                  </svg>
                                                  Couple Friendly
                                               </span>
                                                <!---->
                                               <svg data-v-01d7cf4a="" style="display: none;">
                                                  <symbol data-v-01d7cf4a="" id="couple-tag">
                                                     <g data-v-01d7cf4a="" clip-path="url(#clip0_3759_25068)">
                                                        <path data-v-01d7cf4a=""
                                                              d="M3.55554 1.50366H2.39844V3.23931H3.55554V1.50366Z"
                                                              fill="#F44586"></path>
                                                        <path data-v-01d7cf4a=""
                                                              d="M6.15893 1.50366H5.00183V3.23931H6.15893V1.50366Z"
                                                              fill="#F44586"></path>
                                                        <path data-v-01d7cf4a=""
                                                              d="M7.7836 12.4957C8.02825 12.2816 8.18382 11.968 8.18382 11.6182V6.42125C8.18382 6.2865 8.09072 6.16977 7.95965 6.13932L7.89455 6.12427V0.346648C7.89455 0.187048 7.76505 0.057373 7.60527 0.057373H0.952298C0.792698 0.057373 0.663023 0.187048 0.663023 0.346648V4.45547L0.438848 4.40367C0.352923 4.38407 0.262798 4.40437 0.193848 4.45915C0.124898 4.51392 0.0846477 4.59722 0.0846477 4.68542V11.6181C0.0846477 11.9679 0.240223 12.2815 0.485048 12.4955C0.240048 12.7099 0.0844727 13.0235 0.0844727 13.3733V13.6528C0.0844727 13.8124 0.214148 13.942 0.373748 13.942H7.89455C8.05415 13.942 8.18382 13.8125 8.184 13.6528V13.3733C8.184 13.0235 8.02842 12.7097 7.7836 12.4957ZM1.2414 0.635923H7.316V5.99092L6.1589 5.72387V4.39632H5.0018V5.45682L3.55542 5.1231V4.3965H2.39832V4.85622L1.24122 4.58917V0.635923H1.2414ZM6.98682 9.88152C6.74707 10.2462 5.71475 11.1133 5.49092 11.1133C5.27182 11.1133 4.23022 10.2431 3.99205 9.88152C3.87287 9.70057 3.78817 9.50072 3.80217 9.23822C3.82702 8.7736 4.20695 8.38982 4.67227 8.38982C5.15072 8.38982 5.42932 8.9003 5.48935 8.9003C5.55812 8.9003 5.84862 8.38982 6.30642 8.38982C6.77175 8.38982 7.15167 8.7736 7.17652 9.23822C7.1907 9.5009 7.10635 9.69987 6.98682 9.88152ZM1.0923 8.1016C1.12467 7.49627 1.61957 6.99647 2.2256 6.99647C2.84877 6.99647 3.21155 7.6613 3.28977 7.6613C3.3792 7.6613 3.75772 6.99647 4.35395 6.99647C4.95997 6.99647 5.45487 7.49627 5.48725 8.1016C5.4918 8.18822 5.49232 8.26697 5.47972 8.34012C5.47115 8.38982 5.42442 8.42045 5.3847 8.37967C5.21127 8.2122 5.02577 8.09495 4.6721 8.09495C4.37057 8.09495 4.08392 8.21395 3.86482 8.42972C3.65045 8.64112 3.52357 8.92252 3.50747 9.22248C3.48717 9.6038 3.63365 9.87382 3.74547 10.0437C3.78012 10.0962 3.79395 10.1171 3.84767 10.1787C3.87375 10.2126 3.85327 10.2357 3.84015 10.2452C3.59357 10.4233 3.38655 10.5435 3.2917 10.5435C3.00645 10.5435 1.64967 9.41007 1.3394 8.93915C1.18417 8.70377 1.0741 8.44355 1.0923 8.1016ZM0.663023 13.3637C0.668273 13.044 0.930073 12.7851 1.2512 12.7851H7.0171H7.01727C7.33822 12.7851 7.6002 13.0438 7.60527 13.3637H0.663023Z"
                                                              fill="#F44586"></path>
                                                     </g>
                                                     <defs data-v-01d7cf4a="">
                                                        <clipPath data-v-01d7cf4a="" id="clip0_3759_25068">
                                                           <rect data-v-01d7cf4a="" width="8.26822" height="14"
                                                                 fill="white"></rect>
                                                        </clipPath>
                                                     </defs>
                                                  </symbol>
                                               </svg>
                                            </span>
                                             <!---->
                                             <!---->
                                             <!---->
                                         </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="hotel-preview hotel-nearby-lg">
                                    <div class="info-preview-container">
                                        <div class="hotel-heading-name">
                                            <div data-v-58caae98="" class="nearby">
                                                <div data-v-58caae98="" class="label"> What's Nearby</div>
                                                @foreach(json_decode($show->custom_nearby_areas) as $area)
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
                                <button type="button" class="btn btn-primary btn-custim-gallery" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    <span style="padding-right: 7px;"><i class="fa fa-solid fa-image"></i></span>
                                    View all photos
                                </button>
                            </div>
                            <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-car-offers">

                                @php
                                    $photoFields = [
                                        'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
                                        'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos',
                                        'rooftop_photos', 'gym_photos', 'security_photos', 'amenities_photos'
                                    ];
                                @endphp

                                @foreach($photoFields as $field)
                                    @php
                                        $photos = is_string($show->$field) ? json_decode($show->$field, true) : [];
                                    @endphp

                                    @if(!empty($photos) && is_array($photos))
                                        @foreach($photos as $bannerPhoto)
                                            <div class="item">
                                                <div class="main-block car-offer-block">
                                                    <div class="main-img room-main-image car-offer-img">
                                                        <a href="" data-bs-toggle="modal"
                                                           data-bs-target="#exampleModal">
                                                            <img src="{{ asset('/') . $bannerPhoto }}" class="img-fluid"
                                                                 alt="hotel"/>
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


                <!-- Tabing Menu -->
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
                                        <div data-v-58caae98="" class="landmark">
                                          <span data-v-58caae98="">
                                          <i data-v-58caae98="" class="icon icon-map-marker-grey location-pin"></i> 16.5 km from Himchori Waterfall </span>
                                        </div>
                                        <div data-v-58caae98="" class="landmark">
                                          <span data-v-58caae98="">
                                          <i data-v-58caae98="" class="icon icon-map-marker-grey location-pin"></i> 0.25 km from Navy Jetty, from where Saint Martin bound ship sails </span>
                                        </div>
                                        <div data-v-58caae98="" class="landmark">
                                          <span data-v-58caae98="">
                                          <i data-v-58caae98="" class="icon icon-map-marker-grey location-pin"></i> 3.2 km from Cox's Bazar Airport </span>
                                        </div>
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

                                        @foreach($show->facilities as $facility)
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

                                        <form>
                                            <div class="row">


                                                <div class="col-12 col-md-3">
                                                    <div class="form-group left-icon">
                                                        <input type="date" class="form-control dpd1" id="checkInDate"
                                                               placeholder="Check In">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div><!-- end columns -->

                                                <div class="col-12 col-md-3">
                                                    <div class="form-group left-icon">
                                                        <input type="date" class="form-control dpd1" id="checkoutDate"
                                                               placeholder="Check In">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div><!-- end columns -->

                                                <div class="col-6 col-md-6 col-lg-2">
                                                    <div class="form-group right-icon">
                                                        <select class="form-control">
                                                            <option selected="">Add Guests</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select>
                                                        <i class="fa fa-angle-down"></i>
                                                    </div>
                                                </div><!-- end columns -->


                                                <div class="col-6 col-md-6 col-lg-2">
                                                    <div class="form-group right-icon">
                                                        <select class="form-control">
                                                            <option selected="">Add Children</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select>
                                                        <i class="fa fa-angle-down"></i>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-12 col-xl-2">
                                                    <button class="btn btn-orange">Modify Search</button>
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
                    // Set the input field to today's date on page load
                    window.onload = function () {
                        const today = new Date();
                        const formattedDate = today.toISOString().substr(0, 10); // Format as YYYY-MM-DD
                        document.getElementById("checkInDate").value = formattedDate;
                    };

                </script>

                <style>
                    /* Wishlist Heart Icon Styles */
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
                    
                    .image-gallery {
                        position: relative;
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

                <div class="uitk-pill-container">
                    <div class="uitk-pill">
                        <input id="ALLROOMS" aria-checked="true" type="checkbox"
                               class="uitk-pill-standard is-visually-hidden" value="true" checked=""/>
                        <label class="uitk-pill-content" for="ALLROOMS" aria-label="All rooms"><span
                                class="uitk-pill-text">All rooms</span></label>
                    </div>
                    <div class="uitk-pill">
                        <input id="1BED" aria-checked="false" type="checkbox"
                               class="uitk-pill-standard is-visually-hidden" value="false"/><label
                            class="uitk-pill-content" for="1BED" aria-label="1 bed"><span
                                class="uitk-pill-text">1 bed</span></label>
                    </div>
                    <div class="uitk-pill">
                        <input id="2BEDS" aria-checked="false" type="checkbox"
                               class="uitk-pill-standard is-visually-hidden" value="false"/><label
                            class="uitk-pill-content" for="2BEDS" aria-label="2 beds"><span class="uitk-pill-text">2 beds</span></label>
                    </div>
                    <div class="uitk-pill">
                        <input id="3PLUSBEDS" aria-checked="false" type="checkbox"
                               class="uitk-pill-standard is-visually-hidden" value="false"/>
                        <label class="uitk-pill-content" for="3PLUSBEDS" aria-label="3 or more beds"><span
                                class="uitk-pill-text">3+ beds</span></label>
                    </div>
                    <div class="uitk-pill">
                        <a class="reset-btn" href="">Clear Filter</a>
                    </div>

                </div>

                <style type="text/css">
                    .room-card {
                        background-color: #FAFAFA;
                        height: 400px;
                        border-radius: 5px;
                    }
                </style>


                <div id="Room_Details" class="row">
                    <div class="col-md-12">
                        <div data-v-58caae98="" id="rooms">
                            <div data-v-58caae98="" class="row">
                                <div data-v-58caae98="" class="col-lg-9 col-md-12">
                                    <div data-v-58caae98="" class="room-section hotel-summary">
                                        <div data-v-58caae98="" class="room-details-header">
                                            <h2 data-v-58caae98="">Room Details</h2>
                                            <h2 data-v-58caae98=""> For 2 Adults, for 1 Night </h2>
                                        </div>


                                        <div class="hotel-room">

                                            @foreach(\App\Models\Room::where('hotel_id', $show->id)->get() as $roomList)

                                                <div class="hotel-all-card">
                                                    <div class="room-info">
                                                        <div class="room-feature-head">
                                                            <h3 class="room-title">{{ $roomList->name }}</h3>
                                                            <p class="room-numbers">Room # {{ $roomList->number }} <span
                                                                    class="floor-numbers">{{ $roomList->floor_number }}</span>
                                                            </p>

                                                        </div>
                                                        <div class="image-gallery multiple-row" data-bs-toggle="modal"
                                                             data-bs-target="#rightSidebarModalDetails"
                                                             data-room-id="{{ $roomList->id }}"
                                                             onclick="loadRoomDetails({{ $roomList->id }})">
                                                            {{-- Wishlist Heart Icon --}}
                                                            <div class="wishlist-heart-icon" 
                                                                 data-room-id="{{ $roomList->id }}"
                                                                 onclick="event.stopPropagation(); toggleWishlist({{ $roomList->id }})">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                            {{--                                                    {{ $roomList->id }}--}}
                                                            @php
                                                                $photos = \App\Models\RoomPhoto::where('room_id', $roomList->id)->where('category', 'feature')->get();
                                                            @endphp

                                                            @foreach($photos as $key => $feature)
                                                                @if($key == 0)
                                                                    {{-- Featured image --}}
                                                                    <div class="featured">
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
                                                                            <span> +{{ $photos->count() - 3 }} <i class="fas fa-images"></i></span>
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

                                                        </div>
                                                        <div class="show-amenities-modal mt-1 mb-2">
                                                            <span role="button" tabindex="0"><a href="javascript:void(0)"
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target="#rightSidebarModalDetails"
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

                                                                    <div class="review-cat">Fabulous</div>
                                                                    <div class="review-cat-home">8.9</div>

                                                                </div>
                                                                @php
                                                                    $originalPrice = $roomList->price_per_night;
                                                                    $discountedPrice = $originalPrice;
                                                                    $discountPercentage = 0;
                                                                    
                                                                    if ($roomList->discount_type == 'percentage' && $roomList->discount_percentage) {
                                                                        $discountPercentage = $roomList->discount_percentage;
                                                                        $discountedPrice = $originalPrice - ($originalPrice * $discountPercentage / 100);
                                                                    } elseif ($roomList->discount_type == 'amount' && $roomList->discount_amount) {
                                                                        $discountedPrice = $originalPrice - $roomList->discount_amount;
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
                                                                <div data-v-b6728cd0="" class="price-amount">
                                                                    @if($discountPercentage > 0)
                                                                    <span data-v-b6728cd0=""
                                                                          class="price-before-discount"> <del>BDT {{ number_format($originalPrice, 2) }}</del> </span>
                                                                    @endif
                                                                    <span class="amount">Total = BDT {{ number_format($discountedPrice, 2) }} </span>
                                                                    <p class="tax-tag"> Fee or Tax Will show at the
                                                                        check out page (if any) </p>
                                                                </div>

                                                                <div data-v-b6728cd0="" class="price-per"> Per Night
                                                                </div>


                                                                <div class="quantity-btn">
                                                                    <form action="">
                                                                        <p class="qty qty-room">
                                                                            <button type="button" class="qtyminus" data-room-id="{{ $roomList->id }}"
                                                                                    aria-hidden="true">&minus;
                                                                            </button>
                                                                            <input type="number" name="qty" id="qty-{{ $roomList->id }}"
                                                                                   min="1" max="{{ $roomList->total_rooms ?? 10 }}" step="1" value="1">
                                                                            <button type="button" class="qtyplus" data-room-id="{{ $roomList->id }}"
                                                                                    aria-hidden="true">&plus;
                                                                            </button>
                                                                            <label style="padding-left: 15px;"
                                                                                   for="qty-{{ $roomList->id }}">Quantity</label>
                                                                        </p>
                                                                    </form>
                                                                </div>

                                                                <div class="book_btn_2">
                                                                    <a href="javascript:void(0)" 
                                                                       onclick="addToCart({{ $roomList->id }}, '{{ $roomList->name }}', {{ $discountedPrice }}, {{ $roomList->total_rooms ?? 1 }})">
                                                                        Add to<span> Book</span>
                                                                    </a>
                                                                </div>

                                                                <!---->
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach

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
                    // Use global cart functions
                    function addToCart(roomId, roomName, price, maxQuantity) {
                        const qtyInput = document.getElementById('qty-' + roomId);
                        const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
                        
                        if (addToGlobalCart(roomId, roomName, price, maxQuantity, quantity)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Added to Cart!',
                                text: `${roomName} (Qty: ${quantity}) has been added to your booking cart.`,
                                confirmButtonColor: '#91278f',
                                timer: 2000,
                                showConfirmButton: true,
                                confirmButtonText: 'View Cart'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    toggleCartDrawer();
                                }
                            });
                        }
                    }

                    function removeFromCart(roomId) {
                        removeFromGlobalCart(roomId);
                    }

                    const roomsData = {!! json_encode(\App\Models\Room::where('hotel_id', $show->id)->with('photos')->get()->map(function($room) {
                        return [
                            'id' => $room->id,
                            'name' => $room->name,
                            'number' => $room->number,
                            'floor_number' => $room->floor_number,
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
                            'appliances' => json_decode($room->appliances, true) ?? [],
                            'furniture' => json_decode($room->furniture, true) ?? [],
                            'amenities' => json_decode($room->amenities, true) ?? [],
                            'cancellation_policy' => json_decode($room->cancellation_policy, true) ?? [],
                            'photos' => $room->photos->groupBy('category')->map(function($photos) {
                                return $photos->map(function($photo) {
                                    return $photo->photo_path;
                                });
                            })
                        ];
                    })) !!};

                    // Store current room for modal "Add to Book" button
                    let currentModalRoom = null;

                    function loadRoomDetails(roomId) {
                        const room = roomsData.find(r => r.id === roomId);
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

                        // Update modal header
                        document.querySelector('.room-title-modal').textContent = room.name;
                        document.querySelector('.room-numbers').innerHTML = `Room # ${room.number}<br> <span style="padding-left:0px" class="floor-numbers">${room.floor_number || ''}</span>`;

                        // Update pricing
                        if (discountPercentage > 0) {
                            document.querySelector('.discount-tag-modal').style.display = 'block';
                            document.querySelector('.discount-tag-modal .discount-tag').textContent = Math.round(discountPercentage) + '% off';
                            document.querySelector('.price-before-discount-modal').innerHTML = `<del>BDT ${originalPrice.toFixed(2)}</del>`;
                            document.querySelector('.discount-price-modal').textContent = `BDT ${discountedPrice.toFixed(2)}`;
                        } else {
                            document.querySelector('.discount-tag-modal').style.display = 'none';
                            document.querySelector('.price-before-discount-modal').textContent = '';
                            document.querySelector('.discount-price-modal').textContent = `BDT ${originalPrice.toFixed(2)}`;
                        }

                        // Update quantity max value
                        document.querySelector('#rightSidebarModalDetails #qty').setAttribute('max', room.total_rooms || 10);

                        // Update modal "Add to Book" button
                        const modalAddBtn = document.getElementById('modalAddToBookBtn');
                        if (modalAddBtn) {
                            modalAddBtn.onclick = function(e) {
                                e.preventDefault();
                                const modalQty = document.querySelector('#rightSidebarModalDetails #qty');
                                const quantity = modalQty ? parseInt(modalQty.value) : 1;
                                
                                if (addToGlobalCart(room.id, room.name, discountedPrice, room.total_rooms || 1, quantity)) {
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
                                        text: `${room.name} (Qty: ${quantity}) has been added to your booking cart.`,
                                        confirmButtonColor: '#91278f',
                                        timer: 2000,
                                        showConfirmButton: true,
                                        confirmButtonText: 'View Cart'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            toggleCartDrawer();
                                        }
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
                    }

                    function updateRoomPhotos(photos) {
                        const photoContainer = document.querySelector('#hotel-room .all-rooms-details .row');
                        photoContainer.innerHTML = '';

                        // Display all photo categories
                        const categories = ['feature', 'kitchen', 'washroom', 'parking', 'entrance', 'accessibility', 'spa', 'bar', 'transport', 'rooftop', 'recreation', 'safety', 'amenity'];
                        
                        categories.forEach(category => {
                            if (photos[category]) {
                                photos[category].forEach(photoPath => {
                                    const div = document.createElement('div');
                                    div.className = 'col-6 col-md-6 luxury-room-block';
                                    div.innerHTML = `<img class="img-fluid" src="/${photoPath}" alt="${category}-photo">`;
                                    photoContainer.appendChild(div);
                                });
                            }
                        });

                        if (photoContainer.innerHTML === '') {
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
                        
                        // Room Information (Left column) - Room specifications
                        const roomInfo = [];
                        if (room.size) roomInfo.push(`Room Size: ${room.size} sq ft`);
                        if (room.total_persons) roomInfo.push(`Capacity: ${room.total_persons} Adults Maximum`);
                        if (room.total_beds) roomInfo.push(`Beds: ${room.total_beds}`);
                        if (room.total_washrooms) roomInfo.push(`Washrooms: ${room.total_washrooms}`);
                        if (room.total_rooms) roomInfo.push(`Available Rooms: ${room.total_rooms}`);
                        if (room.wifi_details) roomInfo.push(`WiFi: ${room.wifi_details}`);
                        
                        // Add appliances to Room Information
                        if (room.appliances && room.appliances.length > 0) {
                            roomInfo.push(...room.appliances);
                        }
                        
                        // Additional Room Information (Right column) - Furniture, Amenities, Policies
                        const additionalInfo = [];
                        
                        // Add furniture
                        if (room.furniture && room.furniture.length > 0) {
                            additionalInfo.push(...room.furniture);
                        }
                        
                        // Add amenities
                        if (room.amenities && room.amenities.length > 0) {
                            additionalInfo.push(...room.amenities);
                        }
                        
                        // Add cancellation policy
                        if (room.cancellation_policy && room.cancellation_policy.length > 0) {
                            additionalInfo.push(...room.cancellation_policy.map(policy => `Policy: ${policy}`));
                        }
                        
                        detailsModal.innerHTML = `
                            <div class="room-details-des">
                                <p>${description}</p>
                            </div>
                            <div data-v-58caae98="" class="facilities-flex">
                                ${generateDetailsColumn('Room Information', roomInfo, 'fa-bed fa-bed-custom')}
                                ${generateDetailsColumn('Additional Room Information', additionalInfo, 'fa-bed fa-bed-custom')}
                            </div>
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
                        
                        // Add click event listener to each delete button
                        const deleteButtons = document.querySelectorAll('.delete-button');

                        deleteButtons.forEach(function (button) {
                            button.addEventListener('click', function () {
                                // Find the parent .room element
                                const roomItem = button.closest('.room');

                                // Remove the room item from the DOM
                                if (roomItem) {
                                    roomItem.remove();
                                }
                            });
                        });

                        // Handle quantity selectors for all rooms
                        const qtyMinusButtons = document.querySelectorAll('.qtyminus');
                        const qtyPlusButtons = document.querySelectorAll('.qtyplus');

                        qtyMinusButtons.forEach(function (button) {
                            button.addEventListener('click', function () {
                                const roomId = button.getAttribute('data-room-id');
                                const qtyInput = document.getElementById('qty-' + roomId);
                                let currentValue = parseInt(qtyInput.value);
                                const minValue = parseInt(qtyInput.getAttribute('min'));
                                
                                if (currentValue > minValue) {
                                    qtyInput.value = currentValue - 1;
                                }
                            });
                        });

                        qtyPlusButtons.forEach(function (button) {
                            button.addEventListener('click', function () {
                                const roomId = button.getAttribute('data-room-id');
                                const qtyInput = document.getElementById('qty-' + roomId);
                                let currentValue = parseInt(qtyInput.value);
                                const maxValue = parseInt(qtyInput.getAttribute('max'));
                                
                                if (currentValue < maxValue) {
                                    qtyInput.value = currentValue + 1;
                                }
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
                                            const lat = "{{ $show->lati ?? 0 }}";
                                            const lng = "{{ $show->longi ?? 0 }}";
                                            const mapUrl = `https://www.google.com/maps?q=${lat},${lng}&z=15&output=embed`;

                                            document.getElementById('dynamicMap').src = mapUrl;
                                        </script>



                                    </div>
                                </div>
                                <div data-v-58caae98="" class="nearby-places">
                                    <div data-v-58caae98="" class="nearby-flex">


                                        @foreach($show->nearby_areas as $category => $data)
                                            @php
                                                // Format the category title nicely
                                                $title = ucwords(str_replace('___', ' & ', str_replace('_', ' ', $category)));
                                            @endphp

                                            <div class="facilities-column">
                                                <h3 class="place-title">
                                                    {{ $title }}
                                                </h3>
                                                <ul class="place-facilities-list">
                                                    @foreach($data['name'] as $index => $name)
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
                                    $facilities = json_decode($show->hotel_facilities, true);

                                    // Group facilities by category
                                    $groupedFacilities = collect($facilities)->groupBy('category');
                                @endphp

                                @foreach($groupedFacilities as $category => $items)
                                    <div data-v-58caae98="" class="facilities-column">
                                        <h3 data-v-58caae98="" class="general-title">
                                            {{ ucwords(str_replace(['___', '_'], [' & ', ' '], $category)) }}
                                        </h3>
                                        <ul data-v-58caae98="" class="general-facilities-list">
                                            @foreach($items as $facility)
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
                                        <!--  -->
                                        <div class="row mb-20">
                                            <div class="col-lg-7">
                                                <div class="review-name-left">
                                                    <h2>Guest reviews</h2>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="group-select-label">
                                                    <h3 class="sort-review-title">Sort reviews by:</h3>
                                                    <select class="form-select max-w-180"
                                                            aria-label="Default select example">
                                                        <option selected>Most Relevant</option>
                                                        <option>Newest</option>
                                                        <option>Oldest</option>
                                                        <option>High Rate</option>
                                                        <option>Low Rate</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr class="b9bfeba2b4 b288f61df6" aria-hidden="true">
                                        </div>


                                        <div class="row mb-20">
                                            <div class="col-lg-4">
                                                <div class="review-profile-left">
                                                    <div class="review-header-modal">
                                                        <div class="reviewer-info">
                                                            <img
                                                                src="https://cdn3.iconfinder.com/data/icons/avatars-15/64/_Ninja-2-512.png"
                                                                alt="Reviewer Image" class="reviewer-image">
                                                            <div class="reviewer-details">
                                                                <h3 class="reviewer-name">Tarun</h3>
                                                                <p class="reviewer-country">Bangladesh</p>
                                                            </div>
                                                        </div>
                                                        <div class="review-meta">
                                                            <p class="room-type"><span><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" width="15px"><path
                                                                            d="M3.75 11.25V9a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 0 1.5 0V9a2.25 2.25 0 0 0-2.25-2.25h-6A2.25 2.25 0 0 0 2.25 9v2.25a.75.75 0 0 0 1.5 0m9 0V9a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 0 1.5 0V9a2.25 2.25 0 0 0-2.25-2.25h-6A2.25 2.25 0 0 0 11.25 9v2.25a.75.75 0 0 0 1.5 0m-10 .75h18.5c.69 0 1.25.56 1.25 1.25V18l.75-.75H.75l.75.75v-4.75c0-.69.56-1.25 1.25-1.25m0-1.5A2.75 2.75 0 0 0 0 13.25V18c0 .414.336.75.75.75h22.5A.75.75 0 0 0 24 18v-4.75a2.75 2.75 0 0 0-2.75-2.75zM0 18v3a.75.75 0 0 0 1.5 0v-3A.75.75 0 0 0 0 18m22.5 0v3a.75.75 0 0 0 1.5 0v-3a.75.75 0 0 0-1.5 0m-.75-6.75V4.5a2.25 2.25 0 0 0-2.25-2.25h-15A2.25 2.25 0 0 0 2.25 4.5v6.75a.75.75 0 0 0 1.5 0V4.5a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 .75.75v6.75a.75.75 0 0 0 1.5 0"></path></svg></span>Deluxe
                                                                King Room
                                                            </p>
                                                            <p class="stay-details"><span><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" width="15px"><path
                                                                            d="M22.502 13.5v8.25a.75.75 0 0 1-.75.75h-19.5a.75.75 0 0 1-.75-.75V5.25a.75.75 0 0 1 .75-.75h19.5a.75.75 0 0 1 .75.75zm1.5 0V5.25A2.25 2.25 0 0 0 21.752 3h-19.5a2.25 2.25 0 0 0-2.25 2.25v16.5A2.25 2.25 0 0 0 2.252 24h19.5a2.25 2.25 0 0 0 2.25-2.25zm-23.25-3h22.5a.75.75 0 0 0 0-1.5H.752a.75.75 0 0 0 0 1.5M7.502 6V.75a.75.75 0 0 0-1.5 0V6a.75.75 0 0 0 1.5 0m10.5 0V.75a.75.75 0 0 0-1.5 0V6a.75.75 0 0 0 1.5 0"></path></svg></span>1
                                                                night · October 2024
                                                            </p>
                                                            <p class="group-type"><span><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" width="15px"><path
                                                                            d="M8.25 3.75a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0m1.5 0a3.75 3.75 0 1 0-7.5 0 3.75 3.75 0 0 0 7.5 0M12 13.5a6 6 0 0 0-12 0v2.25c0 .414.336.75.75.75H3l-.746-.675.75 7.5A.75.75 0 0 0 3.75 24h4.5a.75.75 0 0 0 .746-.675l.75-7.5L9 16.5h2.25a.75.75 0 0 0 .75-.75zm-1.5 0v2.25l.75-.75H9a.75.75 0 0 0-.746.675l-.75 7.5.746-.675h-4.5l.746.675-.75-7.5A.75.75 0 0 0 3 15H.75l.75.75V13.5a4.5 4.5 0 1 1 9 0m9.75-9.75a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0m1.5 0a3.75 3.75 0 1 0-7.5 0 3.75 3.75 0 0 0 7.5 0M13.5 16.5H15l-.746-.675.75 7.5a.75.75 0 0 0 .746.675h4.5a.75.75 0 0 0 .746-.675l.75-7.5L21 16.5h2.25a.75.75 0 0 0 .75-.75V13.5a6 6 0 0 0-11.143-3.086.75.75 0 0 0 1.286.772 4.5 4.5 0 0 1 8.357 2.315v2.249l.75-.75H21a.75.75 0 0 0-.746.675l-.75 7.5.746-.675h-4.5l.746.675-.75-7.5A.75.75 0 0 0 15 15h-1.5a.75.75 0 0 0 0 1.5"></path></svg></span>
                                                                Group
                                                            </p>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="review-profile-details">

                                                    <div class="review-inner-1">
                                                        <div class="review-details">

                                                            <span class="reviewer-choice"><span><span
                                                                        class="fcd9eec8fb fb4ef8dd02 fc17714355"
                                                                        aria-hidden="true"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" width="20px"><path
                                                                                d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12C23.993 5.376 18.624.007 12 0m6.216 10.376-2.788 2.485a.5.5 0 0 0-.126.572l1.629 3.749a.5.5 0 0 1-.7.634l-3.982-2.242a.5.5 0 0 0-.491 0l-3.985 2.242a.5.5 0 0 1-.7-.634L8.7 13.433a.5.5 0 0 0-.126-.572l-2.79-2.485a.5.5 0 0 1 .332-.876h3.31a.5.5 0 0 0 .46-.3l1.655-3.84a.5.5 0 0 1 .918 0l1.655 3.84a.5.5 0 0 0 .46.3h3.31a.5.5 0 0 1 .332.873z"></path></svg></span></span> Reviewers' choice</span>
                                                            <span class="review-date">Reviewed: 2 November 2024</span>

                                                            <div class="review-header">
                                                                <h4 class="review-title">Exceptional</h4>
                                                                <div class="rating">
                                                                    <h2 class="rating-score">10</h2>
                                                                </div>
                                                            </div>


                                                            <P>his hotel is a gem! We were blown away by how spotlessly
                                                                clean it was. It is recently opened, so everything is
                                                                nice and new. The bed was so comfortable with lovely,
                                                                soft linen and the shower was especially fantastic— good
                                                                water pressure and always hot. The staff went out of
                                                                their way to accommodate us, nothing was too big of an
                                                                ask. Lahki, the manager and Judi on the desk were so
                                                                friendly and helpful whenever we had a question.</P>
                                                            <p class="review-text positive">😊 Brand new hotel. Roof top
                                                                pool will open in just a couple of weeks. Very, very
                                                                friendly staff.</p>
                                                            <p class="review-text negative">☹️ The beds could have been
                                                                softer.</p>
                                                        </div>


                                                    </div>

                                                    <div class="review-hotel-rrom-gallery">
                                                        <div class="row">
                                                            <div class="col-6 col-md-2">

                                                                <img class="img-fluid"
                                                                     src="{{ asset('frontend')}}/images/luxury-room-1.jpg"
                                                                     alt="luxury-room-img">

                                                            </div>

                                                            <div class="col-6 col-md-2 ">

                                                                <img class="img-fluid"
                                                                     src="{{ asset('frontend')}}/images/luxury-room-2.jpg"
                                                                     alt="luxury-room-img">

                                                            </div>

                                                            <div class="col-6 col-md-2">

                                                                <img class="img-fluid"
                                                                     src="{{ asset('frontend')}}/images/luxury-room-3.jpg"
                                                                     alt="luxury-room-img">

                                                            </div>

                                                            <div class="col-6 col-md-2">

                                                                <img class="img-fluid"
                                                                     src="{{ asset('frontend')}}/images/luxury-room-4.jpg"
                                                                     alt="luxury-room-img">

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="hotel-response">
                                                        <h5 class="response-title">Hotel response:</h5>
                                                        <p>Thank you very much for your review! We would be
                                                            adding...</p>

                                                    </div>


                                                </div>
                                            </div>

                                            <hr class="b9bfeba2b4 b288f61df6" aria-hidden="true">
                                        </div>


                                        <div class="row mb-20">
                                            <div class="col-lg-4">
                                                <div class="review-profile-left">
                                                    <div class="review-header-modal">
                                                        <div class="reviewer-info">
                                                            <img
                                                                src="https://cdn3.iconfinder.com/data/icons/avatars-15/64/_Ninja-2-512.png"
                                                                alt="Reviewer Image" class="reviewer-image">
                                                            <div class="reviewer-details">
                                                                <h3 class="reviewer-name">Tarun</h3>
                                                                <p class="reviewer-country">Bangladesh</p>
                                                            </div>
                                                        </div>
                                                        <div class="review-meta">
                                                            <p class="room-type"><span><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" width="15px"><path
                                                                            d="M3.75 11.25V9a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 0 1.5 0V9a2.25 2.25 0 0 0-2.25-2.25h-6A2.25 2.25 0 0 0 2.25 9v2.25a.75.75 0 0 0 1.5 0m9 0V9a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 0 1.5 0V9a2.25 2.25 0 0 0-2.25-2.25h-6A2.25 2.25 0 0 0 11.25 9v2.25a.75.75 0 0 0 1.5 0m-10 .75h18.5c.69 0 1.25.56 1.25 1.25V18l.75-.75H.75l.75.75v-4.75c0-.69.56-1.25 1.25-1.25m0-1.5A2.75 2.75 0 0 0 0 13.25V18c0 .414.336.75.75.75h22.5A.75.75 0 0 0 24 18v-4.75a2.75 2.75 0 0 0-2.75-2.75zM0 18v3a.75.75 0 0 0 1.5 0v-3A.75.75 0 0 0 0 18m22.5 0v3a.75.75 0 0 0 1.5 0v-3a.75.75 0 0 0-1.5 0m-.75-6.75V4.5a2.25 2.25 0 0 0-2.25-2.25h-15A2.25 2.25 0 0 0 2.25 4.5v6.75a.75.75 0 0 0 1.5 0V4.5a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 .75.75v6.75a.75.75 0 0 0 1.5 0"></path></svg></span>Deluxe
                                                                King Room
                                                            </p>
                                                            <p class="stay-details"><span><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" width="15px"><path
                                                                            d="M22.502 13.5v8.25a.75.75 0 0 1-.75.75h-19.5a.75.75 0 0 1-.75-.75V5.25a.75.75 0 0 1 .75-.75h19.5a.75.75 0 0 1 .75.75zm1.5 0V5.25A2.25 2.25 0 0 0 21.752 3h-19.5a2.25 2.25 0 0 0-2.25 2.25v16.5A2.25 2.25 0 0 0 2.252 24h19.5a2.25 2.25 0 0 0 2.25-2.25zm-23.25-3h22.5a.75.75 0 0 0 0-1.5H.752a.75.75 0 0 0 0 1.5M7.502 6V.75a.75.75 0 0 0-1.5 0V6a.75.75 0 0 0 1.5 0m10.5 0V.75a.75.75 0 0 0-1.5 0V6a.75.75 0 0 0 1.5 0"></path></svg></span>1
                                                                night · October 2024
                                                            </p>
                                                            <p class="group-type"><span><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" width="15px"><path
                                                                            d="M8.25 3.75a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0m1.5 0a3.75 3.75 0 1 0-7.5 0 3.75 3.75 0 0 0 7.5 0M12 13.5a6 6 0 0 0-12 0v2.25c0 .414.336.75.75.75H3l-.746-.675.75 7.5A.75.75 0 0 0 3.75 24h4.5a.75.75 0 0 0 .746-.675l.75-7.5L9 16.5h2.25a.75.75 0 0 0 .75-.75zm-1.5 0v2.25l.75-.75H9a.75.75 0 0 0-.746.675l-.75 7.5.746-.675h-4.5l.746.675-.75-7.5A.75.75 0 0 0 3 15H.75l.75.75V13.5a4.5 4.5 0 1 1 9 0m9.75-9.75a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0m1.5 0a3.75 3.75 0 1 0-7.5 0 3.75 3.75 0 0 0 7.5 0M13.5 16.5H15l-.746-.675.75 7.5a.75.75 0 0 0 .746.675h4.5a.75.75 0 0 0 .746-.675l.75-7.5L21 16.5h2.25a.75.75 0 0 0 .75-.75V13.5a6 6 0 0 0-11.143-3.086.75.75 0 0 0 1.286.772 4.5 4.5 0 0 1 8.357 2.315v2.249l.75-.75H21a.75.75 0 0 0-.746.675l-.75 7.5.746-.675h-4.5l.746.675-.75-7.5A.75.75 0 0 0 15 15h-1.5a.75.75 0 0 0 0 1.5"></path></svg></span>
                                                                Group
                                                            </p>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="review-profile-details">

                                                    <div class="review-inner-1">
                                                        <div class="review-details">

                                                            <span class="reviewer-choice"><span><span
                                                                        class="fcd9eec8fb fb4ef8dd02 fc17714355"
                                                                        aria-hidden="true"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" width="20px"><path
                                                                                d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12C23.993 5.376 18.624.007 12 0m6.216 10.376-2.788 2.485a.5.5 0 0 0-.126.572l1.629 3.749a.5.5 0 0 1-.7.634l-3.982-2.242a.5.5 0 0 0-.491 0l-3.985 2.242a.5.5 0 0 1-.7-.634L8.7 13.433a.5.5 0 0 0-.126-.572l-2.79-2.485a.5.5 0 0 1 .332-.876h3.31a.5.5 0 0 0 .46-.3l1.655-3.84a.5.5 0 0 1 .918 0l1.655 3.84a.5.5 0 0 0 .46.3h3.31a.5.5 0 0 1 .332.873z"></path></svg></span></span> Reviewers' choice</span>
                                                            <span class="review-date">Reviewed: 2 November 2024</span>

                                                            <div class="review-header">
                                                                <h4 class="review-title">Exceptional</h4>
                                                                <div class="rating">
                                                                    <h2 class="rating-score">10</h2>
                                                                </div>
                                                            </div>


                                                            <P>his hotel is a gem! We were blown away by how spotlessly
                                                                clean it was. It is recently opened, so everything is
                                                                nice and new. The bed was so comfortable with lovely,
                                                                soft linen and the shower was especially fantastic— good
                                                                water pressure and always hot. The staff went out of
                                                                their way to accommodate us, nothing was too big of an
                                                                ask. Lahki, the manager and Judi on the desk were so
                                                                friendly and helpful whenever we had a question.</P>
                                                            <p class="review-text positive">😊 Brand new hotel. Roof top
                                                                pool will open in just a couple of weeks. Very, very
                                                                friendly staff.</p>
                                                            <p class="review-text negative">☹️ The beds could have been
                                                                softer.</p>
                                                        </div>


                                                    </div>

                                                    <div class="review-hotel-rrom-gallery">
                                                        <div class="row">
                                                            <div class="col-6 col-md-2">

                                                                <img class="img-fluid"
                                                                     src="{{ asset('frontend')}}/images/luxury-room-1.jpg"
                                                                     alt="luxury-room-img">

                                                            </div>

                                                            <div class="col-6 col-md-2 ">

                                                                <img class="img-fluid"
                                                                     src="{{ asset('frontend')}}/images/luxury-room-2.jpg"
                                                                     alt="luxury-room-img">

                                                            </div>

                                                            <div class="col-6 col-md-2">

                                                                <img class="img-fluid"
                                                                     src="{{ asset('frontend')}}/images/luxury-room-3.jpg"
                                                                     alt="luxury-room-img">

                                                            </div>

                                                            <div class="col-6 col-md-2">

                                                                <img class="img-fluid"
                                                                     src="{{ asset('frontend')}}/images/luxury-room-4.jpg"
                                                                     alt="luxury-room-img">

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="hotel-response">
                                                        <h5 class="response-title">Hotel response:</h5>
                                                        <p>Thank you very much for your review! We would be
                                                            adding...</p>

                                                    </div>


                                                </div>
                                            </div>

                                            <hr class="b9bfeba2b4 b288f61df6" aria-hidden="true">
                                        </div>

                                    </div>
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
                                            <h3>4.5</h3>
                                        </div>
                                        <div class="review-comments">
                                            <h2>Excellent</h2>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#rightSidebarModal">
                                                10 Reviews & Comments
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
                                                        <h2>7.9</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress_custom progress-bar-success"
                                                         role="progressbar" aria-valuenow="70" aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width: 70%; background-color: #91278f;">
                                                        <span class="sr-only">40% Complete (success)</span>
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
                                                        <h2>7.9</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 90%; background-color: #489b48;">
                                                        <span class="sr-only">40% Complete (success)</span>
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
                                                        <h2>7.9</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 90%; background-color: #489b48;">
                                                        <span class="sr-only">40% Complete (success)</span>
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
                                                        <h2>7.9</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress_custom" role="progressbar"
                                                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 70%; background-color: #489b48;">
                                                        <span class="sr-only">40% Complete (success)</span>
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
                                                        <h2>6.7</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress_custom progress-bar-success"
                                                         role="progressbar" aria-valuenow="70" aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width: 70%; background-color: #91278f;">
                                                        <span class="sr-only">40% Complete (success)</span>
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
                                                        <h2>7.9</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 90%; background-color: #489b48;">
                                                        <span class="sr-only">40% Complete (success)</span>
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
                                                        <h2>6.7</h2>
                                                    </div>
                                                </div>
                                                <div class="progress progress_custom">
                                                    <div class="progress-bar progress_custom" role="progressbar"
                                                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 70%; background-color: #91278f;">
                                                        <span class="sr-only">40% Complete (success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
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
                                                    <h5 class="Superhost-subtitle"> {{ $show->description }} is a
                                                        Superhost</h5>

                                                    <div class="vendor-personal-info">

                                                        <h3 class="info-subtitle" style="font-size: 16px;">Superhosts
                                                            are experienced, highly rated hosts who are committed to
                                                            providing great stays for guests.</h3>


                                                    </div>

                                                    <div class="co-host-card">
                                                        <h5 class="Superhost-subtitle"> Co-hosts</h5>

                                                        <div class="co-host-list">

                                                            <div class="co-host-profile">
                                                                <div class="co-host-pic">
                                                                    <a href="#"><img
                                                                            src="{{ asset('frontend')}}/images/reviewer-1.jpg"></a>
                                                                </div>
                                                                <div class="co-host-name">
                                                                    <h4>Sharon</h4>
                                                                </div>
                                                            </div>

                                                            <div class="co-host-profile">
                                                                <div class="co-host-pic">
                                                                    <a href="#"><img
                                                                            src="{{ asset('frontend')}}/images/reviewer-1.jpg"></a>
                                                                </div>
                                                                <div class="co-host-name">
                                                                    <h4>Sharon</h4>
                                                                </div>
                                                            </div>


                                                            <div class="co-host-profile">
                                                                <div class="co-host-pic">
                                                                    <a href="#"><img
                                                                            src="{{ asset('frontend')}}/images/reviewer-1.jpg"></a>
                                                                </div>
                                                                <div class="co-host-name">
                                                                    <h4>Sharon</h4>
                                                                </div>
                                                            </div>

                                                            <div class="co-host-profile">
                                                                <div class="co-host-pic">
                                                                    <a href="#"><img
                                                                            src="{{ asset('frontend')}}/images/reviewer-1.jpg"></a>
                                                                </div>
                                                                <div class="co-host-name">
                                                                    <h4>Sharon</h4>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>


                                                    <div class="co-host-card">
                                                        <h5 class="Superhost-subtitle">Host details</h5>
                                                        <div class="co-host-profile">

                                                            <div class="co-host-name">
                                                                <h4>Response rate: 100%</h4>
                                                                <h4>Responds within an hour</h4>
                                                            </div>
                                                        </div>

                                                        <div data-v-798d4468="" class="action"
                                                             style="margin: 15px 0px;">
                                                            <button data-v-798d4468=""
                                                                    style="text-transform: capitalize; padding: 10px; font-size: 16px;"
                                                                    type="button"
                                                                    class="btn room-option-btn btn-secondary btn-sm btn100">
                                                                Message Host
                                                            </button>
                                                        </div>
                                                    </div>


                                                    <!-- <div class="border-bottom-line"></div> -->
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-3 order-1 order-lg-2">
                                            <div class="vendor-left-section">
                                                <div class="vendor-profile">
                                                    <div class="vendor-profile-left">
                                                        <div class="vendor-pic">
                                                            <img src="{{ asset('frontend')}}/images/urmee.png"
                                                                 class="img-fluid" alt="user-img">
                                                        </div>
                                                        <div class="vendor-title">
                                                            <h3>{{ $show->description }}</h3>
                                                            <p>Super Host</p>
                                                        </div>
                                                    </div>
                                                    <div class="vendor-profile-right">
                                                        <div class="vendor-all-info">
                                                            <h3>216</h3>
                                                            <p>Reviews</p>
                                                        </div>

                                                        <div class="vendor-all-info">
                                                            <h3>4.32 <sup><i class="fa fa-star Block"></i></sup></h3>
                                                            <p>Rating</p>
                                                        </div>

                                                        <div class="vendor-all-info">
                                                            <h3>6</h3>
                                                            <p>Years hosting</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="vendor-profile-footer">


                                                    <div class="vendor-info-list">
                                                        <span><svg xmlns="http://www.w3.org/2000/svg"
                                                                   viewBox="0 0 32 32" aria-hidden="true"
                                                                   role="presentation" focusable="false"
                                                                   style="display: block; height: 24px; width: 24px; fill: var(--linaria-theme_palette-hof);"><path
                                                                    d="M26 2a5 5 0 0 1 5 4.78V21a5 5 0 0 1-4.78 5h-6.06L16 31.08 11.84 26H6a5 5 0 0 1-4.98-4.56L1 21.22 1 21V7a5 5 0 0 1 4.78-5H26zm0 2H6a3 3 0 0 0-3 2.82V21a3 3 0 0 0 2.82 3H12.8l3.2 3.92L19.2 24H26a3 3 0 0 0 3-2.82V7a3 3 0 0 0-2.82-3H26zM16 6a8.02 8.02 0 0 1 8 8.03A8 8 0 0 1 16.23 22h-.25A8 8 0 0 1 8 14.24v-.25A8 8 0 0 1 16 6zm1.68 9h-3.37c.11 1.45.43 2.76.79 3.68l.09.22.13.3c.23.45.45.74.62.8H16c.33 0 .85-.94 1.23-2.34l.11-.44c.16-.67.29-1.42.34-2.22zm4.24 0h-2.23c-.1 1.6-.42 3.12-.92 4.32a6 6 0 0 0 3.1-4.07l.05-.25zm-9.61 0h-2.23a6 6 0 0 0 3.14 4.32c-.5-1.2-.82-2.71-.91-4.32zm.92-6.32-.13.07A6 6 0 0 0 10.08 13h2.23c.1-1.61.42-3.12.91-4.32zM16 8h-.05c-.27.08-.64.7-.97 1.65l-.13.4a13.99 13.99 0 0 0-.54 2.95h3.37c-.19-2.66-1.1-4.85-1.63-5H16zm2.78.69.02.05c.48 1.19.8 2.68.9 4.26h2.21A6.02 6.02 0 0 0 19 8.8l-.22-.12z"></path></svg></span>Speaks
                                                        English
                                                    </div>

                                                    <div class="vendor-info-list" style="padding-top: 15px;">
                                                        <span><svg xmlns="http://www.w3.org/2000/svg"
                                                                   viewBox="0 0 32 32" aria-hidden="true"
                                                                   role="presentation" focusable="false"
                                                                   style="display: block; height: 24px; width: 24px; fill: var(--linaria-theme_palette-hof);"><path
                                                                    d="m5.7 1.3 3 3-.66.72a12 12 0 0 0 16.95 16.94l.72-.67 3 3-1.42 1.42-1.67-1.68A13.94 13.94 0 0 1 18 26.96V29h3v2h-8v-2h3v-2.04a13.95 13.95 0 0 1-8.92-4.08 14 14 0 0 1-1.11-18.5L4.29 2.71zm18.18 4.44.21.21.21.22a10 10 0 1 1-.64-.63zm-9.34 11.13-2.45 2.45a8 8 0 0 0 8.04 1.05 16.7 16.7 0 0 1-5.59-3.5zm4.91-4.91-3.5 3.5c2.85 2.54 6.08 3.82 6.7 3.2.63-.61-.66-3.85-3.2-6.7zm-9.81-2.1-.08.19a8 8 0 0 0 1.12 7.86l2.45-2.45a16.68 16.68 0 0 1-3.5-5.6zM23.32 8.1l-2.45 2.44a16.73 16.73 0 0 1 3.5 5.6 8 8 0 0 0-1.05-8.05zm-11.98-.76c-.62.62.66 3.86 3.2 6.7l3.5-3.5c-2.85-2.54-6.07-3.82-6.7-3.2zm2.54-1.7c1.75.59 3.75 1.83 5.58 3.49l2.44-2.45a8.03 8.03 0 0 0-8.02-1.04z"></path></svg></span>Lives
                                                        in Cox's Bazar, Chittagong
                                                    </div>

                                                    <h4 class="vendor-names">Hi, I am KK. I am glad to help every guest
                                                        to stay and have fun in Bangkok. Belong everywhere!</h4>

                                                    <a href="vendor.html" class="show-more-btn-vendor">Show More</a>
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

@endsection
