@extends('layouts.admin')

@section('content')
    <header>
        <nav>
            <a href="{{ route('admin.orders.index') }}" class="search-btn">All Orders</a>
        </nav>
    </header>

    <section class="content">
        <h1>Delivered Orders</h1>
        
        <a href="{{ route('admin.orders.index') }}" class="search-btn">Back to All Orders</a>
        <table class="order-table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Date Ordered</th>
                    <th>Warehouse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ optional($order->customer)->name ?? 'No customer' }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->date_ordered ? $order->date_ordered->format('Y-m-d') : 'No date available' }}</td>
                        <td>{{ optional($order->warehouse)->name ?? 'No warehouse assigned' }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="search-btn">View</a>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="search-btn">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </section>
@endsection
