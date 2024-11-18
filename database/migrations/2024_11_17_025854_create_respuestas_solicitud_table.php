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
        Schema::create('respuestas_solicitud', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('solicitud_de_beca_id')->unsigned();
            $table->bigInteger('respuestas_alumno_id')->unsigned();
            $table->timestamps();
                        //
            $table->foreign('solicitud_de_beca_id')->references('id')->on('preguntas_de_solicitud_del_alumno')->onDelete('no action')->onUpdate('no action');
            $table->foreign('respuestas_alumno_id')->references('id')->on('respuestas_alumno')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_solicitud');
    }
};
