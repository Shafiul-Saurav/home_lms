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
        Schema::create('landing_page_review_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landingpage_id')->constrained('landing_pages')->onDelete('cascade');
            $table->string('image_path'); // Store the image file path
            $table->string('section_type')->default('review'); // To specify which section the image belongs to (e.g., 'review', 'screenshot', etc.)
            $table->integer('order')->default(0); // To specify the order of images
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_page_review_images');
    }
};