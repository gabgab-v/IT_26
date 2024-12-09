@extends('layouts.app')

@section('content')
    <div class="dashboard-container" style="padding: 20px; max-width: 1200px; margin: auto;">

        <!-- Dashboard Header -->
        <div class="dashboard-header" style="display: flex; justify-content: space-between; align-items: center; background-color: #091057; padding: 15px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
            <h1 style="font-size: 2em; color: #ffffff; margin: 0;">Admin Dashboard</h1>

            <a href="{{ route('admin.orders.index') }}" style="background-color: #024CAA; color: white; padding: 15px 25px; border-radius: 5px; text-decoration: none; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
                Manage Orders
            </a>

            <!-- Logout Button -->
            <a href="{{ route('admin.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                style="color: white; background-color: #e74c3c; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                Logout
            </a>

            <!-- Logout Form -->
            <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="summary-cards" style="display: flex; gap: 20px; margin-top: 20px;">
            <div class="card" style="flex: 1; background-color: #024CAA; color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">
                <h2>Total Orders</h2>
                <p style="font-size: 1.5em; font-weight: bold;">{{ $totalOrders }}</p>
            </div>
            <div class="card" style="flex: 1; background-color: #024CAA; color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">
                <h2>Total Customers</h2>
                <p style="font-size: 1.5em; font-weight: bold;">{{ $totalCustomers }}</p>
            </div>
            <div class="card" style="flex: 1; background-color: #024CAA; color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">
                <h2>Total Parcel Prices (₱)</h2>
                <p style="font-size: 1.5em; font-weight: bold;">₱{{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>

        <!-- Date Range Filter Form -->
        <form id="date-filter-form" method="GET" action="{{ route('admin.dashboard') }}" style="margin-top: 40px; display: flex; gap: 10px; justify-content: flex-end;">
            <label for="date_ordered_from" style="align-self: center;">Date From:</label>
            <input type="date" name="date_ordered_from" id="date_ordered_from" value="{{ request('date_ordered_from') }}" style="padding: 5px;">

            <label for="date_ordered_to" style="align-self: center;">Date To:</label>
            <input type="date" name="date_ordered_to" id="date_ordered_to" value="{{ request('date_ordered_to') }}" style="padding: 5px;">

            <button type="submit" style="padding: 5px 15px; background-color: #024CAA; color: white; border: none; border-radius: 5px;">
                Filter
            </button>
        </form>


        <!-- Charts Section -->
        <div class="charts-section" style="margin-top: 40px;">
            <h2 style="font-size: 1.8em; color: #091057; border-bottom: 2px solid #091057; padding-bottom: 10px;">
                Analytics
            </h2>
            <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between;">
                <div style="flex: 1; min-width: 300px;">
                    <canvas id="ordersChart"></canvas>
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="recent-orders" style="margin-top: 40px;">
            <h2 style="font-size: 1.8em; color: #091057; border-bottom: 2px solid #091057; padding-bottom: 10px;">
                Recent Orders
            </h2>

            <table style="width: 100%; border-collapse: collapse; margin-top: 20px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                <thead>
                    <tr style="background-color: #f4f4f4; color: #333; text-align: left;">
                        <th style="padding: 10px;">Order Number</th>
                        <th style="padding: 10px;">Customer</th>
                        <th style="padding: 10px;">Total Price (₱)</th>
                        <th style="padding: 10px;">Status</th>
                        <th style="padding: 10px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;">{{ $order->order_number }}</td>
                            <td style="padding: 10px;">{{ $order->customer ? $order->customer->name : 'No customer' }}</td>
                            <td style="padding: 10px;">₱{{ number_format($order->total_price, 2) }}</td>
                            <td style="padding: 10px;">{{ ucfirst($order->status) }}</td>
                            <td style="padding: 10px;">{{ $order->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 10px; text-align: center; color: #999;">No orders found for the selected date range.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Orders Chart
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ordersCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData['dates']) !!},
            datasets: [{
                label: 'Orders',
                data: {!! json_encode($chartData['orders']) !!},
                borderColor: '#024CAA',
                backgroundColor: 'rgba(2, 76, 170, 0.1)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            }
        }
    });

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['dates']) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($chartData['revenue']) !!},
                backgroundColor: '#024CAA'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            }
        }
    });
</script>

@endsection
