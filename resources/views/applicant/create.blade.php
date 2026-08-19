<x-app-layout>
    <div class="py-6 bg-slate-200 min-h-screen text-slate-900 font-sans text-xs">
        <div class="max-w-7xl mx-auto bg-white p-6 md:p-8 shadow-md border border-slate-400">

            <div class="flex justify-between items-start mb-2">
                <h1 class="text-xl font-bold uppercase tracking-tight">Borang UET</h1>
                <div class="text-right text-[10px] font-semibold text-slate-700">
                    CERAIAN 'B' KEPADA MATERIAL<br>
                    REGULATIONS 1102
                </div>
            </div>

            <div class="text-center font-bold text-sm uppercase mb-4 border-b pb-2 border-slate-800">
                CADANGAN BAGI PINDAAN KEPADA JADUAL KELENGKAPAN UNIT
            </div>

            <form action="{{ isset($uetRequest) ? route('uet.update', $uetRequest->id) : route('uet.store') }}" method="POST" enctype="multipart/form-data" id="uetForm">
                @csrf
                @if(isset($uetRequest))
                    @method('PUT')
                @endif

                <!-- HEADER SECTION: Metadata -->
                <div class="grid grid-cols-12 gap-x-4 mb-4">
                    <div class="col-span-12 md:col-span-6 border border-slate-900">
                        <div class="flex border-b border-slate-900 p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">Kepada:</label>
                            <input type="text" name="kepada" value="{{ old('kepada', $uetRequest->kepada ?? '') }}" required 
                                   @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">
                        </div>
                        <div class="flex p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">Daripada:</label>
                            <input type="text" name="daripada" value="{{ old('daripada', $uetRequest->daripada ?? '') }}" required 
                                   @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 border border-slate-900 mt-2 md:mt-0">
                        <div class="flex border-b border-slate-900 p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">Unit:</label>
                            <input type="text" name="unit" value="{{ old('unit', $uetRequest->unit ?? '') }}" required 
                                   @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">
                        </div>
                        <div class="flex border-b border-slate-900 p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">JKU Bil:</label>
                            <input type="text" name="jku_bil" value="{{ old('jku_bil', $uetRequest->jku_bil ?? '') }}"
                                   @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">
                        </div>
                        <div class="flex p-1.5 items-center">
                            <label class="w-20 font-bold uppercase text-[11px]">Tarikh:</label>
                            <input type="date" name="tarikh" value="{{ old('tarikh', $uetRequest->tarikh ?? date('Y-m-d')) }}" required 
                                   @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                   class="flex-1 border border-slate-300 p-1 text-xs uppercase focus:ring-1 focus:ring-slate-800 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="font-bold text-[11px] mb-1">
                    1. Butir - butir kelengkapan dan ulasan serta keputusan :
                </div>

                <!-- MAIN TABLE -->
                <div class="overflow-x-auto mb-6">
                    <table class="w-full border-collapse border border-slate-900 text-[10px]">
                        <thead>
                            <tr class="bg-slate-100 text-center font-bold divide-x divide-slate-900 border-b border-slate-900">
                                <th colspan="10" class="py-1 uppercase bg-slate-200">DIISI OLEH PEMOHON DENGAN LENGKAP</th>
                                <th colspan="3" class="py-1 uppercase bg-slate-300">DIISI OLEH JAWATANKUASA & YANG BERKENAAN SAHAJA</th>
                            </tr>
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
                                <th class="p-1 w-28">BARU / PENGURANGAN / PENAMBAHAN</th>
                                <th class="p-1 min-w-[160px]">ALASAN & KETERANGAN LENGKAP UNIT</th>
                                <th class="p-1 w-28 bg-amber-50">ULASAN TIMB PEG TURUS</th>
                                <th class="p-1 w-32 bg-slate-100">KEPUTUSAN JKG / ECC / MCSC</th>
                                <th class="p-1 w-32 bg-slate-100">CATATAN & TINDAKAN PEJABAT JKU</th>
                            </tr>
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
                                <th class="p-0.5 bg-amber-50">(j)</th>
                                <th class="p-0.5 bg-slate-100">(k)</th>
                                <th class="p-0.5 bg-slate-100">(l)</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody" class="divide-y divide-slate-900">
                            @php
                            $items = (isset($uetRequest) && $uetRequest->items->isNotEmpty()) 
                                    ? $uetRequest->items 
                                    : [ (object) [
                                        'sub_unit' => '',
                                        'item_unit' => '',
                                        'nama_barang' => '',
                                        'perihal_barangan' => '',
                                        'qty_dipohon' => '',
                                        'kuantiti' => '',
                                        'muka_surat_jku' => '',
                                        'pindaan_type' => 'BARU',
                                        'status_pindaan' => 'BARU',
                                        'alasan' => '',
                                        'sebab_permohonan' => '',
                                        'dalam_simpanan_ada' => false,
                                        'dalam_simpanan_tiada' => false,
                                    ] ];
                        @endphp

                            @foreach($items as $index => $item)
                                <tr class="divide-x divide-slate-900 relative group">
                                    <td class="p-1 text-center font-bold row-num">{{ $loop->iteration }}</td>
                                    
                                    <td class="p-1">
                                        <input type="text" name="items[{{ $index }}][sub_unit]" value="{{ old("items.$index.sub_unit", $item->sub_unit ?? '') }}"
                                               @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                               class="w-full text-[10px] p-0.5 uppercase border-0 focus:ring-0 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">
                                    </td>
                                    <td class="p-1">
                                        <input type="text" name="items[{{ $index }}][nama_barang]" value="{{ old("items.$index.nama_barang", $item->nama_barang ?? '') }}"
                                               @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                               class="w-full text-[10px] p-0.5 uppercase border-0 focus:ring-0 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">
                                    </td>
                                    <td class="p-1">
                                        <input type="number" name="items[{{ $index }}][qty_dipohon]" value="{{ old("items.$index.qty_dipohon", $item->qty_dipohon ?? '') }}"
                                               @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                               class="w-full text-[10px] p-0.5 text-center border-0 focus:ring-0 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">
                                    </td>
                                    <td class="p-1 bg-slate-100 text-center">
                                        <input type="text" disabled class="w-full text-[10px] bg-transparent text-center border-0">
                                    </td>
                                    <td class="p-1 text-center">
                                        <input type="checkbox" name="items[{{ $index }}][dalam_simpanan_ada]" value="1" 
                                               @checked(old("items.$index.dalam_simpanan_ada", $item->dalam_simpanan_ada ?? false))
                                               @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') disabled @endif>
                                    </td>
                                    <td class="p-1 text-center">
                                        <input type="checkbox" name="items[{{ $index }}][dalam_simpanan_tiada]" value="1" 
                                               @checked(old("items.$index.dalam_simpanan_tiada", $item->dalam_simpanan_tiada ?? false))
                                               @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') disabled @endif>
                                    </td>
                                    <td class="p-1">
                                        <input type="text" name="items[{{ $index }}][muka_surat_jku]" value="{{ old("items.$index.muka_surat_jku", $item->muka_surat_jku ?? '') }}"
                                               @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                               class="w-full text-[10px] p-0.5 uppercase text-center border-0 focus:ring-0 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">
                                    </td>
                                    <td class="p-1">
                                        <select name="items[{{ $index }}][pindaan_type]" 
                                                @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') disabled @endif
                                                class="w-full text-[9px] p-0 border-0 focus:ring-0 bg-transparent">
                                            <option value="BARU" @selected(old("items.$index.pindaan_type", $item->pindaan_type ?? '') === 'BARU')>BARU</option>
                                            <option value="PENAMBAHAN" @selected(old("items.$index.pindaan_type", $item->pindaan_type ?? '') === 'PENAMBAHAN')>PENAMBAHAN</option>
                                            <option value="PENGURANGAN" @selected(old("items.$index.pindaan_type", $item->pindaan_type ?? '') === 'PENGURANGAN')>PENGURANGAN</option>
                                        </select>
                                    </td>
                                    <td class="p-1">
                                        <textarea name="items[{{ $index }}][alasan]" rows="2" 
                                                  @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                                  class="w-full text-[10px] p-0.5 border-0 focus:ring-0 resize-none {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'bg-slate-100 cursor-not-allowed' : '' }}">{{ old("items.$index.alasan", $item->alasan ?? '') }}</textarea>
                                    </td>

                                    <!-- (j) Ulasan OC -->
                                    <td class="p-1 bg-amber-50/50">
                                        <textarea name="ulasan_timb_peg_turus" rows="2" 
                                                  @if(auth()->user()->role !== 'oc') readonly @endif 
                                                  class="w-full text-[10px] p-0.5 border-0 focus:ring-0 resize-none {{ auth()->user()->role !== 'oc' ? 'bg-transparent cursor-not-allowed text-slate-500' : 'bg-white border border-amber-300' }}">{{ old('ulasan_timb_peg_turus', $uetRequest->approval->ulasan_timb_peg_turus ?? '') }}</textarea>
                                    </td>

                                    <!-- (k) Keputusan QM -->
                                    <td class="p-1 bg-slate-50">
                                        <textarea name="keputusan_jkg" rows="2" 
                                                  @if(auth()->user()->role !== 'qm') readonly @endif 
                                                  class="w-full text-[10px] p-0.5 border-0 focus:ring-0 resize-none {{ auth()->user()->role !== 'qm' ? 'bg-transparent cursor-not-allowed text-slate-500' : 'bg-white border border-slate-300' }}">{{ old('keputusan_jkg', $uetRequest->approval->keputusan_jkg ?? '') }}</textarea>
                                    </td>

                                    <!-- (l) Catatan JKU -->
                                    <td class="p-1 bg-slate-50 relative">
                                        <textarea name="catatan_jku" rows="2" 
                                                  @if(auth()->user()->role !== 'qm') readonly @endif 
                                                  class="w-full text-[10px] p-0.5 border-0 focus:ring-0 resize-none {{ auth()->user()->role !== 'qm' ? 'bg-transparent cursor-not-allowed text-slate-500' : 'bg-white border border-slate-300' }}">{{ old('catatan_jku', $uetRequest->approval->catatan_jku ?? '') }}</textarea>
                                        
                                        @if(auth()->user()->role !== 'oc' && auth()->user()->role !== 'qm')
                                            <button type="button" class="remove-row text-red-600 font-bold absolute right-1 top-1 {{ count($items) === 1 ? 'hidden' : '' }}">×</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if(auth()->user()->role !== 'oc' && auth()->user()->role !== 'qm')
                    <div class="mb-6 flex justify-between items-center">
                        <button type="button" id="addRowBtn" class="bg-slate-800 text-white text-xs px-3 py-1.5 rounded hover:bg-slate-700 font-semibold">
                            + Tambah Baris
                        </button>
                    </div>
                @endif

                <!-- BOTTOM SECTIONS -->
                <div class="grid grid-cols-12 gap-6 border-t-2 border-slate-900 pt-4">

                    <!-- LEFT SIDE -->
                    <div class="col-span-12 md:col-span-7 space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="font-bold whitespace-nowrap text-[11px]">2. Tanda Tangan dan nama KM/Pemohon :</span>
                            <div class="flex-1 border border-dashed border-slate-900 h-8 px-2 flex items-center bg-white">
                                <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon', $uetRequest->nama_pemohon ?? '') }}"
                                       @if(auth()->user()->role === 'oc' || auth()->user()->role === 'qm') readonly @endif
                                       class="w-full border-0 p-0 text-xs focus:ring-0 {{ auth()->user()->role === 'oc' || auth()->user()->role === 'qm' ? 'cursor-not-allowed text-slate-500' : 'bg-transparent' }}">
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="font-bold whitespace-nowrap text-[11px]">3. Tanda Tangan dan nama Timb Peg Turus Unit :</span>
                            <div class="flex-1 border border-dashed border-slate-900 h-8 px-2 flex items-center bg-white">
                                <input type="text" name="nama_timb_peg_turus" value="{{ old('nama_timb_peg_turus', $uetRequest->approval->nama_timb_peg_turus ?? '') }}"
                                       @if(auth()->user()->role !== 'oc') readonly @endif
                                       class="w-full border-0 p-0 text-xs focus:ring-0 {{ auth()->user()->role !== 'oc' ? 'cursor-not-allowed text-slate-500' : 'bg-transparent' }}">
                            </div>
                        </div>

                        <div class="border border-slate-900 p-3 space-y-2 bg-white">
                            <div class="font-bold text-[11px]">4. Keputusan Jawatankuasa tetap cadangan ECC/UETSC</div>
                            <div class="pl-4 space-y-2">
                                <label class="flex items-center gap-2 {{ auth()->user()->role !== 'oc' ? 'pointer-events-none' : '' }}">
                                    <input type="radio" name="keputusan_jku" value="diluluskan" 
                                           @checked(old('keputusan_jku', $uetRequest->approval->keputusan_jku ?? '') === 'diluluskan')
                                           @if(auth()->user()->role !== 'oc') disabled @endif class="text-slate-800">
                                    <span class="text-xs">a. Diluluskan bagi pindaan kepada bilangan :</span>
                                    <input type="text" name="bilangan_diluluskan" value="{{ old('bilangan_diluluskan', $uetRequest->approval->bilangan_diluluskan ?? '') }}"
                                           @if(auth()->user()->role !== 'oc') readonly @endif 
                                           class="border border-slate-800 px-2 py-0.5 text-xs w-28 focus:ring-0 {{ auth()->user()->role !== 'oc' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-transparent' }}">
                                </label>
                                
                                <label class="flex items-center gap-2 {{ auth()->user()->role !== 'oc' ? 'pointer-events-none' : '' }}">
                                    <input type="radio" name="keputusan_jku" value="tidak_diluluskan" 
                                           @checked(old('keputusan_jku', $uetRequest->approval->keputusan_jku ?? '') === 'tidak_diluluskan')
                                           @if(auth()->user()->role !== 'oc') disabled @endif class="text-slate-800">
                                    <span class="text-xs">b. Tidak diluluskan bagi pindaan kepada bilangan :</span>
                                    <input type="text" name="bilangan_tidak_diluluskan" value="{{ old('bilangan_tidak_diluluskan', $uetRequest->approval->bilangan_tidak_diluluskan ?? '') }}"
                                           @if(auth()->user()->role !== 'oc') readonly @endif 
                                           class="border border-slate-800 px-2 py-0.5 text-xs w-28 focus:ring-0 {{ auth()->user()->role !== 'oc' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-transparent' }}">
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 pt-1">
                            <span class="font-bold whitespace-nowrap text-[11px]">5. Tanda Tangan dan nama Setiausaha ECC/MCSC/UETSC :</span>
                            <div class="flex-1 border border-slate-900 h-8 px-2 flex items-center bg-white">
                                <input type="text" name="nama_setiausaha" value="{{ old('nama_setiausaha', $uetRequest->approval->nama_setiausaha ?? '') }}"
                                       @if(auth()->user()->role !== 'oc') readonly @endif 
                                       class="w-full border-0 p-0 text-xs focus:ring-0 {{ auth()->user()->role !== 'oc' ? 'cursor-not-allowed text-slate-500' : 'bg-transparent' }}">
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE -->
                    <div class="col-span-12 md:col-span-5 border border-slate-900 p-3 bg-slate-50 space-y-4 flex flex-col justify-between">
                        <div>
                            <div class="font-bold text-center uppercase border-b border-slate-900 pb-1.5 mb-3 text-[11px] tracking-tight">
                                TINDAKAN DIBUAT OLEH YANG BERKENAAN SAHAJA
                            </div>

                            <div class="mb-3">
                                <label class="block font-bold mb-1 text-[11px]">6. Pindaan oleh Pembantu Staf JKU :</label>
                                <input type="text" name="pindaan_bilangan_jku" value="{{ old('pindaan_bilangan_jku', $uetRequest->approval->pindaan_bilangan_jku ?? '') }}"
                                       @if(auth()->user()->role !== 'qm') readonly @endif 
                                       class="w-full border border-slate-400 p-1.5 text-xs h-8 {{ auth()->user()->role !== 'qm' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-white' }}">
                            </div>

                            <div class="mb-3">
                                <label class="block font-bold mb-1 text-[11px]">7. Nama Pembantu Staf JKU :</label>
                                <input type="text" name="nama_pembantu_staf_jku" value="{{ old('nama_pembantu_staf_jku', $uetRequest->approval->nama_pembantu_staf_jku ?? '') }}"
                                       @if(auth()->user()->role !== 'qm') readonly @endif 
                                       class="w-full border border-slate-400 p-1.5 text-xs h-8 {{ auth()->user()->role !== 'qm' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-white' }}">
                            </div>

                            <div>
                                <label class="block font-bold mb-1 text-[11px]">8. Nama Timb Peg Turus PP & JKU :</label>
                                <input type="text" name="nama_timb_peg_turus_jku" value="{{ old('nama_timb_peg_turus_jku', $uetRequest->approval->nama_timb_peg_turus_jku ?? '') }}"
                                       @if(auth()->user()->role !== 'qm') readonly @endif 
                                       class="w-full border border-slate-400 p-1.5 text-xs h-8 {{ auth()->user()->role !== 'qm' ? 'bg-slate-100 cursor-not-allowed text-slate-500' : 'bg-white' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-slate-300 pt-4">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rowIdx = document.querySelectorAll('#itemTableBody tr').length;
            const userRole = @json(auth()->user()->role);

            const addBtn = document.getElementById('addRowBtn');
            if (addBtn) {
                addBtn.addEventListener('click', function() {
                    const tbody = document.getElementById('itemTableBody');
                    const newRow = document.createElement('tr');
                    newRow.className = 'divide-x divide-slate-900 relative group';

                    const isPemohon = (userRole !== 'oc' && userRole !== 'qm');

                    newRow.innerHTML = `
                        <td class="p-1 text-center font-bold row-num">${rowIdx + 1}</td>
                        <td class="p-1"><input type="text" name="items[${rowIdx}][sub_unit]" ${!isPemohon ? 'readonly' : ''} class="w-full text-[10px] p-0.5 uppercase border-0 focus:ring-0 ${!isPemohon ? 'bg-slate-100 cursor-not-allowed' : ''}"></td>
                        <td class="p-1"><input type="text" name="items[${rowIdx}][nama_barang]" ${!isPemohon ? 'readonly' : ''} class="w-full text-[10px] p-0.5 uppercase border-0 focus:ring-0 ${!isPemohon ? 'bg-slate-100 cursor-not-allowed' : ''}"></td>
                        <td class="p-1"><input type="number" name="items[${rowIdx}][qty_dipohon]" ${!isPemohon ? 'readonly' : ''} class="w-full text-[10px] p-0.5 text-center border-0 focus:ring-0 ${!isPemohon ? 'bg-slate-100 cursor-not-allowed' : ''}"></td>
                        <td class="p-1 bg-slate-100 text-center"><input type="text" disabled class="w-full text-[10px] bg-transparent text-center border-0"></td>
                        <td class="p-1 text-center"><input type="checkbox" name="items[${rowIdx}][dalam_simpanan_ada]" value="1" ${!isPemohon ? 'disabled' : ''}></td>
                        <td class="p-1 text-center"><input type="checkbox" name="items[${rowIdx}][dalam_simpanan_tiada]" value="1" ${!isPemohon ? 'disabled' : ''}></td>
                        <td class="p-1"><input type="text" name="items[${rowIdx}][muka_surat_jku]" ${!isPemohon ? 'readonly' : ''} class="w-full text-[10px] p-0.5 uppercase text-center border-0 focus:ring-0 ${!isPemohon ? 'bg-slate-100 cursor-not-allowed' : ''}"></td>
                        <td class="p-1">
                            <select name="items[${rowIdx}][pindaan_type]" ${!isPemohon ? 'disabled' : ''} class="w-full text-[9px] p-0 border-0 focus:ring-0 bg-transparent">
                                <option value="BARU">BARU</option>
                                <option value="PENAMBAHAN">PENAMBAHAN</option>
                                <option value="PENGURANGAN">PENGURANGAN</option>
                            </select>
                        </td>
                        <td class="p-1"><textarea name="items[${rowIdx}][alasan]" rows="2" ${!isPemohon ? 'readonly' : ''} class="w-full text-[10px] p-0.5 border-0 focus:ring-0 resize-none ${!isPemohon ? 'bg-slate-100 cursor-not-allowed' : ''}"></textarea></td>
                        <td class="p-1 bg-amber-50/50"><textarea disabled class="w-full text-[10px] p-0.5 border-0 bg-transparent cursor-not-allowed"></textarea></td>
                        <td class="p-1 bg-slate-50"><textarea disabled class="w-full text-[10px] p-0.5 border-0 bg-transparent cursor-not-allowed"></textarea></td>
                        <td class="p-1 bg-slate-50 relative">
                            <textarea disabled class="w-full text-[10px] p-0.5 border-0 bg-transparent cursor-not-allowed"></textarea>
                            ${isPemohon ? '<button type="button" class="remove-row text-red-600 font-bold absolute right-1 top-1">×</button>' : ''}
                        </td>
                    `;

                    tbody.appendChild(newRow);
                    rowIdx++;
                    updateNumbers();
                });
            }

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
                    if (btn) {
                        if (rows.length === 1) {
                            btn.classList.add('hidden');
                        } else {
                            btn.classList.remove('hidden');
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>