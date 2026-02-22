@extends('frontend.hotelMaster')
@section('title', $tourPackage->title . ' - EZBOOKING')
@section('main')
    <!--===== INNERPAGE-WRAPPER (same structure as tour-package-details.html) =====-->
    <section class="innerpage-wrapper">
        <div id="hotel-details" class="innerpage-section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 content-side">
                        <div class="detail-slider">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="feature-slider">
                                        @if($tourPackage->image)
                                            <div><img src="{{ asset($tourPackage->image) }}" class="img-responsive" alt="{{ $tourPackage->title }}"/></div>
                                        @else
                                            <div><img src="https://via.placeholder.com/800x500?text={{ urlencode($tourPackage->title) }}" class="img-responsive" alt="{{ $tourPackage->title }}"/></div>
                                        @endif
                                    </div>
                                    @if($tourPackage->image)
                                    <div class="feature-slider-nav">
                                        <div><img src="{{ asset($tourPackage->image) }}" class="img-responsive" alt="{{ $tourPackage->title }}"/></div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="hotel-feature pt-20">
                                <div class="hotel-price">
                                    <div class="location-left">
                                        @if($tourPackage->short_description)
                                            <p>{{ $tourPackage->short_description }}</p>
                                        @endif
                                        <div class="riview-single">
                                            <div class="s197t1q2 atm_h3_1n1ank9 dir dir-ltr">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: currentcolor;">
                                                    <path fill-rule="evenodd" d="m15.1 1.58-4.13 8.88-9.86 1.27a1 1 0 0 0-.54 1.74l7.3 6.57-1.97 9.85a1 1 0 0 0 1.48 1.06l8.62-5 8.63 5a1 1 0 0 0 1.48-1.06l-1.97-9.85 7.3-6.57a1 1 0 0 0-.55-1.73l-9.86-1.28-4.12-8.88a1 1 0 0 0-1.82 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="r1lutz1s atm_c8_o7aogt atm_c8_l52nlx__oggzyc dir dir-ltr" aria-hidden="true">{{ number_format($tourPackage->rating, 1) }}</div>
                                            <span aria-hidden="true">·</span>
                                            <span class="dir dir-ltr">{{ $tourPackage->review_count }} reviews</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row service-details-body">
                            <div class="col-md-12">
                                <div class="hotel-description">
                                    <h4>About this package</h4>
                                    <div class="inner-block">
                                        @if($tourPackage->description)
                                            <div>{!! nl2br(e($tourPackage->description)) !!}</div>
                                        @else
                                            <div class="text-muted">No description available.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
