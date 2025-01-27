<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SolicitudDeBeca;
use App\Models\AlumnoSolicitudBeca;
use App\Models\RespuestaAlumno;
use App\Models\RespuestaSolicitud;
use App\Models\CarrerasAlumno;
use App\Models\CarrerasSupervisor;

class FormularioSolicitud extends Controller
{
    public function show()
    {
        return view('alumno.preguntas');
    }

    public function enviarFormulario(Request $request)
    {
        // Obtener el ID del alumno autenticado
        $alumnoId = Auth::user()->alumno->id;
        $estado = 'pendiente';
        $fechaSolicitud = now();  // Usamos el timestamp actual para fecha_solicitud

        // IDs de las preguntas definidos
        $idsPreguntas = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];

        // Obtener las respuestas del formulario
        $respuestas = collect($request->only([
            'respuesta_1',
            'respuesta_2',
            'respuesta_3', // Esta es opcional
            'respuesta_4',
            'respuesta_5',
            'respuesta_6',
            'respuesta_7',
            'respuesta_8',
            'respuesta_9',
            'respuesta_10',
            'respuesta_11',
            'respuesta_12',
            'respuesta_13',
            'respuesta_14'
        ]));

        // Verificar si ya existe una solicitud de beca para el alumno
        $solicitudBeca = AlumnoSolicitudBeca::where('alumno_id', $alumnoId)->first();
        if (!$solicitudBeca) {
            // Crear una nueva solicitud de beca
            $solicitud = SolicitudDeBeca::create(['fecha_solicitud' => $fechaSolicitud]);
            $solicitudBeca = AlumnoSolicitudBeca::create([
                'solicitud_de_beca_id' => $solicitud->id,
                'alumno_id' => $alumnoId,
                'estado' => $estado,
                'envio' => 0
            ]);
        } else {
            // Actualizar la fecha de solicitud si ya existe
            $solicitudBeca->solicitudDeBeca->update(['fecha_solicitud' => $fechaSolicitud]);
        }

        // Obtener la carrera del alumno
        $carreraAlumno = CarrerasAlumno::where('alumno_id', $alumnoId)->first();

        // Obtener un supervisor de la misma carrera
        $supervisor = CarrerasSupervisor::where('carreras_id', $carreraAlumno->carreras_id)->first();

        // Iterar sobre cada respuesta y guardarla en la base de datos
        foreach ($idsPreguntas as $idPregunta) {
            // Obtener la respuesta para esta pregunta
            $respuesta = $respuestas->get('respuesta_' . $idPregunta, null);

            // Verificar si la respuesta es opcional y está vacía
            if ($idPregunta == 3 && empty($respuesta)) {
                continue; // Saltar la inserción si la respuesta es opcional y está vacía
            }

            // Crear la respuesta del alumno
            $respuestaAlumno = RespuestaAlumno::create([
                'preguntas_id' => $idPregunta,
                'supervisor_id' => $supervisor->supervisor_id, // Asignar el ID del supervisor de la misma carrera
                'respuesta' => $respuesta
            ]);

            // Asociar la respuesta con la solicitud de beca
            RespuestaSolicitud::create([
                'solicitud_de_beca_id' => $solicitudBeca->solicitud_de_beca_id,
                'respuestas_alumno_id' => $respuestaAlumno->id
            ]);
        }

        return redirect()->route('alumno.solicitud')->with('success', 'Se envió el formulario.');
    }
}
