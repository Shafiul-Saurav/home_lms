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
        Schema::create('book_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('order_number')->unique();
            $table->string('transaction_id')->nullable();
            $table->string('currency')->default('BDT');
            $table->decimal('amount', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->string('coupon_name')->nullable();
            $table->integer('qty')->default(1);
            $table->date('date')->nullable();
            $table->boolean('agree')->default(false);
            $table->enum('status', ['pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'])->default('pending');
            $table->string('payment_status')->default('Pending');
            $table->string('payment_method')->default('SSLCommerz');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_orders');
    }
};
