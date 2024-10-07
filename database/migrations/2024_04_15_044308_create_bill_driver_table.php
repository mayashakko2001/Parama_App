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
        Schema::create('bill_driver', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_driver')
            ->constrained('driver')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
             
            $table->foreignId('id_user_request')
            ->constrained('user_request')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->enum('state_bill',['accept','disallow','NotYetDetermined'])->default('NotYetDetermined');
            $table->enum('state_bill_driver',['accept','disallow','NotYetDetermined'])->default('NotYetDetermined');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_driver');
    }
};
