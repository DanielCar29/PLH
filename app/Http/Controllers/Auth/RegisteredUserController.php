<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Alumno;
use App\Models\CarrerasAlumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $carreras = carrera::all(); // O cualquier método que obtenga las carreras
        return view('registro', compact('carreras'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'apellido_materno' => ['required', 'string', 'max:255'],
            'numero_de_control' => ['required', 'string', 'max:9', 'unique:alumnos'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'semestre' => ['required', 'string', 'max:255'],
            'carrera' => ['required', 'exists:carreras,id'],
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'role' => 'alumno',
        ]);

        // Asociar al alumno con la carrera seleccionada
        $carrera = carrera::findOrFail($request->carrera);

        // Crear el estudiante asociado con el usuario
        $alumno = new Alumno();
        $alumno->numero_de_control = $request->numero_de_control;
        $alumno->semestre = $request->semestre;
        $alumno->usuario_id = $user->id;
        $alumno->save();

        // Crear una nueva entrada en la tabla pivot carreras_alumno
        $carrera_alumno = new CarrerasAlumno();
        $carrera_alumno->carreras_id = $carrera->id; // ID de la carrera seleccionada
        $carrera_alumno->alumno_id = $alumno->id; // ID del alumno recién creado
        $carrera_alumno->save();

        // Autenticar al usuario recién registrado
        Auth::login($user);

        // Redirigir al usuario a la página de inicio del alumno
        return redirect(RouteServiceProvider::HOME_ALUMNO);
    }
}
