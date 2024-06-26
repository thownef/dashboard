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
        Schema::create('t_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("review_id");
            $table->text("content");
            $table->string("language");
            $table->timestamps();
        });
        Schema::table('t_reviews', function (Blueprint $table) {
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_reviews');
    }
};
