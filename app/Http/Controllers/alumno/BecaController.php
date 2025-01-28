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

        // Verificar si la beca no está activa
        $mostrarBotonPDF = $beca && $beca->estado !== 'activo';

        // Retornar la vista con los datos de la beca y la variable para mostrar el botón
        return view('alumno.ver_beca', compact('beca', 'mostrarBotonPDF'));
    }

    public function generarPDF()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el alumno asociado al usuario
        $alumno = Alumno::where('usuario_id', $user->id)->first();

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
        $html = View::make('alumno.qrcode', compact('qrCodeBase64', 'alumno'))->render();

        // Cargar HTML en Dompdf y generar el PDF
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        // Devolver el PDF como una descarga
        return $pdf->stream('codigo_qr.pdf');
    }
}
