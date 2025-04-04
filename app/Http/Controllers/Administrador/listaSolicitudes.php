<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Carrera;
use App\Models\Alumno;
use App\Models\AlumnoSolicitudBeca;
use App\Models\Beca;
use App\Models\AlumnoBeca;
use App\Models\ListaSolicitud;

class listaSolicitudes extends Controller
{
    public function index() {
        $carreras = Carrera::all();
        $solicitudesPorCarrera = [];

        foreach ($carreras as $carrera) {
            $solicitudesPorCarrera[$carrera->id] = Alumno::whereHas('carreras', function($query) use ($carrera) {
                $query->where('carreras.id', $carrera->id);
            })->whereHas('solicitudesBeca', function($query) {
                $query->whereHas('listaSolicitud', function($query) {
                    $query->where('envio', 0); // Excluir solicitudes ya enviadas
                });
            })->with(['user', 'solicitudesBeca' => function($query) {
                $query->with('listaSolicitud');
            }])->get();
        }

        return view('administrador.listaSolicitudes', compact('carreras', 'solicitudesPorCarrera'));
    }

    public function verSolicitudAlumno($id){
        $alumno = Alumno::with('user', 'carreras')->find($id);
        $preguntas_alumno = DB::select('CALL obtenerAlumnoRespuestas(?)',[$id]);
        $estado = AlumnoSolicitudBeca::where('alumno_id', $id)->value('estado');

        return view('administrador.verSolicitudAlumno', compact('alumno', 'preguntas_alumno', 'estado'));
    }

    public function aceptarSolicitud($id){
        $estado = 'aceptada';
        ListaSolicitud::where('solicitud_de_beca_id', $id)->update(['estado' => $estado]);

        return redirect()->route('administrador.listaSolicitudes');
    }

    public function rechazarSolicitud($id){
        $estado = 'rechazada';
        ListaSolicitud::where('solicitud_de_beca_id', $id)->update(['estado' => $estado]);

        return redirect()->route('administrador.listaSolicitudes');
    }

    public function activarBeca() {
        $alumnos = Alumno::whereHas('solicitudesBeca.listaSolicitud', function($query) {
            $query->where('envio', 0);
        })->get();

        foreach ($alumnos as $alumno) {
            $this->activarBecaParaAlumno($alumno);
        }

        return redirect()->route('administrador.listaSolicitudes')->with('success', 'Becas activadas correctamente.');
    }

    public function activarBecaPorCarrera($carrera_id) {
        $alumnos = Alumno::whereHas('carreras', function($query) use ($carrera_id) {
            $query->where('carreras.id', $carrera_id);
        })->whereHas('solicitudesBeca.listaSolicitud', function($query) {
            $query->where('envio', 0);
        })->get();

        foreach ($alumnos as $alumno) {
            $this->activarBecaParaAlumno($alumno);
        }

        return redirect()->route('administrador.listaSolicitudes')->with('success', 'Becas activadas correctamente para la carrera seleccionada.');
    }

    private function activarBecaParaAlumno($alumno) {
        $solicitudBeca = $alumno->solicitudesBeca->first();
        if ($solicitudBeca) {
            if ($solicitudBeca->listaSolicitud->estado == 'aceptada') {
                $codigo_qr = $this->generateUniqueQrCode();

                $beca = Beca::create([
                    'fecha_de_autorizacion' => now(),
                    'codigo_qr' => $codigo_qr,
                    'estado' => 'activo',
                    'becas_carrera_id' => $alumno->carreras->first()->id // Asignar el ID correcto de la carrera del alumno
                ]);

                AlumnoBeca::create([
                    'alumno_id' => $alumno->id,
                    'beca_id' => $beca->id
                ]);
            }
            $solicitudBeca->listaSolicitud->update(['envio' => 1]);
        }
    }

    private function generateUniqueQrCode() {
        do {
            $codigo_qr = bin2hex(random_bytes(16)); // Generar un código QR único
        } while (Beca::where('codigo_qr', $codigo_qr)->exists());

        return $codigo_qr;
    }
}