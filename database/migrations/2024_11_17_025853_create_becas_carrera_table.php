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
        Schema::create('becas_carrera', function (Blueprint $table) {  
            $table->increments('id');  
            $table->bigInteger('carreras_id')->unsigned();  
            $table->integer('detalles_beca_id')->unsigned();  
            $table->integer('cantidad_de_becas'); // Agregar el campo cantidad_de_becas
            $table->timestamps();  

            $table->foreign('carreras_id')->references('id')->on('carreras')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('detalles_beca_id')->references('id')->on('detalles_becas')->onDelete('no action')->onUpdate('no action');  
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('becas_carrera');
    }
};
