@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Create Manual Booking</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.bookings.index') }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em> Back to Bookings
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <form action="{{ route('super-admin.bookings.manual.store') }}" method="POST" enctype="multipart/form-data" id="manualOrderForm">
                                    @csrf
                                    
                                    <div class="row gy-4">
                                        <!-- Hotel Selection -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Select Hotel <span class="text-danger">*</span></label>
                                                <select name="hotel_id" id="hotel_id" class="form-select" required>
                                                    <option value="">-- Select Hotel --</option>
                                                    @foreach($hotels as $hotel)
                                                        <option value="{{ $hotel->id }}">{{ $hotel->description ?? $hotel->property_category ?? 'Hotel #' . $hotel->id }}</option>
                                                    @endforeach
                                                </select>
                                                @error('hotel_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Room Selection -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Select Room <span class="text-danger">*</span></label>
                                                <select name="room_id" id="room_id" class="form-select" required disabled>
                                                    <option value="">-- Select Hotel First --</option>
                                                </select>
                                                @error('room_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Night -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Night <span class="text-danger">*</span></label>
                                                <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
                                                @error('quantity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Price Per Night -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Price Per Night (BDT) <span class="text-danger">*</span></label>
                                                <input type="number" name="price_per_night" id="price_per_night" class="form-control" step="0.01" min="0" required>
                                                @error('price_per_night')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Check-in Date -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Check-in Date <span class="text-danger">*</span></label>
                                                <input type="date" name="checkin_date" id="checkin_date" class="form-control" required>
                                                @error('checkin_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Check-out Date -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Check-out Date <span class="text-danger">*</span></label>
                                                <input type="date" name="checkout_date" id="checkout_date" class="form-control" required>
                                                @error('checkout_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Total Nights (Auto-calculated) -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Total Nights</label>
                                                <input type="text" id="total_nights" class="form-control" readonly value="0">
                                            </div>
                                        </div>

                                        <!-- Booking Status -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Booking Status</label>
                                                <select name="booking_status" class="form-select">
                                                    <option value="pending">Pending</option>
                                                    <option value="confirmed" selected>Confirmed</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Payment Status -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Payment Status</label>
                                                <select name="payment_status" class="form-select">
                                                    <option value="unpaid" selected>Unpaid</option>
                                                    <option value="partial">Partial</option>
                                                    <option value="paid">Paid</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Paid Amount -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Paid Amount (BDT)</label>
                                                <input type="number" name="paid_amount" class="form-control" step="0.01" min="0" value="0">
                                            </div>
                                        </div>

                                        <!-- Discount -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Discount (BDT)</label>
                                                <input type="number" name="discount" id="discount" class="form-control" step="0.01" min="0" value="0">
                                            </div>
                                        </div>

                                        <!-- Tax Percentage -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Tax Percentage (%)</label>
                                                <input type="number" name="tax_percentage" id="tax_percentage" class="form-control" step="0.01" min="0" max="100" value="15">
                                            </div>
                                        </div>

                                        <!-- Pricing Summary -->
                                        <div class="col-md-12">
                                            <div class="card" style="background: #f8f9fa;">
                                                <div class="card-body">
                                                    <h6 class="mb-3">Pricing Summary</h6>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <strong>Subtotal:</strong> <span id="subtotal_display">BDT 0.00</span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <strong>Discount:</strong> <span id="discount_display">BDT 0.00</span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <strong>Tax:</strong> <span id="tax_display">BDT 0.00</span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <strong>Grand Total:</strong> <span id="grand_total_display" style="font-size: 1.2em; color: #90278e;">BDT 0.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <hr>
                                            <h5 class="mb-3">Guest Information</h5>
                                        </div>

                                        <!-- Guest Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Guest Name <span class="text-danger">*</span></label>
                                                <input type="text" name="guest_name" class="form-control" required>
                                                @error('guest_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Guest Phone -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Guest Phone <span class="text-danger">*</span></label>
                                                <input type="text" name="guest_phone" class="form-control" required>
                                                @error('guest_phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Guest Email -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Guest Email</label>
                                                <input type="email" name="guest_email" class="form-control">
                                                @error('guest_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Home Address -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Home Address <span class="text-danger">*</span></label>
                                                <textarea name="home_address" class="form-control" rows="2" required></textarea>
                                                @error('home_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Total Persons -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Total Persons</label>
                                                <input type="number" name="total_persons" class="form-control" min="1" value="1">
                                            </div>
                                        </div>

                                        <!-- Total Male -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Total Male</label>
                                                <input type="number" name="total_male" class="form-control" min="0" value="0">
                                            </div>
                                        </div>

                                        <!-- Total Female -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Total Female</label>
                                                <input type="number" name="total_female" class="form-control" min="0" value="0">
                                            </div>
                                        </div>

                                        <!-- Total Kids -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Total Kids</label>
                                                <input type="number" name="total_kids" class="form-control" min="0" value="0">
                                            </div>
                                        </div>

                                        <!-- Arrival Time -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Arrival Time</label>
                                                <input type="time" name="arrival_time" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Relationship -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Relationship</label>
                                                <select name="relationship" class="form-select">
                                                    <option value="onlyMe">Only Me</option>
                                                    <option value="family">Family</option>
                                                    <option value="husband">Husband</option>
                                                    <option value="friends">Friends</option>
                                                    <option value="colleagues">Colleagues</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Bed Type -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Bed Type</label>
                                                <select name="bed_type" class="form-select">
                                                    <option value="">-- Select --</option>
                                                    <option value="large_bed">Large Bed</option>
                                                    <option value="twin_beds">Twin Beds</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Room Preference -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Room Preference</label>
                                                <select name="room_preference" class="form-select">
                                                    <option value="non_smoking">Non-Smoking</option>
                                                    <option value="smoking">Smoking</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Citizenship -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Citizenship</label>
                                                <select name="citizenship" class="form-select">
                                                    <option value="">-- Select --</option>
                                                    <option value="bangladesh">Bangladesh</option>
                                                    <option value="international">International</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Organization -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Organization</label>
                                                <input type="text" name="organization" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Organization Address -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Organization Address</label>
                                                <input type="text" name="organization_address" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Room Type -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Room Type</label>
                                                <input type="text" name="room_type" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Room Number -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Room Number</label>
                                                <input type="text" name="room_number" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Property Note -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Property Note</label>
                                                <textarea name="property_note" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <!-- Documents -->
                                        <div class="col-md-12">
                                            <hr>
                                            <h5 class="mb-3">Documents (Optional)</h5>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">NID Front</label>
                                                <input type="file" name="nid_front" class="form-control" accept="image/*">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">NID Back</label>
                                                <input type="file" name="nid_back" class="form-control" accept="image/*">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Passport</label>
                                                <input type="file" name="passport" class="form-control" accept="image/*">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Visa</label>
                                                <input type="file" name="visa" class="form-control" accept="image/*">
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-md-12">
                                            <hr>
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <em class="icon ni ni-save"></em> Create Manual Booking
                                            </button>
                                            <a href="{{ route('super-admin.bookings.index') }}" class="btn btn-secondary btn-lg">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hotelSelect = document.getElementById('hotel_id');
            const roomSelect = document.getElementById('room_id');
            const quantityInput = document.getElementById('quantity');
            const priceInput = document.getElementById('price_per_night');
            const checkinInput = document.getElementById('checkin_date');
            const checkoutInput = document.getElementById('checkout_date');
            const discountInput = document.getElementById('discount');
            const taxPercentageInput = document.getElementById('tax_percentage');
            const totalNightsDisplay = document.getElementById('total_nights');

            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            checkinInput.setAttribute('min', today);
            checkoutInput.setAttribute('min', today);

            // Load rooms when hotel is selected
            hotelSelect.addEventListener('change', function() {
                const hotelId = this.value;
                roomSelect.innerHTML = '<option value="">Loading...</option>';
                roomSelect.disabled = true;

                if (hotelId) {
                    fetch(`{{ url('super-admin/bookings/manual/rooms') }}/${hotelId}`)
                        .then(response => response.json())
                        .then(data => {
                            roomSelect.innerHTML = '<option value="">-- Select Room --</option>';
                            if (data.length > 0) {
                                data.forEach(room => {
                                    const option = document.createElement('option');
                                    option.value = room.id;
                                    option.textContent = `${room.name || 'Room'} - BDT ${room.price_per_night || 0}/night`;
                                    option.setAttribute('data-price', room.price_per_night || 0);
                                    roomSelect.appendChild(option);
                                });
                                roomSelect.disabled = false;
                            } else {
                                roomSelect.innerHTML = '<option value="">No rooms available</option>';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            roomSelect.innerHTML = '<option value="">Error loading rooms</option>';
                        });
                } else {
                    roomSelect.innerHTML = '<option value="">-- Select Hotel First --</option>';
                }
            });

            // Auto-fill price when room is selected
            roomSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption && selectedOption.getAttribute('data-price')) {
                    priceInput.value = selectedOption.getAttribute('data-price');
                    calculatePricing();
                }
            });

            // Calculate total nights
            function calculateNights() {
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
                totalNightsDisplay.value = 0;
                return 0;
            }

            // Calculate pricing
            function calculatePricing() {
                const quantity = parseFloat(quantityInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
                const nights = calculateNights();
                const discount = parseFloat(discountInput.value) || 0;
                const taxPercentage = parseFloat(taxPercentageInput.value) || 15;

                const subtotal = price * quantity * nights;
                const afterDiscount = subtotal - discount;
                const tax = afterDiscount * (taxPercentage / 100);
                const grandTotal = afterDiscount + tax;

                document.getElementById('subtotal_display').textContent = 'BDT ' + subtotal.toFixed(2);
                document.getElementById('discount_display').textContent = 'BDT ' + discount.toFixed(2);
                document.getElementById('tax_display').textContent = 'BDT ' + tax.toFixed(2);
                document.getElementById('grand_total_display').textContent = 'BDT ' + grandTotal.toFixed(2);
            }

            // Add event listeners for pricing calculation
            [quantityInput, priceInput, checkinInput, checkoutInput, discountInput, taxPercentageInput].forEach(input => {
                input.addEventListener('input', calculatePricing);
                input.addEventListener('change', calculatePricing);
            });

            // Validate checkout date is after checkin date
            checkinInput.addEventListener('change', function() {
                if (this.value) {
                    checkoutInput.setAttribute('min', this.value);
                    if (checkoutInput.value && checkoutInput.value <= this.value) {
                        checkoutInput.value = '';
                    }
                }
                calculatePricing();
            });

            checkoutInput.addEventListener('change', function() {
                if (this.value && checkinInput.value && this.value <= checkinInput.value) {
                    alert('Check-out date must be after check-in date');
                    this.value = '';
                }
                calculatePricing();
            });
        });
    </script>
@endsection

