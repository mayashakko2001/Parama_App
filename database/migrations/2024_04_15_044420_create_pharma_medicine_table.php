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
        Schema::create('pharma_medicine', function (Blueprint $table) {
            $table->id();
            
            $table->integer('price');
            $table->integer('quantety');
            $table->string('name_medicine');
            $table->string('name_company');
            $table->string('image')->nullable();
            $table->enum('prescription_requierd',['yes','null'])->default('null'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharma_medicine');
    }
};
