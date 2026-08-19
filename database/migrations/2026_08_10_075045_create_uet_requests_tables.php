<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uet_requests', function (Blueprint $table) {
            $table->id();
            
            // Using applicant_id instead of user_id
            $table->foreignId('applicant_id')->constrained('users')->onDelete('cascade');
            
            $table->string('kepada');
            $table->string('daripada');
            $table->string('unit');
            $table->string('jku_bil')->nullable();
            $table->date('tarikh');
            $table->string('nama_pemohon')->nullable();
            $table->enum('status', ['draft', 'pending_oc', 'pending_qm', 'completed', 'rejected'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uet_requests');
    }
};