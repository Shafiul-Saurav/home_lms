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
        Schema::create('ssl_commerzs', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('store_password')->nullable();
            $table->string('sslcommerz_url')->nullable();
            $table->string('sslcommerz_validation_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ssl_commerzs');
    }
};
