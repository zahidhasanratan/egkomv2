@extends('auth.layout.vendor_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Manage Hotel / Property</h3>
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
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Facilities of Hotel / Property</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Photos">Photos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem1">Nearby Area</a>
                                    </li>
                                </ul>


                                <form method="POST" action="{{ route('vendor-admin.hotel.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content">
                                        <!-- Hotel Description -->
                                        <div class="tab-pane active" id="tabItem3">
                                            <!-- Hotel Information Section -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Hotel / Property Information</strong></h5>
                                                        
                                                        <div class="row gy-4">
                                                            <div class="col-md-6 col-lg-4 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label for="division" class="form-label">Select Property
                                                                        Category</label>
                                                                    <select name="property_category" class="form-control" id="division">
                                                                        <option value="">Select Property</option>
                                                                        <option value="Hotels">Hotels</option>
                                                                        <option value="Transit">Transit Hotels</option>
                                                                        <option value="Resorts">Resorts, Eco, & Outdoor</option>
                                                                        <option value="Apartments">Hostels & Lodges</option>
                                                                        <option value="Guesthouses">Apartments & Homestays</option>
                                                                        <option value="Guesthouses">Vacation Rentals & Guesthouses</option>
                                                                        <option value="Crisis">Crisis & Shelter Accommodation</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-4 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label for="property_type" id="districtContainer" class="form-label">Property Type</label>
                                                                    <select name="property_type" class="form-control">
                                                                        <option>Hotels</option>
                                                                        <option>Transit</option>
                                                                        <option>Resorts</option>
                                                                        <option>Lodges</option>
                                                                        <option>Guesthouses</option>
                                                                        <option>Crisis</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-4 col-xxl-12" id="placeCheckboxList"
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

                                                            <div class="col-md-4 col-lg-4 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="default-textarea">Hotel /
                                                                        Property Name</label>
                                                                    <div class="form-control-wrap">
                                                                        <input class="form-control no-resize"
                                                                               name="description" value="{{ old('description', '') }}"
                                                                               placeholder="Enter Hotel / Property Name"></input>
                                                                        @error('description') <span
                                                                            class="text-danger"></span> @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="default-textarea">Hotel/Property Description & Policy</label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control no-resize" id="default-textarea1" name="details"></textarea>
                                                                        @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Select how many apartments/rooms --}}
                                                            <div class="col-md-4 col-lg-4 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label for="apartment-count">Enter Number of Apartments/Rooms</label>
                                                                    <input type="number" 
                                                                           class="form-control" 
                                                                           id="apartment-count" 
                                                                           name="apartment_count" 
                                                                           min="0" 
                                                                           value="{{ old('apartment_count', 0) }}" 
                                                                           placeholder="Enter number of rooms">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Dynamic forms removed - rooms will be created on room list page --}}
                                            <div id="dynamic-forms" class="dynamic-forms col-12" style="display: none;">
                                                {{-- Rooms will be created as blank entries on the room list page based on apartment_count --}}
                                            </div>

                                            <!-- Property Policy And Rules Section -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Property Policy and Rules</strong></h5>
                                                        
                                                        <div class="row gy-4">

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Pets allowed</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="pets_allowed" value="yes" class="bar-radio-yes" data-target="pets-input"> Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="pets_allowed" value="no" class="bar-radio-no" data-target="pets-input"> No
                                                            </label>
                                                        </div>
                                                        <div class="input-group hidden" id="pets-input">
                                                            <textarea class="form-control" name="pets_details" id="pets-details1" placeholder="" style="height: 50px;"></textarea>
                                                        </div>
                                                        @error('pets_allowed') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Events & Party</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="events_allowed" value="yes" class="bar-radio-yes" data-target="events-input"> Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="events_allowed" value="no" class="bar-radio-no" data-target="events-input"> No
                                                            </label>
                                                        </div>
                                                        <div class="input-group hidden" id="events-input">
                                                            <textarea class="form-control" name="events_details" placeholder="" style="height: 50px;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Smoking</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="smoking_allowed" value="yes" class="bar-radio-yes" data-target="Smoking-input"> Yes (Vaping Or e‑cigarettes)
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="smoking_allowed" value="no" class="bar-radio-no" data-target="Smoking-input"> No
                                                            </label>
                                                        </div>
                                                        <div class="input-group hidden" id="Smoking-input">
                                                            <textarea class="form-control" name="smoking_details" placeholder="" style="height: 50px;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Quiet Hours</label>
                                                        <input type="text" class="form-control" name="quiet_hours" placeholder="Quiet Hours" required>
                                                        @error('quiet_hours') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Commercial photography and filming allowed</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="photography_allowed" value="yes" class="bar-radio-yes" data-target="photography-input"> Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="photography_allowed" value="no" class="bar-radio-no" data-target="photography-input"> No
                                                            </label>
                                                        </div>
                                                        <div class="input-group hidden" id="photography-input">
                                                            <textarea class="form-control" name="photography_details" placeholder="" style="height: 50px;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Check-in Time</label>
                                                        <select class="form-select mb-3" name="check_in_window" aria-label="Large select example">
                                                            <option selected value="">Select Check-in Time</option>
                                                            <option value="1:00 AM">1:00 AM</option>
                                                            <option value="2:00 AM">2:00 AM</option>
                                                            <option value="3:00 AM">3:00 AM</option>
                                                            <option value="4:00 AM">4:00 AM</option>
                                                            <option value="5:00 AM">5:00 AM</option>
                                                            <option value="6:00 AM">6:00 AM</option>
                                                            <option value="7:00 AM">7:00 AM</option>
                                                            <option value="8:00 AM">8:00 AM</option>
                                                            <option value="9:00 AM">9:00 AM</option>
                                                            <option value="10:00 AM">10:00 AM</option>
                                                            <option value="11:00 AM">11:00 AM</option>
                                                            <option value="12:00 PM">12:00 PM (Noon)</option>
                                                            <option value="1:00 PM">1:00 PM</option>
                                                            <option value="2:00 PM">2:00 PM</option>
                                                            <option value="3:00 PM">3:00 PM</option>
                                                            <option value="4:00 PM">4:00 PM</option>
                                                            <option value="5:00 PM">5:00 PM</option>
                                                            <option value="6:00 PM">6:00 PM</option>
                                                            <option value="7:00 PM">7:00 PM</option>
                                                            <option value="8:00 PM">8:00 PM</option>
                                                            <option value="9:00 PM">9:00 PM</option>
                                                            <option value="10:00 PM">10:00 PM</option>
                                                            <option value="11:00 PM">11:00 PM</option>
                                                            <option value="12:00 AM">12:00 AM (Midnight)</option>
                                                        </select>
                                                        @error('check_in_window') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Check Out time</label>
                                                        <select class="form-select mb-3" name="check_out_time" aria-label="Large select example">
                                                            <option selected value="">Select Check Out time</option>
                                                            <option value="1:00 AM">1:00 AM</option>
                                                            <option value="2:00 AM">2:00 AM</option>
                                                            <option value="3:00 AM">3:00 AM</option>
                                                            <option value="4:00 AM">4:00 AM</option>
                                                            <option value="5:00 AM">5:00 AM</option>
                                                            <option value="6:00 AM">6:00 AM</option>
                                                            <option value="7:00 AM">7:00 AM</option>
                                                            <option value="8:00 AM">8:00 AM</option>
                                                            <option value="9:00 AM">9:00 AM</option>
                                                            <option value="10:00 AM">10:00 AM</option>
                                                            <option value="11:00 AM">11:00 AM</option>
                                                            <option value="12:00 PM">12:00 PM (Noon)</option>
                                                            <option value="1:00 PM">1:00 PM</option>
                                                            <option value="2:00 PM">2:00 PM</option>
                                                            <option value="3:00 PM">3:00 PM</option>
                                                            <option value="4:00 PM">4:00 PM</option>
                                                            <option value="5:00 PM">5:00 PM</option>
                                                            <option value="6:00 PM">6:00 PM</option>
                                                            <option value="7:00 PM">7:00 PM</option>
                                                            <option value="8:00 PM">8:00 PM</option>
                                                            <option value="9:00 PM">9:00 PM</option>
                                                            <option value="10:00 PM">10:00 PM</option>
                                                            <option value="11:00 PM">11:00 PM</option>
                                                            <option value="12:00 AM">12:00 AM (Midnight)</option>
                                                        </select>
                                                        @error('check_out_time') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Food & Laundry Facilities</label>
                                                        <div class="bar-radio-group">
                                                            <label>
                                                                <input type="radio" name="food_laundry" value="yes" class="bar-yes"> Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="food_laundry" value="no" class="bar-no"> No
                                                            </label>
                                                        </div>
                                                        @error('food_laundry') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xxl-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Check-in rules if any</label>

                                                        {{-- Checkbox rules --}}
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="checkbox" name="check_in_rules[]" value="Pay in advance"> Pay in advance
                                                            </label>
                                                            <label>
                                                                <input type="checkbox" name="check_in_rules[]" value="Security money for keys"> Security money for keys
                                                            </label>
                                                            <label>
                                                                <input type="checkbox" name="check_in_rules[]" value="Rentals"> Rentals
                                                            </label>
                                                        </div>

                                                        {{-- Dynamic custom input fields --}}
                                                        <div id="custom-checkin-wrapper">
                                                            <div class="form-group mb-2 d-flex align-items-center">
                                                                <input type="text" name="custom_check_in_rules[]" class="form-control" placeholder="Enter something">
                                                                <button type="button" class="btn btn-danger btn-sm ms-2 remove-checkin" style="display: none;">Delete</button>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add-checkin-rule">Add More</button>

                                                        @error('check_in_rules') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Property Information Section -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Property Info</strong></h5>
                                                        
                                                        <div class="checkbox-section">

                                                    <!-- “Select All” toggle and predefined checkboxes -->
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox"
                                                                       class="custom-control-input select-all"
                                                                       name="property_all"
                                                                       id="property-all"
                                                                       data-target="checkbox-item-property">
                                                                <label class="custom-control-label" for="property-all">
                                                                    Select All Property Info
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <label><input type="checkbox" name="property_info[]" value="Guests must climb stairs" class="checkbox-item-property"> Guests must climb stairs</label><br>
                                                    <label><input type="checkbox" name="property_info[]" value="No lift/Elevator" class="checkbox-item-property"> No lift/Elevator</label><br>
                                                    <label><input type="checkbox" name="property_info[]" value="Potential noise during stays" class="checkbox-item-property"> Potential noise during stays</label><br>
                                                    <label><input type="checkbox" name="property_info[]" value="Pet(s) live on the property" class="checkbox-item-property"> Pet(s) live on the property</label><br>
                                                    <label><input type="checkbox" name="property_info[]" value="No parking on the property" class="checkbox-item-property"> No parking on the property</label><br>
                                                    <label><input type="checkbox" name="property_info[]" value="Property has shared spaces" class="checkbox-item-property"> Property has shared spaces</label><br>
                                                    <label><input type="checkbox" name="property_info[]" value="Limited essential amenities" class="checkbox-item-property"> Limited essential amenities</label><br>
                                                    <label><input type="checkbox" name="property_info[]" value="Weapon(s) on the property" class="checkbox-item-property"> Weapon(s) on the property</label><br>
                                                    <label><input type="checkbox" name="property_info[]" value="Commercial shops in the building" class="checkbox-item-property"> Commercial shops in the building</label><br>
                                                    <label><input type="checkbox" name="property_info[]" value="Offices in the building" class="checkbox-item-property"> Offices in the building</label><br>

                                                    <!-- Dynamic “Custom Property Info” inputs -->
                                                    <div id="custom-property-wrapper">
                                                        <div class="form-group mb-3 d-flex align-items-center">
                                                            <input type="text"
                                                                   name="custom_property_info[]"
                                                                   class="form-control"
                                                                   placeholder="Enter something">
                                                            <button type="button"
                                                                    class="btn btn-danger btn-sm ms-2 remove-property-info"
                                                                    style="display: none;">
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <button type="button"
                                                            class="btn btn-primary btn-sm mt-2"
                                                            id="add-property-info">
                                                        Add More
                                                    </button>

                                                    @error('property_info')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function () {
                                                        const wrapper = document.getElementById('custom-property-wrapper');
                                                        const addBtn  = document.getElementById('add-property-info');

                                                        addBtn.addEventListener('click', function () {
                                                            // Create a new input group
                                                            const group = document.createElement('div');
                                                            group.className = 'form-group mb-3 d-flex align-items-center';

                                                            // Text input
                                                            const input = document.createElement('input');
                                                            input.type = 'text';
                                                            input.name = 'custom_property_info[]';
                                                            input.className = 'form-control';
                                                            input.placeholder = 'Enter something';

                                                            // Delete button
                                                            const removeBtn = document.createElement('button');
                                                            removeBtn.type = 'button';
                                                            removeBtn.className = 'btn btn-danger btn-sm ms-2 remove-property-info';
                                                            removeBtn.textContent = 'Delete';
                                                            removeBtn.style.display = 'inline-block';

                                                            removeBtn.addEventListener('click', () => group.remove());

                                                            // Append and show
                                                            group.appendChild(input);
                                                            group.appendChild(removeBtn);
                                                            wrapper.appendChild(group);
                                                        });

                                                        // Attach delete to any existing remove buttons
                                                        wrapper.addEventListener('click', function (e) {
                                                            if (e.target.classList.contains('remove-property-info')) {
                                                                e.target.closest('.form-group').remove();
                                                            }
                                                        });
                                                    });
                                                </script>

                                            </div>

                                            <!-- Start: Arrival Guideline Information -->
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Arrival Guides</h3>
                                                    <div class="row gy-2">
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="first-name">Age Restrictions</label>
                                                                <div class="radio-group">
                                                                    <label>
                                                                        <input type="radio" name="age_restriction" value="yes" class="bar-radio-yes" data-target="Age-input"> Yes
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="age_restriction" value="no" class="bar-radio-no" data-target="Age-input"> No
                                                                    </label>
                                                                </div>
                                                                <div class="input-group hidden" id="Age-input">
                                                                    <textarea class="form-control no-resize" name="age_restriction_details"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="first-name">Vlogging & Commercial Filming</label>
                                                                <div class="radio-group">
                                                                    <label>
                                                                        <input type="radio" name="vlogging_allowed" value="yes" class="bar-radio-yes" data-target="Vlogging-input"> Yes
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="vlogging_allowed" value="no" class="bar-radio-no" data-target="Vlogging-input"> No
                                                                    </label>
                                                                </div>
                                                                <div class="input-group hidden" id="Vlogging-input">
                                                                    <textarea class="form-control no-resize" name="vlogging_details"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-textarea">Child Policy</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea id="ChildPolicy1"  class="form-control no-resize" name="child_policy"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-textarea">Special Instructions</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea id="Instruction1" class="form-control no-resize" name="extra_bed_policy"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-textarea">Cooking Policy</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" name="cooking_policy"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-textarea">Directions (Location Direction details)</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea id="location-direction1" class="form-control no-resize" name="directions"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-lg-12 col-xxl-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-textarea">Additional Policy</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" name="additional_policy"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Start: Check in method -->
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Check in method</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input" name="check_in_all" id="check-in-all">
                                                                <label class="custom-control-label" for="check-in-all">Check All</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label><input type="checkbox" name="check_in_methods[]" value="Building staff" class="checkbox-item-checkin"> Building staff</label><br>
                                                    <label><input type="checkbox" name="check_in_methods[]" value="Housekeeping" class="checkbox-item-checkin"> Housekeeping</label><br>
                                                    <label><input type="checkbox" name="check_in_methods[]" value="Bell boy" class="checkbox-item-checkin"> Bell boy</label><br>
                                                    <label><input type="checkbox" name="check_in_methods[]" value="In-person/Self check-in" class="checkbox-item-checkin"> In-person/Self check-in</label><br>
                                                    <label><input type="checkbox" name="check_in_methods[]" value="Smart lock" class="checkbox-item-checkin"> Smart lock</label><br>
                                                    <label><input type="checkbox" name="check_in_methods[]" value="Keypad" class="checkbox-item-checkin"> Keypad</label><br>
                                                    <label><input type="checkbox" name="check_in_methods[]" value="Lockbox" class="checkbox-item-checkin"> Lockbox</label><br>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <button class="add-rule-btn btn add-button" id="addRuleBtn">Add More +</button>
                                                        </div>
                                                        <div class="form-container" id="formContainer">
                                                            <!-- Input fields will be dynamically added here -->
                                                        </div>
                                                    </div>
                                                    @error('check_in_methods') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <!-- Start: Cancellation Policies -->
                                            <div class="row mt-15">
                                                <div class="col-md-12">
                                                    <h3 class="can-tittle">Cancellation Policies</h3>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox" name="cancellation_policies[]" value="Flexible" id="flexSwitch1">
                                                            <label class="form-check-label" for="flexSwitch1">
                                                                Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox" name="cancellation_policies[]" value="Non-refundable" id="flexSwitch2">
                                                            <label class="form-check-label" for="flexSwitch2">
                                                                Non-refundable (Regardless of the cancellation window, customers will not get any refund under this.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox" name="cancellation_policies[]" value="Partially refundable" id="flexSwitch3">
                                                            <label class="form-check-label" for="flexSwitch3">
                                                                Partially refundable (Cancellations less than 24 hours… 30% cancellation fee.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input cancellation-checkbox" type="checkbox" name="cancellation_policies[]" value="Long-term/Monthly staying policy" id="flexSwitch4">
                                                            <label class="form-check-label" for="flexSwitch4">
                                                                Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Validation error --}}
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
                                                                }, 2000); // hide after 2s
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>


                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="submitted" class="btn btn-primary btn-submit">Next</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="draft" class="btn btn-primary">Save & Drafts</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Hotel Description -->

                                        <!-- Most Popular Facilities -->
                                        <div class="tab-pane" id="tabItem4">
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Most Popular Facilities</strong></h5>

                                                        <div class="checkbox-section">
{{--                                                    <div class="chk-all-sec">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <div class="custom-control custom-switch checked">--}}
{{--                                                                <input type="checkbox" class="custom-control-input" id="facilities-all">--}}
{{--                                                                <label class="custom-control-label" for="facilities-all">Select All</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                    <div class="all-facilities-list">
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="Free Wi-Fi" class="checkbox-item-facility" id="facility-wifi">
                                                            <label for="facility-wifi">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> Free Wi-Fi
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="Hill View Or Sea View" class="checkbox-item-facility" id="facility-view">
                                                            <label for="facility-view">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> Hill View Or Sea View
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="On-site restaurant" class="checkbox-item-facility" id="facility-restaurant">
                                                            <label for="facility-restaurant">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> On-site restaurant
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="Buffet Breakfast" class="checkbox-item-facility" id="facility-breakfast">
                                                            <label for="facility-breakfast">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> Buffet Breakfast
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="Bar/lounge" class="checkbox-item-facility" id="facility-bar">
                                                            <label for="facility-bar">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> Bar/lounge
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="Private Pool" class="checkbox-item-facility" id="facility-pool">
                                                            <label for="facility-pool">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> Private Pool
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="Fitness center & Spa services" class="checkbox-item-facility" id="facility-fitness">
                                                            <label for="facility-fitness">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> Fitness center & Spa services
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="24-hour reception" class="checkbox-item-facility" id="facility-reception">
                                                            <label for="facility-reception">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> 24-hour reception
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="Parking facilities" class="checkbox-item-facility" id="facility-parking">
                                                            <label for="facility-parking">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> Parking facilities
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="facilities[]" value="Airport shuttle service" class="checkbox-item-facility" id="facility-shuttle">
                                                            <label for="facility-shuttle">
                                                                <span><img class="fac-img" src="../images/icons/mountain.png"></span> Airport shuttle service
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="facility-container">
                                                        <!-- Additional inputs will appear here -->
                                                    </div>
                                                    <button class="add-rule-btn btn add-button" id="add-more-btn">Add More +</button>
                                                    @error('facilities') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', () => {
                                                        const uploadedImages = {};

                                                        function initializeMultipleUpload(container) {
                                                            const fileInput = container.querySelector('.multiple-file-input');
                                                            const thumbnailGallery = container.querySelector('.multiple-thumbnail-gallery');
                                                            const containerId = container.id || `dynamic-${Date.now()}`; // Fallback ID for dynamic containers

                                                            uploadedImages[containerId] = [];

                                                            fileInput.addEventListener('change', function(event) {
                                                                console.log(`File input changed in container: ${containerId}`);
                                                                const files = event.target.files;
                                                                for (let file of files) {
                                                                    if (!file.type.startsWith('image/')) {
                                                                        console.warn(`File ${file.name} is not an image`);
                                                                        continue;
                                                                    }
                                                                    const reader = new FileReader();
                                                                    reader.onload = function(e) {
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

                                                        // ADD: facility checkbox selector
                                                        const facilityCheckboxes = document.querySelectorAll('.checkbox-item-facility');
                                                        const maxFacilities = 5;

                                                        addMoreBtn.addEventListener('click', function(event) {
                                                            event.preventDefault();
                                                            console.log('Add More button clicked for custom facilities');

                                                            // ✅ NEW: Count checked + added fields
                                                            const checkedCount = document.querySelectorAll('.checkbox-item-facility:checked').length;
                                                            const addedFieldsCount = facilityContainer.querySelectorAll('.input-field').length;
                                                            const totalFacilities = checkedCount + addedFieldsCount;

                                                            console.log(`Checked: ${checkedCount}, Added: ${addedFieldsCount}, Total: ${totalFacilities}`);

                                                            if (totalFacilities >= maxFacilities) {
                                                                alert(`You can only add/select up to ${maxFacilities} facilities.`);
                                                                return; // ⛔ STOP: Don't add new field
                                                            }

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

                                                        // ✅ OPTIONAL: handle checkbox unchecking if you want live enforcement (optional)
                                                        facilityCheckboxes.forEach(cb => {
                                                            cb.addEventListener('change', function () {
                                                                const checkedCount = document.querySelectorAll('.checkbox-item-facility:checked').length;
                                                                const addedFieldsCount = facilityContainer.querySelectorAll('.input-field').length;
                                                                const totalFacilities = checkedCount + addedFieldsCount;
                                                                console.log(`Checkbox toggled. Total facilities now: ${totalFacilities}`);
                                                                if (totalFacilities > maxFacilities) {
                                                                    alert(`You can only add/select up to ${maxFacilities} facilities.`);
                                                                    cb.checked = false;
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>


                                                    </div>
                                                </div>
                                            </div>

                                            <!-- All Facilities -->
                                            <!-- All Facilities -->

                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Hotel Facilities Categories</strong></h5>

                                                        <div class="row">

                                                    <!-- Dropdown -->
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label for="hotelFacilitySelector">Select Facility</label>
                                                            <select id="hotelFacilitySelector" class="form-control">
                                                                <option value="" disabled selected>Select category</option>
                                                                <option value="General Services">General Services</option>
                                                                <option value="Activities & Entertainment">Activities & Entertainment</option>
                                                                <option value="Safety & Security">Safety & Security</option>
                                                                <option value="Technology, Media & Wi-Fi">Technology, Media & Wi-Fi</option>
                                                                <option value="Bedroom Features">Bedroom Features</option>
                                                                <option value="Bathroom Amenities">Bathroom Amenities</option>
                                                                <option value="Living Room Features">Living Room Features</option>
                                                                <option value="Kitchen Facilities">Kitchen Facilities</option>
                                                                <option value="Food & Beverages">Food & Beverages</option>
                                                                <option value="Parking Availability">Parking Availability</option>
                                                                <option value="View from the Hotel">View from the Hotel</option>
                                                                <option value="Front Desk Services">Front Desk Services</option>
                                                                <option value="Housekeeping & Cleaning">Housekeeping & Cleaning</option>
                                                                <option value="Room Amenities">Room Amenities</option>
                                                                <option value="Business & Meeting Services">Business & Meeting Services</option>
                                                                <option value="Languages Spoken">Languages Spoken</option>
                                                            </select>
                                                        </div>
                                                    </div>



                                                    <!-- Dynamic Field Container -->
                                                    <div class="col-12 mt-4">
                                                        <div class="row" id="dynamicFieldsContainerHotelFacility">
                                                            <!-- Category-specific wrappers will be added here -->
                                                        </div>
                                                    </div>
                                                    <!-- Add More Button -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="submitted" class="btn btn-primary btn-submit">Submit</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="draft" class="btn btn-primary">Save & Drafts</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Nearby Area -->

                                        <div class="tab-pane" id="tabItem1">
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Most Popular Nearby Area</strong></h5>

                                                        <div class="form-group">
                                                        <div id="nearby-areas-wrapper">
                                                            <div class="form-group mb-3 d-flex align-items-center">
                                                                <input type="text" name="custom_nearby_areas[]" class="form-control" placeholder="Enter something">
                                                                <button type="button" class="btn btn-danger btn-sm ms-2 remove-area-btn" style="display: none;">Delete</button>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-primary btn-sm mt-2" id="add-nearby-area">Add More</button>
                                                        @error('custom_nearby_areas') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function () {
                                                            const maxNearbyAreas = 3;
                                                            const addButton = document.getElementById('add-nearby-area');
                                                            const wrapper = document.getElementById('nearby-areas-wrapper');

                                                            function countNearbyFields() {
                                                                return wrapper.querySelectorAll('input[name="custom_nearby_areas[]"]').length;
                                                            }

                                                            addButton.addEventListener('click', function () {
                                                                const currentCount = countNearbyFields();

                                                                if (currentCount >= maxNearbyAreas) {
                                                                    alert(`You can only add up to ${maxNearbyAreas} areas.`);
                                                                    return;
                                                                }

                                                                const group = document.createElement('div');
                                                                group.className = 'form-group mb-3 d-flex align-items-center';

                                                                const input = document.createElement('input');
                                                                input.type = 'text';
                                                                input.name = 'custom_nearby_areas[]';
                                                                input.className = 'form-control';
                                                                input.placeholder = 'Enter something';

                                                                const removeBtn = document.createElement('button');
                                                                removeBtn.type = 'button';
                                                                removeBtn.className = 'btn btn-danger btn-sm ms-2 remove-area-btn';
                                                                removeBtn.textContent = 'Delete';

                                                                removeBtn.addEventListener('click', () => {
                                                                    group.remove();
                                                                });

                                                                group.appendChild(input);
                                                                group.appendChild(removeBtn);
                                                                wrapper.appendChild(group);
                                                            });

                                                            // Attach delete to existing buttons (if any)
                                                            document.querySelectorAll('.remove-area-btn').forEach(btn => {
                                                                btn.addEventListener('click', (e) => {
                                                                    e.target.closest('.form-group').remove();
                                                                });
                                                            });
                                                        });
                                                    </script>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Nearby Area Categories</strong></h5>

                                                        <div class="row">
                                                        <!-- Dropdown -->
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <label for="areaSelector">Select Nearby Area</label>
                                                                <select id="areaSelector" name="area_category" class="form-control">
                                                                    <option value="" disabled selected>Select category</option>
                                                                    <option value="Restaurant & Cafe">Restaurant & Cafe</option>
                                                                    <option value="Entertainment & Attraction Point">Entertainment & Attraction Point</option>
                                                                    <option value="Hospital & Police Station">Hospital & Police Station</option>
                                                                    <option value="Transport & Airport">Transport & Airport</option>
                                                                    <option value="Shopping & ATM">Shopping & ATM</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Add More Button -->
                                                        <div class="col-md-3 mt-4">
                                                            <button class="btn btn-primary" id="addNearbyAreaBtn">Add More +</button>
                                                        </div>

                                                        <!-- Dynamic Field Container -->
                                                        <div class="col-12 mt-4">
                                                            <div class="row" id="dynamicFieldsContainer">
                                                                <!-- Category-specific wrappers will be added here -->
                                                            </div>
                                                        </div>
                                                    </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="submitted" class="btn btn-primary btn-submit">Submit</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="draft" class="btn btn-primary">Save & Drafts</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Photos -->
                                        <div class="tab-pane" id="Photos">
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

                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Photos</strong></h5>

                                                        <div class="row gy-4">
                                                @foreach($photoFields as $index => $field)
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group mt-15">
                                                            <label class="form-label">{{ $labels[$field] }}</label>
                                                            <div class="multiple-upload-container" id="upload-container-{{ $index + 1 }}">
                                                                @if($field === 'featured_photo')
                                                                    <input type="file" class="multiple-file-input" name="{{ $field }}" accept="image/*">
                                                                    <label class="upload-label">Select Single Image</label>
                                                                @else
                                                                    <input type="file" class="multiple-file-input" name="{{ $field }}[]" accept="image/*" multiple>
                                                                    <label class="upload-label">Select Multiple Images</label>
                                                                @endif
                                                                <div class="multiple-thumbnail-gallery"></div>
                                                            </div>
                                                            <input type="hidden" name="removed_{{ $field }}" id="removed_{{ $field }}">
                                                            @error($field . '.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="submitted" class="btn btn-primary btn-submit">Submit</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="draft" class="btn btn-primary">Save & Drafts</button>
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

    <!-- ===== Apartments/Rooms Dynamic Rows (FINAL - CREATE PAGE) ===== -->
    {{-- Removed existing-apartments-json - rooms will be created on room list page --}}

    <script>
        /* ---------------------- (E) Apartments/Rooms dynamic rows - DISABLED ----------------------
           - Dynamic rows are now disabled
           - apartment_count will be saved and used to create blank rooms on the room list page
        --------------------------------------------------------------------------------------- */
        (function () {
            // Disabled - rooms will be created on the room list page instead
            // Just keep the input field functional for saving the count
            const inputEl = document.getElementById('apartment-count');
            if (inputEl) {
                // Ensure the input accepts only positive numbers
                inputEl.addEventListener('input', function() {
                    const val = parseInt(this.value || '0', 10);
                    if (val < 0) {
                        this.value = '0';
                    }
                });
            }
                inputEl.addEventListener('change', onChange);
                inputEl.addEventListener('input', onChange);
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', mount, { once: true });
            } else {
                mount();
            }
        })();
    </script>

    <!-- ================== The rest of your scripts (kept, deduped) ================== -->

    <script type="text/javascript">
        /* ---------------------- (A) Legacy "propertyCategory" script harden ---------------------- */
        (() => {
            const cat = document.getElementById('propertyCategory');
            if (!cat) return;

            cat.addEventListener('change', function () {
                const propertyTypeContainer = document.getElementById('propertyTypeContainer');
                const propertyType = document.getElementById('propertyType');
                if (!propertyTypeContainer || !propertyType) return;

                propertyType.innerHTML = ''; // Clear previous options

                const options = {
                    'Hotel': [
                        { id: 'option1', value: 'Only Apartment', label: 'Only Apartment' },
                        { id: 'option2', value: 'Only room', label: 'Only room' },
                        { id: 'option3', value: 'Only Bed', label: 'Only Bed' }
                    ],
                    'House': [{ id: 'option4', value: 'Kitchen', label: 'Kitchen' }],
                    'Resort': [{ id: 'option6', value: 'Room', label: 'Room' }],
                    'Apartment': [
                        { id: 'option7', value: 'Apartment', label: 'Apartment' },
                        { id: 'option8', value: 'Only room', label: 'Only room' },
                        { id: 'option9', value: 'Only Bed', label: 'Only Bed' }
                    ]
                };

                const selectedValue = this.value;
                if (options[selectedValue]) {
                    options[selectedValue].forEach(function (option) {
                        const li = document.createElement('li');
                        li.innerHTML = `
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="${option.id}" value="${option.value}">
                    <label class="form-check-label" for="${option.id}">${option.label}</label>
                  </div>`;
                        propertyType.appendChild(li);
                    });
                    propertyTypeContainer.style.display = 'block';
                } else {
                    propertyTypeContainer.style.display = 'none';
                }
            });
        })();
    </script>

    <script type="text/javascript">
        /* ---------------------- (B) Select/Deselect all (site-off) ---------------------- */
        document.getElementById("site-off")?.addEventListener("change", function () {
            const isChecked = this.checked;
            document.querySelectorAll(".checkbox-item")?.forEach(cb => { cb.checked = isChecked; });
        });
    </script>

    <script type="text/javascript">
        /* ---------------------- (C) Property ownership toggle ---------------------- */
        document.addEventListener("DOMContentLoaded", () => {
            const checkbox = document.getElementById("property-ownership");
            const options = document.getElementById("ownership-options");
            if (!checkbox || !options) return;

            checkbox.addEventListener("change", () => {
                options.classList.toggle("hidden", !checkbox.checked);
            });
        });
    </script>

    <script>
        /* ---------------------- (D) Hover label helpers ---------------------- */
        function showLabel(text) {
            const labelDiv = document.getElementById('labelText');
            if (!labelDiv) return;
            labelDiv.textContent = text;
            labelDiv.style.display = 'block';
        }
        function hideLabel() {
            const labelDiv = document.getElementById('labelText');
            if (!labelDiv) return;
            labelDiv.style.display = 'none';
        }
    </script>

    <script>
        /* ---------------------- (F) Form submit log (safe) ---------------------- */
        document.querySelector('form')?.addEventListener('submit', function () {
            try {
                const fd = new FormData(this);
                // for (const [k, v] of fd.entries()) console.log(k, v);
            } catch {}
        });
    </script>

    <script>
        /* ---------------------- (G) Radio show/hide extra fields ---------------------- */
        (() => {
            const radios = document.querySelectorAll('input[name="showFields"]');
            const additionalFields = document.getElementById('additionalFields');
            if (!radios.length || !additionalFields) return;

            radios.forEach(radio => {
                radio.addEventListener('change', function () {
                    additionalFields.style.display = this.value === 'yes' ? 'block' : 'none';
                });
            });
        })();
    </script>

    <script>
        /* ---------------------- (H) jQuery select2 + ownership extra fields ---------------------- */
        $(document).ready(function () {
            $('.js-select2').select2?.();

            $('#propertyOwnershipss')?.on('change', function () {
                const v = $(this).val();
                const partnerFields = $('.partner-fields');
                const leaseDates = $('.lease-dates');

                partnerFields.slideUp();
                leaseDates.slideUp();

                if (v === 'Partnership') partnerFields.slideDown();
                else if (v === 'Leased') leaseDates.slideDown();
            });
        });
    </script>

    <script>
        /* ---------------------- (I) Bar selection (yes/no) ---------------------- */
        function initializeBarSelection() {
            const radios = document.querySelectorAll('input[name="barOption"]');
            const barSelectContainer = document.getElementById('barSelectContainer');
            const barNumberSelect = document.getElementById('barNumberSelect');
            if (!radios.length || !barSelectContainer || !barNumberSelect) return;

            radios.forEach(r => {
                r.addEventListener('change', function () {
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
        /* ---------------------- (J) KidsZone Manager ---------------------- */
        class KidsZoneManager {
            constructor() { this.initializeAllKidsZones(); }
            initializeAllKidsZones() {
                document.querySelectorAll('[data-kids-zone]')?.forEach(sec => this.initializeSingleKidsZone(sec));
            }
            initializeSingleKidsZone(section) {
                const radios = section.querySelectorAll('input[type="radio"]');
                const selectContainer = section.querySelector('.select-container');
                const numberSelect = section.querySelector('.number-select');
                if (!radios.length || !selectContainer || !numberSelect) return;

                radios.forEach(radio => {
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
                document.querySelectorAll('[data-kids-zone]')?.forEach(section => {
                    const id = section.getAttribute('data-kids-zone');
                    const selectedRadio = section.querySelector('input[type="radio"]:checked');
                    const numberSelect = section.querySelector('.number-select');
                    selections[`kidsZone${id}`] = {
                        hasKidsZone: selectedRadio ? selectedRadio.value : null,
                        numberOfKids: selectedRadio?.value === 'yes' ? numberSelect?.value : null
                    };
                });
                return selections;
            }
            addNewKidsZone(containerId, zoneNumber) {
                const container = document.getElementById(containerId);
                if (!container) return;
                const html = `
      <div class="col-md-6 col-lg-4 col-xxl-3">
        <div class="form-group">
          <label class="form-label">Kids Zone ${zoneNumber}</label>
          <div class="radio-group" data-kids-zone="${zoneNumber}">
            <div><label><input type="radio" name="kidsZone${zoneNumber}" value="yes" class="radio-yes"> Yes</label></div>
            <div><label><input type="radio" name="kidsZone${zoneNumber}" value="no" class="radio-no"> No</label></div>
            <div class="select-container" style="display: none;">
              <label>Select number of kids:</label>
              <select class="form-select number-select">
                <option value="">Select number</option>
                <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                <option value="4">4</option><option value="5">5</option>
              </select>
            </div>
          </div>
        </div>
      </div>`;
                container.insertAdjacentHTML('beforeend', html);
                this.initializeSingleKidsZone(container.lastElementChild.querySelector('[data-kids-zone]'));
            }
        }
        const kidsZoneManager = new KidsZoneManager();
    </script>

    <script>
        /* ---------------------- (K) Yes/No fields toggle ---------------------- */
        document.addEventListener("DOMContentLoaded", function () {
            const yesOption = document.getElementById("yesOption");
            const noOption = document.getElementById("noOption");
            const yesFields = document.getElementById("yesFields");
            const noFields = document.getElementById("noFields");
            if (!yesOption || !noOption || !yesFields || !noFields) return;

            yesOption.addEventListener("change", function () {
                if (this.checked) { yesFields.classList.remove("hidden"); noFields.classList.add("hidden"); }
            });
            noOption.addEventListener("change", function () {
                if (this.checked) { noFields.classList.remove("hidden"); yesFields.classList.add("hidden"); }
            });
        });
    </script>

    <script type="text/javascript">
        /* ---------------------- (L) Category → Type → Room (works with your HTML) ---------------------- */
        document.addEventListener("DOMContentLoaded", function () {
            const divisionSelect = document.getElementById("division");

            const districtLabel   = document.getElementById("districtContainer");
            const districtGroup   = districtLabel ? districtLabel.closest('.form-group') : null;
            const districtSelect  = districtGroup ? districtGroup.querySelector('select[name="property_type"]') : null;

            const placeCheckboxList = document.getElementById("placeCheckboxList");
            const placeOptions      = document.getElementById("placeOptions");

            if (!divisionSelect || !districtGroup || !districtSelect || !placeCheckboxList || !placeOptions) return;

            districtGroup.parentElement?.parentElement?.style?.setProperty('display','');
            districtGroup.style.display = "none";
            placeCheckboxList.style.display = "none";

            const data = {
                Hotels: { districts: {
                        "Hotel": ["Single Room","Double Room","Twin Room","Suite","Family Room","Penthouse Suite","Accessible Room"],
                        "Luxury Hotels": ["Single Room","Double Room","Twin Room","Suite","Family Room","Penthouse Suite","Accessible Room"],
                        "Budget Hotels": ["Single Room","Double Room","Family Room","Accessible Room"]
                    }},
                Transit: { districts: {
                        "Airport Hotels": ["Single Room","Double Room","Family Unit","Parking-Accessible Room"],
                        "Station Hotels": ["Single Room","Double Room","Family Unit","Parking-Accessible Room"],
                        "Hospital & Visa Center Area Hotels": ["Single Room","Double Room","Family Unit","Parking-Accessible Room"]
                    }},
                Resorts: { districts: {
                        "Resorts": ["Luxury Resort Suites","Private Pool Villas","Garden View Rooms","Standard Camping Tent","Luxury Tent (Glamping)","Treehouses"],
                        "Eco Resorts": ["Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays"],
                        "Beach Resorts": ["Overwater Bungalows","Beach Huts","Oceanfront Villas"],
                        "Mountain Resorts": ["Cabins","Lodges","View Suites"]
                    }},
                Lodges: { districts: {
                        "Hostels": ["Single Bed in Dormitory","Private Room/Apartment","Female-Only Dormitory","Male-Only Dormitory","Mixed Dormitory","Studio Apartment-Style Hostel"],
                        "Motels": ["Single Room","Double Room","Family Room"],
                        "Lodges": ["Private Room","Shared Room"]
                    }},
                Apartments: { districts: {
                        "Apartments": ["Studio","One-Bedroom","Two-Bedroom","Three-Bedroom","Penthouse"],
                        "Serviced Apartments": ["Luxury Serviced","Budget Serviced","Furnished","Unfurnished"],
                        "Homestays": ["Entire Place","Private Room","Shared Room"]
                    }},
                Guesthouses: { districts: {
                        "Guesthouses": ["Bed Only","Room with Shared Bathroom","Private Room","Entire House"],
                        "Vacation Rentals": ["Entire Place","Private Room","Tent/Glamping","RV/Caravan"],
                        "Condominiums": ["Studio","1BR","2BR","3BR"],
                        "B&B": ["Private Room","Family Room"]
                    }},
                Crisis: { districts: {
                        "Old Age Homes": ["Single Bed","Shared Room"],
                        "Orphanages": ["Dormitory","Private Room"],
                        "Rehabilitation Centers": ["Standard Room","Supervised Room"],
                        "Asylums": ["Ward","Private Room"]
                    }}
            };

            function resetTypes() {
                districtSelect.innerHTML = '<option value="" disabled selected>Choose Property Type</option>';
                placeOptions.innerHTML = "";
                placeCheckboxList.style.display = "none";
            }

            function populateDistricts(category) {
                resetTypes();
                if (data[category]) {
                    districtGroup.style.display = "block";
                    Object.keys(data[category].districts).forEach(type => {
                        const opt = document.createElement("option");
                        opt.value = type;
                        opt.textContent = type;
                        districtSelect.appendChild(opt);
                    });
                } else {
                    districtGroup.style.display = "none";
                }
            }

            function populateRoomTypes(category, type) {
                placeOptions.innerHTML = "";
                const list = data[category]?.districts?.[type] || null;
                if (!list) {
                    placeCheckboxList.style.display = "none";
                    return;
                }
                placeCheckboxList.style.display = "block";
                list.forEach((label, idx) => {
                    const id = `room_type_${idx}`;
                    const li = document.createElement("li");
                    li.innerHTML = `
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="${id}" name="room_types[]" value="${label}">
                  <label class="form-check-label" for="${id}">${label}</label>
                </div>`;
                    placeOptions.appendChild(li);
                });
            }

            divisionSelect.addEventListener("change", function () {
                populateDistricts(this.value);
            });

            districtSelect.addEventListener("change", function () {
                if (!divisionSelect.value) return;
                populateRoomTypes(divisionSelect.value, this.value);
            });
        });
    </script>

    <script type="text/javascript">
        /* ---------------------- (M) Facilities select-all ---------------------- */
        document.addEventListener("DOMContentLoaded", function () {
            const master = document.querySelector("#facilities-all");
            if (!master) return;
            master.addEventListener("change", function () {
                document.querySelectorAll(".checkbox-item-facility")?.forEach(cb => { cb.checked = master.checked; });
            });
        });
    </script>

    <script type="text/javascript">
        /* ---------------------- (N) Check-in select-all ---------------------- */
        document.getElementById("check-in-all")?.addEventListener("change", function () {
            const isChecked = this.checked;
            document.querySelectorAll(".checkbox-item-checkin")?.forEach(cb => { cb.checked = isChecked; });
        });
    </script>

    <script>
        /* ---------------------- (O) Add/Delete custom check-in methods ---------------------- */
        document.getElementById('addRuleBtn')?.addEventListener('click', function (event) {
            event.preventDefault();
            const formContainer = document.getElementById('formContainer');
            if (!formContainer) return;

            const newField = document.createElement('div');
            newField.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3');
            newField.innerHTML = `
    <div class="form-group">
      <input type="text" class="form-control" name="custom_check_in_methods[]" placeholder="" required>
      <button type="button" class="delete-btn btn btn-danger btn-sm mt-2">Delete</button>
    </div>`;
            formContainer.appendChild(newField);

            newField.querySelector('.delete-btn')?.addEventListener('click', function () {
                formContainer.removeChild(newField);
            });
        });
    </script>

    <script type="text/javascript">
        /* ---------------------- (P) Radio-group data-target show/hide ---------------------- */
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".radio-group input[type='radio']")?.forEach(function (radio) {
                radio.addEventListener("change", function () {
                    const targetId = this.getAttribute("data-target");
                    if (!targetId) return;
                    const targetInput = document.getElementById(targetId);
                    if (!targetInput) return;
                    if (this.value === "yes") targetInput.classList.remove("hidden");
                    else targetInput.classList.add("hidden");
                });
            });
        });
    </script>

    <script type="text/javascript">
        /* ---------------------- (Q) Property select-all ---------------------- */
        document.querySelector("#property-all")?.addEventListener("change", function () {
            const isChecked = this.checked;
            document.querySelectorAll(".checkbox-item-property")?.forEach(cb => { cb.checked = isChecked; });
        });
    </script>

    <script>
        /* ---------------------- (R) Add-more generic fields ---------------------- */
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".add-more")?.forEach((button) => {
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
                    deleteButton.type = "button";
                    deleteButton.innerText = "Delete";
                    deleteButton.classList.add("delete-btn", "btn", "btn-danger", "btn-sm");
                    deleteButton.addEventListener("click", function () {
                        newFormGroup.remove();
                    });

                    newFormGroup.appendChild(inputField);
                    newFormGroup.appendChild(deleteButton);
                    (inputContainer?.parentNode || this.parentNode).insertBefore(newFormGroup, this);
                });
            });
        });
    </script>

    <script>
        /* ---------------------- (S) Hotel Facilities dynamic groups (safe) ---------------------- */
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

        (() => {
            const hotelFacilitySelector = document.getElementById('hotelFacilitySelector');
            const hotelFormContainer = document.getElementById('dynamicFieldsContainerHotelFacility');
            if (!hotelFormContainer) return;

            let currentFacilityValue = '';

            function ensureAddButton(categoryKey, category) {
                const categoryWrapper = document.getElementById(`wrapper-${categoryKey}`);
                if (!categoryWrapper) return null;
                const row = categoryWrapper.querySelector('.row');
                if (!row) return null;

                let addBtnCol = document.getElementById(`add-btn-${categoryKey}`);
                if (addBtnCol) return addBtnCol;

                addBtnCol = document.createElement('div');
                addBtnCol.className = 'col-md-3 mt-4';
                addBtnCol.id = `add-btn-${categoryKey}`;
                addBtnCol.innerHTML = `
      <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" id="addHotelFacility-${categoryKey}">Add More +</button>
      </div>`;
                row.appendChild(addBtnCol);

                row.querySelector(`#addHotelFacility-${categoryKey}`)?.addEventListener('click', (e) => {
                    e.preventDefault();
                    createHotelFieldGroup(category);
                });
                return addBtnCol;
            }

            function createHotelFieldGroup(category) {
                const labels = hotelFacilitiesLabelsMap[category];
                if (!labels) return;

                const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
                const uniqueId = `hotel-facility-${categoryKey}-${Date.now()}`;

                let categoryWrapper = document.getElementById(`wrapper-${categoryKey}`);
                if (!categoryWrapper) {
                    categoryWrapper = document.createElement('div');
                    categoryWrapper.classList.add('col-12', 'mb-3');
                    categoryWrapper.id = `wrapper-${categoryKey}`;
                    categoryWrapper.innerHTML = `<h5>${category}</h5><div class="row"></div>`;
                    hotelFormContainer.appendChild(categoryWrapper);
                }
                const row = categoryWrapper.querySelector('.row');

                const addBtnCol = ensureAddButton(categoryKey, category);

                const newFieldGroup = document.createElement('div');
                newFieldGroup.classList.add('hotel-field-group', 'col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
                newFieldGroup.id = uniqueId;
                newFieldGroup.innerHTML = `
      <div class="form-group">
        <label for="input-${uniqueId}">${labels[0]}</label>
        <input type="text" class="form-control" id="input-${uniqueId}" name="hotel_facilities[${categoryKey}][]" placeholder="Enter ${labels[0]}" required>
      </div>
      <button type="button" class="btn btn-danger btn-sm mt-2 delete-hotel-btn">Delete</button>`;

                if (addBtnCol) row.insertBefore(newFieldGroup, addBtnCol);
                else row.appendChild(newFieldGroup);

                newFieldGroup.querySelector('.delete-hotel-btn')?.addEventListener('click', function () {
                    row.removeChild(newFieldGroup);
                    const remaining = row.querySelectorAll('.hotel-field-group').length;
                    if (remaining === 0) categoryWrapper.remove();
                });
            }

            hotelFacilitySelector?.addEventListener('change', function () {
                currentFacilityValue = this.value;
                if (!hotelFacilitiesLabelsMap[currentFacilityValue]) return;
                createHotelFieldGroup(currentFacilityValue);
            });

            const addHotelFacilityBtn = document.getElementById('addHotelFacility');
            addHotelFacilityBtn?.addEventListener('click', function (event) {
                event.preventDefault();
                if (!currentFacilityValue || !hotelFacilitiesLabelsMap[currentFacilityValue]) {
                    alert("Please select a valid facility category first.");
                    return;
                }
                createHotelFieldGroup(currentFacilityValue);
            });
        })();
    </script>

    <script>
        /* ---------------------- (T) Nearby Areas dynamic groups ---------------------- */
        (() => {
            const sectionLabelsMap = {
                'Restaurant & Cafe': ['Restaurant & Cafe Name', 'Distance'],
                'Entertainment & Attraction Point': ['Entertainment & Attraction Point', 'Distance'],
                'Hospital & Police Station': ['Hospital & Police Station Name', 'Distance'],
                'Transport & Airport': ['Transport & Airport Name', 'Distance'],
                'Shopping & ATM': ['Shopping & ATM', 'Distance']
            };

            const areaSelector = document.getElementById('areaSelector');
            const formContainer = document.getElementById('dynamicFieldsContainer');
            if (!formContainer) return;

            let currentSelectedValue = '';

            function createFieldGroup(category, nameValue = '', distanceValue = '') {
                const labels = sectionLabelsMap[category];
                if (!labels) return;

                const uniqueId = `nearby-area-${category.replace(/[^a-zA-Z0-9]/g, '')}-${Date.now()}`;
                const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();

                const newFieldGroup = document.createElement('div');
                newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
                newFieldGroup.id = uniqueId;
                newFieldGroup.innerHTML = `
      <div class="form-group">
        <label for="input-name-${uniqueId}">${labels[0]}</label>
        <input type="text" class="form-control" id="input-name-${uniqueId}" name="nearby_areas[${categoryKey}][name][]" placeholder="Enter ${labels[0]}" value="${nameValue}" required>
      </div>
      <div class="form-group">
        <label for="input-distance-${uniqueId}">${labels[1]}</label>
        <input type="text" class="form-control" id="input-distance-${uniqueId}" name="nearby_areas[${categoryKey}][distance][]" placeholder="Enter ${labels[1]}" value="${distanceValue}" required>
      </div>
      <button type="button" class="btn btn-danger btn-sm mt-3 delete-nearby-btn">Delete</button>`;

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

                newFieldGroup.querySelector('.delete-nearby-btn')?.addEventListener('click', function () {
                    row.removeChild(newFieldGroup);
                    if (!row.children.length) categoryWrapper.remove();
                });
            }

            areaSelector?.addEventListener('change', function () {
                currentSelectedValue = this.value;
                if (!sectionLabelsMap[currentSelectedValue]) return;
                createFieldGroup(currentSelectedValue);
            });

            const addNearbyAreaBtn = document.getElementById('addNearbyAreaBtn');
            addNearbyAreaBtn?.addEventListener('click', function (event) {
                event.preventDefault();
                if (!currentSelectedValue || !sectionLabelsMap[currentSelectedValue]) {
                    alert("Please select a valid nearby area category first.");
                    return;
                }
                createFieldGroup(currentSelectedValue);
            });
        })();
    </script>

    <script>
        /* ---------------------- (U) Custom check-in rules (another section) ---------------------- */
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('custom-checkin-wrapper');
            const addBtn  = document.getElementById('add-checkin-rule');
            if (!wrapper || !addBtn) return;

            addBtn.addEventListener('click', function (e) {
                e.preventDefault();
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

            // Attach to any pre-existing delete buttons
            wrapper.querySelectorAll('.remove-checkin')?.forEach(btn => {
                btn.addEventListener('click', function () {
                    this.closest('.form-group')?.remove();
                });
            });
        });
    </script>



@endsection
