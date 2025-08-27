@extends('layouts.app')

@section('title','Edit Big Advertise')
@section('content')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Edit Big Adverrise</h2>

                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Big Advertise
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-md-12">
                                    @include('layouts.partial.msg')

                                    <form role="form" method="post" action="{{ route('bigadvertise.update',$slider->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label>Caption</label>
                                            <input class="form-control" name="title" value="{{ $slider->title }}" placeholder="Caption" />

                                        </div>
                                        <div class="form-group">
                                            <label>Url</label>
                                            <input class="form-control" name="url" value="{{ $slider->url }}" placeholder="Url" />

                                        </div>


                                        <div class="form-group">
                                            <label>Image (Height:745px; X Width:1920px)</label>
                                            <input type="file" name="image"/></br>
                                            <img src="{{ asset('uploads/bigadvertise/'.$slider->image) }}" class="img-thumbnail" width="100" height="100" />
                                        </div>



                                        <a href="{{ route('bigadvertise.index') }}" class="btn btn-danger">Back</a>
                                        <button type="submit" class="btn btn-primary">Submit Button</button>

                                    </form>
                                    <br />




                                </div>
                            </div>
                        </div>
                        <!-- End Form Elements -->
                    </div>
                </div>
                <!-- /. ROW  -->

                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->

@endsection
