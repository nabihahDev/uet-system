<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicantRequest; // Adjust model name as needed

class ApplicantDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Fetch requests for the logged-in user (or empty collection/array if not implemented yet)
        $requests = $request->user()->requests ?? collect(); 

        return view('applicant.dashboard', compact('requests'));
    }
}