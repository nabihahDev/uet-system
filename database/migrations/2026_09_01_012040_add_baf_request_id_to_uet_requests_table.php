<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('uet_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('uet_requests', 'baf_request_id')) {
                $table->foreignId('baf_request_id')->nullable()->constrained('baf_requests')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uet_requests', function (Blueprint $table) {
            if (Schema::hasColumn('uet_requests', 'baf_request_id')) {
                $table->dropForeignIdFor('baf_requests');
                $table->dropColumn('baf_request_id');
            }
        });
    }
};
