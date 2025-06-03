<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>

 .dropdown {
    position: relative;
}

.dropdown-toggle::after {
    content: " ▼";
    font-size: 0.6em;
}

.dropdown-menu {
    display: none;
    flex-direction: column;
    background-color: #030d22;
    padding-left: 0.5rem; /* Reduced left padding */
}

.dropdown:hover .dropdown-menu {
    display: flex;
}

.dropdown-item {
    padding: 0.15rem 0; /* Reduced vertical spacing */
    color: #fff; /* Changed to white for contrast with dark background */
    text-decoration: none;
    font-size: 0.9rem; /* Optional: slightly smaller font */
}

.dropdown-item:hover {
    text-decoration: underline;
}

    
    body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        background-color: #eaeaea;
    }

    /* Sidebar Styling */
    .sidebar {
        width: 210px;
        background-color: #030d22;
        color: white;
        position: fixed;
        top: 0;
        bottom: 0;
        padding: 1rem 0;
        margin: 0;
        transition: width 0.3s;
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
        margin: 0 auto;
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

    .main {
        margin-left: 200px;
        padding: 2rem;
    }

    .dashboard {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        align-items: stretch;
    }

    .card, .gender-panel {
        background-color: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        height: 270px; /* Unified panel height */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .card:hover, .gender-panel:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .card h3, .gender-panel h3 {
        font-size: 1.2rem; /* Reduced font size for titles */
        margin-bottom: 1rem;
        color: #333;
    }

    .card p, .gender-panel p {
        font-size: 0.9rem; /* Reduced font size for panel text */
        color: #555;
    }

    .gender-panel canvas {
        max-width: 100%;
        height: 140px !important;
        margin: 0 auto;
    }

    #clock {
        font-size: 1.3rem; /* Slightly reduced font size for clock */
        font-weight: bold;
        color: #FF8C00;
    }

    #dateDisplay {
        font-size: 0.9rem; /* Reduced font size for date */
        color: #888;
        margin-bottom: 1rem;
    }

    .footer {
        margin-left: 200px;
        text-align: center;
        padding: 1rem;
        font-size: 0.8rem;
        color: #555;
    }

    @media (max-width: 768px) {
        .sidebar, .topbar, .main, .footer {
            margin-left: 0;
        }
    }

    .card {
    background-color: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(124, 66, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    width: 100%; /* This will make the card take the full width */
    box-sizing: border-box; /* Ensures padding doesn't affect the width */
}

</style>

</head>
<body>

    <!-- Sidebar -->
<div class="sidebar">
    <img src="{{ asset('images/logo.png') }}" alt="LTMS Logo" class="logo">

    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i> Profile
    </a>

    <a href="{{ route('record.index') }}" class="{{ request()->routeIs('record.index') ? 'active' : '' }}">
        <i class="bi bi-inbox"></i> Incoming Communication
    </a>

    <a href="{{ route('trainingdb.index') }}" class="{{ request()->routeIs('trainingdb.index') ? 'active' : '' }}">
        <i class="bi bi-inbox"></i> Training IMS
    </a>

    <a href="/radiolog" class="{{ request()->is('radiolog') ? 'active' : '' }}">
        <i class="bi bi-journal-text"></i> Radio Log
    </a>

    <!-- Generated Docs Dropdown -->
    <div class="dropdown">
        <a href="#" class="dropdown-toggle">
            <i class="bi bi-file-earmark-text"></i> Generated Docs
        </a>
        <div class="dropdown-menu">
            <a href="{{route ('risadmin.index')}}" class="dropdown-item">e-RIS</a>
            <a href="{{route ('guest.log')}}" class="dropdown-item">e-Certificate of Appearance</a>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
        @csrf
        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </form>
</div>


    <!-- Topbar -->
    <div class="topbar">
    <div>CLMS <strong>| DASHBOARD</strong></div>
    <div>
        {{ date('l, F j, Y') }} - <span id="liveTime"></span>
    </div>
</div>

<!-- Main Content -->
<div class="main">
    <div class="dashboard" style="gap: 1rem; display: flex; flex-wrap: wrap;">

        <!-- Welcome Card -->
 <div class="card" style="flex: 1 1 25%; min-width: 200px; display: flex; flex-direction: column;">
    <div style="flex: 1; overflow-y: auto; padding-right: 5px; font-size: 0.75rem;">
        <h3 style="font-weight: bold; font-size: .9rem;">WELCOME, {{ Auth::user()->name }}!</h3>
        <p style="margin-bottom: 0.5rem;">You're successfully logged in! Use the dashboard below to manage communication logs, 
                                                                    track records, view reminders, and access all system features.</p>

        <h5 style="font-weight: bold; font-size: 0.8rem; margin-top: 0.75rem;">Date</h5>
        <div id="dateDisplay"></div>

        <h5 style="font-weight: bold; font-size: 0.8rem; margin-top: 0.5rem;">Time</h5>
        <div id="clock"></div>
    </div>
</div>


        <!-- Documents for Review Card - Wider and Larger -->
        <div class="card p-3 mb-4" style="flex: 2 1 50%; min-width: 400px; max-height: 500px; overflow-y: auto; ">
             <h3 style="font-weight: bold; font-size: 1rem;">Reminder Notes/Memos</h3>
 
            
            @if ($myAssignedRecords->isEmpty())
                <p class="text-muted">No records assigned to you.</p>
            @else
                <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                    @foreach ($myAssignedRecords as $record)
                        <li class="list-group-item">
                            <strong style="color:  #FF8C00">{{ $record->subject_description }}</strong><br>
                            <small class="text-muted">
                                <small>From: {{ $record->from_agency_office }}</small> |
                                <small>Type: {{ $record->type }}</small>
                            </small><br>

                        <small>
                            @if ($record->file_path || $record->file_path1 || $record->file_path2)
                                <a href="{{ route('records.show', $record->id) }}" title="View All Files">
                                    <i class="fas fa-paperclip" style="color: #007bff;"></i> View Files
                                </a>
                            @else
                                <span class="text-muted"><i class="fas fa-paperclip"></i> No Attachments</span>
                            @endif
                        </small>

                        </li>

                        @if (!$loop->last)
                            <hr style="border: 1px dotted rgb(221, 221, 221); margin: 5px 0;">

                        @endif
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Gender Distribution Panel -->
        <div class="gender-panel" style="flex: 1 1 25%; min-width: 200px;">
             <h3 style="font-weight: bold; font-size: 0.9rem;">OCD MIMAROPA Employee Gender Distribution</h3>
            <p>Total Employees: 21</p>
            <canvas id="genderChart" width="200" height="200"></canvas>
        </div>

        <!-- Incoming Communications Overview -->
        <div class="card" style="flex: 1 1 25%; min-width: 200px;">
            <h3 style="font-weight: bold; font-size: 1rem;">Incoming Communications Overview</h3>
            
            <div class="row">
                <div class="col">
                    <p><span style="color: #007bff; font-weight: bold;">Reports:</span> {{ $typeCounts['Report'] }}</p>
                    <p><span style="color: #007bff; font-weight: bold;">Request:</span> {{ $typeCounts['Request'] }}</p>
                    <p><span style="color: #007bff; font-weight: bold;">Submission:</span> {{ $typeCounts['Submission'] }}</p>
                </div>
                <div class="col">
                    <p><span style="color: #007bff; font-weight: bold;">Invitation:</span> {{ $typeCounts['Invitation'] }}</p>
                    <p><span style="color: #007bff; font-weight: bold;">For Information:</span> {{ $typeCounts['For Information'] }}</p>
                </div>
                <div class="col">
                    <p><span style="color: #007bff; font-weight: bold;">For Compliance:</span> {{ $typeCounts['For Compliance'] }}</p>
                    <p><span style="color: #007bff; font-weight: bold;">Complaint:</span> {{ $typeCounts['Complaint'] }}</p>
                </div>
            </div>
        </div>

        <!-- Radio Logs Totals Line Chart -->
        <div class="card" style="flex: 1 1 25%; min-width: 200px;">
             <h3 style="font-weight: bold; font-size: 1rem;">Radio Logs Overview</h3>
            <canvas id="radioLogsChart" style="max-height: 200px;"></canvas>
        </div>


    </div>
</div>




<!-- Footer -->
<footer class="footer">
    Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © 2025
</footer>

    <!-- Scripts -->
    <script>
        function updateDateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            const dateString = now.toLocaleDateString(undefined, {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            document.getElementById('clock').textContent = timeString;
            document.getElementById('dateDisplay').textContent = dateString;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>

    <script>
        const ctx = document.getElementById('genderChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Male (12)', 'Female (9)'],
                datasets: [{
                    data: [12, 9],
                    backgroundColor: ['#007bff', '#e83e8c'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let value = context.parsed;
                                let percentage = ((value / total) * 100).toFixed(1) + '%';
                                return `${context.label}: ${value} (${percentage})`;
                            }
                        }
                    }
                }
            }
        });
    </script>

   <script>
    const radioLogsCtx = document.getElementById('radioLogsChart').getContext('2d');

    new Chart(radioLogsCtx, {
        type: 'line',
        data: {
            labels: ['Total Radio Logs', 'Incoming From CO', 'My Coms Log'],
            datasets: [{
                label: 'Radio Logs Count',
                data: [
                    {{ $totalRadioLogs }},
                    {{ $totalIncomingCentral }},
                    {{ $totalMyComsLogs }}
                ],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                fill: true,
                tension: 0.3,
                pointBackgroundColor: '#007bff',
                pointBorderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        font: {
                            size: 10
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 10
                        }
                    }
                }
            }
        }
    });
</script>

<script>
  function updateLiveTime() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    const timeString = `${hours}:${minutes}:${seconds}`;
    document.getElementById('liveTime').textContent = timeString;
  }

  // Update time immediately and every second
  updateLiveTime();
  setInterval(updateLiveTime, 1000);
</script>

</body>
</html>
