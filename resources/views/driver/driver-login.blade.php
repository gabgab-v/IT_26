<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #DBD3D3;
            color: #091057;
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
        .login-title {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .login-form {
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
        .forgot-password-link {
            text-decoration: none;
            color: #091057;
            font-size: 0.9em;
        }
        .login-button {
            background-color: #024CAA;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-button:hover {
            background-color: #EC8305;
        }
    </style>
</head>
<body>
    <section class="content login-content">
        <h1 class="login-title">Driver Login</h1>

        <!-- Session Status -->
        @if(session('status'))
            <div class="mb-4">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('driver.login') }}" class="login-form">
            @csrf

            <!-- Email Address -->
            <div class="input-group">
                <label for="email" class="input-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="input-field">
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group mt-4">
                <label for="password" class="input-label">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="input-field">
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mt-4">
                <label for="remember_me" class="checkbox-label">
                    <input id="remember_me" type="checkbox" class="checkbox-input" name="remember">
                    <span>Remember me</span>
                </label>
            </div>

            <!-- Login Actions -->
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot your password?</a>
                @endif

                <button type="submit" class="login-button">Log in as Driver</button>
            </div>
        </form>
    </section>
</body>
</html>
