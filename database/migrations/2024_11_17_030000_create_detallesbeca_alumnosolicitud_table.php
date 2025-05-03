<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detallesbeca_alumnosolicitud', function (Blueprint $table) {
            $table->id();
            $table->integer('detalles_beca_id')->unsigned();  
            $table->unsignedBigInteger('alumno_solicitudbeca_id'); // Cambiado a unsignedBigInteger
            $table->timestamps();

            $table->foreign('detalles_beca_id')->references('id')->on('detalles_becas')->onDelete('no action')->onUpdate('no action');
            $table->foreign('alumno_solicitudbeca_id')->references('id')->on('alumno_solicitudbeca')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detallesbeca_alumnosolicitud');
    }
};

