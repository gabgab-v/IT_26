<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #091057;
            margin-bottom: 20px;
        }
        .profile-info {
            margin: 20px 0;
            color: #555;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #024CAA;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #EC8305;
        }
        .logout-btn {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h1>Welcome to Your Dashboard, {{ Auth::user()->name }}!</h1>

        <div class="profile-info">
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Member since:</strong> {{ Auth::user()->created_at->format('F Y') }}</p>
        </div>

        <a href="#" class="btn">View Profile</a>
        <a href="/" class="btn">Track Order</a>

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn logout-btn">Logout</button>
        </form>
    </div>

    <div class="container">
    <h2>Recent Order Searches</h2>
    @if ($logs->isEmpty())
        <p>No recent searches found.</p>
    @else
        <table border="1" style="width: 100%; margin-top: 20px;">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Search Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->order_number }}</td>
                        <td>{{ $log->searched_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>
