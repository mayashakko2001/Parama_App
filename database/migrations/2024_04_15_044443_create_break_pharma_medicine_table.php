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
        Schema::create('break_pharma_medicine', function (Blueprint $table) {
            $table->id();
            
            
            
            $table->foreignId('id_pharma')
            ->constrained('pharmacy')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            
            
            $table->foreignId('id_ph_medicine')
            ->constrained('pharma_medicine')
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
        Schema::dropIfExists('break_pharma_medicine');
    }
};
