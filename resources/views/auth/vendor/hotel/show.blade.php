@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">View Hotel / Property</h3>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem3">Hotel/Property Description & Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Facilities of Hotel /
                                            Property</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Photos">Photos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem1">Nearby Area</a>
                                    </li>
                                </ul>

                                <form method="POST" action="{{ route('vendor-admin.hotel.update', $hotel->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="tab-content">
                                        <!-- Hotel Description -->

                                        <style>
                                            .card {
                                                border: none;
                                                border-radius: 10px;
                                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                                margin-bottom: 20px;
                                            }
                                            .card-header {
                                                background-color: #f8f9fa;
                                                border-bottom: 1px solid #e9ecef;
                                                border-radius: 10px 10px 0 0;
                                                padding: 15px 20px;
                                            }
                                            .card-body {
                                                padding: 20px;
                                            }
                                            .section-title {
                                                font-size: 1.5rem;
                                                font-weight: 600;
                                                color: #343a40;
                                                margin-bottom: 15px;
                                            }
                                            .form-label {
                                                font-weight: 500;
                                                color: #495057;
                                                margin-bottom: 5px;
                                            }
                                            .form-control-static {
                                                font-size: 1rem;
                                                color: #212529;
                                                line-height: 1.5;
                                            }
                                            .list-group-item {
                                                border: none;
                                                padding: 8px 0;
                                                font-size: 1rem;
                                                color: #212529;
                                            }
                                            .edit-button {
                                                position: fixed;
                                                bottom: 20px;
                                                right: 20px;
                                                z-index: 1000;
                                            }
                                            .btn-edit {
                                                background-color: #007bff;
                                                border-color: #007bff;
                                                padding: 10px 20px;
                                                font-size: 1rem;
                                                border-radius: 5px;
                                            }
                                            .btn-edit:hover {
                                                background-color: #0056b3;
                                                border-color: #0056b3;
                                            }
                                        </style>

                                        <style>
                                            .card {
                                                border: none;
                                                border-radius: 10px;
                                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                                margin-bottom: 20px;
                                            }
                                            .card-header {
                                                background-color: #f8f9fa;
                                                border-bottom: 1px solid #e9ecef;
                                                border-radius: 10px 10px 0 0;
                                                padding: 15px 20px;
                                            }
                                            .card-body {
                                                padding: 20px;
                                            }
                                            .section-title {
                                                font-size: 1.5rem;
                                                font-weight: 600;
                                                color: #343a40;
                                                margin-bottom: 15px;
                                            }
                                            .form-label {
                                                font-weight: 500;
                                                color: #495057;
                                                margin-bottom: 5px;
                                            }
                                            .form-control-static {
                                                font-size: 1rem;
                                                color: #212529;
                                                line-height: 1.5;
                                            }
                                            .list-group-item {
                                                border: none;
                                                padding: 8px 0;
                                                font-size: 1rem;
                                                color: #212529;
                                            }
                                            .btn-edit {
                                                background: linear-gradient(45deg, #007bff, #00b7eb);
                                                border: none;
                                                padding: 12px 30px;
                                                font-size: 1.1rem;
                                                font-weight: 500;
                                                border-radius: 8px;
                                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                                color: #fff;
                                                transition: all 0.3s ease;
                                            }
                                            .btn-edit:hover {
                                                background: linear-gradient(45deg, #0056b3, #0098c7);
                                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                                                color: #fff;
                                            }
                                        </style>

                                        <style>
                                            .card {
                                                border: none;
                                                border-radius: 10px;
                                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                                margin-bottom: 20px;
                                            }
                                            .card-header {
                                                background-color: #f8f9fa;
                                                border-bottom: 1px solid #e9ecef;
                                                border-radius: 10px 10px 0 0;
                                                padding: 15px 20px;
                                            }
                                            .card-body {
                                                padding: 20px;
                                            }
                                            .section-title {
                                                font-size: 1.5rem;
                                                font-weight: 600;
                                                color: #343a40;
                                                margin-bottom: 15px;
                                            }
                                            .form-label {
                                                font-weight: 600;
                                                font-size: 1.1rem;
                                                color: #1a252f;
                                                margin-bottom: 8px;
                                            }
                                            .form-control-static {
                                                font-weight: 400;
                                                font-size: 1rem;
                                                color: #495057;
                                                line-height: 1.5;
                                                margin-bottom: 15px;
                                                padding-bottom: 10px;
                                                border-bottom: 1px solid #e9ecef;
                                            }
                                            .list-group-item {
                                                border: none;
                                                padding: 8px 0;
                                                font-size: 1rem;
                                                color: #495057;
                                            }
                                            .btn-edit {
                                                background: linear-gradient(45deg, #007bff, #00b7eb);
                                                border: none;
                                                padding: 12px 30px;
                                                font-size: 1.1rem;
                                                font-weight: 500;
                                                border-radius: 8px;
                                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                                color: #fff;
                                                transition: all 0.3s ease;
                                            }
                                            .btn-edit:hover {
                                                background: linear-gradient(45deg, #0056b3, #0098c7);
                                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                                                color: #fff;
                                            }
                                        </style>

                                        <div class="tab-pane active" id="tabItem3" style="padding: 20px;">
                                            <!-- Hotel/Property Description & Policy -->
                                            <div class="card">
                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Hotel/Property Description & Policy</h3>

                                                    <a href="{{ route('vendor-admin.hotel.editOne1', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>


                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Property Type</label>
                                                            <p class="form-control-static">{{ $hotel->property_type ?? 'Not provided' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row gy-4">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Hotel / Property Name</label>
                                                            <p class="form-control-static">{{ $hotel->description ?? 'Not provided' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row gy-4">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Hotel/Property Description & Policy</label>
                                                            <p class="form-control-static">{!!  $hotel->details ?? 'Not provided'  !!}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Location Latitude</label>
                                                            <p class="form-control-static">{{ $hotel->lati }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Location Longitude</label>
                                                            <p class="form-control-static">{{ $hotel->longi }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Adress</label>
                                                            <p class="form-control-static">{{ $hotel->address }}</p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Property Policy And Rules -->
                                            <div class="card">
                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Property Policy and Rules</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editOne2', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Pets Allowed</label>
                                                            <p class="form-control-static">{{ $hotel->pets_allowed == 'yes' ? 'Yes' : 'No' }}</p>
                                                            @if($hotel->pets_allowed == 'yes')
                                                                <label class="form-label">Pets Details</label>
                                                                <p class="form-control-static">{!!  $hotel->pets_details ?? 'Not provided'  !!}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Events & Party</label>
                                                            <p class="form-control-static">{{ $hotel->events_allowed == 'yes' ? 'Yes' : 'No' }}</p>
                                                            @if($hotel->events_allowed == 'yes')
                                                                <label class="form-label">Events Details</label>
                                                                <p class="form-control-static">{{ $hotel->events_details ?? 'Not provided' }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Smoking</label>
                                                            <p class="form-control-static">{{ $hotel->smoking_allowed == 'yes' ? 'Yes (Vaping or e-cigarettes)' : 'No' }}</p>
                                                            @if($hotel->smoking_allowed == 'yes')
                                                                <label class="form-label">Smoking Details</label>
                                                                <p class="form-control-static">{{ $hotel->smoking_details ?? 'Not provided' }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Quiet Hours</label>
                                                            <p class="form-control-static">{{ $hotel->quiet_hours ?? 'Not provided' }}</p>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Commercial Photography and Filming</label>
                                                            <p class="form-control-static">{{ $hotel->photography_allowed == 'yes' ? 'Yes' : 'No' }}</p>
                                                            @if($hotel->photography_allowed == 'yes')
                                                                <label class="form-label">Photography Details</label>
                                                                <p class="form-control-static">{{ $hotel->photography_details ?? 'Not provided' }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Check-in Window</label>
                                                            <p class="form-control-static">{{ $hotel->check_in_window ?? 'Not provided' }}</p>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Check-out Time</label>
                                                            <p class="form-control-static">{{ $hotel->check_out_time ?? 'Not provided' }}</p>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Food & Laundry Facilities</label>
                                                            <p class="form-control-static">{{ $hotel->food_laundry == 'yes' ? 'Yes' : 'No' }}</p>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12 col-xxl-12">
                                                            <label class="form-label">Check-in Rules</label>
                                                            @php
                                                                $rawRules = $hotel->check_in_rules ?? [];
                                                                $savedRules = is_string($rawRules) ? json_decode($rawRules, true) : (is_array($rawRules) ? $rawRules : []);
                                                                $predefinedRules = ['Pay in advance', 'Security money for keys', 'Rentals'];
                                                                $customRules = array_values(array_diff($savedRules, $predefinedRules));
                                                            @endphp
                                                            @if(!empty($savedRules))
                                                                <ul class="list-group">
                                                                    @foreach($savedRules as $rule)
                                                                        <li class="list-group-item">{{ $rule }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <p class="form-control-static">Not provided</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Property Information -->
                                            <div class="card">

                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Property Info</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editOne3', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    @php
                                                        $propertyInfo = old('property_info', $hotel->property_info ?? []);
                                                        if (is_string($propertyInfo)) {
                                                            $propertyInfo = json_decode($propertyInfo, true) ?: [];
                                                        }
                                                        $customPropertyInfo = old('custom_property_info', $hotel->custom_property_info ?? []);
                                                        if (is_string($customPropertyInfo)) {
                                                            $customPropertyInfo = json_decode($customPropertyInfo, true) ?: [];
                                                        }
                                                    @endphp
                                                    @if(!empty($propertyInfo) || !empty($customPropertyInfo))
                                                        <ul class="list-group">
                                                            @foreach($propertyInfo as $info)
                                                                <li class="list-group-item">{{ $info }}</li>
                                                            @endforeach
                                                            @foreach($customPropertyInfo as $customInfo)
                                                                @if(!empty($customInfo))
                                                                    <li class="list-group-item">{{ $customInfo }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="form-control-static">Not provided</p>
                                                    @endif
                                                </div>
                                            </div>


                                            <!-- Arrival Guideline Information -->
                                            <div class="card">

                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Arrival Guides</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editOne4', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Age Restrictions</label>
                                                            <p class="form-control-static">{{ $hotel->age_restriction == 'yes' ? 'Yes' : 'No' }}</p>
                                                            @if($hotel->age_restriction == 'yes')
                                                                <label class="form-label">Age Restriction Details</label>
                                                                <p class="form-control-static">{{ $hotel->age_restriction_details ?? 'Not provided' }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <label class="form-label">Vlogging & Commercial Filming</label>
                                                            <p class="form-control-static">{{ $hotel->vlogging_allowed == 'yes' ? 'Yes' : 'No' }}</p>
                                                            @if($hotel->vlogging_allowed == 'yes')
                                                                <label class="form-label">Vlogging Details</label>
                                                                <p class="form-control-static">{{ $hotel->vlogging_details ?? 'Not provided' }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <label class="form-label">Child Policy</label>
                                                            <p class="form-control-static">{!!  $hotel->child_policy ?? 'Not provided'  !!}</p>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <label class="form-label">Extra Bed Policy</label>
                                                            <p class="form-control-static">{!! $hotel->extra_bed_policy ?? 'Not provided' !!}</p>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <label class="form-label">Cooking Policy</label>
                                                            <p class="form-control-static">{{ $hotel->cooking_policy ?? 'Not provided' }}</p>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <label class="form-label">Directions</label>
                                                            <p class="form-control-static">{!! $hotel->directions ?? 'Not provided' !!}</p>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12 col-xxl-12">
                                                            <label class="form-label">Additional Policy</label>
                                                            <p class="form-control-static">{!! $hotel->additional_policy ?? 'Not provided' !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Check in method -->
                                            <div class="card">
                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Check-in Method</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editOne5', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>

                                                <div class="card-body">
                                                    @php
                                                        $checkInMethods = old('check_in_methods', $hotel->check_in_methods ?? []);
                                                        if (is_string($checkInMethods)) {
                                                            $checkInMethods = json_decode($checkInMethods, true) ?: [];
                                                        }
                                                        $customCheckInMethods = old('custom_check_in_methods', $hotel->custom_check_in_methods ?? []);
                                                        if (is_string($customCheckInMethods)) {
                                                            $customCheckInMethods = json_decode($customCheckInMethods, true) ?: [];
                                                        }
                                                    @endphp
                                                    @if(!empty($checkInMethods) || !empty($customCheckInMethods))
                                                        <ul class="list-group">
                                                            @foreach($checkInMethods as $method)
                                                                <li class="list-group-item">{{ $method }}</li>
                                                            @endforeach
                                                            @foreach($customCheckInMethods as $customMethod)
                                                                @if(!empty($customMethod))
                                                                    <li class="list-group-item">{{ $customMethod }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="form-control-static">Not provided</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Cancellation Policies -->
                                            <div class="card">

                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Cancellation Policies</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editOne6', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    @php
                                                        $cancellationPolicies = old('cancellation_policies', $hotel->cancellation_policies ?? []);
                                                        if (is_string($cancellationPolicies)) {
                                                            $cancellationPolicies = json_decode($cancellationPolicies, true) ?: [];
                                                        }
                                                    @endphp
                                                    @if(!empty($cancellationPolicies))
                                                        <ul class="list-group">
                                                            @foreach($cancellationPolicies as $policy)
                                                                <li class="list-group-item">
                                                                    {{ $policy }}
                                                                    @if($policy == 'Flexible')
                                                                        (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)
                                                                    @elseif($policy == 'Non-refundable')
                                                                        (Regardless of the cancelation window, customers will not get any refund under this.)
                                                                    @elseif($policy == 'Partially refundable')
                                                                        (Cancelations that take place in less than 24 hours and Rooms that are labeled with this badge after deducting a 30% Cancellation fee rest of the amount will be refunded.)
                                                                    @elseif($policy == 'Long-term/Monthly staying policy')
                                                                        (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed. T&C paper will be found in the system.)
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="form-control-static">Not provided</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Edit Button -->
{{--                                            <div class="row mt-4">--}}
{{--                                                <div class="col-12 text-center">--}}
{{--                                                    <a href="{{ route('vendor-admin.hotel.editPone', $hotel) }}" class="btn btn-edit">Edit Details</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>

                                        <!-- Most Popular Facilities -->
                                    @php
                                        // ────────────────────────────────────────────────────────
                                        // 1) Decode saved “facilities” (popular ones) & custom ones
                                        $savedFacilities = old('facilities', $hotel->facilities ?? []);
                                        if (is_string($savedFacilities)) {
                                            $savedFacilities = json_decode($savedFacilities, true) ?: [];
                                        }
                                        $customFacilities = old('custom_facilities', $hotel->custom_facilities ?? []);
                                        if (is_string($customFacilities)) {
                                            $customFacilities = json_decode($customFacilities, true) ?: [];
                                        }

                                        // 2) Decode saved “hotel_facilities” JSON into grouped array
                                        $savedHF = old('hotel_facilities', $hotel->hotel_facilities ?? []);
                                        if (is_string($savedHF)) {
                                            $savedHF = json_decode($savedHF, true) ?: [];
                                        }
                                        $groupedHF = [];
                                        foreach ($savedHF as $item) {
                                            $groupedHF[$item['category']][] = $item['name'];
                                        }
                                    @endphp

                                    <!-- Most Popular Facilities -->
                                        <style>
                                            .card {
                                                border: none;
                                                border-radius: 10px;
                                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                                margin-bottom: 20px;
                                            }
                                            .card-header {
                                                background-color: #f8f9fa;
                                                border-bottom: 1px solid #e9ecef;
                                                border-radius: 10px 10px 0 0;
                                                padding: 15px 20px;
                                            }
                                            .card-body {
                                                padding: 20px;
                                            }
                                            .section-title {
                                                font-size: 1.5rem;
                                                font-weight: 600;
                                                color: #343a40;
                                                margin-bottom: 15px;
                                            }
                                            .form-label {
                                                font-weight: 600;
                                                font-size: 1.1rem;
                                                color: #1a252f;
                                                margin-bottom: 8px;
                                            }
                                            .form-control-static {
                                                font-weight: 400;
                                                font-size: 1rem;
                                                color: #495057;
                                                line-height: 1.5;
                                                margin-bottom: 15px;
                                                padding-bottom: 10px;
                                                border-bottom: 1px solid #e9ecef;
                                            }
                                            .list-group-item {
                                                border: none;
                                                padding: 8px 0;
                                                font-size: 1rem;
                                                color: #495057;
                                                display: flex;
                                                align-items: center;
                                                gap: 10px;
                                            }
                                            .facility-icon {
                                                width: 24px;
                                                height: 24px;
                                                object-fit: contain;
                                            }
                                            .btn-edit {
                                                background: linear-gradient(45deg, #007bff, #00b7eb);
                                                border: none;
                                                padding: 12px 30px;
                                                font-size: 1.1rem;
                                                font-weight: 500;
                                                border-radius: 8px;
                                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                                color: #fff;
                                                transition: all 0.3s ease;
                                            }
                                            .btn-edit:hover {
                                                background: linear-gradient(45deg, #0056b3, #0098c7);
                                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                                                color: #fff;
                                            }
                                        </style>

                                        <div class="tab-pane" id="tabItem4" style="padding: 20px;">
                                            <!-- Most Popular Facilities -->
                                            <div class="card">

                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Most Popular Facilities</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editPtwo1', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    @php
                                                        // Decode saved "facilities" (popular ones) & custom ones
                                                        $savedFacilities = old('facilities', $hotel->facilities ?? []);
                                                        if (is_string($savedFacilities)) {
                                                            $savedFacilities = json_decode($savedFacilities, true) ?: [];
                                                        }
                                                        $customFacilities = old('custom_facilities', $hotel->custom_facilities ?? []);
                                                        if (is_string($customFacilities)) {
                                                            $customFacilities = json_decode($customFacilities, true) ?: [];
                                                        }
                                                        $icons = is_array($hotel->custom_facilities_icon) ? $hotel->custom_facilities_icon : (json_decode($hotel->custom_facilities_icon, true) ?: []);
                                                    @endphp
                                                    @if(!empty($savedFacilities) || !empty($customFacilities))
                                                        <ul class="list-group">
                                                            @foreach([
                                                                'Free Wi-Fi' => '../images/icons/wifi.png',
                                                                'Hill View Or Sea View' => '../images/icons/mountain.png',
                                                                'On-site restaurant' => '../images/icons/restaurant.png',
                                                                'Buffet Breakfast' => '../images/icons/breakfast.png',
                                                                'Bar/lounge' => '../images/icons/bar.png',
                                                                'Private Pool' => '../images/icons/pool.png',
                                                                'Fitness center & Spa services' => '../images/icons/fitness.png',
                                                                '24-hour reception' => '../images/icons/reception.png',
                                                                'Parking facilities' => '../images/icons/parking.png',
                                                                'Airport shuttle service' => '../images/icons/shuttle.png'
                                                            ] as $label => $icon)
                                                                @if(in_array($label, $savedFacilities))
                                                                    <li class="list-group-item">
                                                                        <img src="{{ asset('../images/icons/mountain.png') }}" alt="{{ $label }}" class="facility-icon">
                                                                        {{ $label }}
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                            @foreach($customFacilities as $i => $facility)
                                                                @if(!empty($facility))
                                                                    <li class="list-group-item">
                                                                        @if(isset($icons[$i]) && !in_array($i, explode(',', old('removed_custom_facilities_icon', ''))))
                                                                            <img src="{{ asset('../images/icons/mountain.png') }}" alt="{{ $facility }}" class="facility-icon">
                                                                        @else
                                                                            <img src="{{ asset('../images/icons/mountain.png') }}" alt="{{ $facility }}" class="facility-icon">
                                                                        @endif
                                                                        {{ $facility }}
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="form-control-static">No facilities provided</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Hotel Facilities Categories -->
                                            <div class="card">
                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Hotel Facilities Categories</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editPtwo2', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>


                                                <div class="card-body">

                                                    @php
                                                        // Use the hotelFacilities variable from controller, or fallback to hotel->hotel_facilities
                                                        $hotelFacilitiesData = $hotelFacilities ?? $hotel->hotel_facilities ?? [];
                                                        
                                                        // Ensure it's an array
                                                        if (is_string($hotelFacilitiesData)) {
                                                            $hotelFacilitiesData = json_decode($hotelFacilitiesData, true);
                                                        }
                                                        
                                                        if (!is_array($hotelFacilitiesData)) {
                                                            $hotelFacilitiesData = [];
                                                        }

                                                        $groupedFacilities = [];
                                                        foreach ($hotelFacilitiesData as $facility) {
                                                            if (is_array($facility) && isset($facility['category']) && isset($facility['name'])) {
                                                                $groupedFacilities[$facility['category']][] = $facility['name'];
                                                            }
                                                        }
                                                    @endphp

                                                    @if(!empty($groupedFacilities))
                                                        @foreach($groupedFacilities as $categoryKey => $facilityNames)
                                                            @php
                                                                $formattedCategory = ucwords(str_replace(['___', '_'], [' & ', ' '], $categoryKey));
                                                            @endphp

                                                            <div class="mb-4">
                                                                <h5 class="mb-2" style="font-weight: bold; color: #2c3e50;">{{ $formattedCategory }}</h5>
                                                                <ul class="list-group">
                                                                    @foreach($facilityNames as $facilityName)
                                                                        <li class="list-group-item" style="background-color: #f9f9f9;">{{ $facilityName }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <p class="form-control-static">No facilities provided</p>
                                                    @endif


                                                </div>
                                            </div>


                                        </div>

                                        <style>
                                            .card {
                                                border: none;
                                                border-radius: 10px;
                                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                                margin-bottom: 20px;
                                            }
                                            .card-header {
                                                background-color: #f8f9fa;
                                                border-bottom: 1px solid #e9ecef;
                                                border-radius: 10px 10px 0 0;
                                                padding: 15px 20px;
                                            }
                                            .card-body {
                                                padding: 20px;
                                            }
                                            .section-title {
                                                font-size: 1.5rem;
                                                font-weight: 600;
                                                color: #343a40;
                                                margin-bottom: 15px;
                                            }
                                            .form-label {
                                                font-weight: 600;
                                                font-size: 1.1rem;
                                                color: #1a252f;
                                                margin-bottom: 8px;
                                            }
                                            .form-control-static {
                                                font-weight: 400;
                                                font-size: 1rem;
                                                color: #495057;
                                                line-height: 1.5;
                                                margin-bottom: 15px;
                                                padding-bottom: 10px;
                                                border-bottom: 1px solid #e9ecef;
                                            }
                                            .list-group-item {
                                                border: none;
                                                padding: 8px 0;
                                                font-size: 1rem;
                                                color: #495057;
                                            }
                                            .btn-edit {
                                                background: linear-gradient(45deg, #007bff, #00b7eb);
                                                border: none;
                                                padding: 12px 30px;
                                                font-size: 1.1rem;
                                                font-weight: 500;
                                                border-radius: 8px;
                                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                                color: #fff;
                                                transition: all 0.3s ease;
                                            }
                                            .btn-edit:hover {
                                                background: linear-gradient(45deg, #0056b3, #0098c7);
                                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                                                color: #fff;
                                            }
                                        </style>

                                        <style>
                                            .card {
                                                border: none;
                                                border-radius: 10px;
                                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                                margin-bottom: 20px;
                                            }
                                            .card-header {
                                                background-color: #f8f9fa;
                                                border-bottom: 1px solid #e9ecef;
                                                border-radius: 10px 10px 0 0;
                                                padding: 15px 20px;
                                            }
                                            .card-body {
                                                padding: 20px;
                                            }
                                            .section-title {
                                                font-size: 1.5rem;
                                                font-weight: 600;
                                                color: #343a40;
                                                margin-bottom: 15px;
                                            }
                                            .form-label {
                                                font-weight: 600;
                                                font-size: 1.1rem;
                                                color: #1a252f;
                                                margin-bottom: 8px;
                                            }
                                            .form-control-static {
                                                font-weight: 400;
                                                font-size: 1rem;
                                                color: #495057;
                                                line-height: 1.5;
                                                margin-bottom: 15px;
                                                padding-bottom: 10px;
                                                border-bottom: 1px solid #e9ecef;
                                            }
                                            .list-group-item {
                                                border: none;
                                                padding: 8px 0;
                                                font-size: 1rem;
                                                color: #495057;
                                            }
                                            .btn-edit {
                                                background: linear-gradient(45deg, #007bff, #00b7eb);
                                                border: none;
                                                padding: 12px 30px;
                                                font-size: 1.1rem;
                                                font-weight: 500;
                                                border-radius: 8px;
                                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                                color: #fff;
                                                transition: all 0.3s ease;
                                            }
                                            .btn-edit:hover {
                                                background: linear-gradient(45deg, #0056b3, #0098c7);
                                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                                                color: #fff;
                                            }
                                        </style>

                                        <div class="tab-pane" id="tabItem1" style="padding: 20px;">
                                            <!-- Most Popular Nearby Area -->
                                            <div class="card">

                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Most Popular Nearby Areas</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editPfour', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    @php
                                                        $nearbyAreas = is_array($hotel->custom_nearby_areas) ? $hotel->custom_nearby_areas : json_decode($hotel->custom_nearby_areas, true) ?? [];
                                                    @endphp
                                                    @if(is_array($nearbyAreas) && count($nearbyAreas) > 0)
                                                        <ul class="list-group">
                                                            @foreach($nearbyAreas as $nearbyArea)
                                                                @if(is_string($nearbyArea) && !empty($nearbyArea))
                                                                    <li class="list-group-item">{{ htmlspecialchars($nearbyArea) }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="form-control-static">No nearby areas provided</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Nearby Area Categories -->
                                            <div class="card">

                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Nearby Area Categories</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editPfour2', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    @php
                                                        $nearbyAreas = old('nearby_areas', $hotel->nearby_areas ?? []);
                                                        
                                                        // Ensure it's always an array
                                                        if (is_string($nearbyAreas)) {
                                                            $decoded = json_decode($nearbyAreas, true);
                                                            $nearbyAreas = is_array($decoded) ? $decoded : [];
                                                        } elseif (!is_array($nearbyAreas)) {
                                                            $nearbyAreas = [];
                                                        }
                                                    @endphp

                                                    @if(!empty($nearbyAreas) && is_array($nearbyAreas))
                                                        @foreach($nearbyAreas as $categoryKey => $values)
                                                            @php
                                                                // Format category name (transport___airport => Transport & Airport)
                                                                $formattedCategory = ucwords(str_replace(['___', '_'], [' & ', ' '], $categoryKey));
                                                                
                                                                // Ensure values is an array
                                                                if (!is_array($values)) {
                                                                    continue;
                                                                }
                                                            @endphp

                                                            @if(isset($values['name']) && is_array($values['name']))
                                                                @foreach($values['name'] as $index => $name)
                                                                    <div class="mb-2">
                                                                        <strong>{{ $formattedCategory }} Name:</strong> {{ $name }}<br>
                                                                        <strong>{{ $formattedCategory }} Distance:</strong> {{ $values['distance'][$index] ?? '' }}
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                        @endforeach
                                                    @else
                                                        <p class="form-control-static">No nearby areas provided</p>
                                                    @endif

                                                </div>
                                            </div>


                                        </div>


                                        <style>
                                            .card {
                                                border: none;
                                                border-radius: 10px;
                                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                                margin-bottom: 20px;
                                            }
                                            .card-header {
                                                background-color: #f8f9fa;
                                                border-bottom: 1px solid #e9ecef;
                                                border-radius: 10px 10px 0 0;
                                                padding: 15px 20px;
                                            }
                                            .card-body {
                                                padding: 20px;
                                            }
                                            .section-title {
                                                font-size: 1.5rem;
                                                font-weight: 600;
                                                color: #343a40;
                                                margin-bottom: 15px;
                                            }
                                            .form-label {
                                                font-weight: 600;
                                                font-size: 1.1rem;
                                                color: #1a252f;
                                                margin-bottom: 8px;
                                            }
                                            .form-control-static {
                                                font-weight: 400;
                                                font-size: 1rem;
                                                color: #495057;
                                                line-height: 1.5;
                                                margin-bottom: 15px;
                                                padding-bottom: 10px;
                                                border-bottom: 1px solid #e9ecef;
                                            }
                                            .photo-grid {
                                                display: flex;
                                                flex-wrap: wrap;
                                                gap: 10px;
                                            }
                                            .photo-thumbnail {
                                                width: 100px;
                                                height: 100px;
                                                object-fit: cover;
                                                border-radius: 5px;
                                                border: 1px solid #e9ecef;
                                            }
                                            .btn-edit {
                                                background: linear-gradient(45deg, #007bff, #00b7eb);
                                                border: none;
                                                padding: 12px 30px;
                                                font-size: 1.1rem;
                                                font-weight: 500;
                                                border-radius: 8px;
                                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                                color: #fff;
                                                transition: all 0.3s ease;
                                            }
                                            .btn-edit:hover {
                                                background: linear-gradient(45deg, #0056b3, #0098c7);
                                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                                                color: #fff;
                                            }
                                        </style>

                                        <div class="tab-pane" id="Photos" style="padding: 20px;">
                                            <!-- Hotel Photos -->
                                            <div class="card">

                                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 class="section-title">Hotel Photos</h3>
                                                    <a href="{{ route('vendor-admin.hotel.editPthree', $hotel) }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        @php
                                                            // Updated hotel photo categories
                                                            $photoFields = [
                                                                'featured_photo',           // single
                                                                'entrance_gate_photos',
                                                                'lift_stairs_photos',
                                                                'rooftop_photos',
                                                                'spa_photos',
                                                                'gym_photos',
                                                                'amenities_photos',
                                                            ];
                                                            $labels = [
                                                                'featured_photo' => 'Featured Photo / Thumbnail (Dynamically Selected)',
                                                                'entrance_gate_photos' => 'Hotel Exterior (Building, Signboard, Entrance Gate/Main Gate)',
                                                                'lift_stairs_photos' => 'Common Areas (Reception, Lobby, Public Area, Lift, Stairs, Wheelchair Area, Parking Lot, Sitting Area, Garden Area)',
                                                                'rooftop_photos' => 'Facilities (Restaurants, Conference Hall, Swimming Pool, Rooftop, Souvenir Shop)',
                                                                'spa_photos' => 'Leisure & Wellness (Gym, Game Room, Kids Zone, Spa & Massage Center, Bar)',
                                                                'gym_photos' => 'Guest Rooms (All room types in the hotel/property)',
                                                                'amenities_photos' => 'Amenities & Services (Car, Bus, CCTV, Fire Extinguisher, Surveillance, Room Amenities)',
                                                            ];
                                                        @endphp

                                                        @foreach($photoFields as $field)
                                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">{{ $labels[$field] }}</label>
                                                                    @php
                                                                        $photos = json_decode($hotel->$field, true);
                                                                        if (is_array($photos)) {
                                                                            $photos = array_map(function ($photo) {
                                                                                return str_replace("\\", "/", $photo);
                                                                            }, $photos);
                                                                        } else {
                                                                            $photos = [];
                                                                        }
                                                                    @endphp
                                                                    @if(!empty($photos))
                                                                        <div class="photo-grid">
                                                                            @foreach($photos as $photoIndex => $photo)
                                                                                <img src="{{ asset('/' . $photo) }}"
                                                                                     alt="{{ $labels[$field] }} {{ $photoIndex + 1 }}"
                                                                                     class="photo-thumbnail">
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <p class="form-control-static">No photos provided</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Button -->

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
                      <div class class="form-check">
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
        document.addEventListener('DOMContentLoaded', () => {
            const uploadedImages = {};

            function initializeMultipleUpload(container) {
                const fileInput = container.querySelector('.multiple-file-input');
                const thumbnailGallery = container.querySelector('.multiple-thumbnail-gallery');
                const containerId = container.id || `dynamic-${Date.now()}`; // Fallback ID for dynamic containers

                uploadedImages[containerId] = [];

                fileInput.addEventListener('change', function (event) {
                    console.log(`File input changed in container: ${containerId}`);
                    const files = event.target.files;
                    for (let file of files) {
                        if (!file.type.startsWith('image/')) {
                            console.warn(`File ${file.name} is not an image`);
                            continue;
                        }
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const thumbnailItem = document.createElement('div');
                            thumbnailItem.classList.add('multiple-thumbnail-item');
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            const removeBtn = document.createElement('button');
                            removeBtn.innerHTML = '×';
                            removeBtn.classList.add('multiple-remove-btn');
                            removeBtn.addEventListener('click', () => {
                                thumbnailItem.remove();
                                const index = uploadedImages[containerId].indexOf(file);
                                if (index > -1) {
                                    uploadedImages[containerId].splice(index, 1);
                                    console.log(`Removed file ${file.name} from container ${containerId}`);
                                }
                            });
                            thumbnailItem.appendChild(img);
                            thumbnailItem.appendChild(removeBtn);
                            thumbnailGallery.appendChild(thumbnailItem);
                            uploadedImages[containerId].push(file);
                            console.log(`Added thumbnail for file ${file.name} in container ${containerId}`);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Initialize for all upload containers dynamically
            const uploadContainers = document.querySelectorAll('.multiple-upload-container');
            uploadContainers.forEach(container => {
                console.log(`Initializing upload container: ${container.id}`);
                initializeMultipleUpload(container);
            });

            // Handle Add More button for custom facilities
            const facilityContainer = document.getElementById('facility-container');
            const addMoreBtn = document.getElementById('add-more-btn');

            addMoreBtn.addEventListener('click', function (event) {
                event.preventDefault();
                console.log('Add More button clicked for custom facilities');

                const facilityField = document.createElement('div');
                facilityField.classList.add('input-field', 'd-flex', 'align-items-center', 'mb-3');
                facilityField.style.gap = '10px';
                const uniqueId = Date.now();
                facilityField.innerHTML = `
                    <div class="form-group flex-grow-1">
                        <label for="custom_facility_${uniqueId}">Facility Name</label>
                        <input class="form-control" type="text" name="custom_facilities[]" id="custom_facility_${uniqueId}" placeholder="Enter facility name" />
                    </div>
                    <div class="form-group">
                        <label for="custom_facility_icon_${uniqueId}">Facility Icon</label>
                        <div class="multiple-upload-container" id="upload-container-dynamic-${uniqueId}">
                            <input class="form-control multiple-file-input" type="file" name="custom_facilities_icon[]" id="custom_facility_icon_${uniqueId}" accept="image/*" />
                            <label class="upload-label">Browse Image</label>
                            <div class="multiple-thumbnail-gallery"></div>
                        </div>
                        @error('custom_facilities_icon.*') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
`;

                // Initialize file upload for the new field
                const uploadContainer = facilityField.querySelector('.multiple-upload-container');
                initializeMultipleUpload(uploadContainer);

                // Add delete functionality
                const deleteBtn = facilityField.querySelector('.delete-btn');
                deleteBtn.addEventListener('click', () => {
                    console.log('Delete button clicked for facility field');
                    facilityField.remove();
                });

                facilityContainer.appendChild(facilityField);
                console.log('New facility field added to container');
            });
        });
    </script>

    <script type="text/javascript">
        document.getElementById("site-off")?.addEventListener("change", function () {
            let checkboxes = document.querySelectorAll(".checkbox-item");
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById("site-off").checked;
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            const checkbox = document.getElementById("property-ownership");
            const options = document.getElementById("ownership-options");

            checkbox?.addEventListener("change", () => {
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
        document.getElementById('apartment-count')?.addEventListener('change', function () {
            const count = parseInt(this.value);
            const dynamicFormsContainer = document.getElementById('dynamic-forms');
            dynamicFormsContainer.innerHTML = '';

            if (count > 0) {
                for (let i = 1; i <= count; i++) {
                    const formGroup = document.createElement('div');
                    formGroup.classList.add('apartment-form');

                    const apartmentNumberLabel = document.createElement('label');
                    apartmentNumberLabel.textContent = `Apartment ${i} Number:`;
                    apartmentNumberLabel.setAttribute('for', `apartment-${i}-number`);
                    const apartmentNumberInput = document.createElement('input');
                    apartmentNumberInput.type = 'text';
                    apartmentNumberInput.id = `apartment-${i}-number`;
                    apartmentNumberInput.name = `apartments[${i}][number]`;
                    apartmentNumberInput.classList.add('form-control');

                    const apartmentFloorLabel = document.createElement('label');
                    apartmentFloorLabel.textContent = `Apartment ${i} Floor Number:`;
                    apartmentFloorLabel.setAttribute('for', `apartment-${i}-floor`);
                    const apartmentFloorInput = document.createElement('input');
                    apartmentFloorInput.type = 'text';
                    apartmentFloorInput.id = `apartment-${i}-floor`;
                    apartmentFloorInput.name = `apartments[${i}][floor]`;
                    apartmentFloorInput.classList.add('form-control');

                    const apartmentNameLabel = document.createElement('label');
                    apartmentNameLabel.textContent = `Apartment/Rooms ${i} Name:`;
                    apartmentNameLabel.setAttribute('for', `apartment-${i}-name`);
                    const apartmentNameInput = document.createElement('input');
                    apartmentNameInput.type = 'text';
                    apartmentNameInput.id = `apartment-${i}-name`;
                    apartmentNameInput.name = `apartments[${i}][name]`;
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
        document.querySelector('form').addEventListener('submit', function (event) {
            console.log('Form is submitting with data:', new FormData(this));
        });
    </script>

    <script>
        const radioButtons = document.querySelectorAll('input[name="showFields"]');
        const additionalFields = document.getElementById('additionalFields');

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
            $('.js-select2').select2();

            $('#propertyOwnershipss')?.on('change', function () {
                const selectedValue = $(this).val();
                const partnerFields = $('.partner-fields');
                const leaseDates = $('.lease-dates');

                partnerFields.slideUp();
                leaseDates.slideUp();

                if (selectedValue === 'Partnership') {
                    partnerFields.slideDown();
                } else if (selectedValue === 'Leased') {
                    leaseDates.slideDown();
                }
            });
        });
    </script>

    <script>
        function initializeBarSelection() {
            const barRadioButtons = document.querySelectorAll('input[name="barOption"]');
            const barSelectContainer = document.getElementById('barSelectContainer');
            const barNumberSelect = document.getElementById('barNumberSelect');

            barRadioButtons.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.value === 'yes') {
                        barSelectContainer.style.display = 'block';
                    } else {
                        barSelectContainer.style.display = 'none';
                        barNumberSelect.value = '';
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', initializeBarSelection);
    </script>

    <script>
        class KidsZoneManager {
            constructor() {
                this.initializeAllKidsZones();
            }

            initializeAllKidsZones() {
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
                            numberSelect.value = '';
                        }
                    });
                });
            }

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

        const kidsZoneManager = new KidsZoneManager();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const yesOption = document.getElementById("yesOption");
            const noOption = document.getElementById("noOption");
            const yesFields = document.getElementById("yesFields");
            const noFields = document.getElementById("noFields");

            yesOption?.addEventListener("change", function () {
                if (this.checked) {
                    yesFields.classList.remove("hidden");
                    noFields.classList.add("hidden");
                }
            });

            noOption?.addEventListener("change", function () {
                if (this.checked) {
                    noFields.classList.remove("hidden");
                    yesFields.classList.add("hidden");
                }
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            divisionSelect = document.getElementById("division");
            districtSelect = document.getElementById("district");
            districtContainer = document.getElementById("districtContainer");
            placeCheckboxList = document.getElementById("placeCheckboxList");
            placeOptions = document.getElementById("placeOptions");

            const data = {
                Hotels: {
                    districts: {
                        "hotel": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],
                        "Luxury Hotels": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],
                        "farmgate": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"]
                    }
                },
                chittagong: {
                    districts: {
                        agrabad: ["Area 1", "Area 2", "Area 3"],
                        halishahar: ["Location X", "Location Y", "Location Z"],
                        patenga: ["Site P", "Site Q", "Site R"]
                    }
                },
                khulna: {
                    districts: {
                        khalishpur: ["Zone 1", "Zone 2", "Zone 3"],
                        sonadanga: ["Point A", "Point B", "Point C"],
                        rupsha: ["Spot X", "Spot Y", "Spot Z"]
                    }
                }
            };

            divisionSelect?.addEventListener("change", function () {
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
                }
            });

            districtSelect?.addEventListener("change", function () {
                const division = divisionSelect.value;
                const district = this.value;
                placeOptions.innerHTML = "";

                if (data[division] && data[division].districts[district]) {
                    placeCheckboxList.style.display = "block";
                    data[division].districts[district].forEach((place, index) => {
                        const listItem = document.createElement("li");
                        const checkboxContainer = document.createElement("div");
                        checkboxContainer.classList.add("form-check");

                        const checkbox = document.createElement("input");
                        checkbox.type = "checkbox";
                        checkbox.classList.add("form-check-input");
                        checkbox.id = `checkbox${index}`;
                        checkbox.value = place;

                        const label = document.createElement("label");
                        label.classList.add("form-check-label");
                        label.htmlFor = `checkbox${index}`;
                        label.textContent = place;

                        checkboxContainer.appendChild(checkbox);
                        checkboxContainer.appendChild(label);
                        listItem.appendChild(checkboxContainer);
                        placeOptions.appendChild(listItem);
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("#facilities-all").addEventListener("change", function () {
                console.log("Facilities Select All toggled");
                const facilitiesCheckboxes = document.querySelectorAll(".checkbox-item-facility");
                facilitiesCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = document.querySelector("#facilities-all").checked;
                    console.log(`Checkbox ${checkbox.id} set to ${checkbox.checked}`);
                });
            });
        });
    </script>

    <script type="text/javascript">
        document.getElementById("check-in-all").addEventListener("change", function () {
            let checkinCheckboxes = document.querySelectorAll(".checkbox-item-checkin");
            checkinCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById("check-in-all").checked;
            });
        });
    </script>

    <script>
        document.getElementById('addRuleBtn').addEventListener('click', function (event) {
            event.preventDefault();
            const formContainer = document.getElementById('formContainer');
            const newField = document.createElement('div');
            newField.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3');
            newField.innerHTML = `
                <div class="form-group">
                    <input type="text" class="form-control" name="custom_check_in_methods[]" placeholder="" required>
                    <button class="delete-btn">Delete</button>
                </div>
            `;
            formContainer.appendChild(newField);
            const deleteBtn = newField.querySelector('.delete-btn');
            deleteBtn.addEventListener('click', function () {
                formContainer.removeChild(newField);
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".radio-group input[type='radio']").forEach(function (radio) {
                radio.addEventListener("change", function () {
                    const targetId = this.getAttribute("data-target");
                    const targetInput = document.getElementById(targetId);
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

    <script type="text/javascript">
        document.querySelector("#property-all").addEventListener("change", function () {
            const propertyCheckboxes = document.querySelectorAll(".checkbox-item-property");
            propertyCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.querySelector("#property-all").checked;
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".add-more").forEach((button) => {
                button.addEventListener("click", function (event) {
                    event.preventDefault();
                    const inputContainer = this.previousElementSibling;
                    const newFormGroup = document.createElement("div");
                    newFormGroup.classList.add("form-group", "mb-1", "d-flex", "align-items-center");
                    newFormGroup.style.gap = "10px";
                    const inputField = document.createElement("input");
                    inputField.type = "text";
                    inputField.classList.add("form-control");
                    inputField.placeholder = "Enter something";
                    const deleteButton = document.createElement("button");
                    deleteButton.innerText = "Delete";
                    deleteButton.classList.add("delete-btn");
                    deleteButton.addEventListener("click", function () {
                        newFormGroup.remove();
                    });
                    newFormGroup.appendChild(inputField);
                    newFormGroup.appendChild(deleteButton);
                    inputContainer.parentNode.insertBefore(newFormGroup, this);
                });
            });
        });
    </script>

    <script>
        const hotelFacilitiesLabelsMap = {
            'General Services': ['General Services Name'],
            'Activities & Entertainment': ['Activities & Entertainment Name'],
            'Safety & Security': ['Security Feature Name'],
            'Technology, Media & Wi-Fi': ['Technology, Media & Wi-Fi Name'],
            'Bedroom Features': ['Bedroom Feature Name'],
            'Bathroom Amenities': ['Bathroom Amenity'],
            'Living Room Features': ['Living Room Feature'],
            'Kitchen Facilities': ['Kitchen Facility'],
            'Food & Beverages': ['Food & Beverage Option'],
            'Parking Availability': ['Parking Option'],
            'View from the Hotel': ['View Type'],
            'Front Desk Services': ['Front Desk Service'],
            'Housekeeping & Cleaning': ['Housekeeping & Cleaning Service'],
            'Room Amenities': ['Room Amenity'],
            'Business & Meeting Services': ['Business & Meeting Service'],
            'Languages Spoken': ['Language']
        };

        const hotelFacilitiesCategoryKeysMap = {
            'general_services': 'General Services',
            'activities___entertainment': 'Activities & Entertainment',
            'safety___security': 'Safety & Security',
            'technology__media___wi_fi': 'Technology, Media & Wi-Fi',
            'bedroom_features': 'Bedroom Features',
            'bathroom_amenities': 'Bathroom Amenities',
            'living_room_features': 'Living Room Features',
            'kitchen_facilities': 'Kitchen Facilities',
            'food___beverages': 'Food & Beverages',
            'parking_availability': 'Parking Availability',
            'view_from_the_hotel': 'View from the Hotel',
            'front_desk_services': 'Front Desk Services',
            'housekeeping___cleaning': 'Housekeeping & Cleaning',
            'room_amenities': 'Room Amenities',
            'business___meeting_services': 'Business & Meeting Services',
            'languages_spoken': 'Languages Spoken'
        };

        const hotelFacilitySelector = document.getElementById('hotelFacilitySelector');
        const hotelFormContainer = document.getElementById('dynamicFieldsContainerHotelFacility');
        let currentFacilityValue = '';

        function createHotelFieldGroup(category, value = '') {
            const labels = hotelFacilitiesLabelsMap[category];
            if (!labels) return;

            const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
            const uniqueId = `hotel-facility-${categoryKey}-${Date.now()}`;

            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.setAttribute('id', uniqueId);
            newFieldGroup.innerHTML = `
            <div class="form-group">
                <label for="input-${uniqueId}">${labels[0]}</label>
                <input type="text" class="form-control" id="input-${uniqueId}" name="hotel_facilities[${categoryKey}][]" placeholder="Enter ${labels[0]}" value="${value}" required>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2 delete-hotel-btn">Delete</button>
        `;

            let categoryWrapper = document.getElementById(`wrapper-${categoryKey}`);
            if (!categoryWrapper) {
                categoryWrapper = document.createElement('div');
                categoryWrapper.classList.add('col-12', 'mb-3');
                categoryWrapper.id = `wrapper-${categoryKey}`;
                categoryWrapper.innerHTML = `<h5>${category}</h5><div class="row"></div>`;
                hotelFormContainer.appendChild(categoryWrapper);
            }

            const row = categoryWrapper.querySelector('.row');
            row.appendChild(newFieldGroup);

            newFieldGroup.querySelector('.delete-hotel-btn').addEventListener('click', function () {
                row.removeChild(newFieldGroup);
                if (row.children.length === 0) {
                    hotelFormContainer.removeChild(categoryWrapper);
                }
            });
        }

        // For dropdown selection
        if (hotelFacilitySelector) {
            hotelFacilitySelector.addEventListener('change', function () {
                currentFacilityValue = this.value;
                if (!hotelFacilitiesLabelsMap[currentFacilityValue]) return;
                createHotelFieldGroup(currentFacilityValue);
            });
        }

        // For Add More button
        const addHotelFacilityBtn = document.getElementById('addHotelFacility');
        if (addHotelFacilityBtn) {
            addHotelFacilityBtn.addEventListener('click', function (event) {
                event.preventDefault();
                if (!currentFacilityValue || !hotelFacilitiesLabelsMap[currentFacilityValue]) {
                    alert("Please select a valid facility category first.");
                    return;
                }
                createHotelFieldGroup(currentFacilityValue);
            });
        }

        // Now load existing hotel facilities if available
        const hotelFacilitiesData = {!! json_encode($hotelFacilities ?? []) !!};
        hotelFacilitiesData.forEach(facility => {
            const categoryKey = facility.category; // example: general_services
            const name = facility.name;

            const category = hotelFacilitiesCategoryKeysMap[categoryKey]; // convert back to readable category

            if (category && hotelFacilitiesLabelsMap[category]) {
                createHotelFieldGroup(category, name);
            }
        });
    </script>



    <script>
        const sectionLabelsMap = {
            'Restaurant & Cafe': ['Restaurant & Cafe Name', 'Distance'],
            'Entertainment & Attraction Point': ['Entertainment & Attraction Point', 'Distance'],
            'Hospital & Police Station': ['Hospital & Police Station Name', 'Distance'],
            'Transport & Airport': ['Transport & Airport Name', 'Distance'],
            'Shopping & ATM': ['Shopping & ATM', 'Distance']
        };

        const areaSelector = document.getElementById('areaSelector');
        const formContainer = document.getElementById('dynamicFieldsContainer');
        let currentSelectedValue = '';

        function createFieldGroup(category, nameValue = '', distanceValue = '') {
            const labels = sectionLabelsMap[category];
            const uniqueId = `nearby-area-${category.replace(/[^a-zA-Z0-9]/g, '')}-${Date.now()}`;
            const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();

            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.setAttribute('id', uniqueId);
            newFieldGroup.innerHTML = `
            <div class="form-group">
                <label for="input-name-${uniqueId}">${labels[0]}</label>
                <input type="text" class="form-control" id="input-name-${uniqueId}"
                    name="nearby_areas[${categoryKey}][name][]"
                    placeholder="Enter ${labels[0]}"
                    value="${nameValue}" required>
            </div>
            <div class="form-group">
                <label for="input-distance-${uniqueId}">${labels[1]}</label>
                <input type="text" class="form-control" id="input-distance-${uniqueId}"
                    name="nearby_areas[${categoryKey}][distance][]"
                    placeholder="Enter ${labels[1]}"
                    value="${distanceValue}" required>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-3 delete-nearby-btn">Delete</button>
        `;

            let categoryWrapper = document.getElementById(`wrapper-${categoryKey}`);
            if (!categoryWrapper) {
                categoryWrapper = document.createElement('div');
                categoryWrapper.classList.add('col-12', 'mb-3');
                categoryWrapper.id = `wrapper-${categoryKey}`;
                categoryWrapper.innerHTML = `<h5>${category}</h5><div class="row"></div>`;
                formContainer.appendChild(categoryWrapper);
            }

            const row = categoryWrapper.querySelector('.row');
            row.appendChild(newFieldGroup);

            newFieldGroup.querySelector('.delete-nearby-btn').addEventListener('click', function () {
                row.removeChild(newFieldGroup);
                if (row.children.length === 0) {
                    formContainer.removeChild(categoryWrapper);
                }
            });
        }

        if (areaSelector) {
            areaSelector.addEventListener('change', function () {
                currentSelectedValue = this.value;
                if (!sectionLabelsMap[currentSelectedValue]) return;
                createFieldGroup(currentSelectedValue);
            });
        }

        const addNearbyAreaBtn = document.getElementById('addNearbyAreaBtn');
        if (addNearbyAreaBtn) {
            addNearbyAreaBtn.addEventListener('click', function (event) {
                event.preventDefault();
                if (!currentSelectedValue || !sectionLabelsMap[currentSelectedValue]) {
                    alert("Please select a valid nearby area category first.");
                    return;
                }
                createFieldGroup(currentSelectedValue);
            });
        }

        // 💥 Show existing data
        function populateExistingNearbyAreas(existingData) {
            if (!existingData) return;

            Object.keys(existingData).forEach(function (categoryKey) {
                const formattedCategory = categoryKey.replace(/_/g, ' ').replace(/\s+/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

                // Find the real section label
                let actualCategory = '';
                Object.keys(sectionLabelsMap).forEach(section => {
                    const sectionKey = section.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
                    if (sectionKey === categoryKey) {
                        actualCategory = section;
                    }
                });

                if (!actualCategory) {
                    console.warn(`Category not found for key: ${categoryKey}`);
                    return;
                }

                const names = existingData[categoryKey]['name'] || [];
                const distances = existingData[categoryKey]['distance'] || [];

                names.forEach((name, index) => {
                    const distance = distances[index] || '';
                    createFieldGroup(actualCategory, name, distance);
                });
            });
        }

        // Call this after page load
        document.addEventListener('DOMContentLoaded', function () {
            const existingNearbyAreas = @json($hotel->nearby_areas);
            populateExistingNearbyAreas(existingNearbyAreas);
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('custom-checkin-wrapper');
            const addBtn = document.getElementById('add-checkin-rule');

            // Add new custom field
            addBtn.addEventListener('click', () => {
                const group = document.createElement('div');
                group.className = 'form-group mb-2 d-flex align-items-center';

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'custom_check_in_rules[]';
                input.className = 'form-control';
                input.placeholder = 'Enter something';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger btn-sm ms-2 remove-checkin';
                removeBtn.textContent = 'Delete';
                removeBtn.addEventListener('click', () => group.remove());

                group.appendChild(input);
                group.appendChild(removeBtn);
                wrapper.appendChild(group);
            });

            // Delegate delete clicks
            wrapper.addEventListener('click', e => {
                if (e.target.classList.contains('remove-checkin')) {
                    e.target.closest('.form-group').remove();
                }
            });
        });
    </script>

@endsection
