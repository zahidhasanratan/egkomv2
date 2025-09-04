@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Vendor</h3>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('super-admin.vendor.update', $vendor->vendor_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @php
                                // Helpers for existing values
                                $oldOr = function($key, $default = null) use ($vendor) {
                                    return old($key, $vendor->$key ?? $default);
                                };

                                // Cafe names may be stored as array/json/string — normalize to array
                                $existingCafeNames = old('cafe_names', (function($raw){
                                    if (is_array($raw)) return $raw;
                                    if (is_string($raw) && Str::startsWith(trim($raw), '[')) {
                                        return json_decode($raw, true) ?: [];
                                    }
                                    return is_string($raw) && strlen($raw) ? [$raw] : [];
                                })($vendor->cafe_names ?? []));
                            @endphp

                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row gy-4">

                                        <!-- Property Name -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="property-name">Property Name</label>
                                                <input type="text" class="form-control" id="property-name" name="property_name"
                                                       placeholder="ex: Prime 365"
                                                       value="{{ $oldOr('property_name') }}">
                                            </div>
                                        </div>

                                        <!-- Country -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="country-name">Country Name</label>
                                                <select class="form-select mb-3" id="country-name" name="country_name">
                                                    <option value="Bangladesh"
                                                        {{ $oldOr('country_name','Bangladesh') === 'Bangladesh' ? 'selected' : '' }}>
                                                        Bangladesh
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- District -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="district-name">District Name</label>
                                                <select class="form-select mb-3" id="district-name" name="district_name">
                                                    <option value="">Select District Name</option>
                                                    @foreach(['Bagerhat', 'Bandarban', 'Barguna', 'Barisal', 'Bhola', 'Bogra', 'Brahmanbaria', 'Chandpur', 'Chittagong', 'Chuadanga', 'Comilla', "Cox'sBazar", 'Dhaka', 'Dinajpur', 'Faridpur', 'Feni', 'Gaibandha', 'Gazipur', 'Gopalganj', 'Habiganj', 'Jaipurhat', 'Jamalpur', 'Jessore', 'Jhalokati', 'Jhenaidah', 'Khagrachari', 'Khulna', 'Kishoreganj', 'Kurigram', 'Kushtia', 'Lakshmipur', 'Lalmonirhat', 'Madaripur', 'Magura', 'Manikganj', 'Maulvibazar', 'Meherpur', 'Munshiganj', 'Mymensingh', 'Naogaon', 'Narail', 'Narayanganj', 'Narsingdi', 'Natore', 'Nawabganj', 'Netrokona', 'Nilphamari', 'Noakhali', 'Pabna', 'Panchagarh', 'Patuakhali', 'Pirojpur', 'Rajbari', 'Rajshahi', 'Rangamati', 'Rangpur', 'Satkhira', 'Shariatpur', 'Sherpur', 'Sirajganj', 'Sunamganj', 'Sylhet', 'Tangail', 'Thakurgaon'] as $district)
                                                        <option value="{{ $district }}" {{ $oldOr('district_name') === $district ? 'selected' : '' }}>{{ $district }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- City/Town/Village -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="city-town-village">City/Town/Village</label>
                                                <input type="text" class="form-control" id="city-town-village" name="city_town_village"
                                                       placeholder="City/Town/Village"
                                                       value="{{ $oldOr('city_town_village') }}">
                                            </div>
                                        </div>

                                        <!-- Postcode -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="postcode">Postcode</label>
                                                <input type="text" class="form-control" id="postcode" name="postcode"
                                                       placeholder="Postcode"
                                                       value="{{ $oldOr('postcode') }}">
                                            </div>
                                        </div>

                                        <!-- House Number -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="house-number">House Number</label>
                                                <input type="text" class="form-control" id="house-number" name="house_number"
                                                       placeholder="House Number"
                                                       value="{{ $oldOr('house_number') }}">
                                            </div>
                                        </div>

                                        <!-- Road Number/Name -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="road-number-name">Road Number/Name (If any)</label>
                                                <input type="text" class="form-control" id="road-number-name" name="road_number_name"
                                                       placeholder="Road Number/Name (If any)"
                                                       value="{{ $oldOr('road_number_name') }}">
                                            </div>
                                        </div>

                                        <!-- Company Logo -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group mt-15">
                                                <label class="form-label">Logo Of Company</label>
                                                <div class="multiple-upload-container" id="upload-container-1">
                                                    <input type="file" class="multiple-file-input" accept="image/*" name="company_logo">
                                                    <label class="upload-label">Select Logo</label>
                                                    <div class="multiple-thumbnail-gallery"></div>
                                                    @if(!empty($vendor->company_logo))
                                                        <div class="mt-2">
                                                            <img style="height: auto;width: 120px" src="{{ asset($vendor->company_logo) }}">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Total Capacity -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="total-capacity">Total Capacity Of the Hotel/Property</label>
                                                <input type="text" class="form-control" id="total-capacity" name="total_capacity"
                                                       placeholder="Capacity"
                                                       value="{{ $oldOr('total_capacity') }}">
                                            </div>
                                        </div>

                                        <!-- Total Car Parking -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="total-car-parking">Total Car Parking’s</label>
                                                <input type="text" class="form-control" id="total-car-parking" name="total_car_parking"
                                                       placeholder="Total Car Parking’s"
                                                       value="{{ $oldOr('total_car_parking') }}">
                                            </div>
                                        </div>

                                        <!-- Reception -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                            <div class="form-group">
                                                <label class="form-label">Reception (If any)</label>
                                                <div class="radio-group">
                                                    <label>
                                                        <input type="radio" name="reception" value="yes" class="bar-radio-yes" data-target="Reception-input"
                                                            {{ $oldOr('reception','no') === 'yes' ? 'checked' : '' }}>
                                                        Yes
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="reception" value="no" class="bar-radio-no" data-target="Reception-input"
                                                            {{ $oldOr('reception','no') === 'no' ? 'checked' : '' }}>
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Total Lifts -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="total-lifts">Total Number of Lifts / Elevators</label>
                                                <select class="form-select mb-3" id="total-lifts" name="total_lifts">
                                                    <option value="">Select Number of Lifts / Elevators</option>
                                                    @for ($i = 1; $i <= 20; $i++)
                                                        <option value="{{ $i }}" {{ (int)$oldOr('total_lifts') === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Total Generators -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="total-generators">Total Number of Generators</label>
                                                <select class="form-select mb-3" id="total-generators" name="total_generators">
                                                    <option value="">Select Number of Generators</option>
                                                    @for ($i = 1; $i <= 20; $i++)
                                                        <option value="{{ $i }}" {{ (int)$oldOr('total_generators') === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Total Fire Exits -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="total-fire-exits">Total Fire Exits</label>
                                                <select class="form-select mb-3" id="total-fire-exits" name="total_fire_exits">
                                                    <option value="">Select Total Fire Exits</option>
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}" {{ (int)$oldOr('total_fire_exits') === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Wheelchair Access -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Wheel Chair Access Gate (If Any)</label>
                                                <div class="radio-group" data-kids-zone="2">
                                                    <div>
                                                        <label>
                                                            <input type="radio" name="wheelchair_access" value="yes" class="radio-yes"
                                                                {{ $oldOr('wheelchair_access','no') === 'yes' ? 'checked' : '' }}>
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label>
                                                            <input type="radio" name="wheelchair_access" value="no" class="radio-no"
                                                                {{ $oldOr('wheelchair_access','no') === 'no' ? 'checked' : '' }}>
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Housekeeping counters -->
                                        <div class="col-lg-8">
                                            <label class="form-label">Total House Keeping & Cleaners</label>
                                            <div class="counter-wrapper">
                                                <div class="counter-card">
                                                    <div>
                                                        <h4>Total Male</h4>
                                                        <div class="counter">
                                                            <button type="button" class="btn decrease-male">-</button>
                                                            <span class="count male-count">{{ (int)$oldOr('male_housekeeping', 0) }}</span>
                                                            <input type="hidden" name="male_housekeeping" value="{{ (int)$oldOr('male_housekeeping', 0) }}" class="male-input">
                                                            <button type="button" class="btn increase-male">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="counter-card">
                                                    <div>
                                                        <h4>Total Female</h4>
                                                        <div class="counter">
                                                            <button type="button" class="btn decrease-female">-</button>
                                                            <span class="count female-count">{{ (int)$oldOr('female_housekeeping', 0) }}</span>
                                                            <input type="hidden" name="female_housekeeping" value="{{ (int)$oldOr('female_housekeeping', 0) }}" class="female-input">
                                                            <button type="button" class="btn increase-female">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="total-box">
                                                    Total House Keeping & Cleaners <br>
                                                    <span class="total-count">
                                                        {{ (int)$oldOr('male_housekeeping', 0) + (int)$oldOr('female_housekeeping', 0) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Kids Zone -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Kids Zone</label>
                                                <div class="radio-group" data-kids-zone="1">
                                                    <div>
                                                        <label>
                                                            <input type="radio" name="kids_zone" value="yes" class="radio-yes"
                                                                {{ $oldOr('kids_zone','no') === 'yes' ? 'checked' : '' }}>
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label>
                                                            <input type="radio" name="kids_zone" value="no" class="radio-no"
                                                                {{ $oldOr('kids_zone','no') === 'no' ? 'checked' : '' }}>
                                                            No
                                                        </label>
                                                    </div>
                                                    <div class="select-container"
                                                         style="display: {{ $oldOr('kids_zone') === 'yes' ? 'block' : 'none' }};">
                                                        <label>Select number of kids:</label>
                                                        <select class="form-select number-select" name="kids_zone_count">
                                                            <option value="">Select number</option>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <option value="{{ $i }}" {{ (int)$oldOr('kids_zone_count') === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- View -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="view-from-hotel">View from Hotel / Property</label>
                                                <input type="text" class="form-control" id="view-from-hotel" name="view_from_hotel"
                                                       placeholder="City View, Beach View, Hill View, etc."
                                                       value="{{ $oldOr('view_from_hotel') }}">
                                            </div>
                                        </div>

                                        <!-- Security Guards -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="security-guards">Number of Security Guards</label>
                                                <select class="form-select mb-3" id="security-guards" name="security_guards">
                                                    <option value="">Select Number of Security Guards</option>
                                                    @for ($i = 1; $i <= 20; $i++)
                                                        <option value="{{ $i }}" {{ (int)$oldOr('security_guards') === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Cafe & Restaurants -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div id="customDynamicForm2024">
                                                <div class="mb-4">
                                                    <label class="form-label">Cafe & Restaurants (If any)</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="cafe_restaurants" id="customRadioYes2024" value="yes"
                                                            {{ $oldOr('cafe_restaurants','no') === 'yes' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="customRadioYes2024">Yes</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="cafe_restaurants" id="customRadioNo2024" value="no"
                                                            {{ $oldOr('cafe_restaurants','no') === 'no' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="customRadioNo2024">No</label>
                                                    </div>
                                                </div>

                                                <div id="customSelectContainer2024" class="mb-4 {{ $oldOr('cafe_restaurants') === 'yes' ? '' : 'custom-form-hidden' }}">
                                                    <label for="customOptionSelect2024" class="form-label">Select Total Number of Cafe & Restaurants</label>
                                                    <select class="form-select" id="customOptionSelect2024" name="cafe_restaurants_count">
                                                        <option value="">Select a value</option>
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}" {{ (int)$oldOr('cafe_restaurants_count', count($existingCafeNames)) === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                <div id="customInputContainer2024" class="{{ ($oldOr('cafe_restaurants') === 'yes' && (int)$oldOr('cafe_restaurants_count', count($existingCafeNames)) > 0) ? '' : 'custom-form-hidden' }}">
                                                    {{-- Pre-load existing cafe names if present --}}
                                                    @php $prefillCount = (int)$oldOr('cafe_restaurants_count', count($existingCafeNames)); @endphp
                                                    @for ($i = 1; $i <= max(0, $prefillCount); $i++)
                                                        <div class="mb-3">
                                                            <label class="form-label" for="cafe_name_{{ $i }}"> Cafe & restaurants Name {{ $i }}</label>
                                                            <input type="text" class="form-control" id="cafe_name_{{ $i }}" name="cafe_names[]"
                                                                   placeholder="Enter Cafe & restaurants Name {{ $i }}"
                                                                   value="{{ $existingCafeNames[$i-1] ?? '' }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pool -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Pool (If any)</label>
                                                <div class="radio-group" data-kids-zone="2">
                                                    <div>
                                                        <label><input type="radio" name="pool" value="yes" class="radio-yes" {{ $oldOr('pool','no') === 'yes' ? 'checked' : '' }}> Yes</label>
                                                    </div>
                                                    <div>
                                                        <label><input type="radio" name="pool" value="no" class="radio-no" {{ $oldOr('pool','no') === 'no' ? 'checked' : '' }}> No</label>
                                                    </div>
                                                    <div class="select-container" style="display: {{ $oldOr('pool') === 'yes' ? 'block' : 'none' }};">
                                                        <label>Select Pool Number</label>
                                                        <select class="form-select number-select" name="pool_count">
                                                            <option value="">Select number</option>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <option value="{{ $i }}" {{ (int)$oldOr('pool_count') === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bar -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Bar (If any)</label>
                                                <div class="radio-group" data-kids-zone="2">
                                                    <div>
                                                        <label><input type="radio" name="bar" value="yes" class="radio-yes" {{ $oldOr('bar','no') === 'yes' ? 'checked' : '' }}> Yes</label>
                                                    </div>
                                                    <div>
                                                        <label><input type="radio" name="bar" value="no" class="radio-no" {{ $oldOr('bar','no') === 'no' ? 'checked' : '' }}> No</label>
                                                    </div>
                                                    <div class="select-container" style="display: {{ $oldOr('bar') === 'yes' ? 'block' : 'none' }};">
                                                        <label>Select Total Number of Bar</label>
                                                        <select class="form-select number-select" name="bar_count">
                                                            <option value="">Select number</option>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <option value="{{ $i }}" {{ (int)$oldOr('bar_count') === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Gym -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Gym (If any)</label>
                                                <div class="radio-group" data-kids-zone="2">
                                                    <div>
                                                        <label><input type="radio" name="gym" value="yes" class="radio-yes" {{ $oldOr('gym','no') === 'yes' ? 'checked' : '' }}> Yes</label>
                                                    </div>
                                                    <div>
                                                        <label><input type="radio" name="gym" value="no" class="radio-no" {{ $oldOr('gym','no') === 'no' ? 'checked' : '' }}> No</label>
                                                    </div>
                                                    <div class="select-container" style="display: {{ $oldOr('gym') === 'yes' ? 'block' : 'none' }};">
                                                        <label>Select Total Number of Gym</label>
                                                        <select class="form-select number-select" name="gym_count">
                                                            <option value="">Select number</option>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <option value="{{ $i }}" {{ (int)$oldOr('gym_count') === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Party Center -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                            <div class="form-group">
                                                <label class="form-label">Party Center (If any)</label>
                                                <div class="radio-group">
                                                    <label>
                                                        <input type="radio" name="party_center" value="yes" class="bar-radio-yes" data-target="Party-input"
                                                            {{ $oldOr('party_center','no') === 'yes' ? 'checked' : '' }}>
                                                        Yes
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="party_center" value="no" class="bar-radio-no" data-target="Party-input"
                                                            {{ $oldOr('party_center','no') === 'no' ? 'checked' : '' }}>
                                                        No
                                                    </label>
                                                </div>
                                                <div class="input-group {{ $oldOr('party_center') === 'yes' ? '' : 'hidden' }}" id="Party-input">
                                                    <textarea class="form-control" name="party_center_details" placeholder="Ex: 1500 SFT" style="height: 50px;">{{ $oldOr('party_center_details') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Conference Hall -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                            <div class="form-group">
                                                <label class="form-label">Conference Hall (If any)</label>
                                                <div class="radio-group">
                                                    <label>
                                                        <input type="radio" name="conference_hall" value="yes" class="bar-radio-yes" data-target="Conference-input"
                                                            {{ $oldOr('conference_hall','no') === 'yes' ? 'checked' : '' }}>
                                                        Yes
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="conference_hall" value="no" class="bar-radio-no" data-target="Conference-input"
                                                            {{ $oldOr('conference_hall','no') === 'no' ? 'checked' : '' }}>
                                                        No
                                                    </label>
                                                </div>
                                                <div class="input-group {{ $oldOr('conference_hall') === 'yes' ? '' : 'hidden' }}" id="Conference-input">
                                                    <textarea class="form-control" name="conference_hall_details" placeholder="Ex: 1500 SFT" style="height: 50px;">{{ $oldOr('conference_hall_details') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="email" class="form-label">
                                                    Email <span style="font-size: 11px;color:red"></span>
                                                </label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       placeholder="Enter Email"
                                                       value="{{ \App\Models\Vendor::where('id', $vendor->vendor_id)->first()->email }}
                                                           " required readonly>
                                            </div>
                                        </div>

                                        <!-- Password (optional) -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="password" class="form-label">
                                                    Password <span style="font-size: 11px;color:red">(Leave blank to keep current)</span>
                                                </label>
                                                <input type="password" class="form-control" id="password" name="password" minlength="8" placeholder="Password must be 8 Characters Minimum">
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>

                                    </div> <!-- /.row -->
                                </div> <!-- /.card-inner -->
                            </div> <!-- /.card -->
                        </form>

                        <!-- ====== Scripts (same behavior as Create, prefilled from existing values) ====== -->
                        <script>
                            // Housekeeping counters
                            const maleCountEl = document.querySelector(".male-count");
                            const femaleCountEl = document.querySelector(".female-count");
                            const totalCountEl = document.querySelector(".total-count");
                            const maleInput = document.querySelector(".male-input");
                            const femaleInput = document.querySelector(".female-input");

                            let maleCount = parseInt(maleCountEl?.textContent || '0', 10);
                            let femaleCount = parseInt(femaleCountEl?.textContent || '0', 10);

                            function updateTotalCount() {
                                if (totalCountEl) totalCountEl.textContent = maleCount + femaleCount;
                                if (maleInput) maleInput.value = maleCount;
                                if (femaleInput) femaleInput.value = femaleCount;
                            }
                            document.querySelector(".increase-male")?.addEventListener("click", () => {
                                maleCount++; if (maleCountEl) maleCountEl.textContent = maleCount; updateTotalCount();
                            });
                            document.querySelector(".decrease-male")?.addEventListener("click", () => {
                                if (maleCount > 0) { maleCount--; if (maleCountEl) maleCountEl.textContent = maleCount; updateTotalCount(); }
                            });
                            document.querySelector(".increase-female")?.addEventListener("click", () => {
                                femaleCount++; if (femaleCountEl) femaleCountEl.textContent = femaleCount; updateTotalCount();
                            });
                            document.querySelector(".decrease-female")?.addEventListener("click", () => {
                                if (femaleCount > 0) { femaleCount--; if (femaleCountEl) femaleCountEl.textContent = femaleCount; updateTotalCount(); }
                            });
                            // Initialize totals on load
                            updateTotalCount();
                        </script>

                        <script>
                            // Kids Zone / Pool / Bar / Gym toggle for number selects
                            class KidsZoneManager {
                                constructor() { this.initializeAll(); }
                                initializeAll() {
                                    document.querySelectorAll('[data-kids-zone]').forEach(section => this.bind(section));
                                }
                                bind(section) {
                                    const radios = section.querySelectorAll('input[type="radio"]');
                                    const selectContainer = section.querySelector('.select-container');
                                    const numberSelect = section.querySelector('.number-select');
                                    radios.forEach(r => {
                                        r.addEventListener('change', () => {
                                            if (!selectContainer || !numberSelect) return;
                                            if (r.value === 'yes' && r.checked) {
                                                selectContainer.style.display = 'block';
                                            } else if (r.value === 'no' && r.checked) {
                                                selectContainer.style.display = 'none';
                                                numberSelect.value = '';
                                            }
                                        });
                                    });
                                }
                            }
                            new KidsZoneManager();
                        </script>

                        <script>
                            // Show/hide Party/Conference details
                            document.addEventListener("DOMContentLoaded", function () {
                                document.querySelectorAll(".radio-group input[type='radio']").forEach(function (radio) {
                                    radio.addEventListener("change", function () {
                                        const targetId = this.getAttribute("data-target");
                                        if (!targetId) return;
                                        const targetInput = document.getElementById(targetId);
                                        if (targetInput) {
                                            if (this.value === "yes" && this.checked) {
                                                targetInput.classList.remove("hidden");
                                            } else if (this.value === "no" && this.checked) {
                                                targetInput.classList.add("hidden");
                                            }
                                        }
                                    });
                                });
                            });
                        </script>

                        <script>
                            // Cafe & Restaurants dynamic fields
                            const cafeRadios = document.querySelectorAll('input[name="cafe_restaurants"]');
                            const cafeCountContainer = document.getElementById('customSelectContainer2024');
                            const cafeCountSelect = document.getElementById('customOptionSelect2024');
                            const cafeNamesContainer = document.getElementById('customInputContainer2024');

                            cafeRadios.forEach(r => {
                                r.addEventListener('change', (e) => {
                                    if (e.target.value === 'yes') {
                                        cafeCountContainer?.classList.remove('custom-form-hidden');
                                    } else {
                                        cafeCountContainer?.classList.add('custom-form-hidden');
                                        cafeNamesContainer?.classList.add('custom-form-hidden');
                                        if (cafeCountSelect) cafeCountSelect.value = '';
                                        if (cafeNamesContainer) cafeNamesContainer.innerHTML = '';
                                    }
                                });
                            });

                            cafeCountSelect?.addEventListener('change', (e) => {
                                const count = parseInt(e.target.value || '0', 10);
                                if (!cafeNamesContainer) return;
                                cafeNamesContainer.innerHTML = '';
                                if (count > 0) {
                                    for (let i = 1; i <= count; i++) {
                                        const wrap = document.createElement('div');
                                        wrap.className = 'mb-3';
                                        wrap.innerHTML = `
                                            <label class="form-label" for="cafe_name_${i}"> Cafe & restaurants Name ${i}</label>
                                            <input type="text" class="form-control" id="cafe_name_${i}" name="cafe_names[]" placeholder="Enter Cafe & restaurants Name ${i}">
                                        `;
                                        cafeNamesContainer.appendChild(wrap);
                                    }
                                    cafeNamesContainer.classList.remove('custom-form-hidden');
                                } else {
                                    cafeNamesContainer.classList.add('custom-form-hidden');
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
