<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumno;

class BecaController extends Controller
{
    public function show()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el alumno asociado al usuario
        $alumno = $user->alumno;

        // Obtener la beca del alumno
        $beca = $alumno->becas()->first();

        // Retornar la vista con los datos de la beca
        return view('alumno.ver_beca', compact('beca'));


    }
}
