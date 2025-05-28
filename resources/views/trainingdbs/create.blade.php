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
            <a href="{{route ('trainingdb.index')}}">
                <i class="bi bi-journal-text"></i> Training IMS
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
        <form action="{{route ('trainingdb.store')}}" method="post" class="form-container" enctype="multipart/form-data">
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
    ADD TRAINING CONDUCTED
</h2>
            
{{-- Training Title Selection --}}
<div class="mb-3">
    <label for="training_title" class="form-label">
        <i class="bi bi-journal-code"></i> Training Type
    </label>
    <select id="training_title" name="training_title" class="form-select" required>
        <option value="">-- Please select training type --</option>
        <option value="BICS">BICS</option>
        <option value="CBDRRM">CBDRRM</option>
        <option value="CBDRRM-TOT">CBDRRM-TOT</option>
        <option value="CP">CP</option>
        <option value="DRRM">DRRM</option>
        <option value="ICS-EC">ICS-EC</option>
    </select>
</div>


{{-- IMS Number Auto Fill --}}
<div class="mb-3">
    <label for="ims_number" class="form-label">
        <i class="bi bi-building"></i> IMS Number
    </label>
    <input type="text" id="ims_number" name="ims_number" class="form-control" readonly required>
</div>

{{-- Training Type Selection --}}
<div class="mb-3">
    <label for="training_type" class="form-label">
        <i class="bi bi-journal-code"></i> Training Title
    </label>
    <input type="text" id="training_type" name="training_type" class="form-control" placeholder="e.g., BICS for RDRRMC Member Agencies" required>
</div>


{{-- Province Selection --}}
<div class="mb-3">
    <label for="province" class="form-label">
        <i class="bi bi-geo-alt-fill"></i> Province
    </label>
    <select id="province" name="province" class="form-select" required>
        <option value="">-- Please select province --</option>
        <option value="Province of Occidental Mindoro">Province of Occidental Mindoro</option>
        <option value="Province of Oriental Mindoro">Province of Oriental Mindoro</option>
        <option value="Province of Marinduque">Province of Marinduque</option>
        <option value="Province of Romblon">Province of Romblon</option>
        <option value="Province of Palawan">Province of Palawan</option>
    </select>
</div>

{{-- Municipality Selection --}}
<div class="mb-3" id="municipality-container" style="display: none;">
    <label for="municipality" class="form-label">
        <i class="bi bi-buildings-fill"></i> Municipality
    </label>
    <select id="municipality" name="municipality" class="form-select" required>
        <option value="">-- Please select municipality --</option>
    </select>
</div>

 <div class="mb-3">
                <label for="sector" class="form-label">
                    <i class="bi bi-tag-fill"></i> Sector
                </label>
                <select id="sector" name="sector" class="form-select" required>
                    <option value="Please select">-- Please select --</option>
                    <option value="PDRRMCs" {{ old('sector') == 'PDRRMCs' ? 'selected' : '' }}>PDRRMCs</option>
                    <option value="LDRRMCs" {{ old('sector') == 'LDRRMCs' ? 'selected' : '' }}>LDRRMCs</option>
                    <option value="MDRRMCs" {{ old('sector') == 'MDRRMCs' ? 'selected' : '' }}>MDRRMCs</option>
                </select>
            </div>


     <div class="mb-3">
                <label for="funding" class="form-label">
                    <i class="bi bi-tag-fill"></i> Funding Source
                </label>
                <select id="funding" name="funding" class="form-select" required>
                    <option value="Please select">-- Please select --</option>
                    <option value="APB" {{ old('funding') == 'APB' ? 'selected' : '' }}>APB</option>
                    <option value="Technical Assistance" {{ old('funding') == 'Technical Assistance' ? 'selected' : '' }}>Technical Assistance</option>
                </select>
            </div>


        <div class="mb-3">
                <label for="date_from" class="form-label">
                    <i class="bi bi-calendar-date"></i> Date From
                </label>
                <input type="date" name="date_from" id="date_from" value="{{ old('date_from') }}" class="form-control" required>
            </div>


            <div class="mb-3">
                <label for="date_until" class="form-label">
                    <i class="bi bi-calendar-date"></i> Date Until
                </label>
                <input type="date" name="date_until" id="date_until" value="{{ old('date_until') }}" class="form-control" required>
            </div>

               <div class="mb-3">
                <label for="venue" class="form-label">
                    <i class="bi bi-building"></i> Venue/Location
                </label>
                <input type="text" id="venue" name="venue" value="{{ old('venue') }}" class="form-control" required>
            </div>

            {{-- Number of Graduates --}}
<div class="mb-3">
    <label for="number_graduates" class="form-text text-muted small mb-1">No. of Completion</label>
    <input type="number" name="number_graduates" id="number_graduates"
           step="0.01" min="0"
           class="form-control form-control-sm"
           value="{{ old('number_graduates') }}" required>
</div>

{{-- Number of Participants (Optional) --}}
<div class="mb-3">
    <label for="number_participation" class="form-text text-muted small mb-1">No. of Participation</label>
    <input type="number" name="number_participation" id="number_participation"
           step="0.01" min="0"
           class="form-control form-control-sm"
           value="{{ old('number_participation') }}">
</div>

     <div class="mb-3">
                <label for="ocd_personnel" class="form-label">
                    <i class="bi bi-building"></i> OCD Personnel Involve
                </label>
                <input type="text" id="ocd_personnel" name="ocd_personnel" value="{{ old('ocd_personnel') }}" class="form-control" required>
            </div>


            <div>
                <label for="file_path">Upload File 1</label>
                <input type="file" id="file_path" name="file_path" accept=".pdf,.mp4,.avi,.mov,.doc,.docx,.xls,.xlsx">
            </div>

            <div>
                <label for="file_path1">Upload File 2</label>
                <input type="file" id="file_path1" name="file_path1" accept=".pdf,.mp4,.avi,.mov,.doc,.docx,.xls,.xlsx">
            </div>

            <button type="submit">Save Record</button>
        </form>
    </div>

    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>

    {{-- Script --}}
<script>
    const municipalities = {
        "Province of Occidental Mindoro": [
            "LDRRMCs", "Abra de Ilog", "Calintaan", "Looc", "Lubang", "Magsaysay",
            "Mamburao", "Paluan", "Rizal", "Sablayan", "San Jose", "Santa Cruz"
        ],
        "Province of Oriental Mindoro": [
            "LDRRMCs", "Baco", "Bansud", "Bongabong", "Bulalacao", "Calapan City",
            "Gloria", "Mansalay", "Naujan", "Pinamalayan", "Pola", 
            "Puerto Galera", "Roxas", "San Teodoro", "Socorro", "Victoria"
        ],
        "Province of Marinduque": [
            "LDRRMCs", "Boac", "Buenavista", "Gasan", "Mogpog", "Santa Cruz", "Torrijos"
        ],
        "Province of Romblon": [
            "LDRRMCs", "Alcantara", "Banton", "Cajidiocan", "Calatrava", "Concepcion",
            "Corcuera", "Ferrol", "Looc", "Magdiwang", "Odiongan", 
            "Romblon", "San Agustin", "San Andres", "San Fernando", "San Jose"
        ],
        "Province of Palawan": [
            "LDRRMCs", "Aborlan", "Agutaya", "Araceli", "Balabac", "Bataraza",
            "Brooke's Point", "Busuanga", "Cagayancillo", "Coron", "Culion",
            "Cuyo", "Dumaran", "El Nido", "Kalayaan", "Linapacan",
            "Magsaysay", "Narra", "Puerto Princesa City", "Quezon", 
            "Rizal", "Roxas", "San Vicente", "Sofronio Española", "Taytay"
        ]
    };

    document.getElementById('province').addEventListener('change', function () {
        const selectedProvince = this.value;
        const municipalitySelect = document.getElementById('municipality');
        const municipalityContainer = document.getElementById('municipality-container');

        municipalitySelect.innerHTML = '<option value="">-- Please select municipality --</option>';

        if (municipalities[selectedProvince]) {
            municipalities[selectedProvince].forEach(function (municipality) {
                const option = document.createElement('option');
                option.value = municipality;
                option.text = municipality;
                municipalitySelect.appendChild(option);
            });

            municipalityContainer.style.display = 'block';
        } else {
            municipalityContainer.style.display = 'none';
        }
    });
</script>


{{-- jQuery for AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#training_title').on('change', function () {
        var trainingTitle = $(this).val();
        if (trainingTitle) {
            $.ajax({
                url: '{{ route("generate.ims.number") }}',
                type: 'GET',
                data: { title: trainingTitle },
                success: function (data) {
                    $('#ims_number').val(data.ims_number);
                }
            });
        } else {
            $('#ims_number').val('');
        }
    });
</script>

<script>
    document.getElementById('training_title').addEventListener('change', function () {
        const selectedTitle = this.value;
        const trainingTypeInput = document.getElementById('training_type');
        trainingTypeInput.value = selectedTitle; // Auto-fill the selected title
    });
</script>



</body>
</html>
