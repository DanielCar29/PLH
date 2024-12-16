<?php
namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrera;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class registrar_supervisor extends Controller
{
    /**
     * Muestra el formulario para registrar un supervisor.
     */
    public function index()
    {
        $carreras = Carrera::all(); // Obtén todas las carreras
        return view('administrador.registrarSupervisor', compact('carreras'));
    }

    /**
     * Registra un nuevo supervisor.
     */
    public function registrarSupervisor(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido_paterno' => 'required|string|max:255',
        'apellido_materno' => 'required|string|max:255',
        'correoPart1' => 'required|max:255',
        'correoPart2' => 'required|regex:/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/',
        'carrera' => 'required|exists:carreras,id',
        'passPart1' => 'required|min:8',
        'passPart2' => 'required|min:8',
    ], [
        'correoPart2.regex' => 'El dominio del correo electrónico debe ser válido.',
    ]);
    
    // Verifica si las contraseñas son iguales
    if ($request->input('passPart1') !== $request->input('passPart2')) {
        return back()->withErrors(['passPart2' => 'Las contraseñas no coinciden.']);
    }
    
    // Combina las partes del correo electrónico
$correo = $request->input('correoPart1') . '@' . $request->input('correoPart2');

// Validación de formato de correo (dominio incorrecto)
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    return back()->withErrors([
        'correoPart1' => 'El correo electrónico no es válido.',
        'correoPart2' => 'El dominio del correo electrónico debe ser válido.'
    ])->withInput();
}

// Verifica si el correo ya existe en la base de datos
if (User::where('email', $correo)->exists()) {
    return back()->withErrors([
        'correoPart1' => 'El correo electrónico ya está registrado.',
        'correoPart2' => 'Por favor, utiliza un correo diferente.'
    ])->withInput();
}

    
    $nombre = $request->input('nombre');
    $apellido_paterno = $request->input('apellido_paterno');
    $apellido_materno = $request->input('apellido_materno');
    $carrera = $request->input('carrera');
    $passPart1 = $request->input('passPart1');
    
    $usuario = new User();
    $usuario->name = $nombre;
    $usuario->apellido_paterno = $apellido_paterno;
    $usuario->apellido_materno = $apellido_materno;
    $usuario->email = $correo;
    $usuario->password = bcrypt($passPart1);
    $usuario->role = 'supervisor';
    $usuario->save();
    
    $supervisor = new Supervisor();
    $supervisor->usuario_id = $usuario->id;
    $supervisor->save();
    
    $supervisor->carreras()->attach($carrera);
    
    return redirect()->route('administrador.listaSupervisores')->with('success', 'Supervisor registrado correctamente');
}    
}
