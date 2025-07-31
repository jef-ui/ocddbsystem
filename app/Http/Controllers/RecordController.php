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
                  ->orWhere('concerned_section_personnel', 'like', "%{$search}%")
                  ->orWhere('received_acknowledge_by', 'like', "%{$search}%");
        })
        ->orderBy('received_date', 'desc')
        ->orderBy('received_time', 'desc')
        ->paginate(80)
        ->withQueryString(); // 🔥 Keeps the ?search=... in pagination links


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

    public function edit(Record $record){
        return view('records.edit', ['record' => $record]);
    }

public function store(Request $request)
{
    $request->validate([
        'received_date' => 'required|date',
        'received_time' => 'required|date_format:H:i',
        'received_via' => 'required|not_in:|string|max:255',
        'from_agency_office' => 'required|string|max:255',
        'type' => 'required|not_in:|string|max:255',
        'subject_description' => 'required|string|max:1000',
        'received_acknowledge_by' => 'required|string|max:255',
        'status_as_of_date' => 'nullable|date',
        'action_taken' => 'required|string|max:1000',
        'concerned_section_personnel' => 'required|not_in:|string|max:255',
        'deadline_of_compliance' => 'nullable|date',
        'compliance_status' => 'required|string|max:100',
        'files.*' => 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,xls,xlsx,jpg,jpeg,png,gif|max:20480',
    ]);

    $data = $request->except('files');

    if ($request->hasFile('files')) {
    foreach ($request->file('files') as $index => $file) {
        if ($index > 9) break; // Limit to 10 files
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
        $path = $file->storeAs('documents', $filename, 'public');
        $column = $index === 0 ? 'file_path' : 'file_path' . $index;
        $data[$column] = $path;
    }
}


    Record::create($data);

    return redirect()->route('record.index')->with('success', 'Incoming Communication Logged Successfully');
}

public function update(Record $record, Request $request)
{
    $request->validate([
        'concerned_section_personnel' => 'required|string|max:255|not_in:',
        'deadline_of_compliance' => 'nullable|date',
        'compliance_status' => 'required|string|max:100',
        'files.*' => 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,xls,xlsx,jpg,jpeg,png,gif|max:20480',
    ]);

    $data = $request->except('files');

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $index => $file) {
            if ($index > 9) break;
            $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('documents', $filename, 'public');
            $column = $index === 0 ? 'file_path' : 'file_path' . $index;

            if ($record->$column && Storage::disk('public')->exists($record->$column)) {
                Storage::disk('public')->delete($record->$column);
            }

            $data[$column] = $path;
        }
    }

    for ($i = 0; $i < 10; $i++) {
        $column = $i === 0 ? 'file_path' : 'file_path' . $i;
        if (!isset($data[$column])) {
            $data[$column] = $record->$column;
        }
    }

    $record->update($data);

    return redirect()->route('record.index')->with('success', 'Incoming Communication Updated Successfully.');
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
