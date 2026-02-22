@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Room List
                                    of {{ $hotel->description ?? 'No description available' }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Here are your various room. </p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Search Form - Right Side -->
                                    <form method="GET" action="{{ route('vendor-admin.room.index', \Illuminate\Support\Facades\Crypt::encrypt($hotel->id)) }}" class="search-form-inline">
                                        <div class="input-group">
                                            <input type="text" 
                                                   name="search" 
                                                   class="form-control form-control-sm" 
                                                   placeholder="Search rooms..." 
                                                   value="{{ request('search') }}">
                                            @if(request('search'))
                                            <a href="{{ route('vendor-admin.room.index', \Illuminate\Support\Facades\Crypt::encrypt($hotel->id)) }}" class="btn btn-outline-light btn-sm" title="Clear search">
                                                <em class="icon ni ni-cross"></em>
                                            </a>
                                            @endif
                                            <button type="submit" class="btn btn-primary btn-sm" title="Search">
                                                <em class="icon ni ni-search"></em>
                                            </button>
                                        </div>
                                    </form>
                                    
                                    <ul class="nk-block-tools g-3 mb-0">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-primary"
                                                   data-bs-toggle="dropdown">
                                                    <em class="icon ni ni-plus"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a href="{{ route('vendor-admin.room.create',\Illuminate\Support\Facades\Crypt::encrypt($hotel->id)) }}">
                                                                <span>Add Room</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
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
                                                <span class="sub-text"
                                                      style="font-weight: bold">Hotel Property Name</span>
                                            </div>

                                            <div class="nk-tb-col">
                                                <span class="sub-text" style="font-weight: bold">Room Number</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="sub-text" style="font-weight: bold">Floor Number</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="sub-text" style="font-weight: bold">Price / Night</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="sub-text"
                                                      style="font-weight: bold">Active / Deactive</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="sub-text" style="font-weight: bold">Status</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end"></div>
                                        </div>
                                        @forelse($roomList as $hotel)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span
                                                        class="text-primary">{{ $hotel->name ?? 'No description' }}</span>
                                                </div>

                                                <div class="nk-tb-col">
                                                    <span
                                                        class="text-primary">{{ $hotel->number ?? 'No Number' }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span
                                                        class="text-primary">{{ $hotel->floor_number ?? 'No Floor Number' }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span
                                                        class="text-primary">{{ $hotel->price_per_night ?? 'No Price' }}</span>
                                                </div>


                                                <div class="nk-tb-col">
                                                    @php
                                                        $roomStatus = $hotel->status ?? 'draft';
                                                        $isSuccess = in_array($roomStatus, ['submitted', 'published']);
                                                    @endphp
                                                    <span class="badge" style="{{ $isSuccess ? 'background:#198754;color:#fff' : 'background:#495057;color:#fff' }};">{{ ucfirst($roomStatus) }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="text-primary">
    {{ $hotel->is_active == 1 ? 'active' : 'deactive' }}
</span>

                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                   class="dropdown-toggle btn btn-icon btn-trigger"
                                                                   data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li>
                                                                            <a href="{{ route('vendor-admin.room.edit', $hotel) }}">
                                                                                <em class="icon ni ni-edit"></em>
                                                                                <span>Edit</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>

                                                                            <a href="javascript:void(0);"
                                                                               onclick="deleteHotel(event, '{{ route('vendor-admin.room.destroy', $hotel) }}')">
                                                                                <em class="icon ni ni-trash"></em>
                                                                                <span>Delete</span>
                                                                            </a>

                                                                            <form id="delete-hotel-form" action=""
                                                                                  method="POST" style="display:none;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                            </form>

                                                                            <script>
                                                                                function deleteHotel(event, url) {
                                                                                    event.preventDefault();
                                                                                    if (confirm('Are you sure you want to delete this hotel?')) {
                                                                                        let form = document.getElementById('delete-hotel-form');
                                                                                        form.action = url;
                                                                                        form.submit();
                                                                                    }
                                                                                }
                                                                            </script>

                                                                        </li>
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
                                                    Showing {{ $roomList->total() }} result(s) for "<strong>{{ request('search') }}</strong>"
                                                </p>
                                            @endif
                                            {{ $roomList->links() }}
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
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        th:first-child, td:first-child {
            text-align: left;
        }

        th:last-child, td:last-child {
            text-align: center;
        }

        .icon {
            vertical-align: middle;
        }

        .action-buttons button {
            border: none;
            background: none;
            cursor: pointer;
            padding: 6px;
        }

        .edit-btn {
            color: #007bff;
        }

        .delete-btn {
            color: #dc3545;
        }

        .badges {
            font-size: .75em;
            font-weight: 400;
            line-height: 1em;
            padding: .65em .65em;
            border-radius: 4px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .badge-primary {
            background-color: rgba(0, 122, 255, .1);
            color: #007aff;
        }

        .badge-danger {
            background-color: rgba(255, 59, 48, .1);
            color: #ff3b30;
        }

        em.icon.ni.ni-edit, em.icon.ni.ni-trash {
            margin-right: 0px;
        }

        td.action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
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
        
        .d-flex.gap-2 {
            gap: 0.5rem;
        }
    </style>

    <script>
        // Basic search toggle functionality (already in your template)
        document.querySelectorAll('.toggle-search').forEach(toggle => {
            toggle.addEventListener('click', function () {
                const target = document.querySelector(`[data-search="${this.dataset.target}"]`);
                target.classList.toggle('active');
            });
        });

        // Card tools toggle
        document.querySelectorAll('.toggle').forEach(toggle => {
            toggle.addEventListener('click', function () {
                const target = document.querySelector(`[data-content="${this.dataset.target}"]`);
                target.classList.toggle('active');
            });
        });
    </script>
@endsection
