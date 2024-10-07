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
        Schema::create('break_ph_request_medicine', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_waMedicin')
            ->constrained('warehouse_medicine')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        
            $table->foreignId('id_request_ph')
            ->constrained('pharma_request')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->integer('quantety');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('break_ph_request_medicine');
    }
};
