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
        Schema::create('warehouse', function (Blueprint $table) {
            $table->id();
            $table->integer('WaPhone');
            $table->string('WaName');
            $table->string('email')->unique();
           
            $table->enum('state',['accept','disallow','NotYetDetermined'])->default('NotYetDetermined');
            $table->enum('state2',['accept','disallow','NotYetDetermined'])->default('NotYetDetermined'); 
            $table->enum('state3',['accept','disallow','NotYetDetermined'])->default('NotYetDetermined'); 
            $table ->softDeletes();
            $table->string('image')->default('null'); 
            $table->string('password');
            
            $table->string('license');
            $table->integer('role')->default(2);
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse');
    }
};
