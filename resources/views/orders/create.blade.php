<!-- resources/views/orders/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <label for="customer">Customer:</label>
        <select name="customer_id" id="customer_id" class="form-control" required>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>

        <label for="total_price">Total Price:</label>
        <input type="number" name="total_price" step="0.01" required>

        <label for="status">Status:</label>
        <input type="text" name="status" value="Pending" required>

        <button type="submit">Create Order</button>
    </form>
@endsection
