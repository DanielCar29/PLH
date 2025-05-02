<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Beca;
use App\Models\Reporte;
use App\Models\AlumnoBeca;
use app\Models\SupervisorVisualizaReporte;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QrScannerController extends Controller
{
    public function showScanner()
    {
        return view('qrscanner');
    }

    public function registerUsage(Request $request)
    {
        $decodedText = $request->input('decodedText');
        $beca = Beca::where('codigo_qr', $decodedText)->first();

        if (!$beca) {
            return response()->json(['message' => 'Beca no encontrada.', 'debug' => $decodedText], 404);
        }

        // Verificar si la beca está activa
        if ($beca->estado !== 'activo') {
            return response()->json(['message' => 'Beca suspendida temporalmente', 'debug' => $decodedText], 400);
        }

        $alumnoBeca = AlumnoBeca::where('beca_id', $beca->id)->first();

        if (!$alumnoBeca) {
            return response()->json(['message' => 'Alumno no encontrado para esta beca.', 'debug' => $decodedText], 404);
        }

        $alumnoId = $alumnoBeca->alumno_id;

        // Verificar si el alumno ya usó la beca hoy
        $today = DB::raw('DATE(NOW())');
        
        $reporte = Reporte::where('alumno_id', $alumnoId)
                  ->whereDate('fecha_uso_beca', $today)
                  ->first();

        if ($reporte) {
            return response()->json(['message' => 'Este alumno ya canjeó su beca alimenticia por hoy.'], 400);
        }

        // Registrar el uso de la beca
        $reporte = Reporte::create([
            'fecha_uso_beca' => $today,
            'alumno_id' => $alumnoId,
        ]);

        return response()->json([
            'message' => 'Uso de beca registrado exitosamente.',
            'alumno' => Alumno::find($alumnoId)->load('user')
        ]);
    }
}
