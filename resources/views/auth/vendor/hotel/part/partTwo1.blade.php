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

                                    <li class="nav-item active">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Facilities of Hotel /
                                            Property</a>
                                    </li>

                                </ul>
                                @if (session('success'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('vendor-admin.hotel.update', $hotel->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="tab-content">
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
                                        <div class="tab-pane active" id="tabItem4">
                                            <div class="row mt-15">
                                                <div class="checkbox-section">
                                                    <h3 class="can-tittle">Most Popular Facilities</h3>

                                                    <!-- Select All Toggle -->
                                                    <div class="chk-all-sec">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox"
                                                                       class="custom-control-input"
                                                                       id="facilities-all"
                                                                    {{-- you can add JS to toggle all below --}}
                                                                    {{ count(array_intersect([
                                                                       'Free Wi-Fi','Hill View Or Sea View','On-site restaurant',
                                                                       'Buffet Breakfast','Bar/lounge','Private Pool',
                                                                       'Fitness center & Spa services','24-hour reception',
                                                                       'Parking facilities','Airport shuttle service'
                                                                    ], $savedFacilities)) === 10 ? 'checked' : '' }}>
{{--                                                                <label class="custom-control-label"--}}
{{--                                                                       for="facilities-all">--}}
{{--                                                                    Select All--}}
{{--                                                                </label>--}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Predefined checkboxes -->
                                                    <div class="all-facilities-list">
                                                        @foreach([
                                                          'Free Wi-Fi'                    => 'facility-wifi',
                                                          'Hill View Or Sea View'         => 'facility-view',
                                                          'On-site restaurant'            => 'facility-restaurant',
                                                          'Buffet Breakfast'              => 'facility-breakfast',
                                                          'Bar/lounge'                    => 'facility-bar',
                                                          'Private Pool'                  => 'facility-pool',
                                                          'Fitness center & Spa services' => 'facility-fitness',
                                                          '24-hour reception'             => 'facility-reception',
                                                          'Parking facilities'            => 'facility-parking',
                                                          'Airport shuttle service'       => 'facility-shuttle',
                                                        ] as $label => $id)
                                                            <div>
                                                                <input type="checkbox"
                                                                       name="facilities[]"
                                                                       value="{{ $label }}"
                                                                       class="checkbox-item-facility"
                                                                       id="{{ $id }}"
                                                                    {{ in_array($label, $savedFacilities) ? 'checked' : '' }}>
                                                                <label for="{{ $id }}">
              <span>
                <img class="fac-img" src="{{ asset('../images/icons/mountain.png') }}">
              </span>
                                                                    {{ $label }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <!-- Custom facilities from previous saves -->

                                                    <!-- put this somewhere above your loop, inside the form -->
                                                    <!-- track which existing icons we remove -->
                                                    <input
                                                        type="hidden"
                                                        name="removed_custom_facilities_icon"
                                                        id="removed_custom_facilities_icon"
                                                        value="{{ old('removed_custom_facilities_icon','') }}">

                                                    <div id="facility-container">
                                                        @php
                                                            // decode JSON into array once
                                                            $icons = is_array($hotel->custom_facilities_icon)
                                                                     ? $hotel->custom_facilities_icon
                                                                     : ( json_decode($hotel->custom_facilities_icon,true) ?: [] );
                                                        @endphp

                                                        @foreach($customFacilities as $i => $facility)
                                                            <div class="input-field d-flex align-items-center mb-3"
                                                                 style="gap:10px;">
                                                                <!-- Facility Name -->
                                                                <div class="form-group flex-grow-1">
                                                                    <label for="custom_facility_{{ $i }}">Facility
                                                                        Name</label>
                                                                    <input
                                                                        type="text"
                                                                        name="custom_facilities[]"
                                                                        id="custom_facility_{{ $i }}"
                                                                        class="form-control"
                                                                        value="{{ old("custom_facilities.{$i}", $facility) }}"
                                                                        placeholder="Enter facility name">
                                                                </div>

                                                                <!-- Facility Icon -->
                                                                <div class="form-group">
                                                                    <label for="custom_facility_icon_{{ $i }}">Facility
                                                                        Icon</label>
                                                                    <div class="multiple-upload-container"
                                                                         id="upload-container-dynamic-{{ $i }}">
                                                                        @if(isset($icons[$i]))
                                                                            <div class="multiple-thumbnail-item">
                                                                                <img
                                                                                    src="{{ asset('storage/'.$icons[$i]) }}"
                                                                                    alt="Icon">
                                                                                <button
                                                                                    type="button"
                                                                                    class="multiple-remove-btn"
                                                                                    data-index="{{ $i }}"
                                                                                    data-field="custom_facilities_icon">
                                                                                    ×
                                                                                </button>
                                                                            </div>
                                                                        @endif

                                                                        <input
                                                                            type="file"
                                                                            name="custom_facilities_icon[]"
                                                                            id="custom_facility_icon_{{ $i }}"
                                                                            class="form-control multiple-file-input"
                                                                            accept="image/*">
                                                                        <label class="upload-label">Browse Image</label>
                                                                        <div class="multiple-thumbnail-gallery"></div>
                                                                    </div>
                                                                    @error("custom_facilities_icon.{$i}")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>


                                                                <button type="button"
                                                                        class="btn btn-danger btn-sm delete-btn">Delete
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <script>
                                                        document.addEventListener('click', function (e) {
                                                            // if the clicked element has class "delete-btn"...
                                                            if (!e.target.classList.contains('delete-btn')) return;

                                                            // find the nearest wrapper for the entire row
                                                            const row = e.target.closest('.input-field');
                                                            if (row) row.remove();
                                                        });
                                                    </script>

                                                    <script>
                                                        document.addEventListener('click', function (e) {
                                                            if (!e.target.classList.contains('multiple-remove-btn')) return;
                                                            const btn = e.target;
                                                            const idx = btn.dataset.index;
                                                            const field = btn.dataset.field; // e.g. "custom_facilities_icon"
                                                            const hidden = document.getElementById(`removed_${field}`);
                                                            let list = hidden.value ? hidden.value.split(',') : [];
                                                            if (!list.includes(idx)) list.push(idx);
                                                            hidden.value = list.join(',');
                                                            // remove thumbnail
                                                            btn.closest('.multiple-thumbnail-item').remove();
                                                        });
                                                    </script>


                                                    <!-- track which existing icons we remove -->
                                                    <input
                                                        type="hidden"
                                                        name="removed_custom_facilities_icon"
                                                        id="removed_custom_facilities_icon"
                                                        value="{{ old('removed_custom_facilities_icon','') }}">

                                                    <button type="button"
                                                            class="add-rule-btn btn add-button"
                                                            id="add-more-btn">
                                                        Add More +
                                                    </button>

                                                    @error('facilities')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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

                                                <!-- Save / Submit Buttons -->
                                                <div class="row">
                                                    <div class="col-sm-2 col-md-2 mt-15">
                                                        <button type="submit"
                                                                name="status"
                                                                value="submitted"
                                                                class="btn btn-primary btn-submit">
                                                            Submit
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 mt-15">
                                                        <button type="submit"
                                                                name="status"
                                                                value="draft"
                                                                class="btn btn-primary">
                                                            Save & Drafts
                                                        </button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>


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
