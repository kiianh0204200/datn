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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('SET NULL');
            $table->string('order_id')->unique();
            $table->double('total')->default(0);
            $table->string('payment_method')->default('cod');
            $table->string('payment_status')->default('unpaid');
            $table->string('order_status')->default('pending');
            $table->string('payment_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->text('notes')->nullable();
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
