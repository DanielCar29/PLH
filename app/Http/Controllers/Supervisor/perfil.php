<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class perfil extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_supervisor = auth()->user()->id;

        $datos_supervisor =DB::select('CALL ObtenerDatosSupervisor(?)',[$id_supervisor]);

        return view('supervisor.perfil', compact('datos_supervisor'));
    }

    public function actualizarPerfil(Request $request){

        // $request->validate([
        //     'nombre' => 'required|string|max:255',
        //     'pass' => 'min:8',
        // ]);

        $id_supervisor = auth()->user()->id;
        $nombre = $request->input('nombre');
        $apellidoPaterno = $request->input('apellidoPaterno');
        $apellidoMaterno = $request->input('apellidoMaterno');
        $correo = $request->input('correo');

        if(empty($request->pass)){
            DB::select('CALL ActualizarUsuarioSupervisor(?,?,?,?,?,?)',[
                $id_supervisor,
                $nombre,
                $apellidoPaterno,
                $apellidoMaterno,
                $correo,
                ''
            ]);
        }
        else{
            $pass = hash::make($request->input('pass'));

            DB::select('CALL ActualizarUsuarioSupervisor(?,?,?,?,?,?)',[
                $id_supervisor,
                $nombre,
                $apellidoPaterno,
                $apellidoMaterno,
                $correo,
                $pass
            ]);
        }

        $datos_supervisor =DB::select('CALL ObtenerDatosSupervisor(?)',[$id_supervisor]);

        return view('supervisor.perfil', compact('datos_supervisor'));

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
