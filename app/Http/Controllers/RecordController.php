<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class RecordController extends Controller
{
    public function index(){
        $records = Record::all();
        return view('records.index', ['records' => $records]);
    }

    public function create(){

        return view('records.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'received_date' => 'required|date',
        'received_time' => 'required|date_format:H:i',
        'received_via' => 'required|string|max:255',
        'from_agency_office' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'subject_description' => 'required|string|max:1000',
        'received_acknowledge_by' => 'required|string|max:255',
        'status_as_of_date' => 'required|date',
        'action_taken' => 'required|string|max:1000',
        'concerned_section_personnel' => 'required|string|max:255',
        'deadline_of_compliance' => 'required|date',
        'compliance_status' => 'required|string|max:100',
        'file_path' => 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,xls,xlsx|max:20480',
        'file_path1' => 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,xls,xlsx|max:20480',
        'file_path2' => 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,xls,xlsx|max:20480',
    ]);

    // Handle file uploads
    if ($request->hasFile('file_path')) {
        $data['file_path'] = $request->file('file_path')->store('documents', 'public');
    }

    if ($request->hasFile('file_path1')) {
        $data['file_path1'] = $request->file('file_path1')->store('documents', 'public');
    }

    if ($request->hasFile('file_path2')) {
        $data['file_path2'] = $request->file('file_path2')->store('documents', 'public');
    }

    Record::create($data);

    return redirect(route('record.index'))->with('success', 'Incoming Communication Logged Successfully');
}

public function showAttachments($id)
{
    $record = Record::findOrFail($id);
    return view('records.attachments', compact('record'));
}

public function show($id)
{
    $record = Record::findOrFail($id);
    return view('records.show', compact('record'));
}



}
