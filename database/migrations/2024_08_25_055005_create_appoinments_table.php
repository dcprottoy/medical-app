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
        Schema::create('appoinments', function (Blueprint $table) {
            $table->id();
            $table->integer('appoint_id');
            $table->integer('patient_id');
            $table->integer('doctor_id');
            $table->date('appointed_date');
            $table->integer('appointment_type_id')->nullable();
            $table->boolean('referred_appointment')->default(false);
            $table->integer('referred_by')->nullable();
            $table->boolean('transferred_appointment')->default(false);
            $table->integer('transferred_to')->nullable();
            $table->text('note')->nullable();
            $table->integer('serial')->nullable();
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
        Schema::dropIfExists('appoinments');
    }
};
