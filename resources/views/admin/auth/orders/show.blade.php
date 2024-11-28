<!-- resources/views/orders/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Order Details</h1>

    <div class="order-details" style="background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); max-width: 500px; margin: 20px auto;">
        <p style="font-size: 1.1em; color: #091057;"><strong>Order Number:</strong> {{ $order->order_number }}</p>

        <p style="font-size: 1.1em; color: #091057;"><strong>Customer:</strong> 
            {{ $order->customer ? $order->customer->name : 'No customer' }}
        </p>

        <p style="font-size: 1.1em; color: #091057;"><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>

        <p style="font-size: 1.1em; color: #091057;"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

        <a href="{{ route('admin.orders.index') }}" style="display: inline-block; margin-top: 20px; background-color: #024CAA; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 1em; transition: background-color 0.3s ease;">
            Back to Orders
        </a>
    </div>
@endsection
