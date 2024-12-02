@extends('layouts.admin')

@section('content')
    <header>
        <div class="logo">
            <div class="logo-circle">
                <img src="{{ asset('images/jgab_logo3.png') }}" alt="JGAB Express Logo">
            </div>
            <div class="logo-text">
                <h1>JGAB Express</h1>
                <p>Stay Informed, Stay on Track</p>
            </div>
        </div>
        <nav>
            <a href="#">About Us</a>
            <a href="#">Services</a>
            <a href="{{ route('admin.orders.archived') }}" class="search-btn">Archived Orders</a>
            <a href="{{ route('admin.warehouses.index') }}" class="search-btn">Warehouse</a>
            <a href="{{ route('admin.orders.delivered') }}" class="search-btn">Delivered</a>
            <a href="{{ route('admin.admin_warehouse.orders.index') }}" class="btn btn-primary">
                Test Warehouse Orders Route
            </a>

        </nav>
    </header>

    <section class="content">
        <h1>Orders List</h1>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="search-btn">
                {{ __('Log Out') }}
            </button>
        </form>

        <form method="GET" action="{{ route('admin.orders.index') }}">
            <label for="date_ordered_from">Date From:</label>
            <input type="date" name="date_ordered_from" id="date_ordered_from" value="{{ request('date_ordered_from') }}">

            <label for="date_ordered_to">Date To:</label>
            <input type="date" name="date_ordered_to" id="date_ordered_to" value="{{ request('date_ordered_to') }}">

            <button type="submit" class="search-btn">Filter</button>
        </form>

        <a href="{{ route('admin.orders.create') }}" class="search-btn">Create New Order</a>

        <table class="order-table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Duration</th>
                    <th>Warehouse</th>
                    <th>Parcel Locations</th>
                    <th>Fully Delivered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ optional($order->customer)->name ?? 'No customer' }}</td>
                    <td>₱{{ number_format($order->total_price, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->duration ?? 'N/A' }}</td>
                    <td>{{ optional($order->warehouse)->name ?? 'No warehouse assigned' }}</td>
                    <td>{{ $order->parcel_location ?? 'No parcel location' }}</td>
                    <td>
                        {{ $order->is_fully_delivered ? 'Yes' : 'Pending Confirmation' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="search-btn">View</a>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="search-btn">Edit</a>
                        @if ($order->status === 'Pending')
                            <form action="{{ route('admin.orders.process', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="search-btn">Process Order</button>
                            </form>
                        @endif


                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()">
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="ready_for_shipping" {{ $order->status === 'ready_for_shipping' ? 'selected' : '' }}>Ready for Shipping</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </form>


                        
                        @if ($order->status === 'delivered' && !$order->is_fully_delivered)
                            <form action="{{ route('admin.orders.confirm_delivery', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="search-btn">Confirm Fully Delivered</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>



    <style>
        /* Add consistent styling from the main page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #DBD3D3;
            color: #091057;
        }
        header {
            background-color: #091057;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            align-items: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo-circle {
            width: 60px;
            height: 60px;
            background-color: #024CAA;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }
        .logo-circle img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .logo-text h1 {
            font-size: 1.8em;
            margin-bottom: 5px;
            color: #ffffff;
        }
        .logo-text p {
            font-size: 0.9em;
            color: #ffffff;
            margin-top: -5px;
        }
        .content h1 {
            margin-top: 30px;
            color: #091057;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .order-table th, .order-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .order-table th {
            background-color: #024CAA;
            color: #ffffff;
        }
        .order-table tr:hover {
            background-color: #f1f1f1;
        }
        .search-btn {
            background-color: #024CAA;
            border: none;
            padding: 10px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease, color 0.3s ease;
            margin-top: 10px;
            text-decoration: none;
        }
        .search-btn:hover {
            background-color: #EC8305;
            color: #ffffff;
        }
    </style>
    <!-- JavaScript for Assign Driver AJAX call -->
    <script>
        function assignDriver(orderId) {
            let form = document.getElementById(`assignDriverForm-${orderId}`);
            let formData = new FormData(form);

            fetch(form.action, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Driver assigned successfully');
                    location.reload();
                } else {
                    alert('Error assigning driver');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while assigning the driver.');
            });
        }

    </script>
    <script>
        function showCancelModal(orderId) {
            const form = document.getElementById('cancelForm');
            form.action = `/admin/orders/${orderId}/cancel`;
            document.getElementById('cancelModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('cancelModal').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function () {
        const radioOptions = document.getElementsByName('cancel_reason');
        const otherReasonContainer = document.getElementById('otherReasonContainer');
        const otherReasonInput = document.getElementById('other_reason');

        // Add event listeners to radio buttons
        radioOptions.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'Other') {
                    otherReasonContainer.style.display = 'block';
                    otherReasonInput.setAttribute('required', 'true'); // Make textbox required
                } else {
                    otherReasonContainer.style.display = 'none';
                    otherReasonInput.removeAttribute('required'); // Remove required from textbox
                }
            });
        });
    });

    </script>
@endsection
