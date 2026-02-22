@extends('frontend.hotelMaster')
@section('title', 'Search Results - EZBOOKING')
@section('main')

<section class="innerpage-wrapper">
    <div id="hotel-details" class="innerpage-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-v-58caae98="" id="rooms">
                        <div class="row">
                            <!-- Left Sidebar Filters -->
                            <div class="col-lg-3 pl-lg-0 side-bar left-side-bar">
                                <div class="side-bar-block filter-block">
                                    <div class="filter-sort-title">
                                        <h3>Sort By Filter</h3>
                                        <a class="reset-btn" href="javascript:void(0)" onclick="clearFilters()">Clear Filter</a>
                                    </div>

                                    <div class="search-sidebar">
                                        <div class="input-group mb-4 border rounded-pill p-1 mt-10 pt-10">
                                            <input type="search" id="hotel-search-filter" placeholder="Search Hotel.." aria-describedby="button-addon3" class="form-control search-filter-focus bg-none border-0" onkeyup="filterHotels()">
                                            <div class="input-group-append border-0">
                                                <button id="button-addon3" type="button" class="btn btn-link text-success"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panels-group">
                                        <p class="per-night">Your budget (per night)</p>
                                        <div class="price-slider">
                                            <p><input type="text" id="amount" readonly></p>
                                            <div id="slider-range"></div>
                                        </div>

                                        <!-- Filter 1: Price Range -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="filter-title">Price Range</h3>
                                            </div>
                                            <div class="panel-collapse">
                                                <div class="card-body text-start">
                                                    <div class="check-filter-list">
                                                        <ul>
                                                            <li>
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" class="form-check-input price-filter" data-min="0" data-max="5000" id="price-0-5000" onchange="filterByPrice()">
                                                                    <div class="check-group">
                                                                        <label class="form-check-label" for="price-0-5000">0 Tk - 5,000 Tk</label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" class="form-check-input price-filter" data-min="5000" data-max="10000" id="price-5000-10000" onchange="filterByPrice()">
                                                                    <div class="check-group">
                                                                        <label class="form-check-label" for="price-5000-10000">5,000 Tk - 10,000 Tk</label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" class="form-check-input price-filter" data-min="10000" data-max="20000" id="price-10000-20000" onchange="filterByPrice()">
                                                                    <div class="check-group">
                                                                        <label class="form-check-label" for="price-10000-20000">10,000 Tk - 20,000 Tk</label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" class="form-check-input price-filter" data-min="20000" data-max="999999" id="price-20000-plus" onchange="filterByPrice()">
                                                                    <div class="check-group">
                                                                        <label class="form-check-label" for="price-20000-plus">20,000 Tk+</label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Filter 2: Popular Filters -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="filter-title">Popular Filters</h3>
                                            </div>
                                            <div class="panel-collapse">
                                                <div class="card-body text-start">
                                                    <div class="check-filter-list">
                                                        <ul>
                                                            <li>
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" class="form-check-input facility-filter" data-facility="wifi" id="filter-wifi" onchange="filterHotels()">
                                                                    <div class="check-group">
                                                                        <label class="form-check-label" for="filter-wifi">Free WiFi</label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" class="form-check-input facility-filter" data-facility="breakfast" id="filter-breakfast" onchange="filterHotels()">
                                                                    <div class="check-group">
                                                                        <label class="form-check-label" for="filter-breakfast">Breakfast included</label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" class="form-check-input facility-filter" data-facility="parking" id="filter-parking" onchange="filterHotels()">
                                                                    <div class="check-group">
                                                                        <label class="form-check-label" for="filter-parking">Parking</label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Filter 3: Property Type -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="filter-title">Property Type</h3>
                                            </div>
                                            <div class="panel-collapse">
                                                <div class="card-body text-start">
                                                    <div class="check-filter-list">
                                                        <ul>
                                                            @foreach($propertyTypes as $type)
                                                                <li>
                                                                    <div class="form-group form-check">
                                                                        <input type="checkbox" class="form-check-input property-type-filter" data-type="{{ $type->property_category }}" id="type-{{ $type->property_category }}" onchange="filterHotels()">
                                                                        <div class="check-group">
                                                                            <label class="form-check-label" for="type-{{ $type->property_category }}">{{ $type->property_category }}</label>
                                                                            <label class="form-check-label" for="type-{{ $type->property_category }}">{{ $type->count }}</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Content: Hotels List -->
                            <div data-v-58caae98="" class="col-lg-9 col-md-12">
                                <!-- Search results summary / criteria (what you searched: Where, Check in, Check out, Who) -->
                                <div class="search-results-summary mb-3">
                                    <h3 class="mb-2">
                                        @if($totalHotelsCount > 0)
                                            {{ $totalHotelsCount }} {{ $totalHotelsCount == 1 ? 'hotel' : 'hotels' }}
                                            and {{ $totalRoomsCount }} {{ $totalRoomsCount == 1 ? 'room' : 'rooms' }} found
                                        @else
                                            No hotels found matching your search criteria
                                        @endif
                                    </h3>
                                    @if($destination || $checkin || $checkout || $adults > 0 || $children > 0 || $infants > 0 || $pets > 0)
                                        <div class="search-criteria mb-2">
                                            @if($destination)
                                                <span class="badge bg-secondary me-2">Where: {{ $destination }}</span>
                                            @endif
                                            @if($checkin)
                                                <span class="badge bg-secondary me-2">Check-in: {{ $checkin }}</span>
                                            @endif
                                            @if($checkout)
                                                <span class="badge bg-secondary me-2">Check-out: {{ $checkout }}</span>
                                            @endif
                                            @if($adults > 0 || $children > 0 || $infants > 0 || $pets > 0)
                                                @php
                                                    $guestParts = [];
                                                    if ($adults > 0) $guestParts[] = $adults . ' ' . ($adults == 1 ? 'adult' : 'adults');
                                                    if ($children > 0) $guestParts[] = $children . ' ' . ($children == 1 ? 'child' : 'children');
                                                    if ($infants > 0) $guestParts[] = $infants . ' ' . ($infants == 1 ? 'infant' : 'infants');
                                                    if ($pets > 0) $guestParts[] = $pets . ' ' . ($pets == 1 ? 'pet' : 'pets');
                                                @endphp
                                                <span class="badge bg-secondary me-2">Who: {{ implode(', ', $guestParts) }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="sort-filter">
                                    <div class="tt-sort">
                                        <div class="mobile-search-filter">
                                            <button class="filter-btn" onclick="toggleSidebar()">
                                                <span><i class="fa fa-filter" aria-hidden="true"></i></span> Filter
                                            </button>
                                        </div>

                                        <select class="sort-by-product-wrap" id="sort-select" onchange="sortHotels()">
                                            <option value="default">Sort By</option>
                                            <option value="price-low">Price Low to High</option>
                                            <option value="price-high">Price High to Low</option>
                                            <option value="name-asc">Name A-Z</option>
                                            <option value="name-desc">Name Z-A</option>
                                        </select>
                                        <select class="sort-by-product-wrap" id="per-page-select">
                                            <option value="all">Show All</option>
                                            <option value="9">9</option>
                                            <option value="16">16</option>
                                            <option value="32">32</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Mobile Filter Sidebar -->
                                <div class="sidebarFilter" id="sidebarFilter">
                                    <button class="close-btn close-btn-cattegory" onclick="toggleSidebar()">&times;</button>
                                    <div class="gap-sec"></div>

                                    <div class="side-bar-block filter-block">
                                        <div class="filter-sort-title">
                                            <h3>Sort By Filter</h3>
                                            <a class="reset-btn" href="javascript:void(0)" onclick="clearFilters()">Clear Filter</a>
                                        </div>

                                        <div class="search-sidebar">
                                            <div class="input-group mb-4 border rounded-pill p-1 mt-10 pt-10">
                                                <input type="search" id="mobile-hotel-search-filter" placeholder="Search Hotel.." class="form-control search-filter-focus bg-none border-0" onkeyup="filterHotels()">
                                                <div class="input-group-append border-0">
                                                    <button type="button" class="btn btn-link text-success"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panels-group">
                                            <div class="filter-category">
                                                <h3 onclick="toggleCategory(this)">Price Range <i class="fa fa-down-custom fa-chevron-down"></i></h3>
                                                <div class="filter-options">
                                                    <ul>
                                                        <li>
                                                            <input type="checkbox" class="price-filter" id="mobile-price-0-5000" data-min="0" data-max="5000" onchange="filterByPrice()">
                                                            <label for="mobile-price-0-5000">0 Tk - 5,000 Tk</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" class="price-filter" id="mobile-price-5000-10000" data-min="5000" data-max="10000" onchange="filterByPrice()">
                                                            <label for="mobile-price-5000-10000">5,000 Tk - 10,000 Tk</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" class="price-filter" id="mobile-price-10000-20000" data-min="10000" data-max="20000" onchange="filterByPrice()">
                                                            <label for="mobile-price-10000-20000">10,000 Tk - 20,000 Tk</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" class="price-filter" id="mobile-price-20000-plus" data-min="20000" data-max="999999" onchange="filterByPrice()">
                                                            <label for="mobile-price-20000-plus">20,000 Tk+</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="filter-category">
                                                <h3 onclick="toggleCategory(this)">Popular Filters <i class="fa fa-down-custom fa-chevron-down"></i></h3>
                                                <div class="filter-options">
                                                    <ul>
                                                        <li>
                                                            <input type="checkbox" class="facility-filter" id="mobile-filter-wifi" data-facility="wifi" onchange="filterHotels()">
                                                            <label for="mobile-filter-wifi">Free WiFi</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" class="facility-filter" id="mobile-filter-breakfast" data-facility="breakfast" onchange="filterHotels()">
                                                            <label for="mobile-filter-breakfast">Breakfast included</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" class="facility-filter" id="mobile-filter-parking" data-facility="parking" onchange="filterHotels()">
                                                            <label for="mobile-filter-parking">Parking</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="filter-category">
                                                <h3 onclick="toggleCategory(this)">Property Type <i class="fa fa-down-custom fa-chevron-down"></i></h3>
                                                <div class="filter-options">
                                                    <ul>
                                                        @foreach($propertyTypes as $type)
                                                            <li>
                                                                <input type="checkbox" class="property-type-filter" id="mobile-type-{{ $type->property_category }}" data-type="{{ $type->property_category }}" onchange="filterHotels()">
                                                                <label for="mobile-type-{{ $type->property_category }}">{{ $type->property_category }} ({{ $type->count }})</label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="room-section hotel-summary">
                                    <div class="hotel-room" id="hotels-container">
                                        @forelse($filteredHotels as $hotel)
                                            @php
                                                $images = $hotel->display_images ?? [];
                                                $roomCount = $hotel->rooms->count();
                                                $minPrice = $hotel->min_price ?? 0;
                                                $queryParams = [];
                                                if ($checkin) $queryParams['checkin'] = $checkin;
                                                if ($checkout) $queryParams['checkout'] = $checkout;
                                                if ($adults > 0) $queryParams['adults'] = $adults;
                                                if ($children > 0) $queryParams['children'] = $children;
                                                if ($infants > 0) $queryParams['infants'] = $infants;
                                                if ($pets > 0) $queryParams['pets'] = $pets;
                                                $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
                                            @endphp
                                            <div class="hotel-all-card" data-hotel-id="{{ $hotel->id }}" data-price="{{ $minPrice }}" data-name="{{ strtolower($hotel->description) }}" data-property-type="{{ strtolower($hotel->property_category ?? 'hotel') }}">
                                                <div class="room-info">
                                                    <div class="room-feature-head">
                                                        <h3 class="room-title">{{ $hotel->description }}</h3>
                                                        <h5>
                                                            <span style="padding-right:5px"><i class="fa fa-star"></i></span>
                                                            {{ $hotel->property_category ?? 'Hotel' }}
                                                        </h5>
                                                        <p class="room-numbers">Location: <span class="floor-numbers">{{ $hotel->address }}</span></p>
                                                    </div>

                                                    <div class="image-gallery multiple-row">
                                                        @if(!empty($images[0]))
                                                            <div class="featured">
                                                                <picture>
                                                                    <img src="{{ asset($images[0]) }}" alt="{{ $hotel->description }}" class="image-box">
                                                                </picture>
                                                            </div>
                                                            @if(isset($images[1]))
                                                                <div class="thumb-image">
                                                                    <picture>
                                                                        <img src="{{ asset($images[1]) }}" alt="{{ $hotel->description }}" class="image-box">
                                                                    </picture>
                                                                </div>
                                                            @endif
                                                            @if(isset($images[2]))
                                                                <div class="thumb-image">
                                                                    <picture>
                                                                        <img src="{{ asset($images[2]) }}" alt="{{ $hotel->description }}" class="image-box">
                                                                    </picture>
                                                                </div>
                                                            @endif
                                                            @if(isset($images[3]))
                                                                <div class="thumb-image">
                                                                    <div class="overlay">
                                                                        <span>+{{ count($images) - 3 }} <i class="fas fa-images"></i></span>
                                                                    </div>
                                                                    <picture>
                                                                        <img src="{{ asset($images[3]) }}" alt="{{ $hotel->description }}" class="image-box">
                                                                    </picture>
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="featured">
                                                                <picture>
                                                                    <img src="{{ asset('frontend/images/destination-1.jpg') }}" alt="{{ $hotel->description }}" class="image-box">
                                                                </picture>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="features fea-grid">
                                                        <h3 class="block-title">
                                                            <a href="{{ route('hotel.details', \Illuminate\Support\Facades\Crypt::encrypt($hotel->id)) }}{{ $queryString }}">{{ $hotel->description }}</a>
                                                        </h3>
                                                        @if($roomCount > 0)
                                                            <small class="d-block">
                                                                <i style="color: #91278f; font-size: 18px;" class="fa fa-home"></i>
                                                                Rooms Available: <b>{{ $roomCount }} {{ $roomCount == 1 ? 'Room' : 'Rooms' }}</b>
                                                            </small>
                                                        @endif
                                                        <small class="d-block">
                                                            <i style="color: #91278f; font-size: 18px;" class="fa fa-map-marker"></i>
                                                            Location: <b>{{ $hotel->address }}</b>
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="room-options">
                                                    <div data-v-798d4468="" class="option-card">
                                                        <div data-v-b6728cd0="" data-v-798d4468="" class="pricing-info">
                                                            <div class="review-main" style="margin-top: 10%;">
                                                                <div class="review-cat">Fabulous</div>
                                                                <div class="review-cat-home">8.9</div>
                                                            </div>

                                                            @if($minPrice > 0)
                                                                <div data-v-b6728cd0="" class="price-amount">
                                                                    <span data-v-b6728cd0="" class="discount-price">BDT {{ number_format($minPrice, 2) }}</span>
                                                                </div>
                                                                <div data-v-b6728cd0="" class="price-per">Per Night</div>
                                                            @else
                                                                <div data-v-b6728cd0="" class="price-amount">
                                                                    <span data-v-b6728cd0="" class="discount-price">Contact for Price</span>
                                                                </div>
                                                            @endif

                                                            <div class="book_btn_2">
                                                                <a href="{{ route('hotel.details', \Illuminate\Support\Facades\Crypt::encrypt($hotel->id)) }}{{ $queryString }}">Go <span>Details</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-5">
                                                <h3>No hotels found</h3>
                                                <p>Please try adjusting your search criteria or filters.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .form-group.form-check {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }
    .check-group {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        padding-top: 5px;
        width: 100%;
    }
    .book_btn_2 {
        margin-right: 0px;
    }

    #hotels-container.hotel-room {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        gap: 20px;
        align-items: stretch;
        margin-bottom: 0;
    }

    #hotels-container .hotel-all-card {
        transition: opacity 0.2s ease;
        will-change: opacity;
        flex: 0 0 calc(50% - 10px);
        max-width: calc(50% - 10px);
        margin-bottom: 0;
        display: flex;
    }

    @media (max-width: 991px) {
        #hotels-container .hotel-all-card {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    .hotel-all-card.hidden {
        display: none !important;
    }

    #hotels-container {
        min-height: 200px;
    }

    #no-results-message {
        flex: 0 0 100%;
        width: 100%;
        padding: 40px 20px;
    }

    .side-bar .filter-block .price-slider #slider-range.ui-slider,
    .side-bar .filter-block .price-slider .ui-slider-horizontal {
        position: relative;
        height: 6px;
        border: none;
        border-radius: 3px;
        background: #e0e0e0 !important;
    }
    .side-bar .filter-block .price-slider .ui-slider-range {
        position: absolute !important;
        top: 0;
        height: 100%;
        border: none !important;
        border-radius: 3px;
        background: #91278f !important;
    }
    .side-bar .filter-block .price-slider .ui-widget-header {
        background: #91278f !important;
        border: none !important;
    }
    .side-bar .filter-block .price-slider .ui-slider .ui-slider-handle {
        position: absolute !important;
        width: 18px;
        height: 18px;
        top: -6px !important;
        margin-left: 0 !important;
        transform: translateX(-50%);
        border: 2px solid #333 !important;
        background: #91278f !important;
        border-radius: 4px;
        cursor: pointer;
        outline: none;
    }
    .side-bar .filter-block .price-slider .ui-slider .ui-slider-handle:hover,
    .side-bar .filter-block .price-slider .ui-slider .ui-slider-handle:focus {
        background: #7a2178 !important;
        border-color: #333 !important;
    }
</style>

@endsection

@push('scripts')
<script>
    // Pre-fill the header search bar with the criteria that was searched (Where, Check in, Check out, Who)
    (function() {
        var destination = @json($destination ?? '');
        var checkin = @json($checkin ?? '');
        var checkout = @json($checkout ?? '');
        var adults = {{ (int) ($adults ?? 0) }};
        var children = {{ (int) ($children ?? 0) }};
        var infants = {{ (int) ($infants ?? 0) }};
        var pets = {{ (int) ($pets ?? 0) }};
        function applySearchParamsToHeader() {
            var destInput = document.getElementById('desktop-destination-input');
            var checkinDisplay = document.getElementById('checkin-desktop');
            var checkinHidden = document.getElementById('checkin-desktop-hidden');
            var checkoutDisplay = document.getElementById('checkout-desktop');
            var checkoutHidden = document.getElementById('checkout-desktop-hidden');
            if (destInput && destination) destInput.value = destination;
            if (checkinHidden && checkin) checkinHidden.value = checkin;
            if (checkoutHidden && checkout) checkoutHidden.value = checkout;
            // Display dates in dd/mm/yyyy for the visible inputs (match datepicker format)
            if (checkinDisplay && checkin) {
                var d = new Date(checkin + 'T00:00:00');
                if (!isNaN(d.getTime())) {
                    checkinDisplay.value = String(d.getDate()).padStart(2, '0') + '/' + String(d.getMonth() + 1).padStart(2, '0') + '/' + d.getFullYear();
                } else { checkinDisplay.value = checkin; }
            }
            if (checkoutDisplay && checkout) {
                var d2 = new Date(checkout + 'T00:00:00');
                if (!isNaN(d2.getTime())) {
                    checkoutDisplay.value = String(d2.getDate()).padStart(2, '0') + '/' + String(d2.getMonth() + 1).padStart(2, '0') + '/' + d2.getFullYear();
                } else { checkoutDisplay.value = checkout; }
            }
            var ad = document.getElementById('adultCountDesktop');
            var ch = document.getElementById('childrenCountDesktop');
            var inf = document.getElementById('infantCountDesktop');
            var pt = document.getElementById('petCountDesktop');
            if (ad) ad.innerText = adults;
            if (ch) ch.innerText = children;
            if (inf) inf.innerText = infants;
            if (pt) pt.innerText = pets;
            var adultsInput = document.getElementById('adults-input-hotel-master');
            var childrenInput = document.getElementById('children-input-hotel-master');
            var infantsInput = document.getElementById('infants-input-hotel-master');
            var petsInput = document.getElementById('pets-input-hotel-master');
            if (adultsInput) adultsInput.value = adults;
            if (childrenInput) childrenInput.value = children;
            if (infantsInput) infantsInput.value = infants;
            if (petsInput) petsInput.value = pets;
            if (typeof updateGuestButtonText === 'function') {
                updateGuestButtonText('desktop');
            } else {
                var btn = document.querySelector('#guest-dropdown-desktop .guest-button');
                if (btn) {
                    var parts = [];
                    if (adults + children > 0) parts.push((adults + children) + ' guest' + (adults + children > 1 ? 's' : ''));
                    if (infants > 0) parts.push(infants + ' infant' + (infants > 1 ? 's' : ''));
                    if (pets > 0) parts.push(pets + ' pet' + (pets > 1 ? 's' : ''));
                    btn.innerText = parts.length ? parts.join(', ') : 'Add Guests';
                }
            }
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', applySearchParamsToHeader);
        } else {
            applySearchParamsToHeader();
        }
    })();

    let priceSliderMin = 0;
    let priceSliderMax = 50000;

    function toggleSidebar() {
        const sidebar = document.getElementById("sidebarFilter");
        if (sidebar) {
            sidebar.classList.toggle("active");
        }
    }

    function toggleCategory(element) {
        const options = element.nextElementSibling;
        if (options) {
            const isVisible = options.style.display === 'block';
            options.style.display = isVisible ? 'none' : 'block';

            const icon = element.querySelector('i');
            if (icon) {
                if (isVisible) {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            }
        }
    }

    function clearFilters() {
        document.querySelectorAll('.form-check-input, .price-filter, .facility-filter, .property-type-filter').forEach(cb => cb.checked = false);

        const desktopSearch = document.getElementById('hotel-search-filter');
        const mobileSearch = document.getElementById('mobile-hotel-search-filter');
        if (desktopSearch) desktopSearch.value = '';
        if (mobileSearch) mobileSearch.value = '';

        if ($("#slider-range").length && $("#slider-range").data("ui-slider")) {
            var maxVal = $("#slider-range").slider("option", "max") || 50000;
            $("#slider-range").slider("values", [0, maxVal]);
            $("#amount").val("BDT 0 - BDT " + maxVal.toLocaleString());
            priceSliderMin = 0;
            priceSliderMax = maxVal;
        } else {
            priceSliderMin = 0;
            priceSliderMax = 50000;
        }

        const sortSelect = document.getElementById('sort-select');
        if (sortSelect) sortSelect.value = 'default';

        applyAllFilters();
    }

    function filterHotels() {
        applyAllFilters();
    }

    function filterByPrice() {
        applyAllFilters();
    }

    function applyAllFilters() {
        const hotelCards = document.querySelectorAll('.hotel-all-card');
        const desktopSearch = document.getElementById('hotel-search-filter');
        const mobileSearch = document.getElementById('mobile-hotel-search-filter');
        const searchTerm = (desktopSearch?.value || mobileSearch?.value || '').toLowerCase().trim();

        const selectedPriceRanges = Array.from(document.querySelectorAll('.price-filter:checked')).map(cb => ({
            min: parseInt(cb.dataset.min) || 0,
            max: parseInt(cb.dataset.max) || 999999
        }));

        const selectedFacilities = Array.from(document.querySelectorAll('.facility-filter:checked')).map(cb =>
            cb.dataset.facility?.toLowerCase()
        );

        const selectedPropertyTypes = Array.from(document.querySelectorAll('.property-type-filter:checked')).map(cb =>
            cb.dataset.type?.toLowerCase()
        );

        let visibleCount = 0;

        hotelCards.forEach(card => {
            let show = true;

            if (searchTerm) {
                const hotelName = (card.dataset.name || '').toLowerCase();
                if (!hotelName.includes(searchTerm)) {
                    show = false;
                }
            }

            if (show && selectedPriceRanges.length > 0) {
                const price = parseFloat(card.dataset.price) || 0;
                const inPriceRange = selectedPriceRanges.some(range =>
                    price >= range.min && price <= range.max
                );
                if (!inPriceRange) {
                    show = false;
                }
            }

            if (show) {
                const price = parseFloat(card.dataset.price) || 0;
                if (price < priceSliderMin || price > priceSliderMax) {
                    show = false;
                }
            }

            if (show && selectedPropertyTypes.length > 0) {
                const propertyType = (card.dataset.propertyType || '').toLowerCase();
                const matchesPropertyType = selectedPropertyTypes.some(type =>
                    propertyType === type.toLowerCase()
                );
                if (!matchesPropertyType) {
                    show = false;
                }
            }

            if (show) {
                card.classList.remove('hidden');
                card.style.display = '';
                visibleCount++;
            } else {
                card.classList.add('hidden');
                card.style.display = 'none';
            }
        });

        const noResultsMsg = document.getElementById('no-results-message');
        if (visibleCount === 0) {
            if (!noResultsMsg) {
                const container = document.getElementById('hotels-container');
                const msg = document.createElement('div');
                msg.id = 'no-results-message';
                msg.className = 'col-12 text-center py-5';
                msg.innerHTML = '<h3>No hotels found</h3><p>Try adjusting your filters to see more results.</p>';
                container.appendChild(msg);
            }
        } else {
            if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }
    }

    function sortHotels() {
        const sortValue = document.getElementById('sort-select').value;
        if (sortValue === 'default') {
            return;
        }

        const container = document.getElementById('hotels-container');
        const cards = Array.from(container.querySelectorAll('.hotel-all-card'));

        const visibleCards = cards.filter(card => {
            const display = window.getComputedStyle(card).display;
            return display !== 'none' && card.style.display !== 'none';
        });
        const hiddenCards = cards.filter(card => {
            const display = window.getComputedStyle(card).display;
            return display === 'none' || card.style.display === 'none';
        });

        visibleCards.sort((a, b) => {
            if (sortValue === 'price-low') {
                return (parseFloat(a.dataset.price) || 0) - (parseFloat(b.dataset.price) || 0);
            } else if (sortValue === 'price-high') {
                return (parseFloat(b.dataset.price) || 0) - (parseFloat(a.dataset.price) || 0);
            } else if (sortValue === 'name-asc') {
                const nameA = (a.dataset.name || '').toLowerCase();
                const nameB = (b.dataset.name || '').toLowerCase();
                return nameA.localeCompare(nameB);
            } else if (sortValue === 'name-desc') {
                const nameA = (a.dataset.name || '').toLowerCase();
                const nameB = (b.dataset.name || '').toLowerCase();
                return nameB.localeCompare(nameA);
            }
            return 0;
        });

        visibleCards.forEach(card => container.appendChild(card));
        hiddenCards.forEach(card => container.appendChild(card));
    }

    $(document).ready(function() {
        if ($("#slider-range").length) {
            const hotelCards = document.querySelectorAll('.hotel-all-card');
            let maxPrice = 50000;
            hotelCards.forEach(card => {
                const price = parseFloat(card.dataset.price) || 0;
                if (price > maxPrice) maxPrice = Math.ceil(price);
            });

            $("#slider-range").slider({
                range: true,
                min: 0,
                max: maxPrice || 50000,
                step: 1000,
                values: [0, maxPrice || 50000],
                slide: function(event, ui) {
                    priceSliderMin = ui.values[0];
                    priceSliderMax = ui.values[1];
                    $("#amount").val("BDT " + ui.values[0].toLocaleString() + " - BDT " + ui.values[1].toLocaleString());
                    applyAllFilters();
                },
                change: function(event, ui) {
                    priceSliderMin = ui.values[0];
                    priceSliderMax = ui.values[1];
                    applyAllFilters();
                }
            });
            $("#amount").val("BDT 0 - BDT " + (maxPrice || 50000).toLocaleString());
            priceSliderMin = $("#slider-range").slider("values", 0);
            priceSliderMax = $("#slider-range").slider("values", 1);
            applyAllFilters();
        }

        document.querySelectorAll('.facility-filter, .property-type-filter').forEach(checkbox => {
            checkbox.addEventListener('change', applyAllFilters);
        });

        const desktopSearch = document.getElementById('hotel-search-filter');
        const mobileSearch = document.getElementById('mobile-hotel-search-filter');
        if (desktopSearch && mobileSearch) {
            desktopSearch.addEventListener('input', function() {
                mobileSearch.value = this.value;
            });
            mobileSearch.addEventListener('input', function() {
                desktopSearch.value = this.value;
            });
        }

        function syncCheckboxes() {
            document.querySelectorAll('.price-filter').forEach(checkbox => {
                const dataMin = checkbox.dataset.min;
                const dataMax = checkbox.dataset.max;
                const isChecked = checkbox.checked;
                document.querySelectorAll(`.price-filter[data-min="${dataMin}"][data-max="${dataMax}"]`).forEach(cb => {
                    if (cb.id !== checkbox.id) cb.checked = isChecked;
                });
            });
            document.querySelectorAll('.facility-filter').forEach(checkbox => {
                const dataFacility = checkbox.dataset.facility;
                const isChecked = checkbox.checked;
                document.querySelectorAll(`.facility-filter[data-facility="${dataFacility}"]`).forEach(cb => {
                    if (cb.id !== checkbox.id) cb.checked = isChecked;
                });
            });
            document.querySelectorAll('.property-type-filter').forEach(checkbox => {
                const dataType = checkbox.dataset.type;
                const isChecked = checkbox.checked;
                document.querySelectorAll(`.property-type-filter[data-type="${dataType}"]`).forEach(cb => {
                    if (cb.id !== checkbox.id) cb.checked = isChecked;
                });
            });
        }

        document.querySelectorAll('.price-filter, .facility-filter, .property-type-filter').forEach(checkbox => {
            checkbox.addEventListener('change', syncCheckboxes);
        });

        const perPageSelect = document.getElementById('per-page-select');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function() {
                const value = this.value;
                const cards = Array.from(document.querySelectorAll('.hotel-all-card'));

                if (value === 'all') {
                    applyAllFilters();
                } else {
                    const limit = parseInt(value);
                    applyAllFilters();
                    let count = 0;
                    cards.forEach(card => {
                        const isVisible = window.getComputedStyle(card).display !== 'none' && card.style.display !== 'none';
                        if (isVisible) {
                            if (count < limit) {
                                card.classList.remove('hidden');
                                card.style.display = '';
                                count++;
                            } else {
                                card.classList.add('hidden');
                                card.style.display = 'none';
                            }
                        }
                    });
                }
            });
        }
    });
</script>
@endpush
