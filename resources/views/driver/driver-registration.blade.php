<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Driver Registration</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #DBD3D3;
            color: #091057;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .content {
            margin: auto;
            max-width: 500px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .register-title {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .register-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .input-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .input-label {
            font-weight: bold;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #091057;
            border-radius: 5px;
        }
        .error-text {
            color: red;
            font-size: 0.9em;
        }
        .register-button {
            background-color: #024CAA;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .register-button:hover {
            background-color: #EC8305;
        }
    </style>
</head>
<body>
    <section class="content register-content">
        <h1 class="register-title">Driver Registration</h1>

        <form method="POST" action="{{ route('driver.register') }}" class="register-form">
            @csrf

            <!-- Name -->
            <div class="input-group">
                <label for="name" class="input-label">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="input-field">
                @error('name')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="input-group mt-4">
                <label for="email" class="input-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="input-field">
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- License Number -->
            <div class="input-group mt-4">
                <label for="license" class="input-label">License Number</label>
                <input id="license" type="text" name="license" value="{{ old('license') }}" required class="input-field">
                @error('license')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Vehicle Information -->
            <div class="input-group mt-4">
                <label for="vehicle" class="input-label">Vehicle Information</label>
                <input id="vehicle" type="text" name="vehicle" value="{{ old('vehicle') }}" required class="input-field">
                @error('vehicle')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group mt-4">
                <label for="password" class="input-label">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="input-field">
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="input-group mt-4">
                <label for="password_confirmation" class="input-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="input-field">
                @error('password_confirmation')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Register Button -->
            <div class="flex items-center justify-between mt-4">
                <button type="submit" class="register-button">Register as Driver</button>
            </div>
        </form>
    </section>
</body>
</html>
