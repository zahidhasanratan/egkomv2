@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Add Tour Package</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.tour-packages.index') }}" class="btn btn-outline-light">
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

                        <form action="{{ route('super-admin.tour-packages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row gy-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                       placeholder="e.g. Best Western Heritage"
                                                       value="{{ old('title') }}" required>
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="short_description">Short Description</label>
                                                <textarea class="form-control" id="short_description" name="short_description" rows="2"
                                                          placeholder="Brief description for card">{{ old('short_description') }}</textarea>
                                                @error('short_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="description">Full Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="5"
                                                          placeholder="Full content for details page">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="image">Image</label>
                                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                <small class="form-text text-muted">Max 5MB. JPG, PNG, GIF</small>
                                                @error('image')
                                                    <span class="text-danger d-block">{{ $message }}</span>
                                                @enderror
                                                <div id="image-preview" class="mt-2" style="display: none;">
                                                    <img id="preview-img" src="" alt="Preview" style="max-width: 200px; max-height: 150px; object-fit: contain; border-radius: 8px;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="rating">Rating (0–5)</label>
                                                <input type="number" step="0.1" min="0" max="5" class="form-control" id="rating" name="rating"
                                                       value="{{ old('rating', '5') }}">
                                                @error('rating')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="review_count">Review Count</label>
                                                <input type="number" min="0" class="form-control" id="review_count" name="review_count"
                                                       value="{{ old('review_count', '0') }}">
                                                @error('review_count')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="sort_order">Sort Order</label>
                                                <input type="number" min="0" class="form-control" id="sort_order" name="sort_order"
                                                       value="{{ old('sort_order', '0') }}">
                                                @error('sort_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Active</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="is_active">Show on home page</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <em class="icon ni ni-save"></em> Save Tour Package
                                    </button>
                                    <a href="{{ route('super-admin.tour-packages.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            var file = e.target.files[0];
            var preview = document.getElementById('image-preview');
            var img = document.getElementById('preview-img');
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>

@endsection
