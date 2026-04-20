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
        Schema::create('pdf_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pdf_book_category_id')->nullable()->constrained('pdf_book_categories')->onDelete('set null');
            $table->foreignId('pdf_book_subcategory_id')->nullable()->constrained('pdf_book_subcategories')->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->string('image')->nullable();
            $table->string('pdf_file')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_books');
    }
};
