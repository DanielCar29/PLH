<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\carreras; // Asegúrate de importar el modelo Carrera
use App\Models\User;
use App\Models\alumnos;
use App\Models\carreras_alumno;  // Asegúrate de importar el modelo Alumno
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $carreras = carreras::all(); // O cualquier método que obtenga las carreras
        return view('registro', compact('carreras'));
    }
    
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        dd($request->all());
        $request->validate([
            // Validación de otros campos...
            'name' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'apellido_materno' => ['required', 'string', 'max:255'],
            'numero_de_control' => ['required', 'string', 'max:9', 'unique:alumnos'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'semestre' => ['required', 'string', 'max:255'],
            'carrera' => ['required', 'exists:carreras,id'], // Asegurar que la carrera seleccionada exista en la tabla de carreras
        ]);
        

        // Crear el usuario
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Asociar al alumno con la carrera seleccionada
    $carrera = carreras::findOrFail($request->carrera);

    // Crear el estudiante asociado con el usuario
    $alumno = new alumnos();
    $alumno->numero_de_control = $request->numero_de_control;
    $alumno->semestre = $request->semestre;
    $alumno->role = 'alumno'; // Asumiendo que el rol es 'alumno'
    $alumno->user_id = $user->id;
    $alumno->save();

    // Crear una nueva entrada en la tabla pivot carreras_alumno
    $carrera_alumno = new carreras_alumno();
    $carrera_alumno->carreras_id = $carrera->id; // ID de la carrera seleccionada
    $carrera_alumno->alumno_id = $alumno->id; // ID del alumno recién creado
    $carrera_alumno->save();

    // Autenticar al usuario recién registrado
    Auth::login($user);

    // Redirigir al usuario a la página de inicio del alumno
    return redirect(RouteServiceProvider::HOME_ALUMNO);
    }
}
