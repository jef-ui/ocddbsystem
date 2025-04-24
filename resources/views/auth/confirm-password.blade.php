<x-guest-layout>

    <!-- Logo and Title -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 50px; height: auto;"> <!-- Adjusted size with inline CSS -->
    </div>
    <div class="flex justify-center mb-6">
        <h2 class="text-lg font-semibold">OCD MIMAROPA CLMS</h2> <!-- Title below the logo -->
    </div>


    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
