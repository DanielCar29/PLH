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

        // Eliminar el procedimiento si ya existe
        DB::statement('DROP PROCEDURE IF EXISTS obtenerAlumnos_visualizarSolicitudes');
        DB::statement('DROP PROCEDURE IF EXISTS obtenerDatosAlumno');
        DB::statement('DROP PROCEDURE IF EXISTS cambiarEstadoSolicitudAlumno');
        DB::statement('DROP PROCEDURE IF EXISTS obtenerDatosReporteAlumno');
        DB::statement('DROP PROCEDURE IF EXISTS obtenerDatosSupervisor');
        DB::statement('DROP PROCEDURE IF EXISTS ActualizarUsuarioSupervisor');


        // Crear el procedimiento
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

        DB::statement("
        CREATE PROCEDURE obtenerDatosAlumno (IN alumno_id INT)
            BEGIN
                SELECT 
                    alumnos.id AS alumno_id,
                    alumnos.numero_de_control AS Numero_de_control,
                    users.name AS Nombre,
                    users.apellido_paterno AS Apellido_Paterno,
                    users.apellido_materno AS Apellido_Materno,
                    carreras.carrera AS Carrera
                FROM 
                    alumnos
                JOIN 
                    users ON alumnos.usuario_id = users.id
                JOIN 
                    carreras_alumno ON alumnos.id = carreras_alumno.alumno_id
                JOIN 
                    carreras ON carreras_alumno.carreras_id = carreras.id
                WHERE 
                    alumnos.id = alumno_id;
            END
        ");

        DB::statement("
                CREATE PROCEDURE cambiarEstadoSolicitudAlumno(
                    IN estado_param VARCHAR(45),
                    IN alumno_id_param BIGINT
                )
                BEGIN
                    UPDATE alumno_solicitudbeca
                    SET estado = estado_param
                    WHERE alumno_id = alumno_id_param;
                END
        ");

        DB::statement("
            CREATE PROCEDURE obtenerDatosReporteAlumno()
                BEGIN
                    SELECT 
                        alumnos.id,
                        alumnos.numero_de_control,
                        users.name,
                        users.apellido_paterno,
                        users.apellido_materno,
                        MAX(reportes.fecha_uso_beca) AS ultima_vez_uso_beca
                    FROM 
                        alumnos
                    JOIN 
                        users ON alumnos.usuario_id = users.id
                    LEFT JOIN 
                        reportes ON alumnos.id = reportes.alumno_id
                    GROUP BY 
                        alumnos.id, alumnos.numero_de_control, users.name, users.apellido_paterno, users.apellido_materno;
                END
        ");

        DB::statement("
            CREATE PROCEDURE ObtenerDatosSupervisor (
                IN supervisor_id INT
            )
                BEGIN
                    SELECT 
                        u.name AS Nombre,
                        u.apellido_paterno AS ApellidoPaterno,
                        u.apellido_materno AS ApellidoMaterno,
                        u.email AS Correo,
                        u.password AS Contraseña,
                        c.carrera AS Carrera,
                        u.id AS ID
                    FROM 
                        users u
                    LEFT JOIN 
                        supervisores s ON u.id = s.usuario_id
                    LEFT JOIN 
                        carreras_supervisor cs ON s.id = cs.supervisor_id
                    LEFT JOIN 
                        carreras c ON cs.carreras_id = c.id
                    WHERE 
                        u.id = supervisor_id;
                END  
        ");

        DB::statement("
        CREATE PROCEDURE ActualizarUsuarioSupervisor(
            IN p_user_id INT,
            IN p_nombre VARCHAR(255),
            IN p_apellido_paterno VARCHAR(255),
            IN p_apellido_materno VARCHAR(255),
            IN p_correo VARCHAR(255),
            IN p_contraseña VARCHAR(255)
        )
                BEGIN
                    -- Inicializar la contraseña a NULL si no se proporciona
                    IF p_contraseña = '' THEN
                        SET p_contraseña = NULL;
                    END IF;

                    IF p_contraseña IS NOT NULL THEN
                        UPDATE users
                        SET
                            name = p_nombre,
                            apellido_paterno = p_apellido_paterno,
                            apellido_materno = p_apellido_materno,
                            email = p_correo,
                            password = p_contraseña
                        WHERE
                            id = p_user_id;
                    ELSE
                        UPDATE users
                        SET
                            name = p_nombre,
                            apellido_paterno = p_apellido_paterno,
                            apellido_materno = p_apellido_materno,
                            email = p_correo
                        WHERE
                            id = p_user_id;
                    END IF;
                END
        ");

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

      // Eliminar el procedimiento en la migración inversa
      DB::statement('DROP PROCEDURE IF EXISTS obtenerAlumnos_visualizarSolicitudes');
      DB::statement('DROP PROCEDURE IF EXISTS obtenerDatosAlumno');
      DB::statement('DROP PROCEDURE IF EXISTS cambiarEstadoSolicitudAlumno');
      DB::statement('DROP PROCEDURE IF EXISTS obtenerDatosReporteAlumno');
      DB::statement('DRPO PROCEDURE IF EXISTS obtenerDatosSupervisor');
      DB::statement('DROP PROCEDURE IF EXISTS ActualizarUsuarioSupervisor');
    }

    
};
