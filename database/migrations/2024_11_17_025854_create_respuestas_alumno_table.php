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
        Schema::create('respuestas_alumno', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('preguntas_id')->unsigned();    
            $table->bigInteger('supervisor_id')->unsigned();  
            $table->string('respuesta', 200)->default('no contesto');  
            $table->timestamps(); 
           
            $table->foreign('preguntas_id')->references('id')->on('preguntas_de_solicitud_del_alumno')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('supervisor_id')->references('id')->on('supervisores')->onDelete('no action')->onUpdate('no action');  
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_alumno');
    }
};
