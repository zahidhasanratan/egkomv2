<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - EGKOM</title>
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

    html, body{
        display: grid;
        height: 100%;
        width: 100%;
        place-items: center;
        background-image: linear-gradient(rgba(0, 0, 0, .1), rgba(0, 0, 0, .1)), url('https://i.postimg.cc/8CnC2xH5/background.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .wrapper{
        max-width: 390px;
        background-color: transparent;
        backdrop-filter: blur(20px);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 15px 20px rgba(0, 0, 0, .1);
        overflow: hidden;
    }

    .wrapper .title-text .title{
        font-size: 28px;
        font-weight: 600;
        text-align: center;
        color: #fff;
        margin-bottom: 20px;
    }

    .form-inner form .field{
        height: 50px;
        width: 100%;
        margin-top: 20px;
    }

    .form-inner form .field input{
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

    .form-inner form .field input:focus{
        border-color: #fc83bb;
    }

    .form-inner form .field input[readonly]{
        background-color: rgba(255, 255, 255, 0.7);
    }

    form .field input[type="submit"]{
        background: -webkit-linear-gradient(left, #648b45, #223f1f);
        color: #fff;
        font-size: 20px;
        font-weight: 500;
        padding-left: 0;
        border: none;
        cursor: pointer;
    }

    .form-inner form .pass-link{
        margin-top: 5px;
        text-align: center;
    }

    .form-inner form .pass-link a{
        color: #fff;
        text-decoration: none;
    }

    .form-inner form .pass-link a:hover{
        text-decoration: underline;
    }

    .subtitle {
        color: #fff;
        text-align: center;
        font-size: 14px;
        margin-bottom: 20px;
        opacity: 0.9;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
<div class="wrapper">
    <div class="title-text">
        <div class="title">Reset Password</div>
    </div>
    <div class="form-container">
        <div class="form-inner">
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

            <p class="subtitle">Enter your new password below.</p>

            <form action="{{ route('super-admin.password.update') }}" method="POST" class="login">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="field">
                    <input type="email" name="email" value="{{ $email }}" readonly>
                </div>

                <div class="field">
                    <input type="password" name="password" placeholder="New Password" required minlength="8" autofocus>
                </div>

                <div class="field">
                    <input type="password" name="password_confirmation" placeholder="Confirm New Password" required minlength="8">
                </div>

                <div class="field">
                    <input type="submit" value="Reset Password">
                </div>

                <div class="pass-link">
                    <a href="{{ route('super-admin.login') }}">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

