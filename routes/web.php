<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('welcome');
Route::get('/login-selection', function() {
    return view('frontend.login-selection');
})->name('login.selection');
Route::get('/hotel-details/{id}', [App\Http\Controllers\HomeController::class, 'hotelDetails'])->name('hotel.details');
Route::get('/search', [App\Http\Controllers\Frontend\SearchController::class, 'search'])->name('search');
Route::get('/destinations', [App\Http\Controllers\Frontend\DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [App\Http\Controllers\Frontend\DestinationController::class, 'show'])->name('destination.show');
Route::get('/booking/checkout', [App\Http\Controllers\Frontend\BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('/booking/rooms-data', [App\Http\Controllers\Frontend\BookingController::class, 'getRoomsData'])->name('booking.rooms-data');
Route::post('/booking/validate-availability', [App\Http\Controllers\Frontend\BookingController::class, 'validateRoomAvailability'])->name('booking.validate-availability');
Route::post('/booking/store', [App\Http\Controllers\Frontend\BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/invoice/{id}', [App\Http\Controllers\Frontend\BookingController::class, 'invoice'])->name('booking.invoice');

// Co-Host Authentication Routes
Route::prefix('co-host')->name('co-host.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Frontend\CoHostAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Frontend\CoHostAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [App\Http\Controllers\Frontend\CoHostAuthController::class, 'logout'])->name('logout');
    
    Route::middleware('auth:cohost')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Frontend\CoHostAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/bookings', [App\Http\Controllers\Frontend\CoHostAuthController::class, 'bookings'])->name('bookings');
        Route::get('/bookings/{id}', [App\Http\Controllers\Frontend\CoHostAuthController::class, 'bookingShow'])->name('bookings.show');
        Route::put('/bookings/{id}/status', [App\Http\Controllers\Frontend\CoHostAuthController::class, 'updateBookingStatus'])->name('bookings.updateStatus');
    });
});

// Wishlist routes (public API routes)
Route::post('/wishlist/toggle', [App\Http\Controllers\Frontend\WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::get('/wishlist/check', [App\Http\Controllers\Frontend\WishlistController::class, 'check'])->name('wishlist.check');

// Hotel Wishlist routes (public API routes)
Route::post('/hotel-wishlist/toggle', [App\Http\Controllers\Frontend\HotelWishlistController::class, 'toggle'])->name('hotel.wishlist.toggle');
Route::get('/hotel-wishlist/check', [App\Http\Controllers\Frontend\HotelWishlistController::class, 'check'])->name('hotel.wishlist.check');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Guest Authentication Routes
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Frontend\GuestAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Frontend\GuestAuthController::class, 'login'])->name('login.submit');
    Route::get('/signup', [App\Http\Controllers\Frontend\GuestAuthController::class, 'showSignupForm'])->name('signup');
    Route::post('/signup', [App\Http\Controllers\Frontend\GuestAuthController::class, 'signup'])->name('signup.submit');
    Route::post('/logout', [App\Http\Controllers\Frontend\GuestAuthController::class, 'logout'])->name('logout');
    
    // Password reset routes
    Route::get('/password/forgot', [App\Http\Controllers\Frontend\GuestAuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/email', [App\Http\Controllers\Frontend\GuestAuthController::class, 'sendPasswordResetEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Frontend\GuestAuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Frontend\GuestAuthController::class, 'resetPassword'])->name('password.update');
    
    // Protected routes (require authentication)
    Route::middleware('auth:guest')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Frontend\GuestAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/bookings', [App\Http\Controllers\Frontend\GuestAuthController::class, 'bookings'])->name('bookings');
        Route::get('/wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index'])->name('wishlist');
        Route::get('/hotel-wishlist', [App\Http\Controllers\Frontend\HotelWishlistController::class, 'index'])->name('hotel.wishlist');
        Route::get('/payment-history', [App\Http\Controllers\Frontend\GuestAuthController::class, 'paymentHistory'])->name('payment-history');
        Route::get('/reviews', [App\Http\Controllers\Frontend\GuestAuthController::class, 'reviews'])->name('reviews');
        Route::get('/notifications', [App\Http\Controllers\Frontend\GuestAuthController::class, 'notifications'])->name('notifications');
        Route::get('/profile', [App\Http\Controllers\Frontend\GuestAuthController::class, 'showProfile'])->name('profile');
        Route::put('/profile', [App\Http\Controllers\Frontend\GuestAuthController::class, 'updateProfile'])->name('profile.update');
        Route::get('/settings', [App\Http\Controllers\Frontend\GuestAuthController::class, 'showSettings'])->name('settings');
        Route::put('/settings/password', [App\Http\Controllers\Frontend\GuestAuthController::class, 'updatePassword'])->name('settings.password.update');
    });
});




