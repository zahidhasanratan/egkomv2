@extends('frontend.app')
@section('title','Payment History - EGKom')
@section('main')

@include('frontend.guest.dashboard-styles')

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        @include('frontend.guest.dashboard-sidebar')
        
        <div class="dashboard-content">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Payment History</h1>
        <p class="dashboard-subtitle">View all your payment transactions</p>
    </div>
    
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fa fa-credit-card"></i>
        </div>
        <h4 class="empty-state-title">No payment history</h4>
        <p class="empty-state-text">Your payment transactions will appear here</p>
    </div>
    </div>
</div>

@endsection

