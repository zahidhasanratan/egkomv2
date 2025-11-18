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
Route::get('/hotel-details/{id}', [App\Http\Controllers\HomeController::class, 'hotelDetails'])->name('hotel.details');


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
        Route::get('/profile', [App\Http\Controllers\Frontend\GuestAuthController::class, 'showProfile'])->name('profile');
        Route::put('/profile', [App\Http\Controllers\Frontend\GuestAuthController::class, 'updateProfile'])->name('profile.update');
        Route::get('/settings', [App\Http\Controllers\Frontend\GuestAuthController::class, 'showSettings'])->name('settings');
        Route::put('/settings/password', [App\Http\Controllers\Frontend\GuestAuthController::class, 'updatePassword'])->name('settings.password.update');
    });
});




