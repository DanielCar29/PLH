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
        Schema::create('listas_solicitud', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carreras_id');
            $table->unsignedBigInteger('solicitud_de_beca_id');
            $table->string('estado')->default('pendiente');
            $table->boolean('envio')->default(false);
            $table->foreign('carreras_id')->references('id')->on('carreras')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('solicitud_de_beca_id')->references('id')->on('solicitudes_de_beca')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listas_solicitud');
    }
};
