<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>




<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:5px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:5px 5px;word-break:normal;}
.tg .tg-doeh{border-color:inherit;font-size:8px;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-91w8{border-color:inherit;font-size:8px;text-align:center;vertical-align:top}
.tg .tg-j7mi{border-color:inherit;font-size:8px;font-style:italic;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-l6li{border-color:inherit;font-size:8px;text-align:left;vertical-align:top}
.tg .tg-4k6h{border-color:inherit;font-size:8px;font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}

.white-text {
  color: white;
  border-color: black !important; /* or #000 or your table’s default border */
}



</style>
</head>
<body>

 @php
    $image = base64_encode(file_get_contents(public_path('images/lhead.png')));
@endphp

<div class="letterhead">
    <img src="data:image/png;base64,{{ $image }}" style="width: 100%; max-width: 700px; margin-bottom: 10px;">
</div>



    <h3 style="text-align: center;">REQUISITION AND ISSUE SLIP</h3>

<table class="tg" style="undefined;table-layout: fixed; width: 714px"><colgroup>
<col style="width: 58.2px">
<col style="width: 47.2px">
<col style="width: 112.2px">
<col style="width: 109.2px">
<col style="width: 53.2px">
<col style="width: 64.2px">
<col style="width: 101.2px">
<col style="width: 99.2px">
<col style="width: 69.2px">
</colgroup>
<thead>
  <tr>
    <th class="tg-l6li">Entity name:</th>
    <th class="tg-l6li" colspan="4">OFFICE OF CIVIL DEFENSE MIMAROPA</th>
    <th class="tg-doeh" colspan="4">Fund Cluster: {{$risadmin->fund_cluster}}</th>
  </tr></thead>
<tbody>
  <tr>
    <td class="tg-l6li">Division:</td>
    <td class="tg-91w8" colspan="4">{{$risadmin->division}}</td>
    <td class="tg-l6li" colspan="2">Responsibility Center Code</td>
    <td class="tg-doeh" colspan="2"></td>
  </tr>
  <tr>
    <td class="tg-l6li">Office:</td>
    <td class="tg-doeh" colspan="4">{{$risadmin->office_agency}}</td>
    <td class="tg-l6li" colspan="2">RIS Number</td>
    <td class="tg-doeh" colspan="2"></td>
  </tr>
  <tr>
    <td class="tg-doeh" colspan="4">Requistion</td>
    <td class="tg-j7mi" colspan="2">Stock Available ?</td>
    <td class="tg-j7mi" colspan="3">Issue</td>
  </tr>
  <tr>
    <td class="tg-doeh">Stock No.</td>
    <td class="tg-doeh">Unit</td>
    <td class="tg-doeh">Description</td>
    <td class="tg-doeh">Quantity</td>
    <td class="tg-doeh">Yes</td>
    <td class="tg-doeh">No</td>
    <td class="tg-doeh">Quantity</td>
    <td class="tg-doeh" colspan="2">Remarks</td>
  </tr>
  <tr>
    <td class="tg-4k6h"></td>
    <td class="tg-91w8">{{$risadmin->unit}}</td>
    <td class="tg-91w8">{{$risadmin->description}}</td>
    <td class="tg-91w8">{{$risadmin->quantity}}</td>
    <td class="tg-doeh">/</td>
    <td class="tg-doeh"></td>
    <td class="tg-91w8">{{$risadmin->quantity}}</td>
    <td class="tg-4k6h">Amount Utilized</td>
    <td class="tg-91w8">{{$risadmin->amount_utilized}}</td>
  </tr>
  <tr>
    <td class="tg-4k6h"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-4k6h">Balance</td>
    <td class="tg-91w8">{{$risadmin->balance}}</td>
  </tr>
  <tr>
    <td class="tg-4k6h"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-4k6h">Invoice</td>
    <td class="tg-91w8">{{$risadmin->invoice_number}}</td>
  </tr>
  <tr>
    <td class="tg-4k6h"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-doeh"></td>
    <td class="tg-4k6h">Plate Number</td>
    <td class="tg-91w8">{{$risadmin->plate_number}}</td>
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h">Type of Car</td>
    <td class="tg-91w8">{{$risadmin->type_car}}</td>
  </tr>

   {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}

      {{-- Blank tr td --}}
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-4k6h white-text">Type of Car</td>
    <td class="tg-91w8 white-text">{{$risadmin->type_car}}</td>
  </tr>
   {{-- Blank tr td --}}
   


  <tr>
    <td class="tg-91w8">Purpose</td>
    <td class="tg-4k6h" colspan="8">{{$risadmin->purpose}}</td>
  </tr>
  <tr>
    <td class="tg-4k6h white-text" colspan="9">#purpose</td>
  </tr>
  <tr>
    <td class="tg-4k6h"></td>
<td class="tg-l6li" colspan="2"><b>Requested By:</b></td>
<td class="tg-l6li" colspan="2"><b>Approved By:</b></td>
<td class="tg-l6li" colspan="2"><b>Issued By:</b></td>
<td class="tg-l6li" colspan="2"><b>Received By:</b></td>
  </tr>
  <tr>
<td class="tg-l6li"><b>Signature:</b></td>
<td class="tg-4k6h" colspan="2"></td>
<td class="tg-4k6h" colspan="2"></td>
<td class="tg-4k6h" colspan="2"></td>
<td class="tg-4k6h" colspan="2"></td>
  </tr>
  <tr>
    <td class="tg-l6li"><b>Printed Name:</b></td>
  <td class="tg-91w8" colspan="2"><b>{{$risadmin->name}}</b></td>
  <td class="tg-91w8" colspan="2"><b>MARC REMBRANDT P. VICTORE</b></td>
  <td class="tg-91w8" colspan="2"><b>JERVIS LLOYD M. ATILANO</b></td>
  <td class="tg-91w8" colspan="2"><b>{{$risadmin->name}}</b></td>
  </tr>
  <tr>
  <td class="tg-l6li"><b>Designation:</b></td>
  <td class="tg-91w8" colspan="2"><b>{{$risadmin->position}}</b></td>
  <td class="tg-91w8" colspan="2"><b>OIC, OCD MIMAROPA</b></td>
  <td class="tg-91w8" colspan="2"><b>SUPPLY ACCOUNTABLE OFFICER</b></td>
  <td class="tg-91w8" colspan="2"><b>{{$risadmin->position}}</b></td>

  </tr>
  <tr>
    <td class="tg-l6li"><b>Date:</b></td>
    <td class="tg-91w8" colspan="2">{{ \Carbon\Carbon::parse($risadmin->date)->format('F d, Y') }}</td>
    <td class="tg-91w8" colspan="2">{{ \Carbon\Carbon::parse($risadmin->date)->format('F d, Y') }}</td>
    <td class="tg-91w8" colspan="2">{{ \Carbon\Carbon::parse($risadmin->date)->format('F d, Y') }}</td>
    <td class="tg-91w8" colspan="2">{{ \Carbon\Carbon::parse($risadmin->date)->format('F d, Y') }}</td>

  </tr>
</tbody></table>
</body>
</html>
