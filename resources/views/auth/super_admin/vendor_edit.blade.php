@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Vendor</h3>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('super-admin.vendor.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row gy-4">
                                        <!-- Hotel Name -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="property_type" class="form-label">Property Type</label>
                                                <select name="property_type" class="form-control">
                                                    <option {{ $vendor->property_type == 'Hotels' ? 'selected' : '' }}>Hotels</option>
                                                    <option {{ $vendor->property_type == 'Transit' ? 'selected' : '' }}>Transit</option>
                                                    <option {{ $vendor->property_type == 'Resorts' ? 'selected' : '' }}>Resorts</option>
                                                    <option {{ $vendor->property_type == 'Lodges' ? 'selected' : '' }}>Lodges</option>
                                                    <option {{ $vendor->property_type == 'Guesthouses' ? 'selected' : '' }}>Guesthouses</option>
                                                    <option {{ $vendor->property_type == 'Crisis' ? 'selected' : '' }}>Crisis</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="hotel_name" class="form-label">Hotel Name</label>
                                                <input type="text" class="form-control" id="hotel_name" name="hotel_name" value="{{ old('hotel_name', $vendor->hotel_name) }}" required>
                                            </div>
                                        </div>

                                        <!-- Contact Person Name -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="contact_person_name" class="form-label">Contact Person Name</label>
                                                <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" value="{{ old('contact_person_name', $vendor->contact_person_name) }}" required>
                                            </div>
                                        </div>

                                        <!-- Contact Person Date of Birth -->
{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="contact_person_dob" class="form-label">Contact Person Date of Birth</label>--}}
{{--                                                <input type="date" class="form-control" id="contact_person_dob" name="contact_person_dob" value="{{ old('contact_person_dob', $vendor->contact_person_dob) }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <!-- Contact Person Designation -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="contact_person_designation" class="form-label">Contact Person Designation</label>
                                                <input type="text" class="form-control" id="contact_person_designation" name="contact_person_designation" value="{{ old('contact_person_designation', $vendor->contact_person_designation) }}">
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $vendor->phone) }}" required>
                                            </div>
                                        </div>

                                        <!-- Email Address -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $vendor->email) }}" required>
                                            </div>
                                        </div>

                                        <!-- Address Fields -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_house" class="form-label">Property/Hotel Address</label>
                                                <input type="text" class="form-control" id="address_house" name="address_house" value="{{ old('address_house', $vendor->address_house) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="address_city" name="address_city" value="{{ old('address_city', $vendor->address_city) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_district" class="form-label">District</label>
                                                <select class="form-control" id="address_district" name="address_district">
                                                    <option value="">-- Select District --</option>
                                                    @php
                                                        $districts = [
                                                            'Bagerhat', 'Bandarban', 'Barguna', 'Barisal', 'Bhola', 'Bogra', 'Brahmanbaria',
                                                            'Chandpur', 'Chapai Nawabganj', 'Chattogram', 'Chuadanga', 'Comilla', "Cox's Bazar",
                                                            'Dhaka', 'Dinajpur', 'Faridpur', 'Feni', 'Gaibandha', 'Gazipur', 'Gopalganj',
                                                            'Habiganj', 'Jamalpur', 'Jashore', 'Jhalokathi', 'Jhenaidah', 'Joypurhat',
                                                            'Khagrachhari', 'Khulna', 'Kishoreganj', 'Kurigram', 'Kushtia', 'Lakshmipur',
                                                            'Lalmonirhat', 'Madaripur', 'Magura', 'Manikganj', 'Meherpur', 'Moulvibazar',
                                                            'Munshiganj', 'Mymensingh', 'Naogaon', 'Narail', 'Narayanganj', 'Narsingdi',
                                                            'Natore', 'Netrokona', 'Nilphamari', 'Noakhali', 'Pabna', 'Panchagarh',
                                                            'Patuakhali', 'Pirojpur', 'Rajbari', 'Rajshahi', 'Rangamati', 'Rangpur',
                                                            'Satkhira', 'Shariatpur', 'Sherpur', 'Sirajganj', 'Sunamganj', 'Sylhet',
                                                            'Tangail', 'Thakurgaon'
                                                        ];
                                                        $selectedDistrict = old('address_district', $vendor->address_district ?? '');
                                                    @endphp
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district }}" {{ $selectedDistrict == $district ? 'selected' : '' }}>
                                                            {{ $district }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="address_area" class="form-label">Area</label>--}}
{{--                                                <input type="text" class="form-control" id="address_area" name="address_area" value="{{ old('address_area', $vendor->address_area) }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_landmark" class="form-label">Landmark</label>
                                                <input type="text" class="form-control" id="address_landmark" name="address_landmark" value="{{ old('address_landmark', $vendor->address_landmark) }}">
                                            </div>
                                        </div>

                                        <!-- File Uploads -->
{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="profile-picture">Profile Picture</label>--}}
{{--                                                <input type="file" class="form-control" id="profile-picture" name="profile_picture">--}}
{{--                                                @if($vendor->profile_picture)--}}
{{--                                                    <small>Current: <a href="{{ Storage::url($vendor->profile_picture) }}" target="_blank">View Image</a></small>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="logo">Hotel Logo</label>
                                                <input type="file" class="form-control" id="logo" name="logo">
                                                @if($vendor->logo)
                                                    <small>Current: <a href="{{ asset('/') }}{{ $vendor->logo }}" target="_blank">View Image</a></small>
                                                @endif
                                            </div>
                                        </div>

{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="hotel-pictures">Hotel Pictures (Multiple Images)</label>--}}
{{--                                                <input type="file" class="form-control" id="hotel-pictures" name="hotel_pictures[]" multiple>--}}
{{--                                                @if($vendor->hotel_pictures)--}}
{{--                                                    <small>Current:--}}
{{--                                                        @foreach(json_decode($vendor->hotel_pictures, true) as $picture)--}}
{{--                                                            <a href="{{ Storage::url($picture) }}" target="_blank">View Image</a>--}}
{{--                                                        @endforeach--}}
{{--                                                    </small>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="bank-check-picture">Bank Check Picture</label>--}}
{{--                                                <input type="file" class="form-control" id="bank-check-picture" name="bank_check_picture">--}}
{{--                                                @if($vendor->bank_check_picture)--}}
{{--                                                    <small>Current: <a href="{{ Storage::url($vendor->bank_check_picture) }}" target="_blank">View Image</a></small>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <!-- Additional Information -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="nid">NID</label>
                                                <input type="text" class="form-control" id="nid" name="nid" value="{{ old('nid', $vendor->nid) }}" placeholder="NID">
                                            </div>
                                        </div>

{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="trade_license_bin_tin">Trade License / BIN / TIN</label>--}}
{{--                                                <input type="text" class="form-control" id="trade_license_bin_tin" name="trade_license_bin_tin" value="{{ old('trade_license_bin_tin', $vendor->trade_license_bin_tin) }}" placeholder="Trade License / BIN / TIN">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="bank_details">Bank Details</label>--}}
{{--                                                <input type="text" class="form-control" id="bank_details" name="bank_details" value="{{ old('bank_details', $vendor->bank_details) }}" placeholder="Bank Details">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password (Leave blank to keep current)</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password must be 8 Characters Minimum">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Update</button>
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
@endsection

