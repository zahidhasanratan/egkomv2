<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\SuperAdminLoginController;
use App\Http\Controllers\Vendor\VendorAdminLoginController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\OwnerController;
use App\Http\Controllers\Vendor\BankingController;
use App\Http\Controllers\Vendor\ManageHotel;
use App\Http\Controllers\Vendor\ManageRoomController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\BigAdvertiseController;
use App\Http\Controllers\admin\SmallAdvertiseController;
use App\Http\Controllers\Superadmin\SettingsController;

// Super Admin Login Routes
Route::prefix('vendor-admin')->group(function () {
    Route::get('login', [VendorAdminLoginController::class, 'showLoginForm'])->name('vendor-admin.login');
    Route::post('login', [VendorAdminLoginController::class, 'login'])->name('vendor-admin.login.submit');



    Route::middleware('auth:vendor')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Vendor\DashboardController::class, 'index'])->name('vendor.dashboard');
        Route::get('vendor-dashboard', [\App\Http\Controllers\Vendor\DashboardController::class, 'index'])->name('vendor-admin.dashboard');
        Route::get('account-settings', [\App\Http\Controllers\Vendor\DashboardController::class, 'accountSettings'])->name('vendor-admin.accountSettings');
        Route::get('account-email', [\App\Http\Controllers\Vendor\DashboardController::class, 'accountEmail'])->name('vendor-admin.accountEmail');
        Route::get('activity-log', [\App\Http\Controllers\Vendor\DashboardController::class, 'activityLog'])->name('vendor-admin.activityLog');
        Route::get('account-security', [\App\Http\Controllers\Vendor\DashboardController::class, 'accountSecurity'])->name('vendor-admin.accountSecurity');
        Route::post('update-password', [VendorAdminLoginController::class, 'updatePassword'])->name('vendor-admin.update-password');
        Route::post('vendor-admin/update-settings', [\App\Http\Controllers\Vendor\DashboardController::class, 'updateSettings'])->name('vendor-admin.update.settings');
        Route::get('/vendor-info', [VendorController::class, 'create'])->name('vendor-admin.vendor.create');
        Route::post('/vendor-info', [VendorController::class, 'store'])->name('vendor.info.store');
        Route::post('logout', [VendorAdminLoginController::class, 'logout'])->name('vendor-admin.logout');

//        Route::get('/owner-info', [OwnerController::class, 'create'])->name('vendor-admin.owner.create');
        Route::post('/owners', [OwnerController::class, 'store'])->name('owners.store');

        Route::get('/owner-info', [OwnerController::class, 'create'])->name('vendor-admin.owner.create');
        Route::get('/owners-bankInfo', [OwnerController::class, 'bankInfo'])->name('owners.bankInfo');
        Route::post('/owners-banking', [BankingController::class, 'store'])->name('bankings.store');
        Route::post('/owners-banking', [BankingController::class, 'store'])->name('bankings.store');


        Route::get('/hotel-create', [ManageHotel::class, 'create'])->name('vendor-admin.hotel.create');
        Route::post('/vendor-admin/hotel/store', [ManageHotel::class, 'store'])->name('vendor-admin.hotel.store');
        Route::get('/vendor-admin/hotel', [ManageHotel::class, 'index'])->name('vendor-admin.hotel.index');




        Route::get('/hotel/{hotel}/edit', [ManageHotel::class, 'edit'])->name('vendor-admin.hotel.edit');
        Route::put('/hotel/{hotel}', [ManageHotel::class, 'update'])->name('vendor-admin.hotel.update');
        Route::delete('/hotel/{hotel}', [ManageHotel::class, 'destroy'])->name('vendor-admin.hotel.destroy');


        Route::get('/vendor-admin/room/{id}', [ManageRoomController::class, 'index'])->name('vendor-admin.room.index');
        Route::get('/room-create/{id}', [ManageRoomController::class, 'create'])->name('vendor-admin.room.create');
    });
    Route::post('/vendor-admin/room/store', [ManageRoomController::class, 'store'])->name('vendor-admin.room.store');
    /*Admin Panel Ended */

});
