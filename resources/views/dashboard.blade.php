<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f4f6f9;
    }

    /* Sidebar Styling */
    .sidebar {
        width: 200px;
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
        font-size: 1.8rem; /* Slightly reduced font size for clock */
        font-weight: bold;
        color: #FF8C00;
        margin-top: 1rem;
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

    <a href="/radiolog" class="{{ request()->is('radiolog') ? 'active' : '' }}">
        <i class="bi bi-journal-text"></i> Radio Log
    </a>

    <a href="{{ route('record.index') }}" class="{{ request()->routeIs('record.index') ? 'active' : '' }}">
        <i class="bi bi-inbox"></i> Incoming
    </a>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
        @csrf
        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </form>
</div>


    <!-- Topbar -->
    <div class="topbar">
    <div><strong>COMMUNICATION LOGGING MANAGEMENT SYSTEM</strong></div>
    <div>
        {{ date('l, F j, Y') }} - <span id="liveTime"></span>
    </div>
</div>

    <!-- Main Content -->
   <div class="main">
    <div class="dashboard" style="gap: 1rem;">
        <!-- Welcome Card -->
        <div class="card">
    <h3 style="font-weight: bold;">Welcome, {{ Auth::user()->name }}!</h3>
    <p>You're successfully logged in! Manage your communication logs, track records, and access all system features.</p>
</div>


        <!-- Date & Time Card -->
        <div class="card">
            <h3>📅 Date</h3>
            <div id="dateDisplay"></div>

            <h3>🕒 Time</h3>
            <div id="clock"></div>
        </div>

        <!-- Gender Chart -->
        <div class="gender-panel">
            <h3>👩‍💼 Employee Gender Distribution</h3>
            <p>Total Employees: 21</p>
            <canvas id="genderChart" width="200" height="200"></canvas>
        </div>

        <!-- Incoming Summary -->
        <div class="card">
            <h3>📥 Incoming Communications Summary</h3>
            <p>Total Report: ...</p>
            <p>Total Submission: ...</p>
            <p>For Information: ... </p>
            <p>For Compliance: ... </p>
            <p>Complaint: ...</p>
        </div>

        <!-- Radiologs Totals Line Chart -->
<div class="card" style="height: 320px;">
    <h3 style="font-size: 1rem;">📈 Radio Logs Totals Overview</h3>
    <canvas id="radioLogsChart" style="max-height: 220px;"></canvas>
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
