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
        Schema::create('driver', function (Blueprint $table) {
            $table->id();
            $table->string('DrName');
            $table->string('email')->unique();
            $table->string('DrPhone');
            $table->string('password');
            $table->string('cv');
            $table->integer('role')->default(4);
            $table->string('image')->default('null'); 
            $table ->softDeletes();
            $table->enum('state',['accept','disallow','NotYetDetermined'])->default('NotYetDetermined');
            
          
            $table->string('transport');
          

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver');
    }
};
