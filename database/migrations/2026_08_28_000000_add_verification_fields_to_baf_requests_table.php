<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('baf_requests', function (Blueprint $table) {
            $table->string('vote_title')->nullable();
            $table->string('vote_signature_path')->nullable();
            $table->date('vote_date')->nullable();
            $table->string('auth_title')->nullable();
            $table->string('auth_code')->nullable();
            $table->string('auth_signature_path')->nullable();
            $table->date('auth_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('baf_requests', function (Blueprint $table) {
            $table->dropColumn([
                'vote_title',
                'vote_signature_path',
                'vote_date',
                'auth_title',
                'auth_code',
                'auth_signature_path',
                'auth_date',
            ]);
        });
    }
};
