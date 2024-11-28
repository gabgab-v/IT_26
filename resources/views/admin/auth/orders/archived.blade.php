@extends('layouts.admin')

@section('content')
<h1>Archived Orders</h1>

<table class="order-table">
    <thead>
        <tr>
            <th>Order Number</th>
            <th>Customer</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Cancelled Reason</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($archivedOrders as $order)
        <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->customer ? $order->customer->name : 'No customer' }}</td>
            <td>{{ $order->total_price }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->cancel_reason }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
