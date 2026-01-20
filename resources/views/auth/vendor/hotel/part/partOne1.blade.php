@extends('auth.layout.vendor_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Hotel / Property</h3>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem3">Hotel /
                                            Property Description</a>
                                    </li>

                                </ul>
                                @if (session('success'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('vendor-admin.hotel.update', $hotel->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="tab-content">
                                        <!-- Hotel Description -->
                                        <div class="tab-pane active" id="tabItem3">
                                            <!-- Hotel Information Section -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa;">
                                                        <h5 class="mb-4" style="color: #91278f; border-bottom: 2px solid #91278f; padding-bottom: 10px;"><strong>Hotel / Property Information</strong></h5>
                                                        
                                                        <div class="row gy-4">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="popular_destination_id" class="form-label">Select Your Area <span class="text-danger">*</span></label>
                                                                    <select name="popular_destination_id" class="form-control" id="popular_destination_id" required style="border: 1px solid #dee2e6; border-radius: 6px; padding: 8px 12px;">
                                                                        <option value="">Select Area</option>
                                                                        @foreach($popularDestinations as $destination)
                                                                            <option value="{{ $destination->id }}" {{ old('popular_destination_id', $hotel->popular_destination_id) == $destination->id ? 'selected' : '' }}>
                                                                                {{ $destination->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('popular_destination_id')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="division" class="form-label">Select Property Category</label>
                                                                    <select name="property_category" class="form-control" id="division" style="border: 1px solid #dee2e6; border-radius: 6px; padding: 8px 12px;">
                                                                        <option value="" {{ !$hotel || !$hotel->property_category ? 'selected' : '' }}>Select Property</option>
                                                                        <option value="Hotels" {{ old('property_category', $hotel->property_category ?? '') === 'Hotels' ? 'selected' : '' }}>Hotels</option>
                                                                        <option value="Transit" {{ old('property_category', $hotel->property_category ?? '') === 'Transit' ? 'selected' : '' }}>Transit Hotels</option>
                                                                        <option value="Resorts" {{ old('property_category', $hotel->property_category ?? '') === 'Resorts' ? 'selected' : '' }}>Resorts, Eco, & Outdoor</option>
                                                                        <option value="Apartments" {{ old('property_category', $hotel->property_category ?? '') === 'Apartments' ? 'selected' : '' }}>Hostels & Lodges</option>
                                                                        <option value="Guesthouses" {{ old('property_category', $hotel->property_category ?? '') === 'Guesthouses' ? 'selected' : '' }}>Apartments & Homestays</option>
                                                                        <option value="Crisis" {{ old('property_category', $hotel->property_category ?? '') === 'Crisis' ? 'selected' : '' }}>Crisis & Shelter Accommodation</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="hotel_name">Hotel / Property Name</label>
                                                                    <input class="form-control" 
                                                                           name="description" 
                                                                           id="hotel_name"
                                                                           value="{{ old('description', \App\Models\Property::where('vendor_id', auth()->user()->id)->first()->property_name ?? $hotel->description ?? '') }}"
                                                                           placeholder="Enter Hotel / Property Name"
                                                                           style="border: 1px solid #dee2e6; border-radius: 6px; padding: 8px 12px;">
                                                                    @error('description')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" id="districtContainer" style="display:none;">
                                                                <div class="form-group">
                                                                    <label for="district" class="form-label">Property Type</label>
                                                                    <select name="property_type" id="district" class="form-control" style="border: 1px solid #dee2e6; border-radius: 6px; padding: 8px 12px;">
                                                                        <option value="" disabled selected>Choose Property Type</option>
                                                                        <option {{ old('property_type', $hotel->property_type) == 'Hotels' ? 'selected' : '' }}>Hotels</option>
                                                                        <option {{ old('property_type', $hotel->property_type) == 'Transit' ? 'selected' : '' }}>Transit</option>
                                                                        <option {{ old('property_type', $hotel->property_type) == 'Resorts' ? 'selected' : '' }}>Resorts</option>
                                                                        <option {{ old('property_type', $hotel->property_type) == 'Lodges' ? 'selected' : '' }}>Lodges</option>
                                                                        <option {{ old('property_type', $hotel->property_type) == 'Guesthouses' ? 'selected' : '' }}>Guesthouses</option>
                                                                        <option {{ old('property_type', $hotel->property_type) == 'Crisis' ? 'selected' : '' }}>Crisis</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" id="placeCheckboxList" style="display: none;">
                                                                <div class="form-group">
                                                                    <label class="form-label">Choose Room/Accommodation Type</label>
                                                                    <ul id="placeOptions" class="list-unstyled" style="max-height: 200px; overflow-y: auto;">
                                                                        <!-- Dynamic Checkboxes Will Appear Here -->
                                                                    </ul>
                                                                    @error('room_types')
                                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="hotel-description">Hotel/Property Description & Policy</label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control" id="hotel-description" name="details">{!!  old('details', $hotel->details)  !!}</textarea>
                                                                        @error('details') <span class="text-danger">{{ $details }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-4 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="building-age">Building
                                                                        Age/Founding Year</label>
                                                                    <input type="number" class="form-control" id="building-age"
                                                                           name="building_age" placeholder="ex: 2010"
                                                                           value="{{ old('building_age', $property->building_age ?? '') }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-4 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="building-stories">Building
                                                                        Storied</label>
                                                                    <input type="number" class="form-control" id="building-stories"
                                                                           name="building_stories" placeholder="ex: 10 Story"
                                                                           value="{{ old('building_stories', $property->building_stories ?? '') }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-6 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="hotel-description">Location Latitude</label>
                                                                    <div class="form-control-wrap">
                                                                        <input class="form-control" id="hotel-description" name="lati" placeholder="Enter Latitude" value="{{ $hotel->lati }}"></input>
                                                                        @error('lati') <span class="text-danger">{{ $lati }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-6 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="hotel-description">Location Longitude</label>
                                                                    <div class="form-control-wrap">
                                                                        <input class="form-control" id="hotel-description" name="longi" placeholder="Enter Longitude" value="{{ $hotel->longi }}"></input>
                                                                        @error('longi') <span class="text-danger">{{ $longi }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 col-lg-12 col-xxl-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="default-textarea">Address</label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea class="form-control no-resize"
                                                                                  id="default-textarea"
                                                                                  name="address">{{ old('address', $hotel->address) }}</textarea>
                                                                        @error('address') <span
                                                                            class="text-danger">{{ $address }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#hotel-description'))
                                                    .catch(error => {
                                                        console.error(error);
                                                    });
                                            </script>

                                            <!-- Property Policy And Rules -->


                                            <!-- Start: Property Information -->

                                            <!-- Start: Arrival Guideline Information -->



                                            <div class="row">
                                                <div class="col-sm-2 col-md-2 mt-15">
                                                    <div class="form-group">
                                                        <button type="submit" name="status" value="submitted"
                                                                class="btn btn-primary btn-submit">Submit
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Hotel Description -->

                                        <!-- Most Popular Facilities -->
                                        @php
                                            // ────────────────────────────────────────────────────────
                                            // 1) Decode saved “facilities” (popular ones) & custom ones
                                            $savedFacilities = old('facilities', $hotel->facilities ?? []);
                                            if (is_string($savedFacilities)) {
                                                $savedFacilities = json_decode($savedFacilities, true) ?: [];
                                            }
                                            $customFacilities = old('custom_facilities', $hotel->custom_facilities ?? []);
                                            if (is_string($customFacilities)) {
                                                $customFacilities = json_decode($customFacilities, true) ?: [];
                                            }

                                            // 2) Decode saved “hotel_facilities” JSON into grouped array
                                            $savedHF = old('hotel_facilities', $hotel->hotel_facilities ?? []);
                                            if (is_string($savedHF)) {
                                                $savedHF = json_decode($savedHF, true) ?: [];
                                            }
                                            $groupedHF = [];
                                            foreach ($savedHF as $item) {
                                                $groupedHF[$item['category']][] = $item['name'];
                                            }
                                        @endphp





                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- harmless placeholder so “propertyCategory” script never crashes if element is absent -->

    <span id="propertyCategory" hidden></span>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            const divisionSelect    = document.getElementById("division");   // property_category
            const districtSelect    = document.getElementById("district");   // property_type
            const districtContainer = document.getElementById("districtContainer");
            const placeCheckboxList = document.getElementById("placeCheckboxList");
            const placeOptions      = document.getElementById("placeOptions");

            const data = {
                Hotels: {
                    districts: {
                        "hotel": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],
                        "Luxury Hotels": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],
                        "Resort Hotels ": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],
                        "Budget Hotels ": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],
                        "Hotels 3 Star ": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],
                        "Hotels 4 Star": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"],
                        "Hotels 5 Star ": ["Single Room", "Double Room", "Twin Room", "Suite", "Family Room", "Penthouse Suite", "Accessible Room"]
                    }
                },
                Transit: {
                    districts: {
                        "Airport Hotels ": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],
                        "Station Hotels ": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],
                        "Bus Stop Hotels": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],
                        "Jetty Hotels ": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],
                        "Hospital & Visa Center Area hotels": ["Single Room", "Double Room", "Family Unit", "Parking-Accessible Room"],
                    }
                },
                Resorts: {
                    districts: {
                        "Resorts ": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Eco Resorts ": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Eco Hotels ": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Farm Stays": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Campsites ": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Glamping ": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Treehouses ": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Adventure Resorts  ": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Wellness Retreats  ": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Beach Resorts ": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Mountain Resorts": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                        "Safari Lodges": ["Luxury Resort Suites","Oceanfront Villas","Private Pool Villas","Garden View Rooms","Eco Resorts & Hotels","Bamboo Cottages","Solar-Powered Cabins","Off-Grid Stays","Farm Stays","Rustic Farmhouses","Luxury Farm Villas","Campsites","Standard Camping Tent","Luxury Tent (Glamping)","RV/Caravan Parking","Glamping","Safari-Style Tents","Dome Pods","Airstream Trailers","Treehouses","Basic Tree Cabins","Luxury Tree Villas","Adventure Resorts","Zipline Resorts","Rock Climbing Camps","Water Sports Resorts","Wellness Retreats","Ayurveda Resorts","Yoga Retreats","Meditation Centers","Beach Resorts","Overwater Bungalows","Beach Huts","Mountain Resorts","Safari Lodges","Wildlife Observation Rooms","Riverside Safari Cottages"],
                    }
                },
                Lodges: {
                    districts: {
                        "Hostels ": ["Single Bed in Dormitory/Room/Apartment ","Oceanfront Villas","Private Room/Apartment","Female-Only Dormitory/Apartment/Room","Male-Only Dormitory/Apartment/Room","Mixed Dormitory: Shared Room (All Genders) ","Studio Apartment-Style Hostel"],
                        "Motels ": ["Single Bed in Dormitory/Room/Apartment ","Oceanfront Villas","Private Room/Apartment","Female-Only Dormitory/Apartment/Room","Male-Only Dormitory/Apartment/Room","Mixed Dormitory: Shared Room (All Genders) ","Studio Apartment-Style Hostel"],
                        "Lodges ": ["Single Bed in Dormitory/Room/Apartment ","Oceanfront Villas","Private Room/Apartment","Female-Only Dormitory/Apartment/Room","Male-Only Dormitory/Apartment/Room","Mixed Dormitory: Shared Room (All Genders) ","Studio Apartment-Style Hostel"],
                        "Mountain Lodges ": ["Single Bed in Dormitory/Room/Apartment ","Oceanfront Villas","Private Room/Apartment","Female-Only Dormitory/Apartment/Room","Male-Only Dormitory/Apartment/Room","Mixed Dormitory: Shared Room (All Genders) ","Studio Apartment-Style Hostel"],
                        "Fishing Lodges ": ["Single Bed in Dormitory/Room/Apartment ","Oceanfront Villas","Private Room/Apartment","Female-Only Dormitory/Apartment/Room","Male-Only Dormitory/Apartment/Room","Mixed Dormitory: Shared Room (All Genders) ","Studio Apartment-Style Hostel"],
                        "Hunting Lodges ": ["Single Bed in Dormitory/Room/Apartment ","Oceanfront Villas","Private Room/Apartment","Female-Only Dormitory/Apartment/Room","Male-Only Dormitory/Apartment/Room","Mixed Dormitory: Shared Room (All Genders) ","Studio Apartment-Style Hostel"],
                    }
                },
                Apartments: {
                    districts: {
                        "Apartments": ["Luxury Serviced Apartments","Budget Serviced Apartments","Furnished Apartments","Unfurnished Apartments","Studio Apartments","One-Bedroom Apartments","Two-Bedroom Apartments","Three-Bedroom Apartments","Penthouse Apartments","Shared Apartments"],
                        "Serviced Apartments": ["Luxury Serviced Apartments","Budget Serviced Apartments","Furnished Apartments","Unfurnished Apartments","Studio Apartments","One-Bedroom Apartments","Two-Bedroom Apartments","Three-Bedroom Apartments","Penthouse Apartments","Shared Apartments"],
                        "Homestays": ["Luxury Serviced Apartments","Budget Serviced Apartments","Furnished Apartments","Unfurnished Apartments","Studio Apartments","One-Bedroom Apartments","Two-Bedroom Apartments","Three-Bedroom Apartments","Penthouse Apartments","Shared Apartments"],
                    }
                },
                Guesthouses: {
                    districts: {
                        "Vacation Rentals": ["Bed Only","Room with Shared Bathroom","Entire Place","Private Room","Entire House","Farmhouse Room","Tent/Glamping Tent","RV/Caravan: Mobile Accommodations"],
                        "Condominiums": ["Bed Only","Room with Shared Bathroom","Entire Place","Private Room","Entire House","Farmhouse Room","Tent/Glamping Tent","RV/Caravan: Mobile Accommodations"],
                        "Bed and Breakfasts (B&Bs)": ["Bed Only","Room with Shared Bathroom","Entire Place","Private Room","Entire House","Farmhouse Room","Tent/Glamping Tent","RV/Caravan: Mobile Accommodations"],
                        "Guesthouses": ["Bed Only","Room with Shared Bathroom","Entire Place","Private Room","Entire House","Farmhouse Room","Tent/Glamping Tent","RV/Caravan: Mobile Accommodations"],
                    }
                },
                Crisis: {
                    districts: {
                        "Old Age Homes": ["Old Age Homes","Orphanages","Rehabilitation Centers","Asylums"],
                        "Orphanages": ["Old Age Homes","Orphanages","Rehabilitation Centers","Asylums"],
                        "Rehabilitation Centers": ["Old Age Homes","Orphanages","Rehabilitation Centers","Asylums"],
                        "Asylums": ["Old Age Homes","Orphanages","Rehabilitation Centers","Asylums"],
                    }
                },
            };

            // Use old(...) if available, else DB
            const savedRoomTypes  = @json(old('room_types', json_decode($hotel->room_types ?? '[]', true)));
            const initialDivision = @json(old('property_category', $hotel->property_category ?? ''));
            const initialDistrict = @json(old('property_type',     $hotel->property_type     ?? ''));

            function populateDistricts(division) {
                districtSelect.innerHTML = '<option value="" disabled selected>Choose Property Type</option>';

                if (data[division]) {
                    districtContainer.style.display = "block";
                    Object.keys(data[division].districts).forEach(district => {
                        const option = document.createElement("option");
                        option.value = district;
                        option.textContent = district; // keep exact label
                        districtSelect.appendChild(option);
                    });
                } else {
                    districtContainer.style.display = "none";
                    placeCheckboxList.style.display = "none";
                    placeOptions.innerHTML = "";
                }
            }

            function populateRoomTypes(division, district) {
                placeOptions.innerHTML = "";

                if (data[division] && data[division].districts[district]) {
                    placeCheckboxList.style.display = "block";
                    data[division].districts[district].forEach((place, index) => {
                        const inputId   = `room_type_${index}`;
                        const isChecked = Array.isArray(savedRoomTypes) && savedRoomTypes.includes(place);
                        const li = document.createElement("li");
                        li.innerHTML = `
                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               id="${inputId}"
                               name="room_types[]"
                               value="${place}"
                               ${isChecked ? 'checked' : ''}>
                        <label class="form-check-label" for="${inputId}">${place}</label>
                    </div>
                `;
                        placeOptions.appendChild(li);
                    });
                } else {
                    placeCheckboxList.style.display = "none";
                }
            }

            // Listeners
            divisionSelect?.addEventListener("change", function () {
                populateDistricts(this.value);
                placeOptions.innerHTML = "";
                placeCheckboxList.style.display = "none";
            });

            districtSelect?.addEventListener("change", function () {
                populateRoomTypes(divisionSelect.value, this.value);
            });

            // Initial render on load
            if (initialDivision) {
                if (divisionSelect) divisionSelect.value = initialDivision;
                populateDistricts(initialDivision);
                const hasDistrict = data[initialDivision] && data[initialDivision].districts[initialDistrict];
                if (initialDistrict && hasDistrict) {
                    districtSelect.value = initialDistrict;
                    populateRoomTypes(initialDivision, initialDistrict);
                }
            }
        });
    </script>

    <script type="text/javascript">
        document.getElementById('propertyCategory')?.addEventListener('change', function () {
            var propertyTypeContainer = document.getElementById('propertyTypeContainer');
            var propertyType = document.getElementById('propertyType');
            if (!propertyTypeContainer || !propertyType) return;
            propertyType.innerHTML = ''; // Clear previous options

            var options = {
                'Hotel': [
                    {id: 'option1', value: 'Only Apartment', label: 'Only Apartment'},
                    {id: 'option2', value: 'Only room', label: 'Only room'},
                    {id: 'option3', value: 'Only Bed', label: 'Only Bed'}
                ],
                'House': [
                    {id: 'option4', value: 'Kitchen', label: 'Kitchen'}
                ],
                'Resort': [
                    {id: 'option6', value: 'Room', label: 'Room'}
                ],
                'Apartment': [
                    {id: 'option7', value: 'Apartment', label: 'Apartment'},
                    {id: 'option8', value: 'Only room', label: 'Only room'},
                    {id: 'option9', value: 'Only Bed', label: 'Only Bed'}
                ]
            };

            var selectedValue = this.value;
            if (options[selectedValue]) {
                options[selectedValue].forEach(function (option) {
                    var li = document.createElement('li');
                    li.innerHTML = `
                  <div class class="form-check">
                      <input
                          class="form-check-input"
                          type="checkbox"
                          id="${option.id}"
                          value="${option.value}">
                      <label class="form-check-label" for="${option.id}">
                          ${option.label}
                      </label>
                  </div>
              `;
                    propertyType.appendChild(li);
                });
                propertyTypeContainer.style.display = 'block';
            } else {
                propertyTypeContainer.style.display = 'none';
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const uploadedImages = {};

            function initializeMultipleUpload(container) {
                const fileInput = container?.querySelector('.multiple-file-input');
                const thumbnailGallery = container?.querySelector('.multiple-thumbnail-gallery');
                if (!fileInput || !thumbnailGallery) return;
                const containerId = container.id || `dynamic-${Date.now()}`; // Fallback ID for dynamic containers

                uploadedImages[containerId] = [];

                fileInput.addEventListener('change', function (event) {
                    console.log(`File input changed in container: ${containerId}`);
                    const files = event.target.files;
                    for (let file of files) {
                        if (!file.type.startsWith('image/')) {
                            console.warn(`File ${file.name} is not an image`);
                            continue;
                        }
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const thumbnailItem = document.createElement('div');
                            thumbnailItem.classList.add('multiple-thumbnail-item');
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            const removeBtn = document.createElement('button');
                            removeBtn.innerHTML = '×';
                            removeBtn.classList.add('multiple-remove-btn');
                            removeBtn.addEventListener('click', () => {
                                thumbnailItem.remove();
                                const index = uploadedImages[containerId].indexOf(file);
                                if (index > -1) {
                                    uploadedImages[containerId].splice(index, 1);
                                    console.log(`Removed file ${file.name} from container ${containerId}`);
                                }
                            });
                            thumbnailItem.appendChild(img);
                            thumbnailItem.appendChild(removeBtn);
                            thumbnailGallery.appendChild(thumbnailItem);
                            uploadedImages[containerId].push(file);
                            console.log(`Added thumbnail for file ${file.name} in container ${containerId}`);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Initialize for all upload containers dynamically
            const uploadContainers = document.querySelectorAll('.multiple-upload-container');
            uploadContainers.forEach(container => {
                console.log(`Initializing upload container: ${container.id}`);
                initializeMultipleUpload(container);
            });

            // Handle Add More button for custom facilities
            const facilityContainer = document.getElementById('facility-container');
            const addMoreBtn = document.getElementById('add-more-btn');

            addMoreBtn?.addEventListener('click', function (event) {
                event.preventDefault();
                console.log('Add More button clicked for custom facilities');

                const facilityField = document.createElement('div');
                facilityField.classList.add('input-field', 'd-flex', 'align-items-center', 'mb-3');
                facilityField.style.gap = '10px';
                const uniqueId = Date.now();
                facilityField.innerHTML = `
                <div class="form-group flex-grow-1">
                    <label for="custom_facility_${uniqueId}">Facility Name</label>
                    <input class="form-control" type="text" name="custom_facilities[]" id="custom_facility_${uniqueId}" placeholder="Enter facility name" />
                </div>
                <div class="form-group">
                    <label for="custom_facility_icon_${uniqueId}">Facility Icon</label>
                    <div class="multiple-upload-container" id="upload-container-dynamic-${uniqueId}">
                        <input class="form-control multiple-file-input" type="file" name="custom_facilities_icon[]" id="custom_facility_icon_${uniqueId}" accept="image/*" />
                        <label class="upload-label">Browse Image</label>
                        <div class="multiple-thumbnail-gallery"></div>
                    </div>
                    @error('custom_facilities_icon.*') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
`;

                // Initialize file upload for the new field
                const uploadContainer = facilityField.querySelector('.multiple-upload-container');
                initializeMultipleUpload(uploadContainer);

                // Add delete functionality
                const deleteBtn = facilityField.querySelector('.delete-btn');
                deleteBtn.addEventListener('click', () => {
                    console.log('Delete button clicked for facility field');
                    facilityField.remove();
                });

                facilityContainer?.appendChild(facilityField);
                console.log('New facility field added to container');
            });
        });
    </script>

    <script type="text/javascript">
        document.getElementById("site-off")?.addEventListener("change", function () {
            let checkboxes = document.querySelectorAll(".checkbox-item");
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById("site-off").checked;
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            const checkbox = document.getElementById("property-ownership");
            const options = document.getElementById("ownership-options");

            checkbox?.addEventListener("change", () => {
                if (checkbox.checked) {
                    options.classList.remove("hidden");
                } else {
                    options.classList.add("hidden");
                }
            });
        });
    </script>

    <script>
        function showLabel(text) {
            const labelDiv = document.getElementById('labelText');
            if (!labelDiv) return;
            labelDiv.textContent = text;
            labelDiv.style.display = 'block';
        }

        function hideLabel() {
            const labelDiv = document.getElementById('labelText');
            if (!labelDiv) return;
            labelDiv.style.display = 'none';
        }
    </script>

    <script>
        document.getElementById('apartment-count')?.addEventListener('change', function () {
            const count = parseInt(this.value);
            const dynamicFormsContainer = document.getElementById('dynamic-forms');
            if (!dynamicFormsContainer) return;
            dynamicFormsContainer.innerHTML = '';

            if (count > 0) {
                for (let i = 1; i <= count; i++) {
                    const formGroup = document.createElement('div');
                    formGroup.classList.add('apartment-form');

                    const apartmentNumberLabel = document.createElement('label');
                    apartmentNumberLabel.textContent = `Apartment ${i} Number:`;
                    apartmentNumberLabel.setAttribute('for', `apartment-${i}-number`);
                    const apartmentNumberInput = document.createElement('input');
                    apartmentNumberInput.type = 'text';
                    apartmentNumberInput.id = `apartment-${i}-number`;
                    apartmentNumberInput.name = `apartments[${i}][number]`;
                    apartmentNumberInput.classList.add('form-control');

                    const apartmentFloorLabel = document.createElement('label');
                    apartmentFloorLabel.textContent = `Apartment ${i} Floor Number:`;
                    apartmentFloorLabel.setAttribute('for', `apartment-${i}-floor`);
                    const apartmentFloorInput = document.createElement('input');
                    apartmentFloorInput.type = 'text';
                    apartmentFloorInput.id = `apartment-${i}-floor`;
                    apartmentFloorInput.name = `apartments[${i}][floor]`;
                    apartmentFloorInput.classList.add('form-control');

                    const apartmentNameLabel = document.createElement('label');
                    apartmentNameLabel.textContent = `Apartment/Rooms ${i} Name:`;
                    apartmentNameLabel.setAttribute('for', `apartment-${i}-name`);
                    const apartmentNameInput = document.createElement('input');
                    apartmentNameInput.type = 'text';
                    apartmentNameInput.id = `apartment-${i}-name`;
                    apartmentNameInput.name = `apartments[${i}][name]`;
                    apartmentNameInput.classList.add('form-control');

                    formGroup.appendChild(apartmentNameLabel);
                    formGroup.appendChild(apartmentNameInput);
                    formGroup.appendChild(apartmentNumberLabel);
                    formGroup.appendChild(apartmentNumberInput);
                    formGroup.appendChild(apartmentFloorLabel);
                    formGroup.appendChild(apartmentFloorInput);

                    dynamicFormsContainer.appendChild(formGroup);
                }
            }
        });
    </script>

    <script>
        document.querySelector('form')?.addEventListener('submit', function (event) {
            console.log('Form is submitting with data:', new FormData(this));
        });
    </script>

    <script>
        const radioButtons = document.querySelectorAll('input[name="showFields"]');
        const additionalFields = document.getElementById('additionalFields');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'yes') {
                    additionalFields?.style.setProperty('display', 'block');
                } else {
                    additionalFields?.style.setProperty('display', 'none');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.js-select2').select2();

            $('#propertyOwnershipss')?.on('change', function () {
                const selectedValue = $(this).val();
                const partnerFields = $('.partner-fields');
                const leaseDates = $('.lease-dates');

                partnerFields.slideUp();
                leaseDates.slideUp();

                if (selectedValue === 'Partnership') {
                    partnerFields.slideDown();
                } else if (selectedValue === 'Leased') {
                    leaseDates.slideDown();
                }
            });
        });
    </script>

    <script>
        function initializeBarSelection() {
            const barRadioButtons = document.querySelectorAll('input[name="barOption"]');
            const barSelectContainer = document.getElementById('barSelectContainer');
            const barNumberSelect = document.getElementById('barNumberSelect');

            barRadioButtons.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.value === 'yes') {
                        barSelectContainer?.style.setProperty('display', 'block');
                    } else {
                        barSelectContainer?.style.setProperty('display', 'none');
                        if (barNumberSelect) barNumberSelect.value = '';
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', initializeBarSelection);
    </script>

    <script>
        class KidsZoneManager {
            constructor() {
                this.initializeAllKidsZones();
            }

            initializeAllKidsZones() {
                const kidsZoneSections = document.querySelectorAll('[data-kids-zone]');
                kidsZoneSections.forEach(section => {
                    this.initializeSingleKidsZone(section);
                });
            }

            initializeSingleKidsZone(section) {
                const radioButtons = section.querySelectorAll('input[type="radio"]');
                const selectContainer = section.querySelector('.select-container');
                const numberSelect = section.querySelector('.number-select');

                radioButtons.forEach(radio => {
                    radio.addEventListener('change', () => {
                        if (radio.value === 'yes') {
                            selectContainer.style.display = 'block';
                        } else {
                            selectContainer.style.display = 'none';
                            if (numberSelect) numberSelect.value = '';
                        }
                    });
                });
            }

            getAllSelections() {
                const selections = {};
                const sections = document.querySelectorAll('[data-kids-zone]');

                sections.forEach(section => {
                    const id = section.getAttribute('data-kids-zone');
                    const selectedRadio = section.querySelector('input[type="radio"]:checked');
                    const numberSelect = section.querySelector('.number-select');

                    selections[`kidsZone${id}`] = {
                        hasKidsZone: selectedRadio ? selectedRadio.value : null,
                        numberOfKids: selectedRadio?.value === 'yes' ? numberSelect.value : null
                    };
                });

                return selections;
            }

            addNewKidsZone(containerId, zoneNumber) {
                const container = document.getElementById(containerId);
                const newSection = `
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="form-group">
                        <label class="form-label">Kids Zone ${zoneNumber}</label>
                        <div class="radio-group" data-kids-zone="${zoneNumber}">
                            <div>
                                <label>
                                    <input type="radio" name="kidsZone${zoneNumber}" value="yes" class="radio-yes"> Yes
                                </label>
                            </div>
                            <div>
                                <label>
                                    <input type="radio" name="kidsZone${zoneNumber}" value="no" class="radio-no"> No
                                </label>
                            </div>
                            <div class="select-container" style="display: none;">
                                <label>Select number of kids:</label>
                                <select class="form-select number-select">
                                    <option value="">Select number</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            `;

                container.insertAdjacentHTML('beforeend', newSection);
                this.initializeSingleKidsZone(container.lastElementChild.querySelector('[data-kids-zone]'));
            }
        }

        const kidsZoneManager = new KidsZoneManager();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const yesOption = document.getElementById("yesOption");
            const noOption = document.getElementById("noOption");
            const yesFields = document.getElementById("yesFields");
            const noFields = document.getElementById("noFields");

            yesOption?.addEventListener("change", function () {
                if (this.checked) {
                    yesFields?.classList.remove("hidden");
                    noFields?.classList.add("hidden");
                }
            });

            noOption?.addEventListener("change", function () {
                if (this.checked) {
                    noFields?.classList.remove("hidden");
                    yesFields?.classList.add("hidden");
                }
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("#facilities-all")?.addEventListener("change", function () {
                console.log("Facilities Select All toggled");
                const facilitiesCheckboxes = document.querySelectorAll(".checkbox-item-facility");
                facilitiesCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = document.querySelector("#facilities-all").checked;
                    console.log(`Checkbox ${checkbox.id} set to ${checkbox.checked}`);
                });
            });
        });
    </script>

    <script type="text/javascript">
        document.getElementById("check-in-all")?.addEventListener("change", function () {
            let checkinCheckboxes = document.querySelectorAll(".checkbox-item-checkin");
            checkinCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById("check-in-all").checked;
            });
        });
    </script>

    <script>
        document.getElementById('addRuleBtn')?.addEventListener('click', function (event) {
            event.preventDefault();
            const formContainer = document.getElementById('formContainer');
            if (!formContainer) return;
            const newField = document.createElement('div');
            newField.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3');
            newField.innerHTML = `
            <div class="form-group">
                <input type="text" class="form-control" name="custom_check_in_methods[]" placeholder="" required>
                <button class="delete-btn">Delete</button>
            </div>
        `;
            formContainer.appendChild(newField);
            const deleteBtn = newField.querySelector('.delete-btn');
            deleteBtn.addEventListener('click', function () {
                formContainer.removeChild(newField);
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".radio-group input[type='radio']").forEach(function (radio) {
                radio.addEventListener("change", function () {
                    const targetId = this.getAttribute("data-target");
                    const targetInput = document.getElementById(targetId);
                    if (targetInput) {
                        if (this.value === "yes") {
                            targetInput.classList.remove("hidden");
                        } else {
                            targetInput.classList.add("hidden");
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        document.querySelector("#property-all")?.addEventListener("change", function () {
            const propertyCheckboxes = document.querySelectorAll(".checkbox-item-property");
            propertyCheckboxes.forEach(function (checkbox) {
                checkbox.checked = document.querySelector("#property-all").checked;
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".add-more").forEach((button) => {
                button.addEventListener("click", function (event) {
                    event.preventDefault();
                    const inputContainer = this.previousElementSibling;
                    const newFormGroup = document.createElement("div");
                    newFormGroup.classList.add("form-group", "mb-1", "d-flex", "align-items-center");
                    newFormGroup.style.gap = "10px";
                    const inputField = document.createElement("input");
                    inputField.type = "text";
                    inputField.classList.add("form-control");
                    inputField.placeholder = "Enter something";
                    const deleteButton = document.createElement("button");
                    deleteButton.innerText = "Delete";
                    deleteButton.classList.add("delete-btn");
                    deleteButton.addEventListener("click", function () {
                        newFormGroup.remove();
                    });
                    newFormGroup.appendChild(inputField);
                    newFormGroup.appendChild(deleteButton);
                    inputContainer.parentNode.insertBefore(newFormGroup, this);
                });
            });
        });
    </script>

    <script>
        const hotelFacilitiesLabelsMap = {
            'General Services': ['General Services Name'],
            'Activities & Entertainment': ['Activities & Entertainment Name'],
            'Safety & Security': ['Security Feature Name'],
            'Technology, Media & Wi-Fi': ['Technology, Media & Wi-Fi Name'],
            'Bedroom Features': ['Bedroom Feature Name'],
            'Bathroom Amenities': ['Bathroom Amenity'],
            'Living Room Features': ['Living Room Feature'],
            'Kitchen Facilities': ['Kitchen Facility'],
            'Food & Beverages': ['Food & Beverage Option'],
            'Parking Availability': ['Parking Option'],
            'View from the Hotel': ['View Type'],
            'Front Desk Services': ['Front Desk Service'],
            'Housekeeping & Cleaning': ['Housekeeping & Cleaning Service'],
            'Room Amenities': ['Room Amenity'],
            'Business & Meeting Services': ['Business & Meeting Service'],
            'Languages Spoken': ['Language']
        };

        const hotelFacilitiesCategoryKeysMap = {
            'general_services': 'General Services',
            'activities___entertainment': 'Activities & Entertainment',
            'safety___security': 'Safety & Security',
            'technology__media___wi_fi': 'Technology, Media & Wi-Fi',
            'bedroom_features': 'Bedroom Features',
            'bathroom_amenities': 'Bathroom Amenities',
            'living_room_features': 'Living Room Features',
            'kitchen_facilities': 'Kitchen Facilities',
            'food___beverages': 'Food & Beverages',
            'parking_availability': 'Parking Availability',
            'view_from_the_hotel': 'View from the Hotel',
            'front_desk_services': 'Front Desk Services',
            'housekeeping___cleaning': 'Housekeeping & Cleaning',
            'room_amenities': 'Room Amenities',
            'business___meeting_services': 'Business & Meeting Services',
            'languages_spoken': 'Languages Spoken'
        };

        const hotelFacilitySelector = document.getElementById('hotelFacilitySelector');
        const hotelFormContainer = document.getElementById('dynamicFieldsContainerHotelFacility');
        let currentFacilityValue = '';

        function createHotelFieldGroup(category, value = '') {
            const labels = hotelFacilitiesLabelsMap[category];
            if (!labels || !hotelFormContainer) return;

            const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
            const uniqueId = `hotel-facility-${categoryKey}-${Date.now()}`;

            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.setAttribute('id', uniqueId);
            newFieldGroup.innerHTML = `
        <div class="form-group">
            <label for="input-${uniqueId}">${labels[0]}</label>
            <input type="text" class="form-control" id="input-${uniqueId}" name="hotel_facilities[${categoryKey}][]" placeholder="Enter ${labels[0]}" value="${value}" required>
        </div>
        <button type="button" class="btn btn-danger btn-sm mt-2 delete-hotel-btn">Delete</button>
    `;

            let categoryWrapper = document.getElementById(`wrapper-${categoryKey}`);
            if (!categoryWrapper) {
                categoryWrapper = document.createElement('div');
                categoryWrapper.classList.add('col-12', 'mb-3');
                categoryWrapper.id = `wrapper-${categoryKey}`;
                categoryWrapper.innerHTML = `<h5>${category}</h5><div class="row"></div>`;
                hotelFormContainer.appendChild(categoryWrapper);
            }

            const row = categoryWrapper.querySelector('.row');
            row.appendChild(newFieldGroup);

            newFieldGroup.querySelector('.delete-hotel-btn').addEventListener('click', function () {
                row.removeChild(newFieldGroup);
                if (row.children.length === 0) {
                    hotelFormContainer.removeChild(categoryWrapper);
                }
            });
        }

        // For dropdown selection
        if (hotelFacilitySelector) {
            hotelFacilitySelector.addEventListener('change', function () {
                currentFacilityValue = this.value;
                if (!hotelFacilitiesLabelsMap[currentFacilityValue]) return;
                createHotelFieldGroup(currentFacilityValue);
            });
        }

        // For Add More button
        const addHotelFacilityBtn = document.getElementById('addHotelFacility');
        if (addHotelFacilityBtn) {
            addHotelFacilityBtn.addEventListener('click', function (event) {
                event.preventDefault();
                if (!currentFacilityValue || !hotelFacilitiesLabelsMap[currentFacilityValue]) {
                    alert("Please select a valid facility category first.");
                    return;
                }
                createHotelFieldGroup(currentFacilityValue);
            });
        }

        // Now load existing hotel facilities if available
        const hotelFacilitiesData = {!! json_encode($hotelFacilities ?? []) !!};
        hotelFacilitiesData.forEach(facility => {
            const categoryKey = facility.category; // example: general_services
            const name = facility.name;

            const category = hotelFacilitiesCategoryKeysMap[categoryKey]; // convert back to readable category

            if (category && hotelFacilitiesLabelsMap[category]) {
                createHotelFieldGroup(category, name);
            }
        });
    </script>

    <script>
        const sectionLabelsMap = {
            'Restaurant & Cafe': ['Restaurant & Cafe Name', 'Distance'],
            'Entertainment & Attraction Point': ['Entertainment & Attraction Point', 'Distance'],
            'Hospital & Police Station': ['Hospital & Police Station Name', 'Distance'],
            'Transport & Airport': ['Transport & Airport Name', 'Distance'],
            'Shopping & ATM': ['Shopping & ATM', 'Distance']
        };

        const areaSelector = document.getElementById('areaSelector');
        const formContainer = document.getElementById('dynamicFieldsContainer');
        let currentSelectedValue = '';

        function createFieldGroup(category, nameValue = '', distanceValue = '') {
            const labels = sectionLabelsMap[category];
            const uniqueId = `nearby-area-${category.replace(/[^a-zA-Z0-9]/g, '')}-${Date.now()}`;
            const categoryKey = category.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();

            const newFieldGroup = document.createElement('div');
            newFieldGroup.classList.add('col-md-6', 'col-lg-4', 'col-xxl-3', 'mb-3');
            newFieldGroup.setAttribute('id', uniqueId);
            newFieldGroup.innerHTML = `
        <div class="form-group">
            <label for="input-name-${uniqueId}">${labels[0]}</label>
            <input type="text" class="form-control" id="input-name-${uniqueId}"
                name="nearby_areas[${categoryKey}][name][]"
                placeholder="Enter ${labels[0]}"
                value="${nameValue}" required>
        </div>
        <div class="form-group">
            <label for="input-distance-${uniqueId}">${labels[1]}</label>
            <input type="text" class="form-control" id="input-distance-${uniqueId}"
                name="nearby_areas[${categoryKey}][distance][]"
                placeholder="Enter ${labels[1]}"
                value="${distanceValue}" required>
        </div>
        <button type="button" class="btn btn-danger btn-sm mt-3 delete-nearby-btn">Delete</button>
    `;

            let categoryWrapper = document.getElementById(`wrapper-${categoryKey}`);
            if (!categoryWrapper) {
                categoryWrapper = document.createElement('div');
                categoryWrapper.classList.add('col-12', 'mb-3');
                categoryWrapper.id = `wrapper-${categoryKey}`;
                categoryWrapper.innerHTML = `<h5>${category}</h5><div class="row"></div>`;
                formContainer.appendChild(categoryWrapper);
            }

            const row = categoryWrapper.querySelector('.row');
            row.appendChild(newFieldGroup);

            newFieldGroup.querySelector('.delete-nearby-btn').addEventListener('click', function () {
                row.removeChild(newFieldGroup);
                if (row.children.length === 0) {
                    formContainer.removeChild(categoryWrapper);
                }
            });
        }

        if (areaSelector) {
            areaSelector.addEventListener('change', function () {
                currentSelectedValue = this.value;
                if (!sectionLabelsMap[currentSelectedValue]) return;
                createFieldGroup(currentSelectedValue);
            });
        }

        const addNearbyAreaBtn = document.getElementById('addNearbyAreaBtn');
        if (addNearbyAreaBtn) {
            addNearbyAreaBtn.addEventListener('click', function (event) {
                event.preventDefault();
                if (!currentSelectedValue || !sectionLabelsMap[currentSelectedValue]) {
                    alert("Please select a valid nearby area category first.");
                    return;
                }
                createFieldGroup(currentSelectedValue);
            });
        }

        // 💥 Show existing data
        function populateExistingNearbyAreas(existingData) {
            if (!existingData) return;

            Object.keys(existingData).forEach(function (categoryKey) {
                const formattedCategory = categoryKey.replace(/_/g, ' ').replace(/\s+/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

                // Find the real section label
                let actualCategory = '';
                Object.keys(sectionLabelsMap).forEach(section => {
                    const sectionKey = section.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
                    if (sectionKey === categoryKey) {
                        actualCategory = section;
                    }
                });

                if (!actualCategory) {
                    console.warn(`Category not found for key: ${categoryKey}`);
                    return;
                }

                const names = existingData[categoryKey]['name'] || [];
                const distances = existingData[categoryKey]['distance'] || [];

                names.forEach((name, index) => {
                    const distance = distances[index] || '';
                    createFieldGroup(actualCategory, name, distance);
                });
            });
        }

        // Call this after page load
        document.addEventListener('DOMContentLoaded', function () {
            const existingNearbyAreas = @json($hotel->nearby_areas);
            populateExistingNearbyAreas(existingNearbyAreas);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('custom-checkin-wrapper');
            const addBtn = document.getElementById('add-checkin-rule');

            // Add new custom field
            addBtn?.addEventListener('click', () => {
                const group = document.createElement('div');
                group.className = 'form-group mb-2 d-flex align-items-center';

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'custom_check_in_rules[]';
                input.className = 'form-control';
                input.placeholder = 'Enter something';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger btn-sm ms-2 remove-checkin';
                removeBtn.textContent = 'Delete';
                removeBtn.addEventListener('click', () => group.remove());

                group.appendChild(input);
                group.appendChild(removeBtn);
                wrapper?.appendChild(group); /* fixed */
            });

            // Delegate delete clicks
            wrapper?.addEventListener('click', e => {
                if (e.target.classList.contains('remove-checkin')) {
                    e.target.closest('.form-group').remove();
                }
            });
        });
    </script>

@endsection
