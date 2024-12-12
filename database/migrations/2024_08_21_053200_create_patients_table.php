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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('patient_id');
            $table->string('address');
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->integer('day')->nullable();
            $table->string('contact_no');
            $table->string('emr_cont_no')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('sex',['M','F','O']);
            $table->enum('status',['Y','N'])->default('Y');
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
        Schema::dropIfExists('patients');
    }
};
