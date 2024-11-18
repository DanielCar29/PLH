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
        Schema::create('supervisor_visualiza_reporte', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('supervisor_id')->unsigned();  
            $table->bigInteger('reporte_id')->unsigned();  
            $table->timestamps();  

            $table->foreign('supervisor_id')->references('id')->on('supervisores')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('reporte_id')->references('id')->on('reportes')->onDelete('no action')->onUpdate('no action'); 

        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisor_visualiza_reporte');
    }
};
