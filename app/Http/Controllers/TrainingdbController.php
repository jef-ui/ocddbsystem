<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainingdb;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TrainingdbController extends Controller
{
    public function index (Request $request){

        $search = $request->input ('search');

        $trainingdbs = Trainingdb::query()
            ->when($search, function ($query, $search) {
                $query->where('training_title', 'like', "%{$search}%")
                      ->orwhere('ims_number', 'like', "%{$search}%")
                      ->orwhere('training_type', 'like', "%{$search}%")
                      ->orwhere('province', 'like', "%{$search}%")
                      ->orwhere('municipality', 'like', "%{$search}%")
                      ->orwhere('sector', 'like', "%{$search}%")
                      ->orwhere('funding', 'like', "%{$search}%")
                      ->orwhere('date_from', 'like', "%{$search}%")
                      ->orwhere('date_until', 'like', "%{$search}%")
                      ->orwhere('venue', 'like', "%{$search}%")
                      ->orwhere('ocd_personnel', 'like', "%{$search}%");         
            })
            ->orderBy ('id', 'desc')
            ->paginate(15);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('trainingdbs.index', compact('trainingdbs'))->render()
            ]);
        }    

        return view('trainingdbs.index', compact('trainingdbs'));

    }

     public function create (){
        return view('trainingdbs.create');
    }

    public function store (Request $request){

        $data = $request->validate([

            'training_title' => 'required|string|max:255',
            'ims_number' => 'required|string|max:255',
            'training_type'=> 'required|string|max:255',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'funding' => 'required|string|max:255',
            'date_from'=> 'required|date',
            'date_until'=> 'required|date',
            'venue' => 'required|string|max:255',
            'number_graduates'=> 'required|numeric|min:0',
            'number_participation'=> 'required|numeric|min:0',
            'ocd_personnel' => 'required|string|max:255',
            'file_path'=> 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,xls,xlsx|max:20480',
            'file_path1'=> 'nullable|file|mimes:pdf,mp4,avi,mov,doc,docx,xls,xlsx|max:20480',
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

    Trainingdb::create($data);

    return redirect(route('trainingdb.index'))->with('success', 'Training Database Logged Successfully');

    }

    public function show ($id){

        $trainingdb = Trainingdb::findOrFail($id);
        return view ('trainingdbs.show', compact('trainingdb'));

    }

    public function generateIMSNumber(Request $request)
{
    $title = $request->input('title');
    $year = now()->year;

    // Count how many existing records with the same title and current year
    $count = Trainingdb::where('training_title', $title)
                ->whereYear('created_at', $year)
                ->count() + 1;

    // Pad the count with leading zero if less than 10
    $formattedCount = str_pad($count, 2, '0', STR_PAD_LEFT);

    // Format: BICS-OCDMIMAROPA-01-2025
    $ims_number = "{$title}-OCDMIMAROPA-{$formattedCount}-{$year}";

    return response()->json(['ims_number' => $ims_number]);
}


    public function delete (Trainingdb $trainingdb){

        $trainingdb->delete();

        return redirect(route('trainingdb.index'))->with('success', 'Training Database Deleted Successfully');
    }


}
