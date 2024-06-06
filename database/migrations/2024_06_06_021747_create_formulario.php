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
    
        DB::statement('DROP PROCEDURE IF EXISTS InsertarRespuestaAlumno');

        DB::statement('
        CREATE PROCEDURE InsertarRespuestaAlumno(
            IN pregunta_id_param INT,
            IN respuesta_param VARCHAR(200),
            IN alumno_id_param INT,
            IN estado_param VARCHAR(45),
            IN fecha_solicitud_param TIMESTAMP
        )
        BEGIN
            DECLARE supervisor_id_val INT;
            DECLARE respuesta_alumno_id_val BIGINT;
            DECLARE solicitud_beca_id_val BIGINT;

            -- Obtener el ID del supervisor (asumiendo que es 1)
            SET supervisor_id_val = 1;

            -- Insertar la solicitud de beca si no existe para ese alumno
            IF NOT EXISTS (
                SELECT 1 
                FROM alumno_solicitudbeca asb 
                JOIN solicitudes_de_beca sdb 
                ON asb.solicitud_de_beca_id = sdb.id 
                WHERE asb.alumno_id = alumno_id_param
            ) THEN
                -- Insertar la solicitud de beca
                INSERT INTO solicitudes_de_beca (fecha_solicitud, created_at, updated_at)
                VALUES (fecha_solicitud_param, NOW(), NOW());

                -- Obtener el ID de la solicitud de beca recién insertada
                SET solicitud_beca_id_val = LAST_INSERT_ID();
                
                -- Insertar en la tabla de alumno_solicitudbeca
                INSERT INTO alumno_solicitudbeca (solicitud_de_beca_id, alumno_id, estado, envio, created_at, updated_at)
                VALUES (solicitud_beca_id_val, alumno_id_param, estado_param, 0, NOW(), NOW());
            ELSE
                -- Obtener el ID de la solicitud de beca asociada al alumno
                SELECT asb.solicitud_de_beca_id 
                INTO solicitud_beca_id_val 
                FROM alumno_solicitudbeca asb 
                JOIN solicitudes_de_beca sdb 
                ON asb.solicitud_de_beca_id = sdb.id 
                WHERE asb.alumno_id = alumno_id_param 
                LIMIT 1;
            END IF;

            -- Insertar la respuesta del alumno y obtener su ID
            INSERT INTO respuestas_alumno (preguntas_id, supervisor_id, respuesta, created_at, updated_at)
            VALUES (pregunta_id_param, supervisor_id_val, respuesta_param, NOW(), NOW());

            SET respuesta_alumno_id_val = LAST_INSERT_ID();

            -- Insertar en la tabla de respuestas_solicitud
            INSERT INTO respuestas_solicitud (solicitud_de_beca_id, respuestas_alumno_id, created_at, updated_at)
            VALUES (solicitud_beca_id_val, respuesta_alumno_id_val, NOW(), NOW());
            
        END' );
            
    }

    /**
     * DB::statement('DROP PROCEDURE IF EXISTS InsertarRespuestaAlumno');
     */
    public function down(): void
    {
        
    }
};
