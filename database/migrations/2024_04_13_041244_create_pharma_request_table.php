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
        Schema::create('pharma_request', function (Blueprint $table) {
            $table->id();
          
            $table->integer('id_bill_pharma');
            $table->foreignId('id_pharma')
            ->constrained('pharmacy')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
           
           
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharma_request');
    }
};
