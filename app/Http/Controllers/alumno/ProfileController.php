<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $alumno = $user->alumno; // Obtener la información del alumno relacionado

        return view('alumno.perfil', compact('user', 'alumno'));

    }
}
