@extends('layouts.admin')

@section('content')
    <h1>Warehouse Orders</h1>

    {{-- Logout Button for Warehouse Admin --}}
    @if (auth('admin')->user()->role === 'warehouse')
        <form action="{{ route('admin.logout') }}" method="POST" style="text-align: right; margin-bottom: 20px;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @endif

    <table class="order-table">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Warehouse</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ optional($order->customer)->name ?? 'No customer' }}</td>
                    <td>{{ optional($order->warehouse)->name ?? 'No warehouse assigned' }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        @if ($order->status === 'processing')
                            <form action="{{ route('admin.admin.orders.ready_for_shipping', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Confirm Ready for Shipping</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
