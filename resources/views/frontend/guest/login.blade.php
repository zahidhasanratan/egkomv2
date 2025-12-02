@extends('frontend.app')
@section('title','Guest Login - EGKom')
@section('main')

<style>
    .guest-auth-container {
        min-height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
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
    
    .guest-auth-welcome {
        font-size: 20px;
        font-weight: 700;
        color: #000;
        margin-bottom: 30px;
        text-align: center;
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
    
    .phone-input-group {
        display: flex;
        gap: 10px;
    }
    
    .country-code-select {
        flex: 0 0 180px;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        background-color: white;
    }
    
    .phone-input {
        flex: 1;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
    }
    
    .privacy-text {
        font-size: 12px;
        color: #666;
        margin-top: 10px;
        line-height: 1.5;
    }
    
    .privacy-link {
        color: #2563EB;
        text-decoration: none;
    }
    
    .privacy-link:hover {
        text-decoration: underline;
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
    
    .continue-btn:active {
        transform: translateY(0);
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
        <h1 class="guest-auth-title">Log in or sign up</h1>
        <h2 class="guest-auth-welcome">Welcome to Egkom</h2>
        
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
        
        <form method="POST" action="{{ route('guest.login.submit') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control @error('email') error @enderror" 
                    placeholder="Email address"
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') error @enderror" 
                    placeholder="Password"
                    required
                >
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                <label style="display: flex; align-items: center; gap: 8px; font-weight: normal; cursor: pointer;">
                    <input type="checkbox" name="remember" style="cursor: pointer;">
                    <span>Remember me</span>
                </label>
                <a href="{{ route('guest.password.request') }}" style="color: #6B46C1; text-decoration: none; font-size: 14px; font-weight: 500;">Forgot password?</a>
            </div>
            
            <button type="submit" class="continue-btn">CONTINUE</button>
        </form>
        
        <div class="switch-auth">
            Don't have an account? <a href="{{ route('guest.signup') }}">Sign up</a>
        </div>
        
        <div style="text-align: center; margin: 25px 0; position: relative;">
            <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #e0e0e0;"></div>
            <span style="background: white; padding: 0 15px; position: relative; color: #999; font-size: 14px;">Or login as</span>
        </div>
        
        <div style="display: flex; gap: 10px; justify-content: center;">
            <a href="{{ route('vendor-admin.login') }}" style="flex: 1; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; text-align: center; color: #666; text-decoration: none; font-weight: 500; transition: all 0.3s;">
                <i class="fas fa-store"></i> Vendor
            </a>
            <a href="{{ route('co-host.login') }}" style="flex: 1; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; text-align: center; color: #666; text-decoration: none; font-weight: 500; transition: all 0.3s;">
                <i class="fas fa-user-tie"></i> Co-Host
            </a>
        </div>
    </div>
</div>

@endsection

