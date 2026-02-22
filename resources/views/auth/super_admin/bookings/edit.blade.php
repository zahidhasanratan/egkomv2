@extends('auth.layout.super_admin_layout')

@section('mainbody')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .nk-content-body {
        padding: 20px;
    }
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .card-header {
        background: linear-gradient(135deg, #90278e 0%, #6d1c6a 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 8px 8px 0 0;
    }
    .card-title {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    .availability-calendar {
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }
    .calendar-day {
        padding: 8px;
        text-align: center;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.2s;
    }
    .calendar-day.other-month {
        color: #ccc;
        background: #f5f5f5;
    }
    .calendar-day.today {
        background: #e3f2fd;
        font-weight: bold;
        border: 2px solid #2196f3;
    }
    .calendar-day.available {
        background: #c8e6c9;
        color: #2e7d32;
        position: relative;
    }
    .calendar-day.available::after {
        content: '✓';
        position: absolute;
        top: 2px;
        right: 2px;
        font-size: 10px;
        color: #2e7d32;
        font-weight: bold;
    }
    .calendar-day.available:hover {
        background: #a5d6a7;
        transform: scale(1.1);
        z-index: 10;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .calendar-day.unavailable {
        background: #ffcdd2;
        color: #c62828;
        cursor: not-allowed;
        opacity: 0.7;
    }
    .calendar-day.selected {
        background: #90278e;
        color: white;
        font-weight: bold;
        box-shadow: 0 0 0 2px rgba(144, 39, 142, 0.3);
    }
    .calendar-day.range {
        background: #e1bee7;
        color: #4a148c;
        font-weight: 500;
    }
    .calendar-day.range-start {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }
    .calendar-day.range-end {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }
    .date-selection-info {
        margin-top: 15px;
        padding: 10px;
        background: #e3f2fd;
        border-left: 4px solid #2196f3;
        border-radius: 4px;
        font-size: 14px;
    }
    .date-selection-info strong {
        color: #1976d2;
    }
    .selection-hint {
        margin-top: 10px;
        padding: 8px;
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        border-radius: 4px;
        font-size: 12px;
        color: #856404;
    }
    .calendar-legend {
        display: flex;
        gap: 15px;
        margin-top: 15px;
        flex-wrap: wrap;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
    }
    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 4px;
    }
</style>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="container-fluid">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-edit"></i> Edit Booking - {{ $booking->invoice_number }}
                                    </h3>
                                    <div class="card-tools">
                                        <a href="{{ route('super-admin.bookings.index') }}" class="btn btn-sm btn-light">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="editBookingForm" action="{{ route('super-admin.bookings.update', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <!-- Hotel & Room (same order as create) -->
                                        @php
                                            $firstRoom = $booking->rooms_data[0] ?? null;
                                            $currentHotelId = $firstRoom['hotelId'] ?? null;
                                            $currentRoomId = $firstRoom['roomId'] ?? null;
                                            $pricePerNight = $firstRoom['price'] ?? 0;
                                        @endphp

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hotel_id">Hotel <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="hotel_id" name="hotel_id" required>
                                                        <option value="">-- Select Hotel --</option>
                                                        @foreach($hotels as $hotel)
                                                            <option value="{{ $hotel->id }}" {{ $currentHotelId == $hotel->id ? 'selected' : '' }}>
                                                                {{ $hotel->description ?? $hotel->property_category ?? 'Hotel #' . $hotel->id }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="room_id">Room <span class="text-danger">*</span></label>
                                                    <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                                                        <option value="">-- Select Room --</option>
                                                        @foreach($rooms as $room)
                                                            <option value="{{ $room->id }}" {{ $currentRoomId == $room->id ? 'selected' : '' }} data-price="{{ $room->price_per_night }}">
                                                                {{ $room->name }} - BDT {{ number_format($room->price_per_night, 2) }}/night
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('room_id')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="price_per_night">Price Per Night (BDT) <span class="text-danger">*</span></label>
                                                    <input type="number" name="price_per_night" id="price_per_night" class="form-control" step="0.01" min="0" value="{{ old('price_per_night', $pricePerNight) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="checkin_date">Check-in Date <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control @error('checkin_date') is-invalid @enderror" id="checkin_date" name="checkin_date" value="{{ old('checkin_date', $booking->checkin_date->format('Y-m-d')) }}" required>
                                                    @error('checkin_date')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="checkout_date">Check-out Date <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control @error('checkout_date') is-invalid @enderror" id="checkout_date" name="checkout_date" value="{{ old('checkout_date', $booking->checkout_date->format('Y-m-d')) }}" required>
                                                    @error('checkout_date')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Total Nights (dynamic from dates - readonly) -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="total_nights_display">Total Nights</label>
                                                    <input type="text" id="total_nights_display" class="form-control" readonly value="{{ $booking->total_nights }}">
                                                    <small class="text-muted">Auto-calculated from check-in / check-out dates</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="quantity">Room Quantity</label>
                                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $firstRoom['quantity'] ?? 1) }}" min="1">
                                                    @error('quantity')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="booking_status">Booking Status</label>
                                                    <select class="form-select" id="booking_status" name="booking_status">
                                                        <option value="pending" {{ old('booking_status', $booking->booking_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="confirmed" {{ old('booking_status', $booking->booking_status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                        <option value="staying" {{ old('booking_status', $booking->booking_status) == 'staying' ? 'selected' : '' }}>Staying</option>
                                                        <option value="completed" {{ old('booking_status', $booking->booking_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="cancelled" {{ old('booking_status', $booking->booking_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Payment (same as create) -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="payment_status">Payment Status</label>
                                                    <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status">
                                                        <option value="unpaid" {{ old('payment_status', $booking->payment_status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                                        <option value="partial" {{ old('payment_status', $booking->payment_status) == 'partial' ? 'selected' : '' }}>Partial</option>
                                                        <option value="paid" {{ old('payment_status', $booking->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                                    </select>
                                                    @error('payment_status')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paid_amount">Paid Amount (BDT)</label>
                                                    <input type="number" step="0.01" min="0" class="form-control @error('paid_amount') is-invalid @enderror" id="paid_amount" name="paid_amount" value="{{ old('paid_amount', $booking->paid_amount ?? 0) }}">
                                                    @error('paid_amount')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="discount">Discount (BDT)</label>
                                                    <input type="number" name="discount" id="discount" class="form-control" step="0.01" min="0" value="{{ old('discount', $booking->discount ?? 0) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="tax_percentage">Tax Percentage (%)</label>
                                                    <input type="number" name="tax_percentage" id="tax_percentage" class="form-control" step="0.01" min="0" max="100" value="{{ old('tax_percentage', $booking->tax_percentage ?? 15) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="platform_fee">Platform Fee (BDT)</label>
                                                    <input type="number" name="platform_fee" id="platform_fee" class="form-control" step="0.01" min="0" value="{{ old('platform_fee', $booking->platform_fee ?? 0) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pricing Summary (dynamic) -->
                                        <div class="col-12 mb-3">
                                            <div class="card" style="background: #f8f9fa;">
                                                <div class="card-body">
                                                    <h6 class="mb-3">Pricing Summary</h6>
                                                    @if($booking->coupon_code)
                                                    <div class="row mb-2">
                                                        <div class="col-12"><span class="badge bg-secondary">Coupon applied: {{ $booking->coupon_code }}</span></div>
                                                    </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-2"><strong>Subtotal:</strong> <span id="subtotal_display">BDT 0.00</span></div>
                                                        <div class="col-md-2"><strong>Discount:</strong> <span id="discount_display">BDT 0.00</span></div>
                                                        <div class="col-md-2"><strong>Tax:</strong> <span id="tax_display">BDT 0.00</span></div>
                                                        <div class="col-md-2"><strong>Platform Fee:</strong> <span id="platform_fee_display">BDT 0.00</span></div>
                                                        <div class="col-md-4"><strong>Grand Total:</strong> <span id="grand_total_display" style="font-size: 1.2em; color: #90278e;">BDT 0.00</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12"><hr><h5 class="mb-3">Guest Information</h5></div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="guest_name">Guest Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="guest_name" id="guest_name" class="form-control" value="{{ old('guest_name', $booking->guest_name) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="guest_phone">Guest Phone</label>
                                                    <input type="text" name="guest_phone" id="guest_phone" class="form-control" value="{{ old('guest_phone', $booking->guest_phone) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="guest_email">Guest Email</label>
                                                    <input type="email" name="guest_email" id="guest_email" class="form-control" value="{{ old('guest_email', $booking->guest_email) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="home_address">Home Address</label>
                                                    <textarea name="home_address" id="home_address" class="form-control" rows="2">{{ old('home_address', $booking->home_address) }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Admin Note -->
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="admin_note">Admin Note</label>
                                                    <textarea class="form-control @error('admin_note') is-invalid @enderror" id="admin_note" name="admin_note" rows="4" placeholder="Add any notes about this booking...">{{ old('admin_note', $booking->admin_note) }}</textarea>
                                                    @error('admin_note')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    <small class="form-text text-muted">This note is only visible to admins</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Availability Calendar -->
                                        <div class="availability-calendar" id="availabilityCalendar" style="display: none;">
                                            <div class="calendar-header">
                                                <button type="button" class="btn btn-sm btn-default" id="prevMonth">
                                                    <i class="fas fa-chevron-left"></i>
                                                </button>
                                                <h5 style="margin: 0;" id="calendarMonth"></h5>
                                                <button type="button" class="btn btn-sm btn-default" id="nextMonth">
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            </div>
                                            
                                            <!-- Selection Info -->
                                            <div class="date-selection-info" id="selectionInfo" style="display: none;">
                                                <strong><i class="fas fa-info-circle"></i> Selected Dates:</strong>
                                                <span id="selectionText">Click on available dates to select check-in and check-out</span>
                                            </div>
                                            
                                            <div class="selection-hint">
                                                <i class="fas fa-lightbulb"></i> <strong>Tip:</strong> Click an available date to set check-in, then click another date after it to set check-out. The calendar will highlight your selected range.
                                            </div>
                                            
                                            <div class="calendar-grid" id="calendarGrid">
                                                <!-- Calendar will be rendered here -->
                                            </div>
                                            <div class="calendar-legend">
                                                <div class="legend-item">
                                                    <div class="legend-color" style="background: #c8e6c9;"></div>
                                                    <span>Available</span>
                                                </div>
                                                <div class="legend-item">
                                                    <div class="legend-color" style="background: #ffcdd2;"></div>
                                                    <span>Unavailable/Booked</span>
                                                </div>
                                                <div class="legend-item">
                                                    <div class="legend-color" style="background: #e3f2fd; border: 2px solid #2196f3;"></div>
                                                    <span>Today</span>
                                                </div>
                                                <div class="legend-item">
                                                    <div class="legend-color" style="background: #90278e;"></div>
                                                    <span>Check-in/Check-out</span>
                                                </div>
                                                <div class="legend-item">
                                                    <div class="legend-color" style="background: #e1bee7;"></div>
                                                    <span>Selected Range</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="alert alert-info mt-3">
                                            <i class="fas fa-info-circle"></i> 
                                            <strong>How to select dates:</strong>
                                            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                                                <li><strong>Method 1:</strong> Click on available (green) dates in the calendar below - first click sets check-in, second click sets check-out</li>
                                                <li><strong>Method 2:</strong> Use the date input fields above to manually enter or select dates</li>
                                            </ul>
                                            <br>
                                            <strong>Note:</strong> When you change the check-in/check-out dates or room, the system will automatically check room availability. 
                                            If the room is not available for the selected dates, the update will be rejected.
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Update Booking
                                            </button>
                                            <a href="{{ route('super-admin.bookings.index') }}" class="btn btn-default">
                                                <i class="fas fa-times"></i> Cancel
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let availabilityData = {
        availability_dates: [],
        booked_dates: [],
        has_availability_dates: false
    };
    let currentCalendarMonth = new Date();
    let selectedCheckin = null;
    let selectedCheckout = null;

    function loadRooms(hotelId) {
        if (!hotelId) {
            document.getElementById('room_id').innerHTML = '<option value="">Select Room</option>';
            document.getElementById('availabilityCalendar').style.display = 'none';
            return;
        }
        
        fetch(`{{ url('super-admin/bookings/manual/rooms') }}/${hotelId}`)
            .then(response => response.json())
            .then(rooms => {
                const roomSelect = document.getElementById('room_id');
                roomSelect.innerHTML = '<option value="">Select Room</option>';
                
                rooms.forEach(room => {
                    const option = document.createElement('option');
                    option.value = room.id;
                    option.textContent = `${room.name} - BDT ${parseFloat(room.price_per_night).toFixed(2)}/night`;
                    option.setAttribute('data-price', room.price_per_night);
                    roomSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error loading rooms:', error);
                alert('Failed to load rooms. Please try again.');
            });
    }

    function loadAvailability(roomId) {
        if (!roomId) {
            document.getElementById('availabilityCalendar').style.display = 'none';
            return;
        }

        const bookingId = {{ $booking->id }};
        fetch(`{{ url('super-admin/bookings/room') }}/${roomId}/availability/${bookingId}`)
            .then(response => response.json())
            .then(data => {
                availabilityData = data;
                document.getElementById('availabilityCalendar').style.display = 'block';
                renderCalendar();
            })
            .catch(error => {
                console.error('Error loading availability:', error);
            });
    }

    function isDateAvailable(dateString) {
        // If room has availability dates set, check them
        if (availabilityData.has_availability_dates) {
            if (!availabilityData.availability_dates.includes(dateString)) {
                return false;
            }
        }
        
        // Check if date is booked
        if (availabilityData.booked_dates.includes(dateString)) {
            return false;
        }
        
        return true;
    }

    function renderCalendar() {
        const year = currentCalendarMonth.getFullYear();
        const month = currentCalendarMonth.getMonth();
        
        // Update month header
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 
                          'July', 'August', 'September', 'October', 'November', 'December'];
        document.getElementById('calendarMonth').textContent = `${monthNames[month]} ${year}`;
        
        // Get first day of month and number of days
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startingDayOfWeek = firstDay.getDay();
        
        // Get previous month's days to fill the grid
        const prevMonth = new Date(year, month, 0);
        const daysInPrevMonth = prevMonth.getDate();
        
        const grid = document.getElementById('calendarGrid');
        grid.innerHTML = '';
        
        // Day headers
        const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayHeaders.forEach(day => {
            const header = document.createElement('div');
            header.style.fontWeight = 'bold';
            header.style.padding = '8px';
            header.textContent = day;
            grid.appendChild(header);
        });
        
        // Previous month's days
        for (let i = startingDayOfWeek - 1; i >= 0; i--) {
            const day = daysInPrevMonth - i;
            const date = new Date(year, month - 1, day);
            const dateString = date.toISOString().split('T')[0];
            const dayElement = createDayElement(day, dateString, true);
            grid.appendChild(dayElement);
        }
        
        // Current month's days
        const today = new Date().toISOString().split('T')[0];
        const checkinDate = document.getElementById('checkin_date').value;
        const checkoutDate = document.getElementById('checkout_date').value;
        
        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(year, month, day);
            const dateString = date.toISOString().split('T')[0];
            const isInRange = checkinDate && checkoutDate && dateString >= checkinDate && dateString < checkoutDate;
            const isRangeStart = dateString === checkinDate;
            const isRangeEnd = dateString === checkoutDate;
            const dayElement = createDayElement(day, dateString, false, dateString === today, dateString === checkinDate, dateString === checkoutDate, isInRange, isRangeStart, isRangeEnd);
            grid.appendChild(dayElement);
        }
        
        // Next month's days to fill the grid
        const totalCells = grid.children.length;
        const remainingCells = 42 - totalCells; // 6 rows * 7 days
        for (let day = 1; day <= remainingCells; day++) {
            const date = new Date(year, month + 1, day);
            const dateString = date.toISOString().split('T')[0];
            const dayElement = createDayElement(day, dateString, true);
            grid.appendChild(dayElement);
        }
    }

    function createDayElement(day, dateString, isOtherMonth, isToday = false, isCheckin = false, isCheckout = false, isInRange = false, isRangeStart = false, isRangeEnd = false) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';
        dayElement.textContent = day;
        dayElement.dataset.date = dateString;
        
        if (isOtherMonth) {
            dayElement.classList.add('other-month');
        } else {
            const available = isDateAvailable(dateString);
            
            if (isToday) {
                dayElement.classList.add('today');
            }
            
            if (isCheckin || isCheckout) {
                dayElement.classList.add('selected');
            } else if (isInRange) {
                dayElement.classList.add('range');
                if (isRangeStart) {
                    dayElement.classList.add('range-start');
                }
                if (isRangeEnd) {
                    dayElement.classList.add('range-end');
                }
            } else if (!available) {
                dayElement.classList.add('unavailable');
            } else {
                dayElement.classList.add('available');
            }
            
            // Add click handler for available dates
            if (available && !isOtherMonth) {
                dayElement.style.cursor = 'pointer';
                dayElement.title = 'Click to select';
                dayElement.addEventListener('click', function() {
                    handleDateClick(dateString);
                });
            } else if (!available && !isOtherMonth) {
                dayElement.title = 'This date is not available';
            }
        }
        
        return dayElement;
    }

    function handleDateClick(dateString) {
        const checkinInput = document.getElementById('checkin_date');
        const checkoutInput = document.getElementById('checkout_date');
        const checkinValue = checkinInput.value;
        const checkoutValue = checkoutInput.value;
        
        if (!checkinValue || (checkinValue && checkoutValue)) {
            // Set check-in (or reset if both are set)
            checkinInput.value = dateString;
            checkoutInput.value = '';
            selectedCheckin = dateString;
            selectedCheckout = null;
            updateSelectionInfo(dateString, null);
            // Trigger change event to update min date for checkout
            checkinInput.dispatchEvent(new Event('change'));
        } else if (checkinValue && !checkoutValue) {
            // Set check-out
            if (dateString > checkinValue) {
                checkoutInput.value = dateString;
                selectedCheckout = dateString;
                updateSelectionInfo(checkinValue, dateString);
                checkoutInput.dispatchEvent(new Event('change'));
            } else {
                alert('Check-out date must be after check-in date. Please select a date after ' + formatDateForDisplay(checkinValue));
                return;
            }
        }
        
        renderCalendar();
    }

    function formatDateForDisplay(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    function updateSelectionInfo(checkin, checkout) {
        const infoDiv = document.getElementById('selectionInfo');
        const infoText = document.getElementById('selectionText');
        
        if (checkin && checkout) {
            const checkinDate = new Date(checkin);
            const checkoutDate = new Date(checkout);
            const nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
            
            infoDiv.style.display = 'block';
            infoText.innerHTML = `
                <strong>Check-in:</strong> ${formatDateForDisplay(checkin)} | 
                <strong>Check-out:</strong> ${formatDateForDisplay(checkout)} | 
                <strong>Nights:</strong> ${nights} night${nights !== 1 ? 's' : ''}
            `;
        } else if (checkin) {
            infoDiv.style.display = 'block';
            infoText.innerHTML = `
                <strong>Check-in:</strong> ${formatDateForDisplay(checkin)} | 
                <em>Now select your check-out date</em>
            `;
        } else {
            infoDiv.style.display = 'none';
        }
    }

    // Dynamic total nights from check-in / check-out
    function calculateNights() {
        const checkinInput = document.getElementById('checkin_date');
        const checkoutInput = document.getElementById('checkout_date');
        const totalNightsDisplay = document.getElementById('total_nights_display');
        if (!checkinInput || !checkoutInput || !totalNightsDisplay) return 0;
        if (checkinInput.value && checkoutInput.value) {
            const checkin = new Date(checkinInput.value);
            const checkout = new Date(checkoutInput.value);
            if (checkout > checkin) {
                const diffTime = Math.abs(checkout - checkin);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                totalNightsDisplay.value = diffDays;
                return diffDays;
            }
        }
        totalNightsDisplay.value = '0';
        return 0;
    }

    // Dynamic pricing summary (same logic as create form)
    function calculatePricing() {
        const priceInput = document.getElementById('price_per_night');
        const quantityInput = document.getElementById('quantity');
        const discountInput = document.getElementById('discount');
        const taxInput = document.getElementById('tax_percentage');
        const platformFeeInput = document.getElementById('platform_fee');
        if (!priceInput || !quantityInput) return;
        const price = parseFloat(priceInput.value) || 0;
        const quantity = parseInt(quantityInput.value, 10) || 1;
        const nights = calculateNights();
        const discount = parseFloat(discountInput?.value) || 0;
        const taxPct = parseFloat(taxInput?.value) || 15;
        const platformFee = parseFloat(platformFeeInput?.value) || 0;
        const subtotal = price * quantity * nights;
        const afterDiscount = subtotal - discount;
        const tax = afterDiscount * (taxPct / 100);
        const grandTotal = afterDiscount + tax + platformFee;
        const subtotalEl = document.getElementById('subtotal_display');
        const discountEl = document.getElementById('discount_display');
        const taxEl = document.getElementById('tax_display');
        const platformFeeEl = document.getElementById('platform_fee_display');
        const grandTotalEl = document.getElementById('grand_total_display');
        if (subtotalEl) subtotalEl.textContent = 'BDT ' + subtotal.toFixed(2);
        if (discountEl) discountEl.textContent = 'BDT ' + discount.toFixed(2);
        if (taxEl) taxEl.textContent = 'BDT ' + tax.toFixed(2);
        if (platformFeeEl) platformFeeEl.textContent = 'BDT ' + platformFee.toFixed(2);
        if (grandTotalEl) grandTotalEl.textContent = 'BDT ' + grandTotal.toFixed(2);
    }

    // Set minimum date to today
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('checkin_date').setAttribute('min', today);
        document.getElementById('checkout_date').setAttribute('min', today);

        // Hotel change: load rooms (same as create form)
        document.getElementById('hotel_id').addEventListener('change', function() {
            const hotelId = this.value;
            const roomSelect = document.getElementById('room_id');
            roomSelect.innerHTML = '<option value="">Loading...</option>';
            roomSelect.disabled = true;
            if (hotelId) {
                fetch(`{{ url('super-admin/bookings/manual/rooms') }}/${hotelId}`)
                    .then(r => r.json())
                    .then(data => {
                        roomSelect.innerHTML = '<option value="">-- Select Room --</option>';
                        data.forEach(room => {
                            const opt = document.createElement('option');
                            opt.value = room.id;
                            opt.textContent = (room.name || 'Room') + ' - BDT ' + (room.price_per_night || 0) + '/night';
                            opt.setAttribute('data-price', room.price_per_night || 0);
                            roomSelect.appendChild(opt);
                        });
                        roomSelect.disabled = false;
                        calculatePricing();
                    })
                    .catch(() => { roomSelect.innerHTML = '<option value="">Error loading rooms</option>'; roomSelect.disabled = false; });
            } else {
                roomSelect.innerHTML = '<option value="">-- Select Hotel First --</option>';
            }
        });

        // Room change: fill price, recalc, load availability
        document.getElementById('room_id').addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];
            if (opt && opt.getAttribute('data-price')) {
                document.getElementById('price_per_night').value = opt.getAttribute('data-price');
            }
            calculatePricing();
            if (this.value) loadAvailability(this.value);
            else document.getElementById('availabilityCalendar').style.display = 'none';
        });

        // Price, quantity, discount, tax, platform_fee: recalc
        ['price_per_night', 'quantity', 'discount', 'tax_percentage', 'platform_fee'].forEach(function(id) {
            const el = document.getElementById(id);
            if (el) { el.addEventListener('input', calculatePricing); el.addEventListener('change', calculatePricing); }
        });
        
        // Update checkout min date when checkin changes + recalc nights
        document.getElementById('checkin_date').addEventListener('change', function() {
            const checkinDate = this.value;
            if (checkinDate) {
                const nextDay = new Date(checkinDate);
                nextDay.setDate(nextDay.getDate() + 1);
                document.getElementById('checkout_date').setAttribute('min', nextDay.toISOString().split('T')[0]);
                const checkoutValue = document.getElementById('checkout_date').value;
                updateSelectionInfo(checkinDate, checkoutValue || null);
                renderCalendar();
            }
            calculatePricing();
        });
        
        document.getElementById('checkout_date').addEventListener('change', function() {
            const checkinValue = document.getElementById('checkin_date').value;
            const checkoutValue = this.value;
            updateSelectionInfo(checkinValue || null, checkoutValue || null);
            renderCalendar();
            calculatePricing();
        });
        
        // Calendar navigation
        document.getElementById('prevMonth').addEventListener('click', function() {
            currentCalendarMonth.setMonth(currentCalendarMonth.getMonth() - 1);
            renderCalendar();
        });
        
        document.getElementById('nextMonth').addEventListener('click', function() {
            currentCalendarMonth.setMonth(currentCalendarMonth.getMonth() + 1);
            renderCalendar();
        });
        
        // Initial: load availability if room selected, and run pricing
        const roomId = document.getElementById('room_id').value;
        if (roomId) loadAvailability(roomId);
        calculatePricing();

        // Form submit: show clear message if validation fails
        const editForm = document.getElementById('editBookingForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                if (!this.checkValidity()) {
                    e.preventDefault();
                    this.reportValidity();
                    var firstInvalid = this.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.focus();
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    alert('Please complete all required fields (marked with *). The first missing or invalid field has been highlighted.');
                    return false;
                }
            });
        }
    });
</script>
@endsection

