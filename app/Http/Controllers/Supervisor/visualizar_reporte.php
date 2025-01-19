<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\supervisor_visualiza_reporte;
// Incluir clase para enviar correos de no uso a alumno
use App\Mail\CorreoNoUsoMailable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


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
}
