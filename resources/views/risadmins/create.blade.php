<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-RIS AutoPDF</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vite -->
    @vite('resources/js/app.js')

    <style>

        input:valid {
  font-weight: bold;
}

/* Style for hidden placeholder option */
    select option[hidden] {
        font-weight: normal;
        color: #6c757d;
    }

    /* Style for actual selectable options */
    select option:not([hidden]) {
        font-weight: bold;
    }

 /* Style for placeholder option */
    select option[hidden] {
        font-weight: normal;
        color: #6c757d; /* Gray placeholder text */
    }

    /* Style for actual selectable options */
    select option:not([hidden]) {
        font-weight: bold;
    }

    /* Make hidden placeholder options normal (not bold and dimmer color) */
    select option[hidden] {
        font-weight: normal;
        color: #6c757d; /* Optional: makes it look like a placeholder */
    }

    /* All other options stay bold */
    select option:not([hidden]) {
        font-weight: bold;
    }

/* Make the default hidden placeholder not bold */
    #description-select option[hidden] {
        font-weight: normal;
        color: #6c757d; /* Optional: make it appear more like a placeholder */
    }

    /* All other options will remain bold */
    #description-select option:not([hidden]) {
        font-weight: bold;
    }
     

        body {
    background: url('{{ asset('images/bg_1.png') }}') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    flex-direction: column;
}

.form-container {
    background-color: #ffffff; /* Pure white background */
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 600px; /* Increase max-width for wider view */
    margin-bottom: 80px; /* Add margin-bottom to prevent footer overlap */
}

h2 {
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    color: #222;
    margin-bottom: 1.5rem;
}

h2 span {
    font-weight: bold;
    color: orange; /* Bold and Orange color for e-GUEST */
}

.signature-pad {
    border: 2px solid #000;
    width: 100%;
    height: 300px;
    background-color: #fff;
}

canvas {
    touch-action: none !important;
}

.form-label i {
    margin-right: 10px;
    color: orange; /* Icon color changed to orange */
}

.input-group-text {
    background-color: transparent;
    border: none;
}

.btn-submit {
    background-color: #003366; /* Dark blue background for the submit button */
    color: white;
    border: none;
}

.logo img {
    width: 100px; /* Set the logo size */
    margin-bottom: 1rem;
}

#clear-btn {
    background-color: orange; /* Solid orange background */
    border: none;
    color: white;
}

#clear-btn:hover {
    background-color: #e67e22; /* Lighter orange on hover */
    color: white;
}

@media (max-width: 576px) {
    .form-container {
        padding: 1rem;
    }

    h2 {
        font-size: 1.25rem;
    }

    .signature-pad {
        height: 150px;
    }

    .input-group-text {
        font-size: 0.9rem;
    }
}

.footer {
    background-color: white;
    color: #003366;
    text-align: center;
    font-size: 12px;
    padding: 10px 0;
    position: relative;
    width: 100%;
}

/* Hide overlay by default */
#loadingOverlay {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Use JS to toggle this class */
.overlay-hidden {
    display: none !important;
}

.loader {
    border: 6px solid #f3f3f3;
    border-top: 6px solid #007bff;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

#loadingOverlay p {
    margin-top: 1rem;
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}



    </style>
</head>
<body>
    <div class="form-container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

         <form action="{{ route('risadmin.store') }}" method="POST" enctype="multipart/form-data" id="pdfForm">
            @csrf

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="logo text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>

            <h2 class="text-center">
                OCD MIMAROPA <span>e-RIS</span> AutoPDF
            </h2>

           <!-- fund_cluster -->
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text" id="fund-cluster-icon">
            <i class="bi bi-cash-coin"></i>
        </span>
        <select name="fund_cluster" class="form-select" id="fund-cluster-select" required>
            <option value="" disabled selected hidden>--SELECT FUND CLUSTER --</option>
            <option value="Fleet Card (ADMIN), Blue Color RA- OCD IVB-3 - 738766030225745104">
                Fleet Card (ADMIN), Blue Color RA- OCD IVB-3 - 738766030225745104
            </option>
            <option value="Fleet Card (RD's Office), Blue Color OCDRC IVB-1 - 738766030358506000">
                Fleet Card (RD's Office), Blue Color OCDRC IVB-1 - 738766030358506000
            </option>
            <option value="Fleet Card (Vehicle), Red Color Office of Civil Defense 030103 - 738766030354808012">
                Fleet Card (Vehicle), Red Color Office of Civil Defense 030103 - 738766030354808012
            </option>
            <option value="Fleet Card (QRF), Blue Color QRF-2014-OCD4B-3 - 738766030225688007">
                Fleet Card (QRF), Blue Color QRF-2014-OCD4B-3 - 738766030225688007
            </option>
            <option value="Fleet Card (QRF), Blue Color QRF-2014-ocd4b-2 - 738766030225805106">
                Fleet Card (QRF), Blue Color QRF-2014-ocd4b-2 - 738766030225805106
            </option>
            <option value="Fleet Card (QRF), Blue Color QRF2015-OCDIVB-1 - 738766030225804109">
                Fleet Card (QRF), Blue Color QRF2015-OCDIVB-1 - 738766030225804109
            </option>
            <option value="Fleet Card (QRF), Blue Color QRF-2023-OCD4B-1 - 738766030483319006">
                Fleet Card (QRF), Blue Color QRF-2023-OCD4B-1 - 738766030483319006
            </option>
        </select>
    </div>
</div>


            {{-- date --}}
            <div class="mb-3">
    <div class="input-group position-relative">
        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
        <input type="date" id="date" name="date" class="form-control" required>
        <span id="date-placeholder" class="position-absolute text-muted" 
              style="left: 45px; top: 50%; transform: translateY(-50%); pointer-events: none;">
            --SELECT DATE--
        </span>
    </div>
</div>
            
            {{-- name --}}
<div class="mb-3">
  <div class="input-group">
    <span class="input-group-text">
      <i class="bi bi-person-circle"></i>
    </span>
    <input
      type="text"
      id="name-input"
      name="name"
      class="form-control"
      placeholder="Select or type name"
      list="name-options"
      style="text-transform: uppercase;"
      required
      oninput="this.value = this.value.toUpperCase(); updateFontWeight();"
    >
    <datalist id="name-options">
      <option value="Marc Rembrandt P. Victore"></option>
      <option value="Aquilino P. Ducay"></option>
      <option value="Almarose Tabliago"></option>
      <option value="Maria Aiza S. Siason"></option>
      <option value="Jommel Merano"></option>
      <option value="Lilia Guevarra"></option>
      <option value="Mary An B. Aceveda"></option>
      <option value="Jonalyn Pagcaliwagan"></option>
      <option value="Efril F. Maranan"></option>
      <option value="Jervis Lloyd M. Atilano"></option>
      <option value="Glory Balegan"></option>
      <option value="Minerva R. Alcaraz"></option>
      <option value="Mario D. Punzalan Jr."></option>
      <option value="Nino G. Faltado"></option>
      <option value="Sheila Marie S. Reyes"></option>
      <option value="Fernando De Leon"></option>
      <option value="Anthony M. Zoleta"></option>
      <option value="Wilmer Fabella"></option>
      <option value="Joe Mark A. Cabador"></option>
      <option value="Ray Jonmat R. La Rosa"></option>
      <option value="Rodelio Gucela Jr."></option>
    </datalist>
  </div>
</div>

            
            {{-- position --}}
          <div class="mb-3">
    <div class="input-group">
        <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
        <input 
            type="text" 
            name="position" 
            class="form-control" 
            placeholder="POSITION/DESIGNATION" 
            value="{{ old('position') }}"
            style="text-transform: uppercase;" 
            required
        >
    </div>
</div>

            
            {{-- division --}}
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text" id="division-icon">
            <i class="bi bi-building"></i>
        </span>
        <select name="division" class="form-select" id="division-select" required>
            <option value="" disabled selected hidden>-- SELECT DIVISION/SECTION --</option>
            <option value="DRRMD">DRRMD</option>
            <option value="AFMS">AFMS</option>
            <option value="OPCEN">OPCEN</option>
            <option value="PDPS">PDPS</option>
            <option value="DPS">DPS</option>
            <option value="RRMS">RRMS</option>
        </select>
    </div>
</div>



            {{-- office_agency --}}
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
        <input 
            type="text"
            name="office_agency"
            id="office-agency"
            class="form-control"
            placeholder="--select Office/Agency--"
            list="agency-options"
            style="text-transform: uppercase;"
            required
        >
        <datalist id="agency-options">
            <option value="OCD MIMAROPA"></option>
        </datalist>
    </div>
</div>
  
            {{-- UNIT --}}
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text" id="unit-icon">
            <i class="bi bi-droplet"></i>
        </span>
        <select name="unit" class="form-select" id="unit-select" required>
            <option value="" disabled selected hidden>-- SELECT UNIT --</option>
            <option value="L">LITER</option>
            <option value="G">GALLON</option>
        </select>
    </div>
</div>

{{-- DESCRIPTION --}}
   <div class="mb-3">
    <div class="input-group">
        <span class="input-group-text" id="description-icon">
            <i class="bi bi-droplet"></i>
        </span>
        <select name="description" class="form-select" id="description-select" required>
            <option value="" disabled selected hidden>--SELECT GAS TYPE--</option>
            <option value="XCS">XCS</option>
            <option value="XTRA">XTRA</option>
            <option value="DIESEL">DIESEL</option>
        </select>
    </div>
</div>

{{-- quantity --}}
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-box-seam"></i> <!-- Icon representing quantity/items -->
        </span>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="form-control" step="0.01" placeholder="QUANTITY" required>
    </div>
</div>

{{-- amount utilized --}}
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-cash-stack"></i> <!-- Money icon -->
        </span>
        <input type="number" name="amount_utilized" id="amount_utilized" value="{{ old('amount_utilized') }}" class="form-control" step="0.01" placeholder="AMOUNT UTILIZED" required>
    </div>
</div>


{{-- balance --}}
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-wallet2"></i> <!-- Wallet icon for balance -->
        </span>
        <input type="number" name="balance" id="balance" value="{{ old('balance') }}" class="form-control" step="0.01" placeholder="BALANCE" required>
    </div>
</div>

{{-- invoice number --}}

<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-receipt"></i> <!-- Receipt icon for invoice -->
        </span>
        <input type="number" name="invoice_number" id="invoice_number" value="{{ old('invoice_number') }}" class="form-control" step="1" min="0" placeholder="INVOICE NUMBER" required>
    </div>
</div>

{{-- Plate Number --}}
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-car-front"></i> <!-- Car icon for plate number -->
        </span>
        <input 
            type="text" id="plate_number" name="plate_number" 
            value="{{ old('plate_number') }}" 
            class="form-control" 
            placeholder="Plate Number"
            required 
            style="text-transform: uppercase;" 
            oninput="this.value = this.value.toUpperCase();">
    </div>
</div>

{{-- Type of Car --}}

<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-truck"></i> <!-- Truck icon for type of car -->
        </span>
        <input 
            type="text" id="type_car" name="type_car" 
            value="{{ old('type_car') }}" 
            class="form-control" 
            placeholder="Type of Car" 
            required 
            style="text-transform: uppercase;" 
            oninput="this.value = this.value.toUpperCase();">
    </div>
</div>


{{-- purpose --}}


<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-clipboard2-check"></i>
        </span>
        <input 
            type="text" 
            id="purpose" 
            name="purpose" 
            value="{{ old('purpose') }}" 
            class="form-control" 
            placeholder="Purpose" 
            list="purpose-options"
            required 
            style="text-transform: uppercase;" 
            oninput="this.value = this.value.toUpperCase(); updatePurposeFontWeight();"
        >
        <datalist id="purpose-options">
            <option value="ADMINISTRATIVE SUPPORT"></option>
            <option value="OPERATIONAL SUPPORT"></option>
        </datalist>
    </div>
</div>


{{-- File Upload --}}
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-upload"></i> <!-- Upload icon -->
        </span>
        <input 
            type="file" id="file_path" name="file_path" 
            class="form-control" 
            accept=".pdf,image/*">
    </div>
</div>


    <div class="d-grid">
        <button type="submit" id="submitBtn" class="btn btn-submit">Submit</button>
    </div>
</form>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="overlay-hidden">
    <div class="text-center">
        <div class="logo mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <p>Generating PDF, please wait...</p>
        <div class="spinner-border text-primary mt-2" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>



            
            {{-- <div class="mb-3">
                <label class="form-label" for="signature-pad">
                    Digital Signature (Draw Below)
                    <br>
                    <small class="text-muted">Use your mouse or touchscreen to sign inside the box</small>
                </label>
                
                <div class="input-group">
                    <canvas id="signature-pad" class="signature-pad" required></canvas>
                    <input type="hidden" name="e_signature" id="e_signature">
                </div>
                <button type="button" id="clear-btn" class="btn btn-outline-secondary mt-2">Clear</button>
            </div> comment --}}
        

  
   {{--  <script>
        // Get the signature pad and form elements
        const signaturePad = document.getElementById('signature-pad');
        const eSignatureInput = document.getElementById('e_signature');
        const clearBtn = document.getElementById('clear-btn');

        // Initialize signature pad
        const ctx = signaturePad.getContext('2d');
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.strokeStyle = '#000000';

        let drawing = false;

        signaturePad.addEventListener('mousedown', (e) => startDrawing(e));
        signaturePad.addEventListener('mousemove', (e) => draw(e));
        signaturePad.addEventListener('mouseup', () => stopDrawing());
        signaturePad.addEventListener('mouseout', () => stopDrawing());

        function startDrawing(e) {
            drawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        }

        function draw(e) {
            if (drawing) {
                ctx.lineTo(e.offsetX, e.offsetY);
                ctx.stroke();
            }
        }

        function stopDrawing() {
            drawing = false;
        }

        // Clear the canvas
        clearBtn.addEventListener('click', () => ctx.clearRect(0, 0, signaturePad.width, signaturePad.height));

        // Form submission validation
        document.getElementById('guest-form').addEventListener('submit', function (e) {
            // Check if the signature pad is empty
            if (!isSignatureValid()) {
                e.preventDefault();
                alert('Please provide your signature.');
            } else {
                eSignatureInput.value = signaturePad.toDataURL();
            }
        });

        function isSignatureValid() {
            const imageData = ctx.getImageData(0, 0, signaturePad.width, signaturePad.height);
            const pixels = imageData.data;
            for (let i = 0; i < pixels.length; i += 4) {
                if (pixels[i + 3] > 0) { // Check if there's any non-transparent pixel
                    return true;
                }
            }
            return false;
        }
    </script> comment --}}

    <script>
    const unitSelect = document.getElementById('unit-select');
    const unitIcon = document.getElementById('unit-icon').querySelector('i');

    unitSelect.addEventListener('change', function () {
        if (this.value === 'Liter') {
            unitIcon.className = 'bi bi-droplet'; // Icon for Liter
        } else if (this.value === 'Gallon') {
            unitIcon.className = 'bi bi-fuel-pump'; // Icon for Gallon
        }
    });
</script>

{{-- drop down turn to bold --}}
<script>
    const boldenSelectOnChange = (id) => {
        const el = document.getElementById(id);
        el.addEventListener('change', function () {
            this.style.fontWeight = 'bold';
        });
    };

    boldenSelectOnChange('fund-cluster-select');
    boldenSelectOnChange('division-select');
    boldenSelectOnChange('unit-select');
    boldenSelectOnChange('description-select');
    boldenSelectOnChange('purpose-options');
</script>

{{-- Date Function --}}
<script>
    function toggleDatePlaceholder() {
        const input = document.getElementById('date');
        const placeholder = document.getElementById('date-placeholder');

        // Show placeholder only when input is empty and screen is mobile
        if (!input.value && window.innerWidth < 768) {
            placeholder.style.display = 'block';
        } else {
            placeholder.style.display = 'none';
        }
    }

    // Initialize
    toggleDatePlaceholder();

    // Watch for changes and window resize
    document.getElementById('date').addEventListener('input', toggleDatePlaceholder);
    window.addEventListener('resize', toggleDatePlaceholder);
</script>

<script>
    const agencyInput = document.getElementById('office-agency');

    function updateFontWeight() {
        if (agencyInput.value.trim().toUpperCase() === 'OCD MIMAROPA') {
            agencyInput.style.fontWeight = 'bold';
        } else {
            agencyInput.style.fontWeight = 'normal';
        }
    }

    agencyInput.addEventListener('input', updateFontWeight);
    window.addEventListener('load', updateFontWeight);
</script>

<script>
    const purposeInput = document.getElementById('purpose');

    function updateFontWeight() {
        if (purposeInput.value.trim().toUpperCase() === 'SUPPORT TO ADMIN') {
            purposeInput.style.fontWeight = 'bold';
        } else {
            purposeInput.style.fontWeight = 'normal';
        }
    }

    // Call once on page load in case value is prefilled
    window.addEventListener('load', updateFontWeight);
</script>


{{-- DROP DOWN NAME --}}
<script>
  const nameInput = document.getElementById('name-input');

  function updateFontWeight() {
    if (nameInput.value.trim().toUpperCase() === 'MARC REMBRANDT P. VICTORE') {
      nameInput.style.fontWeight = 'bold';
    } else {
      nameInput.style.fontWeight = 'normal';
    }
  }

  window.addEventListener('load', updateFontWeight);
</script>

<script>
  function updateFontWeight() {
    const input = document.getElementById("name-input");
    const options = Array.from(document.getElementById("name-options").options);
    const match = options.some(option => option.value.toUpperCase() === input.value.toUpperCase());

    input.style.fontWeight = match ? "bold" : "normal";
  }
</script>

<script>
    function updatePurposeFontWeight() {
        const input = document.getElementById("purpose");
        const options = Array.from(document.getElementById("purpose-options").options);
        const inputValue = input.value.toUpperCase();
        const match = options.some(option => option.value.toUpperCase() === inputValue);

        // Make text bold whether it's a match or just typed
        input.style.fontWeight = inputValue ? "bold" : "normal";
    }
</script>

<script>
document.querySelector('input[name="position"]').addEventListener('input', function () {
    this.value = this.value.toUpperCase();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('pdfForm');
    const overlay = document.getElementById('loadingOverlay');
    const submitBtn = document.getElementById('submitBtn');

    if (form && overlay && submitBtn) {
        form.addEventListener('submit', function (e) {
            // Only proceed if form is valid (optional check)
            if (form.checkValidity()) {
                overlay.classList.remove('overlay-hidden');
                submitBtn.disabled = true;
                submitBtn.innerText = 'Please wait...';
            }
        });
    }
});

</script>





  <!-- Footer -->
    <footer class="footer">
        Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025
    </footer>



    
</body>
</html>
