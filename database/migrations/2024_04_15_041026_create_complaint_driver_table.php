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
        Schema::create('complaint_driver', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_driver')
            ->constrained('driver')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
           
            $table->string('category_user');
            $table->longText('description');
            $table->string('his_phone');
            $table->string('his_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_driver');
    }
};
