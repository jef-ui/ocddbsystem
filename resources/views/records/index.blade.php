<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OCD MIMAROPA Incoming Communications</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
body {
  margin: 0;
  font-family: 'Arial', sans-serif;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background-color: #f4f6f8;
}

.main {
  flex: 1;
  display: flex;
}

.sidebar {
  width: 200px;
   background-color: #030d22;
  color: white;
  position: fixed;
  top: 0;
  bottom: 0;
  padding: 1rem 0;
  z-index: 1000;
  overflow-y: auto;
}

.content {
  margin-left: 200px; /* match sidebar width */
  flex: 1;
  padding: 2rem;
  overflow-y: auto;
}

.sidebar:hover {
  width: 230px;
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
  margin: 0 auto 1rem;
}

.success-message {
  color: green;
  margin-bottom: 1rem;
}

.footer {
  background-color: white;
  color: #003366;
  text-align: center;
  font-size: 12px;
  padding: 10px 0;
  margin-top: auto;
  border-top: 1px solid #ccc;
}

.table-container {
  background: white;
  padding: 1rem;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
  font-size: 0.8rem;
}

table, th, td {
  border: 1px solid #000000;
}

th, td {
  padding: 0.4rem;
  text-align: center;
}

th {
  background-color: #1c1c1c;
  color: white;
}

.btn-add {
  background-color: #FF8C00;
  color: white;
  padding: 0.75rem 1.5rem;
  border-radius: 5px;
  text-decoration: none;
  font-weight: bold;
  margin-bottom: 1rem;
  transition: background-color 0.3s;
}

.btn-add:hover {
  background-color: #e67300;
}

td a i.bi-pencil-square,
td form button i.bi-trash {
  font-size: 0.9rem;
}

td a {
  color: #FF8C00;
}

td a:hover {
  color: #e67300;
}

td form button {
  background: none;
  border: none;
  padding: 0;
  margin: 0;
  color: inherit;
}

.delete-icon {
  color: red;
  font-size: 0.9rem;
}

.delete-icon:hover {
  color: darkred;
}

.nav-btn {
  color: #000;
  background-color: #f8f9fa;
  border: 1px solid #ddd;
  padding: 8px 16px;
  border-radius: 5px;
  transition: background-color 0.2s ease, color 0.2s ease;
  text-decoration: none;
  margin: 0 4px;
}

.nav-btn:hover,
.nav-btn:active {
  background-color: orange;
  color: white;
  text-decoration: none;
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


  </style>
</head>
<body>

    <!-- Topbar -->
    <div class="topbar">
    <div><strong>COMMUNICATION LOGGING MANAGEMENT SYSTEM</strong></div>
    <div>
        {{ date('l, F j, Y') }} - <span id="liveTime"></span>
    </div>
</div>


<div class="main">

  <!-- Sidebar -->
  <div class="sidebar">

    
    <img src="{{ asset('images/logo.png') }}" alt="LTMS Logo" class="logo">

    @if(Auth::check())
    @php
        $firstName = explode(' ', Auth::user()->name)[0];
    @endphp
  
  <div class="d-flex align-items-center mb-3 px-3 py-2" style="background-color: white; border-radius: 0;">
    <i class="bi bi-person-circle me-2" style="font-size: 1.2rem; color: black;"></i>
    <span style="font-size: 0.95rem; color: black;">Hi! {{ $firstName }}</span>
</div>

  @endif
  

<a href="{{ url('/dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>

<a href="{{ route('radiolog.exportPDF') }}">
  <i class="bi bi-printer"></i> Print/Download
</a>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  <i class="bi bi-box-arrow-right"></i> Log Out
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

    
  </div>

  <!-- Main Content -->
  <div class="content">
    @if(session()->has('success'))
      <div class="success-message">
        {{ session('success') }}
      </div>
    @endif

    <!-- Table -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Date</th>
            <th>Time</th>
            <th>From Agency/Office</th>
            <th>Type</th>
            <th>Subject Description</th>
            <th>Acknowledged By</th>
            <th>Uploaded Attachments</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($records as $record)
          <tr>
            <td>{{ $record->received_date }}</td>
            <td>{{ $record->received_time }}</td>
            <td>{{ $record->from_agency_office }}</td>
            <td>{{ $record->type }}</td>
            <td>{{ $record->subject_description }}</td>
            <td>{{ $record->received_acknowledge_by }}</td>
            <td><!-- View file link/button here if needed --></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="footer">
  Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
</footer>

<script>
  function updateLiveTime() {
    const now = new Date();
    let hours = now.getHours();
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    
    // Determine AM or PM
    const ampm = hours >= 12 ? 'PM' : 'AM';
    
    // Convert to 12-hour format
    hours = hours % 12;
    hours = hours ? hours : 12; // Hour '0' should be '12'
    
    // Format time as hh:mm:ss AM/PM
    const timeString = `${hours.toString().padStart(2, '0')}:${minutes}:${seconds} ${ampm}`;
    document.getElementById('liveTime').textContent = timeString;
  }

  // Update time immediately and every second
  updateLiveTime();
  setInterval(updateLiveTime, 1000);
</script>


</body>
</html>
