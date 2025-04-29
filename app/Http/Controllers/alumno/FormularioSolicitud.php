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
        $alumnoId = Auth::user()->alumno->id;
        $solicitudBeca = AlumnoSolicitudBeca::where('alumno_id', $alumnoId)
            ->where('envio', 0)  // Solo mostrar las solicitudes no enviadas
            ->orderBy('created_at', 'desc')
            ->first();
    
        $respuestas = collect(); // por defecto respuestas vacías
    
        if ($solicitudBeca && $solicitudBeca->solicitudDeBeca && $solicitudBeca->solicitudDeBeca->respuestasSolicitud) {
            $respuestas = $solicitudBeca->solicitudDeBeca->respuestasSolicitud->pluck('respuesta', 'preguntas_id');
        }
    
        return view('alumno.preguntas', compact('respuestas'));
    }
    public function enviarFormulario(Request $request)
    {
        // Validar campos de texto
        $request->validate([
            'respuesta_14' => 'required|string|max:1000',
            'other_reason' => 'nullable|string|max:500',
            'other_health_reason' => 'nullable|string|max:500',
        ]);

        $alumnoId = Auth::user()->alumno->id;
        $estado = 'pendiente';
        $fechaSolicitud = now(); 

        // Respuestas del formulario, incluida la pregunta opcional
        $idsPreguntas = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];

        $respuestas = collect($request->only([
            'respuesta_1',
            'respuesta_2',
            'respuesta_3', // Pregunta opcional
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

        // Buscar la última solicitud del alumno, solo si no está enviada
        $solicitudBeca = AlumnoSolicitudBeca::where('alumno_id', $alumnoId)
                                             ->where('envio', 0)
                                             ->orderBy('created_at', 'desc')
                                             ->first();
        
        if (!$solicitudBeca) {
            // Si no existe una solicitud pendiente, creamos una nueva
            $solicitud = SolicitudDeBeca::create(['fecha_solicitud' => $fechaSolicitud]);
            $solicitudBeca = AlumnoSolicitudBeca::create([
                'solicitud_de_beca_id' => $solicitud->id,
                'alumno_id' => $alumnoId,
                'estado' => $estado,
                'envio' => 0
            ]);
        } else {
            // Si ya existe una solicitud pendiente, actualizamos la fecha de solicitud
            $solicitudBeca->solicitudDeBeca->update(['fecha_solicitud' => $fechaSolicitud]);
        }

        $carreraAlumno = CarrerasAlumno::where('alumno_id', $alumnoId)->first();
        $supervisor = CarrerasSupervisor::where('carreras_id', $carreraAlumno->carreras_id)->first();

        // Validar si existe un supervisor para la carrera
        if (!$supervisor) {
            return redirect()->route('alumno.solicitud')->with('error', 'No se encontró un supervisor para tu carrera.');
        }

        // Guardar respuestas en el historial
        foreach ($idsPreguntas as $idPregunta) {
            $respuesta = $respuestas->get('respuesta_' . $idPregunta, null);

            // Si la pregunta 3 es opcional y no tiene respuesta, la ignoramos
            if ($idPregunta == 3 && empty($respuesta)) {
                continue;
            }

            // Validar que la respuesta 14 (última pregunta) no esté vacía
            if ($idPregunta == 14 && empty($respuesta)) {
                return redirect()->route('alumno.solicitud')->with('error', 'La última pregunta es obligatoria.');
            }

            $respuestaAlumno = RespuestaAlumno::create([
                'preguntas_id' => $idPregunta,
                'supervisor_id' => $supervisor->supervisor_id,
                'respuesta' => $respuesta
            ]);

            RespuestaSolicitud::create([
                'solicitud_de_beca_id' => $solicitudBeca->solicitud_de_beca_id,
                'respuestas_alumno_id' => $respuestaAlumno->id
            ]);
        }

        return redirect()->route('alumno.solicitud')->with('success', 'Se envió el formulario.');
    }
}
