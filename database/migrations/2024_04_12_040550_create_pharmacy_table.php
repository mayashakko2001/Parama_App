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
        Schema::create('pharmacy', function (Blueprint $table) {
            $table->id();
            $table->string('PhName');
            $table->integer('PhPhone');
            $table->integer('role')->default(3);
            $table->string('email')->unique();
           
            $table ->softDeletes();
            $table->string('password');
            
            $table->enum('state',['accept','disallow','NotYetDetermined'])->default('NotYetDetermined');      
            $table->enum('state2',['accept','disallow','NotYetDetermined'])->default('NotYetDetermined'); 
             $table->enum('state3',['accept','disallow','NotYetDetermined'])->default('NotYetDetermined'); 
            $table->string('license');
          
            $table->string('certificate');
            $table->string('image')->default('null'); 
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy');
    }
};
