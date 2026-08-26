<?php
use Illuminate\Support\Facades\Hash;

public function approveAsTimbPegTurus(Request $request, $uetRequestId)
{
    $request->validate([
        'pin' => ['required', 'digits:4'],
        'ulasan_timb_peg_turus' => ['nullable', 'string'],
    ]);

    $user = auth()->user();

    // 1. Verify User Has Signature Configured
    if (!$user->signature_path || !$user->signature_pin) {
        return back()->withErrors(['pin' => 'Sila muat naik tanda tangan dan tetapkan PIN dalam Profil terlebih dahulu.']);
    }

    // 2. Verify PIN
    if (!Hash::check($request->pin, $user->signature_pin)) {
        return back()->withErrors(['pin' => 'PIN Tanda Tangan tidak sah.']);
    }

    // 3. Process Approval
    $approval = UetApproval::firstOrCreate(['uet_request_id' => $uetRequestId]);
    
    $approval->update([
        'timb_peg_turus_id'        => $user->id,
        'timb_peg_turus_signed_at' => now(),
        'ulasan_timb_peg_turus'    => $request->ulasan_timb_peg_turus,
        'nama_timb_peg_turus'      => $user->name,
    ]);

    return back()->with('success', 'Permohonan berjaya disahkan dengan tanda tangan digital.');
}