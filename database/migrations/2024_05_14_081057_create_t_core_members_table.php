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
        Schema::create('t_core_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("core_member_id");
            $table->string("member_name");
            $table->string("member_position");
            $table->text("member_description");
            $table->string("language");
            $table->timestamps();
        });
        Schema::table('t_core_members', function (Blueprint $table) {
            $table->foreign('core_member_id')->references('id')->on('core_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_core_members');
    }
};
