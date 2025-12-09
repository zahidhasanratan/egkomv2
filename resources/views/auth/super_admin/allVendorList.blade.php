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

                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <!-- DataTable -->
                                        <table id="booking-table" class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th><input type="checkbox" class="custom-control-input" id="uid"></th>
                                                <th>ID</th>
                                                <th>Hotel Name</th>

                                                <th>Contact Person</th>
                                                <th>Phone</th>
                                                <th>Email</th>


                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vendorList as $vendorList)
                                                <tr>
                                                    <td><input type="checkbox" class="custom-control-input" id="uid1">
                                                    </td>
                                                    <td><span class="text-primary">{{ $vendorList->vendorId }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('super-admin.vendor.show', $vendorList->id) }}">
                                                            <div class="user-card">
                                                                <div class="user-avatar bg-primary">
                                                                    <span>{{ implode('', array_map(function($word) {
    return strtoupper(substr($word, 0, 1));
}, array_slice(explode(' ', $vendorList->hotel_name), 0, 2))) }}</span>
                                                                </div>
                                                                <div class="user-info">
                                                                    <span class="tb-lead">{{ $vendorList->hotel_name }} <span
                                                                            class="dot dot-success d-md-none ms-1"></span></span>
                                                                    <span>{{ $vendorList->email }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>

                                                    <td><span
                                                            class="tb-status">{{ $vendorList->contact_person_name }}</span>
                                                    </td>
                                                    <td>{{ $vendorList->phone }}</td>
                                                    <td>{{ $vendorList->email }}</td>


                                                    <td>
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#"
                                                                       class="dropdown-toggle btn btn-icon btn-trigger"
                                                                       data-bs-toggle="dropdown"
                                                                       aria-expanded="false"><em
                                                                            class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">

                                                                            <li>
                                                                                <a href="{{ route('super-admin.vendor.show',$vendorList->id) }}"><em
                                                                                        class="icon ni ni-eye"></em><span>Preview</span></a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{ route('super.vendor.infoShow', $vendorList->id) }}">
                                                                                    <em class="icon ni ni-user"></em>
                                                                                    <span>Vendor Info</span>
                                                                                </a>
                                                                            </li>

                                                                            <li>
                                                                                <a href="{{ route('super.vendor-admin.owner.show',$vendorList->id) }}"><em
                                                                                        class="icon ni ni-building"></em><span>Owner Details</span></a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{ route('super.owners.bankInfo.show',$vendorList->id) }}"><em
                                                                                        class="icon ni ni ni-bag"></em><span>Owner Banking Info</span></a>
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
                                        // Initialize DataTables
                                        $('#booking-table').DataTable({
                                            "paging": true,  // Enable pagination
                                            "searching": true,  // Enable search
                                            "ordering": true,  // Enable sorting
                                            "info": true,  // Display table info
                                            "lengthChange": true,  // Allow changing the number of rows per page
                                        });
                                    });
                                </script>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
