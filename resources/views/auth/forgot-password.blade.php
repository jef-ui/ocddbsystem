<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - OCD CLMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('{{ asset('images/bg_1.png') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .forgot-card {
            background-color: white;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 3rem auto;
            width: 90%;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .title {
            text-align: center;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer {
            background-color: white;
            color: #003366;
            text-align: center;
            font-size: 12px;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <div class="forgot-card">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 60px; height: auto;">
        </div>

        <!-- Title -->
        <div class="title">
            OCD MIMAROPA CLMS
        </div>

        <!-- Info Text -->
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Forgot Password Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

</body>
</html>
