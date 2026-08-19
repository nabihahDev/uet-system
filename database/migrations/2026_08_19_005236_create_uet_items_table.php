<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uet_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uet_request_id')->constrained('uet_requests')->onDelete('cascade');
            $table->string('sub_unit')->nullable();
            $table->string('nama_barang');
            $table->integer('qty_dipohon');
            $table->boolean('dalam_simpanan_ada')->default(false);
            $table->boolean('dalam_simpanan_tiada')->default(false);
            $table->string('muka_surat_jku')->nullable();
            $table->enum('pindaan_type', ['BARU', 'PENAMBAHAN', 'PENGURANGAN'])->default('BARU');
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uet_items');
    }
};