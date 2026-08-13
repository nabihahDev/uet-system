<x-app-layout>
    <style>
        .baf-form-container {
            max-width: 1100px;
            margin: 20px auto;
            background: #ffffff;
            padding: 24px;
            border: 1px solid #111827;
            font-family: ui-sans-serif, system-ui, -apple-system, sans-serif;
            color: #111827;
            font-size: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .baf-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #111827;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }
        .baf-title-box {
            border: 1.5px solid #111827;
            font-weight: 700;
            padding: 6px 12px;
            display: inline-block;
            font-size: 16px;
            background-color: #f9fafb;
        }
        .baf-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            border: 1px solid #111827;
            padding: 8px;
            background: #f9fafb;
            margin-bottom: 16px;
            text-align: center;
        }
        .baf-grid-cell {
            border-right: 1px solid #d1d5db;
            padding: 0 4px;
        }
        .baf-grid-cell:last-child {
            border-right: none;
        }
        .baf-input {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 4px 6px;
            font-size: 11px;
            box-sizing: border-box;
            background-color: #ffffff;
        }
        .baf-input:read-only, .baf-textarea:read-only {
            background-color: #e5e7eb;
            color: #6b7280;
            cursor: not-allowed;
        }

        /* Dynamic Auto-Expanding Textarea Styling */
        .baf-textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 4px 6px;
            font-size: 11px;
            box-sizing: border-box;
            background-color: #ffffff;
            font-family: inherit;
            resize: none;
            min-height: 26px;
            overflow-y: hidden;
            display: block;
        }

        .baf-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            text-align: center;
            margin-bottom: 16px;
        }
        .baf-table th, .baf-table td {
            border: 1px solid #111827;
            padding: 4px;
            vertical-align: top;
        }
        .baf-table th {
            background-color: #f3f4f6;
            font-weight: 700;
        }

        .baf-table-wrapper {
            position: relative;
            overflow-x: auto;
            padding-right: 32px;
        }

        .baf-table tr {
            position: relative;
        }

        .baf-btn-floating-remove {
            position: absolute;
            right: -28px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #ef4444;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            width: 22px;
            height: 22px;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
            transition: all 0.2s ease;
        }

        .baf-btn-floating-remove:hover {
            background-color: #dc2626;
            transform: translateY(-50%) scale(1.1);
        }

        .baf-add-btn-container {
            display: flex;
            justify-content: flex-end;
            margin-top: -10px;
            margin-bottom: 14px;
        }

        .baf-btn-add {
            background-color: #007FFF;
            color: #ffffff;
            border: none;
            padding: 5px 14px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background-color 0.2s ease;
        }

        .baf-btn-add:hover {
            background-color: #0066CC;
        }

        .baf-picking-box {
            display: grid;
            grid-template-columns: 3fr 1fr;
            border: 1px solid #111827;
            margin-bottom: 16px;
        }
        .baf-picking-left {
            padding: 8px;
            border-right: 1px solid #111827;
        }
        .baf-picking-right {
            padding: 8px;
            background: #f9fafb;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .baf-bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .baf-section-box {
            border: 1px solid #111827;
            padding: 10px;
        }
        .baf-sub-box {
            border: 1px solid #d1d5db;
            padding: 8px;
            margin-top: 8px;
            border-radius: 4px;
        }
        .baf-sub-box.active-review {
            border-color: #0066CC;
            background-color: #f5f3ff;
        }
        .baf-btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            color: #ffffff;
            font-size: 12px;
        }
        
        .baf-btn-primary { 
            background-color: #007FFF; 
            transition: background-color 0.2s ease;
        }

        .baf-btn-primary:hover { 
            background-color: #0066CC; 
        }
        .baf-btn-success { background-color: #16a34a; }
        .baf-btn-danger { background-color: #dc2626; }
    </style>

    <div class="baf-form-container">
        <form action="{{ route('requests.update', $requestModel->id ?? 1) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- HEADER SECTION -->
            <div class="baf-header">
                <div>
                    <div class="baf-title-box">REQUISITION FORM</div>
                    <div style="margin-top: 10px; display: flex; gap: 16px; align-items: center;">
                        <span style="font-weight: bold;">Indicate Requisition Type:</span>
                        @php $type = old('req_type', $requestModel->req_type ?? 'stock'); @endphp
                        <label><input type="radio" name="req_type" value="stock" {{ $type == 'stock' ? 'checked' : '' }} {{ $canEditRequester ? '' : 'disabled' }}> STOCK (Catalogued Items)</label>
                        <label><input type="radio" name="req_type" value="services" {{ $type == 'services' ? 'checked' : '' }} {{ $canEditRequester ? '' : 'disabled' }}> SERVICES (Non-Catalogued Items)</label>
                        <label><input type="radio" name="req_type" value="return" {{ $type == 'return' ? 'checked' : '' }} {{ $canEditRequester ? '' : 'disabled' }}> RETURN TO STORE (Credits)</label>

                        @if(!$canEditRequester)
                            <input type="hidden" name="req_type" value="{{ $type }}">
                        @endif
                    </div>
                </div>
                <div style="text-align: right;">
                    <div style="font-weight: bold; font-size: 13px;">BAF Q 140</div>
                    <div style="margin-top: 6px;">
                        <strong>REQ. NO:</strong> 
                        <span style="border-bottom: 1px solid #111827; padding: 2px 8px; font-family: monospace;">{{ $requestModel->req_no ?? '' }}</span>
                    </div>
                </div>
            </div>

            <!-- TOP FIELD METRICS -->
            <div class="baf-grid-4">
                <div class="baf-grid-cell">
                    <label style="font-weight: bold; display: block;">UNIT CODE</label>
                    <input type="text" name="unit_code" value="{{ old('unit_code', $requestModel->unit_code ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }}>
                </div>
                <div class="baf-grid-cell">
                    <label style="font-weight: bold; display: block;">REQUIRED BY DATE</label>
                    <input type="text" name="required_by" placeholder="DD / MM / YYYY" value="{{ old('required_by', $requestModel->required_by ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }}>
                </div>
                <div class="baf-grid-cell">
                    <label style="font-weight: bold; display: block;">PRIORITY (1, 2, 3 OR 4)</label>
                    <input type="text" name="priority" value="{{ old('priority', $requestModel->priority ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }}>
                </div>
                <div class="baf-grid-cell">
                    <label style="font-weight: bold; display: block;">PART ISSUE (Y/N)</label>
                    <input type="text" name="part_issue" value="{{ old('part_issue', $requestModel->part_issue ?? '') }}" class="baf-input" style="text-align: center;" {{ $canEditRequester ? '' : 'readonly' }}>
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
                        @php $items = old('items', $requestModel->items ?? [[]]); @endphp
                        @foreach($items as $index => $item)
                        <tr class="item-row">
                            <td class="row-index">{{ $loop->iteration }}</td>
                            <td><textarea name="items[{{ $index }}][qty]" class="baf-textarea item-qty" style="text-align: center;" rows="1" oninput="autoExpand(this); calculateTotal();" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['qty'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][uom]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['uom'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][req_type]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['req_type'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][stock_code]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['stock_code'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][manufacturer]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['manufacturer'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][part_number]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['part_number'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][description]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['description'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][est_cost]" class="baf-textarea item-cost" style="text-align: right;" rows="1" oninput="autoExpand(this); calculateTotal();" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['est_cost'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][ipc_ref]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['ipc_ref'] ?? '' }}</textarea></td>
                            <td><textarea name="items[{{ $index }}][equip_used_on]" class="baf-textarea" rows="1" oninput="autoExpand(this)" {{ $canEditRequester ? '' : 'readonly' }}>{{ $item['equip_used_on'] ?? '' }}</textarea></td>
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
                    <strong>PICKING SLIP/DELIVERY INSTRUCTIONS</strong>
                    <div style="margin-top: 4px;">
                        <input type="text" name="delivery_contact" placeholder="Contact TELP / POC upon receiving items" value="{{ old('delivery_contact', $requestModel->delivery_contact ?? '') }}" class="baf-input" {{ $canEditRequester ? '' : 'readonly' }}>
                    </div>
                    <div style="margin-top: 4px;">
                        <input type="text" name="delivery_instructions" placeholder="Delivery office/location instructions" value="{{ old('delivery_instructions', $requestModel->delivery_instructions ?? '') }}" class="baf-input" {{ $canEditRequester ? '' : 'readonly' }}>
                    </div>
                </div>
                <div class="baf-picking-right">
                    <strong>TOTAL EST. COST B$</strong>
                    <div style="font-size: 15px; font-weight: bold; margin-top: 4px;" id="total-cost-display">$0.00</div>
                </div>
            </div>

            <!-- LOWER AUTHORIZATION SECTIONS -->
            <div class="baf-bottom-grid" style="align-items: start;">
                
                <!-- LEFT COLUMN: TECHNICAL & VOTE CONTROLLER -->
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div class="baf-section-box" style="padding: 8px;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px; text-align: center;">
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">EQUIPMENT NO.</label>
                                <input type="text" name="equipment_no" value="{{ old('equipment_no', $requestModel->equipment_no ?? '') }}" class="baf-input" {{ $canEditVoteController ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">WORK ORDER NO.</label>
                                <input type="text" name="work_order_no" value="{{ old('work_order_no', $requestModel->work_order_no ?? '') }}" class="baf-input" {{ $canEditVoteController ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">VOTE SUB HEAD</label>
                                <input type="text" name="vote_sub_head" value="{{ old('vote_sub_head', $requestModel->vote_sub_head ?? '') }}" class="baf-input" {{ $canEditVoteController ? '' : 'readonly' }}>
                            </div>
                        </div>
                    </div>

                    <div class="baf-section-box {{ $canEditVoteController ? 'active-review' : '' }}" style="padding: 8px;">
                        <div style="display: grid; grid-template-columns: 1.2fr 1.2fr 1fr; gap: 8px; text-align: center;">
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">VOTE CONTROLLER<br><span style="font-weight: normal; font-size: 9px;">(Appointment Title)</span></label>
                                <input type="text" name="vote_title" value="{{ old('vote_title', $requestModel->vote_title ?? '') }}" class="baf-input" {{ $canEditVoteController ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">SIGNATURE</label>
                                <input type="text" name="vote_signature" value="{{ old('vote_signature', $requestModel->vote_signature ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditVoteController ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">DATE</label>
                                <input type="text" name="vote_date" placeholder="DD / MM / YYYY" value="{{ old('vote_date', $requestModel->vote_date ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditVoteController ? '' : 'readonly' }}>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: REQUESTED BY & AUTHORISED BY -->
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div class="baf-section-box {{ $canEditRequester ? 'active-review' : '' }}" style="padding: 8px;">
                        <div style="display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr; gap: 8px; text-align: center;">
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">REQUESTED BY<br><span style="font-weight: normal; font-size: 9px;">(Appointment Title)</span></label>
                                <input type="text" name="req_title" value="{{ old('req_title', $requestModel->req_title ?? '') }}" class="baf-input" {{ $canEditRequester ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">EMPLOYEE CODE</label>
                                <input type="text" name="req_code" value="{{ old('req_code', $requestModel->req_code ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditRequester ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">SIGNATURE</label>
                                <input type="text" name="req_signature" value="{{ old('req_signature', $requestModel->req_signature ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditRequester ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">REQUESTED DATE</label>
                                <input type="text" name="req_date" placeholder="DD / MM / YYYY" value="{{ old('req_date', $requestModel->req_date ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditRequester ? '' : 'readonly' }}>
                            </div>
                        </div>
                    </div>

                    <div class="baf-section-box {{ $canEditAuthoriser ? 'active-review' : '' }}" style="padding: 8px;">
                        <div style="display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr; gap: 8px; text-align: center;">
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">AUTHORISED BY<br><span style="font-weight: normal; font-size: 9px;">(Appointment Title)</span></label>
                                <input type="text" name="auth_title" value="{{ old('auth_title', $requestModel->auth_title ?? '') }}" class="baf-input" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">EMPLOYEE CODE</label>
                                <input type="text" name="auth_code" value="{{ old('auth_code', $requestModel->auth_code ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">SIGNATURE</label>
                                <input type="text" name="auth_signature" value="{{ old('auth_signature', $requestModel->auth_signature ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                            </div>
                            <div>
                                <label style="font-weight: bold; display: block; font-size: 10px; margin-bottom: 4px;">DATE</label>
                                <input type="text" name="auth_date" placeholder="DD / MM / YYYY" value="{{ old('auth_date', $requestModel->auth_date ?? '') }}" class="baf-input" style="margin-top: 13px;" {{ $canEditAuthoriser ? '' : 'readonly' }}>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- FOOTER LABELS & ACTION BUTTONS -->
            <div style="margin-top: 16px; font-size: 10px; color: #6b7280; display: flex; justify-content: space-between; align-items: flex-end;">
                <div>
                    <div>• Vote Controller Signature is only required for "SERVICES" Requisition</div>
                    <div>• Req. Type-Enter either "S" to indicate a Store Issue or a "P" to indicate a Direct Purchase</div>
                    <div>• Upon Authorisation forward 'Requisition' to Support Cell for Input to DEFLIS</div>
                </div>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
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
                <td class="row-index">${rowCount + 1}</td>
                <td><textarea name="items[${index}][qty]" class="baf-textarea item-qty" style="text-align: center;" rows="1" oninput="autoExpand(this); calculateTotal();"></textarea></td>
                <td><textarea name="items[${index}][uom]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)"></textarea></td>
                <td><textarea name="items[${index}][req_type]" class="baf-textarea" style="text-align: center;" rows="1" oninput="autoExpand(this)"></textarea></td>
                <td><textarea name="items[${index}][stock_code]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea></td>
                <td><textarea name="items[${index}][manufacturer]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea></td>
                <td><textarea name="items[${index}][part_number]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea></td>
                <td><textarea name="items[${index}][description]" class="baf-textarea" rows="1" oninput="autoExpand(this)"></textarea></td>
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
                alert('Form requires at least one item row.');
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
        });
    </script>
</x-app-layout>