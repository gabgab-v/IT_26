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
        <table class="order-table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f4f4f4; text-align: left;">
                    <th style="padding: 10px;">Order Number</th>
                    <th style="padding: 10px;">Customer</th>
                    <th style="padding: 10px;">Total Price</th>
                    <th style="padding: 10px;">Date Ordered</th>
                    <th style="padding: 10px;">Warehouse</th>
                    <th style="padding: 10px;">Delivery Status</th>
                    <th style="padding: 10px;">Fully Delivered</th>
                    <th style="padding: 10px;">Delivered At</th>
                    <th style="padding: 10px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;">{{ $order->order_number }}</td>
                        <td style="padding: 10px;">{{ optional($order->customer)->name ?? 'No customer' }}</td>
                        <td style="padding: 10px;">₱{{ number_format($order->total_price, 2) }}</td>
                        <td style="padding: 10px;">{{ $order->date_ordered ? $order->date_ordered->format('Y-m-d') : 'No date available' }}</td>
                        <td style="padding: 10px;">{{ optional($order->warehouse)->name ?? 'No warehouse assigned' }}</td>
                        <td style="padding: 10px;">{{ $order->is_delivered ? 'Yes' : 'No' }}</td>
                        <td style="padding: 10px;">{{ $order->is_fully_delivered ? 'Yes' : 'Pending Confirmation' }}</td>
                        <td style="padding: 10px;">{{ $order->delivered_at ? $order->delivered_at->format('Y-m-d') : 'Not delivered yet' }}</td>
                        <td style="padding: 10px;">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="search-btn">View</a>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="search-btn">Edit</a>
                            
                            @if ($order->is_delivered && !$order->is_fully_delivered)
                                <form action="{{ route('admin.orders.confirm_delivery', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="search-btn">Confirm Fully Delivered</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 10px;">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
