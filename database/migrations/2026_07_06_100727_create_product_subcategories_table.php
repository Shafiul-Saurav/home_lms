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
        if (! Schema::hasTable('product_subcategories')) {
            Schema::create('product_subcategories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_category_id')->nullable()->constrained('product_categories')->onDelete('cascade');
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('file')->nullable();
                $table->boolean('is_active')->default(true);
                $table->boolean('is_home')->default(false);
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_subcategories');
    }
};
