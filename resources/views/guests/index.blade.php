<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Guest</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vite -->
    @vite('resources/js/app.js')

    <style>
        body {
            background: url('{{ asset('images/bg_1.png') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .logo img {
            width: 100px;
            margin-bottom: 1rem;
        }

        h1 {
            font-size: 1.75rem;
            color: #003366;
            font-weight: bold;
        }

        p {
            font-size: 1.2rem;
            color: #333;
        }

        span.name-highlight {
            color: orange;
            font-weight: bold;
        }

        @media (max-width: 576px) {
            .welcome-container {
                padding: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <h1>Welcome to OCD MIMAROPA</h1>
        <p>Thank you for your visit, <span class="name-highlight">{{ $guest->name }}</span>!</p>

    </div>
</body>
</html>
