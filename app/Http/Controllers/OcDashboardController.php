<?php

namespace App\Http\Controllers;

use App\Models\UetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OcDashboardController extends Controller
{
    /**
     * Display the OC Dashboard with pending reviews and stats.
     */
    public function index()
    {
        $pendingReviews = UetRequest::where('status', 'pending_oc')
            ->latest()
            ->get();

        $approvedCount = UetRequest::where('status', 'pending_qm')->count();
        $completedCount = UetRequest::where('status', 'completed')->count();

        return view('oc.dashboard', compact('pendingReviews', 'approvedCount', 'completedCount'));
    }

    /**
     * Show single form review page for OC.
     */
    public function review(UetRequest $uet)
    {
        // Eager load items for performance
        $uet->load('items');

        // Reuses Blade form in OC view mode
        return view('applicant.create', compact('uet'));
    }

    /**
     * Save OC Review, Signature, & Remarks.
     */
    public function updateReview(Request $request, UetRequest $uet)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.ulasan_timb_peg_turus' => 'required|string',
            'nama_timb_peg_turus' => 'required|string|max:255',
            'keputusan_jku' => 'required|in:diluluskan,tidak_diluluskan',
            'bilangan_diluluskan' => 'nullable|integer|min:0',
            'bilangan_tidak_diluluskan' => 'nullable|integer|min:0',
            'nama_setiausaha' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $uet) {
            // Update child item remarks
            foreach ($request->items as $itemId => $itemData) {
                $uet->items()
                    ->where('id', $itemId)
                    ->update([
                        'ulasan_timb_peg_turus' => $itemData['ulasan_timb_peg_turus'],
                    ]);
            }

            // Update main form details and move status to QM
            $uet->update([
                'nama_timb_peg_turus' => $request->nama_timb_peg_turus,
                'keputusan_jku' => $request->keputusan_jku,
                'bilangan_diluluskan' => $request->bilangan_diluluskan ?? 0,
                'bilangan_tidak_diluluskan' => $request->bilangan_tidak_diluluskan ?? 0,
                'nama_setiausaha' => $request->nama_setiausaha,
                'status' => 'pending_qm',
                'reviewed_at_oc' => now(),
            ]);
        });

        return redirect()
            ->route('oc.dashboard')
            ->with('success', 'UET application reviewed and forwarded to JKU successfully.');
    }
}