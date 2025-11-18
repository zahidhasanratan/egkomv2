@extends('frontend.app')
@section('title','Reset Password - EGKom')
@section('main')

<style>
    .guest-auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background-color: #f5f5f5;
    }
    
    .guest-auth-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        max-width: 450px;
        width: 100%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .guest-auth-title {
        color: #6B46C1;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
        text-align: center;
    }
    
    .guest-auth-subtitle {
        font-size: 14px;
        color: #666;
        margin-bottom: 30px;
        text-align: center;
        line-height: 1.6;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #333;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #6B46C1;
        box-shadow: 0 0 0 3px rgba(107, 70, 193, 0.1);
    }
    
    .continue-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(90deg, #9333EA 0%, #6B46C1 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        margin-top: 20px;
    }
    
    .continue-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 70, 193, 0.3);
    }
    
    .error-message {
        color: #DC2626;
        font-size: 14px;
        margin-top: 5px;
    }
    
    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background-color: #D1FAE5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }
    
    .alert-error {
        background-color: #FEE2E2;
        color: #991B1B;
        border: 1px solid #FECACA;
    }
    
    .switch-auth {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #666;
    }
    
    .switch-auth a {
        color: #6B46C1;
        text-decoration: none;
        font-weight: 500;
    }
    
    .switch-auth a:hover {
        text-decoration: underline;
    }
</style>

<div class="guest-auth-container">
    <div class="guest-auth-card">
        <h1 class="guest-auth-title">Reset Password</h1>
        <p class="guest-auth-subtitle">Enter your new password below.</p>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('guest.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    value="{{ $email }}"
                    readonly
                    style="background-color: #f5f5f5;"
                >
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password">New Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') error @enderror" 
                    placeholder="Enter new password"
                    required
                    minlength="6"
                    autofocus
                >
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm New Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="form-control" 
                    placeholder="Confirm new password"
                    required
                    minlength="6"
                >
            </div>
            
            <button type="submit" class="continue-btn">RESET PASSWORD</button>
        </form>
        
        <div class="switch-auth">
            Remember your password? <a href="{{ route('guest.login') }}">Log in</a>
        </div>
    </div>
</div>

@endsection

