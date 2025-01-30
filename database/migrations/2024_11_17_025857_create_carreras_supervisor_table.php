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
        Schema::create('carreras_supervisor', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('supervisor_id')->unsigned();  
            $table->bigInteger('carreras_id')->unsigned();  
            $table->timestamps();  

            $table->foreign('supervisor_id')->references('id')->on('supervisores')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('carreras_id')->references('id')->on('carreras')->onDelete('no action')->onUpdate('no action');  
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreras_supervisor');
    }
};
