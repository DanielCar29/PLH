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
        Schema::create('administradores_generales', function (Blueprint $table) { 
            $table->bigIncrements('id'); 
            $table->bigInteger('usuario_id')->unsigned(); 
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action'); 

        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administradores_generales');
    }
};
