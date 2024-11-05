<x-guest-layout>
    <section class="content login-content">
        <h1 class="login-title">Login to Your Account</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email Address -->
            <div class="input-group">
                <x-input-label for="email" :value="__('Email')" class="input-label" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="input-field" />
                <x-input-error :messages="$errors->get('email')" class="error-text" />
            </div>

            <!-- Password -->
            <div class="input-group mt-4">
                <x-input-label for="password" :value="__('Password')" class="input-label" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" class="input-field" />
                <x-input-error :messages="$errors->get('password')" class="error-text" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mt-4">
                <label for="remember_me" class="checkbox-label">
                    <input id="remember_me" type="checkbox" class="checkbox-input" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Login Actions -->
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password-link">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="login-button">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </section>

    <!-- Add custom styles for login page here -->
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
            border-color: #4f46e5; /* Indigo */
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2); /* Light indigo shadow */
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #666;
        }

        .checkbox-input {
            margin-right: 0.5rem;
            accent-color: #4f46e5; /* Indigo */
        }

        .forgot-password-link {
            font-size: 0.85rem;
            color: #4f46e5;
            text-decoration: underline;
        }

        .forgot-password-link:hover {
            color: #3730a3; /* Darker indigo */
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
</x-guest-layout>
