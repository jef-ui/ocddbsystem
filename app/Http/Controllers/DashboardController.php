<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RadioLog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Total logs
        $totalRadioLogs = RadioLog::count(); 

        // Logs from Central Office
        $totalIncomingCentral = RadioLog::where('sender_name', 'like', '%Central Office%')->count();

        // Logs related to the current user
        $currentUserName = "OCD MIMAROPA | " . Auth::user()->name;
        $totalMyComsLogs = RadioLog::where('sender_name', $currentUserName)
            ->orWhere('receiver_name', $currentUserName)
            ->count();

        // You can also add logic for Today and This Week if needed later

        return view('dashboard', compact('totalRadioLogs', 'totalIncomingCentral', 'totalMyComsLogs'));
    }
}
