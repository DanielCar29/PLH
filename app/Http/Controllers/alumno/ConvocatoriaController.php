<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\DetallesBeca;
use Illuminate\Support\Facades\DB;

class ConvocatoriaController extends Controller
{
    public function verificarConvocatoriaActiva()
    {
        $detallesBeca = DetallesBeca::where('estado_convocatoria', 'activa')
            ->where('inicio_convocatoria', '<=', now())
            ->where('fin_convocatoria', '>=', now())
            ->first();

        if (!$detallesBeca) {
            return response()->json(['activa' => false, 'error' => 'No hay convocatorias activas.']);
        }

        $alumnoId = auth()->user()->alumno->id;

        // Verificar si el alumno ya envió una solicitud en esta convocatoria
        $solicitudExistente = DB::table('detallesbeca_alumnosolicitud')
            ->join('alumno_solicitudbeca', 'detallesbeca_alumnosolicitud.alumno_solicitudbeca_id', '=', 'alumno_solicitudbeca.id')
            ->where('detallesbeca_alumnosolicitud.detalles_beca_id', $detallesBeca->id)
            ->where('alumno_solicitudbeca.alumno_id', $alumnoId)
            ->exists();

        return response()->json([
            'activa' => true,
            'inicio_convocatoria' => $detallesBeca->inicio_convocatoria,
            'fin_convocatoria' => $detallesBeca->fin_convocatoria,
            'puede_solicitar' => !$solicitudExistente, // Solo puede solicitar si no existe una solicitud
        ]);
    }

    public function debugConvocatoria()
    {
        $detallesBeca = DetallesBeca::first();

        if (!$detallesBeca) {
            return response()->json(['error' => 'No hay convocatorias registradas.']);
        }

        return response()->json([
            'estado_convocatoria' => $detallesBeca->estado_convocatoria,
            'inicio_convocatoria' => $detallesBeca->inicio_convocatoria,
            'fin_convocatoria' => $detallesBeca->fin_convocatoria,
            'is_activa' => $detallesBeca->isConvocatoriaActiva(),
            'is_finalizada' => $detallesBeca->isConvocatoriaFinalizada(),
        ]);
    }
}
