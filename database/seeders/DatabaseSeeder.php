<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AdministradorGeneral;
use App\Models\AlumnoBeca;
use App\Models\AlumnoSolicitudBeca;
use App\Models\Alumno;
use App\Models\BecasCarrera;
use App\Models\Beca;
use App\Models\CarrerasAlumno;
use App\Models\CarrerasSupervisor;
use App\Models\Carrera;
use App\Models\DetallesBeca;
use App\Models\PreguntaDeSolicitudDelAlumno;
use App\Models\Reporte;
use App\Models\RespuestasAlumno;
use App\Models\SolicitudDeBeca;
use App\Models\SupervisorVisualizaReporte;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\ListaSolicitud;
use App\Models\RespuestaAlumno; // Añadir esta línea
use App\Models\RespuestaSolicitud; // Añadir esta línea

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Creación de carreras:
        $carreras = [
            'Ing. Informatica',
            'Ing. en Sistemas Computacionales',
            'Ing. en Sistemas Automotrices',
            'Ing. Ambiental',
            'Ing. Industrial',
            'Ing. en Gestión Empresarial',
            'Ing. Electromecánica',
            'Ing. Electrónica'
        ];

        foreach ($carreras as $nombreCarrera) {
            Carrera::create(['carrera' => $nombreCarrera]);
        }

        // Creación de usuarios y sus roles
        $usuarios = [
            [
                'name' => 'Lorena',
                'apellido_materno' => 'Chacon',
                'apellido_paterno' => 'Rodriguez',
                'email' => 'supervisor@gmail.com',
                'password' => Hash::make(123456789),
                'role' => 'supervisor'
            ],
            [
                'name' => 'Jose',
                'apellido_materno' => 'Vazquez',
                'apellido_paterno' => 'Sandoval',
                'email' => 'alumno1@gmail.com',
                'password' => Hash::make(123456789),
                'role' => 'alumno'
            ],
            [
                'name' => 'Pedro',
                'apellido_materno' => 'Buendia',
                'apellido_paterno' => 'Avalos',
                'email' => 'alumno2@gmail.com',
                'password' => Hash::make(123456789),
                'role' => 'alumno'
            ],
            [
                'name' => 'Daniel',
                'apellido_materno' => 'Caballero',
                'apellido_paterno' => 'Cardenas',
                'email' => 'alumno3@gmail.com',
                'password' => Hash::make(123456789),
                'role' => 'alumno'
            ],
            [
                'name' => 'Angel',
                'apellido_materno' => 'Lomeli',
                'apellido_paterno' => 'Sornia',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(123456789),
                'role' => 'administrador'
            ],
            [
                'name' => 'Cafeteria',
                'apellido_materno' => 'N/A',
                'apellido_paterno' => 'N/A',
                'email' => 'cafeteria@gmail.com',
                'password' => Hash::make(123456789),
                'role' => 'cafeteria'
            ]
        ];

        foreach ($usuarios as $usuarioData) {
            $usuario = User::create($usuarioData);

            if ($usuario->role == 'supervisor') {
                $supervisor = Supervisor::create(['usuario_id' => $usuario->id]);
                CarrerasSupervisor::create(['supervisor_id' => $supervisor->id, 'carreras_id' => 1]);
            } elseif ($usuario->role == 'alumno') {
                $alumno = Alumno::create(['usuario_id' => $usuario->id, 'numero_de_control' => fake()->randomNumber(9), 'semestre' => 6]);
                Reporte::create(['fecha_uso_beca' => fake()->date(), 'alumno_id' => $alumno->id]);
                CarrerasAlumno::create(['carreras_id' => 1, 'alumno_id' => $alumno->id]);
            } elseif ($usuario->role == 'administrador') {
                AdministradorGeneral::create(['usuario_id' => $usuario->id]);
            }
        }

        // Registro en tabla detalles becas
        $detalles_beca = DetallesBeca::create([
            'administrador_general_id' => 1,
            'estado_convocatoria' => 'activa',
            'inicio_convocatoria' => fake()->date(),
            'fin_convocatoria' => fake()->date(),
            'inicio_uso_beca' => fake()->date(), // Añadir este campo
            'fin_uso_beca' => fake()->date() // Añadir este campo
        ]);

        // Registro en tabla becas carrera
        BecasCarrera::create([
            'carreras_id' => 1,
            'detalles_beca_id' => $detalles_beca->id,
            'cantidad_de_becas' => 10,
            'limite_solicitudes' => 5 // Añadir este campo
        ]);


        // Registros en tabla de solicitudes de beca
        for ($i = 1; $i <= 3; $i++) {
            SolicitudDeBeca::create(['fecha_solicitud' => fake()->date()]);
        }

        // Registros en tabla de alumno solicitud beca
        for ($i = 1; $i <= 3; $i++) {
            AlumnoSolicitudBeca::create([
                'solicitud_de_beca_id' => $i,
                'alumno_id' => $i,
                'envio' => 0
            ]);
        }

        // Registros en tabla de preguntas de solicitud del alumno
        $preguntas = [
            "1. La beca Alimenticia que solicitas es:",
            "2. Cuentas actualmente con otra beca en el Tec:",
            "En caso de que sí, ¿con qué becas cuentas actualmente?",
            "3. ¿Vives con tu familia?",
            "4. ¿Trabajas Actualmente?",
            "5. ¿Cuántas personas dependen del ingreso económico de los miembros de tu hogar para cubrir gastos de alimento (incluyéndote)?",
            "6. ¿Cuál es el ingreso económico mensual?",
            "7. ¿Quién es la persona responsable de cubrir tus gastos escolares (colegiaturas)?",
            "8. La vivienda donde vive tu familia es:",
            "9. ¿Con qué servicio de salud cuentan tú y tu familia?",
            "10. ¿Qué medio de transporte utilizas para ir a la escuela?",
            "11. ¿Cuánto tiempo tardas en trasladarte de tu casa a la escuela?",
            "12. ¿Cuánto tiempo duras en la escuela?",
            "13. Describe las causas de por qué solicitas la beca:"
        ];

        foreach ($preguntas as $pregunta) {
            PreguntaDeSolicitudDelAlumno::create(['pregunta' => $pregunta]);
        }

        // Registros en tabla de respuestas de alumno
        $respuestas = [
            "Respuesta 1",
            "Respuesta 2",
            "Respuesta 3",
            "Respuesta 4",
            "Respuesta 5",
            "Respuesta 6",
            "Respuesta 7",
            "Respuesta 8",
            "Respuesta 9",
            "Respuesta 10",
            "Respuesta 11",
            "Respuesta 12",
            "Respuesta 13"
        ];

        for ($i = 1; $i <= 3; $i++) {
            foreach ($respuestas as $index => $respuesta) {
                $respuestaAlumno = RespuestaAlumno::create([
                    'preguntas_id' => $index + 1,
                    'supervisor_id' => 1, // Asignar el ID del supervisor
                    'respuesta' => $respuesta
                ]);

                RespuestaSolicitud::create([
                    'solicitud_de_beca_id' => $i,
                    'respuestas_alumno_id' => $respuestaAlumno->id
                ]);
            }
        }
    }
}
