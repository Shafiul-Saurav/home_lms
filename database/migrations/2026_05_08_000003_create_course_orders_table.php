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
        Schema::create('course_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('order_number')->unique()->nullable();
            $table->string('transaction_id')->nullable(); // SSLCommerz transaction ID
            $table->string('currency')->default('BDT');
            $table->decimal('amount', 10, 2);
            $table->decimal('price', 10, 2);
            $table->date('date')->nullable();
            $table->boolean('agree')->default(false);
            $table->enum('status', ['pending', 'Enrolled'])->default('pending');
            $table->string('payment_status')->default('Pending'); // Payment status: Pending, Completed, Failed, Cancelled
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
        Schema::dropIfExists('course_orders');
    }
};
