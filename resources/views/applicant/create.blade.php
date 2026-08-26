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
        
        <!-- 2. PEMOHON SIGNATURE -->
        <div class="flex items-center gap-2">
            <span class="font-bold whitespace-nowrap text-[11px] w-52">2. Tanda Tangan dan nama KM/Pemohon :</span>
            <div class="flex-1 border border-dashed border-slate-900 min-h-[36px] px-2 py-1 flex items-center justify-between bg-white font-semibold uppercase">
                <span>{{ auth()->user()->name }}</span>
                @if(auth()->user()->signature_path)
                    <img src="{{ Storage::url(auth()->user()->signature_path) }}" alt="Signature" class="h-8 max-w-[120px] object-contain">
                @else
                    <span class="text-[10px] text-rose-500 font-normal italic print:hidden">(Tiada tanda tangan dalam profil)</span>
                @endif
            </div>
        </div>

        <!-- 3. TIMB PEG TURUS SIGNATURE & PIN APPROVAL -->
        <div class="space-y-1">
            <div class="flex items-center gap-2">
                <span class="font-bold whitespace-nowrap text-[11px] w-52">3. Tanda Tangan & nama Timb Peg Turus Unit :</span>
                <div class="flex-1 border border-dashed border-slate-900 min-h-[36px] px-2 py-1 flex items-center justify-between bg-slate-100 font-semibold uppercase text-slate-500 italic text-xs">
                    <span>- (Menunggu Kelulusan) -</span>
                </div>
            </div>
        </div>

        <!-- 4. KEPUTUSAN JAWATANKUASA -->
        <div class="border border-slate-900 p-3 space-y-2 bg-white">
            <div class="font-bold text-[11px]">4. Keputusan Jawatankuasa tetap cadangan ECC/UETSC</div>
            <div class="pl-4 space-y-2">
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="keputusan_jku" value="diluluskan" class="rounded border-slate-400" {{ old('keputusan_jku') === 'diluluskan' ? 'checked' : '' }}>
                    <span class="text-xs">a. Diluluskan bagi pindaan kepada bilangan :</span>
                    <input type="text" name="bilangan_diluluskan" value="{{ old('bilangan_diluluskan') }}" class="border-b border-slate-800 px-1 text-xs w-24 bg-transparent focus:outline-none">
                </div>
                
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="keputusan_jku" value="tidak_diluluskan" class="rounded border-slate-400" {{ old('keputusan_jku') === 'tidak_diluluskan' ? 'checked' : '' }}>
                    <span class="text-xs">b. Tidak diluluskan bagi pindaan kepada bilangan :</span>
                    <input type="text" name="bilangan_tidak_diluluskan" value="{{ old('bilangan_tidak_diluluskan') }}" class="border-b border-slate-800 px-1 text-xs w-24 bg-transparent focus:outline-none">
                </div>
            </div>
        </div>

        <!-- 5. SETIAUSAHA SIGNATURE -->
        <div class="flex items-center gap-2">
            <span class="font-bold whitespace-nowrap text-[11px] w-52">5. Tanda Tangan & nama Setiausaha :</span>
            <div class="flex-1 border border-slate-900 min-h-[36px] px-2 py-1 flex items-center justify-between bg-slate-100 font-semibold uppercase text-slate-500 italic text-xs">
                <span>- (Menunggu Pengesahan) -</span>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="col-span-12 md:col-span-5 border border-slate-900 p-3 bg-slate-50 space-y-3">
        <div class="font-bold text-center uppercase border-b border-slate-900 pb-1.5 text-[11px]">
            TINDAKAN DIBUAT OLEH YANG BERKENAAN SAHAJA
        </div>

        <div>
            <label class="block font-bold mb-1 text-[11px]">6. Pindaan oleh Pembantu Staf JKU :</label>
            <input type="text" name="pindaan_bilangan_jku" value="{{ old('pindaan_bilangan_jku') }}" class="w-full border border-slate-400 p-1 text-xs bg-white font-semibold">
        </div>

        <div>
            <label class="block font-bold mb-1 text-[11px]">7. Nama Pembantu Staf JKU :</label>
            <input type="text" name="nama_pembantu_staf_jku" value="{{ old('nama_pembantu_staf_jku') }}" class="w-full border border-slate-400 p-1 text-xs bg-white font-semibold uppercase">
        </div>

        <div>
            <label class="block font-bold mb-1 text-[11px]">8. Nama Timb Peg Turus PP & JKU :</label>
            <input type="text" name="nama_timb_peg_turus_jku" value="{{ old('nama_timb_peg_turus_jku') }}" class="w-full border border-slate-400 p-1 text-xs bg-white font-semibold uppercase">
        </div>
    </div>
</div>

    <!-- FILE ATTACHMENT SECTION -->
    <div class="mt-4 border border-slate-900 p-3 bg-white">
        <label class="block font-bold text-xs mb-1 text-slate-800">
            Lampiran / File Attachment (PDF, PNG, JPG - Max 2MB):
        </label>
        <input type="file" 
               name="attachment" 
               id="attachment" 
               class="block w-full text-xs text-slate-500
                      file:mr-4 file:py-2 file:px-4
                      file:rounded file:border-0
                      file:text-xs file:font-semibold
                      file:bg-slate-900 file:text-white
                      hover:file:bg-slate-700">
        @error('attachment')
            <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
        @enderror
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