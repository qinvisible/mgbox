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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->reference('orders')->on('id');
            $table->bigInteger('product_id')->reference('product')->on('id');
            $table->string('name', 100)->nullable();
            $table->decimal('price', 0, 0)->nullable()->default(0);
            $table->decimal('width', 0, 0)->nullable()->default(0);
            $table->decimal('height', 0, 0)->nullable()->default(0);
            $table->decimal('length', 0, 0)->nullable()->default(0);
            $table->decimal('thickness', 0, 0)->nullable()->default(0);
            $table->integer('item_number')->default(0);
            $table->integer('item_done')->default(0);
            $table->integer('item_remaining')->default(0);
            $table->enum('status', ['done', 'failed', 'need_to_rev'])->default('done');
            $table->text('need_to_rev_notes');
            $table->timestamp('target_date');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
