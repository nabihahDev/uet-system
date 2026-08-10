<?php

namespace App\Http\Controllers;

use App\Models\BafRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BafRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if (in_array($user->role_id, [2,3,4,5,6])) {
            // roles with queues see all requests for now; filter later by unit/role
            $requests = BafRequest::orderBy('created_at', 'desc')->paginate(15);
        } else {
            $requests = BafRequest::where('created_by', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        }

        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        return view('requests.form', ['requestModel' => new BafRequest]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'unit_code' => 'required|string|max:100',
            'priority' => 'nullable|string|max:50',
            'required_by' => 'nullable|date',
            'request_type' => 'nullable|string|max:50',
            'justification' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*.item_no' => 'nullable|string|max:50',
            'items.*.qty' => 'nullable|integer|min:1',
            'items.*.uom' => 'nullable|string|max:20',
            'items.*.req_type' => 'nullable|string|max:10',
            'items.*.stock_code' => 'nullable|string|max:100',
            'items.*.manufacturer' => 'nullable|string|max:150',
            'items.*.part_number' => 'nullable|string|max:150',
            'items.*.description' => 'nullable|string',
            'items.*.est_cost' => 'nullable|numeric',
            'items.*.ipc_ref' => 'nullable|string|max:150',
            'items.*.equip_used_on' => 'nullable|string|max:150',
            'items.*.reason' => 'nullable|string',
        ]);

        $model = BafRequest::create([
            'unit_code' => $validated['unit_code'],
            'priority' => $validated['priority'] ?? 'normal',
            'required_by' => $validated['required_by'] ?? null,
            'items' => $validated['items'] ?? [],
            'user_section' => [
                'filled_by' => $user->id,
                'filled_at' => now(),
                'request_type' => $validated['request_type'] ?? null,
                'justification' => $validated['justification'] ?? null,
            ],
            'created_by' => $user->id,
            'status' => 'submitted',
        ]);

        return redirect()->route('requests.show', $model)->with('success', 'Request submitted.');
    }

    public function show(BafRequest $requestModel)
    {
        return view('requests.show', ['requestModel' => $requestModel]);
    }

    public function update(Request $request, BafRequest $requestModel)
    {
        $user = $request->user();

        // USER updates own section
        if ($user->role_id === 1) {
            $validated = $request->validate([
                'unit_code' => 'required|string|max:100',
                'required_by' => 'nullable|date',
                'items' => 'nullable|array',
                'items.*.description' => 'nullable|string',
                'items.*.qty' => 'nullable|integer|min:1',
            ]);

            $requestModel->update([
                'unit_code' => $validated['unit_code'],
                'required_by' => $validated['required_by'] ?? $requestModel->required_by,
                'items' => $validated['items'] ?? $requestModel->items ?? [],
                'user_section' => array_merge($requestModel->user_section ?? [], ['updated_by' => $user->id, 'updated_at' => now()]),
                'status' => 'submitted',
            ]);

            return back()->with('success', 'Your section was updated.');
        }

        // OC endorsement
        if ($user->role_id === 2) {
            $validated = $request->validate([
                'oc_note' => 'nullable|string',
                'oc_endorse' => 'nullable|in:0,1',
            ]);

            $ocData = array_merge($requestModel->oc_section ?? [], ['note' => $validated['oc_note'] ?? null, 'endorsed' => (int)($validated['oc_endorse'] ?? 0), 'by' => $user->id, 'at' => now()]);
            $requestModel->oc_section = $ocData;
            $requestModel->status = ($ocData['endorsed'] ? 'oc_endorsed' : 'returned');
            $requestModel->save();

            return back()->with('success', 'OC decision recorded.');
        }

        // CO authorization
        if ($user->role_id === 3) {
            $validated = $request->validate([
                'co_note' => 'nullable|string',
                'co_authorize' => 'nullable|in:0,1',
            ]);

            $coData = array_merge($requestModel->co_section ?? [], ['note' => $validated['co_note'] ?? null, 'authorized' => (int)($validated['co_authorize'] ?? 0), 'by' => $user->id, 'at' => now()]);
            $requestModel->co_section = $coData;
            $requestModel->status = ($coData['authorized'] ? 'co_authorized' : 'co_rejected');
            $requestModel->save();

            return back()->with('success', 'CO decision recorded.');
        }

        // QM verification
        if ($user->role_id === 4) {
            $validated = $request->validate([
                'qm_note' => 'nullable|string',
                'qm_verified' => 'nullable|in:0,1',
            ]);

            $qmData = array_merge($requestModel->qm_section ?? [], ['note' => $validated['qm_note'] ?? null, 'verified' => (int)($validated['qm_verified'] ?? 0), 'by' => $user->id, 'at' => now()]);
            $requestModel->qm_section = $qmData;
            $requestModel->status = ($qmData['verified'] ? 'qm_verified' : 'qm_stop');
            $requestModel->save();

            return back()->with('success', 'QM verification recorded.');
        }

        // Pegawai review
        if ($user->role_id === 5) {
            $validated = $request->validate([
                'pegawai_note' => 'nullable|string',
            ]);

            $pegawaiData = array_merge($requestModel->pegawai_section ?? [], ['note' => $validated['pegawai_note'] ?? null, 'by' => $user->id, 'at' => now()]);
            $requestModel->pegawai_section = $pegawaiData;
            $requestModel->status = 'pegawai_reviewed';
            $requestModel->save();

            return back()->with('success', 'Pegawai review saved.');
        }

        // MINDEF final decision
        if ($user->role_id === 6) {
            $validated = $request->validate([
                'mindef_decision' => 'required|in:approved,rejected',
                'mindef_note' => 'nullable|string',
            ]);

            $mindef = ['decision' => $validated['mindef_decision'], 'note' => $validated['mindef_note'] ?? null, 'by' => $user->id, 'at' => now()];
            $requestModel->mindef_section = $mindef;
            $requestModel->status = ($validated['mindef_decision'] === 'approved') ? 'approved' : 'rejected';
            $requestModel->save();

            return back()->with('success', 'Final decision recorded.');
        }

        abort(403);
    }
}
