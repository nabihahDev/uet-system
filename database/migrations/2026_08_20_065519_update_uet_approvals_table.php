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
    Schema::table('uet_approvals', function (Blueprint $table) {
        $table->foreignId('timb_peg_turus_id')->nullable()->constrained('users')->nullOnDelete();
        $table->timestamp('timb_peg_turus_signed_at')->nullable();
        
        $table->foreignId('setiausaha_id')->nullable()->constrained('users')->nullOnDelete();
        $table->timestamp('setiausaha_signed_at')->nullable();
    });
}

public function down(): void
{
    Schema::table('uet_approvals', function (Blueprint $table) {
        $table->dropForeign(['timb_peg_turus_id']);
        $table->dropForeign(['setiausaha_id']);
        $table->dropColumn([
            'timb_peg_turus_id', 'timb_peg_turus_signed_at',
            'setiausaha_id', 'setiausaha_signed_at'
        ]);
    });
}
};
