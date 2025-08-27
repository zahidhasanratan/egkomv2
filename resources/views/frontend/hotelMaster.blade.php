<!doctype html>
<html lang="en">
<head>
    <title>Egkom</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="images/fav.png" type="image/x-icon">
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
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/responsive.css">
    <!-- Swiper slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>

<body id="main-homepage">
<div class="wrapper">

    <!--Start:  Mobile Header- -->
    <!--Start:  Mobile Header- -->
    <section class="mobile-header-erapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-3">
                    <div class="mb-menu">
                        <a href="" class="menu-logo"  data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="sidebarCollapse">
                            <img src="{{ asset('frontend')}}/images/icons/menu.png" alt="Ez booking">
                        </a>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-logo">
                        <a href="{{ asset('/') }}" class="">
                            <img src="{{ asset('frontend')}}/images/logo.png" alt="Ez booking">
                        </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="mb-login">
                        <a href="" class="">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill login-icon" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!--  -->
                <div class="sidenav-content">
                    <!-- Sidebar  -->
                    <nav id="sidebar" class="sidenav">
                        <h2 id="web-name"></h2>

                        <div id="main-menu">
                            <div id="dismiss">
                                <button class="btn" id="closebtn">&times;</button>
                            </div>
                            <div class="list-group panel">
                                <a href="#home-links" class="items-list" data-bs-toggle="collapse" aria-expanded="false">
                                    Home</a>


                                <a class="items-list" href="#flights-links" data-bs-toggle="collapse">Hotels<span><i class="fa fa-chevron-down arrow"></i></span></a>
                                <div class="collapse sub-menu" id="flights-links">
                                    <a class="items-list" href="#">Sub Menu 1</a>
                                    <a class="items-list" href="#">Sub Menu 2</a>
                                    <a class="items-list" href="#">Sub Menu 3</a>
                                    <a class="items-list" href="#">Sub Menu 4</a>

                                </div><!-- end sub-menu -->

                                <a class="items-list" href="#hotels-links" data-bs-toggle="collapse"><span></span>Menu 1<span><i class="fa fa-chevron-down arrow"></i></span></a>
                                <div class="collapse sub-menu" id="hotels-links">
                                    <a class="items-list" href="#">Sub Menu 1</a>
                                    <a class="items-list" href="#">Sub Menu 2</a>
                                    <a class="items-list" href="#">Sub Menu 3</a>
                                    <a class="items-list" href="#">Sub Menu 4</a>
                                </div><!-- end sub-menu -->

                                <a class="items-list" href="#tours-links" data-bs-toggle="collapse">Menu 2<span><i class="fa fa-chevron-down arrow"></i></span></a>
                                <div class="collapse sub-menu" id="tours-links">
                                    <a class="items-list" href="#">Sub Menu 1</a>
                                    <a class="items-list" href="#">Sub Menu 2</a>
                                    <a class="items-list" href="#">Sub Menu 3</a>
                                    <a class="items-list" href="#">Sub Menu 4</a>
                                </div><!-- end sub-menu -->

                                <a class="items-list" href="#cruise-links" data-bs-toggle="collapse">Menu 3<span><i class="fa fa-chevron-down arrow"></i></span></a>
                                <div class="collapse sub-menu" id="cruise-links">
                                    <a class="items-list" href="#">Sub Menu 1</a>
                                    <a class="items-list" href="#">Sub Menu 2</a>
                                    <a class="items-list" href="#">Sub Menu 3</a>
                                    <a class="items-list" href="#">Sub Menu 4</a>
                                </div><!-- end sub-menu -->


                            </div><!-- End list-group panel -->
                        </div><!-- End main-menu -->
                    </nav>
                </div><!-- End sidenav-content -->

            </div>
        </div>
    </section>
    <!-- End:Mobile Header -->


    <!-- Start: Mobile Search Bar -->

    <div class="overlay" id="overlay"></div>

    <!-- Fixed Search Button -->
    <button class="search-button-sidebar" id="searchBtn"> <i class="fa fa-search search-icon-top-mb"></i></button>


    <section class="mb-search-bar" id="searchBar">
        <div class="mb-search-wrapper">
            <div class="category-item">
                <ul>
                    <li><a href="#">Hotel</a></li>
                    <!-- <li><a href="#">Resort</a></li> -->
                </ul>
            </div>
            <!--  -->
            <div class="search-bar search-bar-mb-list">
                <div class="search-container search-item">
                    <label for="mobile-destination-input">Where To?</label>
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
                        <label for="checkin-mobile">Add date</label>
                        <input type="text" id="checkin-mobile" placeholder="Check In" readonly />
                    </div>
                    <div class="search-container search-item">
                        <label for="checkout-mobile">Add date</label>
                        <input type="text" id="checkout-mobile" placeholder="Check Out" readonly />
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
                <div class="search-container search-item search-button-group" style="border: none;">
                    <div class="guest-container">
                        <!-- Guest Button -->
                        <div id="guest-dropdown-mobile" class="guest-dropdown">
                            <label>Persons</label>
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
                        <i class="fa fa-search search-icon-top-mb"></i>
                    </button>
                </div>

            </div>
            <!--  -->


        </div>
    </section>
    <!-- End: Mobile Search Bar -->

    <!--Start: Mobile Footer Bar -->
    <section class="footer-fixed">
        <div class="footer-menu">
            <div class="footer-menu-items">
                <div class="wish-list-card text-center">
                    <div class="wish-list">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                        </svg>
                    </div>
                    <p class="footer-bar-title">Saved List</p>
                </div>

                <div class="explore text-center">
                    <div class="explore-logo">
                        <img src="{{ asset('frontend')}}/images/icons/ez.png">
                        <p class="footer-bar-title">Explore</p>
                    </div>
                </div>
                <div class="message-chat-card text-center">
                    <div class="message-chat">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        </svg>
                    </div>
                    <p class="footer-bar-title">Message</p>
                </div>

            </div>
        </div>
    </section>
    <!--ENd: Mobile Footer Bar -->


    <button id="scrollTopBtn" onclick="scrollToTop()"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></button>





    <!--Start: Top Bar -->
    <section class="top-bar-area" id="stickyBar">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="egkom-logo">
                        <a href="{{ asset('/') }}" class="navbar-brand main-logo py-1 m-0">
                            <img src="{{ asset('frontend')}}/images/logo.png" alt="Egkom">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <!-- Small Search Box -->
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
                    <!-- Large Search Box -->
                    <div class="booking-search-wrapper" id="largeSearchBox" style="display: none;">
                        <div class="booking-search-box">
                            <div class="search-bar">
                                <div class="search-container search-item search-box-first">
                                    <label for="desktop-destination-input">Where</label>
                                    <input type="text" id="desktop-destination-input" placeholder="Search destinations" onfocus="showDesktopSuggestions()" onblur="hideDesktopSuggestions()">
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







 @yield('main')


    <!-- Hotel details Modal -->
    <div class="modal fade right" id="rightSidebarModalDetails" tabindex="-1" aria-labelledby="rightSidebarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-room">
                    <button type="button" class="close modal-btn-fixed"data-bs-dismiss="modal" aria-label="Close">
                        <span class="modal-close-button" aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal-body-room">
                    <div class="modal-header-custom">
                        <div class="modal-header-left">
                            <h3 class="room-title-modal"> Suite Room </h3>
                            <p class="room-numbers">Room # 105<br> <span style="padding-left:0px" class="floor-numbers">3rd Floor</span></p>
                            <div class="option-meta">
                   <span data-v-798d4468="" data-toggle="tooltip" class="non-refundable" data-bs-original-title="The Option is not non-refundable"> Non-Refundable <i data-v-798d4468="" variant="primary" class="fa fa-info-circle"></i>
                   </span>
                            </div>
                        </div>
                        <div class="modal-header-right">
                            <div class="discount-tag-modal">
                                <span  class="discount-tag"> 69% off </span>
                            </div>
                            <div class="price-amount">
                                <span class="price-before-discount-modal"> BDT 6,000 </span>
                                <span  class="discount-price-modal"> BDT 4,000 </span>
                            </div>
                            <div class="price-per-modal"> Per Night </div>
                        </div>

                    </div>
                    <div class="bd-example bd-example-tabs">
                        <div class="row" style="border-bottom: 1px solid #ccc; margin-bottom: 15px;">
                            <nav class="col-md-8">
                                <div class="nav nav-tabs nav-tabbing-padding" id="nav-tab" role="tablist" style="border:none;">
                                    <a class="nav-item nav-modal-room nav-link text-black active" id="nav-home-tab" data-bs-toggle="tab" href="#hotel-room" role="tab" aria-controls="nav-home" aria-selected="true">Room Photo</a>
                                    <a class="nav-item nav-modal-room nav-link text-black" id="nav-profile-tab" data-bs-toggle="tab" href="#facility" role="tab" aria-controls="nav-profile" aria-selected="false">Room Facilities </a>
                                    <a class="nav-item nav-modal-room nav-link text-black" id="nav-contact-tab" data-bs-toggle="tab" href="#others" role="tab" aria-controls="nav-contact" aria-selected="false">Room Details</a>
                                </div>
                            </nav>

                            <div class="col-lg-4">
                                <div class="action-btn-group">
                                    <div class="quantity-btn" >
                                        <form action="">
                                            <p class="qty qty-room" style="margin: 0px;">
                                                <button type="button" class="qtyminus" aria-hidden="true">&minus;</button>
                                                <input type="number" name="qty" id="qty" min="1" max="10" step="1" value="1">
                                                <button type="button" class="qtyplus" aria-hidden="true">&plus;</button>
                                                <label style="padding-left: 15px;" for="qty">Quantity</label>
                                            </p>
                                        </form>
                                    </div>

                                    <div class="book_btn_2" style="margin-bottom: 7px; margin-top: 0px;">
                                        <a href="">Add to<span> Book</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="hotel-room" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="all-rooms-details">
                                    <div class="row">



                                        <div class="col-6 col-md-6 luxury-room-block">
                                            <img class="img-fluid" src="{{ asset('frontend')}}/images/hotel/urmee/3.jpg" alt="luxury-room-img">
                                        </div>

                                        <div class="col-6 col-md-6 luxury-room-block">
                                            <img class="img-fluid" src="{{ asset('frontend')}}/images/hotel/urmee/3a.jpg" alt="luxury-room-img">
                                        </div>

                                        <div class="col-6 col-md-6 luxury-room-block">
                                            <img class="img-fluid" src="{{ asset('frontend')}}/images/hotel/urmee/3b.jpg" alt="luxury-room-img">
                                        </div>

                                        <div class="col-6 col-md-6 luxury-room-block">
                                            <img class="img-fluid" src="{{ asset('frontend')}}/images/hotel/urmee/3.jpg" alt="luxury-room-img">
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="facility" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="facilites-card">
                                    <div class="feature-all">
                                        <div data-plugin-in-point-id="AMENITIES_DEFAULT" data-section-id="AMENITIES_DEFAULT">
                                            <section>


                                                <div data-v-58caae98="" id="facilities" class="hotel-facilities room-section" style="border: none; box-shadow:none; padding: 0px;">
                                                    <h3 data-v-58caae98="" class="facility-title">
                                                        Facilities of Room
                                                    </h3>
                                                    <div data-v-58caae98="" class="facility-wrapper" style="padding: 0px;">
                                                        <div data-v-58caae98="" class="facility-container">

                                                            <div data-v-58caae98="" class="facilities-flex">

                                                                <div data-v-58caae98="" class="facilities-column">
                                                                    <h3 data-v-58caae98="" class="general-title">
                                                                        <span class="faci-icon-awe"><i class="fa fa-bed fa-bed-custom"></i></span> Appliances Information
                                                                    </h3>
                                                                    <ul data-v-58caae98="" class="general-facilities-list">
                                                                        <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                                            AC
                                                                        </li>
                                                                        <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                                            TV
                                                                        </li>

                                                                        <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                                            Fridge
                                                                        </li>

                                                                        <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                                            Microwave
                                                                        </li>


                                                                        <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                                            Fan
                                                                        </li>

                                                                        <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                                            Lamp
                                                                        </li>
                                                                    </ul>
                                                                </div>


                                                                <div data-v-58caae98="" class="facilities-column">
                                                                    <h3 data-v-58caae98="" class="general-title">
                                                                        <span class="faci-icon-awe"><i class="fa fa-bed fa-bed-custom"></i></span> Furniture Information
                                                                    </h3>
                                                                    <ul data-v-58caae98="" class="general-facilities-list">
                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Bed
                                                                        </li>
                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Dining Table with Chair
                                                                        </li>

                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Sofa/Couch
                                                                        </li>

                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Tea Table
                                                                        </li>


                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Bedside Table
                                                                        </li>

                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Shoe Rack
                                                                        </li>
                                                                    </ul>
                                                                </div>


                                                                <div data-v-58caae98="" class="facilities-column">
                                                                    <h3 data-v-58caae98="" class="general-title">
                                                                        <span class="faci-icon-awe"><i class="fa fa-bed fa-bed-custom"></i></span> Room Amenities
                                                                    </h3>
                                                                    <ul data-v-58caae98="" class="general-facilities-list">
                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Soap
                                                                        </li>
                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Tissue
                                                                        </li>

                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Shampoo
                                                                        </li>

                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Toothbrush
                                                                        </li>


                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Towel
                                                                        </li>

                                                                        <li data-v-58caae98="">
                                         <span>
                                            <svg style="color: #91278f;
                                               margin-top: -3px;
                                               margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                               <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                            </svg>
                                         </span>
                                                                            Water bottle
                                                                        </li>
                                                                    </ul>
                                                                </div>






                                                            </div>





                                                        </div>
                                                    </div>


                                                </div>
                                        </div>

                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="room-details-modal">

                                <div class="room-details-des">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div data-v-58caae98="" class="facilities-flex">
                                    <div data-v-58caae98="" class="facilities-column">
                                        <h3 data-v-58caae98="" class="general-title">
                                            <span class="faci-icon-awe"><i class="fa fa-bed fa-bed-custom"></i> Appliance Information                                </h3>
                                        <ul data-v-58caae98="" class="general-facilities-list">
                                            <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                AC
                                            </li>
                                            <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                TV
                                            </li>

                                            <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                Fridge
                                            </li>

                                            <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                TV
                                            </li>
                                        </ul>
                                    </div>


                                    <div data-v-58caae98="" class="facilities-column">
                                        <h3 data-v-58caae98="" class="general-title">
                                  <span class="faci-icon-awe"><i class="fa fa-bed fa-bed-custom"></i> Furniture Information
                                        </h3>

                                        <ul data-v-58caae98="" class="general-facilities-list">
                                            <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                Swimming Pool
                                            </li>
                                            <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                Heated Swimming Pool
                                            </li>

                                            <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                Gym
                                            </li>
                                            <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                Hair Dressing Salon
                                            </li>

                                            <li data-v-58caae98="">
                                       <span>
                                          <svg style="color: #91278f;
                                             margin-top: -3px;
                                             margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                             <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                          </svg>
                                       </span>
                                                Massage
                                            </li>
                                        </ul>
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
<!-- Hotel details Modal -->


<style>
    div#hotel-details {
        padding-top: 105px;
    }
    .top-bar-area {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: white;
        z-index: 1000;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .sticky-top-search {
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .booking-search-wrapper {
        display: none;

    }
    .headerss.fixed {
        width: 96%;
        position: fixed;
        top: 0px;
        height: 43px;
        /* box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1); */
        border: none;
        z-index: 444;
    }
    h2.meta-info-hotel {
        font-size: 28px;
        padding-bottom: 30px;
        color: #91278f;
        font-weight: 500;
        font-family: 'Lato', sans-serif
    }

    @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
        section.mobile-header-erapper {
            position: relative !important;
        }
        .headerss.fixed {
            top: 0px !important;
        }
        section.mb-search-bar {
            padding-top: 5px;
        }
    }
</style>



<!-- Mb view Cart button -->




<!-- Desktop view on scroll Cart button -->
<div class="cart-container-dv" id="cartIcon" onclick="toggleCart(event)">
    <div class="cart-badge-dv">2</div>
    <i class="fa fa-shopping-cart"></i>
    <div class="cart-text-dv">Booking<br> Cart</div>
</div>

<div class="cart-box" id="cartBox">
    <div  id="cart-bar" class="cart-visible" style="z-index: 1;">
        <div class="backdrop"></div>
        <div class="cart-wrapper">
            <div class="cart-header">
                <h2>Pricing Summary</h2>
            </div>
            <div class="rooms-selection-container">
                <div class="rooms">
                    <p class="text-center text-primary"> Added Rooms </p>
                    <div>
                        <div class="room">
                            <div class="room-content">
                                <div class="room-name"> Twin Room </div>
                                <div class="pax-and-fare">
                                    <span class="fare"> BDT 4,392 </span>
                                </div>
                            </div>
                            <div class="delete-button"></div>
                        </div>
                        <!---->
                    </div>
                </div>

                <div class="rooms">
                    <div>
                        <div class="room">
                            <div class="room-content">
                                <div class="room-name"> Queen Room </div>
                                <div class="pax-and-fare">
                                    <span class="fare"> BDT 7,500 </span>
                                </div>
                            </div>
                            <div class="delete-button"></div>
                        </div>
                        <!---->
                    </div>
                </div>


                <div class="action">
                    <div class="total-amount">
                        <span class="amount">Total=  BDT 4,392 </span>
                        <p class="tax-tag"> Fee or Tax Will show ate the check out page (if any) </p>
                    </div>
                    <a href="hotel-cart.html"> <button type="button" class="btn btn-secondary total-con btn-block"> Continue </button></a>
                </div>
            </div>
        </div>
    </div>
</div>








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

<!-- end popup-ad -->
</div>
<!-- Page Scripts Starts -->
<script src="{{ asset('frontend')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('frontend')}}/js/popper.min.js"></script>
<script src="{{ asset('frontend')}}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('frontend')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ asset('frontend')}}/js/bootstrap-5.3.2.min.js"></script>
<script src="{{ asset('frontend')}}/js/jquery.flexslider.js"></script>
<script src="{{ asset('frontend')}}/{{ asset('frontend')}}/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('frontend')}}/js/owl.carousel.min.js"></script>
<script src="{{ asset('frontend')}}/js/custom-navigation.js"></script>
<script src="{{ asset('frontend')}}/{{ asset('frontend')}}/js/custom-flex.js"></script>
<script src="{{ asset('frontend')}}/js/custom-owl.js"></script>
<script src="{{ asset('frontend')}}/js/custom-date-picker.js"></script>
<script src="{{ asset('frontend')}}/js/custom-video.js"></script>
<script src="{{ asset('frontend')}}/js/popup-ad.js"></script>
<script src="{{ asset('frontend')}}/js/slick.min.js"></script>
<script src="{{ asset('frontend')}}/js/custom-slick.js"></script>
<script src="{{ asset('frontend')}}/js/custom-gallery.js"></script>
<script src="{{ asset('frontend')}}/js/script.js"></script>
<script src="{{ asset('frontend')}}/https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('frontend')}}/js/jquery-ui.min.js"></script>




<script>

    const smallSearchBox = document.getElementById('smallSearchBox');
    const largeSearchBox = document.getElementById('largeSearchBox');
    const stickyBar = document.getElementById('stickyBar');

    let lastScrollPosition = 0;

    // Show large search box when clicking on small search box
    smallSearchBox.addEventListener('click', () => {
        largeSearchBox.style.display = 'block';
    });

    // Handle scroll behavior
    window.addEventListener('scroll', () => {
        const currentScrollPosition = window.pageYOffset;

        if (currentScrollPosition > lastScrollPosition) {
            // Scrolling down - hide the sticky bar
            stickyBar.style.transform = 'translateY(-100%)';
            stickyBar.style.transition = 'transform 0.3s ease-in-out'; // Smooth hide animation
        } else {
            // Scrolling up - show the sticky bar
            stickyBar.style.transform = 'translateY(0)';
        }

        // Update the last scroll position
        lastScrollPosition = currentScrollPosition;
    });

    // Optional: Hide large search box when clicking outside
    document.addEventListener('click', (event) => {
        if (!largeSearchBox.contains(event.target) && !smallSearchBox.contains(event.target)) {
            largeSearchBox.style.display = 'none';
        }
    });

</script>




<!-- Sticky All Hotel  menu  -->
<script type="text/javascript">

    $(window).scroll(function(){
        if ($(this).scrollTop() > 180) {
            $('.headerss').addClass('fixed');
        } else {
            $('.headerss').removeClass('fixed');
        }
    });

</script>




<script>
    $(document).ready(function() {
        // Initialize Slick slider
        $(".slider").slick();

        // Ensure Slick slider positions correctly on tab switch
        $('.nav-tabs a[data-bs-toggle="tab"]').on('shown.bs.tab', function() {
            $('.slider').slick('setPosition');
        });

        // Show the first tab content every time the modal opens
        $('#exampleModal').on('shown.bs.modal', function () {
            // Set the first tab to be active
            $('#nav-home-tab').addClass('active').attr('aria-selected', 'true');
            $('#nav-profile-tab, #nav-contact-tab').removeClass('active').attr('aria-selected', 'false');

            // Show the content of the first tab and hide others
            $('#nav-home').addClass('show active');
            $('#nav-profile, #nav-contact').removeClass('show active');
        });
    });
</script>

<script>
    document.getElementById('exampleModal').addEventListener('shown.bs.modal', function () {
        if (typeof mySwiper !== 'undefined') {
            mySwiper.update(); // Refresh the Swiper slider
        }
    });

    // modal right Side bar
    document.getElementById('exampleModal').addEventListener('shown.bs.modal', function () {
        // Initialize or refresh the slider in the active tab
        $('.slider').slick('setPosition'); // Recalculates dimensions
    });


</script>

<script>
    // Initialize tooltips
    $(function () {
        /*var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        */

        $('[data-toggle="tooltip"]').tooltip();
    })


    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });

</script>


<script>
    document.querySelectorAll('.nav-tabing-custom a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            const offset = 130;
            const topPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - offset;

            window.scrollTo({
                top: topPosition,
                behavior: 'smooth'
            });
        });
    });
</script>


<!-- cart button on mb -->
<script>
    function toggleCart() {
        let cart = document.getElementById("cart");
        cart.classList.toggle("show");
    }
</script>


<!-- cart button on scroll top to bottomm -->
<script>
    window.addEventListener("scroll", function() {
        let cartIcon = document.getElementById("cartIcon");
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Show cart when within 500px of the top (header)
        if (scrollTop >= 900) {
            cartIcon.style.display = "block";
            setTimeout(() => { cartIcon.style.opacity = "1"; }, 10); // Smooth fade-in
        } else {
            cartIcon.style.opacity = "0";
            setTimeout(() => { cartIcon.style.display = "none"; }, 300); // Hide after fade-out
        }
    });

    function toggleCart(event) {
        event.stopPropagation();
        let cartBox = document.getElementById("cartBox");
        if (cartBox.classList.contains("show")) {
            cartBox.classList.remove("show");
            setTimeout(() => { cartBox.style.display = "none"; }, 300);
        } else {
            cartBox.style.display = "block";
            setTimeout(() => { cartBox.classList.add("show"); }, 10);
        }
    }

    document.addEventListener("click", function(event) {
        let cartBox = document.getElementById("cartBox");
        let cartIcon = document.getElementById("cartIcon");
        if (!cartBox.contains(event.target) && !cartIcon.contains(event.target)) {
            cartBox.classList.remove("show");
            setTimeout(() => { cartBox.style.display = "none"; }, 300);
        }
    });
</script>


</body>
</html>
