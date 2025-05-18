<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS - Radio Log</title>
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
            background-color: #030d22;
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
            max-width: 1100px;
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            color:#030d22;
        }

        .form-container h2 {
            grid-column: span 3;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #030d22;
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
            background-color: #030d22;
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
            background-color:  #FF8C00;
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
                <i class="bi bi-journal-text"></i> Radio Log
            </a>
        </div>
    </div>

    <div>
        @if($errors->any())
        <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
        </ul>
        @endif
    </div>
    
    

    <!-- Main Content -->
    <div class="main-content">
        <form action="{{ route('radiolog.update',['radiolog' => $radiolog])}}" method="post" class="form-container">
            @csrf
            @method('put')
            
            
            <h2 style="display: flex; align-items: center; justify-content: center; font-size: 1.75rem; font-weight: bold; color: #333; border-bottom: 2px solid #001F5B; padding-bottom: 0.5rem;">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 2.5rem; width: auto; margin-right: 1rem;">
    UPDATE RADIO LOG ENTRY
</h2>

            <div>
                <label for="received_date" style="color: black;">
                    <i class="bi bi-calendar-date" style="color: rgb(0, 0, 0);"></i> Received Date
                </label>
                <input type="date" name="received_date" id="received_date" value="{{ old('received_date', $radiolog->received_date) }}">
            </div>

                        @php
                        $receivedTime = old('received_time', $radiolog->received_time);
                        if ($receivedTime && strlen($receivedTime) > 5) {
                    $receivedTime = \Carbon\Carbon::createFromFormat('H:i:s', $receivedTime)->format('H:i');
                    }
                    @endphp

            <div>
                 <label for="received_time" style="color: black;">
                    <i class="bi bi-clock" style="color: rgb(0, 0, 0);"></i> Received Time
                </label>
                <input type="time" name="received_time" id="received_time" value="{{ $receivedTime }}">
            </div>

            <div>
                <label for="sender_name" style="color: black;">
                    <i class="bi bi-person-fill" style="color: rgb(0, 0, 0);"></i> Name of Sender
                </label>
                <select name="sender_name" id="sender_name" required>
                    <option value="OCD MIMAROPA | {{ Auth::user()->name }}" {{ old('sender_name', $radiolog->sender_name) == 'OCD MIMAROPA | ' . Auth::user()->name ? 'selected' : '' }}>
                        OCD MIMAROPA | {{ Auth::user()->name }}
                    </option>
                    <option value="OCD Central Office" {{ old('sender_name', $radiolog->sender_name) == 'OCD Central Office' ? 'selected' : '' }}>OCD Central Office</option>
                    <option value="OCD Region I" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region I' ? 'selected' : '' }}>OCD Region I</option>
                    <option value="OCD Region II" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region II' ? 'selected' : '' }}>OCD Region II</option>
                    <option value="OCD Region III" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region III' ? 'selected' : '' }}>OCD Region III</option>
                    <option value="OCD Region IV-A (CALABARZON)" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region IV-A (CALABARZON)' ? 'selected' : '' }}>OCD Region IV-A (CALABARZON)</option>
                    <option value="OCD Region V" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region V' ? 'selected' : '' }}>OCD Region V</option>
                    <option value="OCD Region VI" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region VI' ? 'selected' : '' }}>OCD Region VI</option>
                    <option value="OCD Region VII" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region VII' ? 'selected' : '' }}>OCD Region VII</option>
                    <option value="OCD Region VIII" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region VIII' ? 'selected' : '' }}>OCD Region VIII</option>
                    <option value="OCD Region IX" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region IX' ? 'selected' : '' }}>OCD Region IX</option>
                    <option value="OCD Region X" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region X' ? 'selected' : '' }}>OCD Region X</option>
                    <option value="OCD Region XI" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region XI' ? 'selected' : '' }}>OCD Region XI</option>
                    <option value="OCD Region XII" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region XII' ? 'selected' : '' }}>OCD Region XII</option>
                    <option value="OCD Region XIII (Caraga)" {{ old('sender_name', $radiolog->sender_name) == 'OCD Region XIII (Caraga)' ? 'selected' : '' }}>OCD Region XIII (Caraga)</option>
                    <option value="OCD NCR" {{ old('sender_name', $radiolog->sender_name) == 'OCD NCR' ? 'selected' : '' }}>OCD NCR</option>
                    <option value="OCD CAR" {{ old('sender_name', $radiolog->sender_name) == 'OCD CAR' ? 'selected' : '' }}>OCD CAR</option>
                    <option value="OCD BARMM" {{ old('sender_name', $radiolog->sender_name) == 'OCD BARMM' ? 'selected' : '' }}>OCD BARMM</option>
                    <option value="OCD NIR" {{ old('sender_name', $radiolog->sender_name) == 'OCD NIR' ? 'selected' : '' }}>OCD NIR</option>
                </select>
            </div>
        
            <div>
                <label for="band" style="color: black;">
                    <i class="bi bi-broadcast" style="color: rgb(0, 0, 0);"></i> Band
                </label>
                <select name="band" id="band" required>
                    <option value="">Select Band</option>
                    <option value="UHF" {{ old('band', $radiolog->band) == 'UHF' ? 'selected' : '' }}>UHF</option>
                    <option value="HF" {{ old('band', $radiolog->band) == 'HF' ? 'selected' : '' }}>HF</option>
                </select>
            </div>
            

            <div>
                 <label for="mode" style="color: black;">
                    <i class="bi bi-sliders" style="color: rgb(0, 0, 0);"></i> Mode
                </label>
                <select name="mode" id="mode" required>
                    <option value="">Select Mode</option>
                    <option value="DMR" {{ old('mode', $radiolog->mode) == 'DMR' ? 'selected' : '' }}>DMR</option>
                    <option value="SSB" {{ old('mode', $radiolog->mode) == 'SSB' ? 'selected' : '' }}>SSB</option>
                    <option value="LSB" {{ old('mode', $radiolog->mode) == 'LSB' ? 'selected' : '' }}>LSB</option>
                </select>
            </div>
            

            <div>
                <label for="signal_strength" style="color: black;">
                    <i class="bi bi-reception-4" style="color: rgb(0, 0, 0);"></i> Signal Strength
                </label>
                <select name="signal_strength" id="signal_strength" required>
                    <option value="">Select Signal Strength</option>
                    <option value="Excellent" {{ old('signal_strength', $radiolog->signal_strength) == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                    <option value="Good" {{ old('signal_strength', $radiolog->signal_strength) == 'Good' ? 'selected' : '' }}>Good</option>
                    <option value="Fair" {{ old('signal_strength', $radiolog->signal_strength) == 'Fair' ? 'selected' : '' }}>Fair</option>
                    <option value="Poor" {{ old('signal_strength', $radiolog->signal_strength) == 'Poor' ? 'selected' : '' }}>Poor</option>
                </select>
            </div>
            

            <div>
                  <label for="receiver_name" style="color: black;">
                    <i class="bi bi-person-check-fill" style="color: rgb(0, 0, 0);"></i> Name of Receiver
                </label>
                <select name="receiver_name" id="receiver_name" required>
                    <option value="OCD MIMAROPA | {{ Auth::user()->name }}" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD MIMAROPA | ' . Auth::user()->name ? 'selected' : '' }}>
                        OCD MIMAROPA | {{ Auth::user()->name }}
                    </option>
                    <option value="OCD Central Office" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Central Office' ? 'selected' : '' }}>
                        OCD Central Office
                    </option>
                    <option value="OCD Region I" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region I' ? 'selected' : '' }}>
                        OCD Region I
                    </option>
                    <option value="OCD Region II" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region II' ? 'selected' : '' }}>
                        OCD Region II
                    </option>
                    <option value="OCD Region III" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region III' ? 'selected' : '' }}>
                        OCD Region III
                    </option>
                    <option value="OCD Region IV-A (CALABARZON)" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region IV-A (CALABARZON)' ? 'selected' : '' }}>
                        OCD Region IV-A (CALABARZON)
                    </option>
                    </option>
                    <option value="OCD Region V" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region V' ? 'selected' : '' }}>
                        OCD Region V
                    </option>
                    <option value="OCD Region VI" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region VI' ? 'selected' : '' }}>
                        OCD Region VI
                    </option>
                    <option value="OCD Region VII" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region VII' ? 'selected' : '' }}>
                        OCD Region VII
                    </option>
                    <option value="OCD Region VIII" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region VIII' ? 'selected' : '' }}>
                        OCD Region VIII
                    </option>
                    <option value="OCD Region IX" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region IX' ? 'selected' : '' }}>
                        OCD Region IX
                    </option>
                    <option value="OCD Region X" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region X' ? 'selected' : '' }}>
                        OCD Region X
                    </option>
                    <option value="OCD Region XI" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region XI' ? 'selected' : '' }}>
                        OCD Region XI
                    </option>
                    <option value="OCD Region XII" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region XII' ? 'selected' : '' }}>
                        OCD Region XII
                    </option>
                    <option value="OCD Region XIII (Caraga)" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD Region XIII (Caraga)' ? 'selected' : '' }}>
                        OCD Region XIII (Caraga)
                    </option>
                    <option value="OCD NCR" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD NCR' ? 'selected' : '' }}>
                        OCD NCR
                    </option>
                    <option value="OCD CAR" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD CAR' ? 'selected' : '' }}>
                        OCD CAR
                    </option>
                    <option value="OCD BARMM" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD BARMM' ? 'selected' : '' }}>
                        OCD BARMM
                    </option>
                    <option value="OCD NIR" {{ old('receiver_name', $radiolog->receiver_name) == 'OCD NIR' ? 'selected' : '' }}>
                        OCD NIR
                    </option>
                </select>
            </div>
            
            

            <div class="full-width">
                 <label for="notes_remarks" style="color: black;">
                    <i class="bi bi-journal-text" style="color: rgb(0, 0, 0);"></i> Notes / Remarks
                </label>
                <select name="notes_remarks" id="notes_remarks">
                    <option value="">Select Notes/Remarks</option>
                    <option value="Radio Check / Net Call" {{ old('notes_remarks', $radiolog->notes_remarks) == 'Radio Check / Net Call' ? 'selected' : '' }}>
                        Radio Check / Net Call
                    </option>
                    <option value="Radio Check & Weather Update" {{ old('notes_remarks', $radiolog->notes_remarks) == 'Radio Check & Weather Update' ? 'selected' : '' }}>
                        Radio Check & Weather Update
                    </option>
                    <option value="Incident Follow-up" {{ old('notes_remarks', $radiolog->notes_remarks) == 'Incident Follow-up' ? 'selected' : '' }}>
                        Incident Follow-up
                    </option>
                    <option value="ComEx" {{ old('notes_remarks', $radiolog->notes_remarks) == 'ComEx' ? 'selected' : '' }}>
                        ComEx
                    </option>
                    <option value="Unit Movement" {{ old('notes_remarks', $radiolog->notes_remarks) == 'Unit Movement' ? 'selected' : '' }}>
                        Unit Movement
                    </option>
                </select>
            </div>
            

            <button type="submit">Update Log</button>

        </form>
    </div>

    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

</body>
</html>
