<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DriverDashboardController extends Controller
{
    /**
     * Display the driver's dashboard with assigned orders.
     */
    public function index()
    {
        // Get orders assigned to the authenticated driver that are not fully delivered
        $orders = Order::where('driver_id', auth()->id())
                       ->where('is_fully_delivered', false)
                       ->get();
        return view('driver.dashboard', compact('orders'));
    }
    

    /**
     * Update the parcel location for an order.
     */
    public function updateLocation(Request $request, Order $order)
    {
        // Ensure the driver owns the order
        if ($order->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }

        // Validate the input for parcel_location
        $request->validate([
            'parcel_location' => 'required|string|max:255',
        ]);

        // Update the parcel location
        $order->parcel_location = $request->input('parcel_location');
        $order->save();

        return redirect()->route('driver.dashboard')->with('success', 'Parcel location updated successfully');
    }

    /**
     * Update the order status for a driver.
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        // Ensure the driver owns the order and that the order is not fully delivered
        if ($order->driver_id !== auth()->id() || $order->is_fully_delivered) {
            return redirect()->back()->with('error', 'Unauthorized action or order already fully delivered');
        }
    
        // Validate the input for status
        $request->validate([
            'status' => 'required|string|in:pending,delivered',
        ]);
    
        // Update the order status
        $order->status = $request->input('status');
        $order->save();
    
        return redirect()->route('driver.dashboard')->with('success', 'Order status updated successfully');
    }
    
}
