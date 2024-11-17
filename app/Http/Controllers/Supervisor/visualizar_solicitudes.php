<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\DB;

class visualizar_solicitudes extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = DB::select('CALL mostrarDatosAlumno_NOENVIO()');

        return view('supervisor.visualizar_solicitud', compact('alumnos'));
    }

    public function verSolicitudAlumno($id){

        $alumno = DB::select('CALL obtenerDatosAlumno(?)',[$id]);

        $preguntas_alumno = DB::select('CALL obtenerAlumnoRespuestas(?)',[$id]);

        return view('supervisor.ver_solicitud_alumno', compact('alumno','preguntas_alumno'));

    }

    public function aceptarSolicitud($id){

        $estado = 'aceptada';

        DB::select('CALL cambiarEstadoSolicitudAlumno(?,?)',[$estado,$id]);

        $alumnos = DB::select('CALL obtenerAlumnos_visualizarSolicitudes()');

        return view('supervisor.visualizar_solicitud', compact('alumnos'));

    }

    public function rechazarSolicitud($id){

        $estado = 'rechazada';

        DB::select('CALL cambiarEstadoSolicitudAlumno(?,?)',[$estado,$id]);

        $alumnos = DB::select('CALL obtenerAlumnos_visualizarSolicitudes()');

        return view('supervisor.visualizar_solicitud', compact('alumnos'));

    }

    public function esperaSolicitud($id){

        $estado = 'pendiente';

        DB::select('CALL cambiarEstadoSolicitudAlumno(?,?)',[$estado,$id]);
        
        $alumnos = DB::select('CALL obtenerAlumnos_visualizarSolicitudes()');

        return view('supervisor.visualizar_solicitud', compact('alumnos'));

    }

    public function enviarListaSolicitudes(){

        DB::select('CALL actualizar_e_insertar_solicitudes()');

        $alumnos = DB::select('CALL obtenerAlumnos_visualizarSolicitudes()');

        return redirect()->route('supervisor.visualizar_solicitud')->with(['success' => 'Se ha enviado la lista de solicitudes!']);

    }

}
