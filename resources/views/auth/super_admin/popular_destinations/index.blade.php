@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid" data-select2-id="19">
            <div class="nk-content-inner" data-select2-id="18">
                <div class="nk-content-body" data-select2-id="17">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Most Popular Destinations</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                       data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <a href="{{ route('super-admin.popular-destinations.create') }}"
                                                   class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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
                                        <table id="destinations-table" class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Destination Name</th>
                                                <th>Image</th>
                                                <th>Video URL</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($destinations as $destination)
                                                <tr>
                                                    <td><span class="text-primary">{{ $destination->id }}</span></td>
                                                    <td><strong>{{ $destination->name }}</strong></td>
                                                    <td>
                                                        @if($destination->feature_photo)
                                                            <img src="{{ asset($destination->feature_photo) }}" 
                                                                 alt="{{ $destination->name }}" 
                                                                 style="max-width: 100px; max-height: 60px; object-fit: cover; border-radius: 4px;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($destination->feature_video)
                                                            <a href="{{ $destination->feature_video }}" target="_blank" class="text-primary">
                                                                <em class="icon ni ni-external"></em> View Video
                                                            </a>
                                                        @else
                                                            <span class="text-muted">No Video</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $destination->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#"
                                                                       class="dropdown-toggle btn btn-icon btn-trigger"
                                                                       data-bs-toggle="dropdown"
                                                                       aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li>
                                                                                <a href="{{ route('super-admin.popular-destinations.edit', $destination->id) }}">
                                                                                    <em class="icon ni ni-edit"></em><span>Edit</span>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $destination->id }}').submit();" class="text-danger">
                                                                                    <em class="icon ni ni-trash"></em><span>Delete</span>
                                                                                </a>
                                                                                <form id="delete-form-{{ $destination->id }}" 
                                                                                      action="{{ route('super-admin.popular-destinations.destroy', $destination->id) }}" 
                                                                                      method="POST" 
                                                                                      style="display: none;">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                </form>
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
                            </div>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $destinations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables JS and CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#destinations-table').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": true,
            });
        });
    </script>

@endsection

