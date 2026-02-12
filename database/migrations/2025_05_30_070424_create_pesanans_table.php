<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('pesanans')) {
            Schema::create('pesanans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // customer
                $table->foreignId('kurir_id')->nullable()->constrained('kurirs')->onDelete('set null'); // kurir yang ditugaskan
                $table->string('kode_pesanan')->unique();
                $table->decimal('total_harga', 12, 2)->default(0);
                $table->enum('status', ['pending', 'diterima', 'ditolak', 'dikirim', 'selesai'])->default('pending');
                $table->enum('pembayaran_status', ['unpaid', 'paid'])->default('unpaid');
                $table->enum('pengiriman_status', ['pending', 'dikirim', 'diterima'])->default('pending');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
