@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Vendor Details</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.vendor.edit', $vendor->vendor_id) }}" class="btn btn-primary">
                                    <em class="icon ni ni-edit"></em> Edit
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @php
                            // Helper function to get value
                            $getValue = function($key, $default = 'N/A') use ($vendor) {
                                $value = $vendor->$key ?? null;
                                if ($value === null || $value === '') return $default;
                                return $value;
                            };

                            // Helper to format boolean
                            $formatBool = function($value) {
                                return $value ? 'Yes' : 'No';
                            };

                            // Cafe names - already cast as array in Property model
                            $cafeNames = is_array($vendor->cafe_restaurant_names) ? $vendor->cafe_restaurant_names : [];

                            $vendorModel = \App\Models\Vendor::where('id', $vendor->vendor_id)->first();
                        @endphp

                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row gy-4">
                                    <!-- Property Name -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Property Name</label>
                                            <div class="form-control-plaintext">{{ $getValue('property_name') }}</div>
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Country Name</label>
                                            <div class="form-control-plaintext">{{ $getValue('country_name', 'Bangladesh') }}</div>
                                        </div>
                                    </div>

                                    <!-- District -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">District Name</label>
                                            <div class="form-control-plaintext">{{ $getValue('district_name') }}</div>
                                        </div>
                                    </div>

                                    <!-- City/Town/Village -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">City/Town/Village</label>
                                            <div class="form-control-plaintext">{{ $getValue('city_town_village') }}</div>
                                        </div>
                                    </div>

                                    <!-- Postcode -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Postcode</label>
                                            <div class="form-control-plaintext">{{ $getValue('postcode') }}</div>
                                        </div>
                                    </div>

                                    <!-- House Number -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">House Number</label>
                                            <div class="form-control-plaintext">{{ $getValue('house_number') }}</div>
                                        </div>
                                    </div>

                                    <!-- Road Number/Name -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Road Number/Name (If any)</label>
                                            <div class="form-control-plaintext">{{ $getValue('road_number_name') }}</div>
                                        </div>
                                    </div>

                                    <!-- Total Capacity -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Total Capacity Of the Hotel/Property</label>
                                            <div class="form-control-plaintext">{{ $getValue('total_capacity') }}</div>
                                        </div>
                                    </div>

                                    <!-- Total Car Parking -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Total Car Parking's</label>
                                            <div class="form-control-plaintext">{{ $getValue('car_parking') }}</div>
                                        </div>
                                    </div>

                                    <!-- Reception -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Reception (If any)</label>
                                            <div class="form-control-plaintext">{{ $formatBool($vendor->has_reception ?? false) }}</div>
                                        </div>
                                    </div>

                                    <!-- Total Lifts -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Total Number of Lifts / Elevators</label>
                                            <div class="form-control-plaintext">{{ $getValue('elevators', '0') }}</div>
                                        </div>
                                    </div>

                                    <!-- Total Generators -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Total Number of Generators</label>
                                            <div class="form-control-plaintext">{{ $getValue('generators', '0') }}</div>
                                        </div>
                                    </div>

                                    <!-- Total Fire Exits -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Total Fire Exits</label>
                                            <div class="form-control-plaintext">{{ $getValue('fire_exits', '0') }}</div>
                                        </div>
                                    </div>

                                    <!-- Wheelchair Access -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Wheel Chair Access Gate (If Any)</label>
                                            <div class="form-control-plaintext">{{ $formatBool($vendor->wheelchair_access ?? false) }}</div>
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
                                                        <span class="count">{{ (int)$getValue('male_housekeeping', 0) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="counter-card">
                                                <div>
                                                    <h4>Total Female</h4>
                                                    <div class="counter">
                                                        <span class="count">{{ (int)$getValue('female_housekeeping', 0) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="total-box">
                                                Total House Keeping & Cleaners <br>
                                                <span class="total-count">
                                                    {{ (int)$getValue('male_housekeeping', 0) + (int)$getValue('female_housekeeping', 0) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kids Zone -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Kids Zone</label>
                                            <div class="form-control-plaintext">
                                                {{ $formatBool($vendor->has_kids_zone ?? false) }}
                                                @if($vendor->has_kids_zone ?? false)
                                                    (Count: {{ $getValue('kids_zone_count', '0') }})
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">View from Hotel / Property</label>
                                            <div class="form-control-plaintext">{{ $getValue('view_type') }}</div>
                                        </div>
                                    </div>

                                    <!-- Security Guards -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Number of Security Guards</label>
                                            <div class="form-control-plaintext">{{ $getValue('security_guards', '0') }}</div>
                                        </div>
                                    </div>

                                    <!-- Cafe & Restaurants -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Cafe & Restaurants (If any)</label>
                                            <div class="form-control-plaintext">
                                                {{ $formatBool($vendor->has_cafe_restaurant ?? false) }}
                                                @if($vendor->has_cafe_restaurant ?? false)
                                                    <br><small>Count: {{ $getValue('cafe_restaurant_count', '0') }}</small>
                                                    @if(count($cafeNames) > 0)
                                                        <br><small>
                                                            Names: {{ implode(', ', $cafeNames) }}
                                                        </small>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pool -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Pool (If any)</label>
                                            <div class="form-control-plaintext">
                                                {{ $formatBool($vendor->has_pool ?? false) }}
                                                @if($vendor->has_pool ?? false)
                                                    (Count: {{ $getValue('pool_count', '0') }})
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bar -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Bar (If any)</label>
                                            <div class="form-control-plaintext">
                                                {{ $formatBool($vendor->has_bar ?? false) }}
                                                @if($vendor->has_bar ?? false)
                                                    (Count: {{ $getValue('bar_count', '0') }})
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gym -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Gym (If any)</label>
                                            <div class="form-control-plaintext">
                                                {{ $formatBool($vendor->has_gym ?? false) }}
                                                @if($vendor->has_gym ?? false)
                                                    (Count: {{ $getValue('gym_count', '0') }})
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Party Center -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Party Center (If any)</label>
                                            <div class="form-control-plaintext">
                                                {{ $formatBool($vendor->has_party_center ?? false) }}
                                                @if($vendor->has_party_center ?? false && $getValue('party_center_details') !== 'N/A')
                                                    <br><small>{{ $getValue('party_center_details') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Conference Hall -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Conference Hall (If any)</label>
                                            <div class="form-control-plaintext">
                                                {{ $formatBool($vendor->has_conference_hall ?? false) }}
                                                @if($vendor->has_conference_hall ?? false && $getValue('conference_hall_details') !== 'N/A')
                                                    <br><small>{{ $getValue('conference_hall_details') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Company Logo -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Logo Of Company</label>
                                            @if(!empty($vendor->company_logo))
                                                <div class="mt-2">
                                                    <img style="height: auto;width: 120px" src="{{ asset($vendor->company_logo) }}" alt="Company Logo">
                                                </div>
                                            @else
                                                <div class="form-control-plaintext">N/A</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <div class="form-control-plaintext">{{ $vendorModel->email ?? 'N/A' }}</div>
                                        </div>
                                    </div>

                                </div> <!-- /.row -->
                            </div> <!-- /.card-inner -->
                        </div> <!-- /.card -->

                        <div class="mt-3">
                            <a href="{{ route('super-admin.vendor.index') }}" class="btn btn-secondary">Back to List</a>
                            <a href="{{ route('super-admin.vendor.edit', $vendor->vendor_id) }}" class="btn btn-primary">
                                <em class="icon ni ni-edit"></em> Edit Vendor
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

