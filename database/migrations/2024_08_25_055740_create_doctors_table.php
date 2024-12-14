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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('doctor_id');
            $table->integer('department_id')->nullable();
            $table->string('address');
            $table->string('contact_no');
            $table->string('emr_cont_no')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('sex',['M','F','O']);
            $table->enum('status',['Y','N'])->default('Y');
            $table->text('degree')->nullable();
            $table->text('specialities')->nullable();
            $table->date('appointed_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
