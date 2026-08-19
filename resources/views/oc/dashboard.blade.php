<x-app-layout>
    <div class="py-6 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Dashboard Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-900">Panel Timb Peg Turus (OC)</h1>
                <p class="text-sm text-slate-600">Semakan dan Pengesahan Borang UET</p>
            </div>

            <!-- Flash Success Message -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-md text-sm font-medium flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Stats Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 border border-amber-300 rounded shadow-sm border-l-4 border-l-amber-500">
                    <div class="text-xs text-slate-500 uppercase font-semibold">Perlu Semakan / Tinjauan</div>
                    <div class="text-2xl font-bold text-slate-900 mt-1">{{ $pendingReviews->count() }}</div>
                </div>
                <div class="bg-white p-4 border border-slate-200 rounded shadow-sm border-l-4 border-l-emerald-500">
                    <div class="text-xs text-slate-500 uppercase font-semibold">Dihantar ke JKU / QM</div>
                    <div class="text-2xl font-bold text-slate-900 mt-1">{{ $approvedCount }}</div>
                </div>
                <div class="bg-white p-4 border border-slate-200 rounded shadow-sm border-l-4 border-l-blue-500">
                    <div class="text-xs text-slate-500 uppercase font-semibold">Selesai Sepenuhnya</div>
                    <div class="text-2xl font-bold text-slate-900 mt-1">{{ $completedCount }}</div>
                </div>
            </div>

            <!-- Pending Review Requests Table -->
            <div class="bg-white border border-slate-300 rounded shadow-sm overflow-hidden">
                <div class="p-4 border-b border-slate-200 bg-slate-50 font-bold text-slate-800 text-sm flex items-center justify-between">
                    <span>Senarai Borang Menunggu Semakan (Pending Review)</span>
                    <span class="text-xs bg-slate-200 text-slate-700 font-semibold px-2 py-0.5 rounded-full">
                        {{ $pendingReviews->count() }} Tugasan
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="bg-slate-100 text-slate-700 uppercase font-bold border-b border-slate-300">
                            <tr>
                                <th class="p-3">Bil / Ref</th>
                                <th class="p-3">Pemohon</th>
                                <th class="p-3">Unit</th>
                                <th class="p-3">Tarikh Mohon</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($pendingReviews as $uet)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-3 font-semibold text-slate-900">{{ $uet->jku_bil ?? 'UET-' . $uet->id }}</td>
                                    <td class="p-3">{{ $uet->nama_pemohon ?? optional($uet->user)->name ?? 'N/A' }}</td>
                                    <td class="p-3 uppercase font-medium">{{ $uet->unit ?? '-' }}</td>
                                    <td class="p-3">{{ $uet->tarikh ? \Carbon\Carbon::parse($uet->tarikh)->format('d/m/Y') : '-' }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-0.5 text-[10px] bg-amber-100 text-amber-800 rounded font-bold">
                                            Menunggu Ulasan
                                        </span>
                                    </td>
                                    <td class="p-3 text-right">
                                        <a href="{{ route('oc.review', $uet->id) }}" 
                                           class="bg-amber-600 text-white px-3 py-1.5 rounded hover:bg-amber-700 font-bold text-xs inline-flex items-center gap-1 shadow-sm transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            <span>Semak & Tanda Tangan</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-sm font-medium">Tiada permohonan UET baru yang memerlukan semakan buat masa ini.</p>
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