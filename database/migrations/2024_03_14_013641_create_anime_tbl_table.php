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
        Schema::create('anime_tbl', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('category')->nullable(true);
            $table->string('description');
            $table->string('publisher')->nullable(true);
            $table->string('cover');
            $table->string('type');
            $table->string('status')->nullable(true);
            $table->softDeletesDatetime()->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anime_tbl');
    }
};
