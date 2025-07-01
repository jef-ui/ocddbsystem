<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OcdDirectory;

class OcdDirectoryController extends Controller
{
    public function index (){
            $submittedAt = session('form_submitted_at');

    if (!$submittedAt || now()->diffInMinutes($submittedAt) >= 10) {
        session()->forget(['form_submitted', 'form_submitted_at']);
        return redirect()->route('ocddirectory.create')->with('error', 'Your session expired. Please submit the form again.');
    }

    return view('ocddirectories.index');

    }

    public function create (){
        return view ('ocddirectories.create');
    }

    public function store (Request $request){
        
        $data = $request->validate([

            'agency' => 'required|string|max:255',
            'regionaldirector' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'hotline' => 'required|string|max:255',
            'govmail' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

           session([
            'form_submitted' => true,
            'form_submitted_at' => now()
        ]);

        OcdDirectory::create($data);

        return redirect (route('ocddirectory.index'))->with('success', 'Thank you! Your directory information has been added to our system');
        
    }
}
