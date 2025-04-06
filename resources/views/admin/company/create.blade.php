@extends('layouts.app')

@section('title','Add PAST EXECUTIVE COMMITTEE')
@section('content')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add PAST EXECUTIVE COMMITTEE</h2>

                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add PAST EXECUTIVE COMMITTEE
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-md-12">
                                    @include('layouts.partial.msg')

                                    <form role="form" method="post" action="{{ route('company.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input class="form-control" name="title" placeholder="Title" />

                                        </div>
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input class="form-control" name="designation" placeholder="Designation" />

                                        </div>

                                        <!--<div class="form-group">-->
                                        <!--    <select name="type" class="form-control" style="width:60%; margin-bottom:5px">-->
                                        <!--        <option> Select Type</option>-->
                                        <!--        @foreach(\App\PreviousProgram::all() as $main_menu)-->

                                        <!--            <option value="{{$main_menu->id}}">{{$main_menu->title}}</option>-->

                                        <!--        @endforeach-->
                                        <!--    </select>-->

                                        <!--</div>-->

                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image"/>
                                        </div>



                                        <a href="{{ route('company.index') }}" class="btn btn-danger">Back</a>
                                        <button type="submit" class="btn btn-primary">Save</button>

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