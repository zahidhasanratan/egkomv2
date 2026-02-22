@extends('auth.layout.vendor_admin_layout')
@section('title', 'All Co-Hosts')
@section('mainbody')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<style>
    .nk-content-body {
        padding: 20px;
    }
    
    .container-fluid {
        padding: 0 15px;
    }
    
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        background: white;
        overflow: visible;
    }
    
    .card-body {
        background: white;
        padding: 20px;
    }
    
    .action-btn {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        border-radius: 4px;
        margin: 0 3px;
        opacity: 1 !important;
        visibility: visible !important;
        transition: all 0.3s;
        color: white;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    
    .action-btn-primary {
        background: #6576ff !important;
    }
    
    .action-btn-primary:hover {
        background: #5160d8 !important;
    }
    
    .action-btn-success {
        background: #1ee0ac !important;
    }
    
    .action-btn-success:hover {
        background: #1bc89a !important;
    }
    
    .action-btn-warning {
        background: #f4bd0e !important;
    }
    
    .action-btn-warning:hover {
        background: #d3a30c !important;
    }
    
    .action-btn-danger {
        background: #e85347 !important;
    }
    
    .action-btn-danger:hover {
        background: #d63c30 !important;
    }
    
    .co-host-photo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .status-active {
        background: #d1fae5;
        color: #065f46;
    }
    
    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }
</style>

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">All Co-Hosts</h3>
                            <div class="nk-block-des text-soft">
                                <p>View all co-hosts across all your hotels</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            confirmButtonColor: '#6576ff'
                        });
                    </script>
                @endif

                @if(session('error'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: '{{ session('error') }}',
                            confirmButtonColor: '#6576ff'
                        });
                    </script>
                @endif

                <div class="card">
                    <div class="card-body">
                        @if($coHosts->count() > 0)
                        <div class="table-responsive">
                            <table id="cohosts-table" class="table table-bordered table-hover">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="width: 60px;">Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Hotel</th>
                                        <th>Language</th>
                                        <th style="width: 120px; text-align: center;">Response Rate</th>
                                        <th style="width: 100px; text-align: center;">Status</th>
                                        <th style="width: 200px; text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coHosts as $coHost)
                                    <tr>
                                        <td style="text-align: center;">
                                            @if($coHost->photo)
                                                <img src="{{ asset($coHost->photo) }}" alt="{{ $coHost->name }}" class="co-host-photo">
                                            @else
                                                <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #6576ff, #5160d8); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px; margin: 0 auto;">
                                                    {{ strtoupper(substr($coHost->name, 0, 2)) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $coHost->name }}</strong><br>
                                            <small class="text-muted">{{ $coHost->response_time ?? 'N/A' }}</small>
                                        </td>
                                        <td>{{ $coHost->email }}</td>
                                        <td>{{ $coHost->phone ?? 'N/A' }}</td>
                                        <td>
                                            @if($coHost->hotel)
                                                <a href="{{ route('vendor.co-hosts.index', $coHost->hotel->id) }}" class="text-primary">
                                                    <strong>{{ $coHost->hotel->description }}</strong>
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $coHost->language ?? 'English' }}</td>
                                        <td style="text-align: center;">
                                            <span class="badge badge-success" style="font-size: 14px;">{{ $coHost->response_rate ?? 0 }}%</span>
                                        </td>
                                        <td style="text-align: center;">
                                            @if($coHost->is_active)
                                                <span class="status-badge status-active">Active</span>
                                            @else
                                                <span class="status-badge status-inactive">Inactive</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if($coHost->hotel)
                                            <a href="{{ route('vendor.co-hosts.edit', [$coHost->hotel->id, $coHost->id]) }}" 
                                               class="action-btn action-btn-primary" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            
                                            <form id="toggle-status-{{ $coHost->id }}" 
                                                  action="{{ route('vendor.co-hosts.update', [$coHost->hotel->id, $coHost->id]) }}" 
                                                  method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="name" value="{{ $coHost->name }}">
                                                <input type="hidden" name="email" value="{{ $coHost->email }}">
                                                <input type="hidden" name="is_active" value="{{ $coHost->is_active ? '0' : '1' }}">
                                                <button type="submit" 
                                                        class="action-btn {{ $coHost->is_active ? 'action-btn-warning' : 'action-btn-success' }}" 
                                                        title="{{ $coHost->is_active ? 'Deactivate' : 'Activate' }}">
                                                    <i class="fas fa-{{ $coHost->is_active ? 'ban' : 'check' }}"></i> 
                                                    {{ $coHost->is_active ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                            
                                            <button type="button" 
                                                    class="action-btn action-btn-danger" 
                                                    onclick="deleteCoHost({{ $coHost->id }}, {{ $coHost->hotel->id }})"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            
                                            <form id="delete-form-{{ $coHost->id }}" 
                                                  action="{{ route('vendor.co-hosts.destroy', [$coHost->hotel->id, $coHost->id]) }}" 
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @else
                                            <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center" style="padding: 60px 20px;">
                            <em class="icon ni ni-users" style="font-size: 80px; color: #ddd; margin-bottom: 20px;"></em>
                            <h4 style="color: #666; margin-bottom: 10px;">No Co-Hosts Yet</h4>
                            <p style="color: #999; margin-bottom: 30px;">Add co-hosts to help manage your properties professionally</p>
                        </div>
                        @endif
                    </div>
                </div>
                
                @if($coHosts->count() > 0)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div style="text-align: center; padding: 20px; background: #f0f7ff; border-radius: 8px;">
                                    <h3 style="color: #6576ff; margin-bottom: 5px;">{{ $coHosts->count() }}</h3>
                                    <p style="color: #666; margin: 0;">Total Co-Hosts</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="text-align: center; padding: 20px; background: #e6fff9; border-radius: 8px;">
                                    <h3 style="color: #1ee0ac; margin-bottom: 5px;">{{ $coHosts->where('is_active', true)->count() }}</h3>
                                    <p style="color: #666; margin: 0;">Active Co-Hosts</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="text-align: center; padding: 20px; background: #fff5e6; border-radius: 8px;">
                                    <h3 style="color: #f4bd0e; margin-bottom: 5px;">{{ number_format($coHosts->avg('response_rate'), 0) }}%</h3>
                                    <p style="color: #666; margin: 0;">Avg Response Rate</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="text-align: center; padding: 20px; background: #f0f0f0; border-radius: 8px;">
                                    <h3 style="color: #666; margin-bottom: 5px;">{{ $coHosts->groupBy('hotel_id')->count() }}</h3>
                                    <p style="color: #666; margin: 0;">Hotels</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        var opts = { 
            paging: true, 
            searching: true, 
            ordering: true, 
            info: true, 
            lengthChange: true,
            pageLength: 25
        };
        // Only init DataTables when table has data rows
        var $t = $('#cohosts-table');
        var $dataRows = $t.find('tbody tr').filter(function() { return $(this).find('td').length === 9; });
        if ($dataRows.length > 0) {
            $t.DataTable(opts);
        }
    });

    function deleteCoHost(coHostId, hotelId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This co-host will be permanently deleted and will lose access to the dashboard.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e85347',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + coHostId).submit();
            }
        });
    }
</script>

@endsection
