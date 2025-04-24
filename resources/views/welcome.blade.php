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

        .btn {
            display: inline-block;
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-register {
            background-color: #FF8C00;
            color: white;
            margin-right: 1rem;
        }

        .btn-register:hover {
            background-color: #e67e00;
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
            <a href="https://ocd.gov.ph/about-ocd.html">OCD OFFICIAL WEBPAGE</a>
            <a href="{{ asset('storage/documents/citizens-charter.pdf') }}" target="_blank" class="button login">CITIZEN'S CHARTER</a>
            <a href="#">CONTACT</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">REGISTER</a>
            @endif
            @if (Route::has('login'))
                <a href="{{ route('login') }}">LOGIN</a>
            @endif
        </div>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <!-- <h2 class="text-xl mb-2">Office of Civil Defense MIMAROPA</h2> -->
        <img src="{{ asset('images/logo.png') }}" alt="LTMS Logo" class="logo">
        <h1>OCD MIMAROPA CLMS</h1>
        <p>Welcome to the Communication Logging Management System! Keep track of all your communication records in one secure and easy-to-use platform. Simplify your workflow and ensure smooth, organized communication management.</p>

        @if (Route::has('login'))
            <div class="flex justify-center mt-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-login">Go to Dashboard</a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-register">REGISTER NOW</a>
                    @endif
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
