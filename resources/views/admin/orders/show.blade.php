<!-- resources/views/orders/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Order Details</h1>
    <p>Order Number: {{ $order->order_number }}</p>
    <p>{{ $order->customer ? $order->customer->name : 'No customer' }}</p>
    <p>Total Price: {{ $order->total_price }}</p>
    <p>Status: {{ $order->status }}</p>
    
    <a href="{{ route('orders.index') }}">Back to Orders</a>
@endsection
