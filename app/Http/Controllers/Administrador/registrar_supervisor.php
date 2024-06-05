<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\carreras;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class registrar_supervisor extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carreras = carreras::all();

        return view('administrador.registrarSupervisor',compact('carreras'));
    }

    public function registrarSupervisor(Request $request){

        $nombre = $request->input('nombre');
        $apellido_paterno = $request->input('apellido_paterno');
        $apellido_materno = $request->input('apellido_materno');
        $correoPart1 = $request->input('correoPart1');
        $correoPart2 = $request->input('correoPart2');
        $carrera = $request->input('carrera');
        $passPart1 = $request->input('passPart1');
        $passPart2 = $request->input('passPart2');

        $password = hash::make($passPart1);
        $correo = $correoPart1.'@'.$correoPart2;

        if($passPart1 === $passPart2){
            DB::select('CALL RegistrarSupervisor(?,?,?,?,?,?)',[
                $nombre,
                $apellido_paterno,
                $apellido_materno,
                $correo,
                $password,
                $carrera
            ]);

            $carreras = carreras::all();

            return redirect()->back()->with([
                'success' => 'Se ha registradro el supervisor: '.$nombre.' '.$apellido_paterno.' '.$apellido_materno,
                'carreras' => $carreras,
            ]);

        }
        else{

            session()->flash('message', 'Algo salió mal. Intenta de nuevo');

            $carreras = carreras::all();

            return redirect()->back()->with([
                'error' => 'Ocurrió un error. Intenta de nuevo',
                'carreras' => $carreras,
            ]);

        }

        

    }

}
