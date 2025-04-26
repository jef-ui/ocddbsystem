<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Add this in your <head> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('{{ asset('images/bg_1.png') }}') no-repeat center center fixed;
            background-size: cover;
        }

        .topbar {
            background-color: #001F5B;
            color: white;
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar a {
            color: white;
            margin-left: 1rem;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .topbar a:hover {
            color: orange;
        
        }

        .main-content {
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .main-content h1 {
            font-family: Arial, sans-serif; /* Changed to Arial */
            font-size: 3rem;
            font-weight: 800;
            margin: 1rem 0;
        }

        .main-content p {
            font-size: 1rem; /* Reduced font size */
            max-width: 700px;
            margin: 0 auto 2rem auto;
        }

        .btn {
            display: inline-block;
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: transparent;
            border: 2px solid #FF8C00;
            color: #FF8C00;
        }

        .btn-login:hover {
            background-color: #FF8C00;
            color: white;
        }

        .logo {
            max-width: 140px;
            margin: 1rem auto;
        }

        .footer {
            background-color: white;
            color: #003366;
            text-align: center;
            font-size: 12px;
            padding: 10px 0;
        }

        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }
    </style>
</head>
<body>

    <!-- Topbar -->
<div class="topbar">
    <div class="flex items-center space-x-3">
        <strong>OCD CLMS</strong>
    </div>
    <div>
        <a href="https://ocd.gov.ph/about-ocd.html">
            <i class="bi bi-globe"></i> OCD OFFICIAL WEBPAGE
        </a>
        <a href="#">
            <i class="bi bi-envelope-at"></i> CONTACT
        </a>
        @if (Route::has('login'))
            <a href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right"></i> LOGIN
            </a>
        @endif
    </div>
</div>


    <!-- Main content -->
    <div class="main-content">
        <img src="{{ asset('images/logo.png') }}" alt="LTMS Logo" class="logo">
        <h1>OCD MIMAROPA CLMS</h1>
        <p>
            Welcome to the Communication Logging Management System! Keep track of all your communication records in one secure and easy-to-use platform. Simplify your workflow and ensure smooth, organized communication management.
        </p>

        @if (Route::has('login'))
            <div class="mt-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-login">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-login">LOG IN</a>
                @endauth
            </div>
        @endif
    </div>

    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

</body>
</html>
