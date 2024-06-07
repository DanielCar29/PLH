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
        DB::statement('DROP PROCEDURE IF EXISTS ActualizarUsuario');
        DB::statement('DROP PROCEDURE IF EXISTS RegistrarSupervisor');
        DB::statement('DROP PROCEDURE IF EXISTS obtenerDatosAdmin');
        DB::statement('DROP PROCEDURE IF EXISTS actualizarAlumno');
        DB::statement('DROP PROCEDURE IF EXISTS obtenerDatosAlumno_perfil');
        DB::statement('DROP PROCEDURE IF EXISTS actualizar_e_insertar_solicitudes');
        DB::statement('DROP PROCEDURE IF EXISTS mostrarDatosAlumno_NOENVIO');
        DB::statement('DROP PROCEDURE IF EXISTS insertar_detalle_beca');
        DB::statement('DROP PROCEDURE IF EXISTS obtenerAlumnoRespuestas');
        DB::statement('DROP PROCEDURE IF EXISTS mostrarDatosListasSolicitud');






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
        CREATE PROCEDURE ActualizarUsuario(
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

        DB::statement("
            CREATE PROCEDURE RegistrarSupervisor(
                IN p_name VARCHAR(255),
                IN p_apellido_paterno VARCHAR(255),
                IN p_apellido_materno VARCHAR(255),
                IN p_email VARCHAR(255),
                IN p_password VARCHAR(255),
                IN p_carrera_id BIGINT
            )
            BEGIN
                DECLARE v_user_id BIGINT;
                DECLARE v_supervisor_id BIGINT;

                -- Insertar un nuevo usuario con el rol de supervisor
                INSERT INTO users (name, apellido_paterno, apellido_materno, email, password, role, created_at, updated_at)
                VALUES (p_name, p_apellido_paterno, p_apellido_materno, p_email, p_password, 'supervisor', NOW(), NOW());

                -- Obtener el ID del nuevo usuario
                SET v_user_id = LAST_INSERT_ID();

                -- Insertar un nuevo supervisor
                INSERT INTO supervisores (usuario_id, created_at, updated_at)
                VALUES (v_user_id, NOW(), NOW());

                -- Obtener el ID del nuevo supervisor
                SET v_supervisor_id = LAST_INSERT_ID();

                -- Asignar la carrera al supervisor
                INSERT INTO carreras_supervisor (supervisor_id, carreras_id, created_at, updated_at)
                VALUES (v_supervisor_id, p_carrera_id, NOW(), NOW());
            END
        ");

        DB::statement("
            CREATE PROCEDURE obtenerDatosAdmin(IN userid BIGINT)
            BEGIN
                SELECT * FROM users WHERE id = userid;
            END
        ");

        DB::statement("
        CREATE PROCEDURE actualizarAlumno(
            IN alumno_id BIGINT,
            IN nuevo_nombre VARCHAR(255),
            IN nuevo_apellido_paterno VARCHAR(255),
            IN nuevo_apellido_materno VARCHAR(255),
            IN nuevo_email VARCHAR(255),
            IN nuevo_password VARCHAR(255), -- Este campo es opcional
            IN nuevo_numero_de_control VARCHAR(9),
            IN nuevo_semestre VARCHAR(200)
        )
        BEGIN
            -- Actualizar la tabla users
            IF nuevo_password IS NOT NULL THEN
                UPDATE users
                SET name = nuevo_nombre,
                    apellido_paterno = nuevo_apellido_paterno,
                    apellido_materno = nuevo_apellido_materno,
                    email = nuevo_email,
                    password = nuevo_password
                WHERE id = (SELECT usuario_id FROM alumnos WHERE id = alumno_id);
            ELSE
                UPDATE users
                SET name = nuevo_nombre,
                    apellido_paterno = nuevo_apellido_paterno,
                    apellido_materno = nuevo_apellido_materno,
                    email = nuevo_email
                WHERE id = (SELECT usuario_id FROM alumnos WHERE id = alumno_id);
            END IF;
        
            -- Actualizar la tabla alumnos
            UPDATE alumnos
            SET numero_de_control = nuevo_numero_de_control,
                semestre = nuevo_semestre
            WHERE id = alumno_id;
        END
        
        ");

        DB::statement("
            CREATE PROCEDURE obtenerDatosAlumno_perfil(
                IN userId INT
        )
            BEGIN
            SELECT 
                u.id AS usuario_id,
                u.name AS nombre,
                u.apellido_paterno,
                u.apellido_materno,
                u.email,
                a.id AS alumno_id,
                a.numero_de_control,
                a.semestre,
                c.carrera
                FROM 
                    users AS u
                INNER JOIN 
                    alumnos AS a ON u.id = a.usuario_id
                INNER JOIN 
                    carreras_alumno AS ca ON a.id = ca.alumno_id
                INNER JOIN 
                    carreras AS c ON ca.carreras_id = c.id
                WHERE 
                    u.id = userId;
        END
        ");

        DB::statement("
            CREATE PROCEDURE actualizar_e_insertar_solicitudes()
                BEGIN
                    -- Desactivar el modo de actualización segura
                    SET @old_safe_updates = @@sql_safe_updates;
                    SET @@sql_safe_updates = 0;
                
                    -- Iniciar la transacción
                    START TRANSACTION;
                
                    -- Actualizar el campo envio a 1
                    UPDATE alumno_solicitudbeca
                    SET envio = 1;
                
                    -- Insertar registros en listas_solicitud para aquellos con estado = 'aceptada'
                    INSERT INTO listas_solicitud (carreras_id, solicitud_de_beca_id, created_at, updated_at)
                    SELECT ca.carreras_id, asb.solicitud_de_beca_id, NOW(), NOW()
                    FROM alumno_solicitudbeca asb
                    JOIN alumnos a ON asb.alumno_id = a.id
                    JOIN carreras_alumno ca ON a.id = ca.alumno_id
                    WHERE asb.estado = 'aceptada';
                
                    -- Confirmar la transacción
                    COMMIT;
                
                    -- Restaurar el modo de actualización segura
                    SET @@sql_safe_updates = @old_safe_updates;
                END
        ");

        DB::statement("
            CREATE PROCEDURE mostrarDatosAlumno_NOENVIO()
                BEGIN
                    SELECT 
                    a.id as alumno_id,
                    u.name,
                    u.apellido_paterno,
                    u.apellido_materno,
                    a.numero_de_control,
                    sb.fecha_solicitud AS fecha_solicitud,
                    asb.estado AS estado
                FROM 
                    alumno_solicitudbeca asb
                JOIN 
                    alumnos a ON asb.alumno_id = a.id
                JOIN 
                    users u ON a.usuario_id = u.id
                JOIN 
                    solicitudes_de_beca sb ON asb.solicitud_de_beca_id = sb.id
                WHERE 
                    asb.envio = 0;            
            END
        ");

        DB::statement("
        CREATE PROCEDURE insertar_detalle_beca(
            IN p_cantidad_de_becas INT,
            IN p_carrera_id BIGINT,
            IN p_administrador_general_id BIGINT,
            IN p_estado_convocatoria VARCHAR(45),
            IN p_inicio_convocatoria DATE,
            IN p_fin_convocatoria DATE
        )
            BEGIN
            INSERT INTO detalles_becas (
                cantidad_de_becas, 
                carrera_id, 
                administrador_general_id, 
                estado_convocatoria, 
                inicio_convocatoria, 
                fin_convocatoria,
                created_at,
                updated_at
            ) VALUES (
                p_cantidad_de_becas, 
                p_carrera_id, 
                p_administrador_general_id, 
                p_estado_convocatoria, 
                p_inicio_convocatoria, 
                p_fin_convocatoria,
                CURRENT_TIMESTAMP,
                CURRENT_TIMESTAMP
            );
        END
        ");

        DB::statement("
            CREATE PROCEDURE obtenerAlumnoRespuestas(IN alumnoID BIGINT)
                BEGIN
                    SELECT 
                        alumnos.id AS alumno_id,
                        alumnos.numero_de_control,
                        preguntas_de_solicitud_del_alumno.pregunta,
                        respuestas_alumno.respuesta
                    FROM 
                        respuestas_alumno
                    JOIN 
                        preguntas_de_solicitud_del_alumno ON respuestas_alumno.preguntas_id = preguntas_de_solicitud_del_alumno.id
                    JOIN 
                        respuestas_solicitud ON respuestas_alumno.id = respuestas_solicitud.respuestas_alumno_id
                    JOIN 
                        alumno_solicitudbeca ON respuestas_solicitud.solicitud_de_beca_id = alumno_solicitudbeca.solicitud_de_beca_id
                    JOIN 
                        alumnos ON alumno_solicitudbeca.alumno_id = alumnos.id
                    WHERE 
                        alumnos.id = alumnoID;
                END
        ");

        DB::statement("
        CREATE PROCEDURE mostrarDatosListasSolicitud()
            BEGIN
                SELECT 
                    u.name AS name,
                    a.id AS alumno_id,
                    u.apellido_paterno AS apellido_paterno,
                    u.apellido_materno AS apellido_materno,
                    a.numero_de_control AS numero_de_control,
                    asb.estado AS estado
                FROM 
                    listas_solicitud ls
                JOIN 
                    solicitudes_de_beca sb ON ls.solicitud_de_beca_id = sb.id
                JOIN 
                    alumno_solicitudbeca asb ON ls.solicitud_de_beca_id = asb.solicitud_de_beca_id
                JOIN 
                    alumnos a ON asb.alumno_id = a.id
                JOIN 
                    users u ON a.usuario_id = u.id;
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
      DB::statement('DROP PROCEDURE IF EXISTS RegistrarSupervisor');
      DB::statement('DROP PROCEDURE IF EXISTS obtenerDatosAdmin');
      DB::statement('DROP PROCEDURE IF EXISTS actualizarAlumno');
      DB::statement('DROP PROCEDURE IF EXISTS obtenerDatosAlumno_perfil');
      DB::statement('DROP PROCEDURE IF EXISTS actualizar_e_insertar_solicitudes');
      DB::statement('DROP PROCEDURE IF EXISTS mostrarDatosAlumno_NOENVIO');
      DB::statement('DROP PROCEDURE IF EXISTS insertar_detalle_beca');
      DB::statement('DROP PROCEDURE IF EXISTS obtenerAlumnoRespuestas');
      DB::statement('DROP PROCEDURE IF EXISTS mostrarDatosListasSolicitud');

        
      
    }

    
};
