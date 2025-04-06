@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Owners Details</h3>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form method="POST" action="{{ route('owners.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" required value="{{ old('name', $property->name ?? '') }}">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="phone_number">Phone Number</label>
                                                <input type="number" name="phone_number" class="form-control" id="phone_number" placeholder="Phone Number" value="{{ old('phone_number', $property->phone_number ?? '') }}">
                                                @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Select Ownership</label>
                                                <div class="radio-group col-md-12 col-lg-12 col-xxl-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="ownership_type" id="commercial" value="Commercial" {{ old('ownership_type', $property->ownership_type ?? '') === 'Commercial' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="commercial">Commercial</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="ownership_type" id="private" value="Private" {{ old('ownership_type', $property->ownership_type ?? '') === 'Private' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="private">Private</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="ownership_type" id="others" value="Others" {{ old('ownership_type', $property->ownership_type ?? '') === 'Others' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="others">Others</label>
                                                    </div>
                                                    @error('ownership_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="Ownership" id="additionalFields" style="display:{{ old('ownership_type', $property->ownership_type ?? '') === 'Commercial' ? 'block' : 'none' }};">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="trade_license">Trade License</label>
                                                        <input type="text" name="trade_license" class="form-control" id="trade_license" placeholder="Trade License" value="{{ old('trade_license', $property->trade_license ?? '') }}">
                                                        @error('trade_license')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="bin">BIN</label>
                                                        <input type="text" name="bin" class="form-control" id="bin" placeholder="BIN" value="{{ old('bin', $property->bin ?? '') }}">
                                                        @error('bin')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4 col-xxl-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="tin">TIN</label>
                                                        <input type="text" name="tin" class="form-control" id="tin" placeholder="TIN Number" value="{{ old('tin', $property->tin ?? '') }}">
                                                        @error('tin')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="nid_number">NID Number</label>
                                                <input type="number" name="nid_number" class="form-control" id="nid_number" placeholder="NID Number" value="{{ old('nid_number', $property->nid_number ?? '') }}">
                                                @error('nid_number')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="date_of_birth">Date of Birth</label>
                                                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="{{ old('date_of_birth', $property->date_of_birth ?? '') }}">
                                                @error('date_of_birth')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="passport_number">Passport Number</label>
                                                <input type="text" name="passport_number" class="form-control" id="passport_number" placeholder="Passport Number" value="{{ old('passport_number', $property->passport_number ?? '') }}">
                                                @error('passport_number')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="present_address">Present Address</label>
                                                <textarea name="present_address" class="form-control no-resize" id="present_address">{{ old('present_address', $property->present_address ?? '') }}</textarea>
                                                @error('present_address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="permanent_address">Permanent Address</label>
                                                <textarea name="permanent_address" class="form-control no-resize" id="permanent_address">{{ old('permanent_address', $property->permanent_address ?? '') }}</textarea>
                                                @error('permanent_address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Property Ownership</label>
                                                <select name="property_ownership" class="form-select js-select2" id="propertyOwnership" data-placeholder="Select multiple options">
                                                    <option value="">Select Property Ownership</option>
                                                    <option value="Proprietorship" {{ old('property_ownership', $property->property_ownership ?? '') === 'Proprietorship' ? 'selected' : '' }}>Proprietorship</option>
                                                    <option value="Partnership" {{ old('property_ownership', $property->property_ownership ?? '') === 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                                    <option value="Ltd" {{ old('property_ownership', $property->property_ownership ?? '') === 'Ltd' ? 'selected' : '' }}>Ltd</option>
                                                    <option value="NGO" {{ old('property_ownership', $property->property_ownership ?? '') === 'NGO' ? 'selected' : '' }}>NGO</option>
                                                    <option value="Leased" {{ old('property_ownership', $property->property_ownership ?? '') === 'Leased' ? 'selected' : '' }}>Leased</option>
                                                </select>
                                                @error('property_ownership')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3 partner-fields" style="display:{{ old('property_ownership', $property->property_ownership ?? '') === 'Partnership' ? 'block' : 'none' }};">
                                            <div class="form-group">
                                                <label class="form-label" for="partner_name">Business Partners Name</label>
                                                <input type="text" name="partner_name" class="form-control" id="partner_name" placeholder="Business Partners Name" value="{{ old('partner_name', $property->partner_name ?? '') }}">
                                                @error('partner_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3 partner-fields" style="display:{{ old('property_ownership', $property->property_ownership ?? '') === 'Partnership' ? 'block' : 'none' }};">
                                            <div class="form-group">
                                                <label class="form-label" for="partner_contact">Contact Number</label>
                                                <input type="tel" name="partner_contact" class="form-control" id="partner_contact" placeholder="Contact Number" value="{{ old('partner_contact', $property->partner_contact ?? '') }}">
                                                @error('partner_contact')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3 partner-fields" style="display:{{ old('property_ownership', $property->property_ownership ?? '') === 'Partnership' ? 'block' : 'none' }};">
                                            <div class="form-group">
                                                <label class="form-label" for="partner_details">Contacts Details</label>
                                                <textarea name="partner_details" class="form-control no-resize" id="partner_details" rows="3">{{ old('partner_details', $property->partner_details ?? '') }}</textarea>
                                                @error('partner_details')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3 lease-dates" style="display:{{ old('property_ownership', $property->property_ownership ?? '') === 'Leased' ? 'block' : 'none' }};">
                                            <div class="form-group">
                                                <label class="form-label" for="lease_start_date">Lease Start Date</label>
                                                <input type="date" name="lease_start_date" class="form-control" id="lease_start_date" value="{{ old('lease_start_date', $property->lease_start_date ?? '') }}">
                                                @error('lease_start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3 lease-dates" style="display:{{ old('property_ownership', $property->property_ownership ?? '') === 'Leased' ? 'block' : 'none' }};">
                                            <div class="form-group">
                                                <label class="form-label" for="lease_end_date">Lease End Date</label>
                                                <input type="date" name="lease_end_date" class="form-control" id="lease_end_date" value="{{ old('lease_end_date', $property->lease_end_date ?? '') }}">
                                                @error('lease_end_date')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="facebook_link">Facebook Page link (Hotels Page) If any</label>
                                                <input type="text" name="facebook_link" class="form-control" id="facebook_link" placeholder="Page link" value="{{ old('facebook_link', $property->facebook_link ?? '') }}">
                                                @error('facebook_link')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="website_link">Website Link (Hotels website) if any</label>
                                                <input type="text" name="website_link" class="form-control" id="website_link" placeholder="Website Link" value="{{ old('website_link', $property->website_link ?? '') }}">
                                                @error('website_link')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-lg-4 col-xxl-3">
                                                <div class="form-group mt-15">
                                                    <label class="form-label">Upload NID Front Copy</label>
                                                    <div class="single-upload-container">
                                                        <input type="file" name="nid_front_image" id="single-file-input-front" accept="image/*">
                                                        <label for="single-file-input-front" class="upload-label">Select NID Front Copy</label>
                                                        <div class="single-thumbnail-preview" id="single-thumbnail-preview-front">
                                                            @if($property && $property->nid_front_image)
                                                                <img src="{{ asset('storage/' . $property->nid_front_image) }}" alt="NID Front" style="max-width: 100%;">
                                                            @else
                                                                <span class="single-placeholder">No image selected</span>
                                                            @endif
                                                        </div>
                                                        @error('nid_front_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-lg-4 col-xxl-3">
                                                <div class="form-group mt-15">
                                                    <label class="form-label">Upload NID Back Side Copy</label>
                                                    <div class="single-upload-container">
                                                        <input type="file" name="nid_back_image" id="single-file-input-back" accept="image/*">
                                                        <label for="single-file-input-back" class="upload-label">Select NID Back Side</label>
                                                        <div class="single-thumbnail-preview" id="single-thumbnail-preview-back">
                                                            @if($property && $property->nid_back_image)
                                                                <img src="{{ asset('storage/' . $property->nid_back_image) }}" alt="NID Back" style="max-width: 100%;">
                                                            @else
                                                                <span class="single-placeholder">No image selected</span>
                                                            @endif
                                                        </div>
                                                        @error('nid_back_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-md-2 mt-15">
                                            <div class="form-group">
                                                <button type="submit" name="action" value="submitted" class="btn btn-primary btn-submit">Submit</button>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-md-2 mt-15">
                                            <div class="form-group">
                                                <button type="submit" name="action" value="draft" class="btn btn-primary">Save & Drafts</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Add JavaScript to handle dynamic field visibility if needed
                        document.querySelectorAll('input[name="ownership_type"]').forEach(input => {
                            input.addEventListener('change', function() {
                                document.getElementById('additionalFields').style.display = this.value === 'Commercial' ? 'block' : 'none';
                            });
                        });

                        document.getElementById('propertyOwnership').addEventListener('change', function() {
                            const partnerFields = document.querySelectorAll('.partner-fields');
                            const leaseDates = document.querySelectorAll('.lease-dates');
                            partnerFields.forEach(field => field.style.display = this.value === 'Partnership' ? 'block' : 'none');
                            leaseDates.forEach(field => field.style.display = this.value === 'Leased' ? 'block' : 'none');
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const singleFileInputFront = document.getElementById('single-file-input-front');
            const singleThumbnailPreviewFront = document.getElementById('single-thumbnail-preview-front');
            const singleFileInputBack = document.getElementById('single-file-input-back');
            const singleThumbnailPreviewBack = document.getElementById('single-thumbnail-preview-back');

            singleFileInputFront.addEventListener('change', (event) => handleSingleFileUpload(event, singleThumbnailPreviewFront, singleFileInputFront));
            singleFileInputBack.addEventListener('change', (event) => handleSingleFileUpload(event, singleThumbnailPreviewBack, singleFileInputBack));

            function handleSingleFileUpload(event, previewElement, inputElement) {
                const file = event.target.files[0];
                previewElement.innerHTML = '';

                if (!file || !file.type.startsWith('image/')) {
                    previewElement.innerHTML = '<span class="single-placeholder">Invalid image</span>';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';

                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '×';
                    removeBtn.classList.add('single-remove-btn');
                    removeBtn.addEventListener('click', () => {
                        previewElement.innerHTML = '<span class="single-placeholder">No image selected</span>';
                        inputElement.value = '';
                    });

                    previewElement.appendChild(img);
                    previewElement.appendChild(removeBtn);
                };
                reader.readAsDataURL(file);
            }

            const radioButtons = document.querySelectorAll('input[name="ownership_type"]');
            const additionalFields = document.getElementById('additionalFields');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    additionalFields.style.display = this.value === 'Commercial' ? 'block' : 'none';
                });
            });

            $('.js-select2').select2();
            $('#propertyOwnership').on('change', function() {
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
@endsection
