<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class RecordController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');

    $records = Record::query()
        ->when($search, function ($query, $search) {
            $query->where('received_date', 'like', "%{$search}%")
                  ->orWhere('received_time', 'like', "%{$search}%")
                  ->orWhere('from_agency_office', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('subject_description', 'like', "%{$search}%")
                  ->orWhere('received_acknowledge_by', 'like', "%{$search}%");
        })
        ->orderBy('received_date', 'desc') // Order by the received date in descending order
        ->paginate(15);  // Pagination after 15 records

    if ($request->ajax()) {
        // Return the partial view with updated records (for AJAX request)
        return response()->json([
            'html' => view('records.index', compact('records'))->render()
        ]);
    }

    // For normal requests (non-AJAX)
    return view('records.index', compact('records'));
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

public function delete (Record $record){

    $record->delete();

    return redirect(route('record.index'))->with('success', 'Incoming Communication Deleted Successfully');
}



}
