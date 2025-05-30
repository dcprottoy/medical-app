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
        Schema::create('bill_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('service_type_id')->nullable();
            $table->integer('investigation_type_id')->nullable();
            $table->integer('investigation_group_id')->nullable();
            $table->integer('service_category_id')->nullable();
            $table->integer('duration')->nullable();
            $table->decimal('price',18,2)->nullable();
            $table->decimal('discount_per',18,2)->nullable();
            $table->decimal('discount_amount',18,2)->nullable();
            $table->decimal('final_price',18,2)->nullable();
            $table->boolean('discountable')->default(0)->nullable();
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
        Schema::dropIfExists('bill_items');
    }
};
