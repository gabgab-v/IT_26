<x-guest-layout>
    <section class="content register-content">
        <h1 class="register-title">Create a New Account</h1>

        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf

            <!-- Name -->
            <div class="input-group">
                <x-input-label for="name" :value="__('Name')" class="input-label" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="input-field" />
                <x-input-error :messages="$errors->get('name')" class="error-text" />
            </div>

            <!-- Email Address -->
            <div class="input-group mt-4">
                <x-input-label for="email" :value="__('Email')" class="input-label" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="input-field" />
                <x-input-error :messages="$errors->get('email')" class="error-text" />
            </div>

            <!-- Password -->
            <div class="input-group mt-4">
                <x-input-label for="password" :value="__('Password')" class="input-label" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" class="input-field" />
                <x-input-error :messages="$errors->get('password')" class="error-text" />
            </div>

            <!-- Confirm Password -->
            <div class="input-group mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="input-label" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="input-field" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-text" />
            </div>

            <!-- Register Actions -->
            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('login') }}" class="already-registered-link">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="register-button">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </section>

    <!-- Custom styles for registration page -->
    <style>
        .content {
            max-width: 400px;
            margin: auto;
            padding: 2rem;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .register-title {
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

        .already-registered-link {
            font-size: 0.85rem;
            color: #4f46e5;
            text-decoration: underline;
        }

        .already-registered-link:hover {
            color: #3730a3;
        }

        .register-button {
            background-color: #024CAA;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .register-button:hover {
            background-color: #3730a3;
        }

        .error-text {
            color: #e53e3e;
            font-size: 0.85rem;
        }
    </style>
</x-guest-layout>
