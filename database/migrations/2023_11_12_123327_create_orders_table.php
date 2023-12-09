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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->reference('customers')->on('id');
            $table->enum('status', ['received', 'pending', 'process', 'ready_to_send', 'on_deliver', 'delivered', 'cancelled', 'done' ])->default('received');
            $table->text('note')->nullable();
            $table->decimal('total_payment', 0, 0)->nullable()->default(0);
            $table->decimal('remaining_payment', 0, 0)->nullable()->default(0);
            $table->decimal('paid', 0, 0)->nullable()->default(0);
            $table->timestamp('payment_deadline');
            $table->softDeletes('deleted_at', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
