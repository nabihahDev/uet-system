<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BafRequest;
use App\Models\UetRequest;
use Illuminate\Support\Facades\Auth;

class ApplicantDashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // 1. Dapatkan BAF bersama itemnya (Guna 'created_by')
        $bafRequests = BafRequest::where('created_by', $userId)
                        ->with('items')
                        ->latest()
                        ->get();

        // 2. Dapatkan UET bersama itemnya (Guna 'applicant_id')
        $uetRequests = UetRequest::where('applicant_id', $userId)
                        ->with('items')
                        ->latest()
                        ->get();

        // 3. Gabungkan dan susun mengikut tarikh permohonan terkini
        $requests = $bafRequests->concat($uetRequests)->sortByDesc('created_at');

        return view('applicant.dashboard', compact('requests'));
    }
}