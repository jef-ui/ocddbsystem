<?php

namespace App\Http\Controllers;

use App\Models\Record;  // Assuming you have a Record model
use App\Models\RadioLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Total radio logs
        $totalRadioLogs = RadioLog::count(); 

        // Logs from Central Office
        $totalIncomingCentral = RadioLog::where('sender_name', 'like', '%Central Office%')->count();

        // Logs related to the current user
        $currentUserName = "OCD MIMAROPA | " . Auth::user()->name;
        $totalMyComsLogs = RadioLog::where('sender_name', $currentUserName)
            ->orWhere('receiver_name', $currentUserName)
            ->count();

        // Fetching the total count for each type of communication (Request, Invitation, etc.)
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

        // Total number of records in the system
        $totalLogs = Record::count();  // Counting all records in the Record model

        // Returning the view with the necessary data
        return view('dashboard', compact(
            'totalRadioLogs', 
            'totalIncomingCentral', 
            'totalMyComsLogs', 
            'typeCounts', 
            'totalLogs'  // Passing the totalLogs variable to the view
        ));
    }
}
