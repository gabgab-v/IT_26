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
                <section class="content register-content">
                    <h1 class="register-title">Create a New Account</h1>

                    <form method="POST" action="{{ route('register') }}" class="register-form">
                        @csrf

                        <!-- Name -->
                        <div class="input-group">
                            <label for="name" class="input-label">Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="input-field">
                            <x-input-error :messages="$errors->get('name')" class="error-text" />
                        </div>

                        <!-- Email Address -->
                        <div class="input-group mt-4">
                            <label for="email" class="input-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="input-field">
                            <x-input-error :messages="$errors->get('email')" class="error-text" />
                        </div>

                        <!-- Password -->
                        <div class="input-group mt-4">
                            <label for="password" class="input-label">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password" class="input-field">
                            <x-input-error :messages="$errors->get('password')" class="error-text" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="input-group mt-4">
                            <label for="password_confirmation" class="input-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="input-field">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="error-text" />
                        </div>

                        <!-- Register Actions -->
                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('login') }}" class="already-registered-link">Already registered?</a>

                            <button type="submit" class="register-button">Register</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </body>
</html>
