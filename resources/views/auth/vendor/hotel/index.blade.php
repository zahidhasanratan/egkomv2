@extends('auth.layout.vendor_admin_layout')

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

                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown">
                                                <em class="icon ni ni-plus"></em>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="{{ route('vendor-admin.hotel.create') }}">
                                                            <span>Add Hotel</span>
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
                                                <span class="sub-text" style="font-weight: bold">Status</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end"></div>
                                        </div>
                                        @forelse($hotels as $hotel)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="text-primary">{{ $hotel->description ?? 'No description' }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="text-primary">{{ $hotel->status ?? 'No Status' }}</span>
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
                                                                            <a href="{{ route('vendor-admin.hotel.show', $hotel) }}">
                                                                                <em class="icon ni ni-eye"></em>
                                                                                <span>View</span>
                                                                            </a>
                                                                        </li>
{{--                                                                        <li>--}}
{{--                                                                            <a href="{{ route('vendor-admin.hotel.edit', $hotel) }}">--}}
{{--                                                                                <em class="icon ni ni-edit"></em>--}}
{{--                                                                                <span>Edit</span>--}}
{{--                                                                            </a>--}}
{{--                                                                        </li>--}}
                                                                        <li>
{{--                                                                            <form action="{{ route('vendor-admin.hotel.destroy', $hotel) }}" method="POST" style="display:inline;">--}}
{{--                                                                                @csrf--}}
{{--                                                                                @method('DELETE')--}}
{{--                                                                                <button type="submit" class="btn-link" onclick="return confirm('Are you sure you want to delete this hotel?');">--}}
{{--                                                                                    <em class="icon ni ni-trash"></em>--}}
{{--                                                                                    <span>Delete</span>--}}
{{--                                                                                </button>--}}
{{--                                                                            </form>--}}
                                                                            <a href="javascript:void(0);" onclick="deleteHotel(event, '{{ route('vendor-admin.hotel.destroy', $hotel) }}')">
                                                                                <em class="icon ni ni-trash"></em>
                                                                                <span>Delete</span>
                                                                            </a>

                                                                            <form id="delete-hotel-form" action="" method="POST" style="display:none;">
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
@endsection
