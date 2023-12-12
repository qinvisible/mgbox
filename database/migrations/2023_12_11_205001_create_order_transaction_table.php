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
        Schema::create('order_transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->reference('orders')->on('id');
            $table->enum('type', ['down_payment','payment', 'refund']);
            $table->decimal('amount')->default(0);
            $table->timestamp('date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_transaction');
    }
};
