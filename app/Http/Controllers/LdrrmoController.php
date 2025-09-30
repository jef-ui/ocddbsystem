<?php

namespace App\Http\Controllers;

use App\Models\Ldrrmo;
use Illuminate\Http\Request;

class LdrrmoController extends Controller
{
    //

    public function index(Request $request)
{
    $search = $request->input('search');

    $ldrrmos = Ldrrmo::query()
        ->when($search, function ($query, $search) {
            $query->where('agency_name', 'like', "%{$search}%")
                  ->orWhere('head_name', 'like', "%{$search}%")
                  ->orWhere('office_address', 'like', "%{$search}%")
                  ->orWhere('contact_number', 'like', "%{$search}%")
                  ->orWhere('alt_contact_number', 'like', "%{$search}%")
                  ->orWhere('official_email_add', 'like', "%{$search}%")
                  ->orWhere('alt_email_add', 'like', "%{$search}%");
        })
        ->paginate(80);

    if ($request->ajax()) {
        return response()->json([
            'html' => view('ldrrmos.index', compact('ldrrmos'))->render()
        ]);
    }

    return view('ldrrmos.index', compact('ldrrmos'));
}


    public function store (Request $request){
        $data = $request->validate([


            'agency_name' => 'required|string|max:255',
            'head_name' => 'required|string|max:255',
            'office_address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'alt_contact_number' => 'required|string|max:255',
            'official_email_add' => 'required|string|max:255',
            'alt_email_add' => 'required|string|max:255',

        ]);

        Ldrrmo::create($data);

        return redirect (route('ldrrmo.index'))->with('success', 'Contact Added Successfully!');
    }
}
