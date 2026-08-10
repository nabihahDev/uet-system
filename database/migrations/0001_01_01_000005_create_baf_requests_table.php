<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baf_requests', function (Blueprint $table) {
            $table->id();
            $table->string('unit_code')->nullable();
            $table->string('priority')->default('normal');
            $table->date('required_by')->nullable();
            $table->string('status')->default('draft');
            $table->json('items')->nullable();
            $table->json('user_section')->nullable();
            $table->json('oc_section')->nullable();
            $table->json('co_section')->nullable();
            $table->json('qm_section')->nullable();
            $table->json('pegawai_section')->nullable();
            $table->json('mindef_section')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baf_requests');
    }
};
