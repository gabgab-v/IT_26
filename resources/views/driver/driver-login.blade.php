<x-guest-layout>
    <section class="content login-content">
        <div class="logo-container">
            <!-- Add your logo here -->
            <img src="{{ asset('images/jgab_logo3.png') }}" alt="Logo" class="login-logo">
        </div>
        <h1 class="login-title">Driver Login</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('driver.login') }}" class="login-form" id="loginForm">
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
            <div class="flex items-center justify-between mt-6">
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
        body {
    background-color: #F3F4F6;
    font-family: 'Roboto', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-image: url('{{ asset('images/BG.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    filter: brightness(0.9);
    padding: 20px; /* Adds some spacing for smaller screens */
}

.login-content {
    background: rgba (255, 255, 255, 1); /* Subtle gradient for a professional look */
    padding: 50px;
    border-radius: 20px;
    border: 1px solid #e0e0e0; /* Adds a border for more definition */
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1); /* Softer, more professional shadow */
    max-width: 400px;
    width: 100%;
    backdrop-filter: none;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.login-content:hover {
    transform: translateY(-5px); /* Adds a hover effect to lift the container */
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15); /* Deepens shadow on hover for emphasis */
}

.logo-container {
    margin-bottom: 30px; /* Increased spacing for better visual separation */
}

.login-logo {
    max-width: 150px;
    width: 100%;
}

.login-title {
    font-size: 2em;
    margin-bottom: 25px;
    text-align: center;
    color: #333333; /* Changed to a darker shade for readability */
    font-weight: 700;
}

.input-group {
    margin-bottom: 25px; /* Increased spacing between fields */
    position: relative;
}

.input-label {
    font-weight: bold;
    color: #555555; /* Neutral color for a professional look */
    margin-bottom: 8px;
    display: block;
}

.input-field {
    width: 100%;
    padding: 15px;
    border: 1px solid #ddd; /* Adds a border for better definition */
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
    color: #000000; /* Black text for readability */
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Soft inset shadow for depth */
    transition: box-shadow 0.2s, border 0.2s, transform 0.2s;
}

.input-field:focus {
    outline: none;
    border: 1px solid #005BBB; /* Emphasizes focus state with brand color */
    box-shadow: 0 0 10px rgba(0, 91, 187, 0.3); /* Soft glowing effect */
    transform: scale(1.02);
}

.error-text {
    color: #ff4c4c;
    font-size: 0.875em;
    margin-top: 5px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    color: #555555; /* Changed to a neutral color */
}

.checkbox-input {
    margin-right: 10px;
}

.forgot-password-link {
    color: #005BBB; /* Aligned with brand color */
    text-decoration: none;
    transition: color 0.3s;
}

.forgot-password-link:hover {
    color: #024CAA; /* Darkens on hover for emphasis */
}

.login-button {
    background: linear-gradient(145deg, #024CAA, #005BBB);
    padding: 15px 30px;
    color: #ffffff;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.3s;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    font-weight: bold;
}

.login-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(2, 76, 170, 0.4);
}

.flex.items-center {
    display: flex;
    align-items: center;
}

.flex.items-center.justify-between {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.toggle-password {
    position: absolute;
    right: 15px;
    top: 42px;
    color: #005BBB; /* Changed to match brand color */
    cursor: pointer;
    user-select: none;
    font-size: 0.875em;
    transition: color 0.3s;
}

.toggle-password:hover {
    color: #024CAA; /* Darkens on hover for emphasis */
}

    </style>
</x-guest-layout>
