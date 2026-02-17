@extends('auth.layout.super_admin_layout')

@section('mainbody')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Tour Package: {{ $tour_package->title }}</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('super-admin.tour-packages.index') }}" class="btn btn-outline-light me-2">
                                    <em class="icon ni ni-arrow-left"></em> Back
                                </a>
                                <a href="{{ route('super-admin.tour-packages.edit', $tour_package) }}" class="btn btn-primary">
                                    <em class="icon ni ni-edit"></em> Edit
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row">
                                    @if($tour_package->image)
                                        <div class="col-md-4 mb-3">
                                            <img src="{{ asset($tour_package->image) }}" alt="{{ $tour_package->title }}" class="img-fluid rounded">
                                        </div>
                                    @endif
                                    <div class="col">
                                        <p><strong>Slug:</strong> {{ $tour_package->slug }}</p>
                                        <p><strong>Rating:</strong> {{ $tour_package->rating }}</p>
                                        <p><strong>Review count:</strong> {{ $tour_package->review_count }}</p>
                                        <p><strong>Sort order:</strong> {{ $tour_package->sort_order }}</p>
                                        <p><strong>Active:</strong> {{ $tour_package->is_active ? 'Yes' : 'No' }}</p>
                                        @if($tour_package->short_description)
                                            <p><strong>Short description:</strong><br>{{ $tour_package->short_description }}</p>
                                        @endif
                                        @if($tour_package->description)
                                            <p><strong>Description:</strong><br>{!! nl2br(e($tour_package->description)) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
