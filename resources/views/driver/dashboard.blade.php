<!-- resources/views/driver/dashboard.blade.php -->
<html>
<head>
    <title>Driver Dashboard</title>
</head>
<body>
    <h1>Welcome to the Driver Dashboard</h1>
    <p>This is the dashboard for drivers.</p>

    <!-- Logout Form -->
    <form action="{{ route('driver.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
