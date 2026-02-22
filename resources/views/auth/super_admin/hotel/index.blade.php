@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Hotel List</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Here are your various hotels.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <!-- Search Form - Right Side -->
                                <form method="GET" action="{{ route('super-admin.hotel.index') }}" class="search-form-inline">
                                    <div class="input-group">
                                        <input type="text" 
                                               name="search" 
                                               class="form-control form-control-sm" 
                                               placeholder="Search hotels..." 
                                               value="{{ request('search') }}">
                                        @if(request('search'))
                                        <a href="{{ route('super-admin.hotel.index') }}" class="btn btn-outline-light btn-sm" title="Clear search">
                                            <em class="icon ni ni-cross"></em>
                                        </a>
                                        @endif
                                        <button type="submit" class="btn btn-primary btn-sm" title="Search">
                                            <em class="icon ni ni-search"></em>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">

                                <div class="card-inner p-0">

                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col">
                                                <span class="sub-text" style="font-weight: bold">Hotel Property Name</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="sub-text" style="font-weight: bold">Vendor</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="sub-text" style="font-weight: bold">Status</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="sub-text" style="font-weight: bold">Status & Visibility</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end"></div>
                                        </div>
                                        @forelse($hotels as $hotel)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="text-primary">{{ $hotel->description ?? 'No description' }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="text-primary">{{ \App\Models\Vendor::where('id',$hotel->vendor_id)->first()->contact_person_name }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="text-primary">{{ $hotel->status ?? 'No Status' }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <div class="status-controls-wrapper">
                                                        <!-- Approval Status -->
                                                        <div class="status-control-item">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="approve-toggle-{{ $hotel->id }}"
                                                                       {{ $hotel->approve ? 'checked' : '' }}
                                                                       onchange="toggleApprove({{ $hotel->id }}, this.checked)">
                                                                <label class="form-check-label" for="approve-toggle-{{ $hotel->id }}">
                                                                    <span class="status-badge {{ $hotel->approve ? 'badge-approved' : 'badge-not-approved' }}">
                                                                        {{ $hotel->approve ? 'Approved' : 'Not Approved' }}
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Suspend/Disable Status - Only for approved hotels -->
                                                        @if($hotel->approve == 1)
                                                        <div class="status-control-item">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="suspend-toggle-{{ $hotel->id }}"
                                                                       {{ $hotel->is_suspended ? 'checked' : '' }}
                                                                       onchange="toggleSuspend({{ $hotel->id }}, this.checked)">
                                                                <label class="form-check-label" for="suspend-toggle-{{ $hotel->id }}">
                                                                    <span class="status-badge {{ $hotel->is_suspended ? 'badge-suspended' : 'badge-active' }}">
                                                                        {{ $hotel->is_suspended ? 'Suspended' : 'Active' }}
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li>
                                                                            <a href="{{ route('super-admin.hotel.edit', $hotel) }}">
                                                                                <em class="icon ni ni-edit"></em>
                                                                                <span>Edit</span>
                                                                            </a>
                                                                        </li>

{{--                                                                        <li>--}}

{{--                                                                            <a href="javascript:void(0);" onclick="deleteHotel(event, '{{ route('vendor-admin.hotel.destroy', $hotel) }}')">--}}
{{--                                                                                <em class="icon ni ni-trash"></em>--}}
{{--                                                                                <span>Delete</span>--}}
{{--                                                                            </a>--}}

{{--                                                                            <form id="delete-hotel-form" action="" method="POST" style="display:none;">--}}
{{--                                                                                @csrf--}}
{{--                                                                                @method('DELETE')--}}
{{--                                                                            </form>--}}

{{--                                                                            <script>--}}
{{--                                                                                function deleteHotel(event, url) {--}}
{{--                                                                                    event.preventDefault();--}}
{{--                                                                                    if (confirm('Are you sure you want to delete this hotel?')) {--}}
{{--                                                                                        let form = document.getElementById('delete-hotel-form');--}}
{{--                                                                                        form.action = url;--}}
{{--                                                                                        form.submit();--}}
{{--                                                                                    }--}}
{{--                                                                                }--}}
{{--                                                                            </script>--}}
{{--                                                                        </li>--}}

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span>No hotels found.</span>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        <div class="g">
                                            @if(request('search'))
                                                <p class="text-muted small mb-2">
                                                    Showing {{ $hotels->total() }} result(s) for "<strong>{{ request('search') }}</strong>"
                                                </p>
                                            @endif
                                            {{ $hotels->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Your existing styles remain unchanged */
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 12px 16px; border-bottom: 1px solid #ddd; }
        th { background-color: #f4f4f4; font-weight: bold; }
        tr:hover { background-color: #f1f1f1; }
        th:first-child, td:first-child { text-align: left; }
        th:last-child, td:last-child { text-align: center; }
        .icon { vertical-align: middle; }
        .action-buttons button { border: none; background: none; cursor: pointer; padding: 6px; }
        .edit-btn { color: #007bff; }
        .delete-btn { color: #dc3545; }
        .badges { font-size: .75em; font-weight: 400; line-height: 1em; padding: .65em .65em; border-radius: 4px; text-transform: uppercase; display: inline-flex; align-items: center; justify-content: center; }
        .badge-primary { background-color: rgba(0, 122, 255, .1); color: #007aff; }
        .badge-danger { background-color: rgba(255, 59, 48, .1); color: #ff3b30; }
        em.icon.ni.ni-edit, em.icon.ni.ni-trash { margin-right: 0px; }
        td.action-buttons { display: flex; justify-content: center; gap: 10px; }
        
        /* Status Controls Styling */
        .status-controls-wrapper {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 140px;
        }
        
        .status-control-item {
            display: flex;
            align-items: center;
        }
        
        .status-control-item .form-check {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .status-control-item .form-check-input {
            margin: 0;
            flex-shrink: 0;
        }
        
        .status-control-item .form-check-label {
            margin: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
            line-height: 1.4;
        }
        
        .badge-approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-not-approved {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .badge-active {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .badge-suspended {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .nk-tb-col {
            vertical-align: middle;
        }
        
        /* Beautiful Search Form Styling - Right Side */
        .search-form-inline {
            display: inline-flex;
        }
        
        .search-form-inline .input-group {
            display: flex;
            align-items: center;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .search-form-inline .input-group:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .search-form-inline .form-control-sm {
            border: 1px solid #e0e0e0;
            border-right: none;
            padding: 0.5rem 1rem;
            min-width: 250px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }
        
        .search-form-inline .form-control-sm:focus {
            border-color: #5263ff;
            box-shadow: 0 0 0 0.2rem rgba(82, 99, 255, 0.1);
            outline: none;
        }
        
        .search-form-inline .btn-sm {
            padding: 0.5rem 0.75rem;
            border-radius: 0;
            border-left: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .search-form-inline .btn-primary.btn-sm {
            background: linear-gradient(135deg, #5263ff 0%, #7c3aed 100%);
            border-color: #5263ff;
        }
        
        .search-form-inline .btn-primary.btn-sm:hover {
            background: linear-gradient(135deg, #4050e6 0%, #6b2dd8 100%);
            transform: translateY(-1px);
        }
        
        .search-form-inline .btn-outline-light.btn-sm {
            background-color: #f8f9fa;
            border-color: #e0e0e0;
            color: #6c757d;
        }
        
        .search-form-inline .btn-outline-light.btn-sm:hover {
            background-color: #e9ecef;
            color: #495057;
        }
        
        .nk-block-head-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
    </style>

    <script>
        // Basic search toggle functionality (already in your template)
        document.querySelectorAll('.toggle-search').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const target = document.querySelector(`[data-search="${this.dataset.target}"]`);
                target.classList.toggle('active');
            });
        });

        // Card tools toggle
        document.querySelectorAll('.toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const target = document.querySelector(`[data-content="${this.dataset.target}"]`);
                target.classList.toggle('active');
            });
        });
    </script>

    <script>
        function toggleApprove(hotelId, isChecked) {
            const approve = isChecked ? 1 : 0;

            fetch(`/super-admin/admin/hotel/${hotelId}/toggle-approve`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ approve: approve })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Approval status updated');
                        const message = isChecked 
                            ? '✅ Hotel approved successfully. You can now suspend/activate it.' 
                            : '⚠️ Hotel unapproved. Suspend option has been disabled.';
                        alert(message);
                        // Reload page to show/hide suspend toggle
                        location.reload();
                    } else {
                        alert('❌ Error updating approval status.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating approval.');
                });
        }
        
        function toggleSuspend(hotelId, isChecked) {
            const isSuspended = isChecked ? 1 : 0;
            
            if (isChecked && !confirm('⚠️ Are you sure you want to SUSPEND this hotel?\n\nThis will:\n• Hide the hotel from the website\n• Hide all its rooms from search results\n• Make the hotel page return 404\n\nYou can reactivate it anytime.')) {
                // Reset checkbox if user cancels
                document.getElementById('suspend-toggle-' + hotelId).checked = false;
                return;
            }

            fetch(`/super-admin/admin/hotel/${hotelId}/toggle-suspend`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_suspended: isSuspended })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Suspend status updated');
                        // Show success message
                        const message = isChecked 
                            ? '✅ Hotel suspended successfully. It is now hidden from the website.' 
                            : '✅ Hotel activated successfully. It is now visible on the website.';
                        alert(message);
                        // Reload to update UI with badges
                        location.reload();
                    } else {
                        alert('❌ Error updating suspend status: ' + (data.message || 'Unknown error'));
                        // Reset checkbox on error
                        document.getElementById('suspend-toggle-' + hotelId).checked = !isChecked;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Error updating suspend status. Please try again.');
                    // Reset checkbox on error
                    document.getElementById('suspend-toggle-' + hotelId).checked = !isChecked;
                });
        }
    </script>


@endsection
