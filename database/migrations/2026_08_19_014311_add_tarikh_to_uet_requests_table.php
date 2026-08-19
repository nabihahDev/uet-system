<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('uet_requests', function (Blueprint $table) {
            // Only add column if it doesn't exist yet
            if (!Schema::hasColumn('uet_requests', 'nama_pemohon')) {
                $table->string('nama_pemohon')->nullable()->after('tarikh');
            }
        });
    }

    public function down(): void
    {
        Schema::table('uet_requests', function (Blueprint $table) {
            if (Schema::hasColumn('uet_requests', 'nama_pemohon')) {
                $table->dropColumn('nama_pemohon');
            }
        });
    }
};