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
      height: 100vh;
      display: flex;
      background-color: #f4f6f8;
    }

    .sidebar {
      width: 180px;
      background-color: #001F5B;
      color: white;
      padding: 2rem 1rem;
      display: flex;
      flex-direction: column;
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
      background-color: #003366;
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

    /* Updated table style */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      font-size: 0.8rem; /* smaller text */
    }

    table, th, td {
      border: 1px solid #ccc;
    }

    th, td {
      padding: 0.4rem; /* reduced padding */
      text-align: center;
    }

    th {
      background-color: #001F5B;
      color: white;
    }

    /* Success message */
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

    /* Edit and Delete icon smaller */
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
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>
      <img src="{{ asset('images/logo.png') }}" alt="Logo"> OCD CLMS
    </h2>
    <a href="{{ url('/dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ url('/radiolog/create') }}"><i class="bi bi-journal-plus"></i> Add Radio Log</a>
    <a href="{{ route('radiolog.exportPDF') }}">
      <i class="bi bi-printer"></i> Print Logs
    </a>
    {{-- <a href="{{ route('radiolog.print') }}" target="_blank"><i class="bi bi-printer"></i> Preview</a>  --}}
    <a href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
  

  <!-- Main Content -->
  <div class="content">
    <h1> OCD MIMAROPA RADIO LOGS SYSTEM</h1>

    @if(session()->has('success'))
      <div class="success-message">
        {{ session('success') }}
      </div>
    @endif

    <!-- Live Search Bar -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem; gap: 10px;">
      <input type="text" id="search" placeholder="Search Radio Logs..." 
          style="padding: 8px 12px; height: 42px; width: 300px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
      <button type="button" id="clearSearch" class="btn-add" 
          style="height: 42px; padding: 8px 20px; display: flex; align-items: center; justify-content: center; font-size: 14px; border: none; border-radius: 5px;">
          <i class="bi bi-x-circle" style="margin-right: 5px;"></i> Clear
      </button>
    </div>
    
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
            <th><i class="bi bi-trash"></i> Delete</th> 
          </tr>
        </thead>
        <tbody id="radiolog-table">
          @foreach ($radiologs as $radiolog)
            <tr>
              <td>{{ $radiolog->received_date }}</td>
              <td>{{ $radiolog->received_time }}</td>
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
              
              <td>
                <form method="post" action="{{ route('radiolog.delete', ['radiolog' => $radiolog]) }}">
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

   

      <!-- jQuery and search functionality -->
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
      <div class="mt-4" style="text-align: center;">
        {{ $radiologs->appends(['search' => request('search')])->links('vendor.pagination.simple-icons') }}
      </div>
      
    </div>
  </div>

</body>
</html>
