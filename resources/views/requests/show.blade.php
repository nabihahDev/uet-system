<x-app-layout>
    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .baf-form-container {
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

        /* Sharp Grid Cards */
        .baf-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            border: 1px solid #000000;
            background: #ffffff;
            margin-bottom: 16px;
            text-align: center;
        }
        
        .baf-grid-cell {
            border-right: 1px solid #000000;
            padding: 8px;
        }
        
        .baf-grid-cell:last-child {
            border-right: none;
        }

        /* Sharp Border Inputs */
        .baf-input {
            width: 100%;
            border: 1px solid #000000;
            border-radius: 0px;
            padding: 5px 8px;
            font-size: 12px;
            box-sizing: border-box;
            background-color: #ffffff;
            color: #000000;
        }

        .baf-input:read-only, .baf-textarea:read-only {
            background-color: #f3f4f6;
            color: #374151;
            pointer-events: none;
            user-select: none;
        }

        .baf-textarea {
            width: 100%;
            border: 1px solid #000000;
            border-radius: 0px;
            padding: 4px 6px;
            font-size: 11px;
            box-sizing: border-box;
            background-color: #ffffff;
            color: #000000;
            font-family: inherit;
            resize: none;
            min-height: 28px;
            overflow-y: hidden;
            display: block;
        }

        /* Formal Table Styling */
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
            position: relative;
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

        .baf-section-box {
            border: 1px solid #000000;
            border-radius: 0px;
            padding: 10px;
            background-color: #ffffff;
        }

        .baf-btn {
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 0px;
            cursor: pointer;
            border: 1px solid transparent;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back-active {
        display: inline-block;
        background-color: #0f172a; /* Warna gelap solid (navy/black) */
        color: #ffffff !important;  /* Teks putih terang */
        padding: 8px 16px;
        border-radius: 0px;
        font-weight: 600;
        text-decoration: none;
        opacity: 1 !important;      /* Paksa opacity penuh */
        cursor: pointer;
        transition: background-color 0.2s ease;
        }

        .btn-back-active:hover {
        background-color: #1e293b; /* Kesan hover sedikit terang */
        color: #ffffff;
        }

        .baf-btn-secondary { background-color: #4b5563; color: #ffffff; }
        .baf-btn-secondary:hover { background-color: #374151; }
    </style>

    <div class="baf-form-container">
        <!-- HEADER SECTION -->
        <div class="baf-header">
            <div>
                <div class="baf-title-box">REQUISITION FORM</div>
                <div style="margin-top: 12px; display: flex; gap: 16px; align-items: center; color: #374151;">
                    <span style="font-weight: 600;">Requisition Type:</span>
                    
                    <label class="inline-flex items-center gap-1">
                        <input type="radio" disabled {{ ($requestModel->requisition_type ?? '') === 'stock' ? 'checked' : '' }}>
                        <span>STOCK (Catalogued Items)</span>
                    </label>

                    <label class="inline-flex items-center gap-1">
                        <input type="radio" disabled {{ ($requestModel->requisition_type ?? '') === 'services' ? 'checked' : '' }}>
                        <span>SERVICES (Non-Catalogued Items)</span>
                    </label>

                    <label class="inline-flex items-center gap-1">
                        <input type="radio" disabled {{ ($requestModel->requisition_type ?? '') === 'return_to_store' ? 'checked' : '' }}>
                        <span>RETURN TO STORE (Credits)</span>
                    </label>
                </div>
            </div>
            <div style="text-align: right;">
                <div style="font-weight: 700; font-size: 14px; color: #111827;">BAF Q 140</div>
                <div style="margin-top: 6px; color: #374151;">
                    <strong>REQ. NO:</strong> 
                    <span style="border-bottom: 1.5px solid #374151; padding: 2px 8px; font-family: monospace; font-weight: 600;">{{ $requestModel->req_no ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- TOP FIELD METRICS -->
        <div class="baf-grid-4">
            <div class="baf-grid-cell">
                <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">UNIT CODE</label>
                <input type="text" value="{{ $requestModel->unit_code ?? '' }}" class="baf-input" style="text-align: center;" readonly>
            </div>
            <div class="baf-grid-cell">
                <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">REQUIRED BY DATE</label>
                <input type="text" value="{{ $requestModel->required_by ?? '' }}" class="baf-input" style="text-align: center;" readonly>
            </div>
            <div class="baf-grid-cell">
                <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">PRIORITY (1, 2, 3 OR 4)</label>
                <input type="text" value="{{ $requestModel->priority ?? '' }}" class="baf-input" style="text-align: center;" readonly>
            </div>
            <div class="baf-grid-cell">
                <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">PART ISSUE (Y/N)</label>
                <input type="text" value="{{ $requestModel->part_issue ?? '' }}" class="baf-input" style="text-align: center;" readonly>
            </div>
        </div>

        <!-- TABLE ITEMS WRAPPER -->
        <div class="baf-table-wrapper">
            <table class="baf-table" id="items-table">
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
                <tbody id="items-tbody">
                    @forelse($requestModel->items ?? [] as $index => $item)
                    <tr class="item-row">
                        <td style="font-weight: 600; color: #6b7280;">{{ $loop->iteration }}</td>
                        <td><textarea class="baf-textarea item-qty" style="text-align: center;" rows="1" readonly>{{ $item['qty'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea" style="text-align: center;" rows="1" readonly>{{ $item['uom'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea" style="text-align: center;" rows="1" readonly>{{ $item['req_type'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea" rows="1" readonly>{{ $item['stock_code'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea" rows="1" readonly>{{ $item['manufacturer'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea" rows="1" readonly>{{ $item['part_number'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea item-desc" rows="1" readonly>{{ $item['description'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea item-cost" style="text-align: right;" rows="1" readonly>{{ $item['est_cost'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea" rows="1" readonly>{{ $item['ipc_ref'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea" rows="1" readonly>{{ $item['equip_used_on'] ?? '' }}</textarea></td>
                        <td><textarea class="baf-textarea" rows="1" readonly>{{ $item['reason'] ?? '' }}</textarea></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" style="text-align: center; color: #6b7280; padding: 12px;">Tiada item didaftarkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PICKING SLIP BLOCK -->
        <div class="baf-picking-box">
            <div class="baf-picking-left">
                <strong style="color: #374151;">PICKING SLIP/DELIVERY INSTRUCTIONS</strong>
                <div style="margin-top: 6px;">
                    <input type="text" value="{{ $requestModel->delivery_contact ?? '' }}" class="baf-input" readonly placeholder="Contact TELP / POC">
                </div>
                <div style="margin-top: 6px;">
                    <input type="text" value="{{ $requestModel->delivery_instructions ?? '' }}" class="baf-input" readonly placeholder="Delivery office/location">
                </div>
            </div>
            <div class="baf-picking-right">
                <strong style="color: #4b5563; font-size: 11px;">TOTAL EST. COST B$</strong>
                <div style="font-size: 18px; font-weight: 700; color: #111827; margin-top: 2px;" id="total-cost-display">$0.00</div>
            </div>
        </div>

        <!-- LOWER AUTHORIZATION SECTIONS -->
        <div class="baf-bottom-grid">
            
            <!-- LEFT COLUMN -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div class="baf-section-box" style="border: 1px solid #000; padding: 8px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px; text-align: center;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EQUIPMENT NO.</label>
                            <input type="text" value="{{ $requestModel->equipment_no ?? '' }}" class="baf-input" readonly>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">WORK ORDER NO.</label>
                            <input type="text" value="{{ $requestModel->work_order_no ?? '' }}" class="baf-input" readonly>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE SUB HEAD</label>
                            <input type="text" value="{{ $requestModel->vote_sub_head ?? '' }}" class="baf-input" readonly>
                        </div>
                    </div>
                </div>

                <div class="baf-section-box" style="border: 1px solid #000; padding: 8px;">
                    <div style="display: grid; grid-template-columns: 1.2fr 1.2fr 1fr; gap: 8px; text-align: center;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE CONTROLLER</label>
                            <input type="text" value="{{ $requestModel->vote_title ?? '' }}" class="baf-input" readonly>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">IC NUMBER</label>
                            <input type="text" value="{{ $requestModel->vote_ic_number ?? '' }}" class="baf-input" style="margin-top: 13px;" readonly>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">DATE</label>
                            <input type="text" value="{{ $requestModel->vote_date ?? '' }}" class="baf-input" style="margin-top: 13px;" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div class="baf-section-box" style="border: 1px solid #000; padding: 8px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1.4fr 1fr; gap: 6px; text-align: center; align-items: start;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">REQUESTED BY</label>
                            <input type="text" value="{{ $requestModel->requested_by_title ?? '' }}" class="baf-input" readonly>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EMPLOYEE CODE</label>
                            <input type="text" value="{{ $requestModel->employee_code ?? '' }}" class="baf-input" style="margin-top: 13px;" readonly>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">SIGNATURE / STAMP</label>
                            @if(isset($requestModel->signature_path))
                                <div style="padding: 2px; background: #ffffff; border: 1px solid #d1d5db; border-radius: 4px;">
                                    <img src="{{ Storage::url($requestModel->signature_path) }}" alt="Signature" style="max-height: 30px; display: block; margin: 0 auto 2px;">
                                </div>
                            @else
                                <span style="font-size: 10px; color: #9ca3af;">No signature</span>
                            @endif
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">REQUESTED DATE</label>
                            <input type="text" value="{{ $requestModel->required_by ?? '' }}" class="baf-input" style="margin-top: 13px;" readonly>
                        </div>
                    </div>
                </div>

                <div class="baf-section-box" style="border: 1px solid #000; padding: 8px;">
                    <div style="display: grid; grid-template-columns: 1.2fr 1fr 1.2fr 1fr; gap: 8px; text-align: center;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">AUTHORISED BY</label>
                            <input type="text" value="{{ $requestModel->auth_title ?? '' }}" class="baf-input" readonly>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EMPLOYEE CODE</label>
                            <input type="text" value="{{ $requestModel->auth_code ?? '' }}" class="baf-input" style="margin-top: 13px;" readonly>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">IC NUMBER</label>
                            <input type="text" value="{{ $requestModel->auth_ic_number ?? '' }}" class="baf-input" style="margin-top: 13px;" readonly>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">DATE</label>
                            <input type="text" value="{{ $requestModel->auth_date ?? '' }}" class="baf-input" style="margin-top: 13px;" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ATTACHMENT DISPLAY SECTION -->
        @if(isset($requestModel->attachment_path))
        <div style="margin-top: 16px; padding: 12px; border: 1px solid #d1d5db; background-color: #f9fafb; border-radius: 6px;">
            <label style="font-weight: 600; display: block; font-size: 11px; margin-bottom: 6px; color: #374151;">ATTACHMENT</label>
            <a href="{{ Storage::url($requestModel->attachment_path) }}" target="_blank" style="color: #2563eb; text-decoration: underline; font-size: 11px;">
                View Attached File
            </a>
        </div>
        @endif

        <!-- BACK BUTTON -->
        <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 12px;">
            <a href="{{ route('applicant.dashboard') }}" class="btn-back-active">
                Back to List
            </a>
        </div>
    </div>

    <script>
        function autoExpand(element) {
            element.style.height = 'auto';
            element.style.height = element.scrollHeight + 'px';
        }

        function calculateTotal() {
            let total = 0;
            const rows = document.querySelectorAll('#items-tbody .item-row');
            rows.forEach(row => {
                const qtyVal = row.querySelector('.item-qty')?.value.replace(/[^0-9.-]+/g, "") || "0";
                const costVal = row.querySelector('.item-cost')?.value.replace(/[^0-9.-]+/g, "") || "0";
                
                const qty = parseFloat(qtyVal) || 0;
                const cost = parseFloat(costVal) || 0;
                
                total += (qty * cost);
            });

            document.getElementById('total-cost-display').textContent = '$' + total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.baf-textarea').forEach(el => autoExpand(el));
            calculateTotal();
        });
    </script>
</x-app-layout>