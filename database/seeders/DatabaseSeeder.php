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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
   // \App\Models\User::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // // Crear administradores generales
        // administradores_general::factory()->count(1)->create();

        // // Crear alumnos
        // alumnos::factory()->count(5)->create();

        // // Crear supervisores
        // supervisores::factory()->count(5)->create();

        // Creación de carreras:

        $carrera1 = new Carrera;
        $carrera1->carrera = 'ing. informatica';
        $carrera1->save();

        $carrera2 = new Carrera;
        $carrera2->carrera = 'ing. Sistemas Computacionales';
        $carrera2->save();

        $carrera3 = new Carrera;
        $carrera3->carrera = 'ing. Sistemas Automotrices';
        $carrera3->save();

        $carrera4 = new Carrera;
        $carrera4->carrera = 'Ing. ambiental';
        $carrera4->save();

        $carrera5 = new Carrera;
        $carrera5->carrera = 'ing. electromecanica';
        $carrera5->save();

        $carrera6 = new Carrera;
        $carrera6->carrera = 'ing electronica';
        $carrera6->save();

        $carrera7 = new Carrera;
        $carrera7->carrera = 'ing industrial';
        $carrera7->save();

        // Creación de 5 Usuarios --------------------------------------------------------------------------------------------------------------
        // Usuario de supervisor y todo en relación a supervisor
        // ID = 1
        $usuario1 = new User;
        $usuario1->name = 'Lorena';
        $usuario1->apellido_materno = 'Chacon';
        $usuario1->apellido_paterno = 'Rodriguez';
        $usuario1->email = 'supervisor@gmail.com';
        $usuario1->password = hash::make(123456789);
        $usuario1->role = 'supervisor';
        $usuario1->save();
        // registro tabla supervisor
        $supervisor = new Supervisor;
        $supervisor->usuario_id = 1;
        $supervisor->save();
        // registro tabla intermedia carreras_supervisor
        $carrera_supervisor = new CarrerasSupervisor();
        $carrera_supervisor->supervisor_id = 1;
        $carrera_supervisor->carreras_id = 1;
        $carrera_supervisor->save();
        
        // -------------------------------------------------------------------------------------------------------------------------------

        // ID = 2
        $usuario2 = new User;
        $usuario2->name = 'Jose';
        $usuario2->apellido_materno = 'Vazquez';
        $usuario2->apellido_paterno = 'Sandoval';
        $usuario2->email = 'alumno1@gmail.com';
        $usuario2->password = hash::make(123456789);
        $usuario2->role = 'alumno';
        $usuario2->save();
        // Registro en tabla alumnos
        // ID = 1 registro en tabla alumno
        $alumno1 = new Alumno;
        $alumno1->usuario_id = 2;
        $alumno1->numero_de_control = 212310023;
        $alumno1->semestre = 6;
        $alumno1->save();
        // Registro en tabla reporte
        $reporte1 = new Reporte;
        $reporte1->fecha_uso_beca = fake()->date();
        $reporte1->alumno_id = 1;
        $reporte1->save();

        // ID = 3
        $usuario3 = new User;
        $usuario3->name = 'Pedro';
        $usuario3->apellido_materno = 'Buendia';
        $usuario3->apellido_paterno = 'Avalos';
        $usuario3->email = 'alumno2@gmail.com';
        $usuario3->password = hash::make(123456789);
        $usuario3->role = 'alumno';
        $usuario3->save();
        // ID = 1 registro en tabla alumno
        $alumno2 = new Alumno;
        $alumno2->usuario_id = 3;
        $alumno2->numero_de_control = 212310078;
        $alumno2->semestre = 6;
        $alumno2->save();
        // ID = 2 Registro en tabla reporte
        $reporte2 = new Reporte;
        $reporte2->fecha_uso_beca = fake()->date();
        $reporte2->alumno_id = 2;
        $reporte2->save();

        // ID = 4
        $usuario4 = new User;
        $usuario4->name = 'Daniel';
        $usuario4->apellido_materno = 'Caballero';
        $usuario4->apellido_paterno = 'Cardenas';
        $usuario4->email = 'alumno3@gmail.com';
        $usuario4->password = hash::make(123456789);
        $usuario4->role = 'alumno';
        $usuario4->save();
        // ID = 3
        $alumno3 = new Alumno;
        $alumno3->usuario_id = 4;
        $alumno3->numero_de_control = 212310977;
        $alumno3->semestre = 6;
        $alumno3->save();
        // ID = 2 Registro en tabla reporte
        $reporte2 = new Reporte;
        $reporte2->fecha_uso_beca = fake()->date();
        $reporte2->alumno_id = 2;
        $reporte2->save();

        // ID = 5
        $usuario5 = new User;
        $usuario5->name = 'Angel';
        $usuario5->apellido_materno = 'Lomeli';
        $usuario5->apellido_paterno = 'Sornia';
        $usuario5->email = 'admin@gmail.com';
        $usuario5->password = hash::make(123456789);
        $usuario5->role = 'administrador';
        $usuario5->save();
        $admin = new AdministradorGeneral();
        $admin->usuario_id = 5;
        $admin->save();

        //------------------------------------------------------------------------------------------------------------------------------
        // registro en tabla detalles becas
        // ID = 1
        $detalles_beca = new DetallesBeca();
        $detalles_beca->cantidad_de_becas = 10;
        $detalles_beca->carrera_id = 1;
        $detalles_beca->administrador_general_id = 1;
        $detalles_beca->estado_convocatoria = 'activo';
        $detalles_beca->inicio_convocatoria =fake()->date();
        $detalles_beca->fin_convocatoria = fake()->date();
        $detalles_beca->save();

        // Registro en tabla becas carrera
        // ID = 1
        $becas_carrera = new BecasCarrera();
        $becas_carrera->carreras_id = 1;
        $becas_carrera->detalles_beca_id = 1;
        $becas_carrera->save();
        
        // Registro en tabla beca
        // ID = 1
        $beca1 = new Beca;
        $beca1->fecha_de_autorizacion = fake()->date();
        $beca1->codigo_qr = '82hfieh98f';
        $beca1->estado = 'activo';
        $beca1->becas_carrera_id = 1;
        $beca1->save();
        // ID = 2
        $beca2 = new Beca;
        $beca2->fecha_de_autorizacion = fake()->date();
        $beca2->codigo_qr = 'sdfsdfsdfer234';
        $beca2->estado = 'activo';
        $beca2->becas_carrera_id = 1;
        $beca2->save();
        // ID = 3
        $beca3 = new Beca;
        $beca3->fecha_de_autorizacion = fake()->date();
        $beca3->codigo_qr = '324534534erert';
        $beca3->estado = 'activo';
        $beca3->becas_carrera_id = 1;
        $beca3->save();

        // Registros en tabla de alumnos beca
        // ID = 1
        $alumno_beca1 = new AlumnoBeca();
        $alumno_beca1->alumno_id = 1;
        $alumno_beca1->beca_id = 1;
        $alumno_beca1->save();
        // ID = 2
        $alumno_beca2 = new AlumnoBeca();
        $alumno_beca2->alumno_id = 2;
        $alumno_beca2->beca_id = 2;
        $alumno_beca2->save();
        // ID = 3
        $alumno_beca3 = new AlumnoBeca();
        $alumno_beca3->alumno_id = 3;
        $alumno_beca3->beca_id = 3;
        $alumno_beca3->save();

        // Registros en tabla de solicitudes de beca
        // ID = 1
        $solicitud_de_beca1 = new SolicitudDeBeca();
        $solicitud_de_beca1->fecha_solicitud = fake()->date();
        $solicitud_de_beca1->save();
        // ID = 2
        $solicitud_de_beca2 = new SolicitudDeBeca;
        $solicitud_de_beca2->fecha_solicitud = fake()->date();
        $solicitud_de_beca2->save();
        // ID = 3
        $solicitud_de_beca3 = new SolicitudDeBeca;
        $solicitud_de_beca3->fecha_solicitud = fake()->date();
        $solicitud_de_beca3->save();

        // Registros en tabla de alumno solicitud beca
        // ID = 1
        $alumno_solicitudbeca1 = new AlumnoSolicitudBeca();
        $alumno_solicitudbeca1->solicitud_de_beca_id = 1;
        $alumno_solicitudbeca1->alumno_id = 1;
        $alumno_solicitudbeca1->estado = "aceptada";
        $alumno_solicitudbeca1->envio = 0;
        $alumno_solicitudbeca1->save();
        // ID = 2
        $alumno_solicitudbeca2 = new AlumnoSolicitudBeca;
        $alumno_solicitudbeca2->solicitud_de_beca_id = 2;
        $alumno_solicitudbeca2->alumno_id = 2;
        $alumno_solicitudbeca2->estado = "rechazada";
        $alumno_solicitudbeca2->envio = 0;
        $alumno_solicitudbeca2->save();
        // ID = 3
        $alumno_solicitudbeca3 = new AlumnoSolicitudBeca;
        $alumno_solicitudbeca3->solicitud_de_beca_id = 3;
        $alumno_solicitudbeca3->alumno_id = 3;
        $alumno_solicitudbeca3->envio = 0;
        $alumno_solicitudbeca3->save();
        // Registros en tabla de carreras alumno
        // ID = 1
        $carreras_alumno1 = new CarrerasAlumno();
        $carreras_alumno1->carreras_id = 1;
        $carreras_alumno1->alumno_id = 1;
        $carreras_alumno1->save();
        // ID = 2
        $carreras_alumno2 = new CarrerasAlumno;
        $carreras_alumno2->carreras_id = 1;
        $carreras_alumno2->alumno_id = 2;
        $carreras_alumno2->save();
        // ID = 3
        $carreras_alumno3 = new CarrerasAlumno;
        $carreras_alumno3->carreras_id = 1;
        $carreras_alumno3->alumno_id = 3;
        $carreras_alumno3->save();

            // ID = 1
            $pregunta1 = new PreguntaDeSolicitudDelAlumno();
            $pregunta1->pregunta = "1. La beca Alimenticia que solicitas es:";
            $pregunta1->save();

            // ID = 2
            $pregunta2 = new PreguntaDeSolicitudDelAlumno;
            $pregunta2->pregunta = "2. Cuentas actualmente con otra beca en el Tec:";
            $pregunta2->save();
            // ID = 3

            $pregunta2 = new PreguntaDeSolicitudDelAlumno;
            $pregunta2->pregunta = "En caso de que sí, ¿con qué becas cuentas actualmente?";
            $pregunta2->save();
            // ID = 4
            $pregunta3 = new PreguntaDeSolicitudDelAlumno;
            $pregunta3->pregunta = "3. ¿Vives con tu familia?";
            $pregunta3->save();

            $pregunta3 = new PreguntaDeSolicitudDelAlumno;
            $pregunta3->pregunta = "4. ¿Trabajas Actualmente?";
            $pregunta3->save();

            // ID = 5
            $pregunta4 = new PreguntaDeSolicitudDelAlumno;
            $pregunta4->pregunta = "5. ¿Cuántas personas dependen del ingreso económico de los miembros de tu hogar para cubrir gastos de alimento (incluyéndote)?";
            $pregunta4->save();

            // ID = 6
            $pregunta5 = new PreguntaDeSolicitudDelAlumno;
            $pregunta5->pregunta = "6. ¿Cuál es el ingreso económico mensual?";
            $pregunta5->save();

            // ID = 7
            $pregunta6 = new PreguntaDeSolicitudDelAlumno;
            $pregunta6->pregunta = "7. ¿Quién es la persona responsable de cubrir tus gastos escolares (colegiaturas)?";
            $pregunta6->save();

            // ID = 8
            $pregunta7 = new PreguntaDeSolicitudDelAlumno;
            $pregunta7->pregunta = "8. La vivienda donde vive tu familia es:";
            $pregunta7->save();

            // ID = 9
            $pregunta8 = new PreguntaDeSolicitudDelAlumno;
            $pregunta8->pregunta = "9. ¿Con qué servicio de salud cuentan tú y tu familia?";
            $pregunta8->save();

            // ID = 10
            $pregunta9 = new PreguntaDeSolicitudDelAlumno;
            $pregunta9->pregunta = "10. ¿Qué medio de transporte utilizas para ir a la escuela?";
            $pregunta9->save();

            // ID = 11
            $pregunta10 = new PreguntaDeSolicitudDelAlumno;
            $pregunta10->pregunta = "11. ¿Cuánto tiempo tardas en trasladarte de tu casa a la escuela?";
            $pregunta10->save();

            // ID = 12
            $pregunta11 = new PreguntaDeSolicitudDelAlumno;
            $pregunta11->pregunta = "12. ¿Cuánto tiempo duras en la escuela?";
            $pregunta11->save();

            // ID = 13
            $pregunta12 = new PreguntaDeSolicitudDelAlumno;
            $pregunta12->pregunta = "13. Describe las causas de por qué solicitas la beca:";
            $pregunta12->save();


        
    }
}
