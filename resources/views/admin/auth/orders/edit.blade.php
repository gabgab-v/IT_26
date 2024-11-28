<!-- resources/views/orders/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Order</h1>

    <div class="edit-order-form" style="background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); max-width: 500px; margin: 20px auto;">
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Hidden order number field -->
        <input type="hidden" name="order_number" value="{{ $order->order_number }}">

        <div style="margin-bottom: 15px;">
            <label for="customer" style="display: block; font-size: 1.1em; color: #091057;">Customer:</label>
            <select name="customer_id" style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $customer->id == $order->customer_id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="total_price" style="display: block; font-size: 1.1em; color: #091057;">Total Price:</label>
            <input type="number" name="total_price" step="0.01" value="{{ $order->total_price }}" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="status" style="display: block; font-size: 1.1em; color: #091057;">Status:</label>
            <input type="text" name="status" value="{{ $order->status }}" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
        </div>

        <button type="submit" style="background-color: #024CAA; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; width: 100%; transition: background-color 0.3s ease;">
            Update Order
        </button>
    </form>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
@endsection
