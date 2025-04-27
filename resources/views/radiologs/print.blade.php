<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Radio Logs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 10px;
            font-size: 11px;
        }
        .letterhead {
            text-align: center;
            margin-bottom: 10px;
        }
        .letterhead img {
            width: 100%; /* Adjust the width of your letterhead */
            max-width: 800px; /* Set a maximum width */
            height: auto;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 5px;
            border: 1px solid #333;
            text-align: center;
            font-size: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="letterhead">
        <img src="{{ public_path('images/lhead.png') }}" style="width: 100%; max-width: 700px; margin-bottom: 10px;">
    </div>

    
    <h1>OCD MIMAROPA RADIO LOGBOOK</h1>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Sender</th>
                <th>Band</th>
                <th>Mode</th>
                <th>Signal</th>
                <th>Receiver</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($radiologs as $radiolog)
                <tr>
                    <td>{{ $radiolog->received_date }}</td>
                    <td>{{ $radiolog->received_time }}</td>
                    <td>{{ $radiolog->sender_name }}</td>
                    <td>{{ $radiolog->band }}</td>
                    <td>{{ $radiolog->mode }}</td>
                    <td>{{ $radiolog->signal_strength }}</td>
                    <td>{{ $radiolog->receiver_name }}</td>
                    <td>{{ $radiolog->notes_remarks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
