@extends('auth.layout.super_admin_layout')

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
                            <p><strong>Address:</strong><br>{{ $booking->home_address }}</p>
                            @if($booking->organization)
                            <p><strong>Organization:</strong> {{ $booking->organization }}</p>
                            @endif
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
                                    <th>Hotel</th>
                                    <th>Room Name</th>
                                    <th>Quantity</th>
                                    <th>Price/Night</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->rooms_data as $room)
                                @php
                                    $hotel = \App\Models\Hotel::find($room['hotelId'] ?? null);
                                    $hotelName = $room['hotelName'] ?? ($hotel->description ?? $hotel->property_category ?? 'Hotel');
                                @endphp
                                <tr>
                                    <td>{{ $hotelName }}</td>
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
                    <h5 style="color: #90278e; border-bottom: 2px solid #90278e; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fas fa-calendar"></i> Stay Duration
                    </h5>
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

                    <!-- Guest Count -->
                    <h5 style="color: #90278e; border-bottom: 2px solid #90278e; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fas fa-users"></i> Guest Details
                    </h5>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <p><strong>Total Male:</strong> {{ $booking->total_male }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Total Female:</strong> {{ $booking->total_female }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Total Kids:</strong> {{ $booking->total_kids }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Total Persons:</strong> <span class="badge badge-primary">{{ $booking->total_persons }}</span></p>
                        </div>
                    </div>

                    @if(!empty($booking->other_guests))
                    <div class="mb-4">
                        <strong>Other Guests:</strong>
                        <p>{{ implode(', ', $booking->other_guests) }}</p>
                    </div>
                    @endif

                    <!-- Additional Requests -->
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

                    <!-- Room Preferences -->
                    <h5 style="color: #90278e; border-bottom: 2px solid #90278e; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fas fa-cog"></i> Room Preferences
                    </h5>
                    <div class="row mb-4">
                        @if($booking->bed_type)
                        <div class="col-md-6">
                            <p><strong>Bed Type:</strong> {{ ucfirst(str_replace('_', ' ', $booking->bed_type)) }}</p>
                        </div>
                        @endif
                        <div class="col-md-6">
                            <p><strong>Room Preference:</strong> {{ ucfirst(str_replace('_', '-', $booking->room_preference)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Relationship:</strong> {{ ucfirst($booking->relationship) }}</p>
                        </div>
                        @if($booking->arrival_time)
                        <div class="col-md-6">
                            <p><strong>Arrival Time:</strong> 
                                @php
                                    $hour = intval($booking->arrival_time);
                                    if ($hour == -1) {
                                        echo "Don't know";
                                    } else {
                                        echo sprintf("%02d:00 - %02d:00", $hour % 24, ($hour + 1) % 24);
                                    }
                                @endphp
                            </p>
                        </div>
                        @endif
                    </div>

                    <!-- Property Note -->
                    @if($booking->property_note)
                    <h5 style="color: #90278e; border-bottom: 2px solid #90278e; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fas fa-sticky-note"></i> Note for Property
                    </h5>
                    <div class="alert alert-info">
                        {{ $booking->property_note }}
                    </div>
                    @endif

                    <!-- Documents -->
                    @if($booking->nid_front || $booking->passport)
                    <h5 style="color: #90278e; border-bottom: 2px solid #90278e; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fas fa-id-card"></i> Identity Documents
                    </h5>
                    <div class="row mb-4">
                        @if($booking->nid_front)
                        <div class="col-md-6">
                            <p><strong>NID Front:</strong></p>
                            <a href="{{ asset('storage/' . $booking->nid_front) }}" target="_blank">
                                <img src="{{ asset('storage/' . $booking->nid_front) }}" style="max-width: 100%; border: 1px solid #ddd; border-radius: 4px;">
                            </a>
                        </div>
                        @endif
                        @if($booking->nid_back)
                        <div class="col-md-6">
                            <p><strong>NID Back:</strong></p>
                            <a href="{{ asset('storage/' . $booking->nid_back) }}" target="_blank">
                                <img src="{{ asset('storage/' . $booking->nid_back) }}" style="max-width: 100%; border: 1px solid #ddd; border-radius: 4px;">
                            </a>
                        </div>
                        @endif
                        @if($booking->passport)
                        <div class="col-md-6">
                            <p><strong>Passport:</strong></p>
                            <a href="{{ asset('storage/' . $booking->passport) }}" target="_blank">
                                <img src="{{ asset('storage/' . $booking->passport) }}" style="max-width: 100%; border: 1px solid #ddd; border-radius: 4px;">
                            </a>
                        </div>
                        @endif
                        @if($booking->visa)
                        <div class="col-md-6">
                            <p><strong>Visa:</strong></p>
                            <a href="{{ asset('storage/' . $booking->visa) }}" target="_blank">
                                <img src="{{ asset('storage/' . $booking->visa) }}" style="max-width: 100%; border: 1px solid #ddd; border-radius: 4px;">
                            </a>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar - Status & Actions -->
        <div class="col-md-4">
            <!-- Status Card -->
            <div class="card">
                <div class="card-header" style="background: #90278e; color: white;">
                    <h3 class="card-title">Booking Status</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('super-admin.bookings.updateStatus', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Update Status</label>
                            <select name="booking_status" class="form-control">
                                <option value="pending" {{ $booking->booking_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->booking_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->booking_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->booking_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                    </form>
                </div>
            </div>

            <!-- Payment Summary Card -->
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
                        @if($booking->discount > 0)
                        <tr>
                            <td>Discount:</td>
                            <td class="text-right text-danger"><strong>-BDT {{ number_format($booking->discount, 2) }}</strong></td>
                        </tr>
                        @endif
                        <tr>
                            <td>Tax (15%):</td>
                            <td class="text-right"><strong>BDT {{ number_format($booking->tax, 2) }}</strong></td>
                        </tr>
                        <tr style="background: #f8f9fa; font-size: 16px;">
                            <td><strong>Grand Total:</strong></td>
                            <td class="text-right"><strong style="color: #90278e;">BDT {{ number_format($booking->grand_total, 2) }}</strong></td>
                        </tr>
                    </table>
                    
                    <hr>
                    
                    <div class="text-center">
                        <p class="mb-2"><strong>Payment Status:</strong></p>
                        <span class="badge badge-{{ $booking->payment_status == 'paid' ? 'success' : ($booking->payment_status == 'partial' ? 'warning' : 'danger') }} px-4 py-2">
                            {{ strtoupper($booking->payment_status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Actions</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('super-admin.bookings.index') }}" class="btn btn-default btn-block">
                        <i class="fas fa-arrow-left"></i> Back to Bookings
                    </a>
                    <a href="{{ route('booking.invoice', $booking->id) }}" class="btn btn-info btn-block" target="_blank">
                        <i class="fas fa-file-invoice"></i> View Invoice
                    </a>
                    <button type="button" class="btn btn-danger btn-block" onclick="deleteBooking()">
                        <i class="fas fa-trash"></i> Delete Booking
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" action="{{ route('super-admin.bookings.destroy', $booking->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function deleteBooking() {
        if (confirm('Are you sure you want to delete this booking? This action cannot be undone.')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
            </div>
        </div>
    </div>
</div>
@endsection

