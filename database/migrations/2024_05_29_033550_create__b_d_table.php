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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero_de_control', 9)->unique();
            $table->string('semestre', 200);
            $table->bigInteger('usuario_id')->unsigned();
            $table->timestamps();
        
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        

 

        Schema::create('supervisores', function (Blueprint $table) { 

            $table->bigIncrements('id'); 
            $table->bigInteger('usuario_id')->unsigned(); 
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action'); 

        });  

        Schema::create('administradores_generales', function (Blueprint $table) { 
            $table->bigIncrements('id'); 
            $table->bigInteger('usuario_id')->unsigned(); 
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action'); 

        }); 


        Schema::create('reportes', function (Blueprint $table) { 
            $table->bigIncrements('id'); 
            $table->date('fecha_uso_beca')->unique(); 
            $table->bigInteger('alumno_id')->unsigned(); 
            $table->timestamps();

            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('no action')->onUpdate('no action'); 

        }); 

        Schema::create('solicitudes_de_beca', function (Blueprint $table) { 
            $table->bigIncrements('id'); 
            $table->date('fecha_solicitud')->unique(); 
            $table->timestamps(); 
        }); 

        Schema::create('carreras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('carrera'); // Cambiar 'integer' por 'string'
            $table->timestamps();
        });
        
        Schema::create('detalles_becas', function (Blueprint $table) {  
            $table->increments('id');  
            $table->integer('cantidad_de_beces');  
            $table->bigInteger('administrador_general_id')->unsigned();  
            $table->string('estado_combocatoria', 45);  
            $table->timestamps();  

            $table->foreign('administrador_general_id')->references('id')->on('administradores_generales')->onDelete('no action')->onUpdate('no action');  
        });  

        Schema::create('becas_carrera', function (Blueprint $table) {  
            $table->increments('id');  
            $table->bigInteger('carreras_id')->unsigned();  
            $table->integer('detalles_beca_id')->unsigned();  
            $table->timestamps();  

            $table->foreign('carreras_id')->references('id')->on('carreras')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('detalles_beca_id')->references('id')->on('detalles_becas')->onDelete('no action')->onUpdate('no action');  
        });  

 
        Schema::create('becas', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->date('fecha_de_autorizacion')->nullable();  
            $table->string('codigo_qr', 45)->unique();  
            $table->string('estado', 45);  
            $table->integer('becas_carrera_id')->unsigned();  
            $table->timestamps();  

            $table->foreign('becas_carrera_id')->references('id')->on('becas_carrera')->onDelete('no action')->onUpdate('no action');  
        });  

        Schema::create('alumno_solicitudbeca', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('solicitud_de_beca_id')->unsigned();  
            $table->bigInteger('alumno_id')->unsigned();  
            $table->string('estado', 45)->default('pendiente');
            $table->timestamps();  

            $table->foreign('solicitud_de_beca_id')->references('id')->on('solicitudes_de_beca')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('no action')->onUpdate('no action');  
        });  

        Schema::create('preguntas_de_solicitud_del_alumno', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('solicitud_de_beca_id')->unsigned();
            $table->string('pregunta', 200);  
            $table->timestamps();  
        });  

         Schema::create('respuestas_alumno', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('preguntas_id')->unsigned();    
            $table->bigInteger('supervisor_id')->unsigned();  
            $table->string('respuesta', 200);  
            $table->timestamps(); 
           
            $table->foreign('preguntas_id')->references('id')->on('preguntas_de_solicitud_del_alumno')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('supervisor_id')->references('id')->on('supervisores')->onDelete('no action')->onUpdate('no action');  
        });  

        Schema::create('respuestas_salicitud', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('solicitud_de_beca_id')->unsigned();
            $table->bigInteger('respuestas_alumno_id')->unsigned();
            $table->timestamps();
                        //
            $table->foreign('solicitud_de_beca_id')->references('id')->on('preguntas_de_solicitud_del_alumno')->onDelete('no action')->onUpdate('no action');
            $table->foreign('respuestas_alumno_id')->references('id')->on('respuestas_alumno')->onDelete('no action')->onUpdate('no action');
        });

        Schema::create('supervisor_visualiza_reporte', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('supervisor_id')->unsigned();  
            $table->bigInteger('reporte_id')->unsigned();  
            $table->timestamps();  

            $table->foreign('supervisor_id')->references('id')->on('supervisores')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('reporte_id')->references('id')->on('reportes')->onDelete('no action')->onUpdate('no action'); 

        });  


        Schema::create('alumno_beca', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('alumno_id')->unsigned();  
            $table->bigInteger('beca_id')->unsigned();   
            $table->timestamps();  

            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('beca_id')->references('id')->on('becas')->onDelete('no action')->onUpdate('no action');  
        });  

 
        Schema::create('carreras_supervisor', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('supervisor_id')->unsigned();  
            $table->bigInteger('carreras_id')->unsigned();  
            $table->timestamps();  

    
            $table->foreign('supervisor_id')->references('id')->on('supervisores')->onDelete('no action')->onUpdate('no action');  

            $table->foreign('carreras_id')->references('id')->on('carreras')->onDelete('no action')->onUpdate('no action');  

        });  

 
        Schema::create('carreras_alumno', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->bigInteger('carreras_id')->unsigned();  
            $table->bigInteger('alumno_id')->unsigned();  
            $table->timestamps();  

            $table->foreign('carreras_id')->references('id')->on('carreras')->onDelete('no action')->onUpdate('no action');  
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('no action')->onUpdate('no action');  

 

        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreras_alumno'); 

        Schema::dropIfExists('carreras_supervisor'); 

        Schema::dropIfExists('alumno_beca'); 

        Schema::dropIfExists('supervisor_visualiza_reporte'); 

        Schema::dropIfExists('respuestas_alumno'); 

        Schema::dropIfExists('respuestas_salicitud');

        Schema::dropIfExists('preguntas_de_solicitud_del_alumno'); 

        Schema::dropIfExists('alumno_solicitudbeca'); 

        Schema::dropIfExists('becas'); 

        Schema::dropIfExists('becas_carrera'); 

        Schema::dropIfExists('detalles_becas'); 

        Schema::dropIfExists('reportes'); 

        Schema::dropIfExists('solicitudes_de_beca'); 

        Schema::dropIfExists('carreras'); 

        Schema::dropIfExists('administradores_generales'); 

        Schema::dropIfExists('supervisores'); 

        Schema::dropIfExists('alumnos'); 
    }
};
