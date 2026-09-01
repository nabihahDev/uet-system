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

        .baf-input:not(:read-only), .baf-textarea:not(:read-only) {
            background-color: #ffffff !important;
        }

        .baf-input:-webkit-autofill, .baf-input:-webkit-autofill:hover, .baf-input:-webkit-autofill:focus,
        .baf-textarea:-webkit-autofill, .baf-textarea:-webkit-autofill:hover, .baf-textarea:-webkit-autofill:focus {
            -webkit-text-fill-color: #000000;
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset;
            box-shadow: 0 0 0 1000px #ffffff inset;
        }
        
        .baf-input:focus, .baf-textarea:focus {
            outline: 1px solid #000000;
        }
        
        .baf-input:read-only, .baf-textarea:read-only {
            background-color: #f3f4f6;
            color: #374151;
            pointer-events: none; /* Menghalang klik & garis fokus biru */
            user-select: none;     /* Menghalang teks daripada di-highlight */
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

        /* Add Row Container & Action Buttons */
        .baf-add-btn-container {
            margin-bottom: 16px;
        }

        .baf-btn-add {
            background-color: #0f172a;
            color: #ffffff;
            border: 1px solid #0f172a;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 3px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .baf-btn-add:hover {
            background-color: #1e293b;
        }

        .baf-btn-floating-remove {
            position: absolute;
            top: 2px;
            right: 2px;
            background: #ef4444;
            color: #ffffff;
            border: none;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            font-size: 10px;
            line-height: 1;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .baf-btn {
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 0px;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .baf-btn-primary { background-color: #0f172a; color: #ffffff; }
        .baf-btn-primary:hover { background-color: #1e293b; }
        
        .baf-btn-success { background-color: #16a34a; color: #ffffff; }
        .baf-btn-success:hover { background-color: #15803d; }
        
        .baf-btn-danger { background-color: #dc2626; color: #ffffff; }
        .baf-btn-danger:hover { background-color: #b91c1c; }

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

        /* Lower Authorization Layout Fix */
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

        .baf-section-box.active-review {
            border: 1px dashed #000000;
            background-color: #ffffff;
            box-shadow: none;
        }
    </style>

    <div class="baf-form-container">
    <form id="baf-form" 
          action="{{ isset($requestModel) && $requestModel->exists ? route('baf.update', $requestModel->id) : route('baf.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf

        @if(isset($requestModel) && $requestModel->exists)
            @method('PUT')
        @endif
        <input type="hidden" name="continue_to_uet" id="continue-to-uet" value="0">

        <!-- HEADER SECTION -->
<div class="baf-header">
    <div>
        <div class="baf-title-box">REQUISITION FORM</div>
        <div style="margin-top: 12px; display: flex; gap: 16px; align-items: center; color: #374151;">
            <span style="font-weight: 600;">Indicate Requisition Type:</span>
            
            <label class="inline-flex items-center gap-1 cursor-pointer">
                <input type="radio" name="requisition_type" value="stock" 
                    {{ old('requisition_type', $requestModel->requisition_type ?? '') === 'stock' ? 'checked' : '' }} 
                    {{ $canEditRequester ? '' : 'disabled' }} required>
                <span>STOCK (Catalogued Items)</span>
            </label>

            <label class="inline-flex items-center gap-1 cursor-pointer">
                <input type="radio" name="requisition_type" value="services" 
                    {{ old('requisition_type', $requestModel->requisition_type ?? '') === 'services' ? 'checked' : '' }} 
                    {{ $canEditRequester ? '' : 'disabled' }} required>
                <span>SERVICES (Non-Catalogued Items)</span>
            </label>

            <label class="inline-flex items-center gap-1 cursor-pointer">
                <input type="radio" name="requisition_type" value="return_to_store" 
                    {{ old('requisition_type', $requestModel->requisition_type ?? '') === 'return_to_store' ? 'checked' : '' }} 
                    {{ $canEditRequester ? '' : 'disabled' }} required>
                <span>RETURN TO STORE (Credits)</span>
            </label>

            @if(!$canEditRequester && isset($requestModel->requisition_type))
                <input type="hidden" name="requisition_type" value="{{ $requestModel->requisition_type }}">
            @endif
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
        <div class="baf-grid-4" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-top: 16px;">
            <div class="baf-grid-cell">
                <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">UNIT CODE</label>
                <input type="text" name="unit_code" value="{{ old('unit_code', $requestModel->unit ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }} required>
            </div>
            <div class="baf-grid-cell">
                <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">REQUIRED BY DATE</label>
                            <input type="date" name="required_by_date" value="{{ old('required_by_date', $requestModel->required_by_date ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }} required>
            </div>
            <div class="baf-grid-cell">
                <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">PRIORITY (1, 2, 3 OR 4)</label>
                <input type="text" name="priority" value="{{ old('priority', $requestModel->priority ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }}>
            </div>
            <div class="baf-grid-cell">
                <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">PART ISSUE (Y/N)</label>
                <input type="text" name="part_issue" value="{{ old('part_issue', $requestModel->part_issue ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }}>
            </div>
        </div>

        <!-- TABLE ITEMS WRAPPER -->
        <div class="baf-table-wrapper" style="margin-top: 16px;">
            <table class="baf-table" id="items-table" style="width: 100%; border-collapse: collapse;">
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
                    @php 
                        $rawItems = $requestModel->items ?? [];
                        $hasDbItems = is_iterable($rawItems) && count($rawItems) > 0;
                        $items = old('items', $hasDbItems ? $rawItems : [[]]); 
                    @endphp
                    @foreach($items as $index => $item)
<tr class="item-row">
    <td class="row-index" style="font-weight: 600; color: #6b7280; text-align: center;">{{ $loop->iteration }}</td>
    
    <!-- Qty -->
    <td><textarea name="items[{{ $index }}][qty]" class="baf-textarea item-qty" style="text-align: center;" rows="1" oninput="autoExpand(this); calculateTotal();" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['qty'] ?? $item->quantity_demanded ?? '' }}</textarea></td>
    
    <!-- UOM -->
    <td><textarea name="items[{{ $index }}][uom]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['uom'] ?? $item->unit_of_measure ?? '' }}</textarea></td>
    
    <!-- Req Type -->
    <td><textarea name="items[{{ $index }}][req_type]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['req_type'] ?? $item->req_type_sp ?? '' }}</textarea></td>
    
    <!-- Stock Code -->
    <td><textarea name="items[{{ $index }}][stock_code]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['stock_code'] ?? $item->stock_code ?? '' }}</textarea></td>
    
    <!-- Mfr -->
    <td><textarea name="items[{{ $index }}][manufacturer]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['manufacturer'] ?? $item->suggested_mfr ?? '' }}</textarea></td>
    
    <!-- Part No -->
    <td><textarea name="items[{{ $index }}][part_number]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['part_number'] ?? $item->part_no ?? '' }}</textarea></td>
    
    <!-- Description -->
    <td><textarea name="items[{{ $index }}][description]" class="baf-textarea item-desc" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }} {{ $index === 0 && $canEditRequester ? 'required' : '' }}>{{ $item['description'] ?? $item->item_description ?? '' }}</textarea></td>
    
    <!-- Est Cost -->
    <td><textarea name="items[{{ $index }}][est_cost]" class="baf-textarea item-cost" style="text-align: right;" rows="1" oninput="autoExpand(this); calculateTotal();" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['est_cost'] ?? $item->est_cost ?? '' }}</textarea></td>
    
    <!-- IPC Ref -->
    <td><textarea name="items[{{ $index }}][ipc_ref]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['ipc_ref'] ?? $item->ipc_ref ?? '' }}</textarea></td>
    
    <!-- Equip Used On -->
    <td><textarea name="items[{{ $index }}][equip_used_on]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['equip_used_on'] ?? $item->equip_used_on ?? '' }}</textarea></td>
    
    <!-- Remarks / Reason -->
    <td>
        <textarea name="items[{{ $index }}][reason]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['reason'] ?? $item->remarks ?? '' }}</textarea>
        @if($canEditRequester)
            <button type="button" class="baf-btn-floating-remove" onclick="removeRow(this)" title="Delete Row">✕</button>
        @endif
    </td>
</tr>
@endforeach
                </tbody>
            </table>
        </div>

        <!-- + ADD BUTTON -->
        @if($canEditRequester)
        <div class="baf-add-btn-container" style="margin-top: 8px;">
            <button type="button" class="baf-btn-add" onclick="addNewRow()">
                <span>+</span> Add Row
            </button>
        </div>
        @endif

        <!-- PICKING SLIP BLOCK -->
        <div class="baf-picking-box" style="margin-top: 16px; display: flex; justify-content: space-between; border: 1px solid #000; padding: 8px;">
            <div class="baf-picking-left" style="flex: 1;">
                <strong style="color: #374151;">PICKING SLIP/DELIVERY INSTRUCTIONS</strong>
                <div style="margin-top: 6px;">
                    <input type="text" name="delivery_contact" placeholder="Contact TELP / POC upon receiving items" value="{{ old('delivery_contact', $requestModel->picking_slip ?? '') }}" class="baf-input" style="width: 100%;" {{ $canEditRequester ? '' : 'readonly' }}>
                </div>
                <div style="margin-top: 6px;">
                    <input type="text" name="delivery_instructions" placeholder="Delivery office/location instructions" value="{{ old('delivery_instructions', $requestModel->delivery_instructions ?? '') }}" class="baf-input" style="width: 100%;" {{ $canEditRequester ? '' : 'readonly' }}>
                </div>
            </div>
            <div class="baf-picking-right" style="width: 180px; text-align: right; border-left: 1px solid #000; padding-left: 12px; margin-left: 12px;">
                <strong style="color: #4b5563; font-size: 11px;">TOTAL EST. COST B$</strong>
                @php
    $totalCost = 0;
    if (isset($items) && is_iterable($items)) {
        foreach ($items as $itm) {
            $cost = is_array($itm) ? ($itm['est_cost'] ?? 0) : ($itm->est_cost ?? 0);
            $desc = is_array($itm) ? ($itm['description'] ?? '') : ($itm->item_description ?? '');
            // Only count items that have a description or cost (exclude blank rows)
            if (!empty($cost) || !empty($desc)) {
                $qty = is_array($itm) ? ($itm['qty'] ?? 1) : ($itm->qty ?? 1);
                $totalCost += (float)$cost * (float)$qty;
            }
        }
    }
@endphp
<div style="font-size: 18px; font-weight: 700; color: #111827; margin-top: 2px;" id="total-cost-display">
    ${{ number_format($totalCost, 2) }}
</div>
            </div>
        </div>

        <!-- LOWER AUTHORIZATION SECTIONS -->
        <div class="baf-bottom-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 12px;">
            <!-- LEFT COLUMN: TECHNICAL & VOTE CONTROLLER -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div class="baf-section-box {{ $canEditRequester ? 'active-review' : '' }}" style="border: 1px dashed #000; padding: 8px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px; text-align: center;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EQUIPMENT NO.</label>
                            <input type="text" name="equipment_no" value="{{ old('equipment_no', $requestModel->equipment_no ?? '') }}" class="baf-input" style="width: 100%;" {{ $canEditRequester ? '' : 'readonly' }}>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">WORK ORDER NO.</label>
                            <input type="text" name="work_order_no" value="{{ old('work_order_no', $requestModel->work_order_no ?? '') }}" class="baf-input" style="width: 100%;" {{ $canEditRequester ? '' : 'readonly' }}>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE SUB HEAD</label>
                            <input type="text" name="vote_sub_head" value="{{ old('vote_sub_head', $requestModel->vote_sub_head ?? '') }}" class="baf-input" style="width: 100%;" {{ $canEditRequester ? '' : 'readonly' }}>
                        </div>
                    </div>
                </div>

                <div class="baf-section-box {{ $canEditVoteController ? 'active-review' : '' }}" style="border: 1px solid #000; padding: 8px; background-color: #f3f4f6;">
                    <div style="display: grid; grid-template-columns: 1.2fr 1.2fr 1fr; gap: 8px; text-align: center;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE CONTROLLER<br><span style="font-weight: normal; font-size: 9px; color: #6b7280;">(Appointment Title)</span></label>
                            <input type="text" name="vote_title" value="{{ old('vote_title', $requestModel->vote_title ?? '') }}" class="baf-input" style="width: 100%;" {{ $canEditVoteController ? '' : 'readonly' }}>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE CONTROLLER SIGNATURE</label>
                            <div class="baf-input" style="width: 100%; min-height: 30px; margin-top: 13px; display: flex; align-items: center; justify-content: center; background-color: #f3f4f6; color: #64748b; font-size: 10px; font-style: italic;">
                                @if(isset($requestModel) && $requestModel->exists && $requestModel->status !== 'draft')
                                    Pending verification
                                @endif
                            </div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">DATE</label>
                            <input type="date" name="vote_date" value="{{ old('vote_date', $requestModel->vote_date ?? ($canEditVoteController ? date('Y-m-d') : '')) }}" class="baf-input" style="width: 100%; margin-top: 13px;" {{ $canEditVoteController ? '' : 'readonly' }}>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: REQUESTED BY & AUTHORISED BY -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <!-- REQUESTED BY BOX -->
                <div class="baf-section-box {{ $canEditRequester ? 'active-review' : '' }}" style="border: 1px dashed #000; padding: 8px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1.4fr 1fr; gap: 6px; text-align: center; align-items: start;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">REQUESTED BY<br><span style="font-weight: normal; font-size: 9px; color: #6b7280;">(Appointment Title)</span></label>
                            <input type="text" name="requested_by_title" value="{{ old('requested_by_title', $requestModel->daripada ?? '') }}" class="baf-input" style="width: 100%;" {{ $canEditRequester ? '' : 'readonly' }}>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EMPLOYEE CODE</label>
                            <input type="text" name="employee_code" value="{{ old('employee_code', $requestModel->employee_code ?? '') }}" class="baf-input" style="width: 100%; margin-top: 13px;" {{ $canEditRequester ? '' : 'readonly' }}>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">SIGNATURE</label>
                            <div style="min-height: 36px; padding: 4px 6px; display: flex; align-items: center; justify-content: space-between; gap: 6px; border: 1px dashed #000; background: #fff; font-weight: 600; text-transform: uppercase;">
                                <span>{{ auth()->user()->name }}</span>
                                @if(auth()->user()->signature_path)
                                    <img src="{{ Storage::url(auth()->user()->signature_path) }}" alt="Signature" style="height: 30px; max-width: 120px; object-fit: contain;">
                                @else
                                    <span style="font-size: 9px; color: #e11d48; font-weight: normal; font-style: italic;">(Tiada tanda tangan dalam profil)</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">REQUESTED DATE</label>
                            <input type="date" name="requested_date" value="{{ old('requested_date', $requestModel->request_date ?? now()->format('Y-m-d')) }}" class="baf-input" style="width: 100%; margin-top: 13px;" {{ $canEditRequester ? '' : 'readonly' }}>
                        </div>
                    </div>
                </div>

                <!-- AUTHORISED BY BOX -->
                <div class="baf-section-box {{ $canEditAuthoriser ? 'active-review' : '' }}" style="border: 1px solid #000; padding: 8px; background-color: #f3f4f6;">
                    <div style="display: grid; grid-template-columns: 1.2fr 1fr 1.2fr 1fr; gap: 8px; text-align: center;">
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">AUTHORISED BY<br><span style="font-weight: normal; font-size: 9px; color: #6b7280;">(Appointment Title)</span></label>
                            <input type="text" name="auth_title" value="{{ old('auth_title', $requestModel->auth_title ?? '') }}" class="baf-input" style="width: 100%; {{ !$canEditAuthoriser ? 'background-color: #f3f4f6; color: #64748b; font-style: italic;' : '' }}" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EMPLOYEE CODE</label>
                            <input type="text" name="auth_code" value="{{ old('auth_code', $requestModel->auth_code ?? '') }}" class="baf-input" style="width: 100%; margin-top: 13px;" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">SIGNATURE</label>
                            <div class="baf-input" style="width: 100%; min-height: 30px; margin-top: 13px; display: flex; align-items: center; justify-content: center; background-color: #f3f4f6; color: #64748b; font-size: 10px; font-style: italic;">
                                @if(isset($requestModel) && $requestModel->exists && $requestModel->status !== 'draft')
                                    Pending verification
                                @endif
                            </div>
                        </div>
                        <div>
                            <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">DATE</label>
                            <input type="date" name="auth_date" value="{{ old('auth_date', $requestModel->auth_date ?? ($canEditAuthoriser ? date('Y-m-d') : '')) }}" class="baf-input" style="width: 100%; margin-top: 13px;" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ATTACHMENT SECTION -->
        <div style="margin-top: 16px; border: 1px solid #000; padding: 12px; background: #fff;">
            <label for="attachment_input" style="display: block; font-weight: 700; font-size: 12px; margin-bottom: 4px; color: #1e293b;">
                Lampiran / File Attachment (PDF, PNG, JPG - Max 2MB):
            </label>
            <input type="file" id="attachment_input" name="attachment" accept="image/*,.pdf,.doc,.docx" class="block w-full text-xs text-slate-500 file:mr-4 file:rounded file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-slate-700" style="cursor: pointer;">
            @error('attachment')
                <span style="display: block; margin-top: 4px; font-size: 12px; color: #e11d48;">{{ $message }}</span>
            @enderror
        </div>

        <!-- FOOTER LABELS & ACTION BUTTONS -->
        <div style="margin-top: 20px; font-size: 11px; color: #6b7280; display: flex; justify-content: space-between; align-items: flex-end;">
            <div style="line-height: 1.5;">
                <div>• Vote Controller Signature is only required for "SERVICES" Requisition</div>
                <div>• Req. Type-Enter either "S" to indicate a Store Issue or a "P" to indicate a Direct Purchase</div>
                <div>• Upon Authorisation forward 'Requisition' to Support Cell for Input to DEFLIS</div>
            </div>
        </div>

        <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 12px;">
            @if($canEditRequester)
                <button type="submit" class="baf-btn baf-btn-primary">Save & Submit Request</button>
            @elseif($canEditAuthoriser)
                <button type="submit" name="oc_endorse" value="1" class="baf-btn baf-btn-success">Authorise & Endorse</button>
                <button type="submit" name="oc_endorse" value="0" class="baf-btn baf-btn-danger">Return Request</button>
            @endif
        </div>
    </form>
</div>

    <script>
    function autoExpand(element) {
        element.style.height = 'auto';
        element.style.height = element.scrollHeight + 'px';
    }

    function addNewRow() {
        const tbody = document.getElementById('items-tbody');
        const rowCount = tbody.children.length;
        const index = rowCount;

        const newRow = document.createElement('tr');
        newRow.className = 'item-row';
        newRow.innerHTML = `
            <td class="row-index" style="font-weight: 600; color: #6b7280;">${rowCount + 1}</td>
            <td><textarea name="items[${index}][qty]" class="baf-textarea item-qty" style="text-align: center;" rows="1" oninput="autoExpand(this); calculateTotal();"></textarea></td>
            <td><textarea name="items[${index}][uom]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)"></textarea></td>
            <td><textarea name="items[${index}][req_type]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)"></textarea></td>
            <td><textarea name="items[${index}][stock_code]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea></td>
            <td><textarea name="items[${index}][manufacturer]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea></td>
            <td><textarea name="items[${index}][part_number]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea></td>
            <td><textarea name="items[${index}][description]" class="baf-textarea item-desc" rows="1" oninput="autoExpand(this)"></textarea></td>
            <td><textarea name="items[${index}][est_cost]" class="baf-textarea item-cost" style="text-align: right;" rows="1" oninput="autoExpand(this); calculateTotal();"></textarea></td>
            <td><textarea name="items[${index}][ipc_ref]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea></td>
            <td><textarea name="items[${index}][equip_used_on]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea></td>
            <td>
                <textarea name="items[${index}][reason]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea>
                <button type="button" class="baf-btn-floating-remove" onclick="removeRow(this)" title="Delete Row">✕</button>
            </td>
        `;

        tbody.appendChild(newRow);
        calculateTotal();
    }

    function removeRow(button) {
        const tbody = document.getElementById('items-tbody');
        if (tbody.children.length > 1) {
            button.closest('tr').remove();
            reindexRows();
            calculateTotal();
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Borang memerlukan sekurang-kurangnya satu baris item.',
                confirmButtonColor: '#0f172a'
            });
        }
    }

    function reindexRows() {
        const rows = document.querySelectorAll('#items-tbody .item-row');
        rows.forEach((row, i) => {
            row.querySelector('.row-index').textContent = i + 1;
            row.querySelectorAll('textarea').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/items\[\d+\]/, `items[${i}]`));
                }
            });
        });
    }

    function calculateTotal() {
        let total = 0;
        const rows = document.querySelectorAll('#items-tbody .item-row');
        rows.forEach(row => {
            const descVal = row.querySelector('.item-desc').value.trim();
            const costVal = row.querySelector('.item-cost').value.replace(/[^0-9.-]+/g, "");
            const cost = parseFloat(costVal) || 0;
            
            // Only count rows that have a description or cost
            if (descVal || cost) {
                const qtyVal = row.querySelector('.item-qty').value.replace(/[^0-9.-]+/g, "");
                const qty = parseFloat(qtyVal) || 1;
                total += (qty * cost);
            }
        });

        document.getElementById('total-cost-display').textContent = '$' + total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.baf-textarea').forEach(el => autoExpand(el));
    calculateTotal();

    const bafForm = document.getElementById('baf-form');

    if (bafForm) {
        bafForm.addEventListener('submit', function (e) {
            const submitter = e.submitter;
            
            // Bypass checks if 'Return Request' is clicked
            if (submitter && submitter.name === 'oc_endorse' && submitter.value === '0') {
                return;
            }

            // Let native browser validation handle missing required fields first
            if (!bafForm.checkValidity()) {
                return; 
            }

            e.preventDefault();

            // Check if first item description is filled
            const firstItemDesc = document.querySelector('textarea[name="items[0][description]"]');
            if (firstItemDesc && firstItemDesc.value.trim() === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Borang Belum Lengkap',
                    text: 'Sila isi sekurang-kurangnya perihalan (Description) bagi item pertama.',
                    confirmButtonColor: '#0f172a'
                });
                return;
            }

            // SweetAlert Confirmation Popup
            Swal.fire({
                title: 'Pengesahan Borang JKU',
                text: 'Adakah awda sudah mengisi borang JKU?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0f172a',
                cancelButtonColor: '#dc2626',
                confirmButtonText: 'Ya, Sudah',
                cancelButtonText: 'Belum (Isi Borang JKU)',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    bafForm.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    document.getElementById('continue-to-uet').value = '1';
                    bafForm.submit();
                }
            });
        });
    }
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto expand semua textarea yang ada isi semasa skrin show dibuka
        document.querySelectorAll('.baf-textarea').forEach(function(textarea) {
            if (typeof autoExpand === 'function') {
                autoExpand(textarea);
            }
        });

        // Jalankan pengiraan semula kos
        if (typeof calculateTotal === 'function') {
            calculateTotal();
        }
    });
</script>
</x-app-layout>