<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class perfil extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = auth()->user()->id;
        $supervisor = User::with(['supervisor', 'supervisor.carreras'])->find($id_user);

        if (!$supervisor || !$supervisor->supervisor) {
            return redirect()->back()->withErrors(['error' => 'No se encontraron datos del supervisor.']);
        }

        return view('supervisor.perfil', compact('supervisor'));
    }

    public function actualizarPerfil(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidoPaterno' => 'required|string|max:255',
            'apellidoMaterno' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255',
            'pass_actual' => 'required|string|min:8',
            'pass_nueva' => 'nullable|string|min:8|confirmed',
        ]);

        $id_user = auth()->user()->id;
        $user = User::with('supervisor')->find($id_user);

        if (!$user || !$user->supervisor) {
            return redirect()->back()->withErrors(['error' => 'Usuario no encontrado.']);
        }

        if (!Hash::check($request->input('pass_actual'), $user->password)) {
            return redirect()->back()->withErrors(['error' => 'Los cambios no se pudieron hacer porque la contraseña no es correcta.']);
        }

        $user->name = $request->input('nombre');
        $user->apellido_paterno = $request->input('apellidoPaterno');
        $user->apellido_materno = $request->input('apellidoMaterno');
        $user->email = $request->input('correo');

        if (!empty($request->pass_nueva)) {
            $user->password = Hash::make($request->input('pass_nueva'));
        }

        $user->save();

        return redirect()->back()->with([
            'success' => 'Se han hecho cambios correctamente!',
            'supervisor' => $user,
        ]);
    }
}
