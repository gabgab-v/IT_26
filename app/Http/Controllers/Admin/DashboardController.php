<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller
use App\Models\Order;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count(); // Count total orders
        $totalRevenue = Order::sum('total_price'); // Calculate total revenue from orders
        $totalCustomers = Customer::count(); // Count total customers
        $recentOrders = Order::latest()->take(5)->get(); // Get the latest 5 orders for display

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalCustomers', 'recentOrders'));
    }
}
