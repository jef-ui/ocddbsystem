<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RadioLog;


class RadioLogController extends Controller
{
    public function index(){
        $radiologs = RadioLog::all();
        return view('radiologs.index', ['radiologs' => $radiologs]);
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
    
        return redirect(route('radiolog.index'))->with('success', 'Radio Log saved successfully!');
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
}
