<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\RadioLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
{
    $totalRadioLogs = RadioLog::count();
    $totalIncomingCentral = RadioLog::where('sender_name', 'like', '%Central Office%')->count();

    $currentUserName = Auth::user()->name;

    $totalMyComsLogs = RadioLog::where('sender_name', 'OCD MIMAROPA | ' . $currentUserName)
        ->orWhere('receiver_name', 'OCD MIMAROPA | ' . $currentUserName)
        ->count();

    $typeCounts = Record::query()
        ->selectRaw('type, count(*) as count')
        ->whereIn('type', ['Request', 'Invitation', 'Submission', 'For Information', 'For Compliance', 'Report', 'Complaint'])
        ->groupBy('type')
        ->pluck('count', 'type')
        ->toArray();

    $types = [
        'Request' => 0,
        'Invitation' => 0,
        'Submission' => 0,
        'For Information' => 0,
        'For Compliance' => 0,
        'Report' => 0,
        'Complaint' => 0
    ];

    $typeCounts = array_merge($types, $typeCounts);
    $totalLogs = Record::count();

    // Filter out 'Complied' and 'Review' status
    $myAssignedRecords = Record::where('concerned_section_personnel', $currentUserName)
        ->whereNotIn('compliance_status', ['Complied', 'Review'])
        ->latest()
        ->take(10)
        ->get();

    return view('dashboard', compact(
        'totalRadioLogs',
        'totalIncomingCentral',
        'totalMyComsLogs',
        'typeCounts',
        'totalLogs',
        'myAssignedRecords'
    ));
}


}
