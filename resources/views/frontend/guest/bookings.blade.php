@extends('frontend.app')
@section('title','My Bookings - EGKom')
@section('main')

@include('frontend.guest.dashboard-styles')

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        @include('frontend.guest.dashboard-sidebar')
        
        <div class="dashboard-content">
    <div class="dashboard-header">
        <h1 class="dashboard-title">My Bookings</h1>
        <p class="dashboard-subtitle">View and manage all your hotel bookings</p>
    </div>
    
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fa fa-calendar-check-o"></i>
        </div>
        <h4 class="empty-state-title">No bookings yet</h4>
        <p class="empty-state-text">When you make a booking, it will appear here</p>
        <a href="{{ route('welcome') }}" style="display: inline-block; margin-top: 20px; padding: 12px 24px; background: linear-gradient(90deg, #9333EA 0%, #6B46C1 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 500;">Browse Hotels</a>
    </div>
    </div>
</div>

@endsection

