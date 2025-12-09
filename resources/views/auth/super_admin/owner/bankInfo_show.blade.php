@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Banking Information - Preview</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super.owners.bankInfo', $banking->vendor_id ?? '') }}" class="btn btn-primary">
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
                                    $getValue = function($key, $default = 'N/A') use ($banking) {
                                        if (!$banking) return $default;
                                        $value = $banking->$key ?? null;
                                        if ($value === null || $value === '') return $default;
                                        return $value;
                                    };
                                @endphp

                                <div class="row gy-4">
                                    <div class="col-lg-4">
                                        <div class="bank-all-info">
                                            <h3 class="pay-method-title">Payment Method</h3>
                                            <div class="form-control-plaintext mt-3">
                                                <strong>{{ $getValue('payment_method', 'Not Selected') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($banking && $banking->payment_method === 'Bank')
                                    <div class="row gy-4 mt-3">
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Account Number</label>
                                                <div class="form-control-plaintext">{{ $getValue('account_number') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Bank Name</label>
                                                <div class="form-control-plaintext">{{ $getValue('bank_name') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Routing Number</label>
                                                <div class="form-control-plaintext">{{ $getValue('routing_number') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Account Type</label>
                                                <div class="form-control-plaintext">{{ $getValue('account_type') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Picture of the Bank Cheque</label>
                                                @if($banking && $banking->bank_cheque_image)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $banking->bank_cheque_image) }}" alt="Bank Cheque" style="max-width: 200px;">
                                                    </div>
                                                @else
                                                    <div class="form-control-plaintext">N/A</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($banking && $banking->payment_method === 'Mobile Banking')
                                    <div class="row gy-4 mt-3">
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Bakshe Number</label>
                                                <div class="form-control-plaintext">{{ $getValue('bakshe_number') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Nagad Number</label>
                                                <div class="form-control-plaintext">{{ $getValue('nagad_number') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xxl-3">
                                            <div class="form-group">
                                                <label class="form-label">Dutch Bangla Mobile Banking Number</label>
                                                <div class="form-control-plaintext">{{ $getValue('dutch_bangla_number') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-3">
                                    <a href="{{ route('super-admin.vendor.index') }}" class="btn btn-secondary">Back to List</a>
                                    <a href="{{ route('super.owners.bankInfo', $banking->vendor_id ?? '') }}" class="btn btn-primary">
                                        <em class="icon ni ni-edit"></em> Edit Banking Info
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

