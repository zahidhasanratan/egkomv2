@extends('auth.layout.vendor_admin_layout')
@section('title', 'All Rooms')
@section('mainbody')

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">All Rooms</h3>
                            <div class="nk-block-des text-soft">
                                <p>View all rooms across all your hotels</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible mt-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card card-bordered card-stretch">
                    <div class="card-inner-group">
                        <div class="card-inner p-0">
                            @if($rooms->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead style="background: #f8f9fa;">
                                        <tr>
                                            <th>Hotel</th>
                                            <th>Room Name</th>
                                            <th>Room Number</th>
                                            <th>Floor</th>
                                            <th>Price / Night</th>
                                            <th>Status</th>
                                            <th>Active</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rooms as $room)
                                        <tr>
                                            <td>
                                                @if($room->hotel)
                                                    <a href="{{ route('vendor-admin.room.index', \Illuminate\Support\Facades\Crypt::encrypt($room->hotel->id)) }}" class="text-primary">
                                                        <strong>{{ $room->hotel->description }}</strong>
                                                    </a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $room->name ?? '—' }}</td>
                                            <td>{{ $room->number ?? '—' }}</td>
                                            <td>{{ $room->floor_number ?? '—' }}</td>
                                            <td>{{ $room->price_per_night ?? '0' }}</td>
                                            <td>
                                                @php
                                                    $st = $room->status ?? 'draft';
                                                    $isSuccess = in_array($st, ['submitted', 'published']);
                                                @endphp
                                                <span class="badge" style="{{ $isSuccess ? 'background:#198754;color:#fff' : 'background:#495057;color:#fff' }};">{{ ucfirst($st) }}</span>
                                            </td>
                                            <td>{{ $room->is_active ? 'Active' : 'Inactive' }}</td>
                                            <td class="text-end">
                                                @if($room->hotel)
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="{{ route('vendor-admin.room.edit', $room) }}">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>Edit</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" onclick="deleteRoom(event, '{{ route('vendor-admin.room.destroy', $room) }}')">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">
                                        {{ $rooms->links() }}
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="card-inner text-center py-5">
                                <em class="icon ni ni-home-alt" style="font-size: 48px; color: #ddd;"></em>
                                <h5 class="mt-3 text-soft">No rooms yet</h5>
                                <p class="text-soft">Add rooms from your hotel room lists.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="delete-room-form" action="" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function deleteRoom(event, url) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this room?')) {
            document.getElementById('delete-room-form').action = url;
            document.getElementById('delete-room-form').submit();
        }
    }
</script>

@endsection
