<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JGAB Express</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        /* Combined Inline CSS styling */
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

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('{{ asset('images/BG.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -1;
        }

        header {
            background-color: #091057;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            align-items: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 10;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .logo-circle img {
            width: 75px;
            height: 75px;
            border-radius: 50%;
        }

        .logo-text h1 {
            font-size: 1.8em;
            margin-bottom: 5px;
            color: #ffffff;
            margin-left: 20px;
        }

        .logo-text p {
            font-size: 0.9em;
            color: #ffffff;
            margin-top: -5px;
            margin-left: 20px;
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

        .content {
            text-align: center;
            margin-top: 120px;
            position: relative;
            z-index: 5;
        }

        .tabs {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.7), rgba(240, 240, 240, 0.7));
            padding: 15px;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        .tabs button {
            background: linear-gradient(145deg, #024CAA, #005BBB);
            border: none;
            color: #ffffff;
            margin: 0 10px;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 1em;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.3s, color 0.3s;
        }

        .tabs button:hover {
            background-color: #EC8305;
            transform: scale(1.1);
            color: #ffffff;
        }

        .section {
            background: rgba(255, 255, 255, 0.9);
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            color: #091057;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.8s ease;
            background-image: url('{{ asset('images/pattern.png') }}');
            background-size: 150px;
            background-blend-mode: overlay;
        }

        .hidden {
            display: none;
        }

        .search-btn, .calculate-btn {
            background: linear-gradient(145deg, #024CAA, #005BBB);
            border: none;
            padding: 10px;
            color: white;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1em;
            transition: transform 0.2s, background-color 0.3s, color 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-btn:hover, .calculate-btn:hover {
            background-color: #EC8305;
            transform: scale(1.1);
            color: #ffffff;
        }

        .shipping-days-table, .shipping-rates-table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .shipping-days-table th, .shipping-days-table td, .shipping-rates-table th, .shipping-rates-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 0.9em;
            transition: background-color 0.3s;
        }

        .shipping-days-table th, .shipping-rates-table th {
            background-color: #024CAA;
            color: #ffffff;
            font-weight: bold;
        }

        .shipping-days-table tr:nth-child(even), .shipping-rates-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .shipping-rates-table tr:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .shipping-rates-table td {
            font-weight: bold;
        }

        .form-group label {
            font-weight: bold;
            color: #024CAA;
            display: block;
            margin-bottom: 5px;
        }

        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 1em;
        }

        #result {
            width: 90%;
            margin: 20px auto;
            padding: 15px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            display: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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
            <a href="#about-us">About Us</a>
            <a href="#services">Services</a>
            @guest
                <a href="{{ route('login') }}">Log In</a>
                <a href="{{ route('register') }}">Register</a>
            @else
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
            @endguest
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">Driver Access</a>
                <div class="dropdown-menu">
                    <a href="{{ route('driver.login') }}">Driver Log In</a>
                    <a href="{{ route('driver.register') }}">Driver Register</a>
                </div>
            </div>
        </nav>
    </header>

    <section class="content">
        <div class="tabs">
            <button id="trackBtn">Track Your Order</button>
            <button id="ratesBtn">Shipping Rates</button>
            <button id="daysBtn">Shipping Days</button>
        </div>
        <br>

        <div class="section" id="tracking-form">
            <h2>Track Your Order</h2>
            <form action="{{ route('track-order.submit') }}" method="POST">
                @csrf
                <label for="order_number">Order Number</label>
                <input type="text" id="order_number" name="order_number" placeholder="Enter your order number" required>
                <button type="submit" class="search-btn">🔍 Search</button>
            </form>

            @if ($errors->has('order_number'))
                <p style="color: red;">{{ $errors->first('order_number') }}</p>
            @endif
        </div>

        <div class="section hidden" id="shipping-rates">
            <h2>Shipping Rates</h2>
            <form id="shipping-form">
                <div class="form-group">
                    <label for="origin">Origin:</label>
                    <select id="origin" name="origin" required>
                        <option value="cagayan-de-oro">Cagayan de Oro</option>
                        <option value="surigao-del-sur">Surigao Del Sur</option>
                        <option value="general-santos">General Santos</option>
                        <option value="tagum">Tagum</option>
                        <option value="davao-del-sur">Davao Del Sur</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="destination">Destination:</label>
                    <select id="destination" name="destination" required>
                        <option value="cagayan-de-oro">Cagayan de Oro</option>
                        <option value="surigao-del-sur">Surigao Del Sur</option>
                        <option value="general-santos">General Santos</option>
                        <option value="tagum">Tagum</option>
                        <option value="davao-del-sur">Davao Del Sur</option>
                    </select>
                </div>

                <div class="form-group bag-specs">
                    <label for="bag_specifications">Bag Specifications:</label>
                    <select id="bag_specifications" name="bag_specifications" required>
                        <option value="small">Small (&lt;= 2KG)</option>
                        <option value="medium">Medium (&lt;= 5KG)</option>
                        <option value="large">Large (&lt;= 10KG)</option>
                    </select>
                </div>

                <button type="submit" class="calculate-btn">Calculate Shipping Cost</button>
            </form>

            <div id="result">
                <h3>Shipping Cost Calculation</h3>
                <p><strong>Origin:</strong> <span id="result-origin"></span></p>
                <p><strong>Destination:</strong> <span id="result-destination"></span></p>
                <p><strong>Bag Specifications:</strong> <span id="result-bag-specifications"></span></p>
                <p class="total-amount" style="font-size: 1.2em; color: #EC8305; font-weight: bold;"><strong>Total Amount:</strong> PHP <span id="result-cost"></span></p>
            </div>
        </div>

        <div class="section hidden" id="shipping-days">
            <h2>Shipping Days</h2>
            <p>Here are the estimated shipping days for different locations...</p>
            <table class="shipping-days-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Estimated Shipping Days</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cagayan de Oro</td>
                        <td>3-5 Days</td>
                    </tr>
                    <tr>
                        <td>Surigao Del Sur</td>
                        <td>4-6 Days</td>
                    </tr>
                    <tr>
                        <td>General Santos</td>
                        <td>5-7 Days</td>
                    </tr>
                    <tr>
                        <td>Tagum</td>
                        <td>2-4 Days</td>
                    </tr>
                    <tr>
                        <td>Davao Del Sur</td>
                        <td>3-5 Days</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="about-us" class="about-section" style="margin-top: 400px; opacity: 0.95;">
            <h2>About Us</h2>
            <p>JGAB Express is committed to providing fast and reliable delivery services across the region. We strive to offer the best experience for our customers with a focus on efficiency and customer satisfaction.</p>
        </div>

        <div id="services" class="services-section" style="margin-top: 300px; opacity: 0.95;">
            <h2>Our Services</h2>
            <p>We offer a wide range of logistics and delivery services, including express shipping, cargo handling, and doorstep delivery. Our network ensures that your packages are delivered safely and on time.</p>
        </div>
    </section>

    <script>
        document.getElementById('trackBtn').addEventListener('click', function() {
            showSection('tracking-form');
        });

        document.getElementById('ratesBtn').addEventListener('click', function() {
            showSection('shipping-rates');
        });

        document.getElementById('daysBtn').addEventListener('click', function() {
            showSection('shipping-days');
        });

        function showSection(sectionId) {
            document.getElementById('tracking-form').classList.add('hidden');
            document.getElementById('shipping-rates').classList.add('hidden');
            document.getElementById('shipping-days').classList.add('hidden');

            document.getElementById(sectionId).classList.remove('hidden');
        }

        document.getElementById('shipping-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const origin = document.getElementById('origin').value;
            const destination = document.getElementById('destination').value;
            const bagSpecifications = document.getElementById('bag_specifications').value;

            const rates = {
                'cagayan-de-oro': 10,
                'surigao-del-sur': 12.5,
                'general-santos': 15,
                'tagum': 8,
                'davao-del-sur': 11
            };

            const weightRates = {
                'small': 1,     // Weight multiplier for <= 2KG
                'medium': 1.5,  // Weight multiplier for <= 5KG
                'large': 2      // Weight multiplier for <= 10KG
            };

            const originRate = rates[origin] || 0;
            const destinationRate = rates[destination] || 0;
            const weightMultiplier = weightRates[bagSpecifications] || 1;

            const shippingCost = (originRate + destinationRate) * weightMultiplier;

            document.getElementById('result-origin').textContent = origin.replace(/-/g, ' ').toUpperCase();
            document.getElementById('result-destination').textContent = destination.replace(/-/g, ' ').toUpperCase();
            document.getElementById('result-bag-specifications').textContent = bagSpecifications;
            document.getElementById('result-cost').textContent = shippingCost.toFixed(2);

            document.getElementById('result').style.display = 'block';
        });
    </script>
</body>
</html>
