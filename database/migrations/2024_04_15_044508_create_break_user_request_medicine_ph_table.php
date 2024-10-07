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
        Schema::create('break_user_request_medicine_ph', function (Blueprint $table) {
            $table->id();
           
            $table->foreignId('id_user_request')
            ->constrained('user_request')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            
            $table->foreignId('id_ph_medicine')
            ->constrained('pharma_medicine')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->timestamps();

            $table->string('image_rasheta')->nullable();
            $table->integer('quantety');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('break_user_request_medicine_ph');
    }
};
