<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = auth()->user()->id;
        $alumno = User::with(['alumno', 'alumno.carreras'])->where('id', $id_user)->first();

        if (!$alumno || !$alumno->alumno) {
            return redirect()->back()->withErrors(['error' => 'No se encontraron datos del alumno.']);
        }

        return view('alumno.perfil', compact('alumno'));
    }

    public function actualizarPerfil(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255',
            'pass_actual' => 'required|string|min:8',
            'pass_nueva' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::with('alumno')->find($id);

        if (!$user || !$user->alumno) {
            return redirect()->back()->withErrors(['error' => 'Usuario no encontrado.']);
        }

        if (!Hash::check($request->input('pass_actual'), $user->password)) {
            return redirect()->back()->withErrors(['error' => 'Los cambios no se pudieron hacer porque la contraseña no es correcta.']);
        }

        $user->name = $request->input('nombre');
        $user->apellido_paterno = $request->input('apellido_paterno');
        $user->apellido_materno = $request->input('apellido_materno');
        $user->email = $request->input('correo');

        if (!empty($request->pass_nueva)) {
            $user->password = Hash::make($request->input('pass_nueva'));
        }

        $user->alumno->numero_de_control = $request->input('numero_control');
        $user->alumno->semestre = $request->input('semestre');

        $user->save();
        $user->alumno->save();

        return redirect()->back()->with([
            'success' => 'Se han hecho cambios correctamente!',
            'alumno' => $user,
        ]);
    }
}
