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
            'correo' => 'required|email|max:255|unique:users,email',
            'carrera' => 'required|exists:carreras,id',
            'passPart1' => 'required|min:8',
            'passPart2' => 'required|min:8|same:passPart1',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'apellido_paterno.required' => 'El campo apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El campo apellido materno es obligatorio.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El correo debe ser una dirección de correo válida.',
            'correo.unique' => 'El correo ya está registrado.',
            'carrera.required' => 'El campo carrera es obligatorio.',
            'carrera.exists' => 'La carrera seleccionada no es válida.',
            'passPart1.required' => 'El campo contraseña es obligatorio.',
            'passPart1.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'passPart2.required' => 'El campo verificar contraseña es obligatorio.',
            'passPart2.min' => 'La verificación de la contraseña debe tener al menos 8 caracteres.',
            'passPart2.same' => 'Las contraseñas no coinciden.',
        ]);

        $nombre = $request->input('nombre');
        $apellido_paterno = $request->input('apellido_paterno');
        $apellido_materno = $request->input('apellido_materno');
        $correo = $request->input('correo');
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
