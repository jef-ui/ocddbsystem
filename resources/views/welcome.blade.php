<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            background: url('{{ asset('images/bg_3.png') }}') no-repeat center center fixed;
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
            flex: 1;
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
            font-size: 3rem;
            font-weight: 800;
            margin: 1rem 0;
        }

        .main-content p {
            font-size: 1rem;
            max-width: 700px;
            margin: 0 auto 2rem auto;
        }

        .btn {
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

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none; /* hidden by default */
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            text-align: center;
        }

        .modal-content h4 {
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }

        .modal-content p {
            font-size: 0.9rem;
            color: #333;
        }

        .modal-content .btn-primary {
            margin-top: 1.5rem;
            padding: 0.5rem 1.5rem;
            background-color: #001F5B;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content img {
    display: block;
    margin: 0 auto 1rem auto;
}

    </style>
</head>
<body>

    <!-- Notification Modal -->
    <div id="notification-modal" class="modal-overlay">
    <div class="modal-content">
        <div class="logo text-center mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 80px;">
        </div>
        <h4>Welcome!</h4>
        <p>
            This Communication Logging Management System (CLMS) is <strong>locally hosted</strong> by OCD MIMAROPA. <br>
            All communication records are processed with <strong>confidentiality</strong> and stored in a <strong>secured environment</strong>.<br>
            For any technical concerns, please report immediately to the <strong>System Administrator</strong>.
        </p>
        <button onclick="closeModal()" class="btn-primary">Continue</button>
    </div>
</div>


    <!-- Topbar -->
    <div class="topbar">
        <div><strong>OCD CLMS</strong></div>
        <div>
            <a href="https://ocd.gov.ph/about-ocd.html">
                <i class="bi bi-globe"></i> OCD OFFICIAL WEBPAGE
            </a>
            <a href="{{ url ('directory')}}">
                <i class="bi bi-envelope-at"></i> DIRECTORIES
            </a>
            <a href="{{ asset('images/citizens-charter.png') }}">
                <i class="bi bi-envelope-at"></i> CITIZEN'S CHARTER
            </a>
            @if (Route::has('login'))
                <a href="{{ asset('images/org-structure.png') }}">
                    <i class="bi bi-box-arrow-in-right"></i> ORGANIZATIONAL STRUCTURE
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

    <!-- Footer -->
    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

    <!-- Modal Script -->
    <script>
        function closeModal() {
            document.getElementById('notification-modal').style.display = 'none';
        }

        window.addEventListener('load', function () {
            document.getElementById('notification-modal').style.display = 'flex';
        });
    </script>

</body>
</html>
