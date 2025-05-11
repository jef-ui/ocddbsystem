<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center bg-light" style="min-height: 100vh;">

<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="card-title">Uploaded Files for Record ID: {{ $record->id }}</h3>
            <ul class="list-group list-group-flush my-4">
                @if($record->file_path)
                    <li class="list-group-item">
                        <i class="bi bi-file-earmark-text-fill text-primary"></i>
                        <a href="{{ route('records.show', $record->id) }}" target="_blank">File 1</a>
                    </li>
                @endif
                @if($record->file_path1)
                    <li class="list-group-item">
                        <i class="bi bi-file-earmark-text-fill text-success"></i>
                        <a href="{{ route('records.show', $record->id) }}" target="_blank">File 2</a>
                    </li>
                @endif
                @if($record->file_path2)
                    <li class="list-group-item">
                        <i class="bi bi-file-earmark-text-fill text-danger"></i>
                        <a href="{{ route('records.show', $record->id) }}" target="_blank">File 3</a>
                    </li>
                @endif
            </ul>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

</body>
</html>
