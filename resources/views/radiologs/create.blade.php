<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS - New Radio Log</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    


    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('{{ asset('images/bg_1.png') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background-color: #001F5B;
            color: white;
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar a {
            color: white;
            margin-left: 1rem;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .topbar a:hover {
            color: orange;
            
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 3rem 1rem;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 8px;
            max-width: 1100px;
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            color: #001F5B;
        }

        .form-container h2 {
            grid-column: span 3;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #001F5B;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        label {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
            display: block;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            background-color: white;
        }

        .full-width {
            grid-column: span 3;
        }

        button {
            background-color: #001F5B;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            grid-column: span 3;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #003366;
        }

        .footer {
            background-color: white;
            color: #003366;
            text-align: center;
            font-size: 12px;
            padding: 10px 0;
        }
        
    </style>
</head>
<body>

    <!-- Topbar -->
    <div class="topbar">
        <div class="flex items-center space-x-3">
            <a href="{{ route('profile.edit') }}">
                <i class="bi bi-person-circle"></i> <strong>PROFILE</strong>
            </a>
        </div>
        <div>
            <a href="/radiolog">
                <i class="bi bi-journal-text"></i> RADIO LOG SYSTEM
            </a>
            
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="bi bi-box-arrow-right"></i> LOG OUT
                </a>
            </form>
        </div>
    </div>
    
    

    <!-- Main Content -->
    <div class="main-content">
        <form action="{{ route('radiolog.store')}}" method="post" class="form-container">
            @csrf
            
            <div>
                @if($errors->any())
                <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                </ul>
                @endif
            </div>
            

            <h2 style="display: flex; align-items: center; justify-content: center; font-size: 1.75rem; font-weight: bold; color: #333;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 2.5rem; width: auto; margin-right: 1rem;">
                NEW RADIO LOG ENTRY
            </h2>
            
            <div>
                <label for="received_date" style="color: black;">
                    <i class="bi bi-calendar-date" style="color: orange;"></i> Received Date
                </label>
                <input type="date" name="received_date" id="received_date" value="{{ old('received_date') }}" required>
            </div>
            
            <div>
                <label for="received_time" style="color: black;">
                    <i class="bi bi-clock" style="color: orange;"></i> Received Time
                </label>
                <input type="time" name="received_time" id="received_time" value="{{ old('received_time') }}" required>
            </div>
            
            <div>
                <label for="sender_name" style="color: black;">
                    <i class="bi bi-person-fill" style="color: orange;"></i> Name of Sender
                </label>
                <select name="sender_name" id="sender_name" required>
                    <option value="OCD Central Office" selected>OCD Central Office</option>
                    <option value="OCD MIMAROPA | {{ Auth::user()->name }}" {{ old('sender_name') == 'OCD MIMAROPA | ' . Auth::user()->name ? 'selected' : '' }}>OCD MIMAROPA | {{ Auth::user()->name }}</option>
                    <option value="OCD Region I">OCD Region I</option>
                    <option value="OCD Region II">OCD Region II</option>
                    <option value="OCD Region III">OCD Region III</option>
                    <option value="OCD Region IV-A (CALABARZON)">OCD Region IV-A (CALABARZON)</option>
                    <option value="OCD Region V">OCD Region V</option>
                    <option value="OCD Region VI">OCD Region VI</option>
                    <option value="OCD Region VII">OCD Region VII</option>
                    <option value="OCD Region VIII">OCD Region VIII</option>
                    <option value="OCD Region IX">OCD Region IX</option>
                    <option value="OCD Region X">OCD Region X</option>
                    <option value="OCD Region XI">OCD Region XI</option>
                    <option value="OCD Region XII">OCD Region XII</option>
                    <option value="OCD Region XIII (Caraga)">OCD Region XIII (Caraga)</option>
                    <option value="OCD NCR">OCD NCR</option>
                    <option value="OCD CAR">OCD CAR</option>
                    <option value="OCD BARMM">OCD BARMM</option>
                    <option value="OCD NIR">OCD NIR</option>
                </select>
            </div>
            
            <div>
                <label for="band" style="color: black;">
                    <i class="bi bi-broadcast" style="color: orange;"></i> Band
                </label>
                <select name="band" id="band" required>
                    <option value="" disabled {{ old('band') ? '' : 'selected' }}>Select Band</option>
                    <option value="UHF" {{ old('band', 'UHF') == 'UHF' ? 'selected' : '' }}>UHF</option>
                    <option value="HF" {{ old('band') == 'HF' ? 'selected' : '' }}>HF</option>
                </select>
            </div>
            
            <div>
                <label for="mode" style="color: black;">
                    <i class="bi bi-sliders" style="color: orange;"></i> Mode
                </label>
                <select name="mode" id="mode" required>
                    <option value="" disabled {{ old('mode') ? '' : 'selected' }}>Select Mode</option>
                    <option value="DMR" {{ old('mode', 'DMR') == 'DMR' ? 'selected' : '' }}>DMR</option>
                    <option value="SSB" {{ old('mode') == 'SSB' ? 'selected' : '' }}>SSB</option>
                    <option value="LSB" {{ old('mode') == 'LSB' ? 'selected' : '' }}>LSB</option>
                </select>
            </div>
            
            <div>
                <label for="signal_strength" style="color: black;">
                    <i class="bi bi-reception-4" style="color: orange;"></i> Signal Strength
                </label>
                <select name="signal_strength" id="signal_strength" required>
                    <option value="" disabled {{ old('signal_strength') ? '' : 'selected' }}>Select Signal Strength</option>
                    <option value="Excellent" {{ old('signal_strength', 'Excellent') == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                    <option value="Good" {{ old('signal_strength') == 'Good' ? 'selected' : '' }}>Good</option>
                    <option value="Fair" {{ old('signal_strength') == 'Fair' ? 'selected' : '' }}>Fair</option>
                    <option value="Poor" {{ old('signal_strength') == 'Poor' ? 'selected' : '' }}>Poor</option>
                </select>
            </div>
            
            <div>
                <label for="receiver_name" style="color: black;">
                    <i class="bi bi-person-check-fill" style="color: orange;"></i> Name of Receiver
                </label>
                <select name="receiver_name" id="receiver_name" required>
                    <option value="OCD MIMAROPA | {{ Auth::user()->name }}" selected>OCD MIMAROPA | {{ Auth::user()->name }}</option>
                    <option value="OCD Central Office">OCD Central Office</option>
                    <option value="OCD Region I">OCD Region I</option>
                    <option value="OCD Region II">OCD Region II</option>
                    <option value="OCD Region III">OCD Region III</option>
                    <option value="OCD Region IV-A (CALABARZON)">OCD Region IV-A (CALABARZON)</option>
                    <option value="OCD Region V">OCD Region V</option>
                    <option value="OCD Region VI">OCD Region VI</option>
                    <option value="OCD Region VII">OCD Region VII</option>
                    <option value="OCD Region VIII">OCD Region VIII</option>
                    <option value="OCD Region IX">OCD Region IX</option>
                    <option value="OCD Region X">OCD Region X</option>
                    <option value="OCD Region XI">OCD Region XI</option>
                    <option value="OCD Region XII">OCD Region XII</option>
                    <option value="OCD Region XIII (Caraga)">OCD Region XIII (Caraga)</option>
                    <option value="OCD NCR">OCD NCR</option>
                    <option value="OCD CAR">OCD CAR</option>
                    <option value="OCD BARMM">OCD BARMM</option>
                    <option value="OCD NIR">OCD NIR</option>
                </select>
            </div>
            
            <div class="full-width">
                <label for="notes_remarks" style="color: black;">
                    <i class="bi bi-journal-text" style="color: orange;"></i> Notes / Remarks
                </label>
                <select name="notes_remarks" id="notes_remarks">
                    <option value="" disabled {{ old('notes_remarks') ? '' : 'selected' }}>Select Notes/Remarks</option>
                    <option value="Radio Check & Weather Update" {{ old('notes_remarks', 'Radio Check & Weather Update') == 'Radio Check & Weather Update' ? 'selected' : '' }}>Radio Check & Weather Update</option>
                    <option value="Radio Check / Net Call" {{ old('notes_remarks', 'Radio Check & Weather Update') == 'Radio Check / Net Call' ? 'selected' : '' }}>Radio Check / Net Call</option>
                    <option value="Incident Follow-up" {{ old('notes_remarks') == 'Incident Follow-up' ? 'selected' : '' }}>Incident Follow-up</option>
                    <option value="ComEx" {{ old('notes_remarks') == 'ComEx' ? 'selected' : '' }}>ComEx</option>
                    <option value="Unit Movement" {{ old('notes_remarks') == 'Unit Movement' ? 'selected' : '' }}>Unit Movement</option>
                </select>
            </div>
            
            

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save-fill" style="color: orange;"></i> SAVE RADIO LOG
            </button>
            

        </form>
    </div>

    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

</body>
</html>
