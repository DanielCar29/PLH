<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetallesBeca;
use App\Models\BecasCarrera;
use App\Models\Carrera;

class habilitar_convocatoria extends Controller
{
    public function index(){
        $carreras = Carrera::all();
        return view('administrador.habilitarConvocatoria', compact('carreras'));
    }

    public function habilitarConvocatoria(Request $request){
        // Validar los datos del formulario
        $request->validate([
            'fecha_inicio' => 'required|date|before:fecha_cierre',
            'fecha_cierre' => 'required|date|after:fecha_inicio',
            'carreras' => 'required|array',
            'carreras.*' => 'required|integer|exists:carreras,id',
            'cantidad_de_becas.*' => 'required|integer|min:1',
        ], [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.before' => 'La fecha de inicio debe ser antes de la fecha de cierre.',
            'fecha_cierre.required' => 'La fecha de cierre es obligatoria.',
            'fecha_cierre.date' => 'La fecha de cierre debe ser una fecha válida.',
            'fecha_cierre.after' => 'La fecha de cierre debe ser después de la fecha de inicio.',
            'carreras.required' => 'Debe seleccionar al menos una carrera.',
            'carreras.*.exists' => 'La carrera seleccionada no es válida.',
            'cantidad_de_becas.*.required' => 'La cantidad de becas es obligatoria.',
            'cantidad_de_becas.*.integer' => 'La cantidad de becas debe ser un número entero.',
            'cantidad_de_becas.*.min' => 'La cantidad de becas debe ser al menos 1.',
        ]);

        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_cierre = $request->input('fecha_cierre');

        // Verificar si el administrador está autenticado
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'No estás autenticado.');
        }

        $detalleBeca = new DetallesBeca();
        $detalleBeca->administrador_general_id = auth()->user()->administradorGeneral->id; // Obtener el ID del administrador general
        $detalleBeca->estado_convocatoria = 'activo';
        $detalleBeca->inicio_convocatoria = $fecha_inicio;
        $detalleBeca->fin_convocatoria = $fecha_cierre;
        $detalleBeca->save();

        foreach ($request->input('carreras') as $carrera_id => $cantidad_de_becas) {
            $becaCarrera = new BecasCarrera();
            $becaCarrera->carreras_id = $carrera_id;
            $becaCarrera->detalles_beca_id = $detalleBeca->id;
            $becaCarrera->cantidad_de_becas = $cantidad_de_becas;
            $becaCarrera->save();
        }

        return redirect()->back()->with('success', 'Se ha habilitado correctamente!');
    }
}
