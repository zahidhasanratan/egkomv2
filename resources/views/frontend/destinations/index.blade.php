@extends('frontend.app')
@section('title', 'All Destinations - EGKom')
@section('main')

<section class="section-padding" style="background-color: #F5F7FA;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading-2" style="margin-bottom: 40px; text-align: center;">
                    <h2>All Popular Destinations</h2>
                    <p>Explore our handpicked collection of the most popular destinations with amazing hotels and accommodations waiting for you.</p>
                </div>
                
                <div class="row">
                    @forelse($destinations as $destination)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card" style="border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s;">
                                <a href="{{ route('destination.show', $destination->slug) }}" style="text-decoration: none; color: inherit;">
                                    @if($destination->media_type == 'video' && $destination->feature_video)
                                        @php
                                            $videoUrl = $destination->feature_video;
                                            $videoId = '';
                                            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/', $videoUrl, $matches)) {
                                                $videoId = $matches[1];
                                            }
                                        @endphp
                                        @if($videoId)
                                            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" 
                                                        frameborder="0" 
                                                        allow="autoplay; encrypted-media" 
                                                        allowfullscreen
                                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                            </div>
                                        @else
                                            <img src="{{ asset('frontend/images/destination-1.jpg') }}" alt="{{ $destination->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                                        @endif
                                    @elseif($destination->feature_photo)
                                        <img src="{{ asset($destination->feature_photo) }}" alt="{{ $destination->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('frontend/images/destination-1.jpg') }}" alt="{{ $destination->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body" style="padding: 15px;">
                                        <h5 class="card-title" style="margin-bottom: 5px; color: #333;">{{ $destination->name }}</h5>
                                        <p class="card-text" style="color: #666; font-size: 14px; margin: 0;">
                                            {{ $destination->hotels_count }} {{ $destination->hotels_count == 1 ? 'Hotel' : 'Hotels' }} Available
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p>No destinations available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

