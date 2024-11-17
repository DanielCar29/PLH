<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class listaSolicitudes extends Controller
{
    public function index(){

        $alumnos = DB::select('CALL mostrarDatosListasSolicitud()');

        return view('administrador.listaSolicitudes', compact('alumnos'));

    }

    public function verSolicitudAlumno($id){

        $alumno = DB::select('CALL obtenerDatosAlumno(?)',[$id]);

        $preguntas_alumno = DB::select('CALL obtenerAlumnoRespuestas(?)',[$id]);

        return view('administrador.verSolicitudAlumno', compact('alumno','preguntas_alumno'));

    }

    public function aceptarSolicitud($id){

        $estado = 'aceptada';

        DB::select('CALL cambiarEstadoSolicitudAlumno(?,?)',[$estado,$id]);

        $alumnos = DB::select('CALL mostrarDatosListasSolicitud()');

        return view('administrador.listaSolicitudes', compact('alumnos'));

    }

    public function rechazarSolicitud($id){

        $estado = 'rechazada';

        DB::select('CALL cambiarEstadoSolicitudAlumno(?,?)',[$estado,$id]);

        $alumnos = DB::select('CALL mostrarDatosListasSolicitud()');

        return view('administrador.listaSolicitudes', compact('alumnos'));

    }

    public function esperaSolicitud($id){

        $estado = 'pendiente';

        DB::select('CALL cambiarEstadoSolicitudAlumno(?,?)',[$estado,$id]);
        
        $alumnos = DB::select('CALL mostrarDatosListasSolicitud()');

        return view('administrador.listaSolicitudes', compact('alumnos'));

    }
}
