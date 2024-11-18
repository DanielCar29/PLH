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
        Schema::create('carreras_alumno', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('carreras_id')->unsigned();  
            $table->bigInteger('alumno_id')->unsigned();  
            $table->timestamps();  

            $table->foreign('carreras_id')->references('id')->on('carreras')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('no action')->onUpdate('no action');  

 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreras_alumno');
    }
};
