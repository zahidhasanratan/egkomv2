@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Coupon Code Management</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.coupons.create') }}" class="btn btn-primary">
                                    <em class="icon ni ni-plus"></em> Add Coupon
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group" style="padding: 10px;">
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Discount</th>
                                                <th>Valid From</th>
                                                <th>Valid To</th>
                                                <th>Time Limit (Uses)</th>
                                                <th>Application</th>
                                                <th>Active</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($coupons as $coupon)
                                                <tr>
                                                    <td><strong>{{ $coupon->code }}</strong></td>
                                                    <td>
                                                        @if($coupon->discount_type === 'percentage')
                                                            {{ number_format($coupon->discount_value, 0) }}%
                                                        @else
                                                            BDT {{ number_format($coupon->discount_value, 0) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $coupon->valid_from->format('d M Y') }}</td>
                                                    <td>{{ $coupon->valid_to->format('d M Y') }}</td>
                                                    <td>
                                                        @if($coupon->usage_limit)
                                                            {{ $coupon->usage_count }} / {{ $coupon->usage_limit }}
                                                        @else
                                                            {{ $coupon->usage_count }} (unlimited)
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($coupon->apply_to_all_hotels)
                                                            <span class="badge bg-info">All Hotels</span>
                                                        @else
                                                            <span class="badge bg-secondary">Selected Hotels</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($coupon->is_active)
                                                            <span class="badge bg-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-secondary">No</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('super-admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                        <form action="{{ route('super-admin.coupons.destroy', $coupon) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this coupon?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted py-4">No coupons yet. <a href="{{ route('super-admin.coupons.create') }}">Create one</a></td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">{{ $coupons->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
