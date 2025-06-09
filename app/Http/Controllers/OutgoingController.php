<?php

namespace App\Http\Controllers;

use App\Models\Outgoing;
use Illuminate\Http\Request;
use PDO;

class OutgoingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $outgoings = Outgoing::query()
            ->when($search, function ($query, $search){
                $query->where('subject_description', 'like', "%{$search}%")
                        ->orWhere('sent_via', 'like', "%{$search}%")
                        ->orWhere('recipient', 'like', "%{$search}%")
                        ->orWhere('type', 'like', "%{$search}%")
                        ->orWhere('sender', 'like', "%{$search}%")
                        ->orWhere('received_by', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
            })

            ->orderBy('date', 'desc')
            ->paginate(15);

        if ($request->ajax()) {
        return response()->json([
            'html' => view('outgoings.index', compact('outgoings'))->render()
        ]);
    }

    return view('outgoings.index', compact('outgoings'));
}

    public function create(){
        return view('outgoings.create');
    }

    // 
    //public function developer(){
        //return view('outgoings.developer');
    //}

    public function store(Request $request){
    
        $data = $request->validate([

            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'subject_description' => 'required|string|max:1000',
            'sent_via' => 'required|not_in:|string|max:255',
            'recipient' => 'required|string|max:255',
            'type' => 'required|not_in:|string|max:255',
            'status' => 'required|string|max:255',
            'sender' => 'required|not_in:|string|max:255',
            'received_by' => 'nullable|string|max:255',
            'file_path'=> 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,xls,xlsx,jpg,jpeg,png,gif|max:20480',
            'file_path2'=> 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,xls,xlsx,jpg,jpeg,png,gif|max:20480',

        ]);

        if ($request->hasFile('file_path')) {
        $file = $request->file('file_path');
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
        $data['file_path'] = $file->storeAs('documents', $filename, 'public');
    }

    if ($request->hasFile('file_path2')) {
        $file = $request->file('file_path2');
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
        $data['file_path2'] = $file->storeAs('documents', $filename, 'public');
    }

    Outgoing::create($data);

    return redirect(route('outgoing.index'))->with('success', 'Outgoing Communication Logged Successfully');

    }

    public function show ($id){

        $outgoing = Outgoing::findOrFail($id);
        return view('outgoings.show', compact('outgoing'));

    }

    public function showFileTwo ($id){

        $outgoing = Outgoing::findOrFail($id);
        return view('outgoings.showFileTwo', compact('outgoing'));

    }

    



}
