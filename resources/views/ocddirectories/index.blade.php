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
        html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    background: url('#') no-repeat center center fixed;
    background-size: cover;
}

body {
    flex: 1;
}

.main-content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.welcome-container {
    background-color: #ffffff;
    padding: 2.5rem;
    border-radius: 1.25rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 600px;
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

.highlight {
    color: orange;
}

.card-link {
    display: block;
    margin: 0.75rem auto;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    background-color: #003366;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.card-link:hover {
    background-color: orange;
    color: #fff;
}

.footer {
    background-color: white;
    color: #003366;
    text-align: center;
    font-size: 12px;
    padding: 10px 0;
}

#successOverlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  backdrop-filter: blur(6px);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  animation: fadeIn 0.3s ease-in-out;
}

#successMessage {
  background-color: #fefefe;
  color: #222;
  padding: 30px 50px;
  border: 1px solid #ccc;
  border-radius: 12px;
  font-size: 1rem;
  font-family: "Arial", serif;
  text-align: center;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  animation: popIn 0.4s ease-in-out;
}

#successMessage .logo {
  display: block;
  margin: 0 auto 15px auto; /* top: 0, left/right: auto, bottom: 15px */
  width: 80px;
  height: auto;
}


#successMessage p {
  margin: 0;
  font-weight: bold;
}

/* Fade-in and out animations */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes popIn {
  0% { transform: scale(0.7); opacity: 0; }
  60% { transform: scale(1.1); opacity: 1; }
  80% { transform: scale(0.95); }
  100% { transform: scale(1); }
}

@keyframes fadeOut {
  from { opacity: 1; }
  to { opacity: 0; }
}


    </style>
</head>

  <div class="content">
@if(session()->has('success'))
  <div id="successOverlay">
    <div id="successMessage">
      <img src="{{ asset('images/logo.png') }}" alt="LTMS Logo" class="logo">
      <p>{{ session('success') }}</p>
    </div>
  </div>

  <script>
    setTimeout(() => {
      const overlay = document.getElementById('successOverlay');
      overlay.style.animation = 'fadeOut 0.5s ease-in-out forwards';

      setTimeout(() => {
        location.reload();
      }, 500);
    }, 2000);
  </script>
@endif



<body>
    <body>
        <div class="main-content">
            <div class="welcome-container">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <h1>Office of Civil Defense MIMAROPA</h1>
    
                <a href="{{ asset('images/mission-vision.png') }}" class="card-link">
                    <i class="bi bi-file-earmark-text"></i> Mission, Vision, Quality Policy & Core Values
                </a>
    
                <a href="{{ asset('images/citizens-charter.png') }}" class="card-link">
                    <i class="bi bi-file-earmark-text"></i> View Citizen's Charter
                </a>
    
                <a href="{{ asset('images/org-structure.png') }}" class="card-link">
                    <i class="bi bi-diagram-3"></i> View OCD MIMAROPA Organizational Structure
                </a>
            </div>
        </div>
    
        <footer class="footer">
            Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
        </footer>
    </body>
    
    
</body>
</html>
