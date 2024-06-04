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

            session()->flash('message', 'Se ha creado Supervisor: '.$nombre.' '.$apellido_paterno.' '.$apellido_materno);

            $carreras = carreras::all();

            return view('administrador.registrarSupervisor',compact('carreras'));
        }
        else{

            session()->flash('message', 'Algo salió mal. Intenta de nuevo');

            $carreras = carreras::all();

            return view('administrador.registrarSupervisor',compact('carreras'));

        }

        

    }

    /**
     * Store a newly created resource in storage.
     */
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
