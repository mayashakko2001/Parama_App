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
        Schema::create('address_warehouse', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_warehouse')
            ->constrained('warehouse')
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
        Schema::dropIfExists('address_warehouse');
    }
};
