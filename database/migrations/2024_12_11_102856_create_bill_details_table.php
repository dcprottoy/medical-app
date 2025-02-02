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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_main_id');
            $table->integer('patient_id');
            $table->integer('service_category_id')->nullable();
            $table->integer('referrence_id');
            $table->integer('item_id');
            $table->date('bill_date');
            $table->date('delivery_date')->nullable();
            $table->double('price');
            $table->double('quantity');
            $table->double('final_price');
            $table->double('discount_percent')->default(0)->nullable();;
            $table->double('discount_amount')->default(0)->nullable();;
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
        Schema::dropIfExists('bill_details');
    }
};
