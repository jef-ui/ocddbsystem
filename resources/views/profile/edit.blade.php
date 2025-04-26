<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS - Profile</title>
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
            color: orange;
        }

        .main-content {
            color: black;
            padding: 3rem 1rem;
            max-width: 800px;
            margin: auto;
        }

        .footer {
            background-color: white;
            color: #003366;
            text-align: center;
            font-size: 12px;
            padding: 10px 0;
            margin-top: 3rem;
        }

        .form-section {
            background-color: white;
            color: black;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
        <a href="{{ url('/dashboard') }}">DASHBOARD</a>
        <a href="{{ route('profile.edit') }}">PROFILE</a>
        <!-- LOG OUT LINK -->
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">LOG OUT</a>
        </form>
    </div>
</div>

<!-- Main content -->
<div class="main-content">

    <div class="form-section">
        
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="form-section">
        @include('profile.partials.update-password-form')
    </div>

    <div class="form-section">
        @include('profile.partials.delete-user-form')
    </div>
</div>

<footer class="footer">
    Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
</footer>

</body>
</html>
