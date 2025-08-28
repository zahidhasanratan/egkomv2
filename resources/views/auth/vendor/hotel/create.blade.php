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
                                            <div class="row gy-4">
                                                <div class="col-md-12 col-lg-12 col-xxl-3">

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label for="property_type" class="form-label">Property Type</label>
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
                                                    <div class="col-md-12 col-lg-12 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-textarea">Hotel /
                                                                Property Name</label>
                                                            <div class="form-control-wrap">
                                                                <input class="form-control no-resize"
                                                                       name="description" ></input>
                                                                @error('description') <span
                                                                    class="text-danger"></span> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-textarea">Hotel/Property Description & Policy</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control no-resize" id="default-textarea1" name="details"></textarea>
                                                            @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Property Policy And Rules -->
                                            <div class="row gy-4">
                                                <div class="col-md-12 col-lg-12 col-xxl-3">
                                                    <h3 class="can-tittle" style="padding-top: 50px;">Property Policy and Rules</h3>
                                                </div>

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
                                                        <label class="form-label" for="first-name">Check-in window start and end time</label>
                                                        <select class="form-select mb-3" name="check_in_window" aria-label="Large select example">
                                                            <option selected value="">Select Check-in Time</option>
                                                            <option value="00:00-02:00">12:00 AM (Midnight) - 2:00 AM</option>
                                                            <option value="02:00-04:00">2:00 AM - 4:00 AM</option>
                                                            <option value="04:00-06:00">4:00 AM - 6:00 AM</option>
                                                            <option value="06:00-08:00">6:00 AM - 8:00 AM</option>
                                                            <option value="08:00-10:00">8:00 AM - 10:00 AM</option>
                                                            <option value="10:00-12:00">10:00 AM - 12:00 PM (Noon)</option>
                                                            <option value="12:00-14:00">12:00 PM (Noon) - 2:00 PM</option>
                                                            <option value="14:00-16:00">2:00 PM - 4:00 PM</option>
                                                            <option value="16:00-18:00">4:00 PM - 6:00 PM</option>
                                                            <option value="18:00-20:00">6:00 PM - 8:00 PM</option>
                                                            <option value="20:00-22:00">8:00 PM - 10:00 PM</option>
                                                            <option value="22:00-00:00">10:00 PM - 12:00 AM (Midnight)</option>
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

                                            <!-- Start: Property Information -->
                                            <div class="row mt-15">

                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Property Info</h3>

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
                                            <div class="row mt-15">

                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Most Popular Facilities</h3>
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

                                            <!-- All Facilities -->
                                            <!-- All Facilities -->

                                            <div class="container mt-15">
                                                <div class="row">
                                                    <h3 class="can-tittle">Hotel Facilities Categories</h3>

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
                                            <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group">
                                                        <h3 class="can-tittle">Most Popular Nearby Area</h3>
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


                                                <div class="container mt-4">

                                                    <div class="row">
                                                        <h3 class="can-tittle">Nearby Area Categories</h3>
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
                                                $photoFields = [
                                                    'featured_photo','kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
                                                    'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos',
                                                    'rooftop_photos', 'gym_photos', 'security_photos', 'amenities_photos'
                                                ];
                                                $labels = [
                                                    'featured_photo' => 'Featured Photo Photo',
                                                    'kitchen_photos' => 'Kitchen Photo',
                                                    'washroom_photos' => 'Washroom Photo',
                                                    'parking_lot_photos' => 'Parking Lot Photos',
                                                    'entrance_gate_photos' => 'Entrance Gate/Main Gate Photos',
                                                    'lift_stairs_photos' => 'Lift, Stairs, Wheelchair Area Photos',
                                                    'spa_photos' => 'Spa and Massage Center Photos',
                                                    'bar_photos' => 'Bar Photos',
                                                    'transport_photos' => 'Hotel Car and Bus Photos',
                                                    'rooftop_photos' => 'Rooftop, Garden, Sitting Area Photos',
                                                    'gym_photos' => 'Gym, Game Room, and Kids Zone Photos',
                                                    'security_photos' => 'CCTV, Fire Extinguisher, and Surveillance Photos',
                                                    'amenities_photos' => 'Hotel/Property Amenities Photos'
                                                ];
                                            @endphp

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


    <script type="text/javascript">
        document.getElementById("site-off")?.addEventListener("change", function() {
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
        document.getElementById('apartment-count')?.addEventListener('change', function() {
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
        document.querySelector('form').addEventListener('submit', function(event) {
            console.log('Form is submitting with data:', new FormData(this));
        });
    </script>

    <script>
        const radioButtons = document.querySelectorAll('input[name="showFields"]');
        const additionalFields = document.getElementById('additionalFields');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'yes') {
                    additionalFields.style.display = 'block';
                } else {
                    additionalFields.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.js-select2').select2();

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
                        "hotel": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room" ],
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

        const hotelFacilitySelector = document.getElementById('hotelFacilitySelector');
        const hotelFormContainer = document.getElementById('dynamicFieldsContainerHotelFacility');
        let currentFacilityValue = '';

        function ensureAddButton(categoryKey, category) {
            const categoryWrapper = document.getElementById(`wrapper-${categoryKey}`);
            const row = categoryWrapper.querySelector('.row');

            // If button already exists, return it
            let addBtnCol = document.getElementById(`add-btn-${categoryKey}`);
            if (addBtnCol) return addBtnCol;

            // Create the single "Add More +" button for this category
            addBtnCol = document.createElement('div');
            addBtnCol.className = 'col-md-3 mt-4';
            addBtnCol.id = `add-btn-${categoryKey}`;
            addBtnCol.innerHTML = `
      <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" id="addHotelFacility-${categoryKey}">Add More +</button>
      </div>
    `;

            row.appendChild(addBtnCol);

            // Wire the click to add another field to THIS category
            row.querySelector(`#addHotelFacility-${categoryKey}`).addEventListener('click', (e) => {
                e.preventDefault();
                createHotelFieldGroup(category);
            });

            return addBtnCol;
        }

        function createHotelFieldGroup(category) {
            const labels = hotelFacilitiesLabelsMap[category];
            const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
            const uniqueId = `hotel-facility-${categoryKey}-${Date.now()}`;

            // Create wrapper if needed
            let categoryWrapper = document.getElementById(`wrapper-${categoryKey}`);
            if (!categoryWrapper) {
                categoryWrapper = document.createElement('div');
                categoryWrapper.classList.add('col-12', 'mb-3');
                categoryWrapper.id = `wrapper-${categoryKey}`;
                categoryWrapper.innerHTML = `<h5>${category}</h5><div class="row"></div>`;
                hotelFormContainer.appendChild(categoryWrapper);
            }

            const row = categoryWrapper.querySelector('.row');

            // Make or get the single Add button column for this category
            const addBtnCol = ensureAddButton(categoryKey, category);

            // Build one field group
            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('hotel-field-group', 'col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.id = uniqueId;
            newFieldGroup.innerHTML = `
      <div class="form-group">
        <label for="input-${uniqueId}">${labels[0]}</label>
        <input type="text" class="form-control" id="input-${uniqueId}" name="hotel_facilities[${categoryKey}][]" placeholder="Enter ${labels[0]}" required>
      </div>
      <button type="button" class="btn btn-danger btn-sm mt-2 delete-hotel-btn">Delete</button>
    `;

            // Insert the new field BEFORE the add button so the button stays last
            row.insertBefore(newFieldGroup, addBtnCol);

            // Delete handler
            newFieldGroup.querySelector('.delete-hotel-btn').addEventListener('click', function () {
                row.removeChild(newFieldGroup);

                // If no more field groups remain for this category, remove the whole wrapper
                const remainingFields = row.querySelectorAll('.hotel-field-group').length;
                if (remainingFields === 0) {
                    categoryWrapper.remove();
                }
            });
        }

        // When a category is selected from the dropdown, remember it and add the first field
        if (hotelFacilitySelector) {
            hotelFacilitySelector.addEventListener('change', function () {
                currentFacilityValue = this.value;
                if (!hotelFacilitiesLabelsMap[currentFacilityValue]) return;
                createHotelFieldGroup(currentFacilityValue);
            });
        }

        // (Optional) If you still keep a single global button outside, wire it to the current category
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

        function createFieldGroup(category) {
            const labels = sectionLabelsMap[category];
            const uniqueId = `nearby-area-${category.replace(/[^a-zA-Z0-9]/g, '')}-${Date.now()}`;
            const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();

            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.setAttribute('id', uniqueId);
            newFieldGroup.innerHTML = `
        <div class="form-group">
            <label for="input-name-${uniqueId}">${labels[0]}</label>
            <input type="text" class="form-control" id="input-name-${uniqueId}" name="nearby_areas[${categoryKey}][name][]" placeholder="Enter ${labels[0]}" required>
        </div>
        <div class="form-group">
            <label for="input-distance-${uniqueId}">${labels[1]}</label>
            <input type="text" class="form-control" id="input-distance-${uniqueId}" name="nearby_areas[${categoryKey}][distance][]" placeholder="Enter ${labels[1]}" required>
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

            // Add event listener to delete button after adding the field
            newFieldGroup.querySelector('.delete-nearby-btn').addEventListener('click', function () {
                row.removeChild(newFieldGroup);
                if (row.children.length === 0) {
                    formContainer.removeChild(categoryWrapper);
                }
            });
        }

        // Ensure areaSelector exists before adding event listener
        if (areaSelector) {
            areaSelector.addEventListener('change', function () {
                currentSelectedValue = this.value;
                if (!sectionLabelsMap[currentSelectedValue]) return;
                createFieldGroup(currentSelectedValue);
            });
        }

        // Ensure addNearbyAreaBtn exists before adding event listener
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

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('custom-checkin-wrapper');
            const addBtn = document.getElementById('add-checkin-rule');

            addBtn.addEventListener('click', function () {
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

            // Attach delete buttons to existing (if any)
            document.querySelectorAll('.remove-checkin').forEach(btn => {
                btn.addEventListener('click', function () {
                    this.closest('.form-group').remove();
                });
            });
        });
    </script>



@endsection
