<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest-only routes for Admin Login
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
    });

    // Authenticated-only routes for Admin
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        // Dashboard, Order, and Profile routes restricted to admin
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('orders', OrderController::class); // Now only admins can access Order routes

        // Profile management for admins
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Public Order Tracking
Route::get('/track-order', [OrderController::class, 'showTrackOrderForm'])->name('track-order');
Route::post('/track-order', [OrderController::class, 'trackOrder'])->name('track-order.submit');

require __DIR__.'/auth.php';
