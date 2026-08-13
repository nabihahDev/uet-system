<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('uet_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained('users')->onDelete('cascade');
            $table->string('reference_no')->unique(); // e.g. UET-2026-0001
            $table->string('kepada')->default('Timb Peg Turus PP & JKU JSTH LOG KEMENTAH');
            $table->string('daripada'); // e.g. DBSTUDB
            $table->string('unit'); // e.g. HQ 6 WINGS
            $table->string('jku_bil')->nullable();
            $table->date('request_date');
            $table->text('alasan_keterangan')->nullable(); // Section 1 justification
            $table->string('status')->default('submitted'); // submitted, oc_approved, co_approved, etc.
            $table->timestamps();
        });

        Schema::create('uet_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uet_request_id')->constrained('uet_requests')->onDelete('cascade');
            $table->string('item_unit'); // e.g. AIS-ESS
            $table->string('nama_barang'); // e.g. SERVER RACK, UPS
            $table->integer('qty_dipohon'); // Di Pohon Kan
            $table->integer('qty_diluluskan')->nullable(); // Filled later by MINDEF
            $table->integer('simpanan_ada')->default(0); // Dalam Simpanan Unit (Ada)
            $table->integer('simpanan_tidak_ada')->default(0); // Dalam Simpanan Unit (Tidak Ada)
            $table->string('muka_surat_jku')->nullable();
            $table->string('status_pindaan')->default('BARU'); // BARU / PENGURANGAN / PENAMBAHAN
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uet_request_items');
        Schema::dropIfExists('uet_requests');
    }
};