<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class habilitar_convocatoria extends Controller
{
    public function index(){

        return view('administrador.habilitarConvocatoria');

    }

    public function habilitarConvocatoria(Request $request){

        $num_informatica = $request->input('informatica');
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_cierre = $request->input('fecha_cierre');

        DB::select('CALL insertar_detalle_beca(?,?,?,?,?,?)',[
            $num_informatica,
            1,
            1,
            'activo',
            $fecha_inicio,
            $fecha_cierre
        ]);

        return redirect()->back()->with('success', 'Se ha habilitado correctamente!');
    }
}
