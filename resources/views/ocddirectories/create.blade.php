<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDRRMC Directories</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vite -->
    @vite('resources/js/app.js')

    <style>
        body {
    background: url('#') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    flex-direction: column;
}

.form-container {
    background-color: #ffffff; /* Pure white background */
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 600px; /* Increase max-width for wider view */
    margin-bottom: 80px; /* Add margin-bottom to prevent footer overlap */
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
    color: #003366; /* Bold and Orange color for e-GUEST */
}

.signature-pad {
    border: 2px solid #000;
    width: 100%;
    height: 300px;
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
    background-color: #003366; /* Dark blue */
    color: #ffffff; /* White text */
    border: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-submit:hover {
    background-color: #eb6a00; /* White background on hover */
    color: #ffffff; /* Dark blue text */
    border: 1px solid #ffffff; /* Optional: visible border on hover */
    cursor: pointer;
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

.footer {
    background-color: white;
    color: #003366;
    text-align: center;
    font-size: 12px;
    padding: 10px 0;
    position: relative;
    width: 100%;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
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
    font-family: Arial, sans-serif;
}

    </style>
</head>

<!-- Notification Modal -->
<div id="notification-modal" class="modal-overlay">
    <div class="modal-content">
        <div class="logo text-center mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 80px;">
        </div>
        <h4 class="text-center">Welcome!</h4>
        <p class="text-center">
            This site is <strong>locally hosted</strong> and your details are <strong>secured</strong>.<br>
            Please ensure accuracy before submitting your information.
        </p>
        <div class="text-center mt-3">
            <button onclick="closeModal()" class="btn btn-primary">Continue</button>
        </div>
    </div>
</div>


{{-- <script>
    window.addEventListener('load', function () {
        alert("This site is locally hosted and your details are secured. Please ensure accuracy before submitting.");
    });
</script> --}}

<body>
    <div class="form-container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{route ('ocddirectory.store')}}" method="POST" id="guest-form">
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
                        <span>RDRRMC MIMAROPA </span> Official Contact Registry
                </h2>


            
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-building"></i></span>
                    <input type="text" name="agency" class="form-control uppercase" placeholder="Agency/ Office" required style="text-transform: uppercase;">
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="regionaldirector" class="form-control uppercase" placeholder="Office Head / Regional Director" required style="text-transform: uppercase;">
                </div>
            </div>
            
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <input type="text" name="designation" class="form-control uppercase" placeholder="Position/ Designation" required style="text-transform: uppercase;">
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                    <input type="text" name="hotline" class="form-control" placeholder="HOTLINE/OFFICE CONTACT NUMBER" required>
                </div>
            </div>

             <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                    <input type="text" name="govmail" class="form-control" placeholder="OFFICIAL GOVMAIL/YMAIL/GMAIL" required>
                </div>
            </div>
            
            
     <div class="mb-3">
    <div class="input-group">
        <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
        <input type="text" name="address" class="form-control uppercase" placeholder="Office Address" required style="text-transform: uppercase;">
    </div>
</div>

         <div class="d-grid">
                <button type="submit" class="btn btn-submit">Submit</button>
            </div>
        </form>
    </div>

            

    <!-- Footer -->
    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

    <script>
document.querySelectorAll('.capitalize').forEach(input => {
    input.addEventListener('input', () => {
        const words = input.value.toLowerCase().split(' ');
        for (let i = 0; i < words.length; i++) {
            if (words[i]) {
                words[i] = words[i][0].toUpperCase() + words[i].substring(1);
            }
        }
        input.value = words.join(' ');
    });
});
</script>

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
