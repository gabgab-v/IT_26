<!-- resources/views/orders/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Order</h1>

    <div class="create-order-form" style="background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); max-width: 500px; margin: 20px auto;">
        <form action="{{ route('admin.orders.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="user_id" style="display: block; font-size: 1.1em; color: #091057;">User:</label>
                <select name="user_id" id="user_id" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="total_price" style="display: block; font-size: 1.1em; color: #091057;">Total Price:</label>
                <input type="number" name="total_price" step="0.01" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="warehouse_id" style="display: block; font-size: 1.1em; color: #091057;">Warehouse:</label>
                <select name="warehouse_id" id="warehouse_id" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}" data-location="{{ $warehouse->location }}">
                            {{ $warehouse->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="parcel_location" style="display: block; font-size: 1.1em; color: #091057;">Parcel Location:</label>
                <input type="text" name="parcel_location" id="parcel_location" readonly style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px; background-color: #f9f9f9;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="destination" style="display: block; font-size: 1.1em; color: #091057;">Destination:</label>
                <select name="destination" id="destination" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #091057; border-radius: 5px;">
                    @foreach ($locationFees as $locationFee)
                        <option value="{{ $locationFee->location_name }}">{{ $locationFee->location_name }}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" style="background-color: #024CAA; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; width: 100%; transition: background-color 0.3s ease;">
                Create Order
            </button>
        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const warehouseSelect = document.getElementById('warehouse_id');
            const parcelLocationInput = document.getElementById('parcel_location');

            warehouseSelect.addEventListener('change', function () {
                const selectedOption = warehouseSelect.options[warehouseSelect.selectedIndex];
                const location = selectedOption.getAttribute('data-location');
                parcelLocationInput.value = location;
            });

            // Trigger the change event to prefill on page load if needed
            warehouseSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection

