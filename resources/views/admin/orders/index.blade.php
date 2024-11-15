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

        <a href="{{ route('admin.orders.create') }}" class="search-btn">Create New Order</a>

        <table class="order-table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Driver</th>
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
                        <a href="{{ route('admin.orders.assign_driver_page', $order->id) }}" class="search-btn">Assign Driver</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="search-btn">View</a>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="search-btn">Edit</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="search-btn">Cancel</button>
                        </form>
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
@endsection
