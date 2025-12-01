<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\SuperAdminLoginController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\BigAdvertiseController;
use App\Http\Controllers\admin\SmallAdvertiseController;
use App\Http\Controllers\Superadmin\SettingsController;
use App\Http\Controllers\Vendor\ManageHotel;
use App\Http\Controllers\Vendor\ManageRoomController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\OwnerController;
use App\Http\Controllers\Vendor\BankingController;

// Super Admin Login Routes
Route::prefix('super-admin')->group(function () {
    Route::get('login', [SuperAdminLoginController::class, 'showLoginForm'])->name('super-admin.login');
    Route::post('login', [SuperAdminLoginController::class, 'login'])->name('super-admin.login.submit');
    
    // Password reset routes
    Route::get('password/forgot', [SuperAdminLoginController::class, 'showForgotPasswordForm'])->name('super-admin.password.request');
    Route::post('password/email', [SuperAdminLoginController::class, 'sendPasswordResetEmail'])->name('super-admin.password.email');
    Route::get('password/reset/{token}', [SuperAdminLoginController::class, 'showResetPasswordForm'])->name('super-admin.password.reset');
    Route::post('password/reset', [SuperAdminLoginController::class, 'resetPassword'])->name('super-admin.password.update');


    Route::middleware('auth:super-admin')->group(function () {
        Route::post('/update-smtp-settings', [SettingsController::class, 'updateSmtpSettings'])->name('super-admin.update.smtp');

        Route::get('account-settings', [DashboardController::class, 'accountSettings'])->name('super-admin.accountSettings');
        Route::post('super-admin/update-settings', [DashboardController::class, 'updateSettings'])->name('super-admin.update.settings');

        Route::get('account-email', [DashboardController::class, 'accountEmail'])->name('super-admin.accountEmail');
        Route::get('account-security', [DashboardController::class, 'accountSecurity'])->name('super-admin.accountSecurity');
        Route::get('activity-log', [DashboardController::class, 'activityLog'])->name('super-admin.activityLog');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('super-admin.dashboard');
        Route::post('update-password', [SuperAdminLoginController::class, 'updatePassword'])->name('super-admin.update-password');
        Route::post('logout', [SuperAdminLoginController::class, 'logout'])->name('super-admin.logout');
        Route::get('super-dashboard', [DashboardController::class, 'index'])->name('super-admin.dashboard');
        Route::get('vendor/create', [DashboardController::class, 'vendor_create'])->name('super-admin.vendor.create');
        Route::post('vendor/store', [DashboardController::class, 'vendor_store'])->name('super-admin.vendor.store');
        Route::get('vendor/allList', [DashboardController::class, 'allVendorList'])->name('super-admin.vendor.index');
        Route::get('vendor/{id}/edit', [DashboardController::class, 'vendor_edit'])->name('super-admin.vendor.edit');
        Route::put('vendor/{id}', [DashboardController::class, 'vendor_update'])->name('super-admin.vendor.update');

        Route::get('/vendor-info/{id}', [DashboardController::class, 'vendorInfoCreate'])->name('super.vendor.infoCreate');
        Route::post('/Super-vendor-info', [DashboardController::class, 'vendorInfoStore'])->name('super.info.Store');

        Route::get('/Super-vendor-owner-info', [OwnerController::class, 'createSuper'])->name('super-admin.owner.create');

        Route::get('vendor/details/{id}', [DashboardController::class, 'vendor_index'])->name('super-admin.vendor.details');
        Route::get('/owner-info/{id}', [OwnerController::class, 'createSuper'])->name('super.vendor-admin.owner.details');
        Route::post('/vendor-info', [VendorController::class, 'storeSuper'])->name('super.vendor.info.store');
        Route::post('/owners', [OwnerController::class, 'storeSuper'])->name('super.owners.store');
        Route::post('/owners-banking', [BankingController::class, 'storeSuper'])->name('super.bankings.store');
        Route::get('/owners-bankInfo/{id}', [OwnerController::class, 'bankInfoSuper'])->name('super.owners.bankInfo');

//        ManageHotel
        Route::get('/super-admin/hotel', [ManageHotel::class, 'indexSuper'])->name('super-admin.hotel.index');
        Route::get('/hotel/{hotel}/edit', [ManageHotel::class, 'editSuper'])->name('super-admin.hotel.edit');
        Route::put('/hotel/{hotel}', [ManageHotel::class, 'updateSuper'])->name('super-admin.hotel.update');
        Route::post('/admin/hotel/{hotel}/toggle-approve', [ManageHotel::class, 'toggleApprove']);


//      Mange Room

        Route::get('/super-admin/room/{id}', [ManageRoomController::class, 'indexSuper'])->name('super-admin.room.index');
        Route::get('/room/{room}/edit', [ManageRoomController::class, 'editSuper'])->name('super-admin.room.edit');
        Route::put('/room/{room}', [ManageRoomController::class, 'updateSuper'])->name('super-admin.room.update');
        Route::post('super-admin/room/delete-photo', [ManageRoomController::class, 'deletePhoto'])->name('super-admin.room.delete-photo');
        /*Admin Panel Started */

        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('menu', MenuController::class);
        Route::resource('page', PageController::class);
        Route::resource('bigadvertise', BigAdvertiseController::class);
        Route::resource('smalladvertise', SmallAdvertiseController::class);

        Route::get('/pagedetails/{slug}', [PageController::class, 'details'])->name('page.details');
        Route::get('/ajaxsearch', [MenuController::class, 'searchajax'])->name('menu.ajaxsearch');


    });
    /*Admin Panel Ended */

});
