<?php

namespace App\Http\Controllers;

use App\Models\UetRequest;
use App\Models\BafRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UetApplicantController extends Controller
{
    // Applicant Dashboard View
    public function index()
    {
        $userId = Auth::id();

        // Get BAF requests
        $bafRequests = BafRequest::where('created_by', $userId)
            ->with('items')
            ->latest()
            ->get();

        // Get UET requests
        $uetRequests = UetRequest::where('applicant_id', $userId)
            ->with(['items', 'approval'])
            ->latest()
            ->get();

        // Combine and sort by creation date (newest first)
        $requests = $bafRequests->concat($uetRequests)->sortByDesc('created_at');

        return view('applicant.dashboard', compact('requests'));
    }

    // Show Create Form
    public function create()
    {
        return view('applicant.create', [
            'bafRequestId' => request()->integer('baf_request_id') ?: null,
        ]);
    }

    // Store Request with Multiple Items and Attachment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kepada' => 'required|string',
            'daripada' => 'required|string',
            'unit' => 'required|string',
            'jku_bil' => 'nullable|string',
            'tarikh' => 'required|date',
            'nama_pemohon' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
            'items' => 'required|array|min:1',
            'items.*.sub_unit' => 'nullable|string',
            'items.*.nama_barang' => 'required|string',
            'items.*.qty_dipohon' => 'required|integer|min:1',
            'items.*.muka_surat_jku' => 'nullable|string',
            'items.*.pindaan_type' => 'required|string',
            'items.*.alasan' => 'nullable|string',
        ]);

        $action = $request->input('action', 'submit'); // Default to submit if not specified
        $isDraft = ($action === 'draft');

        // Applicant cannot submit OC/QM-only fields. Ignore any tampered client-side values.
        if (Auth::user()->role === 'applicant') {
            $request->merge([
                'ulasan_timb_peg_turus' => null,
                'keputusan_jkg' => null,
                'catatan_jku' => null,
                'keputusan_jku' => null,
                'bilangan_diluluskan' => null,
                'bilangan_tidak_diluluskan' => null,
                'pindaan_bilangan_jku' => null,
                'nama_pembantu_staf_jku' => null,
                'nama_timb_peg_turus_jku' => null,
            ]);
        }

        $uet = DB::transaction(function () use ($validated, $request, $isDraft) {
            // Handle file upload
            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('attachments/uet', 'public');
            }

            $uetData = [
                'applicant_id' => Auth::id(),
                'reference_no' => 'UET-' . strtoupper(Str::random(8)),
                'jku_bil' => $validated['jku_bil'] ?? null,
                'kepada' => $validated['kepada'],
                'daripada' => $validated['daripada'],
                'unit' => $validated['unit'],
                'tarikh' => $validated['tarikh'] ?? now()->toDateString(),
                'nama_pemohon' => $validated['nama_pemohon'] ?? Auth::user()->name,
                'attachment_path' => $attachmentPath,
                'status' => $isDraft ? 'draft' : 'pending_oc',
            ];

            // Assign OC fields if user is OC
            if (Auth::user()->isOc()) {
                $uetData['nama_timb_peg_turus'] = $request->input('nama_timb_peg_turus');
                $uetData['keputusan_jku'] = $request->input('keputusan_jku');
                $uetData['bilangan_diluluskan'] = $request->input('bilangan_diluluskan');
                $uetData['bilangan_tidak_diluluskan'] = $request->input('bilangan_tidak_diluluskan');
                $uetData['nama_setiausaha'] = $request->input('nama_setiausaha');
            }

            $uet = UetRequest::create($uetData);

            foreach ($validated['items'] as $item) {
                $uet->items()->create([
                    'sub_unit' => $item['sub_unit'] ?? null,
                    'nama_barang' => $item['nama_barang'],
                    'qty_dipohon' => $item['qty_dipohon'],
                    'muka_surat_jku' => $item['muka_surat_jku'] ?? null,
                    'pindaan_type' => $item['pindaan_type'],
                    'alasan' => $item['alasan'] ?? null,
                ]);
            }

            if ($request->filled('baf_request_id')) {
                BafRequest::whereKey($request->integer('baf_request_id'))
                    ->where('created_by', Auth::id())
                    ->where('status', 'draft')
                    ->update(['status' => 'pending_oc']);
            }

            return $uet;
        });

        // Handle redirect based on action
        if ($isDraft) {
            return redirect()->route('applicant.dashboard')->with('success', 'Borang UET berjaya disimpan sebagai draf.');
        }

        // On submit, redirect to BAF if user selected "Ya" in the alert
        if ($request->input('redirect_to_baf') === 'true') {
            return redirect()->route('bafq140.create')->with('success', 'Permohonan UET berjaya dihantar! Sekarang sila isi borang BAF Q 140.');
        }

        return redirect()->route('applicant.dashboard')->with('success', 'Permohonan UET berjaya dihantar!');
    }

    // Show Request Details
    public function show($id)
    {
        $uetRequest = UetRequest::with([
            'items', 
            'applicant', 
            'approval.timbPegTurus', 
            'approval.setiausaha'
        ])
        ->where('applicant_id', Auth::id())
        ->findOrFail($id);

        // Jika Blade view guna $uetRequest
        return view('applicant.show', compact('uetRequest'));
    }

    // Process PIN Approval by OC
    public function approveByOc(Request $request, UetRequest $uetRequest)
    {
        $request->validate([
            'approval_pin' => 'required|digits:4',
            'ulasan_timb_peg_turus' => 'nullable|string',
        ]);

        $user = Auth::user();

        if (!$user->approval_pin) {
            return back()->with('error', 'Sila tetapkan PIN keselamatan anda di profil terlebih dahulu.');
        }

        if (!Hash::check($request->approval_pin, $user->approval_pin)) {
            return back()->with('error', 'PIN keselamatan tidak sah. Sila cuba lagi.');
        }

        $uetRequest->approval()->updateOrCreate(
            ['uet_request_id' => $uetRequest->id],
            [
                'timb_peg_turus_id' => $user->id,
                'ulasan_timb_peg_turus' => $request->ulasan_timb_peg_turus,
                'timb_peg_turus_at' => now(),
            ]
        );

        $uetRequest->update(['status' => 'pending_jku']);

        return back()->with('status', 'Borang berjaya disahkan dan ditandatangani!');
    }
}