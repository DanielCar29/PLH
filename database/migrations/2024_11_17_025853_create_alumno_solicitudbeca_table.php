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
        Schema::create('alumno_solicitudbeca', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('solicitud_de_beca_id')->unsigned();  
            $table->bigInteger('alumno_id')->unsigned();  
            $table->string('estado', 45)->default('pendiente');
            $table->integer('envio')->default('0');
            $table->timestamps();  

            $table->foreign('solicitud_de_beca_id')->references('id')->on('solicitudes_de_beca')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('no action')->onUpdate('no action');  
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_solicitudbeca');
    }
};
