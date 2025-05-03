<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Attendance Form</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vite -->
    @vite('resources/js/app.js')

    <style>
        .signature-pad {
            border: 2px solid #000;
            width: 100%;
            height: 200px;
        }

        canvas {
            touch-action: none !important; /* Ensures mobile devices allow drawing */
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h3>Attendance Form</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="agency" class="form-label">Agency</label>
            <input type="text" name="agency" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" name="position" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" class="form-control" required>
                <option disabled selected>Choose...</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="purpose_of_visit" class="form-label">Purpose of Visit</label>
            <input type="text" name="purpose_of_visit" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_of_visit" class="form-label">Date of Visit</label>
            <input type="date" name="date_of_visit" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">E-Signature</label>
            <canvas id="signature-pad" class="signature-pad"></canvas>
            <input type="hidden" name="e_signature" id="e_signature">
            <button type="button" id="clear-btn" class="btn btn-warning mt-2">Clear</button>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
