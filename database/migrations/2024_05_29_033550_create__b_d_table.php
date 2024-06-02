<?php

use App\Models\preguntas_de_solicitud_del_alumno;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string('pregunta', 300);  
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

        Schema::create('respuestas_solicitud', function (Blueprint $table) {
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
        // preguntas   

        // ID = 1
            $pregunta1 = new preguntas_de_solicitud_del_alumno;
            $pregunta1->pregunta = "1. La beca Alimenticia que solicitas es:";
            $pregunta1->save();

            // ID = 2
            $pregunta2 = new preguntas_de_solicitud_del_alumno;
            $pregunta2->pregunta = "2. Cuentas actualmente con otra beca en el Tec:)";
            $pregunta2->save();

            $pregunta2 = new preguntas_de_solicitud_del_alumno;
            $pregunta2->pregunta = "En caso de que si, ¿con qué becas cuentas actualmente?";
            $pregunta2->save();

            // ID = 3
            $pregunta3 = new preguntas_de_solicitud_del_alumno;
            $pregunta3->pregunta = "3. ¿Vives con tu familia?";
            $pregunta3->save();

            // ID = 4
            $pregunta4 = new preguntas_de_solicitud_del_alumno;
            $pregunta4->pregunta = "4. ¿Cuántas personas dependen del ingreso económico de los miembros de tu hogar para cubrir gastos de alimento (incluyéndote)?";
            $pregunta4->save();

            // ID = 5
            $pregunta5 = new preguntas_de_solicitud_del_alumno;
            $pregunta5->pregunta = "5. ¿Cuál es el ingreso económico mensual?";
            $pregunta5->save();

            // ID = 6
            $pregunta6 = new preguntas_de_solicitud_del_alumno;
            $pregunta6->pregunta = "6. ¿Quién es la persona responsable de cubrir tus gastos escolares (colegiaturas)?";
            $pregunta6->save();

            // ID = 7
            $pregunta7 = new preguntas_de_solicitud_del_alumno;
            $pregunta7->pregunta = "7. La vivienda donde vive tu familia es:";
            $pregunta7->save();

            // ID = 8
            $pregunta8 = new preguntas_de_solicitud_del_alumno;
            $pregunta8->pregunta = "8. ¿Con qué servicio de salud cuentan tú y tu familia?";
            $pregunta8->save();

            // ID = 9
            $pregunta9 = new preguntas_de_solicitud_del_alumno;
            $pregunta9->pregunta = "9. ¿Qué medio de transporte utilizas para ir a la escuela?";
            $pregunta9->save();

            // ID = 10
            $pregunta10 = new preguntas_de_solicitud_del_alumno;
            $pregunta10->pregunta = "10. ¿Cuánto tiempo tardas en trasladarte de tu casa a la escuela?";
            $pregunta10->save();

            // ID = 11
            $pregunta11 = new preguntas_de_solicitud_del_alumno;
            $pregunta11->pregunta = "11. ¿Cuánto tiempo duras en la escuela?";
            $pregunta11->save();

            // ID = 12
            $pregunta12 = new preguntas_de_solicitud_del_alumno;
            $pregunta12->pregunta = "12. Describe las causas de por qué solicitas la beca:";
            $pregunta12->save();


        // Creación de procedimientos almacenados:

        DB::statement('DROP PROCEDURE IF EXISTS obtenerAlumnos_visualizarSolicitudes');

        DB::statement('
            CREATE PROCEDURE obtenerAlumnos_visualizarSolicitudes()
            BEGIN
                SELECT
                    alumnos.id AS alumno_id,
                    alumnos.numero_de_control,
                    alumnos.semestre,
                    users.name,
                    users.apellido_paterno,
                    users.apellido_materno,
                    solicitudes_de_beca.fecha_solicitud,
                    alumno_solicitudbeca.estado
                FROM
                    alumnos
                JOIN
                    alumno_solicitudbeca ON alumnos.id = alumno_solicitudbeca.alumno_id
                JOIN
                    solicitudes_de_beca ON alumno_solicitudbeca.solicitud_de_beca_id = solicitudes_de_beca.id
                JOIN
                    users ON alumnos.usuario_id = users.id;
            END
        ');

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

        Schema::dropIfExists('respuestas_solicitud');

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

        $procedimiento_visualizar_solicitudes = "DROP PROCEDURE IF EXISTS obtenerAlumnos_visualizarSolicitudes;";

        DB::unprepared($procedimiento_visualizar_solicitudes);
    }
};
