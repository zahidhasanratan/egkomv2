<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{ asset('frontend')}}/images/fav.png" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i%7CMerriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/bootstrap-5.3.2.min.css">
    <!-- Sidebar Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/font-awesome.min.css">
    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/2.css">
    <link rel="stylesheet" id="cpswitch" href="{{ asset('frontend')}}/css/orange.css">
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/responsive.css">
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/custom.css">
    <!-- Owl Carousel Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/owl.theme.css">
    <!-- Flex Slider Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/flexslider.css" type="text/css" />
    <!--Date-Picker Stylesheet-->
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/datepicker.css">
    <!-- Magnific Gallery -->
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/magnific-popup.css">
    <!-- Slick Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/slick.css">
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/slick-theme.css">
    <!-- Swiper slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>


<body id="main-homepage">
@php
    // Get active hotels once for use in suggestions dropdown
    $activeHotelsForSuggestions = \App\Models\Hotel::where('approve', 1)->orderBy('description', 'asc')->get();
@endphp
<div class="wrapper">

    <!--Start:  Mobile Header- -->
    <section class="mobile-header-erapper">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="mb-logo">
                        <a href="{{ asset('/') }}" class="">
                            <img src="{{ asset('frontend')}}/images/logo.png" alt="Egkom">
                        </a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="mb-search-box" data-bs-toggle="modal" data-bs-target="#bookingModal">
                        <div class="mb-search-list">
                            <div class="mb-search-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 20px; width: 20px; fill: currentcolor;"><path d="M13 0a13 13 0 0 1 10.5 20.67l7.91 7.92-2.82 2.82-7.92-7.91A12.94 12.94 0 0 1 13 26a13 13 0 1 1 0-26zm0 4a9 9 0 1 0 0 18 9 9 0 0 0 0-18z"></path></svg>
                            </div>
                            <div class="mb-search-icon-name">
                                <h3 class="where">Where to?</h3>
                                <div class="location-list">
                                    <ul>
                                        <li>Anywhere</li>
                                        <li>Any week</li>
                                        <li>Add guests</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade modal-main-top-search" id="bookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-mobile-top">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-mb-search">
                    <form id="mobile-search-form" action="{{ route('search') }}" method="GET">
                    <div class="search-bar search-bar-mb-list">
                        <div class="search-container search-item">
                            <label for="mobile-destination-input">Where</label>
                            <input
                                type="text"
                                id="mobile-destination-input"
                                name="destination"
                                placeholder="Search destinations"
                                onfocus="showMobileSuggestions()"
                                onblur="hideMobileSuggestions()"
                            >
                            <div class="suggestions" id="mobile-suggestions-list">
                                <p class="suggestion-title">Suggested destinations</p>
                                        @forelse($activeHotelsForSuggestions as $hotel)
                                            <div class="suggestion-item" data-hotel-name="{{ $hotel->description }}">
                                                @php
                                                    $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                    $nearbyAreas = is_string($hotel->custom_nearby_areas)
                                                        ? json_decode($hotel->custom_nearby_areas, true)
                                                        : $hotel->custom_nearby_areas;
                                                @endphp
                                                @if (!empty($featuredPhotos[0]))
                                                    <img src="{{ asset($featuredPhotos[0]) }}" alt="{{ $hotel->description }}" class="suggestion-icon" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <img src="{{ asset('frontend')}}/images/icons/1.webp" alt="{{ $hotel->description }}" class="suggestion-icon" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                @endif
                                                <div class="suggestion-text">
                                                    <strong>{{ $hotel->description }}</strong>
                                                    <br>
                                                    <span>
                                                        @if (!empty($nearbyAreas[0]))
                                                            {{ $nearbyAreas[0] }}
                                                        @elseif(!empty($hotel->address))
                                                            {{ $hotel->address }}
                                                        @else
                                                            Available for booking
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                @empty
                                    <div class="suggestion-item">
                                        <div class="suggestion-text">
                                            <span>No hotels available</span>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <!-- Mobile View HTML -->
                        <div id="mobile-view">
                            <div class=" search-container search-item">
                                <label for="checkin-mobile">Check in</label>
                                <input type="text" id="checkin-mobile" name="checkin_display" placeholder="Add dates" readonly />
                                <input type="hidden" id="checkin-mobile-hidden" name="checkin" />
                            </div>
                            <div class="search-container search-item">
                                <label for="checkout-mobile">Check out</label>
                                <input type="text" id="checkout-mobile" name="checkout_display" placeholder="Add dates" readonly />
                                <input type="hidden" id="checkout-mobile-hidden" name="checkout" />
                            </div>

                            <!-- Mobile Calendar Popup -->
                            <div id="calendar-popup-mobile" class="calendar-popup">
                                <div class="calendar-header">
                                    <button type="button" id="prevMonth-mobile">&#10094;</button>
                                    <span id="calendarMonth-mobile"></span>
                                    <button type="button" id="nextMonth-mobile">&#10095;</button>
                                </div>
                                <div id="calendar-mobile" class="calendar"></div>
                            </div>
                        </div>
                        <div class="search-container search-item search-button-group">
                            <div class="guest-container">
                                <!-- Guest Button -->
                                <div id="guest-dropdown-mobile" class="guest-dropdown">
                                    <label>Who</label>
                                    <button type="button" class="guest-button" onclick="toggleGuestDropdown('mobile')">Add Guests</button>
                                    <!-- Guest Selection (Initially Hidden) -->
                                    <div class="guest-selector hidden" id="guest-selector-mobile">
                                        <div class="guest-type">
                                            <div class="person-group">
                                                <span class="guest-label">Adults</span>
                                                <p>Ages 13 or above</p>
                                            </div>
                                            <div class="guest-controls">
                                                <button type="button" class="decrease" onclick="decreaseCount('mobile', 'adultCount')">-</button>
                                                <span class="guest-count" id="adultCountMobile">0</span>
                                                <button type="button" class="increase" onclick="increaseCount('mobile', 'adultCount')">+</button>
                                            </div>
                                        </div>
                                        <div class="guest-type">
                                            <div class="person-group">
                                                <span class="guest-label">Children</span>
                                                <p>Ages 2 – 12</p>
                                            </div>
                                            <div class="guest-controls">
                                                <button type="button" class="decrease" onclick="decreaseCount('mobile', 'childrenCount')">-</button>
                                                <span class="guest-count" id="childrenCountMobile">0</span>
                                                <button type="button" class="increase" onclick="increaseCount('mobile', 'childrenCount')">+</button>
                                            </div>
                                        </div>
                                        <div class="guest-type">
                                            <div class="person-group">
                                                <span class="guest-label">Infants</span>
                                                <p>Under 2</p>
                                            </div>
                                            <div class="guest-controls">
                                                <button type="button" class="decrease" onclick="decreaseCount('mobile', 'infantCount')">-</button>
                                                <span class="guest-count" id="infantCountMobile">0</span>
                                                <button type="button" class="increase" onclick="increaseCount('mobile', 'infantCount')">+</button>
                                            </div>
                                        </div>
                                        <div class="guest-type">
                                            <div class="person-group">
                                                <span class="guest-label">Pets</span>
                                                <p>Bringing a service animal?</p>
                                            </div>
                                            <div class="guest-controls">
                                                <button type="button" class="decrease" onclick="decreaseCount('mobile', 'petCount')">-</button>
                                                <span class="guest-count" id="petCountMobile">0</span>
                                                <button type="button" class="increase" onclick="increaseCount('mobile', 'petCount')">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-btn search-btn-mb-filter">
                            <button type="submit" class="search-button seach-mb-filter">
                                <i class="fa fa-search search-icon-top-mb"></i>   Search
                            </button>
                        </div>
                        <!-- Hidden inputs for guest counts -->
                        <input type="hidden" id="adults-input-mobile" name="adults" value="0" />
                        <input type="hidden" id="children-input-mobile" name="children" value="0" />
                        <input type="hidden" id="infants-input-mobile" name="infants" value="0" />
                        <input type="hidden" id="pets-input-mobile" name="pets" value="0" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--End:  Mobile Header- -->

    <!--Start: Top Bar -->
    <section class="top-bar-area" id="stickyBar" >
        <div class="container">
            <div class="row ">
                <div class="col-lg-2">
                    <div class="egkom-logo">
                        <a href="{{ asset('/') }}" class="navbar-brand main-logo py-1 m-0">
                            <img src="{{ asset('frontend')}}/images/logo.png" alt="Egkom">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="sticky-top-search" id="smallSearchBox">
                        <div class="search-bars">
                            <div class="search-itemss">Anywhere</div>
                            <div class="search-itemss">Any week</div>
                            <div class="search-itemss" style="border: none;">2 guests</div>
                            <button class="search-button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="booking-search-wrapper" id="largeSearchBox">
                        <div class="experices-sec">
                            <div class="experices-secbtn-group">
                                <a href="#">Hotel</a>
                            </div>
                        </div>

                        <div class="booking-search-box">
                            <form id="desktop-search-form" action="{{ route('search') }}" method="GET">
                            <div class="search-bar">
                                <div class="search-container search-item search-box-first">
                                    <label for="desktop-destination-input">Where</label>
                                    <input
                                        type="text"
                                        id="desktop-destination-input"
                                        name="destination"
                                        placeholder="Search by hotel"
                                        onfocus="showDesktopSuggestions()"
                                        onblur="hideDesktopSuggestions()"
                                    >
                                    <div class="suggestions" id="desktop-suggestions-list">
                                        <p class="suggestion-title">Suggested destinations</p>
                                        @forelse($activeHotelsForSuggestions as $hotel)
                                            <div class="suggestion-item" data-hotel-name="{{ $hotel->description }}">
                                                @php
                                                    $featuredPhotos = json_decode($hotel->featured_photo, true);
                                                    $nearbyAreas = is_string($hotel->custom_nearby_areas)
                                                        ? json_decode($hotel->custom_nearby_areas, true)
                                                        : $hotel->custom_nearby_areas;
                                                @endphp
                                                @if (!empty($featuredPhotos[0]))
                                                    <img src="{{ asset($featuredPhotos[0]) }}" alt="{{ $hotel->description }}" class="suggestion-icon" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <img src="{{ asset('frontend')}}/images/icons/1.webp" alt="{{ $hotel->description }}" class="suggestion-icon" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                @endif
                                                <div class="suggestion-text">
                                                    <strong>{{ $hotel->description }}</strong>
                                                    <br>
                                                    <span>
                                                        @if (!empty($nearbyAreas[0]))
                                                            {{ $nearbyAreas[0] }}
                                                        @elseif(!empty($hotel->address))
                                                            {{ $hotel->address }}
                                                        @else
                                                            Available for booking
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="suggestion-item">
                                                <div class="suggestion-text">
                                                    <span>No hotels available</span>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- <div class="search-container search-item">
                                    <label>Check in</label>
                                    <input type="text" id="checkin" placeholder="Add dates" readonly />
                                  </div>
                                  <div class="search-container search-item">
                                    <label>Check out</label>
                                    <input type="text" id="checkout" placeholder="Add dates" readonly />
                                  </div> -->



                                <div class="search-container search-item">
                                    <label for="checkin-desktop">Check in</label>
                                    <input type="text" id="checkin-desktop" name="checkin_display" placeholder="Add dates" readonly />
                                    <input type="hidden" id="checkin-desktop-hidden" name="checkin" />
                                </div>
                                <div class="search-container search-item">
                                    <label for="checkout-desktop">Check out</label>
                                    <input type="text" id="checkout-desktop" name="checkout_display" placeholder="Add dates" readonly />
                                    <input type="hidden" id="checkout-desktop-hidden" name="checkout" />
                                </div>

                                <!-- Desktop Calendar Popup -->
                                <div id="calendar-popup-desktop" class="calendar-popup">
                                    <div class="calendar-header">
                                        <button type="button" id="prevMonth-desktop">&#10094;</button>
                                        <span id="calendarMonth-desktop"></span>
                                        <button type="button" id="nextMonth-desktop">&#10095;</button>
                                    </div>
                                    <div id="calendar-desktop" class="calendar"></div>
                                </div>



                                <div class="search-item search-button-group">
                                    <div class="guest-container">
                                        <!-- Guest Button -->
                                        <div id="guest-dropdown-desktop" class="guest-dropdown">
                                            <label>Who</label>
                                            <button type="button" class="guest-button" onclick="toggleGuestDropdown('desktop')">Add Guests</button>
                                            <!-- Guest Selection (Initially Hidden) -->
                                            <div class="guest-selector hidden" id="guest-selector-desktop">
                                                <div class="guest-type">
                                                    <div class="person-group">
                                                        <span class="guest-label">Adults</span>
                                                        <p>Ages 13 or above</p>
                                                    </div>
                                                    <div class="guest-controls">
                                                        <button type="button" class="decrease" onclick="decreaseCount('desktop', 'adultCount')">-</button>
                                                        <span class="guest-count" id="adultCountDesktop">0</span>
                                                        <button type="button" class="increase" onclick="increaseCount('desktop', 'adultCount')">+</button>
                                                    </div>
                                                </div>
                                                <div class="guest-type">
                                                    <div class="person-group">
                                                        <span class="guest-label">Children</span>
                                                        <p>Ages 2 – 12</p>
                                                    </div>
                                                    <div class="guest-controls">
                                                        <button type="button" class="decrease" onclick="decreaseCount('desktop', 'childrenCount')">-</button>
                                                        <span class="guest-count" id="childrenCountDesktop">0</span>
                                                        <button type="button" class="increase" onclick="increaseCount('desktop', 'childrenCount')">+</button>
                                                    </div>
                                                </div>
                                                <div class="guest-type">
                                                    <div class="person-group">
                                                        <span class="guest-label">Infants</span>
                                                        <p>Under 2</p>
                                                    </div>
                                                    <div class="guest-controls">
                                                        <button type="button" class="decrease" onclick="decreaseCount('desktop', 'infantCount')">-</button>
                                                        <span class="guest-count" id="infantCountDesktop">0</span>
                                                        <button type="button" class="increase" onclick="increaseCount('desktop', 'infantCount')">+</button>
                                                    </div>
                                                </div>
                                                <div class="guest-type">
                                                    <div class="person-group">
                                                        <span class="guest-label">Pets</span>
                                                        <p>Bringing a service animal?</p>
                                                    </div>
                                                    <div class="guest-controls">
                                                        <button type="button" class="decrease" onclick="decreaseCount('desktop', 'petCount')">-</button>
                                                        <span class="guest-count" id="petCountDesktop">0</span>
                                                        <button type="button" class="increase" onclick="increaseCount('desktop', 'petCount')">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-btn">
                                        <button type="submit" class="search-button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Hidden inputs for guest counts -->
                            <input type="hidden" id="adults-input" name="adults" value="0" />
                            <input type="hidden" id="children-input" name="children" value="0" />
                            <input type="hidden" id="infants-input" name="infants" value="0" />
                            <input type="hidden" id="pets-input" name="pets" value="0" />
                            </form>
                        </div>


                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="user-bendor">
                        <div class="bendor-section">
                            @if(auth()->guard('guest')->check())
                                <a href="#">{{ auth()->guard('guest')->user()->name }}</a>
                            @else
                                <a href="#">Egkom your Home </a>
                            @endif
                        </div>
                        
                        <div class="user-section">
                            <div class="user-login-button">
                                <a href="#" id="profileIconToggle">
                                    <div class="user-svg-toggle">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;">
                                            <g fill="none">
                                                <path d="M2 16h28M2 24h28M2 8h28"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="user-icon">
                                        <svg class="user-cicle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block;  fill: currentcolor;">
                                            <path d="M16 .7C7.56.7.7 7.56.7 16S7.56 31.3 16 31.3 31.3 24.44 31.3 16 24.44.7 16 .7zm0 28c-4.02 0-7.6-1.88-9.93-4.81a12.43 12.43 0 0 1 6.45-4.4A6.5 6.5 0 0 1 9.5 14a6.5 6.5 0 0 1 13 0 6.51 6.5 0 0 1-3.02 5.5 12.42 12.42 0 0 1 6.45 4.4A12.67 12.67 0 0 1 16 28.7z"></path>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                            <!-- Submenu -->
                            <div class="user-submenu" id="userSubmenu">
                                <ul>
                                    
                                    
                                   
                                    
                                   
                                    <li style="display: none;">
                                        <a href="{{ route('guest.login') }}" id="loginMenu">Login</a>
                                    </li>
                                    
                                    @if(auth()->guard('guest')->check())
 
    <li>
                                        <a href="{{ route('guest.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('guest.profile') }}">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('guest.settings') }}">Settings</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('guest.logout') }}" style="display: inline;">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                        </form>
                                    </li>
@else
<li>
                                        <a href="{{ route('guest.login') }}" id="loginMenu">Login</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('guest.signup') }}">Signup</a>
                                    </li>
@endif
                                </ul>
                            </div>
                            
                            <!-- Login Modal -->
                            <div id="loginModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" id="closeLogin">&times;</span>
                                    <h2>Login</h2>
                                    <form action="/login" method="post">
                                        <label for="username">Username:</label>
                                        <input type="text" id="username" name="username" required>
                                        <label for="password">Password:</label>
                                        <input type="password" id="password" name="password" required>
                                        <button type="submit">Login</button>
                                    </form>
                                    <hr>
                                    <div class="social-login">
                                        <button class="social-btn facebook-btn">Login with Facebook</button>
                                        <button class="social-btn google-btn">Login with Google</button>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" id="forgotPassword">Forgot Password?</a>
                                        <span> | </span>
                                        <a href="#" id="signupLink">Don't have an account? Sign Up</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Signup Modal -->
                            <div id="signupModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" id="closeSignup">&times;</span>
                                    <h2>Sign Up</h2>
                                    <form action="/signup" method="post">
                                        <label for="signupUsername">Username:</label>
                                        <input type="text" id="signupUsername" name="username" required>
                                        <label for="signupEmail">Email:</label>
                                        <input type="email" id="signupEmail" name="email" required>
                                        <label for="signupPhone">Phone Number:</label>
                                        <div class="phone-number-input">
                                            <select id="countryCode" name="countryCode" required>
                                                <option value="+1">+1 (USA)</option>
                                                <option value="+44">+44 (UK)</option>
                                                <option value="+91">+91 (India)</option>
                                                <option value="+61">+61 (Australia)</option>
                                                <option value="+33">+33 (France)</option>
                                                <!-- Add other country codes as needed -->
                                            </select>
                                            <input type="text" id="signupPhone" name="phone" placeholder="Enter your phone number" required>
                                        </div>
                                        <label for="signupPassword">Password:</label>
                                        <input type="password" id="signupPassword" name="password" required>
                                        <button type="submit">Sign Up</button>
                                    </form>
                                    <hr>
                                    <div class="social-login">
                                        <button class="social-btn facebook-btn">Sign Up with Facebook</button>
                                        <button class="social-btn google-btn">Sign Up with Google</button>
                                    </div>
                                    <div class="modal-footer">
                                        <span>Already have an account? </span>
                                        <a href="#" id="loginLink">
                                            <i class="fa fa-sign-in-alt"></i> Login </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Start: Top Bar -->


@yield('main')

    <!--======================= FOOTER =======================-->
    <section id="footer" class="ftr-heading-o ftr-heading-mgn-1">
        <div id="footer-top" class="banner-padding ftr-top-grey ftr-text-white">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-3 col-lg-4 col-xl-3 footer-widget ftr-links">
                        <h3 class="footer-heading">Support</h3>
                        <ul class="list-unstyled">
                            @foreach(\App\Menu::where('footer1', 1)->get() as $main_menu)
                            <li>
                                <a href="{{ $main_menu->page_type == 'url' ? $main_menu->external_link : route('page.details', $main_menu->slug) }}">
                                    {{ $main_menu->menu_name }}
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <!-- end columns -->
                    <div class="col-6 col-md-3 col-lg-4 col-xl-3 footer-widget ftr-links">
                        <h3 class="footer-heading">Discover</h3>
                        <ul class="list-unstyled">
                            @foreach(\App\Menu::where('footer2', 1)->get() as $main_menu)
                            <li>
                                <a href="{{ $main_menu->page_type == 'url' ? $main_menu->external_link : route('page.details', $main_menu->slug) }}">
                                    {{ $main_menu->menu_name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- end columns -->
                    <div class="col-6 col-md-3 col-lg-4 col-xl-3 footer-widget ftr-links">
                        <h3 class="footer-heading">Terms and settings</h3>
                        <ul class="list-unstyled">
                            @foreach(\App\Menu::where('footer3', 1)->get() as $main_menu)
                            <li>
                                <a href="{{ $main_menu->page_type == 'url' ? $main_menu->external_link : route('page.details', $main_menu->slug) }}">
                                    {{ $main_menu->menu_name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- end columns -->
                    <div class="col-6 col-md-3 col-lg-4 col-xl-3 footer-widget ftr-links">
                        <h3 class="footer-heading">About</h3>
                        <ul class="list-unstyled">
                            @foreach(\App\Menu::where('footer4', 1)->get() as $main_menu)
                            <li>
                                <a href="{{ $main_menu->page_type == 'url' ? $main_menu->external_link : route('page.details', $main_menu->slug) }}">
                                    {{ $main_menu->menu_name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- end columns -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end footer-top -->
        <div id="footer-bottom" class="ftr-bot-black">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6" id="copyright">
                        <p>Copyright © 2024 Egkom. All Rights Reserved.</p>
                    </div>
                    <!-- end columns -->
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6" id="terms">
                        <div class="footer-links">
                            <p class="footer-copytext">
                                <a href="https://www.esoft.com.bd/" target="_blank"> Web Design Company :</a>
                                <span style="font-family:cursive">e- <span style="color:red">S</span>oft </span>
                            </p>
                        </div>
                    </div>
                    <!-- end columns -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end footer-bottom -->
    </section>
    <!-- end footer -->

</div>
<!-- Page Scripts Starts -->
<script src="{{ asset('frontend')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('frontend')}}/js/popper.min.js"></script>
<script src="{{ asset('frontend')}}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('frontend')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ asset('frontend')}}/js/bootstrap-5.3.2.min.js"></script>
<script src="{{ asset('frontend')}}/js/jquery.flexslider.js"></script>
<script src="{{ asset('frontend')}}/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('frontend')}}/js/owl.carousel.min.js"></script>
<script src="{{ asset('frontend')}}/js/custom-navigation.js"></script>
<script src="{{ asset('frontend')}}/js/custom-flex.js"></script>
<script src="{{ asset('frontend')}}/js/custom-owl.js"></script>
<script src="{{ asset('frontend')}}/js/custom-date-picker.js"></script>
<script src="{{ asset('frontend')}}/js/custom-video.js"></script>
<script src="{{ asset('frontend')}}/js/popup-ad.js"></script>
<script src="{{ asset('frontend')}}/js/slick.min.js"></script>
<script src="{{ asset('frontend')}}/js/custom-slick.js"></script>
<script src="{{ asset('frontend')}}/js/custom-gallery.js"></script>
<script src="{{ asset('frontend')}}/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!--  -->




<!-- Most Popular slider -->
<script type="text/javascript">
    const swiper = new Swiper(".swiper", {
        direction: "horizontal",
        loop: true,
        speed: 3500,
        slidesPerView: 4,
        spaceBetween: 10,
        mousewheel: {
            forceToAxis: true,
            releaseOnEdges: true,
        },
        parallax: true,
        centeredSlides: true,
        effect: "coverflow",
        coverflowEffect: {
            rotate: 40,
            slideShadows: true,
        },
        autoplay: {
            delay: 2000,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true, // Enables clicking on bullet points to change slides
        },
        scrollbar: {
            el: ".swiper-scrollbar",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 60,
            },
            600: {
                slidesPerView: 2,
                spaceBetween: 60,
            },
            1000: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
            1400: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
            2300: {
                slidesPerView: 5,
                spaceBetween: 60,
            },
            2900: {
                slidesPerView: 6,
                spaceBetween: 60,
            },
        },
    });
    // https://codepen.io/TheMOZZARELLA/pen/OJqrvNo
</script>


<script type="text/javascript">

    // Initialize date picker
    flatpickr("#selectDate", {
        mode: "range",
        dateFormat: "Y-m-d"
    });

</script>

<script>
    // Scroll Interaction Script
    document.addEventListener('DOMContentLoaded', () => {
        const smallSearchBox = document.getElementById('smallSearchBox');
        const largeSearchBox = document.getElementById('largeSearchBox');
        let lastScrollTop = 0;

        // Function to switch back to large search box
        function switchToLargeSearchBox() {
            largeSearchBox.classList.remove('hidden');
            smallSearchBox.classList.remove('active');
        }

        // Scroll event listener
        window.addEventListener('scroll', () => {
            const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Determine scroll direction
            const isScrollingDown = currentScrollTop > lastScrollTop;

            // Threshold for when to switch search boxes (adjust as needed)
            const scrollThreshold = 200;

            if (isScrollingDown && currentScrollTop > scrollThreshold) {
                // Scroll Down: Hide large search, show small search
                largeSearchBox.classList.add('hidden');
                smallSearchBox.classList.add('active');
            } else if (!isScrollingDown && currentScrollTop <= scrollThreshold) {
                // Scroll Up: Show large search, hide small search
                switchToLargeSearchBox();
            }

            // Update last scroll position
            lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
        });

        // Click event listener for small search box
        smallSearchBox.addEventListener('click', (event) => {
            // Completely prevent default behavior and event propagation
            event.preventDefault();
            event.stopPropagation();

            // Switch to large search box
            switchToLargeSearchBox();

            // Optional: Add a visual feedback
            largeSearchBox.classList.add('clicked-focus');
            setTimeout(() => {
                largeSearchBox.classList.remove('clicked-focus');
            }, 500);
        });
    });

    // Optional: Suggestions functionality
    function showSuggestions() {
        console.log('Suggestions shown');
    }

    function hideSuggestions() {
        console.log('Suggestions hidden');
    }
</script>

<!-- Global Booking Cart Drawer -->
<div id="globalBookingCartDrawer" class="booking-cart-drawer">
    <div class="cart-drawer-overlay" onclick="toggleCartDrawer()"></div>
    <div class="cart-drawer-content">
        <div class="cart-header">
            <h2>Pricing Summary</h2>
            <button class="cart-drawer-close" onclick="toggleCartDrawer()">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="rooms-selection-container">
            <div class="rooms">
                <p class="text-center text-primary">Added Rooms</p>
                <div id="globalCartItemsList">
                    <!-- Cart items will be added here dynamically -->
                </div>
            </div>
            <div class="action">
                <div class="total-amount">
                    <span class="amount" id="globalCartTotal">Total = BDT 0.00</span>
                    <p class="tax-tag">Fee or Tax Will show at the check out page (if any)</p>
                </div>
                <a href="javascript:void(0)" onclick="proceedToCheckout()">
                    <button type="button" class="btn btn-secondary total-con btn-block">CONTINUE</button>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Global Floating Booking Cart Button -->
<div class="global-floating-cart-btn" onclick="toggleCartDrawer()">
    <div class="cart-icon-wrapper">
        <i class="fa fa-shopping-cart"></i>
        <span class="cart-count-badge" id="globalCartCountBadge">0</span>
    </div>
    <span class="cart-text">Booking Cart</span>
</div>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Global Floating Booking Cart Button - Image 2 Design */
    .global-floating-cart-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: white;
        border: 3px solid #91278f;
        border-radius: 50%;
        width: 90px;
        height: 90px;
        display: none; /* Hidden by default */
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(145, 39, 143, 0.3);
        transition: all 0.3s;
        z-index: 9999;
    }
    .global-floating-cart-btn.visible {
        display: flex; /* Show when cart has items */
    }
    .global-floating-cart-btn:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 25px rgba(145, 39, 143, 0.5);
        border-width: 4px;
    }
    .cart-icon-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cart-icon-wrapper i {
        font-size: 28px;
        color: #91278f;
    }
    .cart-count-badge {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #91278f;
        color: white;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s ease;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .cart-count-badge.visible {
        opacity: 1;
        transform: scale(1);
    }
    .cart-text {
        font-size: 12px;
        font-weight: 600;
        margin-top: 2px;
        color: #91278f;
        text-align: center;
        line-height: 1.2;
    }

    /* Booking Cart Drawer */
    .booking-cart-drawer {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        width: 400px;
        z-index: 10000;
        pointer-events: none;
        transition: all 0.3s ease;
    }
    .booking-cart-drawer.active {
        pointer-events: all;
    }
    .cart-drawer-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .booking-cart-drawer.active .cart-drawer-overlay {
        opacity: 1;
    }
    .cart-drawer-content {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 400px;
        background: white;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        transform: translateX(100%);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .booking-cart-drawer.active .cart-drawer-content {
        transform: translateX(0);
    }
    .cart-header {
        background: #4a5568;
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .cart-header h2 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    .cart-drawer-close {
        background: transparent;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .rooms-selection-container {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }
    .rooms-selection-container .rooms {
        flex: 1;
        overflow-y: auto;
    }
    .rooms-selection-container .rooms .text-primary {
        color: #91278f !important;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
    }
    .rooms-selection-container .room {
        background: white;
        border-left: 4px solid #91278f;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .rooms-selection-container .room-content {
        flex: 1;
    }
    .rooms-selection-container .room-name {
        font-weight: 600;
        font-size: 16px;
        color: #2d3748;
        margin-bottom: 5px;
    }
    .rooms-selection-container .pax-and-fare {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .rooms-selection-container .pax {
        color: #718096;
        font-size: 14px;
    }
    .rooms-selection-container .fare {
        color: #91278f;
        font-weight: 700;
        font-size: 16px;
    }
    .rooms-selection-container .delete-button {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #3b82f6;
        cursor: pointer;
        position: relative;
        transition: all 0.3s;
        flex-shrink: 0;
        margin-left: 10px;
    }
    .rooms-selection-container .delete-button:hover {
        background: #2563eb;
        transform: scale(1.1);
    }
    .rooms-selection-container .delete-button:before,
    .rooms-selection-container .delete-button:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 14px;
        height: 2px;
        background: white;
    }
    .rooms-selection-container .delete-button:before {
        transform: translate(-50%, -50%) rotate(45deg);
    }
    .rooms-selection-container .delete-button:after {
        transform: translate(-50%, -50%) rotate(-45deg);
    }
    .rooms-selection-container .action {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
    }
    .rooms-selection-container .total-amount {
        margin-bottom: 20px;
    }
    .rooms-selection-container .amount {
        font-size: 20px;
        font-weight: 700;
        color: #2d3748;
        display: block;
        margin-bottom: 5px;
    }
    .rooms-selection-container .tax-tag {
        font-size: 12px;
        color: #718096;
        margin: 0;
    }
    .rooms-selection-container .btn-secondary.total-con {
        background: linear-gradient(135deg, #91278f 0%, #6b1f6e 100%);
        border: none;
        color: white;
        padding: 15px 30px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
    }
    .rooms-selection-container .btn-secondary.total-con:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(145, 39, 143, 0.4);
    }
    .empty-cart-message {
        text-align: center;
        color: #999;
        padding: 20px;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .global-floating-cart-btn {
            width: 75px;
            height: 75px;
            bottom: 20px;
            right: 20px;
            border-width: 2px;
        }
        .global-floating-cart-btn:hover {
            border-width: 2px;
        }
        .cart-icon-wrapper i {
            font-size: 24px;
        }
        .cart-text {
            font-size: 11px;
        }
        .cart-count-badge {
            width: 24px;
            height: 24px;
            font-size: 12px;
            top: -8px;
            right: -8px;
        }
        .booking-cart-drawer,
        .cart-drawer-content {
            width: 100%;
            max-width: 400px;
        }
    }
</style>

<!-- Global Booking Cart JavaScript -->
<script>
    // Global Shopping Cart Management
    let globalBookingCart = JSON.parse(localStorage.getItem('bookingCart')) || [];

    function addToGlobalCart(roomId, roomName, price, maxQuantity, quantity = 1, capacity = 2) {
        // Check if room already in cart
        const existingItem = globalBookingCart.find(item => item.roomId === roomId);
        
        if (existingItem) {
            // Update quantity if not exceeding max
            const newQuantity = existingItem.quantity + quantity;
            if (newQuantity <= maxQuantity) {
                existingItem.quantity = newQuantity;
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Maximum Reached',
                    text: `Maximum ${maxQuantity} rooms can be booked.`,
                    confirmButtonColor: '#91278f'
                });
                return false;
            }
        } else {
            // Add new item with capacity
            globalBookingCart.push({
                roomId: roomId,
                roomName: roomName,
                price: price,
                quantity: quantity,
                maxQuantity: maxQuantity,
                capacity: capacity || 2 // Store room capacity (total_persons)
            });
        }
        
        // Save to localStorage
        localStorage.setItem('bookingCart', JSON.stringify(globalBookingCart));
        
        // Force immediate update
        updateGlobalCartDisplay();
        
        // Force badge update
        setTimeout(() => {
            updateGlobalCartDisplay();
        }, 10);
        
        return true;
    }

    function removeFromGlobalCart(roomId) {
        const item = globalBookingCart.find(i => i.roomId === roomId);
        if (!item) return;
        
        Swal.fire({
            title: 'Remove from Cart?',
            text: `Remove ${item.roomName} from your booking cart?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e53e3e',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, Remove',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                globalBookingCart = globalBookingCart.filter(i => i.roomId !== roomId);
                localStorage.setItem('bookingCart', JSON.stringify(globalBookingCart));
                updateGlobalCartDisplay();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Removed!',
                    text: 'Room has been removed from cart.',
                    confirmButtonColor: '#91278f',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

    function updateGlobalCartDisplay() {
        // Update drawer cart
        const drawerCartList = document.getElementById('globalCartItemsList');
        const drawerCartTotal = document.getElementById('globalCartTotal');
        
        // Update floating button badge and visibility
        const globalBadge = document.getElementById('globalCartCountBadge');
        const floatingButton = document.querySelector('.global-floating-cart-btn');
        
        if (globalBookingCart.length === 0) {
            const emptyMessage = '<p class="empty-cart-message">No rooms added yet</p>';
            if (drawerCartList) drawerCartList.innerHTML = emptyMessage;
            
            if (drawerCartTotal) drawerCartTotal.textContent = 'Total = BDT 0.00';
            
            if (globalBadge) {
                globalBadge.textContent = '0';
                globalBadge.classList.remove('visible');
            }
            
            // Hide floating button when cart is empty
            if (floatingButton) {
                floatingButton.classList.remove('visible');
            }
            return;
        }
        
        // Show floating button when cart has items
        if (floatingButton) {
            floatingButton.classList.add('visible');
        }
        
        // Get number of nights from bookingParams or date inputs
        let nights = 1; // Default to 1 night
        
        // Try to get dates from localStorage first
        const bookingParams = JSON.parse(localStorage.getItem('bookingParams')) || {};
        let checkinDate = bookingParams.checkin;
        let checkoutDate = bookingParams.checkout;
        
        // If not in localStorage, try to get from page inputs (if on checkout page)
        if (!checkinDate || !checkoutDate) {
            const checkinInput = document.getElementById('checkin-date');
            const checkoutInput = document.getElementById('checkout-date');
            if (checkinInput && checkoutInput) {
                checkinDate = checkinInput.value;
                checkoutDate = checkoutInput.value;
            }
        }
        
        // Calculate nights if dates are available
        if (checkinDate && checkoutDate) {
            const checkin = new Date(checkinDate + 'T00:00:00');
            const checkout = new Date(checkoutDate + 'T00:00:00');
            nights = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
            if (nights < 1) nights = 1; // Ensure at least 1 night
        }
        
        let total = 0;
        let itemsHtml = '';
        
        globalBookingCart.forEach(item => {
            // Calculate: price per night * quantity * number of nights
            const itemTotal = item.price * item.quantity * nights;
            total += itemTotal;
            
            itemsHtml += `
                <div class="room">
                    <div class="room-content">
                        <div class="room-name">${item.roomName}</div>
                        <div class="pax-and-fare">
                            ${item.quantity > 1 ? `<span class="pax">Qty: ${item.quantity} × </span>` : ''}
                            <span class="fare">BDT ${itemTotal.toFixed(2)}</span>
                            ${nights > 1 ? ` <small style="color: #666; font-size: 0.85em;">(${nights} nights)</small>` : ''}
                        </div>
                    </div>
                    <div class="delete-button" onclick="removeFromGlobalCart(${item.roomId})"></div>
                </div>
            `;
        });
        
        // Update drawer
        if (drawerCartList) drawerCartList.innerHTML = itemsHtml;
        if (drawerCartTotal) drawerCartTotal.textContent = `Total = BDT ${total.toFixed(2)}`;
        
        // Update badge with animation
        const count = globalBookingCart.length;
        if (globalBadge) {
            globalBadge.textContent = count;
            if (count > 0) {
                globalBadge.classList.add('visible');
            } else {
                globalBadge.classList.remove('visible');
            }
        }
        
        // Ensure floating button is visible when cart has items
        if (floatingButton && count > 0) {
            floatingButton.classList.add('visible');
        }
    }

    function toggleCartDrawer() {
        const drawer = document.getElementById('globalBookingCartDrawer');
        if (drawer) {
            drawer.classList.toggle('active');
        }
    }
    
    // Listen for storage changes to update cart when bookingParams change
    window.addEventListener('storage', function(e) {
        if (e.key === 'bookingParams' || e.key === 'bookingCart') {
            if (typeof updateGlobalCartDisplay === 'function') {
                updateGlobalCartDisplay();
            }
        }
    });
    
    // Also listen for custom events (for same-tab updates)
    window.addEventListener('bookingParamsUpdated', function() {
        if (typeof updateGlobalCartDisplay === 'function') {
            updateGlobalCartDisplay();
        }
    });

    function proceedToCheckout() {
        if (globalBookingCart.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Cart is Empty',
                text: 'Please add at least one room to continue.',
                confirmButtonColor: '#91278f'
            });
            return;
        }
        
        // Store booking parameters from URL or search state
        const urlParams = new URLSearchParams(window.location.search);
        const bookingParams = {
            checkin: urlParams.get('checkin') || document.getElementById('checkin-desktop-hidden')?.value || document.getElementById('checkin-mobile-hidden')?.value || '',
            checkout: urlParams.get('checkout') || document.getElementById('checkout-desktop-hidden')?.value || document.getElementById('checkout-mobile-hidden')?.value || '',
            adults: parseInt(urlParams.get('adults')) || parseInt(document.getElementById('adults-input')?.value) || parseInt(document.getElementById('adults-input-mobile')?.value) || 0,
            children: parseInt(urlParams.get('children')) || parseInt(document.getElementById('children-input')?.value) || parseInt(document.getElementById('children-input-mobile')?.value) || 0,
            infants: parseInt(urlParams.get('infants')) || parseInt(document.getElementById('infants-input')?.value) || parseInt(document.getElementById('infants-input-mobile')?.value) || 0,
            pets: parseInt(urlParams.get('pets')) || parseInt(document.getElementById('pets-input')?.value) || parseInt(document.getElementById('pets-input-mobile')?.value) || 0
        };
        
        // Store booking parameters in localStorage
        localStorage.setItem('bookingParams', JSON.stringify(bookingParams));
        
        // Redirect to checkout page
        window.location.href = '/booking/checkout';
    }

    // Initialize cart on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateGlobalCartDisplay();
        
        // Update guest count hidden inputs when counts change
        function updateGuestHiddenInputs(view) {
            const adultCount = parseInt(document.getElementById(`adultCount${capitalize(view)}`).innerText) || 0;
            const childrenCount = parseInt(document.getElementById(`childrenCount${capitalize(view)}`).innerText) || 0;
            const infantCount = parseInt(document.getElementById(`infantCount${capitalize(view)}`).innerText) || 0;
            const petCount = parseInt(document.getElementById(`petCount${capitalize(view)}`).innerText) || 0;
            
            // Update desktop inputs
            const adultsInput = document.getElementById('adults-input');
            const childrenInput = document.getElementById('children-input');
            const infantsInput = document.getElementById('infants-input');
            const petsInput = document.getElementById('pets-input');
            
            if (adultsInput) adultsInput.value = adultCount;
            if (childrenInput) childrenInput.value = childrenCount;
            if (infantsInput) infantsInput.value = infantCount;
            if (petsInput) petsInput.value = petCount;
            
            // Update mobile inputs
            const adultsInputMobile = document.getElementById('adults-input-mobile');
            const childrenInputMobile = document.getElementById('children-input-mobile');
            const infantsInputMobile = document.getElementById('infants-input-mobile');
            const petsInputMobile = document.getElementById('pets-input-mobile');
            
            if (adultsInputMobile) adultsInputMobile.value = adultCount;
            if (childrenInputMobile) childrenInputMobile.value = childrenCount;
            if (infantsInputMobile) infantsInputMobile.value = infantCount;
            if (petsInputMobile) petsInputMobile.value = petCount;
        }
        
        // Override increaseCount to update hidden inputs
        const originalIncreaseCount = window.increaseCount;
        window.increaseCount = function(view, id) {
            originalIncreaseCount(view, id);
            updateGuestHiddenInputs(view);
        };
        
        // Override decreaseCount to update hidden inputs
        const originalDecreaseCount = window.decreaseCount;
        window.decreaseCount = function(view, id) {
            originalDecreaseCount(view, id);
            updateGuestHiddenInputs(view);
        };
        
        // Handle search form submission
        const searchForm = document.getElementById('desktop-search-form');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                // Convert dates from dd/mm/yyyy to YYYY-MM-DD
                const checkinDisplay = document.getElementById('checkin-desktop').value;
                const checkoutDisplay = document.getElementById('checkout-desktop').value;
                
                if (checkinDisplay) {
                    // Convert from dd/mm/yyyy to YYYY-MM-DD
                    const parts = checkinDisplay.split('/');
                    if (parts.length === 3) {
                        const day = parts[0].padStart(2, '0');
                        const month = parts[1].padStart(2, '0');
                        const year = parts[2];
                        document.getElementById('checkin-desktop-hidden').value = `${year}-${month}-${day}`;
                    }
                }
                
                if (checkoutDisplay) {
                    // Convert from dd/mm/yyyy to YYYY-MM-DD
                    const parts = checkoutDisplay.split('/');
                    if (parts.length === 3) {
                        const day = parts[0].padStart(2, '0');
                        const month = parts[1].padStart(2, '0');
                        const year = parts[2];
                        document.getElementById('checkout-desktop-hidden').value = `${year}-${month}-${day}`;
                    }
                }
                
                // Update guest counts
                updateGuestHiddenInputs('desktop');
            });
        }
        
        // Handle mobile search form submission
        const mobileSearchForm = document.getElementById('mobile-search-form');
        if (mobileSearchForm) {
            mobileSearchForm.addEventListener('submit', function(e) {
                // Convert dates from dd/mm/yyyy to YYYY-MM-DD
                const checkinDisplay = document.getElementById('checkin-mobile').value;
                const checkoutDisplay = document.getElementById('checkout-mobile').value;
                
                if (checkinDisplay) {
                    // Convert from dd/mm/yyyy to YYYY-MM-DD
                    const parts = checkinDisplay.split('/');
                    if (parts.length === 3) {
                        const day = parts[0].padStart(2, '0');
                        const month = parts[1].padStart(2, '0');
                        const year = parts[2];
                        document.getElementById('checkin-mobile-hidden').value = `${year}-${month}-${day}`;
                    }
                }
                
                if (checkoutDisplay) {
                    // Convert from dd/mm/yyyy to YYYY-MM-DD
                    const parts = checkoutDisplay.split('/');
                    if (parts.length === 3) {
                        const day = parts[0].padStart(2, '0');
                        const month = parts[1].padStart(2, '0');
                        const year = parts[2];
                        document.getElementById('checkout-mobile-hidden').value = `${year}-${month}-${day}`;
                    }
                }
                
                // Update guest counts
                updateGuestHiddenInputs('mobile');
            });
        }
        
        // Update suggestion item click handlers to use data attribute
        document.querySelectorAll("#desktop-suggestions-list .suggestion-item").forEach(item => {
            item.addEventListener("click", function () {
                const hotelName = this.getAttribute('data-hotel-name') || this.querySelector("strong")?.innerText;
                if (hotelName) {
                    document.getElementById("desktop-destination-input").value = hotelName;
                    if (typeof hideDesktopSuggestions === 'function') {
                        hideDesktopSuggestions();
                    }
                }
            });
        });
        
        document.querySelectorAll("#mobile-suggestions-list .suggestion-item").forEach(item => {
            item.addEventListener("click", function () {
                const hotelName = this.getAttribute('data-hotel-name') || this.querySelector("strong")?.innerText;
                if (hotelName) {
                    document.getElementById("mobile-destination-input").value = hotelName;
                    if (typeof hideMobileSuggestions === 'function') {
                        hideMobileSuggestions();
                    }
                }
            });
        });
    });
</script>

</body>
</html>
