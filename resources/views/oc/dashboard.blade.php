<x-app-layout>
    <div class="py-6 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Dashboard Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-900">Panel Timb Peg Turus (OC)</h1>
                <p class="text-sm text-slate-600">Semakan dan Pengesahan Borang UET</p>
            </div>

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
                <div class="p-4 border-b border-slate-200 bg-slate-50 font-bold text-slate-800 text-sm">
                    Senarai Borang Menunggu Semakan (Pending Review)
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
                                <tr class="hover:bg-slate-50">
                                    <td class="p-3 font-semibold">{{ $uet->jku_bil ?? 'UET-' . $uet->id }}</td>
                                    <td class="p-3">{{ $uet->nama_pemohon ?? $uet->user->name }}</td>
                                    <td class="p-3 uppercase">{{ $uet->unit }}</td>
                                    <td class="p-3">{{ \Carbon\Carbon::parse($uet->tarikh)->format('d/m/Y') }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-0.5 text-[10px] bg-amber-100 text-amber-800 rounded font-bold">
                                            Menunggu Ulasan
                                        </span>
                                    </td>
                                    <td class="p-3 text-right">
                                        <a href="{{ route('oc.review', $uet->id) }}" 
                                           class="bg-amber-600 text-white px-3 py-1.5 rounded hover:bg-amber-700 font-bold text-xs inline-block">
                                            Semak & Tanda Tangan
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-6 text-center text-slate-500">
                                        Tiada permohonan UET baru yang memerlukan semakan buat masa ini.
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