<?php

namespace App\Http\Controllers;

use App\Models\UetRequest;
use App\Models\UetItem;
use App\Models\UetApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UetRequestController extends Controller
{
    // Render the form view (Create or Edit mode)
    public function show(Request $request, $id = null)
    {
        $uetRequest = null;
        if ($id) {
            $uetRequest = UetRequest::with(['items', 'approval'])->findOrFail($id);
        }

        return view('uet.form', compact('uetRequest'));
    }

    // Step 1: Save new request from Pemohon
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kepada' => 'required|string',
            'daripada' => 'required|string',
            'unit' => 'required|string',
            'jku_bil' => 'nullable|string',
            'tarikh' => 'required|date',
            'nama_pemohon' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.nama_barang' => 'required|string',
            'items.*.qty_dipohon' => 'required|integer',
        ]);

        DB::transaction(function () use ($request, $validated) {
            // Save main request using applicant_id
            $uet = UetRequest::create([
                'applicant_id' => auth()->id(),
                'kepada' => $validated['kepada'],
                'daripada' => $validated['daripada'],
                'unit' => $validated['unit'],
                'jku_bil' => $validated['jku_bil'],
                'tarikh' => $validated['tarikh'],
                'nama_pemohon' => $validated['nama_pemohon'],
                'status' => $request->action === 'submit' ? 'pending_oc' : 'draft',
            ]);

            // Save line items
            foreach ($request->items as $item) {
                $uet->items()->create([
                    'sub_unit' => $item['sub_unit'] ?? null,
                    'nama_barang' => $item['nama_barang'],
                    'qty_dipohon' => $item['qty_dipohon'],
                    'dalam_simpanan_ada' => isset($item['dalam_simpanan_ada']),
                    'dalam_simpanan_tiada' => isset($item['dalam_simpanan_tiada']),
                    'muka_surat_jku' => $item['muka_surat_jku'] ?? null,
                    'pindaan_type' => $item['pindaan_type'] ?? 'BARU',
                    'alasan' => $item['alasan'] ?? null,
                ]);
            }

            // Create blank approval record
            $uet->approval()->create([]);
        });

        return redirect()->route('uet.index')->with('success', 'Borang UET berjaya dihantar!');
    }

    // Step 2: Handle updates for OC / QM or edits by Pemohon
    public function update(Request $request, $id)
    {
        $uet = UetRequest::with('approval')->findOrFail($id);
        $userRole = auth()->user()->role;

        DB::transaction(function () use ($request, $uet, $userRole) {
            // Update by OC Role
            if ($userRole === 'oc') {
                $uet->approval()->updateOrCreate(
                    ['uet_request_id' => $uet->id],
                    [
                        'ulasan_timb_peg_turus' => $request->ulasan_timb_peg_turus,
                        'nama_timb_peg_turus' => $request->nama_timb_peg_turus,
                        'keputusan_jku' => $request->keputusan_jku,
                        'bilangan_diluluskan' => $request->bilangan_diluluskan,
                        'bilangan_tidak_diluluskan' => $request->bilangan_tidak_diluluskan,
                        'nama_setiausaha' => $request->nama_setiausaha,
                    ]
                );
                $uet->update(['status' => 'pending_qm']);
            } 
            // Update by QM Role
            elseif ($userRole === 'qm') {
                $uet->approval()->updateOrCreate(
                    ['uet_request_id' => $uet->id],
                    [
                        'keputusan_jkg' => $request->keputusan_jkg,
                        'catatan_jku' => $request->catatan_jku,
                        'pindaan_bilangan_jku' => $request->pindaan_bilangan_jku,
                        'nama_pembantu_staf_jku' => $request->nama_pembantu_staf_jku,
                        'nama_timb_peg_turus_jku' => $request->nama_timb_peg_turus_jku,
                    ]
                );
                $uet->update(['status' => 'completed']);
            }
        });

        return back()->with('success', 'Kemaskini borang berjaya disimpan!');
    }
}