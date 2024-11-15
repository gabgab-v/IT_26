<x-guest-layout>
    <section class="content register-content">
        <h1 class="register-title">Driver Registration</h1>

        <form method="POST" action="{{ route('driver.register') }}" class="register-form">
            @csrf

            <!-- Name -->
            <div class="input-group">
                <x-input-label for="name" :value="__('Name')" class="input-label" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus class="input-field" />
                <x-input-error :messages="$errors->get('name')" class="error-text" />
            </div>

            <!-- Email Address -->
            <div class="input-group mt-4">
                <x-input-label for="email" :value="__('Email')" class="input-label" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required class="input-field" />
                <x-input-error :messages="$errors->get('email')" class="error-text" />
            </div>

            <!-- License Number -->
            <div class="input-group mt-4">
                <x-input-label for="license" :value="__('License Number')" class="input-label" />
                <x-text-input id="license" type="text" name="license" :value="old('license')" required class="input-field" />
                <x-input-error :messages="$errors->get('license')" class="error-text" />
            </div>

            <!-- Vehicle Information -->
            <div class="input-group mt-4">
                <x-input-label for="vehicle" :value="__('Vehicle Information')" class="input-label" />
                <x-text-input id="vehicle" type="text" name="vehicle" :value="old('vehicle')" required class="input-field" />
                <x-input-error :messages="$errors->get('vehicle')" class="error-text" />
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

            <!-- Register Button -->
            <div class="flex items-center justify-between mt-4">
                <x-primary-button class="register-button">
                    {{ __('Register as Driver') }}
                </x-primary-button>
            </div>
        </form>
    </section>

    <!-- Custom Styles for Driver Registration -->
    <style>
        /* Apply custom styles similar to the login page */
        /* Reuse styling as provided */
    </style>
</x-guest-layout>
