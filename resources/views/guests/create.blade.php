<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Attendance Form</title>

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

        .form-container {
    background-color: #ffffff; /* Pure white background */
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 500px;
}


        h2 {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            color: #222;
            margin-bottom: 1.5rem;
        }

        h2 span {
            font-weight: bold;
            color: orange; /* Bold and Orange color for e-GUEST */
        }

        .signature-pad {
            border: 2px solid #000;
            width: 100%;
            height: 200px;
            background-color: #fff;
        }

        canvas {
            touch-action: none !important;
        }

        .form-label i {
            margin-right: 10px;
            color: orange; /* Icon color changed to orange */
        }

        .input-group-text {
            background-color: transparent;
            border: none;
        }

        .btn-submit {
            background-color: #003366; /* Dark blue background for the submit button */
            color: white;
            border: none;
        }

        .logo img {
            width: 100px; /* Set the logo size */
            margin-bottom: 1rem;
        }

        #clear-btn {
            background-color: orange; /* Solid orange background */
            border: none;
            color: white;
        }

        #clear-btn:hover {
            background-color: #e67e22; /* Lighter orange on hover */
            color: white;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 1rem;
            }

            h2 {
                font-size: 1.25rem;
            }

            .signature-pad {
                height: 150px;
            }

            .input-group-text {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{route ('guest.store')}}" method="POST">
            @csrf


                        @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="logo text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>

            <h2 class="text-center">
                OCD MIMAROPA <span>e-GUEST</span> ATTENDANCE LOG
            </h2>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                    <input type="date" name="date_of_visit" class="form-control" placeholder="Date" required>
                </div>
            </div>
            
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required>
                </div>
            </div>
            
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-building"></i></span>
                    <input type="text" name="agency" class="form-control" placeholder="Agency" required>
                </div>
            </div>
            
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <input type="text" name="position" class="form-control" placeholder="Position" required>
                </div>
            </div>
            
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                    <select name="gender" class="form-select" required>
                        <option disabled selected>Choose Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                    <input type="text" name="purpose_of_visit" class="form-control" placeholder="Purpose of Visit" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">E-Signature</label>
                <div class="input-group">
                    <canvas id="signature-pad" class="signature-pad"></canvas>
                    <input type="hidden" name="e_signature" id="e_signature">
                </div>
                <button type="button" id="clear-btn" class="btn btn-outline-secondary mt-2">Clear</button>
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-submit">Submit</button>
            </div>
        </form>
    </div>

    <!-- Optional: Add JS for signature pad -->
</body>
</html>
