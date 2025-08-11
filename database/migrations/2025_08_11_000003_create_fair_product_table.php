<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fair_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fair_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedInteger('sold')->default(0);
            $table->boolean('sold_out')->default(false);
            $table->timestamps();

            $table->unique(['fair_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fair_product');
    }
};
