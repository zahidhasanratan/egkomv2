@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">My Payment</h3>
                                <p class="text-muted mb-0">View income, EZBOOKING charges, request payouts, and manage payment methods.</p>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Total Income</h6>
                                    <h4 class="text-primary mb-0">BDT {{ number_format($totalIncome, 2) }}</h4>
                                    <small class="text-muted">From paid bookings</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">EZBOOKING Charges</h6>
                                    <h4 class="text-warning mb-0">BDT {{ number_format($totalCommission, 2) }}</h4>
                                    <small class="text-muted">Commission</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Net Earnings</h6>
                                    <h4 class="text-success mb-0">BDT {{ number_format($netEarnings, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Available Balance</h6>
                                    <h4 class="mb-0">BDT {{ number_format($availableBalance, 2) }}</h4>
                                    <small class="text-muted">After payouts</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-12"><h6 class="text-muted mb-2">Income by period</h6></div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Weekly Income</h6>
                                    <h5 class="text-primary mb-0">BDT {{ number_format($weeklyIncome, 2) }}</h5>
                                    <small class="text-muted">Last 7 days</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Weekly Net</h6>
                                    <h5 class="mb-0">BDT {{ number_format($weeklyNet, 2) }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Monthly Income</h6>
                                    <h5 class="text-primary mb-0">BDT {{ number_format($monthlyIncome, 2) }}</h5>
                                    <small class="text-muted">This month</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted small">Monthly Net</h6>
                                    <h5 class="mb-0">BDT {{ number_format($monthlyNet, 2) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-12">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="text-muted mb-2">Date to date search</h6>
                                    <form action="{{ route('vendor-admin.payment.index') }}" method="GET" class="row g-2 align-items-end">
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
                                                <a href="{{ route('vendor-admin.payment.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
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
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-lg-4">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h5 class="mb-3">Request payment</h5>
                                    <p class="text-muted small">Submit a withdrawal request. Payments are sent to your registered banking details.</p>
                                    <a href="{{ route('vendor-admin.owner.create') }}" class="d-block mb-2 small">Owner Details</a>
                                    <a href="{{ route('owners.bankInfo') }}" class="d-block mb-3 small">Owner Banking Info</a>
                                    <form action="{{ route('vendor-admin.payment.request') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label class="form-label">Amount (BDT)</label>
                                            <input type="number" name="amount" class="form-control" step="0.01" min="1" placeholder="0.00" required value="{{ old('amount') }}">
                                            @error('amount')<span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Note (optional)</label>
                                            <textarea name="vendor_note" class="form-control" rows="2" placeholder="Any note for this request">{{ old('vendor_note') }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" {{ $availableBalance < 1 ? 'disabled' : '' }}>Request payout</button>
                                    </form>
                                    @if($availableBalance < 1)
                                        <p class="small text-muted mt-2 mb-0">Available balance must be at least BDT 1 to request a payout.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h5 class="mb-3">Withdrawal requests</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Requested</th>
                                                    <th>Processed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($payouts as $p)
                                                    <tr>
                                                        <td>{{ $p->id }}</td>
                                                        <td>BDT {{ number_format($p->amount, 2) }}</td>
                                                        <td>
                                                            <span class="badge {{ $p->status === 'completed' ? 'bg-success' : ($p->status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                                                {{ \App\Models\VendorPayout::statusOptions()[$p->status] ?? $p->status }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $p->requested_at ? $p->requested_at->format('M d, Y') : '-' }}</td>
                                                        <td>{{ $p->processed_at ? $p->processed_at->format('M d, Y') : '-' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="5" class="text-center text-muted">No withdrawal requests yet.</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($payouts->hasPages())
                                        <div class="mt-2">{{ $payouts->links() }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-bordered mt-4">
                        <div class="card-inner">
                            <h5 class="mb-3">Payment methods & banking</h5>
                            <p class="text-muted mb-2">Manage where you receive payments. Owner Banking Info is required before requesting payouts.</p>
                            <div class="row g-2">
                                <div class="col-auto">
                                    <a href="{{ route('vendor-admin.owner.create') }}" class="btn btn-outline-primary">
                                        <em class="icon ni ni-user"></em> Owner Details
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('owners.bankInfo') }}" class="btn btn-outline-primary">
                                        <em class="icon ni ni-bag"></em> Owner Banking Info
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
