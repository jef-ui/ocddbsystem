<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Document</title>
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

<h2>Viewing Document: {{ $record->name }}</h2>

@php
    $files = [
        'File 1' => $record->file_path,
        'File 2' => $record->file_path1,
        'File 3' => $record->file_path2,
    ];
@endphp

@foreach($files as $label => $path)
    @if($path)
        @php $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION)); @endphp

        <div class="file-info">
            <p><strong>{{ $label }}</strong></p>
        </div>

        <div class="file-view">
            @if($extension === 'pdf')
                <embed src="{{ asset('storage/' . $path) }}" type="application/pdf" width="100%" height="800px" />
            @elseif(in_array($extension, ['mp4', 'avi', 'mov']))
                <video width="100%" height="600" controls>
                    <source src="{{ asset('storage/' . $path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx']))
                <p>Preview for DOC and Excel files is not available. You can download the file. If you want a preview, please consider converting it to PDF and uploading again.</p>
            @else
                <p>{{ $label }}: File type not supported for viewing in the browser.</p>
            @endif
        </div>

        <div class="file-download">
            <!-- Download Link for the file -->
            <a href="{{ asset('storage/' . $path) }}" class="download-button" download>Download {{ $label }}</a>
        </div>

        <hr>
    @endif
@endforeach

<a href="{{ route('record.index') }}" class="back-button">Back to Records</a>

<div class="footer">
    <p>Designed and Developed by ICTU MIMAROPA, Office of Civil Defense MIMAROPA © Copyright 2025</p>
</div>

</body>
</html>
