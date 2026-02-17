@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Homepage Hero</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.dashboard') }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em> Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <em class="icon ni ni-check-circle"></em> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

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

                        <form action="{{ route('super-admin.homepage-hero.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <p class="text-muted mb-4">This video and text appear on the homepage banner. Leave video empty to keep the current video.</p>
                                    <div class="row gy-4">

                                        <!-- Title -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                       placeholder="e.g. Welcome to Eg Kom!"
                                                       value="{{ old('title', $hero->title) }}" required>
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Subtitle -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="subtitle">Subtitle <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="subtitle" name="subtitle"
                                                       placeholder="e.g. Find Hotels, Visa & Holidays"
                                                       value="{{ old('subtitle', $hero->subtitle) }}" required>
                                                @error('subtitle')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Video -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="video">Hero Video</label>
                                                @if($hero->video_path)
                                                    <div class="mb-3 border rounded p-3" style="background: #f8f9fa;">
                                                        <strong>Current video:</strong>
                                                        @if(\Illuminate\Support\Facades\File::exists(public_path($hero->video_path)))
                                                            <span class="text-muted">{{ $hero->video_path }}</span>
                                                            <div class="mt-2">
                                                                <video src="{{ asset($hero->video_path) }}" controls width="320" height="180" style="max-width:100%; border-radius:8px;"></video>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">{{ $hero->video_path }}</span>
                                                        @endif
                                                        <small class="d-block mt-2 text-muted">Upload a new file to replace. Leave empty to keep current.</small>
                                                    </div>
                                                @endif
                                                <input type="file" class="form-control" id="video" name="video"
                                                       accept="video/mp4,video/webm,video/ogg,video/quicktime">
                                                <small class="form-text text-muted d-block mt-2">
                                                    <em class="icon ni ni-info"></em> MP4, WebM, OGG or MOV. Max 100MB.
                                                </small>
                                                @error('video')
                                                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <em class="icon ni ni-save"></em> Update Homepage Hero
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
