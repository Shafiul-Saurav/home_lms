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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();

            // Main Header Section
            $table->string('main_heading')->nullable();
            $table->text('main_description')->nullable();
            $table->string('video_url')->nullable();

            // Benefits Section
            $table->text('benefits_title')->nullable();
            $table->json('benefits_list')->nullable(); // Store as JSON array

            // Why Buy Section
            $table->text('why_buy_title')->nullable();
            $table->json('why_buy_images')->nullable(); // Store as JSON array of image paths
            $table->text('why_buy_description')->nullable();

            // Usage Instructions Section
            $table->text('usage_title')->nullable();
            $table->text('usage_instructions')->nullable();

            // Certificate Section
            $table->text('certificate_title')->nullable();
            $table->string('certificate_subtitle')->nullable();
            $table->string('certificate_image')->nullable();


            // CTA Banner Section
            $table->string('cta_banner_image')->nullable();
            $table->text('cta_banner_text')->nullable();
            $table->string('cta_banner_phone')->nullable();

            // Footer Section
            $table->text('footer_text')->nullable();

            // Status & Visibility
            $table->boolean('is_active')->default(true);
            $table->json('section_visibility')->nullable(); // To control which sections to show

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landingpages');
    }
};
