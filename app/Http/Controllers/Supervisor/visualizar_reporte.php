<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\supervisor_visualiza_reporte;
// Incluir clase para enviar correos de no uso a alumno
use App\Mail\CorreoNoUsoMailable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class visualizar_reporte extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Encontrar la manera de hacer esto mismo pero sin el procedmiento almacenado y con modelos
        $alumnos = DB::table('alumnos')
            ->join('users', 'alumnos.usuario_id', '=', 'users.id')
            ->leftJoin('reportes', 'alumnos.id', '=', 'reportes.alumno_id')
            ->select(
                'alumnos.id', 
                'alumnos.numero_de_control', 
                'users.name', 
                'users.apellido_paterno', 
                'users.apellido_materno', 
                'users.email', // Se agrega el campo email
                DB::raw('MAX(reportes.fecha_uso_beca) AS ultima_vez_uso_beca')
            )
            ->groupBy(
                'alumnos.id', 
                'alumnos.numero_de_control', 
                'users.name', 
                'users.apellido_paterno', 
                'users.apellido_materno', 
                'users.email' // Asegúrate de agrupar por el campo email también
            )
            ->get();

        return view('supervisor.visualizar_reporte', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function verGrafica($id){

        $alumno = DB::table('alumnos')
            ->join('users', 'alumnos.usuario_id', '=', 'users.id')
            ->join('carreras_alumno', 'alumnos.id', '=', 'carreras_alumno.alumno_id')
            ->join('carreras', 'carreras_alumno.carreras_id', '=', 'carreras.id')
            ->select(
                'alumnos.id AS alumno_id', 
                'alumnos.numero_de_control AS Numero_de_control', 
                'users.name AS Nombre', 
                'users.apellido_paterno AS Apellido_Paterno', 
                'users.apellido_materno AS Apellido_Materno', 
                'carreras.carrera AS Carrera'
            )
            ->where('alumnos.id', $id)
            ->first();

        return view('supervisor.grafica', compact('alumno'));

    }

    public function correoNoUso($nombre,$apellidoPaterno,$apellidoMaterno,$email){

        Mail::to($email)->send(new CorreoNoUsoMailable($nombre,$apellidoPaterno,$apellidoMaterno));

        return redirect()->route('supervisor.visualizar_reporte')->with(['success' => 'Se ha enviado la notificación a: '.$nombre
                                                                    .' '.$apellidoPaterno.' '.$apellidoMaterno]);

    }

    public function generarPDF($id){

        $alumno = DB::table('alumnos')
            ->join('users', 'alumnos.usuario_id', '=', 'users.id')
            ->join('carreras_alumno', 'alumnos.id', '=', 'carreras_alumno.alumno_id')
            ->join('carreras', 'carreras_alumno.carreras_id', '=', 'carreras.id')
            ->select(
                'alumnos.id AS alumno_id', 
                'alumnos.numero_de_control AS numero_de_control', 
                'users.name AS nombre', 
                'users.apellido_paterno AS apellido_paterno', 
                'users.apellido_materno AS apellido_materno', 
                'carreras.carrera AS carrera',
            )
            ->where('alumnos.id', $id)
            ->first();

        $reportes = DB::table('reportes')
            ->where('alumno_id', $id)
            ->get();

        // Agrupar los reportes por mes
        $reportesPorMes = $reportes->groupBy(function($reporte) {
            return \Carbon\Carbon::parse($reporte->fecha_uso_beca)->format('F Y'); // Agrupar por mes y año
        });

        $pdf = PDF::loadView('/Supervisor/PDFIndividual', compact('alumno', 'reportesPorMes'));

        return $pdf->stream('reporte_'.$alumno->numero_de_control.'.pdf');

    }

    public function generarPDFGeneral(){

        //Código para generar PDF general
        $supervisorId = auth()->user()->id;

        $carrera = DB::table('carreras_supervisor')
            ->join('carreras', 'carreras_supervisor.carreras_id', '=', 'carreras.id')
            ->where('carreras_supervisor.supervisor_id', $supervisorId)
            ->select('carreras.carrera')
            ->first();

        $alumnos = DB::table('alumnos')
            ->join('users', 'alumnos.usuario_id', '=', 'users.id')
            ->join('carreras_alumno', 'alumnos.id', '=', 'carreras_alumno.alumno_id')
            ->join('carreras', 'carreras_alumno.carreras_id', '=', 'carreras.id')
            ->join('carreras_supervisor', 'carreras.id', '=', 'carreras_supervisor.carreras_id')
            ->join('reportes', 'alumnos.id', '=', 'reportes.alumno_id')
            ->select(
                'alumnos.id AS alumno_id', 
                'alumnos.numero_de_control AS numero_de_control', 
                'users.name AS nombre', 
                'users.apellido_paterno AS apellido_paterno', 
                'users.apellido_materno AS apellido_materno', 
                'carreras.carrera AS carrera',
                DB::raw('COUNT(reportes.id) AS veces_uso_beca')
            )
            ->where('carreras_supervisor.supervisor_id', $supervisorId)
            ->groupBy(
                'alumnos.id', 
                'alumnos.numero_de_control', 
                'users.name', 
                'users.apellido_paterno', 
                'users.apellido_materno', 
                'carreras.carrera'
            )
            ->get();

        $reportesPorMes = DB::table('reportes')
            ->select(
            'alumno_id',
            DB::raw('DATE_FORMAT(fecha_uso_beca, "%Y-%m") as mes'),
            DB::raw('COUNT(id) as veces_uso_beca')
            )
            ->groupBy('alumno_id', 'mes')
            ->get()
            ->groupBy('alumno_id');

        $pdf = PDF::loadView('/Supervisor/PDFGeneral', compact('alumnos', 'reportesPorMes', 'carrera'));

        return $pdf->stream('reporte_general.pdf');
    }

    public function bloquearBeca($id){

        //Código para bloquear beca
        echo "Beca bloqueada: ".$id;

    }

    public function desbloquearBeca($id){

        //Código para desbloquear beca
        echo "Beca desbloqueada: ".$id;

    }
}
