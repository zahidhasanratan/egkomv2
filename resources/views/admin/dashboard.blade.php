@extends('layouts.app')

@section('title','Dashboard')

@push('css')
<style>
    .text-muted a{
       color : #4a4007
    }
</style>
@endpush

@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Admin Dashboard</h2>


                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-bars"></i>
                </span>
                    <div class="text-box" >
                        <p class="main-text">Menu</p>
                        <p class="text-muted"><a style="text-decoration:none;" href="{{ route('menu.index') }}">All Menu</a></p>
                    </div>
                </div>
            </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-bars"></i>
                </span>
                        <div class="text-box" >
                            <p class="main-text">Page</p>
                            <p class="text-muted"><a style="text-decoration:none;" href="{{ route('page.index') }}">All Page</a></p>
                        </div>
                    </div>
                </div>




            </div>


            <hr />



            <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
    </div>
@endsection

@push('scripts')

@endpush
