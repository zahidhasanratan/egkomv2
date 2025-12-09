@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Owners Details - Preview</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super.vendor-admin.owner.details', $property->vendor_id ?? '') }}" class="btn btn-primary">
                                    <em class="icon ni ni-edit"></em> Edit
                                </a>
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
                                @php
                                    $getValue = function($key, $default = 'N/A') use ($property) {
                                        if (!$property) return $default;
                                        $value = $property->$key ?? null;
                                        if ($value === null || $value === '') return $default;
                                        return $value;
                                    };
                                @endphp

                                <div class="row gy-4">
                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <div class="form-control-plaintext">{{ $getValue('name') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <div class="form-control-plaintext">{{ $getValue('phone_number') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Ownership Type</label>
                                            <div class="form-control-plaintext">{{ $getValue('ownership_type') }}</div>
                                        </div>
                                    </div>

                                    @if($property && $property->ownership_type === 'Commercial')
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Trade License</label>
                                                <div class="form-control-plaintext">{{ $getValue('trade_license') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">BIN</label>
                                                <div class="form-control-plaintext">{{ $getValue('bin') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">TIN</label>
                                                <div class="form-control-plaintext">{{ $getValue('tin') }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">NID Number</label>
                                            <div class="form-control-plaintext">{{ $getValue('nid_number') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Date of Birth</label>
                                            <div class="form-control-plaintext">{{ $getValue('date_of_birth') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Passport Number</label>
                                            <div class="form-control-plaintext">{{ $getValue('passport_number') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Present Address</label>
                                            <div class="form-control-plaintext">{{ $getValue('present_address') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Permanent Address</label>
                                            <div class="form-control-plaintext">{{ $getValue('permanent_address') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Property Ownership</label>
                                            <div class="form-control-plaintext">{{ $getValue('property_ownership') }}</div>
                                        </div>
                                    </div>

                                    @if($property && $property->property_ownership === 'Partnership')
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Business Partners Name</label>
                                                <div class="form-control-plaintext">{{ $getValue('partner_name') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Contact Number</label>
                                                <div class="form-control-plaintext">{{ $getValue('partner_contact') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Contacts Details</label>
                                                <div class="form-control-plaintext">{{ $getValue('partner_details') }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($property && $property->property_ownership === 'Leased')
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Lease Start Date</label>
                                                <div class="form-control-plaintext">{{ $getValue('lease_start_date') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Lease End Date</label>
                                                <div class="form-control-plaintext">{{ $getValue('lease_end_date') }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Facebook Page link (Hotels Page) If any</label>
                                            <div class="form-control-plaintext">{{ $getValue('facebook_link') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">Website Link (Hotels website) if any</label>
                                            <div class="form-control-plaintext">{{ $getValue('website_link') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">NID Front Copy</label>
                                            @if($property && $property->nid_front_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $property->nid_front_image) }}" alt="NID Front" style="max-width: 200px;">
                                                </div>
                                            @else
                                                <div class="form-control-plaintext">N/A</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">NID Back Side Copy</label>
                                            @if($property && $property->nid_back_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $property->nid_back_image) }}" alt="NID Back" style="max-width: 200px;">
                                                </div>
                                            @else
                                                <div class="form-control-plaintext">N/A</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('super-admin.vendor.index') }}" class="btn btn-secondary">Back to List</a>
                                    <a href="{{ route('super.vendor-admin.owner.details', $property->vendor_id ?? '') }}" class="btn btn-primary">
                                        <em class="icon ni ni-edit"></em> Edit Owner Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

