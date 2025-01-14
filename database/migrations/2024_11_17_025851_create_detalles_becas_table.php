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
        Schema::create('detalles_becas', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('administrador_general_id')->unsigned();
            $table->string('estado_convocatoria', 45);
            $table->date('inicio_convocatoria'); // New field for the start date of the convocatoria
            $table->date('fin_convocatoria'); // New field for the end date of the convocatoria
            $table->timestamps();

            $table->foreign('administrador_general_id')->references('id')->on('administradores_generales')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_becas');
    }
};
