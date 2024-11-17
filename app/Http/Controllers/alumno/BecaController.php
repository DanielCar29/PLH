<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumno;
use App\Models\Beca;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class BecaController extends Controller
{
    public function show()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el alumno asociado al usuario
        $alumno = $user->alumno;

        // Obtener la beca del alumno
        $beca = $alumno->becas()->first();

        // Retornar la vista con los datos de la beca
        return view('alumno.ver_beca', compact('beca'));
    }

    public function generarPDF()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el alumno asociado al usuario
        $alumno = $user->alumno;

        // Obtener la beca del alumno
        $beca = $alumno->becas()->first();

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
        $html = View::make('alumno.qrcode', compact('qrCodeBase64'))->render();

        // Cargar HTML en Dompdf y generar el PDF
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        // Devolver el PDF como una descarga
        return $pdf->stream('codigo_qr.pdf');
    }
}
