<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Default to the last 30 days if no date range is provided
        $dateFrom = $request->input('date_ordered_from') ?? now()->subDays(30)->format('Y-m-d');
        $dateTo = $request->input('date_ordered_to') ?? now()->format('Y-m-d');
    
        // Parse and validate the date range
        $startDate = Carbon::parse($dateFrom)->startOfDay();
        $endDate = Carbon::parse($dateTo)->endOfDay();
    
        if ($startDate > $endDate) {
            return back()->withErrors(['Date From must be earlier than or equal to Date To']);
        }
    
        // Query orders within the date range
        $query = Order::whereBetween('created_at', [$startDate, $endDate]);
    
        // Fetch metrics
        $totalOrders = $query->count();
        $totalRevenue = $query->sum('total_price');
        $totalBaseRevenue = $query->sum('base_total_price'); // Sum base total price
        $recentOrders = $query->latest()->take(5)->get();
        $totalCustomers = $query->distinct('user_id')->count('user_id');
    
        // Prepare chart data
        $orders = $query->get();
    
        // Create a continuous date range
        $dates = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dates[$currentDate->format('Y-m-d')] = [
                'orders' => 0,
                'total_price' => 0,
                'base_total_price' => 0,
                'customers' => 0,
            ];
            $currentDate->addDay();
        }
    
        // Group data and populate the date range
        $groupedOrders = $orders->groupBy(function ($order) {
            return $order->created_at->format('Y-m-d');
        });
    
        foreach ($groupedOrders as $date => $dailyOrders) {
            if (isset($dates[$date])) {
                $dates[$date]['orders'] = $dailyOrders->count();
                $dates[$date]['total_price'] = $dailyOrders->sum('total_price'); // Sum total price
                $dates[$date]['base_total_price'] = $dailyOrders->sum('base_total_price'); // Sum base total price
                $dates[$date]['customers'] = $dailyOrders->pluck('user_id')->unique()->count();
            }
        }
    
        // Prepare chart data for the frontend
        $chartData = [
            'dates' => array_keys($dates),
            'orders' => array_column($dates, 'orders'),
            'total_price' => array_column($dates, 'total_price'),
            'base_total_price' => array_column($dates, 'base_total_price'),
            'customers' => array_column($dates, 'customers'),
        ];
    
        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalBaseRevenue', 'totalCustomers', 'recentOrders', 'chartData', 'dateFrom', 'dateTo'));
    }
    

}
