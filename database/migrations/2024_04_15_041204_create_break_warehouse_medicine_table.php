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
        Schema::create('break_warehouse_medicine', function (Blueprint $table) {
            $table->id();
 
            $table->foreignId('id_warehouse')
            ->constrained('warehouse')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
             
             
            $table->foreignId('id_medicine_wa')
            ->constrained('warehouse_medicine')
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
        Schema::dropIfExists('break_warehouse_medicine');
    }
};
