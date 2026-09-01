<x-display-layout>
    {{-- CSS Khas Untuk Cetakan --}}
    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 8mm;
            }
            
            /* Hide app layout navigation and header */
            header, nav, .navbar, [role="navigation"], .nav-primary, .nav-secondary {
                display: none !important;
            }
            
            /* Reset body styling for print */
            body {
                background: white !important;
                color: black !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            
            /* Hide all non-print elements */
            .print\:hidden {
                display: none !important;
            }
            .print\:shadow-none {
                box-shadow: none !important;
            }
            .print\:border-none {
                border: none !important;
            }
            .print\:p-0 {
                padding: 0 !important;
            }
            .page-break-inside-avoid {
                break-inside: avoid;
            }
        }
    </style>

    <div class="py-4 md:py-6 bg-slate-200 min-h-screen text-slate-900 font-sans text-xs print:bg-white print:min-h-0 print:p-0">
        <div class="max-w-7xl mx-auto bg-white p-4 md:p-8 shadow-md border border-slate-400 print:shadow-none print:border-none print:p-0">

            <!-- HEADER ACTIONS / NAVIGATION -->
            <div class="flex justify-between items-center mb-4 print:hidden">
                <a href="{{ route('applicant.dashboard') }}" class="px-4 py-1.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded transition-colors inline-flex items-center gap-1">
                    &larr; Kembali
                </a>
                <div class="flex gap-2">
                    <button onclick="window.print()" class="px-4 py-1.5 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded shadow transition-all inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak / Simpan PDF
                    </button>
                </div>
            </div>

            <!-- FLASH STATUS MESSAGES -->
            @if(session('status'))
                <div class="mb-4 p-3 bg-emerald-100 border border-emerald-400 text-emerald-800 rounded font-semibold print:hidden flex items-center justify-between">
                    <span>{{ session('status') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-3 bg-rose-100 border border-rose-400 text-rose-800 rounded font-semibold print:hidden flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- FORM HEADER -->
            <div class="flex justify-between items-start mb-2">
                <h1 class="text-xl font-bold uppercase tracking-tight">Borang UET</h1>
                <div class="text-right text-[10px] font-semibold text-slate-700 leading-tight">
                    CERAIAN 'B' KEPADA MATERIAL<br>
                    REGULATIONS 1102
                </div>
            </div>

            <div class="text-center font-bold text-sm uppercase mb-3 border-b-2 pb-2 border-slate-900 tracking-wide">
                CADANGAN BAGI PINDAAN KEPADA JADUAL KELENGKAPAN UNIT
            </div>

            <!-- HEADER SECTION: Metadata -->
            <div class="grid grid-cols-12 gap-2 md:gap-4 mb-3">
                <div class="col-span-12 md:col-span-6 border border-slate-900">
                    <div class="flex border-b border-slate-900 p-1.5 items-center">
                        <label class="w-20 font-bold uppercase text-[11px] shrink-0">Kepada:</label>
                        <span class="flex-1 font-semibold text-xs uppercase px-1">{{ $uetRequest->kepada ?? '-' }}</span>
                    </div>
                    <div class="flex p-1.5 items-center">
                        <label class="w-20 font-bold uppercase text-[11px] shrink-0">Daripada:</label>
                        <span class="flex-1 font-semibold text-xs uppercase px-1">{{ $uetRequest->daripada ?? '-' }}</span>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 border border-slate-900">
                    <div class="flex border-b border-slate-900 p-1.5 items-center">
                        <label class="w-20 font-bold uppercase text-[11px] shrink-0">Unit:</label>
                        <span class="flex-1 font-semibold text-xs uppercase px-1">{{ $uetRequest->unit ?? '-' }}</span>
                    </div>
                    <div class="flex border-b border-slate-900 p-1.5 items-center">
                        <label class="w-20 font-bold uppercase text-[11px] shrink-0">JKU Bil:</label>
                        <span class="flex-1 font-semibold text-xs uppercase px-1">{{ $uetRequest->jku_bil ?? '-' }}</span>
                    </div>
                    <div class="flex p-1.5 items-center">
                        <label class="w-20 font-bold uppercase text-[11px] shrink-0">Tarikh:</label>
                        <span class="flex-1 font-semibold text-xs uppercase px-1">
                            {{ isset($uetRequest->tarikh) ? \Carbon\Carbon::parse($uetRequest->tarikh)->format('d/m/Y') : '-' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- ATTACHMENT SECTION -->
            @if(!empty($uetRequest->attachment_path))
                <div class="mb-3 p-2.5 bg-slate-50 border border-slate-300 rounded flex items-center justify-between print:hidden">
                    <div class="flex items-center gap-2 min-w-0">
                        <svg class="w-4 h-4 text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                        <span class="font-bold text-slate-700 shrink-0">Lampiran Sokongan:</span>
                        <span class="text-slate-600 truncate">{{ basename($uetRequest->attachment_path) }}</span>
                    </div>
                    <a href="{{ Storage::url($uetRequest->attachment_path) }}" target="_blank" class="px-3 py-1 bg-slate-800 hover:bg-slate-900 text-white font-semibold rounded text-xs shrink-0 transition-colors">
                        Lihat / Muat Turun
                    </a>
                </div>
            @endif

            <div class="font-bold text-[11px] mb-1">
                1. Butir - butir kelengkapan dan ulasan serta keputusan :
            </div>

            <!-- MAIN TABLE -->
            <div class="overflow-x-auto mb-4">
                <table class="w-full border-collapse border border-slate-900 text-[10px]">
                    <thead>
                        <tr class="bg-slate-100 text-center font-bold divide-x divide-slate-900 border-b border-slate-900">
                            <th colspan="10" class="py-1 uppercase bg-slate-200">DIISI OLEH PEMOHON DENGAN LENGKAP</th>
                            <th colspan="3" class="py-1 uppercase bg-slate-300">DIISI OLEH JAWATANKUASA & YANG BERKENAAN SAHAJA</th>
                        </tr>
                        <tr class="bg-slate-50 text-center font-bold divide-x divide-slate-900 border-b border-slate-900">
                            <th class="p-1 w-7">BIL</th>
                            <th class="p-1 w-20">UNIT</th>
                            <th class="p-1 min-w-[130px]">NAMA BARANG</th>
                            <th class="p-1 w-12">DI POHON KAN</th>
                            <th class="p-1 w-12">JKU YG DILULUS KAN</th>
                            <th class="p-1 w-20" colspan="2">
                                DALAM SIMPANAN UNIT
                                <div class="grid grid-cols-2 border-t border-slate-900 mt-1 pt-0.5 font-bold">
                                    <span>ADA</span>
                                    <span class="border-l border-slate-900">TIADA</span>
                                </div>
                            </th>
                            <th class="p-1 w-14">MUKA SURAT DLM JKU</th>
                            <th class="p-1 w-28">BARU / PENGURANGAN / PENAMBAHAN</th>
                            <th class="p-1 min-w-[160px]">ALASAN & KETERANGAN LENGKAP UNIT</th>
                            <th class="p-1 w-28 bg-amber-50/80">ULASAN TIMB PEG TURUS</th>
                            <th class="p-1 w-32 bg-slate-100">KEPUTUSAN JKG / ECC / MCSC</th>
                            <th class="p-1 w-32 bg-slate-100">CATATAN & TINDAKAN PEJABAT JKU</th>
                        </tr>
                        <tr class="text-center font-semibold bg-slate-100 divide-x divide-slate-900 border-b border-slate-900 text-[9px]">
                            <th class="p-0.5">(a)</th>
                            <th class="p-0.5">(b)</th>
                            <th class="p-0.5">(c)</th>
                            <th class="p-0.5">(d)</th>
                            <th class="p-0.5">(e)</th>
                            <th class="p-0.5" colspan="2">(f)</th>
                            <th class="p-0.5">(g)</th>
                            <th class="p-0.5">(h)</th>
                            <th class="p-0.5">(i)</th>
                            <th class="p-0.5 bg-amber-50/80">(j)</th>
                            <th class="p-0.5 bg-slate-100">(k)</th>
                            <th class="p-0.5 bg-slate-100">(l)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-900">
                        @forelse($uetRequest->items as $index => $item)
                            <tr class="divide-x divide-slate-900 align-top">
                                <td class="p-1 text-center font-bold">{{ $loop->iteration }}</td>
                                <td class="p-1 uppercase text-center">{{ $item->sub_unit ?? '-' }}</td>
                                <td class="p-1 uppercase font-medium">{{ $item->nama_barang ?? '-' }}</td>
                                <td class="p-1 text-center font-semibold">{{ $item->qty_dipohon ?? '-' }}</td>
                                <td class="p-1 text-center bg-slate-100/70 font-semibold">{{ $item->kuantiti ?? '-' }}</td>
                                <td class="p-1 text-center">
                                    @if($item->dalam_simpanan_ada)
                                        <span class="font-bold text-slate-900 text-xs">&#10003;</span>
                                    @endif
                                </td>
                                <td class="p-1 text-center">
                                    @if($item->dalam_simpanan_tiada)
                                        <span class="font-bold text-slate-900 text-xs">&#10003;</span>
                                    @endif
                                </td>
                                <td class="p-1 uppercase text-center">{{ $item->muka_surat_jku ?? '-' }}</td>
                                <td class="p-1 text-center font-semibold uppercase">{{ $item->pindaan_type ?? '-' }}</td>
                                <td class="p-1 whitespace-pre-line leading-tight">{{ $item->alasan ?? '-' }}</td>

                                <!-- (j) Ulasan OC -->
                                <td class="p-1 bg-amber-50/40 whitespace-pre-line leading-tight">
                                    {{ $uetRequest->approval?->ulasan_timb_peg_turus ?? '-' }}
                                </td>

                                <!-- (k) Keputusan QM -->
                                <td class="p-1 bg-slate-50 whitespace-pre-line leading-tight">
                                    {{ $uetRequest->approval?->keputusan_jkg ?? '-' }}
                                </td>

                                <!-- (l) Catatan JKU -->
                                <td class="p-1 bg-slate-50 whitespace-pre-line leading-tight">
                                    {{ $uetRequest->approval?->catatan_jku ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="p-4 text-center text-slate-500 italic">Tiada item direkodkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- BOTTOM SECTIONS -->
            <div class="grid grid-cols-12 gap-4 border-t-2 border-slate-900 pt-3 page-break-inside-avoid">

                <!-- LEFT SIDE -->
                <div class="col-span-12 md:col-span-7 space-y-3">
                    
                    <!-- 2. PEMOHON SIGNATURE -->
                    <div class="flex items-center gap-2">
                        <span class="font-bold whitespace-nowrap text-[11px] w-56 shrink-0">2. Tanda Tangan dan nama KM/Pemohon :</span>
                        <div class="flex-1 border border-dashed border-slate-900 min-h-[42px] px-2 py-1 flex items-center justify-between bg-white font-semibold uppercase">
                            <span>{{ $uetRequest->nama_pemohon ?? '-' }}</span>
                            @if($uetRequest->applicant?->signature_path)
                                <img src="{{ Storage::url($uetRequest->applicant->signature_path) }}" alt="Signature" class="h-8 max-w-[120px] object-contain">
                            @endif
                        </div>
                    </div>

                    <!-- 3. TIMB PEG TURUS SIGNATURE & APPROVAL ACTION -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="font-bold whitespace-nowrap text-[11px] w-56 shrink-0">3. Tanda Tangan dan nama Timb Peg Turus Unit :</span>
                            <div class="flex-1 border border-dashed border-slate-900 min-h-[42px] px-2 py-1 flex items-center justify-between bg-white font-semibold uppercase">
                                <div>
                                    <div class="leading-tight">{{ $uetRequest->approval?->timbPegTurus?->name ?? $uetRequest->approval?->nama_timb_peg_turus ?? '-' }}</div>
                                    @if($uetRequest->approval?->timb_peg_turus_at)
                                        <div class="text-[9px] text-slate-500 lowercase font-normal">Disahkan pada: {{ $uetRequest->approval->timb_peg_turus_at->format('d/m/Y H:i') }}</div>
                                    @endif
                                </div>
                                @if($uetRequest->approval?->timbPegTurus?->signature_path)
                                    <img src="{{ Storage::url($uetRequest->approval->timbPegTurus->signature_path) }}" alt="Officer Signature" class="h-8 max-w-[120px] object-contain">
                                @endif
                            </div>
                        </div>

                        <!-- Action Box for OC Officer Sign-off -->
                        @if(auth()->user()->isOc() && !$uetRequest->approval?->timb_peg_turus_at)
                            <div class="p-3 bg-amber-50 border border-amber-300 rounded print:hidden shadow-sm">
                                <form action="{{ route('uet.approve.oc', $uetRequest) }}" method="POST" class="space-y-2">
                                    @csrf
                                    <label class="block font-bold text-amber-900">Ulasan & Pengesahan Timb Peg Turus:</label>
                                    <textarea name="ulasan_timb_peg_turus" rows="2" class="w-full text-xs p-1.5 border border-slate-300 rounded focus:ring-1 focus:ring-amber-500" placeholder="Masukkan ulasan (pilihan)..."></textarea>
                                    
                                    <div class="flex items-center gap-2 pt-1">
                                        <input type="password" name="approval_pin" maxlength="4" placeholder="4-Digit PIN" required class="w-28 text-xs p-1.5 border border-slate-300 rounded text-center font-mono">
                                        <button type="submit" class="px-3 py-1.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded text-xs transition-colors">
                                            Sahkan & Tanda Tangan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>

                    <!-- 4. KEPUTUSAN JAWATANKUASA -->
                    <div class="border border-slate-900 p-2.5 space-y-1.5 bg-white">
                        <div class="font-bold text-[11px]">4. Keputusan Jawatankuasa tetap cadangan ECC/UETSC</div>
                        <div class="pl-3 space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs font-mono">
                                    [{{ $uetRequest->approval?->keputusan_jku === 'diluluskan' ? 'X' : ' ' }}]
                                </span>
                                <span class="text-xs">a. Diluluskan bagi pindaan kepada bilangan :</span>
                                <span class="border-b border-slate-800 px-2 text-xs font-semibold">
                                    {{ $uetRequest->approval?->bilangan_diluluskan ?? '_____' }}
                                </span>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs font-mono">
                                    [{{ $uetRequest->approval?->keputusan_jku === 'tidak_diluluskan' ? 'X' : ' ' }}]
                                </span>
                                <span class="text-xs">b. Tidak diluluskan bagi pindaan kepada bilangan :</span>
                                <span class="border-b border-slate-800 px-2 text-xs font-semibold">
                                    {{ $uetRequest->approval?->bilangan_tidak_diluluskan ?? '_____' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 5. SETIAUSAHA SIGNATURE -->
                    <div class="flex items-center gap-2">
                        <span class="font-bold whitespace-nowrap text-[11px] w-56 shrink-0">5. Tanda Tangan dan nama Setiausaha ECC/MCSC/UETSC :</span>
                        <div class="flex-1 border border-slate-900 min-h-[42px] px-2 py-1 flex items-center justify-between bg-white font-semibold uppercase">
                            <div>
                                <div class="leading-tight">{{ $uetRequest->approval?->setiausaha?->name ?? $uetRequest->approval?->nama_setiausaha ?? '-' }}</div>
                                @if($uetRequest->approval?->setiausaha_at)
                                    <div class="text-[9px] text-slate-500 lowercase font-normal">Disahkan pada: {{ $uetRequest->approval->setiausaha_at->format('d/m/Y H:i') }}</div>
                                @endif
                            </div>
                            @if($uetRequest->approval?->setiausaha?->signature_path)
                                <img src="{{ Storage::url($uetRequest->approval->setiausaha->signature_path) }}" alt="Secretary Signature" class="h-8 max-w-[120px] object-contain">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE -->
                <div class="col-span-12 md:col-span-5 border border-slate-900 p-3 bg-slate-50 flex flex-col justify-between">
                    <div>
                        <div class="font-bold text-center uppercase border-b border-slate-900 pb-1.5 mb-3 text-[11px] tracking-tight">
                            TINDAKAN DIBUAT OLEH YANG BERKENAAN SAHAJA
                        </div>

                        <div class="mb-3">
                            <label class="block font-bold mb-1 text-[11px]">6. Pindaan oleh Pembantu Staf JKU :</label>
                            <div class="w-full border border-slate-400 p-1.5 text-xs min-h-[32px] bg-white font-semibold">
                                {{ $uetRequest->approval?->pindaan_bilangan_jku ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="block font-bold mb-1 text-[11px]">7. Nama Pembantu Staf JKU :</label>
                            <div class="w-full border border-slate-400 p-1.5 text-xs min-h-[32px] bg-white font-semibold uppercase">
                                {{ $uetRequest->approval?->nama_pembantu_staf_jku ?? '-' }}
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold mb-1 text-[11px]">8. Nama Timb Peg Turus PP & JKU :</label>
                            <div class="w-full border border-slate-400 p-1.5 text-xs min-h-[32px] bg-white font-semibold uppercase">
                                {{ $uetRequest->approval?->nama_timb_peg_turus_jku ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-display-layout>