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
            $table->string('title')->nullable();
            $table->string('occupancy')->nullable();
            $table->string('bed_type')->nullable();
            $table->string('image')->default('default_room.jpg');
            $table->longText('description')->nullable();
            $table->string('price')->nullable();
            $table->boolean('is_wifi')->default(true);
            $table->boolean('is_ac')->default(true);
            $table->boolean('is_tv')->default(true);
            $table->boolean('balcony')->default(false);
            $table->boolean('mini_fridge')->default(false);
            $table->boolean('kitchenette')->default(false);
            $table->boolean('living_area')->default(false);
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
