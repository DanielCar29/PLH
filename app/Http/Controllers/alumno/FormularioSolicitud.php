<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    
        // Iterar sobre cada respuesta y llamar al procedimiento almacenado
        foreach ($idsPreguntas as $idPregunta) {
            // Obtener la respuesta para esta pregunta
            $respuesta = $respuestas->get('respuesta_' . $idPregunta, null);
    
            // Verificar si la respuesta es opcional y está vacía
            if ($idPregunta == 3 && empty($respuesta)) {
                continue; // Saltar la inserción si la respuesta es opcional y está vacía
            }
    
            // Llamar al procedimiento almacenado
            DB::statement('CALL InsertarRespuestaAlumno(?, ?, ?, ?, ?)', [
                $idPregunta, 
                $respuesta, 
                $alumnoId, 
                $estado, 
                $fechaSolicitud
            ]);
        }
    
        return redirect()->route('alumno.solicitud')->with('success', 'Se envió el formulario.');
    }
    
    
}
