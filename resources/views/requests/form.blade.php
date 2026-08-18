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
            border-radius: 3px;
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
        <form id="baf-form" action="{{ route('requests.update', $requestModel->id ?? 1) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- HEADER SECTION -->
            <div class="baf-header">
                <div>
                    <div class="baf-title-box">REQUISITION FORM</div>
                    <div style="margin-top: 12px; display: flex; gap: 16px; align-items: center; color: #374151;">
                        <span style="font-weight: 600;">Indicate Requisition Type:</span>
                        @php $type = old('req_type', $requestModel->req_type ?? 'stock'); @endphp
                        <!-- STOCK -->
<label class="inline-flex items-center gap-1 cursor-pointer">
    <input type="radio" 
           name="requisition_type" 
           value="stock" 
           {{ old('requisition_type', $requestModel->requisition_type ?? '') === 'stock' ? 'checked' : '' }} 
           required>
    <span>STOCK (Catalogued Items)</span>
</label>

<!-- SERVICES -->
<label class="inline-flex items-center gap-1 cursor-pointer">
    <input type="radio" 
           name="requisition_type" 
           value="services" 
           {{ old('requisition_type', $requestModel->requisition_type ?? '') === 'services' ? 'checked' : '' }} 
           required>
    <span>SERVICES (Non-Catalogued Items)</span>
</label>

<!-- RETURN TO STORE -->
<label class="inline-flex items-center gap-1 cursor-pointer">
    <input type="radio" 
           name="requisition_type" 
           value="return_to_store" 
           {{ old('requisition_type', $requestModel->requisition_type ?? '') === 'return_to_store' ? 'checked' : '' }} 
           required>
    <span>RETURN TO STORE (Credits)</span>
</label>

                        @if(!$canEditRequester)
                            <input type="hidden" name="req_type" value="{{ $type }}">
                        @endif
                    </div>
                </div>
                <div style="text-align: right;">
                    <div style="font-weight: 700; font-size: 14px; color: #111827;">BAF Q 140</div>
                    <div style="margin-top: 6px; color: #374151;">
                        <strong>REQ. NO:</strong> 
                        <span style="border-bottom: 1.5px solid #374151; padding: 2px 8px; font-family: monospace; font-weight: 600;">{{ $requestModel->req_no ?? '' }}</span>
                    </div>
                </div>
            </div>

            <!-- TOP FIELD METRICS -->
            <div class="baf-grid-4">
                <div class="baf-grid-cell">
                    <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">UNIT CODE *</label>
                    <input type="text" name="unit_code" value="{{ old('unit_code', $requestModel->unit_code ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }} required>
                </div>
                <div class="baf-grid-cell">
                    <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">REQUIRED BY DATE *</label>
                    <input type="date" name="required_by" value="{{ old('required_by', $requestModel->required_by ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }} required>
                </div>
                <div class="baf-grid-cell">
                    <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">PRIORITY (1, 2, 3 OR 4)</label>
                    <input type="text" name="priority" value="{{ old('priority', $requestModel->priority ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }} required>
                </div>
                <div class="baf-grid-cell">
                    <label style="font-weight: 600; display: block; margin-bottom: 4px; color: #374151;">PART ISSUE (Y/N)</label>
                    <input type="text" name="part_issue" value="{{ old('part_issue', $requestModel->part_issue ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }} required>
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
                            <th>Description *</th>
                            <th style="width: 80px;">Est. Cost B$</th>
                            <th style="width: 80px;">IPC Ref</th>
                            <th style="width: 100px;">Equip Used On</th>
                            <th style="width: 100px;">Reason For Demand</th>
                        </tr>
                    </thead>
                    <tbody id="items-tbody">
                        @php $items = old('items', $requestModel->items ?? [[]]); @endphp
                        @foreach($items as $index => $item)
                        <tr class="item-row">
                            <td class="row-index" style="font-weight: 600; color: #6b7280;">{{ $loop->iteration }}</td>
                            <td><textarea name="items[{{ $index }}][qty]" class="baf-textarea item-qty" style="text-align: center;" rows="1" oninput="autoExpand(this); calculateTotal();" {{ $canEditRequester ? '' : 'readonly' }} required>{{ $item['qty'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][uom]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }} required>{{ $item['uom'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][req_type]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }} required>{{ $item['req_type'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][stock_code]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }} required>{{ $item['stock_code'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][manufacturer]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }} required>{{ $item['manufacturer'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][part_number]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }} required>{{ $item['part_number'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][description]" class="baf-textarea item-desc" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }} {{ $index === 0 && $canEditRequester ? 'required' : '' }}>{{ $item['description'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][est_cost]" class="baf-textarea item-cost" style="text-align: right;" rows="1" oninput="autoExpand(this); calculateTotal();" {{ $canEditRequester ? '' : 'readonly' }} required>{{ $item['est_cost'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][ipc_ref]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }} required>{{ $item['ipc_ref'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][equip_used_on]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }} required>{{ $item['equip_used_on'] ?? '' }}</textarea></td>
                            <td>
                                <textarea name="items[{{ $index }}][reason]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['reason'] ?? '' }}</textarea>
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
            <div class="baf-add-btn-container">
                <button type="button" class="baf-btn-add" onclick="addNewRow()">
                    <span>+</span> Add Row
                </button>
            </div>
            @endif

            <!-- PICKING SLIP BLOCK -->
            <div class="baf-picking-box">
                <div class="baf-picking-left">
                    <strong style="color: #374151;">PICKING SLIP/DELIVERY INSTRUCTIONS</strong>
                    <div style="margin-top: 6px;">
                        <input type="text" name="delivery_contact" placeholder="Contact TELP / POC upon receiving items" value="{{ old('delivery_contact', $requestModel->delivery_contact ?? '') }}" class="baf-input" {{ $canEditRequester ? '' : 'readonly' }}>
                    </div>
                    <div style="margin-top: 6px;">
                        <input type="text" name="delivery_instructions" placeholder="Delivery office/location instructions" value="{{ old('delivery_instructions', $requestModel->delivery_instructions ?? '') }}" class="baf-input" {{ $canEditRequester ? '' : 'readonly' }}>
                    </div>
                </div>
                <div class="baf-picking-right">
                    <strong style="color: #4b5563; font-size: 11px;">TOTAL EST. COST B$</strong>
                    <div style="font-size: 18px; font-weight: 700; color: #111827; margin-top: 2px;" id="total-cost-display">$0.00</div>
                </div>
            </div>

            <!-- LOWER AUTHORIZATION SECTIONS -->
            <div class="baf-bottom-grid">
                
                <!-- LEFT COLUMN: TECHNICAL & VOTE CONTROLLER -->
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div class="baf-section-box {{ $canEditRequester ? 'active-review' : '' }}">
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px; text-align: center;">
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EQUIPMENT NO.</label>
                                <input type="text" name="equipment_no" value="{{ old('equipment_no', $requestModel->equipment_no ?? '') }}" class="baf-input" {{ $canEditRequester ? '' : 'readonly' }} required>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">WORK ORDER NO.</label>
                                <input type="text" name="work_order_no" value="{{ old('work_order_no', $requestModel->work_order_no ?? '') }}" class="baf-input" {{ $canEditRequester ? '' : 'readonly' }} required>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE SUB HEAD</label>
                                <input type="text" name="vote_sub_head" value="{{ old('vote_sub_head', $requestModel->vote_sub_head ?? '') }}" class="baf-input" {{ $canEditRequester ? '' : 'readonly' }} required>
                            </div>
                        </div>
                    </div>

                    <div class="baf-section-box {{ $canEditVoteController ? 'active-review' : '' }}">
                        <div style="display: grid; grid-template-columns: 1.2fr 1.2fr 1fr; gap: 8px; text-align: center;">
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">VOTE CONTROLLER<br><span style="font-weight: normal; font-size: 9px; color: #6b7280;">(Appointment Title)</span></label>
                                <input type="text" name="vote_title" value="{{ old('vote_title', $requestModel->vote_title ?? '') }}" class="baf-input" {{ $canEditVoteController ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">SIGNATURE</label>
                                <input type="text" name="vote_signature" value="{{ old('vote_signature', $requestModel->vote_signature ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditVoteController ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">DATE</label>
                                <input type="date" name="vote_date" value="{{ old('vote_date', $requestModel->vote_date ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditVoteController ? '' : 'readonly' }}>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: REQUESTED BY & AUTHORISED BY -->
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div class="baf-section-box {{ $canEditRequester ? 'active-review' : '' }}">
                        <div style="display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr; gap: 8px; text-align: center;">
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">REQUESTED BY<br><span style="font-weight: normal; font-size: 9px; color: #6b7280;">(Appointment Title)</span></label>
                                <input type="text" name="req_title" value="{{ old('req_title', $requestModel->req_title ?? '') }}" class="baf-input" {{ $canEditRequester ? '' : 'readonly' }} required>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EMPLOYEE CODE</label>
                                <input type="text" name="req_code" value="{{ old('req_code', $requestModel->req_code ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditRequester ? '' : 'readonly' }} required>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">SIGNATURE</label>
                                <input type="text" name="req_signature" value="{{ old('req_signature', $requestModel->req_signature ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditRequester ? '' : 'readonly' }} required>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">REQUESTED DATE *</label>
                                <input type="date" name="req_date" value="{{ old('req_date', $requestModel->req_date ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditRequester ? '' : 'readonly' }} required>
                            </div>
                        </div>
                    </div>

                    <div class="baf-section-box {{ $canEditAuthoriser ? 'active-review' : '' }}">
                        <div style="display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr; gap: 8px; text-align: center;">
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">AUTHORISED BY<br><span style="font-weight: normal; font-size: 9px; color: #6b7280;">(Appointment Title)</span></label>
                                <input type="text" name="auth_title" value="{{ old('auth_title', $requestModel->auth_title ?? '') }}" class="baf-input" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">EMPLOYEE CODE</label>
                                <input type="text" name="auth_code" value="{{ old('auth_code', $requestModel->auth_code ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">SIGNATURE</label>
                                <input type="text" name="auth_signature" value="{{ old('auth_signature', $requestModel->auth_signature ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: 600; display: block; font-size: 10px; margin-bottom: 4px; color: #4b5563;">DATE</label>
                                <input type="date" name="auth_date" value="{{ old('auth_date', $requestModel->auth_date ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                            </div>
                        </div>
                    </div>
                </div>

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
            const qtyVal = row.querySelector('.item-qty').value.replace(/[^0-9.-]+/g, "");
            const costVal = row.querySelector('.item-cost').value.replace(/[^0-9.-]+/g, "");
            
            const qty = parseFloat(qtyVal) || 0;
            const cost = parseFloat(costVal) || 0;
            
            total += (qty * cost);
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
                
                // Teruskan terus jika butang "Return Request" ditekan
                if (submitter && submitter.name === 'oc_endorse' && submitter.value === '0') {
                    return;
                }

                e.preventDefault();

                // 1. Semak jika medan required (Unit Code, Required By Date, etc) belum diisi
                if (!bafForm.checkValidity()) {
                    bafForm.reportValidity();
                    return;
                }

                // 2. Semak jika perihalan item pertama kosong
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

                // 3. Pop-up Pengesahan SweetAlert2
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
                        window.location.href = "{{ route('uet.create') }}";
                    }
                });
            });
        }
    });
</script>
</x-app-layout>