@extends('frontend.app')
@section('title','My Reviews - EGKom')
@section('main')

@include('frontend.guest.dashboard-styles')

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        @include('frontend.guest.dashboard-sidebar')
        
        <div class="dashboard-content">
    <div class="dashboard-header">
        <h1 class="dashboard-title">My Reviews</h1>
        <p class="dashboard-subtitle">Reviews you've written for hotels</p>
    </div>
    
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fa fa-star"></i>
        </div>
        <h4 class="empty-state-title">No reviews yet</h4>
        <p class="empty-state-text">Share your experience by writing reviews for hotels you've stayed at</p>
    </div>
    </div>
</div>

@endsection

