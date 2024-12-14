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
        Schema::create('appointment_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('day_diff')->default(0);
            $table->integer('appointment_type_id');
            $table->integer('fee_amount');
            $table->enum('status',['Y','N'])->default('Y');
            $table->boolean('is_default')->default(false);
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
        Schema::dropIfExists('appointment_fees');
    }
};
