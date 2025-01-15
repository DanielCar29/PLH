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
            'pass' => 'nullable|string|min:8|confirmed',
        ]);

        $id_user = auth()->user()->id;
        $user = User::find($id_user);

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Usuario no encontrado.']);
        }

        $user->name = $request->input('nombre');
        $user->apellido_paterno = $request->input('apellido_paterno');
        $user->apellido_materno = $request->input('apellido_materno');
        $user->email = $request->input('correo');

        if (!empty($request->pass)) {
            $user->password = Hash::make($request->input('pass'));
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
