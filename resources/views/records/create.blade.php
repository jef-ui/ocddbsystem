<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCD CLMS - Incoming Communication</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    


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
        color: black; /* changed from #001F5B */
    }

    .form-container h2 {
        grid-column: span 3;
        text-align: center;
        font-size: 2rem;
        margin-bottom: 1rem;
        color: black; /* changed from #001F5B */
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
        background-color: #FF8C00;
    }

    .footer {
        background-color: white;
        color: #003366;
        text-align: center;
        font-size: 12px;
        padding: 10px 0;
    }

    @media (max-width: 768px) {
    .form-container {
        grid-template-columns: 1fr !important;
        padding: 1.5rem 1rem;
    }

    .form-container h2 {
        grid-column: span 1 !important;
        font-size: 1.5rem;
        flex-direction: column;
        gap: 0.25rem;
    }

    .full-width,
    button {
        grid-column: span 1 !important;
    }

    label {
        font-size: 0.85rem;
    }

    input,
    select {
        font-size: 1rem;
    }
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
            <a href="{{route ('record.index')}}">
                <i class="bi bi-journal-text"></i> Incoming Communications
            </a>
            
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Log Out
                </a>
            </form>
        </div>
    </div>
    
    

    <!-- Main Content -->
    <div class="main-content">
        <form action="{{route('record.store')}}" method="post" class="form-container" enctype="multipart/form-data">
            @csrf
            @method('post')
            
            <div>
                @if($errors->any())
                <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                </ul>
                @endif
            </div>
            
            <h2 style="display: flex; align-items: center; justify-content: center; font-size: 1.75rem; font-weight: bold; color: #333; border-bottom: 2px solid #001F5B; padding-bottom: 0.5rem;">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 2.5rem; width: auto; margin-right: 1rem;">
    ADD INCOMING COMMUNICATION
</h2>
            <div class="mb-3">
                <label for="received_date" class="form-label">
                    <i class="bi bi-calendar-date"></i> Received Date
                </label>
                <input type="date" name="received_date" id="received_date" value="{{ old('received_date') }}" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="received_time" class="form-label">
                    <i class="bi bi-clock"></i> Received Time
                </label>
                <input type="time" name="received_time" id="received_time" value="{{ old('received_time') }}" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="received_via" class="form-label">
                    <i class="bi bi-envelope-paper-fill"></i> Received Via
                </label>
                <select name="received_via" id="received_via" class="form-select" required>
                    <option value="">-- Please select --</option>
                    <option value="Yahoo Mail" {{ old('received_via') == 'Yahoo Mail' ? 'selected' : '' }}>Yahoo Mail</option>
                    <option value="Gov Mail" {{ old('received_via') == 'Gov Mail' ? 'selected' : '' }}>Gov Mail</option>
                    <option value="Fax" {{ old('received_via') == 'Fax' ? 'selected' : '' }}>Fax</option>
                    <option value="LBC" {{ old('received_via') == 'LBC' ? 'selected' : '' }}>LBC</option>
                    <option value="JNT" {{ old('received_via') == 'JNT' ? 'selected' : '' }}>JNT</option>
                    <option value="JRS" {{ old('received_via') == 'JRS' ? 'selected' : '' }}>JRS</option>
                    <option value="HAND CARRIED" {{ old('received_via') == 'HAND CARRIED' ? 'selected' : '' }}>HAND CARRIED</option>
                    
                </select>
            </div>
            
            <div class="mb-3">
                <label for="from_agency_office" class="form-label">
                    <i class="bi bi-building"></i> From Agency/Office
                </label>
                <input type="text" id="from_agency_office" name="from_agency_office" value="{{ old('from_agency_office') }}" class="form-control" required>
            </div>
                    
                <div class="mb-3">
            <label for="type" class="form-label">
                <i class="bi bi-tag-fill"></i> Type
            </label>
            <select id="type" name="type" class="form-select" required>
                <option value="">-- Please select --</option>
                <option value="Advisories" {{ old('type') == 'Advisories' ? 'selected' : '' }}>Advisories</option>
                <option value="Request" {{ old('type') == 'Request' ? 'selected' : '' }}>Request</option>
                <option value="Invitation" {{ old('type') == 'Invitation' ? 'selected' : '' }}>Invitation</option>
                <option value="Submission" {{ old('type') == 'Submission' ? 'selected' : '' }}>Submission</option>
                <option value="For Information" {{ old('type') == 'For Information' ? 'selected' : '' }}>For Information</option>
                <option value="For Compliance" {{ old('type') == 'For Compliance' ? 'selected' : '' }}>For Compliance</option>
                <option value="Report" {{ old('type') == 'Report' ? 'selected' : '' }}>Report</option>
                <option value="Complaint" {{ old('type') == 'Complaint' ? 'selected' : '' }}>Complaint</option>
            </select>
        </div>

            
            <div class="mb-3">
                <label for="subject_description" class="form-label">
                    <i class="bi bi-chat-left-text-fill"></i> Subject / Description
                </label>
                <input type="text" id="subject_description" name="subject_description" value="{{ old('subject_description') }}" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="received_acknowledge_by" class="form-label">
                    <i class="bi bi-person-check-fill"></i> Received Acknowledged By
                </label>
                <select name="received_acknowledge_by" id="received_acknowledge_by" class="form-select" required>
                    <option value="{{ Auth::user()->name }}" selected>{{ Auth::user()->name }}</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="status_as_of_date" class="form-label">
                    <i class="bi bi-calendar-check-fill"></i> Status as of
                </label>
                <input type="date" name="status_as_of_date" id="status_as_of_date" value="{{ old('status_as_of_date') }}" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="action_taken" class="form-label">
                    <i class="bi bi-clipboard-check-fill"></i> Actions Taken
                </label>
                <select id="action_taken" name="action_taken" class="form-select" required>
                    <option value="Acknowledged and forwarded to concerned personnel" {{ old('type') == 'Acknowledged and forwarded to concerned personnel' ? 'selected' : '' }}>Acknowledged and forwarded to concerned section/personnel</option>
                    {{-- <option value="Acknowledged and forwarded to OCD OpCen email" {{ old('type') == 'Acknowledged and forwarded to OCD OpCen email' ? 'selected' : '' }}>Acknowledged and forwarded to OCD OpCen email</option>
                    <option value="Acknowledged and forwarded to DPS" {{ old('type') == 'Acknowledged and forwarded to DPS' ? 'selected' : '' }}>Acknowledged and forwarded to DPS</option>
                    <option value="Acknowledged and forwarded to HRMU" {{ old('type') == 'Acknowledged and forwarded to HRMU' ? 'selected' : '' }}>Acknowledged and forwarded to HRMU</option>
                    <option value="Acknowledged and forwarded to LGUs" {{ old('type') == 'Acknowledged and forwarded to LGUs' ? 'selected' : '' }}>Acknowledged and forwarded to LGUs</option> comment --}}
                </select>
            </div>
            
            <div class="mb-3">
                <label for="concerned_section_personnel" class="form-label" required>
    <i class="bi bi-diagram-3-fill"></i> Concerned Section/Personnel
</label>
<select id="concerned_section_personnel" name="concerned_section_personnel" class="form-select" required>
    <option value="">-- Please select --</option>
                    <option value="Operations Section" {{ old('type') == 'Operations Section' ? 'selected' : '' }}>Operations Section (SitReps,Advisories & etc...)</option>
                    <option value="Administrative and Financial Management Section" {{ old('type') == 'Administrative and Financial Management Section' ? 'selected' : '' }}>Administrative and Financial Management Section</option>
                    <option value="Policy Development and Planning Section" {{ old('type') == 'Policy Development and Planning Section' ? 'selected' : '' }}>Policy Development and Planning Section</option>
                    <option value="Disaster Preparedness Section" {{ old('type') == 'Disaster Preparedness Section' ? 'selected' : '' }}>Disaster Preparedness Section</option>
                    <option value="Marc Rembrandt P. Victore" {{ old('type') == 'Marc Rembrandt P. Victore' ? 'selected' : '' }}>Marc Rembrandt P. Victore</option>
                    <option value="Aquilino P. Ducay" {{ old('type') == 'Aquilino P. Ducay' ? 'selected' : '' }}>Aquilino P. Ducay</option>
                    <option value="Almarose S. Tabliago" {{ old('type') == 'Almarose S. Tabliago' ? 'selected' : '' }}>Almarose S. Tabliago</option>
                    <option value="Maria Aiza S. Siason" {{ old('type') == 'Maria Aiza S. Siason' ? 'selected' : '' }}>Maria Aiza S. Siason</option>
                    <option value="Jommel Merano" {{ old('type') == 'Jommel Merano' ? 'selected' : '' }}>Jommel Merano</option>
                    <option value="Lilia Guevarra" {{ old('type') == 'Lilia Guevarra' ? 'selected' : '' }}>Lilia Guevarra</option>
                    <option value="Mary An B. Aceveda" {{ old('type') == 'Mary An B. Aceveda' ? 'selected' : '' }}>Mary An B. Aceveda</option>
                    <option value="Jonalyn Pagcaliwagan" {{ old('type') == 'Jonalyn Pagcaliwagan' ? 'selected' : '' }}>Jonalyn Pagcaliwagan</option>'
                    <option value="Efril F. Maranan" {{ old('type') == 'Efril F. Maranan' ? 'selected' : '' }}>Efril F. Maranan</option>
                    <option value="Jervis Lloyd M. Atilano" {{ old('type') == 'Jervis Lloyd M. Atilano' ? 'selected' : '' }}>Jervis Lloyd M. Atilano</option>
                    <option value="Glory Balegan" {{ old('type') == 'Glory Balegan' ? 'selected' : '' }}>Glory Balegan</option>
                    <option value="Minerva R. Alcaraz" {{ old('type') == 'Minerva R. Alcaraz' ? 'selected' : '' }}>Minerva R. Alcaraz</option>
                    <option value="Julius Anthony L. Del Rio" {{ old('type') == 'Julius Anthony L. Del Rio' ? 'selected' : '' }}>Julius Anthony L. Del Rio</option>
                    <option value="Jorge V. Matunog" {{ old('type') == 'Jorge V. Matunog' ? 'selected' : '' }}>Jorge V. Matunog</option>
                    <option value="Jefrie G. Rodriguez" {{ old('type') == 'Jefrie G. Rodriguez' ? 'selected' : '' }}>Jefrie G. Rodriguez</option>
                    <option value="Ma. Reena Pelagio" {{ old('type') == 'Ma. Reena Pelagio' ? 'selected' : '' }}>Ma. Reena Pelagio</option>
                    <option value="Caryn S. Tomenio" {{ old('type') == 'Caryn S. Tomenio' ? 'selected' : '' }}>Caryn S. Tomenio</option>
                    <option value="Mario D. Punzalan Jr." {{ old('type') == 'Mario D. Punzalan Jr.' ? 'selected' : '' }}>Mario D. Punzalan Jr.</option>
                    <option value="Nino G. Faltado" {{ old('type') == 'Nino G. Faltado' ? 'selected' : '' }}>Nino G. Faltado</option>
                    <option value="Sheila Marie S. Reyes" {{ old('type') == 'Sheila Marie S. Reyes' ? 'selected' : '' }}>Sheila Marie S. Reyes</option>
                    <option value="Fernando De Leon" {{ old('type') == 'Fernando De Leon' ? 'selected' : '' }}>Fernando De Leon</option>
                    <option value="Anthony M. Zoleta" {{ old('type') == 'Anthony M. Zoleta' ? 'selected' : '' }}>Anthony M. Zoleta</option>
                    <option value="Wilmer Fabella" {{ old('type') == 'Wilmer Fabella' ? 'selected' : '' }}>Wilmer Fabella</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="deadline_of_compliance" class="form-label">
                    <i class="bi bi-hourglass-split"></i> Deadline of Compliance
                </label>
                <input type="date" name="deadline_of_compliance" id="deadline_of_compliance" value="{{ old('deadline_of_compliance') }}" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="compliance_status" class="form-label">
                    <i class="bi bi-list-check"></i> Status
                </label>
                <select id="compliance_status" name="compliance_status" class="form-select" required>
                    <option value="Compliant" {{ old('type') == 'Compliant' ? 'selected' : '' }}>Compliant</option>
                    <option value="Non-Compliant" {{ old('type') == 'Non-Compliant' ? 'selected' : '' }}>Non-Compliant</option>
                    <option value="Pending" {{ old('type') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Not Applicable" {{ old('type') == 'Not Applicable' ? 'selected' : '' }}>Not Applicable</option>
                </select>
            </div>
            
<div class="full-width mb-3">
    <label for="files" class="form-label d-flex align-items-center">
        <i class="bi bi-upload me-2" style="font-size: 1.2rem; color: #030d22;"></i>
        <span>Upload Files</span>
        <small class="text-muted ms-2" style="font-size: 0.8rem;">
            (Allowed: PDF, MP4, AVI, MOV, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG, GIF – Max 10)
        </small>
    </label>
    <input type="file" id="files" name="files[]" multiple
           accept=".pdf,.mp4,.avi,.mov,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.gif"
           class="form-control">
</div>





            <button type="submit">Save Incoming Communication</button>

        </form>
    </div>

    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

    <script>
    document.getElementById('files').addEventListener('change', function () {
        const fileLimit = 10;
        const fileInput = this;
        const fileCount = fileInput.files.length;
        const message = document.getElementById('file-limit-message');

        if (fileCount > fileLimit) {
            message.style.display = 'inline';
            fileInput.value = ''; // clear input
        } else {
            message.style.display = 'none';
        }
    });
</script>

</body>
</html>
