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
                    <div class="search-bar search-bar-mb-list">
                        <div class="search-container search-item">
                            <label for="mobile-destination-input">Where</label>
                            <input
                                type="text"
                                id="mobile-destination-input"
                                placeholder="Search destinations"
                                onfocus="showMobileSuggestions()"
                                onblur="hideMobileSuggestions()"
                            >
                            <div class="suggestions" id="mobile-suggestions-list">
                                <p class="suggestion-title">Suggested destinations</p>
                                <div class="suggestion-item">
                                    <img src="{{ asset('frontend')}}/images/icons/1.webp" alt="Bangkok" class="suggestion-icon">
                                    <div class="suggestion-text">
                                        <strong>Bangkok, Thailand</strong>
                                        <br>
                                        <span>For sights like Grand Palace</span>
                                    </div>
                                </div>
                                <div class="suggestion-item">
                                    <img src="{{ asset('frontend')}}/images/icons/2.png" alt="London" class="suggestion-icon">
                                    <div class="suggestion-text">
                                        <strong>London, United Kingdom</strong>
                                        <br>
                                        <span>For its bustling nightlife</span>
                                    </div>
                                </div>
                                <div class="suggestion-item">
                                    <img src="{{ asset('frontend')}}/images/icons/1.webp" alt="New York" class="suggestion-icon">
                                    <div class="suggestion-text">
                                        <strong>New York City, NY</strong>
                                        <br>
                                        <span>For its stunning architecture</span>
                                    </div>
                                </div>
                                <div class="suggestion-item">
                                    <img src="{{ asset('frontend')}}/images/icons/2.png" alt="Vancouver" class="suggestion-icon">
                                    <div class="suggestion-text">
                                        <strong>Vancouver, Canada</strong>
                                        <br>
                                        <span>For nature-lovers</span>
                                    </div>
                                </div>
                                <div class="suggestion-item">
                                    <img src="{{ asset('frontend')}}/images/icons/1.webp" alt="Bangkok" class="suggestion-icon">
                                    <div class="suggestion-text">
                                        <strong>Bangkok, Thailand</strong>
                                        <br>
                                        <span>For sights like Grand Palace</span>
                                    </div>
                                </div>
                                <div class="suggestion-item">
                                    <img src="{{ asset('frontend')}}/images/icons/2.png" alt="London" class="suggestion-icon">
                                    <div class="suggestion-text">
                                        <strong>London, United Kingdom</strong>
                                        <br>
                                        <span>For its bustling nightlife</span>
                                    </div>
                                </div>
                                <div class="suggestion-item">
                                    <img src="{{ asset('frontend')}}/images/icons/1.webp" alt="New York" class="suggestion-icon">
                                    <div class="suggestion-text">
                                        <strong>New York City, NY</strong>
                                        <br>
                                        <span>For its stunning architecture</span>
                                    </div>
                                </div>
                                <div class="suggestion-item">
                                    <img src="{{ asset('frontend')}}/images/icons/2.png" alt="Vancouver" class="suggestion-icon">
                                    <div class="suggestion-text">
                                        <strong>Vancouver, Canada</strong>
                                        <br>
                                        <span>For nature-lovers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile View HTML -->
                        <div id="mobile-view">
                            <div class=" search-container search-item">
                                <label for="checkin-mobile">Check in</label>
                                <input type="text" id="checkin-mobile" placeholder="Add dates" readonly />
                            </div>
                            <div class="search-container search-item">
                                <label for="checkout-mobile">Check out</label>
                                <input type="text" id="checkout-mobile" placeholder="Add dates" readonly />
                            </div>

                            <!-- Mobile Calendar Popup -->
                            <div id="calendar-popup-mobile" class="calendar-popup">
                                <div class="calendar-header">
                                    <button id="prevMonth-mobile">&#10094;</button>
                                    <span id="calendarMonth-mobile"></span>
                                    <button id="nextMonth-mobile">&#10095;</button>
                                </div>
                                <div id="calendar-mobile" class="calendar"></div>
                            </div>
                        </div>
                        <div class="search-container search-item search-button-group">
                            <div class="guest-container">
                                <!-- Guest Button -->
                                <div id="guest-dropdown-mobile" class="guest-dropdown">
                                    <label>Who</label>
                                    <button class="guest-button" onclick="toggleGuestDropdown('mobile')">Add Guests</button>
                                    <!-- Guest Selection (Initially Hidden) -->
                                    <div class="guest-selector hidden" id="guest-selector-mobile">
                                        <div class="guest-type">
                                            <div class="person-group">
                                                <span class="guest-label">Adults</span>
                                                <p>Ages 13 or above</p>
                                            </div>
                                            <div class="guest-controls">
                                                <button class="decrease" onclick="decreaseCount('mobile', 'adultCount')">-</button>
                                                <span class="guest-count" id="adultCountMobile">0</span>
                                                <button class="increase" onclick="increaseCount('mobile', 'adultCount')">+</button>
                                            </div>
                                        </div>
                                        <div class="guest-type">
                                            <div class="person-group">
                                                <span class="guest-label">Children</span>
                                                <p>Ages 2 – 12</p>
                                            </div>
                                            <div class="guest-controls">
                                                <button class="decrease" onclick="decreaseCount('mobile', 'childrenCount')">-</button>
                                                <span class="guest-count" id="childrenCountMobile">0</span>
                                                <button class="increase" onclick="increaseCount('mobile', 'childrenCount')">+</button>
                                            </div>
                                        </div>
                                        <div class="guest-type">
                                            <div class="person-group">
                                                <span class="guest-label">Infants</span>
                                                <p>Under 2</p>
                                            </div>
                                            <div class="guest-controls">
                                                <button class="decrease" onclick="decreaseCount('mobile', 'infantCount')">-</button>
                                                <span class="guest-count" id="infantCountMobile">0</span>
                                                <button class="increase" onclick="increaseCount('mobile', 'infantCount')">+</button>
                                            </div>
                                        </div>
                                        <div class="guest-type">
                                            <div class="person-group">
                                                <span class="guest-label">Pets</span>
                                                <p>Bringing a service animal?</p>
                                            </div>
                                            <div class="guest-controls">
                                                <button class="decrease" onclick="decreaseCount('mobile', 'petCount')">-</button>
                                                <span class="guest-count" id="petCountMobile">0</span>
                                                <button class="increase" onclick="increaseCount('mobile', 'petCount')">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-btn search-btn-mb-filter">
                            <button class="search-button seach-mb-filter">
                                <i class="fa fa-search search-icon-top-mb"></i>   Search
                            </button>
                        </div>

                    </div>
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
                            <div class="search-bar">
                                <div class="search-container search-item search-box-first">
                                    <label for="desktop-destination-input">Where</label>
                                    <input
                                        type="text"
                                        id="desktop-destination-input"
                                        placeholder="Search destinations"
                                        onfocus="showDesktopSuggestions()"
                                        onblur="hideDesktopSuggestions()"
                                    >
                                    <div class="suggestions" id="desktop-suggestions-list">
                                        <p class="suggestion-title">Suggested destinations</p>
                                        <div class="suggestion-item">
                                            <img src="{{ asset('frontend')}}/images/icons/1.webp" alt="New York" class="suggestion-icon">
                                            <div class="suggestion-text">
                                                <strong>New York City, NY</strong>
                                                <br>
                                                <span>For its stunning architecture</span>
                                            </div>
                                        </div>
                                        <div class="suggestion-item">
                                            <img src="{{ asset('frontend')}}/images/icons/2.png" alt="Vancouver" class="suggestion-icon">
                                            <div class="suggestion-text">
                                                <strong>Vancouver, Canada</strong>
                                                <br>
                                                <span>For nature-lovers</span>
                                            </div>
                                        </div>
                                        <div class="suggestion-item">
                                            <img src="{{ asset('frontend')}}/images/icons/1.webp" alt="Bangkok" class="suggestion-icon">
                                            <div class="suggestion-text">
                                                <strong>Bangkok, Thailand</strong>
                                                <br>
                                                <span>For sights like Grand Palace</span>
                                            </div>
                                        </div>
                                        <div class="suggestion-item">
                                            <img src="{{ asset('frontend')}}/images/icons/2.png" alt="London" class="suggestion-icon">
                                            <div class="suggestion-text">
                                                <strong>London, United Kingdom</strong>
                                                <br>
                                                <span>For its bustling nightlife</span>
                                            </div>
                                        </div>
                                        <div class="suggestion-item">
                                            <img src="{{ asset('frontend')}}/images/icons/1.webp" alt="New York" class="suggestion-icon">
                                            <div class="suggestion-text">
                                                <strong>New York City, NY</strong>
                                                <br>
                                                <span>For its stunning architecture</span>
                                            </div>
                                        </div>
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
                                    <input type="text" id="checkin-desktop" placeholder="Add dates" readonly />
                                </div>
                                <div class="search-container search-item">
                                    <label for="checkout-desktop">Check out</label>
                                    <input type="text" id="checkout-desktop" placeholder="Add dates" readonly />
                                </div>

                                <!-- Desktop Calendar Popup -->
                                <div id="calendar-popup-desktop" class="calendar-popup">
                                    <div class="calendar-header">
                                        <button id="prevMonth-desktop">&#10094;</button>
                                        <span id="calendarMonth-desktop"></span>
                                        <button id="nextMonth-desktop">&#10095;</button>
                                    </div>
                                    <div id="calendar-desktop" class="calendar"></div>
                                </div>



                                <div class="search-item search-button-group">
                                    <div class="guest-container">
                                        <!-- Guest Button -->
                                        <div id="guest-dropdown-desktop" class="guest-dropdown">
                                            <label>Who</label>
                                            <button class="guest-button" onclick="toggleGuestDropdown('desktop')">Add Guests</button>
                                            <!-- Guest Selection (Initially Hidden) -->
                                            <div class="guest-selector hidden" id="guest-selector-desktop">
                                                <div class="guest-type">
                                                    <div class="person-group">
                                                        <span class="guest-label">Adults</span>
                                                        <p>Ages 13 or above</p>
                                                    </div>
                                                    <div class="guest-controls">
                                                        <button class="decrease" onclick="decreaseCount('desktop', 'adultCount')">-</button>
                                                        <span class="guest-count" id="adultCountDesktop">0</span>
                                                        <button class="increase" onclick="increaseCount('desktop', 'adultCount')">+</button>
                                                    </div>
                                                </div>
                                                <div class="guest-type">
                                                    <div class="person-group">
                                                        <span class="guest-label">Children</span>
                                                        <p>Ages 2 – 12</p>
                                                    </div>
                                                    <div class="guest-controls">
                                                        <button class="decrease" onclick="decreaseCount('desktop', 'childrenCount')">-</button>
                                                        <span class="guest-count" id="childrenCountDesktop">0</span>
                                                        <button class="increase" onclick="increaseCount('desktop', 'childrenCount')">+</button>
                                                    </div>
                                                </div>
                                                <div class="guest-type">
                                                    <div class="person-group">
                                                        <span class="guest-label">Infants</span>
                                                        <p>Under 2</p>
                                                    </div>
                                                    <div class="guest-controls">
                                                        <button class="decrease" onclick="decreaseCount('desktop', 'infantCount')">-</button>
                                                        <span class="guest-count" id="infantCountDesktop">0</span>
                                                        <button class="increase" onclick="increaseCount('desktop', 'infantCount')">+</button>
                                                    </div>
                                                </div>
                                                <div class="guest-type">
                                                    <div class="person-group">
                                                        <span class="guest-label">Pets</span>
                                                        <p>Bringing a service animal?</p>
                                                    </div>
                                                    <div class="guest-controls">
                                                        <button class="decrease" onclick="decreaseCount('desktop', 'petCount')">-</button>
                                                        <span class="guest-count" id="petCountDesktop">0</span>
                                                        <button class="increase" onclick="increaseCount('desktop', 'petCount')">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-btn">
                                        <button class="search-button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="user-bendor">
                        <div class="bendor-section">
                            <a href="#">Egkom you Home</a>
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
                                    <li>
                                        <a href="login.html" id="loginMenu">Login</a>
                                    </li>
                                    <li>
                                        <a href="sign-up.html">Signup</a>
                                    </li>
                                    <li>
                                        <a href="profile.html">Profile</a>
                                    </li>
                                    <li>
                                        <a href="#">Settings</a>
                                    </li>
                                    <li>
                                        <a href="#">Logout</a>
                                    </li>
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


</body>
</html>
