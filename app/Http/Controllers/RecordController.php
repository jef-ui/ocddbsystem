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

    // Query for the records based on search input
    $records = Record::query()
        ->when($search, function ($query, $search) {
            $query->where('received_date', 'like', "%{$search}%")
                  ->orWhere('received_time', 'like', "%{$search}%")
                  ->orWhere('from_agency_office', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('subject_description', 'like', "%{$search}%")
                  ->orWhere('received_acknowledge_by', 'like', "%{$search}%");
        })
        ->orderBy('received_date', 'desc')    // First by date
        ->orderBy('received_time', 'desc')    // Then by time
        ->paginate(15);

    // Get total counts for each type
    $typeCounts = Record::query()
        ->selectRaw('type, count(*) as count')
        ->whereIn('type', ['Request', 'Invitation', 'Submission', 'For Information', 'For Compliance', 'Report', 'Complaint'])
        ->groupBy('type')
        ->pluck('count', 'type')
        ->toArray();

    // Default values for types that have no records
    $types = [
        'Request' => 0,
        'Invitation' => 0,
        'Submission' => 0,
        'For Information' => 0,
        'For Compliance' => 0,
        'Report' => 0,
        'Complaint' => 0
    ];

    // Merge the counts with the default values
    $typeCounts = array_merge($types, $typeCounts);

    if ($request->ajax()) {
        return response()->json([
            'html' => view('records.index', compact('records', 'typeCounts'))->render()
        ]);
    }

    // Return the view with the records and type counts
    return view('records.index', compact('records', 'typeCounts'));
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

    // Handle file uploads with filename sanitization
    if ($request->hasFile('file_path')) {
        $file = $request->file('file_path');
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
        $data['file_path'] = $file->storeAs('documents', $filename, 'public');
    }

    if ($request->hasFile('file_path1')) {
        $file = $request->file('file_path1');
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
        $data['file_path1'] = $file->storeAs('documents', $filename, 'public');
    }

    if ($request->hasFile('file_path2')) {
        $file = $request->file('file_path2');
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
        $data['file_path2'] = $file->storeAs('documents', $filename, 'public');
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
