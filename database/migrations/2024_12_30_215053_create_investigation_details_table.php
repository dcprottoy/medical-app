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
        Schema::create('investigation_details', function (Blueprint $table) {
            $table->id();
            $table->integer('investigation_main_id');
            $table->integer('investigation_section_id')->nullable();
            $table->string('details_name');
            $table->text('refference_value')->nullable();
            $table->integer('serial');
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
        Schema::dropIfExists('investigation_details');
    }
};
