<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RadioLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;



class RadioLogController extends Controller
{
   
public function index(Request $request)
{
    $search = $request->input('search');

    $radiologs = RadioLog::query()
        ->when($search, function($query, $search) {
            $query->where('received_date', 'like', "%{$search}%")
                ->orWhere('received_time', 'like', "%{$search}%")
                ->orWhere('sender_name', 'like', "%{$search}%")
                ->orWhere('band', 'like', "%{$search}%")
                ->orWhere('mode', 'like', "%{$search}%")
                ->orWhere('signal_strength', 'like', "%{$search}%")
                ->orWhere('receiver_name', 'like', "%{$search}%")
                ->orWhere('notes_remarks', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->simplePaginate(15);

    $totalRadioLogs = RadioLog::count(); 
    
    $totalIncomingCentral = RadioLog::where('sender_name', 'like', '%Central Office%')->count();

    $currentUserName = "OCD MIMAROPA | " . Auth::user()->name;
    $totalMyComsLogs = RadioLog::where('sender_name', $currentUserName)
    ->orWhere('receiver_name', $currentUserName)
    ->count();


    if ($request->ajax()) {
        return view('radiologs.index', compact('radiologs', 'totalRadioLogs', 'totalIncomingCentral', 'totalMyComsLogs'))->render();
    }

    return view('radiologs.index', compact('radiologs', 'totalRadioLogs', 'totalIncomingCentral', 'totalMyComsLogs'));
}




    public function create(){
        return view ('radiologs.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'received_date' => 'required|date',
            'received_time' => 'required|date_format:H:i',
            'sender_name' => 'required|string|max:255',
            'band' => 'required|string|max:255',
            'mode' => 'required|string|max:255',
            'signal_strength' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'notes_remarks' => 'nullable|string|max:255', // notes_remarks is optional
        ]);
    
        RadioLog::create($data);
    
        return redirect(route('radiolog.index'))->with('success', 'Radio Logs  Saved Successfully!');
    }

    public function edit (RadioLog $radiolog){
        return view('radiologs.edit', ['radiolog' => $radiolog]);
    }

    public function update(RadioLog $radiolog, Request $request)
    {
        $data = $request->validate([
            'received_date' => 'required|date',
            'received_time' => 'required|date_format:H:i',
            'sender_name' => 'sometimes|required|string|max:255',
            'band' => 'sometimes|required|string|max:255',
            'mode' => 'sometimes|required|string|max:255',
            'signal_strength' => 'sometimes|required|string|max:255',
            'receiver_name' => 'sometimes|required|string|max:255',
            'notes_remarks' => 'nullable|string|max:255', // notes_remarks is optional
        ]);
    
        $radiolog->update($data);
    
        return redirect(route('radiolog.index'))->with('success', 'Radio Log Updated Successfully');
    }

    public function delete (RadioLog $radiolog){

        $radiolog->delete();

        return redirect(route('radiolog.index'))->with('success', 'Radio Log Deleted Successfully');
    }

    public function print()
        {
            $radiologs = RadioLog::all(); // Get all radio logs from the database
            return view('radiologs.print', compact('radiologs')); // Pass data to the print view
        }

        public function exportPDF()
        {
            $radiologs = RadioLog::all();
            $pdf = Pdf::loadView('radiologs.print', compact('radiologs'))
                      ->setPaper('a4', 'landscape'); // <-- Add this to make it landscape
                      
            return $pdf->download('radiologs.pdf');
        }

}
