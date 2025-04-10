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

// Super Admin Login Routes
Route::prefix('super-admin')->group(function () {
    Route::get('login', [SuperAdminLoginController::class, 'showLoginForm'])->name('super-admin.login');
    Route::post('login', [SuperAdminLoginController::class, 'login'])->name('super-admin.login.submit');


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
