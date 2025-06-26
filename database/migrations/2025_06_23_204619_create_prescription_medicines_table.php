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
        Schema::create('prescription_medicines', function (Blueprint $table) {
            $table->id();
            $table->integer('prescription_id');
            $table->integer('medicine_id')->nullable();
            $table->string('medicine');
            $table->integer('dose_id')->nullable();
            $table->string('dose');
            $table->integer('dose_frequency_id')->nullable();
            $table->string('dose_frequency')->nullable();
            $table->integer('dose_duration_id')->nullable();
            $table->string('dose_duration')->nullable();
            $table->string('usage_id')->nullable();
            $table->string('usage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_medicines');
    }
};
