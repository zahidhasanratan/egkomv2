@extends('frontend.app')
@section('title','Booking Checkout - EZBOOKING')
@section('main')

<!--===== INNERPAGE-WRAPPER ====-->
<section class="innerpage-wrapper innerpage-wrapper-custom">
    <div data-v-1b1a5b0b="" id="hotelBooking">
        <div data-v-1b1a5b0b="" class="container form-container fill-height">
            <div data-v-1b1a5b0b="" class="row booking-info-wrapper">
                <div data-v-1b1a5b0b="" class="col-12 col-lg-8 booking-guest-info">
                    <div data-v-1b1a5b0b="" id="sign-in-notice">
                        <p data-v-1b1a5b0b="">
                            <svg data-v-1b1a5b0b="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="#1C3C6B" fill-rule="evenodd">
                                <path data-v-1b1a5b0b="" id="a" transform="translate(-2 -2)" d="M13.75 11.875a3.75 3.75 0 0 1 3.745 3.55l.005.2v.938c0 .517-.42.937-.938.937H3.438a.937.937 0 0 1-.937-.938v-.937a3.75 3.75 0 0 1 3.75-3.75h7.5ZM10 2.5a3.754 3.754 0 0 1 3.75 3.75A3.754 3.754 0 0 1 10 10a3.754 3.754 0 0 1-3.75-3.75A3.754 3.754 0 0 1 10 2.5Z"></path>
                            </svg>
                            @auth('guest')
                                <span style="color: #1C3C6B; font-weight: 600;" data-v-1b1a5b0b="">Welcome, {{ auth('guest')->user()->name }}!</span> EZBOOKING.com will send your booking confirmation (including the hotel's contact information) to <strong>{{ auth('guest')->user()->email }}</strong>.
                            @else
                                <a href="{{ route('guest.login') }}" style="color: #1C3C6B; text-decoration: underline; font-weight: 600;" data-v-1b1a5b0b="">Sign In</a> and EZBOOKING.com will send your booking confirmation (including the hotel's contact information) to this.
                            @endauth
                        </p>
                    </div>
                    <h4 data-v-1b1a5b0b="" class="text-primary font-weight-bolder booking-header"> Review Your Booking </h4>

                    <!-- Dynamic Booking Cards Container -->
                    <div id="bookingCardsContainer">
                        <!-- Will be populated dynamically -->
                    </div>

                    <!-- Primary Contact Person Details -->
                    <div class="hotel-booking-container">
                        <h4>Primary Contact Person Details</h4>
                        <div class="hotel-booking-form">
                            <div class="room">
                                <h4 class="room-no" id="primaryContactRoomName">Contact Information</h4>
                                <div>
                                    <form id="bookingForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="guest-full-name">Primary Contact Person</label>
                                                <input type="text" id="guest-full-name" placeholder="Enter your full name as NID or Passport" class="form-control" required oninput="updatePrimaryContactOptions()" />
                                            </div>
                                            <div class="mb-1 col-md-6">
                                                <label for="phone-number">Mobile Number</label>
                                                <input type="text" id="phone-number" placeholder="+880 1XXX XXXXXX" class="form-control" required />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Relationship With Guest -->
                    <div data-v-1b1a5b0b="" id="primary-contact">
                        <form class="">
                            <div class="row">
                                <div data-v-1b1a5b0b="" class="mt-1">
                                    <div data-v-1b1a5b0b="" class="section-header">
                                        <h4 class="title"> Relationship With Guest</h4>
                                    </div>
                                    <div data-v-1b1a5b0b="" class="row">
                                        <div data-v-1b1a5b0b="" class="mb-1 col-md-12 relation-flex">
                                            <label data-v-1b1a5b0b="" class="additional-req-input">
                                                <div data-v-1b1a5b0b="" class="m-0 custom-control custom-radio">
                                                    <input type="radio" id="family" name="relationship" class="custom-control-input" value="family">
                                                    <label class="custom-control-label" for="family"> Family </label>
                                                </div>
                                            </label>
                                            <label data-v-1b1a5b0b="" class="additional-req-input">
                                                <div data-v-1b1a5b0b="" class="m-0 custom-control custom-radio">
                                                    <input type="radio" id="husband" name="relationship" class="custom-control-input" value="husband">
                                                    <label class="custom-control-label" for="husband"> Husband/Wife </label>
                                                </div>
                                            </label>
                                            <label data-v-1b1a5b0b="" class="additional-req-input">
                                                <div data-v-1b1a5b0b="" class="m-0 custom-control custom-radio">
                                                    <input type="radio" id="friends" name="relationship" class="custom-control-input" value="friends">
                                                    <label class="custom-control-label" for="friends"> Group Of Friends </label>
                                                </div>
                                            </label>
                                            <label data-v-1b1a5b0b="" class="additional-req-input">
                                                <div data-v-1b1a5b0b="" class="m-0 custom-control custom-radio">
                                                    <input type="radio" id="colleagues" name="relationship" class="custom-control-input" value="colleagues">
                                                    <label class="custom-control-label" for="colleagues"> Colleagues </label>
                                                </div>
                                            </label>
                                            <label data-v-1b1a5b0b="" class="additional-req-input">
                                                <div data-v-1b1a5b0b="" class="m-0 custom-control custom-radio">
                                                    <input type="radio" id="onlyMe" name="relationship" class="custom-control-input" value="onlyMe" checked>
                                                    <label class="custom-control-label" for="onlyMe"> Only Me </label>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Number of Guests -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="title">Number of Guests</h4>
                                    <div class="member-add-cal">
                                        <div class="quantity-btn-group">
                                            <!-- Total Male -->
                                            <div class="quantity-title">
                                                <label for="qty">Total Male</label>
                                                <p class="qty">
                                                    <button type="button" class="qtyminus" data-target="qty" aria-hidden="true">−</button>
                                                    <input type="number" name="qty" id="qty" min="0" max="10" step="1" value="1">
                                                    <button type="button" class="qtyplus" data-target="qty" aria-hidden="true">+</button>
                                                </p>
                                            </div>
                                            <!-- Total Female -->
                                            <div class="quantity-title">
                                                <label for="qty2">Total Female</label>
                                                <p class="qty">
                                                    <button type="button" class="qtyminus" data-target="qty2" aria-hidden="true">−</button>
                                                    <input type="number" name="qty2" id="qty2" min="0" max="10" step="1" value="0">
                                                    <button type="button" class="qtyplus" data-target="qty2" aria-hidden="true">+</button>
                                                </p>
                                            </div>
                                            <!-- Total Kids -->
                                            <div class="quantity-title">
                                                <label for="qty3">Total Kids</label>
                                                <p class="qty">
                                                    <button type="button" class="qtyminus" data-target="qty3" aria-hidden="true">−</button>
                                                    <input type="number" name="qty3" id="qty3" min="0" max="10" step="1" value="0">
                                                    <button type="button" class="qtyplus" data-target="qty3" aria-hidden="true">+</button>
                                                </p>
                                            </div>
                                            <!-- Total Persons -->
                                            <div class="total-person">
                                                <div class="total-title">Total Persons</div>
                                                <div class="total-number-person">
                                                    <h2 id="totalPersons">1</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Input Fields for Other Guests -->
                            <div class="row" id="guestInputFields"></div>

                            <!-- Booking Information -->
                            <div data-v-1b1a5b0b="" class="row">
                                <h4 data-v-1b1a5b0b="" class="title"> Booking Information</h4>
                                <div class="mb-1 col-md-6 order-1 order-md-1">
                                    <div class="form-group">
                                        <label for="checkin-date">Check-in Date:</label>
                                        <input type="date" id="checkin-date" name="checkin-date" class="form-control" required readonly style="background-color: #f5f5f5; cursor: not-allowed;">
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6 order-3 order-md-2">
                                    <fieldset data-v-1b1a5b0b="" class="form-group">
                                        <legend class="col-form-label pt-0">Room Type</legend>
                                        <div>
                                            <input data-v-1b1a5b0b="" type="text" id="room-type" placeholder="" class="form-control">
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="mb-1 col-md-6 order-2 order-md-3">
                                    <div class="form-group">
                                        <label for="checkout-date">Check-out Date:</label>
                                        <input type="date" id="checkout-date" name="checkout-date" class="form-control" required readonly style="background-color: #f5f5f5; cursor: not-allowed;">
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6 order-4 order-md-4">
                                    <fieldset data-v-1b1a5b0b="" class="form-group">
                                        <legend class="col-form-label pt-0">Room/Apartment Number</legend>
                                        <div>
                                            <input data-v-1b1a5b0b="" type="text" placeholder="" class="form-control" id="room-number">
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <div data-v-1b1a5b0b="" class="mb-1 col-md-12">
                                        <fieldset data-v-1b1a5b0b="" class="form-group">
                                            <legend class="col-form-label pt-0">Home Address:</legend>
                                            <div>
                                                <input data-v-1b1a5b0b="" type="text" placeholder="" class="form-control" id="home-address" required>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div data-v-1b1a5b0b="" class="mb-1 col-md-6">
                                        <fieldset data-v-1b1a5b0b="" class="form-group">
                                            <legend class="col-form-label pt-0">Organization I work in <span class="chk-span">(Optional)</span></legend>
                                            <div>
                                                <input data-v-1b1a5b0b="" type="text" placeholder="" class="form-control" id="organization">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div data-v-1b1a5b0b="" class="mb-1 col-md-6">
                                        <fieldset data-v-1b1a5b0b="" class="form-group">
                                            <legend class="col-form-label pt-0">Organization Address<span class="chk-span"> (Optional)</span></legend>
                                            <div>
                                                <input data-v-1b1a5b0b="" type="text" placeholder="" class="form-control" id="org-address">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Additional Requests -->
                    <div data-v-1b1a5b0b="" id="additional-request">
                        <h4 data-v-1b1a5b0b="" class="title"> Additional Requests </h4>
                        <p data-v-1b1a5b0b="" class="sub-title"> Request will be passed to property, <b data-v-1b1a5b0b="">fulfillment subject to availability</b></p>
                        <form data-v-1b1a5b0b="" class="">
                            <div data-v-1b1a5b0b="" class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="additional-req-input">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="airportTransfer" onchange="toggleFlightDetailsMessage()">
                                            <label class="custom-control-label" for="airportTransfer"> Airport Transfer </label>
                                        </div>
                                    </label>
                                    <small id="flightDetailsMessage" class="text-danger" style="display: none;">
                                        *Provide flight details in the note; extra charges may apply.
                                    </small>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="additional-req-input">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="extraBed" onchange="toggleExtraBedMessage()">
                                            <label class="custom-control-label" for="extraBed"> Extra Bed </label>
                                        </div>
                                    </label>
                                    <small id="extraBedMessage" class="text-danger" style="display: none;">
                                        *Extra charges may apply
                                    </small>
                                </div>
                            </div>
                            <div data-v-1b1a5b0b="" class="row">
                                <div data-v-1b1a5b0b="" class="mb-1 col-md-6">
                                    <label data-v-1b1a5b0b="" class="additional-req-input">
                                        <div data-v-1b1a5b0b="" class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="true" id="higherFloor">
                                            <label class="custom-control-label" for="higherFloor"> Room On a Higher Floor </label>
                                        </div>
                                    </label>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="additional-req-input">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="roomDecorations" onchange="toggleDecorationMessage()">
                                            <label class="custom-control-label" for="roomDecorations"> Decorations in Room </label>
                                        </div>
                                    </label>
                                    <small id="decorationMessage" class="text-danger" style="display: none;">
                                        *Extra charges may apply
                                    </small>
                                </div>
                                <div data-v-1b1a5b0b="" class="mb-1 col-md-6">
                                    <label data-v-1b1a5b0b="" class="additional-req-input">
                                        <div data-v-1b1a5b0b="" class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="true" id="kitchenFacility">
                                            <label class="custom-control-label" for="kitchenFacility"> Kitchen Facility </label>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Bed Type -->
                            <div data-v-1b1a5b0b="" class="mt-1">
                                <div data-v-1b1a5b0b="" class="section-header">
                                    <span data-v-1b1a5b0b="" class="custom-label">Bed Type</span>
                                </div>
                                <div data-v-1b1a5b0b="" class="row">
                                    <div data-v-1b1a5b0b="" class="mb-1 col-md-6">
                                        <label data-v-1b1a5b0b="" class="additional-req-input bed-type">
                                            <div data-v-1b1a5b0b="" class="custom-control custom-radio">
                                                <input type="radio" name="bed-type" class="custom-control-input" value="Large Bed" id="largeBed">
                                                <label class="custom-control-label" for="largeBed"> Large Bed </label>
                                            </div>
                                            <i data-v-1b1a5b0b="" class="fa fa-bed"></i>
                                        </label>
                                    </div>
                                    <div data-v-1b1a5b0b="" class="mb-1 col-md-6">
                                        <label data-v-1b1a5b0b="" class="additional-req-input bed-type">
                                            <div data-v-1b1a5b0b="" class="custom-control custom-radio">
                                                <input type="radio" name="bed-type" class="custom-control-input" value="Twin Beds" id="twinBeds">
                                                <label class="custom-control-label" for="twinBeds"> Twin Beds </label>
                                            </div>
                                            <i data-v-1b1a5b0b="" class="fa fa-bed"></i>
                                            <i data-v-1b1a5b0b="" class="fa fa-bed"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Room Preference -->
                            <div data-v-1b1a5b0b="" class="mt-1">
                                <div data-v-1b1a5b0b="" class="section-header">
                                    <span data-v-1b1a5b0b="" class="custom-label">Room Preference</span>
                                </div>
                                <div data-v-1b1a5b0b="" class="row">
                                    <div data-v-1b1a5b0b="" class="mb-1 col-md-6">
                                        <label data-v-1b1a5b0b="" class="additional-req-input">
                                            <div data-v-1b1a5b0b="" class="m-0 custom-control custom-radio">
                                                <input type="radio" name="room-smoking-type" class="custom-control-input" value="Non-Smoking" id="nonSmoking" checked>
                                                <label class="custom-control-label" for="nonSmoking"> Non-Smoking </label>
                                            </div>
                                        </label>
                                    </div>
                                    <div data-v-1b1a5b0b="" class="mb-1 col-md-6">
                                        <label data-v-1b1a5b0b="" class="additional-req-input">
                                            <div data-v-1b1a5b0b="" class="m-0 custom-control custom-radio">
                                                <input type="radio" name="room-smoking-type" class="custom-control-input" value="Smoking" id="smoking">
                                                <label class="custom-control-label" for="smoking"> Smoking </label>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Note for Property -->
                            <div data-v-1b1a5b0b="" class="mt-1">
                                <div data-v-1b1a5b0b="" class="custom-label"> Leave a Note For The Property </div>
                                <textarea data-v-1b1a5b0b="" placeholder="I am arriving by Flight No. XX- XXX. Please see if you can arrange an airport shuttle." rows="3" wrap="soft" class="form-control" style="resize: none;" id="property-note"></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Arrival Time -->
                    <div class="arrival_time">
                        <div class="arrival-time-content">
                            <h4 data-v-1b1a5b0b="" class="title"> Your arrival time</h4>
                            <div class="arrival-list">
                                <ul class="bui-list bui-list--text bui-list--icon">
                                    <li class="bui-list__item">
                                        <span class="bui-list__icon" role="presentation">
                                            <svg class="bk-icon -streamline-checkmark_selected" fill="#008009" height="24" width="24" viewBox="0 0 128 128" role="presentation" aria-hidden="true" focusable="false">
                                                <path d="M56.62 93.54a4 4 0 0 1-2.83-1.18L28.4 67a4 4 0 1 1 5.65-5.65l22.13 22.1 33-44a4 4 0 1 1 6.4 4.8L59.82 91.94a4.06 4.06 0 0 1-2.92 1.59zM128 64c0-35.346-28.654-64-64-64C28.654 0 0 28.654 0 64c0 35.346 28.654 64 64 64 35.33-.039 63.961-28.67 64-64zm-8 0c0 30.928-25.072 56-56 56S8 94.928 8 64 33.072 8 64 8c30.914.033 55.967 25.086 56 56z"></path>
                                            </svg>
                                        </span>
                                        <div class="bui-list__body">
                                            <div class="bui-list__description"> Your room will be ready for check-in at 15:00 </div>
                                        </div>
                                    </li>
                                    <li class="bui-list__item">
                                        <span class="bui-list__icon" role="presentation">
                                            <svg class="bk-icon -streamline-front_desk" fill="#008009" height="24" width="24" viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false">
                                                <path d="M14.244 14.156a6.75 6.75 0 0 0-6.75-5.906A6.747 6.747 0 0 0 .73 14.397a.75.75 0 0 0 1.494.134 5.25 5.25 0 0 1 5.27-4.781 5.253 5.253 0 0 1 5.262 4.594.75.75 0 1 0 1.488-.188zM10.125 4.125a2.625 2.625 0 1 1-5.25 0V1.5h5.25v2.625zm1.5 0V1.5a1.5 1.5 0 0 0-1.5-1.5h-5.25a1.5 1.5 0 0 0-1.5 1.5v2.625a4.125 4.125 0 0 0 8.25 0zM23.25 22.5H.75l.75.75v-7.5a.75.75 0 0 1 .75-.75h19.5a.75.75 0 0 1 .75.75v7.5l.75-.75zm0 1.5a.75.75 0 0 0 .75-.75v-7.5a2.25 2.25 0 0 0-2.25-2.25H2.25A2.25 2.25 0 0 0 0 15.75v7.5c0 .414.336.75.75.75h22.5zM4.376 5.017a9.42 9.42 0 0 1 3.12-.517 9.428 9.428 0 0 1 3.133.519.75.75 0 0 0 .49-1.418A10.917 10.917 0 0 0 7.498 3a10.91 10.91 0 0 0-3.611.6.75.75 0 0 0 .49 1.417zM15.75 14.27a3.001 3.001 0 0 1 6 .16.75.75 0 1 0 1.5.04 4.501 4.501 0 1 0-9-.24.75.75 0 1 0 1.5.04zm3.75-3.77V8.25a.75.75 0 0 0-1.5 0v2.25a.75.75 0 0 0 1.5 0zM17.25 9h3a.75.75 0 0 0 0-1.5h-3a.75.75 0 0 0 0 1.5z"></path>
                                            </svg>
                                        </span>
                                        <div class="bui-list__body">
                                            <div class="bui-list__description"> 24-hour front desk – Help whenever you need it! </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="arrival-time-zone">
                                <div class="bui-group__item">
                                    <div class="bui-grid">
                                        <div class="bui-grid__column">
                                            <div class="bui-form__group bp-form-group bp-form-group__checkin_eta_hour">
                                                <label class="bui-form__label" for="checkin_eta_hour">Add your estimated arrival time <span class="bp-form-field__indicator bp-form-field__indicator--required bui-text--variant-body_2 bui-text--color-destructive">*</span></label>
                                                <div class="bui-input-select">
                                                    <select name="checkin_eta_hour" class="bui-form__control" id="checkin_eta_hour" required>
                                                        <option value="" disabled="" selected="">Please select</option>
                                                        <option value="-1">I don't know</option>
                                                        <option value="0">00:00 – 01:00 </option>
                                                        <option value="1">01:00 – 02:00 </option>
                                                        <option value="2">02:00 – 03:00 </option>
                                                        <option value="3">03:00 – 04:00 </option>
                                                        <option value="4">04:00 – 05:00 </option>
                                                        <option value="5">05:00 – 06:00 </option>
                                                        <option value="6">06:00 – 07:00 </option>
                                                        <option value="7">07:00 – 08:00 </option>
                                                        <option value="8">08:00 – 09:00 </option>
                                                        <option value="9">09:00 – 10:00 </option>
                                                        <option value="10">10:00 – 11:00 </option>
                                                        <option value="11">11:00 – 12:00 </option>
                                                        <option value="12">12:00 – 13:00 </option>
                                                        <option value="13">13:00 – 14:00 </option>
                                                        <option value="14">14:00 – 15:00 </option>
                                                        <option value="15">15:00 – 16:00 </option>
                                                        <option value="16">16:00 – 17:00 </option>
                                                        <option value="17">17:00 – 18:00 </option>
                                                        <option value="18">18:00 – 19:00 </option>
                                                        <option value="19">19:00 – 20:00 </option>
                                                        <option value="20">20:00 – 21:00 </option>
                                                        <option value="21">21:00 – 22:00 </option>
                                                        <option value="22">22:00 – 23:00 </option>
                                                        <option value="23">23:00 – 00:00 </option>
                                                        <option value="24">00:00 – 01:00 (the next day)</option>
                                                        <option value="25">01:00 – 02:00 (the next day)</option>
                                                    </select>
                                                </div>
                                                <div id="form-field__helper--checkin_eta_hour" class="bui-form__helper">Time is for BD time zone</div>
                                            </div>

                                            <!-- Citizenship Selection -->
                                            <div class="mb-3 col-md-5 mt-1">
                                                <label for="citizenship" class="form-label">Select Citizenship</label>
                                                <select id="citizenship" class="form-control" onchange="toggleUploadFields()">
                                                    <option value="">-- Select --</option>
                                                    <option value="bangladesh">Bangladesh</option>
                                                    <option value="international">International</option>
                                                </select>
                                            </div>

                                            <!-- NID Upload Fields -->
                                            <div id="nid-upload" style="display: none;">
                                                <div class="mb-3 col-md-5 mt-1">
                                                    <label for="nidFront" class="form-label">Upload NID Front Side Photo:</label>
                                                    <input class="form-control" type="file" id="nidFront" accept="image/*" onchange="handleFilePreview(this, 'nidFrontPreview')">
                                                    <div id="nidFrontPreview" class="file-preview-container" style="display: none;">
                                                        <div class="file-preview-wrapper">
                                                            <img id="nidFrontPreviewImg" src="" alt="NID Front Preview" class="file-preview-image">
                                                            <button type="button" class="file-remove-btn" onclick="removeFilePreview('nidFront', 'nidFrontPreview')" title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-5 mt-1">
                                                    <label for="nidBack" class="form-label">Upload NID Back Side Photo:</label>
                                                    <input class="form-control" type="file" id="nidBack" accept="image/*" onchange="handleFilePreview(this, 'nidBackPreview')">
                                                    <div id="nidBackPreview" class="file-preview-container" style="display: none;">
                                                        <div class="file-preview-wrapper">
                                                            <img id="nidBackPreviewImg" src="" alt="NID Back Preview" class="file-preview-image">
                                                            <button type="button" class="file-remove-btn" onclick="removeFilePreview('nidBack', 'nidBackPreview')" title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Passport and Visa Upload Fields -->
                                            <div id="passport-upload" style="display: none;">
                                                <div class="mb-3 col-md-5 mt-1">
                                                    <label for="passport" class="form-label">Upload Passport Front Side Photo:</label>
                                                    <input class="form-control" type="file" id="passport" accept="image/*" onchange="handleFilePreview(this, 'passportPreview')">
                                                    <div id="passportPreview" class="file-preview-container" style="display: none;">
                                                        <div class="file-preview-wrapper">
                                                            <img id="passportPreviewImg" src="" alt="Passport Preview" class="file-preview-image">
                                                            <button type="button" class="file-remove-btn" onclick="removeFilePreview('passport', 'passportPreview')" title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-5 mt-1">
                                                    <label for="visa" class="form-label">Upload Visa Photo:</label>
                                                    <input class="form-control" type="file" id="visa" accept="image/*" onchange="handleFilePreview(this, 'visaPreview')">
                                                    <div id="visaPreview" class="file-preview-container" style="display: none;">
                                                        <div class="file-preview-wrapper">
                                                            <img id="visaPreviewImg" src="" alt="Visa Preview" class="file-preview-image">
                                                            <button type="button" class="file-remove-btn" onclick="removeFilePreview('visa', 'visaPreview')" title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
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
                    
                    <!-- Confirm Booking Button at Bottom of Form -->
                    <div class="mt-5 mb-4" style="padding-top: 30px; border-top: 2px solid #e0e0e0;">
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary btn-lg confirmation-btn" onclick="confirmBooking()" style="padding: 18px 50px; font-size: 18px; font-weight: 600; border-radius: 8px; background: linear-gradient(135deg, #91278f 0%, #7a1f78 100%); border: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(145, 39, 143, 0.3); color: white;">
                                    <i class="fa fa-check-circle" style="margin-right: 8px;"></i> Confirm Booking
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar - Price Summary -->
                <div data-v-1b1a5b0b="" class="col-12 col-lg-4">
                    <div data-v-58caae98="" id="cart-bar" class="cart-visible" style="z-index: 1;">
                        <div data-v-1b1a5b0b="" class="fare-and-policy-wrapper">
                            <div data-v-1b1a5b0b="" class="fare-and-policy-content">
                                <div data-v-30094f07="" data-v-1b1a5b0b="" class="fare-summary-wrapper hotel" id="booking-price-summary">
                                    <!-- Dynamically populated by JavaScript -->
                                </div>
                                
                                <!-- Booking Details Card -->
                                <section class="bui-card bp-card--booking-summary bui-u-bleed@small">
                                    <div class="bui-card__content">
                                        <header class="bui-card__header bui-spacer--large">
                                            <h2 class="bui-card__title">Your booking details</h2>
                                        </header>
                                        <div class="bui-group bui-group--large">
                                            <div class="bui-group bui-group--large">
                                                <div class="bui-group__item">
                                                    <div class="bui-date-range bui-date-range--large bp-date-range" id="bookingDateRange">
                                                        <!-- Will be populated dynamically -->
                                                    </div>
                                                </div>
                                                <div class="bui-group__item bui-group bui-group--small">
                                                    <div class="bui-group__item bui-f-font-emphasized">Total length of stay:</div>
                                                    <div class="bui-group__item bui-f-font-strong" id="totalNights"> 1 night </div>
                                                </div>
                                            </div>
                                            <hr class="bui-divider">
                                            <div class="bui-group bui-group--large">
                                                <div class="bui-group__item">
                                                    <ul class="bui-accordion bp-unit-selection-accordion">
                                                        <li class="bui-accordion__row bui-is-active">
                                                            <button class="bui-accordion__row-inner bp-unit-selection-accordion__row-inner" type="button">
                                                                <div class="bui-accordion__row-header" id="unit-selection-label">
                                                                    <p class="bui-accordion__subtitle bp-unit-selection-accordion__subtitle">You selected</p>
                                                                    <h3 class="bui-accordion__title" id="selectedRoomsSummary"> 1 room for 2 adults </h3>
                                                                </div>
                                                            </button>
                                                            <div id="unit-selection-content" class="bui-accordion__content bp-unit-selection-accordion__content">
                                                                <ul class="bui-list bui-list--text bp-list--compact" id="selectedRoomsList">
                                                                    <!-- Will be populated dynamically -->
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="bui-group__item">
                                                    <div class="bp-booking-summary__change-selection">
                                                        <div class="bui-group bui-button-group bui-group--inline bui-group--vertical-align-middle">
                                                            <div class="bui-group__item">
                                                                <a class="bui-button bui-button--tertiary" href="#" id="change-selection-btn">
                                                                    <span class="bui-button__text">Change your selection</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Hidden change options -->
                                                    <div id="change-options" style="display: none; margin-top: 20px; border: 1px solid #ddd; padding: 20px; border-radius: 8px; background-color: #f9f9f9;">
                                                        <div class="form-group">
                                                            <label for="change-checkin-date" style="font-weight: 600; color: #333; margin-bottom: 8px;">Check-in Date:</label>
                                                            <div style="position: relative;">
                                                                <input type="date" id="change-checkin-date" name="change-checkin-date" class="form-control" required style="padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                                                                <i class="fa fa-calendar" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #666; pointer-events: none;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 15px;">
                                                            <label for="change-checkout-date" style="font-weight: 600; color: #333; margin-bottom: 8px;">Check-out Date:</label>
                                                            <div style="position: relative;">
                                                                <input type="date" id="change-checkout-date" name="change-checkout-date" class="form-control" required style="padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                                                                <i class="fa fa-calendar" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #666; pointer-events: none;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 15px;">
                                                            <label for="adults-select" style="font-weight: 600; color: #333; margin-bottom: 8px;">Adults:</label>
                                                            <select id="adults-select" name="adults" class="form-control" style="padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                                                                <option value="1">1 Adult</option>
                                                                <option value="2" selected>2 Adults</option>
                                                                <option value="3">3 Adults</option>
                                                                <option value="4">4 Adults</option>
                                                                <option value="5">5 Adults</option>
                                                                <option value="6">6 Adults</option>
                                                                <option value="7">7 Adults</option>
                                                                <option value="8">8 Adults</option>
                                                                <option value="9">9 Adults</option>
                                                                <option value="10">10 Adults</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 15px;">
                                                            <label for="children-select" style="font-weight: 600; color: #333; margin-bottom: 8px;">Children:</label>
                                                            <select id="children-select" name="children" class="form-control" style="padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                                                                <option value="0" selected>0 Children</option>
                                                                <option value="1">1 Child</option>
                                                                <option value="2">2 Children</option>
                                                                <option value="3">3 Children</option>
                                                                <option value="4">4 Children</option>
                                                                <option value="5">5 Children</option>
                                                            </select>
                                                        </div>
                                                        <button id="save-selection" class="btn btn-primary" style="margin-top: 20px; width: 100%; padding: 12px; background-color: #8C349C; border: none; border-radius: 4px; color: white; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#7a2d8a'" onmouseout="this.style.backgroundColor='#8C349C'">SAVE SELECTION</button>
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
            </div>
        </div>
    </div>
</section>

<script>
    // Filter Additional Requests based on room configuration
    function filterAdditionalRequests(availableRequests) {
        const requestMapping = {
            'airportTransfer': 'airportTransfer',
            'extraBed': 'extraBed',
            'higherFloor': 'higherFloor',
            'roomDecorations': 'roomDecorations',
            'kitchenFacility': 'kitchenFacility'
        };
        
        // Hide all by default
        Object.keys(requestMapping).forEach(key => {
            const element = document.getElementById(key);
            if (element) {
                const label = element.closest('.mb-1');
                if (label) {
                    label.style.display = 'none';
                }
            }
        });
        
        // Show only available ones
        if (availableRequests.length === 0) {
            // If no specific requests configured, show all (default behavior)
            Object.keys(requestMapping).forEach(key => {
                const element = document.getElementById(key);
                if (element) {
                    const label = element.closest('.mb-1');
                    if (label) {
                        label.style.display = '';
                    }
                }
            });
        } else {
            availableRequests.forEach(request => {
                const key = requestMapping[request] || request.toLowerCase().replace(/\s+/g, '');
                const element = document.getElementById(key);
                if (element) {
                    const label = element.closest('.mb-1');
                    if (label) {
                        label.style.display = '';
                    }
                }
            });
        }
    }
    
    // Filter Bed Types based on room configuration
    function filterBedTypes(availableBedTypes) {
        const bedTypeMapping = {
            'large_bed': 'largeBed',
            'Large Bed': 'largeBed',
            'twin_beds': 'twinBeds',
            'Twin Beds': 'twinBeds'
        };
        
        // Hide all by default
        ['largeBed', 'twinBeds'].forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                const label = element.closest('.mb-1');
                if (label) {
                    label.style.display = 'none';
                }
            }
        });
        
        // Show only available ones
        if (availableBedTypes.length === 0) {
            // If no specific bed types configured, show all (default behavior)
            ['largeBed', 'twinBeds'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    const label = element.closest('.mb-1');
                    if (label) {
                        label.style.display = '';
                    }
                }
            });
        } else {
            availableBedTypes.forEach(bedType => {
                const key = bedTypeMapping[bedType] || bedType;
                const element = document.getElementById(key);
                if (element) {
                    const label = element.closest('.mb-1');
                    if (label) {
                        label.style.display = '';
                    }
                }
            });
        }
    }
    
    // Filter Room Preferences based on room configuration
    function filterRoomPreferences(availableRoomPreferences) {
        const preferenceMapping = {
            'non_smoking': 'nonSmoking',
            'Non-Smoking': 'nonSmoking',
            'smoking': 'smoking',
            'Smoking': 'smoking'
        };
        
        // Hide all by default
        ['nonSmoking', 'smoking'].forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                const label = element.closest('.mb-1');
                if (label) {
                    label.style.display = 'none';
                }
            }
        });
        
        // Show only available ones
        if (availableRoomPreferences.length === 0) {
            // If no specific preferences configured, show all (default behavior)
            ['nonSmoking', 'smoking'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    const label = element.closest('.mb-1');
                    if (label) {
                        label.style.display = '';
                    }
                }
            });
        } else {
            availableRoomPreferences.forEach(preference => {
                const key = preferenceMapping[preference] || preference;
                const element = document.getElementById(key);
                if (element) {
                    const label = element.closest('.mb-1');
                    if (label) {
                        label.style.display = '';
                    }
                }
            });
        }
    }
    
    // Populate booking from cart
    document.addEventListener('DOMContentLoaded', function() {
        const cart = JSON.parse(localStorage.getItem('bookingCart')) || [];
        
        if (cart.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Cart',
                text: 'No rooms in your cart. Redirecting to homepage...',
                confirmButtonColor: '#91278f'
            }).then(() => {
                window.location.href = '/';
            });
            return;
        }

        renderBookingCards(cart);
        
        // Auto-fill user information if logged in
        @auth('guest')
            const guestName = "{{ auth('guest')->user()->name }}";
            const guestPhone = "{{ auth('guest')->user()->phone ?? '' }}";
            
            if (guestName) {
                document.getElementById('guest-full-name').value = guestName;
            }
            if (guestPhone) {
                document.getElementById('phone-number').value = guestPhone;
            }
        @endauth
        
        // Auto-fill booking parameters from localStorage
        const bookingParams = JSON.parse(localStorage.getItem('bookingParams')) || {};
        
        // Auto-fill dates - use defaults (tomorrow, day after) if not in bookingParams
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        const dayAfter = new Date(tomorrow);
        dayAfter.setDate(dayAfter.getDate() + 1);
        const defaultCheckin = tomorrow.toISOString().split('T')[0];
        const defaultCheckout = dayAfter.toISOString().split('T')[0];
        
        const checkinVal = bookingParams.checkin || defaultCheckin;
        let checkoutVal = bookingParams.checkout;
        if (!checkoutVal) {
            const ci = new Date(checkinVal);
            ci.setDate(ci.getDate() + 1);
            checkoutVal = ci.toISOString().split('T')[0];
        }
        document.getElementById('checkin-date').value = checkinVal;
        document.getElementById('checkout-date').value = checkoutVal;
        if (!bookingParams.checkin || !bookingParams.checkout) {
            bookingParams.checkin = checkinVal;
            bookingParams.checkout = checkoutVal;
            localStorage.setItem('bookingParams', JSON.stringify(bookingParams));
        }
        
        // Set min attributes on date inputs to prevent past dates
        document.getElementById('checkin-date').setAttribute('min', today.toISOString().split('T')[0]);
        const minCheckout = new Date(checkinVal);
        minCheckout.setDate(minCheckout.getDate() + 1);
        document.getElementById('checkout-date').setAttribute('min', minCheckout.toISOString().split('T')[0]);
        
        // Update total nights and render price summary after dates are set
        setTimeout(() => {
            updateTotalNights();
            renderPriceSummary(cart); // Call after dates are set
        }, 100);
        
        // Auto-fill Room Type and Room/Apartment Number from cart
        if (cart.length > 0) {
            // Get unique room names from cart
            const roomNames = cart.map(item => {
                const name = item.roomName || 'Room';
                return item.quantity > 1 ? `${name} (${item.quantity}x)` : name;
            });
            const roomTypeValue = roomNames.join(', ');
            document.getElementById('room-type').value = roomTypeValue;
            
            // Auto-fill Room/Apartment Number from cart (room number and optional floor)
            const roomNumberParts = [];
            cart.forEach(item => {
                const roomNumber = item.roomNumber || item.number || null;
                const floorNumber = item.floorNumber || item.floor_number || null;
                if (roomNumber) {
                    let part = roomNumber;
                    if (floorNumber) {
                        const floorNum = parseInt(floorNumber);
                        let suffix = 'th';
                        if (floorNum == 1) suffix = 'st';
                        else if (floorNum == 2) suffix = 'nd';
                        else if (floorNum == 3) suffix = 'rd';
                        part += ` - ${floorNum}${suffix} Floor`;
                    }
                    const count = item.quantity || 1;
                    for (let i = 0; i < count; i++) {
                        roomNumberParts.push(part);
                    }
                }
            });
            const roomNumberInput = document.getElementById('room-number');
            if (roomNumberInput) {
                roomNumberInput.value = roomNumberParts.length > 0 ? roomNumberParts.join(', ') : '';
            }
            
            // Calculate and update total nights
            updateTotalNights();
            
            // Add event listeners to update cards when dates change
            const checkinInput = document.getElementById('checkin-date');
            const checkoutInput = document.getElementById('checkout-date');
            
            if (checkinInput) {
                checkinInput.addEventListener('change', function() {
                    updateTotalNights();
                    renderBookingCards(cart);
                    renderPriceSummary(cart);
                    // Update bookingParams in localStorage
                    const bookingParams = JSON.parse(localStorage.getItem('bookingParams')) || {};
                    bookingParams.checkin = this.value;
                    localStorage.setItem('bookingParams', JSON.stringify(bookingParams));
                    // Trigger global cart update via custom event (for same-tab updates)
                    window.dispatchEvent(new Event('bookingParamsUpdated'));
                    // Also call directly if function exists
                    if (typeof updateGlobalCartDisplay === 'function') {
                        updateGlobalCartDisplay();
                    }
                });
            }
            if (checkoutInput) {
                checkoutInput.addEventListener('change', function() {
                    updateTotalNights();
                    renderBookingCards(cart);
                    renderPriceSummary(cart);
                    // Update bookingParams in localStorage
                    const bookingParams = JSON.parse(localStorage.getItem('bookingParams')) || {};
                    bookingParams.checkout = this.value;
                    localStorage.setItem('bookingParams', JSON.stringify(bookingParams));
                    // Trigger global cart update via custom event (for same-tab updates)
                    window.dispatchEvent(new Event('bookingParamsUpdated'));
                    // Also call directly if function exists
                    if (typeof updateGlobalCartDisplay === 'function') {
                        updateGlobalCartDisplay();
                    }
                });
            }
            
            // Fetch room data to get available additional requests
            const roomIds = cart.map(item => item.roomId);
            fetch('{{ route("booking.rooms-data") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ room_ids: roomIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.rooms && data.rooms.length > 0) {
                    // Update cart items with hotelId, encrypted_hotel_id, roomNumber, and floorNumber if missing (backward compatibility)
                    data.rooms.forEach(room => {
                        const cartItem = cart.find(item => item.roomId === room.id);
                        if (cartItem) {
                            if (!cartItem.hotelId && room.hotel_id) {
                                cartItem.hotelId = room.hotel_id;
                            }
                            if (!cartItem.encryptedHotelId && room.encrypted_hotel_id) {
                                cartItem.encryptedHotelId = room.encrypted_hotel_id;
                            }
                            // Add room number and floor number if missing
                            if (!cartItem.roomNumber && room.number) {
                                cartItem.roomNumber = room.number;
                            }
                            if (!cartItem.floorNumber && room.floor_number) {
                                cartItem.floorNumber = room.floor_number;
                            }
                            // Add cancellation policy if missing
                            if (!cartItem.cancellationPolicy && room.cancellation_policy) {
                                cartItem.cancellationPolicy = room.cancellation_policy;
                            }
                            // Add hotel photo if missing
                            if (!cartItem.hotelPhoto && room.hotel_photo) {
                                cartItem.hotelPhoto = room.hotel_photo;
                            }
                            // Add hotel name if missing
                            if (!cartItem.hotelName && room.hotel_name) {
                                cartItem.hotelName = room.hotel_name;
                            }
                        }
                    });
                    // Save updated cart
                    localStorage.setItem('bookingCart', JSON.stringify(cart));
                    // Re-render cards and summary with updated hotelId
                    renderBookingCards(cart);
                    renderPriceSummary(cart);
                    
                    // Auto-fill Room/Apartment Number now that room data (number, floor) is in cart
                    const roomNumberParts = [];
                    cart.forEach(item => {
                        const roomNumber = item.roomNumber || item.number || null;
                        const floorNumber = item.floorNumber || item.floor_number || null;
                        if (roomNumber) {
                            let part = roomNumber;
                            if (floorNumber) {
                                const floorNum = parseInt(floorNumber);
                                let suffix = 'th';
                                if (floorNum == 1) suffix = 'st';
                                else if (floorNum == 2) suffix = 'nd';
                                else if (floorNum == 3) suffix = 'rd';
                                part += ` - ${floorNum}${suffix} Floor`;
                            }
                            const count = item.quantity || 1;
                            for (let i = 0; i < count; i++) {
                                roomNumberParts.push(part);
                            }
                        }
                    });
                    const roomNumberInputEl = document.getElementById('room-number');
                    if (roomNumberInputEl) {
                        roomNumberInputEl.value = roomNumberParts.length > 0 ? roomNumberParts.join(', ') : '';
                    }
                    
                    // Collect all available requests from all rooms
                    const allAvailableRequests = new Set();
                    const allAvailableBedTypes = new Set();
                    const allAvailableRoomPreferences = new Set();
                    
                    data.rooms.forEach(room => {
                        if (room.available_requests && Array.isArray(room.available_requests)) {
                            room.available_requests.forEach(req => allAvailableRequests.add(req));
                        }
                        if (room.available_bed_types && Array.isArray(room.available_bed_types)) {
                            room.available_bed_types.forEach(bed => allAvailableBedTypes.add(bed));
                        }
                        if (room.available_room_preferences && Array.isArray(room.available_room_preferences)) {
                            room.available_room_preferences.forEach(pref => allAvailableRoomPreferences.add(pref));
                        }
                    });
                    
                    // Filter additional requests checkboxes
                    filterAdditionalRequests(Array.from(allAvailableRequests));
                    
                    // Filter bed types
                    filterBedTypes(Array.from(allAvailableBedTypes));
                    
                    // Filter room preferences
                    filterRoomPreferences(Array.from(allAvailableRoomPreferences));
                }
            })
            .catch(error => {
                console.error('Error fetching room data:', error);
            });
        }
        
        // Calculate maximum allowed guests based on room capacities
        let maxAllowedGuests = 0;
        cart.forEach(item => {
            const capacity = item.capacity || 2; // Default to 2 if not set
            maxAllowedGuests += capacity * item.quantity;
        });
        
        // Set max values for guest inputs
        document.getElementById('qty').setAttribute('max', maxAllowedGuests);
        document.getElementById('qty2').setAttribute('max', maxAllowedGuests);
        document.getElementById('qty3').setAttribute('max', maxAllowedGuests);
        
        // Store max allowed guests for validation
        window.maxAllowedGuests = maxAllowedGuests;
        
        // Auto-fill guest counts (Total Male = adults, Total Female = 0 initially, Total Kids = children)
        if (bookingParams.adults !== undefined) {
            const adults = Math.min(bookingParams.adults || 1, maxAllowedGuests);
            document.getElementById('qty').value = adults;
            updateTotalPersons();
        }
        if (bookingParams.children !== undefined) {
            const children = Math.min(bookingParams.children || 0, maxAllowedGuests);
            document.getElementById('qty3').value = children;
            updateTotalPersons();
        }
        // Total Female starts at 0, can be adjusted by user
        document.getElementById('qty2').value = 0;
        updateTotalPersons();
        
        // Show max capacity info
        if (maxAllowedGuests > 0) {
            const capacityInfo = document.createElement('div');
            capacityInfo.id = 'capacity-info';
            capacityInfo.style.cssText = 'margin-top: 10px; padding: 10px; background: #f0f7ff; border-left: 3px solid #91278f; border-radius: 4px; font-size: 14px; color: #666;';
            capacityInfo.innerHTML = `<i class="fa fa-info-circle" style="color: #91278f; margin-right: 5px;"></i>Maximum capacity: <strong>${maxAllowedGuests} ${maxAllowedGuests === 1 ? 'person' : 'persons'}</strong> based on selected rooms`;
            document.querySelector('.member-add-cal').appendChild(capacityInfo);
        }
        
        // Add input validation for manual entry
        ['qty', 'qty2', 'qty3'].forEach(inputId => {
            const input = document.getElementById(inputId);
            if (input) {
                input.addEventListener('input', function() {
                    const currentTotal = getCurrentTotalPersons();
                    if (currentTotal > maxAllowedGuests) {
                        updateTotalPersons(); // This will auto-adjust
                    }
                });
                input.addEventListener('change', function() {
                    updateTotalPersons();
                });
            }
        });
    });

    function renderBookingCards(cart) {
        const container = document.getElementById('bookingCardsContainer');
        const primaryContactRoom = document.getElementById('primaryContactRoomName');
        let html = '';
        
        // Get actual dates from form inputs or localStorage
        let checkinDateInput = document.getElementById('checkin-date')?.value;
        let checkoutDateInput = document.getElementById('checkout-date')?.value;
        
        // If not in form, try localStorage
        if (!checkinDateInput || !checkoutDateInput) {
            const bookingParams = JSON.parse(localStorage.getItem('bookingParams')) || {};
            checkinDateInput = checkinDateInput || bookingParams.checkin;
            checkoutDateInput = checkoutDateInput || bookingParams.checkout;
        }
        
        // If still no dates, use default (tomorrow and day after)
        let checkinDate, checkoutDate;
        if (checkinDateInput && checkoutDateInput) {
            checkinDate = new Date(checkinDateInput);
            checkoutDate = new Date(checkoutDateInput);
        } else {
            checkinDate = new Date();
        checkinDate.setDate(checkinDate.getDate() + 1);
            checkoutDate = new Date(checkinDate);
        checkoutDate.setDate(checkoutDate.getDate() + 1);
        }
        
        // Calculate number of nights
        const nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
        
        const checkinFormatted = checkinDate.toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' });
        const checkoutFormatted = checkoutDate.toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' });
        const checkinDay = checkinDate.toLocaleDateString('en-US', { weekday: 'long' });
        const checkoutDay = checkoutDate.toLocaleDateString('en-US', { weekday: 'long' });
        
        // Set first room as primary contact room
        if (cart.length > 0 && primaryContactRoom) {
            primaryContactRoom.textContent = cart[0].roomName;
        }

        // Get encrypted hotel ID from first cart item (all rooms should be from same hotel)
        const encryptedHotelId = cart.length > 0 && cart[0].encryptedHotelId ? cart[0].encryptedHotelId : '';

        cart.forEach((item, index) => {
            const totalPersons = 2; // Default, can be made dynamic
            
            // Get room number and floor number with fallbacks
            const roomNumber = item.roomNumber || item.number || null;
            const floorNumber = item.floorNumber || item.floor_number || null;
            
            // Format floor number with ordinal suffix
            let floorText = '';
            if (floorNumber) {
                const floorNum = parseInt(floorNumber);
                let suffix = 'th';
                if (floorNum == 1) suffix = 'st';
                else if (floorNum == 2) suffix = 'nd';
                else if (floorNum == 3) suffix = 'rd';
                floorText = ` - ${floorNum}${suffix} Floor`;
            }
            
            // Format room number
            const roomNumberText = roomNumber ? ` (Room #${roomNumber})` : '';
            
            html += `
                <div data-v-67ade680="" data-v-1b1a5b0b="" class="hotel-review-card">
                    <div data-v-67ade680="" class="review-header">
                        <div data-v-67ade680="" class="review-header-text">
                            <h4 data-v-67ade680="">Room ${index + 1}: ${item.roomName}${roomNumberText}${floorText}</h4>
                            <div data-v-67ade680="">
                                <p data-v-67ade680=""> ${totalPersons} Guests | ${item.quantity} Room${item.quantity > 1 ? 's' : ''} </p>
                            </div>
                        </div>
                        <div data-v-67ade680="" class="img-placeholder">
                            ${encryptedHotelId ? `<a href="/hotel-details/${encryptedHotelId}" style="display: block; cursor: pointer;">` : ''}
                                <picture data-v-345c6862="" data-v-67ade680="">
                                    ${(() => {
                                        // Use hotel photo from cart item, fallback to default
                                        const hotelPhoto = item.hotelPhoto || null;
                                        const defaultPhoto = '{{ asset("frontend/images/urmee.png") }}';
                                        if (hotelPhoto) {
                                            // Ensure proper path format
                                            const photoPath = hotelPhoto.startsWith('http') || hotelPhoto.startsWith('/') ? hotelPhoto : '/' + hotelPhoto;
                                            return `<img data-v-345c6862="" src="${photoPath}" alt="${item.roomName}" class="image-box" onerror="this.src='${defaultPhoto}'">`;
                                        } else {
                                            return `<img data-v-345c6862="" src="${defaultPhoto}" alt="${item.roomName}" class="image-box">`;
                                        }
                                    })()}
                                </picture>
                            ${encryptedHotelId ? '</a>' : ''}
                        </div>
                    </div>
                    <div data-v-67ade680="" class="review-timeline-details">
                        <div data-v-67ade680="" class="details-text">
                            <p data-v-67ade680=""> Check In 14:00 - 20:00 </p>
                            <h6 data-v-67ade680=""> ${checkinFormatted} </h6>
                            <p data-v-67ade680="">${checkinDay}</p>
                        </div>
                        <div data-v-67ade680="" class="custom-badge" style="color: white !important;"> ${nights} ${nights === 1 ? 'Night' : 'Nights'} </div>
                        <div data-v-67ade680="" class="details-text details-text-sm">
                            <p data-v-67ade680=""> Check Out 11:00 </p>
                            <h6 data-v-67ade680=""> ${checkoutFormatted} </h6>
                            <p data-v-67ade680="">${checkoutDay}</p>
                        </div>
                    </div>
                    <div data-v-67ade680="" class="review-container">
                        <div data-v-67ade680="" class="review-card">
                            <h4 data-v-67ade680="">${item.roomName}${roomNumberText}${floorText}</h4>
                            <div data-v-67ade680="">
                                <p data-v-67ade680="">
                                    <svg data-v-67ade680="" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3251 17.6743H14.5863C15.2245 17.6743 15.7488 17.188 15.8247 16.565L17.0784 4.04389H13.2795V0.966797H11.7827V4.04389H8.00663L8.23457 5.82177C9.53378 6.17886 10.7494 6.82467 11.4788 7.53886C12.5729 8.61775 13.3251 9.73462 13.3251 11.5581V17.6743ZM0.363281 16.9145V16.1623H11.7827V16.9145C11.7827 17.3324 11.4408 17.6743 11.0153 17.6743H1.13066C0.705181 17.6743 0.363281 17.3324 0.363281 16.9145ZM11.7827 11.5961C11.7827 5.51786 0.363281 5.51786 0.363281 11.5961H11.7827ZM0.378477 13.1232H11.7751V14.6428H0.378477V13.1232Z" fill="#5D6974"/>
                                    </svg> Room Only
                                </p>
                                ${(() => {
                                    // Check if Non-refundable is selected in room's cancellation_policy field
                                    // The form uses cancellation_policy[] with value 'non_refundable'
                                    const roomCancellationPolicy = item.cancellationPolicy || [];
                                    const isNonRefundable = Array.isArray(roomCancellationPolicy) && roomCancellationPolicy.includes('non_refundable');
                                    return isNonRefundable ? '<p data-v-67ade680=""> Non-Refundable </p>' : '';
                                })()}
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        container.innerHTML = html;
        
        // Update booking date range display
        updateBookingDateRange(checkinDate, checkoutDate);
    }
    
    function updateTotalNights() {
        const checkinInput = document.getElementById('checkin-date')?.value;
        const checkoutInput = document.getElementById('checkout-date')?.value;
        
        if (checkinInput && checkoutInput) {
            const checkin = new Date(checkinInput);
            const checkout = new Date(checkoutInput);
            const nights = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
            
            const totalNightsEl = document.getElementById('totalNights');
            if (totalNightsEl) {
                totalNightsEl.textContent = `${nights} ${nights === 1 ? 'night' : 'nights'}`;
            }
        }
    }
    
    function updateBookingDateRange(checkinDate, checkoutDate) {
        const dateRangeContainer = document.getElementById('bookingDateRange');
        if (!dateRangeContainer) return;
        
        const checkinFormatted = checkinDate.toLocaleDateString('en-US', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
        const checkoutFormatted = checkoutDate.toLocaleDateString('en-US', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
        
        dateRangeContainer.innerHTML = `
            <div class="bui-date-range__item">
                <div id="bp-checkin-date__label" class="bui-date__label">Check-in</div>
                <time class="bui-date bui-date--large" aria-describedby="bp-checkin-date__label">
                    <span class="bui-date__title">${checkinFormatted}</span>
                    <span class="bui-date__subtitle"> From 14:00 </span>
                </time>
            </div>
            <div class="bui-date-range__item">
                <div id="bp-checkout-date__label" class="bui-date__label">Check-out</div>
                <time class="bui-date bui-date--large" aria-describedby="bp-checkout-date__label">
                    <span class="bui-date__title">${checkoutFormatted}</span>
                    <span class="bui-date__subtitle"> Until 12:00 </span>
                </time>
            </div>
        `;
    }

    function renderPriceSummary(cart) {
        const container = document.getElementById('booking-price-summary');
        const selectedRoomsList = document.getElementById('selectedRoomsList');
        const selectedRoomsSummary = document.getElementById('selectedRoomsSummary');
        
        // Get number of nights from dates
        const checkinInput = document.getElementById('checkin-date')?.value;
        const checkoutInput = document.getElementById('checkout-date')?.value;
        let nights = 1; // Default to 1 night
        
        if (checkinInput && checkoutInput) {
            const checkin = new Date(checkinInput + 'T00:00:00'); // Add time to avoid timezone issues
            const checkout = new Date(checkoutInput + 'T00:00:00');
            nights = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
            if (nights < 1) nights = 1; // Ensure at least 1 night
        }
        
        let total = 0;
        let subTotal = 0;
        let rackRate = 0;
        let discount = 0;
        let taxesAndFees = 0;
        let roomsListHtml = '';
        let fareItemsHtml = '';

        cart.forEach(item => {
            // Calculate: price per night * quantity * number of nights
            const itemTotal = item.price * item.quantity * nights;
            subTotal += itemTotal;
            
            // Get room number and floor number with fallbacks
            const itemRoomNumber = item.roomNumber || item.number || null;
            const itemFloorNumber = item.floorNumber || item.floor_number || null;
            
            // Format floor number with ordinal suffix
            let itemFloorText = '';
            if (itemFloorNumber) {
                const floorNum = parseInt(itemFloorNumber);
                let suffix = 'th';
                if (floorNum == 1) suffix = 'st';
                else if (floorNum == 2) suffix = 'nd';
                else if (floorNum == 3) suffix = 'rd';
                itemFloorText = ` - ${floorNum}${suffix} Floor`;
            }
            
            // Format room number
            const itemRoomNumberText = itemRoomNumber ? ` (Room #${itemRoomNumber})` : '';
            
            // Calculate rack rate (assuming 69% discount as in reference)
            const itemRackRate = itemTotal / 0.31; // If discounted price is 31% of rack rate
            rackRate += itemRackRate;
            
            fareItemsHtml += `
                <div data-v-30094f07="" class="fare-item">
                    <span data-v-30094f07="" class="fare">${item.roomName}${itemRoomNumberText}${itemFloorText} ${item.quantity > 1 ? '(' + item.quantity + 'x)' : ''}</span>
                    <span data-v-30094f07="" class="fare-price">
                        <span data-v-30094f07="" class="sm-text">BDT</span>
                        <span data-v-30094f07="" class="lg-text"> ${itemTotal.toFixed(0)} </span>
                    </span>
                </div>
            `;
            
            roomsListHtml += `
                <li class="bui-list__item">
                    <div class="bui-text bui-text--variant-emphasized_2"> ${item.quantity} x ${item.roomName}${itemRoomNumberText}${itemFloorText} </div>
                </li>
            `;
        });
        
        discount = rackRate - subTotal;
        const discountPercentage = ((discount / rackRate) * 100).toFixed(0);
        taxesAndFees = 0; // No tax – exact calculation only
        // Applied coupon (set by Apply button)
        if (typeof window.appliedCoupon === 'undefined') window.appliedCoupon = { code: '', discount: 0 };
        const couponDiscount = window.appliedCoupon.discount || 0;
        total = subTotal - couponDiscount;
        
        // Update selected rooms summary
        const totalRooms = cart.reduce((sum, item) => sum + item.quantity, 0);
        const adults = parseInt(document.getElementById('qty')?.value) || 1;
        const children = parseInt(document.getElementById('qty3')?.value) || 0;
        let guestText = `${adults} ${adults === 1 ? 'adult' : 'adults'}`;
        if (children > 0) {
            guestText += `, ${children} ${children === 1 ? 'child' : 'children'}`;
        }
        if (selectedRoomsSummary) {
            selectedRoomsSummary.textContent = `${totalRooms} room${totalRooms > 1 ? 's' : ''} for ${guestText}`;
        }
        if (selectedRoomsList) {
            selectedRoomsList.innerHTML = roomsListHtml;
        }

        // Get encrypted hotel ID from first cart item
        const encryptedHotelId = cart.length > 0 && cart[0].encryptedHotelId ? cart[0].encryptedHotelId : '';

        const html = `
            <div data-v-30094f07="" class="fare-modal-header text-center">
                <h4 data-v-30094f07="" class="mb-0 font-weight-bolder"> Price Summary </h4>
                <i data-v-30094f07="" class="fas fa-times fa-lg" style="display:none;"></i>
            </div>
            <div data-v-30094f07="" class="fare-wrapper">
                <div data-v-30094f07="" class="fare-box">
                    <div data-v-30094f07="" class="fare-header">
                        <div data-v-30094f07="" class="wrapper">
                            <div data-v-30094f07="" class="img-placeholder">
                                ${encryptedHotelId ? `<a href="/hotel-details/${encryptedHotelId}" style="display: block; cursor: pointer;">` : ''}
                                    <picture data-v-345c6862="" data-v-30094f07="">
                                        ${(() => {
                                            // Use hotel photo from first cart item, fallback to default
                                            const firstItem = cart.length > 0 ? cart[0] : null;
                                            const hotelPhoto = firstItem && firstItem.hotelPhoto ? firstItem.hotelPhoto : null;
                                            const defaultPhoto = '{{ asset("frontend/images/urmee.png") }}';
                                            if (hotelPhoto) {
                                                // Ensure proper path format
                                                const photoPath = hotelPhoto.startsWith('http') || hotelPhoto.startsWith('/') ? hotelPhoto : '/' + hotelPhoto;
                                                return `<img data-v-345c6862="" src="${photoPath}" alt="Hotel" class="image-box" onerror="this.src='${defaultPhoto}'">`;
                                            } else {
                                                return `<img data-v-345c6862="" src="${defaultPhoto}" alt="Hotel" class="image-box">`;
                                            }
                                        })()}
                                    </picture>
                                ${encryptedHotelId ? '</a>' : ''}
                            </div>
                            <div data-v-30094f07="" class="header-summary">
                                <div data-v-30094f07="" class="fare-type">
                                    <svg data-v-30094f07="" width="37" height="21" viewBox="0 0 32 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path d="M18.198 20.9737V24.515H13.8711V1.81036C13.8711 1.43382 14.0207 1.07271 14.2869 0.806457C14.5532 0.540206 14.9143 0.390625 15.2908 0.390625H26.6438C27.02 0.390625 27.3808 0.54007 27.6468 0.806091C27.9128 1.07211 28.0622 1.43292 28.0622 1.80913V24.5138H22.3858V20.9724L18.198 20.9737Z" fill="#E5F5FD"></path>
                                            <path d="M18.1982 20.9736H22.3848V24.515H18.1982V20.9736Z" fill="#00B8F8"></path>
                                            <path d="M13.8712 7.48535V24.5135H3.93799V8.90508C3.93766 8.52909 4.08663 8.16834 4.35215 7.90212C4.61767 7.63591 4.97802 7.486 5.35402 7.48535H13.8712Z" fill="#43CAF9"></path>
                                        </g>
                                    </svg>
                                    <span data-v-30094f07="">${(() => {
                                        // Get hotel name from first cart item, fallback to "Hotel"
                                        const firstItem = cart.length > 0 ? cart[0] : null;
                                        return firstItem && firstItem.hotelName ? firstItem.hotelName : 'Hotel';
                                    })()}</span>
                                </div>
                                <span data-v-30094f07="" class="name">Hotel Booking</span>
                                <span data-v-30094f07="" class="subtitle"> Booking Summary </span>
                            </div>
                        </div>
                    </div>
                    <div data-v-30094f07="" class="fare-info collapse show">
                        <div data-v-30094f07="" class="fare-info-header"> Fare Summary </div>
                        <div data-v-30094f07="" class="fare-content">
                            <div data-v-30094f07="" class="fare-info-content">
                                <div data-v-30094f07="" class="room-details">
                                    ${cart.map(item => {
                                        const rNum = item.roomNumber || item.number || null;
                                        const fNum = item.floorNumber || item.floor_number || null;
                                        let fText = '';
                                        if (fNum) {
                                            const f = parseInt(fNum);
                                            let s = 'th';
                                            if (f == 1) s = 'st';
                                            else if (f == 2) s = 'nd';
                                            else if (f == 3) s = 'rd';
                                            fText = ` - ${f}${s} Floor`;
                                        }
                                        const rText = rNum ? ` (Room #${rNum})` : '';
                                        return `<p data-v-30094f07=""> ${item.roomName}${rText}${fText} (${item.quantity}x) </p>`;
                                    }).join('')}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-v-30094f07="" class="fare-breakdown">
                        <div data-v-30094f07="" class="fare-content">
                            <div data-v-30094f07="" class="fare-info-content">
                                
                                <div data-v-30094f07="" class="fare-item">
                                    <span data-v-30094f07="" class="fare">Room Rate (${nights} ${nights === 1 ? 'night' : 'nights'})</span>
                                    <span data-v-30094f07="" class="fare-price">
                                        <span data-v-30094f07="" class="sm-text">BDT</span>
                                        <span data-v-30094f07="" class="lg-text"> ${subTotal.toFixed(0)} </span>
                                    </span>
                                </div>
                                ${couponDiscount > 0 ? `
                                <div data-v-30094f07="" class="fare-item">
                                    <span data-v-30094f07="" class="fare">Coupon (${window.appliedCoupon.code})</span>
                                    <span data-v-30094f07="" class="fare-price text-success">
                                        <span data-v-30094f07="" class="sm-text">- BDT</span>
                                        <span data-v-30094f07="" class="lg-text"> ${couponDiscount.toFixed(0)} </span>
                                    </span>
                                </div>
                                ` : ''}
                                <div data-v-30094f07="" class="fare-item mt-3" style="border-top: 1px solid #eee; padding-top: 10px;">
                                    <span data-v-30094f07="" class="fare">Have a coupon?</span>
                                    <span data-v-30094f07="" class="fare-price"></span>
                                </div>
                                <div data-v-30094f07="" class="fare-item" id="coupon-input-wrap" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <input type="text" id="coupon-code-input" class="form-control" placeholder="Enter code" style="max-width: 160px;" value="${window.appliedCoupon.code || ''}" ${couponDiscount > 0 ? 'readonly' : ''}>
                                    ${couponDiscount > 0 ? `
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="coupon-remove-btn">Remove</button>
                                    ` : `
                                    <button type="button" class="btn btn-sm btn-primary" id="coupon-apply-btn">Apply</button>
                                    `}
                                </div>
                                <div id="coupon-message" class="small mt-1" style="min-height: 18px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-v-30094f07="" class="total-price total-payable-price">
                    <div data-v-30094f07="" class="price-wrapper">
                        <div data-v-30094f07="">
                            <span data-v-30094f07="" class="text-blue text-white">Total <i data-v-30094f07="" class="icon icon-info-light"></i></span>
                        </div>
                        <span data-v-30094f07="" class="text-blue text-white">
                            <span data-v-30094f07="" class="sm-text">BDT</span>
                            <span data-v-30094f07="" class="lg-text"> ${total.toFixed(0)} </span>
                        </span>
                    </div>
                </div>
            </div>
        `;

        container.innerHTML = html;

        // Coupon Apply button
        const applyBtn = document.getElementById('coupon-apply-btn');
        const removeBtn = document.getElementById('coupon-remove-btn');
        const couponInput = document.getElementById('coupon-code-input');
        const couponMessage = document.getElementById('coupon-message');

        if (applyBtn && couponInput) {
            applyBtn.addEventListener('click', function() {
                const code = (couponInput.value || '').trim();
                if (!code) {
                    if (couponMessage) couponMessage.innerHTML = '<span class="text-danger">Enter a coupon code.</span>';
                    return;
                }
                const checkinDate = document.getElementById('checkin-date')?.value;
                const checkoutDate = document.getElementById('checkout-date')?.value;
                if (!checkinDate || !checkoutDate) {
                    if (couponMessage) couponMessage.innerHTML = '<span class="text-danger">Select check-in and check-out dates first.</span>';
                    return;
                }
                const hotelId = cart.length > 0 ? (cart[0].hotelId || null) : null;
                const subtotal = subTotal;

                applyBtn.disabled = true;
                if (couponMessage) couponMessage.innerHTML = '<span class="text-muted">Checking...</span>';

                fetch('{{ route('booking.validate-coupon') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        code: code,
                        subtotal: subtotal,
                        hotel_id: hotelId,
                        checkin_date: checkinDate,
                        checkout_date: checkoutDate,
                    }),
                })
                .then(r => r.json())
                .then(data => {
                    applyBtn.disabled = false;
                    if (data.valid) {
                        window.appliedCoupon = { code: data.coupon_code, discount: data.discount };
                        if (couponMessage) couponMessage.innerHTML = '<span class="text-success">' + (data.message || 'Coupon applied.') + '</span>';
                        renderPriceSummary(cart);
                    } else {
                        window.appliedCoupon = { code: '', discount: 0 };
                        if (couponMessage) couponMessage.innerHTML = '<span class="text-danger">' + (data.message || 'Invalid coupon.') + '</span>';
                    }
                })
                .catch(() => {
                    applyBtn.disabled = false;
                    if (couponMessage) couponMessage.innerHTML = '<span class="text-danger">Could not validate coupon. Try again.</span>';
                });
            });
        }

        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                window.appliedCoupon = { code: '', discount: 0 };
                renderPriceSummary(cart);
            });
        }
    }

    function confirmBooking() {
        // Get all form data
        const guestName = document.getElementById('guest-full-name')?.value || '';
        const guestPhone = document.getElementById('phone-number')?.value || '';
        const checkinDate = document.getElementById('checkin-date')?.value || '';
        const checkoutDate = document.getElementById('checkout-date')?.value || '';
        const homeAddress = document.getElementById('home-address')?.value || '';
        const arrivalTime = document.getElementById('checkin_eta_hour')?.value || '';
        
        console.log('Form Data Check:', {
            guestName,
            guestPhone,
            checkinDate,
            checkoutDate,
            homeAddress,
            arrivalTime
        });
        
        // Validate required fields
        if (!guestName || !guestPhone || !checkinDate || !checkoutDate || !homeAddress || !arrivalTime) {
            const missing = [];
            if (!guestName) missing.push('Name');
            if (!guestPhone) missing.push('Phone');
            if (!checkinDate) missing.push('Check-in Date');
            if (!checkoutDate) missing.push('Check-out Date');
            if (!homeAddress) missing.push('Home Address');
            if (!arrivalTime) missing.push('Arrival Time');
            
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete Form',
                html: `Please fill in all required fields:<br><br><strong>${missing.join('<br>')}</strong>`,
                confirmButtonColor: '#91278f'
            });
            return;
        }
        
        // Get cart data
        const cart = JSON.parse(localStorage.getItem('bookingCart')) || [];
        if (cart.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'No Rooms Selected',
                text: 'Please add rooms to your cart before booking.',
                confirmButtonColor: '#91278f'
            });
            return;
        }
        
        // Collect additional requests
        const additionalRequests = [];
        if (document.getElementById('airportTransfer')?.checked) additionalRequests.push('Airport Transfer');
        if (document.getElementById('extraBed')?.checked) additionalRequests.push('Extra Bed');
        if (document.getElementById('higherFloor')?.checked) additionalRequests.push('Room On Higher Floor');
        if (document.getElementById('roomDecorations')?.checked) additionalRequests.push('Decorations in Room');
        if (document.getElementById('kitchenFacility')?.checked) additionalRequests.push('Kitchen Facility');
        
        // Get relationship
        const relationship = document.querySelector('input[name="relationship"]:checked')?.value || 'onlyMe';
        
        // Get bed type and convert to database format
        const bedTypeRaw = document.querySelector('input[name="bed-type"]:checked')?.value;
        const bedType = bedTypeRaw ? bedTypeRaw.toLowerCase().replace(/\s+/g, '_') : '';
        
        // Get room preference and convert to database format
        const roomPreferenceRaw = document.querySelector('input[name="room-smoking-type"]:checked')?.value || 'Non-Smoking';
        const roomPreference = roomPreferenceRaw.toLowerCase().replace('-', '_');
        
        // Collect other guest names
        const otherGuests = [];
        document.querySelectorAll('#guestInputFields input[type="text"]').forEach(input => {
            if (input.value.trim()) {
                otherGuests.push(input.value.trim());
            }
        });
        
        // Prepare form data
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('guest_name', guestName);
        formData.append('guest_phone', guestPhone);
        formData.append('checkin_date', checkinDate);
        formData.append('checkout_date', checkoutDate);
        formData.append('home_address', homeAddress);
        formData.append('organization', document.getElementById('organization')?.value || '');
        formData.append('organization_address', document.getElementById('org-address')?.value || '');
        formData.append('relationship', relationship);
        formData.append('total_male', document.getElementById('qty').value);
        formData.append('total_female', document.getElementById('qty2').value);
        formData.append('total_kids', document.getElementById('qty3').value);
        formData.append('total_persons', document.getElementById('totalPersons').textContent);
        formData.append('other_guests', JSON.stringify(otherGuests));
        formData.append('additional_requests', JSON.stringify(additionalRequests));
        formData.append('bed_type', bedType);
        formData.append('room_preference', roomPreference);
        formData.append('room_type', document.getElementById('room-type')?.value || '');
        formData.append('room_number', document.getElementById('room-number')?.value || '');
        formData.append('arrival_time', arrivalTime);
        formData.append('property_note', document.getElementById('property-note')?.value || '');
        formData.append('citizenship', document.getElementById('citizenship')?.value || '');
        formData.append('rooms_data', JSON.stringify(cart));
        
        // Get coupon code if applied (from global set by Apply button)
        const couponCode = (typeof window.appliedCoupon !== 'undefined' && window.appliedCoupon && window.appliedCoupon.code) ? window.appliedCoupon.code : '';
        if (couponCode) {
            formData.append('coupon_code', couponCode);
        }
        
        // Get guest email if not logged in (for guest users)
        @guest('guest')
            const guestEmail = document.getElementById('guest-email')?.value || '';
            if (guestEmail) {
                formData.append('guest_email', guestEmail);
            }
        @endguest
        
        // Calculate number of nights for validation
        const checkin = new Date(checkinDate);
        const checkout = new Date(checkoutDate);
        const nights = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
        
        // Validate dates
        if (nights < 1) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Dates',
                text: 'Check-out date must be after check-in date.',
                confirmButtonColor: '#91278f'
            });
            return;
        }
        
        // Debug: Log what we're sending
        console.log('Sending booking data:', {
            guest_name: guestName,
            guest_phone: guestPhone,
            checkin_date: checkinDate,
            checkout_date: checkoutDate,
            home_address: homeAddress,
            arrival_time: arrivalTime,
            nights: nights,
            rooms_count: cart.length,
            total_rooms: cart.reduce((sum, item) => sum + item.quantity, 0),
            additional_requests: additionalRequests,
            bed_type: bedType,
            room_preference: roomPreference,
            relationship: relationship
        });
        
        // Append files if any
        const nidFront = document.getElementById('nidFront')?.files[0];
        const nidBack = document.getElementById('nidBack')?.files[0];
        const passport = document.getElementById('passport')?.files[0];
        const visa = document.getElementById('visa')?.files[0];
        
        if (nidFront) formData.append('nid_front', nidFront);
        if (nidBack) formData.append('nid_back', nidBack);
        if (passport) formData.append('passport', passport);
        if (visa) formData.append('visa', visa);
        
        // Show loading
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait while we confirm your booking.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Submit booking
        fetch('{{ route('booking.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                return response.json().then(err => {
                    console.error('Error response:', err);
                    return Promise.reject(err);
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Booking response data:', data);
            Swal.close();
            
            if (data.success) {
                // Do NOT clear cart here – only clear after successful payment (on invoice page).
                // If user cancels payment and clicks "Back to Checkout", cart will still be there.
                
                // Server sends redirect_url to payment gateway (/booking/pay/ID); use it so user goes to ShurjoPay
                const redirectUrl = data.redirect_url || (data.booking_id ? '/booking/invoice/' + data.booking_id : null);
                
                if (!redirectUrl) {
                    console.error('No redirect URL available. Response:', data);
                    Swal.fire({
                        icon: 'error',
                        title: 'Redirect Error',
                        text: 'Booking confirmed but unable to redirect. Please contact support with Booking ID: ' + (data.booking_id || 'N/A'),
                        confirmButtonColor: '#91278f'
                    });
                    return;
                }
                
                console.log('Booking successful. Redirecting to payment:', redirectUrl);
                
                // Redirect immediately to payment gateway (no delay)
                window.location.replace(redirectUrl);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Booking Failed',
                    html: `<p>${data.message || 'Something went wrong. Please try again.'}</p>`,
                    confirmButtonColor: '#91278f'
                });
            }
        })
        .catch(error => {
            Swal.close();
            console.error('Booking Error:', error);
            let errorMessage = 'An error occurred while processing your booking.';
            
            if (error.message) {
                errorMessage = error.message;
            }
            
            if (error.errors) {
                const errorList = Object.values(error.errors).flat();
                errorMessage = '<div style="text-align: left;"><p><strong>Please fix the following errors:</strong></p><ul style="margin-left: 20px;">';
                errorList.forEach(err => {
                    errorMessage += `<li>${err}</li>`;
                });
                errorMessage += '</ul></div>';
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Booking Failed',
                html: errorMessage,
                confirmButtonColor: '#91278f',
                width: '500px'
            });
        })
        .finally(() => {
            // Ensure loading is closed
            Swal.close();
        });
    }

    // Helper functions for the form
    function toggleFlightDetailsMessage() {
        const checkbox = document.getElementById("airportTransfer");
        const message = document.getElementById("flightDetailsMessage");
        message.style.display = checkbox.checked ? "block" : "none";
    }

    function toggleExtraBedMessage() {
        const checkbox = document.getElementById("extraBed");
        const message = document.getElementById("extraBedMessage");
        message.style.display = checkbox.checked ? "block" : "none";
    }

    function toggleDecorationMessage() {
        const checkbox = document.getElementById("roomDecorations");
        const message = document.getElementById("decorationMessage");
        message.style.display = checkbox.checked ? "block" : "none";
    }

    function toggleUploadFields() {
        const citizenship = document.getElementById("citizenship").value;
        const nidUpload = document.getElementById("nid-upload");
        const passportUpload = document.getElementById("passport-upload");

        if (citizenship === "bangladesh") {
            nidUpload.style.display = "block";
            passportUpload.style.display = "none";
        } else if (citizenship === "international") {
            nidUpload.style.display = "none";
            passportUpload.style.display = "block";
        } else {
            nidUpload.style.display = "none";
            passportUpload.style.display = "none";
        }
    }

    // Night buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('qtyminus')) {
            const targetId = e.target.dataset.target;
            const input = document.getElementById(targetId);
            let val = parseInt(input.value);
            if (val > parseInt(input.min)) {
                input.value = val - 1;
                updateTotalPersons();
            }
        }
        if (e.target.classList.contains('qtyplus')) {
            const targetId = e.target.dataset.target;
            const input = document.getElementById(targetId);
            let val = parseInt(input.value);
            const maxVal = parseInt(input.max);
            
            // Check if adding would exceed total capacity
            const currentTotal = getCurrentTotalPersons();
            if (currentTotal >= (window.maxAllowedGuests || 999)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Maximum Capacity Reached',
                    text: `You cannot exceed ${window.maxAllowedGuests || 999} ${(window.maxAllowedGuests || 999) === 1 ? 'person' : 'persons'} based on your selected rooms.`,
                    confirmButtonColor: '#91278f',
                    timer: 3000
                });
                return;
            }
            
            if (val < maxVal) {
                input.value = val + 1;
                updateTotalPersons();
            }
        }
    });
    
    function getCurrentTotalPersons() {
        const male = parseInt(document.getElementById('qty').value) || 0;
        const female = parseInt(document.getElementById('qty2').value) || 0;
        const kids = parseInt(document.getElementById('qty3').value) || 0;
        return male + female + kids;
    }

    function updateTotalPersons() {
        const male = parseInt(document.getElementById('qty').value) || 0;
        const female = parseInt(document.getElementById('qty2').value) || 0;
        const kids = parseInt(document.getElementById('qty3').value) || 0;
        const total = male + female + kids;
        const maxAllowed = window.maxAllowedGuests || 999;
        
        // Validate against max capacity
        if (total > maxAllowed) {
            // Adjust values to not exceed max
            let remaining = maxAllowed;
            if (male > 0) {
                const maleVal = Math.min(male, remaining);
                document.getElementById('qty').value = maleVal;
                remaining -= maleVal;
            }
            if (female > 0 && remaining > 0) {
                const femaleVal = Math.min(female, remaining);
                document.getElementById('qty2').value = femaleVal;
                remaining -= femaleVal;
            }
            if (kids > 0 && remaining > 0) {
                const kidsVal = Math.min(kids, remaining);
                document.getElementById('qty3').value = kidsVal;
                remaining -= kidsVal;
            }
            
            Swal.fire({
                icon: 'warning',
                title: 'Maximum Capacity Reached',
                text: `You cannot exceed ${maxAllowed} ${maxAllowed === 1 ? 'person' : 'persons'} based on your selected rooms.`,
                confirmButtonColor: '#91278f',
                timer: 3000
            });
            
            // Recalculate with adjusted values
            const adjustedTotal = parseInt(document.getElementById('qty').value) + 
                                 parseInt(document.getElementById('qty2').value) + 
                                 parseInt(document.getElementById('qty3').value);
            document.getElementById('totalPersons').textContent = adjustedTotal;
        } else {
        document.getElementById('totalPersons').textContent = total;
        }
        
        // Update capacity info color if approaching limit
        const capacityInfo = document.getElementById('capacity-info');
        if (capacityInfo) {
            if (total >= maxAllowed) {
                capacityInfo.style.background = '#ffe6e6';
                capacityInfo.style.borderLeftColor = '#e74c3c';
                capacityInfo.style.color = '#c0392b';
            } else if (total >= maxAllowed * 0.8) {
                capacityInfo.style.background = '#fff3cd';
                capacityInfo.style.borderLeftColor = '#ffc107';
                capacityInfo.style.color = '#856404';
            } else {
                capacityInfo.style.background = '#f0f7ff';
                capacityInfo.style.borderLeftColor = '#91278f';
                capacityInfo.style.color = '#666';
            }
        }

        // Generate guest input fields
        const container = document.getElementById('guestInputFields');
        container.innerHTML = '';
        
        for (let i = 1; i <= total; i++) {
            const div = document.createElement('div');
            div.className = 'mb-1 col-md-6';
            div.innerHTML = `
                <fieldset class="form-group">
                    <legend class="col-form-label pt-0">Guest Name ${i}</legend>
                    <div>
                        <input type="text" placeholder="Full Name" class="form-control">
                    </div>
                </fieldset>
            `;
            container.appendChild(div);
        }
    }

    // Initialize
    updateTotalPersons();
    
    // Change selection button
    document.addEventListener('DOMContentLoaded', function() {
        const changeSelectionButton = document.getElementById('change-selection-btn');
        const changeOptions = document.getElementById('change-options');
        
        // Initialize change options with current values
        if (changeOptions) {
            const checkinDate = document.getElementById('checkin-date')?.value || '';
            const checkoutDate = document.getElementById('checkout-date')?.value || '';
            const adults = parseInt(document.getElementById('qty')?.value) || 1;
            const children = parseInt(document.getElementById('qty3')?.value) || 0;
            
            const changeCheckinEl = document.getElementById('change-checkin-date');
            const changeCheckoutEl = document.getElementById('change-checkout-date');
            
            if (changeCheckinEl) {
                changeCheckinEl.value = checkinDate;
                // Set minimum date to today
                const today = new Date().toISOString().split('T')[0];
                changeCheckinEl.setAttribute('min', today);
            }
            if (changeCheckoutEl) {
                changeCheckoutEl.value = checkoutDate;
                // Set minimum date based on checkin
                const today = new Date().toISOString().split('T')[0];
                const minDate = checkinDate ? (() => {
                    const checkin = new Date(checkinDate);
                    checkin.setDate(checkin.getDate() + 1);
                    return checkin.toISOString().split('T')[0];
                })() : today;
                changeCheckoutEl.setAttribute('min', minDate);
            }
            
            const adultsSelect = document.getElementById('adults-select');
            const childrenSelect = document.getElementById('children-select');
            if (adultsSelect) adultsSelect.value = adults;
            if (childrenSelect) childrenSelect.value = children;
        }
        
        if (changeSelectionButton && changeOptions) {
            changeSelectionButton.addEventListener('click', function(event) {
                event.preventDefault();
                const isHidden = changeOptions.style.display === 'none' || changeOptions.style.display === '';
                changeOptions.style.display = isHidden ? 'block' : 'none';
                
                if (isHidden) {
                    this.querySelector('.bui-button__text').textContent = 'Hide selection';
                    // Sync change options from main form when opening (in case main form was updated)
                    const mainCheckin = document.getElementById('checkin-date')?.value;
                    const mainCheckout = document.getElementById('checkout-date')?.value;
                    const mainAdults = document.getElementById('qty')?.value;
                    const mainChildren = document.getElementById('qty3')?.value;
                    const ccIn = document.getElementById('change-checkin-date');
                    const ccOut = document.getElementById('change-checkout-date');
                    const aSel = document.getElementById('adults-select');
                    const cSel = document.getElementById('children-select');
                    if (ccIn && mainCheckin) ccIn.value = mainCheckin;
                    if (ccOut && mainCheckout) ccOut.value = mainCheckout;
                    if (aSel && mainAdults) aSel.value = mainAdults;
                    if (cSel && mainChildren) cSel.value = mainChildren;
                } else {
                    this.querySelector('.bui-button__text').textContent = 'Change your selection';
                }
            });
        }
        
        // Sync change options with main form when changed
        const changeCheckin = document.getElementById('change-checkin-date');
        const changeCheckout = document.getElementById('change-checkout-date');
        const changeAdults = document.getElementById('adults-select');
        const changeChildren = document.getElementById('children-select');
        
        // Set minimum date to today for date inputs
        const today = new Date().toISOString().split('T')[0];
        
        if (changeCheckin) {
            changeCheckin.setAttribute('min', today);
            changeCheckin.addEventListener('change', function() {
                // Update main form
                const mainCheckin = document.getElementById('checkin-date');
                if (mainCheckin) {
                    mainCheckin.value = this.value;
                }
                // Update checkout minimum date
                if (changeCheckout) {
                    const checkinDate = new Date(this.value);
                    checkinDate.setDate(checkinDate.getDate() + 1);
                    changeCheckout.setAttribute('min', checkinDate.toISOString().split('T')[0]);
                    // If checkout date is before new checkin, update it
                    if (changeCheckout.value && new Date(changeCheckout.value) <= new Date(this.value)) {
                        changeCheckout.value = checkinDate.toISOString().split('T')[0];
                        const mainCheckout = document.getElementById('checkout-date');
                        if (mainCheckout) {
                            mainCheckout.value = changeCheckout.value;
                        }
                    }
                }
                // Update total nights
                updateTotalNights();
            });
        }
        if (changeCheckout) {
            changeCheckout.setAttribute('min', today);
            changeCheckout.addEventListener('change', function() {
                // Update main form
                const mainCheckout = document.getElementById('checkout-date');
                if (mainCheckout) {
                    mainCheckout.value = this.value;
                }
                // Validate checkout is after checkin
                if (changeCheckin && changeCheckin.value) {
                    const checkinDate = new Date(changeCheckin.value);
                    const checkoutDate = new Date(this.value);
                    if (checkoutDate <= checkinDate) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Date',
                            text: 'Check-out date must be after check-in date.',
                            confirmButtonColor: '#91278f'
                        });
                        const checkinDatePlusOne = new Date(checkinDate);
                        checkinDatePlusOne.setDate(checkinDatePlusOne.getDate() + 1);
                        this.value = checkinDatePlusOne.toISOString().split('T')[0];
                        if (mainCheckout) {
                            mainCheckout.value = this.value;
                        }
                    }
                }
                // Update total nights
                updateTotalNights();
            });
        }
        if (changeAdults) {
            changeAdults.addEventListener('change', function() {
                document.getElementById('qty').value = this.value;
                updateTotalPersons();
            });
        }
        if (changeChildren) {
            changeChildren.addEventListener('change', function() {
                document.getElementById('qty3').value = this.value;
                updateTotalPersons();
            });
        }
        
        // Save Selection button handler
        const saveSelectionBtn = document.getElementById('save-selection');
        if (saveSelectionBtn) {
            saveSelectionBtn.addEventListener('click', function() {
                const checkinDate = document.getElementById('change-checkin-date').value;
                const checkoutDate = document.getElementById('change-checkout-date').value;
                const adults = parseInt(document.getElementById('adults-select').value) || 0;
                const children = parseInt(document.getElementById('children-select').value) || 0;
                
                // Validate dates
                if (!checkinDate || !checkoutDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Dates',
                        text: 'Please select both check-in and check-out dates.',
                        confirmButtonColor: '#91278f'
                    });
                    return;
                }
                
                if (new Date(checkoutDate) <= new Date(checkinDate)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Dates',
                        text: 'Check-out date must be after check-in date.',
                        confirmButtonColor: '#91278f'
                    });
                    return;
                }
                
                // Get room IDs from cart
                const cart = JSON.parse(localStorage.getItem('bookingCart')) || [];
                const roomIds = cart.map(item => item.roomId);
                
                if (roomIds.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'No Rooms',
                        text: 'No rooms found in your cart.',
                        confirmButtonColor: '#91278f'
                    });
                    return;
                }
                
                // Show loading
                Swal.fire({
                    title: 'Validating...',
                    text: 'Please wait while we check room availability',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Validate room availability and capacity
                fetch('{{ route("booking.validate-availability") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        room_ids: roomIds,
                        checkin_date: checkinDate,
                        checkout_date: checkoutDate,
                        adults: adults,
                        children: children
                    })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.close();
                    
                    if (data.available) {
                        // Update main form fields
                        const mainCheckin = document.getElementById('checkin-date');
                        const mainCheckout = document.getElementById('checkout-date');
                        const mainAdults = document.getElementById('qty');
                        const mainChildren = document.getElementById('qty3');
                        
                        if (mainCheckin) mainCheckin.value = checkinDate;
                        if (mainCheckout) mainCheckout.value = checkoutDate;
                        if (mainAdults) mainAdults.value = adults;
                        if (mainChildren) mainChildren.value = children;
                        
                        // Update booking params in localStorage
                        const bookingParams = {
                            checkin: checkinDate,
                            checkout: checkoutDate,
                            adults: adults,
                            children: children
                        };
                        localStorage.setItem('bookingParams', JSON.stringify(bookingParams));
                        
                        // Update cart items with new dates (for price recalculation)
                        const updatedCart = cart.map(item => ({
                            ...item,
                            checkin: checkinDate,
                            checkout: checkoutDate,
                            adults: adults,
                            children: children
                        }));
                        localStorage.setItem('bookingCart', JSON.stringify(updatedCart));
                        
                        // Update total persons
                        if (typeof updateTotalPersons === 'function') {
                            updateTotalPersons();
                        }
                        
                        // Update total nights
                        if (typeof updateTotalNights === 'function') {
                            updateTotalNights();
                        }
                        
                        // Hide the change options section
                        if (changeOptions) {
                            changeOptions.style.display = 'none';
                        }
                        if (changeSelectionButton) {
                            const buttonText = changeSelectionButton.querySelector('.bui-button__text');
                            if (buttonText) {
                                buttonText.textContent = 'Change your selection';
                            }
                        }
                        
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Selection Updated',
                            text: 'Your booking dates and guest count have been updated successfully.',
                            confirmButtonColor: '#91278f',
                            timer: 2000
                        });
                        
                        // Refresh booking summary - use updated cart
                        setTimeout(() => {
                            if (typeof renderBookingCards === 'function') {
                                renderBookingCards(updatedCart);
                            }
                            if (typeof renderPriceSummary === 'function') {
                                renderPriceSummary(updatedCart);
                            }
                            
                            // Update total nights display
                            const checkin = new Date(checkinDate);
                            const checkout = new Date(checkoutDate);
                            const nights = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
                            const totalNightsEl = document.getElementById('totalNights');
                            if (totalNightsEl) {
                                totalNightsEl.textContent = `${nights} ${nights === 1 ? 'night' : 'nights'}`;
                            }
                            
                            // Update booking date range
                            if (typeof updateBookingDateRange === 'function') {
                                updateBookingDateRange(checkin, checkout);
                            }
                            
                            // Trigger global cart update event
                            window.dispatchEvent(new Event('bookingParamsUpdated'));
                            if (typeof updateGlobalCartDisplay === 'function') {
                                updateGlobalCartDisplay();
                            }
                        }, 100);
                    } else {
                        // Show error with details
                        let errorMessage = data.message || 'Rooms are not available for the selected dates or guest count.';
                        
                        if (data.errors && data.errors.length > 0) {
                            errorMessage = data.errors.join('\n');
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Not Available',
                            html: errorMessage.replace(/\n/g, '<br>'),
                            confirmButtonColor: '#91278f'
                        });
                    }
                })
                .catch(error => {
                    Swal.close();
                    console.error('Error validating availability:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating room availability. Please try again.',
                        confirmButtonColor: '#91278f'
                    });
                });
            });
        }
    });
</script>

<style>
    .hotel-review-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: 1px solid #e0e0e0;
    }
    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    .review-header-text h4 {
        color: #1C3C6B;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .review-header-text p {
        color: #666;
        font-size: 14px;
        margin: 0;
    }
    .img-placeholder {
        width: 120px;
        height: 90px;
        overflow: hidden;
        border-radius: 8px;
    }
    .img-placeholder img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .review-timeline-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-top: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
        margin-bottom: 15px;
    }
    .details-text p {
        font-size: 12px;
        color: #666;
        margin: 0 0 5px 0;
    }
    .details-text h6 {
        font-size: 16px;
        font-weight: 600;
        color: #1C3C6B;
        margin: 0 0 5px 0;
    }
    .custom-badge {
        background: #91278f;
        color: white !important;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }
    .review-container {
        padding: 15px 0;
    }
    .review-card h4 {
        font-size: 16px;
        font-weight: 600;
        color: #1C3C6B;
        margin-bottom: 10px;
    }
    .review-card p {
        font-size: 14px;
        color: #666;
        margin: 5px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .fare-and-policy-wrapper {
        position: sticky;
        top: 100px;
    }
    .quantity-btn-group {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: flex-end;
    }
    .quantity-title {
        flex: 1;
        min-width: 150px;
    }
    .quantity-title label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1C3C6B;
    }
    .qty {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
    }
    .qtyminus, .qtyplus {
        width: 35px;
        height: 35px;
        border: 1px solid #91278f;
        background: white;
        border-radius: 50%;
        cursor: pointer;
        color: #91278f;
        font-size: 18px;
        font-weight: bold;
        transition: all 0.3s;
    }
    .qtyminus:hover, .qtyplus:hover {
        background: #91278f;
        color: white;
    }
    .qty input {
        width: 60px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px 5px;
        font-size: 16px;
        font-weight: 600;
    }
    .total-person {
        background: #91278f;
        color: white;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        min-width: 150px;
    }
    .total-person .total-title {
        font-size: 14px;
        margin-bottom: 8px;
    }
    .total-person h2 {
        font-size: 32px;
        font-weight: bold;
        margin: 0;
    }
    .relation-flex {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .arrival-list {
        margin-bottom: 20px;
    }
    .bui-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .bui-list__item {
        display: flex;
        gap: 12px;
        padding: 12px 0;
    }
    .bui-list__icon svg {
        width: 24px;
        height: 24px;
    }
    .bui-list__description {
        font-size: 14px;
        color: #333;
    }
    .bui-card {
        background: white;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        margin-top: 20px;
    }
    .bui-card__header {
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
    }
    .bui-card__title {
        font-size: 18px;
        font-weight: 600;
        color: #1C3C6B;
        margin: 0;
    }
    .bui-card__content {
        padding: 20px;
    }
    .bui-date-range {
        display: flex;
        gap: 20px;
        padding: 15px;
        background: #f5f5f5;
        border-radius: 8px;
    }
    .bui-date-range__item {
        flex: 1;
    }
    .bui-date__label {
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
    }
    .bui-date__title {
        display: block;
        font-size: 16px;
        font-weight: 600;
        color: #1C3C6B;
        margin-bottom: 3px;
    }
    .bui-date__subtitle {
        display: block;
        font-size: 14px;
        color: #666;
    }
    .bui-divider {
        border: 0;
        border-top: 1px solid #e0e0e0;
        margin: 20px 0;
    }
    .bui-group--large {
        margin-bottom: 20px;
    }
    .bui-group__item {
        margin-bottom: 15px;
    }
    .bui-accordion__row-inner {
        width: 100%;
        background: #f5f5f5;
        border: none;
        padding: 15px;
        border-radius: 8px;
        cursor: default;
        text-align: left;
    }
    .bui-accordion__subtitle {
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
    }
    .bui-accordion__title {
        font-size: 16px;
        font-weight: 600;
        color: #1C3C6B;
        margin: 0;
    }
    .bui-accordion__content {
        padding: 15px;
    }
    .bp-list--compact {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .bui-button--tertiary {
        background: transparent;
        border: 1px solid #91278f;
        color: #91278f;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }
    .bui-button--tertiary:hover {
        background: #91278f;
        color: white;
    }
    #change-options {
        animation: slideDown 0.3s ease-out;
    }
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .coupon-input-container {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-top: 10px;
    }
    .coupon-input {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .apply-btn {
        background: #91278f;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }
    .apply-btn:hover {
        background: #6b1f6e;
    }
    .coupon-text {
        color: #91278f;
        cursor: pointer;
        text-decoration: underline;
    }
    .coupon-text:hover {
        color: #6b1f6e;
    }
    
    /* File Preview Styles */
    .file-preview-container {
        margin-top: 15px;
    }
    .file-preview-wrapper {
        position: relative;
        display: inline-block;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px;
        background: #f9f9f9;
        max-width: 300px;
    }
    .file-preview-image {
        max-width: 100%;
        max-height: 200px;
        display: block;
        border-radius: 4px;
        object-fit: contain;
    }
    .file-remove-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #dc3545;
        color: white;
        border: 2px solid white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }
    .file-remove-btn:hover {
        background: #c82333;
        transform: scale(1.1);
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.3);
    }
    .file-remove-btn:active {
        transform: scale(0.95);
    }
    .file-remove-btn i {
        font-size: 12px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .file-preview-wrapper {
            max-width: 100%;
        }
        .file-preview-image {
            max-height: 150px;
        }
    }
</style>

<script>
    // Handle file preview when file is selected
    function handleFilePreview(input, previewContainerId) {
        const file = input.files[0];
        const previewContainer = document.getElementById(previewContainerId);
        const previewImg = document.getElementById(previewContainerId + 'Img');
        
        if (file) {
            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Please select an image file.');
                input.value = '';
                return;
            }
            
            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB.');
                input.value = '';
                return;
            }
            
            // Create preview using FileReader
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    }
    
    // Remove file preview and clear input
    function removeFilePreview(inputId, previewContainerId) {
        const input = document.getElementById(inputId);
        const previewContainer = document.getElementById(previewContainerId);
        const previewImg = document.getElementById(previewContainerId + 'Img');
        
        // Clear the file input
        input.value = '';
        
        // Hide preview
        previewContainer.style.display = 'none';
        previewImg.src = '';
    }
</script>

@endsection

