<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
            text-decoration: underline;
        }

        .main-content {
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5rem 1rem;
        }

        .main-content h1 {
            font-size: 3rem;
            font-weight: 800;
            margin: 1rem 0;
        }

        .main-content p {
            font-size: 1.25rem;
            max-width: 800px;
            margin: 0 auto 2rem auto;
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
            <a href="#">OPCEN</a>
            <a href="#">SITREP</a>
            <a href="#">INCOMING COMMUNICATION</a>
             <!-- Profile link -->
        <a href="{{ route('profile.edit') }}">PROFILE</a>
        <!-- LOG OUT LINK -->
            <!-- LOG OUT LINK -->
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">LOG OUT</a>
            </form>
        </div>
    </div>

   <!-- Main content -->
<div class="main-content">
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>You're successfully logged in! Manage your communication logs, track records, and access all system features.</p>
    
</div>




    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

</body>
</html>
