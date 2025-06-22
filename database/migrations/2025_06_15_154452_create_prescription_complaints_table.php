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
        Schema::create('prescription_complaints', function (Blueprint $table) {
            $table->id();
            $table->integer('prescription_id');
            $table->integer('complaint_id')->nullable();
            $table->string('complaint');
            $table->string('complaint_duration')->nullable();
            $table->integer('complaint_duration_id')->nullable();
            $table->string('complaint_duration_value')->nullable();
            $table->string('complaint_duration_value_id')->nullable();
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
        Schema::dropIfExists('prescription_complaints');
    }
};
