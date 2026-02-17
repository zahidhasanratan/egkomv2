@extends('auth.layout.vendor_admin_layout')

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
                                <a href="{{ route('vendor.bookings.index') }}" class="btn btn-outline-light">
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

                                <form action="{{ route('vendor.bookings.manual.store') }}" method="POST" enctype="multipart/form-data" id="manualOrderForm">
                                    @csrf
                                    <input type="hidden" name="_confirmed" id="_confirmed" value="0">
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

                                        <!-- Hidden quantity field (always 1 for manual bookings) -->
                                        <input type="hidden" name="quantity" id="quantity" value="1">

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
                                                <label class="form-label">Paid Amount (BDT) <span id="paid_amount_required" class="text-danger" style="display: none;">*</span></label>
                                                <input type="number" name="paid_amount" id="paid_amount" class="form-control" step="0.01" min="0" value="0">
                                                <small id="paid_amount_help" class="text-muted" style="display: none;">Required when payment status is Partial</small>
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

                                        <!-- Platform Fee -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Platform Fee (BDT)</label>
                                                <input type="number" name="platform_fee" id="platform_fee" class="form-control" step="0.01" min="0" value="0">
                                                <small class="text-muted">Optional service/platform fee</small>
                                            </div>
                                        </div>

                                        <!-- Pricing Summary -->
                                        <div class="col-md-12">
                                            <div class="card" style="background: #f8f9fa;">
                                                <div class="card-body">
                                                    <h6 class="mb-3">Pricing Summary</h6>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <strong>Subtotal:</strong> <span id="subtotal_display">BDT 0.00</span>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <strong>Discount:</strong> <span id="discount_display">BDT 0.00</span>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <strong>Tax:</strong> <span id="tax_display">BDT 0.00</span>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <strong>Platform Fee:</strong> <span id="platform_fee_display">BDT 0.00</span>
                                                        </div>
                                                        <div class="col-md-4">
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
                                                <input type="file" name="nid_front" id="nid_front" class="form-control document-file-input" accept="image/*">
                                                <div class="document-preview-container mt-2" id="nid_front_preview" style="display: none;">
                                                    <div class="position-relative d-inline-block">
                                                        <img id="nid_front_preview_img" src="" alt="NID Front Preview" style="max-width: 200px; max-height: 150px; border: 2px solid #ddd; border-radius: 8px; padding: 5px;">
                                                        <button type="button" class="btn btn-sm btn-danger document-remove-btn" data-input="nid_front" style="position: absolute; top: -10px; right: -10px; border-radius: 50%; width: 28px; height: 28px; padding: 0; line-height: 1; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold;">
                                                            ×
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">NID Back</label>
                                                <input type="file" name="nid_back" id="nid_back" class="form-control document-file-input" accept="image/*">
                                                <div class="document-preview-container mt-2" id="nid_back_preview" style="display: none;">
                                                    <div class="position-relative d-inline-block">
                                                        <img id="nid_back_preview_img" src="" alt="NID Back Preview" style="max-width: 200px; max-height: 150px; border: 2px solid #ddd; border-radius: 8px; padding: 5px;">
                                                        <button type="button" class="btn btn-sm btn-danger document-remove-btn" data-input="nid_back" style="position: absolute; top: -10px; right: -10px; border-radius: 50%; width: 28px; height: 28px; padding: 0; line-height: 1; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold;">
                                                            ×
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Passport</label>
                                                <input type="file" name="passport" id="passport" class="form-control document-file-input" accept="image/*">
                                                <div class="document-preview-container mt-2" id="passport_preview" style="display: none;">
                                                    <div class="position-relative d-inline-block">
                                                        <img id="passport_preview_img" src="" alt="Passport Preview" style="max-width: 200px; max-height: 150px; border: 2px solid #ddd; border-radius: 8px; padding: 5px;">
                                                        <button type="button" class="btn btn-sm btn-danger document-remove-btn" data-input="passport" style="position: absolute; top: -10px; right: -10px; border-radius: 50%; width: 28px; height: 28px; padding: 0; line-height: 1; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold;">
                                                            ×
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Visa</label>
                                                <input type="file" name="visa" id="visa" class="form-control document-file-input" accept="image/*">
                                                <div class="document-preview-container mt-2" id="visa_preview" style="display: none;">
                                                    <div class="position-relative d-inline-block">
                                                        <img id="visa_preview_img" src="" alt="Visa Preview" style="max-width: 200px; max-height: 150px; border: 2px solid #ddd; border-radius: 8px; padding: 5px;">
                                                        <button type="button" class="btn btn-sm btn-danger document-remove-btn" data-input="visa" style="position: absolute; top: -10px; right: -10px; border-radius: 50%; width: 28px; height: 28px; padding: 0; line-height: 1; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold;">
                                                            ×
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-md-12">
                                            <hr>
                                            <button type="submit" class="btn btn-primary btn-lg" id="btnSubmitBooking">
                                                <em class="icon ni ni-save"></em> Create Manual Booking
                                            </button>
                                            <a href="{{ route('vendor.bookings.index') }}" class="btn btn-secondary btn-lg">
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

    <!-- Preview modal: review invoice before confirming creation -->
    <div class="modal fade" id="manualBookingPreviewModal" tabindex="-1" aria-labelledby="manualBookingPreviewModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manualBookingPreviewModalLabel">
                        <em class="icon ni ni-file-docs"></em> Preview – Review your booking
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-3">Please review the details below. This will be used as the invoice summary.</p>
                    <div id="manualBookingPreviewContent" class="border rounded p-4" style="background: #f8f9fa;"></div>
                    <div class="alert alert-warning mt-3 mb-0">
                        <strong>Confirm Creation</strong><br>
                        No changes can be made after confirmation.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back to Edit</button>
                    <button type="button" class="btn btn-primary" id="btnConfirmCreation">
                        <em class="icon ni ni-check"></em> Confirm Creation
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hotelSelect = document.getElementById('hotel_id');
            const roomSelect = document.getElementById('room_id');
            const quantityInput = document.getElementById('quantity'); // Hidden field, always 1
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

            // Open calendar when clicking on date input fields (not just the icon)
            [checkinInput, checkoutInput].forEach(input => {
                input.addEventListener('click', function() {
                    if (this.showPicker) {
                        this.showPicker();
                    }
                });
            });

            // Load rooms when hotel is selected
            hotelSelect.addEventListener('change', function() {
                const hotelId = this.value;
                roomSelect.innerHTML = '<option value="">Loading...</option>';
                roomSelect.disabled = true;

                if (hotelId) {
                    fetch(`{{ url('vendor-admin/bookings/manual/rooms') }}/${hotelId}`)
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
                const quantity = 1; // Always 1 for manual bookings
                const price = parseFloat(priceInput.value) || 0;
                const nights = calculateNights();
                const discount = parseFloat(discountInput.value) || 0;
                const taxPercentage = parseFloat(taxPercentageInput.value) || 15;
                const platformFee = parseFloat(document.getElementById('platform_fee').value) || 0;

                const subtotal = price * quantity * nights;
                const afterDiscount = subtotal - discount;
                const tax = afterDiscount * (taxPercentage / 100);
                const grandTotal = afterDiscount + tax + platformFee;

                document.getElementById('subtotal_display').textContent = 'BDT ' + subtotal.toFixed(2);
                document.getElementById('discount_display').textContent = 'BDT ' + discount.toFixed(2);
                document.getElementById('tax_display').textContent = 'BDT ' + tax.toFixed(2);
                document.getElementById('platform_fee_display').textContent = 'BDT ' + platformFee.toFixed(2);
                document.getElementById('grand_total_display').textContent = 'BDT ' + grandTotal.toFixed(2);
            }

            // Add event listeners for pricing calculation
            const platformFeeInput = document.getElementById('platform_fee');
            [priceInput, checkinInput, checkoutInput, discountInput, taxPercentageInput, platformFeeInput].forEach(input => {
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

            // Payment Status: Show/hide required indicator and help text for Paid Amount when Partial is selected
            const paymentStatusSelect = document.querySelector('select[name="payment_status"]');
            const paidAmountInput = document.getElementById('paid_amount');
            const paidAmountRequired = document.getElementById('paid_amount_required');
            const paidAmountHelp = document.getElementById('paid_amount_help');

            function updatePaidAmountField() {
                const paymentStatus = paymentStatusSelect.value;
                if (paymentStatus === 'partial') {
                    paidAmountRequired.style.display = 'inline';
                    paidAmountHelp.style.display = 'block';
                    paidAmountInput.setAttribute('required', 'required');
                    paidAmountInput.setAttribute('min', '0.01');
                } else {
                    paidAmountRequired.style.display = 'none';
                    paidAmountHelp.style.display = 'none';
                    paidAmountInput.removeAttribute('required');
                    paidAmountInput.setAttribute('min', '0');
                    if (paymentStatus === 'paid') {
                        // Auto-fill with grand total if paid is selected (optional enhancement)
                        // This can be uncommented if desired
                        // const grandTotalText = document.getElementById('grand_total_display').textContent.replace('BDT ', '').replace(',', '');
                        // paidAmountInput.value = parseFloat(grandTotalText) || 0;
                    }
                }
            }

            paymentStatusSelect.addEventListener('change', updatePaidAmountField);
            updatePaidAmountField(); // Initialize on page load

            // Document file preview and remove functionality
            const documentInputs = ['nid_front', 'nid_back', 'passport', 'visa'];
            
            documentInputs.forEach(inputName => {
                const input = document.getElementById(inputName);
                const previewContainer = document.getElementById(inputName + '_preview');
                const previewImg = document.getElementById(inputName + '_preview_img');
                
                if (input && previewContainer && previewImg) {
                    // Show preview when file is selected
                    input.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file && file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImg.src = e.target.result;
                                previewContainer.style.display = 'block';
                            };
                            reader.readAsDataURL(file);
                        } else {
                            previewContainer.style.display = 'none';
                        }
                    });
                }
            });

            // Remove file functionality
            document.querySelectorAll('.document-remove-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const inputName = this.getAttribute('data-input');
                    const input = document.getElementById(inputName);
                    const previewContainer = document.getElementById(inputName + '_preview');
                    
                    if (input) {
                        input.value = ''; // Clear the file input
                        if (previewContainer) {
                            previewContainer.style.display = 'none';
                        }
                    }
                });
            });

            // Preview step: intercept form submit, show preview modal, then confirm to actually submit
            const form = document.getElementById('manualOrderForm');
            const confirmInput = document.getElementById('_confirmed');
            const previewModal = new bootstrap.Modal(document.getElementById('manualBookingPreviewModal'));
            const previewContent = document.getElementById('manualBookingPreviewContent');
            const btnConfirm = document.getElementById('btnConfirmCreation');

            function buildPreviewHTML() {
                const hotelOpt = document.getElementById('hotel_id').selectedOptions[0];
                const roomOpt = document.getElementById('room_id').selectedOptions[0];
                const hotelName = hotelOpt ? hotelOpt.textContent : '—';
                const roomName = roomOpt ? roomOpt.textContent : '—';
                const quantity = 1; // Always 1 for manual bookings
                const price = parseFloat(priceInput.value) || 0;
                const nights = calculateNights();
                const discount = parseFloat(discountInput.value) || 0;
                const taxPct = parseFloat(taxPercentageInput.value) || 15;
                const platformFee = parseFloat(document.getElementById('platform_fee').value) || 0;
                const subtotal = price * quantity * nights;
                const afterDiscount = subtotal - discount;
                const tax = afterDiscount * (taxPct / 100);
                const grandTotal = afterDiscount + tax + platformFee;
                const paidAmount = parseFloat(document.querySelector('input[name="paid_amount"]').value) || 0;
                const bookingStatus = (document.querySelector('select[name="booking_status"]') || {}).value || '—';
                const paymentStatus = (document.querySelector('select[name="payment_status"]') || {}).value || '—';
                const guestName = (document.querySelector('input[name="guest_name"]') || {}).value || '—';
                const guestPhone = (document.querySelector('input[name="guest_phone"]') || {}).value || '—';
                const guestEmail = (document.querySelector('input[name="guest_email"]') || {}).value || '—';
                const homeAddress = (document.querySelector('textarea[name="home_address"]') || {}).value || '—';
                const checkin = checkinInput.value || '—';
                const checkout = checkoutInput.value || '—';
                
                // Additional fields
                const totalPersons = (document.querySelector('input[name="total_persons"]') || {}).value || '—';
                const totalMale = (document.querySelector('input[name="total_male"]') || {}).value || '—';
                const totalFemale = (document.querySelector('input[name="total_female"]') || {}).value || '—';
                const totalKids = (document.querySelector('input[name="total_kids"]') || {}).value || '—';
                const arrivalTime = (document.querySelector('input[name="arrival_time"]') || {}).value || '—';
                const relationship = (document.querySelector('select[name="relationship"]') || {}).value || '—';
                const bedType = (document.querySelector('select[name="bed_type"]') || {}).value || '—';
                const roomPreference = (document.querySelector('select[name="room_preference"]') || {}).value || '—';
                const citizenship = (document.querySelector('select[name="citizenship"]') || {}).value || '—';
                const organization = (document.querySelector('input[name="organization"]') || {}).value || '—';
                const organizationAddress = (document.querySelector('input[name="organization_address"]') || {}).value || '—';
                const roomType = (document.querySelector('input[name="room_type"]') || {}).value || '—';
                const roomNumber = (document.querySelector('input[name="room_number"]') || {}).value || '—';
                const propertyNote = (document.querySelector('textarea[name="property_note"]') || {}).value || '—';
                
                // Documents
                const nidFront = document.querySelector('input[name="nid_front"]').files.length > 0 ? document.querySelector('input[name="nid_front"]').files[0].name : '—';
                const nidBack = document.querySelector('input[name="nid_back"]').files.length > 0 ? document.querySelector('input[name="nid_back"]').files[0].name : '—';
                const passport = document.querySelector('input[name="passport"]').files.length > 0 ? document.querySelector('input[name="passport"]').files[0].name : '—';
                const visa = document.querySelector('input[name="visa"]').files.length > 0 ? document.querySelector('input[name="visa"]').files[0].name : '—';
                
                // Format select values
                const relationshipLabels = { onlyMe: 'Only Me', family: 'Family', husband: 'Husband', friends: 'Friends', colleagues: 'Colleagues' };
                const bedTypeLabels = { large_bed: 'Large Bed', twin_beds: 'Twin Beds', '': '—' };
                const roomPreferenceLabels = { non_smoking: 'Non-Smoking', smoking: 'Smoking' };
                const citizenshipLabels = { bangladesh: 'Bangladesh', international: 'International', '': '—' };
                
                return `
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3" style="color: #90278e;">Booking Details</h6>
                            <table class="table table-sm table-bordered mb-3">
                                <tr><th class="bg-light" width="45%">Hotel</th><td>${hotelName}</td></tr>
                                <tr><th class="bg-light">Room</th><td>${roomName}</td></tr>
                                <tr><th class="bg-light">Check-in Date</th><td>${checkin}</td></tr>
                                <tr><th class="bg-light">Check-out Date</th><td>${checkout}</td></tr>
                                <tr><th class="bg-light">Total Nights</th><td>${nights} night${nights !== 1 ? 's' : ''}</td></tr>
                                <tr><th class="bg-light">Price Per Night</th><td>BDT ${price.toFixed(2)}</td></tr>
                                <tr><th class="bg-light">Room Type</th><td>${roomType || '—'}</td></tr>
                                <tr><th class="bg-light">Room Number</th><td>${roomNumber || '—'}</td></tr>
                                <tr><th class="bg-light">Bed Type</th><td>${bedTypeLabels[bedType] || bedType || '—'}</td></tr>
                                <tr><th class="bg-light">Room Preference</th><td>${roomPreferenceLabels[roomPreference] || roomPreference || '—'}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3" style="color: #90278e;">Guest Information</h6>
                            <table class="table table-sm table-bordered mb-3">
                                <tr><th class="bg-light" width="45%">Guest Name</th><td>${guestName}</td></tr>
                                <tr><th class="bg-light">Phone</th><td>${guestPhone}</td></tr>
                                <tr><th class="bg-light">Email</th><td>${guestEmail || '—'}</td></tr>
                                <tr><th class="bg-light">Home Address</th><td>${homeAddress || '—'}</td></tr>
                                <tr><th class="bg-light">Total Persons</th><td>${totalPersons}</td></tr>
                                <tr><th class="bg-light">Total Male</th><td>${totalMale}</td></tr>
                                <tr><th class="bg-light">Total Female</th><td>${totalFemale}</td></tr>
                                <tr><th class="bg-light">Total Kids</th><td>${totalKids}</td></tr>
                                <tr><th class="bg-light">Arrival Time</th><td>${arrivalTime || '—'}</td></tr>
                                <tr><th class="bg-light">Relationship</th><td>${relationshipLabels[relationship] || relationship || '—'}</td></tr>
                                <tr><th class="bg-light">Citizenship</th><td>${citizenshipLabels[citizenship] || citizenship || '—'}</td></tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3" style="color: #90278e;">Organization</h6>
                            <table class="table table-sm table-bordered mb-3">
                                <tr><th class="bg-light" width="45%">Organization</th><td>${organization || '—'}</td></tr>
                                <tr><th class="bg-light">Organization Address</th><td>${organizationAddress || '—'}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3" style="color: #90278e;">Documents</h6>
                            <table class="table table-sm table-bordered mb-3">
                                <tr><th class="bg-light" width="45%">NID Front</th><td>${nidFront}</td></tr>
                                <tr><th class="bg-light">NID Back</th><td>${nidBack}</td></tr>
                                <tr><th class="bg-light">Passport</th><td>${passport}</td></tr>
                                <tr><th class="bg-light">Visa</th><td>${visa}</td></tr>
                            </table>
                        </div>
                    </div>
                    ${propertyNote && propertyNote !== '—' ? `<div class="mb-3"><h6 style="color: #90278e;">Property Note</h6><div class="border rounded p-2 bg-white">${propertyNote}</div></div>` : ''}
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="mb-3" style="color: #90278e;">Pricing & Status</h6>
                            <table class="table table-sm table-bordered mb-0">
                                <tr><th class="bg-light" width="40%">Subtotal</th><td>BDT ${subtotal.toFixed(2)}</td></tr>
                                <tr><th class="bg-light">Discount</th><td>BDT ${discount.toFixed(2)}</td></tr>
                                <tr><th class="bg-light">Tax Percentage</th><td>${taxPct}%</td></tr>
                                <tr><th class="bg-light">Tax Amount</th><td>BDT ${tax.toFixed(2)}</td></tr>
                                <tr><th class="bg-light">Platform Fee</th><td>BDT ${platformFee.toFixed(2)}</td></tr>
                                <tr><th class="bg-light"><strong>Grand Total</strong></th><td><strong style="color: #90278e; font-size: 1.1em;">BDT ${grandTotal.toFixed(2)}</strong></td></tr>
                                <tr><th class="bg-light">Booking Status</th><td><span class="badge bg-info">${bookingStatus}</span></td></tr>
                                <tr><th class="bg-light">Payment Status</th><td><span class="badge bg-warning">${paymentStatus}</span></td></tr>
                                <tr><th class="bg-light">Paid Amount</th><td>BDT ${paidAmount.toFixed(2)}</td></tr>
                                ${paymentStatus === 'partial' && paidAmount > 0 ? `
                                <tr><th class="bg-light" style="color: #e74c3c;"><strong>Remaining Amount</strong></th><td style="color: #e74c3c;"><strong>BDT ${(grandTotal - paidAmount).toFixed(2)}</strong></td></tr>
                                ` : ''}
                            </table>
                        </div>
                    </div>
                `;
            }

            form.addEventListener('submit', function(e) {
                if (confirmInput.value === '1') return;
                e.preventDefault();
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                previewContent.innerHTML = buildPreviewHTML();
                previewModal.show();
            });

            btnConfirm.addEventListener('click', function() {
                confirmInput.value = '1';
                previewModal.hide();
                form.submit();
            });
        });
    </script>
@endsection

