<!-- resources/views/orders/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Order</h1>

    <div class="create-order-form" style="background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); max-width: 500px; margin: 20px auto;">
        <form action="{{ route('admin.orders.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="customer" style="display: block; font-size: 1.1em; color: #091057;">Customer:</label>
                <select name="customer_id" id="customer_id" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="total_price" style="display: block; font-size: 1.1em; color: #091057;">Total Price:</label>
                <input type="number" name="total_price" step="0.01" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="status" style="display: block; font-size: 1.1em; color: #091057;">Status:</label>
                <input type="text" name="status" value="Pending" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="warehouse_id" style="display: block; font-size: 1.1em; color: #091057;">Warehouse:</label>
                <select name="warehouse_id" id="warehouse_id" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="parcel_location" style="display: block; font-size: 1.1em; color: #091057;">Parcel Location:</label>
                <input type="text" name="parcel_location" id="parcel_location" placeholder="Enter current location" style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
            </div>


            <button type="submit" style="background-color: #024CAA; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; width: 100%; transition: background-color 0.3s ease;">
                Create Order
            </button>
        </form>
    </div>
@endsection
