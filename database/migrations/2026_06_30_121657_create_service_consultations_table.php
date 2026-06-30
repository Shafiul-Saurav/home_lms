<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company_name')->nullable();
            $table->foreignId('service_id')->constrained('servicetwos')->onDelete('cascade');
            $table->foreignId('timeslot_id')->constrained('service_consultation_timeslots')->onDelete('cascade');
            $table->string('expected_timeline')->nullable();
            $table->longText('project_requirement');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_consultations');
    }
};
