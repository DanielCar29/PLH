<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\DetallesBeca;

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

        return response()->json([
            'activa' => true,
            'inicio_convocatoria' => $detallesBeca->inicio_convocatoria,
            'fin_convocatoria' => $detallesBeca->fin_convocatoria,
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
