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
        Schema::create('prescription_mains', function (Blueprint $table) {

            $table->id();
            $table->integer('prescription_id');
            $table->integer('appoint_id');
            $table->integer('patient_id');
            $table->integer('doctor_id');
            $table->string('patient_name');
            $table->string('patient_gender');
            $table->string('patient_age');
            $table->date('prescribed_date');
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
        Schema::dropIfExists('prescription_mains');
    }
};
