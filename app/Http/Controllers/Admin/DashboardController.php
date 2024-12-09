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
        // Get date range filters
        $dateFrom = $request->input('date_ordered_from');
        $dateTo = $request->input('date_ordered_to');
    
        $query = Order::query();
    
        if ($dateFrom && $dateTo) {
            $startDate = Carbon::parse($dateFrom)->startOfDay();
            $endDate = Carbon::parse($dateTo)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        // Fetch data for metrics
        $totalOrders = $query->count();
        $totalRevenue = $query->sum('total_price');
        $recentOrders = $query->latest()->take(5)->get();
        $totalCustomers = Customer::count();
    
        // Prepare data for charts
        $orders = $query->get();
        $chartData = [
            'dates' => [],
            'orders' => [],
            'revenue' => [],
        ];
    
        $groupedOrders = $orders->groupBy(function ($order) {
            return $order->created_at->format('Y-m-d');
        });
    
        foreach ($groupedOrders as $date => $dailyOrders) {
            $chartData['dates'][] = $date;
            $chartData['orders'][] = $dailyOrders->count();
            $chartData['revenue'][] = $dailyOrders->sum('total_price');
        }
    
        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalCustomers', 'recentOrders', 'chartData'));
    }
    
}
