@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Popular Destination</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.popular-destinations.index') }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="nk-block">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('super-admin.popular-destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row gy-4">
                                        <!-- Destination Name -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Destination Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" name="name" 
                                                       placeholder="Enter destination name" 
                                                       value="{{ old('name', $destination->name) }}" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Media Type Selection -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Media Type</label>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-radio-card" id="media-type-image-card">
                                                            <input class="custom-control-input" type="radio" name="media_type" 
                                                                   id="media_type_image" value="image" 
                                                                   {{ (old('media_type', $destination->feature_photo ? 'image' : ($destination->feature_video ? 'video' : 'image'))) === 'image' ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="media_type_image">
                                                                <div class="card border-2" style="padding: 15px; text-align: center; cursor: pointer; transition: all 0.3s;">
                                                                    <div class="card-body">
                                                                        <em class="icon ni ni-image" style="font-size: 32px; color: #91278f; margin-bottom: 10px;"></em>
                                                                        <h6 class="mb-0">Upload Image</h6>
                                                                        <small class="text-muted">JPG, PNG, GIF (Max 5MB)</small>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-radio-card" id="media-type-video-card">
                                                            <input class="custom-control-input" type="radio" name="media_type" 
                                                                   id="media_type_video" value="video"
                                                                   {{ (old('media_type', $destination->feature_video ? 'video' : 'image')) === 'video' ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="media_type_video">
                                                                <div class="card border-2" style="padding: 15px; text-align: center; cursor: pointer; transition: all 0.3s;">
                                                                    <div class="card-body">
                                                                        <em class="icon ni ni-play" style="font-size: 32px; color: #91278f; margin-bottom: 10px;"></em>
                                                                        <h6 class="mb-0">YouTube Video</h6>
                                                                        <small class="text-muted">Paste YouTube URL</small>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Image Upload Section -->
                                        <div class="col-md-12" id="image-section">
                                            <div class="form-group">
                                                <label class="form-label" for="image">Upload Image</label>
                                                
                                                <!-- Current Image -->
                                                @if($destination->feature_photo)
                                                    <div class="mb-3 border rounded p-3" style="background: #f8f9fa;">
                                                        <label class="form-label d-block mb-2">
                                                            <strong>Current Image:</strong>
                                                        </label>
                                                        <div class="mb-2">
                                                            <img src="{{ asset($destination->feature_photo) }}" 
                                                                 alt="{{ $destination->name }}" 
                                                                 style="max-width: 100%; max-height: 300px; border-radius: 8px; object-fit: contain; border: 1px solid #dee2e6;">
                                                        </div>
                                                        <small class="text-muted d-block">
                                                            <em class="icon ni ni-info"></em> Upload a new image to replace the current one
                                                        </small>
                                                    </div>
                                                @endif
                                                
                                                <div class="custom-file-upload">
                                                    <input type="file" class="form-control" id="image" name="image" 
                                                           accept="image/*">
                                                </div>
                                                <small class="form-text text-muted d-block mt-2">
                                                    <em class="icon ni ni-info"></em> Max file size: 5MB. Allowed types: JPG, JPEG, PNG, GIF
                                                </small>
                                                @error('image')
                                                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                                                @enderror
                                                
                                                <!-- New Image Preview -->
                                                <div id="image-preview" class="mt-3" style="display: none;">
                                                    <div class="border rounded p-3" style="background: #f8f9fa;">
                                                        <label class="form-label mb-2"><strong>New Image Preview:</strong></label>
                                                        <img id="preview-img" src="" alt="Preview" 
                                                             style="max-width: 100%; max-height: 300px; border-radius: 8px; object-fit: contain;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Video URL Section -->
                                        <div class="col-md-12" id="video-section">
                                            <div class="form-group">
                                                <label class="form-label" for="video_url">YouTube Video URL</label>
                                                
                                                @if($destination->feature_video)
                                                    <div class="mb-3 border rounded p-3" style="background: #f8f9fa;">
                                                        <label class="form-label d-block mb-2">
                                                            <strong>Current Video:</strong>
                                                        </label>
                                                        <div class="mb-2">
                                                            <a href="{{ $destination->feature_video }}" target="_blank" class="btn btn-sm btn-primary">
                                                                <em class="icon ni ni-external"></em> View Current Video
                                                            </a>
                                                        </div>
                                                        <small class="text-muted d-block">
                                                            <em class="icon ni ni-info"></em> Enter a new YouTube URL to replace the current one
                                                        </small>
                                                    </div>
                                                @endif
                                                
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <em class="icon ni ni-global"></em>
                                                    </span>
                                                    <input type="url" class="form-control" id="video_url" name="video_url" 
                                                           placeholder="https://www.youtube.com/watch?v=... or https://youtu.be/..."
                                                           value="{{ old('video_url', $destination->feature_video) }}"
                                                           data-old-value="{{ $destination->feature_video ?? '' }}">
                                                </div>
                                                <small class="form-text text-muted d-block mt-2">
                                                    <em class="icon ni ni-info"></em> Paste the full YouTube video URL (watch link or short link)
                                                </small>
                                                @error('video_url')
                                                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                                                @enderror
                                                
                                                <!-- Video Preview/Info -->
                                                <div id="video-preview" class="mt-3" style="display: none;">
                                                    <div class="alert alert-success">
                                                        <em class="icon ni ni-check-circle"></em> Valid YouTube URL detected
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Hidden field to track media type for form submission -->
                                        <input type="hidden" name="media_type_selected" id="media_type_selected" value="{{ old('media_type', $destination->media_type ?? 'image') }}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <em class="icon ni ni-save"></em> Update Destination
                                    </button>
                                    <a href="{{ route('super-admin.popular-destinations.index') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-control-input:checked ~ .custom-control-label .card {
            border-color: #91278f !important;
            background-color: #f8f4ff;
            box-shadow: 0 0 0 0.2rem rgba(145, 39, 143, 0.25);
        }
        .custom-control-label .card:hover {
            border-color: #91278f;
            transform: translateY(-2px);
        }
        .custom-control-input {
            position: absolute;
            opacity: 0;
        }
    </style>
    
    <script>
        // Media type toggle functionality
        const imageRadio = document.getElementById('media_type_image');
        const videoRadio = document.getElementById('media_type_video');
        const imageSection = document.getElementById('image-section');
        const videoSection = document.getElementById('video-section');
        const imageInput = document.getElementById('image');
        const videoInput = document.getElementById('video_url');

        // Handle radio button changes
        function toggleMediaSections() {
            if (imageRadio.checked) {
                imageSection.style.display = 'block';
                videoSection.style.display = 'none';
                // Clear video URL input when switching to image
                videoInput.value = '';
                document.getElementById('video-preview').style.display = 'none';
            } else if (videoRadio.checked) {
                imageSection.style.display = 'none';
                videoSection.style.display = 'block';
                // Restore old video URL if exists, otherwise clear
                const oldValue = videoInput.getAttribute('data-old-value');
                if (!videoInput.value && oldValue) {
                    videoInput.value = oldValue;
                }
                imageInput.value = ''; // Clear image when switching to video
                document.getElementById('image-preview').style.display = 'none';
            }
        }

        imageRadio.addEventListener('change', function() {
            toggleMediaSections();
            // Clear video URL when image is selected
            videoInput.value = '';
            document.getElementById('media_type_selected').value = 'image';
        });
        
        videoRadio.addEventListener('change', function() {
            toggleMediaSections();
            // Restore video URL if it existed
            const oldValue = videoInput.getAttribute('data-old-value');
            if (!videoInput.value && oldValue) {
                videoInput.value = oldValue;
            }
            document.getElementById('media_type_selected').value = 'video';
        });

        // Initialize based on current destination
        @if($destination->feature_video)
            videoRadio.checked = true;
        @else
            imageRadio.checked = true;
        @endif
        toggleMediaSections();

        // Image preview functionality
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('image-preview').style.display = 'none';
            }
        });

        // Video URL validation
        videoInput.addEventListener('input', function(e) {
            const url = e.target.value.trim();
            const youtubeRegex = /^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w-]+/;
            
            if (url && youtubeRegex.test(url)) {
                document.getElementById('video-preview').style.display = 'block';
            } else if (url) {
                document.getElementById('video-preview').style.display = 'none';
            } else {
                document.getElementById('video-preview').style.display = 'none';
            }
        });

        // Initialize video preview if URL exists
        @if($destination->feature_video)
            const existingUrl = '{{ $destination->feature_video }}';
            const youtubeRegex = /^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w-]+/;
            if (youtubeRegex.test(existingUrl)) {
                document.getElementById('video-preview').style.display = 'block';
            }
        @endif
    </script>

@endsection

