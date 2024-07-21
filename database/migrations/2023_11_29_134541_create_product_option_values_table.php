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
        Schema::create('product_option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('CASCADE');
            $table->foreignId('color_id')->constrained('product_options')->onDelete('CASCADE');
            $table->foreignId('size_id')->constrained('product_options')->onDelete('CASCADE');
            $table->double('price', 16, 2);
            $table->integer('in_stock')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option_values');
    }
};
