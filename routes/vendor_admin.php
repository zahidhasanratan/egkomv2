<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\SuperAdminLoginController;
use App\Http\Controllers\Vendor\VendorAdminLoginController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\OwnerController;
use App\Http\Controllers\Vendor\BankingController;
use App\Http\Controllers\Vendor\ManageHotel;
use App\Http\Controllers\Vendor\ManageRoomController;
use App\Http\Controllers\Vendor\CoHostController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\BigAdvertiseController;
use App\Http\Controllers\admin\SmallAdvertiseController;
use App\Http\Controllers\Superadmin\SettingsController;

// Vendor Login & Signup Routes
Route::prefix('vendor-admin')->group(function () {
    Route::get('login', [VendorAdminLoginController::class, 'showLoginForm'])->name('vendor-admin.login');
    Route::post('login', [VendorAdminLoginController::class, 'login'])->name('vendor-admin.login.submit');
    Route::post('signup', [VendorAdminLoginController::class, 'signup'])->name('vendor-admin.signup.submit');
    
    // Password reset routes
    Route::get('password/forgot', [VendorAdminLoginController::class, 'showForgotPasswordForm'])->name('vendor-admin.password.request');
    Route::post('password/email', [VendorAdminLoginController::class, 'sendPasswordResetEmail'])->name('vendor-admin.password.email');
    Route::get('password/reset/{token}', [VendorAdminLoginController::class, 'showResetPasswordForm'])->name('vendor-admin.password.reset');
    Route::post('password/reset', [VendorAdminLoginController::class, 'resetPassword'])->name('vendor-admin.password.update');



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
//        Route::post('/owners-banking', [BankingController::class, 'store'])->name('bankings.store');

        // Approved vendors only: owner banking, hotel, room, co-hosts, bookings, reviews
        Route::middleware('vendor.approved')->group(function () {
        Route::get('/owners-bankInfo', [OwnerController::class, 'bankInfo'])->name('owners.bankInfo');
        Route::post('/owners-banking', [BankingController::class, 'store'])->name('bankings.store');
        Route::get('/hotel-create', [ManageHotel::class, 'create'])->name('vendor-admin.hotel.create');
        Route::post('/hotel/store', [ManageHotel::class, 'store'])->name('vendor-admin.hotel.store');
        Route::get('/hotel', [ManageHotel::class, 'index'])->name('vendor-admin.hotel.index');




        Route::get('/hotel/{hotel}/edit', [ManageHotel::class, 'edit'])->name('vendor-admin.hotel.edit');
        Route::get('/hotel/{hotel}/partOne', [ManageHotel::class, 'partOne'])->name('vendor-admin.hotel.editPone');
        Route::get('/hotel/{hotel}/partOneOne', [ManageHotel::class, 'partOneOne'])->name('vendor-admin.hotel.editOneOne');
        Route::get('/hotel/{hotel}/partOne1', [ManageHotel::class, 'partOne1'])->name('vendor-admin.hotel.editOne1');
        Route::get('/hotel/{hotel}/partOne2', [ManageHotel::class, 'partOne2'])->name('vendor-admin.hotel.editOne2');
        Route::get('/hotel/{hotel}/partOne3', [ManageHotel::class, 'partOne3'])->name('vendor-admin.hotel.editOne3');
        Route::get('/hotel/{hotel}/partOne4', [ManageHotel::class, 'partOne4'])->name('vendor-admin.hotel.editOne4');
        Route::get('/hotel/{hotel}/partOne5', [ManageHotel::class, 'partOne5'])->name('vendor-admin.hotel.editOne5');
        Route::get('/hotel/{hotel}/editOne6', [ManageHotel::class, 'partOne6'])->name('vendor-admin.hotel.editOne6');
        Route::get('/hotel/{hotel}/partTwo', [ManageHotel::class, 'partTwo'])->name('vendor-admin.hotel.editPtwo');
        Route::get('/hotel/{hotel}/partTwo1', [ManageHotel::class, 'partTwo1'])->name('vendor-admin.hotel.editPtwo1');
        Route::get('/hotel/{hotel}/partTwo2', [ManageHotel::class, 'partTwo2'])->name('vendor-admin.hotel.editPtwo2');

        Route::get('/hotel/{hotel}/partThree', [ManageHotel::class, 'partThree'])->name('vendor-admin.hotel.editPthree');
        Route::get('/hotel/{hotel}/partFour', [ManageHotel::class, 'partFour'])->name('vendor-admin.hotel.editPfour');
        Route::get('/hotel/{hotel}/partFour2', [ManageHotel::class, 'partFour2'])->name('vendor-admin.hotel.editPfour2');


        Route::get('/hotel/{hotel}/show', [ManageHotel::class, 'show'])->name('vendor-admin.hotel.show');
        Route::put('/hotel/{hotel}', [ManageHotel::class, 'update'])->name('vendor-admin.hotel.update');
        Route::delete('/hotel/{hotel}', [ManageHotel::class, 'destroy'])->name('vendor-admin.hotel.destroy');


        Route::get('/rooms/all', [ManageRoomController::class, 'allRooms'])->name('vendor-admin.room.all');
        Route::get('/vendor-admin/room/{id}', [ManageRoomController::class, 'index'])->name('vendor-admin.room.index');
        
        // Co-Host Management Routes
        Route::get('/co-hosts/all', [CoHostController::class, 'allCoHosts'])->name('vendor.co-hosts.all');
        Route::get('/hotel/{hotelId}/co-hosts', [CoHostController::class, 'index'])->name('vendor.co-hosts.index');
        Route::get('/hotel/{hotelId}/co-hosts/create', [CoHostController::class, 'create'])->name('vendor.co-hosts.create');
        Route::post('/hotel/{hotelId}/co-hosts', [CoHostController::class, 'store'])->name('vendor.co-hosts.store');
        Route::get('/hotel/{hotelId}/co-hosts/{id}/edit', [CoHostController::class, 'edit'])->name('vendor.co-hosts.edit');
        Route::put('/hotel/{hotelId}/co-hosts/{id}', [CoHostController::class, 'update'])->name('vendor.co-hosts.update');
        Route::delete('/hotel/{hotelId}/co-hosts/{id}', [CoHostController::class, 'destroy'])->name('vendor.co-hosts.destroy');
        Route::get('/room-create/{id}', [ManageRoomController::class, 'create'])->name('vendor-admin.room.create');
        Route::post('/vendor-admin/room/store', [ManageRoomController::class, 'store'])->name('vendor-admin.room.store');
        Route::delete('/room/{hotel}', [ManageRoomController::class, 'destroy'])->name('vendor-admin.room.destroy');
        Route::get('/room/{room}/edit', [ManageRoomController::class, 'edit'])->name('vendor-admin.room.edit');
        Route::put('/room/{room}', [ManageRoomController::class, 'update'])->name('vendor-admin.room.update');
        Route::post('vendor-admin/room/delete-photo', [ManageRoomController::class, 'deletePhoto'])->name('vendor-admin.room.delete-photo');
        
        // Booking Management
        Route::get('/bookings', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'index'])->name('vendor.bookings.index');
        Route::get('/reports/bookings/excel', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'exportExcel'])->name('vendor.reports.bookings.excel');
        Route::get('/reports/bookings/pdf', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'exportPdf'])->name('vendor.reports.bookings.pdf');
        Route::get('/bookings/status/{status}', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'indexByStatus'])->name('vendor.bookings.by-status');
        Route::get('/bookings/{id}', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'show'])->name('vendor.bookings.show');
        Route::get('/bookings/{id}/edit', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'edit'])->name('vendor.bookings.edit');
        Route::put('/bookings/{id}', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'update'])->name('vendor.bookings.update');
        Route::put('/bookings/{id}/status', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'updateStatus'])->name('vendor.bookings.updateStatus');
        Route::put('/bookings/{id}/currently-staying', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'updateCurrentlyStaying'])->name('vendor.bookings.updateCurrentlyStaying');
        
        // Manual Order
        Route::get('/bookings/manual/create', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'createManualOrder'])->name('vendor.bookings.manual.create');
        Route::post('/bookings/manual/store', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'storeManualOrder'])->name('vendor.bookings.manual.store');
        Route::get('/bookings/manual/rooms/{hotelId}', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'getRooms'])->name('vendor.bookings.manual.rooms');
        Route::get('/bookings/room/{roomId}/availability/{bookingId?}', [\App\Http\Controllers\Vendor\VendorBookingController::class, 'getRoomAvailability'])->name('vendor.bookings.room.availability');
        
        // Review Management (Vendor can only see and approve reviews for their own hotels)
        Route::get('/reviews', [\App\Http\Controllers\Vendor\VendorReviewController::class, 'index'])->name('vendor.reviews.index');
        Route::get('/reviews/{id}', [\App\Http\Controllers\Vendor\VendorReviewController::class, 'show'])->name('vendor.reviews.show');
        Route::post('/reviews/{id}/approve', [\App\Http\Controllers\Vendor\VendorReviewController::class, 'approve'])->name('vendor.reviews.approve');
        Route::post('/reviews/bulk-approve', [\App\Http\Controllers\Vendor\VendorReviewController::class, 'bulkApprove'])->name('vendor.reviews.bulk-approve');
        Route::post('/reviews/{id}/response', [\App\Http\Controllers\Vendor\VendorReviewController::class, 'addResponse'])->name('vendor.reviews.add-response');
        });
    });
    /*Admin Panel Ended */

});
