<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; // Import the Order model

class DriverDashboardController extends Controller
{
    /**
     * Display the driver's dashboard with assigned orders.
     */
    public function index()
    {
        // Get orders assigned to the authenticated driver
        $orders = Order::where('driver_id', auth()->id())->get();
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
}
