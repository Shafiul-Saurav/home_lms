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
            $table->foreignId('category_id')->nullable()->constrained('product_categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained('product_subcategories')->onDelete('set null');
            $table->foreignId('childcategory_id')->nullable()->constrained('product_childcategories')->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->decimal('purchase_price', 10, 2)->default(0);
            $table->decimal('sell_price', 10, 2)->default(0);
            $table->string('product_quantity');
            $table->string('color')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('size')->nullable();
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->boolean('is_stock')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_home')->default(false);
            $table->string('image')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->longText('additional_info')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
