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
        Schema::create('t_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("area_id");
            $table->string("name");
            $table->string("language");
            $table->timestamps();
        });
        Schema::table('t_areas', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_areas');
    }
};
