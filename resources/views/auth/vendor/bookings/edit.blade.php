@extends('auth.layout.vendor_admin_layout')

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
                                        <a href="{{ route('vendor.bookings.index') }}" class="btn btn-sm btn-light">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('vendor.bookings.update', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="checkin_date">Check-in Date <span class="text-danger">*</span></label>
                                                    <input type="date" 
                                                           class="form-control @error('checkin_date') is-invalid @enderror" 
                                                           id="checkin_date" 
                                                           name="checkin_date" 
                                                           value="{{ old('checkin_date', $booking->checkin_date->format('Y-m-d')) }}" 
                                                           required>
                                                    @error('checkin_date')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="checkout_date">Check-out Date <span class="text-danger">*</span></label>
                                                    <input type="date" 
                                                           class="form-control @error('checkout_date') is-invalid @enderror" 
                                                           id="checkout_date" 
                                                           name="checkout_date" 
                                                           value="{{ old('checkout_date', $booking->checkout_date->format('Y-m-d')) }}" 
                                                           required>
                                                    @error('checkout_date')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
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

                                        @php
                                            $firstRoom = $booking->rooms_data[0] ?? null;
                                            $currentHotelId = $firstRoom['hotelId'] ?? null;
                                            $currentRoomId = $firstRoom['roomId'] ?? null;
                                        @endphp

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hotel_id">Hotel</label>
                                                    <select class="form-control" id="hotel_id" name="hotel_id" onchange="loadRooms(this.value)">
                                                        <option value="">Select Hotel</option>
                                                        @foreach($hotels as $hotel)
                                                            <option value="{{ $hotel->id }}" 
                                                                {{ $currentHotelId == $hotel->id ? 'selected' : '' }}>
                                                                {{ $hotel->description ?? $hotel->property_category ?? 'Hotel' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="room_id">Room</label>
                                                    <select class="form-control @error('room_id') is-invalid @enderror" 
                                                            id="room_id" 
                                                            name="room_id">
                                                        <option value="">Select Room</option>
                                                        @foreach($rooms as $room)
                                                            <option value="{{ $room->id }}" 
                                                                {{ $currentRoomId == $room->id ? 'selected' : '' }}
                                                                data-price="{{ $room->price_per_night }}">
                                                                {{ $room->name }} - BDT {{ number_format($room->price_per_night, 2) }}/night
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('room_id')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    <small class="form-text text-muted">
                                                        <i class="fas fa-info-circle"></i> Changing room will check availability for selected dates
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="quantity">Night</label>
                                                    <input type="number" 
                                                           class="form-control @error('quantity') is-invalid @enderror" 
                                                           id="quantity" 
                                                           name="quantity" 
                                                           value="{{ old('quantity', $firstRoom['quantity'] ?? 1) }}" 
                                                           min="1">
                                                    @error('quantity')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="admin_note">Admin Note</label>
                                            <textarea class="form-control @error('admin_note') is-invalid @enderror" 
                                                      id="admin_note" 
                                                      name="admin_note" 
                                                      rows="4" 
                                                      placeholder="Add any notes about this booking...">{{ old('admin_note', $booking->admin_note) }}</textarea>
                                            @error('admin_note')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle"></i> This note is only visible to admins
                                            </small>
                                        </div>

                                        <div class="alert alert-info">
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
                                            <a href="{{ route('vendor.bookings.index') }}" class="btn btn-default">
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
        
        fetch(`{{ url('vendor-admin/bookings/manual/rooms') }}/${hotelId}`)
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
        fetch(`{{ url('vendor-admin/bookings/room') }}/${roomId}/availability/${bookingId}`)
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

    // Set minimum date to today
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('checkin_date').setAttribute('min', today);
        document.getElementById('checkout_date').setAttribute('min', today);
        
        // Update checkout min date when checkin changes
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
        });
        
        document.getElementById('checkout_date').addEventListener('change', function() {
            const checkinValue = document.getElementById('checkin_date').value;
            const checkoutValue = this.value;
            updateSelectionInfo(checkinValue || null, checkoutValue || null);
            renderCalendar();
        });
        
        // Load availability when room is selected
        document.getElementById('room_id').addEventListener('change', function() {
            if (this.value) {
                loadAvailability(this.value);
            } else {
                document.getElementById('availabilityCalendar').style.display = 'none';
            }
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
        
        // Load availability if room is already selected
        const roomId = document.getElementById('room_id').value;
        if (roomId) {
            loadAvailability(roomId);
        }
    });
</script>
@endsection

