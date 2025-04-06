@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Add Vendor</h3>
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
                        <form action="{{ route('super-admin.vendor.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row gy-4">
                                        <!-- Hotel Name -->

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="property_type" class="form-label">Property Type</label>
                                                <select name="property_type" class="form-control">
                                                    <option>5 Star</option>
                                                    <option>3 Star</option>
                                                    <option>7 Star</option>
                                                    <option>Star</option>
                                                    <option>Boutique</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="hotel_name" class="form-label">Hotel Name</label>
                                                <input type="text" class="form-control" id="hotel_name" name="hotel_name" required>
                                            </div>
                                        </div>

                                        <!-- Contact Person Name -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="contact_person_name" class="form-label">Contact Person Name</label>
                                                <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" required>
                                            </div>
                                        </div>

                                        <!-- Contact Person Date of Birth -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="contact_person_dob" class="form-label">Contact Person Date of Birth</label>
                                                <input type="date" class="form-control" id="contact_person_dob" name="contact_person_dob">
                                            </div>
                                        </div>

                                        <!-- Contact Person Designation -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="contact_person_designation" class="form-label">Contact Person Designation</label>
                                                <input type="text" class="form-control" id="contact_person_designation" name="contact_person_designation">
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" required>
                                            </div>
                                        </div>

                                        <!-- Email Address -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                        </div>

                                        <!-- Address Fields -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_house" class="form-label">House Address</label>
                                                <input type="text" class="form-control" id="address_house" name="address_house">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="address_city" name="address_city">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_district" class="form-label">District</label>
                                                <input type="text" class="form-control" id="address_district" name="address_district">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_area" class="form-label">Area</label>
                                                <input type="text" class="form-control" id="address_area" name="address_area">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_landmark" class="form-label">Landmark</label>
                                                <input type="text" class="form-control" id="address_landmark" name="address_landmark">
                                            </div>
                                        </div>



                                        <!-- File Uploads -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="profile-picture">Profile Picture</label>
                                                <input type="file" class="form-control" id="profile-picture" name="profile_picture">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="logo">Hotel Logo</label>
                                                <input type="file" class="form-control" id="logo" name="logo">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="hotel-pictures">Hotel Pictures (Multiple Images)</label>
                                                <input type="file" class="form-control" id="hotel-pictures" name="hotel_pictures[]" multiple>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="bank-check-picture">Bank Check Picture</label>
                                                <input type="file" class="form-control" id="bank-check-picture" name="bank_check_picture">
                                            </div>
                                        </div>

                                        <!-- Additional Information -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="nid">NID</label>
                                                <input type="text" class="form-control" id="nid" name="nid" placeholder="NID">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="trade_license_bin_tin">Trade License / BIN / TIN</label>
                                                <input type="text" class="form-control" id="trade_license_bin_tin" name="trade_license_bin_tin" placeholder="Trade License / BIN / TIN">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="bank_details">Bank Details</label>
                                                <input type="text" class="form-control" id="bank_details" name="bank_details" placeholder="Bank Details">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
