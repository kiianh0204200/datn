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
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('SET NULL');
            $table->foreignId('product_category_id')->nullable()->constrained('product_categories')->onDelete('SET NULL');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail');
            $table->string('slug')->unique();
            $table->double('price', 16, 2);
            $table->decimal('discount')->default(0);
            $table->string('condition')->default('new');
            $table->boolean('is_active')->default(true);
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
