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
        Schema::create('user_tbl', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->string('email');
            $table->date('dob');
            $table->string('contactNumber');
            $table->string('password');
            $table->softDeletesDatetime()->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tbl');
    }
};
