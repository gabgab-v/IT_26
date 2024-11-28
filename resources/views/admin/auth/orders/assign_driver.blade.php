@extends('layouts.admin')

@section('content')
    <h1>Assign Driver to Order #{{ $order->order_number }}</h1>

    <form action="{{ route('admin.orders.assign_driver', $order->id) }}" method="POST">
        @csrf
        <label for="driver_id">Select Driver:</label>
        <select name="driver_id" id="driver_id" required>
            @foreach ($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="search-btn">Assign Driver</button>
    </form>
@endsection
