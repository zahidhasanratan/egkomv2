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
                                                    <option>Hotels</option>
                                                    <option>Transit</option>
                                                    <option>Resorts</option>
                                                    <option>Lodges</option>
                                                    <option>Guesthouses</option>
                                                    <option>Crisis</option>
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
{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="contact_person_dob" class="form-label">Contact Person Date of Birth</label>--}}
{{--                                                <input type="date" class="form-control" id="contact_person_dob" name="contact_person_dob">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

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
                                                <label for="address_house" class="form-label">Property/Hotel Address</label>
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
                                                <select class="form-control" id="address_district" name="address_district">
                                                    <option value="">-- Select District --</option>
                                                    <option value="Bagerhat">Bagerhat</option>
                                                    <option value="Bandarban">Bandarban</option>
                                                    <option value="Barguna">Barguna</option>
                                                    <option value="Barisal">Barisal</option>
                                                    <option value="Bhola">Bhola</option>
                                                    <option value="Bogra">Bogra</option>
                                                    <option value="Brahmanbaria">Brahmanbaria</option>
                                                    <option value="Chandpur">Chandpur</option>
                                                    <option value="Chapai Nawabganj">Chapai Nawabganj</option>
                                                    <option value="Chattogram">Chattogram</option>
                                                    <option value="Chuadanga">Chuadanga</option>
                                                    <option value="Comilla">Comilla</option>
                                                    <option value="Cox's Bazar">Cox's Bazar</option>
                                                    <option value="Dhaka">Dhaka</option>
                                                    <option value="Dinajpur">Dinajpur</option>
                                                    <option value="Faridpur">Faridpur</option>
                                                    <option value="Feni">Feni</option>
                                                    <option value="Gaibandha">Gaibandha</option>
                                                    <option value="Gazipur">Gazipur</option>
                                                    <option value="Gopalganj">Gopalganj</option>
                                                    <option value="Habiganj">Habiganj</option>
                                                    <option value="Jamalpur">Jamalpur</option>
                                                    <option value="Jashore">Jashore</option>
                                                    <option value="Jhalokathi">Jhalokathi</option>
                                                    <option value="Jhenaidah">Jhenaidah</option>
                                                    <option value="Joypurhat">Joypurhat</option>
                                                    <option value="Khagrachhari">Khagrachhari</option>
                                                    <option value="Khulna">Khulna</option>
                                                    <option value="Kishoreganj">Kishoreganj</option>
                                                    <option value="Kurigram">Kurigram</option>
                                                    <option value="Kushtia">Kushtia</option>
                                                    <option value="Lakshmipur">Lakshmipur</option>
                                                    <option value="Lalmonirhat">Lalmonirhat</option>
                                                    <option value="Madaripur">Madaripur</option>
                                                    <option value="Magura">Magura</option>
                                                    <option value="Manikganj">Manikganj</option>
                                                    <option value="Meherpur">Meherpur</option>
                                                    <option value="Moulvibazar">Moulvibazar</option>
                                                    <option value="Munshiganj">Munshiganj</option>
                                                    <option value="Mymensingh">Mymensingh</option>
                                                    <option value="Naogaon">Naogaon</option>
                                                    <option value="Narail">Narail</option>
                                                    <option value="Narayanganj">Narayanganj</option>
                                                    <option value="Narsingdi">Narsingdi</option>
                                                    <option value="Natore">Natore</option>
                                                    <option value="Netrokona">Netrokona</option>
                                                    <option value="Nilphamari">Nilphamari</option>
                                                    <option value="Noakhali">Noakhali</option>
                                                    <option value="Pabna">Pabna</option>
                                                    <option value="Panchagarh">Panchagarh</option>
                                                    <option value="Patuakhali">Patuakhali</option>
                                                    <option value="Pirojpur">Pirojpur</option>
                                                    <option value="Rajbari">Rajbari</option>
                                                    <option value="Rajshahi">Rajshahi</option>
                                                    <option value="Rangamati">Rangamati</option>
                                                    <option value="Rangpur">Rangpur</option>
                                                    <option value="Satkhira">Satkhira</option>
                                                    <option value="Shariatpur">Shariatpur</option>
                                                    <option value="Sherpur">Sherpur</option>
                                                    <option value="Sirajganj">Sirajganj</option>
                                                    <option value="Sunamganj">Sunamganj</option>
                                                    <option value="Sylhet">Sylhet</option>
                                                    <option value="Tangail">Tangail</option>
                                                    <option value="Thakurgaon">Thakurgaon</option>
                                                </select>
                                            </div>
                                        </div>


{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="address_area" class="form-label">Area</label>--}}
{{--                                                <input type="text" class="form-control" id="address_area" name="address_area">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="address_landmark" class="form-label">Landmark</label>
                                                <input type="text" class="form-control" id="address_landmark" name="address_landmark">
                                            </div>
                                        </div>



                                        <!-- File Uploads -->
{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="profile-picture">Profile Picture</label>--}}
{{--                                                <input type="file" class="form-control" id="profile-picture" name="profile_picture">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="logo">Hotel Logo</label>
                                                <input type="file" class="form-control" id="logo" name="logo">
                                            </div>
                                        </div>

{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="hotel-pictures">Hotel Pictures (Multiple Images)</label>--}}
{{--                                                <input type="file" class="form-control" id="hotel-pictures" name="hotel_pictures[]" multiple>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="bank-check-picture">Bank Check Picture</label>--}}
{{--                                                <input type="file" class="form-control" id="bank-check-picture" name="bank_check_picture">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <!-- Additional Information -->
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label" for="nid">NID</label>
                                                <input type="text" class="form-control" id="nid" name="nid" placeholder="NID">
                                            </div>
                                        </div>

{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="trade_license_bin_tin">Trade License / BIN / TIN</label>--}}
{{--                                                <input type="text" class="form-control" id="trade_license_bin_tin" name="trade_license_bin_tin" placeholder="Trade License / BIN / TIN">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6 col-lg-4 col-xxl-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label" for="bank_details">Bank Details</label>--}}
{{--                                                <input type="text" class="form-control" id="bank_details" name="bank_details" placeholder="Bank Details">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password <span style="font-size: 11px;color:red">(Password must be 8 Characters Minimum)</span></label>
                                                <input type="password" class="form-control" id="password" name="password" required placeholder="Password must be 8 Characters Minimum">
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
