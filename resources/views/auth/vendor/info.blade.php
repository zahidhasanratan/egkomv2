@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Manage Vendor</h3>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem3">Hotel /
                                            Property Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Facilities of Hotel /
                                            Property</a>
                                    </li>
                                </ul>

                                <form method="POST" action="{{ route('vendor.info.store') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content">
                                        <!-- Property Info -->
                                        <div class="tab-pane active" id="tabItem3">
                                            <div class="row gy-4">
                                                <div class="col-md-12 col-lg-12 col-xxl-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="property-name">Property
                                                            Name</label>
                                                        <input type="text" class="form-control" id="property-name"
                                                               name="property_name" placeholder="ex: Prime 365"
                                                               value="{{ old('property_name', $property->property_name ?? '') }}">
                                                    </div>
                                                </div>

                                                <!-- Property Category -->
                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="mb-3">
                                                        <label for="division" class="form-label">Select Property
                                                            Category</label>
                                                        <select class="form-select" id="division"
                                                                name="property_category">
                                                            <option value=""
                                                                    disabled {{ !$property || !$property->property_category ? 'selected' : '' }}>
                                                                Choose Property Category
                                                            </option>
                                                            <option
                                                                value="Hotels" {{ old('property_category', $property->property_category ?? '') === 'Hotels' ? 'selected' : '' }}>
                                                                Hotels
                                                            </option>
                                                            <option
                                                                value="Transit" {{ old('property_category', $property->property_category ?? '') === 'Transit' ? 'selected' : '' }}>
                                                                Transit Hotels
                                                            </option>
                                                            <option
                                                                value="Resorts" {{ old('property_category', $property->property_category ?? '') === 'Resorts' ? 'selected' : '' }}>
                                                                Resorts, Eco, & Outdoor
                                                            </option>
                                                            <option
                                                                value="Lodges" {{ old('property_category', $property->property_category ?? '') === 'Lodges' ? 'selected' : '' }}>
                                                                Hostels & Lodges
                                                            </option>
                                                            <option
                                                                value="Apartments" {{ old('property_category', $property->property_category ?? '') === 'Apartments' ? 'selected' : '' }}>
                                                                Apartments & Homestays
                                                            </option>
                                                            <option
                                                                value="Guesthouses" {{ old('property_category', $property->property_category ?? '') === 'Guesthouses' ? 'selected' : '' }}>
                                                                Vacation Rentals & Guesthouses
                                                            </option>
                                                            <option
                                                                value="Crisis" {{ old('property_category', $property->property_category ?? '') === 'Crisis' ? 'selected' : '' }}>
                                                                Crisis & Shelter Accommodation
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3" id="districtContainer"
                                                     style="display: none;">
                                                    <div class="mb-3">
                                                        <label for="district" class="form-label">Select Property
                                                            Type</label>
                                                        <select class="form-select" id="district" name="property_type">
                                                            <option value="" disabled selected>Choose Property Type
                                                            </option>
                                                            <!-- Populate dynamically if needed -->
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3" id="placeCheckboxList"
                                                     style="display: none;">
                                                    <div class="form-group">
                                                        <label class="form-label">Choose Room/Accommodation Type</label>
                                                        <ul id="placeOptions" class="list-unstyled"
                                                            style="max-height: 200px; overflow-y: auto;">
                                                            <!-- Dynamic Checkboxes Will Appear Here -->
                                                        </ul>
                                                        @error('room_types')
                                                        <span class="invalid-feedback"
                                                              role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="country-name">Country
                                                            Name</label>
                                                        <select class="form-select mb-3" id="country-name"
                                                                name="country_name">
                                                            <option
                                                                value="Bangladesh" {{ old('country_name', $property->country_name ?? 'Bangladesh') === 'Bangladesh' ? 'selected' : '' }}>
                                                                Bangladesh
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="district-name">District
                                                            Name</label>
                                                        <select class="form-select mb-3" id="district-name"
                                                                name="district_name">
                                                            <option
                                                                value="" {{ !$property || !$property->district_name ? 'selected' : '' }}>
                                                                Select District Name
                                                            </option>
                                                            @foreach(['Bagerhat', 'Bandarban', 'Barguna', 'Barisal', 'Bhola', 'Bogra', 'Brahmanbaria', 'Chandpur', 'Chittagong', 'Chuadanga', 'Comilla', "Cox'sBazar", 'Dhaka', 'Dinajpur', 'Faridpur', 'Feni', 'Gaibandha', 'Gazipur', 'Gopalganj', 'Habiganj', 'Jaipurhat', 'Jamalpur', 'Jessore', 'Jhalokati', 'Jhenaidah', 'Khagrachari', 'Khulna', 'Kishoreganj', 'Kurigram', 'Kushtia', 'Lakshmipur', 'Lalmonirhat', 'Madaripur', 'Magura', 'Manikganj', 'Maulvibazar', 'Meherpur', 'Munshiganj', 'Mymensingh', 'Naogaon', 'Narail', 'Narayanganj', 'Narsingdi', 'Natore', 'Nawabganj', 'Netrokona', 'Nilphamari', 'Noakhali', 'Pabna', 'Panchagarh', 'Patuakhali', 'Pirojpur', 'Rajbari', 'Rajshahi', 'Rangamati', 'Rangpur', 'Satkhira', 'Shariatpur', 'Sherpur', 'Sirajganj', 'Sunamganj', 'Sylhet', 'Tangail', 'Thakurgaon'] as $district)
                                                                <option
                                                                    value="{{ $district }}" {{ old('district_name', $property->district_name ?? '') === $district ? 'selected' : '' }}>{{ $district }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="city-town-village">City/Town/Village</label>
                                                        <input type="text" class="form-control" id="city-town-village"
                                                               name="city_town_village" placeholder="City/Town/Village"
                                                               value="{{ old('city_town_village', $property->city_town_village ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="postcode">Postcode</label>
                                                        <input type="text" class="form-control" id="postcode"
                                                               name="postcode" placeholder="Postcode"
                                                               value="{{ old('postcode', $property->postcode ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="house-number">House
                                                            Number</label>
                                                        <input type="text" class="form-control" id="house-number"
                                                               name="house_number" placeholder="House Number"
                                                               value="{{ old('house_number', $property->house_number ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="road-number-name">Road
                                                            Number/Name (If any)</label>
                                                        <input type="text" class="form-control" id="road-number-name"
                                                               name="road_number_name"
                                                               placeholder="Road Number/Name (If any)"
                                                               value="{{ old('road_number_name', $property->road_number_name ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="building-age">Building
                                                            Age/Founding Year</label>
                                                        <input type="number" class="form-control" id="building-age"
                                                               name="building_age" placeholder="ex: 2010"
                                                               value="{{ old('building_age', $property->building_age ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="building-size">Building
                                                            Size</label>
                                                        <input type="number" class="form-control" id="building-size"
                                                               name="building_size" placeholder="ex: 50,000 SQFT"
                                                               value="{{ old('building_size', $property->building_size ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="building-stories">Building
                                                            Storied</label>
                                                        <input type="number" class="form-control" id="building-stories"
                                                               name="building_stories" placeholder="ex: 10 Story"
                                                               value="{{ old('building_stories', $property->building_stories ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="landmark-details">Land Mark
                                                            Details</label>
                                                        <textarea class="form-control no-resize" id="landmark-details"
                                                                  name="landmark_details"
                                                                  placeholder="Land Mark Details">{{ old('landmark_details', $property->landmark_details ?? '') }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="google-map-link">Google Map
                                                            Link</label>
                                                        <input type="text" class="form-control" id="google-map-link"
                                                               name="google_map_link" placeholder="Google Map Location"
                                                               value="{{ old('google_map_link', $property->google_map_link ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Logo Of Company</label>
                                                        <div class="multiple-upload-container" id="upload-container-1">
                                                            <input type="file" class="multiple-file-input"
                                                                   accept="image/*" name="company_logo">
                                                            <label class="upload-label">Select Logo</label>
                                                            <div class="multiple-thumbnail-gallery">
                                                                @if($property && $property->company_logo)
                                                                    <img src="{{ asset($property->company_logo) }}"
                                                                         alt="Company Logo"
                                                                         style="max-width: 100px; max-height: 100px;">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <button type="submit" class="btn btn-primary btn-submit"
                                                            name="action" value="save_draft">Save & Drafts
                                                    </button>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="document.querySelector('.nav-link[href=\'#tabItem4\']').click();">
                                                        Next
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Facilities of Hotel / Property -->
                                        <div class="tab-pane" id="tabItem4">
                                            <div class="row gy-4">
                                                <div class="col-md-4 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label for="apartment-count">Select Number of
                                                            Apartments/Rooms</label>
                                                        <select class="form-select" id="apartment-count"
                                                                name="apartment_count">
                                                            <option
                                                                value="0" {{ old('apartment_count', $property->apartment_count ?? 0) == 0 ? 'selected' : '' }}>
                                                                Select Number of Apartments/Rooms
                                                            </option>
                                                            @for ($i = 1; $i <= 19; $i++)
                                                                <option
                                                                    value="{{ $i }}" {{ old('apartment_count', $property->apartment_count ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="dynamic-forms" class="dynamic-forms col-12">
                                                    @if($property && $property->apartments)
                                                        @foreach($property->apartments as $index => $apartment)
                                                            <div class="apartment-form">
                                                                <label for="apartments-{{ $index }}-name">Apartment/Rooms {{ $index + 1 }}
                                                                    Name:</label>
                                                                <input type="text" id="apartments-{{ $index }}-name"
                                                                       name="apartments[{{ $index }}][name]"
                                                                       class="form-control"
                                                                       value="{{ old("apartments.$index.name", $apartment['name'] ?? '') }}">

                                                                <label
                                                                    for="apartments-{{ $index }}-number">Apartment {{ $index + 1 }}
                                                                    Number:</label>
                                                                <input type="text" id="apartments-{{ $index }}-number"
                                                                       name="apartments[{{ $index }}][number]"
                                                                       class="form-control"
                                                                       value="{{ old("apartments.$index.number", $apartment['number'] ?? '') }}">

                                                                <label
                                                                    for="apartments-{{ $index }}-floor">Apartment {{ $index + 1 }}
                                                                    Floor Number:</label>
                                                                <input type="text" id="apartments-{{ $index }}-floor"
                                                                       name="apartments[{{ $index }}][floor]"
                                                                       class="form-control"
                                                                       value="{{ old("apartments.$index.floor", $apartment['floor'] ?? '') }}">
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="total-capacity">Total Capacity Of
                                                            the Hotel/Property</label>
                                                        <input type="text" class="form-control" id="total-capacity"
                                                               name="total_capacity" placeholder="Capacity"
                                                               value="{{ old('total_capacity', $property->total_capacity ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="total-car-parking">Total Car
                                                            Parking’s</label>
                                                        <input type="text" class="form-control" id="total-car-parking"
                                                               name="total_car_parking"
                                                               placeholder="Total Car Parking’s"
                                                               value="{{ old('total_car_parking', $property->car_parking ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Reception (If any)</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="reception" value="yes"
                                                                       class="bar-radio-yes"
                                                                       data-target="Reception-input" {{ old('reception', $property->has_reception ?? false) ? 'checked' : '' }}>
                                                                Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="reception" value="no"
                                                                       class="bar-radio-no"
                                                                       data-target="Reception-input" {{ old('reception', $property->has_reception ?? true) ? '' : 'checked' }}>
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="total-lifts">Total Number of
                                                            Lifts / Elevators</label>
                                                        <select class="form-select mb-3" id="total-lifts"
                                                                name="total_lifts">
                                                            <option
                                                                value="" {{ !$property || !$property->elevators ? 'selected' : '' }}>
                                                                Select Number of Lifts / Elevators
                                                            </option>
                                                            @for ($i = 1; $i <= 20; $i++)
                                                                <option
                                                                    value="{{ $i }}" {{ old('total_lifts', $property->elevators ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="total-generators">Total Number of
                                                            Generators</label>
                                                        <select class="form-select mb-3" id="total-generators"
                                                                name="total_generators">
                                                            <option
                                                                value="" {{ !$property || !$property->generators ? 'selected' : '' }}>
                                                                Select Number of Generators
                                                            </option>
                                                            @for ($i = 1; $i <= 20; $i++)
                                                                <option
                                                                    value="{{ $i }}" {{ old('total_generators', $property->generators ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="total-fire-exits">Total Fire
                                                            Exits</label>
                                                        <select class="form-select mb-3" id="total-fire-exits"
                                                                name="total_fire_exits">
                                                            <option
                                                                value="" {{ !$property || !$property->fire_exits ? 'selected' : '' }}>
                                                                Select Total Fire Exits
                                                            </option>
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option
                                                                    value="{{ $i }}" {{ old('total_fire_exits', $property->fire_exits ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Wheel Chair Access Gate (If
                                                            Any)</label>
                                                        <div class="radio-group" data-kids-zone="2">
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="wheelchair_access"
                                                                           value="yes"
                                                                           class="radio-yes" {{ old('wheelchair_access', $property->wheelchair_access ?? false) ? 'checked' : '' }}>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="wheelchair_access"
                                                                           value="no"
                                                                           class="radio-no" {{ old('wheelchair_access', $property->wheelchair_access ?? true) ? '' : 'checked' }}>
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8">
                                                    <label class="form-label">Total House Keeping & Cleaners</label>
                                                    <div class="counter-wrapper">
                                                        <div class="counter-card">
                                                            <div>
                                                                <h4>Total Male</h4>
                                                                <div class="counter">
                                                                    <button type="button" class="btn decrease-male">-
                                                                    </button>
                                                                    <span
                                                                        class="count male-count">{{ old('male_housekeeping', $property->male_housekeeping ?? 0) }}</span>
                                                                    <input type="hidden" name="male_housekeeping"
                                                                           value="{{ old('male_housekeeping', $property->male_housekeeping ?? 0) }}"
                                                                           class="male-input">
                                                                    <button type="button" class="btn increase-male">+
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="counter-card">
                                                            <div>
                                                                <h4>Total Female</h4>
                                                                <div class="counter">
                                                                    <button type="button" class="btn decrease-female">
                                                                        -
                                                                    </button>
                                                                    <span
                                                                        class="count female-count">{{ old('female_housekeeping', $property->female_housekeeping ?? 0) }}</span>
                                                                    <input type="hidden" name="female_housekeeping"
                                                                           value="{{ old('female_housekeeping', $property->female_housekeeping ?? 0) }}"
                                                                           class="female-input">
                                                                    <button type="button" class="btn increase-female">
                                                                        +
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="total-box">
                                                            Total House Keeping & Cleaners <br>
                                                            <span
                                                                class="total-count">{{ (old('male_housekeeping', $property->male_housekeeping ?? 0)) + (old('female_housekeeping', $property->female_housekeeping ?? 0)) }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Kids Zone</label>
                                                        <div class="radio-group" data-kids-zone="1">
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="kids_zone" value="yes"
                                                                           class="radio-yes" {{ old('kids_zone', $property->has_kids_zone ?? false) ? 'checked' : '' }}>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="kids_zone" value="no"
                                                                           class="radio-no" {{ old('kids_zone', $property->has_kids_zone ?? true) ? '' : 'checked' }}>
                                                                    No
                                                                </label>
                                                            </div>
                                                            <div class="select-container"
                                                                 style="display: {{ $property && $property->has_kids_zone ? 'block' : 'none' }};">
                                                                <label>Select number of kids:</label>
                                                                <select class="form-select number-select"
                                                                        name="kids_zone_count">
                                                                    <option
                                                                        value="" {{ !$property || !$property->kids_zone_count ? 'selected' : '' }}>
                                                                        Select number
                                                                    </option>
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <option
                                                                            value="{{ $i }}" {{ old('kids_zone_count', $property->kids_zone_count ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="view-from-hotel">View from Hotel
                                                            / Property</label>
                                                        <input type="text" class="form-control" id="view-from-hotel"
                                                               name="view_from_hotel"
                                                               placeholder="City View, Beach View, Hill View, etc."
                                                               value="{{ old('view_from_hotel', $property->view_type ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="security-guards">Number of
                                                            Security Guards</label>
                                                        <select class="form-select mb-3" id="security-guards"
                                                                name="security_guards">
                                                            <option
                                                                value="" {{ !$property || !$property->security_guards ? 'selected' : '' }}>
                                                                Select Number of Security Guards
                                                            </option>
                                                            @for ($i = 1; $i <= 20; $i++)
                                                                <option
                                                                    value="{{ $i }}" {{ old('security_guards', $property->security_guards ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div id="customDynamicForm2024">
                                                        <div class="mb-4">
                                                            <label class="form-label">Cafe & Restaurants (If
                                                                any)</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                       name="cafe_restaurants" id="customRadioYes2024"
                                                                       value="yes" {{ old('cafe_restaurants', $property->has_cafe_restaurant ?? false) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="customRadioYes2024">Yes</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                       name="cafe_restaurants" id="customRadioNo2024"
                                                                       value="no" {{ old('cafe_restaurants', $property->has_cafe_restaurant ?? true) ? '' : 'checked' }}>
                                                                <label class="form-check-label" for="customRadioNo2024">No</label>
                                                            </div>
                                                        </div>
                                                        <div id="customSelectContainer2024"
                                                             class="mb-4 {{ $property && $property->has_cafe_restaurant ? '' : 'custom-form-hidden' }}">
                                                            <label for="customOptionSelect2024" class="form-label">Select
                                                                Total Number of Cafe & Restaurants</label>
                                                            <select class="form-select" id="customOptionSelect2024"
                                                                    name="cafe_restaurants_count">
                                                                <option
                                                                    value="" {{ !$property || !$property->cafe_restaurant_count ? 'selected' : '' }}>
                                                                    Select a value
                                                                </option>
                                                                @for ($i = 1; $i <= 10; $i++)
                                                                    <option
                                                                        value="{{ $i }}" {{ old('cafe_restaurants_count', $property->cafe_restaurant_count ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div id="customInputContainer2024" class="custom-form-hidden">
                                                            <!-- Dynamic Input Fields Will Be Generated Here -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Pool (If any)</label>
                                                        <div class="radio-group" data-kids-zone="2">
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="pool" value="yes"
                                                                           class="radio-yes" {{ old('pool', $property->has_pool ?? false) ? 'checked' : '' }}>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="pool" value="no"
                                                                           class="radio-no" {{ old('pool', $property->has_pool ?? true) ? '' : 'checked' }}>
                                                                    No
                                                                </label>
                                                            </div>
                                                            <div class="select-container"
                                                                 style="display: {{ $property && $property->has_pool ? 'block' : 'none' }};">
                                                                <label>Select Pool Number</label>
                                                                <select class="form-select number-select"
                                                                        name="pool_count">
                                                                    <option
                                                                        value="" {{ !$property || !$property->pool_count ? 'selected' : '' }}>
                                                                        Select number
                                                                    </option>
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <option
                                                                            value="{{ $i }}" {{ old('pool_count', $property->pool_count ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Bar (If any)</label>
                                                        <div class="radio-group" data-kids-zone="2">
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="bar" value="yes"
                                                                           class="radio-yes" {{ old('bar', $property->has_bar ?? false) ? 'checked' : '' }}>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="bar" value="no"
                                                                           class="radio-no" {{ old('bar', $property->has_bar ?? true) ? '' : 'checked' }}>
                                                                    No
                                                                </label>
                                                            </div>
                                                            <div class="select-container"
                                                                 style="display: {{ $property && $property->has_bar ? 'block' : 'none' }};">
                                                                <label>Select Total Number of Bar</label>
                                                                <select class="form-select number-select"
                                                                        name="bar_count">
                                                                    <option
                                                                        value="" {{ !$property || !$property->bar_count ? 'selected' : '' }}>
                                                                        Select number
                                                                    </option>
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <option
                                                                            value="{{ $i }}" {{ old('bar_count', $property->bar_count ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Gym (If any)</label>
                                                        <div class="radio-group" data-kids-zone="2">
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="gym" value="yes"
                                                                           class="radio-yes" {{ old('gym', $property->has_gym ?? false) ? 'checked' : '' }}>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="gym" value="no"
                                                                           class="radio-no" {{ old('gym', $property->has_gym ?? true) ? '' : 'checked' }}>
                                                                    No
                                                                </label>
                                                            </div>
                                                            <div class="select-container"
                                                                 style="display: {{ $property && $property->has_gym ? 'block' : 'none' }};">
                                                                <label>Select Total Number of Gym</label>
                                                                <select class="form-select number-select"
                                                                        name="gym_count">
                                                                    <option
                                                                        value="" {{ !$property || !$property->gym_count ? 'selected' : '' }}>
                                                                        Select number
                                                                    </option>
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <option
                                                                            value="{{ $i }}" {{ old('gym_count', $property->gym_count ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Party Center (If any)</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="party_center" value="yes"
                                                                       class="bar-radio-yes"
                                                                       data-target="Party-input" {{ old('party_center', $property->has_party_center ?? false) ? 'checked' : '' }}>
                                                                Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="party_center" value="no"
                                                                       class="bar-radio-no"
                                                                       data-target="Party-input" {{ old('party_center', $property->has_party_center ?? true) ? '' : 'checked' }}>
                                                                No
                                                            </label>
                                                        </div>
                                                        <div
                                                            class="input-group {{ $property && $property->has_party_center ? '' : 'hidden' }}"
                                                            id="Party-input">
                                                            <textarea class="form-control" name="party_center_details"
                                                                      placeholder="Ex: 1500 SFT"
                                                                      style="height: 50px;">{{ old('party_center_details', $property->party_center_details ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Conference Hall (If any)</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="conference_hall" value="yes"
                                                                       class="bar-radio-yes"
                                                                       data-target="Conference-input" {{ old('conference_hall', $property->has_conference_hall ?? false) ? 'checked' : '' }}>
                                                                Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="conference_hall" value="no"
                                                                       class="bar-radio-no"
                                                                       data-target="Conference-input" {{ old('conference_hall', $property->has_conference_hall ?? true) ? '' : 'checked' }}>
                                                                No
                                                            </label>
                                                        </div>
                                                        <div
                                                            class="input-group {{ $property && $property->has_conference_hall ? '' : 'hidden' }}"
                                                            id="Conference-input">
                                                            <textarea class="form-control"
                                                                      name="conference_hall_details"
                                                                      placeholder="Ex: 1500 SFT"
                                                                      style="height: 50px;">{{ old('conference_hall_details', $property->conference_hall_details ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <button type="submit" class="btn btn-primary btn-submit"
                                                            name="action" value="save_draft">Save & Drafts
                                                    </button>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <button type="submit" class="btn btn-primary" name="action"
                                                            value="submit">Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        document.getElementById('propertyCategory').addEventListener('change', function () {
            var propertyTypeContainer = document.getElementById('propertyTypeContainer');
            var propertyType = document.getElementById('propertyType');
            propertyType.innerHTML = ''; // Clear previous options

            var options = {
                'Hotel': [
                    {id: 'option1', value: 'Only Apartment', label: 'Only Apartment'},
                    {id: 'option2', value: 'Only room', label: 'Only room'},
                    {id: 'option3', value: 'Only Bed', label: 'Only Bed'}
                ],
                'House': [
                    {id: 'option4', value: 'Kitchen', label: 'Kitchen'}
                ],
                'Resort': [
                    {id: 'option6', value: 'Room', label: 'Room'}
                ],
                'Apartment': [
                    {id: 'option7', value: 'Apartment', label: 'Apartment'},
                    {id: 'option8', value: 'Only room', label: 'Only room'},
                    {id: 'option9', value: 'Only Bed', label: 'Only Bed'}
                ]
            };

            var selectedValue = this.value;
            if (options[selectedValue]) {
                options[selectedValue].forEach(function (option) {
                    var li = document.createElement('li');
                    li.innerHTML = `
                      <div class="form-check">
                          <input
                              class="form-check-input"
                              type="checkbox"
                              id="${option.id}"
                              value="${option.value}">
                          <label class="form-check-label" for="${option.id}">
                              ${option.label}
                          </label>
                      </div>
                  `;
                    propertyType.appendChild(li);
                });
                propertyTypeContainer.style.display = 'block';
            } else {
                propertyTypeContainer.style.display = 'none';
            }
        });


    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const apartmentCountSelect = document.getElementById('apartment-count');
            const dynamicFormsContainer = document.getElementById('dynamic-forms');
            const existingApartments = {{ json_encode($property->apartments ?? []) }};

            // Pre-fill if data exists
            if (existingApartments.length > 0) {
                apartmentCountSelect.value = existingApartments.length;
                dynamicFormsContainer.innerHTML = '';
                existingApartments.forEach((apartment, i) => {
                    const formGroup = document.createElement('div');
                    formGroup.classList.add('apartment-form');

                    const apartmentNumberLabel = document.createElement('label');
                    apartmentNumberLabel.textContent = `Apartment ${i + 1} Number:`;
                    apartmentNumberLabel.setAttribute('for', `apartments-${i}-number`);
                    const apartmentNumberInput = document.createElement('input');
                    apartmentNumberInput.type = 'text';
                    apartmentNumberInput.id = `apartments-${i}-number`;
                    apartmentNumberInput.name = `apartments[${i}][number]`;
                    apartmentNumberInput.classList.add('form-control');
                    apartmentNumberInput.value = apartment.number || '';

                    const apartmentFloorLabel = document.createElement('label');
                    apartmentFloorLabel.textContent = `Apartment ${i + 1} Floor Number:`;
                    apartmentFloorLabel.setAttribute('for', `apartments-${i}-floor`);
                    const apartmentFloorInput = document.createElement('input');
                    apartmentFloorInput.type = 'text';
                    apartmentFloorInput.id = `apartments-${i}-floor`;
                    apartmentFloorInput.name = `apartments[${i}][floor]`;
                    apartmentFloorInput.classList.add('form-control');
                    apartmentFloorInput.value = apartment.floor || '';

                    const apartmentNameLabel = document.createElement('label');
                    apartmentNameLabel.textContent = `Apartment/Rooms ${i + 1} Name:`;
                    apartmentNameLabel.setAttribute('for', `apartments-${i}-name`);
                    const apartmentNameInput = document.createElement('input');
                    apartmentNameInput.type = 'text';
                    apartmentNameInput.id = `apartments-${i}-name`;
                    apartmentNameInput.name = `apartments[${i}][name]`;
                    apartmentNameInput.classList.add('form-control');
                    apartmentNameInput.value = apartment.name || '';

                    formGroup.appendChild(apartmentNameLabel);
                    formGroup.appendChild(apartmentNameInput);
                    formGroup.appendChild(apartmentNumberLabel);
                    formGroup.appendChild(apartmentNumberInput);
                    formGroup.appendChild(apartmentFloorLabel);
                    formGroup.appendChild(apartmentFloorInput);

                    dynamicFormsContainer.appendChild(formGroup);
                });
            }

            // Handle change event
            apartmentCountSelect.addEventListener('change', function () {
                const count = parseInt(this.value);
                dynamicFormsContainer.innerHTML = '';

                if (count > 0) {
                    for (let i = 0; i < count; i++) {
                        const formGroup = document.createElement('div');
                        formGroup.classList.add('apartment-form');

                        const apartmentNumberLabel = document.createElement('label');
                        apartmentNumberLabel.textContent = `Apartment ${i + 1} Number:`;
                        apartmentNumberLabel.setAttribute('for', `apartments-${i}-number`);
                        const apartmentNumberInput = document.createElement('input');
                        apartmentNumberInput.type = 'text';
                        apartmentNumberInput.id = `apartments-${i}-number`;
                        apartmentNumberInput.name = `apartments[${i}][number]`;
                        apartmentNumberInput.classList.add('form-control');
                        apartmentNumberInput.value = existingApartments[i]?.number || '';

                        const apartmentFloorLabel = document.createElement('label');
                        apartmentFloorLabel.textContent = `Apartment ${i + 1} Floor Number:`;
                        apartmentFloorLabel.setAttribute('for', `apartments-${i}-floor`);
                        const apartmentFloorInput = document.createElement('input');
                        apartmentFloorInput.type = 'text';
                        apartmentFloorInput.id = `apartments-${i}-floor`;
                        apartmentFloorInput.name = `apartments[${i}][floor]`;
                        apartmentFloorInput.classList.add('form-control');
                        apartmentFloorInput.value = existingApartments[i]?.floor || '';

                        const apartmentNameLabel = document.createElement('label');
                        apartmentNameLabel.textContent = `Apartment/Rooms ${i + 1} Name:`;
                        apartmentNameLabel.setAttribute('for', `apartments-${i}-name`);
                        const apartmentNameInput = document.createElement('input');
                        apartmentNameInput.type = 'text';
                        apartmentNameInput.id = `apartments-${i}-name`;
                        apartmentNameInput.name = `apartments[${i}][name]`;
                        apartmentNameInput.classList.add('form-control');
                        apartmentNameInput.value = existingApartments[i]?.name || '';

                        formGroup.appendChild(apartmentNameLabel);
                        formGroup.appendChild(apartmentNameInput);
                        formGroup.appendChild(apartmentNumberLabel);
                        formGroup.appendChild(apartmentNumberInput);
                        formGroup.appendChild(apartmentFloorLabel);
                        formGroup.appendChild(apartmentFloorInput);

                        dynamicFormsContainer.appendChild(formGroup);
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">
        // JavaScript to handle "Check All" functionality
        document.getElementById("site-off").addEventListener("change", function () {
            // Get all checkboxes with the class "checkbox-item"
            let checkboxes = document.querySelectorAll(".checkbox-item");
            // Set checked status based on "Check All" checkbox
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById("site-off").checked;
            });
        });
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            const checkbox = document.getElementById("property-ownership");
            const options = document.getElementById("ownership-options");

            checkbox.addEventListener("change", () => {
                if (checkbox.checked) {
                    options.classList.remove("hidden");
                } else {
                    options.classList.add("hidden");
                }
            });
        });

    </script>
    <script>
        function showLabel(text) {
            const labelDiv = document.getElementById('labelText');
            labelDiv.textContent = text;
            labelDiv.style.display = 'block';
        }

        function hideLabel() {
            const labelDiv = document.getElementById('labelText');
            labelDiv.style.display = 'none';
        }
    </script>

    <script>
        document.getElementById('apartment-count').addEventListener('change', function () {
            const count = parseInt(this.value);
            const dynamicFormsContainer = document.getElementById('dynamic-forms');

            // Clear previous forms
            dynamicFormsContainer.innerHTML = '';

            if (count > 0) {
                for (let i = 0; i < count; i++) { // Changed to 0-based index for consistency
                    const formGroup = document.createElement('div');
                    formGroup.classList.add('apartment-form');

                    // Apartment Number Field
                    const apartmentNumberLabel = document.createElement('label');
                    apartmentNumberLabel.textContent = `Apartment ${i + 1} Number:`;
                    apartmentNumberLabel.setAttribute('for', `apartments-${i}-number`);
                    const apartmentNumberInput = document.createElement('input');
                    apartmentNumberInput.type = 'text';
                    apartmentNumberInput.id = `apartments-${i}-number`;
                    apartmentNumberInput.name = `apartments[${i}][number]`; // Array structure
                    apartmentNumberInput.classList.add('form-control');

                    // Apartment Floor Number Field
                    const apartmentFloorLabel = document.createElement('label');
                    apartmentFloorLabel.textContent = `Apartment ${i + 1} Floor Number:`;
                    apartmentFloorLabel.setAttribute('for', `apartments-${i}-floor`);
                    const apartmentFloorInput = document.createElement('input');
                    apartmentFloorInput.type = 'text';
                    apartmentFloorInput.id = `apartments-${i}-floor`;
                    apartmentFloorInput.name = `apartments[${i}][floor]`; // Array structure
                    apartmentFloorInput.classList.add('form-control');

                    // Apartment/Rooms Name Field
                    const apartmentNameLabel = document.createElement('label');
                    apartmentNameLabel.textContent = `Apartment/Rooms ${i + 1} Name:`;
                    apartmentNameLabel.setAttribute('for', `apartments-${i}-name`);
                    const apartmentNameInput = document.createElement('input');
                    apartmentNameInput.type = 'text';
                    apartmentNameInput.id = `apartments-${i}-name`;
                    apartmentNameInput.name = `apartments[${i}][name]`; // Array structure
                    apartmentNameInput.classList.add('form-control');

                    formGroup.appendChild(apartmentNameLabel);
                    formGroup.appendChild(apartmentNameInput);
                    formGroup.appendChild(apartmentNumberLabel);
                    formGroup.appendChild(apartmentNumberInput);
                    formGroup.appendChild(apartmentFloorLabel);
                    formGroup.appendChild(apartmentFloorInput);

                    dynamicFormsContainer.appendChild(formGroup);
                }
            }
        });
    </script>

    <script>
        // Get all radio buttons
        const radioButtons = document.querySelectorAll('input[name="showFields"]');
        const additionalFields = document.getElementById('additionalFields');

        // Add event listener to each radio button
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'yes') {
                    additionalFields.style.display = 'block';
                } else {
                    additionalFields.style.display = 'none';
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Initialize Select2
            $('.js-select2').select2();

            // Handle property ownership change
            $('#propertyOwnershipss').on('change', function () {
                const selectedValue = $(this).val();
                const partnerFields = $('.partner-fields');
                const leaseDates = $('.lease-dates');

                // Hide all conditional fields first
                partnerFields.slideUp();
                leaseDates.slideUp();

                // Show relevant fields based on selection
                if (selectedValue === 'Partnership') {
                    partnerFields.slideDown();
                } else if (selectedValue === 'Leased') {
                    leaseDates.slideDown();
                }
            });
        });
    </script>
    <script>
        class KidsZoneManager {
            constructor() {
                this.initializeAllKidsZones();
            }

            initializeAllKidsZones() {
                // Find all kids zone sections
                const kidsZoneSections = document.querySelectorAll('[data-kids-zone]');

                kidsZoneSections.forEach(section => {
                    this.initializeSingleKidsZone(section);
                });
            }

            initializeSingleKidsZone(section) {
                const radioButtons = section.querySelectorAll('input[type="radio"]');
                const selectContainer = section.querySelector('.select-container');
                const numberSelect = section.querySelector('.number-select');

                radioButtons.forEach(radio => {
                    radio.addEventListener('change', () => {
                        if (radio.value === 'yes') {
                            selectContainer.style.display = 'block';
                        } else {
                            selectContainer.style.display = 'none';
                            numberSelect.value = ''; // Reset select when hiding
                        }
                    });
                });
            }

            // Method to get all selections
            getAllSelections() {
                const selections = {};
                const sections = document.querySelectorAll('[data-kids-zone]');

                sections.forEach(section => {
                    const id = section.getAttribute('data-kids-zone');
                    const selectedRadio = section.querySelector('input[type="radio"]:checked');
                    const numberSelect = section.querySelector('.number-select');

                    selections[`kidsZone${id}`] = {
                        hasKidsZone: selectedRadio ? selectedRadio.value : null,
                        numberOfKids: selectedRadio?.value === 'yes' ? numberSelect.value : null
                    };
                });

                return selections;
            }

            // Method to add a new kids zone section dynamically
            addNewKidsZone(containerId, zoneNumber) {
                const container = document.getElementById(containerId);
                const newSection = `
                    <div class="col-md-6 col-lg-4 col-xxl-3">
                        <div class="form-group">
                            <label class="form-label">Kids Zone ${zoneNumber}</label>
                            <div class="radio-group" data-kids-zone="${zoneNumber}">
                                <div>
                                    <label>
                                        <input type="radio" name="kidsZone${zoneNumber}" value="yes" class="radio-yes"> Yes
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="radio" name="kidsZone${zoneNumber}" value="no" class="radio-no"> No
                                    </label>
                                </div>
                                <div class="select-container" style="display: none;">
                                    <label>Select number of kids:</label>
                                    <select class="form-select number-select">
                                        <option value="">Select number</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                container.insertAdjacentHTML('beforeend', newSection);
                this.initializeSingleKidsZone(container.lastElementChild.querySelector('[data-kids-zone]'));
            }
        }

        // Initialize the manager
        const kidsZoneManager = new KidsZoneManager();

        // Example usage:
        // To add a new kids zone section:
        // kidsZoneManager.addNewKidsZone('container-id', 3);

        // To get all selections:
        // const selections = kidsZoneManager.getAllSelections();
        // console.log(selections);
    </script>


    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            const divisionSelect = document.getElementById("division");
            const districtSelect = document.getElementById("district");
            const districtContainer = document.getElementById("districtContainer");
            const placeCheckboxList = document.getElementById("placeCheckboxList");
            const placeOptions = document.getElementById("placeOptions");

            const data = {
                Hotels: {
                    districts: {
                        "hotel": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],

                        "Luxury Hotels": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],

                        "Resort Hotels ": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],

                        "Budget Hotels ": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],

                        "Hotels 3 Star ": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],

                        "Hotels 4 Star": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],
                        "Hotels 5 Star ": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"]
                    }
                },


                Transit: {
                    districts: {
                        "Airport Hotels ": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],

                        "Station Hotels ": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],


                        "Bus Stop Hotels": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],


                        "Jetty Hotels ": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],

                        "Hospital & Visa Center Area hotels": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],
                    }
                },

                Resorts: {
                    districts: {
                        "Resorts ": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],


                        "Eco Resorts ": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],

                        "Eco Hotels ": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],


                        "Farm Stays": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],


                        "Campsites ": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],

                        "Glamping ": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],


                        "Treehouses ": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],

                        "Adventure Resorts  ": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],


                        "Wellness Retreats  ": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],

                        "Beach Resorts ": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],


                        "Mountain Resorts": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],


                        "Safari Lodges": ["Luxury Resort Suites",
                            "Oceanfront Villas",
                            "Private Pool Villas",
                            "Garden View Rooms",
                            "Eco Resorts & Hotels",
                            "Bamboo Cottages",
                            "Solar-Powered Cabins",
                            "Off-Grid Stays",
                            "Farm Stays",
                            "Rustic Farmhouses",
                            "Luxury Farm Villas",
                            "Campsites",
                            "Standard Camping Tent",
                            "Luxury Tent (Glamping)",
                            "RV/Caravan Parking",
                            "Glamping",
                            "Safari-Style Tents",
                            "Dome Pods",
                            "Airstream Trailers",
                            "Treehouses",
                            "Basic Tree Cabins",
                            "Luxury Tree Villas",
                            "Adventure Resorts",
                            "Zipline Resorts",
                            "Rock Climbing Camps",
                            "Water Sports Resorts",
                            "Wellness Retreats",
                            "Ayurveda Resorts",
                            "Yoga Retreats",
                            "Meditation Centers",
                            "Beach Resorts",
                            "Overwater Bungalows",
                            "Beach Huts",
                            "Mountain Resorts",
                            "Safari Lodges",
                            "Wildlife Observation Rooms",
                            "Riverside Safari Cottages"],

                    }
                },

                Lodges: {
                    districts: {
                        "Hostels ": ["Single Bed in Dormitory/Room/Apartment ", "Oceanfront Villas", "Private Room/Apartment", "Female-Only Dormitory/Apartment/Room", "Male-Only Dormitory/Apartment/Room", "Mixed Dormitory: Shared Room (All Genders) ", "Studio Apartment-Style Hostel"],

                        "Motels ": ["Single Bed in Dormitory/Room/Apartment ", "Oceanfront Villas", "Private Room/Apartment", "Female-Only Dormitory/Apartment/Room", "Male-Only Dormitory/Apartment/Room", "Mixed Dormitory: Shared Room (All Genders) ", "Studio Apartment-Style Hostel"],

                        "Lodges ": ["Single Bed in Dormitory/Room/Apartment ", "Oceanfront Villas", "Private Room/Apartment", "Female-Only Dormitory/Apartment/Room", "Male-Only Dormitory/Apartment/Room", "Mixed Dormitory: Shared Room (All Genders) ", "Studio Apartment-Style Hostel"],

                        "Mountain Lodges ": ["Single Bed in Dormitory/Room/Apartment ", "Oceanfront Villas", "Private Room/Apartment", "Female-Only Dormitory/Apartment/Room", "Male-Only Dormitory/Apartment/Room", "Mixed Dormitory: Shared Room (All Genders) ", "Studio Apartment-Style Hostel"],

                        "Fishing Lodges ": ["Single Bed in Dormitory/Room/Apartment ", "Oceanfront Villas", "Private Room/Apartment", "Female-Only Dormitory/Apartment/Room", "Male-Only Dormitory/Apartment/Room", "Mixed Dormitory: Shared Room (All Genders) ", "Studio Apartment-Style Hostel"],

                        "Hunting Lodges ": ["Single Bed in Dormitory/Room/Apartment ", "Oceanfront Villas", "Private Room/Apartment", "Female-Only Dormitory/Apartment/Room", "Male-Only Dormitory/Apartment/Room", "Mixed Dormitory: Shared Room (All Genders) ", "Studio Apartment-Style Hostel"],

                    }
                },


                Apartments: {
                    districts: {
                        "Apartments": [
                            "Luxury Serviced Apartments",
                            "Budget Serviced Apartments",
                            "Furnished Apartments",
                            "Unfurnished Apartments",
                            "Studio Apartments",
                            "One-Bedroom Apartments",
                            "Two-Bedroom Apartments",
                            "Three-Bedroom Apartments",
                            "Penthouse Apartments",
                            "Shared Apartments"
                        ],
                        "Serviced Apartments": [
                            "Luxury Serviced Apartments",
                            "Budget Serviced Apartments",
                            "Furnished Apartments",
                            "Unfurnished Apartments",
                            "Studio Apartments",
                            "One-Bedroom Apartments",
                            "Two-Bedroom Apartments",
                            "Three-Bedroom Apartments",
                            "Penthouse Apartments",
                            "Shared Apartments"
                        ],


                        "Homestays": [
                            "Luxury Serviced Apartments",
                            "Budget Serviced Apartments",
                            "Furnished Apartments",
                            "Unfurnished Apartments",
                            "Studio Apartments",
                            "One-Bedroom Apartments",
                            "Two-Bedroom Apartments",
                            "Three-Bedroom Apartments",
                            "Penthouse Apartments",
                            "Shared Apartments"
                        ],

                    }
                },


                Guesthouses: {
                    districts: {
                        "Vacation Rentals": [
                            "Bed Only",
                            "Room with Shared Bathroom",
                            "Entire Place",
                            "Private Room",
                            "Entire House",
                            "Farmhouse Room",
                            "Tent/Glamping Tent",
                            "RV/Caravan: Mobile Accommodations"
                        ],


                        "Condominiums": [
                            "Bed Only",
                            "Room with Shared Bathroom",
                            "Entire Place",
                            "Private Room",
                            "Entire House",
                            "Farmhouse Room",
                            "Tent/Glamping Tent",
                            "RV/Caravan: Mobile Accommodations"
                        ],


                        "Bed and Breakfasts (B&Bs)": [
                            "Bed Only",
                            "Room with Shared Bathroom",
                            "Entire Place",
                            "Private Room",
                            "Entire House",
                            "Farmhouse Room",
                            "Tent/Glamping Tent",
                            "RV/Caravan: Mobile Accommodations"
                        ],

                        "Guesthouses": [
                            "Bed Only",
                            "Room with Shared Bathroom",
                            "Entire Place",
                            "Private Room",
                            "Entire House",
                            "Farmhouse Room",
                            "Tent/Glamping Tent",
                            "RV/Caravan: Mobile Accommodations"
                        ],

                    }
                },


                Crisis: {
                    districts: {
                        "Old Age Homes": [
                            "Old Age Homes",
                            "Orphanages",
                            "Rehabilitation Centers",
                            "Asylums"
                        ],

                        "Orphanages": [
                            "Old Age Homes",
                            "Orphanages",
                            "Rehabilitation Centers",
                            "Asylums"
                        ],

                        "Rehabilitation Centers": [
                            "Old Age Homes",
                            "Orphanages",
                            "Rehabilitation Centers",
                            "Asylums"
                        ],

                        "Asylums": [
                            "Old Age Homes",
                            "Orphanages",
                            "Rehabilitation Centers",
                            "Asylums"
                        ],
                    }
                },


            };


            // Populate districts based on selected division
            divisionSelect.addEventListener("change", function () {
                const division = this.value;
                districtSelect.innerHTML = '<option value="" disabled selected>Choose Property Type</option>';
                placeOptions.innerHTML = "";
                placeCheckboxList.style.display = "none";

                if (data[division]) {
                    districtContainer.style.display = "block";
                    Object.keys(data[division].districts).forEach(district => {
                        const option = document.createElement("option");
                        option.value = district;
                        option.textContent = district.charAt(0).toUpperCase() + district.slice(1);
                        districtSelect.appendChild(option);
                    });
                } else {
                    districtContainer.style.display = "none";
                }
            });

            // Display checkboxes based on selected district
            districtSelect.addEventListener("change", function () {
                const division = divisionSelect.value;
                const district = this.value;
                placeOptions.innerHTML = "";

                if (data[division] && data[division].districts[district]) {
                    placeCheckboxList.style.display = "block";
                    data[division].districts[district].forEach((place, index) => {
                        const listItem = document.createElement("li");
                        listItem.innerHTML = `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="room_type_${index}" name="room_types[]" value="${place}">
                        <label class="form-check-label" for="room_type_${index}">${place}</label>
                    </div>
                `;
                        placeOptions.appendChild(listItem);
                    });
                } else {
                    placeCheckboxList.style.display = "none";
                }
            });
        });
    </script>

    <script>
        const maleCountEl = document.querySelector(".male-count");
        const femaleCountEl = document.querySelector(".female-count");
        const totalCountEl = document.querySelector(".total-count");
        const maleInput = document.querySelector(".male-input"); // Add this if using hidden input
        const femaleInput = document.querySelector(".female-input"); // Add this if using hidden input

        let maleCount = 0;
        let femaleCount = 0;

        function updateTotalCount() {
            totalCountEl.textContent = maleCount + femaleCount;
            if (maleInput) maleInput.value = maleCount; // Update hidden input
            if (femaleInput) femaleInput.value = femaleCount; // Update hidden input
        }

        document.querySelector(".increase-male").addEventListener("click", () => {
            maleCount++;
            maleCountEl.textContent = maleCount;
            updateTotalCount();
        });

        document.querySelector(".decrease-male").addEventListener("click", () => {
            if (maleCount > 0) {
                maleCount--;
                maleCountEl.textContent = maleCount;
                updateTotalCount();
            }
        });

        document.querySelector(".increase-female").addEventListener("click", () => {
            femaleCount++;
            femaleCountEl.textContent = femaleCount;
            updateTotalCount();
        });

        document.querySelector(".decrease-female").addEventListener("click", () => {
            if (femaleCount > 0) {
                femaleCount--;
                femaleCountEl.textContent = femaleCount;
                updateTotalCount();
            }
        });
    </script>



    <script>
        // Get DOM elements with new IDs
        const customRadioButtons2024 = document.querySelectorAll('input[name="customRadioOption2024"]');
        const customSelectContainer2024 = document.getElementById('customSelectContainer2024');
        const customOptionSelect2024 = document.getElementById('customOptionSelect2024');
        const customInputContainer2024 = document.getElementById('customInputContainer2024');

        // Add event listeners
        customRadioButtons2024.forEach(radio => {
            radio.addEventListener('change', handleCustomRadioChange2024);
        });

        customOptionSelect2024.addEventListener('change', handleCustomSelectChange2024);

        // Handle radio button change
        function handleCustomRadioChange2024(e) {
            if (e.target.value === 'yes') {
                customSelectContainer2024.classList.remove('custom-form-hidden');
            } else {
                customSelectContainer2024.classList.add('custom-form-hidden');
                customInputContainer2024.classList.add('custom-form-hidden');
                customOptionSelect2024.value = '';
                clearInputFields();
            }
        }

        // Handle select change
        function handleCustomSelectChange2024(e) {
            const selectedValue = parseInt(e.target.value);
            if (selectedValue > 0) {
                generateInputFields(selectedValue);
                customInputContainer2024.classList.remove('custom-form-hidden');
            } else {
                customInputContainer2024.classList.add('custom-form-hidden');
                clearInputFields();
            }
        }

        // Function to generate input fields
        function generateInputFields(count) {
            clearInputFields();

            for (let i = 1; i <= count; i++) {
                const inputGroup = document.createElement('div');
                inputGroup.className = 'mb-3';

                const label = document.createElement('label');
                label.className = 'form-label';
                label.htmlFor = `customInput${i}_2024`;
                label.textContent = ` Cafe & restaurants Name ${i}`;

                const input = document.createElement('input');
                input.type = 'text';
                input.className = 'form-control';
                input.id = `customInput${i}_2024`;
                input.name = `customInput${i}_2024`;
                input.placeholder = `Enter Cafe & restaurants Name ${i}`;

                inputGroup.appendChild(label);
                inputGroup.appendChild(input);
                customInputContainer2024.appendChild(inputGroup);
            }
        }

        // Function to clear input fields
        function clearInputFields() {
            customInputContainer2024.innerHTML = '';
        }
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            // Find all radio groups with a target input
            document.querySelectorAll(".radio-group input[type='radio']").forEach(function (radio) {
                radio.addEventListener("change", function () {
                    // Get the target input element using the data attribute
                    const targetId = this.getAttribute("data-target");
                    const targetInput = document.getElementById(targetId);

                    // Check if the target exists and show/hide it based on the value
                    if (targetInput) {
                        if (this.value === "yes") {
                            targetInput.classList.remove("hidden");
                        } else {
                            targetInput.classList.add("hidden");
                        }
                    }
                });
            });
        });

    </script>

@endsection
