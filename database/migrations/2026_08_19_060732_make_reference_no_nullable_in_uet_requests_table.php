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
        if (Schema::hasColumn('uet_requests', 'reference_no')) {
            $table->string('reference_no')->nullable()->change();
        } else {
            $table->string('reference_no')->nullable();
        }
    });
}

public function down(): void
{
    Schema::table('uet_requests', function (Blueprint $table) {
        if (Schema::hasColumn('uet_requests', 'reference_no')) {
            $table->string('reference_no')->nullable(false)->change();
        }
    });
}
};
