@extends('frontend.app')
@section('title','Dashboard - EZBOOKING')
@section('main')

@include('frontend.guest.dashboard-styles')
@include('frontend.guest.dashboard-header')

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        @include('frontend.guest.dashboard-sidebar')
        
        <!-- Main Content -->
        <div class="dashboard-content">
            <div class="dashboard-header">
                <h1 class="dashboard-title">Welcome back, {{ auth()->guard('guest')->user()->name }}!</h1>
                <p class="dashboard-subtitle">Here's an overview of your account</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="dashboard-stats">
                <div class="stat-card primary">
                    <div class="stat-value">0</div>
                    <div class="stat-label">Total Bookings</div>
                </div>
                <div class="stat-card success">
                    <div class="stat-value">0</div>
                    <div class="stat-label">Upcoming Trips</div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-value">0</div>
                    <div class="stat-label">Wishlist Items</div>
                </div>
                <div class="stat-card info">
                    <div class="stat-value">0</div>
                    <div class="stat-label">Total Spent</div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div>
                <h3 style="color: #333; font-size: 20px; margin-bottom: 20px;">Recent Activity</h3>
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fa fa-inbox"></i>
                    </div>
                    <h4 class="empty-state-title">No recent activity</h4>
                    <p class="empty-state-text">Your recent bookings and activities will appear here</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

