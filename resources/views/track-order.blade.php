<!-- resources/views/track-order.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <section class="content">
        <h1>Track Your Order</h1>
        <form action="{{ route('track-order.submit') }}" method="POST" class="tracking-form">
            @csrf
            <label for="order_number">Order Number</label>
            <input type="text" id="order_number" name="order_number" placeholder="Enter your order number" required>
            <button type="submit" class="search-btn">🔍 Search</button>
        </form>

        <!-- Display error if the order is not found -->
        @if ($errors->has('order_number'))
            <p style="color: red;">{{ $errors->first('order_number') }}</p>
        @endif
    </section>
</body>
</html>
