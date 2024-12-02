<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
            body {
                background: linear-gradient(135deg, #e3f2fd, #e1bee7);
                font-family: 'Figtree', sans-serif;
                margin: 0;
                color: #091057;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                animation: backgroundFade 3s ease-in-out infinite alternate;
            }

            @keyframes backgroundFade {
                0% { filter: brightness(1); }
                100% { filter: brightness(0.9); }
            }

            .logo {
                display: flex;
                justify-content: center;
                margin-bottom: 1.5rem;
            }

            .center-logo {
                max-width: 150px;
                width: 100%;
                height: auto;
                margin-bottom: 1rem;
                animation: rotateIn 1.5s ease;
            }

            @keyframes rotateIn {
                from { transform: rotate(-180deg); opacity: 0; }
                to { transform: rotate(0); opacity: 1; }
            }

            .login-container {
                width: 100%;
                max-width: 400px;
                background: rgba(255, 255, 255, 0.85);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                border-radius: 12px;
                padding: 2.5rem;
                text-align: center;
                animation: slideIn 0.5s ease-out forwards;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .form-header {
                text-align: center;
                margin-bottom: 1.5rem;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .form-header h1 {
                font-size: 1.8rem;
                font-weight: bold;
                color: #091057;
                animation: fadeInText 1.2s ease-in-out;
            }

            @keyframes fadeInText {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .input-field-container {
                position: relative;
                width: 100%;
                margin-bottom: 1.5rem;
            }

            .input-field {
                width: 100%;
                padding: 0.85rem;
                padding-right: 3rem;
                border: 1px solid #ccc;
                border-radius: 8px;
                font-size: 1rem;
                background: #f9f9f9;
                transition: border-color 0.3s, box-shadow 0.3s;
            }

            .input-field:focus {
                border-color: #3f51b5;
                box-shadow: 0 0 5px rgba(63, 81, 181, 0.5);
                outline: none;
            }

            .password-toggle {
                position: absolute;
                top: 50%;
                right: 1rem;
                transform: translateY(-50%);
                cursor: pointer;
                font-size: 1.4rem;
                color: #555;
                transition: color 0.3s;
            }

            .password-toggle:hover {
                color: #3f51b5;
            }

            .actions {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
            }

            .checkbox-label {
                font-size: 0.85rem;
                color: #555;
            }

            .checkbox-input {
                margin-right: 0.5rem;
            }

            .forgot-password-link {
                font-size: 0.85rem;
                color: #3f51b5;
                text-decoration: none;
                transition: color 0.3s;
            }

            .forgot-password-link:hover {
                color: #1a237e;
            }

            .login-button {
                background: #EC8305;
                color: white;
                padding: 0.8rem 1.5rem;
                font-size: 1.1rem;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                transition: background 0.3s, transform 0.2s;
                width: 100%;
                display: block;
            }

            .login-button:hover {
                background: #EC8305;
                transform: translateY(-2px);
            }

            .error-text {
                font-size: 0.85rem;
                color: #e53935;
            }
        </style>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="JGAB Express Logo" class="center-logo">
        </div>
        <div class="login-container">
            <div class="form-header">
                <h1>Welcome Back</h1>
                <p class="login-subtitle">Please sign in to continue</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="input-field-container">
                    <input id="email" type="email" name="email" placeholder="Enter your email" :value="old('email')" required autofocus class="input-field">
                    <x-input-error :messages="$errors->get('email')" class="error-text" />
                </div>

                <!-- Password with Toggle -->
                <div class="input-field-container">
                    <input id="password" type="password" name="password" placeholder="Enter your password" required class="input-field">
                    <span id="toggle-password" class="password-toggle">
                        <i id="eye-icon" class="fas fa-eye"></i>
                    </span>
                    <x-input-error :messages="$errors->get('password')" class="error-text" />
                </div>

                <!-- Actions -->
                <div class="actions">
                    <label for="remember_me" class="checkbox-label">
                        <input id="remember_me" type="checkbox" class="checkbox-input" name="remember">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot password?</a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-button">
                    Sign In
                </button>
            </form>
        </div>

        <script>
            document.getElementById('toggle-password').addEventListener('click', function () {
                const passwordField = document.getElementById('password');
                const eyeIcon = document.getElementById('eye-icon');
                const isPasswordVisible = passwordField.type === 'text';

                // Toggle between password and text
                passwordField.type = isPasswordVisible ? 'password' : 'text';

                // Update eye icon
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });
        </script>
    </body>
</html>
