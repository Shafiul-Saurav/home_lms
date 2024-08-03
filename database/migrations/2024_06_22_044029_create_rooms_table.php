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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roomtype_id')->constrained('roomtypes')->onDelete('cascade');
            $table->string('title');
            $table->string('image')->default('default_room.jpg');
            $table->longText('description');
            $table->string('price');
            $table->boolean('is_wifi')->default(true);
            $table->boolean('is_ac')->default(true);
            $table->boolean('is_tv')->default(true);
            $table->boolean('is_balcony')->default(false);
            $table->boolean('is_mini_fridge')->default(false);
            $table->boolean('is_kitchenette')->default(false);
            $table->boolean('is_living_area')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
