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

        // Obtener el ID de la última solicitud del alumno
        $ultimaSolicitudId = DB::table('alumno_solicitudbeca as asb')
            ->join('solicitudes_de_beca as sb', 'asb.solicitud_de_beca_id', '=', 'sb.id')
            ->where('asb.alumno_id', $id)
            ->orderBy('sb.created_at', 'desc') // Ordenar por la fecha más reciente
            ->value('sb.id'); // Obtener el ID de la última solicitud

        if (!$ultimaSolicitudId) {
            // Si no hay solicitudes, devolver una vista con un mensaje de error
            return view('administrador.verSolicitudAlumno', compact('alumno'))
                ->with('error', 'No se encontraron solicitudes para este alumno.');
        }

        // Subconsulta para obtener las respuestas más recientes por pregunta
        $subquery = DB::table('respuestas_alumno as ra')
            ->join('respuestas_solicitud as rs', 'ra.id', '=', 'rs.respuestas_alumno_id')
            ->where('rs.solicitud_de_beca_id', $ultimaSolicitudId)
            ->select('ra.preguntas_id', DB::raw('MAX(ra.created_at) as max_fecha'))
            ->groupBy('ra.preguntas_id');

        // Obtener las respuestas asociadas a la última solicitud
        $preguntas_alumno = DB::table('respuestas_alumno as ra')
            ->join('preguntas_de_solicitud_del_alumno as psa', 'ra.preguntas_id', '=', 'psa.id')
            ->join('respuestas_solicitud as rs', 'ra.id', '=', 'rs.respuestas_alumno_id')
            ->joinSub($subquery, 'sub', function ($join) {
                $join->on('ra.preguntas_id', '=', 'sub.preguntas_id')
                     ->on('ra.created_at', '=', 'sub.max_fecha');
            })
            ->where('rs.solicitud_de_beca_id', $ultimaSolicitudId)
            ->select('psa.pregunta', 'ra.respuesta', 'ra.preguntas_id', 'ra.created_at as fecha_respuesta')
            ->orderBy('ra.preguntas_id', 'asc') // Ordenar por el ID de la pregunta
            ->get();

        // Filtrar la pregunta opcional (pregunta 3) si la respuesta a la pregunta 2 es "No"
        $respuestaPregunta2 = $preguntas_alumno->firstWhere('preguntas_id', 2)->respuesta ?? null;
        if ($respuestaPregunta2 === 'No') {
            $preguntas_alumno = $preguntas_alumno->reject(function ($pregunta) {
                return $pregunta->preguntas_id == 3; // Excluir la pregunta 3
            });
        }

        $estado = AlumnoSolicitudBeca::where('alumno_id', $id)
            ->where('solicitud_de_beca_id', $ultimaSolicitudId) // Filtrar por la última solicitud
            ->value('estado');

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

        return redirect()->route('administrador.listaSolicitudes')->with('success', 'Becas activadas correctamente para todas las carreras.');
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