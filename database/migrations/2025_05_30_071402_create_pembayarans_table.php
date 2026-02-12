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
        if (!Schema::hasTable('pembayarans')) {
            Schema::create('pembayarans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
                $table->string('metode')->default('Midtrans'); // misalnya hanya pakai Midtrans
                $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
                $table->json('midtrans_response')->nullable(); // menyimpan response JSON
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
