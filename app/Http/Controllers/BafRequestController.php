<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BafRequest;
use App\Models\BafRequestItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BafRequestController extends Controller
{
    // 1. Mod Buat Permohonan Baru
    public function create()
    {
        $requestModel = new BafRequest();
        $requestModel->signature_path = auth()->user()->signature_path;
        
        // Tetapkan senarai penuh permission flags untuk form.blade.php
        $permissions = [
            'canEditRequester'      => true,
            'canEditVoteController' => false,
            'canEditAuthoriser'     => false,
            'canEditOc'             => false,
            'canEditQm'             => false,
        ];

        return view('requests.form', array_merge(['requestModel' => $requestModel], $permissions));
    }

    // 2. Mod Papar / Kemaskini Permohonan Sedia Ada
    public function show($id)
    {
        $requestModel = BafRequest::with('items')->findOrFail($id);

        // Use display view for read-only view (Papar mode)
        // This ensures the form cannot be edited from the view
        return view('requests.display', compact('requestModel'));
    }

    // 3. Simpan Permohonan Baru
    public function store(Request $request)
{
        $request->validate([
            'attachment' => ['nullable', 'file', 'mimes:pdf,png,jpg,jpeg', 'max:2048'],
        ]);

    $signaturePath = auth()->user()->signature_path;
        $attachmentPath = $request->hasFile('attachment')
            ? $request->file('attachment')->store('baf-attachments', 'public')
            : null;

    // 1. Simpan Rekod Utama BAF (Tambah field yang hilang)
    $bafRequest = BafRequest::create([
        'created_by'          => auth()->id() ?? 1,
        'reference_no'        => 'REQ-' . time(),
        'requisition_type'    => $request->input('requisition_type'), // STOCK / SERVICES / RETURN
        'unit'                => $request->input('unit_code'),
        'required_by_date'    => $request->input('required_by_date') ?: now()->toDateString(),
        'priority'            => $request->input('priority'),
        'part_issue'          => $request->input('part_issue'),
        'daripada'            => $request->input('requested_by_title'),
        'employee_code'       => $request->input('employee_code'),
        'request_date'        => $request->input('requested_date') ?: now()->toDateString(),
        'status'              => $request->boolean('continue_to_uet') ? 'draft' : 'pending_oc',
        'work_order_no'       => $request->input('work_order_no'),
        'equipment_no'        => $request->input('equipment_no'),
        'vote_sub_head'       => $request->input('vote_sub_head'),
        'picking_slip'        => $request->input('delivery_contact'),
        'delivery_instructions' => $request->input('delivery_instructions'),
        'signature_path'      => $signaturePath,
        'attachment_path'    => $attachmentPath,
        'vote_title'         => $request->input('vote_title'),
        'vote_date'          => $request->input('vote_date'),
        'auth_title'         => $request->input('auth_title'),
        'auth_code'          => $request->input('auth_code'),
        'auth_date'          => $request->input('auth_date'),
    ]);

    // 2. Simpan Item-Item Table (Masukkan semua lajur)
    if ($request->has('items') && is_array($request->items)) {
        foreach ($request->items as $item) {
            if (!empty($item['description'])) {
                $estimatedCost = preg_replace('/[^0-9.-]/', '', (string) ($item['est_cost'] ?? '0'));

                $bafRequest->items()->create([
                    'quantity_demanded' => $item['qty'] ?? 0,
                    'unit_of_measure'   => $item['uom'] ?? null,
                    'req_type_sp'       => $item['req_type'] ?? null,
                    'stock_code'        => $item['stock_code'] ?? null,
                    'suggested_mfr'     => $item['manufacturer'] ?? null,
                    'part_no'           => $item['part_number'] ?? null,
                    'item_description'  => $item['description'],
                    'est_cost'          => $estimatedCost !== '' ? $estimatedCost : 0,
                    'ipc_ref'           => $item['ipc_ref'] ?? null,
                    'equip_used_on'     => $item['equip_used_on'] ?? null,
                    'remarks'           => $item['reason'] ?? null,
                ]);
            }
        }
    }

    if ($request->boolean('continue_to_uet')) {
        return redirect()->route('uet.create', ['baf_request_id' => $bafRequest->id]);
    }

    return redirect()->route('requests.show', $bafRequest)->with('success', 'Borang berjaya disimpan!');
}
}