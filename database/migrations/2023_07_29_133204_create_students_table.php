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
        Schema::create('students', function (Blueprint $table) {
           
            $table->string('student_id')->primary();
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('sex');
            $table->integer('age');
            $table->integer('phone');
            $table->float('entranceResult');
            $table->float('cgpa');
            $table->integer('cocResult');
            $table->string('department');
            $table->string('batch');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
