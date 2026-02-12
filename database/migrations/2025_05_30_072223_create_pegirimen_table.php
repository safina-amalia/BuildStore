<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('pengirimen')) {
            Schema::create('pengirimen', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
                $table->foreignId('kurir_id')->constrained('kurirs')->onDelete('cascade');
                $table->enum('status', ['pending', 'sedang dikirim', 'diterima'])->default('pending');
                $table->timestamp('tanggal_dikirim')->nullable();
                $table->timestamp('tanggal_diterima')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimen');
    }
};
