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
        Schema::create('public_record', function (Blueprint $table) {
            $table->id();
           
            $table->foreignId('id_pharma')
            ->constrained('pharmacy')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            
            $table->foreignId('id_warehouse')
            ->constrained('warehouse')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
           
            $table->foreignId('id_driver')
            ->constrained('driver')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
           
            $table->foreignId('id_user')
            ->constrained('users')
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
        Schema::dropIfExists('public_record');
    }
};
