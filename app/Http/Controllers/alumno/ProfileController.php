<?php
namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\alumnos;

class ProfileController extends Controller
{
    public function show()
    {

        $id_user = auth()->user()->id;

        $alumno = DB::select('CALL obtenerDatosAlumno_perfil(?)',[$id_user]);

        return view('alumno.perfil',compact('alumno'));

    }

    public function actualizarPerfil(Request $request,$id)
    {
        $id_alumno = $id;
        $nombre = $request->input('nombre');
        $apellido_paterno = $request->input('apellido_paterno');
        $apellido_materno = $request->input('apellido_materno');
        $correo = $request->input('correo');
        $numero_control = $request->input('numero_control');
        $semestre = $request->input('semestre');
        $carrera = $request->input('carrera');

        if(empty($request->input('pass'))){
            DB::select('CALL actualizarAlumno(?,?,?,?,?,?,?,?)', [
                $id_alumno,
                $nombre,
                $apellido_paterno,
                $apellido_materno,
                $correo,
                '',
                $numero_control,
                $semestre
            ]);
        } else {
            $pass = Hash::make($request->input('pass'));
            DB::select('CALL actualizarAlumno(?,?,?,?,?,?,?,?)', [
                $id_alumno,
                $nombre,
                $apellido_paterno,
                $apellido_materno,
                $correo,
                $pass,
                $numero_control,
                $semestre
            ]);
        }

        return redirect()->route('alumno.perfil')->with('success', 'Perfil actualizado exitosamente.');
    }
}
