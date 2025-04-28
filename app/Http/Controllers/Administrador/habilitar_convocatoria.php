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
            'inicio_uso_beca' => 'required|date|before:fin_uso_beca',
            'fin_uso_beca' => 'required|date|after:inicio_uso_beca',
            'limite_solicitudes' => 'required|integer|min:1',
            'carreras' => 'required|array',
            'carreras.*' => 'required|integer|exists:carreras,id',
            'carreras.*' => 'required|integer|min:1', // Asegúrate de validar la cantidad de becas
        ], [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.before' => 'La fecha de inicio debe ser antes de la fecha de cierre.',
            'fecha_cierre.required' => 'La fecha de cierre es obligatoria.',
            'fecha_cierre.date' => 'La fecha de cierre debe ser una fecha válida.',
            'fecha_cierre.after' => 'La fecha de cierre debe ser después de la fecha de inicio.',
            'inicio_uso_beca.required' => 'La fecha de inicio de uso de la beca es obligatoria.',
            'inicio_uso_beca.date' => 'La fecha de inicio de uso de la beca debe ser una fecha válida.',
            'inicio_uso_beca.before' => 'La fecha de inicio de uso de la beca debe ser antes de la fecha de fin de uso de la beca.',
            'fin_uso_beca.required' => 'La fecha de fin de uso de la beca es obligatoria.',
            'fin_uso_beca.date' => 'La fecha de fin de uso de la beca debe ser una fecha válida.',
            'fin_uso_beca.after' => 'La fecha de fin de uso de la beca debe ser después de la fecha de inicio de uso de la beca.',
            'limite_solicitudes.required' => 'El límite de solicitudes por docente es obligatorio.',
            'limite_solicitudes.integer' => 'El límite de solicitudes por docente debe ser un número entero.',
            'limite_solicitudes.min' => 'El límite de solicitudes por docente debe ser al menos 1.',
            'carreras.required' => 'Debe seleccionar al menos una carrera.',
            'carreras.*.exists' => 'La carrera seleccionada no es válida.',
            'carreras.*.min' => 'La cantidad de becas debe ser al menos 1.',
        ]);

        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_cierre = $request->input('fecha_cierre');
        $inicio_uso_beca = $request->input('inicio_uso_beca');
        $fin_uso_beca = $request->input('fin_uso_beca');
        $limite_solicitudes = $request->input('limite_solicitudes');

        // Verificar si el administrador está autenticado
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'No estás autenticado.');
        }

        // Actualizar convocatorias finalizadas automáticamente
        DetallesBeca::where('estado_convocatoria', 'activa')
            ->where('fin_convocatoria', '<', now())
            ->each(function ($convocatoria) {
                $convocatoria->update(['estado_convocatoria' => 'finalizada']);
            });

        // Crear nueva convocatoria
        $detalleBeca = new DetallesBeca();
        $detalleBeca->administrador_general_id = auth()->user()->administradorGeneral->id; // Obtener el ID del administrador general
        $detalleBeca->estado_convocatoria = 'activa'; // Asegúrate de que el estado sea 'activa'
        $detalleBeca->inicio_convocatoria = $fecha_inicio;
        $detalleBeca->fin_convocatoria = $fecha_cierre;
        $detalleBeca->inicio_uso_beca = $inicio_uso_beca;
        $detalleBeca->fin_uso_beca = $fin_uso_beca;
        $detalleBeca->save();

        foreach ($request->input('carreras') as $carrera_id => $cantidad_de_becas) {
            $becaCarrera = new BecasCarrera();
            $becaCarrera->carreras_id = $carrera_id;
            $becaCarrera->detalles_beca_id = $detalleBeca->id;
            $becaCarrera->cantidad_de_becas = $cantidad_de_becas;
            $becaCarrera->limite_solicitudes = $limite_solicitudes;
            $becaCarrera->save();
        }

        return redirect()->back()->with('success', 'Se ha habilitado correctamente!');
    }

    public function verificarConvocatoria()
    {
        $detallesBeca = DetallesBeca::where('estado_convocatoria', 'activa')
            ->where('inicio_convocatoria', '<=', now())
            ->where('fin_convocatoria', '>=', now())
            ->first();

        if (!$detallesBeca) {
            return response()->json(['activa' => false, 'error' => 'No hay convocatorias activas.']);
        }

        return response()->json([
            'activa' => true,
            'inicio_convocatoria' => $detallesBeca->inicio_convocatoria,
            'fin_convocatoria' => $detallesBeca->fin_convocatoria,
        ]);
    }
}
