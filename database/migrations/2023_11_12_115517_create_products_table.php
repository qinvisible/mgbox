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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('desc');
            $table->decimal('price', 0, 0)->nullable()->default(0);
            $table->decimal('width', 0, 0)->nullable()->default(0);
            $table->decimal('height', 0, 0)->nullable()->default(0);
            $table->decimal('length', 0, 0)->nullable()->default(0);
            $table->decimal('thickness', 0, 0)->nullable()->default(0);
            $table->string('location');
            $table->bigInteger('amount')->default(1);
            $table->softDeletes('deleted_at', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
