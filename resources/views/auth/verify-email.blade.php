<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email - OCD CLMS</title>
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

        .verify-card {
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

    <div class="verify-card">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 60px; height: auto;">
        </div>

        <!-- Title -->
        <div class="title">
            OCD MIMAROPA CLMS
        </div>

        <!-- Message -->
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        <!-- Status Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <!-- Resend Form -->
        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

</body>
</html>
