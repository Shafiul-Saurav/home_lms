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
        Schema::create('photogalleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('photocategories')->onDelete('cascade');
            $table->string('title');
            $table->string('price');
            $table->string('gall_image')->default('default_gall_image.jpg');
            $table->longText('description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_home')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photogalleries');
    }
};
