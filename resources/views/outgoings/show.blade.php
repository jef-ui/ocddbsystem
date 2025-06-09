<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCD CLMS - Incoming Communication</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #003366;
            padding: 40px;
            max-width: 900px;
            margin: auto;
        }

        h2 {
            text-align: center;
            color: #003366;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .file-info {
            margin-bottom: 20px;
        }

        .file-info p {
            font-size: 16px;
            color: #555;
        }

        .file-view {
            margin: 20px 0;
            text-align: center;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #003366;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 20px;
            width: 100%;
        }

        .back-button:hover {
            background-color: #0055aa;
        }

        .download-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        .download-button:hover {
            background-color: #0056b3;
        }

        .footer {
            background-color: white;
            color: #003366;
            text-align: center;
            font-size: 12px;
            padding: 5px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>

   <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">

<h2>Viewing Document: {{ $outgoing->name }}</h2>

@php
    $fileColumns = ['file_path'];
@endphp

@foreach ($fileColumns as $index => $column)
    @php
        $path = $outgoing->$column;
        if (!$path) continue;
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $label = 'File ' . ($index + 1);
    @endphp

    <div style="margin-bottom: 20px;">
        <h5>{{ $label }}</h5>

        @if($extension === 'pdf')
            <embed src="{{ asset('storage/' . $path) }}" type="application/pdf" width="100%" height="800px" />
        @elseif(in_array($extension, ['mp4', 'avi', 'mov']))
            <video width="100%" height="600" controls>
                <source src="{{ asset('storage/' . $path) }}" type="video/{{ $extension }}">
                Your browser does not support the video tag.
            </video>
        @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
            <img src="{{ asset('storage/' . $path) }}" alt="{{ $label }}" style="max-width:100%; height:auto;">
        @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx']))
            <p>{{ $label }}: Preview not available for Word or Excel files. Please download the file.</p>
            <a href="{{ asset('storage/' . $path) }}" download class="btn btn-sm btn-primary">Download {{ $label }}</a>
        @else
            <p>{{ $label }}: File type not supported for viewing in the browser.</p>
            <a href="{{ asset('storage/' . $path) }}" download class="btn btn-sm btn-secondary">Download {{ $label }}</a>
        @endif
    </div>
@endforeach


<a href="{{ route('outgoing.index') }}" class="back-button">Back to Records</a>

<div class="footer">
    <p>Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025</p>
</div>

</body>
</html>
