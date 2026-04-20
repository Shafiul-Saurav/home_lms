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
            $table->foreignId('category_id')->constrained('exam_categories')->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null');
            $table->string('mcq_written')->default('mcq'); // mcq, written, both
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->string('free_paid')->default('free');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('temporary_permanent')->default('permanent');
            $table->dateTime('start_date')->nullable();
            $table->string('exam_time')->nullable(); // e.g. "60 minutes" or just string
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
