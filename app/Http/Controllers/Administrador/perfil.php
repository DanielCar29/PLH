<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class perfil extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = auth()->user()->id;
        $admin = DB::select('CALL obtenerDatosAdmin(?)',[$id_user]);
        return view('administrador.perfil',compact('admin'));
    }


    public function actualizarPerfil(Request $request){

        $id_user = auth()->user()->id;
        $nombre = $request->input('nombre');
        $apellido_paterno = $request->input('apellido_paterno');
        $apellido_materno = $request->input('apellido_materno');
        $correo = $request->input('correo');

        if(empty($request->pass)){
            DB::select('CALL ActualizarUsuario(?,?,?,?,?,?)',[
                $id_user,
                $nombre,
                $apellido_paterno,
                $apellido_materno,
                $correo,
                ''
            ]);
        }
        else{
            $pass = hash::make($request->input('pass'));

            DB::select('CALL ActualizarUsuario(?,?,?,?,?,?)',[
                $id_user,
                $nombre,
                $apellido_paterno,
                $apellido_materno,
                $correo,
                $pass
            ]);
        }

        $admin = DB::select('CALL obtenerDatosAdmin(?)',[$id_user]);

        return redirect()->back()->with([
            'success' => 'Se han hecho cambios correctamente!',
            'admin' => $admin,
        ]);

    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
