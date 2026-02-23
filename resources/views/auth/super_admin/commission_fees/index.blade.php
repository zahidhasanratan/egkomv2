@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Commission & Platform Fees</h3>
                                <p class="text-muted mb-0">Set commission from vendors, platform fee, tax, and platform discount. These apply at checkout.</p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mb-4">
                        <strong>How platform profit is calculated</strong><br>
                        For each <strong>paid</strong> booking, the platform earns: <strong>Commission</strong> (from vendor, added to guest price) + <strong>Platform Fee</strong> (flat amount). Tax collected is not counted as platform profit (it is typically remitted). You can see total Platform Profit on the Dashboard.
                    </div>

                    <div class="nk-block">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('super-admin.commission-fees.update') }}" method="POST" id="commission-fees-form">
                            @csrf
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h5 class="mb-3">Vendor Commission</h5>
                                    <p class="text-muted small">Commission is charged from vendors and added on top of the room price (e.g. vendor price BDT 5,000 + 10% = BDT 5,500 to customer).</p>
                                    <div class="row gy-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="commission_percentage">Commission (%)</label>
                                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="commission_percentage" name="commission_percentage"
                                                   value="{{ old('commission_percentage', $settings->commission_percentage ?? 0) }}" placeholder="e.g. 10">
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <h5 class="mb-3">Platform Fee & Tax</h5>
                                    <p class="text-muted small">Flat platform fee and percentage-based tax (when enabled) are added at checkout.</p>
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="platform_fee_enabled" name="platform_fee_enabled" value="1"
                                                       {{ old('platform_fee_enabled', $settings->platform_fee_enabled ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="platform_fee_enabled">Enable Platform Fee (flat rate)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="platform_fee_amount">Platform Fee Amount (BDT)</label>
                                            <input type="number" step="0.01" min="0" class="form-control" id="platform_fee_amount" name="platform_fee_amount"
                                                   value="{{ old('platform_fee_amount', $settings->platform_fee_amount ?? 0) }}">
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="tax_enabled" name="tax_enabled" value="1"
                                                       {{ old('tax_enabled', $settings->tax_enabled ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tax_enabled">Enable Tax (percentage)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="tax_percentage">Tax (%)</label>
                                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="tax_percentage" name="tax_percentage"
                                                   value="{{ old('tax_percentage', $settings->tax_percentage ?? 0) }}">
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <h5 class="mb-3">Platform Discount</h5>
                                    <p class="text-muted small">A percentage discount set by Super Admin. Apply to all hotels or selected hotels only (similar to coupon).</p>
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="platform_discount_enabled" name="platform_discount_enabled" value="1"
                                                       {{ old('platform_discount_enabled', $settings->platform_discount_enabled ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="platform_discount_enabled">Enable Platform Discount</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="platform_discount_percentage">Discount (%)</label>
                                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="platform_discount_percentage" name="platform_discount_percentage"
                                                   value="{{ old('platform_discount_percentage', $settings->platform_discount_percentage ?? 0) }}">
                                        </div>
                                        <div class="col-12 mt-3 pt-3" style="border-top: 1px solid #e5e9f2;">
                                            <div class="form-check form-switch mb-2">
                                                <input type="checkbox" class="form-check-input" id="platform_discount_apply_to_all_hotels" name="platform_discount_apply_to_all_hotels" value="1"
                                                       {{ old('platform_discount_apply_to_all_hotels', $settings->platform_discount_apply_to_all_hotels ?? true) ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="platform_discount_apply_to_all_hotels">Apply to all hotels</label>
                                            </div>
                                            <small class="text-muted d-block mb-2">When OFF: select specific hotels below.</small>
                                            <div id="platform-discount-hotels-wrap" style="display: {{ old('platform_discount_apply_to_all_hotels', $settings->platform_discount_apply_to_all_hotels ?? true) ? 'none' : 'block' }};">
                                                <label class="form-label">Selected hotel(s)</label>
                                                <div class="border rounded p-3" style="max-height: 220px; overflow-y: auto; background: #fff;">
                                                    @php $selectedIds = array_map('intval', (array) old('hotel_ids', $settings->platform_discount_hotel_ids ?? [])); @endphp
                                                    @forelse($hotels as $h)
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" name="hotel_ids[]" value="{{ $h->id }}" id="platform_hotel_{{ $h->id }}"
                                                                   {{ in_array((int) $h->id, $selectedIds) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="platform_hotel_{{ $h->id }}">{{ $h->description }}</label>
                                                        </div>
                                                    @empty
                                                        <p class="text-muted mb-0">No hotels available.</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Save Settings</button>
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

    <script>
        document.getElementById('platform_discount_apply_to_all_hotels').addEventListener('change', function() {
            document.getElementById('platform-discount-hotels-wrap').style.display = this.checked ? 'none' : 'block';
        });
    </script>
@endsection
