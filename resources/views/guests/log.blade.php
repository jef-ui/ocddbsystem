<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>OCD MIMAROPA Guests Database</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"/>

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
      margin-top: 60px;
    }

    .sidebar {
      width: 230px;
      background-color: #030d22;
      color: white;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      padding: 1rem 0;
      z-index: 1000;
      overflow-y: auto;
      transition: width 0.3s ease;
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

    .topbar {
      position: fixed;
      top: 0;
      left: 230px; /* match full width of sidebar on hover */
      right: 0;
      height: 60px;
      background-color: white;
      border-bottom: 1px solid #ccc;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 1.5rem;
      font-size: 0.9rem;
      z-index: 1001;
      transition: left 0.3s ease;
    }

    .topbar a {
      color: #333;
      margin-left: 1rem;
      text-decoration: none;
    }

    .topbar a:hover {
      color: #FF8C00;
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

    .content {
      margin-left: 230px; /* match full width of sidebar on hover */
      flex: 1;
      padding: 2rem;
      padding-top: 1rem;
      overflow-y: auto;
      transition: margin-left 0.3s ease;
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
      background-color: #101010;
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
      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Log Out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>

    <!-- Topbar -->
    <div class="topbar">
      <div><strong>COMMUNICATION LOGGING MANAGEMENT SYSTEM</strong></div>
      <div>{{ date('l, F j, Y') }} - <span id="liveTime"></span></div>
    </div>

    <!-- Content -->
    <div class="content">
      @if(session()->has('success'))
        <div class="success-message">
          {{ session('success') }}
        </div>
      @endif

<!-- Container for Add IComs and Search -->
<div style="display: flex; justify-content: space-between; align-items: center; height: 70px; margin-bottom: 15px;">
  
  <!-- Add IComs Button with Icon -->
  <a href="{{route ('guest.create')}}" 
     style="background-color: #b16100; color: white; border: none; padding: 8px 15px; font-size: 14px; 
            border-radius: 5px; text-decoration: none; display: flex; align-items: center;">
    <i class="bi bi-plus-circle" style="margin-right: 8px;"></i> Add e-CA
  </a>

  <!-- Live Search Section -->
  <div style="display: flex; align-items: center; gap: 10px;">
    {{-- <input type="text" id="search" placeholder="Search Radio Logs..." 
           style="padding: 8px 12px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px; height: 42px;">
    <button type="button" id="clearSearch" 
            style="background-color: #007517; color: white; border: none; border-radius: 5px;
                   padding: 0 20px; font-size: 14px; height: 42px; display: flex;
                   align-items: center; justify-content: center; cursor: pointer;">
      <i class="bi bi-x-circle" style="margin-right: 5px;"></i> Clear comment --}}
    </button> </div>
  
</div>


      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Full Name</th>
              <th>Agency</th>
              <th>Position</th>
              <th>Gender</th>
              <th>Purpose of Visit</th>
              <th>Signature</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($requestlogs as $requestlog)
            <tr>
              <td>{{ $requestlog->date_of_visit }}</td>
              <td>{{ $requestlog->name }}</td>
              <td>{{ $requestlog->agency }}</td>
              <td>{{ $requestlog->position }}</td>
              <td>{{ $requestlog->gender }}</td>
              <td>{{ $requestlog->purpose_of_visit }}</td>
              <td>
                @if($requestlog->e_signature)
                  <img src="{{ $requestlog->e_signature }}" alt="Signature" style="height: 60px;">
                @else
                  No Signature
                @endif
              </td>
              <td>
                <form method="post" action="{{ route('guest.delete', ['guest' => $requestlog->id]) }}">
                  @csrf
                  @method('delete')
                  <button type="submit">
                    <i class="bi bi-trash delete-icon"></i>
                  </button>
                </form>
              </td>
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

  <!-- Live Clock Script -->
  <script>
    function updateTime() {
      const now = new Date();
      document.getElementById('liveTime').textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000);
    updateTime();
  </script>
</body>
</html>
