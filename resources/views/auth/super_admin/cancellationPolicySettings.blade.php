@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-lg">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Global Cancellation Policy Settings</h5>
                                            <span>Manage cancellation policies separately for Hotel and Room modules. These settings apply globally to all hotels and rooms.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @php
                                        // Hotel default policies
                                        $defaultHotelCancellationPolicyTexts = [
                                            'Flexible' => 'Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)',
                                            'Non-refundable' => 'Non-refundable (Regardless of the cancellation window, customers will not get any refund under this.)',
                                            'Partially refundable' => 'Partially refundable (Cancellations less than 24 hours… after deducting a 30% cancellation fee.)',
                                            'Long-term/Monthly staying policy' => 'Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed.)',
                                        ];
                                        
                                        // Room default policies (different keys)
                                        $defaultRoomCancellationPolicyTexts = [
                                            'flexible' => 'Flexible (Guests get a full refund if they cancel up to a day before check-in at least 24 hours.)',
                                            'non_refundable' => 'Non-refundable (Regardless of the cancellation window, customers will not get any refund under this.)',
                                            'partially_refundable' => 'Partially refundable (Cancellations that take place in less than 24 hours and Rooms that are labeled with this badge, after deducting a 30% cancellation fee, rest of the amount will be refunded.)',
                                            'long_term' => 'Long-term/Monthly staying policy (Stays more than 30 days will fall under this scope and a specific contract paper shall be signed. T&C paper will be found in the system.)',
                                        ];
                                        
                                        // ========== HOTEL POLICIES ==========
                                        $hotelCancellationPolicyTexts = $defaultHotelCancellationPolicyTexts;
                                        if ($hotelSetting && is_array($hotelSetting->cancellation_policy_texts ?? null)) {
                                            $hotelCancellationPolicyTexts = array_merge($defaultHotelCancellationPolicyTexts, $hotelSetting->cancellation_policy_texts);
                                        }
                                        if (old('cancellation_policy_texts')) {
                                            $hotelCancellationPolicyTexts = array_merge($defaultHotelCancellationPolicyTexts, old('cancellation_policy_texts'));
                                        }
                                        
                                        $hotelCustomPolicies = [];
                                        if ($hotelSetting && is_array($hotelSetting->custom_cancellation_policies ?? null)) {
                                            $hotelCustomPolicies = $hotelSetting->custom_cancellation_policies;
                                        }
                                        if (old('custom_cancellation_policies')) {
                                            $hotelCustomPolicies = old('custom_cancellation_policies');
                                        }
                                        
                                        $hotelEnabledPolicies = null;
                                        if ($hotelSetting) {
                                            $hotelEnabledPolicies = $hotelSetting->enabled_cancellation_policies;
                                        }
                                        if (old('enabled_cancellation_policies') !== null) {
                                            $hotelEnabledPolicies = old('enabled_cancellation_policies');
                                        }
                                        if ($hotelEnabledPolicies === null) {
                                            $hotelEnabledPolicies = array_keys($defaultHotelCancellationPolicyTexts);
                                        } elseif (!is_array($hotelEnabledPolicies)) {
                                            $hotelEnabledPolicies = [];
                                        }
                                        
                                        // ========== ROOM POLICIES ==========
                                        $roomCancellationPolicyTexts = $defaultRoomCancellationPolicyTexts;
                                        if ($hotelSetting && is_array($hotelSetting->room_cancellation_policy_texts ?? null)) {
                                            $roomCancellationPolicyTexts = array_merge($defaultRoomCancellationPolicyTexts, $hotelSetting->room_cancellation_policy_texts);
                                        }
                                        if (old('room_cancellation_policy_texts')) {
                                            $roomCancellationPolicyTexts = array_merge($defaultRoomCancellationPolicyTexts, old('room_cancellation_policy_texts'));
                                        }
                                        
                                        $roomCustomPolicies = [];
                                        if ($hotelSetting && is_array($hotelSetting->room_custom_cancellation_policies ?? null)) {
                                            $roomCustomPolicies = $hotelSetting->room_custom_cancellation_policies;
                                        }
                                        if (old('room_custom_cancellation_policies')) {
                                            $roomCustomPolicies = old('room_custom_cancellation_policies');
                                        }
                                        
                                        $roomEnabledPolicies = null;
                                        if ($hotelSetting) {
                                            $roomEnabledPolicies = $hotelSetting->room_enabled_cancellation_policies;
                                        }
                                        if (old('room_enabled_cancellation_policies') !== null) {
                                            $roomEnabledPolicies = old('room_enabled_cancellation_policies');
                                        }
                                        if ($roomEnabledPolicies === null) {
                                            $roomEnabledPolicies = array_keys($defaultRoomCancellationPolicyTexts);
                                        } elseif (!is_array($roomEnabledPolicies)) {
                                            $roomEnabledPolicies = [];
                                        }
                                        
                                        $hotelDefaultPolicyKeys = ['Flexible', 'Non-refundable', 'Partially refundable', 'Long-term/Monthly staying policy'];
                                        $roomDefaultPolicyKeys = ['flexible', 'non_refundable', 'partially_refundable', 'long_term'];
                                    @endphp

                                    <form action="{{ route('super-admin.updateCancellationPolicySettings') }}" method="POST" class="gy-3 form-settings">
                                        @csrf
                                        
                                        <!-- ========== HOTEL POLICIES SECTION ========== -->
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="card" style="border: 2px solid #91278f; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                    <h4 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;">
                                                        <strong>🏨 Hotel Cancellation Policies</strong>
                                                    </h4>
                                                    
                                                    <!-- Hotel Default Policies -->
                                                    <h5 class="mb-3 mt-3" style="color: #666;">Default Policies</h5>
                                                    @foreach($hotelDefaultPolicyKeys as $policyKey)
                                                    <div class="col-lg-12 mb-3">
                                                        <div class="form-group" style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background: #fff;">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div>
                                                                    <label class="form-label mb-1"><strong>{{ $policyKey }}</strong></label>
                                                                </div>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input enable-policy-toggle" type="checkbox"
                                                                           name="enabled_cancellation_policies[]" value="{{ $policyKey }}"
                                                                           id="enableHotelPolicy{{ str_replace([' ', '/', '-'], '', $policyKey) }}"
                                                                        {{ in_array($policyKey, $hotelEnabledPolicies) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="enableHotelPolicy{{ str_replace([' ', '/', '-'], '', $policyKey) }}" style="font-size: 12px;">
                                                                        Show to Vendor
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted d-block mb-2">Edit policy description:</small>
                                                            <textarea class="form-control" rows="2" name="cancellation_policy_texts[{{ $policyKey }}]">{{ $hotelCancellationPolicyTexts[$policyKey] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    
                                                    <!-- Hotel Custom Policies -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                                                        <h5 style="color: #666; margin: 0;">Custom Policies</h5>
                                                        <button type="button" class="btn btn-sm btn-primary" id="addHotelCustomPolicyBtn" style="background: #91278f; border: none;">
                                                            <em class="icon ni ni-plus"></em> Add Custom Policy
                                                        </button>
                                                    </div>
                                                    
                                                    <div id="hotelCustomPoliciesContainer">
                                                        @if(!empty($hotelCustomPolicies))
                                                            @foreach($hotelCustomPolicies as $index => $customPolicy)
                                                            <div class="col-lg-12 custom-policy-item mb-3" data-index="{{ $index }}">
                                                                <div class="form-group" style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background: #fff;">
                                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                                        <div>
                                                                            <label class="form-label mb-1"><strong>Custom Policy {{ $index + 1 }}</strong></label>
                                                                        </div>
                                                                        <div class="d-flex gap-2">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input enable-policy-toggle" type="checkbox"
                                                                                       name="enabled_cancellation_policies[]" value="{{ $customPolicy['key'] ?? 'custom_' . ($index + 1) }}"
                                                                                       id="enableHotelCustomPolicy{{ $index }}"
                                                                                    {{ in_array($customPolicy['key'] ?? 'custom_' . ($index + 1), $hotelEnabledPolicies) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="enableHotelCustomPolicy{{ $index }}" style="font-size: 12px;">
                                                                                    Show to Vendor
                                                                                </label>
                                                                            </div>
                                                                            <button type="button" class="btn btn-sm btn-danger remove-hotel-custom-policy" data-index="{{ $index }}">
                                                                                <em class="icon ni ni-trash"></em> Remove
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="custom_cancellation_policies[{{ $index }}][key]" value="{{ $customPolicy['key'] ?? 'custom_' . ($index + 1) }}">
                                                                    <textarea class="form-control mt-2" rows="2" name="custom_cancellation_policies[{{ $index }}][text]" placeholder="Enter custom policy description...">{{ $customPolicy['text'] ?? '' }}</textarea>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    
                                                    <div id="noHotelCustomPolicies" class="text-muted text-center py-3" style="{{ !empty($hotelCustomPolicies) ? 'display: none;' : '' }}">
                                                        No custom policies added yet. Click "Add Custom Policy" to create one.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ========== ROOM POLICIES SECTION ========== -->
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="card" style="border: 2px solid #28a745; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                    <h4 class="mb-4" style="color: #28a745; border-bottom: 2px solid #28a745; padding-bottom: 10px;">
                                                        <strong>🛏️ Room Cancellation Policies</strong>
                                                    </h4>
                                                    
                                                    <!-- Room Default Policies -->
                                                    <h5 class="mb-3 mt-3" style="color: #666;">Default Policies</h5>
                                                    @foreach($roomDefaultPolicyKeys as $policyKey)
                                                    <div class="col-lg-12 mb-3">
                                                        <div class="form-group" style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background: #fff;">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div>
                                                                    <label class="form-label mb-1"><strong>{{ ucfirst(str_replace('_', ' ', $policyKey)) }}</strong></label>
                                                                </div>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input enable-policy-toggle" type="checkbox"
                                                                           name="room_enabled_cancellation_policies[]" value="{{ $policyKey }}"
                                                                           id="enableRoomPolicy{{ str_replace(['_'], '', $policyKey) }}"
                                                                        {{ in_array($policyKey, $roomEnabledPolicies) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="enableRoomPolicy{{ str_replace(['_'], '', $policyKey) }}" style="font-size: 12px;">
                                                                        Show to Vendor
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted d-block mb-2">Edit policy description:</small>
                                                            <textarea class="form-control" rows="2" name="room_cancellation_policy_texts[{{ $policyKey }}]">{{ $roomCancellationPolicyTexts[$policyKey] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    
                                                    <!-- Room Custom Policies -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                                                        <h5 style="color: #666; margin: 0;">Custom Policies</h5>
                                                        <button type="button" class="btn btn-sm btn-primary" id="addRoomCustomPolicyBtn" style="background: #28a745; border: none;">
                                                            <em class="icon ni ni-plus"></em> Add Custom Policy
                                                        </button>
                                                    </div>
                                                    
                                                    <div id="roomCustomPoliciesContainer">
                                                        @if(!empty($roomCustomPolicies))
                                                            @foreach($roomCustomPolicies as $index => $customPolicy)
                                                            <div class="col-lg-12 custom-policy-item mb-3" data-index="{{ $index }}">
                                                                <div class="form-group" style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background: #fff;">
                                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                                        <div>
                                                                            <label class="form-label mb-1"><strong>Custom Policy {{ $index + 1 }}</strong></label>
                                                                        </div>
                                                                        <div class="d-flex gap-2">
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input enable-policy-toggle" type="checkbox"
                                                                                       name="room_enabled_cancellation_policies[]" value="{{ $customPolicy['key'] ?? 'custom_' . ($index + 1) }}"
                                                                                       id="enableRoomCustomPolicy{{ $index }}"
                                                                                    {{ in_array($customPolicy['key'] ?? 'custom_' . ($index + 1), $roomEnabledPolicies) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="enableRoomCustomPolicy{{ $index }}" style="font-size: 12px;">
                                                                                    Show to Vendor
                                                                                </label>
                                                                            </div>
                                                                            <button type="button" class="btn btn-sm btn-danger remove-room-custom-policy" data-index="{{ $index }}">
                                                                                <em class="icon ni ni-trash"></em> Remove
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="room_custom_cancellation_policies[{{ $index }}][key]" value="{{ $customPolicy['key'] ?? 'custom_' . ($index + 1) }}">
                                                                    <textarea class="form-control mt-2" rows="2" name="room_custom_cancellation_policies[{{ $index }}][text]" placeholder="Enter custom policy description...">{{ $customPolicy['text'] ?? '' }}</textarea>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    
                                                    <div id="noRoomCustomPolicies" class="text-muted text-center py-3" style="{{ !empty($roomCustomPolicies) ? 'display: none;' : '' }}">
                                                        No custom policies added yet. Click "Add Custom Policy" to create one.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden fields to ensure enabled policies are always sent -->
                                        <input type="hidden" name="enabled_cancellation_policies_force" value="1">
                                        <input type="hidden" name="room_enabled_cancellation_policies_force" value="1">

                                        <div class="row mt-4">
                                            <div class="col-lg-7 offset-lg-5">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary" style="background: #91278f; border: none;">
                                                        <em class="icon ni ni-save"></em> Save Settings
                                                    </button>
                                                </div>
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let hotelCustomPolicyIndex = {{ !empty($hotelCustomPolicies) ? count($hotelCustomPolicies) : 0 }};
            let roomCustomPolicyIndex = {{ !empty($roomCustomPolicies) ? count($roomCustomPolicies) : 0 }};
            
            // ========== HOTEL CUSTOM POLICIES ==========
            document.getElementById('addHotelCustomPolicyBtn').addEventListener('click', function() {
                const container = document.getElementById('hotelCustomPoliciesContainer');
                const noCustomMsg = document.getElementById('noHotelCustomPolicies');
                const policyKey = 'custom_' + (hotelCustomPolicyIndex + 1);
                
                const newPolicyHtml = `
                    <div class="col-lg-12 custom-policy-item mb-3" data-index="${hotelCustomPolicyIndex}">
                        <div class="form-group" style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background: #fff;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <label class="form-label mb-1"><strong>Custom Policy ${hotelCustomPolicyIndex + 1}</strong></label>
                                </div>
                                <div class="d-flex gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input enable-policy-toggle" type="checkbox"
                                               name="enabled_cancellation_policies[]" value="${policyKey}"
                                               id="enableHotelCustomPolicy${hotelCustomPolicyIndex}">
                                        <label class="form-check-label" for="enableHotelCustomPolicy${hotelCustomPolicyIndex}" style="font-size: 12px;">
                                            Show to Vendor
                                        </label>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-hotel-custom-policy" data-index="${hotelCustomPolicyIndex}">
                                        <em class="icon ni ni-trash"></em> Remove
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="custom_cancellation_policies[${hotelCustomPolicyIndex}][key]" value="${policyKey}">
                            <textarea class="form-control mt-2" rows="2" name="custom_cancellation_policies[${hotelCustomPolicyIndex}][text]" placeholder="Enter custom policy description..."></textarea>
                        </div>
                    </div>
                `;
                
                container.insertAdjacentHTML('beforeend', newPolicyHtml);
                noCustomMsg.style.display = 'none';
                hotelCustomPolicyIndex++;
            });
            
            // ========== ROOM CUSTOM POLICIES ==========
            document.getElementById('addRoomCustomPolicyBtn').addEventListener('click', function() {
                const container = document.getElementById('roomCustomPoliciesContainer');
                const noCustomMsg = document.getElementById('noRoomCustomPolicies');
                const policyKey = 'custom_' + (roomCustomPolicyIndex + 1);
                
                const newPolicyHtml = `
                    <div class="col-lg-12 custom-policy-item mb-3" data-index="${roomCustomPolicyIndex}">
                        <div class="form-group" style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background: #fff;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <label class="form-label mb-1"><strong>Custom Policy ${roomCustomPolicyIndex + 1}</strong></label>
                                </div>
                                <div class="d-flex gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input enable-policy-toggle" type="checkbox"
                                               name="room_enabled_cancellation_policies[]" value="${policyKey}"
                                               id="enableRoomCustomPolicy${roomCustomPolicyIndex}">
                                        <label class="form-check-label" for="enableRoomCustomPolicy${roomCustomPolicyIndex}" style="font-size: 12px;">
                                            Show to Vendor
                                        </label>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-room-custom-policy" data-index="${roomCustomPolicyIndex}">
                                        <em class="icon ni ni-trash"></em> Remove
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="room_custom_cancellation_policies[${roomCustomPolicyIndex}][key]" value="${policyKey}">
                            <textarea class="form-control mt-2" rows="2" name="room_custom_cancellation_policies[${roomCustomPolicyIndex}][text]" placeholder="Enter custom policy description..."></textarea>
                        </div>
                    </div>
                `;
                
                container.insertAdjacentHTML('beforeend', newPolicyHtml);
                noCustomMsg.style.display = 'none';
                roomCustomPolicyIndex++;
            });
            
            // Remove Hotel Custom Policy
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-hotel-custom-policy')) {
                    const button = e.target.closest('.remove-hotel-custom-policy');
                    const policyItem = button.closest('.custom-policy-item');
                    policyItem.remove();
                    
                    const container = document.getElementById('hotelCustomPoliciesContainer');
                    const noCustomMsg = document.getElementById('noHotelCustomPolicies');
                    if (container.children.length === 0) {
                        noCustomMsg.style.display = 'block';
                    }
                }
                
                // Remove Room Custom Policy
                if (e.target.closest('.remove-room-custom-policy')) {
                    const button = e.target.closest('.remove-room-custom-policy');
                    const policyItem = button.closest('.custom-policy-item');
                    policyItem.remove();
                    
                    const container = document.getElementById('roomCustomPoliciesContainer');
                    const noCustomMsg = document.getElementById('noRoomCustomPolicies');
                    if (container.children.length === 0) {
                        noCustomMsg.style.display = 'block';
                    }
                }
            });
        });
    </script>
@endsection
