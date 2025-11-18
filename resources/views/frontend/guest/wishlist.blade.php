@extends('frontend.app')
@section('title','My Wishlist - EGKom')
@section('main')

@include('frontend.guest.dashboard-styles')

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        @include('frontend.guest.dashboard-sidebar')
        
        <div class="dashboard-content">
    <div class="dashboard-header">
        <h1 class="dashboard-title">My Wishlist</h1>
        <p class="dashboard-subtitle">Hotels you've saved for later</p>
    </div>
    
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fa fa-heart"></i>
        </div>
        <h4 class="empty-state-title">Your wishlist is empty</h4>
        <p class="empty-state-text">Start saving hotels you love to your wishlist</p>
        <a href="{{ route('welcome') }}" style="display: inline-block; margin-top: 20px; padding: 12px 24px; background: linear-gradient(90deg, #9333EA 0%, #6B46C1 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 500;">Explore Hotels</a>
    </div>
    </div>
</div>

@endsection

