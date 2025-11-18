@extends('frontend.app')
@section('title','Guest Signup - EGKom')
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
        cursor: pointer;
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
        
        <form method="POST" action="{{ route('guest.signup.submit') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control @error('name') error @enderror" 
                    placeholder="Full name"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="country_code">Country Code</label>
                <select 
                    id="country_code" 
                    name="country_code" 
                    class="form-control @error('country_code') error @enderror"
                    required
                >
                    <option value="+880" {{ old('country_code', '+880') == '+880' ? 'selected' : '' }}>Bangladesh (+880)</option>
                    <option value="+1" {{ old('country_code') == '+1' ? 'selected' : '' }}>United States (+1)</option>
                    <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>United Kingdom (+44)</option>
                    <option value="+91" {{ old('country_code') == '+91' ? 'selected' : '' }}>India (+91)</option>
                    <option value="+61" {{ old('country_code') == '+61' ? 'selected' : '' }}>Australia (+61)</option>
                    <option value="+33" {{ old('country_code') == '+33' ? 'selected' : '' }}>France (+33)</option>
                    <option value="+86" {{ old('country_code') == '+86' ? 'selected' : '' }}>China (+86)</option>
                    <option value="+81" {{ old('country_code') == '+81' ? 'selected' : '' }}>Japan (+81)</option>
                    <option value="+971" {{ old('country_code') == '+971' ? 'selected' : '' }}>UAE (+971)</option>
                    <option value="+966" {{ old('country_code') == '+966' ? 'selected' : '' }}>Saudi Arabia (+966)</option>
                </select>
                @error('country_code')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="mobile">Phone number</label>
                <input 
                    type="text" 
                    id="mobile" 
                    name="mobile" 
                    class="form-control @error('mobile') error @enderror" 
                    placeholder="Phone number"
                    value="{{ old('mobile') }}"
                    required
                >
                @error('mobile')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="address">Address</label>
                <textarea 
                    id="address" 
                    name="address" 
                    class="form-control @error('address') error @enderror" 
                    placeholder="Your address (optional)"
                    rows="3"
                >{{ old('address') }}</textarea>
                @error('address')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
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
            
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="form-control" 
                    placeholder="Confirm password"
                    required
                >
            </div>
            
            <p class="privacy-text">
                We'll call or text you to confirm your number. Standard message and data rates apply. 
                <a href="#" class="privacy-link">Privacy Policy</a>
            </p>
            
            <button type="submit" class="continue-btn">CONTINUE</button>
        </form>
        
        <div class="switch-auth">
            Already have an account? <a href="{{ route('guest.login') }}">Log in</a>
        </div>
    </div>
</div>

@endsection

