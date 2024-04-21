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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('a1_price');
            $table->tinyInteger('a2_facility');
            $table->tinyInteger('a3_parking');
            $table->tinyInteger('a4_time');
            $table->tinyInteger('a5_roomate');
            $table->tinyInteger('a6_toilet');
            $table->tinyInteger('a7_kitchen');
            $table->tinyInteger('a8_near_center');
            $table->tinyInteger('a9_distance');
            $table->tinyInteger('a10_bus');
            $table->tinyInteger('a11_security');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
