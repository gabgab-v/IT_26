<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Driver\DriverAuthController;
use App\Http\Controllers\Driver\DriverDashboardController;
use App\Http\Controllers\Admin\WarehouseController;

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
        Route::get('orders/delivered', [OrderController::class, 'delivered'])->name('orders.delivered');
        Route::resource('orders', OrderController::class); // Admin access for CRUD operations
        
        Route::resource('warehouses', WarehouseController::class);
        Route::patch('orders/{order}/update-location', [OrderController::class, 'updateLocation'])->name('admin.orders.update_location');
        Route::patch('orders/{order}/mark-delivered', [OrderController::class, 'markAsDelivered'])->name('admin.orders.mark_delivered');
        Route::post('/orders/{order}/process', [OrderController::class, 'processOrder'])->name('orders.process');
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/warehouse/orders', [OrderController::class, 'warehouseView'])->name('admin_warehouse.orders.index');

        Route::post('/warehouse/orders/{order}/ready-for-shipping', [OrderController::class, 'confirmReadyForShipping'])->name('admin.orders.ready_for_shipping');

        Route::get('/warehouse/orders', [OrderController::class, 'warehouseView'])->name('admin.warehouse.orders.list');



        Route::patch('/orders/{order}/confirm_delivery', [OrderController::class, 'confirmDelivery'])->name('orders.confirm_delivery');


        // Assign Driver routes
        Route::get('orders/{order}/assign-driver', [OrderController::class, 'assignDriverPage'])
            ->name('orders.assign_driver_page');
        Route::post('/orders/{order}/assign-driver', [OrderController::class, 'assignDriver'])->name('orders.assign_driver');


        // Profile management for admins
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::patch('orders/{order}/cancel', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
    });
});

Route::post('/orders/{order}/update-location', [OrderController::class, 'updateParcelLocation'])->name('orders.updateLocation');

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
        Route::patch('/orders/{order}/location', [DriverDashboardController::class, 'updateLocation'])->name('orders.update_location');
        Route::post('/logout', [DriverAuthController::class, 'logout'])->name('logout');

        // Driver order update routes
        Route::patch('orders/{order}/update', [DriverDashboardController::class, 'updateOrder'])->name('driver.orders.update');
        Route::patch('orders/{order}/update-status', [DriverDashboardController::class, 'updateStatus'])->name('driver.orders.update_status');
    });
});

// Warehouse
Route::patch('orders/{order}/update-location', [OrderController::class, 'updateLocation'])->name('admin.orders.update_location');


require __DIR__.'/auth.php';
