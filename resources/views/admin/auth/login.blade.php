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
                color: #091057;
            }
        </style>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <div class="profile-icon">
                        <img src="{{ asset('images/jgab_logo3.png') }}" alt="Profile" style="width: 220px; height: auto;">
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <section class="content login-content">
                    <h1 class="login-title">Admin Login</h1>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('admin.login') }}" class="login-form">
                        @csrf

                        <!-- Email Address -->
                        <div class="input-group">
                            <label for="email" class="input-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="input-field">
                            <x-input-error :messages="$errors->get('email')" class="error-text" />
                        </div>

                        <!-- Password -->
                        <div class="input-group mt-4">
                            <label for="password" class="input-label">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="input-field">
                            <x-input-error :messages="$errors->get('password')" class="error-text" />
                        </div>

                        <!-- Login Actions -->
                        <div class="flex items-center justify-between mt-4">
                            <button type="submit" class="login-button">
                                Log in
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
        <!-- Add custom styles for admin login page -->
        <style>
            .content {
                max-width: 400px;
                margin: auto;
                padding: 2rem;
                background-color: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            }
            
            .login-title {
                font-size: 1.5rem;
                text-align: center;
                margin-bottom: 1.5rem;
                color: #333;
            }

            .input-group {
                margin-bottom: 1rem;
            }

            .input-label {
                font-size: 0.9rem;
                color: #666;
                margin-bottom: 0.5rem;
            }

            .input-field {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 1rem;
                background-color: #fff;
            }

            .input-field:focus {
                outline: none;
                border-color: #4f46e5;
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            }

            .login-button {
                background-color: #024CAA;
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                color: #fff;
                border-radius: 4px;
                transition: background-color 0.3s;
            }

            .login-button:hover {
                background-color: #3730a3;
            }

            .error-text {
                color: #e53e3e;
                font-size: 0.85rem;
            }
        </style>
    </body>
</html>
