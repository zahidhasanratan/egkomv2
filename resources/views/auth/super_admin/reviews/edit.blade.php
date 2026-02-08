@extends('auth.layout.super_admin_layout')

@section('mainbody')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .nk-content-body { padding: 20px; }
    .review-detail-card { border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; margin-bottom: 20px; }
</style>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="container-fluid">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="{{ route('super-admin.reviews.show', $review->id) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Review
                            </a>
                        </div>
                    </div>

                    <div class="review-detail-card">
                        <h4><i class="fas fa-edit"></i> Edit Review (Super Admin Only)</h4>
                        <p class="text-muted">Review by {{ $review->guest->name ?? 'Guest' }} · Hotel: {{ $review->hotel->description ?? 'Hotel #'.$review->hotel_id }}</p>
                        <hr>

                        <form method="POST" action="{{ route('super-admin.reviews.update', $review->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Overall Rating (0-10) <span class="text-danger">*</span></label>
                                <input type="number" name="overall_rating" class="form-control" step="0.1" min="0" max="10" value="{{ old('overall_rating', $review->overall_rating) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $review->title) }}">
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea name="comment" class="form-control" rows="4">{{ old('comment', $review->comment) }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pros</label>
                                        <textarea name="pros" class="form-control" rows="2">{{ old('pros', $review->pros) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cons</label>
                                        <textarea name="cons" class="form-control" rows="2">{{ old('cons', $review->cons) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <h6 class="mt-4">Category Ratings (0-10)</h6>
                            <div class="row">
                                @foreach(['staff_rating' => 'Staff', 'facilities_rating' => 'Facilities', 'cleanliness_rating' => 'Cleanliness', 'location_rating' => 'Location', 'comfort_rating' => 'Comfort', 'value_for_money_rating' => 'Value for Money', 'free_wifi_rating' => 'Free WiFi'] as $field => $label)
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>{{ $label }}</label>
                                        <input type="number" name="{{ $field }}" class="form-control form-control-sm" step="0.1" min="0" max="10" value="{{ old($field, $review->$field) }}" placeholder="0-10">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Review
                            </button>
                            <a href="{{ route('super-admin.reviews.show', $review->id) }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
