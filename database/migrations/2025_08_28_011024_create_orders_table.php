<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->uuid('guest_id')->nullable();
            $table->string('order_number')->unique();
            $table->string('payment_method')->nullable();
            $table->string('stripe_payment_id')->nullable();
            $table->string('status')->default('pending');
            $table->integer('subtotal')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('shipping_cost')->default(0);
            $table->integer('tax')->default(0);
            $table->integer('total')->default(0);
            $table->json('details')->nullable(); // itens, carrinho etc.
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
