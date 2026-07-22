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
        Schema::create('course_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
            $table->foreignId('lesson_id')->nullable()->constrained('lessons')->onDelete('cascade');
            $table->text('title');
            $table->text('module_type')->nullable();
            $table->string('duration', 255)->nullable();
            $table->text('article')->nullable();
            $table->text('link')->nullable();
            $table->text('free_paid')->nullable();
            $table->text('live_record')->nullable();
            $table->text('pdf_file')->nullable();
            $table->text('date');
            $table->text('time');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_modules');
    }
};
