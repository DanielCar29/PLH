<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\DB;

class visualizar_solicitudes extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener el ID del supervisor autenticado
        $supervisorId = auth()->user()->id;
        $supervisorId = DB::table('supervisores')
            ->where('usuario_id', auth()->user()->id)
            ->value('id');

        $carrera = DB::table('carreras_supervisor as cs')
            ->join('carreras as c', 'cs.carreras_id', '=', 'c.id')
            ->where('cs.supervisor_id', $supervisorId)
            ->select('c.carrera')
            ->first();

        $carrera = $carrera->carrera;

        $detallesBeca = DB::table('detalles_becas')
            ->where('estado_convocatoria', 'activa')
            ->select('inicio_convocatoria', 'fin_convocatoria')
            ->first();

        $alumnos = DB::table('alumno_solicitudbeca as asb')
            ->join('alumnos as a', 'asb.alumno_id', '=', 'a.id')
            ->join('users as u', 'a.usuario_id', '=', 'u.id')
            ->join('solicitudes_de_beca as sb', 'asb.solicitud_de_beca_id', '=', 'sb.id')
            ->join('carreras_alumno as ca', 'ca.alumno_id', '=', 'a.id')
            ->join('carreras_supervisor as cs', 'cs.carreras_id', '=', 'ca.carreras_id')
            ->select(
            'a.id as alumno_id', 
            'u.name', 
            'u.apellido_paterno', 
            'u.apellido_materno', 
            'a.numero_de_control', 
            'sb.fecha_solicitud as fecha_solicitud', 
            'asb.estado as estado'
            )
            ->where('asb.envio', 0)
            ->where('cs.supervisor_id', $supervisorId)
            ->whereBetween('sb.fecha_solicitud', [$detallesBeca->inicio_convocatoria, $detallesBeca->fin_convocatoria])
            ->get();

        $totalSolicitudes = DB::table('alumno_solicitudbeca as asb')
            ->join('alumnos as a', 'asb.alumno_id', '=', 'a.id')
            ->join('carreras_alumno as ca', 'a.id', '=', 'ca.alumno_id')
            ->join('carreras_supervisor as cs', 'ca.carreras_id', '=', 'cs.carreras_id')
            // ->where('asb.estado', 'pendiente')
            ->where('asb.envio', 0)
            ->where('cs.supervisor_id', $supervisorId)
            ->select(DB::raw('COUNT(asb.id) as total_solicitudes'))
            ->first();

        $limiteSolicitudes = DB::table('becas_carrera as bc')
            ->join('carreras_supervisor as cs', 'bc.carreras_id', '=', 'cs.carreras_id')
            ->where('cs.supervisor_id', $supervisorId)
            ->select('bc.limite_solicitudes')
            ->first();

        $totalSolicitudes = $totalSolicitudes->total_solicitudes;
        $limiteSolicitudes = $limiteSolicitudes->limite_solicitudes;

        // Retornar la vista con los datos de los alumnos
        return view('supervisor.visualizar_solicitud', compact('alumnos','totalSolicitudes','limiteSolicitudes','carrera'));
    }

    public function verSolicitudAlumno($id){

        $alumno = DB::table('alumnos as a')
            ->join('users as u', 'a.usuario_id', '=', 'u.id')
            ->join('carreras_alumno as ca', 'a.id', '=', 'ca.alumno_id')
            ->join('carreras as c', 'ca.carreras_id', '=', 'c.id')
            ->select(
                'a.id as alumno_id',
                'a.numero_de_control as Numero_de_control',
                'u.name as Nombre',
                'u.apellido_paterno as Apellido_Paterno',
                'u.apellido_materno as Apellido_Materno',
                'c.carrera as Carrera'
            )
            ->where('a.id', $id)
            ->get();

        $detallesBecaActiva = DB::table('detalles_becas')
            ->where('estado_convocatoria', 'activa')
            ->select('inicio_convocatoria', 'fin_convocatoria')
            ->first();

        $preguntas_alumno = DB::table('respuestas_alumno as ra')
            ->join('preguntas_de_solicitud_del_alumno as psa', 'ra.preguntas_id', '=', 'psa.id')
            ->join('respuestas_solicitud as rs', 'ra.id', '=', 'rs.respuestas_alumno_id')
            ->join('alumno_solicitudbeca as asb', 'rs.solicitud_de_beca_id', '=', 'asb.solicitud_de_beca_id')
            ->join('alumnos as a', 'asb.alumno_id', '=', 'a.id')
            ->join('solicitudes_de_beca as sb', 'asb.solicitud_de_beca_id', '=', 'sb.id')
            ->select(
            'a.id as alumno_id',
            'a.numero_de_control',
            'psa.pregunta',
            'ra.respuesta'
            )
            ->where('a.id', $id)
            ->whereBetween('sb.fecha_solicitud', [$detallesBecaActiva->inicio_convocatoria, $detallesBecaActiva->fin_convocatoria])
            ->get();

        return view('supervisor.ver_solicitud_alumno', compact('alumno','preguntas_alumno'));

    }

    public function aceptarSolicitud($id){

        $estado = 'aceptada';

        DB::table('alumno_solicitudbeca')
            ->where('alumno_id', $id)
            ->update(['estado' => $estado]);


        $alumno = DB::table('alumnos as a')
            ->join('users as u', 'a.usuario_id', '=', 'u.id')
            ->select(
            'u.name as nombre', 
            'u.apellido_paterno', 
            'u.apellido_materno'
            )
            ->where('a.id', $id)
            ->first();

        return redirect()->route('supervisor.visualizar_solicitud')->with(['success' => 'Se ha cambiado el estado de la solicitud del alumno: '.
                                                                            $alumno->nombre.' '.
                                                                            $alumno->apellido_materno.' '.
                                                                            $alumno->apellido_paterno. ' a aceptada!']);

    }

    public function rechazarSolicitud($id){

        $estado = 'rechazada';

        DB::table('alumno_solicitudbeca')
            ->where('alumno_id', $id)
            ->update(['estado' => $estado]);

        $alumno = DB::table('alumnos as a')
            ->join('users as u', 'a.usuario_id', '=', 'u.id')
            ->select(
            'u.name as nombre', 
            'u.apellido_paterno', 
            'u.apellido_materno'
            )
            ->where('a.id', $id)
            ->first();

        return redirect()->route('supervisor.visualizar_solicitud')->with(['success' => 'Se ha cambiado el estado de la solicitud del alumno: '.
                                                                            $alumno->nombre.' '.
                                                                            $alumno->apellido_materno.' '.
                                                                            $alumno->apellido_paterno. ' a rechazada!']);

    }

    public function esperaSolicitud($id){

        //NOTA: Esta función no está siendo utilizada en la versión actual del sistema, de ser posible podría elimarse en futuras versiones.

        $estado = 'pendiente';

        DB::table('alumno_solicitudbeca')
            ->where('alumno_id', $id)
            ->update(['estado' => $estado]);

            $alumno = DB::table('alumnos as a')
            ->join('users as u', 'a.usuario_id', '=', 'u.id')
            ->select(
            'u.name as nombre', 
            'u.apellido_paterno', 
            'u.apellido_materno'
            )
            ->where('a.id', $id)
            ->first();

        return redirect()->route('supervisor.visualizar_solicitud')->with(['success' => 'Se ha cambiado el estado de la solicitud del alumno: '.
                                                                            $alumno->nombre.' '.
                                                                            $alumno->apellido_materno.' '.
                                                                            $alumno->apellido_paterno. ' a pendiente!']);

    }

    public function enviarListaSolicitudes(){

        // Desactivar el modo de actualización segura
        DB::statement("SET @old_safe_updates = @@sql_safe_updates;");
        DB::statement("SET @@sql_safe_updates = 0;");

        // Iniciar la transacción
        DB::beginTransaction();

        try {
            // Obtener el ID del supervisor autenticado
            $supervisorId = auth()->user()->id;
            $supervisorId = DB::table('supervisores')
                ->where('usuario_id', auth()->user()->id)
                ->value('id');

            // Insertar registros en listas_solicitud para aquellos con estado = 'aceptada', envio = 0 y que correspondan a la carrera del supervisor
            DB::table('listas_solicitud')->insertUsing(
                ['carreras_id', 'solicitud_de_beca_id', 'created_at', 'updated_at'],
                DB::table('alumno_solicitudbeca as asb')
                    ->join('alumnos as a', 'asb.alumno_id', '=', 'a.id')
                    ->join('carreras_alumno as ca', 'a.id', '=', 'ca.alumno_id')
                    ->join('carreras_supervisor as cs', 'ca.carreras_id', '=', 'cs.carreras_id')
                    ->where('asb.estado', 'aceptada')
                    ->where('asb.envio', 0)
                    ->where('cs.supervisor_id', $supervisorId)
                    ->select('ca.carreras_id', 'asb.solicitud_de_beca_id', DB::raw('NOW()'), DB::raw('NOW()'))
            );

            // Actualizar el campo envio a 1 solo para aquellos que no han sido enviados y que correspondan a la carrera del supervisor
            DB::table('alumno_solicitudbeca as asb')
                ->join('alumnos as a', 'asb.alumno_id', '=', 'a.id')
                ->join('carreras_alumno as ca', 'a.id', '=', 'ca.alumno_id')
                ->join('carreras_supervisor as cs', 'ca.carreras_id', '=', 'cs.carreras_id')
                ->where('asb.envio', 0)
                ->where('cs.supervisor_id', $supervisorId)
                ->update(['asb.envio' => 1]);

            // Confirmar la transacción
            DB::commit();

            // Restaurar el modo de actualización segura
            DB::statement("SET @@sql_safe_updates = @old_safe_updates;");
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            DB::statement("SET @@sql_safe_updates = @old_safe_updates;");
            throw $e;
        }

        return redirect()->route('supervisor.visualizar_solicitud')->with(['success' => 'Se ha enviado la lista de solicitudes!']);

    }
}