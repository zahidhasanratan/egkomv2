@extends('auth.layout.super_admin_layout')

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

                                <form method="POST" action="{{ route('super-admin.hotel.update', $hotel->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="tab-content">
                                        <!-- Hotel Description -->
                                        <div class="tab-pane active" id="tabItem3">
                                            <div class="row gy-4">
                                                <div class="col-md-12 col-lg-12 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-textarea">Hotel/Property Description & Policy</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control no-resize" id="default-textarea" name="description">{{ old('description', $hotel->description ?? '') }}</textarea>
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
                                                                <input type="radio" name="pets_allowed" value="yes" class="bar-radio-yes" data-target="pets-input" {{ old('pets_allowed', $hotel->pets_allowed) === 'yes' ? 'checked' : '' }}> Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="pets_allowed" value="no" class="bar-radio-no" data-target="pets-input" {{ old('pets_allowed', $hotel->pets_allowed) === 'no' ? 'checked' : '' }}> No
                                                            </label>
                                                        </div>
                                                        <div class="input-group {{ old('pets_allowed', $hotel->pets_allowed) === 'yes' ? '' : 'hidden' }}" id="pets-input">
                                                            <textarea class="form-control" name="pets_details" style="height: 50px;">{{ old('pets_details', $hotel->pets_details ?? '') }}</textarea>
                                                        </div>
                                                        @error('pets_allowed') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Events & Party</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="events_allowed" value="yes" class="bar-radio-yes" data-target="events-input" {{ old('events_allowed', $hotel->events_allowed) === 'yes' ? 'checked' : '' }}> Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="events_allowed" value="no" class="bar-radio-no" data-target="events-input" {{ old('events_allowed', $hotel->events_allowed) === 'no' ? 'checked' : '' }}> No
                                                            </label>
                                                        </div>
                                                        <div class="input-group {{ old('events_allowed', $hotel->events_allowed) === 'yes' ? '' : 'hidden' }}" id="events-input">
                                                            <textarea class="form-control" name="events_details" style="height: 50px;">{{ old('events_details', $hotel->events_details ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Smoking</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="smoking_allowed" value="yes" class="bar-radio-yes" data-target="Smoking-input" {{ old('smoking_allowed', $hotel->smoking_allowed) === 'yes' ? 'checked' : '' }}> Yes (Vaping Or e‑cigarettes)
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="smoking_allowed" value="no" class="bar-radio-no" data-target="Smoking-input" {{ old('smoking_allowed', $hotel->smoking_allowed) === 'no' ? 'checked' : '' }}> No
                                                            </label>
                                                        </div>
                                                        <div class="input-group {{ old('smoking_allowed', $hotel->smoking_allowed) === 'yes' ? '' : 'hidden' }}" id="Smoking-input">
                                                            <textarea class="form-control" name="smoking_details" style="height: 50px;">{{ old('smoking_details', $hotel->smoking_details ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Quiet Hours</label>
                                                        <input type="text" class="form-control" name="quiet_hours" value="{{ old('quiet_hours', $hotel->quiet_hours ?? '') }}" placeholder="Quiet Hours">
                                                        @error('quiet_hours') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Commercial photography and filming allowed</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="photography_allowed" value="yes" class="bar-radio-yes" data-target="photography-input" {{ old('photography_allowed', $hotel->photography_allowed) === 'yes' ? 'checked' : '' }}> Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="photography_allowed" value="no" class="bar-radio-no" data-target="photography-input" {{ old('photography_allowed', $hotel->photography_allowed) === 'no' ? 'checked' : '' }}> No
                                                            </label>
                                                        </div>
                                                        <div class="input-group {{ old('photography_allowed', $hotel->photography_allowed) === 'yes' ? '' : 'hidden' }}" id="photography-input">
                                                            <textarea class="form-control" name="photography_details" style="height: 50px;">{{ old('photography_details', $hotel->photography_details ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Check-in window start and end time</label>
                                                        <select class="form-select mb-3" name="check_in_window" aria-label="Large select example">
                                                            <option value="">Select Check-in Time</option>
                                                            @foreach(['00:00-02:00' => '12:00 AM (Midnight) - 2:00 AM', '02:00-04:00' => '2:00 AM - 4:00 AM', '04:00-06:00' => '4:00 AM - 6:00 AM', '06:00-08:00' => '6:00 AM - 8:00 AM', '08:00-10:00' => '8:00 AM - 10:00 AM', '10:00-12:00' => '10:00 AM - 12:00 PM (Noon)', '12:00-14:00' => '12:00 PM (Noon) - 2:00 PM', '14:00-16:00' => '2:00 PM - 4:00 PM', '16:00-18:00' => '4:00 PM - 6:00 PM', '18:00-20:00' => '6:00 PM - 8:00 PM', '20:00-22:00' => '8:00 PM - 10:00 PM', '22:00-00:00' => '10:00 PM - 12:00 AM (Midnight)'] as $value => $label)
                                                                <option value="{{ $value }}" {{ old('check_in_window', $hotel->check_in_window ?? '') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('check_in_window') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Check Out time</label>
                                                        <select class="form-select mb-3" name="check_out_time" aria-label="Large select example">
                                                            <option value="">Select Check Out time</option>
                                                            @foreach(['1:00 AM', '2:00 AM', '3:00 AM', '4:00 AM', '5:00 AM', '6:00 AM', '7:00 AM', '8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM', '6:00 PM', '7:00 PM', '8:00 PM', '9:00 PM', '10:00 PM', '11:00 PM', '12:00 AM'] as $time)
                                                                <option value="{{ $time }}" {{ old('check_out_time', $hotel->check_out_time ?? '') === $time ? 'selected' : '' }}>{{ $time }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('check_out_time') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Food & Laundry Facilities</label>
                                                        <div class="bar-radio-group">
                                                            <label>
                                                                <input type="radio" name="food_laundry" value="yes" class="bar-yes" {{ old('food_laundry', $hotel->food_laundry) === 'yes' ? 'checked' : '' }}> Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="food_laundry" value="no" class="bar-no" {{ old('food_laundry', $hotel->food_laundry) === 'no' ? 'checked' : '' }}> No
                                                            </label>
                                                        </div>
                                                        @error('food_laundry') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xxl-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Check-in rules if any</label>
                                                        <div class="radio-group">
                                                            @foreach(['Pay in advance', 'Security money for keys', 'Rentals'] as $rule)
                                                                <label>
                                                                    <input type="checkbox" name="check_in_rules[]" value="{{ $rule }}" {{ in_array($rule, old('check_in_rules', $hotel->check_in_rules ?? [])) ? 'checked' : '' }}> {{ $rule }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="section">
                                                                    @if(!empty($hotel->custom_check_in_rules) && is_array($hotel->custom_check_in_rules))
                                                                        @foreach($hotel->custom_check_in_rules as $customRule)
                                                                            <div class="form-group mb-3 d-flex align-items-center">
                                                                                <input type="text" class="form-control" name="custom_check_in_rules[]" value="{{ $customRule }}">
                                                                                <button type="button" class="btn btn-danger btn-sm delete-custom-rule">Delete</button>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                    <div class="input-container" style="display: none;">
                                                                        <div class="form-group mb-3 d-flex align-items-center">
                                                                            <input type="text" class="form-control" name="custom_check_in_rules[]" placeholder="Enter something">
                                                                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="add-more add-rule-btn btn add-button">Add More</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('check_in_rules') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Property Information -->
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Property Info</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input select-all" name="property_all" id="property-all" data-target="checkbox-item-property" {{ count(array_intersect(['Guests must climb stairs', 'No lift/Elevator', 'Potential noise during stays', 'Pet(s) live on the property', 'No parking on the property', 'Property has shared spaces', 'Limited essential amenities', 'Weapon(s) on the property', 'Commercial shops in the building', 'Offices in the building'], $hotel->property_info ?? [])) === 10 ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="property-all">Select All Property Info</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach(['Guests must climb stairs', 'No lift/Elevator', 'Potential noise during stays', 'Pet(s) live on the property', 'No parking on the property', 'Property has shared spaces', 'Limited essential amenities', 'Weapon(s) on the property', 'Commercial shops in the building', 'Offices in the building'] as $info)
                                                        <label><input type="checkbox" name="property_info[]" value="{{ $info }}" class="checkbox-item-property" {{ in_array($info, old('property_info', $hotel->property_info ?? [])) ? 'checked' : '' }}> {{ $info }}</label><br>
                                                    @endforeach
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="section">
                                                                @if(!empty($hotel->custom_property_info) && is_array($hotel->custom_property_info))
                                                                    @foreach($hotel->custom_property_info as $customInfo)
                                                                        <div class="form-group mb-3 d-flex align-items-center">
                                                                            <input type="text" class="form-control" name="custom_property_info[]" value="{{ $customInfo }}">
                                                                            <button type="button" class="btn btn-danger btn-sm delete-custom-rule">Delete</button>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <div class="input-container" style="display: none;">
                                                                    <div class="form-group mb-3 d-flex align-items-center">
                                                                        <input type="text" class="form-control" name="custom_property_info[]" placeholder="Enter something">
                                                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="add-more add-rule-btn btn add-button">Add More</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('property_info') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <!-- Arrival Guideline Information -->
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Arrival Guides</h3>
                                                    <div class="row gy-2">
                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Age Restrictions</label>
                                                                <div class="radio-group">
                                                                    <label>
                                                                        <input type="radio" name="age_restriction" value="yes" class="bar-radio-yes" data-target="Age-input" {{ old('age_restriction', $hotel->age_restriction) === 'yes' ? 'checked' : '' }}> Yes
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="age_restriction" value="no" class="bar-radio-no" data-target="Age-input" {{ old('age_restriction', $hotel->age_restriction) === 'no' ? 'checked' : '' }}> No
                                                                    </label>
                                                                </div>
                                                                <div class="input-group {{ old('age_restriction', $hotel->age_restriction) === 'yes' ? '' : 'hidden' }}" id="Age-input">
                                                                    <textarea class="form-control no-resize" name="age_restriction_details">{{ old('age_restriction_details', $hotel->age_restriction_details ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Vlogging & Commercial Filming</label>
                                                                <div class="radio-group">
                                                                    <label>
                                                                        <input type="radio" name="vlogging_allowed" value="yes" class="bar-radio-yes" data-target="Vlogging-input" {{ old('vlogging_allowed', $hotel->vlogging_allowed) === 'yes' ? 'checked' : '' }}> Yes
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="vlogging_allowed" value="no" class="bar-radio-no" data-target="Vlogging-input" {{ old('vlogging_allowed', $hotel->vlogging_allowed) === 'no' ? 'checked' : '' }}> No
                                                                    </label>
                                                                </div>
                                                                <div class="input-group {{ old('vlogging_allowed', $hotel->vlogging_allowed) === 'yes' ? '' : 'hidden' }}" id="Vlogging-input">
                                                                    <textarea class="form-control no-resize" name="vlogging_details">{{ old('vlogging_details', $hotel->vlogging_details ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Child Policy</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" name="child_policy">{{ old('child_policy', $hotel->child_policy ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Extra Bed Policy</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" name="extra_bed_policy">{{ old('extra_bed_policy', $hotel->extra_bed_policy ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Cooking Policy</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" name="cooking_policy">{{ old('cooking_policy', $hotel->cooking_policy ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-6 col-xxl-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Directions (Location Direction details)</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" name="directions">{{ old('directions', $hotel->directions ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-lg-12 col-xxl-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Additional Policy</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" name="additional_policy">{{ old('additional_policy', $hotel->additional_policy ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Check in method -->
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Check in method</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input" name="check_in_all" id="check-in-all" {{ count(array_intersect(['Building staff', 'Housekeeping', 'Bell boy', 'In-person/Self check-in', 'Smart lock', 'Keypad', 'Lockbox'], $hotel->check_in_methods ?? [])) === 7 ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="check-in-all">Check All</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach(['Building staff', 'Housekeeping', 'Bell boy', 'In-person/Self check-in', 'Smart lock', 'Keypad', 'Lockbox'] as $method)
                                                        <label><input type="checkbox" name="check_in_methods[]" value="{{ $method }}" class="checkbox-item-checkin" {{ in_array($method, old('check_in_methods', $hotel->check_in_methods ?? [])) ? 'checked' : '' }}> {{ $method }}</label><br>
                                                    @endforeach
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <button type="button" class="add-rule-btn btn add-button" id="addRuleBtn">Add More +</button>
                                                        </div>
                                                        <div class="form-container" id="formContainer">
                                                            @if(!empty($hotel->custom_check_in_methods) && is_array($hotel->custom_check_in_methods))
                                                                @foreach($hotel->custom_check_in_methods as $customMethod)
                                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="custom_check_in_methods[]" value="{{ $customMethod }}">
                                                                            <button type="button" class="btn btn-danger btn-sm delete-custom-rule">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @error('check_in_methods') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <!-- Cancellation Policies -->
                                            <div class="row mt-15">
                                                <div class="col-md-12">
                                                    <h3 class="can-tittle">Cancellation Policies</h3>
                                                </div>
                                                @foreach(['Flexible' => 'Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)', 'Non-refundable' => 'Non-refundable (Regardless of the cancelation window, customers will not get any refund under this.)', 'Partially refundable' => 'Partially refundable (Cancelations that take place in less than 24 hours and Rooms that are labeled with this badge after deducting a 30% Cancellation fee rest of the amount will be refunded.)', 'Long-term/Monthly staying policy' => 'Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed. T&C paper will be found in the system.)'] as $value => $label)
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <div class="form-check form-switch custom-switch">
                                                                <input class="form-check-input" type="checkbox" name="cancellation_policies[]" value="{{ $value }}" id="flexSwitchCheckChecked_{{ $value }}" {{ in_array($value, old('cancellation_policies', $hotel->cancellation_policies ?? [])) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="flexSwitchCheckChecked_{{ $value }}">{{ $label }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group form-check">
                                                        <input type="hidden" name="approve" value="0">
                                                        <input type="checkbox" name="approve" value="1" class="form-check-input" id="approveCheckbox" {{ $hotel->approve ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="approveCheckbox">Approve</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Most Popular Facilities -->
                                        <div class="tab-pane" id="tabItem4">
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Most Popular Facilities</h3>
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" class="custom-control-input" id="facilities-all" {{ count(array_intersect(['Free Wi-Fi', 'Hill View Or Sea View', 'On-site restaurant', 'Buffet Breakfast', 'Bar/lounge', 'Private Pool', 'Fitness center & Spa services', '24-hour reception', 'Parking facilities', 'Airport shuttle service'], $hotel->facilities ?? [])) === 10 ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="facilities-all">Select All</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="all-facilities-list">
                                                        @foreach(['Free Wi-Fi' => 'wifi', 'Hill View Or Sea View' => 'view', 'On-site restaurant' => 'restaurant', 'Buffet Breakfast' => 'breakfast', 'Bar/lounge' => 'bar', 'Private Pool' => 'pool', 'Fitness center & Spa services' => 'fitness', '24-hour reception' => 'reception', 'Parking facilities' => 'parking', 'Airport shuttle service' => 'shuttle'] as $facility => $id)
                                                            <div>
                                                                <input type="checkbox" name="facilities[]" value="{{ $facility }}" class="checkbox-item-facility" id="facility-{{ $id }}" {{ in_array($facility, old('facilities', $hotel->facilities ?? [])) ? 'checked' : '' }}>
                                                                <label for="facility-{{ $id }}">
                                                                    <span><img class="fac-img" src="{{ asset('images/icons/mountain.png') }}"></span> {{ $facility }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div id="facility-container">
                                                        @if(!empty($hotel->custom_facilities) && is_array($hotel->custom_facilities))
                                                            @foreach($hotel->custom_facilities as $customFacility)
                                                                <div class="input-field">
                                                                    <input class="form-control" type="text" name="custom_facilities[]" value="{{ $customFacility }}" placeholder="Facility name" />
                                                                    <button type="button" class="btn btn-danger btn-sm delete-custom-rule">Delete</button>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <button type="button" class="add-rule-btn btn add-button" id="add-more-btn">Add More +</button>
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
                                                                <option value="general" {{ old('facility_category', $hotel->facility_category ?? '') === 'general' ? 'selected' : '' }}>General Services</option>
                                                                <option value="activities" {{ old('facility_category', $hotel->facility_category ?? '') === 'activities' ? 'selected' : '' }}>Activities & Entertainment</option>
                                                                <option value="safety" {{ old('facility_category', $hotel->facility_category ?? '') === 'safety' ? 'selected' : '' }}>Safety & Security</option>
                                                                <option value="technology" {{ old('facility_category', $hotel->facility_category ?? '') === 'technology' ? 'selected' : '' }}>Technology, Media & Wi-Fi</option>
                                                                <option value="bedroom" {{ old('facility_category', $hotel->facility_category ?? '') === 'bedroom' ? 'selected' : '' }}>Bedroom Features</option>
                                                                <option value="bathroom" {{ old('facility_category', $hotel->facility_category ?? '') === 'bathroom' ? 'selected' : '' }}>Bathroom Amenities</option>
                                                                <option value="living" {{ old('facility_category', $hotel->facility_category ?? '') === 'living' ? 'selected' : '' }}>Living Room Features</option>
                                                                <option value="kitchen" {{ old('facility_category', $hotel->facility_category ?? '') === 'kitchen' ? 'selected' : '' }}>Kitchen Facilities</option>
                                                                <option value="food" {{ old('facility_category', $hotel->facility_category ?? '') === 'food' ? 'selected' : '' }}>Food & Beverages</option>
                                                                <option value="parking" {{ old('facility_category', $hotel->facility_category ?? '') === 'parking' ? 'selected' : '' }}>Parking Availability</option>
                                                                <option value="view" {{ old('facility_category', $hotel->facility_category ?? '') === 'view' ? 'selected' : '' }}>View from the Hotel</option>
                                                                <option value="frontdesk" {{ old('facility_category', $hotel->facility_category ?? '') === 'frontdesk' ? 'selected' : '' }}>Front Desk Services</option>
                                                                <option value="housekeeping" {{ old('facility_category', $hotel->facility_category ?? '') === 'housekeeping' ? 'selected' : '' }}>Housekeeping & Cleaning</option>
                                                                <option value="room" {{ old('facility_category', $hotel->facility_category ?? '') === 'room' ? 'selected' : '' }}>Room Amenities</option>
                                                                <option value="business" {{ old('facility_category', $hotel->facility_category ?? '') === 'business' ? 'selected' : '' }}>Business & Meeting Services</option>
                                                                <option value="languages" {{ old('facility_category', $hotel->facility_category ?? '') === 'languages' ? 'selected' : '' }}>Languages Spoken</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mt-3">
                                                            <button type="button" class="add-rule-btn btn add-button" id="addFacilityButton">Add More +</button>
                                                        </div>
                                                        <div class="row mt-3" id="dynamicFormContainer">
                                                            @if(!empty($hotel->custom_facility_details) && is_array($hotel->custom_facility_details))
                                                                @foreach($hotel->custom_facility_details as $detail)
                                                                    <div class="col-md-6 col-lg-4 col-xxl-3 mb-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control facility-input" value="{{ $detail }}" name="custom_facility_details[]" placeholder="Enter facility detail" required>
                                                                        </div>
                                                                        <button type="button" class="btn btn-danger btn-sm mt-3 delete-facility-btn">Delete</button>
                                                                    </div>
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
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group form-check">
                                                        <input type="hidden" name="approve" value="0">
                                                        <input type="checkbox" name="approve" value="1" class="form-check-input" id="approveCheckbox" {{ $hotel->approve ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="approveCheckbox">Approve</label>
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
                                                            @foreach(['16.5 km from Himchori Waterfall', '0.25 km from Navy Jetty, from where Saint Martin bound ship sails', '3.2 km from Cox\'s Bazar Airport'] as $area)
                                                                <label>
                                                                    <input type="checkbox" name="nearby_areas[]" value="{{ $area }}" class="bar-radio-yes" {{ in_array($area, old('nearby_areas', $hotel->nearby_areas ?? [])) ? 'checked' : '' }}> {{ $area }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="section">
                                                                    @if(!empty($hotel->custom_nearby_areas) && is_array($hotel->custom_nearby_areas))
                                                                        @foreach($hotel->custom_nearby_areas as $customArea)
                                                                            <div class="form-group mb-3 d-flex align-items-center">
                                                                                <input type="text" class="form-control" name="custom_nearby_areas[]" value="{{ $customArea }}">
                                                                                <button type="button" class="btn btn-danger btn-sm delete-custom-rule">Delete</button>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                    <div class="input-container" style="display: none;">
                                                                        <div class="form-group mb-3 d-flex align-items-center">
                                                                            <input type="text" class="form-control" name="custom_nearby_areas[]" placeholder="Enter something">
                                                                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="add-more add-rule-btn btn add-button">Add More</button>
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
                                                                    <option value="restaurant" {{ old('nearby_area_category', $hotel->nearby_area_category ?? '') === 'restaurant' ? 'selected' : '' }}>Restaurant & Cafe</option>
                                                                    <option value="entertainment" {{ old('nearby_area_category', $hotel->nearby_area_category ?? '') === 'entertainment' ? 'selected' : '' }}>Entertainment & Attraction Point</option>
                                                                    <option value="hospital" {{ old('nearby_area_category', $hotel->nearby_area_category ?? '') === 'hospital' ? 'selected' : '' }}>Hospital & Police Station</option>
                                                                    <option value="transport" {{ old('nearby_area_category', $hotel->nearby_area_category ?? '') === 'transport' ? 'selected' : '' }}>Transport & Airport</option>
                                                                    <option value="shopping" {{ old('nearby_area_category', $hotel->nearby_area_category ?? '') === 'shopping' ? 'selected' : '' }}>Shopping & ATM</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-3">
                                                            <button type="button" class="add-more add-rule-btn btn add-button" id="addNearbyAreaBtn">Add More +</button>
                                                        </div>
                                                        <div class="row mt-3" id="dynamicFieldsContainer">
                                                            @if(!empty($hotel->custom_nearby_area_details) && is_array($hotel->custom_nearby_area_details))
                                                                @for($i = 0; $i < count($hotel->custom_nearby_area_details); $i += 2)
                                                                    <div class="col-md-6 col-lg-6 col-xxl-6 mb-3">
                                                                        <div class="form-group">
                                                                            <label>{{ $sectionLabelsMap[$hotel->nearby_area_category ?? 'restaurant'][0] }}</label>
                                                                            <input type="text" class="form-control" name="custom_nearby_area_details[]" value="{{ $hotel->custom_nearby_area_details[$i] ?? '' }}" placeholder="Enter {{ $sectionLabelsMap[$hotel->nearby_area_category ?? 'restaurant'][0] }}" required>
                                                                        </div>
                                                                        <div class="form-group mt-2">
                                                                            <label>{{ $sectionLabelsMap[$hotel->nearby_area_category ?? 'restaurant'][1] }}</label>
                                                                            <input type="text" class="form-control" name="custom_nearby_area_details[]" value="{{ $hotel->custom_nearby_area_details[$i + 1] ?? '' }}" placeholder="Enter {{ $sectionLabelsMap[$hotel->nearby_area_category ?? 'restaurant'][1] }}" required>
                                                                        </div>
                                                                        <button type="button" class="btn btn-danger btn-sm mt-3 removeFieldGroupBtn">Delete</button>
                                                                    </div>
                                                                @endfor
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
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group form-check">
                                                        <input type="hidden" name="approve" value="0">
                                                        <input type="checkbox" name="approve" value="1" class="form-check-input" id="approveCheckbox" {{ $hotel->approve ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="approveCheckbox">Approve</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Photos -->
                                        <div class="tab-pane" id="Photos">
                                            <div class="row gy-4">
                                                @foreach(['kitchen_photos', 'washroom_photos', 'parking_lot_photos', 'entrance_gate_photos', 'lift_stairs_photos', 'spa_photos', 'bar_photos', 'transport_photos', 'rooftop_photos', 'gym_photos', 'security_photos', 'amenities_photos'] as $photoField)
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group mt-15">
                                                            <label class="form-label">{{ ucwords(str_replace('_', ' ', $photoField)) }}</label>
                                                            <div class="multiple-upload-container" id="upload-container-{{ $photoField }}">
                                                                <input type="file" class="multiple-file-input" name="{{ $photoField }}[]" accept="image/*" multiple>
                                                                <label class="upload-label">Select Multiple Images</label>
                                                                <div class="multiple-thumbnail-gallery">
                                                                    @php
                                                                        $photos = is_string($hotel->$photoField) ? json_decode($hotel->$photoField, true) : $hotel->$photoField;
                                                                    @endphp
                                                                    @if(!empty($photos) && is_array($photos))
                                                                        @foreach($photos as $index => $photo)
                                                                            <div class="multiple-thumbnail-item" data-photo="{{ $photo }}">
                                                                                <img src="{{ Storage::url($photo) }}" alt="Uploaded image" style="max-width: 100px; max-height: 100px;">
                                                                                <button type="button" class="multiple-remove-btn" data-index="{{ $index }}" data-field="{{ $photoField }}">×</button>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <!-- Hidden input to track removed photo indices -->
                                                                <input type="hidden" name="removed_{{ $photoField }}" id="removed-{{ $photoField }}" value="">
                                                            </div>
                                                            @error("{$photoField}.*") <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                @endforeach

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
                                                    <div class="col-sm-2 col-md-2 mt-15">
                                                        <div class="form-group form-check">
                                                            <input type="hidden" name="approve" value="0">
                                                            <input type="checkbox" name="approve" value="1" class="form-check-input" id="approveCheckbox" {{ $hotel->approve ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="approveCheckbox">Approve</label>
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

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const uploadedImages = {};

            // Initialize multiple upload containers
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
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Handle removal of existing photos
                thumbnailGallery.querySelectorAll('.multiple-remove-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const thumbnailItem = this.parentElement;
                        const field = this.dataset.field;
                        const index = this.dataset.index;
                        const removedInput = document.getElementById(`removed-${field}`);
                        let removedIndices = removedInput.value ? removedInput.value.split(',') : [];

                        // Add the index to the removed list if not already present
                        if (!removedIndices.includes(index)) {
                            removedIndices.push(index);
                            removedInput.value = removedIndices.join(',');
                        }

                        // Remove the thumbnail from the UI
                        thumbnailItem.remove();

                        // Optional AJAX call to remove immediately (uncomment if desired)
                        /*
                        fetch(`/vendor-admin/hotel/remove-photo/${field}/${index}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        }).then(response => response.json()).then(data => {
                            if (data.success) {
                                console.log('Image removed successfully');
                            }
                        }).catch(error => console.error('Error removing photo:', error));
                        */
                    });
                });
            }

            // Initialize all upload containers
            const uploadContainers = document.querySelectorAll('.multiple-upload-container');
            uploadContainers.forEach(container => {
                initializeMultipleUpload(container);
            });

            // Existing "Add More" functionality (for custom fields)
            document.querySelectorAll('.delete-custom-rule').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });

            document.querySelectorAll('.add-more').forEach(button => {
                button.addEventListener('click', function() {
                    const inputContainer = this.previousElementSibling;
                    const newFormGroup = document.createElement('div');
                    newFormGroup.classList.add('form-group', 'mb-3', 'd-flex', 'align-items-center');
                    newFormGroup.innerHTML = `
                    <input type="text" class="form-control" name="${inputContainer.querySelector('input').name}" placeholder="Enter something">
                    <button type="button" class="btn btn-danger btn-sm delete-custom-rule">Delete</button>
                `;
                    newFormGroup.querySelector('.delete-custom-rule').addEventListener('click', function() {
                        newFormGroup.remove();
                    });
                    inputContainer.parentNode.insertBefore(newFormGroup, this);
                });
            });

            // Check All functionality
            document.getElementById('property-all')?.addEventListener('change', function() {
                document.querySelectorAll('.checkbox-item-property').forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            document.getElementById('check-in-all')?.addEventListener('change', function() {
                document.querySelectorAll('.checkbox-item-checkin').forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            document.getElementById('facilities-all')?.addEventListener('change', function() {
                document.querySelectorAll('.checkbox-item-facility').forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            // Radio button toggle
            document.querySelectorAll('.radio-group input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const targetId = this.getAttribute('data-target');
                    const targetInput = document.getElementById(targetId);
                    if (targetInput) {
                        targetInput.classList.toggle('hidden', this.value !== 'yes');
                    }
                });
            });

            // Add More Facilities
            document.getElementById('add-more-btn')?.addEventListener('click', function() {
                const facilityField = document.createElement('div');
                facilityField.classList.add('input-field');
                facilityField.innerHTML = `
                <input class="form-control" type="text" name="custom_facilities[]" placeholder="Facility name" />
                <button type="button" class="btn btn-danger btn-sm delete-custom-rule">Delete</button>
            `;
                facilityField.querySelector('.delete-custom-rule').addEventListener('click', () => {
                    facilityField.remove();
                });
                document.getElementById('facility-container').appendChild(facilityField);
            });

            // Add More Check-in Methods
            document.getElementById('addRuleBtn')?.addEventListener('click', function() {
                const formContainer = document.getElementById('formContainer');
                const newField = document.createElement('div');
                newField.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3');
                newField.innerHTML = `
                <div class="form-group">
                    <input type="text" class="form-control" name="custom_check_in_methods[]" placeholder="" required>
                    <button type="button" class="btn btn-danger btn-sm delete-custom-rule">Delete</button>
                </div>
            `;
                formContainer.appendChild(newField);
                newField.querySelector('.delete-custom-rule').addEventListener('click', function() {
                    formContainer.removeChild(newField);
                });
            });

            // Hotel Facilities Categories
            const facilityDropdown = document.getElementById('facilityDropdown');
            const dynamicFormContainer = document.getElementById('dynamicFormContainer');
            document.getElementById('addFacilityButton')?.addEventListener('click', function() {
                const selectedFacility = facilityDropdown.value;
                if (!selectedFacility) return;
                const uniqueId = `facility-group-${selectedFacility}-${Date.now()}`;
                const label = getFacilityLabel(selectedFacility);
                const newFieldGroup = document.createElement('div');
                newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
                newFieldGroup.setAttribute('id', uniqueId);
                newFieldGroup.innerHTML = `
                <div class="form-group">
                    <label for="input-${uniqueId}">${label}</label>
                    <input type="text" class="form-control facility-input" id="input-${uniqueId}" name="custom_facility_details[]" placeholder="Enter ${label}" required>
                </div>
                <button type="button" class="btn btn-danger btn-sm mt-3 delete-facility-btn">Delete</button>
            `;
                dynamicFormContainer.appendChild(newFieldGroup);
                newFieldGroup.querySelector('.delete-facility-btn').addEventListener('click', function() {
                    dynamicFormContainer.removeChild(newFieldGroup);
                });
            });

            function getFacilityLabel(selectedFacility) {
                const labels = {
                    'general': 'General Service', 'activities': 'Activity Name', 'safety': 'Safety Measure', 'technology': 'Technology Feature',
                    'bedroom': 'Bedroom Feature', 'bathroom': 'Bathroom Amenity', 'living': 'Living Room Feature', 'kitchen': 'Kitchen Facility',
                    'food': 'Food/Beverage', 'parking': 'Parking Option', 'view': 'View Option', 'frontdesk': 'Front Desk Service',
                    'housekeeping': 'Housekeeping Service', 'room': 'Room Amenity', 'business': 'Business Service', 'languages': 'Language'
                };
                return labels[selectedFacility] || 'Unknown Facility';
            }

            // Nearby Area Categories
            const sectionLabelsMap = {
                restaurant: ['Restaurant Name', 'Distance'], entertainment: ['Attraction Point', 'Distance'], hospital: ['Hospital/Police Station Name', 'Distance'],
                transport: ['Transport/Airport Name', 'Distance'], shopping: ['Shopping/ATM Name', 'Distance']
            };
            document.getElementById('addNearbyAreaBtn')?.addEventListener('click', function() {
                const selectedValue = document.getElementById('areaSelector').value;
                const formContainer = document.getElementById('dynamicFieldsContainer');
                if (!sectionLabelsMap[selectedValue]) return;
                const fieldLabels = sectionLabelsMap[selectedValue];
                const newFieldGroup = document.createElement('div');
                newFieldGroup.classList.add('col-md-6', 'col-lg-6', 'col-xxl-6', 'mb-3');
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

            document.getElementById('dynamicFieldsContainer')?.addEventListener('click', function(event) {
                if (event.target.classList.contains('removeFieldGroupBtn')) {
                    event.target.closest('.col-md-6').remove();
                }
            });
        });
    </script>
@endsection
