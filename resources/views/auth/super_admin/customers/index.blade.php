@extends('auth.layout.super_admin_layout')

@section('mainbody')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">All Customers</h3>
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible mt-2" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                        </div>
                        <div class="nk-block-head-content">
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <em class="icon ni ni-download me-1"></em> Download
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="{{ route('super-admin.customers.export.excel') }}" target="_blank" rel="noopener"><em class="icon ni ni-file-docs"></em><span>Download Excel (CSV)</span></a></li>
                                        <li><a href="{{ route('super-admin.customers.export.csv') }}" target="_blank" rel="noopener"><em class="icon ni ni-download"></em><span>Download CSV</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div class="nk-tb-list nk-tb-ulist">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Total Bookings</th>
                                                <th>Last Booking</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($customers as $customer)
                                            <tr>
                                                <td>{{ $customers->firstItem() + $loop->index }}</td>
                                                <td><span class="tb-lead">{{ $customer->guest_name ?? '—' }}</span></td>
                                                <td>{{ $customer->guest_email ?? '—' }}</td>
                                                <td>{{ $customer->guest_phone ?? '—' }}</td>
                                                <td><span class="badge bg-light text-dark">{{ $customer->total_bookings ?? 0 }}</span></td>
                                                <td>{{ $customer->last_booking_at ? \Carbon\Carbon::parse($customer->last_booking_at)->format('M d, Y H:i') : '—' }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('super-admin.bookings.index') }}?search={{ urlencode($customer->guest_email) }}" class="btn btn-sm btn-outline-primary" title="View bookings">View Bookings</a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-soft py-4">No customers found.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if($customers->hasPages())
                            <div class="card-inner border-top">
                                {{ $customers->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
