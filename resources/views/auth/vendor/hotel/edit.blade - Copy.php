@extends('auth.layout.vendor_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Manage Hotel / Property</h3>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem3">Hotel / Property Description</a>
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

                                <form method="POST" action="#" enctype="multipart/form-data">
{{--                                <form method="POST" action="{{ route('vendor-admin.hotel.update') }}" enctype="multipart/form-data">--}}

                                    @csrf
                                    <div class="tab-content">
                                        <!-- Hotel Description -->
                                        <div class="tab-pane active" id="tabItem3">
                                            <div class="row gy-4">
                                                <div class="col-md-12 col-lg-12 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-textarea">Hotel / Property Description</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control no-resize" id="default-textarea" name="description">{{ $hotel->description }}</textarea>
                                                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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
                                                            <textarea class="form-control" name="pets_details" placeholder="" style="height: 50px;"></textarea>
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
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="checkbox" name="check_in_rules[]" value="Pay in advance" class="bar-radio-yes"> Pay in advance
                                                            </label>
                                                            <label>
                                                                <input type="checkbox" name="check_in_rules[]" value="Security money for keys" class="bar-radio-no"> Security money for keys
                                                            </label>
                                                            <label>
                                                                <input type="checkbox" name="check_in_rules[]" value="Rentals" class="bar-radio-no"> Rentals
                                                            </label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="section">
                                                                    <div class="input-container" style="display: none;">
                                                                        <div class="form-group mb-3 d-flex align-items-center">
                                                                            <input type="text" class="form-control" name="custom_check_in_rules[]" placeholder="Enter something">
                                                                            <button class="btn btn-danger btn-sm">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                    <button class="add-more add-rule-btn btn add-button">Add More</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('check_in_rules') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Start: Property Information -->
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Property Info</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input select-all" name="property_all" id="property-all" data-target="checkbox-item-property">
                                                                <label class="custom-control-label" for="property-all">Select All Property Info</label>
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
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="section">
                                                                <div class="input-container" style="display: none;">
                                                                    <div class="form-group mb-3 d-flex align-items-center">
                                                                        <input type="text" class="form-control" name="custom_property_info[]" placeholder="Enter something">
                                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                                    </div>
                                                                </div>
                                                                <button class="add-more add-rule-btn btn add-button">Add More</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('property_info') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
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
                                                                    <textarea class="form-control no-resize" name="child_policy"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-textarea">Extra Bed Policy</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" name="extra_bed_policy"></textarea>
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
                                                                    <textarea class="form-control no-resize" name="directions"></textarea>
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
                                                            <input class="form-check-input" type="checkbox" name="cancellation_policies[]" value="Flexible" id="flexSwitchCheckChecked">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input" type="checkbox" name="cancellation_policies[]" value="Non-refundable" id="flexSwitchCheckChecked">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Non-refundable (Regardless of the cancelation window, customers will not get any refund under this.)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input" type="checkbox" name="cancellation_policies[]" value="Partially refundable" id="flexSwitchCheckChecked">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Partially refundable (Cancelations that take place in less than 24 hours and Rooms that are labeled with this badge after deducting a 30% Cancellation fee rest of the amount will be refunded.)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch custom-switch">
                                                            <input class="form-check-input" type="checkbox" name="cancellation_policies[]" value="Long-term/Monthly staying policy" id="flexSwitchCheckChecked">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed. T&C paper will be found in the system.)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('cancellation_policies') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

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
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input" id="facilities-all">
                                                                <label class="custom-control-label" for="facilities-all">Select All</label>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                            </div>

                                            <!-- All Facilities -->
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Hotel Facilities Categories</h3>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="facilityDropdown">Select Facility</label>
                                                            <select id="facilityDropdown" class="form-control js-facility-select js-select2" name="facility_category">
                                                                <option value="general">General Services</option>
                                                                <option value="activities">Activities & Entertainment</option>
                                                                <option value="safety">Safety & Security</option>
                                                                <option value="technology">Technology, Media & Wi-Fi</option>
                                                                <option value="bedroom">Bedroom Features</option>
                                                                <option value="bathroom">Bathroom Amenities</option>
                                                                <option value="living">Living Room Features</option>
                                                                <option value="kitchen">Kitchen Facilities</option>
                                                                <option value="food">Food & Beverages</option>
                                                                <option value="parking">Parking Availability</option>
                                                                <option value="view">View from the Hotel</option>
                                                                <option value="frontdesk">Front Desk Services</option>
                                                                <option value="housekeeping">Housekeeping & Cleaning</option>
                                                                <option value="room">Room Amenities</option>
                                                                <option value="business">Business & Meeting Services</option>
                                                                <option value="languages">Languages Spoken</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mt-3">
                                                            <button class="add-rule-btn btn add-button" id="addFacilityButton">Add More +</button>
                                                        </div>
                                                        <div class="row mt-3" id="dynamicFormContainer">
                                                            <!-- Dynamically added fields will appear here -->
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
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <h3 class="can-tittle">Most Popular Nearby Area</h3>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="checkbox" name="nearby_areas[]" value="16.5 km from Himchori Waterfall" class="bar-radio-yes"> 16.5 km from Himchori Waterfall
                                                            </label>
                                                            <label>
                                                                <input type="checkbox" name="nearby_areas[]" value="0.25 km from Navy Jetty, from where Saint Martin bound ship sails" class="bar-radio-no"> 0.25 km from Navy Jetty, from where Saint Martin bound ship sails
                                                            </label>
                                                            <label>
                                                                <input type="checkbox" name="nearby_areas[]" value="3.2 km from Cox's Bazar Airport" class="bar-radio-no"> 3.2 km from Cox's Bazar Airport
                                                            </label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="section">
                                                                    <div class="input-container" style="display: none;">
                                                                        <div class="form-group mb-3 d-flex align-items-center">
                                                                            <input type="text" class="form-control" name="custom_nearby_areas[]" placeholder="Enter something">
                                                                            <button class="btn btn-danger btn-sm">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                    <button class="add-more add-rule-btn btn add-button">Add More</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('nearby_areas') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <h3 class="can-tittle">Nearby Area Categories</h3>
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <label for="areaSelector">Select Nearby Area</label>
                                                                <select id="areaSelector" class="form-control js-facility-select js-select2" name="nearby_area_category">
                                                                    <option value="restaurant">Restaurant & Cafe</option>
                                                                    <option value="entertainment">Entertainment & Attraction Point</option>
                                                                    <option value="hospital">Hospital & Police Station</option>
                                                                    <option value="transport">Transport & Airport</option>
                                                                    <option value="shopping">Shopping & ATM</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-3">
                                                            <button class="add-more add-rule-btn btn add-button" id="addNearbyAreaBtn">Add More +</button>
                                                        </div>
                                                        <div class="row mt-3" id="dynamicFieldsContainer">
                                                            <!-- Dynamically added fields will appear here -->
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
                                            <div class="row gy-4">
                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Kitchen Photo</label>
                                                        <div class="multiple-upload-container" id="upload-container-1">
                                                            <input type="file" class="multiple-file-input" name="kitchen_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('kitchen_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
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
                                                        @error('washroom_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Parking Lot Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="parking_lot_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('parking_lot_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Entrance Gate/Main Gate Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="entrance_gate_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('entrance_gate_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Lift, Stairs, wheelchair area Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="lift_stairs_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('lift_stairs_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Spa & Massage Center Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="spa_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('spa_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Bar Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="bar_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('bar_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Hotels Car & Bus Photo</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="transport_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('transport_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Rooftop, Garde, Sitting area Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="rooftop_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('rooftop_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Gym, Game room & Kids Zone Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="gym_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('gym_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">CCTV, fire extinguisher & Surveillance Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="security_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('security_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group mt-15">
                                                        <label class="form-label">Hotel/Property Amenities Photos</label>
                                                        <div class="multiple-upload-container" id="upload-container-3">
                                                            <input type="file" class="multiple-file-input" name="amenities_photos[]" accept="image/*" multiple>
                                                            <label class="upload-label">Select Multiple Images</label>
                                                            <div class="multiple-thumbnail-gallery"></div>
                                                        </div>
                                                        @error('amenities_photos.*') <span class="text-danger">{{ $message }}</span> @enderror
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
                            removeBtn.addEventListener('click', () => {
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

            // Initialize for all upload containers dynamically
            const uploadContainers = document.querySelectorAll('.multiple-upload-container');
            uploadContainers.forEach(container => {
                initializeMultipleUpload(container);
            });

            // Handle save button click
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.addEventListener('click', () => {
                for (const [containerId, files] of Object.entries(uploadedImages)) {
                    console.log(`Images from ${containerId}:`);
                    files.forEach(file => {
                        console.log(file.name);
                    });
                }
                alert('Images have been logged in the console!');
            });
        });
    </script>


    <script type="text/javascript">
        // JavaScript to handle "Check All" functionality
        document.getElementById("site-off").addEventListener("change", function() {
            // Get all checkboxes with the class "checkbox-item"
            let checkboxes = document.querySelectorAll(".checkbox-item");
            // Set checked status based on "Check All" checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById("site-off").checked;
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            const checkbox = document.getElementById("property-ownership");
            const options = document.getElementById("ownership-options");

            checkbox.addEventListener("change", () => {
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



    <!-- Select Number of Apartments/ Rooms dynamic  form -->
    <script>
        document.getElementById('apartment-count').addEventListener('change', function() {
            const count = parseInt(this.value);
            const dynamicFormsContainer = document.getElementById('dynamic-forms');

            // Clear previous forms
            dynamicFormsContainer.innerHTML = '';

            if (count > 0) {
                for (let i = 1; i <= count; i++) {
                    const formGroup = document.createElement('div');
                    formGroup.classList.add('apartment-form');

                    // Apartment Number Field
                    const apartmentNumberLabel = document.createElement('label');
                    apartmentNumberLabel.textContent = `Apartment ${i} Number:`;
                    apartmentNumberLabel.setAttribute('for', `apartment-${i}-number`);
                    const apartmentNumberInput = document.createElement('input');
                    apartmentNumberInput.type = 'text';
                    apartmentNumberInput.id = `apartment-${i}-number`;
                    apartmentNumberInput.name = `apartment-${i}-number`;
                    apartmentNumberInput.classList.add('form-control');

                    // Apartment Floor Number Field
                    const apartmentFloorLabel = document.createElement('label');
                    apartmentFloorLabel.textContent = `Apartment ${i} Floor Number:`;
                    apartmentFloorLabel.setAttribute('for', `apartment-${i}-floor`);
                    const apartmentFloorInput = document.createElement('input');
                    apartmentFloorInput.type = 'text';
                    apartmentFloorInput.id = `apartment-${i}-floor`;
                    apartmentFloorInput.name = `apartment-${i}-floor`;
                    apartmentFloorInput.classList.add('form-control');

                    // Apartment/Rooms Name Field
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
        });
    </script>


    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            console.log('Form is submitting with data:', new FormData(this));
        });
    </script>

    <!-- Ownership Yes or no -->
    <script>
        // Get all radio buttons
        const radioButtons = document.querySelectorAll('input[name="showFields"]');
        const additionalFields = document.getElementById('additionalFields');

        // Add event listener to each radio button
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


    <!-- Property Ownership -->
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.js-select2').select2();

            // Handle property ownership change
            $('#propertyOwnershipss').on('change', function() {
                const selectedValue = $(this).val();
                const partnerFields = $('.partner-fields');
                const leaseDates = $('.lease-dates');

                // Hide all conditional fields first
                partnerFields.slideUp();
                leaseDates.slideUp();

                // Show relevant fields based on selection
                if (selectedValue === 'Partnership') {
                    partnerFields.slideDown();
                } else if (selectedValue === 'Leased') {
                    leaseDates.slideDown();
                }
            });
        });
    </script>





    <script>
        // Function to handle bar selection
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
                        barNumberSelect.value = ''; // Reset select when hiding
                    }
                });
            });
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', initializeBarSelection);
    </script>


    <script>
        class KidsZoneManager {
            constructor() {
                this.initializeAllKidsZones();
            }

            initializeAllKidsZones() {
                // Find all kids zone sections
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
                            numberSelect.value = ''; // Reset select when hiding
                        }
                    });
                });
            }

            // Method to get all selections
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

            // Method to add a new kids zone section dynamically
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

        // Initialize the manager
        const kidsZoneManager = new KidsZoneManager();

        // Example usage:
        // To add a new kids zone section:
        // kidsZoneManager.addNewKidsZone('container-id', 3);

        // To get all selections:
        // const selections = kidsZoneManager.getAllSelections();
        // console.log(selections);
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const yesOption = document.getElementById("yesOption");
            const noOption = document.getElementById("noOption");
            const yesFields = document.getElementById("yesFields");
            const noFields = document.getElementById("noFields");

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



            // Populate districts based on selected division
            divisionSelect.addEventListener("change", function () {
                const division = this.value;
                districtSelect.innerHTML = '<option value="" disabled selected>Choose Property Type</option>';
                placeOptions.innerHTML = ""; // Clear previous options
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

            // Display checkboxes based on selected district
            districtSelect.addEventListener("change", function () {
                const division = divisionSelect.value;
                const district = this.value;
                placeOptions.innerHTML = ""; // Clear existing checkboxes

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



    <!-- selct all Facilities  Check box -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {


            // Popular Facilities
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










    <!-- Add more Faciliteies -->
    <script>
        const facilityContainer = document.getElementById('facility-container');

        // Function to add a new input and image field
        const addMoreBtn = document.getElementById('add-more-btn');
        addMoreBtn.addEventListener('click', function () {
            const facilityField = document.createElement('div');
            facilityField.classList.add('input-field');
            facilityField.innerHTML = `
        <input class="form-control" type="text" name="custom_facilities[]" placeholder="Facility name" />
        <button type="button" class="delete-btn">Delete</button>
    `;
            const deleteBtn = facilityField.querySelector('.delete-btn');
            deleteBtn.addEventListener('click', () => {
                facilityField.remove();
            });
            document.getElementById('facility-container').appendChild(facilityField);
        });

        // Add event listener to the "Add More" button
        addMoreBtn.addEventListener('click', addFacilityField);
    </script>
    <!-- Add more Faciliteies -->


    <!-- Check In Method -->
    <script type="text/javascript">
        // JavaScript to handle "Check All" functionality for the Check in method section
        document.getElementById("check-in-all").addEventListener("change", function () {
            // Get all checkboxes with the class "checkbox-item-checkin"
            let checkinCheckboxes = document.querySelectorAll(".checkbox-item-checkin");

            // Set checked status based on "Check All" checkbox
            checkinCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById("check-in-all").checked;
            });
        });
    </script>



    <!-- Add  more for Check in method -->
    <script>
        document.getElementById('addRuleBtn').addEventListener('click', function () {
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


    <!-- Yes Click then show Input Field  -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            // Find all radio groups with a target input
            document.querySelectorAll(".radio-group input[type='radio']").forEach(function (radio) {
                radio.addEventListener("change", function () {
                    // Get the target input element using the data attribute
                    const targetId = this.getAttribute("data-target");
                    const targetInput = document.getElementById(targetId);

                    // Check if the target exists and show/hide it based on the value
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

    <!-- Proferty -->
    <script type="text/javascript">

        document.querySelector("#property-all").addEventListener("change", function () {
            // Get all checkboxes in the "Property Info" group
            const propertyCheckboxes = document.querySelectorAll(".checkbox-item-property");

            // Set the checked state of all checkboxes to match the "Select All" checkbox
            propertyCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.querySelector("#property-all").checked;
            });
        });
    </script>





    <!-- Add more then show Input Overall -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Add event listeners to all "Add More" buttons
            document.querySelectorAll(".add-more").forEach((button) => {
                button.addEventListener("click", function () {
                    const inputContainer = this.previousElementSibling; // Get the input container

                    // Create a new form group with an input field and delete button
                    const newFormGroup = document.createElement("div");
                    newFormGroup.classList.add("form-group", "mb-1", "d-flex", "align-items-center");

                    // Add a minimum gap of 10px between input and delete button
                    newFormGroup.style.gap = "10px";

                    // Create new input field
                    const inputField = document.createElement("input");
                    inputField.type = "text";
                    inputField.classList.add("form-control");
                    inputField.placeholder = "Enter something";

                    // Create delete button
                    const deleteButton = document.createElement("button");
                    deleteButton.innerText = "Delete";
                    deleteButton.classList.add("delete-btn");

                    // Add functionality to delete button
                    deleteButton.addEventListener("click", function () {
                        newFormGroup.remove(); // Remove the form group
                    });

                    // Append input and delete button to the new form group
                    newFormGroup.appendChild(inputField);
                    newFormGroup.appendChild(deleteButton);

                    // Insert the new form group before the "Add More" button
                    inputContainer.parentNode.insertBefore(newFormGroup, this);
                });
            });
        });
    </script>


    <!-- Hotel All Acilities -->
    <script>
        const facilityDropdown = document.getElementById('facilityDropdown');
        const dynamicFormContainer = document.getElementById('dynamicFormContainer');
        const addFacilityButton = document.getElementById('addFacilityButton');

        // Automatically show input field when a facility is selected
        facilityDropdown.addEventListener('change', handleFacilitySelection);

        // Handle "Add More" button click
        addFacilityButton.addEventListener('click', addMoreFields);

        function handleFacilitySelection() {
            const selectedFacility = facilityDropdown.value;

            if (selectedFacility) {
                // Check if an input already exists for the selected facility
                const existingField = document.querySelector(`.facility-group-${selectedFacility}`);
                if (!existingField) {
                    createInputField(selectedFacility);
                }
            }
        }

        function addMoreFields() {
            const selectedFacility = facilityDropdown.value;

            if (!selectedFacility) {
                alert('Please select a facility first.');
                return;
            }

            createInputField(selectedFacility);
        }

        function createInputField(selectedFacility) {
            const uniqueId = `facility-group-${selectedFacility}-${Date.now()}`;

            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3', `facility-group-${selectedFacility}`);
            newFieldGroup.setAttribute('id', uniqueId);

            const label = getFacilityLabel(selectedFacility);

            newFieldGroup.innerHTML = `
        <div class="form-group">
            <label for="input-${uniqueId}">${label}</label>
            <input type="text" class="form-control facility-input" id="input-${uniqueId}" placeholder="Enter ${label}" required>
        </div>
        <button type="button" class="btn btn-danger btn-sm mt-3 delete-facility-btn">Delete</button>
    `;

            dynamicFormContainer.appendChild(newFieldGroup);

            // Attach delete functionality to the button
            newFieldGroup.querySelector('.delete-facility-btn').addEventListener('click', function () {
                dynamicFormContainer.removeChild(newFieldGroup);
            });
        }

        function getFacilityLabel(selectedFacility) {
            switch (selectedFacility) {
                case 'general': return 'General Service';
                case 'activities': return 'Activity Name';
                case 'safety': return 'Safety Measure';
                case 'technology': return 'Technology Feature';
                case 'bedroom': return 'Bedroom Feature';
                case 'bathroom': return 'Bathroom Amenity';
                case 'living': return 'Living Room Feature';
                case 'kitchen': return 'Kitchen Facility';
                case 'food': return 'Food/Beverage';
                case 'parking': return 'Parking Option';
                case 'view': return 'View Option';
                case 'frontdesk': return 'Front Desk Service';
                case 'housekeeping': return 'Housekeeping Service';
                case 'room': return 'Room Amenity';
                case 'business': return 'Business Service';
                case 'languages': return 'Language';
                default: return 'Unknown Facility';
            }
        }

    </script>


    <!-- All Near by location set up -->
    <script>
        // Define labels for different section types
        const sectionLabelsMap = {
            restaurant: ['Restaurant Name', 'Distance'],
            entertainment: ['Attraction Point', 'Distance'],
            hospital: ['Hospital/Police Station Name', 'Distance'],
            transport: ['Transport/Airport Name', 'Distance'],
            shopping: ['Shopping/ATM Name', 'Distance']
        };

        // Button click to add new section
        document.getElementById('addNearbyAreaBtn').addEventListener('click', function () {
            const selectedValue = document.getElementById('areaSelector').value;
            const formContainer = document.getElementById('dynamicFieldsContainer');
            if (!sectionLabelsMap[selectedValue]) {
                alert("Please select a valid area.");
                return;
            }
            const fieldGroupId = `field-group-${Date.now()}`;
            const fieldLabels = sectionLabelsMap[selectedValue];
            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-6', 'col-xxl-6', 'mb-3');
            newFieldGroup.setAttribute('id', fieldGroupId);
            newFieldGroup.innerHTML = `
        <div class="form-group">
            <label>${fieldLabels[0]}</label>
            <input type="text" class="form-control" name="custom_nearby_area_details[]" placeholder="Enter ${fieldLabels[0]}" required>
        </div>
        <div class="form-group mt-2">
            <label>${fieldLabels[1]}</label>
            <input type="text" class="form-control" name="custom_nearby_area_details[]" placeholder="Enter ${fieldLabels[1]}" required>
        </div>
        <button type="button" class="btn btn-danger btn-sm mt-3 removeFieldGroupBtn">Delete</button>
    `;
            formContainer.appendChild(newFieldGroup);
        });

        // Delegated event handler for deleting field groups
        document.getElementById('dynamicFieldsContainer').addEventListener('click', function (event) {
            if (event.target.classList.contains('removeFieldGroupBtn')) {
                event.target.closest('.col-md-6').remove();
            }
        });
    </script>

    <script>
        document.querySelectorAll('.add-more').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevents the button from acting as a submit button
            });
        });
        document.getElementById("addRuleBtn").addEventListener("click", function(event) {
            event.preventDefault(); // Stops form submission
        });
        document.getElementById("addFacilityButton").addEventListener("click", function(event) {
            event.preventDefault(); // Stops form submission
        });

    </script>
@endsection
