<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Guest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index()
{
    $submittedAt = session('form_submitted_at');

    if (!$submittedAt || now()->diffInMinutes($submittedAt) >= 10) {
        session()->forget(['form_submitted', 'form_submitted_at']);
        return redirect()->route('guest.create')->with('error', 'Your session expired. Please submit the form again.');
    }

    // Get the latest guest by date_of_visit
    $guest = Guest::orderBy('date_of_visit', 'desc')->first();

    return view('guests.index', ['guest' => $guest]);
}


    

    public function create (){
        return view('guests.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_of_visit' => 'required|date',
            'name' => 'required|string|max:255',
            'agency' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'gender' => 'required|string',
            'purpose_of_visit' => 'required|string|max:255',
            'e_signature' => 'nullable|string'
        ]);
    
        Guest::create($validated);
    
        // Save submission time and flag
        session([
            'form_submitted' => true,
            'form_submitted_at' => now()
        ]);
    
        return redirect(route('guest.index'))->with('success', 'Thank you for your submission!');
    }


    //fetch data from export pdf 
    public function log (){
        $requestlogs = Guest::all();
         return view('guests.log', ['requestlogs' =>  $requestlogs]); 

    }

    public function delete(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('guest.log')->with('success', 'Guest deleted successfully');
    }


    //generated pdf function
    public function exportSinglePDF($id)
{
    $guest = Guest::findOrFail($id);

    $pdf = Pdf::loadView('guests.pdf', compact('guest')) // Make sure your view file is 'guests/pdf.blade.php'
              ->setPaper('a4', 'portrait')
              ->setOptions([
                  'isHtml5ParserEnabled' => true,
                  'isPhpEnabled' => true,
              ]);

    return $pdf->download("guest-{$guest->id}.pdf"); // use ->download instead of ->stream for download
}



    

    

}
