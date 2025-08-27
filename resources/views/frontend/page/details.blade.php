@extends('frontend.app')

@section('title')
    @if(isset($page->title))
    {{$page->title}} | DMC Alumni
    @endif
@endsection


@section('main')
    <section class="page-cover" id="cover-about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">About Us 1</h1>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        @if(isset($page->title))
                            <li class="breadcrumb-item">{{$page->title}}</li>
                        @endif

                    </ul>
                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <section class="innerpage-wrapper">
        <div id="about-us">
            <div id="about-content" class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="flex-content">

                                <div class="about-text">
                                    <div class="about-detail">
                                        @if(isset($page->title))
                                            <h2>{{ $page->title }}</h2>
                                        @endif

                                            @if(isset($page->description))
                                                {!! $page->description !!}
                                            @endif
                                    </div><!-- end about-detail -->
                                </div><!-- end about-text -->
                            </div><!-- end flex-content -->
                        </div><!-- end columns -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div><!-- end about-content -->

        </div><!-- end about-us -->
    </section>
@endsection
