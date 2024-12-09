<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JGAB Express</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> {{-- Link external CSS if any --}}
    <style>
        /* Inline CSS styling */
        /* General reset and body styling */
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
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
        }

        .logo-circle img {
            width: 70px;
            height: 70px;
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

        nav a {
            text-decoration: none;
            color: #ffffff;
            margin-left: 20px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #EC8305;
        }

        .profile-icon img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .content {
            text-align: center;
            margin-top: 50px;
        }

        .tabs {
            background-color: #DBD3D3;
            padding: 15px;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .tabs button {
            background-color: #024CAA;
            border: none;
            color: #ffffff;
            margin: 0 10px;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .tabs button:hover {
            background-color: #EC8305;
            color: #ffffff;
        }

        .tracking-form {
            background-color: #ffffff;
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            color: #091057;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .tracking-form label {
            font-size: 1.2em;
            display: block;
            margin-bottom: 10px;
        }

        .tracking-form input {
            width: 300px;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #091057;
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
        }

        .search-btn:hover {
            background-color: #EC8305;
            color: #ffffff;
        }
    </style>
</head>
<body>
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
            @guest
                <a href="{{ route('login') }}">Log In</a>
                <a href="{{ route('register') }}">Register</a>
            @else
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
            @endguest
            <!-- <div class="profile-icon">
                <img src="{{ asset('images/jgab_logo3.png') }}" alt="Profile">
            </div> -->
                <!-- Driver dropdown menu -->
            @guest
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">Driver Access</a>
                <div class="dropdown-menu">
                    <a href="{{ route('driver.login') }}">Driver Log In</a>
                    <a href="{{ route('driver.register') }}">Driver Register</a>
                </div>
            </div>
            @endguest
        </nav>
    </header>

    <section class="content">
    <div class="tabs">
        <h3>Navigation</h3>
        <p>Sections below are displayed inline for testing purposes:</p>
    </div>

    <div class="section-container">
        <!-- Track and Trace Section -->
        <div id="trackSection" class="content-section">
            <div class="tracking-form">
                <h2>Track Your Order</h2>
                <form action="{{ route('track-order.submit') }}" method="POST">
                    @csrf
                    <label for="order_number">Order Number</label>
                    <input type="text" id="order_number" name="order_number" placeholder="Enter your order number" required>
                    <button type="submit" class="search-btn">🔍 Search</button>
                </form>

                <!-- Display error if the order is not found -->
                @if ($errors->has('order_number'))
                    <p style="color: red;">{{ $errors->first('order_number') }}</p>
                @endif
            </div>
        </div>

        <!-- Shipping Rates Section -->
        <div id="ratesSection" class="content-section">
            <h2>Shipping Rates</h2>
            @if($locationFees->isEmpty())
                <p>No shipping rates available.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Location Name</th>
                            <th>Shipping Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locationFees as $locationFee)
                            <tr>
                                <td>{{ $locationFee->location_name }}</td>
                                <td>₱{{ number_format($locationFee->fee, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Shipping Days Section -->
        <div id="daysSection" class="content-section">
            <h2>Shipping Days</h2>
            <p>Details about shipping days will go here.</p>
        </div>
    </div>
</section>

</section>


    <script>
        // JavaScript for button functionality
        document.getElementById('trackBtn').addEventListener('click', function() {
            alert('Track and Trace clicked');
        });

        document.getElementById('ratesBtn').addEventListener('click', function() {
            alert('Shipping Rates clicked');
        });

        document.getElementById('daysBtn').addEventListener('click', function() {
            alert('Shipping Days clicked');
        });
    </script>
</body>
</html>
