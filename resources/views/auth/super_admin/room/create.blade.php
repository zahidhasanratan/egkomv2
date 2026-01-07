@extends('auth.layout.super_admin_layout')

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
                                
                                <form action="{{ route('super-admin.room.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#Availability">Room Availability</a>
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

                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="AC" {{ in_array('AC', old('appliances', [])) ? 'checked' : '' }}> AC</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="TV" {{ in_array('TV', old('appliances', [])) ? 'checked' : '' }}> TV</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Fridge" {{ in_array('Fridge', old('appliances', [])) ? 'checked' : '' }}> Fridge</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Microwave" {{ in_array('Microwave', old('appliances', [])) ? 'checked' : '' }}> Microwave</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Fan" {{ in_array('Fan', old('appliances', [])) ? 'checked' : '' }}> Fan</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Lamp" {{ in_array('Lamp', old('appliances', [])) ? 'checked' : '' }}> Lamp</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Light" {{ in_array('Light', old('appliances', [])) ? 'checked' : '' }}> Light</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Water heater/Geyser" {{ in_array('Water heater/Geyser', old('appliances', [])) ? 'checked' : '' }}> Water heater/Geyser</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="WiFi Router" {{ in_array('WiFi Router', old('appliances', [])) ? 'checked' : '' }}> WiFi Router</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Crockeries" {{ in_array('Crockeries', old('appliances', [])) ? 'checked' : '' }}> Crockeries</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Gas Stove" {{ in_array('Gas Stove', old('appliances', [])) ? 'checked' : '' }}> Gas Stove</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Electric Kettle" {{ in_array('Electric Kettle', old('appliances', [])) ? 'checked' : '' }}> Electric Kettle</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Room Heater" {{ in_array('Room Heater', old('appliances', [])) ? 'checked' : '' }}> Room Heater</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances checkbox-item-room-info" value="Hair Dryer" {{ in_array('Hair Dryer', old('appliances', [])) ? 'checked' : '' }}> Hair Dryer</label><br>
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

                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Bed" {{ in_array('Bed', old('furniture', [])) ? 'checked' : '' }}> Bed</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Dining Table with Chair" {{ in_array('Dining Table with Chair', old('furniture', [])) ? 'checked' : '' }}> Dining Table with Chair</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Sofa/Couch" {{ in_array('Sofa/Couch', old('furniture', [])) ? 'checked' : '' }}> Sofa/Couch</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Tea Table" {{ in_array('Tea Table', old('furniture', [])) ? 'checked' : '' }}> Tea Table</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Bedside Table" {{ in_array('Bedside Table', old('furniture', [])) ? 'checked' : '' }}> Bedside Table</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Shoe Rack" {{ in_array('Shoe Rack', old('furniture', [])) ? 'checked' : '' }}> Shoe Rack</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Clothing Cabinet" {{ in_array('Clothing Cabinet', old('furniture', [])) ? 'checked' : '' }}> Clothing Cabinet</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Clothes Drying Hanger" {{ in_array('Clothes Drying Hanger', old('furniture', [])) ? 'checked' : '' }}> Clothes Drying Hanger</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Iron Stand" {{ in_array('Iron Stand', old('furniture', [])) ? 'checked' : '' }}> Iron Stand</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture checkbox-item-additional" value="Locker/Safe" {{ in_array('Locker/Safe', old('furniture', [])) ? 'checked' : '' }}> Locker/Safe</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Soap" {{ in_array('Soap', old('amenities', [])) ? 'checked' : '' }}> Soap</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Tissue" {{ in_array('Tissue', old('amenities', [])) ? 'checked' : '' }}> Tissue</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Shampoo" {{ in_array('Shampoo', old('amenities', [])) ? 'checked' : '' }}> Shampoo</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Toothbrush" {{ in_array('Toothbrush', old('amenities', [])) ? 'checked' : '' }}> Toothbrush</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Towel" {{ in_array('Towel', old('amenities', [])) ? 'checked' : '' }}> Towel</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Water bottle" {{ in_array('Water bottle', old('amenities', [])) ? 'checked' : '' }}> Water bottle</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Free laundry" {{ in_array('Free laundry', old('amenities', [])) ? 'checked' : '' }}> Free laundry</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Air freshener" {{ in_array('Air freshener', old('amenities', [])) ? 'checked' : '' }}> Air freshener</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Fruit basket" {{ in_array('Fruit basket', old('amenities', [])) ? 'checked' : '' }}> Fruit basket</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Complimentary drinks" {{ in_array('Complimentary drinks', old('amenities', [])) ? 'checked' : '' }}> Complimentary drinks</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item checkbox-item-additional" value="Buffet breakfast" {{ in_array('Buffet breakfast', old('amenities', [])) ? 'checked' : '' }}> Buffet breakfast</label><br>
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

                                            <!-- Bed Details -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Bed Details</strong></h5>
                                                        
                                                        <!-- Total Beds Counter -->
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Total Beds</label>
                                                            <div class="counter-wrapper" style="max-width: 300px;">
                                                                <div class="counter-card">
                                                                    <div>
                                                                        <div class="counter">
                                                                            <button type="button" class="btn decrease-male" id="bedDecreaseBtn">-</button>
                                                                            <span id="totalBeds" class="count male-count">{{ old('total_beds', 0) }}</span>
                                                                            <input type="hidden" name="total_beds" id="totalBedsInput" value="{{ old('total_beds', 0) }}">
                                                                            <button type="button" class="btn increase-male" id="bedIncreaseBtn">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('total_beds')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        
                                                        <!-- Dynamic Bed Details Container -->
                                                        <div id="bedDetailsContainer" style="margin-top: 20px;">
                                                            <!-- Bed detail sections will be dynamically generated here -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bathroom Details -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Bathroom Details</strong></h5>
                                                        
                                                        <!-- Total Bathroom Counter -->
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Total Bathroom</label>
                                                            <div class="counter-wrapper" style="max-width: 300px;">
                                                                <div class="counter-card">
                                                                    <div>
                                                                        <div class="counter">
                                                                            <button type="button" class="btn decrease-male" id="bathroomDecreaseBtn">-</button>
                                                                            <span id="totalBathrooms" class="count male-count">{{ old('total_washrooms', 0) }}</span>
                                                                            <input type="hidden" name="total_washrooms" id="totalBathroomsInput" value="{{ old('total_washrooms', 0) }}">
                                                                            <button type="button" class="btn increase-male" id="bathroomIncreaseBtn">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('total_washrooms')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        
                                                        <!-- Dynamic Bathroom Details Container -->
                                                        <div id="bathroomDetailsContainer" style="margin-top: 20px;">
                                                            <!-- Bathroom detail sections will be dynamically generated here -->
                                                        </div>
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

                                            <!-- Additional Bed Policy & Fee -->
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Additional Bed Policy & Fee</strong></h5>
                                                        
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Additional Bed Available?</label>
                                                            <div class="d-flex gap-3">
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[additional_bed_available]" id="additional_bed_yes" value="yes" {{ old('additional_info.additional_bed_available', '') == 'yes' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="additional_bed_yes" style="font-weight: 500;">Yes</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[additional_bed_available]" id="additional_bed_no" value="no" {{ old('additional_info.additional_bed_available', '') == 'no' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="additional_bed_no" style="font-weight: 500;">No</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="additional_bed_fields" style="display: {{ old('additional_info.additional_bed_available', '') == 'yes' ? 'block' : 'none' }}; margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                                            <div class="form-group mb-4">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Bed Type</label>
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[bed_fee_type]" id="bed_fee_free" value="free" {{ old('additional_info.bed_fee_type', '') == 'free' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="bed_fee_free" style="font-weight: 500;">Free</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[bed_fee_type]" id="bed_fee_paid" value="paid" {{ old('additional_info.bed_fee_type', '') == 'paid' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="bed_fee_paid" style="font-weight: 500;">Paid</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div id="bed_fee_amount_fields" style="display: {{ old('additional_info.bed_fee_type', '') == 'paid' ? 'block' : 'none' }}; margin-top: 20px; padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                                <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Fee Details</label>
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
                                                            
                                                            <div class="form-group mt-4">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Note</label>
                                                                <textarea class="form-control" name="additional_info[bed_note]" rows="3" placeholder="Enter any additional notes about the bed policy" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.bed_note', '') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Children & Extra Guest Policy -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Children & Extra Guest Policy</strong></h5>
                                                        
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Children & Extra Guest Policy Available?</label>
                                                            <div class="d-flex gap-3">
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[children_guest_policy_available]" id="children_guest_policy_yes" value="yes" {{ old('additional_info.children_guest_policy_available', '') == 'yes' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="children_guest_policy_yes" style="font-weight: 500;">Yes</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[children_guest_policy_available]" id="children_guest_policy_no" value="no" {{ old('additional_info.children_guest_policy_available', '') == 'no' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="children_guest_policy_no" style="font-weight: 500;">No</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="children_guest_policy_fields" style="display: {{ old('additional_info.children_guest_policy_available', '') == 'yes' ? 'block' : 'none' }}; margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                                            <div class="form-group mb-4">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Policy Type</label>
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[children_guest_policy_type]" id="children_guest_complementary" value="complementary" {{ old('additional_info.children_guest_policy_type', '') == 'complementary' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="children_guest_complementary" style="font-weight: 500;">Complementary</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[children_guest_policy_type]" id="children_guest_paid" value="paid" {{ old('additional_info.children_guest_policy_type', '') == 'paid' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="children_guest_paid" style="font-weight: 500;">Paid</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div id="children_guest_fee_fields" style="display: {{ old('additional_info.children_guest_policy_type', '') == 'paid' ? 'block' : 'none' }}; margin-top: 20px; padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                                <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Fee Details</label>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Fee Amount</label>
                                                                            <input type="number" class="form-control" name="additional_info[children_guest_fee_amount]" value="{{ old('additional_info.children_guest_fee_amount', '') }}" placeholder="e.g., 500" min="0" step="0.01">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Currency</label>
                                                                            <input type="text" class="form-control" name="additional_info[children_guest_fee_currency]" value="{{ old('additional_info.children_guest_fee_currency', 'BDT') }}" placeholder="e.g., BDT">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Per Unit</label>
                                                                            <input type="text" class="form-control" name="additional_info[children_guest_fee_unit]" value="{{ old('additional_info.children_guest_fee_unit', 'Per Person') }}" placeholder="e.g., Per Person">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group mt-4">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Note</label>
                                                                <textarea class="form-control" name="additional_info[children_guest_note]" rows="3" placeholder="Enter any additional notes about the children & extra guest policy" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.children_guest_note', '') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Laundry Service -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Laundry Service</strong></h5>
                                                        
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Laundry Service Available?</label>
                                                            <div class="d-flex gap-3">
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[laundry_service]" id="laundry_service_yes" value="yes" {{ old('additional_info.laundry_service', '') == 'yes' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="laundry_service_yes" style="font-weight: 500;">Yes</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[laundry_service]" id="laundry_service_no" value="no" {{ old('additional_info.laundry_service', '') == 'no' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="laundry_service_no" style="font-weight: 500;">No</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="laundry_service_type_container" style="display: {{ old('additional_info.laundry_service', '') == 'yes' ? 'block' : 'none' }}; margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                                            <div class="form-group mb-4">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Service Type</label>
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[laundry_service_type]" id="laundry_complementary" value="complementary" {{ old('additional_info.laundry_service_type', '') == 'complementary' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="laundry_complementary" style="font-weight: 500;">Complementary</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[laundry_service_type]" id="laundry_paid" value="paid" {{ old('additional_info.laundry_service_type', '') == 'paid' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="laundry_paid" style="font-weight: 500;">Paid</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div id="laundry_fee_fields" style="display: {{ old('additional_info.laundry_service_type', '') == 'paid' ? 'block' : 'none' }}; margin-top: 20px; padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                                <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Fee Details</label>
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
                                                            
                                                            <div class="form-group mt-4">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Note</label>
                                                                <textarea class="form-control" name="additional_info[laundry_note]" rows="3" placeholder="Enter any additional notes about the laundry service" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.laundry_note', '') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Housekeeping & Cleaning Policy -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Housekeeping & Cleaning Policy</strong></h5>
                                                        
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Housekeeping Service Available?</label>
                                                            <div class="d-flex gap-3">
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[housekeeping_service]" id="housekeeping_service_yes" value="yes" {{ old('additional_info.housekeeping_service', '') == 'yes' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="housekeeping_service_yes" style="font-weight: 500;">Yes</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[housekeeping_service]" id="housekeeping_service_no" value="no" {{ old('additional_info.housekeeping_service', '') == 'no' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="housekeeping_service_no" style="font-weight: 500;">No</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="housekeeping_service_type_container" style="display: {{ old('additional_info.housekeeping_service', '') == 'yes' ? 'block' : 'none' }}; margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                                            <div class="form-group mb-4">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Service Type</label>
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[housekeeping_service_type]" id="housekeeping_complementary" value="complementary" {{ old('additional_info.housekeeping_service_type', '') == 'complementary' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="housekeeping_complementary" style="font-weight: 500;">Complementary</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[housekeeping_service_type]" id="housekeeping_paid" value="paid" {{ old('additional_info.housekeeping_service_type', '') == 'paid' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="housekeeping_paid" style="font-weight: 500;">Paid</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div id="housekeeping_fee_fields" style="display: {{ old('additional_info.housekeeping_service_type', '') == 'paid' ? 'block' : 'none' }}; margin-top: 20px; padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                                <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Fee Details</label>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Fee Amount</label>
                                                                            <input type="number" class="form-control" name="additional_info[housekeeping_fee_amount]" value="{{ old('additional_info.housekeeping_fee_amount', '') }}" placeholder="e.g., 500" min="0" step="0.01">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Currency</label>
                                                                            <input type="text" class="form-control" name="additional_info[housekeeping_fee_currency]" value="{{ old('additional_info.housekeeping_fee_currency', 'BDT') }}" placeholder="e.g., BDT">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Per Unit</label>
                                                                            <input type="text" class="form-control" name="additional_info[housekeeping_fee_unit]" value="{{ old('additional_info.housekeeping_fee_unit', 'Per Service') }}" placeholder="e.g., Per Service">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group mt-4">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Note</label>
                                                                <textarea class="form-control" name="additional_info[housekeeping_note]" rows="3" placeholder="Enter any additional notes about the housekeeping service" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.housekeeping_note', '') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Check-in & Check-out Policy -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Check-in & Check-out Policy</strong></h5>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Standard Check-in Time</label>
                                                                    <input type="text" class="form-control" name="additional_info[checkin_time]" value="{{ old('additional_info.checkin_time', '') }}" placeholder="e.g., 2:00 PM" style="border: 1px solid #dee2e6; border-radius: 6px;">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Standard Check-out Time</label>
                                                                    <input type="text" class="form-control" name="additional_info[checkout_time]" value="{{ old('additional_info.checkout_time', '') }}" placeholder="e.g., 12:00 PM" style="border: 1px solid #dee2e6; border-radius: 6px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Late Check-out Fee</label>
                                                                    <textarea class="form-control" name="additional_info[late_checkout_fee]" rows="3" placeholder="e.g., 500 BDT per hour" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.late_checkout_fee', '') }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Early Check-in Fee</label>
                                                                    <textarea class="form-control" name="additional_info[early_checkin_fee]" rows="3" placeholder="e.g., 500 BDT per hour" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.early_checkin_fee', '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Security Deposit Requirement -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Security Deposit Requirement</strong></h5>
                                                        
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Security Deposit Required?</label>
                                                            <div class="d-flex gap-3">
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[security_deposit_required]" id="security_deposit_yes" value="yes" {{ old('additional_info.security_deposit_required', '') == 'yes' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="security_deposit_yes" style="font-weight: 500;">Yes</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[security_deposit_required]" id="security_deposit_no" value="no" {{ old('additional_info.security_deposit_required', '') == 'no' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="security_deposit_no" style="font-weight: 500;">No</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="security_deposit_fields_container" style="display: {{ old('additional_info.security_deposit_required', '') == 'yes' ? 'block' : 'none' }}; margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Deposit Amount</label>
                                                                        <input type="text" class="form-control" name="additional_info[security_deposit_amount]" value="{{ old('additional_info.security_deposit_amount', '') }}" placeholder="e.g., 5000 BDT" style="border: 1px solid #dee2e6; border-radius: 6px;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Terms & Refund Policy</label>
                                                                        <textarea class="form-control" name="additional_info[security_deposit_refundable]" rows="3" placeholder="e.g., Fully refundable after check-out if no damages" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.security_deposit_refundable', '') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Parking Availability -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Parking Availability</strong></h5>
                                                        
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Parking Type</label>
                                                            <div class="d-flex gap-3">
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[parking_type]" id="parking_available" value="available" {{ old('additional_info.parking_type', '') == 'available' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="parking_available" style="font-weight: 500;">Available</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[parking_type]" id="parking_paid" value="paid" {{ old('additional_info.parking_type', '') == 'paid' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="parking_paid" style="font-weight: 500;">Paid</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[parking_type]" id="parking_not_available" value="not_available" {{ old('additional_info.parking_type', '') == 'not_available' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="parking_not_available" style="font-weight: 500;">Not Available</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="parking_fields_container" style="display: {{ old('additional_info.parking_type', '') != 'not_available' && old('additional_info.parking_type', '') != '' ? 'block' : (old('additional_info.parking_type', '') == '' ? 'none' : 'none') }}; margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                                            <div id="parking_fee_fields" style="display: {{ old('additional_info.parking_type', '') == 'paid' ? 'block' : 'none' }}; margin-bottom: 20px; padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                                <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Fee Details</label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Amount</label>
                                                                            <input type="number" class="form-control" name="additional_info[parking_fee_amount]" value="{{ old('additional_info.parking_fee_amount', '') }}" placeholder="e.g., 500" min="0" step="0.01">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Currency</label>
                                                                            <input type="text" class="form-control" name="additional_info[parking_fee_currency]" value="{{ old('additional_info.parking_fee_currency', 'BDT') }}" placeholder="e.g., BDT">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Note</label>
                                                                <textarea class="form-control" name="additional_info[parking_note]" rows="3" placeholder="Enter any additional notes about parking" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.parking_note', '') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pet Policy -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Pet Policy</strong></h5>
                                                        
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Pet Policy Type</label>
                                                            <div class="d-flex gap-3">
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[pet_type]" id="pet_complementary" value="complementary" {{ old('additional_info.pet_type', '') == 'complementary' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="pet_complementary" style="font-weight: 500;">Complementary</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[pet_type]" id="pet_paid" value="paid" {{ old('additional_info.pet_type', '') == 'paid' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="pet_paid" style="font-weight: 500;">Paid</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[pet_type]" id="pet_not_available" value="not_available" {{ old('additional_info.pet_type', '') == 'not_available' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="pet_not_available" style="font-weight: 500;">Not Available</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="pet_fields_container" style="display: {{ old('additional_info.pet_type', '') != 'not_available' && old('additional_info.pet_type', '') != '' ? 'block' : (old('additional_info.pet_type', '') == '' ? 'none' : 'none') }}; margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                                            <div id="pet_complementary_note_field" style="display: {{ old('additional_info.pet_type', '') == 'complementary' ? 'block' : 'none' }}; margin-bottom: 20px;">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Note</label>
                                                                    <textarea class="form-control" name="additional_info[pet_complementary_note]" rows="3" placeholder="Enter any additional notes about the pet policy" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.pet_complementary_note', '') }}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <div id="pet_price_fields" style="display: {{ old('additional_info.pet_type', '') == 'paid' ? 'block' : 'none' }}; margin-bottom: 20px; padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                                <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Fee Details</label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Price (Optional)</label>
                                                                            <input type="text" class="form-control" name="additional_info[pet_fee]" value="{{ old('additional_info.pet_fee', '') }}" placeholder="e.g., 500 BDT per pet per day">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Note</label>
                                                                            <input type="text" class="form-control" name="additional_info[pet_paid_note]" value="{{ old('additional_info.pet_paid_note', '') }}" placeholder="e.g., Additional charges apply">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Meal Options -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Meal Options</strong></h5>
                                                        
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Meal Type</label>
                                                            <div class="d-flex gap-3">
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[meal_type]" id="meal_complementary" value="complementary" {{ old('additional_info.meal_type', '') == 'complementary' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="meal_complementary" style="font-weight: 500;">Complementary</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[meal_type]" id="meal_paid" value="paid" {{ old('additional_info.meal_type', '') == 'paid' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="meal_paid" style="font-weight: 500;">Paid</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[meal_type]" id="meal_not_available" value="not_available" {{ old('additional_info.meal_type', '') == 'not_available' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="meal_not_available" style="font-weight: 500;">Not Available</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="meal_fields_container" style="display: {{ old('additional_info.meal_type', '') != 'not_available' && old('additional_info.meal_type', '') != '' ? 'block' : (old('additional_info.meal_type', '') == '' ? 'none' : 'none') }}; margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                                            <div id="meal_complementary_note_field" style="display: {{ old('additional_info.meal_type', '') == 'complementary' ? 'block' : 'none' }}; margin-bottom: 20px;">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Note</label>
                                                                    <textarea class="form-control" name="additional_info[meal_complementary_note]" rows="3" placeholder="Enter any additional notes about the meal policy" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.meal_complementary_note', '') }}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <div id="meal_price_fields" style="display: {{ old('additional_info.meal_type', '') == 'paid' ? 'block' : 'none' }}; margin-bottom: 20px; padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                                <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Fee Details</label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Price (Optional)</label>
                                                                            <input type="text" class="form-control" name="additional_info[meal_fee]" value="{{ old('additional_info.meal_fee', '') }}" placeholder="e.g., 300 BDT per person">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Note</label>
                                                                            <textarea class="form-control" name="additional_info[meal_paid_note]" rows="3" placeholder="Enter any additional notes about the meal policy" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.meal_paid_note', '') }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Transportation Services -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Transportation Services</strong></h5>
                                                        
                                                        <!-- Airport Pickup -->
                                                        <div class="mb-4" style="padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                            <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Airport Pickup</label>
                                                            <div class="form-group mb-3">
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[airport_pickup_type]" id="airport_pickup_complementary" value="complementary" {{ old('additional_info.airport_pickup_type', '') == 'complementary' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="airport_pickup_complementary" style="font-weight: 500;">Complementary</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[airport_pickup_type]" id="airport_pickup_paid" value="paid" {{ old('additional_info.airport_pickup_type', '') == 'paid' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="airport_pickup_paid" style="font-weight: 500;">Paid</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[airport_pickup_type]" id="airport_pickup_not_available" value="not_available" {{ old('additional_info.airport_pickup_type', '') == 'not_available' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="airport_pickup_not_available" style="font-weight: 500;">Not Available</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="airport_pickup_fields" style="display: {{ old('additional_info.airport_pickup_type', '') != 'not_available' && old('additional_info.airport_pickup_type', '') != '' ? 'block' : 'none' }}; margin-top: 15px; padding-top: 15px; border-top: 1px solid #dee2e6;">
                                                                <div id="airport_pickup_amount_field" style="display: {{ old('additional_info.airport_pickup_type', '') == 'paid' ? 'block' : 'none' }}; margin-bottom: 15px;">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Amount</label>
                                                                        <input type="text" class="form-control" name="additional_info[airport_pickup_fee]" value="{{ old('additional_info.airport_pickup_fee', '') }}" placeholder="e.g., 1000 BDT">
                                                                    </div>
                                                                </div>
                                                                <div id="airport_pickup_note_field" style="display: {{ in_array(old('additional_info.airport_pickup_type', ''), ['complementary', 'paid']) ? 'block' : 'none' }};">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Note</label>
                                                                        <textarea class="form-control" name="additional_info[airport_pickup_note]" rows="2" placeholder="Enter any additional notes" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.airport_pickup_note', '') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Shuttle Service -->
                                                        <div class="mb-4" style="padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                            <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Shuttle Service</label>
                                                            <div class="form-group mb-3">
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[shuttle_service_type]" id="shuttle_service_complementary" value="complementary" {{ old('additional_info.shuttle_service_type', '') == 'complementary' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="shuttle_service_complementary" style="font-weight: 500;">Complementary</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[shuttle_service_type]" id="shuttle_service_paid" value="paid" {{ old('additional_info.shuttle_service_type', '') == 'paid' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="shuttle_service_paid" style="font-weight: 500;">Paid</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[shuttle_service_type]" id="shuttle_service_not_available" value="not_available" {{ old('additional_info.shuttle_service_type', '') == 'not_available' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="shuttle_service_not_available" style="font-weight: 500;">Not Available</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="shuttle_service_fields" style="display: {{ old('additional_info.shuttle_service_type', '') != 'not_available' && old('additional_info.shuttle_service_type', '') != '' ? 'block' : 'none' }}; margin-top: 15px; padding-top: 15px; border-top: 1px solid #dee2e6;">
                                                                <div id="shuttle_service_amount_field" style="display: {{ old('additional_info.shuttle_service_type', '') == 'paid' ? 'block' : 'none' }}; margin-bottom: 15px;">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Amount</label>
                                                                        <input type="text" class="form-control" name="additional_info[shuttle_service_fee]" value="{{ old('additional_info.shuttle_service_fee', '') }}" placeholder="e.g., 500 BDT">
                                                                    </div>
                                                                </div>
                                                                <div id="shuttle_service_note_field" style="display: {{ in_array(old('additional_info.shuttle_service_type', ''), ['complementary', 'paid']) ? 'block' : 'none' }};">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Note</label>
                                                                        <textarea class="form-control" name="additional_info[shuttle_service_note]" rows="2" placeholder="Enter any additional notes" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.shuttle_service_note', '') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Car Rental -->
                                                        <div class="mb-4" style="padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                                                            <label class="form-label mb-3" style="font-weight: 600; color: #495057;">Car Rental</label>
                                                            <div class="form-group mb-3">
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[car_rental_type]" id="car_rental_complementary" value="complementary" {{ old('additional_info.car_rental_type', '') == 'complementary' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="car_rental_complementary" style="font-weight: 500;">Complementary</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[car_rental_type]" id="car_rental_paid" value="paid" {{ old('additional_info.car_rental_type', '') == 'paid' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="car_rental_paid" style="font-weight: 500;">Paid</label>
                                                                    </div>
                                                                    <div class="form-check" style="padding-left: 2rem;">
                                                                        <input class="form-check-input" type="radio" name="additional_info[car_rental_type]" id="car_rental_not_available" value="not_available" {{ old('additional_info.car_rental_type', '') == 'not_available' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="car_rental_not_available" style="font-weight: 500;">Not Available</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="car_rental_fields" style="display: {{ old('additional_info.car_rental_type', '') != 'not_available' && old('additional_info.car_rental_type', '') != '' ? 'block' : 'none' }}; margin-top: 15px; padding-top: 15px; border-top: 1px solid #dee2e6;">
                                                                <div id="car_rental_amount_field" style="display: {{ old('additional_info.car_rental_type', '') == 'paid' ? 'block' : 'none' }}; margin-bottom: 15px;">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Amount</label>
                                                                        <input type="text" class="form-control" name="additional_info[car_rental_fee]" value="{{ old('additional_info.car_rental_fee', '') }}" placeholder="e.g., 2000 BDT per day">
                                                                    </div>
                                                                </div>
                                                                <div id="car_rental_note_field" style="display: {{ in_array(old('additional_info.car_rental_type', ''), ['complementary', 'paid']) ? 'block' : 'none' }};">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Note</label>
                                                                        <textarea class="form-control" name="additional_info[car_rental_note]" rows="2" placeholder="Enter any additional notes" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.car_rental_note', '') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Smoking Policy -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Smoking Policy</strong></h5>
                                                        
                                                        <div class="form-group mb-4">
                                                            <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Smoking Policy</label>
                                                            <div class="d-flex gap-3">
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[smoking_policy]" id="smoking_allowed" value="allowed" {{ old('additional_info.smoking_policy', '') == 'allowed' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="smoking_allowed" style="font-weight: 500;">Allowed</label>
                                                                </div>
                                                                <div class="form-check" style="padding-left: 2rem;">
                                                                    <input class="form-check-input" type="radio" name="additional_info[smoking_policy]" id="smoking_not_allowed" value="not_allowed" {{ old('additional_info.smoking_policy', '') == 'not_allowed' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="smoking_not_allowed" style="font-weight: 500;">Not Allowed</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="smoking_note_field" style="display: {{ old('additional_info.smoking_policy', '') == 'allowed' ? 'block' : 'none' }}; margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6;">
                                                            <div class="form-group">
                                                                <label class="form-label" style="font-weight: 600; margin-bottom: 10px;">Note</label>
                                                                <textarea class="form-control" name="additional_info[smoking_policy_note]" rows="3" placeholder="Enter any additional notes about the smoking policy" style="border: 1px solid #dee2e6; border-radius: 6px;">{{ old('additional_info.smoking_policy_note', '') }}</textarea>
                                                            </div>
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
                                                    
                                                    <div class="amenities-list-facilities"></div>
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
                                                    // Clone checkbox lists to Room Facilities tab
                                                    function syncCheckboxLists() {
                                                        // Appliances
                                                        const appliancesLabels = document.querySelectorAll('#tabItem3 input[name="appliances[]"]');
                                                        const appliancesTarget = document.querySelector('.appliances-list-facilities');
                                                        appliancesTarget.innerHTML = '';
                                                        appliancesLabels.forEach(input => {
                                                            const label = input.closest('label');
                                                            if (label) {
                                                                const clone = label.cloneNode(true);
                                                                const checkbox = clone.querySelector('input');
                                                                checkbox.addEventListener('change', function() {
                                                                    const original = document.querySelector(`#tabItem3 input[name="appliances[]"][value="${this.value}"]`);
                                                                    if (original) original.checked = this.checked;
                                                                });
                                                                appliancesTarget.appendChild(clone);
                                                                appliancesTarget.appendChild(document.createElement('br'));
                                                            }
                                                        });

                                                        // Furniture
                                                        const furnitureLabels = document.querySelectorAll('#tabItem3 input[name="furniture[]"]');
                                                        const furnitureTarget = document.querySelector('.furniture-list-facilities');
                                                        furnitureTarget.innerHTML = '';
                                                        furnitureLabels.forEach(input => {
                                                            const label = input.closest('label');
                                                            if (label) {
                                                                const clone = label.cloneNode(true);
                                                                const checkbox = clone.querySelector('input');
                                                                checkbox.addEventListener('change', function() {
                                                                    const original = document.querySelector(`#tabItem3 input[name="furniture[]"][value="${this.value}"]`);
                                                                    if (original) original.checked = this.checked;
                                                                });
                                                                furnitureTarget.appendChild(clone);
                                                                furnitureTarget.appendChild(document.createElement('br'));
                                                            }
                                                        });

                                                        // Amenities
                                                        const amenitiesLabels = document.querySelectorAll('#tabItem3 input[name="amenities[]"]');
                                                        const amenitiesTarget = document.querySelector('.amenities-list-facilities');
                                                        amenitiesTarget.innerHTML = '';
                                                        amenitiesLabels.forEach(input => {
                                                            const label = input.closest('label');
                                                            if (label) {
                                                                const clone = label.cloneNode(true);
                                                                const checkbox = clone.querySelector('input');
                                                                checkbox.addEventListener('change', function() {
                                                                    const original = document.querySelector(`#tabItem3 input[name="amenities[]"][value="${this.value}"]`);
                                                                    if (original) original.checked = this.checked;
                                                                });
                                                                amenitiesTarget.appendChild(clone);
                                                                amenitiesTarget.appendChild(document.createElement('br'));
                                                            }
                                                        });
                                                    }

                                                    // Initial sync
                                                    setTimeout(syncCheckboxLists, 100);

                                                    // Listen for changes in Room Details tab and sync to Facilities
                                                    document.querySelector('#tabItem3').addEventListener('change', function(e) {
                                                        if (e.target.name === 'appliances[]' || e.target.name === 'furniture[]' || e.target.name === 'amenities[]') {
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

                                                    // Additional Bed Toggle Functionality
                                                    const additionalBedYes = document.getElementById('additional_bed_yes');
                                                    const additionalBedNo = document.getElementById('additional_bed_no');
                                                    const additionalBedFields = document.getElementById('additional_bed_fields');
                                                    const bedFeeFree = document.getElementById('bed_fee_free');
                                                    const bedFeePaid = document.getElementById('bed_fee_paid');
                                                    const bedFeeAmountFields = document.getElementById('bed_fee_amount_fields');

                                                    if (additionalBedYes && additionalBedNo) {
                                                        function toggleAdditionalBedFields() {
                                                            if (additionalBedYes.checked) {
                                                                additionalBedFields.style.display = 'block';
                                                            } else {
                                                                additionalBedFields.style.display = 'none';
                                                            }
                                                        }

                                                        function toggleBedFeeFields() {
                                                            if (bedFeePaid && bedFeePaid.checked) {
                                                                bedFeeAmountFields.style.display = 'block';
                                                            } else {
                                                                bedFeeAmountFields.style.display = 'none';
                                                            }
                                                        }

                                                        additionalBedYes.addEventListener('change', toggleAdditionalBedFields);
                                                        additionalBedNo.addEventListener('change', toggleAdditionalBedFields);
                                                        
                                                        if (bedFeePaid) {
                                                            bedFeePaid.addEventListener('change', toggleBedFeeFields);
                                                            bedFeeFree?.addEventListener('change', toggleBedFeeFields);
                                                        }

                                                        // Initialize on page load
                                                        toggleAdditionalBedFields();
                                                        toggleBedFeeFields();
                                                    }

                                                    // Children & Extra Guest Policy Toggle Functionality
                                                    const childrenGuestPolicyYes = document.getElementById('children_guest_policy_yes');
                                                    const childrenGuestPolicyNo = document.getElementById('children_guest_policy_no');
                                                    const childrenGuestPolicyFields = document.getElementById('children_guest_policy_fields');
                                                    const childrenGuestComplementary = document.getElementById('children_guest_complementary');
                                                    const childrenGuestPaid = document.getElementById('children_guest_paid');
                                                    const childrenGuestFeeFields = document.getElementById('children_guest_fee_fields');

                                                    if (childrenGuestPolicyYes && childrenGuestPolicyNo) {
                                                        function toggleChildrenGuestPolicyFields() {
                                                            if (childrenGuestPolicyYes.checked) {
                                                                childrenGuestPolicyFields.style.display = 'block';
                                                            } else {
                                                                childrenGuestPolicyFields.style.display = 'none';
                                                            }
                                                        }

                                                        function toggleChildrenGuestFeeFields() {
                                                            if (childrenGuestPaid && childrenGuestPaid.checked) {
                                                                childrenGuestFeeFields.style.display = 'block';
                                                            } else {
                                                                childrenGuestFeeFields.style.display = 'none';
                                                            }
                                                        }

                                                        childrenGuestPolicyYes.addEventListener('change', toggleChildrenGuestPolicyFields);
                                                        childrenGuestPolicyNo.addEventListener('change', toggleChildrenGuestPolicyFields);
                                                        
                                                        if (childrenGuestPaid) {
                                                            childrenGuestPaid.addEventListener('change', toggleChildrenGuestFeeFields);
                                                            childrenGuestComplementary?.addEventListener('change', toggleChildrenGuestFeeFields);
                                                        }

                                                        // Initialize on page load
                                                        toggleChildrenGuestPolicyFields();
                                                        toggleChildrenGuestFeeFields();
                                                    }

                                                    // Laundry Service Toggle Functionality
                                                    const laundryServiceYes = document.getElementById('laundry_service_yes');
                                                    const laundryServiceNo = document.getElementById('laundry_service_no');
                                                    const laundryServiceTypeContainer = document.getElementById('laundry_service_type_container');
                                                    const laundryPaid = document.getElementById('laundry_paid');
                                                    const laundryFeeFields = document.getElementById('laundry_fee_fields');

                                                    if (laundryServiceYes && laundryServiceNo && laundryServiceTypeContainer) {
                                                        function toggleLaundryServiceType() {
                                                            if (laundryServiceYes.checked) {
                                                                laundryServiceTypeContainer.style.display = 'block';
                                                            } else {
                                                                laundryServiceTypeContainer.style.display = 'none';
                                                                laundryFeeFields.style.display = 'none';
                                                            }
                                                        }

                                                        function toggleLaundryFeeFields() {
                                                            if (laundryPaid && laundryPaid.checked) {
                                                                laundryFeeFields.style.display = 'block';
                                                            } else {
                                                                laundryFeeFields.style.display = 'none';
                                                            }
                                                        }

                                                        laundryServiceYes.addEventListener('change', toggleLaundryServiceType);
                                                        laundryServiceNo.addEventListener('change', toggleLaundryServiceType);
                                                        
                                                        if (laundryPaid) {
                                                            laundryPaid.addEventListener('change', toggleLaundryFeeFields);
                                                            document.getElementById('laundry_complementary')?.addEventListener('change', toggleLaundryFeeFields);
                                                        }

                                                        // Initialize on page load
                                                        toggleLaundryServiceType();
                                                        toggleLaundryFeeFields();
                                                    }

                                                    // Housekeeping Service Toggle Functionality
                                                    const housekeepingServiceYes = document.getElementById('housekeeping_service_yes');
                                                    const housekeepingServiceNo = document.getElementById('housekeeping_service_no');
                                                    const housekeepingServiceTypeContainer = document.getElementById('housekeeping_service_type_container');
                                                    const housekeepingPaid = document.getElementById('housekeeping_paid');
                                                    const housekeepingFeeFields = document.getElementById('housekeeping_fee_fields');

                                                    if (housekeepingServiceYes && housekeepingServiceNo && housekeepingServiceTypeContainer) {
                                                        function toggleHousekeepingServiceType() {
                                                            if (housekeepingServiceYes.checked) {
                                                                housekeepingServiceTypeContainer.style.display = 'block';
                                                            } else {
                                                                housekeepingServiceTypeContainer.style.display = 'none';
                                                                housekeepingFeeFields.style.display = 'none';
                                                            }
                                                        }

                                                        function toggleHousekeepingFeeFields() {
                                                            if (housekeepingPaid && housekeepingPaid.checked) {
                                                                housekeepingFeeFields.style.display = 'block';
                                                            } else {
                                                                housekeepingFeeFields.style.display = 'none';
                                                            }
                                                        }

                                                        housekeepingServiceYes.addEventListener('change', toggleHousekeepingServiceType);
                                                        housekeepingServiceNo.addEventListener('change', toggleHousekeepingServiceType);
                                                        
                                                        if (housekeepingPaid) {
                                                            housekeepingPaid.addEventListener('change', toggleHousekeepingFeeFields);
                                                            document.getElementById('housekeeping_complementary')?.addEventListener('change', toggleHousekeepingFeeFields);
                                                        }

                                                        // Initialize on page load
                                                        toggleHousekeepingServiceType();
                                                        toggleHousekeepingFeeFields();
                                                    }

                                                    // Security Deposit Toggle Functionality
                                                    const securityDepositYes = document.getElementById('security_deposit_yes');
                                                    const securityDepositNo = document.getElementById('security_deposit_no');
                                                    const securityDepositFieldsContainer = document.getElementById('security_deposit_fields_container');

                                                    if (securityDepositYes && securityDepositNo && securityDepositFieldsContainer) {
                                                        function toggleSecurityDepositFields() {
                                                            if (securityDepositYes.checked) {
                                                                securityDepositFieldsContainer.style.display = 'block';
                                                            } else {
                                                                securityDepositFieldsContainer.style.display = 'none';
                                                            }
                                                        }

                                                        securityDepositYes.addEventListener('change', toggleSecurityDepositFields);
                                                        securityDepositNo.addEventListener('change', toggleSecurityDepositFields);

                                                        // Initialize on page load
                                                        toggleSecurityDepositFields();
                                                    }

                                                    // Parking Toggle Functionality
                                                    const parkingAvailable = document.getElementById('parking_available');
                                                    const parkingPaid = document.getElementById('parking_paid');
                                                    const parkingNotAvailable = document.getElementById('parking_not_available');
                                                    const parkingFieldsContainer = document.getElementById('parking_fields_container');
                                                    const parkingFeeFields = document.getElementById('parking_fee_fields');

                                                    if (parkingAvailable && parkingPaid && parkingNotAvailable) {
                                                        function toggleParkingFields() {
                                                            if (parkingNotAvailable.checked) {
                                                                parkingFieldsContainer.style.display = 'none';
                                                            } else {
                                                                parkingFieldsContainer.style.display = 'block';
                                                            }
                                                        }

                                                        function toggleParkingFeeFields() {
                                                            if (parkingPaid && parkingPaid.checked) {
                                                                parkingFeeFields.style.display = 'block';
                                                            } else {
                                                                parkingFeeFields.style.display = 'none';
                                                            }
                                                        }

                                                        parkingAvailable.addEventListener('change', function() {
                                                            toggleParkingFields();
                                                            toggleParkingFeeFields();
                                                        });
                                                        parkingPaid.addEventListener('change', function() {
                                                            toggleParkingFields();
                                                            toggleParkingFeeFields();
                                                        });
                                                        parkingNotAvailable.addEventListener('change', function() {
                                                            toggleParkingFields();
                                                            toggleParkingFeeFields();
                                                        });

                                                        // Initialize on page load
                                                        toggleParkingFields();
                                                        toggleParkingFeeFields();
                                                    }

                                                    // Pet Policy Toggle Functionality
                                                    const petComplementary = document.getElementById('pet_complementary');
                                                    const petPaid = document.getElementById('pet_paid');
                                                    const petNotAvailable = document.getElementById('pet_not_available');
                                                    const petFieldsContainer = document.getElementById('pet_fields_container');
                                                    const petComplementaryNoteField = document.getElementById('pet_complementary_note_field');
                                                    const petPriceFields = document.getElementById('pet_price_fields');

                                                    if (petComplementary && petPaid && petNotAvailable) {
                                                        function togglePetFields() {
                                                            if (petNotAvailable.checked) {
                                                                petFieldsContainer.style.display = 'none';
                                                            } else {
                                                                petFieldsContainer.style.display = 'block';
                                                            }
                                                        }

                                                        function togglePetComplementaryNote() {
                                                            if (petComplementary && petComplementary.checked) {
                                                                petComplementaryNoteField.style.display = 'block';
                                                            } else {
                                                                petComplementaryNoteField.style.display = 'none';
                                                            }
                                                        }

                                                        function togglePetPriceFields() {
                                                            if (petPaid && petPaid.checked) {
                                                                petPriceFields.style.display = 'block';
                                                            } else {
                                                                petPriceFields.style.display = 'none';
                                                            }
                                                        }

                                                        petComplementary.addEventListener('change', function() {
                                                            togglePetFields();
                                                            togglePetComplementaryNote();
                                                            togglePetPriceFields();
                                                        });
                                                        petPaid.addEventListener('change', function() {
                                                            togglePetFields();
                                                            togglePetComplementaryNote();
                                                            togglePetPriceFields();
                                                        });
                                                        petNotAvailable.addEventListener('change', function() {
                                                            togglePetFields();
                                                            togglePetComplementaryNote();
                                                            togglePetPriceFields();
                                                        });

                                                        // Initialize on page load
                                                        togglePetFields();
                                                        togglePetComplementaryNote();
                                                        togglePetPriceFields();
                                                    }

                                                    // Meal Options Toggle Functionality
                                                    const mealComplementary = document.getElementById('meal_complementary');
                                                    const mealPaid = document.getElementById('meal_paid');
                                                    const mealNotAvailable = document.getElementById('meal_not_available');
                                                    const mealFieldsContainer = document.getElementById('meal_fields_container');
                                                    const mealComplementaryNoteField = document.getElementById('meal_complementary_note_field');
                                                    const mealPriceFields = document.getElementById('meal_price_fields');

                                                    if (mealComplementary || mealPaid || mealNotAvailable) {
                                                        function toggleMealFields() {
                                                            if (mealNotAvailable && mealNotAvailable.checked) {
                                                                mealFieldsContainer.style.display = 'none';
                                                            } else {
                                                                mealFieldsContainer.style.display = 'block';
                                                                
                                                                if (mealComplementary && mealComplementary.checked) {
                                                                    mealComplementaryNoteField.style.display = 'block';
                                                                    mealPriceFields.style.display = 'none';
                                                                } else if (mealPaid && mealPaid.checked) {
                                                                    mealComplementaryNoteField.style.display = 'none';
                                                                    mealPriceFields.style.display = 'block';
                                                                } else {
                                                                    mealComplementaryNoteField.style.display = 'none';
                                                                    mealPriceFields.style.display = 'none';
                                                                }
                                                            }
                                                        }

                                                        mealComplementary?.addEventListener('change', toggleMealFields);
                                                        mealPaid?.addEventListener('change', toggleMealFields);
                                                        mealNotAvailable?.addEventListener('change', toggleMealFields);

                                                        // Initialize on page load
                                                        toggleMealFields();
                                                    }

                                                    // Transportation Services Toggle Functionality
                                                    function setupTransportationToggle(serviceName) {
                                                        const complementary = document.getElementById(`${serviceName}_complementary`);
                                                        const paid = document.getElementById(`${serviceName}_paid`);
                                                        const notAvailable = document.getElementById(`${serviceName}_not_available`);
                                                        const fieldsContainer = document.getElementById(`${serviceName}_fields`);
                                                        const amountField = document.getElementById(`${serviceName}_amount_field`);
                                                        const noteField = document.getElementById(`${serviceName}_note_field`);

                                                        if (complementary || paid || notAvailable) {
                                                            function toggleTransportationFields() {
                                                                if (notAvailable && notAvailable.checked) {
                                                                    fieldsContainer.style.display = 'none';
                                                                } else {
                                                                    fieldsContainer.style.display = 'block';
                                                                    
                                                                    if (paid && paid.checked) {
                                                                        amountField.style.display = 'block';
                                                                        noteField.style.display = 'block';
                                                                    } else if (complementary && complementary.checked) {
                                                                        amountField.style.display = 'none';
                                                                        noteField.style.display = 'block';
                                                                    } else {
                                                                        amountField.style.display = 'none';
                                                                        noteField.style.display = 'none';
                                                                    }
                                                                }
                                                            }

                                                            complementary?.addEventListener('change', toggleTransportationFields);
                                                            paid?.addEventListener('change', toggleTransportationFields);
                                                            notAvailable?.addEventListener('change', toggleTransportationFields);

                                                            toggleTransportationFields();
                                                        }
                                                    }

                                                    // Setup toggles for all transportation services
                                                    setupTransportationToggle('airport_pickup');
                                                    setupTransportationToggle('shuttle_service');
                                                    setupTransportationToggle('car_rental');

                                                    // Smoking Policy Toggle Functionality
                                                    const smokingAllowed = document.getElementById('smoking_allowed');
                                                    const smokingNotAllowed = document.getElementById('smoking_not_allowed');
                                                    const smokingNoteField = document.getElementById('smoking_note_field');

                                                    if (smokingAllowed || smokingNotAllowed) {
                                                        function toggleSmokingNote() {
                                                            if (smokingAllowed && smokingAllowed.checked) {
                                                                smokingNoteField.style.display = 'block';
                                                            } else {
                                                                smokingNoteField.style.display = 'none';
                                                            }
                                                        }

                                                        smokingAllowed?.addEventListener('change', toggleSmokingNote);
                                                        smokingNotAllowed?.addEventListener('change', toggleSmokingNote);

                                                        toggleSmokingNote();
                                                    }
                                                });
                                            </script>
                                        </div>

                                        <!-- Room Availability Tab -->
                                        <div class="tab-pane" id="Availability">
                                            <div class="row gy-4">
                                                <div class="col-md-12 col-lg-12 col-xxl-12">
                                                    <div class="row gy-4">
                                                        <div class="price-card-room">
                                                            <h3 class="can-tittle">Room Availability</h3>
                                                            <p class="text-muted" style="font-size: 14px; margin-top: -10px;">Select dates when this room will be available for booking. The room will only appear on the website on selected dates.</p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Select Available Dates</label>
                                                                <input type="hidden" id="availability_dates_hidden" name="availability_dates" value="{{ old('availability_dates') }}">
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

                                        <!-- Photos Tab -->
                                        <div class="tab-pane" id="Photos">
                                            <div class="row gy-4">
                                                @php
                                                    $photo_categories = [
                                                        'feature_main' => 'Thumbnail Photo',
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

                // Bathroom Details Counter and Dynamic Sections
                let bathroomCount = {{ old('total_washrooms', 0) }};
                const totalBathroomsDisplay = document.getElementById('totalBathrooms');
                const totalBathroomsInput = document.getElementById('totalBathroomsInput');
                const bathroomIncreaseBtn = document.getElementById('bathroomIncreaseBtn');
                const bathroomDecreaseBtn = document.getElementById('bathroomDecreaseBtn');
                const bathroomDetailsContainer = document.getElementById('bathroomDetailsContainer');

                // Bathroom options
                const bathroomOptions = ['Attached', 'Private', 'Shower', 'Bathtub', 'Toiletries', 'Hot Water'];

                // Function to generate a bathroom detail section
                function generateBathroomSection(index, existingData = {}) {
                    const checkedOptions = existingData || [];
                    return `
                        <div class="bathroom-section mb-4" data-bathroom-index="${index}" style="padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                            <h6 style="color: #495057; font-weight: 600; margin-bottom: 15px;">Bathroom ${index + 1} Details</h6>
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px 20px;">
                                ${bathroomOptions.map(option => `
                                    <label style="display: flex; align-items: center; margin-bottom: 0;">
                                        <input type="checkbox" name="room_info[bathrooms][${index}][]" class="checkbox-item-room-info" value="${option}" ${checkedOptions.includes(option) ? 'checked' : ''} style="margin-right: 8px;">
                                        <span>${option}</span>
                                    </label>
                                `).join('')}
                            </div>
                            <!-- Custom Bathroom Container for this bathroom -->
                            <div class="custom-bathroom-container-${index} mt-3" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px 20px;"></div>
                            <!-- Add More Bathroom Feature -->
                            <div class="add-more-section mt-3">
                                <div class="input-group" style="max-width: 400px;">
                                    <input type="text" class="form-control custom-bathroom-input-${index}" placeholder="Enter custom bathroom feature">
                                    <button type="button" class="btn btn-primary btn-sm add-bathroom-feature-btn" data-index="${index}">Add</button>
                                </div>
                            </div>
                        </div>
                    `;
                }

                // Function to render all bathroom sections
                function renderBathroomSections(count, existingBathrooms = []) {
                    if (!bathroomDetailsContainer) return;
                    bathroomDetailsContainer.innerHTML = '';
                    for (let i = 0; i < count; i++) {
                        const existingData = existingBathrooms[i] || [];
                        bathroomDetailsContainer.innerHTML += generateBathroomSection(i, existingData);
                    }
                    
                    // Attach event listeners for custom bathroom features
                    attachBathroomFeatureListeners();
                }

                // Function to attach listeners for adding custom bathroom features
                function attachBathroomFeatureListeners() {
                    document.querySelectorAll('.add-bathroom-feature-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const index = this.getAttribute('data-index');
                            const input = document.querySelector(`.custom-bathroom-input-${index}`);
                            const container = document.querySelector(`.custom-bathroom-container-${index}`);
                            const value = input.value.trim();
                            
                            if (value) {
                                const checkbox = document.createElement('label');
                                checkbox.style.display = 'flex';
                                checkbox.style.alignItems = 'center';
                                checkbox.style.marginBottom = '0';
                                checkbox.innerHTML = `
                                    <input type="checkbox" name="room_info[bathrooms][${index}][]" class="checkbox-item-room-info" value="${value}" checked style="margin-right: 8px;">
                                    <span>${value}</span>
                                `;
                                container.appendChild(checkbox);
                                input.value = '';
                            }
                        });
                    });
                }

                // Counter event listeners
                if (bathroomIncreaseBtn) {
                    bathroomIncreaseBtn.addEventListener('click', function (event) {
                        event.preventDefault();
                        bathroomCount++;
                        totalBathroomsDisplay.textContent = bathroomCount;
                        totalBathroomsInput.value = bathroomCount;
                        renderBathroomSections(bathroomCount);
                    });
                }

                if (bathroomDecreaseBtn) {
                    bathroomDecreaseBtn.addEventListener('click', function (event) {
                        event.preventDefault();
                        if (bathroomCount > 0) {
                            bathroomCount--;
                            totalBathroomsDisplay.textContent = bathroomCount;
                            totalBathroomsInput.value = bathroomCount;
                            renderBathroomSections(bathroomCount);
                        }
                    });
                }

                // Initialize bathroom sections on page load
                @if(old('total_washrooms', 0) > 0)
                    const existingBathrooms = @json(old('room_info.bathrooms', []));
                    renderBathroomSections(bathroomCount, existingBathrooms);
                @else
                    renderBathroomSections(bathroomCount);
                @endif

                // Bed Details Counter and Dynamic Sections
                let bedCount = {{ old('total_beds', 0) }};
                const totalBedsDisplay = document.getElementById('totalBeds');
                const totalBedsInput = document.getElementById('totalBedsInput');
                const bedIncreaseBtn = document.getElementById('bedIncreaseBtn');
                const bedDecreaseBtn = document.getElementById('bedDecreaseBtn');
                const bedDetailsContainer = document.getElementById('bedDetailsContainer');

                // Bed type options
                const bedTypeOptions = ['King', 'Queen', 'Twin', 'Single'];
                let customBedTypes = []; // Store custom bed types

                // Function to generate a bed detail section
                function generateBedSection(index, existingData = {}) {
                    const bedType = existingData.bed_type || '';
                    const numberOfBeds = existingData.number_of_beds || '';
                    const isCustom = bedType && !bedTypeOptions.includes(bedType);
                    
                    return `
                        <div class="bed-section mb-4" data-bed-index="${index}" style="padding: 15px; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                            <h6 style="color: #495057; font-weight: 600; margin-bottom: 15px;">Bed ${index + 1} Details</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight: 600; margin-bottom: 8px;">Bed Type</label>
                                        <select class="form-control bed-type-select" name="room_info[beds][${index}][bed_type]" data-bed-index="${index}" style="border: 1px solid #dee2e6; border-radius: 6px;">
                                            <option value="">Select Bed Type</option>
                                            ${bedTypeOptions.map(option => `
                                                <option value="${option}" ${bedType === option ? 'selected' : ''}>${option}</option>
                                            `).join('')}
                                            ${customBedTypes.map(customType => `
                                                <option value="${customType}" ${bedType === customType ? 'selected' : ''}>${customType}</option>
                                            `).join('')}
                                            <option value="Custom" ${isCustom ? 'selected' : ''}>Custom</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="number_of_beds_field_${index}" style="display: ${bedType ? 'block' : 'none'};">
                                        <label class="form-label" style="font-weight: 600; margin-bottom: 8px;">Number of Beds</label>
                                        <input type="number" class="form-control" name="room_info[beds][${index}][number_of_beds]" value="${numberOfBeds}" placeholder="0" min="1" style="border: 1px solid #dee2e6; border-radius: 6px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="custom_bed_type_field_${index}" style="display: ${isCustom ? 'block' : 'none'}; margin-top: 15px;">
                                        <label class="form-label" style="font-weight: 600; margin-bottom: 8px;">Custom Bed Type</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control custom-bed-type-input-${index}" placeholder="Enter custom bed type" value="${isCustom ? bedType : ''}" style="border: 1px solid #dee2e6; border-radius: 6px;">
                                            <button type="button" class="btn btn-primary btn-sm add-custom-bed-type-btn" data-index="${index}">Add</button>
                                        </div>
                                        <input type="hidden" name="room_info[beds][${index}][custom_bed_type]" id="custom_bed_type_hidden_${index}" value="${isCustom ? bedType : ''}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }

                // Function to render all bed sections
                function renderBedSections(count, existingBeds = []) {
                    if (!bedDetailsContainer) return;
                    bedDetailsContainer.innerHTML = '';
                    for (let i = 0; i < count; i++) {
                        const existingData = existingBeds[i] || {};
                        bedDetailsContainer.innerHTML += generateBedSection(i, existingData);
                    }
                    
                    // Attach event listeners
                    attachBedEventListeners();
                }

                // Function to attach event listeners for bed sections
                function attachBedEventListeners() {
                    // Bed type select change handlers
                    document.querySelectorAll('.bed-type-select').forEach(select => {
                        select.addEventListener('change', function() {
                            const index = this.getAttribute('data-bed-index');
                            const selectedValue = this.value;
                            const numberField = document.getElementById(`number_of_beds_field_${index}`);
                            const customField = document.getElementById(`custom_bed_type_field_${index}`);
                            const customHidden = document.getElementById(`custom_bed_type_hidden_${index}`);
                            
                            if (selectedValue === 'Custom') {
                                customField.style.display = 'block';
                                numberField.style.display = 'block'; // Show number of beds for custom too
                                customHidden.value = '';
                            } else if (selectedValue) {
                                customField.style.display = 'none';
                                numberField.style.display = 'block';
                                customHidden.value = '';
                            } else {
                                customField.style.display = 'none';
                                numberField.style.display = 'none';
                                customHidden.value = '';
                            }
                        });
                    });

                    // Custom bed type add button handlers
                    document.querySelectorAll('.add-custom-bed-type-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const index = this.getAttribute('data-index');
                            const input = document.querySelector(`.custom-bed-type-input-${index}`);
                            const hiddenInput = document.getElementById(`custom_bed_type_hidden_${index}`);
                            const select = document.querySelector(`select[data-bed-index="${index}"]`);
                            const value = input.value.trim();
                            
                            if (value) {
                                // Add to custom bed types array if not already present
                                if (!customBedTypes.includes(value)) {
                                    customBedTypes.push(value);
                                }
                                
                                // Update hidden input
                                hiddenInput.value = value;
                                
                                // Update select to show the custom value
                                select.value = value;
                                
                                // Add option to select if not exists
                                if (!Array.from(select.options).some(opt => opt.value === value)) {
                                    const option = document.createElement('option');
                                    option.value = value;
                                    option.textContent = value;
                                    select.insertBefore(option, select.lastElementChild);
                                }
                                
                                // Number of beds field should already be visible, but ensure it is
                                document.getElementById(`number_of_beds_field_${index}`).style.display = 'block';
                                
                                // Trigger change event to update all selects
                                document.querySelectorAll('.bed-type-select').forEach(s => {
                                    if (!Array.from(s.options).some(opt => opt.value === value)) {
                                        const opt = document.createElement('option');
                                        opt.value = value;
                                        opt.textContent = value;
                                        s.insertBefore(opt, s.lastElementChild);
                                    }
                                });
                                
                                input.value = '';
                            }
                        });
                    });
                }

                // Counter event listeners
                if (bedIncreaseBtn) {
                    bedIncreaseBtn.addEventListener('click', function (event) {
                        event.preventDefault();
                        bedCount++;
                        totalBedsDisplay.textContent = bedCount;
                        totalBedsInput.value = bedCount;
                        renderBedSections(bedCount);
                    });
                }

                if (bedDecreaseBtn) {
                    bedDecreaseBtn.addEventListener('click', function (event) {
                        event.preventDefault();
                        if (bedCount > 0) {
                            bedCount--;
                            totalBedsDisplay.textContent = bedCount;
                            totalBedsInput.value = bedCount;
                            renderBedSections(bedCount);
                        }
                    });
                }

                // Initialize bed sections on page load
                @if(old('total_beds', 0) > 0)
                    const existingBeds = @json(old('room_info.beds', []));
                    // Extract custom bed types from existing beds
                    if (existingBeds && Array.isArray(existingBeds)) {
                        existingBeds.forEach(bed => {
                            if (bed.bed_type && !bedTypeOptions.includes(bed.bed_type)) {
                                if (!customBedTypes.includes(bed.bed_type)) {
                                    customBedTypes.push(bed.bed_type);
                                }
                            }
                        });
                    }
                    renderBedSections(bedCount, existingBeds);
                @else
                    renderBedSections(bedCount);
                @endif

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
                const form = document.querySelector('form[action*="room.store"]');
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
                            // Ensure total_beds is synced before submission
                            const totalBedsInput = document.getElementById('totalBedsInput');
                            const totalBedsDisplay = document.getElementById('totalBeds');
                            if (totalBedsInput && totalBedsDisplay) {
                                const currentValue = parseInt(totalBedsDisplay.textContent) || 0;
                                totalBedsInput.value = currentValue;
                            }
                            
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
                                        const dateStr = day.getAttribute('aria-label');
                                        if (dateStr) {
                                            const endDate = new Date(dateStr);
                                            const start = rangeStart < endDate ? rangeStart : endDate;
                                            const end = rangeStart < endDate ? endDate : rangeStart;
                                            
                                            // Add all dates in range
                                            const currentDate = new Date(start);
                                            while (currentDate <= end) {
                                                const dateStr = currentDate.toISOString().split('T')[0];
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
