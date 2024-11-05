<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Include your main CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Include Tailwind CSS or Vite resources if using them -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Logo -->
        <div>
            <a href="/">
                <div class="profile-icon">
                    <img src="{{ asset('images/jgablogo.png') }}" alt="Profile" style="width: 250px; height: auto;">
                </div>
            </a>
        </div>

        <!-- Order Details Container -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="text-2xl font-semibold text-center text-gray-800 dark:text-gray-200 mb-4">Order Details</h1>
            
            <div class="order-info space-y-2 text-gray-700 dark:text-gray-300">
                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                <p><strong>Status:</strong> {{ $order->status }}</p>
                <p><strong>Total Price:</strong> ${{ $order->total_price }}</p>
                <!-- Add more details as needed -->
            </div>

            <!-- Track Another Order Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="underline text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">
                    Track another order
                </a>
            </div>
        </div>
    </div>
</body>
</html>
