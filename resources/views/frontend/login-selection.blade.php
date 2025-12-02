<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EGKom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .selection-container {
            max-width: 900px;
            width: 100%;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .logo i {
            font-size: 48px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .main-title {
            font-size: 36px;
            font-weight: 700;
            color: white;
            margin-bottom: 10px;
        }

        .main-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
        }

        .login-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            display: block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .login-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .login-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            transition: all 0.3s;
        }

        .login-card:hover .login-icon {
            transform: scale(1.1);
        }

        .guest-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .vendor-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .cohost-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .admin-icon {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .login-title {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .login-description {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="selection-container">
        <div class="logo-section">
            <div class="logo">
                <i class="fas fa-hotel"></i>
            </div>
            <h1 class="main-title">Welcome to EGKom</h1>
            <p class="main-subtitle">Select your role to continue</p>
        </div>

        <div class="login-cards">
            <a href="{{ route('guest.login') }}" class="login-card">
                <div class="login-icon guest-icon">
                    <i class="fas fa-user"></i>
                </div>
                <h3 class="login-title">Guest</h3>
                <p class="login-description">Book hotels and manage your reservations</p>
            </a>

            <a href="{{ route('vendor-admin.login') }}" class="login-card">
                <div class="login-icon vendor-icon">
                    <i class="fas fa-store"></i>
                </div>
                <h3 class="login-title">Vendor</h3>
                <p class="login-description">Manage your hotels and properties</p>
            </a>

            <a href="{{ route('co-host.login') }}" class="login-card">
                <div class="login-icon cohost-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="login-title">Co-Host</h3>
                <p class="login-description">Manage assigned hotel properties</p>
            </a>

            <a href="{{ route('login') }}" class="login-card">
                <div class="login-icon admin-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <h3 class="login-title">Admin</h3>
                <p class="login-description">Super Admin & CMS access</p>
            </a>
        </div>
    </div>
</body>
</html>

