@extends('auth.layout.vendor_admin_layout')
@section('title', 'Edit Co-Host - ' . $hotel->description)
@section('mainbody')

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Co-Host</h3>
                            <div class="nk-block-des text-soft">
                                <p>Update co-host information for {{ $hotel->description }}</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('vendor.co-hosts.index', $hotel->id) }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form action="{{ route('vendor.co-hosts.update', [$hotel->id, $coHost->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Full Name <span class="text-danger">*</span></label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" value="{{ old('name', $coHost->name) }}" required>
                                                @error('name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                            <div class="form-control-wrap">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" name="email" value="{{ old('email', $coHost->email) }}" required>
                                                @error('email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone">Phone Number</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                                       id="phone" name="phone" value="{{ old('phone', $coHost->phone) }}">
                                                @error('phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="password">Password (leave blank to keep current)</label>
                                            <div class="form-control-wrap">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                       id="password" name="password">
                                                @error('password')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="language">Language</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control @error('language') is-invalid @enderror" 
                                                       id="language" name="language" value="{{ old('language', $coHost->language) }}">
                                                @error('language')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="photo">Profile Photo</label>
                                            <div class="form-control-wrap">
                                                <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                                       id="photo" name="photo" accept="image/*">
                                                @error('photo')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                                @if($coHost->photo)
                                                    <div style="margin-top: 10px;">
                                                        <small class="text-muted d-block">Current photo:</small>
                                                        <img src="{{ asset($coHost->photo) }}" alt="{{ $coHost->name }}" 
                                                             style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-top: 5px; border: 2px solid #e0e0e0;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="response_rate">Response Rate (%)</label>
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control @error('response_rate') is-invalid @enderror" 
                                                       id="response_rate" name="response_rate" value="{{ old('response_rate', $coHost->response_rate) }}" 
                                                       min="0" max="100">
                                                @error('response_rate')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="response_time">Response Time</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control @error('response_time') is-invalid @enderror" 
                                                        id="response_time" name="response_time">
                                                    <option value="within an hour" {{ old('response_time', $coHost->response_time) == 'within an hour' ? 'selected' : '' }}>Within an hour</option>
                                                    <option value="within a few hours" {{ old('response_time', $coHost->response_time) == 'within a few hours' ? 'selected' : '' }}>Within a few hours</option>
                                                    <option value="within a day" {{ old('response_time', $coHost->response_time) == 'within a day' ? 'selected' : '' }}>Within a day</option>
                                                </select>
                                                @error('response_time')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="bio">Bio / About</label>
                                            <div class="form-control-wrap">
                                                <textarea class="form-control @error('bio') is-invalid @enderror" 
                                                          id="bio" name="bio" rows="4">{{ old('bio', $coHost->bio) }}</textarea>
                                                @error('bio')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $coHost->is_active) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_active">Active</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Update Co-Host</button>
                                            <a href="{{ route('vendor.co-hosts.index', $hotel->id) }}" class="btn btn-lg btn-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

