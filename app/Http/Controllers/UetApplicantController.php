<?php

namespace App\Http\Controllers;

use App\Models\UetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UetApplicantController extends Controller
{
    // Applicant Dashboard View
    public function index()
    {
        $requests = UetRequest::where('applicant_id', Auth::id())
            ->with(['items'])
            ->latest()
            ->paginate(10); 

        return view('applicant.dashboard', compact('requests'));
    }

    // Show Create Form
    public function create()
    {
        return view('applicant.create');
    }

    // Store Request with Multiple Items
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
            'items.*.sub_unit' => 'nullable|string',
            'items.*.nama_barang' => 'required|string',
            'items.*.qty_dipohon' => 'required|integer|min:1',
            'items.*.muka_surat_jku' => 'nullable|string',
            'items.*.pindaan_type' => 'required|string',
            'items.*.alasan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $uetData = [
                'applicant_id' => Auth::id(),
                'reference_no' => 'UET-' . date('Ymd') . '-' . rand(1000, 9999),
                'kepada' => $validated['kepada'],
                'daripada' => $validated['daripada'],
                'unit' => $validated['unit'],
                'jku_bil' => $validated['jku_bil'] ?? null,
                'request_date' => $validated['tarikh'],
                'nama_pemohon' => $validated['nama_pemohon'] ?? null,
                'status' => 'pending_oc_approval',
            ];

            // SECURITY RULE: Only allow updating Section 3, 4, and 5 fields if the current user is an OC
            if (Auth::user()->role === 'oc') {
                // Section 3
                $uetData['nama_timb_peg_turus'] = $request->input('nama_timb_peg_turus');
                
                // Section 4
                $uetData['keputusan_jku'] = $request->input('keputusan_jku');
                $uetData['bilangan_diluluskan'] = $request->input('bilangan_diluluskan');
                $uetData['bilangan_tidak_diluluskan'] = $request->input('bilangan_tidak_diluluskan');
                
                // Section 5
                $uetData['nama_setiausaha'] = $request->input('nama_setiausaha');
            }

            $uet = UetRequest::create($uetData);

            foreach ($validated['items'] as $item) {
                $uet->items()->create([
                    'item_unit' => $item['sub_unit'] ?? null,
                    'nama_barang' => $item['nama_barang'],
                    'qty_dipohon' => $item['qty_dipohon'],
                    'muka_surat_jku' => $item['muka_surat_jku'] ?? null,
                    'status_pindaan' => $item['pindaan_type'],
                    'alasan' => $item['alasan'] ?? null,
                ]);
            }
        });

        return redirect()->route('uet.dashboard')->with('success', 'Permohonan UET berjaya dihantar!');
    }

    // Show Request Details & Status Timeline
    public function show($id)
    {
        $uetRequest = UetRequest::with('items')
            ->where('applicant_id', Auth::id())
            ->findOrFail($id);

        return view('applicant.show', compact('uetRequest'));
    }
}