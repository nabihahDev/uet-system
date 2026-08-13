<x-app-layout>
    <div class="py-6 bg-slate-200 min-h-screen text-slate-900 font-sans text-xs">
        <div class="max-w-7xl mx-auto bg-white p-6 md:p-8 shadow-md border border-slate-400">

            <!-- Top Header & Reference Code -->
            <div class="flex justify-between items-start mb-2">
                <h1 class="text-xl font-bold uppercase tracking-tight">Borang UET</h1>
                <div class="text-right text-[10px] font-semibold text-slate-700">
                    CERAIAN 'B' KEPADA MATERIAL<br>
                    REGULATIONS 1102
                </div>
            </div>

            <!-- Form Main Title -->
            <div class="text-center font-bold text-sm uppercase mb-4 border-b pb-2 border-slate-800">
                CADANGAN BAGI PINDAAN KEPADA JADUAL KELENGKAPAN UNIT
            </div>

            <form action="{{ route('uet.store') }}" method="POST" enctype="multipart/form-data" id="uetForm">
                @csrf

                <!-- HEADER SECTION: Metadata Boxes -->
                <div class="grid grid-cols-12 gap-x-4 mb-4">
                    <!-- Left Block: Kepada / Daripada -->
                    <div class="col-span-12 md:col-span-6 border border-slate-900">
                        <div class="flex border-b border-slate-900 p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">Kepada:</label>
                            <input type="text" name="kepada" required 
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800">
                        </div>
                        <div class="flex p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">Daripada:</label>
                            <input type="text" name="daripada" required 
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800">
                        </div>
                    </div>

                    <!-- Right Block: Unit / JKU Bil / Tarikh -->
                    <div class="col-span-12 md:col-span-6 border border-slate-900 mt-2 md:mt-0">
                        <div class="flex border-b border-slate-900 p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">Unit:</label>
                            <input type="text" name="unit" required 
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800">
                        </div>
                        <div class="flex border-b border-slate-900 p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">JKU Bil:</label>
                            <input type="text" name="jku_bil" 
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800">
                        </div>
                        <div class="flex p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">Tarikh:</label>
                            <input type="date" name="tarikh" value="{{ date('Y-m-d') }}" required 
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800">
                        </div>
                    </div>
                </div>

                <div class="font-bold text-[11px] mb-1">
                    1. Butir - butir kelengkapan dan ulasan serta keputusan :
                </div>

                <!-- MAIN TABLE: Replicating Section 1 (Pemohon & Jawatankuasa) -->
                <div class="overflow-x-auto mb-6">
                    <table class="w-full border-collapse border border-slate-900 text-[10px]">
                        <thead>
                            <!-- Section Super-headers -->
                            <tr class="bg-slate-100 text-center font-bold divide-x divide-slate-900 border-b border-slate-900">
                                <th colspan="9" class="py-1 uppercase bg-slate-200">DIISI OLEH PEMOHON DENGAN LENGKAP</th>
                                <th colspan="3" class="py-1 uppercase bg-slate-300">DIISI OLEH JAWATANKUASA & YANG BERKENAAN SAHAJA</th>
                            </tr>
                            <!-- Column Titles -->
                            <tr class="bg-slate-50 text-center font-bold divide-x divide-slate-900 border-b border-slate-900">
                                <th class="p-1 w-8">BIL</th>
                                <th class="p-1 w-20">UNIT</th>
                                <th class="p-1 min-w-[120px]">NAMA BARANG</th>
                                <th class="p-1 w-12">DI POHON KAN</th>
                                <th class="p-1 w-12">JKU YG DILULUS KAN</th>
                                <th class="p-1 w-20" colspan="2">DALAM SIMPANAN UNIT
                                    <div class="grid grid-cols-2 border-t border-slate-900 mt-1 pt-0.5">
                                        <span>ADA</span>
                                        <span class="border-l border-slate-900">TIDAK ADA</span>
                                    </div>
                                </th>
                                <th class="p-1 w-14">MUKA SURAT DLM JKU</th>
                                <th class="p-1 w-28">BARU / PENGURANGAN / PENAMBAHAN / MASUK DALAM JKU</th>
                                <th class="p-1 min-w-[160px]">ALASAN & KETERANGAN LENGKAP UNIT</th>
                                <th class="p-1 w-24">ULASAN TIMB PEG TURUS</th>
                                <th class="p-1 w-24">KEPUTUSAN JKG / ECC / MCSC / UETSC</th>
                                <th class="p-1 w-24">CATATAN & TINDAKAN PEJABAT JKU</th>
                            </tr>
                            <!-- Index Markers (a) to (l) -->
                            <tr class="text-center font-semibold bg-slate-100 divide-x divide-slate-900 border-b border-slate-900">
                                <th class="p-0.5">(a)</th>
                                <th class="p-0.5">(b)</th>
                                <th class="p-0.5">(c)</th>
                                <th class="p-0.5">(d)</th>
                                <th class="p-0.5">(e)</th>
                                <th class="p-0.5" colspan="2">(f)</th>
                                <th class="p-0.5">(g)</th>
                                <th class="p-0.5">(h)</th>
                                <th class="p-0.5">(i)</th>
                                <th class="p-0.5">(j)</th>
                                <th class="p-0.5">(k)</th>
                                <th class="p-0.5">(l)</th>
                                <th class="p-0.5 w-8"></th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody" class="divide-y divide-slate-900">
                            <!-- Row 1 Default -->
                            <tr class="divide-x divide-slate-900">
                                <td class="p-1 text-center font-bold row-num">1</td>
                                <td class="p-1"><input type="text" name="items[0][sub_unit]" class="w-full text-[10px] p-0.5 uppercase border-0 focus:ring-0"></td>
                                <td class="p-1"><input type="text" name="items[0][nama_barang]" class="w-full text-[10px] p-0.5 uppercase border-0 focus:ring-0"></td>
                                <td class="p-1"><input type="number" name="items[0][qty_dipohon]" class="w-full text-[10px] p-0.5 text-center border-0 focus:ring-0"></td>
                                <td class="p-1 bg-slate-100 text-center"><input type="text" disabled class="w-full text-[10px] bg-transparent text-center border-0"></td>
                                <td class="p-1 text-center"><input type="checkbox" name="items[0][dalam_simpanan_ada]" value="1"></td>
                                <td class="p-1 text-center"><input type="checkbox" name="items[0][dalam_simpanan_tiada]" value="1"></td>
                                <td class="p-1"><input type="text" name="items[0][muka_surat_jku]" class="w-full text-[10px] p-0.5 uppercase text-center border-0 focus:ring-0"></td>
                                <td class="p-1">
                                    <select name="items[0][pindaan_type]" class="w-full text-[9px] p-0 border-0 focus:ring-0 bg-transparent">
                                        <option value="BARU">BARU</option>
                                        <option value="PENAMBAHAN">PENAMBAHAN</option>
                                        <option value="PENGURANGAN">PENGURANGAN</option>
                                    </select>
                                </td>
                                <!-- Merged text area column for Alasan -->
                                <td class="p-1" rowspan="1">
                                    <input type="text" name="items[0][alasan]" class="w-full text-[10px] p-0.5 border-0 focus:ring-0">
                                </td>
                                <!-- Disabled official fields (j, k, l) -->
                                <td class="p-1 bg-slate-50"></td>
                                <td class="p-1 bg-slate-50"></td>
                                <td class="p-1 bg-slate-50"></td>
                                <td class="p-0.5 text-center bg-white">
                                    <button type="button" class="remove-row text-red-600 font-bold hidden">×</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Add Row Control -->
                <div class="mb-6 flex justify-between items-center">
                    <button type="button" id="addRowBtn" class="bg-slate-800 text-white text-xs px-3 py-1.5 rounded hover:bg-slate-700 font-semibold">
                        + Tambah Baris
                    </button>
                </div>

                <!-- BOTTOM SECTIONS: Signatures & Official Sections (2 to 8) -->
                <div class="grid grid-cols-12 gap-4 border-t-2 border-slate-900 pt-4">

                    <!-- LEFT SIDE: Section 2, 3, 4, 5 (Applicant Side) -->
                    <div class="col-span-12 md:col-span-7 space-y-4">
                        <!-- 2. KM / Pemohon -->
                        <div class="flex items-center gap-2">
                            <span class="font-bold whitespace-nowrap">2. Tanda Tangan dan nama KM/Pemohon :</span>
                            <input type="text" name="nama_pemohon" class="flex-1 border-b border-dashed border-slate-800 p-1 text-xs focus:ring-0 focus:border-slate-900 bg-transparent">
                        </div>

                        <!-- 3. Timb Peg Turus Unit -->
                <div class="flex items-center gap-2">
                    <span class="font-bold whitespace-nowrap">3. Tanda Tangan dan nama Timb Peg Turus Unit :</span>
                    <input type="text" 
                        name="nama_timb_peg_turus" 
                        value="{{ old('nama_timb_peg_turus', $uet->nama_timb_peg_turus ?? '') }}"
                        @if(auth()->user()->role !== 'oc') readonly @endif
                        class="flex-1 border-b border-dashed border-slate-800 p-1 text-xs focus:ring-0 focus:border-slate-900 
                                {{ auth()->user()->role !== 'oc' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-transparent' }}">
                </div>

                    <!-- 4. Keputusan Jawatankuasa (CO Only Edit) -->
                        <div class="border border-slate-900 p-2 space-y-2 bg-slate-50/50">
                            <div class="font-bold">4. Keputusan Jawatankuasa tetap cadangan ECC/UETSC</div>
                            <div class="pl-4 space-y-1">
                                <label class="flex items-center gap-2 {{ auth()->user()->role !== 'oc' ? 'pointer-events-none' : '' }}">
                                    <input type="radio" 
                                        name="keputusan_jku" 
                                        value="diluluskan" 
                                        @checked(old('keputusan_jku', $uetRequest->keputusan_jku ?? '') === 'diluluskan')
                                        @if(auth()->user()->role !== 'oc') disabled @endif 
                                        class="text-slate-800">
                                    <span>a. Diluluskan bagi pindaan kepada bilangan :</span>
                                    <input type="text" 
                                        name="bilangan_diluluskan" 
                                        value="{{ old('bilangan_diluluskan', $uetRequest->bilangan_diluluskan ?? '') }}"
                                        @if(auth()->user()->role !== 'oc') readonly @endif 
                                        class="border-b border-slate-800 p-0 text-xs w-24 focus:ring-0 
                                                {{ auth()->user()->role !== 'oc' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-transparent' }}">
                                </label>
                                
                                <div class="font-bold text-center my-0.5 text-[10px]">OR</div>
                                
                                <label class="flex items-center gap-2 {{ auth()->user()->role !== 'oc' ? 'pointer-events-none' : '' }}">
                                    <input type="radio" 
                                        name="keputusan_jku" 
                                        value="tidak_diluluskan" 
                                        @checked(old('keputusan_jku', $uetRequest->keputusan_jku ?? '') === 'tidak_diluluskan')
                                        @if(auth()->user()->role !== 'oc') disabled @endif 
                                        class="text-slate-800">
                                    <span>b. Tidak diluluskan bagi pindaan kepada bilangan :</span>
                                    <input type="text" 
                                        name="bilangan_tidak_diluluskan" 
                                        value="{{ old('bilangan_tidak_diluluskan', $uetRequest->bilangan_tidak_diluluskan ?? '') }}"
                                        @if(auth()->user()->role !== 'oc') readonly @endif 
                                        class="border-b border-slate-800 p-0 text-xs w-24 focus:ring-0 
                                                {{ auth()->user()->role !== 'oc' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-transparent' }}">
                                </label>
                            </div>
                        </div>

                        <!-- 5. Setiausaha ECC/MCSC/UETSC (CO Only Edit) -->
                        <div class="flex items-center gap-2 pt-2">
                            <span class="font-bold whitespace-nowrap">5. Tanda Tangan dan nama Setiausaha ECC/MCSC/UETSC :</span>
                            <input type="text" 
                                name="nama_setiausaha" 
                                value="{{ old('nama_setiausaha', $uetRequest->nama_setiausaha ?? '') }}"
                                @if(auth()->user()->role !== 'oc') readonly @endif 
                                class="flex-1 border-b border-slate-800 p-1 text-xs focus:ring-0 
                                        {{ auth()->user()->role !== 'oc' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-transparent' }}">
                        </div>

                        <!-- RIGHT SIDE: Section 6, 7, 8 (Quartermaster Only Edit) -->
<div class="col-span-12 md:col-span-5 border border-slate-900 p-3 bg-slate-50 space-y-4">
    <div class="font-bold text-center uppercase border-b border-slate-900 pb-1 text-[11px]">
        TINDAKAN DIBUAT OLEH YANG BERKENAAN SAHAJA
    </div>

    <!-- 6. Pembantu Staf JKU -->
    <div>
        <label class="block font-bold mb-1">
            6. Tindakan Pindaan oleh Pembantu Staf JKU dengan menggunakan pindaan bilangan :
        </label>
        <input type="text" 
               name="pindaan_bilangan_jku" 
               value="{{ old('pindaan_bilangan_jku', $uetRequest->pindaan_bilangan_jku ?? '') }}"
               @if(auth()->user()->role !== 'qm') readonly @endif 
               class="w-full border border-slate-400 p-1.5 text-xs 
                      {{ auth()->user()->role !== 'qm' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-white' }}">
    </div>

    <!-- 7. Tanda Tangan Pembantu Staf JKU -->
    <div>
        <label class="block font-bold mb-1">
            7. Tanda Tangan dan nama Pembantu Staf JKU :
        </label>
        <input type="text" 
               name="nama_pembantu_staf_jku" 
               value="{{ old('nama_pembantu_staf_jku', $uetRequest->nama_pembantu_staf_jku ?? '') }}"
               @if(auth()->user()->role !== 'qm') readonly @endif 
               class="w-full border border-slate-400 p-1.5 text-xs 
                      {{ auth()->user()->role !== 'qm' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-white' }}">
    </div>

    <!-- 8. Tandatangan Timb Peg Turus PP & JKU -->
    <div>
        <label class="block font-bold mb-1">
            8. Tandatangan dan nama Timb Peg Turus PP & JKU :
        </label>
        <input type="text" 
               name="nama_timb_peg_turus_jku" 
               value="{{ old('nama_timb_peg_turus_jku', $uetRequest->nama_timb_peg_turus_jku ?? '') }}"
               @if(auth()->user()->role !== 'qm') readonly @endif 
               class="w-full border border-slate-400 p-1.5 text-xs 
                      {{ auth()->user()->role !== 'qm' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-white' }}">
    </div>
</div>

                <!-- Form Action Buttons -->
                <div class="mt-8 flex justify-end gap-3 border-t pt-4">
                    <button type="submit" name="action" value="draft" class="px-5 py-2 border border-slate-800 text-slate-800 font-bold hover:bg-slate-100">
                        Simpan Draf
                    </button>
                    <button type="submit" name="action" value="submit" class="px-6 py-2 bg-slate-900 text-white font-bold hover:bg-slate-800">
                        Hantar Permohonan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Script to Handle Dynamic Row Addition -->
    <script>
        let rowIdx = 1;

        document.getElementById('addRowBtn').addEventListener('click', function() {
            const tbody = document.getElementById('itemTableBody');
            const newRow = document.createElement('tr');
            newRow.className = 'divide-x divide-slate-900';

            newRow.innerHTML = `
                <td class="p-1 text-center font-bold row-num">${rowIdx + 1}</td>
                <td class="p-1"><input type="text" name="items[${rowIdx}][sub_unit]" class="w-full text-[10px] p-0.5 uppercase border-0 focus:ring-0"></td>
                <td class="p-1"><input type="text" name="items[${rowIdx}][nama_barang]" class="w-full text-[10px] p-0.5 uppercase border-0 focus:ring-0"></td>
                <td class="p-1"><input type="number" name="items[${rowIdx}][qty_dipohon]" class="w-full text-[10px] p-0.5 text-center border-0 focus:ring-0"></td>
                <td class="p-1 bg-slate-100 text-center"><input type="text" disabled class="w-full text-[10px] bg-transparent text-center border-0"></td>
                <td class="p-1 text-center"><input type="checkbox" name="items[${rowIdx}][dalam_simpanan_ada]" value="1"></td>
                <td class="p-1 text-center"><input type="checkbox" name="items[${rowIdx}][dalam_simpanan_tiada]" value="1"></td>
                <td class="p-1"><input type="text" name="items[${rowIdx}][muka_surat_jku]" class="w-full text-[10px] p-0.5 uppercase text-center border-0 focus:ring-0"></td>
                <td class="p-1">
                    <select name="items[${rowIdx}][pindaan_type]" class="w-full text-[9px] p-0 border-0 focus:ring-0 bg-transparent">
                        <option value="BARU">BARU</option>
                        <option value="PENAMBAHAN">PENAMBAHAN</option>
                        <option value="PENGURANGAN">PENGURANGAN</option>
                    </select>
                </td>
                <td class="p-1"><input type="text" name="items[${rowIdx}][alasan]" class="w-full text-[10px] p-0.5 border-0 focus:ring-0"></td>
                <td class="p-1 bg-slate-50"></td>
                <td class="p-1 bg-slate-50"></td>
                <td class="p-1 bg-slate-50"></td>
                <td class="p-0.5 text-center bg-white">
                    <button type="button" class="remove-row text-red-600 font-bold">×</button>
                </td>
            `;

            tbody.appendChild(newRow);
            rowIdx++;
            updateNumbers();
        });

        document.getElementById('itemTableBody').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
                updateNumbers();
            }
        });

        function updateNumbers() {
            const rows = document.querySelectorAll('#itemTableBody tr');
            rows.forEach((row, idx) => {
                row.querySelector('.row-num').textContent = idx + 1;
                const btn = row.querySelector('.remove-row');
                if (rows.length === 1) {
                    btn.classList.add('hidden');
                } else {
                    btn.classList.remove('hidden');
                }
            });
        }
    </script>
</x-app-layout>