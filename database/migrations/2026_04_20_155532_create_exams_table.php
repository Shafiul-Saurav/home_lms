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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('exam_categories')->onDelete('set null');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('mcq_written')->default('mcq');
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->string('free_paid')->default('free');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('temporary_permanent')->default('permanent');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('exam_time')->nullable();
            $table->string('pdf_file')->nullable();
            $table->longText('written_paragraph')->nullable();
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
        Schema::dropIfExists('exams');
    }
};
