<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'signature_pin') && !Schema::hasColumn('users', 'approval_pin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('signature_pin', 'approval_pin');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'approval_pin') && !Schema::hasColumn('users', 'signature_pin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('approval_pin', 'signature_pin');
            });
        }
    }
};
