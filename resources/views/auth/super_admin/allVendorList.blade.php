@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid" data-select2-id="19">
            <div class="nk-content-inner" data-select2-id="18">
                <div class="nk-content-body" data-select2-id="17">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">All Vendor Lists</h3>
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible mt-2" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                       data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">

                                            <li class="nk-block-tools-opt">
                                                <div class="drodown">
                                                    <a href="{{ route('super-admin.vendor.create') }}"
                                                       class="btn btn-icon btn-primary"><em
                                                            class="icon ni ni-plus"></em></a>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group" style="padding: 10px;">

                                <ul class="nav nav-tabs nav-tabs-s1 mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#pending-vendors">Pending <span class="badge bg-warning ms-1">{{ $pendingVendors->count() }}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#approved-vendors">Approved <span class="badge bg-success ms-1">{{ $approvedVendors->count() }}</span></a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="pending-vendors">
                                        <div class="nk-tb-list nk-tb-ulist">
                                            <table id="pending-table" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Hotel Name</th>
                                                    <th>Contact Person</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($pendingVendors as $vendor)
                                                    <tr class="{{ $vendor->isRejected() ? 'table-danger' : '' }}">
                                                        <td><span class="text-primary">{{ $vendor->vendorId ?? 'Ven-'.$vendor->id }}</span></td>
                                                        <td>
                                                            <a href="{{ route('super-admin.vendor.show', $vendor->id) }}">
                                                                <div class="user-card">
                                                                    <div class="user-avatar bg-primary">
                                                                        <span>{{ implode('', array_map(function($word) { return strtoupper(substr($word, 0, 1)); }, array_slice(explode(' ', $vendor->hotel_name), 0, 2))) }}</span>
                                                                    </div>
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">{{ $vendor->hotel_name }}</span>
                                                                        <span>{{ $vendor->email }}</span>
                                                                        @if($vendor->isRejected())
                                                                            <span class="badge bg-danger ms-1">Rejected</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td><span class="tb-status">{{ $vendor->contact_person_name }}</span></td>
                                                        <td>{{ $vendor->phone }}</td>
                                                        <td>{{ $vendor->email }}</td>
                                                        <td>
                                                            @if($vendor->isRejected())
                                                                <span class="badge bg-danger">Rejected</span>
                                                                @if($vendor->rejection_message)
                                                                    <div class="mt-1">
                                                                        <small class="text-muted" title="{{ $vendor->rejection_message }}">
                                                                            <em class="icon ni ni-info"></em> Message provided
                                                                        </small>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <form action="{{ route('super-admin.vendor.approve', $vendor->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                                </form>
                                                                <button type="button" class="btn btn-sm btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $vendor->id }}">
                                                                    Reject
                                                                </button>
                                                            @endif
                                                            <div class="drodown d-inline-block ms-1">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="{{ route('super-admin.vendor.show', $vendor->id) }}"><em class="icon ni ni-eye"></em><span>Preview</span></a></li>
                                                                        <li><a href="{{ route('super.vendor.infoShow', $vendor->id) }}"><em class="icon ni ni-user"></em><span>Vendor Info</span></a></li>
                                                                        <li><a href="{{ route('super.vendor-admin.owner.show', $vendor->id) }}"><em class="icon ni ni-building"></em><span>Owner Details</span></a></li>
                                                                        <li><a href="{{ route('super.owners.bankInfo.show', $vendor->id) }}"><em class="icon ni ni-bag"></em><span>Owner Banking Info</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="6" class="text-center text-muted">No pending vendors.</td></tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="approved-vendors">
                                        <div class="nk-tb-list nk-tb-ulist">
                                            <table id="approved-table" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Hotel Name</th>
                                                    <th>Contact Person</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($approvedVendors as $vendor)
                                                    <tr>
                                                        <td><span class="text-primary">{{ $vendor->vendorId ?? 'Ven-'.$vendor->id }}</span></td>
                                                        <td>
                                                            <a href="{{ route('super-admin.vendor.show', $vendor->id) }}">
                                                                <div class="user-card">
                                                                    <div class="user-avatar bg-primary">
                                                                        <span>{{ implode('', array_map(function($word) { return strtoupper(substr($word, 0, 1)); }, array_slice(explode(' ', $vendor->hotel_name), 0, 2))) }}</span>
                                                                    </div>
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">{{ $vendor->hotel_name }}</span>
                                                                        <span>{{ $vendor->email }}</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td><span class="tb-status">{{ $vendor->contact_person_name }}</span></td>
                                                        <td>{{ $vendor->phone }}</td>
                                                        <td>{{ $vendor->email }}</td>
                                                        <td>
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li><a href="{{ route('super-admin.vendor.show', $vendor->id) }}"><em class="icon ni ni-eye"></em><span>Preview</span></a></li>
                                                                                <li><a href="{{ route('super.vendor.infoShow', $vendor->id) }}"><em class="icon ni ni-user"></em><span>Vendor Info</span></a></li>
                                                                                <li><a href="{{ route('super.vendor-admin.owner.show', $vendor->id) }}"><em class="icon ni ni-building"></em><span>Owner Details</span></a></li>
                                                                                <li><a href="{{ route('super.owners.bankInfo.show', $vendor->id) }}"><em class="icon ni ni-bag"></em><span>Owner Banking Info</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="6" class="text-center text-muted">No approved vendors.</td></tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <!-- DataTables JS and CSS -->

                                <!-- DataTables JS and CSS -->
                                <link rel="stylesheet"
                                      href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

                                <script>
                                    $(document).ready(function () {
                                        var opts = { paging: true, searching: true, ordering: true, info: true, lengthChange: true };
                                        // Only init DataTables when table has data rows (6 columns per row). Empty state has 1 cell (colspan=6) which breaks DataTables.
                                        function initDataTable(selector) {
                                            var $t = $(selector);
                                            if ($.fn.DataTable.isDataTable(selector)) $t.DataTable().destroy();
                                            var $dataRows = $t.find('tbody tr').filter(function() { return $(this).find('td').length === 6; });
                                            if ($dataRows.length > 0) $t.DataTable(opts);
                                        }
                                        initDataTable('#pending-table');
                                        initDataTable('#approved-table');
                                    });
                                </script>

                                <!-- Reject Vendor Modals -->
                                @foreach($pendingVendors as $vendor)
                                    @if(!$vendor->isRejected())
                                <div class="modal fade" id="rejectModal{{ $vendor->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $vendor->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rejectModalLabel{{ $vendor->id }}">Reject Vendor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('super-admin.vendor.reject', $vendor->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="rejection_message{{ $vendor->id }}" class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                                                        <textarea 
                                                            class="form-control" 
                                                            id="rejection_message{{ $vendor->id }}" 
                                                            name="rejection_message" 
                                                            rows="4" 
                                                            placeholder="Please provide a reason for rejection..."
                                                            required
                                                        ></textarea>
                                                        <small class="form-text text-muted">This message will be shown to the vendor in their dashboard.</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Reject Vendor</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
