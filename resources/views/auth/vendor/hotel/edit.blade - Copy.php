@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Hotel / Property</h3>
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

                            <form method="POST" action="{{ route('vendor-admin.hotel.update', $hotel->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="tab-content">
                                    <!-- Hotel Description -->
                                    <div class="tab-pane active" id="tabItem3">
                                        <div class="row gy-4">
                                            <div class="col-md-12 col-lg-12 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Hotel / Property Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" id="default-textarea" name="description">{{ old('description', $hotel->description) }}</textarea>
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
                                                            <input type="radio" name="pets_allowed" value="yes" class="bar-radio-yes" data-target="pets-input" {{ old('pets_allowed', $hotel->pets_allowed) == 'yes' ? 'checked' : '' }}> Yes
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="pets_allowed" value="no" class="bar-radio-no" data-target="pets-input" {{ old('pets_allowed', $hotel->pets_allowed) == 'no' ? 'checked' : '' }}> No
                                                        </label>
                                                    </div>
                                                    <div class="input-group {{ old('pets_allowed', $hotel->pets_allowed) == 'yes' ? '' : 'hidden' }}" id="pets-input">
                                                        <textarea class="form-control" name="pets_details" placeholder="" style="height: 50px;">{{ old('pets_details', $hotel->pets_details) }}</textarea>
                                                    </div>
                                                    @error('pets_allowed') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                <div class="form-group">
                                                    <label class="form-label">Events & Party</label>
                                                    <div class="radio-group">
                                                        <label>
                                                            <input type="radio" name="events_allowed" value="yes" class="bar-radio-yes" data-target="events-input" {{ old('events_allowed', $hotel->events_allowed) == 'yes' ? 'checked' : '' }}> Yes
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="events_allowed" value="no" class="bar-radio-no" data-target="events-input" {{ old('events_allowed', $hotel->events_allowed) == 'no' ? 'checked' : '' }}> No
                                                        </label>
                                                    </div>
                                                    <div class="input-group {{ old('events_allowed', $hotel->events_allowed) == 'yes' ? '' : 'hidden' }}" id="events-input">
                                                        <textarea class="form-control" name="events_details" placeholder="" style="height: 50px;">{{ old('events_details', $hotel->events_details) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                <div class="form-group">
                                                    <label class="form-label">Smoking</label>
                                                    <div class="radio-group">
                                                        <label>
                                                            <input type="radio" name="smoking_allowed" value="yes" class="bar-radio-yes" data-target="Smoking-input" {{ old('smoking_allowed', $hotel->smoking_allowed) == 'yes' ? 'checked' : '' }}> Yes (Vaping Or e‑cigarettes)
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="smoking_allowed" value="no" class="bar-radio-no" data-target="Smoking-input" {{ old('smoking_allowed', $hotel->smoking_allowed) == 'no' ? 'checked' : '' }}> No
                                                        </label>
                                                    </div>
                                                    <div class="input-group {{ old('smoking_allowed', $hotel->smoking_allowed) == 'yes' ? '' : 'hidden' }}" id="Smoking-input">
                                                        <textarea class="form-control" name="smoking_details" placeholder="" style="height: 50px;">{{ old('smoking_details', $hotel->smoking_details) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label">Quiet Hours</label>
                                                    <input type="text" class="form-control" name="quiet_hours" placeholder="Quiet Hours" value="{{ old('quiet_hours', $hotel->quiet_hours) }}">
                                                    @error('quiet_hours') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                <div class="form-group">
                                                    <label class="form-label">Commercial photography and filming allowed</label>
                                                    <div class="radio-group">
                                                        <label>
                                                            <input type="radio" name="photography_allowed" value="yes" class="bar-radio-yes" data-target="photography-input" {{ old('photography_allowed', $hotel->photography_allowed) == 'yes' ? 'checked' : '' }}> Yes
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="photography_allowed" value="no" class="bar-radio-no" data-target="photography-input" {{ old('photography_allowed', $hotel->photography_allowed) == 'no' ? 'checked' : '' }}> No
                                                        </label>
                                                    </div>
                                                    <div class="input-group {{ old('photography_allowed', $hotel->photography_allowed) == 'yes' ? '' : 'hidden' }}" id="photography-input">
                                                        <textarea class="form-control" name="photography_details" placeholder="" style="height: 50px;">{{ old('photography_details', $hotel->photography_details) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="check-in-window">Check-in window start and end time</label>
                                                    <select class="form-select mb-3" name="check_in_window" id="check-in-window" aria-label="Large select example">
                                                        <option value="">Select Check-in Time</option>
                                                        <option value="00:00-02:00" {{ old('check_in_window', $hotel->check_in_window) == '00:00-02:00' ? 'selected' : '' }}>12:00 AM (Midnight) - 2:00 AM</option>
                                                        <option value="02:00-04:00" {{ old('check_in_window', $hotel->check_in_window) == '02:00-04:00' ? 'selected' : '' }}>2:00 AM - 4:00 AM</option>
                                                        <option value="04:00-06:00" {{ old('check_in_window', $hotel->check_in_window) == '04:00-06:00' ? 'selected' : '' }}>4:00 AM - 6:00 AM</option>
                                                        <option value="06:00-08:00" {{ old('check_in_window', $hotel->check_in_window) == '06:00-08:00' ? 'selected' : '' }}>6:00 AM - 8:00 AM</option>
                                                        <option value="08:00-10:00" {{ old('check_in_window', $hotel->check_in_window) == '08:00-10:00' ? 'selected' : '' }}>8:00 AM - 10:00 AM</option>
                                                        <option value="10:00-12:00" {{ old('check_in_window', $hotel->check_in_window) == '10:00-12:00' ? 'selected' : '' }}>10:00 AM - 12:00 PM (Noon)</option>
                                                        <option value="12:00-14:00" {{ old('check_in_window', $hotel->check_in_window) == '12:00-14:00' ? 'selected' : '' }}>12:00 PM (Noon) - 2:00 PM</option>
                                                        <option value="14:00-16:00" {{ old('check_in_window', $hotel->check_in_window) == '14:00-16:00' ? 'selected' : '' }}>2:00 PM - 4:00 PM</option>
                                                        <option value="16:00-18:00" {{ old('check_in_window', $hotel->check_in_window) == '16:00-18:00' ? 'selected' : '' }}>4:00 PM - 6:00 PM</option>
                                                        <option value="18:00-20:00" {{ old('check_in_window', $hotel->check_in_window) == '18:00-20:00' ? 'selected' : '' }}>6:00 PM - 8:00 PM</option>
                                                        <option value="20:00-22:00" {{ old('check_in_window', $hotel->check_in_window) == '20:00-22:00' ? 'selected' : '' }}>8:00 PM - 10:00 PM</option>
                                                        <option value="22:00-00:00" {{ old('check_in_window', $hotel->check_in_window) == '22:00-00:00' ? 'selected' : '' }}>10:00 PM - 12:00 AM (Midnight)</option>
                                                    </select>
                                                    @error('check_in_window') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label">Check Out time</label>
                                                    <select class="form-select mb-3" name="check_out_time" aria-label="Large select example">
                                                        <option value="">Select Check Out time</option>
                                                        <option value="1:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '1:00 AM' ? 'selected' : '' }}>1:00 AM</option>
                                                        <option value="2:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '2:00 AM' ? 'selected' : '' }}>2:00 AM</option>
                                                        <option value="3:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '3:00 AM' ? 'selected' : '' }}>3:00 AM</option>
                                                        <option value="4:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '4:00 AM' ? 'selected' : '' }}>4:00 AM</option>
                                                        <option value="5:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '5:00 AM' ? 'selected' : '' }}>5:00 AM</option>
                                                        <option value="6:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '6:00 AM' ? 'selected' : '' }}>6:00 AM</option>
                                                        <option value="7:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '7:00 AM' ? 'selected' : '' }}>7:00 AM</option>
                                                        <option value="8:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '8:00 AM' ? 'selected' : '' }}>8:00 AM</option>
                                                        <option value="9:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '9:00 AM' ? 'selected' : '' }}>9:00 AM</option>
                                                        <option value="10:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '10:00 AM' ? 'selected' : '' }}>10:00 AM</option>
                                                        <option value="11:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '11:00 AM' ? 'selected' : '' }}>11:00 AM</option>
                                                        <option value="12:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '12:00 PM' ? 'selected' : '' }}>12:00 PM (Noon)</option>
                                                        <option value="1:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '1:00 PM' ? 'selected' : '' }}>1:00 PM</option>
                                                        <option value="2:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '2:00 PM' ? 'selected' : '' }}>2:00 PM</option>
                                                        <option value="3:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '3:00 PM' ? 'selected' : '' }}>3:00 PM</option>
                                                        <option value="4:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '4:00 PM' ? 'selected' : '' }}>4:00 PM</option>
                                                        <option value="5:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '5:00 PM' ? 'selected' : '' }}>5:00 PM</option>
                                                        <option value="6:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '6:00 PM' ? 'selected' : '' }}>6:00 PM</option>
                                                        <option value="7:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '7:00 PM' ? 'selected' : '' }}>7:00 PM</option>
                                                        <option value="8:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '8:00 PM' ? 'selected' : '' }}>8:00 PM</option>
                                                        <option value="9:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '9:00 PM' ? 'selected' : '' }}>9:00 PM</option>
                                                        <option value="10:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '10:00 PM' ? 'selected' : '' }}>10:00 PM</option>
                                                        <option value="11:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '11:00 PM' ? 'selected' : '' }}>11:00 PM</option>
                                                        <option value="12:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '12:00 AM' ? 'selected' : '' }}>12:00 AM (Midnight)</option>
                                                    </select>
                                                    @error('check_out_time') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label">Food & Laundry Facilities</label>
                                                    <div class="bar-radio-group">
                                                        <label>
                                                            <input type="radio" name="food_laundry" value="yes" class="bar-yes" {{ old('food_laundry', $hotel->food_laundry) == 'yes' ? 'checked' : '' }}> Yes
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="food_laundry" value="no" class="bar-no" {{ old('food_laundry', $hotel->food_laundry) == 'no' ? 'checked' : '' }}> No
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
                                                            <input type="checkbox" name="check_in_rules[]" value="Pay in advance" class="bar-radio-yes" {{ in_array('Pay in advance', old('check_in_rules', $hotel->check_in_rules ?? [])) ? 'checked' : '' }}> Pay in advance
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="check_in_rules[]" value="Security money for keys" class="bar-radio-no" {{ in_array('Security money for keys', old('check_in_rules', $hotel->check_in_rules ?? [])) ? 'checked' : '' }}> Security money for keys
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="check_in_rules[]" value="Rentals" class="bar-radio-no" {{ in_array('Rentals', old('check_in_rules', $hotel->check_in_rules ?? [])) ? 'checked' : '' }}> Rentals
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
                                                                <!-- Added check for custom_check_in_rules -->
                                                                @if(!empty($hotel->custom_check_in_rules) && is_array($hotel->custom_check_in_rules))
                                                                @foreach(old('custom_check_in_rules', $hotel->custom_check_in_rules) as $rule)
                                                                <div class="form-group mb-3 d-flex align-items-center">
                                                                    <input type="text" class="form-control" name="custom_check_in_rules[]" value="{{ $rule }}" placeholder="Enter something">
                                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                                </div>
                                                                @endforeach
                                                                @endif
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
                                                            <input type="checkbox" class="custom-control-input select-all" name="property_all" id="property-all" data-target="checkbox-item-property" {{ count(array_intersect(['Guests must climb stairs', 'No lift/Elevator', 'Potential noise during stays', 'Pet(s) live on the property', 'No parking on the property', 'Property has shared spaces', 'Limited essential amenities', 'Weapon(s) on the property', 'Commercial shops in the building', 'Offices in the building'], old('property_info', $hotel->property_info ?? []))) === 10 ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="property-all">Select All Property Info</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label><input type="checkbox" name="property_info[]" value="Guests must climb stairs" class="checkbox-item-property" {{ in_array('Guests must climb stairs', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> Guests must climb stairs</label><br>
                                                <label><input type="checkbox" name="property_info[]" value="No lift/Elevator" class="checkbox-item-property" {{ in_array('No lift/Elevator', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> No lift/Elevator</label><br>
                                                <label><input type="checkbox" name="property_info[]" value="Potential noise during stays" class="checkbox-item-property" {{ in_array('Potential noise during stays', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> Potential noise during stays</label><br>
                                                <label><input type="checkbox" name="property_info[]" value="Pet(s) live on the property" class="checkbox-item-property" {{ in_array('Pet(s) live on the property', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> Pet(s) live on the property</label><br>
                                                <label><input type="checkbox" name="property_info[]" value="No parking on the property" class="checkbox-item-property" {{ in_array('No parking on the property', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> No parking on the property</label><br>
                                                <label><input type="checkbox" name="property_info[]" value="Property has shared spaces" class="checkbox-item-property" {{ in_array('Property has shared spaces', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> Property has shared spaces</label><br>
                                                <label><input type="checkbox" name="property_info[]" value="Limited essential amenities" class="checkbox-item-property" {{ in_array('Limited essential amenities', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> Limited essential amenities</label><br>
                                                <label><input type="checkbox" name="property_info[]" value="Weapon(s) on the property" class="checkbox-item-property" {{ in_array('Weapon(s) on the property', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> Weapon(s) on the property</label><br>
                                                <label><input type="checkbox" name="property_info[]" value="Commercial shops in the building" class="checkbox-item-property" {{ in_array('Commercial shops in the building', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> Commercial shops in the building</label><br>
                                                <label><input type="checkbox" name="property_info[]" value="Offices in the building" class="checkbox-item-property" {{ in_array('Offices in the building', old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> Offices in the building</label><br>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="section">
                                                            <div class="input-container" style="display: none;">
                                                                <div class="form-group mb-3 d-flex align-items-center">
                                                                    <input type="text" class="form-control" name="custom_property_info[]" placeholder="Enter something">
                                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                                </div>
                                                            </div>
                                                            <!-- Added check for custom_property_info -->
                                                            @if(!empty($hotel->custom_property_info) && is_array($hotel->custom_property_info))
                                                            @foreach(old('custom_property_info', $hotel->custom_property_info) as $info)
                                                            <div class="form-group mb-3 d-flex align-items-center">
                                                                <input type="text" class="form-control" name="custom_property_info[]" value="{{ $info }}" placeholder="Enter something">
                                                                <button class="btn btn-danger btn-sm">Delete</button>
                                                            </div>
                                                            @endforeach
                                                            @endif
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
                                                            <label class="form-label" for="age-restriction">Age Restrictions</label>
                                                            <div class="radio-group">
                                                                <label>
                                                                    <input type="radio" name="age_restriction" value="yes" class="bar-radio-yes" data-target="Age-input" {{ old('age_restriction', $hotel->age_restriction) == 'yes' ? 'checked' : '' }}> Yes
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="age_restriction" value="no" class="bar-radio-no" data-target="Age-input" {{ old('age_restriction', $hotel->age_restriction) == 'no' ? 'checked' : '' }}> No
                                                                </label>
                                                            </div>
                                                            <div class="input-group {{ old('age_restriction', $hotel->age_restriction) == 'yes' ? '' : 'hidden' }}" id="Age-input">
                                                                <textarea class="form-control no-resize" name="age_restriction_details">{{ old('age_restriction_details', $hotel->age_restriction_details) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="vlogging-allowed">Vlogging & Commercial Filming</label>
                                                            <div class="radio-group">
                                                                <label>
                                                                    <input type="radio" name="vlogging_allowed" value="yes" class="bar-radio-yes" data-target="Vlogging-input" {{ old('vlogging_allowed', $hotel->vlogging_allowed) == 'yes' ? 'checked' : '' }}> Yes
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="vlogging_allowed" value="no" class="bar-radio-no" data-target="Vlogging-input" {{ old('vlogging_allowed', $hotel->vlogging_allowed) == 'no' ? 'checked' : '' }}> No
                                                                </label>
                                                            </div>
                                                            <div class="input-group {{ old('vlogging_allowed', $hotel->vlogging_allowed) == 'yes' ? '' : 'hidden' }}" id="Vlogging-input">
                                                                <textarea class="form-control no-resize" name="vlogging_details">{{ old('vlogging_details', $hotel->vlogging_details) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="child-policy">Child Policy</label>
                                                            <div class="form-control-wrap">
                                                                <textarea class="form-control no-resize" name="child_policy">{{ old('child_policy', $hotel->child_policy) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="extra-bed-policy">Extra Bed Policy</label>
                                                            <div class="form-control-wrap">
                                                                <textarea class="form-control no-resize" name="extra_bed_policy">{{ old('extra_bed_policy', $hotel->extra_bed_policy) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="cooking-policy">Cooking Policy</label>
                                                            <div class="form-control-wrap">
                                                                <textarea class="form-control no-resize" name="cooking_policy">{{ old('cooking_policy', $hotel->cooking_policy) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-6 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="directions">Directions (Location Direction details)</label>
                                                            <div class="form-control-wrap">
                                                                <textarea class="form-control no-resize" name="directions">{{ old('directions', $hotel->directions) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-lg-12 col-xxl-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="additional-policy">Additional Policy</label>
                                                            <div class="form-control-wrap">
                                                                <textarea class="form-control no-resize" name="additional_policy">{{ old('additional_policy', $hotel->additional_policy) }}</textarea>
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
                                                            <input type="checkbox" class="custom-control-input" name="check_in_all" id="check-in-all" {{ count(array_intersect(['Building staff', 'Housekeeping', 'Bell boy', 'In-person/Self check-in', 'Smart lock', 'Keypad', 'Lockbox'], old('check_in_methods', $hotel->check_in_methods ?? []))) === 7 ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="check-in-all">Check All</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label><input type="checkbox" name="check_in_methods[]" value="Building staff" class="checkbox-item-checkin" {{ in_array('Building staff', old('check_in_methods', $hotel->check_in_methods ?? [])) ? 'checked' : '' }}> Building staff</label><br>
                                                <label><input type="checkbox" name="check_in_methods[]" value="Housekeeping" class="checkbox-item-checkin" {{ in_array('Housekeeping', old('check_in_methods', $hotel->check_in_methods ?? [])) ? 'checked' : '' }}> Housekeeping</label><br>
                                                <label><input type="checkbox" name="check_in_methods[]" value="Bell boy" class="checkbox-item-checkin" {{ in_array('Bell boy', old('check_in_methods', $hotel->check_in_methods ?? [])) ? 'checked' : '' }}> Bell boy</label><br>
                                                <label><input type="checkbox" name="check_in_methods[]" value="In-person/Self check-in" class="checkbox-item-checkin" {{ in_array('In-person/Self check-in', old('check_in_methods', $hotel->check_in_methods ?? [])) ? 'checked' : '' }}> In-person/Self check-in</label><br>
                                                <label><input type="checkbox" name="check_in_methods[]" value="Smart lock" class="checkbox-item-checkin" {{ in_array('Smart lock', old('check_in_methods', $hotel->check_in_methods ?? [])) ? 'checked' : '' }}> Smart lock</label><br>
                                                <label><input type="checkbox" name="check_in_methods[]" value="Keypad" class="checkbox-item-checkin" {{ in_array('Keypad', old('check_in_methods', $hotel->check_in_methods ?? [])) ? 'checked' : '' }}> Keypad</label><br>
                                                <label><input type="checkbox" name="check_in_methods[]" value="Lockbox" class="checkbox-item-checkin" {{ in_array('Lockbox', old('check_in_methods', $hotel->check_in_methods ?? [])) ? 'checked' : '' }}> Lockbox</label><br>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <button class="add-rule-btn btn add-button" id="addRuleBtn">Add More +</button>
                                                    </div>
                                                    <div class="form-container" id="formContainer">
                                                        <!-- Added check for custom_check_in_methods -->
                                                        @if(!empty($hotel->custom_check_in_methods) && is_array($hotel->custom_check_in_methods))
                                                        @foreach(old('custom_check_in_methods', $hotel->custom_check_in_methods) as $method)
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="custom_check_in_methods[]" value="{{ $method }}" placeholder="">
                                                                <button class="delete-btn btn btn-danger btn-sm">Delete</button>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
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
                                                        <input class="form-check-input" type="checkbox" name="cancellation_policies[]" value="Flexible" id="flexSwitchCheckFlexible" {{ in_array('Flexible', old('cancellation_policies', $hotel->cancellation_policies ?? [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexSwitchCheckFlexible">Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="form-check form-switch custom-switch">
                                                        <input class="form-check-input" type="checkbox" name="cancellation_policies[]" value="Non-refundable" id="flexSwitchCheckNonRefundable" {{ in_array('Non-refundable', old('cancellation_policies', $hotel->cancellation_policies ?? [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexSwitchCheckNonRefundable">Non-refundable (Regardless of the cancelation window, customers will not get any refund under this.)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="form-check form-switch custom-switch">
                                                        <input class="form-check-input" type="checkbox" name="cancellation_policies[]" value="Partially refundable" id="flexSwitchCheckPartially" {{ in_array('Partially refundable', old('cancellation_policies', $hotel->cancellation_policies ?? [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexSwitchCheckPartially">Partially refundable (Cancelations that take place in less than 24 hours and Rooms that are labeled with this badge after deducting a 30% Cancellation fee rest of the amount will be refunded.)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="form-check form-switch custom-switch">
                                                        <input class="form-check-input" type="checkbox" name="cancellation_policies[]" value="Long-term/Monthly staying policy" id="flexSwitchCheckLongTerm" {{ in_array('Long-term/Monthly staying policy', old('cancellation_policies', $hotel->cancellation_policies ?? [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexSwitchCheckLongTerm">Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed. T&C paper will be found in the system.)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('cancellation_policies') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <!-- Hotel Description -->

                                    <!-- Most Popular Facilities -->
                                    <div class="tab-pane" id="tabItem4">
                                        <div class="row mt-15">
                                            <div class="checkbox-section">
                                                <h3 class="can-tittle">Most Popular Facilities</h3>
                                                <div class="chk-all-sec">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch checked">
                                                            <input type="checkbox" class="custom-control-input" id="facilities-all" {{ count(array_intersect(['Free Wi-Fi', 'Hill View Or Sea View', 'On-site restaurant', 'Buffet Breakfast', 'Bar/lounge', 'Private Pool', 'Fitness center & Spa services', '24-hour reception', 'Parking facilities', 'Airport shuttle service'], old('facilities', $hotel->facilities ?? []))) === 10 ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="facilities-all">Select All</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="all-facilities-list">
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="Free Wi-Fi" class="checkbox-item-facility" id="facility-wifi" {{ in_array('Free Wi-Fi', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-wifi">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> Free Wi-Fi
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="Hill View Or Sea View" class="checkbox-item-facility" id="facility-view" {{ in_array('Hill View Or Sea View', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-view">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> Hill View Or Sea View
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="On-site restaurant" class="checkbox-item-facility" id="facility-restaurant" {{ in_array('On-site restaurant', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-restaurant">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> On-site restaurant
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="Buffet Breakfast" class="checkbox-item-facility" id="facility-breakfast" {{ in_array('Buffet Breakfast', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-breakfast">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> Buffet Breakfast
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="Bar/lounge" class="checkbox-item-facility" id="facility-bar" {{ in_array('Bar/lounge', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-bar">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> Bar/lounge
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="Private Pool" class="checkbox-item-facility" id="facility-pool" {{ in_array('Private Pool', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-pool">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> Private Pool
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="Fitness center & Spa services" class="checkbox-item-facility" id="facility-fitness" {{ in_array('Fitness center & Spa services', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-fitness">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> Fitness center & Spa services
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="24-hour reception" class="checkbox-item-facility" id="facility-reception" {{ in_array('24-hour reception', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-reception">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> 24-hour reception
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="Parking facilities" class="checkbox-item-facility" id="facility-parking" {{ in_array('Parking facilities', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-parking">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> Parking facilities
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="facilities[]" value="Airport shuttle service" class="checkbox-item-facility" id="facility-shuttle" {{ in_array('Airport shuttle service', old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                        <label for="facility-shuttle">
                                                            <span><img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}"></span> Airport shuttle service
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="facility-container">
                                                    <!-- Added check for custom_facilities -->
                                                    @if(!empty($hotel->custom_facilities) && is_array($hotel->custom_facilities))
                                                    @foreach(old('custom_facilities', $hotel->custom_facilities) as $index => $facility)
                                                    <div class="input-field d-flex align-items-center mb-3" style="gap: 10px;">
                                                        <div class="form-group flex-grow-1">
                                                            <label for="custom_facility_{{ $index }}">Facility Name</label>
                                                            <input class="form-control" type="text" name="custom_facilities[]" id="custom_facility_{{ $index }}" value="{{ $facility }}" placeholder="Enter facility name" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="custom_facility_icon_{{ $index }}">Facility Icon</label>
                                                            <div class="multiple-upload-container" id="upload-container-dynamic-{{ $index }}">
                                                                @if(isset($hotel->custom_facilities_icon[$index]) && $hotel->custom_facilities_icon[$index])
                                                                <div class="multiple-thumbnail-item">
                                                                    <img src="{{ asset('storage/' . $hotel->custom_facilities_icon[$index]) }}" alt="Facility Icon">
                                                                    <button type="button" class="multiple-remove-btn" data-index="{{ $index }}" data-field="custom_facilities_icon">×</button>
                                                                </div>
                                                                @endif
                                                                <input class="form-control multiple-file-input" type="file" name="custom_facilities_icon[]" id="custom_facility_icon_{{ $index }}" accept="image/*" />
                                                                <label class="upload-label">Browse Image</label>
                                                                <div class="multiple-thumbnail-gallery"></div>
                                                            </div>
                                                            @error('custom_facilities_icon.*') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <input type="hidden" name="removed_custom_facilities_icon" id="removed_custom_facilities_icon">
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
                                                            <option value="general" {{ old('facility_category', $hotel->facility_category) == 'general' ? 'selected' : '' }}>General Services</option>
                                                            <option value="activities" {{ old('facility_category', $hotel->facility_category) == 'activities' ? 'selected' : '' }}>Activities & Entertainment</option>
                                                            <option value="safety" {{ old('facility_category', $hotel->facility_category) == 'safety' ? 'selected' : '' }}>Safety & Security</option>
                                                            <option value="technology" {{ old('facility_category', $hotel->facility_category) == 'technology' ? 'selected' : '' }}>Technology, Media & Wi-Fi</option>
                                                            <option value="bedroom" {{ old('facility_category', $hotel->facility_category) == 'bedroom' ? 'selected' : '' }}>Bedroom Features</option>
                                                            <option value="bathroom" {{ old('facility_category', $hotel->facility_category) == 'bathroom' ? 'selected' : '' }}>Bathroom Amenities</option>
                                                            <option value="living" {{ old('facility_category', $hotel->facility_category) == 'living' ? 'selected' : '' }}>Living Room Features</option>
                                                            <option value="kitchen" {{ old('facility_category', $hotel->facility_category) == 'kitchen' ? 'selected' : '' }}>Kitchen Facilities</option>
                                                            <option value="food" {{ old('facility_category', $hotel->facility_category) == 'food' ? 'selected' : '' }}>Food & Beverages</option>
                                                            <option value="parking" {{ old('facility_category', $hotel->facility_category) == 'parking' ? 'selected' : '' }}>Parking Availability</option>
                                                            <option value="view" {{ old('facility_category', $hotel->facility_category) == 'view' ? 'selected' : '' }}>View from the Hotel</option>
                                                            <option value="frontdesk" {{ old('facility_category', $hotel->facility_category) == 'frontdesk' ? 'selected' : '' }}>Front Desk Services</option>
                                                            <option value="housekeeping" {{ old('facility_category', $hotel->facility_category) == 'housekeeping' ? 'selected' : '' }}>Housekeeping & Cleaning</option>
                                                            <option value="room" {{ old('facility_category', $hotel->facility_category) == 'room' ? 'selected' : '' }}>Room Amenities</option>
                                                            <option value="business" {{ old('facility_category', $hotel->facility_category) == 'business' ? 'selected' : '' }}>Business & Meeting Services</option>
                                                            <option value="languages" {{ old('facility_category', $hotel->facility_category) == 'languages' ? 'selected' : '' }}>Languages Spoken</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mt-3">
                                                        <button class="add-rule-btn btn add-button" id="addFacilityButton">Add More +</button>
                                                    </div>
                                                    <div class="row mt-3" id="dynamicFormContainer">
                                                        <!-- Added check for facilities -->
                                                        @if(!empty($hotel->facilities) && is_array($hotel->facilities))
                                                        @foreach(old('facilities', $hotel->facilities) as $category => $items)
                                                        @if(is_array($items))
                                                        @foreach($items as $item)
                                                        <div class="col-md-6 col-lg-4 col-xxl-3 mb-3">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="facilities[{{ $category }}][]" value="{{ $item }}" placeholder="Enter {{ $category }} facility">
                                                                <button type="button" class="btn btn-danger btn-sm mt-2 delete-facility-btn">Delete</button>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                        @endforeach
                                                        @endif
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
                                                            <input type="checkbox" name="nearby_areas[]" value="16.5 km from Himchori Waterfall" class="bar-radio-yes" {{ in_array('16.5 km from Himchori Waterfall', old('nearby_areas', $hotel->nearby_areas ?? [])) ? 'checked' : '' }}> 16.5 km from Himchori Waterfall
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="nearby_areas[]" value="0.25 km from Navy Jetty, from where Saint Martin bound ship sails" class="bar-radio-no" {{ in_array('0.25 km from Navy Jetty, from where Saint Martin bound ship sails', old('nearby_areas', $hotel->nearby_areas ?? [])) ? 'checked' : '' }}> 0.25 km from Navy Jetty, from where Saint Martin bound ship sails
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="nearby_areas[]" value="3.2 km from Coxs Bazar Airport" class="bar-radio-no" {{ in_array('3.2 km from Coxs Bazar Airport', old('nearby_areas', $hotel->nearby_areas ?? [])) ? 'checked' : '' }}> 3.2 km from Coxs Bazar Airport
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
                                                                <!-- Added check for custom_nearby_areas -->
                                                                @if(!empty($hotel->custom_nearby_areas) && is_array($hotel->custom_nearby_areas))
                                                                @foreach(old('custom_nearby_areas', $hotel->custom_nearby_areas) as $area)
                                                                <div class="form-group mb-3 d-flex align-items-center">
                                                                    <input type="text" class="form-control" name="custom_nearby_areas[]" value="{{ $area }}" placeholder="Enter something">
                                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                                </div>
                                                                @endforeach
                                                                @endif
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
                                                                <option value="restaurant" {{ old('nearby_area_category', $hotel->nearby_area_category) == 'restaurant' ? 'selected' : '' }}>Restaurant & Cafe</option>
                                                                <option value="entertainment" {{ old('nearby_area_category', $hotel->nearby_area_category) == 'entertainment' ? 'selected' : '' }}>Entertainment & Attraction Point</option>
                                                                <option value="hospital" {{ old('nearby_area_category', $hotel->nearby_area_category) == 'hospital' ? 'selected' : '' }}>Hospital & Police Station</option>
                                                                <option value="transport" {{ old('nearby_area_category', $hotel->nearby_area_category) == 'transport' ? 'selected' : '' }}>Transport & Airport</option>
                                                                <option value="shopping" {{ old('nearby_area_category', $hotel->nearby_area_category) == 'shopping' ? 'selected' : '' }}>Shopping & ATM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mt-3">
                                                        <button class="add-more add-rule-btn btn add-button" id="addNearbyAreaBtn">Add More +</button>
                                                    </div>
                                                    <div class="row mt-3" id="dynamicFieldsContainer">
                                                        <!-- Added check for nearby_areas -->
                                                        @if(!empty($hotel->nearby_areas) && is_array($hotel->nearby_areas))
                                                        @foreach(old('nearby_areas', $hotel->nearby_areas) as $category => $areas)
                                                        @if(is_array($areas) && isset($areas['name']) && is_array($areas['name']))
                                                        @foreach($areas['name'] as $index => $name)
                                                        <div class="col-md-6 col-lg-4 col-xxl-3 mb-3">
                                                            <div class="form-group">
                                                                <label>{{ ucfirst($category) }} Name</label>
                                                                <input type="text" class="form-control" name="nearby_areas[{{ $category }}][name][]" value="{{ $name }}" placeholder="Enter {{ $category }} name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Distance</label>
                                                                <input type="text" class="form-control" name="nearby_areas[{{ $category }}][distance][]" value="{{ $areas['distance'][$index] ?? '' }}" placeholder="Enter distance" required>
                                                            </div>
                                                            <button type="button" class="btn btn-danger btn-sm mt-3 delete-nearby-btn">Delete</button>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                        @endforeach
                                                        @endif
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
                                        'kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos',
                                        'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos',
                                        'rooftop_photos', 'gym_photos', 'security_photos', 'amenities_photos'
                                        ];
                                        $labels = [
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
                                                        <!-- Added check for photo fields -->
                                                        @if(!empty($hotel->$field) && is_array($hotel->$field))
                                                        @foreach($hotel->$field as $photoIndex => $photo)
                                                        <div class="multiple-thumbnail-item">
                                                            <img src="{{ asset('storage/' . $photo) }}" alt="{{ $labels[$field] }} {{ $photoIndex }}">
                                                            <button type="button" class="multiple-remove-btn" data-index="{{ $photoIndex }}" data-field="{{ $field }}">×</button>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                        <input type="file" class="multiple-file-input" name="{{ $field }}[]" accept="image/*" multiple>
                                                        <label class="upload-label">Select Multiple Images</label>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const uploadedImages = {};
        const removedIndices = {};

        // Initialize multiple upload containers
        function initializeMultipleUpload(container) {
            const fileInput = container.querySelector('.multiple-file-input');
            const thumbnailGallery = container.querySelector('.multiple-thumbnail-gallery');
            const containerId = container.id || `dynamic-${Date.now()}`;
            const fieldName = fileInput.name.replace('[]', '');

            uploadedImages[containerId] = [];
            removedIndices[fieldName] = removedIndices[fieldName] || [];

            // Handle existing image removal
            container.querySelectorAll('.multiple-remove-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const index = btn.getAttribute('data-index');
                    const thumbnailItem = btn.parentElement;
                    thumbnailItem.remove();
                    removedIndices[fieldName].push(index);
                    document.getElementById(`removed_${fieldName}`).value = removedIndices[fieldName].join(',');
                    console.log(`Removed existing image index ${index} for ${fieldName}`);
                });
            });

            // Handle new uploads
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

        // Initialize all upload containers
        document.querySelectorAll('.multiple-upload-container').forEach(container => {
            console.log(`Initializing upload container: ${container.id}`);
            initializeMultipleUpload(container);
        });

        // Handle Add More button for custom facilities
        const facilityContainer = document.getElementById('facility-container');
        const addMoreBtn = document.getElementById('add-more-btn');

        addMoreBtn.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('Add More button clicked for custom facilities');

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
                    </div>
                    <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                `;

            const uploadContainer = facilityField.querySelector('.multiple-upload-container');
            initializeMultipleUpload(uploadContainer);

            const deleteBtn = facilityField.querySelector('.delete-btn');
            deleteBtn.addEventListener('click', () => {
                console.log('Delete button clicked for facility field');
                facilityField.remove();
            });

            facilityContainer.appendChild(facilityField);
            console.log('New facility field added to container');
        });

        // Handle dynamic check-in methods
        document.getElementById('addRuleBtn').addEventListener('click', function(event) {
            event.preventDefault();
            const formContainer = document.getElementById('formContainer');
            const newField = document.createElement('div');
            newField.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3');
            newField.innerHTML = `
                    <div class="form-group">
                        <input type="text" class="form-control" name="custom_check_in_methods[]" placeholder="">
                        <button class="delete-btn btn btn-danger btn-sm">Delete</button>
                    </div>
                `;
            formContainer.appendChild(newField);
            const deleteBtn = newField.querySelector('.delete-btn');
            deleteBtn.addEventListener('click', function() {
                formContainer.removeChild(newField);
            });
        });

        // Handle dynamic fields for custom_check_in_rules, custom_property_info, custom_nearby_areas
        document.querySelectorAll('.add-more').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const inputContainer = this.previousElementSibling;
                const newFormGroup = document.createElement('div');
                newFormGroup.classList.add('form-group', 'mb-3', 'd-flex', 'align-items-center');
                newFormGroup.style.gap = '10px';
                const inputField = document.createElement('input');
                inputField.type = 'text';
                inputField.classList.add('form-control');
                inputField.placeholder = 'Enter something';
                inputField.name = inputContainer.querySelector('input')?.name || 'custom_field[]';
                const deleteButton = document.createElement('button');
                deleteButton.innerText = 'Delete';
                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');
                deleteButton.addEventListener('click', function() {
                    newFormGroup.remove();
                });
                newFormGroup.appendChild(inputField);
                newFormGroup.appendChild(deleteButton);
                inputContainer.appendChild(newFormGroup);
            });
        });

        // Handle radio group visibility
        document.querySelectorAll('.radio-group input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const targetId = this.getAttribute('data-target');
                const targetInput = document.getElementById(targetId);
                if (targetInput) {
                    targetInput.classList.toggle('hidden', this.value !== 'yes');
                }
            });
        });

        // Handle Select All checkboxes
        document.getElementById('facilities-all')?.addEventListener('change', function() {
            document.querySelectorAll('.checkbox-item-facility').forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        document.getElementById('check-in-all')?.addEventListener('change', function() {
            document.querySelectorAll('.checkbox-item-checkin').forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        document.getElementById('property-all')?.addEventListener('change', function() {
            document.querySelectorAll('.checkbox-item-property').forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Handle facility categories
        const facilityDropdown = document.getElementById('facilityDropdown');
        const dynamicFormContainer = document.getElementById('dynamicFormContainer');
        const addFacilityButton = document.getElementById('addFacilityButton');

        addFacilityButton.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('Add Facility button clicked');
            const selectedCategory = facilityDropdown.value;
            const newField = document.createElement('div');
            newField.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newField.innerHTML = `
                    <div class="form-group">
                        <input type="text" class="form-control" name="facilities[${selectedCategory}][]" placeholder="Enter ${selectedCategory} facility">
                        <button type="button" class="btn btn-danger btn-sm mt-2 delete-facility-btn">Delete</button>
                    </div>
                `;
            dynamicFormContainer.appendChild(newField);
            const deleteBtn = newField.querySelector('.delete-facility-btn');
            deleteBtn.addEventListener('click', () => {
                console.log('Delete facility field clicked');
                newField.remove();
            });
        });

        // Handle nearby area categories
        const areaSelector = document.getElementById('areaSelector');
        const dynamicFieldsContainer = document.getElementById('dynamicFieldsContainer');
        const addNearbyAreaBtn = document.getElementById('addNearbyAreaBtn');

        addNearbyAreaBtn.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('Add Nearby Area button clicked');
            const selectedCategory = areaSelector.value;
            const newField = document.createElement('div');
            newField.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newField.innerHTML = `
                    <div class="form-group">
                        <label>${selectedCategory.charAt(0).toUpperCase() + selectedCategory.slice(1)} Name</label>
                        <input type="text" class="form-control" name="nearby_areas[${selectedCategory}][name][]" placeholder="Enter ${selectedCategory} name" required>
                    </div>
                    <div class="form-group">
                        <label>Distance</label>
                        <input type="text" class="form-control" name="nearby_areas[${selectedCategory}][distance][]" placeholder="Enter distance" required>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm mt-3 delete-nearby-btn">Delete</button>
                `;
            dynamicFieldsContainer.appendChild(newField);
            const deleteBtn = newField.querySelector('.delete-nearby-btn');
            deleteBtn.addEventListener('click', () => {
                console.log('Delete nearby area field clicked');
                newField.remove();
            });
        });

        // Initialize Select2 for dropdowns
        if (typeof $.fn.select2 !== 'undefined') {
            $('.js-select2').select2({
                placeholder: 'Select an option',
                allowClear: true
            });
        }
    });
</script>
@endsection
