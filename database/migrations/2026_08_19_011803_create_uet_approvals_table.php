<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uet_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uet_request_id')->constrained('uet_requests')->onDelete('cascade');
            
            // OC / Timb Peg Turus inputs
            $table->text('ulasan_timb_peg_turus')->nullable();
            $table->string('nama_timb_peg_turus')->nullable();
            $table->enum('keputusan_jku', ['diluluskan', 'tidak_diluluskan'])->nullable();
            $table->string('bilangan_diluluskan')->nullable();
            $table->string('bilangan_tidak_diluluskan')->nullable();
            $table->string('nama_setiausaha')->nullable();

            // QM / Committee inputs
            $table->text('keputusan_jkg')->nullable();
            $table->text('catatan_jku')->nullable();
            $table->string('pindaan_bilangan_jku')->nullable();
            $table->string('nama_pembantu_staf_jku')->nullable();
            $table->string('nama_timb_peg_turus_jku')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uet_approvals');
    }
};