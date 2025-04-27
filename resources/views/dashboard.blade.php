<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif; /* Changed font-family to Arial */
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
            font-family: Arial, sans-serif; /* Changed font-family to Arial */
        }

        .topbar a {
            color: white;
            margin-left: 1rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-family: Arial, sans-serif; /* Changed font-family to Arial */
        }

        .topbar a:hover {
            color: orange;
        }

        .main-content {
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5rem 1rem;
            font-family: Arial, sans-serif; /* Changed font-family to Arial */
        }

        .main-content h1 {
            font-size: 3rem;
            font-weight: 800;
            margin: 1rem 0;
            font-family: Arial, sans-serif; /* Changed font-family to Arial */
        }

        .main-content p {
            font-size: 1.25rem;
            max-width: 800px;
            margin: 0 auto 2rem auto;
            font-family: Arial, sans-serif; /* Changed font-family to Arial */
        }

        .footer {
            background-color: white;
            color: #003366;
            text-align: center;
            font-size: 12px;
            padding: 10px 0;
            font-family: Arial, sans-serif; /* Changed font-family to Arial */
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

        .logo {
            max-width: 140px;
            margin: 1rem auto;
        }
    </style>
</head>
<body>

    <!-- Topbar -->
    <div class="topbar">
        <div class="flex items-center space-x-3">
            <a href="{{ route('profile.edit') }}">
                <i class="bi bi-person-circle"></i> <strong>PROFILE</strong>
            </a>
        </div>
        <div>
            <a href="/radiolog">
                <i class="bi bi-journal-text"></i> RADIO LOG SYSTEM
            </a>
            <a href="#">
                <i class="bi bi-inbox"></i> INCOMING COMMUNICATION
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="bi bi-box-arrow-right"></i> LOG OUT
                </a>
            </form>
        </div>
    </div>

   <!-- Main content -->
    <div class="main-content">
        <img src="{{ asset('images/logo.png') }}" alt="LTMS Logo" class="logo">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You're successfully logged in! Manage your communication logs, track records, and access all system features.</p>
    </div>

    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

</body>
</html>
