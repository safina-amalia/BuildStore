<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Menambahkan kolom email
            if (!Schema::hasColumn('customers', 'email')) {
                $table->string('email')->unique()->after('nama'); // Setelah kolom 'nama'
            }
            // Menambahkan kolom password
            if (!Schema::hasColumn('customers', 'password')) {
                $table->string('password')->after('email'); // Setelah kolom 'email'
            }
            // Menambahkan kolom verifikasi email (jika diperlukan)
            if (!Schema::hasColumn('customers', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('password'); // Setelah kolom 'password'
            }
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Menghapus kolom yang ditambahkan
            $table->dropColumn(['email', 'password', 'email_verified_at']);
        });
    }
};