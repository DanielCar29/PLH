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
            ->get();

        // Retornar la vista con los datos de los alumnos
        return view('supervisor.visualizar_solicitud', compact('alumnos'));
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

        $preguntas_alumno = DB::table('respuestas_alumno as ra')
            ->join('preguntas_de_solicitud_del_alumno as psa', 'ra.preguntas_id', '=', 'psa.id')
            ->join('respuestas_solicitud as rs', 'ra.id', '=', 'rs.respuestas_alumno_id')
            ->join('alumno_solicitudbeca as asb', 'rs.solicitud_de_beca_id', '=', 'asb.solicitud_de_beca_id')
            ->join('alumnos as a', 'asb.alumno_id', '=', 'a.id')
            ->select(
                'a.id as alumno_id',
                'a.numero_de_control',
                'psa.pregunta',
                'ra.respuesta'
            )
            ->where('a.id', $id)
            ->get();

        return view('supervisor.ver_solicitud_alumno', compact('alumno','preguntas_alumno'));

    }

    public function aceptarSolicitud($id){

        $estado = 'aceptada';

        DB::table('alumno_solicitudbeca')
            ->where('alumno_id', $id)
            ->update(['estado' => $estado]);

        // Obtener el ID del supervisor autenticado
        $supervisorId = auth()->user()->id;

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
            ->get();

        return view('supervisor.visualizar_solicitud', compact('alumnos'));

    }

    public function rechazarSolicitud($id){

        $estado = 'rechazada';

        DB::table('alumno_solicitudbeca')
            ->where('alumno_id', $id)
            ->update(['estado' => $estado]);

        // Obtener el ID del supervisor autenticado
        $supervisorId = auth()->user()->id;

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
            ->get();

        return view('supervisor.visualizar_solicitud', compact('alumnos'));

    }

    public function esperaSolicitud($id){

        //NOTA: Esta función no está siendo utilizada en la versión actual del sistema, de ser posible podría elimarse en futuras versiones.

        $estado = 'pendiente';

        DB::table('alumno_solicitudbeca')
            ->where('alumno_id', $id)
            ->update(['estado' => $estado]);

        // Obtener el ID del supervisor autenticado
        $supervisorId = auth()->user()->id;

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
            ->get();

        return view('supervisor.visualizar_solicitud', compact('alumnos'));

    }

    public function enviarListaSolicitudes(){

        // Desactivar el modo de actualización segura
        DB::statement("SET @old_safe_updates = @@sql_safe_updates;");
        DB::statement("SET @@sql_safe_updates = 0;");

        // Iniciar la transacción
        DB::beginTransaction();

        try {
            // Actualizar el campo envio a 1
            DB::table('alumno_solicitudbeca')
                ->update(['envio' => 1]);

            // Insertar registros en listas_solicitud para aquellos con estado = 'aceptada'
            DB::table('listas_solicitud')->insertUsing(
                ['carreras_id', 'solicitud_de_beca_id', 'created_at', 'updated_at'],
                DB::table('alumno_solicitudbeca as asb')
                    ->join('alumnos as a', 'asb.alumno_id', '=', 'a.id')
                    ->join('carreras_alumno as ca', 'a.id', '=', 'ca.alumno_id')
                    ->where('asb.estado', 'aceptada')
                    ->select('ca.carreras_id', 'asb.solicitud_de_beca_id', DB::raw('NOW()'), DB::raw('NOW()'))
            );

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

        // Obtener el ID del supervisor autenticado
        $supervisorId = auth()->user()->id;

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
            ->get();

        return redirect()->route('supervisor.visualizar_solicitud')->with(['success' => 'Se ha enviado la lista de solicitudes!']);

    }

}
