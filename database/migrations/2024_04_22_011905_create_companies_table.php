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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('area_id')->default(1);
            $table->unsignedBigInteger('category_id')->default(1);
            $table->string('country');
            $table->string('company_logo')->nullable();
            $table->string('establishment')->nullable();
            $table->integer('employer')->nullable();
            $table->text('capital')->nullable();
            $table->json('languages');
            $table->string('referral_code')->nullable();
            $table->integer('highlight')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
