<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Login & Signup - EZBOOKING</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend')}}/css/password-toggle.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            position: relative;
        }

        .vendor-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .vendor-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .vendor-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .vendor-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .tab-container {
            display: flex;
            border-bottom: 2px solid #e0e0e0;
        }

        .tab-button {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
        }

        .tab-button.active {
            background: white;
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .tab-button:hover {
            background: #f0f0f0;
        }

        .tab-content {
            display: none;
            padding: 40px;
        }

        .tab-content.active {
            display: block;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .counter-wrapper {
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
        }

        .counter-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            min-width: 150px;
        }

        .counter {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .counter button {
            width: 35px;
            height: 35px;
            border: none;
            background: #667eea;
            color: white;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .counter button:hover {
            background: #764ba2;
            transform: scale(1.1);
        }

        .counter .count {
            font-size: 1.5rem;
            font-weight: 600;
            min-width: 30px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .hidden {
            display: none !important;
        }

        .login-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .signup-note {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .go-home-link {
            position: fixed;
            top: 20px;
            left: 20px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            z-index: 9999;
            background: rgba(0, 0, 0, 0.2);
            padding: 10px 15px;
            border-radius: 8px;
            backdrop-filter: blur(5px);
        }

        .go-home-link:hover {
            color: #fff;
            background: rgba(0, 0, 0, 0.3);
            transform: translateX(-5px);
            text-decoration: none;
        }

        .go-home-link:active {
            transform: translateX(-3px);
        }

        @media (max-width: 768px) {
            .vendor-header h1 {
                font-size: 2rem;
            }
            .tab-content {
                padding: 20px;
            }
            .go-home-link {
                top: 10px;
                left: 10px;
                padding: 8px 12px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="go-home-link">
        <i class="fas fa-arrow-left"></i> Go to Home
    </a>

    <div class="vendor-container">
        <div class="vendor-header">
            <h1><i class="fas fa-store"></i> Become a Vendor</h1>
            <p>Join "EZBOOKING" and Start Earning from Hosting</p>
        </div>

        <div class="tab-container">
            <button class="tab-button active" onclick="switchTab('login')">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
            <button class="tab-button" onclick="switchTab('signup')">
                <i class="fas fa-user-plus"></i> Signup
            </button>
        </div>

        <!-- Login Tab -->
        <div id="login-tab" class="tab-content active">
            <div class="login-form">
                @if ($errors->any())
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '{{ $errors->first() }}',
                        });
                    </script>
                @endif

                @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '{{ session('success') }}',
                        });
                    </script>
                @endif

                <form action="{{ route('vendor-admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('vendor-admin.password.request') }}" style="color: #667eea; text-decoration: none;">Forgot Password?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Signup Tab -->
        <div id="signup-tab" class="tab-content">
            <div class="signup-note">
                <i class="fas fa-info-circle"></i> <strong>Note:</strong> Your account will be reviewed and approved by admin before you can access the dashboard.
            </div>

            <form action="{{ route('vendor-admin.signup.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information -->
                <div class="form-section">
                    <h3 class="form-section-title"><i class="fas fa-info-circle"></i> Basic Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Property/Hotel Name <span class="text-danger">*</span></label>
                                <input type="text" name="property_name" class="form-control" value="{{ old('property_name') }}" placeholder="ex: Prime 365" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Password <span class="text-danger">*</span> <small class="text-muted">(Min 8 characters)</small></label>
                                <input type="password" name="password" class="form-control" minlength="8" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" minlength="8" placeholder="Confirm Password" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="form-section">
                    <h3 class="form-section-title"><i class="fas fa-map-marker-alt"></i> Location Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Country Name</label>
                                <select class="form-select" name="country_name">
                                    <option value="Bangladesh" {{ old('country_name', 'Bangladesh') === 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">District Name</label>
                                <select class="form-select" name="district_name">
                                    <option value="">Select District Name</option>
                                    @foreach(['Bagerhat', 'Bandarban', 'Barguna', 'Barisal', 'Bhola', 'Bogra', 'Brahmanbaria', 'Chandpur', 'Chittagong', 'Chuadanga', 'Comilla', "Cox'sBazar", 'Dhaka', 'Dinajpur', 'Faridpur', 'Feni', 'Gaibandha', 'Gazipur', 'Gopalganj', 'Habiganj', 'Jaipurhat', 'Jamalpur', 'Jessore', 'Jhalokati', 'Jhenaidah', 'Khagrachari', 'Khulna', 'Kishoreganj', 'Kurigram', 'Kushtia', 'Lakshmipur', 'Lalmonirhat', 'Madaripur', 'Magura', 'Manikganj', 'Maulvibazar', 'Meherpur', 'Munshiganj', 'Mymensingh', 'Naogaon', 'Narail', 'Narayanganj', 'Narsingdi', 'Natore', 'Nawabganj', 'Netrokona', 'Nilphamari', 'Noakhali', 'Pabna', 'Panchagarh', 'Patuakhali', 'Pirojpur', 'Rajbari', 'Rajshahi', 'Rangamati', 'Rangpur', 'Satkhira', 'Shariatpur', 'Sherpur', 'Sirajganj', 'Sunamganj', 'Sylhet', 'Tangail', 'Thakurgaon'] as $district)
                                        <option value="{{ $district }}" {{ old('district_name') === $district ? 'selected' : '' }}>{{ $district }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">City/Town/Village</label>
                                <input type="text" name="city_town_village" class="form-control" value="{{ old('city_town_village') }}" placeholder="City/Town/Village">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Postcode</label>
                                <input type="text" name="postcode" class="form-control" value="{{ old('postcode') }}" placeholder="Postcode">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">House Number</label>
                                <input type="text" name="house_number" class="form-control" value="{{ old('house_number') }}" placeholder="House Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Road Number/Name (If any)</label>
                                <input type="text" name="road_number_name" class="form-control" value="{{ old('road_number_name') }}" placeholder="Road Number/Name">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="form-section">
                    <h3 class="form-section-title"><i class="fas fa-building"></i> Property Details</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Total Capacity</label>
                                <input type="number" name="total_capacity" class="form-control" value="{{ old('total_capacity') }}" placeholder="Total Capacity" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Total Car Parking</label>
                                <input type="number" name="total_car_parking" class="form-control" value="{{ old('total_car_parking') }}" placeholder="Total Car Parking" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Reception (If any)</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="reception" value="yes" {{ old('reception') === 'yes' ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="reception" value="no" {{ old('reception', 'no') === 'no' ? 'checked' : '' }}> No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Total Lifts / Elevators</label>
                                <select class="form-select" name="total_lifts">
                                    <option value="">Select Number</option>
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" {{ old('total_lifts') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Total Generators</label>
                                <select class="form-select" name="total_generators">
                                    <option value="">Select Number</option>
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" {{ old('total_generators') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Total Fire Exits</label>
                                <select class="form-select" name="total_fire_exits">
                                    <option value="">Select Number</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('total_fire_exits') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Wheelchair Access</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="wheelchair_access" value="yes" {{ old('wheelchair_access') === 'yes' ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="wheelchair_access" value="no" {{ old('wheelchair_access', 'no') === 'no' ? 'checked' : '' }}> No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">View from Hotel / Property</label>
                                <input type="text" name="view_from_hotel" class="form-control" value="{{ old('view_from_hotel') }}" placeholder="City View, Beach View, Hill View, etc.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Number of Security Guards</label>
                                <select class="form-select" name="security_guards">
                                    <option value="">Select Number</option>
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" {{ old('security_guards') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Housekeeping -->
                <div class="form-section">
                    <h3 class="form-section-title"><i class="fas fa-broom"></i> Housekeeping & Cleaners</h3>
                    <div class="counter-wrapper">
                        <div class="counter-card">
                            <h4>Total Male</h4>
                            <div class="counter">
                                <button type="button" class="btn decrease-male">-</button>
                                <span class="count male-count">0</span>
                                <input type="hidden" name="male_housekeeping" value="0" class="male-input">
                                <button type="button" class="btn increase-male">+</button>
                            </div>
                        </div>
                        <div class="counter-card">
                            <h4>Total Female</h4>
                            <div class="counter">
                                <button type="button" class="btn decrease-female">-</button>
                                <span class="count female-count">0</span>
                                <input type="hidden" name="female_housekeeping" value="0" class="female-input">
                                <button type="button" class="btn increase-female">+</button>
                            </div>
                        </div>
                        <div class="counter-card">
                            <h4>Total</h4>
                            <div class="total-count" style="font-size: 1.5rem; font-weight: 600; margin-top: 10px;">0</div>
                        </div>
                    </div>
                </div>

                <!-- Facilities -->
                <div class="form-section">
                    <h3 class="form-section-title"><i class="fas fa-star"></i> Facilities</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Kids Zone</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="kids_zone" value="yes" class="kids-zone-radio" {{ old('kids_zone') === 'yes' ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="kids_zone" value="no" class="kids-zone-radio" {{ old('kids_zone', 'no') === 'no' ? 'checked' : '' }}> No</label>
                                </div>
                                <div class="kids-zone-count" style="display: {{ old('kids_zone') === 'yes' ? 'block' : 'none' }}; margin-top: 10px;">
                                    <select class="form-select" name="kids_zone_count">
                                        <option value="">Select number</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('kids_zone_count') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Pool (If any)</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="pool" value="yes" class="pool-radio" {{ old('pool') === 'yes' ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="pool" value="no" class="pool-radio" {{ old('pool', 'no') === 'no' ? 'checked' : '' }}> No</label>
                                </div>
                                <div class="pool-count" style="display: {{ old('pool') === 'yes' ? 'block' : 'none' }}; margin-top: 10px;">
                                    <select class="form-select" name="pool_count">
                                        <option value="">Select number</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('pool_count') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Bar (If any)</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="bar" value="yes" class="bar-radio" {{ old('bar') === 'yes' ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="bar" value="no" class="bar-radio" {{ old('bar', 'no') === 'no' ? 'checked' : '' }}> No</label>
                                </div>
                                <div class="bar-count" style="display: {{ old('bar') === 'yes' ? 'block' : 'none' }}; margin-top: 10px;">
                                    <select class="form-select" name="bar_count">
                                        <option value="">Select number</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('bar_count') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Gym (If any)</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="gym" value="yes" class="gym-radio" {{ old('gym') === 'yes' ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="gym" value="no" class="gym-radio" {{ old('gym', 'no') === 'no' ? 'checked' : '' }}> No</label>
                                </div>
                                <div class="gym-count" style="display: {{ old('gym') === 'yes' ? 'block' : 'none' }}; margin-top: 10px;">
                                    <select class="form-select" name="gym_count">
                                        <option value="">Select number</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('gym_count') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Cafe & Restaurants (If any)</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="cafe_restaurants" value="yes" class="cafe-radio" {{ old('cafe_restaurants') === 'yes' ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="cafe_restaurants" value="no" class="cafe-radio" {{ old('cafe_restaurants', 'no') === 'no' ? 'checked' : '' }}> No</label>
                                </div>
                                <div class="cafe-section" style="display: {{ old('cafe_restaurants') === 'yes' ? 'block' : 'none' }}; margin-top: 10px;">
                                    <select class="form-select mb-2" name="cafe_restaurants_count" id="cafe-count-select">
                                        <option value="">Select total number</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ old('cafe_restaurants_count') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div id="cafe-names-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Party Center (If any)</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="party_center" value="yes" class="party-radio" {{ old('party_center') === 'yes' ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="party_center" value="no" class="party-radio" {{ old('party_center', 'no') === 'no' ? 'checked' : '' }}> No</label>
                                </div>
                                <div class="party-details" style="display: {{ old('party_center') === 'yes' ? 'block' : 'none' }}; margin-top: 10px;">
                                    <textarea class="form-control" name="party_center_details" placeholder="Ex: 1500 SFT" rows="2">{{ old('party_center_details') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Conference Hall (If any)</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="conference_hall" value="yes" class="conference-radio" {{ old('conference_hall') === 'yes' ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="conference_hall" value="no" class="conference-radio" {{ old('conference_hall', 'no') === 'no' ? 'checked' : '' }}> No</label>
                                </div>
                                <div class="conference-details" style="display: {{ old('conference_hall') === 'yes' ? 'block' : 'none' }}; margin-top: 10px;">
                                    <textarea class="form-control" name="conference_hall_details" placeholder="Ex: 1500 SFT" rows="2">{{ old('conference_hall_details') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Logo -->
                <div class="form-section">
                    <h3 class="form-section-title"><i class="fas fa-image"></i> Company Logo</h3>
                    <div class="form-group">
                        <label class="form-label">Upload Logo</label>
                        <input type="file" name="company_logo" class="form-control" accept="image/*">
                        <small class="text-muted">Max file size: 5MB</small>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-section">
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-user-plus"></i> Create Vendor Account
                    </button>
                    <p class="text-center mt-3 text-muted">
                        By signing up, you agree that your account will be reviewed and approved by admin.
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tab + '-tab').classList.add('active');
            event.target.closest('.tab-button').classList.add('active');
        }

        // Housekeeping counters
        let maleCount = 0;
        let femaleCount = 0;

        document.querySelector('.increase-male')?.addEventListener('click', function() {
            maleCount++;
            document.querySelector('.male-count').textContent = maleCount;
            document.querySelector('.male-input').value = maleCount;
            updateTotal();
        });

        document.querySelector('.decrease-male')?.addEventListener('click', function() {
            if (maleCount > 0) {
                maleCount--;
                document.querySelector('.male-count').textContent = maleCount;
                document.querySelector('.male-input').value = maleCount;
                updateTotal();
            }
        });

        document.querySelector('.increase-female')?.addEventListener('click', function() {
            femaleCount++;
            document.querySelector('.female-count').textContent = femaleCount;
            document.querySelector('.female-input').value = femaleCount;
            updateTotal();
        });

        document.querySelector('.decrease-female')?.addEventListener('click', function() {
            if (femaleCount > 0) {
                femaleCount--;
                document.querySelector('.female-count').textContent = femaleCount;
                document.querySelector('.female-input').value = femaleCount;
                updateTotal();
            }
        });

        function updateTotal() {
            const total = maleCount + femaleCount;
            document.querySelector('.total-count').textContent = total;
        }

        // Kids Zone toggle
        document.querySelectorAll('.kids-zone-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const countDiv = document.querySelector('.kids-zone-count');
                if (this.value === 'yes') {
                    countDiv.style.display = 'block';
                } else {
                    countDiv.style.display = 'none';
                    countDiv.querySelector('select').value = '';
                }
            });
        });

        // Pool toggle
        document.querySelectorAll('.pool-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const countDiv = document.querySelector('.pool-count');
                if (this.value === 'yes') {
                    countDiv.style.display = 'block';
                } else {
                    countDiv.style.display = 'none';
                    countDiv.querySelector('select').value = '';
                }
            });
        });

        // Bar toggle
        document.querySelectorAll('.bar-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const countDiv = document.querySelector('.bar-count');
                if (this.value === 'yes') {
                    countDiv.style.display = 'block';
                } else {
                    countDiv.style.display = 'none';
                    countDiv.querySelector('select').value = '';
                }
            });
        });

        // Gym toggle
        document.querySelectorAll('.gym-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const countDiv = document.querySelector('.gym-count');
                if (this.value === 'yes') {
                    countDiv.style.display = 'block';
                } else {
                    countDiv.style.display = 'none';
                    countDiv.querySelector('select').value = '';
                }
            });
        });

        // Cafe & Restaurants toggle
        document.querySelectorAll('.cafe-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const section = document.querySelector('.cafe-section');
                if (this.value === 'yes') {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                    document.getElementById('cafe-count-select').value = '';
                    document.getElementById('cafe-names-container').innerHTML = '';
                }
            });
        });

        // Cafe names dynamic fields
        document.getElementById('cafe-count-select')?.addEventListener('change', function() {
            const count = parseInt(this.value || '0');
            const container = document.getElementById('cafe-names-container');
            container.innerHTML = '';
            if (count > 0) {
                for (let i = 1; i <= count; i++) {
                    const div = document.createElement('div');
                    div.className = 'mb-2';
                    div.innerHTML = `
                        <label class="form-label">Cafe & Restaurant Name ${i}</label>
                        <input type="text" class="form-control" name="cafe_names[]" placeholder="Enter name ${i}">
                    `;
                    container.appendChild(div);
                }
            }
        });

        // Party Center toggle
        document.querySelectorAll('.party-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const detailsDiv = document.querySelector('.party-details');
                if (this.value === 'yes') {
                    detailsDiv.style.display = 'block';
                } else {
                    detailsDiv.style.display = 'none';
                    detailsDiv.querySelector('textarea').value = '';
                }
            });
        });

        // Conference Hall toggle
        document.querySelectorAll('.conference-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const detailsDiv = document.querySelector('.conference-details');
                if (this.value === 'yes') {
                    detailsDiv.style.display = 'block';
                } else {
                    detailsDiv.style.display = 'none';
                    detailsDiv.querySelector('textarea').value = '';
                }
            });
        });
    </script>
    <script src="{{ asset('frontend')}}/js/password-toggle.js"></script>
</body>
</html>
