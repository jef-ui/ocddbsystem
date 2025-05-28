<?php

namespace App\Http\Controllers;
use App\Models\RisAdminCard;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RisAdminCardController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');

    $risadmincards = RisAdminCard::query()
        ->when($search, function ($query, $search) {
            $query->where('date', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('office_agency', 'like', "%{$search}%");
        })
        ->orderBy('date', 'desc')
        ->paginate(5);

    if ($request->ajax()) {
        return response()->json([
            'html' => view('risadmins.index', compact('risadmincards'))->render()
        ]);
    }

    return view('risadmins.index', compact('risadmincards'));
}



    public function create (){
        return view('risadmins.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'fund_cluster' => 'required|string|max:255',
        'date' => 'required|date',
        'name' => 'required|string|max:255',
        'position' => 'nullable|string|max:255',
        'division' => 'required|string|max:255',
        'office_agency' => 'required|string|max:255',
        'unit' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'quantity' => 'required|numeric|min:0',
        'amount_utilized' => 'required|numeric|min:0',
        'balance' => 'required|numeric|min:0',
        'invoice_number' => 'required|string|regex:/^\d+$/',
        'plate_number' => 'required|string|max:255',
        'type_car' => 'required|string|max:255',
        'purpose' => 'required|string|max:255',
        'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
    ]);

    if ($request->hasFile('file_path')) {
        $data['file_path'] = $request->file('file_path')->store('receipts', 'public');
    }

    $risadmin = RisAdminCard::create($data);

    return redirect()->route('risadmin.viewSingle', $risadmin->id);

}

public function delete (RisAdminCard $risadmincard){

    $risadmincard->delete();

    return redirect(route('risadmin.index'))->with('success', 'RIS Deleted Successfully');
}

public function exportSinglePDF($id)
{
    $risadmin = RisAdminCard::findOrFail($id); // Get specific record

    $pdf = Pdf::loadView('risadmins.print', compact('risadmin'))
              ->setPaper('a4', 'portrait')
              ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

    return $pdf->download("RIS-Admin-{$risadmin->id}.pdf");
}

public function viewSinglePDF($id)
{
    $risadmin = RisAdminCard::findOrFail($id);

    $pdf = Pdf::loadView('risadmins.print', compact('risadmin'))
              ->setPaper('a4', 'portrait')
              ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

    return $pdf->stream("RIS-Admin-{$risadmin->id}.pdf");
}







}
