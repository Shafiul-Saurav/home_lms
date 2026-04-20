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
        Schema::create('book_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_category_id')->constrained('book_categories')->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('file')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_home')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_subcategories');
    }
};
