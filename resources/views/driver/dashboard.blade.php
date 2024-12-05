<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions {
            text-align: center;
        }
        .logout-btn {
            margin: 10px 0;
            background-color: #ff4c4c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #ff1a1a;
        }
        .update-form input[type="text"] {
            padding: 5px;
            margin-right: 5px;
            width: 70%;
        }
        .update-form button {
            padding: 5px 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .update-form button:hover {
            background-color: #45a049;
        }
        .empty-row {
            text-align: center;
            font-style: italic;
            color: #999;
        }
    </style>
</head>
<body>
    <h1>Welcome, {{ auth()->user()->name }}!</h1>
    <p>Here are your assigned orders:</p>

    <!-- Logout Form -->
    <form action="{{ route('driver.logout') }}" method="POST" style="text-align: right;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>

    <!-- Orders Table -->
    <table>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer</th>
                <!-- <th>Current Location</th> -->
                <th>Destination</th>
                <th>Status</th>
                <th>Parcel Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->customer->name ?? 'No customer' }}</td>
                    <!-- <td>{{ $order->current_location }}</td> -->
                    <td>{{ $order->destination }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->parcel_location ?? 'Not updated' }}</td>
                    <td class="actions">
                    <!-- Form to update parcel location -->
                        <form action="{{ route('driver.orders.update_location', $order->id) }}" method="POST" class="update-form">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="parcel_location" placeholder="Enter parcel location" value="{{ $order->parcel_location }}">
                            <button type="submit">Update Parcel Location</button>
                        </form>

                        <!-- Form to update order status -->
                        <form action="{{ route('driver.driver.orders.update_status', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Out for Delivery" {{ $order->status == 'Out for Delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                            <noscript>
                                <button type="submit">Update Status</button>
                            </noscript>
                        </form>
                    </td>


                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-row">No orders assigned to you yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>