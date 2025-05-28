<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Appearance</title>
    <style>
        @page {
            margin-top: 10px;
            margin-left: 50px;
            margin-right: 50px;
            margin-bottom: 50px;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            text-align: justify;
            line-height: 1.6;
        }
        .letterhead img {
            width: 100%;
            max-width: 700px;
            margin-bottom: 20px;
        }
        h3 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 30px;
        }
.signature {
    margin-top: 60px;
    text-align: right;
    line-height: 1; /* Reduce spacing between lines */
    margin-bottom: 0;
}

p {
    text-indent: 40px; /* Adjust the value as needed */
}


    </style>
</head>
<body>

    @php
        $image = base64_encode(file_get_contents(public_path('images/lhead.png')));
    @endphp

    <div class="letterhead">
        <img src="data:image/png;base64,{{ $image }}">
    </div>

    <h3>CERTIFICATE OF APPEARANCE</h3>

    <p>
        This is to certify that <strong>{{ \Illuminate\Support\Str::upper($guest->name) }}
</strong> of 
        <strong>{{ \Illuminate\Support\Str::upper($guest->agency) }}</strong> appeared in the Office of Civil Defense 
        MIMAROPA, Regional Office on <strong>{{ \Carbon\Carbon::parse($guest->date_of_visit)->format('F j, Y') }}</strong> 
        in relation to <strong>{{ \Illuminate\Support\Str::title($guest->purpose_of_visit) }}
</strong>.
    </p>

    <p>
        This certification is being issued to the above-mentioned for whatever legal purpose it may serve.
    </p>

    <p>
        Issued on <strong>{{ \Carbon\Carbon::parse($guest->date_of_visit)->format('F j, Y') }}</strong> at the Office of Civil Defense MIMAROPA Regional Office, PEO Compound, Kumintang Ilaya, Batangas City.
    </p>

    <div class="signature">
    <strong>MARC REMBRANDT P. VICTORE</strong><br>
    Chairperson, RDRRMC MIMAROPA<br>
    Officer-in-Charge, OCD MIMAROPA
</div>



</body>
</html>
