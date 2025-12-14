@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- Booking Details Card -->
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #90278e 0%, #6d1c6a 100%); color: white;">
                    <h3 class="card-title"><i class="fas fa-file-invoice"></i> Booking Details - {{ $booking->invoice_number }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('booking.invoice', $booking->id) }}" class="btn btn-sm btn-light" target="_blank">
                            <i class="fas fa-print"></i> Print Invoice
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Guest Information -->
                    <h5 style="color: #90278e; border-bottom: 2px solid #90278e; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fas fa-user"></i> Guest Information
                    </h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $booking->guest_name }}</p>
                            <p><strong>Phone:</strong> {{ $booking->guest_phone }}</p>
                            @if($booking->guest_email)
                            <p><strong>Email:</strong> {{ $booking->guest_email }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total Guests:</strong> {{ $booking->total_persons }}</p>
                            <p><strong>Male:</strong> {{ $booking->total_male }} | <strong>Female:</strong> {{ $booking->total_female }} | <strong>Kids:</strong> {{ $booking->total_kids }}</p>
                            <p><strong>Relationship:</strong> {{ ucfirst($booking->relationship) }}</p>
                        </div>
                    </div>

                    <!-- Rooms Booked -->
                    <h5 style="color: #90278e; border-bottom: 2px solid #90278e; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fas fa-bed"></i> Rooms Booked
                    </h5>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead style="background: #f8f9fa;">
                                <tr>
                                    <th>Room Name</th>
                                    <th>Quantity</th>
                                    <th>Price/Night</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->rooms_data as $room)
                                <tr>
                                    <td>{{ $room['roomName'] }}</td>
                                    <td>{{ $room['quantity'] }}</td>
                                    <td>BDT {{ number_format($room['price'], 2) }}</td>
                                    <td>BDT {{ number_format($room['price'] * $room['quantity'] * $booking->total_nights, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Booking Dates -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-sign-in-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Check-in</span>
                                    <span class="info-box-number">{{ $booking->checkin_date->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-sign-out-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Check-out</span>
                                    <span class="info-box-number">{{ $booking->checkout_date->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-moon"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Nights</span>
                                    <span class="info-box-number">{{ $booking->total_nights }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($booking->additional_requests))
                    <h5 style="color: #90278e; border-bottom: 2px solid #90278e; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fas fa-list"></i> Additional Requests
                    </h5>
                    <div class="mb-4">
                        @foreach($booking->additional_requests as $request)
                            <span class="badge badge-info mr-2">{{ $request }}</span>
                        @endforeach
                    </div>
                    @endif

                    @if($booking->property_note)
                    <h5 style="color: #90278e; border-bottom: 2px solid #90278e; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fas fa-sticky-note"></i> Note for Property
                    </h5>
                    <div class="alert alert-info">
                        {{ $booking->property_note }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Status Card -->
            <div class="card">
                <div class="card-header" style="background: #90278e; color: white;">
                    <h3 class="card-title">Booking Status</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendor.bookings.updateStatus', $booking->id) }}" method="POST" id="statusUpdateForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Update Status</label>
                            <select name="booking_status" id="booking_status" class="form-control">
                                <option value="pending" {{ $booking->booking_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->booking_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="staying" {{ $booking->booking_status == 'staying' ? 'selected' : '' }}>Staying</option>
                                <option value="completed" {{ $booking->booking_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->booking_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group" id="cancellation_comment_group" style="display: {{ $booking->booking_status == 'cancelled' ? 'block' : 'none' }};">
                            <label>Reason for Cancellation <span class="text-danger">*</span></label>
                            <textarea name="cancellation_comment" id="cancellation_comment" class="form-control" rows="4" placeholder="Please provide a reason for cancellation...">{{ old('cancellation_comment', $booking->cancellation_comment) }}</textarea>
                            @error('cancellation_comment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                    </form>
                </div>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const statusSelect = document.getElementById('booking_status');
                        const commentGroup = document.getElementById('cancellation_comment_group');
                        const commentTextarea = document.getElementById('cancellation_comment');
                        const form = document.getElementById('statusUpdateForm');
                        
                        function toggleCommentField() {
                            if (statusSelect.value === 'cancelled') {
                                commentGroup.style.display = 'block';
                                commentTextarea.setAttribute('required', 'required');
                            } else {
                                commentGroup.style.display = 'none';
                                commentTextarea.removeAttribute('required');
                                commentTextarea.value = '';
                            }
                        }
                        
                        statusSelect.addEventListener('change', toggleCommentField);
                        
                        // Validate form submission
                        form.addEventListener('submit', function(e) {
                            if (statusSelect.value === 'cancelled' && !commentTextarea.value.trim()) {
                                e.preventDefault();
                                alert('Please provide a reason for cancellation.');
                                commentTextarea.focus();
                                return false;
                            }
                        });
                    });
                </script>
            </div>

            <!-- Payment Summary -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Summary</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td>Subtotal:</td>
                            <td class="text-right"><strong>BDT {{ number_format($booking->subtotal, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td>Tax (15%):</td>
                            <td class="text-right"><strong>BDT {{ number_format($booking->tax, 2) }}</strong></td>
                        </tr>
                        <tr style="background: #f8f9fa; font-size: 16px;">
                            <td><strong>Grand Total:</strong></td>
                            <td class="text-right"><strong style="color: #90278e;">BDT {{ number_format($booking->grand_total, 2) }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('vendor.bookings.index') }}" class="btn btn-default btn-block">
                        <i class="fas fa-arrow-left"></i> Back to Bookings
                    </a>
                    <a href="{{ route('booking.invoice', $booking->id) }}" class="btn btn-info btn-block" target="_blank">
                        <i class="fas fa-file-invoice"></i> View Invoice
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
@endsection
