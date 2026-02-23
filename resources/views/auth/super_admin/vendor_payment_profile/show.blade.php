@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Payment & Income – {{ $vendor->hotel_name ?? 'Vendor' }}</h3>
                                <p class="text-muted mb-0">Vendor ID: {{ $vendor->vendorId ?? 'Ven-' . $vendor->id }}</p>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.vendor.index') }}" class="btn btn-outline-secondary">
                                    <em class="icon ni ni-arrow-left"></em> All Vendors
                                </a>
                                <a href="{{ route('super-admin.vendor.show', $vendor->id) }}" class="btn btn-primary ms-2">
                                    <em class="icon ni ni-eye"></em> Vendor Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h5 class="mb-3">Vendor details (profile)</h5>
                                    <div class="row g-2">
                                        <div class="col-md-3"><span class="text-muted">Hotel / Business name</span><br><strong>{{ $vendor->hotel_name ?? '–' }}</strong></div>
                                        <div class="col-md-3"><span class="text-muted">Contact person</span><br><strong>{{ $vendor->contact_person_name ?? '–' }}</strong></div>
                                        <div class="col-md-3"><span class="text-muted">Email</span><br><strong>{{ $vendor->email ?? '–' }}</strong></div>
                                        <div class="col-md-3"><span class="text-muted">Phone</span><br><strong>{{ $vendor->phone ?? '–' }}</strong></div>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('super-admin.vendor.show', $vendor->id) }}" class="btn btn-sm btn-outline-primary">Full vendor profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h5 class="mb-3">Payment information</h5>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <a href="{{ route('super.vendor-admin.owner.show', $vendor->id) }}" class="btn btn-outline-primary btn-block">
                                                <em class="icon ni ni-user"></em> Owner Details
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('super.owners.bankInfo.show', $vendor->id) }}" class="btn btn-outline-primary btn-block">
                                                <em class="icon ni ni-bag"></em> Owner Banking Info
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted">Total Income (from paid bookings)</h6>
                                    <h4 class="text-primary">BDT {{ number_format($totalIncome, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted">EZBOOKING Commission</h6>
                                    <h4 class="text-warning">BDT {{ number_format($totalCommission, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted">Net earnings</h6>
                                    <h4 class="text-success">BDT {{ number_format($netEarnings, 2) }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2"><h6 class="text-muted mb-2">Income by period</h6></div>
                        <div class="col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Weekly Income</h6>
                                    <h5 class="text-primary mb-0">BDT {{ number_format($weeklyIncome ?? 0, 2) }}</h5>
                                    <small class="text-muted">Last 7 days</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Weekly Net</h6>
                                    <h5 class="mb-0">BDT {{ number_format($weeklyNet ?? 0, 2) }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Monthly Income</h6>
                                    <h5 class="text-primary mb-0">BDT {{ number_format($monthlyIncome ?? 0, 2) }}</h5>
                                    <small class="text-muted">This month</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Monthly Net</h6>
                                    <h5 class="mb-0">BDT {{ number_format($monthlyNet ?? 0, 2) }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted mb-2">Date to date search</h6>
                                    <form action="{{ route('super-admin.vendor.payment-profile', $vendor->id) }}" method="GET" class="row g-2 align-items-end">
                                        <div class="col-auto">
                                            <label class="form-label small mb-0">From</label>
                                            <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from', $customDateFrom?->format('Y-m-d')) }}">
                                        </div>
                                        <div class="col-auto">
                                            <label class="form-label small mb-0">To</label>
                                            <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to', $customDateTo?->format('Y-m-d')) }}">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                            @if($customDateFrom && $customDateTo)
                                                <a href="{{ route('super-admin.vendor.payment-profile', $vendor->id) }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                                            @endif
                                        </div>
                                    </form>
                                    @if($customDateFrom !== null && $customDateTo !== null)
                                        <div class="row g-2 mt-3">
                                            <div class="col-md-4">
                                                <span class="text-muted small">Income ({{ $customDateFrom->format('M d, Y') }} – {{ $customDateTo->format('M d, Y') }})</span>
                                                <h5 class="text-primary mb-0">BDT {{ number_format($customIncome ?? 0, 2) }}</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="text-muted small">Net (same period)</span>
                                                <h5 class="mb-0">BDT {{ number_format($customNet ?? 0, 2) }}</h5>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted">Payments sent (completed)</h6>
                                    <h4>BDT {{ number_format($totalPaidOut, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted">Pending withdrawal requests</h6>
                                    <h4>BDT {{ number_format($pendingPayouts, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block mt-4">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h5 class="mb-3">Withdrawal requests</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Requested</th>
                                                <th>Processed</th>
                                                <th>Reference</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($payouts as $p)
                                                <tr>
                                                    <td>#{{ $p->id }}</td>
                                                    <td>BDT {{ number_format($p->amount, 2) }}</td>
                                                    <td>
                                                        <span class="badge {{ $p->status === 'completed' ? 'bg-success' : ($p->status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                                            {{ \App\Models\VendorPayout::statusOptions()[$p->status] ?? $p->status }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $p->requested_at ? $p->requested_at->format('M d, Y H:i') : '-' }}</td>
                                                    <td>{{ $p->processed_at ? $p->processed_at->format('M d, Y H:i') : '-' }}</td>
                                                    <td>{{ $p->payment_reference ?? '-' }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#payoutModal{{ $p->id }}">
                                                            Update status
                                                        </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="payoutModal{{ $p->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('super-admin.vendor.payout.update-status', $p->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Update payout #{{ $p->id }} status</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Status</label>
                                                                        <select name="status" class="form-select" required>
                                                                            @foreach(\App\Models\VendorPayout::statusOptions() as $value => $label)
                                                                                <option value="{{ $value }}" {{ $p->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Payment reference</label>
                                                                        <input type="text" name="payment_reference" class="form-control" value="{{ old('payment_reference', $p->payment_reference) }}" placeholder="e.g. TXN-123">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Admin note</label>
                                                                        <textarea name="admin_note" class="form-control" rows="2" placeholder="Internal note">{{ old('admin_note', $p->admin_note) }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <tr><td colspan="7" class="text-center text-muted">No withdrawal requests yet.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if($payouts->hasPages())
                                    <div class="mt-3">{{ $payouts->links() }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
