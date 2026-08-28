<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop jika wujud dulu untuk elak error 1050
        Schema::dropIfExists('baf_request_items');
        Schema::dropIfExists('baf_requests');

        Schema::create('baf_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('reference_no')->unique();
            
            // Requisition Info Header
            $table->string('requisition_type')->nullable(); // STOCK / SERVICES / RETURN
            $table->string('unit')->nullable();
            $table->date('required_by_date')->nullable();
            $table->string('priority')->nullable();
            $table->string('part_issue')->nullable();

            // Picking & Delivery Instructions
            $table->text('picking_slip')->nullable();
            $table->text('delivery_instructions')->nullable();

            // Account & Work Order Info
            $table->string('equipment_no')->nullable();
            $table->string('work_order_no')->nullable();
            $table->string('vote_sub_head')->nullable();

            // Requester Details
            $table->string('daripada')->nullable(); // Requested By (Appointment Title)
            $table->string('employee_code')->nullable();
            $table->date('request_date')->nullable();
            
            // Signatures & Attachments
            $table->string('signature_path')->nullable();
            $table->string('signature_hash')->nullable();
            $table->string('attachment_path')->nullable();

            // System Status
            $table->string('status')->default('pending_oc');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        Schema::create('baf_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baf_request_id')->constrained('baf_requests')->onDelete('cascade');
            
            // Item Table Columns
            $table->string('req_type_sp')->nullable();
            $table->string('stock_code')->nullable();
            $table->string('suggested_mfr')->nullable();
            $table->string('part_no')->nullable();
            $table->text('item_description');
            $table->string('unit_of_measure')->nullable();
            $table->integer('quantity_demanded')->default(0);
            $table->integer('quantity_issued')->nullable();
            $table->decimal('est_cost', 10, 2)->default(0.00);
            $table->string('ipc_ref')->nullable();
            $table->string('equip_used_on')->nullable();
            $table->string('remarks')->nullable(); // Reason for demand
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baf_request_items');
        Schema::dropIfExists('baf_requests');
    }
};