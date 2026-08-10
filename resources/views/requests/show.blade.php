<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Requisition Review') }}</h2>
                <p class="text-sm text-gray-500">Request #{{ $requestModel->id }} • {{ ucfirst($requestModel->status) }}</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-gray-600">Status: {{ ucfirst($requestModel->status) }}</span>
                <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-indigo-700">REQ-2026-0804</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 text-sm text-green-700">{{ session('success') }}</div>
                    @endif

                    <div class="mb-6 rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div class="text-sm font-semibold text-gray-700">Workflow Steps</div>
                            <div class="flex flex-wrap gap-2 text-sm">
                                <span class="rounded-full bg-indigo-600 px-3 py-1 text-white">1. General Information</span>
                                <span class="rounded-full bg-indigo-600 px-3 py-1 text-white">2. Requested Items</span>
                                <span class="rounded-full bg-indigo-600 px-3 py-1 text-white">3. Justification & Delivery</span>
                                <span class="rounded-full bg-gray-200 px-3 py-1 text-gray-600">4. Review & Sign</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <section class="border rounded-lg p-4 bg-white">
                            <h3 class="font-semibold text-gray-800">1. General Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mt-3">
                                <div><strong>Unit Code:</strong> {{ $requestModel->unit_code ?? '-' }}</div>
                                <div><strong>Required By:</strong> {{ optional($requestModel->required_by)->format('Y-m-d') ?? '-' }}</div>
                                <div><strong>Priority:</strong> {{ $requestModel->priority ?? '-' }}</div>
                                <div><strong>Request Type:</strong> {{ $requestModel->user_section['request_type'] ?? '-' }}</div>
                            </div>
                        </section>

                        <section class="border rounded-lg p-4 bg-white">
                            <h3 class="font-semibold text-gray-800">2. Requested Items</h3>
                            <div class="overflow-x-auto mt-3">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-2 py-2 text-xs">#</th>
                                            <th class="px-2 py-2 text-xs">Description</th>
                                            <th class="px-2 py-2 text-xs">Part / Stock No</th>
                                            <th class="px-2 py-2 text-xs">Qty</th>
                                            <th class="px-2 py-2 text-xs">Unit Cost</th>
                                            <th class="px-2 py-2 text-xs">Total</th>
                                            <th class="px-2 py-2 text-xs">Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($requestModel->items ?? [] as $i => $it)
                                            <tr>
                                                <td class="px-2 py-2 text-sm">{{ $i+1 }}</td>
                                                <td class="px-2 py-2 text-sm">{{ $it['description'] ?? '-' }}</td>
                                                <td class="px-2 py-2 text-sm">{{ $it['part_number'] ?? '-' }}</td>
                                                <td class="px-2 py-2 text-sm">{{ $it['qty'] ?? '-' }}</td>
                                                <td class="px-2 py-2 text-sm">{{ $it['est_cost'] ?? '-' }}</td>
                                                <td class="px-2 py-2 text-sm">{{ (($it['qty'] ?? 0) * ($it['est_cost'] ?? 0)) }}</td>
                                                <td class="px-2 py-2 text-sm">{{ $it['reason'] ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>

                        <section class="border rounded-lg p-4 bg-white">
                            <h3 class="font-semibold text-gray-800">3. Justification & Delivery</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                <div>
                                    <div class="text-sm font-semibold text-gray-700">Reason for Demand / Alasan</div>
                                    <p class="mt-2 text-sm text-gray-700">{{ $requestModel->user_section['justification'] ?? 'No justification entered yet.' }}</p>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-700">Delivery / Picking Instructions</div>
                                    <p class="mt-2 text-sm text-gray-700">{{ $requestModel->user_section['delivery_instructions'] ?? 'No instructions entered yet.' }}</p>
                                </div>
                            </div>
                        </section>

                        <section class="border rounded-lg p-4 bg-gray-50">
                            <h3 class="font-semibold text-gray-800">4. Review & Sign</h3>
                            <div class="mt-3 grid gap-3 md:grid-cols-3">
                                <div class="rounded border bg-white p-3">
                                    <div class="text-sm font-semibold">Submitted By</div>
                                    <div class="text-xs text-gray-500">{{ $requestModel->creator->name ?? 'Unknown' }}</div>
                                </div>
                                <div class="rounded border bg-white p-3">
                                    <div class="text-sm font-semibold">Approver Actions</div>
                                    <div class="text-xs text-gray-500">OC, CO, QM, Pegawai and MINDEF actions will appear here.</div>
                                </div>
                                <div class="rounded border bg-white p-3">
                                    <div class="text-sm font-semibold">Digital Timestamp</div>
                                    <div class="text-xs text-gray-500">Approval history is recorded automatically.</div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <hr class="my-4" />

                    <form method="POST" action="{{ route('requests.update', $requestModel) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-6 p-4 border rounded bg-gray-50">
                            <div class="font-semibold">Role-based Action Panel</div>
                            <div class="mt-2 text-sm text-gray-600">The current role will only see the section that applies to them.</div>
                        </div>

                        <div class="mb-6 p-4 border rounded {{ auth()->user()->role_id === 1 ? 'border-blue-400' : 'bg-gray-50' }}">
    <div class="font-semibold">Requester Section</div>
    @php $canEditUser = auth()->user()->role_id === 1 && in_array($requestModel->status, ['draft','returned','submitted']); @endphp
    
    <div class="mt-2">
        <label class="block text-sm font-medium text-gray-700">Unit Code</label>
        <input type="text" name="unit_code" value="{{ old('unit_code', $requestModel->unit_code) }}" class="mt-1 block w-full border-gray-300 rounded-md" {{ $canEditUser ? '' : 'disabled' }} />
    </div>

    @if($canEditUser)
        <div class="mt-3">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded">Save Request</button>
        </div>
    @endif
</div>

                        <div class="mb-6 p-4 border rounded {{ auth()->user()->role_id === 2 ? 'border-indigo-400' : 'bg-gray-50' }}">
                            <div class="font-semibold">OC Section</div>
                            @php $canEditOc = auth()->user()->role_id === 2 && $requestModel->status === 'submitted'; @endphp
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">OC Note</label>
                                <textarea name="oc_note" rows="3" class="mt-1 block w-full border-gray-300 rounded-md" {{ $canEditOc ? '' : 'disabled' }}>{{ old('oc_note', $requestModel->oc_section['note'] ?? '') }}</textarea>
                            </div>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="oc_endorse" value="1" {{ ($requestModel->oc_section['endorsed'] ?? false) ? 'checked' : '' }} {{ $canEditOc ? '' : 'disabled' }} />
                                    <span class="ms-2">Endorse</span>
                                </label>
                            </div>
                            @if($canEditOc)
                                <div class="mt-3">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded">Save OC Decision</button>
                                </div>
                            @endif
                        </div>

                        <div class="mb-6 p-4 border rounded {{ auth()->user()->role_id === 3 ? 'border-teal-400' : 'bg-gray-50' }}">
                            <div class="font-semibold">CO Section</div>
                            @php $canEditCo = auth()->user()->role_id === 3 && $requestModel->status === 'oc_endorsed'; @endphp
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">CO Note</label>
                                <textarea name="co_note" rows="3" class="mt-1 block w-full border-gray-300 rounded-md" {{ $canEditCo ? '' : 'disabled' }}>{{ old('co_note', $requestModel->co_section['note'] ?? '') }}</textarea>
                            </div>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="co_authorize" value="1" {{ ($requestModel->co_section['authorized'] ?? false) ? 'checked' : '' }} {{ $canEditCo ? '' : 'disabled' }} />
                                    <span class="ms-2">Authorize</span>
                                </label>
                            </div>
                            @if($canEditCo)
                                <div class="mt-3">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded">Save CO Decision</button>
                                </div>
                            @endif
                        </div>

                        <div class="mb-6 p-4 border rounded {{ auth()->user()->role_id === 4 ? 'border-amber-400' : 'bg-gray-50' }}">
                            <div class="font-semibold">QM Section</div>
                            @php $canEditQm = auth()->user()->role_id === 4 && $requestModel->status === 'co_authorized'; @endphp
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">QM Note</label>
                                <textarea name="qm_note" rows="3" class="mt-1 block w-full border-gray-300 rounded-md" {{ $canEditQm ? '' : 'disabled' }}>{{ old('qm_note', $requestModel->qm_section['note'] ?? '') }}</textarea>
                            </div>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="qm_verified" value="1" {{ ($requestModel->qm_section['verified'] ?? false) ? 'checked' : '' }} {{ $canEditQm ? '' : 'disabled' }} />
                                    <span class="ms-2">Verify</span>
                                </label>
                            </div>
                            @if($canEditQm)
                                <div class="mt-3">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded">Save QM Decision</button>
                                </div>
                            @endif
                        </div>

                        <div class="mb-6 p-4 border rounded {{ auth()->user()->role_id === 5 ? 'border-purple-400' : 'bg-gray-50' }}">
                            <div class="font-semibold">Pegawai Section</div>
                            @php $canEditPegawai = auth()->user()->role_id === 5 && $requestModel->status === 'qm_verified'; @endphp
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Pegawai Note / Recommendation</label>
                                <textarea name="pegawai_note" rows="3" class="mt-1 block w-full border-gray-300 rounded-md" {{ $canEditPegawai ? '' : 'disabled' }}>{{ old('pegawai_note', $requestModel->pegawai_section['note'] ?? '') }}</textarea>
                            </div>
                            @if($canEditPegawai)
                                <div class="mt-3">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded">Save Pegawai Note</button>
                                </div>
                            @endif
                        </div>

                        <div class="mb-6 p-4 border rounded {{ auth()->user()->role_id === 6 ? 'border-green-400' : 'bg-gray-50' }}">
                            <div class="font-semibold">MINDEF Decision</div>
                            @php $canEditMindef = auth()->user()->role_id === 6 && in_array($requestModel->status, ['pegawai_reviewed','qm_verified']); @endphp
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Decision</label>
                                <select name="mindef_decision" class="mt-1 block w-full border-gray-300 rounded-md" {{ $canEditMindef ? '' : 'disabled' }}>
                                    <option value="approved" {{ ($requestModel->mindef_section['decision'] ?? '') === 'approved' ? 'selected' : '' }}>DILULUSKAN</option>
                                    <option value="rejected" {{ ($requestModel->mindef_section['decision'] ?? '') === 'rejected' ? 'selected' : '' }}>TIDAK DILULUSKAN</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Notes</label>
                                <textarea name="mindef_note" rows="3" class="mt-1 block w-full border-gray-300 rounded-md" {{ $canEditMindef ? '' : 'disabled' }}>{{ old('mindef_note', $requestModel->mindef_section['note'] ?? '') }}</textarea>
                            </div>
                            @if($canEditMindef)
                                <div class="mt-3">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded">Save Final Decision</button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
