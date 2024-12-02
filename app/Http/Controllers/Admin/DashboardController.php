<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get date range filters from the request
        $dateRangeFrom = $request->input('date_ordered_from');
        $dateRangeTo = $request->input('date_ordered_to');

        $query = Order::query();

        if ($dateRangeFrom && $dateRangeTo) {
            $startDate = Carbon::parse($dateRangeFrom)->startOfDay();
            $endDate = Carbon::parse($dateRangeTo)->endOfDay();

            $query->whereBetween('date_ordered', [$startDate, $endDate])
                  ->orWhereBetween('delivered_at', [$startDate, $endDate]);
        }

        // Calculate total orders and revenue based on the query
        $totalOrders = $query->count();
        $totalRevenue = $query->sum('total_price');

        // Total customers (not filtered by date range)
        $totalCustomers = Customer::count();

        // Get the most recent orders filtered by date range
        $recentOrders = $query->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalCustomers', 'recentOrders'));
    }
}
