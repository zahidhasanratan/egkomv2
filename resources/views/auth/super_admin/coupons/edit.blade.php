@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Coupon</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.coupons.index') }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em> Back to List
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('super-admin.coupons.update', $coupon) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="code">Coupon Code <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="code" name="code"
                                                       value="{{ old('code', $coupon->code) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="description">Description</label>
                                                <input type="text" class="form-control" id="description" name="description"
                                                       value="{{ old('description', $coupon->description) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="discount_type">Discount Type <span class="text-danger">*</span></label>
                                                <select class="form-select" id="discount_type" name="discount_type" required>
                                                    <option value="percentage" {{ old('discount_type', $coupon->discount_type) === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                                    <option value="fixed" {{ old('discount_type', $coupon->discount_type) === 'fixed' ? 'selected' : '' }}>Fixed Amount (BDT)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="discount_value">Discount Value <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" min="0" class="form-control" id="discount_value" name="discount_value"
                                                       value="{{ old('discount_value', $coupon->discount_value) }}" required>
                                            </div>
                                        </div>

                                        <div class="col-12"><h5 class="mb-2">Date wise (Validity)</h5></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="valid_from">Valid From <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="valid_from" name="valid_from"
                                                       value="{{ old('valid_from', $coupon->valid_from->format('Y-m-d')) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="valid_to">Valid To <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="valid_to" name="valid_to"
                                                       value="{{ old('valid_to', $coupon->valid_to->format('Y-m-d')) }}" required>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3 pt-3" style="border-top: 1px solid #e5e9f2;">
                                            <h5 class="mb-3">Where does this coupon apply?</h5>
                                            <div class="p-3 rounded" style="background: #f5f6fa;">
                                                <div class="form-group mb-3">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" id="apply_to_all_hotels" name="apply_to_all_hotels" value="1"
                                                               {{ old('apply_to_all_hotels', $coupon->apply_to_all_hotels) ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="apply_to_all_hotels">Application for all hotels</label>
                                                    </div>
                                                    <small class="text-muted">When ON: coupon works on every hotel. When OFF: choose specific hotels below.</small>
                                                </div>
                                                <div id="hotel-selection-wrap" style="display: {{ old('apply_to_all_hotels', $coupon->apply_to_all_hotels) ? 'none' : 'block' }};">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold">Selected hotel(s)</label>
                                                        <div class="border rounded p-3" style="max-height: 220px; overflow-y: auto; background: #fff;">
                                                            @php $selectedIds = array_map('intval', (array) old('hotel_ids', $coupon->hotel_ids ?? [])); @endphp
                                                            @forelse($hotels as $h)
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" name="hotel_ids[]" value="{{ $h->id }}" id="hotel_edit_{{ $h->id }}" {{ in_array((int) $h->id, $selectedIds) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="hotel_edit_{{ $h->id }}">{{ $h->description }}</label>
                                                                </div>
                                                            @empty
                                                                <p class="text-muted mb-0">No hotels available.</p>
                                                            @endforelse
                                                        </div>
                                                        <small class="text-muted">Tick the hotels that should accept this coupon. Single click to select or deselect.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12"><h5 class="mb-2 mt-3">Time limit (Usage)</h5></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="usage_limit">Usage Limit</label>
                                                <input type="number" min="0" class="form-control" id="usage_limit" name="usage_limit"
                                                       value="{{ old('usage_limit', $coupon->usage_limit) }}">
                                                <small class="text-muted">Current uses: {{ $coupon->usage_count }}</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="min_booking_amount">Min. Booking Amount (BDT)</label>
                                                <input type="number" step="0.01" min="0" class="form-control" id="min_booking_amount" name="min_booking_amount"
                                                       value="{{ old('min_booking_amount', $coupon->min_booking_amount) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="is_active">Coupon is active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><em class="icon ni ni-save"></em> Update Coupon</button>
                                    <a href="{{ route('super-admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('apply_to_all_hotels').addEventListener('change', function() {
            document.getElementById('hotel-selection-wrap').style.display = this.checked ? 'none' : 'block';
        });
    </script>

@endsection
