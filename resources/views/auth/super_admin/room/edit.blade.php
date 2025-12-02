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
                                <form action="{{ route('super-admin.room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
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
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="is_active" {{ old('is_active', $room->is_active) ? 'checked' : '' }}>
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
                                                    <h3 class="can-tittle">Appliances Information</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input" name="appliances-all" id="appliances-all">
                                                                <label class="custom-control-label" for="appliances-all">Select All</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $appliances = old('appliances', is_string($room->appliances) ? (json_decode($room->appliances, true) ?? []) : ($room->appliances ?? []));
                                                        if (!is_array($appliances)) {
                                                            $appliances = [];
                                                        }
                                                    @endphp
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="AC" {{ in_array('AC', $appliances) ? 'checked' : '' }}> AC</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="TV" {{ in_array('TV', $appliances) ? 'checked' : '' }}> TV</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Fridge" {{ in_array('Fridge', $appliances) ? 'checked' : '' }}> Fridge</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Microwave" {{ in_array('Microwave', $appliances) ? 'checked' : '' }}> Microwave</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Fan" {{ in_array('Fan', $appliances) ? 'checked' : '' }}> Fan</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Lamp" {{ in_array('Lamp', $appliances) ? 'checked' : '' }}> Lamp</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Light" {{ in_array('Light', $appliances) ? 'checked' : '' }}> Light</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Water heater/Geyser" {{ in_array('Water heater/Geyser', $appliances) ? 'checked' : '' }}> Water heater/Geyser</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="WiFi Router" {{ in_array('WiFi Router', $appliances) ? 'checked' : '' }}> WiFi Router</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Crockeries" {{ in_array('Crockeries', $appliances) ? 'checked' : '' }}> Crockeries</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Gas Stove" {{ in_array('Gas Stove', $appliances) ? 'checked' : '' }}> Gas Stove</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Electric Kettle" {{ in_array('Electric Kettle', $appliances) ? 'checked' : '' }}> Electric Kettle</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Room Heater" {{ in_array('Room Heater', $appliances) ? 'checked' : '' }}> Room Heater</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Hair Dryer" {{ in_array('Hair Dryer', $appliances) ? 'checked' : '' }}> Hair Dryer</label><br>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="section appliances-section">
                                                                <div class="input-container" style="display: none;">
                                                                    <div class="form-group mb-3 d-flex align-items-center">
                                                                        <input type="text" class="form-control" placeholder="Enter custom appliance">
                                                                        <button type="button" class="btn btn-danger btn-sm ms-2">Delete</button>
                                                                    </div>
                                                                </div>
                                                                <div class="custom-inputs">
                                                                    @foreach (array_diff($appliances, ['AC', 'TV', 'Fridge', 'Microwave', 'Fan', 'Lamp', 'Light', 'Water heater/Geyser', 'WiFi Router', 'Crockeries', 'Gas Stove', 'Electric Kettle', 'Room Heater', 'Hair Dryer']) as $appliance)
                                                                        <div class="input-container" style="display: block;">
                                                                            <div class="form-group mb-3 d-flex align-items-center">
                                                                                <input type="text" class="form-control" name="custom_appliances[]" value="{{ $appliance }}" placeholder="Enter custom appliance">
                                                                                <button type="button" class="btn btn-danger btn-sm ms-2">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <button type="button" class="add-more add-rule-btn btn add-button">Add More</button>
                                                                @error('custom_appliances.*')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                (function initAppliancesSelectAll() {
                                                    const container = document.querySelector('.checkbox-section');
                                                    if (!container) return;

                                                    const selectAll = container.querySelector('#appliances-all');
                                                    if (!selectAll) return;

                                                    // Use event delegation so it works even if items are added later
                                                    container.addEventListener('change', function (e) {
                                                        // If "Select All" changed -> toggle all items
                                                        if (e.target === selectAll) {
                                                            const items = container.querySelectorAll('.checkbox-item-appliances');
                                                            items.forEach(chk => { chk.checked = selectAll.checked; });
                                                            return;
                                                        }

                                                        // If an individual appliance changed -> sync "Select All"
                                                        if (e.target.classList.contains('checkbox-item-appliances')) {
                                                            const items = container.querySelectorAll('.checkbox-item-appliances');
                                                            const checkedCount = container.querySelectorAll('.checkbox-item-appliances:checked').length;
                                                            selectAll.checked = (checkedCount === items.length && items.length > 0);
                                                        }
                                                    });

                                                    // Initialize "Select All" state on load/render
                                                    const items = container.querySelectorAll('.checkbox-item-appliances');
                                                    const checkedCount = container.querySelectorAll('.checkbox-item-appliances:checked').length;
                                                    selectAll.checked = (checkedCount === items.length && items.length > 0);
                                                })();
                                            </script>

                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Furniture Information</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input" name="furniture-all" id="furniture-all">
                                                                <label class="custom-control-label" for="furniture-all">Select All</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $furniture = old('furniture', is_string($room->furniture) ? (json_decode($room->furniture, true) ?? []) : ($room->furniture ?? []));
                                                        if (!is_array($furniture)) {
                                                            $furniture = [];
                                                        }
                                                    @endphp
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Bed" {{ in_array('Bed', $furniture) ? 'checked' : '' }}> Bed</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Dining Table with Chair" {{ in_array('Dining Table with Chair', $furniture) ? 'checked' : '' }}> Dining Table with Chair</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Sofa/Couch" {{ in_array('Sofa/Couch', $furniture) ? 'checked' : '' }}> Sofa/Couch</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Tea Table" {{ in_array('Tea Table', $furniture) ? 'checked' : '' }}> Tea Table</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Bedside Table" {{ in_array('Bedside Table', $furniture) ? 'checked' : '' }}> Bedside Table</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Shoe Rack" {{ in_array('Shoe Rack', $furniture) ? 'checked' : '' }}> Shoe Rack</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Clothing Cabinet" {{ in_array('Clothing Cabinet', $furniture) ? 'checked' : '' }}> Clothing Cabinet</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Clothes Drying Hanger" {{ in_array('Clothes Drying Hanger', $furniture) ? 'checked' : '' }}> Clothes Drying Hanger</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Iron Stand" {{ in_array('Iron Stand', $furniture) ? 'checked' : '' }}> Iron Stand</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Locker/Safe" {{ in_array('Locker/Safe', $furniture) ? 'checked' : '' }}> Locker/Safe</label><br>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="section furniture-section">
                                                                <div class="input-container" style="display: none;">
                                                                    <div class="form-group mb-3 d-flex align-items-center">
                                                                        <input type="text" class="form-control" placeholder="Enter custom furniture">
                                                                        <button type="button" class="btn btn-danger btn-sm ms-2">Delete</button>
                                                                    </div>
                                                                </div>
                                                                <div class="custom-inputs">
                                                                    @foreach (array_diff($furniture, ['Bed', 'Dining Table with Chair', 'Sofa/Couch', 'Tea Table', 'Bedside Table', 'Shoe Rack', 'Clothing Cabinet', 'Clothes Drying Hanger', 'Iron Stand', 'Locker/Safe']) as $item)
                                                                        <div class="input-container" style="display: block;">
                                                                            <div class="form-group mb-3 d-flex align-items-center">
                                                                                <input type="text" class="form-control" name="custom_furniture[]" value="{{ $item }}" placeholder="Enter custom furniture">
                                                                                <button type="button" class="btn btn-danger btn-sm ms-2">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <button type="button" class="add-more add-rule-btn btn add-button">Add More</button>
                                                                @error('custom_furniture.*')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                (function initSelectAll(masterSelector, itemSelector) {
                                                    const master = document.querySelector(masterSelector);
                                                    if (!master) return;

                                                    // Find the nearest section that contains this group
                                                    const container = master.closest('.checkbox-section') || document;
                                                    if (!container) return;

                                                    // Delegate changes inside this container
                                                    container.addEventListener('change', function (e) {
                                                        // If "Select All" changed -> toggle all items
                                                        if (e.target === master) {
                                                            const items = container.querySelectorAll(itemSelector);
                                                            items.forEach(chk => { chk.checked = master.checked; });
                                                            return;
                                                        }

                                                        // If an individual item changed -> sync "Select All"
                                                        if (e.target.matches(itemSelector)) {
                                                            const items = container.querySelectorAll(itemSelector);
                                                            const checkedCount = container.querySelectorAll(itemSelector + ':checked').length;
                                                            master.checked = (items.length > 0 && checkedCount === items.length);
                                                        }
                                                    });

                                                    // Initialize "Select All" state on render
                                                    (function initState() {
                                                        const items = container.querySelectorAll(itemSelector);
                                                        const checkedCount = container.querySelectorAll(itemSelector + ':checked').length;
                                                        master.checked = (items.length > 0 && checkedCount === items.length);
                                                    })();
                                                })('#furniture-all', '.checkbox-item-furniture');
                                            </script>

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

                                        <div class="tab-pane" id="tabItem4">
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="label-chk">Room Amenities</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input" name="reg-public" id="site-off">
                                                                <label class="custom-control-label" for="site-off">Check All</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $amenities = old('amenities', is_string($room->amenities) ? (json_decode($room->amenities, true) ?? []) : ($room->amenities ?? []));
                                                        if (!is_array($amenities)) {
                                                            $amenities = [];
                                                        }
                                                    @endphp
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Soap" {{ in_array('Soap', $amenities) ? 'checked' : '' }}> Soap</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Tissue" {{ in_array('Tissue', $amenities) ? 'checked' : '' }}> Tissue</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Shampoo" {{ in_array('Shampoo', $amenities) ? 'checked' : '' }}> Shampoo</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Toothbrush" {{ in_array('Toothbrush', $amenities) ? 'checked' : '' }}> Toothbrush</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Towel" {{ in_array('Towel', $amenities) ? 'checked' : '' }}> Towel</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Water bottle" {{ in_array('Water bottle', $amenities) ? 'checked' : '' }}> Water bottle</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Free laundry" {{ in_array('Free laundry', $amenities) ? 'checked' : '' }}> Free laundry</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Air freshener" {{ in_array('Air freshener', $amenities) ? 'checked' : '' }}> Air freshener</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Fruit basket" {{ in_array('Fruit basket', $amenities) ? 'checked' : '' }}> Fruit basket</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Complimentary drinks" {{ in_array('Complimentary drinks', $amenities) ? 'checked' : '' }}> Complimentary drinks</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Buffet breakfast" {{ in_array('Buffet breakfast', $amenities) ? 'checked' : '' }}> Buffet breakfast</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Add/type Manually" {{ in_array('Add/type Manually', $amenities) ? 'checked' : '' }}> Add/type Manually</label><br>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="section amenities-section">
                                                                <div class="input-container" style="display: none;">
                                                                    <div class="form-group mb-3 d-flex align-items-center">
                                                                        <input type="text" class="form-control" placeholder="Enter custom amenity">
                                                                        <button type="button" class="btn btn-danger btn-sm ms-2">Delete</button>
                                                                    </div>
                                                                </div>
                                                                <div class="custom-inputs">
                                                                    @foreach (array_diff($amenities, ['Soap', 'Tissue', 'Shampoo', 'Toothbrush', 'Towel', 'Water bottle', 'Free laundry', 'Air freshener', 'Fruit basket', 'Complimentary drinks', 'Buffet breakfast', 'Add/type Manually']) as $amenity)
                                                                        <div class="input-container" style="display: block;">
                                                                            <div class="form-group mb-3 d-flex align-items-center">
                                                                                <input type="text" class="form-control" name="custom_amenities[]" value="{{ $amenity }}" placeholder="Enter custom amenity">
                                                                                <button type="button" class="btn btn-danger btn-sm ms-2">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <button type="button" class="add-more add-rule-btn btn add-button">Add More</button>
                                                                @error('custom_amenities.*')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
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
                                        </div>

                                        <!-- Photos Tab -->
                                        <div class="tab-pane" id="Photos">
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
                                                                                <img src="{{ asset($photo->photo_path) }}" style="max-width: 100px; max-height: 100px;">
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
        </script>
@endsection
