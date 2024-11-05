<!-- resources/views/admin/orders/index.blade.php -->
@extends('layouts.admin') <!-- Changed to admin layout if available -->

@section('content')
    <h1>Orders List</h1>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            {{ __('Log Out') }}
        </button>
    </form>
    <a href="{{ route('admin.orders.create') }}">Create New Order</a> <!-- Updated route name -->
    <table>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->customer ? $order->customer->name : 'No customer' }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}">View</a> <!-- Updated route name -->
                        <a href="{{ route('admin.orders.edit', $order->id) }}">Edit</a> <!-- Updated route name -->
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
