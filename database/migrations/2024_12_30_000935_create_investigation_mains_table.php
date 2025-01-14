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
        Schema::create('investigation_mains', function (Blueprint $table) {
            $table->id();
            $table->string('investigation_name');
            $table->integer('investigation_type_id')->nullable();
            $table->integer('investigation_group_id')->nullable();
            $table->decimal('price',18,2)->nullable();
            $table->decimal('discount_per',18,2)->nullable();
            $table->decimal('discount_amount',18,2)->nullable();
            $table->decimal('final_price',18,2)->nullable();
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
        Schema::dropIfExists('investigation_mains');
    }
};
