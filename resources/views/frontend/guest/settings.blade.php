@extends('frontend.app')
@section('title','Settings - EZBOOKING')
@section('main')

<style>
    .settings-container {
        min-height: 80vh;
        padding: 40px 20px;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }
    
    .settings-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .settings-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .settings-title {
        color: #6B46C1;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .settings-subtitle {
        color: #666;
        font-size: 14px;
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
    
    .update-btn {
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
    
    .update-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 70, 193, 0.3);
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
    
    .error-message {
        color: #DC2626;
        font-size: 14px;
        margin-top: 5px;
    }
    
    .password-strength {
        font-size: 12px;
        margin-top: 5px;
        color: #666;
    }
</style>

<div class="settings-container">
    <div class="settings-card">
        <div class="settings-header">
            <h1 class="settings-title">Change Password</h1>
            <p class="settings-subtitle">Update your login password</p>
        </div>
        
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
        
        <form method="POST" action="{{ route('guest.settings.password.update') }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label" for="current_password">Current Password</label>
                <input 
                    type="password" 
                    id="current_password" 
                    name="current_password" 
                    class="form-control @error('current_password') error @enderror" 
                    placeholder="Enter your current password"
                    required
                >
                @error('current_password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
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
                >
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <div class="password-strength">Password must be at least 6 characters long</div>
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
            
            <button type="submit" class="update-btn">UPDATE PASSWORD</button>
        </form>
    </div>
</div>

@endsection

