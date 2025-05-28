<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek dan tambahkan kolom email jika belum ada
        if (!Schema::hasColumn('customers', 'email')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->string('email')->unique()->nullable()->after('nama'); // nullable dulu agar tidak error pada data lama
            });
        }

        // Cek dan tambahkan kolom password jika belum ada
        if (!Schema::hasColumn('customers', 'password')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->string('password')->nullable()->after('email'); // nullable dulu
            });
        }

        // Cek dan tambahkan kolom email_verified_at jika belum ada
        if (!Schema::hasColumn('customers', 'email_verified_at')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->timestamp('email_verified_at')->nullable()->after('password');
            });
        }
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['email', 'password', 'email_verified_at']);
        });
    }
};
