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
        Schema::create('landingpage_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('landingpage_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('order')->default(0); // To specify the order of products on the landing page
            $table->boolean('is_featured')->default(false); // To highlight specific products
            $table->timestamps();

            $table->foreign('landingpage_id')->references('id')->on('landing_pages')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Ensure unique combinations
            $table->unique(['landingpage_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landingpage_product');
    }
};
