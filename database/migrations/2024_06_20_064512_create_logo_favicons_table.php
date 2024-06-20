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
        Schema::create('logo_favicons', function (Blueprint $table) {
            $table->id();
            $table->string('web_name');
            $table->string('logo')->nullable()->default('default_logo.jpg');
            $table->string('favicon')->nullable()->default('default_favicon.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_favicons');
    }
};
