<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display a listing of orders
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    // Show the form for creating a new order
    public function create()
    {
        $customers = Customer::all();  // Retrieve all customers
        return view('orders.create', compact('customers'));
    }

    // Store a newly created order in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'total_price' => 'required|numeric',
            'status' => 'required',
        ]);
    
        // Create the order using the validated data (order_number will be generated)
        Order::create($validated);
    
        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }
    

    // Display the specified order
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    // Show the form for editing an order
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $customers = Customer::all(); // Fetch all customers
    
        return view('orders.edit', compact('order', 'customers'));
    }

    // Update the specified order in the database
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_number' => 'required|unique:orders,order_number,' . $order->id,
            'customer_id' => 'required',
            'total_price' => 'required|numeric',
            'status' => 'required',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    // Remove the specified order from the database
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }

        // Display the tracking form
    public function showTrackingForm()
    {
        return view('track-order');
    }

    // Process the order tracking request
    public function trackOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'order_number' => 'required|string',
        ]);

        // Search for the order by order number
        $order = Order::where('order_number', $request->order_number)->first();

        if ($order) {
            // Return view with order details if found
            return view('order-details', ['order' => $order]);
        } else {
            // Redirect back with an error message if not found
            return redirect()->route('track-order')->withErrors(['order_number' => 'Order not found.']);
        }
    }
    
}
