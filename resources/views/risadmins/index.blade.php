<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OCD MIMAROPA E Generated RIS</title>

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
  color: #333333;
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

        /* Make header text smaller and prevent line wrap */
  #record-table th {
    font-size: 11px;           /* Smaller font size */
    white-space: nowrap;       /* Prevent line break */
    text-align: center;
    vertical-align: middle;
    padding: 6px 8px;          /* Optional: tighter padding */
  }

  /* Adjust table data as well */
  #record-table td {
    font-size: 11px;
    text-align: center;
    vertical-align: middle;
  }

  /* Optional: reduce icon size in table cells */
  #record-table i {
    font-size: 14px;
  }

  /* Optional: make the entire table font consistent and compact */
  #record-table {
    font-family: Arial, sans-serif;
  }

  .delete-icon {
    font-size: 12px;
    color: #dc3545;
    border: none;
    background: none;
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

{{-- <a href="{{ route('radiolog.exportPDF') }}">
  <i class="bi bi-printer"></i> Print/Download
</a> comment --}}

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


<!-- Container for Add IComs and Search -->
<div style="display: flex; justify-content: space-between; align-items: center; height: 70px; margin-bottom: 15px;">
  
  <!-- Add IComs Button with Icon -->
  <a href="{{route ('risadmin.create')}}" 
     style="background-color: #b16100; color: white; border: none; padding: 8px 15px; font-size: 14px; 
            border-radius: 5px; text-decoration: none; display: flex; align-items: center;">
    <i class="bi bi-plus-circle" style="margin-right: 8px;"></i> Add e-RIS
  </a>

  <!-- Live Search Section -->
  <div style="display: flex; align-items: center; gap: 10px;">
    <input type="text" id="search" placeholder="Search Radio Logs..." 
           style="padding: 8px 12px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px; height: 42px;">
    <button type="button" id="clearSearch" 
            style="background-color: #007517; color: white; border: none; border-radius: 5px;
                   padding: 0 20px; font-size: 14px; height: 42px; display: flex;
                   align-items: center; justify-content: center; cursor: pointer;">
      <i class="bi bi-x-circle" style="margin-right: 5px;"></i> Clear
    </button>
  </div>
</div>


<!-- 
<div style="background-color: #fff3cd; color: #856404; padding: 10px 15px; border: 1px solid #ffeeba; border-radius: 5px; margin-bottom: 1rem; font-size: 0.85rem;">
  <strong>Note:</strong> The files from <strong>MGB</strong> can't be uploaded due to large file size.
</div> Upload limitation note -->

  
    <div class="table-container">
  <table id="record-table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Name</th>
        <th>Position</th>
        <th>Division/Section</th>
        <th>Agency/Office</th>
        {{-- <th>Unit</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Amount Utilized</th>
        <th>Balance</th>
        <th>Invoice No.</th>
        <th>Plate No.</th>
        <th>Type of Car</th>
        <th>Purpose</th>comment --}}
        <th>Receipt</th>
        <th>Generated e-PDF</th>
        {{-- <th>Delete</th> comment --}}
        {{-- <th>Delete</th> comment --}}
      </tr>
    </thead>
    <tbody>
      @foreach ($risadmincards as $risadmincard)

        <tr>
            <td>{{$risadmincard->date}}</td>
            <td>{{$risadmincard->name}}</td>
            <td>{{$risadmincard->position}}</td>
            <td>{{$risadmincard->division}}</td>
            <td>{{$risadmincard->office_agency}}</td>
             {{--<td>{{$risadmincard->unit}}</td>
            <td>{{$risadmincard->description}}</td>
            <td>{{$risadmincard->quantity}}</td>
            <td>{{$risadmincard->amount_utilized}}</td>
            <td>{{$risadmincard->balance}}</td>
            <td>{{$risadmincard->invoice_number}}</td>
            <td>{{$risadmincard->plate_number}}</td>
            <td>{{$risadmincard->type_car}}</td>
            <td>{{$risadmincard->purpose}}</td>comment --}}
           <td style="text-align: center;">
    @if($risadmincard->file_path)
        @php
            $extension = pathinfo($risadmincard->file_path, PATHINFO_EXTENSION);
            $fileUrl = asset('storage/' . $risadmincard->file_path);
        @endphp

        @if(in_array($extension, ['jpg', 'jpeg', 'png']))
            <a href="{{ $fileUrl }}" target="_blank">
                <img src="{{ $fileUrl }}" alt="Uploaded Image" width="100" style="display: block; margin: 0 auto;">
            </a>
        @else
            <a href="{{ $fileUrl }}" target="_blank" style="display: inline-block;">View PDF File</a>
        @endif
    @else
        No File
    @endif
</td>


<td>
  <a href="{{ route('risadmin.exportSingle', $risadmincard->id) }}" class="btn btn-sm btn-outline-primary" title="View Generated PDF" download>
    <i class="bi bi-file-earmark-pdf-fill">e-PDF</i>
  </a>
</td>


    </td>

    {{-- 
      <td>
          <form action="{{route ('risadmin.delete', ['risadmincard' => $risadmincard])}}" method="post">
            @csrf
            @method ('delete')
            <button type="submit">
              <i class="bi bi-trash delete-icon"></i>
            </button>
          </form>
        </td> comment --}}




        </tr>

        @endforeach
    </tbody>
    {{-- <tbody>
      @foreach ($records as $record)
      <tr>
        <td>{{ \Carbon\Carbon::parse($record->received_date)->format('F j, Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($record->received_time)->format('g:i A') }}</td>
        <td>{{ $record->from_agency_office }}</td>
        <td>{{ $record->type }}</td>
        <td>{{ $record->subject_description }}</td>
        <td>{{ $record->concerned_section_personnel }}</td>
        <td>{{ $record->received_acknowledge_by }}</td>
        <td>
          @if($record->file_path)
          <li class="list-group-item" style="list-style-type: none; padding-left: 0;">
            <a href="{{ route('records.show', $record->id) }}" title="View Files">
              <i class="bi bi-folder-fill text-dark"></i>
            </a>
          </li>
          @else
          <li class="list-group-item" style="list-style-type: none; padding-left: 0;">
            <span class="text-muted"><i class="bi bi-file-earmark-x"></i> No files uploaded</span>
          </li>
          @endif
        </td>
        {{-- <td>
          <form action="{{route ('record.delete', ['record' => $record])}}" method="post">
            @csrf
            @method ('delete')
            <button type="submit">
              <i class="bi bi-trash delete-icon"></i>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>  comment --}}
  </table>

  <!-- Pagination -->
<div class="mt-4" style="text-align: right; padding-right: 10px;">
  {{ $risadmincards->appends(['search' => request('search')])->links('vendor.pagination.simple-icons') }}
</div>
</div>

  </div>
</div>

</div> <!-- End of .table-container -->




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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#search').on('keyup', function() {
      var search = $(this).val();
      $.ajax({
        url: "{{ route('risadmin.index') }}",
        type: "GET",
        data: { search: search },
        success: function(response) {
          // Replace only the table body with the filtered records
          $('table tbody').html($(response.html).find('tbody').html());
        }
      });
    });

    $('#clearSearch').on('click', function() {
      $('#search').val('');
      $('#search').trigger('keyup');
    });
  });
</script>




</body>
</html>
