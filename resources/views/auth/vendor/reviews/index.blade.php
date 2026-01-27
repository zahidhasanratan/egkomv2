@extends('auth.layout.vendor_admin_layout')

@section('mainbody')

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <em class="icon ni ni-check-circle"></em> {{ session('success') }}
                </div>
                @endif
                
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <em class="icon ni ni-alert-circle"></em> {{ session('error') }}
                </div>
                @endif

                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Reviews Management</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                    <em class="icon ni ni-menu-alt-r"></em>
                                </a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <form method="GET" action="{{ route('vendor.reviews.index') }}" class="d-flex align-items-center gap-2">
                                                <select name="status" class="form-select form-select-sm" style="min-width: 120px;" onchange="this.form.submit()">
                                                    <option value="">All Reviews</option>
                                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                                </select>
                                                @if($hotels->count() > 0)
                                                <select name="hotel_id" class="form-select form-select-sm" style="min-width: 180px;" onchange="this.form.submit()">
                                                    <option value="">All Hotels</option>
                                                    @foreach($hotels as $hotel)
                                                        <option value="{{ $hotel->id }}" {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                                            {{ Str::limit($hotel->description ?? $hotel->property_category ?? 'Hotel #' . $hotel->id, 30) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @endif
                                                <div class="input-group input-group-sm" style="min-width: 200px;">
                                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                                    <button type="submit" class="btn btn-outline-light">
                                                        <em class="icon ni ni-search"></em>
                                                    </button>
                                                </div>
                                            </form>
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
                            <form id="bulkActionForm" method="POST" action="{{ route('vendor.reviews.bulk-approve') }}">
                                @csrf
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <table id="reviews-table" class="table table-striped" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 40px;">
                                                        <input type="checkbox" class="form-check-input" id="selectAll" style="cursor: pointer;">
                                                    </th>
                                                    <th>Reviewer</th>
                                                    <th>Hotel</th>
                                                    <th>Rating</th>
                                                    <th>Title</th>
                                                    <th>Comment</th>
                                                    <th>Images</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($reviews as $review)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="review_ids[]" value="{{ $review->id }}" class="form-check-input review-checkbox" id="review-{{ $review->id }}" style="cursor: pointer;">
                                                    </td>
                                                    <td>
                                                        <div class="user-card">
                                                            <div class="user-avatar bg-primary">
                                                                <span>{{ strtoupper(substr($review->guest->name ?? 'G', 0, 1)) }}</span>
                                                            </div>
                                                            <div class="user-info">
                                                                <span class="tb-lead">{{ $review->guest->name ?? 'Guest' }}</span>
                                                                <span>{{ Str::limit($review->guest->email ?? 'N/A', 25) }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="tb-status">{{ Str::limit($review->hotel->description ?? $review->hotel->property_category ?? 'Hotel #' . $review->hotel_id, 30) }}</span>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $rating = $review->overall_rating;
                                                            $ratingClass = $rating >= 8 ? 'text-success' : ($rating >= 6 ? 'text-info' : ($rating >= 4 ? 'text-warning' : 'text-danger'));
                                                        @endphp
                                                        <span class="tb-status {{ $ratingClass }}">
                                                            <strong>{{ number_format($rating, 1) }}/10</strong>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="tb-lead">{{ $review->title ?? 'No Title' }}</span>
                                                        @if($review->is_featured)
                                                            <span class="badge badge-warning ms-1">
                                                                <em class="icon ni ni-star-fill"></em> Featured
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="tb-status text-soft">{{ Str::limit($review->comment ?? 'No comment', 60) }}</span>
                                                    </td>
                                                    <td style="vertical-align: middle; text-align: center;">
                                                        @if($review->images && is_array($review->images) && count($review->images) > 0)
                                                            <div class="d-flex gap-1 align-items-center justify-content-center flex-wrap" style="min-height: 40px;">
                                                                @foreach(array_slice($review->images, 0, 2) as $image)
                                                                    @php
                                                                        // Handle different path formats - prioritize public/uploads
                                                                        if (strpos($image, 'http') === 0) {
                                                                            $imageUrl = $image;
                                                                        } elseif (strpos($image, 'uploads/') === 0) {
                                                                            $imageUrl = asset($image);
                                                                        } elseif (strpos($image, 'storage/') === 0) {
                                                                            $imageUrl = asset($image);
                                                                        } elseif (strpos($image, '/') === 0) {
                                                                            $imageUrl = asset($image);
                                                                        } else {
                                                                            // Default to uploads/reviews for new uploads
                                                                            $imageUrl = asset('uploads/reviews/' . $image);
                                                                        }
                                                                    @endphp
                                                                    <img src="{{ $imageUrl }}" alt="Review Image" 
                                                                         onerror="this.style.display='none';"
                                                                         style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 1px solid #e0e0e0; display: block; flex-shrink: 0;" 
                                                                         onclick="window.open('{{ $imageUrl }}', '_blank')" 
                                                                         title="Click to view full size">
                                                                @endforeach
                                                                @if(count($review->images) > 2)
                                                                    <span class="badge badge-dim badge-sm" style="flex-shrink: 0;">+{{ count($review->images) - 2 }}</span>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <span class="text-soft">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($review->is_approved)
                                                            <span class="badge badge-success badge-sm" style="background-color: #10b981; color: white; padding: 4px 8px; border-radius: 4px;">
                                                                <em class="icon ni ni-check-circle"></em> Approved
                                                            </span>
                                                        @else
                                                            <span class="badge badge-warning badge-sm" style="background-color: #f59e0b; color: white; padding: 4px 8px; border-radius: 4px;">
                                                                <em class="icon ni ni-clock"></em> Pending
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="tb-date">{{ $review->created_at->format('M d, Y') }}</span>
                                                        <span class="tb-date text-soft d-block" style="font-size: 11px;">{{ $review->created_at->format('h:i A') }}</span>
                                                    </td>
                                                    <td>
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <em class="icon ni ni-more-h"></em>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li>
                                                                                <a href="{{ route('vendor.reviews.show', $review->id) }}">
                                                                                    <em class="icon ni ni-eye"></em><span>View Details</span>
                                                                                </a>
                                                                            </li>
                                                                            @if(!$review->is_approved)
                                                                            <li>
                                                                                <form method="POST" action="{{ route('vendor.reviews.approve', $review->id) }}" class="d-inline">
                                                                                    @csrf
                                                                                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                                                        <em class="icon ni ni-check-circle"></em><span>Approve</span>
                                                                                    </a>
                                                                                </form>
                                                                            </li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="10" class="text-center py-5">
                                                        <div class="text-soft">
                                                            <em class="icon ni ni-inbox" style="font-size: 48px; opacity: 0.3;"></em>
                                                            <p class="mt-2 mb-0">No reviews found</p>
                                                            <small>Try adjusting your filters</small>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @if($reviews->count() > 0)
                                <div class="card-inner border-top" style="padding: 15px;">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-success btn-sm" onclick="bulkApprove()">
                                                <em class="icon ni ni-check-circle"></em> Approve Selected
                                            </button>
                                        </div>
                                        <span class="text-soft" style="font-size: 12px;">
                                            <span id="selectedCount">0</span> selected
                                        </span>
                                    </div>
                                </div>
                                @endif

                                @if($reviews->hasPages())
                                <div class="card-inner border-top">
                                    <div class="d-flex justify-content-center">
                                        {{ $reviews->links() }}
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
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
    let table;
    $(document).ready(function () {
        // Initialize DataTables
        table = $('#reviews-table').DataTable({
            "paging": true,
            "searching": false, // We have custom search
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 25,
            "order": [[8, "desc"]], // Sort by date descending
            "columnDefs": [
                { "orderable": false, "targets": [0, 6, 9] }, // Disable sorting on checkbox, images, and actions columns
                { "width": "40px", "targets": [0] },
                { "width": "150px", "targets": [1] },
                { "width": "180px", "targets": [2] },
                { "width": "90px", "targets": [3] },
                { "width": "150px", "targets": [4] },
                { "width": "200px", "targets": [5] },
                { "width": "120px", "targets": [6] },
                { "width": "110px", "targets": [7] },
                { "width": "130px", "targets": [8] },
                { "width": "140px", "targets": [9] }
            ],
            "drawCallback": function() {
                // Re-attach event listeners after DataTables redraws
                attachCheckboxListeners();
            },
            "language": {
                "emptyTable": "No reviews found",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "lengthMenu": "Show _MENU_ entries"
            }
        });
    });

    // Attach checkbox listeners
    function attachCheckboxListeners() {
        // Select all checkbox
        const selectAll = document.getElementById('selectAll');
        if (selectAll) {
            selectAll.onchange = function() {
                const checkboxes = document.querySelectorAll('.review-checkbox');
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateSelectedCount();
            };
        }

        // Individual checkboxes
        const checkboxes = document.querySelectorAll('.review-checkbox');
        checkboxes.forEach(cb => {
            cb.onchange = function() {
                updateSelectedCount();
                // Update select all checkbox state
                const allChecked = document.querySelectorAll('.review-checkbox:checked').length === checkboxes.length;
                if (selectAll) {
                    selectAll.checked = allChecked && checkboxes.length > 0;
                }
            };
        });
        
        updateSelectedCount();
    }

    // Update selected count
    function updateSelectedCount() {
        const checked = document.querySelectorAll('.review-checkbox:checked');
        const countEl = document.getElementById('selectedCount');
        if (countEl) {
            countEl.textContent = checked.length;
        }
    }

    // Initialize on page load
    $(document).ready(function() {
        attachCheckboxListeners();
    });

    function bulkApprove() {
        const form = document.getElementById('bulkActionForm');
        const checked = document.querySelectorAll('.review-checkbox:checked');
        
        if (checked.length === 0) {
            alert('Please select at least one review');
            return;
        }
        
        if (confirm(`Approve ${checked.length} review(s)?`)) {
            form.action = '{{ route("vendor.reviews.bulk-approve") }}';
            form.method = 'POST';
            form.submit();
        }
    }
</script>

<style>
    .form-check-input {
        width: 18px !important;
        height: 18px !important;
        margin-top: 0.25rem;
        cursor: pointer;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    .badge-sm {
        font-size: 10px;
        padding: 2px 6px;
    }
    .badge-success {
        background-color: #10b981 !important;
        color: white !important;
        padding: 4px 8px !important;
        border-radius: 4px !important;
        display: inline-block !important;
        font-size: 11px !important;
    }
    .badge-warning {
        background-color: #f59e0b !important;
        color: white !important;
        padding: 4px 8px !important;
        border-radius: 4px !important;
        display: inline-block !important;
        font-size: 11px !important;
    }
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
        background-color: #6576ff !important;
    }
    .user-info {
        margin-left: 10px;
        display: inline-block;
        vertical-align: middle;
    }
    .user-card {
        display: flex;
        align-items: center;
    }
    .tb-lead {
        display: block;
        font-weight: 500;
        color: #495057;
        font-size: 13px;
        line-height: 1.4;
    }
    .tb-status {
        display: block;
        color: #6c757d;
        font-size: 13px;
        line-height: 1.4;
    }
    .tb-date {
        display: block;
        font-size: 13px;
        color: #495057;
        line-height: 1.4;
    }
    .text-soft {
        color: #8b95a7 !important;
    }
    #reviews-table {
        width: 100% !important;
    }
    #reviews-table tbody td {
        vertical-align: middle;
        padding: 12px 8px;
    }
    #reviews-table thead th {
        background-color: #f8f9fa;
        font-weight: 600;
        padding: 12px 8px;
        white-space: nowrap;
    }
    #reviews-table tbody tr {
        transition: background-color 0.2s;
    }
    #reviews-table tbody tr:hover {
        background-color: #f8f9fa;
    }
    .reviewer-info {
        display: flex;
        align-items: center;
    }
    .reviewer-avatar {
        flex-shrink: 0;
    }
</style>

@endsection
