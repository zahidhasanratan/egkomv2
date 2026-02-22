@extends('frontend.app')
@section('title','Notifications - EZBOOKING')
@section('main')

@include('frontend.guest.dashboard-styles')
@include('frontend.guest.dashboard-header')

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        @include('frontend.guest.dashboard-sidebar')
        
        <div class="dashboard-content">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Notifications</h1>
        <p class="dashboard-subtitle">Stay updated with your booking activities</p>
    </div>
    
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fa fa-bell"></i>
        </div>
        <h4 class="empty-state-title">No notifications</h4>
        <p class="empty-state-text">You're all caught up! New notifications will appear here</p>
    </div>
    </div>
</div>

@endsection

