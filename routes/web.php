<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Driver\DriverAuthController;
use App\Http\Controllers\Driver\DriverDashboardController;


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
        Route::get('orders/archived', [OrderController::class, 'archived'])->name('orders.archived');
        Route::resource('orders', OrderController::class); // Admin access for CRUD operations
        
        

        // Assign Driver routes
        Route::get('orders/{order}/assign-driver', [OrderController::class, 'assignDriverPage'])
            ->name('orders.assign_driver_page');
        Route::post('orders/{order}/assign-driver', [OrderController::class, 'assignDriver'])
            ->name('orders.assign_driver');

        // Profile management for admins
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::patch('orders/{order}/cancel', [OrderController::class, 'destroy'])->name('admin.orders.destroy');


    });
});



// General authenticated user routes
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [UserDashboardController::class, 'showDashboard'])->name('user.dashboard');
    // Route::get('/user/dashboard/logs', [UserController::class, 'showLogs'])->name('user.logs');

});

// Public Order Tracking
Route::get('/track-order', [OrderController::class, 'showTrackOrderForm'])->name('track-order');
Route::post('/track-order', [OrderController::class, 'trackOrder'])->name('track-order.submit');

// Driver Routes
Route::prefix('driver')->name('driver.')->group(function () {
    // Driver Authentication Routes
    Route::get('/login', [DriverAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [DriverAuthController::class, 'login']);
    Route::get('/register', [DriverAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [DriverAuthController::class, 'register']);

    // Only accessible if authenticated as a driver
    Route::middleware('auth:driver')->group(function () {
        Route::get('/dashboard', [DriverDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [DriverAuthController::class, 'logout'])->name('logout');
    });
});

require __DIR__.'/auth.php';
