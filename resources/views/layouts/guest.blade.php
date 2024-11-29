<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
        body {
            background-color: #DBD3D3;
            background-image: url('{{ asset('images/BG.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Figtree', sans-serif;
            margin: 0;
            color: #091057;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: backgroundFade 3s ease-in-out infinite alternate;
        }

        @keyframes backgroundFade {
            0% { filter: brightness(1); }
            100% { filter: brightness(0.9); }
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            padding: 2rem;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
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
            font-weight: 600;
            color: #091057;
            animation: fadeInText 1.2s ease-in-out;
        }

        @keyframes fadeInText {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
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

        .input-field-container {
            position: relative;
            width: 100%;
        }

        .input-field {
            width: 100%;
            padding: 0.9rem;
            padding-right: 0.2px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            background: #ffffff;
            color: black;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .input-field:focus {
            border-color: #3f51b5;
            box-shadow: 0 0 8px rgba(63, 81, 181, 0.5);
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

        .login-button {
            width: 100%;
            padding: 0.9rem;
            background-color: #091057;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            animation: buttonPulse 1.5s ease-in-out infinite;
        }

        @keyframes buttonPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .login-button:hover {
            background-color: #EC8305;
            transform: translateY(-3px);
        }

        .forgot-password-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            font-size: 0.85rem;
            color: #091057;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password-link:hover {
            color: #EC8305;
        }
    </style>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="login-container">
            <div class="form-header">
                <img src="{{ asset('images/jgab_logo3.png') }}" alt="JGAB Express Logo" class="center-logo">
                <h1>Log In</h1>
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

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="checkbox-label">
                        <input id="remember_me" type="checkbox" class="checkbox-input" name="remember">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password-link">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-button">
                    Log In
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
