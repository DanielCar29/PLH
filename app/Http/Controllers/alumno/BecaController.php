<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumno;
use App\Models\Beca;
use App\Models\DetallesBeca;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class BecaController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $alumno = $user->alumno;

        // Obtener la última beca activa del alumno
        $beca = $alumno->becas()->where('estado', 'activo')->latest()->first();

        $mostrarBotonPDF = false;

        if ($beca) {
            // Buscar las fechas directamente en la tabla detalles_beca
            $detallesBeca = DetallesBeca::where('estado_convocatoria', 'activa')->latest()->first();

            if ($detallesBeca) {
                $inicioUso = Carbon::parse($detallesBeca->inicio_uso_beca)->startOfDay();
                $finUso = Carbon::parse($detallesBeca->fin_uso_beca)->endOfDay();
                $hoy = Carbon::today();

                // Verificar si la fecha actual está dentro del rango
                if ($hoy->between($inicioUso, $finUso)) {
                    $mostrarBotonPDF = true;
                }
            }
        }

        return view('alumno.ver_beca', compact('beca', 'mostrarBotonPDF'));
    }

    public function generarPDF()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el alumno asociado al usuario
        $alumno = Alumno::where('usuario_id', $user->id)->first();

        // Obtener la última beca activa del alumno
        $beca = $alumno->becas()->where('estado', 'activo')->latest()->first();

        // Obtener el código QR de la beca desde la base de datos
        $codigoQR = $beca->codigo_qr;

        // Generar el código QR con el valor obtenido de la base de datos
        $qrCode = QrCode::size(300)->generate($codigoQR);

        // Codificar el código QR en base64
        $qrCodeBase64 = base64_encode($qrCode);

        // Configurar Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $pdf = new Dompdf($options);

        // Renderizar la vista en HTML
        $html = View::make('alumno.qrcode', compact('qrCodeBase64', 'alumno'))->render();

        // Construir el nombre del archivo usando el nombre del alumno
        $nombreArchivo = 'QR_' . $alumno->user->name . '_' . $alumno->user->apellido_paterno . '_' . $alumno->numero_de_control . '.pdf';

        // Cargar HTML en Dompdf y generar el PDF
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        // Devolver el PDF como una descarga con el nombre dinámico
        return $pdf->stream($nombreArchivo);
    }
}
