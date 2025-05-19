<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Ubah kolom price jadi decimal(12, 2)
            $table->decimal('price', 12, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Kembalikan ke decimal(8, 2)
            $table->decimal('price', 8, 2)->change();
        });
    }
};
