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


                                <form method="POST" action="{{ route('vendor-admin.hotel.update', $hotel->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="tab-content">
                                        <!-- Hotel Description -->
                                        <div class="tab-pane active" id="tabItem3">

                                            <!-- Property Policy And Rules -->
                                            <div class="row gy-4">
                                                <div class="col-md-12 col-lg-12 col-xxl-3">
                                                    <h3 class="can-tittle" style="padding-top: 50px;">Property Policy
                                                        and Rules</h3>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Pets allowed</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="pets_allowed" value="yes"
                                                                       class="bar-radio-yes"
                                                                       data-target="pets-input" {{ old('pets_allowed', $hotel->pets_allowed) == 'yes' ? 'checked' : '' }}>
                                                                Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="pets_allowed" value="no"
                                                                       class="bar-radio-no"
                                                                       data-target="pets-input" {{ old('pets_allowed', $hotel->pets_allowed) == 'no' ? 'checked' : '' }}>
                                                                No
                                                            </label>
                                                        </div>
                                                        <div
                                                            class="input-group {{ old('pets_allowed', $hotel->pets_allowed) == 'yes' ? '' : 'hidden' }}"
                                                            id="pets-input">
    <textarea class="form-control" id="pets-details2" name="pets_details"
              placeholder=""
              style="height: 50px;">{{ old('pets_details', $hotel->pets_details) }}</textarea>
                                                        </div>
                                                        @error('pets_allowed') <span
                                                            class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Events & Party</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="events_allowed" value="yes"
                                                                       class="bar-radio-yes"
                                                                       data-target="events-input" {{ old('events_allowed', $hotel->events_allowed) == 'yes' ? 'checked' : '' }}>
                                                                Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="events_allowed" value="no"
                                                                       class="bar-radio-no"
                                                                       data-target="events-input" {{ old('events_allowed', $hotel->events_allowed) == 'no' ? 'checked' : '' }}>
                                                                No
                                                            </label>
                                                        </div>
                                                        <div
                                                            class="input-group {{ old('events_allowed', $hotel->events_allowed) == 'yes' ? '' : 'hidden' }}"
                                                            id="events-input">
                                                            <textarea class="form-control" name="events_details"
                                                                      placeholder=""
                                                                      style="height: 50px;">{{ old('events_details', $hotel->events_details) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Smoking</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="smoking_allowed" value="yes"
                                                                       class="bar-radio-yes"
                                                                       data-target="Smoking-input" {{ old('smoking_allowed', $hotel->smoking_allowed) == 'yes' ? 'checked' : '' }}>
                                                                Yes (Vaping Or e‑cigarettes)
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="smoking_allowed" value="no"
                                                                       class="bar-radio-no"
                                                                       data-target="Smoking-input" {{ old('smoking_allowed', $hotel->smoking_allowed) == 'no' ? 'checked' : '' }}>
                                                                No
                                                            </label>
                                                        </div>
                                                        <div
                                                            class="input-group {{ old('smoking_allowed', $hotel->smoking_allowed) == 'yes' ? '' : 'hidden' }}"
                                                            id="Smoking-input">
                                                            <textarea class="form-control" name="smoking_details"
                                                                      placeholder=""
                                                                      style="height: 50px;">{{ old('smoking_details', $hotel->smoking_details) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Quiet Hours</label>
                                                        <input type="text" class="form-control" name="quiet_hours"
                                                               placeholder="Quiet Hours"
                                                               value="{{ old('quiet_hours', $hotel->quiet_hours) }}">
                                                        @error('quiet_hours') <span
                                                            class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3 pets-section">
                                                    <div class="form-group">
                                                        <label class="form-label">Commercial photography and filming
                                                            allowed</label>
                                                        <div class="radio-group">
                                                            <label>
                                                                <input type="radio" name="photography_allowed"
                                                                       value="yes" class="bar-radio-yes"
                                                                       data-target="photography-input" {{ old('photography_allowed', $hotel->photography_allowed) == 'yes' ? 'checked' : '' }}>
                                                                Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="photography_allowed"
                                                                       value="no" class="bar-radio-no"
                                                                       data-target="photography-input" {{ old('photography_allowed', $hotel->photography_allowed) == 'no' ? 'checked' : '' }}>
                                                                No
                                                            </label>
                                                        </div>
                                                        <div
                                                            class="input-group {{ old('photography_allowed', $hotel->photography_allowed) == 'yes' ? '' : 'hidden' }}"
                                                            id="photography-input">
                                                            <textarea class="form-control" name="photography_details"
                                                                      placeholder=""
                                                                      style="height: 50px;">{{ old('photography_details', $hotel->photography_details) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="check-in-window">Check-in window
                                                            start and end time</label>
                                                        <select class="form-select mb-3" name="check_in_window"
                                                                id="check-in-window" aria-label="Large select example">
                                                            <option value="">Select Check-in Time</option>
                                                            <option
                                                                value="00:00-02:00" {{ old('check_in_window', $hotel->check_in_window) == '00:00-02:00' ? 'selected' : '' }}>
                                                                12:00 AM (Midnight) - 2:00 AM
                                                            </option>
                                                            <option
                                                                value="02:00-04:00" {{ old('check_in_window', $hotel->check_in_window) == '02:00-04:00' ? 'selected' : '' }}>
                                                                2:00 AM - 4:00 AM
                                                            </option>
                                                            <option
                                                                value="04:00-06:00" {{ old('check_in_window', $hotel->check_in_window) == '04:00-06:00' ? 'selected' : '' }}>
                                                                4:00 AM - 6:00 AM
                                                            </option>
                                                            <option
                                                                value="06:00-08:00" {{ old('check_in_window', $hotel->check_in_window) == '06:00-08:00' ? 'selected' : '' }}>
                                                                6:00 AM - 8:00 AM
                                                            </option>
                                                            <option
                                                                value="08:00-10:00" {{ old('check_in_window', $hotel->check_in_window) == '08:00-10:00' ? 'selected' : '' }}>
                                                                8:00 AM - 10:00 AM
                                                            </option>
                                                            <option
                                                                value="10:00-12:00" {{ old('check_in_window', $hotel->check_in_window) == '10:00-12:00' ? 'selected' : '' }}>
                                                                10:00 AM - 12:00 PM (Noon)
                                                            </option>
                                                            <option
                                                                value="12:00-14:00" {{ old('check_in_window', $hotel->check_in_window) == '12:00-14:00' ? 'selected' : '' }}>
                                                                12:00 PM (Noon) - 2:00 PM
                                                            </option>
                                                            <option
                                                                value="14:00-16:00" {{ old('check_in_window', $hotel->check_in_window) == '14:00-16:00' ? 'selected' : '' }}>
                                                                2:00 PM - 4:00 PM
                                                            </option>
                                                            <option
                                                                value="16:00-18:00" {{ old('check_in_window', $hotel->check_in_window) == '16:00-18:00' ? 'selected' : '' }}>
                                                                4:00 PM - 6:00 PM
                                                            </option>
                                                            <option
                                                                value="18:00-20:00" {{ old('check_in_window', $hotel->check_in_window) == '18:00-20:00' ? 'selected' : '' }}>
                                                                6:00 PM - 8:00 PM
                                                            </option>
                                                            <option
                                                                value="20:00-22:00" {{ old('check_in_window', $hotel->check_in_window) == '20:00-22:00' ? 'selected' : '' }}>
                                                                8:00 PM - 10:00 PM
                                                            </option>
                                                            <option
                                                                value="22:00-00:00" {{ old('check_in_window', $hotel->check_in_window) == '22:00-00:00' ? 'selected' : '' }}>
                                                                10:00 PM - 12:00 AM (Midnight)
                                                            </option>
                                                        </select>
                                                        @error('check_in_window') <span
                                                            class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Check Out time</label>
                                                        <select class="form-select mb-3" name="check_out_time"
                                                                aria-label="Large select example">
                                                            <option value="">Select Check Out time</option>
                                                            <option
                                                                value="1:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '1:00 AM' ? 'selected' : '' }}>
                                                                1:00 AM
                                                            </option>
                                                            <option
                                                                value="2:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '2:00 AM' ? 'selected' : '' }}>
                                                                2:00 AM
                                                            </option>
                                                            <option
                                                                value="3:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '3:00 AM' ? 'selected' : '' }}>
                                                                3:00 AM
                                                            </option>
                                                            <option
                                                                value="4:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '4:00 AM' ? 'selected' : '' }}>
                                                                4:00 AM
                                                            </option>
                                                            <option
                                                                value="5:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '5:00 AM' ? 'selected' : '' }}>
                                                                5:00 AM
                                                            </option>
                                                            <option
                                                                value="6:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '6:00 AM' ? 'selected' : '' }}>
                                                                6:00 AM
                                                            </option>
                                                            <option
                                                                value="7:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '7:00 AM' ? 'selected' : '' }}>
                                                                7:00 AM
                                                            </option>
                                                            <option
                                                                value="8:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '8:00 AM' ? 'selected' : '' }}>
                                                                8:00 AM
                                                            </option>
                                                            <option
                                                                value="9:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '9:00 AM' ? 'selected' : '' }}>
                                                                9:00 AM
                                                            </option>
                                                            <option
                                                                value="10:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '10:00 AM' ? 'selected' : '' }}>
                                                                10:00 AM
                                                            </option>
                                                            <option
                                                                value="11:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '11:00 AM' ? 'selected' : '' }}>
                                                                11:00 AM
                                                            </option>
                                                            <option
                                                                value="12:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '12:00 PM' ? 'selected' : '' }}>
                                                                12:00 PM (Noon)
                                                            </option>
                                                            <option
                                                                value="1:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '1:00 PM' ? 'selected' : '' }}>
                                                                1:00 PM
                                                            </option>
                                                            <option
                                                                value="2:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '2:00 PM' ? 'selected' : '' }}>
                                                                2:00 PM
                                                            </option>
                                                            <option
                                                                value="3:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '3:00 PM' ? 'selected' : '' }}>
                                                                3:00 PM
                                                            </option>
                                                            <option
                                                                value="4:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '4:00 PM' ? 'selected' : '' }}>
                                                                4:00 PM
                                                            </option>
                                                            <option
                                                                value="5:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '5:00 PM' ? 'selected' : '' }}>
                                                                5:00 PM
                                                            </option>
                                                            <option
                                                                value="6:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '6:00 PM' ? 'selected' : '' }}>
                                                                6:00 PM
                                                            </option>
                                                            <option
                                                                value="7:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '7:00 PM' ? 'selected' : '' }}>
                                                                7:00 PM
                                                            </option>
                                                            <option
                                                                value="8:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '8:00 PM' ? 'selected' : '' }}>
                                                                8:00 PM
                                                            </option>
                                                            <option
                                                                value="9:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '9:00 PM' ? 'selected' : '' }}>
                                                                9:00 PM
                                                            </option>
                                                            <option
                                                                value="10:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '10:00 PM' ? 'selected' : '' }}>
                                                                10:00 PM
                                                            </option>
                                                            <option
                                                                value="11:00 PM" {{ old('check_out_time', $hotel->check_out_time) == '11:00 PM' ? 'selected' : '' }}>
                                                                11:00 PM
                                                            </option>
                                                            <option
                                                                value="12:00 AM" {{ old('check_out_time', $hotel->check_out_time) == '12:00 AM' ? 'selected' : '' }}>
                                                                12:00 AM (Midnight)
                                                            </option>
                                                        </select>
                                                        @error('check_out_time') <span
                                                            class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Food & Laundry Facilities</label>
                                                        <div class="bar-radio-group">
                                                            <label>
                                                                <input type="radio" name="food_laundry" value="yes"
                                                                       class="bar-yes" {{ old('food_laundry', $hotel->food_laundry) == 'yes' ? 'checked' : '' }}>
                                                                Yes
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="food_laundry" value="no"
                                                                       class="bar-no" {{ old('food_laundry', $hotel->food_laundry) == 'no' ? 'checked' : '' }}>
                                                                No
                                                            </label>
                                                        </div>
                                                        @error('food_laundry') <span
                                                            class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xxl-12">

                                                    @php
                                                        // 1) Grab the raw saved/old data
                                                        $rawRules = old('check_in_rules', $hotel->check_in_rules);

                                                        // 2) Normalize into an array
                                                        if (is_string($rawRules)) {
                                                            $savedRules = json_decode($rawRules, true) ?: [];
                                                        } elseif (is_array($rawRules)) {
                                                            $savedRules = $rawRules;
                                                        } else {
                                                            $savedRules = [];
                                                        }

                                                        // 3) Our three predefined options
                                                        $predefinedRules = [
                                                            'Pay in advance',
                                                            'Security money for keys',
                                                            'Rentals',
                                                        ];

                                                        // 4) Extract anything else as “custom”
                                                        $customRules = array_values(array_diff($savedRules, $predefinedRules));
                                                    @endphp

                                                    <div class="form-group">
                                                        <label class="form-label">Check-in rules if any</label>

                                                        {{-- Checkbox rules --}}
                                                        <div class="radio-group">
                                                            @foreach($predefinedRules as $rule)
                                                                <label>
                                                                    <input
                                                                        type="checkbox"
                                                                        name="check_in_rules[]"
                                                                        value="{{ $rule }}"
                                                                        {{ in_array($rule, $savedRules) ? 'checked' : '' }}
                                                                    >
                                                                    {{ $rule }}
                                                                </label>
                                                            @endforeach
                                                        </div>

                                                        {{-- Dynamic custom input fields --}}
                                                        <div id="custom-checkin-wrapper">
                                                            @if(count($customRules))
                                                                @foreach($customRules as $text)
                                                                    <div
                                                                        class="form-group mb-2 d-flex align-items-center">
                                                                        <input
                                                                            type="text"
                                                                            name="custom_check_in_rules[]"
                                                                            class="form-control"
                                                                            value="{{ $text }}"
                                                                        >
                                                                        <button
                                                                            type="button"
                                                                            class="btn btn-danger btn-sm ms-2 remove-checkin"
                                                                        >Delete
                                                                        </button>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="form-group mb-2 d-flex align-items-center">
                                                                    <input
                                                                        type="text"
                                                                        name="custom_check_in_rules[]"
                                                                        class="form-control"
                                                                        placeholder="Enter something"
                                                                    >
                                                                    <button
                                                                        type="button"
                                                                        class="btn btn-danger btn-sm ms-2 remove-checkin"
                                                                        style="display: none;"
                                                                    >Delete
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <button
                                                            type="button"
                                                            class="btn btn-sm btn-primary mt-2"
                                                            id="add-checkin-rule"
                                                        >Add More
                                                        </button>

                                                        @error('check_in_rules')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                </div>
                                            </div>




                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="submitted"
                                                                class="btn btn-primary btn-submit">Submit
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="draft"
                                                                class="btn btn-primary">Save & Drafts
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Hotel Description -->

                                        <!-- Most Popular Facilities -->
                                    @php
                                        // ────────────────────────────────────────────────────────
                                        // 1) Decode saved “facilities” (popular ones) & custom ones
                                        $savedFacilities = old('facilities', $hotel->facilities ?? []);
                                        if (is_string($savedFacilities)) {
                                            $savedFacilities = json_decode($savedFacilities, true) ?: [];
                                        }
                                        $customFacilities = old('custom_facilities', $hotel->custom_facilities ?? []);
                                        if (is_string($customFacilities)) {
                                            $customFacilities = json_decode($customFacilities, true) ?: [];
                                        }

                                        // 2) Decode saved “hotel_facilities” JSON into grouped array
                                        $savedHF = old('hotel_facilities', $hotel->hotel_facilities ?? []);
                                        if (is_string($savedHF)) {
                                            $savedHF = json_decode($savedHF, true) ?: [];
                                        }
                                        $groupedHF = [];
                                        foreach ($savedHF as $item) {
                                            $groupedHF[$item['category']][] = $item['name'];
                                        }
                                    @endphp

                                    <!-- Most Popular Facilities -->



                                        <script>
                                            document.getElementById('add-nearby-area').addEventListener('click', function () {
                                                const wrapper = document.getElementById('nearby-areas-wrapper');
                                                const newField = document.createElement('div');
                                                newField.classList.add('form-group', 'mb-3', 'd-flex', 'align-items-center');
                                                newField.innerHTML = `
            <input type="text" name="custom_nearby_areas[]" class="form-control" placeholder="Enter something">
            <button type="button" class="btn btn-danger btn-sm ms-2 remove-area-btn">Delete</button>
        `;
                                                wrapper.appendChild(newField);
                                            });

                                            document.addEventListener('click', function (event) {
                                                if (event.target.classList.contains('remove-area-btn')) {
                                                    event.target.closest('.form-group').remove();
                                                }
                                            });
                                        </script>





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
        document.getElementById('propertyCategory').addEventListener('change', function () {
            var propertyTypeContainer = document.getElementById('propertyTypeContainer');
            var propertyType = document.getElementById('propertyType');
            propertyType.innerHTML = ''; // Clear previous options

            var options = {
                'Hotel': [
                    {id: 'option1', value: 'Only Apartment', label: 'Only Apartment'},
                    {id: 'option2', value: 'Only room', label: 'Only room'},
                    {id: 'option3', value: 'Only Bed', label: 'Only Bed'}
                ],
                'House': [
                    {id: 'option4', value: 'Kitchen', label: 'Kitchen'}
                ],
                'Resort': [
                    {id: 'option6', value: 'Room', label: 'Room'}
                ],
                'Apartment': [
                    {id: 'option7', value: 'Apartment', label: 'Apartment'},
                    {id: 'option8', value: 'Only room', label: 'Only room'},
                    {id: 'option9', value: 'Only Bed', label: 'Only Bed'}
                ]
            };

            var selectedValue = this.value;
            if (options[selectedValue]) {
                options[selectedValue].forEach(function (option) {
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const uploadedImages = {};

            function initializeMultipleUpload(container) {
                const fileInput = container.querySelector('.multiple-file-input');
                const thumbnailGallery = container.querySelector('.multiple-thumbnail-gallery');
                const containerId = container.id || `dynamic-${Date.now()}`; // Fallback ID for dynamic containers

                uploadedImages[containerId] = [];

                fileInput.addEventListener('change', function (event) {
                    console.log(`File input changed in container: ${containerId}`);
                    const files = event.target.files;
                    for (let file of files) {
                        if (!file.type.startsWith('image/')) {
                            console.warn(`File ${file.name} is not an image`);
                            continue;
                        }
                        const reader = new FileReader();
                        reader.onload = function (e) {
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

            addMoreBtn.addEventListener('click', function (event) {
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
        });
    </script>

    <script type="text/javascript">
        document.getElementById("site-off")?.addEventListener("change", function () {
            let checkboxes = document.querySelectorAll(".checkbox-item");
            checkboxes.forEach(function (checkbox) {
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
        document.getElementById('apartment-count')?.addEventListener('change', function () {
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
        document.querySelector('form').addEventListener('submit', function (event) {
            console.log('Form is submitting with data:', new FormData(this));
        });
    </script>

    <script>
        const radioButtons = document.querySelectorAll('input[name="showFields"]');
        const additionalFields = document.getElementById('additionalFields');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'yes') {
                    additionalFields.style.display = 'block';
                } else {
                    additionalFields.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.js-select2').select2();

            $('#propertyOwnershipss')?.on('change', function () {
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
                radio.addEventListener('change', function () {
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

        const hotelFacilitiesCategoryKeysMap = {
            'general_services': 'General Services',
            'activities___entertainment': 'Activities & Entertainment',
            'safety___security': 'Safety & Security',
            'technology__media___wi_fi': 'Technology, Media & Wi-Fi',
            'bedroom_features': 'Bedroom Features',
            'bathroom_amenities': 'Bathroom Amenities',
            'living_room_features': 'Living Room Features',
            'kitchen_facilities': 'Kitchen Facilities',
            'food___beverages': 'Food & Beverages',
            'parking_availability': 'Parking Availability',
            'view_from_the_hotel': 'View from the Hotel',
            'front_desk_services': 'Front Desk Services',
            'housekeeping___cleaning': 'Housekeeping & Cleaning',
            'room_amenities': 'Room Amenities',
            'business___meeting_services': 'Business & Meeting Services',
            'languages_spoken': 'Languages Spoken'
        };

        const hotelFacilitySelector = document.getElementById('hotelFacilitySelector');
        const hotelFormContainer = document.getElementById('dynamicFieldsContainerHotelFacility');
        let currentFacilityValue = '';

        function createHotelFieldGroup(category, value = '') {
            const labels = hotelFacilitiesLabelsMap[category];
            if (!labels) return;

            const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
            const uniqueId = `hotel-facility-${categoryKey}-${Date.now()}`;

            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.setAttribute('id', uniqueId);
            newFieldGroup.innerHTML = `
            <div class="form-group">
                <label for="input-${uniqueId}">${labels[0]}</label>
                <input type="text" class="form-control" id="input-${uniqueId}" name="hotel_facilities[${categoryKey}][]" placeholder="Enter ${labels[0]}" value="${value}" required>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2 delete-hotel-btn">Delete</button>
        `;

            let categoryWrapper = document.getElementById(`wrapper-${categoryKey}`);
            if (!categoryWrapper) {
                categoryWrapper = document.createElement('div');
                categoryWrapper.classList.add('col-12', 'mb-3');
                categoryWrapper.id = `wrapper-${categoryKey}`;
                categoryWrapper.innerHTML = `<h5>${category}</h5><div class="row"></div>`;
                hotelFormContainer.appendChild(categoryWrapper);
            }

            const row = categoryWrapper.querySelector('.row');
            row.appendChild(newFieldGroup);

            newFieldGroup.querySelector('.delete-hotel-btn').addEventListener('click', function () {
                row.removeChild(newFieldGroup);
                if (row.children.length === 0) {
                    hotelFormContainer.removeChild(categoryWrapper);
                }
            });
        }

        // For dropdown selection
        if (hotelFacilitySelector) {
            hotelFacilitySelector.addEventListener('change', function () {
                currentFacilityValue = this.value;
                if (!hotelFacilitiesLabelsMap[currentFacilityValue]) return;
                createHotelFieldGroup(currentFacilityValue);
            });
        }

        // For Add More button
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

        // Now load existing hotel facilities if available
        const hotelFacilitiesData = {!! json_encode($hotelFacilities ?? []) !!};
        hotelFacilitiesData.forEach(facility => {
            const categoryKey = facility.category; // example: general_services
            const name = facility.name;

            const category = hotelFacilitiesCategoryKeysMap[categoryKey]; // convert back to readable category

            if (category && hotelFacilitiesLabelsMap[category]) {
                createHotelFieldGroup(category, name);
            }
        });
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

        function createFieldGroup(category, nameValue = '', distanceValue = '') {
            const labels = sectionLabelsMap[category];
            const uniqueId = `nearby-area-${category.replace(/[^a-zA-Z0-9]/g, '')}-${Date.now()}`;
            const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();

            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.setAttribute('id', uniqueId);
            newFieldGroup.innerHTML = `
            <div class="form-group">
                <label for="input-name-${uniqueId}">${labels[0]}</label>
                <input type="text" class="form-control" id="input-name-${uniqueId}"
                    name="nearby_areas[${categoryKey}][name][]"
                    placeholder="Enter ${labels[0]}"
                    value="${nameValue}" required>
            </div>
            <div class="form-group">
                <label for="input-distance-${uniqueId}">${labels[1]}</label>
                <input type="text" class="form-control" id="input-distance-${uniqueId}"
                    name="nearby_areas[${categoryKey}][distance][]"
                    placeholder="Enter ${labels[1]}"
                    value="${distanceValue}" required>
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

            newFieldGroup.querySelector('.delete-nearby-btn').addEventListener('click', function () {
                row.removeChild(newFieldGroup);
                if (row.children.length === 0) {
                    formContainer.removeChild(categoryWrapper);
                }
            });
        }

        if (areaSelector) {
            areaSelector.addEventListener('change', function () {
                currentSelectedValue = this.value;
                if (!sectionLabelsMap[currentSelectedValue]) return;
                createFieldGroup(currentSelectedValue);
            });
        }

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

        // 💥 Show existing data
        function populateExistingNearbyAreas(existingData) {
            if (!existingData) return;

            Object.keys(existingData).forEach(function (categoryKey) {
                const formattedCategory = categoryKey.replace(/_/g, ' ').replace(/\s+/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

                // Find the real section label
                let actualCategory = '';
                Object.keys(sectionLabelsMap).forEach(section => {
                    const sectionKey = section.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
                    if (sectionKey === categoryKey) {
                        actualCategory = section;
                    }
                });

                if (!actualCategory) {
                    console.warn(`Category not found for key: ${categoryKey}`);
                    return;
                }

                const names = existingData[categoryKey]['name'] || [];
                const distances = existingData[categoryKey]['distance'] || [];

                names.forEach((name, index) => {
                    const distance = distances[index] || '';
                    createFieldGroup(actualCategory, name, distance);
                });
            });
        }

        // Call this after page load
        document.addEventListener('DOMContentLoaded', function () {
            const existingNearbyAreas = @json($hotel->nearby_areas);
            populateExistingNearbyAreas(existingNearbyAreas);
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('custom-checkin-wrapper');
            const addBtn = document.getElementById('add-checkin-rule');

            // Add new custom field
            addBtn.addEventListener('click', () => {
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

            // Delegate delete clicks
            wrapper.addEventListener('click', e => {
                if (e.target.classList.contains('remove-checkin')) {
                    e.target.closest('.form-group').remove();
                }
            });
        });
    </script>

@endsection
