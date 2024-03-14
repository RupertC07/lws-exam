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
        Schema::create('episodes_tbl', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('description');
            $table->string('cover');
            $table->integer('episode');
            $table->string('season');
            $table->string('anime_id');
            $table->softDeletesDatetime()->nullable(false); 
            $table->foreign('anime_id')->references('id')->on('anime_tbl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes_tbl');
    }
};
