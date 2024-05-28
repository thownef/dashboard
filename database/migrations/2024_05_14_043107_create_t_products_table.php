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
        Schema::create('t_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->string("product_name")->nullable();
            $table->text("product_description")->nullable();
            $table->string("language");
            $table->timestamps();
        });
        Schema::table('t_products', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_products');
    }
};
