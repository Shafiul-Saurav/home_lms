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
        Schema::table('roomtypes', function (Blueprint $table) {
            $table->string('sm_image')->default('default_sm_image.jpg')->after('description');
            $table->string('lg_image')->default('default_lg_image.jpg')->after('sm_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roomtypes', function (Blueprint $table) {
            $table->dropColumn(['sm_image', 'lg_image']);
        });
    }
};
