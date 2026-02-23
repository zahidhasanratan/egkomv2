@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Payment & Income</h3>
                                <p class="text-muted mb-0">View vendor income, payments sent, and withdrawal requests. Manage pending payouts below or open a vendor to update status.</p>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.vendor.index') }}" class="btn btn-outline-secondary">
                                    <em class="icon ni ni-arrow-left"></em> All Vendors
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(isset($pendingPayouts) && $pendingPayouts->isNotEmpty())
                    <div class="nk-block mb-4">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h5 class="mb-3">Pending withdrawal requests <span class="badge bg-warning">{{ $pendingPayouts->count() }}</span></h5>
                                <p class="text-muted small mb-3">Vendors have requested these payouts. Open the vendor's payment profile to mark as Completed, On Hold, In Process, or Rejected.</p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Vendor</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Requested</th>
                                                <th>Note</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pendingPayouts as $p)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('super-admin.vendor.payment-profile', $p->vendor_id) }}" class="fw-bold">{{ $p->vendor->hotel_name ?? 'Vendor #' . $p->vendor_id }}</a>
                                                        <div class="small text-muted">{{ $p->vendor->email ?? '' }}</div>
                                                    </td>
                                                    <td>BDT {{ number_format($p->amount, 2) }}</td>
                                                    <td><span class="badge {{ $p->status === 'in_process' ? 'bg-info text-dark' : 'bg-warning text-dark' }}">{{ \App\Models\VendorPayout::statusOptions()[$p->status] ?? $p->status }}</span></td>
                                                    <td>{{ $p->requested_at ? $p->requested_at->format('M d, Y H:i') : $p->created_at->format('M d, Y H:i') }}</td>
                                                    <td class="small">{{ \Illuminate\Support\Str::limit($p->vendor_note ?? '–', 30) }}</td>
                                                    <td>
                                                        <a href="{{ route('super-admin.vendor.payment-profile', $p->vendor_id) }}" class="btn btn-sm btn-primary">Manage</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Vendor</th>
                                                <th class="text-end">Total Income</th>
                                                <th class="text-end">Commission</th>
                                                <th class="text-end">Net Earnings</th>
                                                <th class="text-end">Paid Out</th>
                                                <th class="text-end">Pending</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($vendors as $v)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('super-admin.vendor.payment-profile', $v->id) }}" class="fw-bold">
                                                            {{ $v->hotel_name ?? 'Vendor #' . $v->id }}
                                                        </a>
                                                        <div class="small text-muted">{{ $v->email ?? '' }}</div>
                                                    </td>
                                                    <td class="text-end">BDT {{ number_format($v->total_income ?? 0, 2) }}</td>
                                                    <td class="text-end">BDT {{ number_format($v->total_commission ?? 0, 2) }}</td>
                                                    <td class="text-end">BDT {{ number_format($v->net_earnings ?? 0, 2) }}</td>
                                                    <td class="text-end">BDT {{ number_format($v->total_paid_out ?? 0, 2) }}</td>
                                                    <td class="text-end">BDT {{ number_format($v->pending_payouts ?? 0, 2) }}</td>
                                                    <td>
                                                        <a href="{{ route('super-admin.vendor.payment-profile', $v->id) }}" class="btn btn-sm btn-primary">
                                                            View & manage
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted py-4">No approved vendors yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
