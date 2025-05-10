<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS - Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            width: 200px;
            background-color: #030d22;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            padding: 1rem 0;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 1rem 0;
            font-size: 0.85rem;
            padding: 0.8rem 1rem;
            transition: background-color 0.2s, color 0.2s;
        }

        .sidebar a:hover {
            background-color: #f4f6f9;
            color: #000000;
        }

        .sidebar a.active {
            background-color: #FF8C00;
            color: rgb(226, 225, 225);
        }

        .sidebar h2 {
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .sidebar img.logo {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .topbar {
            margin-left: 200px;
            height: 60px;
            background-color: white;
            border-bottom: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            font-size: 0.9rem;
        }

        .topbar a {
            color: #333;
            margin-left: 1rem;
            text-decoration: none;
        }

        .topbar a:hover {
            color: #FF8C00;
        }

        .main-content {
            margin-left: 200px;
            padding: 2rem;
        }

        .form-section {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .footer {
            margin-left: 200px;
            text-align: center;
            padding: 1rem;
            font-size: 0.8rem;
            color: #555;
        }

        @media (max-width: 768px) {
            .sidebar, .topbar, .main-content, .footer {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <img src="{{ asset('images/logo.png') }}" alt="LTMS Logo" class="logo">

    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i> Profile
    </a>

    <a href="/radiolog" class="{{ request()->is('radiolog') ? 'active' : '' }}">
        <i class="bi bi-journal-text"></i> Radio Log
    </a>

    <a href="{{ route('record.index') }}" class="{{ request()->routeIs('record.index') ? 'active' : '' }}">
        <i class="bi bi-inbox"></i> Incoming
    </a>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
        @csrf
        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </form>
</div>

<!-- Topbar -->
<div class="topbar">
    <div><strong>COMMUNICATION LOGGING MANAGEMENT SYSTEM</strong></div>
    <div>
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <a href="{{ route('profile.edit') }}">Profile</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
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

<!-- Footer -->
<footer class="footer">
    Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © 2025
</footer>

</body>
</html>
