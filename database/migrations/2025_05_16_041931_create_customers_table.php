<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        if (!Schema::hasTable('customers')) {
            Schema::create('customers', function (Blueprint $table) {
                $table->id();

                // Relasi ke tabel users
                $table->foreignId('user_id')->constrained()->onDelete('cascade');

                // Informasi pelanggan
                $table->string('nama');
                $table->string('email')->unique(); // email unik, tidak boleh duplikat
                $table->string('alamat');
                $table->string('no_tlp');

                $table->timestamps();
            });
        }
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
