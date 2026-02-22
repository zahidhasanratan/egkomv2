<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EZBOOKING Login</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        list-style: none;
        text-decoration: none;
    }

    html, body {
        display: grid;
        height: 100%;
        width: 100%;
        place-items: center;
        background-image: linear-gradient(rgba(0, 0, 0, .1), rgba(0, 0, 0, .1)), url('https://i.postimg.cc/8CnC2xH5/background.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .wrapper {
        max-width: 390px;
        background-color: transparent;
        backdrop-filter: blur(20px);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 15px 20px rgba(0, 0, 0, .1);
        overflow: hidden;
    }

    .wrapper .title-text {
        display: flex;
        width: 200%;
    }

    .wrapper .title-text .title {
        width: 50%;
        font-size: 35px;
        font-weight: 600;
        text-align: center;
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        color: #fff;
    }

    .wrapper .form-container {
        width: 100%;
        overflow: hidden;
    }

    .form-container .slide-controls {
        display: flex;
        justify-content: space-between;
        height: 50px;
        width: 100%;
        border: 1px solid lightgrey;
        overflow: hidden;
        margin: 30px 0 10px 0;
        border-radius: 10px;
        position: relative;
    }

    .slide-controls .slide {
        width: 100%;
        height: 100%;
        font-size: 18px;
        font-weight: 500;
        line-height: 48px;
        text-align: center;
        cursor: pointer;
        color: #fff;
        z-index: 1;
        transition: all .6s ease;
    }

    .slide-controls .signup {
        color: #212121;
    }

    .slide-controls .slide-tab {
        position: absolute;
        height: 100%;
        width: 50%;
        top: 0;
        left: 0;
        z-index: 0;
        background: -webkit-linear-gradient(left, #648b45, #223f1f);
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    input[type="radio"] {
        display: none;
    }

    #signup:checked ~ .slide-tab {
        left: 50%;
    }

    #signup:checked ~ .signup {
        color: #fff;
    }

    #signup:checked ~ .login {
        color: #212121;
    }

    .form-container .form-inner {
        display: flex;
        width: 200%;
    }

    .form-container .form-inner form {
        width: 50%;
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .form-inner form .field {
        height: 50px;
        width: 100%;
        margin-top: 20px;
    }

    /* Input fields */
    .form-inner form .field input {
        width: 100%;
        height: 100%;
        outline: none;
        font-size: 17px;
        padding-left: 15px;
        border-radius: 10px;
        border: 1px solid lightgray;
        border-bottom-width: 2px;
        transition: all 0.4s ease;
    }

    .form-inner form .field input:focus {
        border-color: #fc83bb;
    }

    /* Styling for the select dropdown to look like an input */
    .form-inner form .field select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 100%;
        padding: 12px 15px;
        font-size: 17px;
        border-radius: 10px;
        border: 1px solid lightgray;
        background-color: #fff;
        color: #333;
        transition: all 0.4s ease;
        cursor: pointer;
        box-sizing: border-box;
    }

    /* Add custom arrow to the dropdown */
    .form-inner form .field select::-ms-expand {
        display: none;
    }

    .form-inner form .field select:focus {
        border-color: #fc83bb;
        outline: none;
    }

    /* Styling for the submit button */
    form .field input[type="submit"] {
        background: -webkit-linear-gradient(left, #648b45, #223f1f);
        color: #fff;
        font-size: 20px;
        font-weight: 500;
        padding-left: 0;
        border: none;
        cursor: pointer;
    }

    .form-inner form .pass-link {
        margin-top: 5px;
    }

    .form-inner form .pass-link a,
    a {
        color: #fff;
        text-decoration: none;
    }

    .form-inner form .signup-link {
        color: #fff;
        text-align: center;
        margin-top: 30px;
    }

    .form-inner form .signup-link a {
        font-weight: bold;
    }

    .form-inner form .pass-link a:hover,
    .form-inner form .signup-link a:hover {
        text-decoration: underline;
    }

</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
<div class="wrapper">
    <div class="title-text">
        <div class="title login">EZBOOKING Login</div>
    </div>
    <div class="form-container">

        <div class="form-inner">
            @if ($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ $errors->first() }}', // Display the first error message
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

                <form id="login-form" method="POST" class="login">
                @csrf

                <!-- Dropdown to select user type -->
                    <div class="field">
                        <select id="user-type" name="user_type">
                            <option value="super-admin">EZBOOKING/Super Admin</option>
                            <option value="user">User</option>
                            <option value="hotel-vendor">Hotel/Vendor</option>
                            <option value="co-host">Co-Host</option>
                        </select>
                    </div>

                    <!-- Email input -->
                    <div class="field">
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>

                    <!-- Password input -->
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <!-- Forgot password link -->
                    <div class="pass-link">
                        <a href="#" id="forgot-password-link">Forgot Password</a>
                    </div>

                    <!-- Submit button -->
                    <div class="field">
                        <input type="submit" value="Login">
                    </div>
                </form>


        </div>
    </div>
</div>
<script>
    // Get the form and the select element
    const form = document.getElementById('login-form');
    const userTypeSelect = document.getElementById('user-type');

    // Set default form action
    form.action = "{{ route('super-admin.login.submit') }}"; // Default for Super Admin

    // Add event listener for the select element change
    userTypeSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        const forgotPasswordLink = document.getElementById('forgot-password-link');

        // Update form action based on selected option
        if (selectedValue === 'super-admin') {
            form.action = "{{ route('super-admin.login.submit') }}"; // Super Admin
            forgotPasswordLink.href = "{{ route('super-admin.password.request') }}";
        } else if (selectedValue === 'hotel-vendor') {
            form.action = "{{ route('vendor-admin.login.submit') }}"; // Vendor
            forgotPasswordLink.href = "{{ route('vendor-admin.password.request') }}";
        } else if (selectedValue === 'co-host') {
            form.action = "{{ route('co-host.login.submit') }}"; // Co-Host
            forgotPasswordLink.href = "#"; // No password reset for co-hosts yet
        } else if (selectedValue === 'user') {
            form.action = "{{ route('guest.login.submit') }}"; // Guest/User – same as frontend guest login
            forgotPasswordLink.href = "{{ route('guest.password.request') }}";
        } else {
            form.action = '#';
            forgotPasswordLink.href = '#';
        }
    });
    
    // Set initial forgot password link
    document.getElementById('forgot-password-link').href = "{{ route('super-admin.password.request') }}";
</script>
<link rel="stylesheet" href="{{ asset('frontend')}}/css/password-toggle.css">
<script src="{{ asset('frontend')}}/js/password-toggle.js"></script>
<script src="script.js"></script>
</body>
</html>
