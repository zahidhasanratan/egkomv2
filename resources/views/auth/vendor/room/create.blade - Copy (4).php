@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Manage Room</h3>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <!-- Form Start -->
                                <form action="{{ route('vendor-admin.room.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

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
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="is_active" checked>
                                                    </div>
                                                    <div id="alertMessage" style="display: none; color: red; margin-top:0px;"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-lg-2 col-xxl-3">
                                                <div class="form-group" style="margin-bottom: 0px;">
                                                    <label class="form-label">Edit your information</label>
                                                    <a style="font-size: 1em;" class="badges badge-primary" href="#">
                                                        <em class="icon ni ni-edit"></em>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Room Description -->
                                        <div class="tab-pane active" id="tabItem3">
                                            <div class="row gy-4">
                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Name</label>
                                                        <input type="text" class="form-control" name="name" placeholder="Room Name" required>
                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Number</label>
                                                        <input type="number" class="form-control" name="number" placeholder="Room number" required>
                                                        @error('number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Floor Number</label>
                                                        <input type="number" class="form-control" name="floor_number" placeholder="Room Floor Number" required>
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
                                                            <input type="number" class="form-control" name="price_per_night" placeholder="Ex: BDT 1,500" required>
                                                            @error('price_per_night')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Weekend Price</label>
                                                            <input type="number" class="form-control" name="weekend_price" placeholder="Ex: BDT 1,500">
                                                            @error('weekend_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Holiday Price</label>
                                                            <input type="number" class="form-control" name="holiday_price" placeholder="Ex: BDT 1,500">
                                                            @error('holiday_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Discount Type</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="discount_type" id="discountAmount" value="amount">
                                                                <label class="form-check-label" for="discountAmount">Discount by Amount</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="discount_type" id="discountPercentage" value="percentage">
                                                                <label class="form-check-label" for="discountPercentage">Discount by Percentage (%)</label>
                                                            </div>
                                                            <div class="mt-3 hidden" id="amountInputField">
                                                                <label for="amount" class="form-label">Enter Discount Amount:</label>
                                                                <input type="number" class="form-control" name="discount_amount" id="amount" placeholder="Ex: 3500">
                                                                @error('discount_amount')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="mt-3 hidden" id="percentageInputField">
                                                                <label for="percentage" class="form-label">Enter Discount Percentage (%)</label>
                                                                <input type="number" class="form-control" name="discount_percentage" id="percentage" placeholder="Ex: 15 %">
                                                                @error('discount_percentage')
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
                                                                        <button class="btn decrease-male">-</button>
                                                                        <span class="count male-count" id="totalPersons">0</span>
                                                                        <input type="hidden" name="total_persons" id="totalPersonsInput" value="0">
                                                                        <button class="btn increase-male">+</button>
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
                                                            <textarea class="form-control no-resize" name="description" id="default-textarea">Large text area content</textarea>
                                                            @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Room Size</label>
                                                        <input type="number" class="form-control" name="size" placeholder="Ex: 1200 SFT" required>
                                                        @error('size')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Total Rooms -->
                                                <div class="col-md-6 col-lg-2 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Total Room</label>
                                                        <div class="counter-wrapper">
                                                            <div class="counter-card">
                                                                <div>
                                                                    <div class="counter">
                                                                        <button class="btn decrease-male">-</button>
                                                                        <span id="totalRooms" class="count male-count">0</span>
                                                                        <input type="hidden" name="total_rooms" id="totalRoomsInput" value="0">
                                                                        <button class="btn increase-male">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('total_rooms')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Total Washrooms -->
                                                <div class="col-md-6 col-lg-2 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Total Washroom</label>
                                                        <div class="counter-wrapper">
                                                            <div class="counter-card">
                                                                <div>
                                                                    <div class="counter">
                                                                        <button class="btn decrease-male">-</button>
                                                                        <span id="totalWashrooms" class="count male-count">0</span>
                                                                        <input type="hidden" name="total_washrooms" id="totalWashroomsInput" value="0">
                                                                        <button class="btn increase-male">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('total_washrooms')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Total Beds -->
                                                <div class="col-md-6 col-lg-2 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Total Beds</label>
                                                        <div class="counter-wrapper">
                                                            <div class="counter-card">
                                                                <div>
                                                                    <div class="counter">
                                                                        <button class="btn decrease-male">-</button>
                                                                        <span id="totalBeds" class="count male-count">0</span>
                                                                        <input type="hidden" name="total_beds" id="totalBedsInput" value="0">
                                                                        <button class="btn increase-male">+</button>
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
                                                        <label class="form-label" for="first-name">WiFi Details/Password</label>
                                                        <input type="text" class="form-control" name="wifi_details" placeholder="WiFi Details/Password">
                                                        @error('wifi_details')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Appliances Information -->
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

                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="AC"> AC</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="TV"> TV</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Fridge"> Fridge</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Microwave"> Microwave</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Fan"> Fan</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Lamp"> Lamp</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Light"> Light</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Water heater/Geyser"> Water heater/Geyser</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="WiFi Router"> WiFi Router</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Crockeries"> Crockeries</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Gas Stove"> Gas Stove</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Electric Kettle"> Electric Kettle</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Room Heater"> Room Heater</label><br>
                                                    <label><input type="checkbox" name="appliances[]" class="checkbox-item-appliances" value="Hair Dryer"> Hair Dryer</label><br>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="section">
                                                                <div class="input-container" style="display: none;">
                                                                    <div class="form-group mb-3 d-flex align-items-center">
                                                                        <input type="text" class="form-control" placeholder="Enter something">
                                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                                    </div>
                                                                </div>
                                                                <button class="add-more add-rule-btn btn add-button">Add More</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Furniture Information -->
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

                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Bed"> Bed</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Dining Table with Chair"> Dining Table with Chair</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Sofa/Couch"> Sofa/Couch</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Tea Table"> Tea Table</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Bedside Table"> Bedside Table</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Shoe Rack"> Shoe Rack</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Clothing Cabinet"> Clothing Cabinet</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Clothes Drying Hanger"> Clothes Drying Hanger</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Iron Stand"> Iron Stand</label><br>
                                                    <label><input type="checkbox" name="furniture[]" class="checkbox-item-furniture" value="Locker/Safe"> Locker/Safe</label><br>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="section">
                                                                <div class="input-container" style="display: none;">
                                                                    <div class="form-group mb-3 d-flex align-items-center">
                                                                        <input type="text" class="form-control" placeholder="Enter something">
                                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                                    </div>
                                                                </div>
                                                                <button class="add-more add-rule-btn btn add-button">Add More</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Cancellation Policies -->
                                            <div class="row mt-15">
                                                <div class="col-md-12">
                                                    <h3 class="can-tittle">Cancellation Policies</h3>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input policy-switch" type="checkbox" name="cancellation_policies[]" id="flexiblePolicy" value="flexible">
                                                            <label class="form-check-label" for="flexiblePolicy">Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input policy-switch" type="checkbox" name="cancellation_policies[]" id="nonRefundablePolicy" value="non_refundable">
                                                            <label class="form-check-label" for="nonRefundablePolicy">Non-refundable (Regardless of the cancellation window, customers will not get any refund under this.)</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input policy-switch" type="checkbox" name="cancellation_policies[]" id="partiallyRefundablePolicy" value="partially_refundable">
                                                            <label class="form-check-label" for="partiallyRefundablePolicy">Partially refundable (Cancellations that take place in less than 24 hours and Rooms that are labeled with this badge, after deducting a 30% cancellation fee, rest of the amount will be refunded.)</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input policy-switch" type="checkbox" name="cancellation_policies[]" id="longTermPolicy" value="long_term">
                                                            <label class="form-check-label" for="longTermPolicy">Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed. T&C paper will be found in the system.)</label>
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
                                        <!-- Room Description End -->

                                        <!-- Amenities -->
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
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Soap"> Soap</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Tissue"> Tissue</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Shampoo"> Shampoo</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Toothbrush"> Toothbrush</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Towel"> Towel</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Water bottle"> Water bottle</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Free laundry"> Free laundry</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Air freshener"> Air freshener</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Fruit basket"> Fruit basket</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Complimentary drinks"> Complimentary drinks</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Buffet breakfast"> Buffet breakfast</label><br>
                                                    <label><input type="checkbox" name="amenities[]" class="checkbox-item" value="Add/type Manually"> Add/type Manually</label><br>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="section">
                                                                <div class="input-container" style="display: none;">
                                                                    <div class="form-group mb-3 d-flex align-items-center">
                                                                        <input type="text" class="form-control" placeholder="Enter something">
                                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                                    </div>
                                                                </div>
                                                                <button class="add-more add-rule-btn btn add-button">Add More</button>
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


                                        <!-- Photos -->
                                        <div class="tab-pane" id="Photos">
                                            <div class="row gy-4">
                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Kitchen Photo</label>
                                                        <div class="multiple-upload-container" id="upload-container-1">
                                                            <input type="file" class="multiple-file-input" name="kitchen_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('kitchen_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Washroom Photo</label>
                                                        <div class="multiple-upload-container" id="upload-container-2">
                                                            <input type="file" class="multiple-file-input" name="washroom_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('washroom_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Parking Lot Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="parking_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('parking_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Entrance Gate/Main Gate Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-4">
                                                            <input type="file" class="multiple-file-input" name="entrance_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('entrance_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Lift, Stairs, wheelchair area Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-5">
                                                            <input type="file" class="multiple-file-input" name="accessibility_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('accessibility_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Spa & Massage Center Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-6">
                                                            <input type="file" class="multiple-file-input" name="spa_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('spa_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Bar Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-7">
                                                            <input type="file" class="multiple-file-input" name="bar_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('bar_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Hotels Car & Bus Photo</label>
                                                        <div class="multiple-upload-container" id="upload-container-8">
                                                            <input type="file" class="multiple-file-input" name="transport_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('transport_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Rooftop, Garden, Sitting area Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-9">
                                                            <input type="file" class="multiple-file-input" name="rooftop_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('rooftop_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Gym, Game room & Kids Zone Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-10">
                                                            <input type="file" class="multiple-file-input" name="recreation_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('recreation_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">CCTV, Fire Extinguisher & Surveillance Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-11">
                                                            <input type="file" class="multiple-file-input" name="safety_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('safety_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Hotel/Property Amenities Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-12">
                                                            <input type="file" class="multiple-file-input" name="amenity_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('amenity_photos.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hidden {
            display: none;
        }
    </style>

    <script type="text/javascript">
        document.getElementById('propertyCategory').addEventListener('change', function() {
            var propertyTypeContainer = document.getElementById('propertyTypeContainer');
            var propertyType = document.getElementById('propertyType');
            propertyType.innerHTML = ''; // Clear previous options

            var options = {
                'Hotel': [
                    { id: 'option1', value: 'Only Apartment', label: 'Only Apartment' },
                    { id: 'option2', value: 'Only room', label: 'Only room' },
                    { id: 'option3', value: 'Only Bed', label: 'Only Bed' }
                ],
                'House': [
                    { id: 'option4', value: 'Kitchen', label: 'Kitchen' }
                ],
                'Resort': [
                    { id: 'option6', value: 'Room', label: 'Room' }
                ],
                'Apartment': [
                    { id: 'option7', value: 'Apartment', label: 'Apartment' },
                    { id: 'option8', value: 'Only room', label: 'Only room' },
                    { id: 'option9', value: 'Only Bed', label: 'Only Bed' }
                ]
            };

            var selectedValue = this.value;
            if (options[selectedValue]) {
                options[selectedValue].forEach(function(option) {
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
                            const removeBtn = document.createElement('button');
                            removeBtn.innerHTML = '×';
                            removeBtn.classList.add('multiple-remove-btn');
                            removeBtn.type = 'button'; // Prevent form submission
                            removeBtn.addEventListener('click', (event) => {
                                event.preventDefault(); // Prevent form submission
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
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            const uploadContainers = document.querySelectorAll('.multiple-upload-container');
            uploadContainers.forEach(container => {
                initializeMultipleUpload(container);
            });

            const submitBtn = document.getElementById('submitBtn');
            if (submitBtn) {
                submitBtn.addEventListener('click', (event) => {
                    event.preventDefault(); // Prevent form submission (if not intended)
                    for (const [containerId, files] of Object.entries(uploadedImages)) {
                        console.log(`Images from ${containerId}:`);
                        files.forEach(file => {
                            console.log(file.name);
                        });
                    }
                    alert('Images have been logged in the console!');
                });
            }
        });
    </script>

    <script type="text/javascript">
        document.getElementById("site-off").addEventListener("change", function() {
            let checkboxes = document.querySelectorAll(".checkbox-item");
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById("site-off").checked;
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            const checkbox = document.getElementById("property-ownership");
            const options = document.getElementById("ownership-options");

            if (checkbox && options) {
                checkbox.addEventListener("change", () => {
                    if (checkbox.checked) {
                        options.classList.remove("hidden");
                    } else {
                        options.classList.add("hidden");
                    }
                });
            }
        });
    </script>

    <script>
        function showLabel(text) {
            const labelDiv = document.getElementById('labelText');
            if (labelDiv) {
                labelDiv.textContent = text;
                labelDiv.style.display = 'block';
            }
        }

        function hideLabel() {
            const labelDiv = document.getElementById('labelText');
            if (labelDiv) {
                labelDiv.style.display = 'none';
            }
        }
    </script>

    <script>
        document.getElementById('apartment-count')?.addEventListener('change', function() {
            const count = parseInt(this.value);
            const dynamicFormsContainer = document.getElementById('dynamic-forms');

            if (dynamicFormsContainer) {
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
                        apartmentNumberInput.name = `apartment-${i}-number`;
                        apartmentNumberInput.classList.add('form-control');

                        const apartmentFloorLabel = document.createElement('label');
                        apartmentFloorLabel.textContent = `Apartment ${i} Floor Number:`;
                        apartmentFloorLabel.setAttribute('for', `apartment-${i}-floor`);
                        const apartmentFloorInput = document.createElement('input');
                        apartmentFloorInput.type = 'text';
                        apartmentFloorInput.id = `apartment-${i}-floor`;
                        apartmentFloorInput.name = `apartment-${i}-floor`;
                        apartmentFloorInput.classList.add('form-control');

                        const apartmentNameLabel = document.createElement('label');
                        apartmentNameLabel.textContent = `Apartment/Rooms ${i} Name:`;
                        apartmentNameLabel.setAttribute('for', `apartment-${i}-name`);
                        const apartmentNameInput = document.createElement('input');
                        apartmentNameInput.type = 'text';
                        apartmentNameInput.id = `apartment-${i}-name`;
                        apartmentNameInput.name = `apartment-${i}-name`;
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
            }
        });
    </script>

    <script>
        const radioButtons = document.querySelectorAll('input[name="showFields"]');
        const additionalFields = document.getElementById('additionalFields');

        if (radioButtons && additionalFields) {
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'yes') {
                        additionalFields.style.display = 'block';
                    } else {
                        additionalFields.style.display = 'none';
                    }
                });
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            if (typeof $('.js-select2').select2 === 'function') {
                $('.js-select2').select2();
            }

            $('#propertyOwnershipss')?.on('change', function() {
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

            if (barRadioButtons && barSelectContainer && barNumberSelect) {
                barRadioButtons.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'yes') {
                            barSelectContainer.style.display = 'block';
                        } else {
                            barSelectContainer.style.display = 'none';
                            barNumberSelect.value = '';
                        }
                    });
                });
            }
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

            if (yesOption && noOption && yesFields && noFields) {
                yesOption.addEventListener("change", function () {
                    if (this.checked) {
                        yesFields.classList.remove("hidden");
                        noFields.classList.add("hidden");
                    }
                });

                noOption.addEventListener("change", function () {
                    if (this.checked) {
                        noFields.classList.remove("hidden");
                        yesFields.classList.add("hidden");
                    }
                });
            }
        });
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

            if (divisionSelect && districtSelect && districtContainer && placeCheckboxList && placeOptions) {
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
                    }
                });

                districtSelect.addEventListener("change", function () {
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
            }
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("#facilities-all")?.addEventListener("change", function () {
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
        document.getElementById('addLocationBtn')?.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent form submission
            const selectedSection = document.getElementById('sectionSelect').value;
            const formContainer = document.getElementById('formContainer');

            const uniqueId = `field-group-${Date.now()}`;
            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.setAttribute('id', uniqueId);

            let labels = [];
            switch (selectedSection) {
                case 'restaurant':
                    labels = ['Restaurant Name', 'Distance'];
                    break;
                case 'entertainment':
                    labels = ['Attraction Point', 'Distance'];
                    break;
                case 'hospital':
                    labels = ['Hospital/Police Station Name', 'Distance'];
                    break;
                case 'transport':
                    labels = ['Transport/Airport Name', 'Distance'];
                    break;
                case 'shopping':
                    labels = ['Shopping/ATM Name', 'Distance'];
                    break;
            }

            newFieldGroup.innerHTML = `
            <div class="form-group">
                <label for="input1-${uniqueId}">${labels[0]}</label>
                <input type="text" class="form-control" id="input1-${uniqueId}" placeholder="Enter ${labels[0]}" required>
            </div>
            <div class="form-group mt-2">
                <label for="input2-${uniqueId}">${labels[1]}</label>
                <input type="text" class="form-control" id="input2-${uniqueId}" placeholder="Enter ${labels[1]}" required>
            </div>
            <button type="button" class="delete-btn btn btn-danger btn-sm mt-3">Delete</button>
        `;

            formContainer.appendChild(newFieldGroup);

            newFieldGroup.querySelector('.delete-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                document.getElementById(uniqueId).remove();
            });
        });
    </script>

    <script>
        document.getElementById('addFacilityButton')?.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent form submission
            const selectedFacility = document.getElementById('facilityDropdown').value;
            const formContainer = document.getElementById('dynamicFormContainer');

            const uniqueId = `facility-group-${Date.now()}`;
            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.setAttribute('id', uniqueId);

            let label;
            switch (selectedFacility) {
                case 'general': label = 'General Service'; break;
                case 'activities': label = 'Activity Name'; break;
                case 'safety': label = 'Safety Measure'; break;
                case 'technology': label = 'Technology Feature'; break;
                case 'bedroom': label = 'Bedroom Feature'; break;
                case 'bathroom': label = 'Bathroom Amenity'; break;
                case 'living': label = 'Living Room Feature'; break;
                case 'kitchen': label = 'Kitchen Facility'; break;
                case 'food': label = 'Food/Beverage'; break;
                case 'parking': label = 'Parking Option'; break;
                case 'view': label = 'View Option'; break;
                case 'frontdesk': label = 'Front Desk Service'; break;
                case 'housekeeping': label = 'Housekeeping Service'; break;
                case 'room': label = 'Room Amenity'; break;
                case 'business': label = 'Business Service'; break;
                case 'languages': label = 'Language'; break;
                default: label = 'Unknown Facility';
            }

            newFieldGroup.innerHTML = `
            <div class="form-group">
                <label for="input-${uniqueId}">${label}</label>
                <input type="text" class="form-control" id="input-${uniqueId}" placeholder="Enter ${label}" required>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-3 delete-field-btn">Delete</button>
        `;

            formContainer.appendChild(newFieldGroup);

            newFieldGroup.querySelector('.delete-field-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                formContainer.removeChild(newFieldGroup);
            });
        });
    </script>

    <script>
        const faqContainer = document.getElementById('faq-container');
        const addBtn = document.getElementById('add-btn');

        if (faqContainer && addBtn) {
            function addFaqField(event) {
                event.preventDefault(); // Prevent form submission
                const faqField = document.createElement('div');
                faqField.classList.add('faq-field');

                faqField.innerHTML = `
                <input class="form-control" type="text" placeholder="Question" />
                <input class="form-control" type="text" placeholder="Answer" />
                <button type="button" class="delete-btn">Delete</button>
            `;

                const deleteBtn = faqField.querySelector('.delete-btn');
                deleteBtn.addEventListener('click', (event) => {
                    event.preventDefault(); // Prevent form submission
                    faqField.remove();
                });

                faqContainer.appendChild(faqField);
            }

            addBtn.addEventListener('click', addFaqField);
        }
    </script>

    <script>
        const facilityContainer = document.getElementById('facility-container');
        const addMoreBtn = document.getElementById('add-more-btn');

        if (facilityContainer && addMoreBtn) {
            function addFacilityField(event) {
                event.preventDefault(); // Prevent form submission
                const facilityField = document.createElement('div');
                facilityField.classList.add('input-field');

                facilityField.innerHTML = `
                <input class="form-control" type="text" placeholder="Facility name" />
                <input class="form-control" type="file" accept="image/*" />
                <button type="button" class="delete-btn">Delete</button>
            `;

                const deleteBtn = facilityField.querySelector('.delete-btn');
                deleteBtn.addEventListener('click', (event) => {
                    event.preventDefault(); // Prevent form submission
                    facilityField.remove();
                });

                facilityContainer.appendChild(facilityField);
            }

            addMoreBtn.addEventListener('click', addFacilityField);
        }
    </script>

    <script type="text/javascript">
        document.getElementById("furniture-all")?.addEventListener("change", function () {
            let furnitureCheckboxes = document.querySelectorAll(".checkbox-item-furniture");
            furnitureCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById("furniture-all").checked;
            });
        });

        document.getElementById("appliances-all")?.addEventListener("change", function () {
            let appliancesCheckboxes = document.querySelectorAll(".checkbox-item-appliances");
            appliancesCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById("appliances-all").checked;
            });
        });

        document.querySelector("#property-all")?.addEventListener("change", function () {
            const propertyCheckboxes = document.querySelectorAll(".checkbox-item-property");
            propertyCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.querySelector("#property-all").checked;
            });
        });

        document.getElementById("Appliances")?.addEventListener("change", function () {
            let appliancesCheckboxes = document.querySelectorAll(".checkbox-appliances");
            appliancesCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById("Appliances").checked;
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".add-more").forEach((button) => {
                button.addEventListener("click", function (event) {
                    event.preventDefault(); // Prevent form submission
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
                    deleteButton.type = "button"; // Prevent form submission

                    deleteButton.addEventListener("click", function (event) {
                        event.preventDefault(); // Prevent form submission
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
        document.addEventListener('DOMContentLoaded', function () {
            const discountAmountRadio = document.getElementById('discountAmount');
            const discountPercentageRadio = document.getElementById('discountPercentage');
            const amountInputField = document.getElementById('amountInputField');
            const percentageInputField = document.getElementById('percentageInputField');

            function handleDiscountSelection() {
                if (discountAmountRadio.checked) {
                    amountInputField.classList.remove('hidden');
                    percentageInputField.classList.add('hidden');
                } else if (discountPercentageRadio.checked) {
                    percentageInputField.classList.remove('hidden');
                    amountInputField.classList.add('hidden');
                }
            }

            function handleDoubleClick(event) {
                const radio = event.target;
                if (radio.checked) {
                    radio.checked = false;
                    amountInputField.classList.add('hidden');
                    percentageInputField.classList.add('hidden');
                }
            }

            discountAmountRadio.addEventListener('change', handleDiscountSelection);
            discountPercentageRadio.addEventListener('change', handleDiscountSelection);
            discountAmountRadio.addEventListener('dblclick', handleDoubleClick);
            discountPercentageRadio.addEventListener('dblclick', handleDoubleClick);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roomSwitch = document.getElementById('flexSwitchCheckDefault');
            const alertMessage = document.getElementById('alertMessage');

            roomSwitch.addEventListener('change', function () {
                if (roomSwitch.checked) {
                    alertMessage.style.display = 'block';
                    alertMessage.textContent = "You're room now Active";
                } else {
                    alertMessage.style.display = 'block';
                    alertMessage.textContent = "Your room now Deactive";
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const switches = document.querySelectorAll('.policy-switch');

            switches.forEach((switchElement) => {
                switchElement.addEventListener('change', function () {
                    if (this.checked) {
                        switches.forEach((otherSwitch) => {
                            if (otherSwitch !== this) {
                                otherSwitch.checked = false;
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Helper function to update counter display and input
            function updateCounter(display, input, count) {
                display.textContent = count;
                input.value = count;
            }

            // Total Persons Counter
            let personCount = 0;
            const totalPersonsDisplay = document.getElementById('totalPersons');
            const totalPersonsInput = document.getElementById('totalPersonsInput');
            const personIncreaseBtn = document.querySelector('#tabItem3 .counter-card:nth-child(1) .increase-male');
            const personDecreaseBtn = document.querySelector('#tabItem3 .counter-card:nth-child(1) .decrease-male');

            personIncreaseBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                personCount++;
                updateCounter(totalPersonsDisplay, totalPersonsInput, personCount);
            });
            personDecreaseBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                if (personCount > 0) personCount--;
                updateCounter(totalPersonsDisplay, totalPersonsInput, personCount);
            });

            // Total Rooms Counter
            let roomCount = 0;
            const totalRoomsDisplay = document.getElementById('totalRooms');
            const totalRoomsInput = document.getElementById('totalRoomsInput');
            const roomIncreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalRooms) .increase-male');
            const roomDecreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalRooms) .decrease-male');

            roomIncreaseBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                roomCount++;
                updateCounter(totalRoomsDisplay, totalRoomsInput, roomCount);
            });
            roomDecreaseBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                if (roomCount > 0) roomCount--;
                updateCounter(totalRoomsDisplay, totalRoomsInput, roomCount);
            });

            // Total Washrooms Counter
            let washroomCount = 0;
            const totalWashroomsDisplay = document.getElementById('totalWashrooms');
            const totalWashroomsInput = document.getElementById('totalWashroomsInput');
            const washroomIncreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalWashrooms) .increase-male');
            const washroomDecreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalWashrooms) .decrease-male');

            washroomIncreaseBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                washroomCount++;
                updateCounter(totalWashroomsDisplay, totalWashroomsInput, washroomCount);
            });
            washroomDecreaseBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                if (washroomCount > 0) washroomCount--;
                updateCounter(totalWashroomsDisplay, totalWashroomsInput, washroomCount);
            });

            // Total Beds Counter
            let bedCount = 0;
            const totalBedsDisplay = document.getElementById('totalBeds');
            const totalBedsInput = document.getElementById('totalBedsInput');
            const bedIncreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalBeds) .increase-male');
            const bedDecreaseBtn = document.querySelector('#tabItem3 .counter-card:has(#totalBeds) .decrease-male');

            bedIncreaseBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                bedCount++;
                updateCounter(totalBedsDisplay, totalBedsInput, bedCount);
            });
            bedDecreaseBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                if (bedCount > 0) bedCount--;
                updateCounter(totalBedsDisplay, totalBedsInput, bedCount);
            });
        });
    </script>

    <script>
        const maleCountEl = document.querySelector(".male-count");
        const femaleCountEl = document.querySelector(".female-count");
        const totalCountEl = document.querySelector(".total-count");

        let maleCount = 0;
        let femaleCount = 0;

        function updateTotalCount() {
            if (totalCountEl) totalCountEl.textContent = maleCount + femaleCount;
        }

        document.querySelector(".increase-male")?.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent form submission
            maleCount++;
            if (maleCountEl) maleCountEl.textContent = maleCount;
            updateTotalCount();
        });

        document.querySelector(".decrease-male")?.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent form submission
            if (maleCount > 0) {
                maleCount--;
                if (maleCountEl) maleCountEl.textContent = maleCount;
                updateTotalCount();
            }
        });

        document.querySelector(".increase-female")?.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent form submission
            femaleCount++;
            if (femaleCountEl) femaleCountEl.textContent = femaleCount;
            updateTotalCount();
        });

        document.querySelector(".decrease-female")?.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent form submission
            if (femaleCount > 0) {
                femaleCount--;
                if (femaleCountEl) femaleCountEl.textContent = femaleCount;
                updateTotalCount();
            }
        });
    </script>
@endsection
