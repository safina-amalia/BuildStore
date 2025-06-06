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
        if (!Schema::hasTable('detail_pesanans')) {
            Schema::create('detail_pesanans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
                $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
                $table->integer('jumlah');
                $table->decimal('harga_satuan', 10, 2);
                $table->decimal('subtotal', 10, 2);
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
