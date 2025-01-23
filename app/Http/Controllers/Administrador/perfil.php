<?php

namespace App\Http\Controllers\Administrador;

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
        $admin = User::with('administradorGeneral')->find($id_user);

        if (!$admin || !$admin->administradorGeneral) {
            return redirect()->back()->withErrors(['error' => 'No se encontraron datos del administrador.']);
        }

        return view('administrador.perfil', compact('admin'));
    }

    public function actualizarPerfil(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255',
            'pass_actual' => 'required|string|min:8',
            'pass_nueva' => 'nullable|string|min:8|confirmed',
        ]);

        $id_user = auth()->user()->id;
        $user = User::with('administradorGeneral')->find($id_user);

        if (!$user || !$user->administradorGeneral) {
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

        $user->save();

        return redirect()->back()->with([
            'success' => 'Se han hecho cambios correctamente!',
            'admin' => $user,
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
