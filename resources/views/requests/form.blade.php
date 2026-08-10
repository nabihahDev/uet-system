<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Create New Requisition') }}</h2>
                <p class="text-sm text-gray-500">BAF Q140 / JKU Digital UET & Requisition System</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-gray-600">Status: Draft</span>
                <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-indigo-700">REQ-2026-0804</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6 rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div class="text-sm font-semibold text-gray-700">Workflow Steps</div>
                            <div class="flex flex-wrap gap-2 text-sm">
                                <span class="rounded-full bg-indigo-600 px-3 py-1 text-white">1. General Information</span>
                                <span class="rounded-full bg-gray-200 px-3 py-1 text-gray-600">2. Requested Items</span>
                                <span class="rounded-full bg-gray-200 px-3 py-1 text-gray-600">3. Justification & Delivery</span>
                                <span class="rounded-full bg-gray-200 px-3 py-1 text-gray-600">4. Review & Sign</span>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('requests.store') }}">
                        @csrf

                        <div class="space-y-6">
                            <section class="border rounded-lg p-5 bg-white">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">1. General Information</h3>
                                    <span class="text-xs uppercase tracking-wide text-gray-500">Requester</span>
                                </div>

                                <div class="mb-4 flex flex-wrap gap-3">
                                    <label class="inline-flex items-center rounded-full border px-3 py-2 text-sm font-medium text-gray-700">
                                        <input type="radio" name="request_type" value="stock" class="mr-2" checked />
                                        Stock (Catalogued)
                                    </label>
                                    <label class="inline-flex items-center rounded-full border px-3 py-2 text-sm font-medium text-gray-700">
                                        <input type="radio" name="request_type" value="services" class="mr-2" />
                                        Services
                                    </label>
                                    <label class="inline-flex items-center rounded-full border px-3 py-2 text-sm font-medium text-gray-700">
                                        <input type="radio" name="request_type" value="return" class="mr-2" />
                                        Return to Store
                                    </label>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                                    <div>
                                        <x-input-label for="unit_code" :value="__('Unit Code')" />
                                        <select id="unit_code" name="unit_code" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                            <option value="">Select Unit</option>
                                            <option value="ITD">ITD</option>
                                            <option value="ENG">ENG</option>
                                            <option value="LOG">LOG</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('unit_code')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="required_by" :value="__('Required By Date')" />
                                        <x-text-input id="required_by" name="required_by" type="date" class="mt-1 block w-full" value="{{ old('required_by') }}" />
                                    </div>
                                    <div>
                                        <x-input-label for="priority" :value="__('Priority Level')" />
                                        <select id="priority" name="priority" class="mt-1 block w-full border-gray-300 rounded-md">
                                            <option value="priority_3">Priority 3 (Standard)</option>
                                            <option value="priority_2">Priority 2 (Urgent)</option>
                                            <option value="priority_1">Priority 1 (Critical)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="vote_sub_head" :value="__('Vote Sub Head')" />
                                        <select id="vote_sub_head" name="vote_sub_head" class="mt-1 block w-full border-gray-300 rounded-md">
                                            <option value="">Select Sub Head</option>
                                            <option value="ITD-001">ITD-001</option>
                                            <option value="ITD-002">ITD-002</option>
                                            <option value="ITD-003">ITD-003</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                                    <div>
                                        <x-input-label for="work_order_no" :value="__('Work Order No.')" />
                                        <x-text-input id="work_order_no" name="work_order_no" type="text" class="mt-1 block w-full" value="{{ old('work_order_no') }}" />
                                    </div>
                                    <div>
                                        <x-input-label for="equipment_no" :value="__('Equipment No.')" />
                                        <x-text-input id="equipment_no" name="equipment_no" type="text" class="mt-1 block w-full" value="{{ old('equipment_no') }}" />
                                    </div>
                                </div>
                            </section>

                            <section class="border rounded-lg p-5 bg-white">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">2. Requested Items</h3>
                                    <span class="text-xs uppercase tracking-wide text-gray-500">Catalog Search</span>
                                </div>

                                <div class="mb-4 rounded-lg border border-dashed border-gray-300 p-3">
                                    <label class="block text-sm font-medium text-gray-700">Search Catalog</label>
                                    <input type="text" placeholder="Type part no or item description" class="mt-2 block w-full rounded-md border-gray-300" />
                                </div>

                                <div class="overflow-x-auto">
                                    <table id="items-table" class="min-w-full divide-y divide-gray-200 border">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-2 py-2 text-xs">#</th>
                                                <th class="px-2 py-2 text-xs">Description / Model</th>
                                                <th class="px-2 py-2 text-xs">Part / Stock No</th>
                                                <th class="px-2 py-2 text-xs">Qty</th>
                                                <th class="px-2 py-2 text-xs">Unit Cost</th>
                                                <th class="px-2 py-2 text-xs">Total</th>
                                                <th class="px-2 py-2 text-xs">Reason</th>
                                                <th class="px-2 py-2 text-xs">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="items-body" class="bg-white divide-y divide-gray-200">
                                            <tr class="item-row">
                                                <td class="px-2 py-2 text-sm">1</td>
                                                <td class="px-2 py-2"><input name="items[0][description]" class="w-full border-gray-300 rounded-md" /></td>
                                                <td class="px-2 py-2"><input name="items[0][part_number]" class="w-full border-gray-300 rounded-md" /></td>
                                                <td class="px-2 py-2"><input name="items[0][qty]" type="number" min="1" class="w-20 border-gray-300 rounded-md" /></td>
                                                <td class="px-2 py-2"><input name="items[0][est_cost]" type="number" step="0.01" class="w-28 border-gray-300 rounded-md" /></td>
                                                <td class="px-2 py-2 text-sm text-gray-600">-</td>
                                                <td class="px-2 py-2"><input name="items[0][reason]" class="w-36 border-gray-300 rounded-md" /></td>
                                                <td class="px-2 py-2"><button type="button" onclick="removeRow(this)" class="text-red-600">Remove</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3 flex items-center justify-between">
                                    <button type="button" id="add-item" class="inline-flex items-center px-3 py-1 bg-gray-200 rounded">+ Add Item</button>
                                    <div class="text-sm font-semibold text-gray-700">TOTAL EST. COST: <span id="total-cost">0.00</span></div>
                                </div>
                            </section>

                            <section class="border rounded-lg p-5 bg-white">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">3. Justification & Delivery</h3>
                                    <span class="text-xs uppercase tracking-wide text-gray-500">Requester Notes</span>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Reason for Demand / Alasan</label>
                                        <textarea name="justification" rows="4" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('justification') }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Delivery / Picking Instructions</label>
                                        <textarea name="delivery_instructions" rows="4" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('delivery_instructions') }}</textarea>
                                    </div>
                                </div>
                            </section>

                            <section class="border rounded-lg p-5 bg-gray-50">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">4. Review & Sign</h3>
                                    <span class="text-xs uppercase tracking-wide text-gray-500">Approver Workflow</span>
                                </div>
                                <div class="rounded-lg border border-dashed p-4 text-sm text-gray-600">
                                    Review and approval actions will appear here after the request is submitted. Each approver sees the same form layout, while only the relevant section is editable.
                                </div>
                            </section>

                            <div class="border-t pt-4 flex items-center justify-between gap-4">
                                <a href="{{ route('requests.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Save Draft</a>
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Submit Request') }}</x-primary-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        let rowIndex = 1;

        const tableBody = document.getElementById('items-body');
        const addButton = document.getElementById('add-item');
        const totalCostSpan = document.getElementById('total-cost');

        function calculateTotals() {
            let grandTotal = 0;
            const rows = tableBody.querySelectorAll('tr.item-row');

            rows.forEach(row => {
                const qty = parseFloat(row.querySelector('input[name*="[qty]"]').value) || 0;
                const cost = parseFloat(row.querySelector('input[name*="[est_cost]"]').value) || 0;
                const rowTotal = qty * cost;
                
                const totalCell = row.querySelector('.row-total');
                if (totalCell) totalCell.textContent = rowTotal.toFixed(2);

                grandTotal += rowTotal;
            });

            totalCostSpan.textContent = grandTotal.toFixed(2);
        }

        addButton.addEventListener('click', function () {
            const newRow = document.createElement('tr');
            newRow.className = 'item-row';
            newRow.innerHTML = `
                <td class="px-2 py-2 text-sm">${tableBody.children.length + 1}</td>
                <td class="px-2 py-2"><input name="items[${rowIndex}][description]" class="w-full border-gray-300 rounded-md text-sm" /></td>
                <td class="px-2 py-2"><input name="items[${rowIndex}][part_number]" class="w-full border-gray-300 rounded-md text-sm" /></td>
                <td class="px-2 py-2"><input name="items[${rowIndex}][qty]" type="number" min="1" class="w-20 border-gray-300 rounded-md text-sm qty-input" /></td>
                <td class="px-2 py-2"><input name="items[${rowIndex}][est_cost]" type="number" step="0.01" class="w-28 border-gray-300 rounded-md text-sm cost-input" /></td>
                <td class="px-2 py-2 text-sm text-gray-600 row-total">0.00</td>
                <td class="px-2 py-2"><input name="items[${rowIndex}][reason]" class="w-36 border-gray-300 rounded-md text-sm" /></td>
                <td class="px-2 py-2"><button type="button" class="text-red-600 remove-row">Remove</button></td>
            `;
            tableBody.appendChild(newRow);
            rowIndex++;
        });

        tableBody.addEventListener('input', function (e) {
            if (e.target.classList.contains('qty-input') || e.target.classList.contains('cost-input')) {
                calculateTotals();
            }
        });

        tableBody.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
                if (tableBody.querySelectorAll('tr.item-row').length > 1) {
                    e.target.closest('tr').remove();
                    calculateTotals();
                }
            }
        });
    });
</script>
</x-app-layout>
