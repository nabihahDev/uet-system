<x-app-layout>
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
            
            /* Ensure form content shows properly */
            .baf-display-container {
                margin: 0 !important;
                box-shadow: none !important;
                border: none !important;
            }
        }


        .baf-display-container {
            max-width: 1100px;
            margin: 24px auto;
            background: #ffffff;
            padding: 32px;
            border: 1px solid #000000;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #000000;
            font-size: 12px;
        }

        .baf-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid #000000;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }

        .baf-title-box {
            border: 1px solid #000000;
            font-weight: 700;
            padding: 6px 14px;
            display: inline-block;
            font-size: 15px;
            letter-spacing: 0.025em;
            background-color: #ffffff;
            color: #000000;
        }

        .baf-display-value {
            padding: 8px 0;
            font-weight: 500;
            color: #374151;
        }

        .baf-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            border: 1px solid #000000;
            background: #ffffff;
            margin-bottom: 16px;
            padding: 12px;
        }

        .baf-grid-cell {
            border: 1px solid #ddd;
            padding: 8px;
            background: #f9fafb;
        }

        .baf-grid-cell-label {
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
            color: #374151;
            font-size: 11px;
        }

        .baf-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            text-align: center;
            margin-bottom: 8px;
            border: 1px solid #000000;
        }

        .baf-table th, .baf-table td {
            border: 1px solid #000000;
            padding: 6px 4px;
            vertical-align: middle;
        }

        .baf-table th {
            background-color: #e5e7eb;
            color: #000000;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
        }

        .baf-table-wrapper {
            position: relative;
            overflow-x: auto;
            margin-bottom: 16px;
        }

        .baf-section-box {
            border: 1px solid #000000;
            padding: 10px;
            background-color: #ffffff;
            margin-bottom: 12px;
        }

        .baf-picking-box {
            display: grid;
            grid-template-columns: 3fr 1fr;
            border: 1px solid #000000;
            margin-bottom: 16px;
        }

        .baf-picking-left {
            padding: 10px;
            border-right: 1px solid #000000;
        }

        .baf-picking-right {
            padding: 10px;
            background: #ffffff;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .baf-bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        .value-display {
            padding: 8px;
            border: 1px solid #ddd;
            background: #f9fafb;
            border-radius: 3px;
            min-height: 28px;
            display: flex;
            align-items: center;
        }
    </style>

    <div class="baf-display-container">
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

        <!-- HEADER SECTION -->
        <div class="baf-header">
            <div>
                <div class="baf-title-box">REQUISITION FORM</div>
                <div style="margin-top: 12px; display: flex; gap: 16px; align-items: center; color: #374151;">
                    <span style="font-weight: 600;">Requisition Type:</span>
                    <span class="font-semibold">
                        @switch($requestModel->requisition_type ?? '')
                            @case('stock')
                                STOCK (Catalogued Items)
                                @break
                            @case('services')
                                SERVICES (Non-Catalogued Items)
                                @break
                            @case('return_to_store')
                                RETURN TO STORE (Credits)
                                @break
                            @default
                                -
                        @endswitch
                    </span>
                </div>
            </div>
            <div style="text-align: right;">
                <div style="font-weight: 700; font-size: 14px; color: #111827;">BAF Q 140</div>
                <div style="margin-top: 6px; color: #374151;">
                    <strong>REQ. NO:</strong> 
                    <span style="border-bottom: 1.5px solid #374151; padding: 2px 8px; font-family: monospace; font-weight: 600;">{{ $requestModel->reference_no ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- TOP FIELD METRICS -->
        <div class="baf-grid-4">
            <div class="baf-grid-cell">
                <label class="baf-grid-cell-label">UNIT CODE</label>
                <div class="baf-display-value">{{ $requestModel->unit ?? '-' }}</div>
            </div>
            <div class="baf-grid-cell">
                <label class="baf-grid-cell-label">REQUIRED BY DATE</label>
                <div class="baf-display-value">{{ isset($requestModel->required_by_date) ? \Carbon\Carbon::parse($requestModel->required_by_date)->format('d/m/Y') : '-' }}</div>
            </div>
            <div class="baf-grid-cell">
                <label class="baf-grid-cell-label">PRIORITY (1, 2, 3 OR 4)</label>
                <div class="baf-display-value">{{ $requestModel->priority ?? '-' }}</div>
            </div>
            <div class="baf-grid-cell">
                <label class="baf-grid-cell-label">PART ISSUE (Y/N)</label>
                <div class="baf-display-value">{{ $requestModel->part_issue ?? '-' }}</div>
            </div>
        </div>

        <!-- TABLE ITEMS -->
        <div class="baf-table-wrapper">
            <table class="baf-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="width: 30px;">Item No</th>
                        <th style="width: 50px;">Qty Req'd</th>
                        <th style="width: 50px;">Unit (UOM)</th>
                        <th style="width: 50px;">Req. Type S/P</th>
                        <th style="width: 80px;">Stock Code</th>
                        <th style="width: 100px;">Suggested Mfr/Supplier</th>
                        <th style="width: 100px;">Part No</th>
                        <th>Description</th>
                        <th style="width: 80px;">Est. Cost B$</th>
                        <th style="width: 80px;">IPC Ref</th>
                        <th style="width: 100px;">Equip Used On</th>
                        <th style="width: 100px;">Reason For Demand</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requestModel->items ?? [] as $item)
                        <tr>
                            <td style="font-weight: 600; color: #6b7280; text-align: center;">{{ $loop->iteration }}</td>
                            <td style="text-align: center;">{{ $item->quantity_demanded ?? '-' }}</td>
                            <td style="text-align: center;">{{ $item->unit_of_measure ?? '-' }}</td>
                            <td style="text-align: center;">{{ $item->req_type_sp ?? '-' }}</td>
                            <td>{{ $item->stock_code ?? '-' }}</td>
                            <td>{{ $item->suggested_mfr ?? '-' }}</td>
                            <td>{{ $item->part_no ?? '-' }}</td>
                            <td>{{ $item->item_description ?? '-' }}</td>
                            <td style="text-align: right;">{{ $item->est_cost ?? '-' }}</td>
                            <td>{{ $item->ipc_ref ?? '-' }}</td>
                            <td>{{ $item->equip_used_on ?? '-' }}</td>
                            <td>{{ $item->remarks ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" style="text-align: center; padding: 16px;">Tiada Item</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PICKING SLIP BLOCK -->
        <div class="baf-picking-box">
            <div class="baf-picking-left">
                <strong style="color: #374151; display: block; margin-bottom: 8px;">PICKING SLIP/DELIVERY INSTRUCTIONS</strong>
                <div style="margin-bottom: 8px;">
                    <label style="font-weight: 600; font-size: 11px; color: #6b7280; display: block; margin-bottom: 2px;">Contact TELP / POC upon receiving items:</label>
                    <div class="value-display">{{ $requestModel->picking_slip ?? '-' }}</div>
                </div>
                <div>
                    <label style="font-weight: 600; font-size: 11px; color: #6b7280; display: block; margin-bottom: 2px;">Delivery office/location instructions:</label>
                    <div class="value-display">{{ $requestModel->delivery_instructions ?? '-' }}</div>
                </div>
            </div>
            <div class="baf-picking-right">
                <strong style="color: #4b5563; font-size: 11px;">TOTAL EST. COST B$</strong>
                @php
                    $totalCost = 0;
                    foreach($requestModel->items ?? [] as $itm) {
                        $totalCost += (float)($itm->est_cost ?? 0) * (float)($itm->quantity_demanded ?? 1);
                    }
                @endphp
                <div style="font-size: 18px; font-weight: 700; color: #111827; margin-top: 2px;">
                    ${{ number_format($totalCost, 2) }}
                </div>
            </div>
        </div>

        <!-- LOWER AUTHORIZATION SECTIONS -->
        <div class="baf-bottom-grid">
            <!-- LEFT COLUMN: TECHNICAL & VOTE CONTROLLER -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div class="baf-section-box" style="border: 1px dashed #000;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px; text-align: center;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EQUIPMENT NO.</label>
                            <div class="value-display">{{ $requestModel->equipment_no ?? '-' }}</div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">WORK ORDER NO.</label>
                            <div class="value-display">{{ $requestModel->work_order_no ?? '-' }}</div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE SUB HEAD</label>
                            <div class="value-display">{{ $requestModel->vote_sub_head ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <div class="baf-section-box" style="border: 1px solid #000; background-color: #f3f4f6;">
                    <div style="display: grid; grid-template-columns: 1.2fr 1.2fr 1fr; gap: 8px; text-align: center;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE CONTROLLER<br><span style="font-weight: normal; font-size: 9px; color: #6b7280;">(Appointment Title)</span></label>
                            <div class="value-display">{{ $requestModel->vote_title ?? '-' }}</div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE CONTROLLER SIGNATURE</label>
                            <div class="value-display" style="min-height: 36px;">
                                @if($requestModel->status !== 'draft')
                                    Pending verification
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">DATE</label>
                            <div class="value-display">{{ isset($requestModel->vote_date) ? \Carbon\Carbon::parse($requestModel->vote_date)->format('d/m/Y') : '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: REQUESTED BY & AUTHORISED BY -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <!-- REQUESTED BY BOX -->
                <div class="baf-section-box" style="border: 1px dashed #000;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1.4fr 1fr; gap: 6px; text-align: center; align-items: start;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">REQUESTED BY<br><span style="font-weight: normal; font-size: 9px; color: #6b7280;">(Appointment Title)</span></label>
                            <div class="value-display">{{ $requestModel->daripada ?? '-' }}</div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EMPLOYEE CODE</label>
                            <div class="value-display">{{ $requestModel->employee_code ?? '-' }}</div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">SIGNATURE</label>
                            <div style="min-height: 36px; padding: 4px 6px; display: flex; align-items: center; justify-content: space-between; gap: 6px; border: 1px dashed #000; background: #fff; font-weight: 600; text-transform: uppercase; font-size: 10px;">
                                <span>{{ $requestModel->signature_path ? 'Signed' : '-' }}</span>
                                @if($requestModel->signature_path)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($requestModel->signature_path) }}" alt="Signature" style="height: 28px; max-width: 100px; object-fit: contain;">
                                @endif
                            </div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">REQUESTED DATE</label>
                            <div class="value-display">{{ isset($requestModel->request_date) ? \Carbon\Carbon::parse($requestModel->request_date)->format('d/m/Y') : '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- AUTHORISED BY BOX -->
                <div class="baf-section-box" style="border: 1px solid #000; background-color: #f3f4f6;">
                    <div style="display: grid; grid-template-columns: 1.2fr 1fr 1.2fr 1fr; gap: 8px; text-align: center;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">AUTHORISED BY<br><span style="font-weight: normal; font-size: 9px; color: #6b7280;">(Appointment Title)</span></label>
                            <div class="value-display">{{ $requestModel->auth_title ?? '-' }}</div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EMPLOYEE CODE</label>
                            <div class="value-display">{{ $requestModel->auth_code ?? '-' }}</div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">SIGNATURE</label>
                            <div class="value-display" style="min-height: 36px;">
                                @if($requestModel->status !== 'draft')
                                    Pending verification
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">DATE</label>
                            <div class="value-display">{{ isset($requestModel->auth_date) ? \Carbon\Carbon::parse($requestModel->auth_date)->format('d/m/Y') : '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ATTACHMENT SECTION -->
        @if(!empty($requestModel->attachment_path))
            <div style="margin-top: 16px; border: 1px solid #000; padding: 12px; background: #fff;">
                <div style="display: flex; align-items: center; gap: 2; margin-bottom: 8px;">
                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>
                    <span class="font-bold text-slate-700">Lampiran Sokongan:</span>
                    <span class="text-slate-600">{{ basename($requestModel->attachment_path) }}</span>
                </div>
                <a href="{{ \Illuminate\Support\Facades\Storage::url($requestModel->attachment_path) }}" target="_blank" class="px-3 py-1 bg-slate-800 hover:bg-slate-900 text-white font-semibold rounded text-xs inline-block transition-colors">
                    Lihat / Muat Turun
                </a>
            </div>
        @endif

        <!-- FOOTER LABELS -->
        <div style="margin-top: 20px; font-size: 11px; color: #6b7280; display: flex; justify-content: space-between; align-items: flex-end;">
            <div style="line-height: 1.5;">
                <div>• Vote Controller Signature is only required for "SERVICES" Requisition</div>
                <div>• Req. Type-Enter either "S" to indicate a Store Issue or a "P" to indicate a Direct Purchase</div>
                <div>• Upon Authorisation forward 'Requisition' to Support Cell for Input to DEFLIS</div>
            </div>
        </div>
    </div>
</x-app-layout>
