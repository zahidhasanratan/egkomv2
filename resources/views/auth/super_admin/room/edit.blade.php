@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Room</h3>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                
                                
                                <style>
                                    .is-invalid {
                                        border-color: #dc3545 !important;
                                        background-color: #fff5f5 !important;
                                    }
                                    .is-invalid:focus {
                                        border-color: #dc3545 !important;
                                        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
                                    }
                                </style>
                                
                                <form action="{{ route('super-admin.room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input name="hotel_id" value="{{ $hotel }}" type="hidden">
                                    <input name="active_tab" id="active_tab" value="{{ old('active_tab', 'tabItem3') }}" type="hidden">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link {{ old('active_tab', 'tabItem3') === 'tabItem3' ? 'active' : '' }}" data-bs-toggle="tab" href="#tabItem3" data-tab="tabItem3">Room Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ old('active_tab', 'tabItem3') === 'tabItem4' ? 'active' : '' }}" data-bs-toggle="tab" href="#tabItem4" data-tab="tabItem4">Room Facilities</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ old('active_tab', 'tabItem3') === 'Photos' ? 'active' : '' }}" data-bs-toggle="tab" href="#Photos" data-tab="Photos">Room Photos</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="room-activate d-flex justify-content-end">
                                            <div class="col-md-3 col-lg-3 col-xxl-3">
                                                <div class="form-group" style="margin-bottom: 0px;">
                                                    <label class="form-label">Room Active/Inactive Button</label>
                                                    <div class="form-check form-switch custom-control custom-switch checked" style="padding-left: 2rem; margin-bottom: 0px;">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="is_active" {{ old('is_active', $room->is_active) ? 'checked' : '' }}>
                                                    </div>
                                                    <div id="alertMessage" style="display: none; color: red; margin-top:0px;"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Room Description -->
                                        <div class="tab-pane {{ old('active_tab', 'tabItem3') === 'tabItem3' ? 'active' : '' }}" id="tabItem3">
                                            <div class="row gy-4">
                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Name</label>
                                                        <input type="text" class="form-control" name="name" value="{{ old('name', $room->name) }}" placeholder="Room Name" required>
                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Number</label>
                                                        <input type="text" class="form-control" name="number" value="{{ old('number', $room->number) }}" placeholder="Room number" required>
                                                        @error('number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Floor Number</label>
                                                        <input type="text" class="form-control" name="floor_number" value="{{ old('floor_number', $room->floor_number) }}" placeholder="Room Floor Number" required>
                                                        @error('floor_number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row gy-4">
                                                    <div class="price-card-room">
                                                        <h3 class="can-tittle">Price Section</h3>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Room Price (Per Night)</label>
                                                            <input type="number" class="form-control" name="price_per_night" value="{{ old('price_per_night', $room->price_per_night) }}" placeholder="Ex: BDT 1,500" required>
                                                            @error('price_per_night')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Weekend Price</label>
                                                            <input type="number" class="form-control" name="weekend_price" value="{{ old('weekend_price', $room->weekend_price) }}" placeholder="Ex: BDT 1,500">
                                                            @error('weekend_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Holiday Price</label>
                                                            <input type="number" class="form-control" name="holiday_price" value="{{ old('holiday_price', $room->holiday_price) }}" placeholder="Ex: BDT 1,500">
                                                            @error('holiday_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Discount Type</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="discount_type" id="discountAmount" value="amount" {{ old('discount_type', $room->discount_type) == 'amount' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="discountAmount">Discount by Amount</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="discount_type" id="discountPercentage" value="percentage" {{ old('discount_type', $room->discount_type) == 'percentage' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="discountPercentage">Discount by Percentage (%)</label>
                                                            </div>
                                                            <div class="mt-3 {{ old('discount_type', $room->discount_type) ? '' : 'hidden' }}" id="discountValueField">
                                                                <label for="discount_value" class="form-label">Enter Discount {{ old('discount_type', $room->discount_type) == 'amount' ? 'Amount' : 'Percentage (%)' }}</label>
                                                                <input type="number" class="form-control" name="discount_value" id="discount_value" value="{{ old('discount_value', $room->discount_type == 'amount' ? $room->discount_amount : $room->discount_percentage) }}" placeholder="{{ old('discount_type', $room->discount_type) == 'amount' ? 'Ex: 3500' : 'Ex: 15 %' }}">
                                                                @error('discount_value')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <label class="form-label">Total Person in this room!</label>
                                                        <div class="counter-wrapper">
                                                            <div class="counter-card">
                                                                <div>
                                                                    <div class="counter">
                                                                        <button type="button" class="btn decrease-male">-</button>
                                                                        <span class="count male-count" id="totalPersons">{{ old('total_persons', $room->total_persons) }}</span>
                                                                        <input type="hidden" name="total_persons" id="totalPersonsInput" value="{{ old('total_persons', $room->total_persons) }}">
                                                                        <button type="button" class="btn increase-male">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('total_persons')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Room Availability Calendar -->
                                                <div class="col-md-12 col-lg-12 col-xxl-12">
                                                    <div class="row gy-4">
                                                        <div class="price-card-room">
                                                            <h3 class="can-tittle">Room Availability</h3>
                                                            <p class="text-muted" style="font-size: 14px; margin-top: -10px;">Select dates when this room will be available for booking. The room will only appear on the website on selected dates.</p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Select Available Dates</label>
                                                                @php
                                                                    $existingDates = $room->availability_dates ?? [];
                                                                    $existingDatesJson = json_encode($existingDates);
                                                                @endphp
                                                                <input type="hidden" id="availability_dates_hidden" name="availability_dates" value="{{ old('availability_dates', $existingDatesJson) }}">
                                                                <input type="text" class="form-control" id="availability_dates_display" placeholder="No dates selected yet. Select dates from the calendar below." readonly style="margin-bottom: 15px; background-color: #f8f9fa; border: 1px solid #e0e0e0; padding: 12px; font-size: 14px; min-height: 45px;">
                                                                <small class="form-text text-muted" style="display: block; margin-bottom: 15px; color: #6c757d;">
                                                                    <strong>How to select dates:</strong><br>
                                                                    • <strong>Drag</strong> from one date to another to select a range<br>
                                                                    • <strong>Click</strong> individual dates to toggle selection (click again to deselect)<br>
                                                                    • The room will be available only on selected dates
                                                                </small>
                                                                <div id="availability_calendar_wrapper" style="max-width: 100%; margin: 20px auto; display: block; padding: 20px; background: #fff; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></div>
                                                                <div style="margin-top: 15px; display: flex; gap: 10px; align-items: center;">
                                                                    <button type="button" id="clear_all_dates" class="btn btn-sm btn-secondary" style="background: #6c757d; color: white; border: none; padding: 8px 20px;">
                                                                        <i class="fas fa-times"></i> Clear All
                                                                    </button>
                                                                    <button type="button" id="apply_dates" class="btn btn-sm btn-primary" style="background: #90278e; color: white; border: none; padding: 8px 20px;">
                                                                        <i class="fas fa-check"></i> Apply Selection
                                                                    </button>
                                                                    <span id="selected_dates_count" style="margin-left: 10px; color: #90278e; font-weight: bold;"></span>
                                                                </div>
                                                                @error('availability_dates')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-textarea">Room Description</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control no-resize" name="description" id="default-textarea">{{ old('description', $room->description) }}</textarea>
                                                            @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Size (sq. ft / sq. m)</label>
                                                        <input type="number" class="form-control" name="size" value="{{ old('size', $room->size) }}" placeholder="Ex: 1200 SFT" required>
                                                        @error('size')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-2 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Total Room</label>
                                                        <div class="counter-wrapper">
                                                            <div class="counter-card">
                                                                <div>
                                                                    <div class="counter">
                                                                        <button type="button" class="btn decrease-male">-</button>
                                                                        <span id="totalRooms" class="count male-count">{{ old('total_rooms', $room->total_rooms) }}</span>
                                                                        <input type="hidden" name="total_rooms" id="totalRoomsInput" value="{{ old('total_rooms', $room->total_rooms) }}">
                                                                        <button type="button" class="btn increase-male">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('total_rooms')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-2 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Total Washroom</label>
                                                        <div class="counter-wrapper">
                                                            <div class="counter-card">
                                                                <div>
                                                                    <div class="counter">
                                                                        <button type="button" class="btn decrease-male">-</button>
                                                                        <span id="totalWashrooms" class="count male-count">{{ old('total_washrooms', $room->total_washrooms) }}</span>
                                                                        <input type="hidden" name="total_washrooms" id="totalWashroomsInput" value="{{ old('total_washrooms', $room->total_washrooms) }}">
                                                                        <button type="button" class="btn increase-male">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('total_washrooms')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-2 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Total Beds</label>
                                                        <div class="counter-wrapper">
                                                            <div class="counter-card">
                                                                <div>
                                                                    <div class="counter">
                                                                        <button type="button" class="btn decrease-male">-</button>
                                                                        <span id="totalBeds" class="count male-count">{{ old('total_beds', $room->total_beds) }}</span>
                                                                        <input type="hidden" name="total_beds" id="totalBedsInput" value="{{ old('total_beds', $room->total_beds) }}">
                                                                        <button type="button" class="btn increase-male">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('total_beds')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="wifi_details">WiFi Details/Password</label>
                                                        <input type="text" class="form-control" name="wifi_details" value="{{ old('wifi_details', $room->wifi_details) }}" placeholder="WiFi Details/Password">
                                                        @error('wifi_details')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Room Information</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input" name="room-info-all" id="room-info-all">
                                                                <label class="custom-control-label" for="room-info-all">Select All</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $appliances = old('appliances', is_string($room->appliances) ? (json_decode($room->appliances, true) ?? []) : ($room->appliances ?? []));
                                                        if (!is_array($appliances)) {
                                                            $appliances = [];
                                                        }
                                                        $roomInfo = old('room_info', is_string($room->display_options) ? (json_decode($room->display_options, true) ?? []) : ($room->display_options ?? []));
                                                        if (!is_array($roomInfo)) {
                                                            $roomInfo = [];
                                                        }
                                                    @endphp

                                                    <!-- Room Facilities & Amenities -->
                                                    <h5 class="mt-3 mb-2"><strong>Room Facilities & Amenities</strong></h5>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="AC" {{ in_array('AC', $appliances) ? 'checked' : '' }}> AC</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Smart TV" {{ in_array('Smart TV', $appliances) ? 'checked' : '' }}> Smart TV</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Wi-Fi" {{ in_array('Wi-Fi', $appliances) ? 'checked' : '' }}> Wi-Fi</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Minibar" {{ in_array('Minibar', $appliances) ? 'checked' : '' }}> Minibar</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Safe" {{ in_array('Safe', $appliances) ? 'checked' : '' }}> Safe</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Desk" {{ in_array('Desk', $appliances) ? 'checked' : '' }}> Desk</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Wardrobe" {{ in_array('Wardrobe', $appliances) ? 'checked' : '' }}> Wardrobe</label><br>
                                                    
                                                    <!-- Custom Facilities Container -->
                                                    <div class="custom-appliances-container mt-3" data-section="appliances">
                                                        @php
                                                            $fixedAppliances = ['AC', 'Smart TV', 'Wi-Fi', 'Minibar', 'Safe', 'Desk', 'Wardrobe'];
                                                            $customAppliances = array_diff($appliances, $fixedAppliances);
                                                        @endphp
                                                        @foreach($customAppliances as $customAppliance)
                                                            <label><input type="checkbox" name="custom_appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="{{ $customAppliance }}" checked> {{ $customAppliance }}</label><br>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- Add More Facilities -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-appliance-input" placeholder="Enter custom facility/amenity name">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-appliance-btn">Add</button>
                                                        </div>
                                                    </div>

                                                    <!-- Bed Details -->
                                                    <h5 class="mt-4 mb-2"><strong>Bed Details</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Bed Type</label>
                                                            <select class="form-control" name="room_info[bed_type]">
                                                                <option value="">Select Bed Type</option>
                                                                <option value="King" {{ old('room_info.bed_type', $roomInfo['bed_type'] ?? '') == 'King' ? 'selected' : '' }}>King</option>
                                                                <option value="Queen" {{ old('room_info.bed_type', $roomInfo['bed_type'] ?? '') == 'Queen' ? 'selected' : '' }}>Queen</option>
                                                                <option value="Twin" {{ old('room_info.bed_type', $roomInfo['bed_type'] ?? '') == 'Twin' ? 'selected' : '' }}>Twin</option>
                                                                <option value="Single" {{ old('room_info.bed_type', $roomInfo['bed_type'] ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Number of Beds</label>
                                                            <input type="number" class="form-control" name="room_info[number_of_beds]" value="{{ old('room_info.number_of_beds', $roomInfo['number_of_beds'] ?? '') }}" placeholder="0" min="0">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Custom Bed Type</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="custom-bed-type-input" placeholder="Enter custom bed type">
                                                                <button type="button" class="btn btn-primary btn-sm" id="add-bed-type-btn">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="custom-bed-types-container" class="mt-2">
                                                        @if(!empty($roomInfo['custom_bed_types']))
                                                            @foreach($roomInfo['custom_bed_types'] as $customBedType)
                                                                <label><input type="checkbox" name="room_info[custom_bed_types][]" class="checkbox-item-room-info" value="{{ $customBedType }}" checked> {{ $customBedType }}</label><br>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <!-- Maximum Occupancy -->
                                                    <h5 class="mt-4 mb-2"><strong>Maximum Occupancy</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Adults</label>
                                                            <input type="number" class="form-control" name="room_info[max_adults]" value="{{ old('room_info.max_adults', $roomInfo['max_adults'] ?? '') }}" placeholder="0" min="0">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Children</label>
                                                            <input type="number" class="form-control" name="room_info[max_children]" value="{{ old('room_info.max_children', $roomInfo['max_children'] ?? '') }}" placeholder="0" min="0">
                                                        </div>
                                                    </div>

                                                    <!-- Layout Details -->
                                                    <h5 class="mt-4 mb-2"><strong>Layout Details</strong></h5>
                                                    @php
                                                        $layoutOptions = old('room_info.layout', $roomInfo['layout'] ?? []);
                                                        if (!is_array($layoutOptions)) {
                                                            $layoutOptions = [];
                                                        }
                                                    @endphp
                                                    <label><input type="checkbox" name="room_info[layout][]" class="checkbox-item-room-info" value="Apartment Style" {{ in_array('Apartment Style', $layoutOptions) ? 'checked' : '' }}> Apartment Style</label><br>
                                                    <label><input type="checkbox" name="room_info[layout][]" class="checkbox-item-room-info" value="Suite" {{ in_array('Suite', $layoutOptions) ? 'checked' : '' }}> Suite</label><br>
                                                    <label><input type="checkbox" name="room_info[layout][]" class="checkbox-item-room-info" value="Studio" {{ in_array('Studio', $layoutOptions) ? 'checked' : '' }}> Studio</label><br>
                                                    <label><input type="checkbox" name="room_info[layout][]" class="checkbox-item-room-info" value="Duplex" {{ in_array('Duplex', $layoutOptions) ? 'checked' : '' }}> Duplex</label><br>
                                                    
                                                    <!-- Custom Layout Container -->
                                                    <div class="custom-layout-container mt-3">
                                                        @php
                                                            $fixedLayouts = ['Apartment Style', 'Suite', 'Studio', 'Duplex'];
                                                            $customLayouts = array_diff($layoutOptions, $fixedLayouts);
                                                        @endphp
                                                        @foreach($customLayouts as $customLayout)
                                                            <label><input type="checkbox" name="room_info[layout][]" class="checkbox-item-room-info" value="{{ $customLayout }}" checked> {{ $customLayout }}</label><br>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- Add More Layout -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-layout-input" placeholder="Enter custom layout type">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-layout-btn">Add</button>
                                                        </div>
                                                    </div>

                                                    <!-- View from the Room -->
                                                    <h5 class="mt-4 mb-2"><strong>View from the Room</strong></h5>
                                                    @php
                                                        $viewOptions = old('room_info.view', $roomInfo['view'] ?? []);
                                                        if (!is_array($viewOptions)) {
                                                            $viewOptions = [];
                                                        }
                                                    @endphp
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="Sea View" {{ in_array('Sea View', $viewOptions) ? 'checked' : '' }}> Sea View</label><br>
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="City View" {{ in_array('City View', $viewOptions) ? 'checked' : '' }}> City View</label><br>
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="Garden View" {{ in_array('Garden View', $viewOptions) ? 'checked' : '' }}> Garden View</label><br>
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="Partial View" {{ in_array('Partial View', $viewOptions) ? 'checked' : '' }}> Partial View</label><br>
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="No View" {{ in_array('No View', $viewOptions) ? 'checked' : '' }}> No View</label><br>
                                                    
                                                    <!-- Custom View Container -->
                                                    <div class="custom-view-container mt-3">
                                                        @php
                                                            $fixedViews = ['Sea View', 'City View', 'Garden View', 'Partial View', 'No View'];
                                                            $customViews = array_diff($viewOptions, $fixedViews);
                                                        @endphp
                                                        @foreach($customViews as $customView)
                                                            <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="{{ $customView }}" checked> {{ $customView }}</label><br>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- Add More View -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-view-input" placeholder="Enter custom view type">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-view-btn">Add</button>
                                                        </div>
                                                    </div>

                                                    <!-- Bathroom Details -->
                                                    <h5 class="mt-4 mb-2"><strong>Bathroom Details</strong></h5>
                                                    @php
                                                        $bathroomOptions = old('room_info.bathroom', $roomInfo['bathroom'] ?? []);
                                                        if (!is_array($bathroomOptions)) {
                                                            $bathroomOptions = [];
                                                        }
                                                    @endphp
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Attached" {{ in_array('Attached', $bathroomOptions) ? 'checked' : '' }}> Attached</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Private" {{ in_array('Private', $bathroomOptions) ? 'checked' : '' }}> Private</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Shower" {{ in_array('Shower', $bathroomOptions) ? 'checked' : '' }}> Shower</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Bathtub" {{ in_array('Bathtub', $bathroomOptions) ? 'checked' : '' }}> Bathtub</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Toiletries" {{ in_array('Toiletries', $bathroomOptions) ? 'checked' : '' }}> Toiletries</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Hot Water" {{ in_array('Hot Water', $bathroomOptions) ? 'checked' : '' }}> Hot Water</label><br>
                                                    
                                                    <!-- Custom Bathroom Container -->
                                                    <div class="custom-bathroom-container mt-3">
                                                        @php
                                                            $fixedBathrooms = ['Attached', 'Private', 'Shower', 'Bathtub', 'Toiletries', 'Hot Water'];
                                                            $customBathrooms = array_diff($bathroomOptions, $fixedBathrooms);
                                                        @endphp
                                                        @foreach($customBathrooms as $customBathroom)
                                                            <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="{{ $customBathroom }}" checked> {{ $customBathroom }}</label><br>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- Add More Bathroom -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-bathroom-input" placeholder="Enter custom bathroom feature">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-bathroom-btn">Add</button>
                                                        </div>
                                                    </div>

                                                    <!-- Kitchen Facilities -->
                                                    <h5 class="mt-4 mb-2"><strong>Kitchen Facilities</strong></h5>
                                                    @php
                                                        $kitchenOptions = old('room_info.kitchen_facilities', $roomInfo['kitchen_facilities'] ?? []);
                                                        if (!is_array($kitchenOptions)) {
                                                            $kitchenOptions = [];
                                                        }
                                                    @endphp
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Fully Equipped" {{ in_array('Fully Equipped', $kitchenOptions) ? 'checked' : '' }}> Fully Equipped</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Partial" {{ in_array('Partial', $kitchenOptions) ? 'checked' : '' }}> Partial</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="None" {{ in_array('None', $kitchenOptions) ? 'checked' : '' }}> None</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Fridge" {{ in_array('Fridge', $kitchenOptions) ? 'checked' : '' }}> Fridge</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Stove" {{ in_array('Stove', $kitchenOptions) ? 'checked' : '' }}> Stove</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Microwave" {{ in_array('Microwave', $kitchenOptions) ? 'checked' : '' }}> Microwave</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Utensils" {{ in_array('Utensils', $kitchenOptions) ? 'checked' : '' }}> Utensils</label><br>
                                                    
                                                    <!-- Custom Kitchen Container -->
                                                    <div class="custom-kitchen-container mt-3">
                                                        @php
                                                            $fixedKitchens = ['Fully Equipped', 'Partial', 'None', 'Fridge', 'Stove', 'Microwave', 'Utensils'];
                                                            $customKitchens = array_diff($kitchenOptions, $fixedKitchens);
                                                        @endphp
                                                        @foreach($customKitchens as $customKitchen)
                                                            <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="{{ $customKitchen }}" checked> {{ $customKitchen }}</label><br>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- Add More Kitchen -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-kitchen-input" placeholder="Enter custom kitchen facility">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-kitchen-btn">Add</button>
                                                        </div>
                                                    </div>

                                                    <!-- Balcony / Terrace Availability -->
                                                    <h5 class="mt-4 mb-2"><strong>Balcony / Terrace Availability</strong></h5>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="room_info[balcony]">
                                                            <option value="">Select Option</option>
                                                            <option value="Yes" {{ old('room_info.balcony', $roomInfo['balcony'] ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ old('room_info.balcony', $roomInfo['balcony'] ?? '') == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <!-- Accessibility Features -->
                                                    <h5 class="mt-4 mb-2"><strong>Accessibility Features</strong></h5>
                                                    @php
                                                        $accessibilityOptions = old('room_info.accessibility', $roomInfo['accessibility'] ?? []);
                                                        if (!is_array($accessibilityOptions)) {
                                                            $accessibilityOptions = [];
                                                        }
                                                    @endphp
                                                    <label><input type="checkbox" name="room_info[accessibility][]" class="checkbox-item-room-info" value="Wheelchair Friendly" {{ in_array('Wheelchair Friendly', $accessibilityOptions) ? 'checked' : '' }}> Wheelchair Friendly</label><br>
                                                    <label><input type="checkbox" name="room_info[accessibility][]" class="checkbox-item-room-info" value="Elevator Access" {{ in_array('Elevator Access', $accessibilityOptions) ? 'checked' : '' }}> Elevator Access</label><br>
                                                    
                                                    <!-- Custom Accessibility Container -->
                                                    <div class="custom-accessibility-container mt-3">
                                                        @php
                                                            $fixedAccessibility = ['Wheelchair Friendly', 'Elevator Access'];
                                                            $customAccessibility = array_diff($accessibilityOptions, $fixedAccessibility);
                                                        @endphp
                                                        @foreach($customAccessibility as $customAcc)
                                                            <label><input type="checkbox" name="room_info[accessibility][]" class="checkbox-item-room-info" value="{{ $customAcc }}" checked> {{ $customAcc }}</label><br>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- Add More Accessibility -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-accessibility-input" placeholder="Enter custom accessibility feature">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-accessibility-btn">Add</button>
                                                        </div>
                                                    </div>

                                                    <!-- Smoking Policy -->
                                                    <h5 class="mt-4 mb-2"><strong>Smoking Policy</strong></h5>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="room_info[smoking_policy]">
                                                            <option value="">Select Policy</option>
                                                            <option value="Smoking Allowed" {{ old('room_info.smoking_policy', $roomInfo['smoking_policy'] ?? '') == 'Smoking Allowed' ? 'selected' : '' }}>Smoking Allowed</option>
                                                            <option value="Non-Smoking" {{ old('room_info.smoking_policy', $roomInfo['smoking_policy'] ?? '') == 'Non-Smoking' ? 'selected' : '' }}>Non-Smoking</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                // Select All functionality
                                                (function initRoomInfoSelectAll() {
                                                    const containers = document.querySelectorAll('.checkbox-section');
                                                    const container = containers[containers.length - 2] || containers[0];
                                                    if (!container) return;

                                                    const selectAll = container.querySelector('#room-info-all');
                                                    if (!selectAll) return;

                                                    container.addEventListener('change', function (e) {
                                                        if (e.target === selectAll) {
                                                            const items = container.querySelectorAll('.checkbox-item-room-info');
                                                            items.forEach(chk => { chk.checked = selectAll.checked; });
                                                            return;
                                                        }

                                                        if (e.target.classList.contains('checkbox-item-room-info')) {
                                                            const items = container.querySelectorAll('.checkbox-item-room-info');
                                                            const checkedCount = container.querySelectorAll('.checkbox-item-room-info:checked').length;
                                                            selectAll.checked = (checkedCount === items.length && items.length > 0);
                                                        }
                                                    });

                                                    const items = container.querySelectorAll('.checkbox-item-room-info');
                                                    const checkedCount = container.querySelectorAll('.checkbox-item-room-info:checked').length;
                                                    selectAll.checked = (checkedCount === items.length && items.length > 0);
                                                })();

                                                // Add More functionality for all categories
                                                function addCustomItem(category, inputId, containerClass, namePrefix) {
                                                    const input = document.getElementById(inputId);
                                                    const value = input.value.trim();
                                                    if (!value) {
                                                        alert('Please enter a value');
                                                        return;
                                                    }

                                                    const container = document.querySelector(containerClass);
                                                    if (!container) return;

                                                    // Check if already exists
                                                    const existing = container.querySelector(`input[value="${value}"]`);
                                                    if (existing) {
                                                        alert('This item already exists!');
                                                        input.value = '';
                                                        return;
                                                    }

                                                    const label = document.createElement('label');
                                                    const checkbox = document.createElement('input');
                                                    checkbox.type = 'checkbox';
                                                    checkbox.name = namePrefix;
                                                    checkbox.value = value;
                                                    checkbox.className = 'checkbox-item-room-info';
                                                    checkbox.checked = true;

                                                    const textNode = document.createTextNode(value);
                                                    label.appendChild(checkbox);
                                                    label.appendChild(textNode);
                                                    label.appendChild(document.createElement('br'));

                                                    container.appendChild(label);
                                                    input.value = '';
                                                }

                                                // Event listeners for Add More buttons
                                                document.getElementById('add-layout-btn')?.addEventListener('click', function() {
                                                    addCustomItem('layout', 'custom-layout-input', '.custom-layout-container', 'room_info[layout][]');
                                                });

                                                document.getElementById('add-view-btn')?.addEventListener('click', function() {
                                                    addCustomItem('view', 'custom-view-input', '.custom-view-container', 'room_info[view][]');
                                                });

                                                document.getElementById('add-bathroom-btn')?.addEventListener('click', function() {
                                                    addCustomItem('bathroom', 'custom-bathroom-input', '.custom-bathroom-container', 'room_info[bathroom][]');
                                                });

                                                document.getElementById('add-kitchen-btn')?.addEventListener('click', function() {
                                                    addCustomItem('kitchen', 'custom-kitchen-input', '.custom-kitchen-container', 'room_info[kitchen_facilities][]');
                                                });

                                                document.getElementById('add-accessibility-btn')?.addEventListener('click', function() {
                                                    addCustomItem('accessibility', 'custom-accessibility-input', '.custom-accessibility-container', 'room_info[accessibility][]');
                                                });

                                                // Bed Type Add More
                                                document.getElementById('add-bed-type-btn')?.addEventListener('click', function() {
                                                    const input = document.getElementById('custom-bed-type-input');
                                                    const value = input.value.trim();
                                                    if (!value) {
                                                        alert('Please enter a bed type');
                                                        return;
                                                    }

                                                    const container = document.getElementById('custom-bed-types-container');
                                                    const existing = container.querySelector(`input[value="${value}"]`);
                                                    if (existing) {
                                                        alert('This bed type already exists!');
                                                        input.value = '';
                                                        return;
                                                    }

                                                    const label = document.createElement('label');
                                                    const checkbox = document.createElement('input');
                                                    checkbox.type = 'checkbox';
                                                    checkbox.name = 'room_info[custom_bed_types][]';
                                                    checkbox.value = value;
                                                    checkbox.className = 'checkbox-item-room-info';
                                                    checkbox.checked = true;

                                                    const textNode = document.createTextNode(value);
                                                    label.appendChild(checkbox);
                                                    label.appendChild(textNode);
                                                    label.appendChild(document.createElement('br'));

                                                    container.appendChild(label);
                                                    input.value = '';
                                                });

                                                // Enter key support
                                                ['custom-layout-input', 'custom-view-input', 'custom-bathroom-input', 'custom-kitchen-input', 'custom-accessibility-input', 'custom-bed-type-input'].forEach(id => {
                                                    document.getElementById(id)?.addEventListener('keypress', function(e) {
                                                        if (e.key === 'Enter') {
                                                            e.preventDefault();
                                                            const btnId = id.replace('-input', '-btn');
                                                            document.getElementById(btnId)?.click();
                                                        }
                                                    });
                                                });
                                            </script>

                                            <div class="row mt-15">
                                                <div class="col-md-12">
                                                    <h3 class="can-tittle">Additional Room Information</h3>
                                                        </div>
                                                    </div>

                                                    @php
                                                $additionalInfo = old('additional_info', $roomInfo['additional_info'] ?? []);
                                                if (!is_array($additionalInfo)) {
                                                    $additionalInfo = [];
                                                        }
                                                    @endphp

                                            <!-- Additional Bed Policy & Fee -->
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Additional Bed Policy & Fee</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Fee Amount</label>
                                                                <input type="number" class="form-control" name="additional_info[bed_fee_amount]" value="{{ old('additional_info.bed_fee_amount', $additionalInfo['bed_fee_amount'] ?? '') }}" placeholder="e.g., 1000" min="0" step="0.01">
                                                </div>
                                            </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Currency</label>
                                                                <input type="text" class="form-control" name="additional_info[bed_fee_currency]" value="{{ old('additional_info.bed_fee_currency', $additionalInfo['bed_fee_currency'] ?? 'BDT') }}" placeholder="e.g., BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Per Unit</label>
                                                                <input type="text" class="form-control" name="additional_info[bed_fee_unit]" value="{{ old('additional_info.bed_fee_unit', $additionalInfo['bed_fee_unit'] ?? 'Per Bed') }}" placeholder="e.g., Per Bed">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Children & Extra Guest Policy -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Children & Extra Guest Policy</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Children Free Age Limit</label>
                                                                <input type="text" class="form-control" name="additional_info[children_free_age]" value="{{ old('additional_info.children_free_age', $additionalInfo['children_free_age'] ?? '') }}" placeholder="e.g., Under 5 years">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Extra Adult Charge</label>
                                                                <input type="text" class="form-control" name="additional_info[extra_adult_charge]" value="{{ old('additional_info.extra_adult_charge', $additionalInfo['extra_adult_charge'] ?? '') }}" placeholder="e.g., 500 BDT per adult">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Laundry Service Fee -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Laundry Service Fee</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Fee Amount</label>
                                                                <input type="number" class="form-control" name="additional_info[laundry_fee_amount]" value="{{ old('additional_info.laundry_fee_amount', $additionalInfo['laundry_fee_amount'] ?? '') }}" placeholder="e.g., 500" min="0" step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Currency</label>
                                                                <input type="text" class="form-control" name="additional_info[laundry_fee_currency]" value="{{ old('additional_info.laundry_fee_currency', $additionalInfo['laundry_fee_currency'] ?? 'BDT') }}" placeholder="e.g., BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Per Unit</label>
                                                                <input type="text" class="form-control" name="additional_info[laundry_fee_unit]" value="{{ old('additional_info.laundry_fee_unit', $additionalInfo['laundry_fee_unit'] ?? 'Per Person') }}" placeholder="e.g., Per Person">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Housekeeping & Cleaning Policy -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Housekeeping & Cleaning Policy</strong></h5>
                                                    <div class="form-group">
                                                        <label class="form-label">Policy Type</label>
                                                        <select class="form-control" name="additional_info[housekeeping_type]">
                                                            <option value="">Select Option</option>
                                                            <option value="Daily" {{ old('additional_info.housekeeping_type', $additionalInfo['housekeeping_type'] ?? '') == 'Daily' ? 'selected' : '' }}>Daily</option>
                                                            <option value="Weekly" {{ old('additional_info.housekeeping_type', $additionalInfo['housekeeping_type'] ?? '') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                                            <option value="On Request" {{ old('additional_info.housekeeping_type', $additionalInfo['housekeeping_type'] ?? '') == 'On Request' ? 'selected' : '' }}>On Request</option>
                                                            <option value="Paid" {{ old('additional_info.housekeeping_type', $additionalInfo['housekeeping_type'] ?? '') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Check-in & Check-out Policy -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Check-in & Check-out Policy</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Standard Check-in Time</label>
                                                                <input type="text" class="form-control" name="additional_info[checkin_time]" value="{{ old('additional_info.checkin_time', $additionalInfo['checkin_time'] ?? '') }}" placeholder="e.g., 2:00 PM">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Standard Check-out Time</label>
                                                                <input type="text" class="form-control" name="additional_info[checkout_time]" value="{{ old('additional_info.checkout_time', $additionalInfo['checkout_time'] ?? '') }}" placeholder="e.g., 12:00 PM">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Late Check-out Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[late_checkout_fee]" value="{{ old('additional_info.late_checkout_fee', $additionalInfo['late_checkout_fee'] ?? '') }}" placeholder="e.g., 500 BDT per hour">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Early Check-in Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[early_checkin_fee]" value="{{ old('additional_info.early_checkin_fee', $additionalInfo['early_checkin_fee'] ?? '') }}" placeholder="e.g., 500 BDT per hour">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Security Deposit Requirement -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Security Deposit Requirement</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Deposit Amount</label>
                                                                <input type="text" class="form-control" name="additional_info[security_deposit_amount]" value="{{ old('additional_info.security_deposit_amount', $additionalInfo['security_deposit_amount'] ?? '') }}" placeholder="e.g., 5000 BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Refundable Terms</label>
                                                                <input type="text" class="form-control" name="additional_info[security_deposit_refundable]" value="{{ old('additional_info.security_deposit_refundable', $additionalInfo['security_deposit_refundable'] ?? '') }}" placeholder="e.g., Fully refundable after check-out">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Parking Availability & Charges -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Parking Availability & Charges</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Availability</label>
                                                                <select class="form-control" name="additional_info[parking_availability]">
                                                                    <option value="">Select Option</option>
                                                                    <option value="Free" {{ old('additional_info.parking_availability', $additionalInfo['parking_availability'] ?? '') == 'Free' ? 'selected' : '' }}>Free</option>
                                                                    <option value="Paid" {{ old('additional_info.parking_availability', $additionalInfo['parking_availability'] ?? '') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                                    <option value="Not Available" {{ old('additional_info.parking_availability', $additionalInfo['parking_availability'] ?? '') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Charge Amount</label>
                                                                <input type="number" class="form-control" name="additional_info[parking_fee_amount]" value="{{ old('additional_info.parking_fee_amount', $additionalInfo['parking_fee_amount'] ?? '') }}" placeholder="e.g., 500" min="0" step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Per Unit</label>
                                                                <input type="text" class="form-control" name="additional_info[parking_fee_unit]" value="{{ old('additional_info.parking_fee_unit', $additionalInfo['parking_fee_unit'] ?? 'Per Day Per Car') }}" placeholder="e.g., Per Day Per Car">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pet Policy -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Pet Policy</strong></h5>
                                                    <div class="form-group">
                                                        <label class="form-label">Policy</label>
                                                        <select class="form-control" name="additional_info[pet_policy]">
                                                            <option value="">Select Policy</option>
                                                            <option value="Allowed" {{ old('additional_info.pet_policy', $additionalInfo['pet_policy'] ?? '') == 'Allowed' ? 'selected' : '' }}>Allowed</option>
                                                            <option value="Not Allowed" {{ old('additional_info.pet_policy', $additionalInfo['pet_policy'] ?? '') == 'Not Allowed' ? 'selected' : '' }}>Not Allowed</option>
                                                            <option value="Extra Charge" {{ old('additional_info.pet_policy', $additionalInfo['pet_policy'] ?? '') == 'Extra Charge' ? 'selected' : '' }}>Extra Charge</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label class="form-label">Pet Fee (if Extra Charge)</label>
                                                        <input type="text" class="form-control" name="additional_info[pet_fee]" value="{{ old('additional_info.pet_fee', $additionalInfo['pet_fee'] ?? '') }}" placeholder="e.g., 500 BDT per pet per day">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Meal Options -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Meal Options</strong></h5>
                                                    <div class="form-group">
                                                        <label class="form-label">Meal Type</label>
                                                        <select class="form-control" name="additional_info[meal_options]">
                                                            <option value="">Select Option</option>
                                                            <option value="Buffet" {{ old('additional_info.meal_options', $additionalInfo['meal_options'] ?? '') == 'Buffet' ? 'selected' : '' }}>Buffet</option>
                                                            <option value="Regular Breakfast Included" {{ old('additional_info.meal_options', $additionalInfo['meal_options'] ?? '') == 'Regular Breakfast Included' ? 'selected' : '' }}>Regular Breakfast Included</option>
                                                            <option value="On Request" {{ old('additional_info.meal_options', $additionalInfo['meal_options'] ?? '') == 'On Request' ? 'selected' : '' }}>On Request</option>
                                                            <option value="Paid Separately" {{ old('additional_info.meal_options', $additionalInfo['meal_options'] ?? '') == 'Paid Separately' ? 'selected' : '' }}>Paid Separately</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label class="form-label">Meal Fee (if Paid Separately)</label>
                                                        <input type="text" class="form-control" name="additional_info[meal_fee]" value="{{ old('additional_info.meal_fee', $additionalInfo['meal_fee'] ?? '') }}" placeholder="e.g., 300 BDT per person">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Transportation Services -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Transportation Services</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Airport Pickup</label>
                                                                <select class="form-control" name="additional_info[airport_pickup]">
                                                                    <option value="">Select Option</option>
                                                                    <option value="Free" {{ old('additional_info.airport_pickup', $additionalInfo['airport_pickup'] ?? '') == 'Free' ? 'selected' : '' }}>Free</option>
                                                                    <option value="Paid" {{ old('additional_info.airport_pickup', $additionalInfo['airport_pickup'] ?? '') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                                    <option value="Not Available" {{ old('additional_info.airport_pickup', $additionalInfo['airport_pickup'] ?? '') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label class="form-label">Airport Pickup Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[airport_pickup_fee]" value="{{ old('additional_info.airport_pickup_fee', $additionalInfo['airport_pickup_fee'] ?? '') }}" placeholder="e.g., 1000 BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Shuttle Service</label>
                                                                <select class="form-control" name="additional_info[shuttle_service]">
                                                                    <option value="">Select Option</option>
                                                                    <option value="Free" {{ old('additional_info.shuttle_service', $additionalInfo['shuttle_service'] ?? '') == 'Free' ? 'selected' : '' }}>Free</option>
                                                                    <option value="Paid" {{ old('additional_info.shuttle_service', $additionalInfo['shuttle_service'] ?? '') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                                    <option value="Not Available" {{ old('additional_info.shuttle_service', $additionalInfo['shuttle_service'] ?? '') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label class="form-label">Shuttle Service Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[shuttle_service_fee]" value="{{ old('additional_info.shuttle_service_fee', $additionalInfo['shuttle_service_fee'] ?? '') }}" placeholder="e.g., 500 BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Car Rental</label>
                                                                <select class="form-control" name="additional_info[car_rental]">
                                                                    <option value="">Select Option</option>
                                                                    <option value="Available" {{ old('additional_info.car_rental', $additionalInfo['car_rental'] ?? '') == 'Available' ? 'selected' : '' }}>Available</option>
                                                                    <option value="Not Available" {{ old('additional_info.car_rental', $additionalInfo['car_rental'] ?? '') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label class="form-label">Car Rental Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[car_rental_fee]" value="{{ old('additional_info.car_rental_fee', $additionalInfo['car_rental_fee'] ?? '') }}" placeholder="e.g., 2000 BDT per day">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Other Charges/Policies -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Other Charges/Policies (If Any)</strong></h5>
                                                    <div class="form-group">
                                                        <label class="form-label">Additional Information</label>
                                                        <textarea class="form-control" name="additional_info[other_charges]" rows="3" placeholder="Enter any other charges or policies">{{ old('additional_info.other_charges', $additionalInfo['other_charges'] ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-15 js-limit-two"> {{-- scoped container --}}
                                                <div class="col-md-12">
                                                    <h3 class="can-tittle">Cancellation Policy</h3>
                                                </div>

                                                @php
                                                    $cancellationPolicies = old(
                                                        'cancellation_policy',
                                                        is_string($room->cancellation_policy)
                                                            ? (json_decode($room->cancellation_policy, true) ?? [])
                                                            : ($room->cancellation_policy ?? [])
                                                    );
                                                    if (!is_array($cancellationPolicies)) {
                                                        $cancellationPolicies = [];
                                                    }
                                                @endphp

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox"
                                                                   name="cancellation_policy[]" id="flexiblePolicy" value="flexible"
                                                                {{ in_array('flexible', $cancellationPolicies) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexiblePolicy">
                                                                Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox"
                                                                   name="cancellation_policy[]" id="nonRefundablePolicy" value="non_refundable"
                                                                {{ in_array('non_refundable', $cancellationPolicies) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="nonRefundablePolicy">
                                                                Non-refundable (Regardless of the cancellation window, customers will not get any refund under this.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox"
                                                                   name="cancellation_policy[]" id="partiallyRefundablePolicy" value="partially_refundable"
                                                                {{ in_array('partially_refundable', $cancellationPolicies) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="partiallyRefundablePolicy">
                                                                Partially refundable (Cancellations that take place in less than 24 hours and Rooms that are labeled with this badge, after deducting a 30% cancellation fee, rest of the amount will be refunded.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox"
                                                                   name="cancellation_policy[]" id="longTermPolicy" value="long_term"
                                                                {{ in_array('long_term', $cancellationPolicies) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="longTermPolicy">
                                                                Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed. T&C paper will be found in the system.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                @error('cancellation_policy.*')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                {{-- Warning (scoped to this block) --}}
                                                <div class="col-lg-12">
                                                    <small class="text-danger policy-warning" style="display:none;">⚠️ Maximum 2 can be Selected</small>
                                                </div>
                                            </div>

                                            {{-- JS: applies to every ".js-limit-two" block independently --}}
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    document.querySelectorAll('.js-limit-two').forEach(function (container) {
                                                        const checkboxes = container.querySelectorAll('.cancellation-checkbox');
                                                        const warning = container.querySelector('.policy-warning');

                                                        function maybeWarn(e) {
                                                            const checkedCount = container.querySelectorAll('.cancellation-checkbox:checked').length;
                                                            if (checkedCount > 2) {
                                                                // undo the last toggle
                                                                if (e && e.target && e.target.type === 'checkbox') {
                                                                    e.target.checked = false;
                                                                }
                                                                // show warning briefly
                                                                warning.style.display = 'block';
                                                                clearTimeout(container._warnTimer);
                                                                container._warnTimer = setTimeout(() => {
                                                                    warning.style.display = 'none';
                                                                }, 2000);
                                                            }
                                                        }

                                                        // Attach listeners
                                                        checkboxes.forEach(cb => cb.addEventListener('change', maybeWarn));

                                                        // Handle pre-checked (old() values)
                                                        maybeWarn();
                                                    });
                                                });
                                            </script>


                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-submit">Update</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" name="save_draft" value="1">Save & Drafts</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane {{ old('active_tab', 'tabItem3') === 'tabItem4' ? 'active' : '' }}" id="tabItem4">
                                            <div class="row mt-15">
                                                <div class="col-12">
                                                    <p class="text-muted"><i class="fa fa-info-circle"></i> These sections are synced with Room Details Tab. Changes made here will reflect there and vice versa.</p>
                                                </div>
                                            </div>

                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Appliances Information</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input sync-checkbox-master" data-target=".checkbox-item-appliances" id="appliances-all-facilities">
                                                                <label class="custom-control-label" for="appliances-all-facilities">Select All</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="appliances-list-facilities"></div>
                                                    
                                                    <!-- Custom Appliances Container for Facilities Tab -->
                                                    <div class="custom-appliances-container-facilities mt-3" data-section="appliances"></div>
                                                    
                                                    <!-- Add More Appliances in Facilities Tab -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-appliance-input-facilities" placeholder="Enter custom appliance name">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-appliance-btn-facilities">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Furniture Information</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input sync-checkbox-master" data-target=".checkbox-item-furniture" id="furniture-all-facilities">
                                                                <label class="custom-control-label" for="furniture-all-facilities">Select All</label>
                                                                    </div>
                                                                </div>
                                                                            </div>
                                                    
                                                    <div class="furniture-list-facilities">
                                                        @php
                                                            $existingFurniture = is_array($room->furniture) ? $room->furniture : (is_string($room->furniture) ? json_decode($room->furniture, true) : []);
                                                        @endphp
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Bed" {{ in_array('Bed', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Bed</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Dining Table with Chair" {{ in_array('Dining Table with Chair', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Dining Table with Chair</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Sofa/Couch" {{ in_array('Sofa/Couch', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Sofa/Couch</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Tea Table" {{ in_array('Tea Table', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Tea Table</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Bedside Table" {{ in_array('Bedside Table', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Bedside Table</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Shoe Rack" {{ in_array('Shoe Rack', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Shoe Rack</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Clothing Cabinet" {{ in_array('Clothing Cabinet', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Clothing Cabinet</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Clothes Drying Hanger" {{ in_array('Clothes Drying Hanger', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Clothes Drying Hanger</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Iron Stand" {{ in_array('Iron Stand', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Iron Stand</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Locker/Safe" {{ in_array('Locker/Safe', old('furniture', $existingFurniture)) ? 'checked' : '' }}> Locker/Safe</label><br>
                                                    </div>
                                                    
                                                    <!-- Custom Furniture Container for Facilities Tab -->
                                                    <div class="custom-furniture-container-facilities mt-3" data-section="furniture"></div>
                                                    
                                                    <!-- Add More Furniture in Facilities Tab -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-furniture-input-facilities" placeholder="Enter custom furniture name">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-furniture-btn-facilities">Add</button>
                                                        </div>
                                                    </div>
                                                                        </div>
                                                                </div>

                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="label-chk">Room Amenities</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input sync-checkbox-master" data-target=".checkbox-item-amenities" id="amenities-all-facilities">
                                                                <label class="custom-control-label" for="amenities-all-facilities">Check All</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    @php
                                                        $amenities = old('amenities', is_string($room->amenities) ? (json_decode($room->amenities, true) ?? []) : ($room->amenities ?? []));
                                                        if (!is_array($amenities)) {
                                                            $amenities = [];
                                                        }
                                                    @endphp
                                                    
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Soap" {{ in_array('Soap', $amenities) ? 'checked' : '' }}> Soap</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Tissue" {{ in_array('Tissue', $amenities) ? 'checked' : '' }}> Tissue</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Shampoo" {{ in_array('Shampoo', $amenities) ? 'checked' : '' }}> Shampoo</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Toothbrush" {{ in_array('Toothbrush', $amenities) ? 'checked' : '' }}> Toothbrush</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Towel" {{ in_array('Towel', $amenities) ? 'checked' : '' }}> Towel</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Water bottle" {{ in_array('Water bottle', $amenities) ? 'checked' : '' }}> Water bottle</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Free laundry" {{ in_array('Free laundry', $amenities) ? 'checked' : '' }}> Free laundry</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Air freshener" {{ in_array('Air freshener', $amenities) ? 'checked' : '' }}> Air freshener</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Fruit basket" {{ in_array('Fruit basket', $amenities) ? 'checked' : '' }}> Fruit basket</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Complimentary drinks" {{ in_array('Complimentary drinks', $amenities) ? 'checked' : '' }}> Complimentary drinks</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Buffet breakfast" {{ in_array('Buffet breakfast', $amenities) ? 'checked' : '' }}> Buffet breakfast</label><br>
                                                    
                                                    <!-- Custom Amenities Container for Facilities Tab -->
                                                    <div class="custom-amenities-container-facilities mt-3" data-section="amenities">
                                                        @php
                                                            $fixedAmenities = ['Soap', 'Tissue', 'Shampoo', 'Toothbrush', 'Towel', 'Water bottle', 'Free laundry', 'Air freshener', 'Fruit basket', 'Complimentary drinks', 'Buffet breakfast'];
                                                            $customAmenities = array_diff($amenities, $fixedAmenities);
                                                        @endphp
                                                        @foreach($customAmenities as $customAmenity)
                                                            <label><input type="checkbox" name="custom_amenities[]" class="checkbox-item-amenities" value="{{ $customAmenity }}" checked> {{ $customAmenity }}</label><br>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- Add More Amenities in Facilities Tab -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-amenity-input-facilities" placeholder="Enter custom amenity name">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-amenity-btn-facilities">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-submit">Update</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" name="save_draft" value="1">Save & Drafts</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                // Sync checkboxes between Room Details and Room Facilities tabs
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    // Clone checkbox lists to Room Facilities tab (only fixed checkboxes, not custom ones)
                                                    function syncCheckboxLists() {
                                                        // Appliances (only fixed, exclude custom)
                                                        const appliancesLabels = document.querySelectorAll('#tabItem3 input[name="appliances[]"]');
                                                        const appliancesTarget = document.querySelector('.appliances-list-facilities');
                                                        appliancesTarget.innerHTML = '';
                                                        appliancesLabels.forEach(input => {
                                                            // Skip if it's in a custom container
                                                            if (input.closest('.custom-appliances-container')) return;
                                                            
                                                            const label = input.closest('label');
                                                            if (label) {
                                                                const clone = label.cloneNode(true);
                                                                const checkbox = clone.querySelector('input');
                                                                checkbox.addEventListener('change', function() {
                                                                    const original = document.querySelector(`#tabItem3 input[name="${this.name}"][value="${this.value}"]`);
                                                                    if (original) original.checked = this.checked;
                                                                });
                                                                appliancesTarget.appendChild(clone);
                                                                appliancesTarget.appendChild(document.createElement('br'));
                                                            }
                                                        });

                                                        // Furniture (only fixed, exclude custom)
                                                        // Furniture - Only in Facilities tab, not in Room Details tab
                                                        // So we don't need to sync furniture from Room Details
                                                        // The furniture items are already in the Facilities tab

                                                        // Amenities - NOT in Room Details tab, only in Facilities tab
                                                        // So we don't sync amenities from Room Details
                                                        
                                                        // Sync custom items from Room Details to Facilities tab
                                                        syncCustomItemsToFacilities();
                                                    }
                                                    
                                                    // Sync custom items to facilities tab
                                                    function syncCustomItemsToFacilities() {
                                                        // Sync custom appliances
                                                        const customAppliances = document.querySelectorAll('#tabItem3 input[name="custom_appliances[]"]');
                                                        const facilitiesApplianceContainer = document.querySelector('#tabItem4 .custom-appliances-container-facilities');
                                                        if (facilitiesApplianceContainer) {
                                                            facilitiesApplianceContainer.innerHTML = '';
                                                            customAppliances.forEach(input => {
                                                            const label = input.closest('label');
                                                            if (label) {
                                                                const clone = label.cloneNode(true);
                                                                const checkbox = clone.querySelector('input');
                                                                    checkbox.className = 'checkbox-item-appliances';
                                                                checkbox.addEventListener('change', function() {
                                                                        const original = document.querySelector(`#tabItem3 input[name="custom_appliances[]"][value="${this.value}"]`);
                                                                    if (original) original.checked = this.checked;
                                                                });
                                                                    facilitiesApplianceContainer.appendChild(clone);
                                                                    facilitiesApplianceContainer.appendChild(document.createElement('br'));
                                                                }
                                                            });
                                                        }
                                                        
                                                        // Sync custom furniture
                                                        const customFurniture = document.querySelectorAll('#tabItem3 input[name="custom_furniture[]"]');
                                                        const facilitiesFurnitureContainer = document.querySelector('#tabItem4 .custom-furniture-container-facilities');
                                                        if (facilitiesFurnitureContainer) {
                                                            facilitiesFurnitureContainer.innerHTML = '';
                                                            customFurniture.forEach(input => {
                                                            const label = input.closest('label');
                                                            if (label) {
                                                                const clone = label.cloneNode(true);
                                                                const checkbox = clone.querySelector('input');
                                                                    checkbox.className = 'checkbox-item-furniture';
                                                                checkbox.addEventListener('change', function() {
                                                                        const original = document.querySelector(`#tabItem3 input[name="custom_furniture[]"][value="${this.value}"]`);
                                                                    if (original) original.checked = this.checked;
                                                                });
                                                                    facilitiesFurnitureContainer.appendChild(clone);
                                                                    facilitiesFurnitureContainer.appendChild(document.createElement('br'));
                                                            }
                                                        });
                                                        }
                                                        
                                                        // Amenities are NOT in Room Details tab, so no need to sync custom amenities from there
                                                    }

                                                    // Initial sync
                                                    setTimeout(syncCheckboxLists, 100);

                                                    // Listen for changes in Room Details tab and sync to Facilities
                                                    document.querySelector('#tabItem3').addEventListener('change', function(e) {
                                                        if (e.target.name === 'appliances[]' || e.target.name === 'custom_appliances[]' || 
                                                            e.target.name === 'furniture[]' || e.target.name === 'custom_furniture[]') {
                                                            const facilitiesCheckbox = document.querySelector(`#tabItem4 input[name="${e.target.name}"][value="${e.target.value}"]`);
                                                            if (facilitiesCheckbox) facilitiesCheckbox.checked = e.target.checked;
                                                        }
                                                    });

                                                    // Handle "Select All" in facilities tab
                                                    document.querySelectorAll('.sync-checkbox-master').forEach(master => {
                                                        master.addEventListener('change', function() {
                                                            const targetClass = this.getAttribute('data-target');
                                                            document.querySelectorAll(targetClass).forEach(checkbox => {
                                                                checkbox.checked = this.checked;
                                                            });
                                                        });
                                                    });

                                                    // Function to create a checkbox element
                                                    function createCheckbox(name, value, classes, container, isCustom = false) {
                                                        const label = document.createElement('label');
                                                        const checkbox = document.createElement('input');
                                                        checkbox.type = 'checkbox';
                                                        checkbox.name = isCustom ? `custom_${name}[]` : `${name}[]`;
                                                        checkbox.value = value;
                                                        checkbox.className = classes;
                                                        checkbox.checked = true;
                                                        
                                                        const textNode = document.createTextNode(value);
                                                        label.appendChild(checkbox);
                                                        label.appendChild(textNode);
                                                        label.appendChild(document.createElement('br'));
                                                        
                                                        container.appendChild(label);
                                                        
                                                        // Add sync functionality if it's in Room Details tab
                                                        if (container.closest('#tabItem3')) {
                                                            // Don't sync amenities from Details to Facilities (amenities don't exist in Details tab)
                                                            if (checkbox.name !== 'custom_amenities[]' && checkbox.name !== 'amenities[]') {
                                                                checkbox.addEventListener('change', function() {
                                                                    const facilitiesCheckbox = document.querySelector(`#tabItem4 input[name="${checkbox.name}"][value="${value}"]`);
                                                                    if (facilitiesCheckbox) facilitiesCheckbox.checked = this.checked;
                                                                });
                                                                // Sync to facilities tab
                                                                syncCustomItemsToFacilities();
                                                            }
                                                        }
                                                        
                                                        // Add sync functionality if it's in Facilities tab
                                                        if (container.closest('#tabItem4')) {
                                                            // Don't sync amenities from Facilities to Details (amenities don't exist in Details tab)
                                                            if (checkbox.name !== 'custom_amenities[]' && checkbox.name !== 'amenities[]') {
                                                                checkbox.addEventListener('change', function() {
                                                                    const detailsCheckbox = document.querySelector(`#tabItem3 input[name="${checkbox.name}"][value="${value}"]`);
                                                                    if (detailsCheckbox) detailsCheckbox.checked = this.checked;
                                                                });
                                                            }
                                                        }
                                                        
                                                        return checkbox;
                                                    }

                                                    // Function to add custom appliance
                                                    function addCustomAppliance(value, sourceTab = 'details') {
                                                        if (!value || value.trim() === '') return;
                                                        
                                                        const trimmedValue = value.trim();
                                                        
                                                        // Check if already exists in the current tab
                                                        const currentTab = sourceTab === 'details' ? '#tabItem3' : '#tabItem4';
                                                        const existing = document.querySelector(`${currentTab} input[name="custom_appliances[]"][value="${trimmedValue}"]`);
                                                        if (existing) {
                                                            alert('This appliance already exists!');
                                                            return;
                                                        }
                                                        
                                                        if (sourceTab === 'details') {
                                                            // Add only to Room Details tab
                                                            const container = document.querySelector('#tabItem3 .custom-appliances-container');
                                                            createCheckbox('appliances', trimmedValue, 'checkbox-item-appliances checkbox-item-room-info', container, true);
                                                        } else {
                                                            // Add to Facilities tab
                                                            const facilitiesContainer = document.querySelector('#tabItem4 .custom-appliances-container-facilities');
                                                            createCheckbox('appliances', trimmedValue, 'checkbox-item-appliances', facilitiesContainer, true);
                                                            
                                                            // Also add to Room Details tab
                                                            const container = document.querySelector('#tabItem3 .custom-appliances-container');
                                                            createCheckbox('appliances', trimmedValue, 'checkbox-item-appliances checkbox-item-room-info', container, true);
                                                        }
                                                    }

                                                    // Function to add custom furniture
                                                    function addCustomFurniture(value, sourceTab = 'details') {
                                                        if (!value || value.trim() === '') return;
                                                        
                                                        const trimmedValue = value.trim();
                                                        
                                                        // Check if already exists in the current tab
                                                        const currentTab = sourceTab === 'details' ? '#tabItem3' : '#tabItem4';
                                                        const existing = document.querySelector(`${currentTab} input[name="custom_furniture[]"][value="${trimmedValue}"]`);
                                                        if (existing) {
                                                            alert('This furniture already exists!');
                                                            return;
                                                        }
                                                        
                                                        if (sourceTab === 'details') {
                                                            // Add only to Room Details tab
                                                            const container = document.querySelector('#tabItem3 .custom-furniture-container');
                                                            createCheckbox('furniture', trimmedValue, 'checkbox-item-furniture checkbox-item-additional', container, true);
                                                        } else {
                                                            // Add to Facilities tab
                                                            const facilitiesContainer = document.querySelector('#tabItem4 .custom-furniture-container-facilities');
                                                            createCheckbox('furniture', trimmedValue, 'checkbox-item-furniture', facilitiesContainer, true);
                                                            
                                                            // Also add to Room Details tab
                                                            const container = document.querySelector('#tabItem3 .custom-furniture-container');
                                                            createCheckbox('furniture', trimmedValue, 'checkbox-item-furniture checkbox-item-additional', container, true);
                                                        }
                                                    }

                                                    // Function to add custom amenity (only in Facilities tab, not in Room Details)
                                                    function addCustomAmenity(value, sourceTab = 'facilities') {
                                                        if (!value || value.trim() === '') return;
                                                        
                                                        const trimmedValue = value.trim();
                                                        
                                                        // Check if already exists in Facilities tab
                                                        const existing = document.querySelector(`#tabItem4 input[name="custom_amenities[]"][value="${trimmedValue}"]`);
                                                        if (existing) {
                                                            alert('This amenity already exists!');
                                                            return;
                                                        }
                                                        
                                                        // Add only to Facilities tab (amenities don't exist in Room Details tab)
                                                        const facilitiesContainer = document.querySelector('#tabItem4 .custom-amenities-container-facilities');
                                                        createCheckbox('amenities', trimmedValue, 'checkbox-item-amenities', facilitiesContainer, true);
                                                    }

                                                    // Add event listeners for "Add" buttons in Room Details tab
                                                    document.getElementById('add-appliance-btn')?.addEventListener('click', function() {
                                                        const input = document.getElementById('custom-appliance-input');
                                                        addCustomAppliance(input.value, 'details');
                                                        input.value = '';
                                                    });

                                                    document.getElementById('add-furniture-btn')?.addEventListener('click', function() {
                                                        const input = document.getElementById('custom-furniture-input');
                                                        addCustomFurniture(input.value, 'details');
                                                        input.value = '';
                                                    });

                                                    // Add event listeners for "Add" buttons in Facilities tab
                                                    document.getElementById('add-appliance-btn-facilities')?.addEventListener('click', function() {
                                                        const input = document.getElementById('custom-appliance-input-facilities');
                                                        addCustomAppliance(input.value, 'facilities');
                                                        input.value = '';
                                                    });

                                                    document.getElementById('add-furniture-btn-facilities')?.addEventListener('click', function() {
                                                        const input = document.getElementById('custom-furniture-input-facilities');
                                                        addCustomFurniture(input.value, 'facilities');
                                                        input.value = '';
                                                    });

                                                    document.getElementById('add-amenity-btn-facilities')?.addEventListener('click', function() {
                                                        const input = document.getElementById('custom-amenity-input-facilities');
                                                        addCustomAmenity(input.value, 'facilities');
                                                        input.value = '';
                                                    });

                                                    // Allow Enter key to trigger add
                                                    ['custom-appliance-input', 'custom-furniture-input',
                                                     'custom-appliance-input-facilities', 'custom-furniture-input-facilities', 'custom-amenity-input-facilities'].forEach(id => {
                                                        document.getElementById(id)?.addEventListener('keypress', function(e) {
                                                            if (e.key === 'Enter') {
                                                                e.preventDefault();
                                                                const btnId = id.replace('-input', '-btn').replace('-input-facilities', '-btn-facilities');
                                                                document.getElementById(btnId)?.click();
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <!-- Photos Tab -->
                                        <div class="tab-pane {{ old('active_tab', 'tabItem3') === 'Photos' ? 'active' : '' }}" id="Photos">
                                            <div class="row gy-4">
                                                @php
                                                    $photo_categories = [
                                                        'feature_main_photos' => 'Main Feature Photo (Shown as primary image)',
                                                        'bedroom_photos' => 'Bedroom (Main Bedroom Photos)',
                                                        'washroom_photos' => 'Washroom (Washroom Photos)',
                                                        'balcony_photos' => 'Balcony (Balcony Photos)',
                                                        'living_dining_photos' => 'Living & Dining (Living Room & Dining Room Photos)',
                                                        'furniture_photos' => 'Furniture (Bed, Sofa, Table, Chair, etc.)',
                                                        'appliances_photos' => 'Appliances (AC, TV, Fridge, Geyser, etc.)',
                                                        'kitchen_photos' => 'Kitchen (Kitchen & Kitchen Items – Crockery, Utensils, Stove, etc.)',
                                                        'amenity_photos' => 'Room Amenities (All in-room / apartment amenities)',
                                                        'bedroom2_photos' => '2nd Bedroom Photos (If Available)',
                                                        'bedroom3_photos' => '3rd Bedroom Photos (If Available)',
                                                        'washroom2_photos' => '2nd Washroom Photos (If Available)',
                                                        'washroom3_photos' => '3rd Washroom Photos (If Available)',
                                                    ];
                                                    // Use already eager-loaded photos (ordered desc)
                                                    $room_photos = $room->photos->groupBy('category');
                                                @endphp

                                                @foreach ($photo_categories as $input_name => $label)
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group mt-15">
                                                            <label class="form-label">{{ $label }}</label>
                                                            <div class="multiple-upload-container" id="upload-container-{{ str_replace('_photos', '', $input_name) }}">
                                                                <input type="file" class="multiple-file-input" id="file-input-{{ str_replace('_photos', '', $input_name) }}" name="{{ $input_name }}[]" accept="image/*" multiple>
                                                                <label class="upload-label" for="file-input-{{ str_replace('_photos', '', $input_name) }}">+ Add More Images</label>
                                                                <div class="multiple-thumbnail-gallery">
                                                                    @if (isset($room_photos[str_replace('_photos', '', $input_name)]))
                                                                        @foreach ($room_photos[str_replace('_photos', '', $input_name)] as $photo)
                                                                            <div class="multiple-thumbnail-item" data-photo-id="{{ $photo->id }}">
                                                                                <img src="{{ asset($photo->photo_path) }}" style="max-width: 100px; max-height: 100px;" onerror="this.onerror=null; this.style.display='none';">
                                                                                <button type="button" class="multiple-remove-btn" onclick="removePhoto({{ $photo->id }}, this)">×</button>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @error("{$input_name}.*")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="row">
                                                    <div class="col-sm-2 col-md-2 mt-15">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary btn-submit">Update</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 mt-15">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary" name="save_draft" value="1">Save & Drafts</button>
                                                        </div>
                                                    </div>
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

        <style>
            .hidden { display: none; }
            .multiple-upload-container {
                position: relative;
                padding: 15px;
                border: 2px dashed #d0d0d0;
                border-radius: 8px;
                background: #fafafa;
                transition: all 0.3s ease;
            }
            .multiple-upload-container:hover {
                border-color: #90278e;
                background: #fff;
            }
            .multiple-file-input {
                display: none;
            }
            .upload-label {
                display: inline-block;
                padding: 10px 20px;
                background-color: #90278e;
                color: white;
                cursor: pointer;
                border-radius: 5px;
                font-weight: 500;
                transition: all 0.3s ease;
                margin-bottom: 15px;
            }
            .upload-label:hover {
                background-color: #7a1f78;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(144, 39, 142, 0.3);
            }
            .multiple-thumbnail-gallery {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 15px;
            }
            .multiple-thumbnail-item {
                position: relative;
                display: inline-block;
                margin: 0;
                border: 2px solid #e0e0e0;
                border-radius: 8px;
                padding: 5px;
                background: #fff;
                transition: all 0.3s ease;
            }
            .multiple-thumbnail-item:hover {
                border-color: #90278e;
                box-shadow: 0 2px 8px rgba(144, 39, 142, 0.2);
            }
            .multiple-thumbnail-item:hover .multiple-remove-btn {
                opacity: 1;
                transform: scale(1.1);
            }
            .multiple-thumbnail-item img {
                display: block;
                border-radius: 4px;
            }
            .multiple-remove-btn {
                position: absolute;
                top: -8px;
                right: -8px;
                background: #dc3545;
                color: white;
                border: 2px solid white;
                border-radius: 50%;
                width: 28px;
                height: 28px;
                line-height: 24px;
                cursor: pointer;
                font-size: 18px;
                font-weight: bold;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0.9;
                transition: all 0.3s ease;
                z-index: 10;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            }
            .multiple-remove-btn:hover {
                background: #c82333;
                transform: scale(1.15);
                opacity: 1;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                function setupAddMore(sectionSelector, inputName) {
                    const section = document.querySelector(sectionSelector);
                    if (!section) return;
                    const addButton = section.querySelector('.add-button');
                    const template = section.querySelector('.input-container');
                    const customInputsContainer = section.querySelector('.custom-inputs');
                    if (!addButton || !template || !customInputsContainer) return;

                    addButton.addEventListener('click', function (e) {
                        e.preventDefault();
                        const newInput = template.cloneNode(true);
                        newInput.style.display = 'block';
                        newInput.querySelector('input').name = inputName + '[]';
                        customInputsContainer.appendChild(newInput);
                    });

                    section.addEventListener('click', function (e) {
                        if (e.target.classList.contains('btn-danger')) {
                            e.preventDefault();
                            e.target.closest('.input-container').remove();
                        }
                    });
                }

                setupAddMore('.appliances-section', 'custom_appliances');
                setupAddMore('.furniture-section', 'custom_furniture');
                setupAddMore('.amenities-section', 'custom_amenities');

                let personCount = {{ old('total_persons', $room->total_persons) }};
                const totalPersonsDisplay = document.getElementById('totalPersons');
                const totalPersonsInput = document.getElementById('totalPersonsInput');
                const personIncreaseBtn = document.querySelector('#tabItem3 .counter-card:nth-child(1) .increase-male');
                const personDecreaseBtn = document.querySelector('#tabItem3 .counter-card:nth-child(1) .decrease-male');

                personIncreaseBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    personCount++;
                    totalPersonsDisplay.textContent = personCount;
                    totalPersonsInput.value = personCount;
                });
                personDecreaseBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (personCount > 0) personCount--;
                    totalPersonsDisplay.textContent = personCount;
                    totalPersonsInput.value = personCount;
                });

                let roomCount = {{ old('total_rooms', $room->total_rooms) }};
                const totalRoomsDisplay = document.getElementById('totalRooms');
                const totalRoomsInput = document.getElementById('totalRoomsInput');
                const roomIncreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalRooms) .increase-male');
                const roomDecreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalRooms) .decrease-male');

                roomIncreaseBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    roomCount++;
                    totalRoomsDisplay.textContent = roomCount;
                    totalRoomsInput.value = roomCount;
                });
                roomDecreaseBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (roomCount > 0) roomCount--;
                    totalRoomsDisplay.textContent = roomCount;
                    totalRoomsInput.value = roomCount;
                });

                let washroomCount = {{ old('total_washrooms', $room->total_washrooms) }};
                const totalWashroomsDisplay = document.getElementById('totalWashrooms');
                const totalWashroomsInput = document.getElementById('totalWashroomsInput');
                const washroomIncreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalWashrooms) .increase-male');
                const washroomDecreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalWashrooms) .decrease-male');

                washroomIncreaseBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    washroomCount++;
                    totalWashroomsDisplay.textContent = washroomCount;
                    totalWashroomsInput.value = washroomCount;
                });
                washroomDecreaseBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (washroomCount > 0) washroomCount--;
                    totalWashroomsDisplay.textContent = washroomCount;
                    totalWashroomsInput.value = washroomCount;
                });

                let bedCount = {{ old('total_beds', $room->total_beds) }};
                const totalBedsDisplay = document.getElementById('totalBeds');
                const totalBedsInput = document.getElementById('totalBedsInput');
                const bedIncreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalBeds) .increase-male');
                const bedDecreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalBeds) .decrease-male');

                bedIncreaseBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    bedCount++;
                    totalBedsDisplay.textContent = bedCount;
                    totalBedsInput.value = bedCount;
                });
                bedDecreaseBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (bedCount > 0) bedCount--;
                    totalBedsDisplay.textContent = bedCount;
                    totalBedsInput.value = bedCount;
                });

                const discountAmountRadio = document.getElementById('discountAmount');
                const discountPercentageRadio = document.getElementById('discountPercentage');
                const discountValueField = document.getElementById('discountValueField');

                function handleDiscountSelection() {
                    if (discountAmountRadio.checked || discountPercentageRadio.checked) {
                        discountValueField.classList.remove('hidden');
                        discountValueField.querySelector('label').textContent = discountAmountRadio.checked ? 'Enter Discount Amount' : 'Enter Discount Percentage (%)';
                        discountValueField.querySelector('input').placeholder = discountAmountRadio.checked ? 'Ex: 3500' : 'Ex: 15 %';
                    } else {
                        discountValueField.classList.add('hidden');
                    }
                }

                discountAmountRadio.addEventListener('change', handleDiscountSelection);
                discountPercentageRadio.addEventListener('change', handleDiscountSelection);
                discountAmountRadio.addEventListener('dblclick', function (event) {
                    if (event.target.checked) {
                        event.target.checked = false;
                        discountValueField.classList.add('hidden');
                    }
                });
                discountPercentageRadio.addEventListener('dblclick', function (event) {
                    if (event.target.checked) {
                        event.target.checked = false;
                        discountValueField.classList.add('hidden');
                    }
                });
                handleDiscountSelection();

                const roomSwitch = document.getElementById('flexSwitchCheckDefault');
                const alertMessage = document.getElementById('alertMessage');
                roomSwitch.addEventListener('change', function () {
                    alertMessage.style.display = 'block';
                    alertMessage.textContent = this.checked ? "Your room is now Active" : "Your room is now Deactive";
                });

                document.getElementById("site-off").addEventListener("change", function() {
                    let checkboxes = document.querySelectorAll(".checkbox-item");
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = this.checked;
                    });
                });

                document.getElementById("furniture-all")?.addEventListener("change", function () {
                    let furnitureCheckboxes = document.querySelectorAll(".checkbox-item-furniture");
                    furnitureCheckboxes.forEach(function (checkbox) {
                        checkbox.checked = this.checked;
                    });
                });

                document.getElementById("appliances-all")?.addEventListener("change", function () {
                    let appliancesCheckboxes = document.querySelectorAll(".checkbox-item-appliances");
                    appliancesCheckboxes.forEach(function (checkbox) {
                        checkbox.checked = this.checked;
                    });
                });
            });

            function removePhoto(photoId, button) {
                // Check if SweetAlert is available
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to delete this photo?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deletePhotoRequest(photoId, button);
                        }
                    });
                } else {
                    // Fallback to regular confirm if SweetAlert is not available
                if (confirm('Are you sure you want to delete this photo?')) {
                        deletePhotoRequest(photoId, button);
                    }
                }
            }
            
            function deletePhotoRequest(photoId, button) {
                    fetch('{{ route("super-admin.room.delete-photo") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ photo_id: photoId })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Photo has been deleted successfully.',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            }
                                button.closest('.multiple-thumbnail-item').remove();
                        } else {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'Failed to delete photo'
                                });
                            } else {
                                alert('Failed to delete photo: ' + (data.message || 'Unknown error'));
                            }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while deleting the photo.'
                            });
                        } else {
                            alert('An error occurred while deleting the photo.');
                        }
                        });
            }

            document.addEventListener('DOMContentLoaded', () => {
                const uploadedImages = {};
                function initializeMultipleUpload(container) {
                    const fileInput = container.querySelector('.multiple-file-input');
                    const thumbnailGallery = container.querySelector('.multiple-thumbnail-gallery');
                    const containerId = container.id;
                    if (!uploadedImages[containerId]) {
                    uploadedImages[containerId] = [];
                    }
                    
                    fileInput.addEventListener('change', function(event) {
                        const files = event.target.files;
                        if (files && files.length > 0) {
                        for (let file of files) {
                            if (!file.type.startsWith('image/')) continue;
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const thumbnailItem = document.createElement('div');
                                thumbnailItem.classList.add('multiple-thumbnail-item');
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.maxWidth = '100px';
                                img.style.maxHeight = '100px';
                                    img.style.display = 'block';
                                    img.style.borderRadius = '4px';
                                const removeBtn = document.createElement('button');
                                removeBtn.innerHTML = '×';
                                removeBtn.classList.add('multiple-remove-btn');
                                removeBtn.type = 'button';
                                removeBtn.addEventListener('click', (event) => {
                                    event.preventDefault();
                                    thumbnailItem.remove();
                                    const index = uploadedImages[containerId].indexOf(file);
                                    if (index > -1) {
                                        uploadedImages[containerId].splice(index, 1);
                                    }
                                });
                                thumbnailItem.appendChild(img);
                                thumbnailItem.appendChild(removeBtn);
                                thumbnailGallery.appendChild(thumbnailItem);
                                uploadedImages[containerId].push(file);
                            };
                            reader.readAsDataURL(file);
                            }
                        }
                    });
                }
                const uploadContainers = document.querySelectorAll('.multiple-upload-container');
                uploadContainers.forEach(container => {
                    initializeMultipleUpload(container);
                });
            });

            // Track active tab and update hidden input
            document.addEventListener('DOMContentLoaded', function() {
                const activeTabInput = document.getElementById('active_tab');
                const savedTab = activeTabInput ? activeTabInput.value : 'tabItem3';
                
                // Activate the saved tab on page load
                if (savedTab) {
                    const tabLink = document.querySelector(`a[data-tab="${savedTab}"]`);
                    const tabPane = document.getElementById(savedTab);
                    
                    if (tabLink && tabPane) {
                        // Remove active class from all tabs and panes
                        document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
                        
                        // Add active class to the saved tab
                        tabLink.classList.add('active');
                        tabPane.classList.add('active');
                        
                        // Trigger Bootstrap tab show event
                        const tab = new bootstrap.Tab(tabLink);
                        tab.show();
                    }
                }
                
                // Track tab changes and update hidden input
                const tabLinks = document.querySelectorAll('a[data-bs-toggle="tab"][data-tab]');
                tabLinks.forEach(link => {
                    link.addEventListener('shown.bs.tab', function(e) {
                        const tabName = e.target.getAttribute('data-tab');
                        if (activeTabInput) {
                            activeTabInput.value = tabName;
                        }
                    });
                });
                
                // Show success message if photos were uploaded
                @if (session('success') && str_contains(session('success'), 'Photos'))
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                @endif
            });
        </script>
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            // Show validation errors using SweetAlert - Must run immediately, not in DOMContentLoaded
            @if ($errors->any())
                (function() {
                    let errorList = '';
                    @foreach ($errors->all() as $error)
                        errorList += '<li style="text-align: left; margin: 5px 0;">{{ addslashes($error) }}</li>';
                    @endforeach
                    
                    // Wait for SweetAlert to be available
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: '<div style="text-align: left;"><strong>Please fix the following errors:</strong><ul style="margin-top: 10px; padding-left: 20px;">' + errorList + '</ul></div>',
                            confirmButtonColor: '#90278e',
                            confirmButtonText: 'OK',
                            width: '600px',
                            allowOutsideClick: false
                        }).then(() => {
                            setTimeout(function() {
                                const firstErrorField = document.querySelector('input.is-invalid, select.is-invalid, textarea.is-invalid') || 
                                                       document.querySelector('[class*="text-danger"]')?.closest('.form-group')?.querySelector('input, select, textarea');
                                if (firstErrorField) {
                                    firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    firstErrorField.focus();
                                }
                            }, 100);
                        });
                    } else {
                        window.addEventListener('load', function() {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    html: '<div style="text-align: left;"><strong>Please fix the following errors:</strong><ul style="margin-top: 10px; padding-left: 20px;">' + errorList + '</ul></div>',
                                    confirmButtonColor: '#90278e',
                                    confirmButtonText: 'OK',
                                    width: '600px',
                                    allowOutsideClick: false
                                }).then(() => {
                                    setTimeout(function() {
                                        const firstErrorField = document.querySelector('input.is-invalid, select.is-invalid, textarea.is-invalid') || 
                                                               document.querySelector('[class*="text-danger"]')?.closest('.form-group')?.querySelector('input, select, textarea');
                                        if (firstErrorField) {
                                            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                            firstErrorField.focus();
                                        }
                                    }, 100);
                                });
                            }
                        });
                    }
                })();
            @endif
            
            // Intercept form submission to show validation errors
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form[action*="room.update"]');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // Always prevent default first
                        
                        // Clear previous validation
                        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                        
                        let hasErrors = false;
                        let errorMessages = [];
                        
                        // Check required fields
                        const requiredFields = form.querySelectorAll('[required]');
                        requiredFields.forEach(field => {
                            if (!field.value || !field.value.toString().trim()) {
                                hasErrors = true;
                                field.classList.add('is-invalid');
                                const label = form.querySelector(`label[for="${field.id}"]`) || 
                                            field.closest('.form-group')?.querySelector('label') ||
                                            field.closest('.form-group')?.querySelector('.form-label');
                                const fieldName = label ? label.textContent.trim().replace('*', '').replace(':', '') : field.name.replace('_', ' ');
                                errorMessages.push(`${fieldName} is required`);
                            }
                        });
                        
                        // Check numeric fields
                        const numericFields = form.querySelectorAll('input[type="number"]');
                        numericFields.forEach(field => {
                            if (field.value && field.value.toString().trim() && isNaN(field.value)) {
                                hasErrors = true;
                                field.classList.add('is-invalid');
                                const label = form.querySelector(`label[for="${field.id}"]`) || 
                                            field.closest('.form-group')?.querySelector('label') ||
                                            field.closest('.form-group')?.querySelector('.form-label');
                                const fieldName = label ? label.textContent.trim().replace('*', '').replace(':', '') : field.name.replace('_', ' ');
                                errorMessages.push(`${fieldName} must be a valid number`);
                            }
                            if (field.hasAttribute('min') && field.value && parseFloat(field.value) < parseFloat(field.getAttribute('min'))) {
                                hasErrors = true;
                                field.classList.add('is-invalid');
                                const label = form.querySelector(`label[for="${field.id}"]`) || 
                                            field.closest('.form-group')?.querySelector('label') ||
                                            field.closest('.form-group')?.querySelector('.form-label');
                                const fieldName = label ? label.textContent.trim().replace('*', '').replace(':', '') : field.name.replace('_', ' ');
                                errorMessages.push(`${fieldName} must be at least ${field.getAttribute('min')}`);
                            }
                        });
                        
                        if (hasErrors) {
                            let errorList = '';
                            errorMessages.forEach(msg => {
                                errorList += '<li style="text-align: left; margin: 5px 0;">' + msg + '</li>';
                            });
                            
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    html: '<div style="text-align: left;"><strong>Please fix the following errors:</strong><ul style="margin-top: 10px; padding-left: 20px;">' + errorList + '</ul></div>',
                                    confirmButtonColor: '#90278e',
                                    confirmButtonText: 'OK',
                                    width: '600px',
                                    allowOutsideClick: false
                                }).then(() => {
                                    const firstErrorField = form.querySelector('.is-invalid');
                                    if (firstErrorField) {
                                        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                        setTimeout(() => firstErrorField.focus(), 300);
                                    }
                                });
                            } else {
                                alert('Validation Error:\n\n' + errorMessages.join('\n'));
                                const firstErrorField = form.querySelector('.is-invalid');
                                if (firstErrorField) {
                                    firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    setTimeout(() => firstErrorField.focus(), 300);
                                }
                            }
                        } else {
                            // No errors, submit the form
                            form.submit();
                        }
                    });
                }
            });
        </script>
        
        <script>
            // Initialize Flatpickr for availability dates with drag selection
            document.addEventListener('DOMContentLoaded', function() {
                const availabilityInputHidden = document.getElementById('availability_dates_hidden');
                const availabilityInputDisplay = document.getElementById('availability_dates_display');
                
                // Helper function to format dates for display
                function formatDatesForDisplay(datesArray) {
                    if (!datesArray || datesArray.length === 0) {
                        return 'No dates selected yet. Select dates from the calendar below.';
                    }
                    
                    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    
                    return datesArray.map(dateStr => {
                        const [year, month, day] = dateStr.split('-').map(Number);
                        const date = new Date(year, month - 1, day);
                        return `${monthNames[date.getMonth()]} ${day}, ${year}`;
                    }).join(', ');
                }
                
                if (availabilityInputHidden && availabilityInputDisplay) {
                    // Get existing dates from hidden input if any
                    let existingDates = [];
                    if (availabilityInputHidden.value) {
                        try {
                            existingDates = JSON.parse(availabilityInputHidden.value);
                        } catch(e) {
                            // If not JSON, try comma-separated dates
                            existingDates = availabilityInputHidden.value.split(',').map(d => d.trim()).filter(d => d);
                        }
                    }
                    
                    // Update display field with formatted dates
                    availabilityInputDisplay.value = formatDatesForDisplay(existingDates);
                    
                    let isRangeSelecting = false;
                    let rangeStart = null;
                    let selectedDatesSet = new Set(existingDates);
                    
                    // Create a wrapper div for the calendar if it doesn't exist
                    const calendarWrapper = document.getElementById('availability_calendar_wrapper');
                    let flatpickrInstance;
                    
                    if (calendarWrapper) {
                        const calendarInput = document.createElement('input');
                        calendarInput.type = 'text';
                        calendarInput.id = 'availability_calendar_input';
                        calendarInput.style.display = 'none';
                        calendarWrapper.appendChild(calendarInput);
                        
                        // Calendar is always visible - no toggle needed
                        
                        flatpickrInstance = flatpickr(calendarInput, {
                            mode: "multiple",
                            dateFormat: "Y-m-d",
                            minDate: "today",
                            enableTime: false,
                            defaultDate: existingDates.length > 0 ? existingDates : null,
                            inline: true,
                            clickOpens: false,
                            allowInput: false,
                            appendTo: calendarWrapper,
                        onReady: function(selectedDates, dateStr, instance) {
                            // Helper function to format date in YYYY-MM-DD without timezone issues
                            function formatDateLocal(date) {
                                const year = date.getFullYear();
                                const month = String(date.getMonth() + 1).padStart(2, '0');
                                const day = String(date.getDate()).padStart(2, '0');
                                return `${year}-${month}-${day}`;
                            }
                            
                            // Helper function to parse date from aria-label or flatpickr day element
                            function getDateFromDayElement(dayElement) {
                                // Try to get the date from flatpickr's data-date attribute first
                                const dataDate = dayElement.getAttribute('data-date');
                                if (dataDate) {
                                    // data-date is in format YYYY-MM-DD
                                    return dataDate;
                                }
                                
                                // Fallback to aria-label parsing
                                const ariaLabel = dayElement.getAttribute('aria-label');
                                if (ariaLabel) {
                                    const date = new Date(ariaLabel);
                                    // Use local date formatting to avoid timezone issues
                                    return formatDateLocal(date);
                                }
                                
                                return null;
                            }
                            
                            // Add custom CSS for range selection
                            const style = document.createElement('style');
                            style.textContent = `
                                .flatpickr-day.selected.startRange,
                                .flatpickr-day.selected.endRange {
                                    background: #90278e;
                                    border-color: #90278e;
                                }
                                .flatpickr-day.inRange {
                                    background: #e8d5e7;
                                    border-color: #e8d5e7;
                                    color: #90278e;
                                }
                            `;
                            document.head.appendChild(style);
                            
                            // Enable mouse drag selection
                            const calendar = instance.calendarContainer;
                            let isDragging = false;
                            let dragStartDate = null;
                            let clickTimer = null;
                            
                            calendar.addEventListener('mousedown', function(e) {
                                const day = e.target.closest('.flatpickr-day:not(.flatpickr-disabled)');
                                if (day && !day.classList.contains('flatpickr-disabled')) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    
                                    const dateFormatted = getDateFromDayElement(day);
                                    if (dateFormatted) {
                                        // Parse the date string to Date object for comparison
                                        const [year, month, dayNum] = dateFormatted.split('-').map(Number);
                                        dragStartDate = new Date(year, month - 1, dayNum);
                                        rangeStart = dragStartDate;
                                        
                                        // Set a timer to detect if it's a click (not drag)
                                        clickTimer = setTimeout(function() {
                                            // This is a click, not a drag
                                            if (!isDragging) {
                                                // Toggle selection
                                                if (selectedDatesSet.has(dateFormatted)) {
                                                    selectedDatesSet.delete(dateFormatted);
                                                } else {
                                                    selectedDatesSet.add(dateFormatted);
                                                }
                                                updateFlatpickrDates();
                                            }
                                        }, 150); // 150ms threshold to distinguish click from drag
                                    }
                                }
                            });
                            
                            calendar.addEventListener('mousemove', function(e) {
                                if (dragStartDate !== null) {
                                    // Clear click timer since we're dragging
                                    if (clickTimer) {
                                        clearTimeout(clickTimer);
                                        clickTimer = null;
                                    }
                                    isDragging = true;
                                    const day = e.target.closest('.flatpickr-day:not(.flatpickr-disabled)');
                                    if (day && rangeStart) {
                                        const dateStr = getDateFromDayElement(day);
                                        if (dateStr) {
                                            const [year, month, dayNum] = dateStr.split('-').map(Number);
                                            const currentDate = new Date(year, month - 1, dayNum);
                                            const start = rangeStart < currentDate ? rangeStart : currentDate;
                                            const end = rangeStart < currentDate ? currentDate : rangeStart;
                                            
                                            // Highlight range
                                            const allDays = calendar.querySelectorAll('.flatpickr-day:not(.flatpickr-disabled)');
                                            allDays.forEach(d => {
                                                d.classList.remove('in-range', 'start-range', 'end-range');
                                            });
                                            
                                            allDays.forEach(d => {
                                                const dDateStr = getDateFromDayElement(d);
                                                if (dDateStr) {
                                                    const [year, month, dayNum] = dDateStr.split('-').map(Number);
                                                    const dDate = new Date(year, month - 1, dayNum);
                                                    if (dDate >= start && dDate <= end) {
                                                        d.classList.add('in-range');
                                                        if (dDate.getTime() === start.getTime()) {
                                                            d.classList.add('start-range');
                                                        }
                                                        if (dDate.getTime() === end.getTime()) {
                                                            d.classList.add('end-range');
                                                        }
                                                    }
                                                }
                                            });
                                        }
                                    }
                                }
                            });
                            
                            calendar.addEventListener('mouseup', function(e) {
                                // Clear click timer
                                if (clickTimer) {
                                    clearTimeout(clickTimer);
                                    clickTimer = null;
                                }
                                
                                if (isDragging && dragStartDate !== null) {
                                    const day = e.target.closest('.flatpickr-day:not(.flatpickr-disabled)');
                                    if (day && rangeStart) {
                                        const dateStr = getDateFromDayElement(day);
                                        if (dateStr) {
                                            const [year, month, dayNum] = dateStr.split('-').map(Number);
                                            const endDate = new Date(year, month - 1, dayNum);
                                            const start = rangeStart < endDate ? rangeStart : endDate;
                                            const end = rangeStart < endDate ? endDate : rangeStart;
                                            
                                            // Add all dates in range using local date formatting
                                            const currentDate = new Date(start);
                                            while (currentDate <= end) {
                                                const dateStr = formatDateLocal(currentDate);
                                                selectedDatesSet.add(dateStr);
                                                currentDate.setDate(currentDate.getDate() + 1);
                                            }
                                            
                                            // Update flatpickr selection
                                            updateFlatpickrDates();
                                        }
                                    }
                                    
                                    // Clear dragging state
                                    isDragging = false;
                                    dragStartDate = null;
                                    rangeStart = null;
                                    
                                    // Clear highlights
                                    const allDays = calendar.querySelectorAll('.flatpickr-day');
                                    allDays.forEach(d => {
                                        d.classList.remove('in-range', 'start-range', 'end-range');
                                    });
                                    
                                    e.preventDefault();
                                } else {
                                    // Reset drag state
                                    isDragging = false;
                                    dragStartDate = null;
                                    rangeStart = null;
                                }
                            });
                            
                            // Note: Click handling is now done in mousedown with timer to distinguish from drag
                            
                            function updateSelectedCount() {
                                const count = selectedDatesSet.size;
                                const countElement = document.getElementById('selected_dates_count');
                                if (countElement) {
                                    if (count > 0) {
                                        countElement.textContent = count + ' date' + (count !== 1 ? 's' : '') + ' selected';
                                    } else {
                                        countElement.textContent = 'No dates selected';
                                    }
                                }
                            }
                            
                            function updateFlatpickrDates() {
                                const datesArray = Array.from(selectedDatesSet).sort().map(dateStr => {
                                    const [year, month, dayNum] = dateStr.split('-').map(Number);
                                    return new Date(year, month - 1, dayNum);
                                });
                                
                                // Update flatpickr but don't trigger onChange
                                flatpickrInstance.setDate(datesArray, false);
                                
                                // Manually update visual selection
                                const allDays = calendar.querySelectorAll('.flatpickr-day:not(.flatpickr-disabled)');
                                allDays.forEach(day => {
                                    const dateFormatted = getDateFromDayElement(day);
                                    if (dateFormatted) {
                                        if (selectedDatesSet.has(dateFormatted)) {
                                            day.classList.add('selected', 'flatpickr-selected');
                                            day.style.background = '#90278e';
                                            day.style.borderColor = '#90278e';
                                            day.style.color = 'white';
                                        } else {
                                            day.classList.remove('selected', 'flatpickr-selected');
                                            day.style.background = '';
                                            day.style.borderColor = '';
                                            day.style.color = '';
                                        }
                                    }
                                });
                                
                                // Update hidden input value (JSON) and display field (formatted)
                                const sortedDates = Array.from(selectedDatesSet).sort();
                                availabilityInputHidden.value = JSON.stringify(sortedDates);
                                availabilityInputDisplay.value = formatDatesForDisplay(sortedDates);
                                updateSelectedCount();
                            }
                            
                            // Initialize count on load
                            updateSelectedCount();
                            updateSelectedCount();
                            
                            // Clear all dates button
                            const clearAllBtn = document.getElementById('clear_all_dates');
                            if (clearAllBtn) {
                                clearAllBtn.addEventListener('click', function() {
                                    if (confirm('Are you sure you want to clear all selected dates?')) {
                                        selectedDatesSet.clear();
                                        updateFlatpickrDates();
                                    }
                                });
                            }
                            
                            // Apply dates button (shows confirmation)
                            const applyBtn = document.getElementById('apply_dates');
                            if (applyBtn) {
                                applyBtn.addEventListener('click', function() {
                                    const count = selectedDatesSet.size;
                                    if (count === 0) {
                                        alert('Please select at least one date, or leave empty to make room always available.');
                                        return;
                                    }
                                    const sortedDates = Array.from(selectedDatesSet).sort();
                                    availabilityInputHidden.value = JSON.stringify(sortedDates);
                                    availabilityInputDisplay.value = formatDatesForDisplay(sortedDates);
                                    const datesArray = sortedDates.map(dateStr => {
                                        const [year, month, dayNum] = dateStr.split('-').map(Number);
                                        return new Date(year, month - 1, dayNum);
                                    });
                                    flatpickrInstance.setDate(datesArray, false);
                                    applyBtn.innerHTML = '<i class="fas fa-check-circle"></i> Applied!';
                                    applyBtn.style.background = '#28a745';
                                    setTimeout(() => {
                                        applyBtn.innerHTML = '<i class="fas fa-check"></i> Apply Selection';
                                        applyBtn.style.background = '#90278e';
                                    }, 2000);
                                });
                            }
                        },
                        onChange: function(selectedDates, dateStr, instance) {
                            // Update our set when dates change through normal selection
                            selectedDatesSet.clear();
                            selectedDates.forEach(date => {
                                const year = date.getFullYear();
                                const month = String(date.getMonth() + 1).padStart(2, '0');
                                const day = String(date.getDate()).padStart(2, '0');
                                selectedDatesSet.add(`${year}-${month}-${day}`);
                            });
                            
                            const sortedDates = Array.from(selectedDatesSet).sort();
                            availabilityInputHidden.value = JSON.stringify(sortedDates);
                            availabilityInputDisplay.value = formatDatesForDisplay(sortedDates);
                            updateSelectedCount();
                        }
                    });
                    } else {
                        // Fallback: use regular flatpickr with inline calendar
                        const flatpickrInstance = flatpickr(availabilityInputDisplay, {
                            mode: "multiple",
                            dateFormat: "Y-m-d",
                            minDate: "today",
                            enableTime: false,
                            defaultDate: existingDates.length > 0 ? existingDates : null,
                            inline: true,
                            clickOpens: true,
                            allowInput: false,
                            onChange: function(selectedDates, dateStr, instance) {
                                const datesArray = selectedDates.map(date => {
                                    const year = date.getFullYear();
                                    const month = String(date.getMonth() + 1).padStart(2, '0');
                                    const day = String(date.getDate()).padStart(2, '0');
                                    return `${year}-${month}-${day}`;
                                });
                                availabilityInputHidden.value = JSON.stringify(datesArray);
                                availabilityInputDisplay.value = formatDatesForDisplay(datesArray);
                            }
                        });
                    }
                }
            });
        </script>
@endsection
