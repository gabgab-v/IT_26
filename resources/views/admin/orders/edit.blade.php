<!-- resources/views/orders/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Order</h1>
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="customer">Customer:</label>
        <select name="customer_id">
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ $customer->id == $order->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
            @endforeach
        </select>

        <label for="total_price">Total Price:</label>
        <input type="number" name="total_price" step="0.01" value="{{ $order->total_price }}" required>

        <label for="status">Status:</label>
        <input type="text" name="status" value="{{ $order->status }}" required>

        <button type="submit">Update Order</button>
    </form>
@endsection
