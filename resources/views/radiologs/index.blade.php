<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OCD MIMAROPA RADIO LOGS SYSTEM</title>

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
  border: 1px solid #c1c1c1;
}


th, td {
  padding: 0.4rem;
  text-align: center;
}

th {
  background-color: #030d22;
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
    <div><strong>CLMS - RADIO LOGS</strong></div>
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


    <!-- Dashboard Cards and Search Bar -->
    <!-- Dashboard Cards and Search Bar -->
<div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 1rem;">

  <div style="flex: 1 1 150px; background-color: #b16100; color: white; padding: 0.8rem; border-radius: 8px;
              text-align: center; height: 70px; display: flex; flex-direction: column; justify-content: center;">
    <a href="{{ url('/radiolog/create') }}" style="color: white; text-decoration: none; font-weight: bold;">
      <i class="bi bi-journal-plus" style="margin-right: 5px;"></i> Add Radio Log
    </a>
  </div>

  <div style="flex: 1 1 180px; background-color: #005a8d; color: white; padding: 0.8rem; border-radius: 8px;
              text-align: center; height: 70px; display: flex; flex-direction: column; justify-content: center;">
    <div style="font-size: 1.2rem; font-weight: bold;">
      <i class="bi bi-chat-dots" style="margin-right: 5px;"></i> {{ $totalMyComsLogs }}
    </div>
    <div style="font-size: 0.8rem;">My COMS Logs</div>
  </div>

  <div style="flex: 1 1 180px; background-color: #001F5B; color: white; padding: 0.8rem; border-radius: 8px;
              text-align: center; height: 70px; display: flex; flex-direction: column; justify-content: center;">
    <div style="font-size: 1.2rem; font-weight: bold;">
      <i class="bi bi-collection" style="margin-right: 5px;"></i> {{ $totalRadioLogs }}
    </div>
    <div style="font-size: 0.8rem;">Total Radio Logs</div>
  </div>

  <div style="flex: 1 1 220px; background-color: #353535; color: white; padding: 0.8rem; border-radius: 8px;
              text-align: center; height: 70px; display: flex; flex-direction: column; justify-content: center;">
    <div style="font-size: 1.2rem; font-weight: bold;">
      <i class="bi bi-broadcast-pin" style="margin-right: 5px;"></i> {{ $totalIncomingCentral }}
    </div>
    <div style="font-size: 0.8rem;">Incoming Radio from CO</div>
  </div>

  <div style="flex: 1 1 300px; display: flex; align-items: center; gap: 5px; height: 70px;">
    <input type="text" id="search" placeholder="Search Radio Logs..."
           style="flex: 1; padding: 8px 12px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px; height: 42px;">
    <button type="button" id="clearSearch"
            style="background-color: #007517; color: white; border: none; border-radius: 5px;
                   padding: 0 20px; font-size: 14px; height: 42px; display: flex;
                   align-items: center; justify-content: center; cursor: pointer;">
      <i class="bi bi-x-circle" style="margin-right: 5px;"></i> Clear
    </button>
  </div>

</div>


    <!-- Table -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th><i class="bi bi-calendar-date"></i> Date</th>
            <th><i class="bi bi-clock"></i> Time</th>
            <th><i class="bi bi-person"></i> Name of Sender</th>
            <th><i class="bi bi-wifi"></i> Band</th>
            <th><i class="bi bi-gear"></i> Mode</th>
            <th><i class="bi bi-signal"></i> Signal Strength</th>
            <th><i class="bi bi-person-lines-fill"></i> Receiver Name</th>
            <th><i class="bi bi-file-earmark-text"></i> Notes / Remarks</th>
            <th><i class="bi bi-pencil-square"></i> Edit</th>
           {{--   <th><i class="bi bi-trash"></i> Delete</th>  --}} 
          </tr>
        </thead>
        <tbody id="radiolog-table">
          @foreach ($radiologs as $radiolog)
            <tr>
              <td>{{ \Carbon\Carbon::parse($radiolog->received_date)->format('F j, Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($radiolog->received_time)->format('h:i A') }}</td>
              <td>{{ $radiolog->sender_name }}</td>
              <td>{{ $radiolog->band }}</td>
              <td>{{ $radiolog->mode }}</td>
              <td>{{ $radiolog->signal_strength }}</td>
              <td>{{ $radiolog->receiver_name }}</td>
              <td>{{ $radiolog->notes_remarks }}</td>
              <td>
                <a href="{{ route('radiolog.edit', ['radiolog' => $radiolog]) }}">
                  <i class="bi bi-pencil-square"></i>
                </a>
              </td>
              {{--   <td>

                
                <form method="post" action="{{ route('radiolog.delete', ['radiolog' => $radiolog]) }}">
                  @csrf
                  @method('delete')
                  <button type="submit">
                    <i class="bi bi-trash delete-icon"></i>
                  </button>
                </form>
                
              </td>--}} 
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Search functionality -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
        $(document).ready(function() {
          $('#search').on('keyup', function() {
            var search = $(this).val();
            $.ajax({
              url: "{{ route('radiolog.index') }}",
              type: "GET",
              data: { search: search },
              success: function(response) {
                $('#radiolog-table').html($(response).find('#radiolog-table').html());
              }
            });
          });

          $('#clearSearch').on('click', function() {
            $('#search').val('');
            $('#search').trigger('keyup');
          });
        });
      </script>

      <!-- Pagination -->
      <div class="mt-4" style="text-align: right; padding-right: 10px;">
        {{ $radiologs->appends(['search' => request('search')])->links('vendor.pagination.simple-icons') }}
      </div>
      
      
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
