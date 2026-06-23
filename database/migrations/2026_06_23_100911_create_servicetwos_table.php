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
        Schema::create('servicetwos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicetwocategory_id')->constrained('servicetwocategories')->onDelete('cascade');
            $table->string('title');
            $table->string('service_icon');
            $table->longText('description');
            $table->string('service_type');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicetwos');
    }
};
