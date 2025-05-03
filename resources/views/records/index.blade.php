<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OCD MIMAROPA Incoming Communications</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Arial', sans-serif;
    }

    body {
      display: flex;
      flex-direction: column;
      background-color: #f4f6f8;
    }

    .main {
      flex: 1;
      display: flex;
    }

    .sidebar {
      width: 180px;
      background-color: #001F5B;
      color: white;
      padding: 2rem 1rem;
      display: flex;
      flex-direction: column;
      box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease-in-out;
    }

    .sidebar:hover {
      box-shadow: 6px 0 12px rgba(0, 0, 0, 0.2);
    }

    .sidebar h2 {
      font-size: 1.2rem;
      margin-bottom: 2rem;
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sidebar h2 img {
      width: 30px;
      height: 30px;
      margin-right: 8px;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      margin: 0.8rem 0;
      display: block;
      padding: 0.5rem 0.8rem;
      border-radius: 5px;
      font-size: 0.9rem;
    }

    .sidebar a i {
      margin-right: 6px;
    }

    .sidebar a:hover {
      color: orange;
    }

    .content {
      flex: 1;
      padding: 2rem;
      overflow-y: auto;
    }

    .content h1 {
      font-size: 2rem;
      margin-bottom: 1rem;
      text-align: center;
      font-weight: bold;
    }

    .table-container {
      background: white;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      font-size: 0.8rem;
    }

    table, th, td {
      border: 1px solid #ccc;
    }

    th, td {
      padding: 0.4rem;
      text-align: center;
    }

    th {
      background-color: #001F5B;
      color: white;
    }

    .success-message {
      color: green;
      margin-bottom: 1rem;
    }

    .btn-add {
      display: inline-block;
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

    .footer {
      background-color: white;
      color: #003366;
      text-align: center;
      font-size: 12px;
      padding: 10px 0;
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
  </style>
</head>
<body>

<div class="main">

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>
      <img src="{{ asset('images/logo.png') }}" alt="Logo"> OCD CLMS
    </h2>

    @if(Auth::check())
    @php
        $firstName = explode(' ', Auth::user()->name)[0];
    @endphp

    <div class="d-flex align-items-center mb-3 px-3 py-2 rounded" style="background-color: white;">
      <i class="bi bi-person-circle me-2" style="font-size: 1.2rem; color: black;"></i>
      <span style="font-size: 0.95rem; color: black;">Hi! {{ $firstName }}</span>
    </div>
    @endif

    <a href="{{ url('/dashboard') }}"><i class="bi bi-speedometer2"></i> DASHBOARD</a>
    <a href="{{ route('radiolog.exportPDF') }}"><i class="bi bi-printer"></i> PRINT LOGS</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right"></i> LOG OUT
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

</body>
</html>
