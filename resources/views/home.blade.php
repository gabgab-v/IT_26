<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JGAB Express - Professional Logistics</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #F3F4F6;
            color: #091057;
            line-height: 1.6;
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
            filter: brightness(0.8);
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
            position: fixed;
            top: 0;
            width: 100%;
            background: linear-gradient(145deg, #091057, #09247B);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            padding: 15px 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo-circle img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .logo-text {
            margin-left: 15px;
        }

        .logo-text h1 {
            font-size: 1.8em;
            color: #ffffff;
            font-weight: 700;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: #ffffff;
            margin-left: 25px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #EC8305;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #ffffff;
            box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 8px;
            z-index: 1001;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #091057;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #EC8305;
            color: #ffffff;
        }

        .content {
            text-align: center;
            padding-top: 150px;
            padding-bottom: 50px;
            position: relative;
        }

        .tabs {
            background: rgba(255, 255, 255, 0.5);
            padding: 20px;
            display: inline-block;
            border-radius: 15px;
            box-shadow: 4px 4px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .tabs button {
            background: linear-gradient(145deg, #024CAA, #005BBB);
            border: none;
            color: #ffffff;
            margin: 0 15px;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 1.1em;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.3s, color 0.3s;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .tabs button:hover {
            background-color: #EC8305;
            transform: scale(1.1);
            color: #ffffff;
        }

        .section {
            background: rgba(255, 255, 255, 0.5);
            margin-top: 20px;
            padding: 30px;
            border-radius: 15px;
            display: inline-block;
            color: #091057;
            box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.8s ease;
        }

        .hidden {
            display: none;
        }

        .search-btn, .calculate-btn {
            background: linear-gradient(145deg, #024CAA, #005BBB);
            border: none;
            padding: 15px 30px;
            color: white;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.2em;
            transition: transform 0.2s, background-color 0.3s, color 0.3s;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .search-btn:hover, .calculate-btn:hover {
            background-color: #EC8305;
            transform: scale(1.1);
            color: #ffffff;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .shipping-days-table, #shipping-rates-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            animation: fadeIn 1s ease-in-out;
        }

        .shipping-days-table th, .shipping-days-table td, #shipping-rates-table th, #shipping-rates-table td {
            padding: 15px 20px;
            text-align: left;
            font-size: 16px;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        .shipping-days-table th, #shipping-rates-table th {
            background: linear-gradient(145deg, #091057, #09247B);
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
        }

        .shipping-days-table tr:hover, #shipping-rates-table tr:hover {
            background-color: #f7f7f7;
            cursor: pointer;
        }

        .about-section, .services-section {
            background: rgba(255, 255, 255, 0.5);
            padding: 30px;
            border-radius: 15px;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #091057;
        }

        .about-section h2, .services-section h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .about-section p, .services-section p {
            font-size: 1.1em;
            line-height: 1.8;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <div class="logo-circle">
                    <img src="{{ asset('images/jgab_logo3.png') }}" alt="JGAB Express Logo">
                </div>
                <div class="logo-text">
                    <h1>JGAB Express</h1>
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
                    <a href="#" class="dropdown-toggle" onclick="toggleDropdown(event)">Driver Access</a>
                    <div class="dropdown-menu">
                        <a href="{{ route('driver.login') }}">Driver Log In</a>
                        <a href="{{ route('driver.register') }}">Driver Register</a>
                    </div>
                </div>
            </nav>
        </div>
    <script>
    function toggleDropdown(event) {
        event.preventDefault();
        const dropdownMenu = event.target.nextElementSibling;
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    }
</script>
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
                <button type="submit" class="search-btn">⌕ Search</button>
            </form>

            <!-- Display error if the order is not found -->
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
                <div class="form-group">
                    <label for="bag_specifications">Bag Specifications:</label>
                    <select id="bag_specifications" name="bag_specifications" required>
                        <option value="small">Small (&lt;= 2KG)</option>
                        <option value="medium">Medium (&lt;= 5KG)</option>
                        <option value="large">Large (&lt;= 10KG)</option>
                    </select>
                </div>
                <button type="submit" class="calculate-btn">Calculate Shipping Cost</button>
            </form>
            <div id="result" style="display: none;">
                <h3>Shipping Cost Calculation</h3>
                <p><strong>Origin:</strong> <span id="result-origin"></span></p>
                <p><strong>Destination:</strong> <span id="result-destination"></span></p>
                <p><strong>Bag Specifications:</strong> <span id="result-bag-specifications"></span></p>
                <p class="total-amount"><strong>Total Amount:</strong> PHP <span id="result-cost"></span></p>
            </div>
        </div>

        <div class="section hidden" id="shipping-days">
            <h2>Shipping Days</h2>
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

        <div id="about-us" class="about-section">
            <h2>About Us</h2>
            <p>JGAB Express is committed to providing fast and reliable delivery services across the region. We strive to offer the best experience for our customers with a focus on efficiency and customer satisfaction.</p>
        </div>

        <div id="services" class="services-section">
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

            const originRate = rates[origin] || 0;
            const destinationRate = rates[destination] || 0;
            const shippingCost = (originRate + destinationRate) * 2;

            document.getElementById('result-origin').textContent = origin.replace(/-/g, ' ').toUpperCase();
            document.getElementById('result-destination').textContent = destination.replace(/-/g, ' ').toUpperCase();
            document.getElementById('result-bag-specifications').textContent = bagSpecifications;
            document.getElementById('result-cost').textContent = shippingCost.toFixed(2);

            document.getElementById('result').style.display = 'block';
        });
    </script>
</body>
</html>
