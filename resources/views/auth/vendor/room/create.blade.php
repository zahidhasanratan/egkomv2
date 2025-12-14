@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Create Room</h3>
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
                                
                                <form action="{{ route('vendor-admin.room.store') }}" method="POST" enctype="multipart/form-data" id="room-create-form">
                                    @csrf
                                    <input name="hotel_id" value="{{ $hotel }}" type="hidden">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tabItem3">Room Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Room Facilities</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#Photos">Room Photos</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="room-activate d-flex justify-content-end">
                                            <div class="col-md-3 col-lg-3 col-xxl-3">
                                                <div class="form-group" style="margin-bottom: 0px;">
                                                    <label class="form-label">Room Active/Inactive Button</label>
                                                    <div class="form-check form-switch custom-control custom-switch checked" style="padding-left: 2rem; margin-bottom: 0px;">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="is_active" {{ old('is_active') ? 'checked' : '' }}>
                                                    </div>
                                                    <div id="alertMessage" style="display: none; color: red; margin-top:0px;"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Room Description -->
                                        <div class="tab-pane active" id="tabItem3">
                                            <div class="row gy-4">
                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Name</label>
                                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Room Name" required>
                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Number</label>
                                                        <input type="text" class="form-control" name="number" value="{{ old('number') }}" placeholder="Room number" required>
                                                        @error('number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Floor Number</label>
                                                        <input type="number" class="form-control" name="floor_number" value="{{ old('floor_number') }}" placeholder="Room Floor Number" required>
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
                                                            <input type="number" class="form-control" name="price_per_night" value="{{ old('price_per_night') }}" placeholder="Ex: BDT 1,500" required>
                                                            @error('price_per_night')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Weekend Price</label>
                                                            <input type="number" class="form-control" name="weekend_price" value="{{ old('weekend_price') }}" placeholder="Ex: BDT 1,500">
                                                            @error('weekend_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Holiday Price</label>
                                                            <input type="number" class="form-control" name="holiday_price" value="{{ old('holiday_price') }}" placeholder="Ex: BDT 1,500">
                                                            @error('holiday_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Discount Type</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="discount_type" id="discountAmount" value="amount" {{ old('discount_type') == 'amount' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="discountAmount">Discount by Amount</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="discount_type" id="discountPercentage" value="percentage" {{ old('discount_type') == 'percentage' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="discountPercentage">Discount by Percentage (%)</label>
                                                            </div>
                                                            <div class="mt-3 {{ old('discount_type') ? '' : 'hidden' }}" id="discountValueField">
                                                                <label for="discount_value" class="form-label">Enter Discount {{ old('discount_type') == 'amount' ? 'Amount' : 'Percentage (%)' }}</label>
                                                                <input type="number" class="form-control" name="discount_value" id="discount_value" value="{{ old('discount_value') }}" placeholder="{{ old('discount_type') == 'amount' ? 'Ex: 3500' : 'Ex: 15 %' }}">
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
                                                                        <span class="count male-count" id="totalPersons">{{ old('total_persons', 0) }}</span>
                                                                        <input type="hidden" name="total_persons" id="totalPersonsInput" value="{{ old('total_persons', 0) }}">
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
                                                                <input type="text" class="form-control" id="availability_dates" name="availability_dates" value="{{ old('availability_dates') }}" placeholder="Click to open calendar and select dates" readonly style="margin-bottom: 15px; cursor: pointer;">
                                                                <small class="form-text text-muted" style="display: block; margin-bottom: 15px;">
                                                                    <strong>How to select dates:</strong><br>
                                                                    • <strong>Click the input field</strong> to open/close the calendar<br>
                                                                    • <strong>Drag</strong> from one date to another to select a range<br>
                                                                    • <strong>Click</strong> individual dates to toggle selection (click again to deselect)<br>
                                                                    • The room will be available only on selected dates
                                                                </small>
                                                                <div id="availability_calendar_wrapper" style="max-width: 100%; margin: 0 auto; display: none;"></div>
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
                                                            <textarea class="form-control no-resize" name="description" id="default-textarea">{{ old('description') }}</textarea>
                                                            @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Size (sq. ft / sq. m)</label>
                                                        <input type="number" class="form-control" name="size" value="{{ old('size') }}" placeholder="Ex: 1200 SFT" required>
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
                                                                        <span id="totalRooms" class="count male-count">{{ old('total_rooms', 0) }}</span>
                                                                        <input type="hidden" name="total_rooms" id="totalRoomsInput" value="{{ old('total_rooms', 0) }}">
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
                                                                        <span id="totalWashrooms" class="count male-count">{{ old('total_washrooms', 0) }}</span>
                                                                        <input type="hidden" name="total_washrooms" id="totalWashroomsInput" value="{{ old('total_washrooms', 0) }}">
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
                                                                        <span id="totalBeds" class="count male-count">{{ old('total_beds', 0) }}</span>
                                                                        <input type="hidden" name="total_beds" id="totalBedsInput" value="{{ old('total_beds', 0) }}">
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
                                                        <input type="text" class="form-control" name="wifi_details" value="{{ old('wifi_details') }}" placeholder="WiFi Details/Password">
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

                                                    <!-- Room Facilities & Amenities -->
                                                    <h5 class="mt-3 mb-2"><strong>Room Facilities & Amenities</strong></h5>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="AC" {{ in_array('AC', old('appliances', [])) ? 'checked' : '' }}> AC</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Smart TV" {{ in_array('Smart TV', old('appliances', [])) ? 'checked' : '' }}> Smart TV</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Wi-Fi" {{ in_array('Wi-Fi', old('appliances', [])) ? 'checked' : '' }}> Wi-Fi</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Minibar" {{ in_array('Minibar', old('appliances', [])) ? 'checked' : '' }}> Minibar</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Safe" {{ in_array('Safe', old('appliances', [])) ? 'checked' : '' }}> Safe</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Desk" {{ in_array('Desk', old('appliances', [])) ? 'checked' : '' }}> Desk</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Wardrobe" {{ in_array('Wardrobe', old('appliances', [])) ? 'checked' : '' }}> Wardrobe</label><br>
                                                    
                                                    <!-- Custom Facilities Container -->
                                                    <div class="custom-appliances-container mt-3" data-section="appliances"></div>
                                                    
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
                                                                <option value="King" {{ old('room_info.bed_type') == 'King' ? 'selected' : '' }}>King</option>
                                                                <option value="Queen" {{ old('room_info.bed_type') == 'Queen' ? 'selected' : '' }}>Queen</option>
                                                                <option value="Twin" {{ old('room_info.bed_type') == 'Twin' ? 'selected' : '' }}>Twin</option>
                                                                <option value="Single" {{ old('room_info.bed_type') == 'Single' ? 'selected' : '' }}>Single</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Number of Beds</label>
                                                            <input type="number" class="form-control" name="room_info[number_of_beds]" value="{{ old('room_info.number_of_beds', '') }}" placeholder="0" min="0">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Custom Bed Type</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="custom-bed-type-input" placeholder="Enter custom bed type">
                                                                <button type="button" class="btn btn-primary btn-sm" id="add-bed-type-btn">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="custom-bed-types-container" class="mt-2"></div>

                                                    <!-- Maximum Occupancy -->
                                                    <h5 class="mt-4 mb-2"><strong>Maximum Occupancy</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Adults</label>
                                                            <input type="number" class="form-control" name="room_info[max_adults]" value="{{ old('room_info.max_adults', '') }}" placeholder="0" min="0">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Children</label>
                                                            <input type="number" class="form-control" name="room_info[max_children]" value="{{ old('room_info.max_children', '') }}" placeholder="0" min="0">
                                                        </div>
                                                    </div>

                                                    <!-- Layout Details -->
                                                    <h5 class="mt-4 mb-2"><strong>Layout Details</strong></h5>
                                                    <label><input type="checkbox" name="room_info[layout][]" class="checkbox-item-room-info" value="Apartment Style" {{ in_array('Apartment Style', old('room_info.layout', [])) ? 'checked' : '' }}> Apartment Style</label><br>
                                                    <label><input type="checkbox" name="room_info[layout][]" class="checkbox-item-room-info" value="Suite" {{ in_array('Suite', old('room_info.layout', [])) ? 'checked' : '' }}> Suite</label><br>
                                                    <label><input type="checkbox" name="room_info[layout][]" class="checkbox-item-room-info" value="Studio" {{ in_array('Studio', old('room_info.layout', [])) ? 'checked' : '' }}> Studio</label><br>
                                                    <label><input type="checkbox" name="room_info[layout][]" class="checkbox-item-room-info" value="Duplex" {{ in_array('Duplex', old('room_info.layout', [])) ? 'checked' : '' }}> Duplex</label><br>
                                                    
                                                    <!-- Custom Layout Container -->
                                                    <div class="custom-layout-container mt-3"></div>
                                                    
                                                    <!-- Add More Layout -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-layout-input" placeholder="Enter custom layout type">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-layout-btn">Add</button>
                                                        </div>
                                                    </div>

                                                    <!-- View from the Room -->
                                                    <h5 class="mt-4 mb-2"><strong>View from the Room</strong></h5>
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="Sea View" {{ in_array('Sea View', old('room_info.view', [])) ? 'checked' : '' }}> Sea View</label><br>
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="City View" {{ in_array('City View', old('room_info.view', [])) ? 'checked' : '' }}> City View</label><br>
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="Garden View" {{ in_array('Garden View', old('room_info.view', [])) ? 'checked' : '' }}> Garden View</label><br>
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="Partial View" {{ in_array('Partial View', old('room_info.view', [])) ? 'checked' : '' }}> Partial View</label><br>
                                                    <label><input type="checkbox" name="room_info[view][]" class="checkbox-item-room-info" value="No View" {{ in_array('No View', old('room_info.view', [])) ? 'checked' : '' }}> No View</label><br>
                                                    
                                                    <!-- Custom View Container -->
                                                    <div class="custom-view-container mt-3"></div>
                                                    
                                                    <!-- Add More View -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-view-input" placeholder="Enter custom view type">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-view-btn">Add</button>
                                                        </div>
                                                    </div>

                                                    <!-- Bathroom Details -->
                                                    <h5 class="mt-4 mb-2"><strong>Bathroom Details</strong></h5>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Attached" {{ in_array('Attached', old('room_info.bathroom', [])) ? 'checked' : '' }}> Attached</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Private" {{ in_array('Private', old('room_info.bathroom', [])) ? 'checked' : '' }}> Private</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Shower" {{ in_array('Shower', old('room_info.bathroom', [])) ? 'checked' : '' }}> Shower</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Bathtub" {{ in_array('Bathtub', old('room_info.bathroom', [])) ? 'checked' : '' }}> Bathtub</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Toiletries" {{ in_array('Toiletries', old('room_info.bathroom', [])) ? 'checked' : '' }}> Toiletries</label><br>
                                                    <label><input type="checkbox" name="room_info[bathroom][]" class="checkbox-item-room-info" value="Hot Water" {{ in_array('Hot Water', old('room_info.bathroom', [])) ? 'checked' : '' }}> Hot Water</label><br>
                                                    
                                                    <!-- Custom Bathroom Container -->
                                                    <div class="custom-bathroom-container mt-3"></div>
                                                    
                                                    <!-- Add More Bathroom -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-bathroom-input" placeholder="Enter custom bathroom feature">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-bathroom-btn">Add</button>
                                                        </div>
                                                    </div>

                                                    <!-- Kitchen Facilities -->
                                                    <h5 class="mt-4 mb-2"><strong>Kitchen Facilities</strong></h5>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Fully Equipped" {{ in_array('Fully Equipped', old('room_info.kitchen_facilities', [])) ? 'checked' : '' }}> Fully Equipped</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Partial" {{ in_array('Partial', old('room_info.kitchen_facilities', [])) ? 'checked' : '' }}> Partial</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="None" {{ in_array('None', old('room_info.kitchen_facilities', [])) ? 'checked' : '' }}> None</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Fridge" {{ in_array('Fridge', old('room_info.kitchen_facilities', [])) ? 'checked' : '' }}> Fridge</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Stove" {{ in_array('Stove', old('room_info.kitchen_facilities', [])) ? 'checked' : '' }}> Stove</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Microwave" {{ in_array('Microwave', old('room_info.kitchen_facilities', [])) ? 'checked' : '' }}> Microwave</label><br>
                                                    <label><input type="checkbox" name="room_info[kitchen_facilities][]" class="checkbox-item-room-info" value="Utensils" {{ in_array('Utensils', old('room_info.kitchen_facilities', [])) ? 'checked' : '' }}> Utensils</label><br>
                                                    
                                                    <!-- Custom Kitchen Container -->
                                                    <div class="custom-kitchen-container mt-3"></div>
                                                    
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
                                                            <option value="Yes" {{ old('room_info.balcony') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ old('room_info.balcony') == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <!-- Accessibility Features -->
                                                    <h5 class="mt-4 mb-2"><strong>Accessibility Features</strong></h5>
                                                    <label><input type="checkbox" name="room_info[accessibility][]" class="checkbox-item-room-info" value="Wheelchair Friendly" {{ in_array('Wheelchair Friendly', old('room_info.accessibility', [])) ? 'checked' : '' }}> Wheelchair Friendly</label><br>
                                                    <label><input type="checkbox" name="room_info[accessibility][]" class="checkbox-item-room-info" value="Elevator Access" {{ in_array('Elevator Access', old('room_info.accessibility', [])) ? 'checked' : '' }}> Elevator Access</label><br>
                                                    
                                                    <!-- Custom Accessibility Container -->
                                                    <div class="custom-accessibility-container mt-3"></div>
                                                    
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
                                                            <option value="Smoking Allowed" {{ old('room_info.smoking_policy') == 'Smoking Allowed' ? 'selected' : '' }}>Smoking Allowed</option>
                                                            <option value="Non-Smoking" {{ old('room_info.smoking_policy') == 'Non-Smoking' ? 'selected' : '' }}>Non-Smoking</option>
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

                                            <!-- Additional Bed Policy & Fee -->
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3"><strong>Additional Bed Policy & Fee</strong></h5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                                <label class="form-label">Fee Amount</label>
                                                                <input type="number" class="form-control" name="additional_info[bed_fee_amount]" value="{{ old('additional_info.bed_fee_amount', '') }}" placeholder="e.g., 1000" min="0" step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Currency</label>
                                                                <input type="text" class="form-control" name="additional_info[bed_fee_currency]" value="{{ old('additional_info.bed_fee_currency', 'BDT') }}" placeholder="e.g., BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Per Unit</label>
                                                                <input type="text" class="form-control" name="additional_info[bed_fee_unit]" value="{{ old('additional_info.bed_fee_unit', 'Per Bed') }}" placeholder="e.g., Per Bed">
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
                                                                <input type="text" class="form-control" name="additional_info[children_free_age]" value="{{ old('additional_info.children_free_age', '') }}" placeholder="e.g., Under 5 years">
                                                </div>
                                            </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Extra Adult Charge</label>
                                                                <input type="text" class="form-control" name="additional_info[extra_adult_charge]" value="{{ old('additional_info.extra_adult_charge', '') }}" placeholder="e.g., 500 BDT per adult">
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
                                                                <input type="number" class="form-control" name="additional_info[laundry_fee_amount]" value="{{ old('additional_info.laundry_fee_amount', '') }}" placeholder="e.g., 500" min="0" step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Currency</label>
                                                                <input type="text" class="form-control" name="additional_info[laundry_fee_currency]" value="{{ old('additional_info.laundry_fee_currency', 'BDT') }}" placeholder="e.g., BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Per Unit</label>
                                                                <input type="text" class="form-control" name="additional_info[laundry_fee_unit]" value="{{ old('additional_info.laundry_fee_unit', 'Per Person') }}" placeholder="e.g., Per Person">
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
                                                            <option value="Daily" {{ old('additional_info.housekeeping_type') == 'Daily' ? 'selected' : '' }}>Daily</option>
                                                            <option value="Weekly" {{ old('additional_info.housekeeping_type') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                                            <option value="On Request" {{ old('additional_info.housekeeping_type') == 'On Request' ? 'selected' : '' }}>On Request</option>
                                                            <option value="Paid" {{ old('additional_info.housekeeping_type') == 'Paid' ? 'selected' : '' }}>Paid</option>
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
                                                                <input type="text" class="form-control" name="additional_info[checkin_time]" value="{{ old('additional_info.checkin_time', '') }}" placeholder="e.g., 2:00 PM">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Standard Check-out Time</label>
                                                                <input type="text" class="form-control" name="additional_info[checkout_time]" value="{{ old('additional_info.checkout_time', '') }}" placeholder="e.g., 12:00 PM">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Late Check-out Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[late_checkout_fee]" value="{{ old('additional_info.late_checkout_fee', '') }}" placeholder="e.g., 500 BDT per hour">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Early Check-in Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[early_checkin_fee]" value="{{ old('additional_info.early_checkin_fee', '') }}" placeholder="e.g., 500 BDT per hour">
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
                                                                <input type="text" class="form-control" name="additional_info[security_deposit_amount]" value="{{ old('additional_info.security_deposit_amount', '') }}" placeholder="e.g., 5000 BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Refundable Terms</label>
                                                                <input type="text" class="form-control" name="additional_info[security_deposit_refundable]" value="{{ old('additional_info.security_deposit_refundable', '') }}" placeholder="e.g., Fully refundable after check-out">
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
                                                                    <option value="Free" {{ old('additional_info.parking_availability') == 'Free' ? 'selected' : '' }}>Free</option>
                                                                    <option value="Paid" {{ old('additional_info.parking_availability') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                                    <option value="Not Available" {{ old('additional_info.parking_availability') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Charge Amount</label>
                                                                <input type="number" class="form-control" name="additional_info[parking_fee_amount]" value="{{ old('additional_info.parking_fee_amount', '') }}" placeholder="e.g., 500" min="0" step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Per Unit</label>
                                                                <input type="text" class="form-control" name="additional_info[parking_fee_unit]" value="{{ old('additional_info.parking_fee_unit', 'Per Day Per Car') }}" placeholder="e.g., Per Day Per Car">
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
                                                            <option value="Allowed" {{ old('additional_info.pet_policy') == 'Allowed' ? 'selected' : '' }}>Allowed</option>
                                                            <option value="Not Allowed" {{ old('additional_info.pet_policy') == 'Not Allowed' ? 'selected' : '' }}>Not Allowed</option>
                                                            <option value="Extra Charge" {{ old('additional_info.pet_policy') == 'Extra Charge' ? 'selected' : '' }}>Extra Charge</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label class="form-label">Pet Fee (if Extra Charge)</label>
                                                        <input type="text" class="form-control" name="additional_info[pet_fee]" value="{{ old('additional_info.pet_fee', '') }}" placeholder="e.g., 500 BDT per pet per day">
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
                                                            <option value="Buffet" {{ old('additional_info.meal_options') == 'Buffet' ? 'selected' : '' }}>Buffet</option>
                                                            <option value="Regular Breakfast Included" {{ old('additional_info.meal_options') == 'Regular Breakfast Included' ? 'selected' : '' }}>Regular Breakfast Included</option>
                                                            <option value="On Request" {{ old('additional_info.meal_options') == 'On Request' ? 'selected' : '' }}>On Request</option>
                                                            <option value="Paid Separately" {{ old('additional_info.meal_options') == 'Paid Separately' ? 'selected' : '' }}>Paid Separately</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label class="form-label">Meal Fee (if Paid Separately)</label>
                                                        <input type="text" class="form-control" name="additional_info[meal_fee]" value="{{ old('additional_info.meal_fee', '') }}" placeholder="e.g., 300 BDT per person">
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
                                                                    <option value="Free" {{ old('additional_info.airport_pickup') == 'Free' ? 'selected' : '' }}>Free</option>
                                                                    <option value="Paid" {{ old('additional_info.airport_pickup') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                                    <option value="Not Available" {{ old('additional_info.airport_pickup') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label class="form-label">Airport Pickup Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[airport_pickup_fee]" value="{{ old('additional_info.airport_pickup_fee', '') }}" placeholder="e.g., 1000 BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Shuttle Service</label>
                                                                <select class="form-control" name="additional_info[shuttle_service]">
                                                                    <option value="">Select Option</option>
                                                                    <option value="Free" {{ old('additional_info.shuttle_service') == 'Free' ? 'selected' : '' }}>Free</option>
                                                                    <option value="Paid" {{ old('additional_info.shuttle_service') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                                    <option value="Not Available" {{ old('additional_info.shuttle_service') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label class="form-label">Shuttle Service Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[shuttle_service_fee]" value="{{ old('additional_info.shuttle_service_fee', '') }}" placeholder="e.g., 500 BDT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Car Rental</label>
                                                                <select class="form-control" name="additional_info[car_rental]">
                                                                    <option value="">Select Option</option>
                                                                    <option value="Available" {{ old('additional_info.car_rental') == 'Available' ? 'selected' : '' }}>Available</option>
                                                                    <option value="Not Available" {{ old('additional_info.car_rental') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label class="form-label">Car Rental Fee</label>
                                                                <input type="text" class="form-control" name="additional_info[car_rental_fee]" value="{{ old('additional_info.car_rental_fee', '') }}" placeholder="e.g., 2000 BDT per day">
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
                                                        <textarea class="form-control" name="additional_info[other_charges]" rows="3" placeholder="Enter any other charges or policies">{{ old('additional_info.other_charges', '') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-15">
                                                <div class="col-md-12">
                                                    <h3 class="can-tittle">Cancellation Policies</h3>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox"
                                                                   name="cancellation_policies[]" value="Flexible"
                                                                   id="flexSwitchCheckFlexible"
                                                                {{ in_array('Flexible', old('cancellation_policies', $hotel->cancellation_policies ?? [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexSwitchCheckFlexible">
                                                                Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox"
                                                                   name="cancellation_policies[]" value="Non-refundable"
                                                                   id="flexSwitchCheckNonRefundable"
                                                                {{ in_array('Non-refundable', old('cancellation_policies', $hotel->cancellation_policies ?? [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexSwitchCheckNonRefundable">
                                                                Non-refundable (Regardless of the cancellation window, customers will not get any refund under this.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox"
                                                                   name="cancellation_policies[]" value="Partially refundable"
                                                                   id="flexSwitchCheckPartially"
                                                                {{ in_array('Partially refundable', old('cancellation_policies', $hotel->cancellation_policies ?? [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexSwitchCheckPartially">
                                                                Partially refundable (Cancellations less than 24 hours… after deducting a 30% cancellation fee.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox"
                                                                   name="cancellation_policies[]" value="Long-term/Monthly staying policy"
                                                                   id="flexSwitchCheckLongTerm"
                                                                {{ in_array('Long-term/Monthly staying policy', old('cancellation_policies', $hotel->cancellation_policies ?? [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexSwitchCheckLongTerm">
                                                                Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Validation Error --}}
                                                @error('cancellation_policies')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                {{-- Warning Message --}}
                                                <div class="col-lg-12">
                                                    <small id="policy-warning" class="text-danger" style="display:none;">⚠️ Maximum 2 can be Selected</small>
                                                </div>
                                            </div>

                                            {{-- JavaScript --}}
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    const checkboxes = document.querySelectorAll('.cancellation-checkbox');
                                                    const warning = document.getElementById('policy-warning');

                                                    checkboxes.forEach(cb => {
                                                        cb.addEventListener('change', function () {
                                                            const checked = document.querySelectorAll('.cancellation-checkbox:checked').length;

                                                            if (checked > 2) {
                                                                this.checked = false; // undo last check
                                                                warning.style.display = 'block';
                                                                setTimeout(() => {
                                                                    warning.style.display = 'none';
                                                                }, 2000); // auto-hide after 2s
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>


                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" name="save_draft" value="1">Save & Drafts</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tabItem4">
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
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Bed" {{ in_array('Bed', old('furniture', [])) ? 'checked' : '' }}> Bed</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Dining Table with Chair" {{ in_array('Dining Table with Chair', old('furniture', [])) ? 'checked' : '' }}> Dining Table with Chair</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Sofa/Couch" {{ in_array('Sofa/Couch', old('furniture', [])) ? 'checked' : '' }}> Sofa/Couch</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Tea Table" {{ in_array('Tea Table', old('furniture', [])) ? 'checked' : '' }}> Tea Table</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Bedside Table" {{ in_array('Bedside Table', old('furniture', [])) ? 'checked' : '' }}> Bedside Table</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Shoe Rack" {{ in_array('Shoe Rack', old('furniture', [])) ? 'checked' : '' }}> Shoe Rack</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Clothing Cabinet" {{ in_array('Clothing Cabinet', old('furniture', [])) ? 'checked' : '' }}> Clothing Cabinet</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Clothes Drying Hanger" {{ in_array('Clothes Drying Hanger', old('furniture', [])) ? 'checked' : '' }}> Clothes Drying Hanger</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Iron Stand" {{ in_array('Iron Stand', old('furniture', [])) ? 'checked' : '' }}> Iron Stand</label><br>
                                                        <label><input type="checkbox" name="furniture[]" class="checkbox-item checkbox-item-furniture" value="Locker/Safe" {{ in_array('Locker/Safe', old('furniture', [])) ? 'checked' : '' }}> Locker/Safe</label><br>
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
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Soap" {{ in_array('Soap', old('amenities', [])) ? 'checked' : '' }}> Soap</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Tissue" {{ in_array('Tissue', old('amenities', [])) ? 'checked' : '' }}> Tissue</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Shampoo" {{ in_array('Shampoo', old('amenities', [])) ? 'checked' : '' }}> Shampoo</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Toothbrush" {{ in_array('Toothbrush', old('amenities', [])) ? 'checked' : '' }}> Toothbrush</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Towel" {{ in_array('Towel', old('amenities', [])) ? 'checked' : '' }}> Towel</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Water bottle" {{ in_array('Water bottle', old('amenities', [])) ? 'checked' : '' }}> Water bottle</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Free laundry" {{ in_array('Free laundry', old('amenities', [])) ? 'checked' : '' }}> Free laundry</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Air freshener" {{ in_array('Air freshener', old('amenities', [])) ? 'checked' : '' }}> Air freshener</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Fruit basket" {{ in_array('Fruit basket', old('amenities', [])) ? 'checked' : '' }}> Fruit basket</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Complimentary drinks" {{ in_array('Complimentary drinks', old('amenities', [])) ? 'checked' : '' }}> Complimentary drinks</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-amenities" value="Buffet breakfast" {{ in_array('Buffet breakfast', old('amenities', [])) ? 'checked' : '' }}> Buffet breakfast</label><br>
                                                    
                                                    <!-- Custom Amenities Container for Facilities Tab -->
                                                    <div class="custom-amenities-container-facilities mt-3" data-section="amenities"></div>
                                                    
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
                                                        <button type="submit" class="btn btn-primary btn-submit">Submit</button>
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

                                                        // Furniture - Only in Facilities tab, not in Room Details tab
                                                        // So we don't need to sync furniture from Room Details
                                                        // The furniture items are already in the Facilities tab

                                                        // Amenities - NOT in Room Details tab, only in Facilities tab
                                                        // So we don't sync amenities from Room Details
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
                                                        checkbox.checked = true; // Check by default so it gets saved
                                                        
                                                        const textNode = document.createTextNode(value);
                                                        label.appendChild(checkbox);
                                                        label.appendChild(textNode);
                                                        label.appendChild(document.createElement('br'));
                                                        
                                                        container.appendChild(label);
                                                        
                                                        // Add sync functionality if it's in Room Details tab
                                                        if (container.closest('#tabItem3')) {
                                                            checkbox.addEventListener('change', function() {
                                                                const facilitiesCheckbox = document.querySelector(`#tabItem4 input[name="${checkbox.name}"][value="${value}"]`);
                                                                if (facilitiesCheckbox) facilitiesCheckbox.checked = this.checked;
                                                            });
                                                        }
                                                        
                                                        // Add sync functionality if it's in Facilities tab
                                                        if (container.closest('#tabItem4')) {
                                                            checkbox.addEventListener('change', function() {
                                                                const detailsCheckbox = document.querySelector(`#tabItem3 input[name="${checkbox.name}"][value="${value}"]`);
                                                                if (detailsCheckbox) detailsCheckbox.checked = this.checked;
                                                            });
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
                                                            // Add only to Facilities tab
                                                            const facilitiesContainer = document.querySelector('#tabItem4 .custom-appliances-container-facilities');
                                                            createCheckbox('appliances', trimmedValue, 'checkbox-item-appliances', facilitiesContainer, true);
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
                                                            // Add only to Facilities tab
                                                            const facilitiesContainer = document.querySelector('#tabItem4 .custom-furniture-container-facilities');
                                                            createCheckbox('furniture', trimmedValue, 'checkbox-item-furniture', facilitiesContainer, true);
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
                                                    
                                                    // Debug: Log form data before submission to verify custom items are included
                                                    const form = document.querySelector('form[action*="room.store"]');
                                                    if (form) {
                                                        form.addEventListener('submit', function(e) {
                                                            const formData = new FormData(this);
                                                            const customAppliances = formData.getAll('custom_appliances[]');
                                                            const customFurniture = formData.getAll('custom_furniture[]');
                                                            const customAmenities = formData.getAll('custom_amenities[]');
                                                            console.log('Custom Appliances being submitted:', customAppliances);
                                                            console.log('Custom Furniture being submitted:', customFurniture);
                                                            console.log('Custom Amenities being submitted:', customAmenities);
                                                        });
                                                    }
                                                });
                                            </script>
                                        </div>

                                        <!-- Photos Tab -->
                                        <div class="tab-pane" id="Photos">
                                            <div class="row gy-4">
                                                @php
                                                    $photo_categories = [
                                                        'feature_main' => 'Main Feature Photo (Shown as primary image)',
                                                        'bedroom' => 'Bedroom (Main Bedroom Photos)',
                                                        'washroom' => 'Washroom (Washroom Photos)',
                                                        'balcony' => 'Balcony (Balcony Photos)',
                                                        'living_dining' => 'Living & Dining (Living Room & Dining Room Photos)',
                                                        'furniture' => 'Furniture (Bed, Sofa, Table, Chair, etc.)',
                                                        'appliances' => 'Appliances (AC, TV, Fridge, Geyser, etc.)',
                                                        'kitchen' => 'Kitchen (Kitchen & Kitchen Items – Crockery, Utensils, Stove, etc.)',
                                                        'amenity' => 'Room Amenities (All in-room / apartment amenities)',
                                                        'bedroom2' => '2nd Bedroom Photos (If Available)',
                                                        'bedroom3' => '3rd Bedroom Photos (If Available)',
                                                        'washroom2' => '2nd Washroom Photos (If Available)',
                                                        'washroom3' => '3rd Washroom Photos (If Available)',
                                                    ];
                                                @endphp

                                                @foreach ($photo_categories as $category => $label)
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group mt-15">
                                                            <label class="form-label">{{ $label }}</label>
                                                            <div class="multiple-upload-container" id="upload-container-{{ $category }}">
                                                                <input type="file" class="multiple-file-input" name="{{ $category }}_photos[]" accept="image/*" multiple>
                                                                <label class="upload-label">Select Multiple Images</label>
                                                                <div class="multiple-thumbnail-gallery"></div>
                                                            </div>
                                                            @error("{$category}_photos.*")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="row">
                                                    <div class="col-sm-2 col-md-2 mt-15">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
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
            .multiple-thumbnail-item { position: relative; display: inline-block; margin: 5px; }
            .multiple-remove-btn {
                position: absolute; top: -10px; right: -10px; background: red; color: white;
                border: none; border-radius: 50%; width: 20px; height: 20px; line-height: 20px; cursor: pointer;
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

                let personCount = {{ old('total_persons', 0) }};
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

                let roomCount = {{ old('total_rooms', 0) }};
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

                let washroomCount = {{ old('total_washrooms', 0) }};
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

                let bedCount = {{ old('total_beds', 0) }};
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

            document.addEventListener('DOMContentLoaded', () => {
                const uploadedImages = {};
                function initializeMultipleUpload(container) {
                    const fileInput = container.querySelector('.multiple-file-input');
                    const thumbnailGallery = container.querySelector('.multiple-thumbnail-gallery');
                    const containerId = container.id;
                    uploadedImages[containerId] = [];
                    fileInput.addEventListener('change', function(event) {
                        const files = event.target.files;
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
                    });
                }
                const uploadContainers = document.querySelectorAll('.multiple-upload-container');
                uploadContainers.forEach(container => {
                    initializeMultipleUpload(container);
                });
                
            });
        </script>
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        
        <script>
            // Initialize Flatpickr for availability dates with drag selection
            document.addEventListener('DOMContentLoaded', function() {
                const availabilityInput = document.getElementById('availability_dates');
                
                if (availabilityInput) {
                    // Get existing dates from old input if any
                    let existingDates = [];
                    if (availabilityInput.value) {
                        try {
                            existingDates = JSON.parse(availabilityInput.value);
                        } catch(e) {
                            // If not JSON, try comma-separated dates
                            existingDates = availabilityInput.value.split(',').map(d => d.trim()).filter(d => d);
                        }
                    }
                    
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
                        
                        // Toggle calendar visibility on input click
                        availabilityInput.addEventListener('click', function(e) {
                            e.stopPropagation();
                            const isVisible = calendarWrapper.style.display === 'block';
                            calendarWrapper.style.display = isVisible ? 'none' : 'block';
                        });
                        
                        // Close calendar when clicking outside
                        document.addEventListener('click', function(e) {
                            if (calendarWrapper && 
                                !calendarWrapper.contains(e.target) && 
                                e.target !== availabilityInput) {
                                calendarWrapper.style.display = 'none';
                            }
                        });
                        
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
                                                const dDateStr = d.getAttribute('aria-label');
                                                if (dDateStr) {
                                                    const dDate = new Date(dDateStr);
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
                                
                                // Update hidden input value
                                const sortedDates = Array.from(selectedDatesSet).sort();
                                availabilityInput.value = JSON.stringify(sortedDates);
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
                                    availabilityInput.value = JSON.stringify(sortedDates);
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
                            availabilityInput.value = JSON.stringify(sortedDates);
                            updateSelectedCount();
                        }
                    });
                    } else {
                        // Fallback: use regular flatpickr with inline calendar
                        const flatpickrInstance = flatpickr(availabilityInput, {
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
                                availabilityInput.value = JSON.stringify(datesArray);
                            }
                        });
                    }
                }
            });
        </script>
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
                            // Scroll to first error field
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
                        // If SweetAlert not loaded yet, wait for it
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
                const form = document.getElementById('room-create-form');
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
                                    // Scroll to first error field
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
@endsection
