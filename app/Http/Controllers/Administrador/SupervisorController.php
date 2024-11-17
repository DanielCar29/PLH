<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    public function listaSupervisores()
    {
        $supervisores = DB::select('CALL ObtenerSupervisores()');
        return view('administrador.listaSupervisores', compact('supervisores'));
    }
}
