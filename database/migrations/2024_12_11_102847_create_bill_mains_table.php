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
        Schema::create('bill_mains', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id');
            $table->integer('patient_id');
            $table->string('patient_name');
            $table->date('bill_date');
            $table->double('total_amount');
            $table->double('discount_percent');
            $table->double('discount_amount');
            $table->double('paid_amount');
            $table->double('due_amount');
            $table->double('return_amount');
            $table->char('returned_status',1);
            $table->boolean('paid_status')->nullable()->default(false);
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
        Schema::dropIfExists('bill_mains');
    }
};
