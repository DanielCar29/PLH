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
        Schema::create('becas', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->date('fecha_de_autorizacion')->nullable();  
            $table->string('codigo_qr', 45)->unique();  
            $table->string('estado', 45);  
            $table->integer('becas_carrera_id')->unsigned();  
            $table->timestamps();  

            $table->foreign('becas_carrera_id')->references('id')->on('becas_carrera')->onDelete('no action')->onUpdate('no action');  
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('becas');
    }
};
