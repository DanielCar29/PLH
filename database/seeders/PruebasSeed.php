<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

class PruebasSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        // Creación de un usuario con rol administrador
        $usuarioAdmin = [
            'name' => 'Angel',
            'apellido_materno' => 'Lomeli',
            'apellido_paterno' => 'Sornia',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123456789),
            'role' => 'administrador'
        ];

        $usuario = User::create($usuarioAdmin);
        AdministradorGeneral::create(['usuario_id' => $usuario->id]);

        $cafeteria = [
            'name' => 'Cafeteria',
            'apellido_materno' => 'N/A',
            'apellido_paterno' => 'N/A',
            'email' => 'cafeteria@gmail.com',
            'password' => Hash::make(123456789),
            'role' => 'cafeteria'
        ];

        User::create($cafeteria);

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
    }
}
