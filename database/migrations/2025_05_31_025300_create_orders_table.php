<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('order_code')->unique();
        $table->text('address');
        $table->string('payment_method'); // 'cod' atau 'transfer'
        $table->string('status')->default('pending');
        $table->decimal('total', 10, 2);
        $table->timestamps();
    });
}

};
