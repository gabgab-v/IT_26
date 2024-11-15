<x-guest-layout>
    <section class="content login-content">
        <h1 class="login-title">Driver Login</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('driver.login') }}" class="login-form">
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
                    {{ __('Log in as Driver') }}
                </x-primary-button>
            </div>
        </form>
    </section>

    <!-- Custom Styles for Driver Login -->
    <style>
        /* Styling adjustments similar to previous layout */
        /* Reuse styling as provided */
    </style>
</x-guest-layout>
