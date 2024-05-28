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
        Schema::create('core_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("company_id");
            $table->string("member_img");
            $table->integer("is_deleted")->default(0);
            $table->timestamps();
        });
        Schema::table('core_members', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_members');
    }
};
