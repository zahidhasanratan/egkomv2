<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed / Cancelled - EGKOM</title>
    <style>
        :root { --brand: #90278e; --text-primary: #1a1a1a; --text-secondary: #666; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            font-size: 15px;
            line-height: 1.5;
            color: var(--text-primary);
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            max-width: 480px;
            width: 100%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
        }
        .icon { font-size: 64px; margin-bottom: 20px; color: #c0392b; }
        h1 { font-size: 22px; color: var(--brand); margin-bottom: 12px; }
        p { color: var(--text-secondary); margin-bottom: 24px; }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: var(--brand);
            color: #fff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn:hover { background: #6d1c6a; color: #fff; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">&#10060;</div>
        <h1>Payment Failed or Cancelled</h1>
        <p>{{ $message }}</p>
        <a href="{{ route('booking.checkout') }}" class="btn">Back to Checkout</a>
    </div>
</body>
</html>
