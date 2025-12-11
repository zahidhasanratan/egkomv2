@extends('auth.layout.vendor_admin_layout')

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
                                <form action="{{ route('vendor-admin.room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
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
                                                        <input type="number" class="form-control" name="floor_number" value="{{ old('floor_number', $room->floor_number) }}" placeholder="Room Floor Number" required>
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
                                                    @endphp

                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="AC" {{ in_array('AC', $appliances) ? 'checked' : '' }}> AC</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="TV" {{ in_array('TV', $appliances) ? 'checked' : '' }}> TV</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Fridge" {{ in_array('Fridge', $appliances) ? 'checked' : '' }}> Fridge</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Microwave" {{ in_array('Microwave', $appliances) ? 'checked' : '' }}> Microwave</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Fan" {{ in_array('Fan', $appliances) ? 'checked' : '' }}> Fan</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Lamp" {{ in_array('Lamp', $appliances) ? 'checked' : '' }}> Lamp</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Light" {{ in_array('Light', $appliances) ? 'checked' : '' }}> Light</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Water heater/Geyser" {{ in_array('Water heater/Geyser', $appliances) ? 'checked' : '' }}> Water heater/Geyser</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="WiFi Router" {{ in_array('WiFi Router', $appliances) ? 'checked' : '' }}> WiFi Router</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Crockeries" {{ in_array('Crockeries', $appliances) ? 'checked' : '' }}> Crockeries</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Gas Stove" {{ in_array('Gas Stove', $appliances) ? 'checked' : '' }}> Gas Stove</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Electric Kettle" {{ in_array('Electric Kettle', $appliances) ? 'checked' : '' }}> Electric Kettle</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Room Heater" {{ in_array('Room Heater', $appliances) ? 'checked' : '' }}> Room Heater</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Hair Dryer" {{ in_array('Hair Dryer', $appliances) ? 'checked' : '' }}> Hair Dryer</label><br>
                                                    
                                                    <!-- Custom Appliances Container -->
                                                    <div class="custom-appliances-container mt-3" data-section="appliances">
                                                        @php
                                                            $fixedAppliances = ['AC', 'TV', 'Fridge', 'Microwave', 'Fan', 'Lamp', 'Light', 'Water heater/Geyser', 'WiFi Router', 'Crockeries', 'Gas Stove', 'Electric Kettle', 'Room Heater', 'Hair Dryer'];
                                                            $customAppliances = array_diff($appliances, $fixedAppliances);
                                                        @endphp
                                                        @foreach($customAppliances as $customAppliance)
                                                            <label><input type="checkbox" name="custom_appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="{{ $customAppliance }}" checked> {{ $customAppliance }}</label><br>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- Add More Appliances -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-appliance-input" placeholder="Enter custom appliance name">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-appliance-btn">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
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
                                            </script>

                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Additional Room Information</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input" name="additional-info-all" id="additional-info-all">
                                                                <label class="custom-control-label" for="additional-info-all">Select All</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $furniture = old('furniture', is_string($room->furniture) ? (json_decode($room->furniture, true) ?? []) : ($room->furniture ?? []));
                                                        if (!is_array($furniture)) {
                                                            $furniture = [];
                                                        }
                                                    @endphp

                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Bed" {{ in_array('Bed', $furniture) ? 'checked' : '' }}> Bed</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Dining Table with Chair" {{ in_array('Dining Table with Chair', $furniture) ? 'checked' : '' }}> Dining Table with Chair</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Sofa/Couch" {{ in_array('Sofa/Couch', $furniture) ? 'checked' : '' }}> Sofa/Couch</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Tea Table" {{ in_array('Tea Table', $furniture) ? 'checked' : '' }}> Tea Table</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Bedside Table" {{ in_array('Bedside Table', $furniture) ? 'checked' : '' }}> Bedside Table</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Shoe Rack" {{ in_array('Shoe Rack', $furniture) ? 'checked' : '' }}> Shoe Rack</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Clothing Cabinet" {{ in_array('Clothing Cabinet', $furniture) ? 'checked' : '' }}> Clothing Cabinet</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Clothes Drying Hanger" {{ in_array('Clothes Drying Hanger', $furniture) ? 'checked' : '' }}> Clothes Drying Hanger</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Iron Stand" {{ in_array('Iron Stand', $furniture) ? 'checked' : '' }}> Iron Stand</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Locker/Safe" {{ in_array('Locker/Safe', $furniture) ? 'checked' : '' }}> Locker/Safe</label><br>
                                                    
                                                    <!-- Custom Furniture Container -->
                                                    <div class="custom-furniture-container mt-3" data-section="furniture">
                                                        @php
                                                            $fixedFurniture = ['Bed', 'Dining Table with Chair', 'Sofa/Couch', 'Tea Table', 'Bedside Table', 'Shoe Rack', 'Clothing Cabinet', 'Clothes Drying Hanger', 'Iron Stand', 'Locker/Safe'];
                                                            $customFurniture = array_diff($furniture, $fixedFurniture);
                                                        @endphp
                                                        @foreach($customFurniture as $customFurn)
                                                            <label><input type="checkbox" name="custom_furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="{{ $customFurn }}" checked> {{ $customFurn }}</label><br>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <!-- Add More Furniture -->
                                                    <div class="add-more-section mt-3">
                                                        <div class="input-group" style="max-width: 400px;">
                                                            <input type="text" class="form-control" id="custom-furniture-input" placeholder="Enter custom furniture name">
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-furniture-btn">Add Furniture</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                (function initAdditionalInfoSelectAll() {
                                                    const containers = document.querySelectorAll('.checkbox-section');
                                                    const container = containers[containers.length - 1];
                                                    if (!container) return;

                                                    const selectAll = container.querySelector('#additional-info-all');
                                                    if (!selectAll) return;

                                                    container.addEventListener('change', function (e) {
                                                        if (e.target === selectAll) {
                                                            const items = container.querySelectorAll('.checkbox-item-additional');
                                                            items.forEach(chk => { chk.checked = selectAll.checked; });
                                                            return;
                                                        }

                                                        if (e.target.classList.contains('checkbox-item-additional')) {
                                                            const items = container.querySelectorAll('.checkbox-item-additional');
                                                            const checkedCount = container.querySelectorAll('.checkbox-item-additional:checked').length;
                                                            selectAll.checked = (checkedCount === items.length && items.length > 0);
                                                        }
                                                    });

                                                    const items = container.querySelectorAll('.checkbox-item-additional');
                                                    const checkedCount = container.querySelectorAll('.checkbox-item-additional:checked').length;
                                                    selectAll.checked = (checkedCount === items.length && items.length > 0);
                                                })();
                                            </script>

                                            <div class="row mt-15">
                                                <div class="col-md-12">
                                                    <h3 class="can-tittle">Cancellation Policy</h3>
                                                </div>

                                                @php
                                                    $cancellationPolicies = old('cancellation_policy', is_string($room->cancellation_policy) ? (json_decode($room->cancellation_policy, true) ?? []) : ($room->cancellation_policy ?? []));
                                                    if (!is_array($cancellationPolicies)) {
                                                        $cancellationPolicies = [];
                                                    }
                                                @endphp

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox" name="cancellation_policy[]" id="flexiblePolicy" value="flexible" {{ in_array('flexible', $cancellationPolicies) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexiblePolicy">
                                                                Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox" name="cancellation_policy[]" id="nonRefundablePolicy" value="non_refundable" {{ in_array('non_refundable', $cancellationPolicies) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="nonRefundablePolicy">
                                                                Non-refundable (Regardless of the cancellation window, customers will not get any refund under this.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox" name="cancellation_policy[]" id="partiallyRefundablePolicy" value="partially_refundable" {{ in_array('partially_refundable', $cancellationPolicies) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="partiallyRefundablePolicy">
                                                                Partially refundable (Cancellations less than 24 hours... 30% cancellation fee.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox" name="cancellation_policy[]" id="longTermPolicy" value="long_term" {{ in_array('long_term', $cancellationPolicies) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="longTermPolicy">
                                                                Long-term/Monthly staying policy (Stays more than 30 days... contract paper shall be signed.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Error --}}
                                                @error('cancellation_policy.*')
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
                                                                }, 2000); // hide after 2 seconds
                                                            }
                                                        });
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
                                                    
                                                    <div class="furniture-list-facilities"></div>
                                                    
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
                                                        const furnitureLabels = document.querySelectorAll('#tabItem3 input[name="furniture[]"]');
                                                        const furnitureTarget = document.querySelector('.furniture-list-facilities');
                                                        furnitureTarget.innerHTML = '';
                                                        furnitureLabels.forEach(input => {
                                                            // Skip if it's in a custom container
                                                            if (input.closest('.custom-furniture-container')) return;
                                                            
                                                            const label = input.closest('label');
                                                            if (label) {
                                                                const clone = label.cloneNode(true);
                                                                const checkbox = clone.querySelector('input');
                                                                checkbox.addEventListener('change', function() {
                                                                    const original = document.querySelector(`#tabItem3 input[name="${this.name}"][value="${this.value}"]`);
                                                                    if (original) original.checked = this.checked;
                                                                });
                                                                furnitureTarget.appendChild(clone);
                                                                furnitureTarget.appendChild(document.createElement('br'));
                                                            }
                                                        });

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
                                                        'feature_photos' => 'Featured Room Photos (Main Display)',
                                                        'kitchen_photos' => 'Kitchen Photo',
                                                        'washroom_photos' => 'Washroom Photo',
                                                        'parking_photos' => 'Parking Lot Photos',
                                                        'entrance_photos' => 'Entrance Gate/Main Gate Photos',
                                                        'accessibility_photos' => 'Lift, Stairs, wheelchair area Photos',
                                                        'spa_photos' => 'Spa & Massage Center Photos',
                                                        'bar_photos' => 'Bar Photos',
                                                        'transport_photos' => 'Hotels Car & Bus Photo',
                                                        'rooftop_photos' => 'Rooftop, Garden, Sitting area Photos',
                                                        'recreation_photos' => 'Gym, Game room & Kids Zone Photos',
                                                        'safety_photos' => 'CCTV, Fire Extinguisher & Surveillance Photos',
                                                        'amenity_photos' => 'Hotel/Property Amenities Photos'
                                                    ];
                                                    $room_photos = $room->photos()->get()->groupBy('category');
                                                @endphp

                                                @foreach ($photo_categories as $input_name => $label)
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group mt-15">
                                                            <label class="form-label">{{ $label }}</label>
                                                            <div class="multiple-upload-container" id="upload-container-{{ str_replace('_photos', '', $input_name) }}">
                                                                <input type="file" class="multiple-file-input" name="{{ $input_name }}[]" accept="image/*" multiple>
                                                                <label class="upload-label">Select Multiple Images</label>
                                                                <div class="multiple-thumbnail-gallery">
                                                                    @if (isset($room_photos[str_replace('_photos', '', $input_name)]))
                                                                        @foreach ($room_photos[str_replace('_photos', '', $input_name)] as $photo)
                                                                            <div class="multiple-thumbnail-item" data-photo-id="{{ $photo->id }}">
                                                                                <img src="{{ asset('storage/' . $photo->photo_path) }}" style="max-width: 100px; max-height: 100px;">
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
                if (confirm('Are you sure you want to delete this photo?')) {
                    fetch('{{ route("vendor-admin.room.delete-photo") }}', {
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
                                button.closest('.multiple-thumbnail-item').remove();
                            } else {
                                alert('Failed to delete photo: ' + (data.message || 'Unknown error'));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while deleting the photo.');
                        });
                }
            }

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
            });
        </script>
@endsection
