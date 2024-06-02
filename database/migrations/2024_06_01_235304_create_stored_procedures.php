<?php

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

        // Creación de procedimientos almacenados:

        $procedimiento_visualizar_solicitudes = "
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
        ";

        DB::unprepared($procedimiento_visualizar_solicitudes);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        if (DB::statement("SHOW PROCEDURE STATUS WHERE Name = 'obtenerAlumnos_visualizarSolicitudes'")) {
            DB::unprepared("DROP PROCEDURE obtenerAlumnos_visualizarSolicitudes;");
        }
    }

    
};
