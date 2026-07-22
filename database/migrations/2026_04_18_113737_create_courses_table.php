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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('course_level')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->string('free_or_paid')->nullable();
            $table->string('image');
            $table->string('pdf')->nullable();
            $table->text('description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('live_schedule')->nullable();
            $table->text('start_date')->nullable();
            $table->text('end_date')->nullable();
            $table->string('max_student')->nullable();
            $table->string('meeting_link')->nullable();
            $table->string('button_type')->nullable();
            $table->text('learning_outcomes')->nullable();
            $table->text('requirement')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('is_active')->nullable();
            $table->string('live_or_record')->nullable();
            $table->boolean('is_offline')->nullable();
            $table->string('video_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
