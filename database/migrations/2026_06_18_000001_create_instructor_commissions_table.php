<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instructor_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->decimal('admin_percentage', 5, 2)->default(30.00); // e.g., 30%
            $table->decimal('gateway_percentage', 5, 2)->default(2.50); // default gateway fee
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('negotiation_note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_commissions');
    }
};
