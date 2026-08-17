<?php
namespace App\Http\Controllers;

use App\Models\UetRequest;
use Illuminate\Http\Request;

class OcDashboardController extends Controller
{
    // Dashboard View
    public function index()
    {
        $pendingReviews = UetRequest::where('status', 'pending_oc')->latest()->get();
        $approvedCount = UetRequest::where('status', 'pending_qm')->count();
        $completedCount = UetRequest::where('status', 'completed')->count();

        return view('oc.dashboard', compact('pendingReviews', 'approvedCount', 'completedCount'));
    }

    // Single Form Review Page
    public function review($id)
    {
        $uet = UetRequest::with('items')->findOrFail($id);
        return view('applicant.create', compact('uet')); // Reuses your Blade form in OC mode
    }

    // Save OC Review, Signature, & Ulasan
    public function updateReview(Request $request, $id)
    {
        $uet = UetRequest::findOrFail($id);

        $request->validate([
            'items.*.ulasan_timb_peg_turus' => 'required|string',
            'nama_timb_peg_turus' => 'required|string',
            'keputusan_jku' => 'required|in:diluluskan,tidak_diluluskan',
            'nama_setiausaha' => 'required|string',
        ]);

        // Update items (Column j: Ulasan Timb Peg Turus)
        foreach ($request->items as $itemId => $itemData) {
            $uet->items()->where('id', $itemId)->update([
                'ulasan_timb_peg_turus' => $itemData['ulasan_timb_peg_turus']
            ]);
        }

        // Update OC main form fields & advance status
        $uet->update([
            'nama_timb_peg_turus' => $request->nama_timb_peg_turus,
            'keputusan_jku' => $request->keputusan_jku,
            'bilangan_diluluskan' => $request->bilangan_diluluskan,
            'bilangan_tidak_diluluskan' => $request->bilangan_tidak_diluluskan,
            'nama_setiausaha' => $request->nama_setiausaha,
            'status' => 'pending_qm', // Moves task to Quartermaster / JKU
            'reviewed_at_oc' => now(),
        ]);

        return redirect()->route('oc.dashboard')->with('success', 'UET application reviewed and forwarded to JKU.');
    }
}