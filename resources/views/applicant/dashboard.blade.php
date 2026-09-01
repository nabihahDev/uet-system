<x-app-layout>
    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Notification Success Message -->
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-md flex items-center justify-between text-sm shadow-sm" role="alert">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button type="button" class="text-emerald-600 hover:text-emerald-800 font-bold" onclick="this.parentElement.remove();">&times;</button>
                </div>
            @endif



            <!-- Quick Summary Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Requests -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Jumlah Permohonan</p>
                            <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $requests->count() }}</h3>
                        </div>
                        <div class="w-10 h-10 bg-slate-100 rounded border border-slate-200 flex items-center justify-center text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- In Progress -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Dalam Semakan</p>
                            <h3 class="text-2xl font-bold text-amber-600 mt-1">
                                {{ $requests->whereNotIn('status', ['draft', 'approved', 'rejected'])->count() }}
                            </h3>
                        </div>
                        <div class="w-10 h-10 bg-amber-50 rounded border border-amber-200 flex items-center justify-center text-amber-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Approved -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Diluluskan</p>
                            <h3 class="text-2xl font-bold text-emerald-600 mt-1">
                                {{ $requests->where('status', 'approved')->count() }}
                            </h3>
                        </div>
                        <div class="w-10 h-10 bg-emerald-50 rounded border border-emerald-200 flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Drafts -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Draf</p>
                            <h3 class="text-2xl font-bold text-slate-700 mt-1">
                                {{ $requests->where('status', 'draft')->count() }}
                            </h3>
                        </div>
                        <div class="w-10 h-10 bg-slate-100 rounded border border-slate-200 flex items-center justify-center text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MAIN TABLE CARD: Request History -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-base font-bold text-slate-800 uppercase tracking-tight">Senarai Permohonan UET & BAF Q 140</h2>
                    <p class="text-xs text-slate-500">Rekod rasmi borang permohonan yang telah dibuat.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-700">
                        <thead class="bg-slate-100 text-slate-700 font-bold uppercase tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="py-3 px-6">No. Rujukan</th>
                                <th class="py-3 px-6">Unit</th>
                                <th class="py-3 px-6">Tarikh</th>
                                <th class="py-3 px-6 text-center">Bil. Barang</th>
                                <th class="py-3 px-6">Status</th>
                                <th class="py-3 px-6 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse($requests as $request)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-3.5 px-6 font-semibold text-slate-900 font-mono">
                                        {{ $request->reference_no }}
                                    </td>
                                    <td class="py-3.5 px-6">
                                        <div class="font-semibold text-slate-800">{{ $request->unit }}</div>
                                        <div class="text-[11px] text-slate-500">{{ $request->daripada }}</div>
                                    </td>
                                    <td class="py-3.5 px-6 text-slate-600">
                                        {{ \Carbon\Carbon::parse($request->request_date)->format('d M Y') }}
                                    </td>
                                    <td class="py-3.5 px-6 text-center">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                            {{ $request->items->count() }} Item
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-6">
                                        @switch($request->status)
                                            @case('draft')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Draf
                                                </span>
                                                @break
                                            @case('submitted')
                                            @case('pending_oc')
                                            @case('pending_oc_approval')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Dalam Semakan OC
                                                </span>
                                                @break
                                            @case('pending_co')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-semibold bg-indigo-50 text-indigo-800 border border-indigo-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span> Dalam Semakan CO
                                                </span>
                                                @break
                                            @case('pending_qm')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Semakan Quartermaster
                                                </span>
                                                @break
                                            @case('pending_pegawai')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-semibold bg-purple-50 text-purple-800 border border-purple-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span> Semakan Pegawai
                                                </span>
                                                @break
                                            @case('pending_mindef')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-semibold bg-sky-50 text-sky-800 border border-sky-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-600"></span> Keputusan MINDEF
                                                </span>
                                                @break
                                            @case('approved')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Diluluskan
                                                </span>
                                                @break
                                            @case('rejected')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span> Ditolak
                                                </span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-300">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="py-3.5 px-6 text-right">
                                        @if($request instanceof \App\Models\BafRequest)
    {{-- Route untuk BAF Q 140 --}}
    <a href="{{ route('requests.show', $request->id) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-slate-700 hover:text-slate-900 transition-colors bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded border border-slate-300">
        Papar
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </a>
@else
    {{-- Route untuk UET --}}
    <a href="{{ route('uet.show', $request->id) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-slate-700 hover:text-slate-900 transition-colors bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded border border-slate-300">
        Papar
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </a>
@endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-3">
                                            <div class="w-12 h-12 bg-slate-100 rounded-full border border-slate-200 flex items-center justify-center text-slate-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            </div>
                                            <p class="text-sm font-bold text-slate-700">Tiada Permohonan Dijumpai</p>
                                            <p class="text-xs text-slate-500 max-w-sm">Anda belum membuat sebarang permohonan UET atau BAF Q 140.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>