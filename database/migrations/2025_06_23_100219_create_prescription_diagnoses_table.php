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
        Schema::create('prescription_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->integer('prescription_id');
            $table->string('diagnosis_id')->nullable();
            $table->string('diagnosis_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_diagnoses');
    }
};
