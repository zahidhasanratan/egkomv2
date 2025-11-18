@extends('frontend.app')
@section('title','My Profile - EGKom')
@section('main')

<style>
    .profile-container {
        min-height: 80vh;
        padding: 40px 20px;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }
    
    .profile-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .profile-title {
        color: #6B46C1;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .profile-photo-section {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .profile-photo-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #6B46C1;
        margin-bottom: 15px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    
    .photo-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 48px;
        color: #9ca3af;
    }
    
    .photo-upload-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #6B46C1;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s;
    }
    
    .photo-upload-btn:hover {
        background: #5a3aa3;
    }
    
    .photo-upload-btn input[type="file"] {
        display: none;
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
        flex: 0 0 120px;
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
</style>

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <h1 class="profile-title">My Profile</h1>
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
        
        <form method="POST" action="{{ route('guest.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="profile-photo-section">
                @if(auth()->guard('guest')->user()->photo)
                    <img src="{{ asset(auth()->guard('guest')->user()->photo) }}" alt="Profile Photo" class="profile-photo-preview" id="photoPreview">
                @else
                    <div class="photo-placeholder" id="photoPlaceholder">
                        <i class="fa fa-user"></i>
                    </div>
                @endif
                <label class="photo-upload-btn">
                    <input type="file" name="photo" id="photoInput" accept="image/*" onchange="previewPhoto(this)">
                    Change Photo
                </label>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control @error('name') error @enderror" 
                    placeholder="Enter your full name"
                    value="{{ old('name', auth()->guard('guest')->user()->name) }}"
                    required
                >
                @error('name')
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
                    placeholder="Enter your email"
                    value="{{ old('email', auth()->guard('guest')->user()->email) }}"
                    required
                >
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="mobile">Phone Number</label>
                <div class="phone-input-group">
                    <select name="country_code" id="country_code" class="country-code-select">
                        <option value="+880" {{ old('country_code', auth()->guard('guest')->user()->country_code) == '+880' ? 'selected' : '' }}>+880</option>
                        <option value="+1" {{ old('country_code', auth()->guard('guest')->user()->country_code) == '+1' ? 'selected' : '' }}>+1</option>
                        <option value="+44" {{ old('country_code', auth()->guard('guest')->user()->country_code) == '+44' ? 'selected' : '' }}>+44</option>
                        <option value="+91" {{ old('country_code', auth()->guard('guest')->user()->country_code) == '+91' ? 'selected' : '' }}>+91</option>
                    </select>
                    <input 
                        type="text" 
                        id="mobile" 
                        name="mobile" 
                        class="phone-input @error('mobile') error @enderror" 
                        placeholder="Enter your phone number"
                        value="{{ old('mobile', auth()->guard('guest')->user()->mobile) }}"
                        required
                    >
                </div>
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
                    placeholder="Enter your address"
                    rows="3"
                >{{ old('address', auth()->guard('guest')->user()->address) }}</textarea>
                @error('address')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="update-btn">UPDATE PROFILE</button>
        </form>
    </div>
</div>

<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const placeholder = document.getElementById('photoPlaceholder');
            let preview = document.getElementById('photoPreview');
            
            if (placeholder) {
                placeholder.style.display = 'none';
            }
            
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'photoPreview';
                preview.className = 'profile-photo-preview';
                input.parentElement.parentElement.insertBefore(preview, input.parentElement);
            }
            
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection

