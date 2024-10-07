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
        Schema::create('address_pharma', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pharma')
            ->constrained('pharmacy')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->string('Governorate_name');
            $table->string('Area_name');
            $table->string('street_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_pharma');
    }
};
