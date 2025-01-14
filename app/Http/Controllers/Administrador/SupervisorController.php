<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;

class SupervisorController extends Controller
{
    /**
     * Muestra la lista de supervisores con sus datos de usuario asociados.
     *
     * @return \Illuminate\View\View
     */
    public function listaSupervisores()
    {
        // Obtener supervisores con la relación 'usuario' cargada (eager loading)
        $supervisores = Supervisor::with('usuario')->get();

        // Pasar la colección de supervisores a la vista
        return view('administrador.listaSupervisores', compact('supervisores'));
    }

    /**
     * Elimina un supervisor.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function eliminarSupervisor($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        
        // Eliminar las relaciones de carreras
        $supervisor->carreras()->detach();
        
        // Eliminar el supervisor
        $supervisor->delete();

        return redirect()->route('administrador.listaSupervisores')->with('success', 'Supervisor eliminado correctamente');
    }
}
