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
        Schema::create('t_support_experts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("expert_id");
            $table->string("name");
            $table->text("specialize");
            $table->text("experience");
            $table->text("education");
            $table->text("advisory_field");
            $table->text("working_process");
            $table->text("price");
            $table->text("url_info");
            $table->string("language");
            $table->timestamps();
        });
        Schema::table('t_support_experts', function (Blueprint $table) {
            $table->foreign('expert_id')->references('id')->on('support_experts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_support_experts');
    }
};
